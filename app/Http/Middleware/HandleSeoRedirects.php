<?php

namespace App\Http\Middleware;

use App\Models\SeoRedirect;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class HandleSeoRedirects
{
    /**
     * Handle an incoming request and check for active SEO redirects.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethodSafe()) {
            return $next($request);
        }

        try {
            if (! Schema::hasTable('seo_redirects')) {
                return $next($request);
            }

            $path = '/'.ltrim($request->path(), '/');

            // Exclude static assets, api, or admin paths
            if (str_starts_with($path, '/admin') || str_starts_with($path, '/api') || str_starts_with($path, '/build')) {
                return $next($request);
            }

            $redirect = SeoRedirect::where('source_path', $path)
                ->where('is_active', true)
                ->first();

            if ($redirect) {
                // Increment hit count asynchronously or safely
                $redirect->increment('hit_count');
                $redirect->update(['last_hit_at' => now()]);

                $target = $redirect->destination_url;
                $queryString = $request->getQueryString();
                if ($queryString && ! str_contains($target, '?')) {
                    $target .= '?'.$queryString;
                }

                $statusCode = in_array($redirect->status_code, [301, 302, 307, 308]) ? $redirect->status_code : 301;

                return redirect($target, $statusCode);
            }
        } catch (\Throwable) {
            // Silently proceed if database is unavailable
        }

        return $next($request);
    }
}
