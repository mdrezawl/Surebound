<?php

namespace App\Services;

/**
 * Service to generate valid, standard ISO/IEC 18004 QR Codes in pure PHP.
 * Supports Byte mode (UTF-8 / ASCII) with Reed-Solomon Error Correction.
 * Produces crisp SVG vector elements and data URIs without any external dependencies.
 */
class QrCodeService
{
    public const EC_L = 1; // ~7% error recovery

    public const EC_M = 0; // ~15% error recovery (Standard)

    public const EC_Q = 3; // ~25% error recovery

    public const EC_H = 2; // ~30% error recovery

    private static array $exp = [];

    private static array $log = [];

    private static bool $tablesInitialized = false;

    /**
     * Initialize Galois Field GF(256) exponent and logarithm tables.
     */
    private static function initTables(): void
    {
        if (self::$tablesInitialized) {
            return;
        }

        self::$exp = array_fill(0, 512, 0);
        self::$log = array_fill(0, 256, 0);
        $x = 1;

        for ($i = 0; $i < 255; $i++) {
            self::$exp[$i] = $x;
            self::$log[$x] = $i;
            $x <<= 1;
            if ($x & 0x100) {
                $x ^= 0x11D; // Primitive polynomial x^8 + x^4 + x^3 + x^2 + 1 (285)
            }
        }

        for ($i = 255; $i < 512; $i++) {
            self::$exp[$i] = self::$exp[$i - 255];
        }

        self::$tablesInitialized = true;
    }

    /**
     * Multiply two numbers in GF(256).
     */
    private static function gmul(int $a, int $b): int
    {
        if ($a === 0 || $b === 0) {
            return 0;
        }

        return self::$exp[self::$log[$a] + self::$log[$b]];
    }

    /**
     * Generate Reed-Solomon generator polynomial of a specified degree.
     */
    private static function rsGeneratorPoly(int $degree): array
    {
        $poly = [1];
        for ($i = 0; $i < $degree; $i++) {
            $next = [1, self::$exp[$i]];
            $res = array_fill(0, count($poly) + 1, 0);
            for ($j = 0; $j < count($poly); $j++) {
                $res[$j] ^= self::gmul($poly[$j], $next[0]);
                $res[$j + 1] ^= self::gmul($poly[$j], $next[1]);
            }
            $poly = $res;
        }

        return $poly;
    }

    /**
     * Calculate Reed-Solomon error correction codewords for a given data block.
     */
    private static function rsEncode(array $data, int $ecCount): array
    {
        self::initTables();
        $gen = self::rsGeneratorPoly($ecCount);
        $remainder = array_fill(0, $ecCount, 0);

        foreach ($data as $byte) {
            $factor = $byte ^ $remainder[0];
            array_shift($remainder);
            $remainder[] = 0;
            if ($factor !== 0) {
                for ($j = 0; $j < $ecCount; $j++) {
                    $remainder[$j] ^= self::gmul($gen[$j + 1], $factor);
                }
            }
        }

        return $remainder;
    }

    /**
     * Retrieve specifications for QR Code version and EC level.
     *
     * @return array{size: int, align: array<int>, totalData: int, ecPerBlock: int, g1Blocks: int, g1Data: int, g2Blocks: int, g2Data: int}|null
     */
    private static function getVersionTable(int $version, int $ecLevel): ?array
    {
        $table = [
            1 => [
                'size' => 21,
                'align' => [],
                self::EC_L => [19, 7, 1, 19, 0, 0],
                self::EC_M => [16, 10, 1, 16, 0, 0],
                self::EC_Q => [13, 13, 1, 13, 0, 0],
                self::EC_H => [9, 17, 1, 9, 0, 0],
            ],
            2 => [
                'size' => 25,
                'align' => [6, 18],
                self::EC_L => [34, 10, 1, 34, 0, 0],
                self::EC_M => [28, 16, 1, 28, 0, 0],
                self::EC_Q => [22, 22, 1, 22, 0, 0],
                self::EC_H => [16, 28, 1, 16, 0, 0],
            ],
            3 => [
                'size' => 29,
                'align' => [6, 22],
                self::EC_L => [55, 15, 1, 55, 0, 0],
                self::EC_M => [44, 26, 1, 44, 0, 0],
                self::EC_Q => [34, 18, 2, 17, 0, 0],
                self::EC_H => [26, 22, 2, 13, 0, 0],
            ],
            4 => [
                'size' => 33,
                'align' => [6, 26],
                self::EC_L => [80, 20, 1, 80, 0, 0],
                self::EC_M => [64, 18, 2, 32, 0, 0],
                self::EC_Q => [48, 26, 2, 24, 0, 0],
                self::EC_H => [36, 16, 4, 9, 0, 0],
            ],
            5 => [
                'size' => 37,
                'align' => [6, 30],
                self::EC_L => [108, 26, 1, 108, 0, 0],
                self::EC_M => [86, 24, 2, 43, 0, 0],
                self::EC_Q => [62, 18, 2, 15, 2, 16],
                self::EC_H => [46, 22, 2, 11, 2, 12],
            ],
            6 => [
                'size' => 41,
                'align' => [6, 34],
                self::EC_L => [136, 18, 2, 68, 0, 0],
                self::EC_M => [108, 16, 4, 27, 0, 0],
                self::EC_Q => [76, 24, 4, 19, 0, 0],
                self::EC_H => [60, 28, 4, 15, 0, 0],
            ],
            7 => [
                'size' => 45,
                'align' => [6, 22, 38],
                self::EC_L => [156, 20, 2, 78, 0, 0],
                self::EC_M => [124, 18, 4, 31, 0, 0],
                self::EC_Q => [88, 18, 2, 14, 4, 15],
                self::EC_H => [66, 26, 4, 13, 1, 14],
            ],
            8 => [
                'size' => 49,
                'align' => [6, 24, 42],
                self::EC_L => [194, 24, 2, 97, 0, 0],
                self::EC_M => [154, 22, 2, 38, 2, 39],
                self::EC_Q => [110, 22, 4, 18, 2, 19],
                self::EC_H => [86, 26, 4, 14, 2, 15],
            ],
            9 => [
                'size' => 53,
                'align' => [6, 26, 46],
                self::EC_L => [232, 30, 2, 116, 0, 0],
                self::EC_M => [182, 22, 3, 36, 2, 37],
                self::EC_Q => [132, 20, 4, 16, 4, 17],
                self::EC_H => [100, 24, 4, 12, 4, 13],
            ],
            10 => [
                'size' => 57,
                'align' => [6, 28, 50],
                self::EC_L => [274, 18, 2, 68, 2, 69],
                self::EC_M => [216, 26, 4, 43, 1, 44],
                self::EC_Q => [154, 18, 6, 19, 2, 20],
                self::EC_H => [122, 28, 6, 15, 2, 16],
            ],
        ];

        if (! isset($table[$version]) || ! isset($table[$version][$ecLevel])) {
            return null;
        }

        $info = $table[$version][$ecLevel];

        return [
            'size' => $table[$version]['size'],
            'align' => $table[$version]['align'],
            'totalData' => $info[0],
            'ecPerBlock' => $info[1],
            'g1Blocks' => $info[2],
            'g1Data' => $info[3],
            'g2Blocks' => $info[4],
            'g2Data' => $info[5],
        ];
    }

    /**
     * Choose the lowest possible version that fits the byte length.
     */
    private static function chooseVersion(int $byteLen, int $ecLevel): int
    {
        for ($v = 1; $v <= 10; $v++) {
            $info = self::getVersionTable($v, $ecLevel);
            if ($info && $info['totalData'] >= $byteLen + 3) {
                return $v;
            }
        }

        return 10;
    }

    /**
     * Generate the 2D boolean module matrix for a text payload.
     *
     * @return array<int, array<int, int>>
     */
    public static function createMatrix(string $text, int $ecLevel = self::EC_M): array
    {
        $rawBytes = array_values(unpack('C*', $text));
        $len = count($rawBytes);
        $version = self::chooseVersion($len, $ecLevel);
        $vInfo = self::getVersionTable($version, $ecLevel) ?? self::getVersionTable(10, $ecLevel);

        // 1. Bitstream construction (8-bit Byte Mode)
        $bits = [0, 1, 0, 0]; // Mode indicator: Byte mode (0100)

        // Character count indicator: 8 bits for versions 1-9, 16 bits for version 10
        $charCountBits = ($version < 10) ? 8 : 16;
        for ($i = $charCountBits - 1; $i >= 0; $i--) {
            $bits[] = ($len >> $i) & 1;
        }

        // Data payload bytes
        foreach ($rawBytes as $b) {
            for ($i = 7; $i >= 0; $i--) {
                $bits[] = ($b >> $i) & 1;
            }
        }

        // Terminator: up to 4 zero bits
        $maxBits = $vInfo['totalData'] * 8;
        $termLen = min(4, $maxBits - count($bits));
        for ($i = 0; $i < $termLen; $i++) {
            $bits[] = 0;
        }

        // Pad to byte boundary
        while (count($bits) % 8 !== 0 && count($bits) < $maxBits) {
            $bits[] = 0;
        }

        // Alternating pad bytes 0xEC, 0x11
        $padBytes = [0xEC, 0x11];
        $padIdx = 0;
        while (count($bits) < $maxBits) {
            $b = $padBytes[$padIdx % 2];
            for ($i = 7; $i >= 0; $i--) {
                $bits[] = ($b >> $i) & 1;
            }
            $padIdx++;
        }

        // Convert bits into data codewords
        $dataCodewords = [];
        for ($i = 0; $i < count($bits); $i += 8) {
            $val = 0;
            for ($j = 0; $j < 8; $j++) {
                $val = ($val << 1) | $bits[$i + $j];
            }
            $dataCodewords[] = $val;
        }

        // 2. Block division and Reed-Solomon calculation
        $blocks = [];
        $ecBlocks = [];
        $offset = 0;

        for ($b = 0; $b < $vInfo['g1Blocks']; $b++) {
            $d = array_slice($dataCodewords, $offset, $vInfo['g1Data']);
            $blocks[] = $d;
            $ecBlocks[] = self::rsEncode($d, $vInfo['ecPerBlock']);
            $offset += $vInfo['g1Data'];
        }

        for ($b = 0; $b < $vInfo['g2Blocks']; $b++) {
            $d = array_slice($dataCodewords, $offset, $vInfo['g2Data']);
            $blocks[] = $d;
            $ecBlocks[] = self::rsEncode($d, $vInfo['ecPerBlock']);
            $offset += $vInfo['g2Data'];
        }

        // 3. Interleaving data codewords
        $finalCodewords = [];
        $maxDataPerBlock = max($vInfo['g1Data'], $vInfo['g2Data']);
        for ($i = 0; $i < $maxDataPerBlock; $i++) {
            foreach ($blocks as $blk) {
                if ($i < count($blk)) {
                    $finalCodewords[] = $blk[$i];
                }
            }
        }

        // Interleaving EC codewords
        for ($i = 0; $i < $vInfo['ecPerBlock']; $i++) {
            foreach ($ecBlocks as $ecBlk) {
                $finalCodewords[] = $ecBlk[$i];
            }
        }

        // Convert to stream of bits
        $finalBits = [];
        foreach ($finalCodewords as $cw) {
            for ($i = 7; $i >= 0; $i--) {
                $finalBits[] = ($cw >> $i) & 1;
            }
        }

        // 4. Matrix initialisation
        $size = $vInfo['size'];
        $matrix = array_fill(0, $size, array_fill(0, $size, null));
        $isReserved = array_fill(0, $size, array_fill(0, $size, false));

        // Place 3 Finder patterns
        $finders = [[0, 0], [0, $size - 7], [$size - 7, 0]];
        foreach ($finders as [$r0, $c0]) {
            for ($r = 0; $r < 7; $r++) {
                for ($c = 0; $c < 7; $c++) {
                    $val = ($r === 0 || $r === 6 || $c === 0 || $c === 6 || ($r >= 2 && $r <= 4 && $c >= 2 && $c <= 4)) ? 1 : 0;
                    $matrix[$r0 + $r][$c0 + $c] = $val;
                    $isReserved[$r0 + $r][$c0 + $c] = true;
                }
            }
            // Separator around finder
            for ($r = -1; $r <= 7; $r++) {
                for ($c = -1; $c <= 7; $c++) {
                    $rr = $r0 + $r;
                    $cc = $c0 + $c;
                    if ($rr >= 0 && $rr < $size && $cc >= 0 && $cc < $size) {
                        if ($matrix[$rr][$cc] === null) {
                            $matrix[$rr][$cc] = 0;
                            $isReserved[$rr][$cc] = true;
                        }
                    }
                }
            }
        }

        // Timing patterns
        for ($i = 8; $i < $size - 8; $i++) {
            $val = ($i % 2 === 0) ? 1 : 0;
            if (! $isReserved[6][$i]) {
                $matrix[6][$i] = $val;
                $isReserved[6][$i] = true;
            }
            if (! $isReserved[$i][6]) {
                $matrix[$i][6] = $val;
                $isReserved[$i][6] = true;
            }
        }

        // Alignment patterns
        $coords = $vInfo['align'];
        $alignCenters = [];
        foreach ($coords as $r) {
            foreach ($coords as $c) {
                // Skip if intersects finder patterns
                if (($r <= 8 && $c <= 8) || ($r <= 8 && $c >= $size - 9) || ($r >= $size - 9 && $c <= 8)) {
                    continue;
                }
                $alignCenters[] = [$r, $c];
            }
        }
        foreach ($alignCenters as [$cr, $cc]) {
            for ($r = -2; $r <= 2; $r++) {
                for ($c = -2; $c <= 2; $c++) {
                    $val = (abs($r) === 2 || abs($c) === 2 || ($r === 0 && $c === 0)) ? 1 : 0;
                    $matrix[$cr + $r][$cc + $c] = $val;
                    $isReserved[$cr + $r][$cc + $c] = true;
                }
            }
        }

        // Dark module
        $matrix[$size - 8][8] = 1;
        $isReserved[$size - 8][8] = true;

        // Reserve format info areas
        for ($i = 0; $i <= 8; $i++) {
            $isReserved[8][$i] = true;
            $isReserved[$i][8] = true;
        }
        for ($i = $size - 8; $i < $size; $i++) {
            $isReserved[8][$i] = true;
            $isReserved[$i][8] = true;
        }

        // Reserve version information area for versions 7+
        if ($version >= 7) {
            for ($r = 0; $r < 6; $r++) {
                for ($c = 0; $c < 3; $c++) {
                    $isReserved[$r][$size - 11 + $c] = true;
                    $isReserved[$size - 11 + $c][$r] = true;
                }
            }
        }

        // 5. Data placement (zigzag)
        $bitIdx = 0;
        $totalBits = count($finalBits);
        $col = $size - 1;
        $dir = -1; // -1 = up, 1 = down

        while ($col > 0) {
            if ($col === 6) { // skip vertical timing pattern
                $col--;
            }
            $rowRange = ($dir === -1) ? range($size - 1, 0, -1) : range(0, $size - 1, 1);
            foreach ($rowRange as $row) {
                for ($c = 0; $c < 2; $c++) {
                    $currCol = $col - $c;
                    if (! $isReserved[$row][$currCol]) {
                        $val = ($bitIdx < $totalBits) ? $finalBits[$bitIdx] : 0;
                        $matrix[$row][$currCol] = $val;
                        $bitIdx++;
                    }
                }
            }
            $dir = -$dir;
            $col -= 2;
        }

        // 6. Mask pattern selection
        $bestMask = 0;
        $minPenalty = PHP_INT_MAX;
        $bestMatrix = null;

        for ($mask = 0; $mask < 8; $mask++) {
            $testMatrix = $matrix;
            for ($r = 0; $r < $size; $r++) {
                for ($c = 0; $c < $size; $c++) {
                    if (! $isReserved[$r][$c]) {
                        $invert = self::isMaskInverted($mask, $r, $c);
                        if ($invert) {
                            $testMatrix[$r][$c] ^= 1;
                        }
                    }
                }
            }

            self::embedFormatInfo($testMatrix, $ecLevel, $mask);

            if ($version >= 7) {
                self::embedVersionInfo($testMatrix, $version);
            }

            $penalty = self::calculatePenalty($testMatrix);
            if ($penalty < $minPenalty) {
                $minPenalty = $penalty;
                $bestMask = $mask;
                $bestMatrix = $testMatrix;
            }
        }

        return $bestMatrix ?? $matrix;
    }

    private static function isMaskInverted(int $mask, int $r, int $c): bool
    {
        return match ($mask) {
            0 => (($r + $c) % 2) === 0,
            1 => ($r % 2) === 0,
            2 => ($c % 3) === 0,
            3 => (($r + $c) % 3) === 0,
            4 => (((int) ($r / 2) + (int) ($c / 3)) % 2) === 0,
            5 => (($r * $c) % 2) + (($r * $c) % 3) === 0,
            6 => (((($r * $c) % 2) + (($r * $c) % 3)) % 2) === 0,
            7 => (((($r + $c) % 2) + (($r * $c) % 3)) % 2) === 0,
            default => false,
        };
    }

    private static function embedFormatInfo(array &$matrix, int $ecLevel, int $mask): void
    {
        $size = count($matrix);
        $ecBits = match ($ecLevel) {
            self::EC_L => 1,
            self::EC_M => 0,
            self::EC_Q => 3,
            self::EC_H => 2,
            default => 0,
        };
        $data = ($ecBits << 3) | $mask;

        // BCH code (15, 5) generator polynomial: 0x537
        $g = 0x537;
        $d = $data << 10;
        for ($i = 14; $i >= 10; $i--) {
            if (($d >> $i) & 1) {
                $d ^= ($g << ($i - 10));
            }
        }
        $formatBits = (($data << 10) | $d) ^ 0x5412;

        $coords1 = [
            [8, 0], [8, 1], [8, 2], [8, 3], [8, 4], [8, 5], [8, 7], [8, 8],
            [7, 8], [5, 8], [4, 8], [3, 8], [2, 8], [1, 8], [0, 8],
        ];

        $coords2 = [
            [$size - 1, 8], [$size - 2, 8], [$size - 3, 8], [$size - 4, 8], [$size - 5, 8], [$size - 6, 8], [$size - 7, 8],
            [8, $size - 8], [8, $size - 7], [8, $size - 6], [8, $size - 5], [8, $size - 4], [8, $size - 3], [8, $size - 2], [8, $size - 1],
        ];

        for ($i = 0; $i < 15; $i++) {
            $bit = ($formatBits >> (14 - $i)) & 1;
            [$r1, $c1] = $coords1[$i];
            $matrix[$r1][$c1] = $bit;
            [$r2, $c2] = $coords2[$i];
            $matrix[$r2][$c2] = $bit;
        }
    }

    private static function embedVersionInfo(array &$matrix, int $version): void
    {
        $size = count($matrix);
        $d = $version << 12;
        $g = 0x1F25;
        for ($i = 17; $i >= 12; $i--) {
            if (($d >> $i) & 1) {
                $d ^= ($g << ($i - 12));
            }
        }
        $versionBits = ($version << 12) | $d;

        for ($i = 0; $i < 18; $i++) {
            $bit = ($versionBits >> $i) & 1;
            $r = (int) ($i / 3);
            $c = $i % 3;
            $matrix[$size - 11 + $r][$c] = $bit;
            $matrix[$c][$size - 11 + $r] = $bit;
        }
    }

    private static function calculatePenalty(array $matrix): int
    {
        $size = count($matrix);
        $penalty = 0;

        // Rule 1: 5+ consecutive same color modules
        for ($r = 0; $r < $size; $r++) {
            $count = 1;
            for ($c = 1; $c < $size; $c++) {
                if ($matrix[$r][$c] === $matrix[$r][$c - 1]) {
                    $count++;
                } else {
                    if ($count >= 5) {
                        $penalty += (3 + ($count - 5));
                    }
                    $count = 1;
                }
            }
            if ($count >= 5) {
                $penalty += (3 + ($count - 5));
            }
        }
        for ($c = 0; $c < $size; $c++) {
            $count = 1;
            for ($r = 1; $r < $size; $r++) {
                if ($matrix[$r][$c] === $matrix[$r - 1][$c]) {
                    $count++;
                } else {
                    if ($count >= 5) {
                        $penalty += (3 + ($count - 5));
                    }
                    $count = 1;
                }
            }
            if ($count >= 5) {
                $penalty += (3 + ($count - 5));
            }
        }

        // Rule 2: 2x2 blocks of same color
        for ($r = 0; $r < $size - 1; $r++) {
            for ($c = 0; $c < $size - 1; $c++) {
                $val = $matrix[$r][$c];
                if ($val === $matrix[$r + 1][$c] && $val === $matrix[$r][$c + 1] && $val === $matrix[$r + 1][$c + 1]) {
                    $penalty += 3;
                }
            }
        }

        // Rule 3: 1:1:3:1:1 pattern
        for ($r = 0; $r < $size; $r++) {
            for ($c = 0; $c <= $size - 11; $c++) {
                $slice = array_slice($matrix[$r], $c, 11);
                if (($slice[0] === 0 && $slice[1] === 0 && $slice[2] === 0 && $slice[3] === 0 &&
                     $slice[4] === 1 && $slice[5] === 0 && $slice[6] === 1 && $slice[7] === 1 && $slice[8] === 1 && $slice[9] === 0 && $slice[10] === 1) ||
                    ($slice[0] === 1 && $slice[1] === 0 && $slice[2] === 1 && $slice[3] === 1 && $slice[4] === 1 && $slice[5] === 0 && $slice[6] === 1 &&
                     $slice[7] === 0 && $slice[8] === 0 && $slice[9] === 0 && $slice[10] === 0)) {
                    $penalty += 40;
                }
            }
        }

        // Rule 4: Balance of dark vs light modules
        $darkCount = 0;
        for ($r = 0; $r < $size; $r++) {
            for ($c = 0; $c < $size; $c++) {
                if ($matrix[$r][$c] === 1) {
                    $darkCount++;
                }
            }
        }
        $total = $size * $size;
        $pct = ($darkCount * 100) / $total;
        $prevMult5 = (int) ($pct / 5) * 5;
        $nextMult5 = $prevMult5 + 5;
        $k = (int) (min(abs($prevMult5 - 50), abs($nextMult5 - 50)) / 5);
        $penalty += $k * 10;

        return $penalty;
    }

    /**
     * Generate an optimized, crisp SVG string for the QR Code.
     *
     * @param  string  $text  The content to encode (URL, text, policy number)
     * @param  int  $size  Width/height in pixels
     * @param  string  $color  Dark module hex color (e.g. #09132e or #000000)
     * @param  int  $margin  Quiet zone margin in module units
     */
    public static function svg(string $text, int $size = 64, string $color = '#09132e', int $margin = 2): string
    {
        $matrix = self::createMatrix($text, self::EC_M);
        $modCount = count($matrix);
        $totalCells = $modCount + ($margin * 2);

        $pathD = '';
        for ($r = 0; $r < $modCount; $r++) {
            for ($c = 0; $c < $modCount; $c++) {
                if ($matrix[$r][$c] === 1) {
                    $x = $c + $margin;
                    $y = $r + $margin;
                    $pathD .= "M{$x},{$y}h1v1h-1z ";
                }
            }
        }

        return sprintf(
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %d %d" width="%d" height="%d" shape-rendering="crispEdges" style="display:block;max-width:100%%;height:auto;">'.
            '<rect width="100%%" height="100%%" fill="#ffffff"/>'.
            '<path d="%s" fill="%s"/>'.
            '</svg>',
            $totalCells,
            $totalCells,
            $size,
            $size,
            trim($pathD),
            htmlspecialchars($color, ENT_QUOTES)
        );
    }

    /**
     * Generate an inline data URI (data:image/svg+xml;base64,...).
     */
    public static function dataUri(string $text, int $size = 64, string $color = '#09132e'): string
    {
        $svg = self::svg($text, $size, $color);

        return 'data:image/svg+xml;base64,'.base64_encode($svg);
    }
}
