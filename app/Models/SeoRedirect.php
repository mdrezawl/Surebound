<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeoRedirect extends Model
{
    use HasFactory;

    protected $table = 'seo_redirects';

    protected $fillable = [
        'source_path',
        'destination_url',
        'status_code',
        'is_active',
        'reason',
        'hit_count',
        'last_hit_at',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'status_code' => 'integer',
            'is_active' => 'boolean',
            'hit_count' => 'integer',
            'last_hit_at' => 'datetime',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Check if a redirect would form an immediate or circular loop.
     */
    public static function wouldFormLoop(string $source, string $destination, ?int $excludeId = null): bool
    {
        $normalizedSource = '/'.ltrim(parse_url($source, PHP_URL_PATH) ?: '/', '/');
        $destPath = parse_url($destination, PHP_URL_PATH);
        $normalizedDest = $destPath ? '/'.ltrim($destPath, '/') : $destination;

        if ($normalizedSource === $normalizedDest) {
            return true;
        }

        // Trace forward redirects up to 10 hops
        $visited = [$normalizedSource => true];
        $current = $normalizedDest;

        for ($i = 0; $i < 10; $i++) {
            $query = static::where('source_path', $current)->where('is_active', true);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
            $next = $query->first();

            if (! $next) {
                break;
            }

            $nextPath = parse_url($next->destination_url, PHP_URL_PATH);
            $current = $nextPath ? '/'.ltrim($nextPath, '/') : $next->destination_url;

            if (isset($visited[$current])) {
                return true;
            }
            $visited[$current] = true;
        }

        return false;
    }
}
