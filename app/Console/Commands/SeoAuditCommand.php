<?php

namespace App\Console\Commands;

use App\Services\SeoAuditService;
use Illuminate\Console\Command;

class SeoAuditCommand extends Command
{
    protected $signature = 'seo:audit {--limit=100 : Maximum number of pages to audit}';

    protected $description = 'Execute a technical SEO audit across all eligible website routes';

    public function handle(SeoAuditService $auditService): int
    {
        $this->info('Starting automated technical SEO audit...');
        $limit = (int) $this->option('limit');

        $audit = $auditService->runFullAudit();

        $this->newLine();
        $this->info("Audit #{$audit->id} completed successfully.");
        $this->table(
            ['Metric', 'Value'],
            [
                ['Health Score', "{$audit->health_score} / 100"],
                ['Pages Scanned', $audit->pages_scanned],
                ['Critical Issues', $audit->critical_count],
                ['High Severity', $audit->high_count],
                ['Medium Severity', $audit->medium_count],
                ['Low Severity', $audit->low_count],
                ['Execution Duration', "{$audit->duration_seconds} seconds"],
            ]
        );

        if ($audit->critical_count > 0) {
            $this->warn("Attention: {$audit->critical_count} critical SEO issues were discovered.");
        }

        return self::SUCCESS;
    }
}
