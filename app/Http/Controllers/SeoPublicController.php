<?php

namespace App\Http\Controllers;

use App\Services\SitemapRobotsService;
use Illuminate\Http\Response;

class SeoPublicController extends Controller
{
    /**
     * Render dynamic XML sitemap.
     */
    public function sitemap(SitemapRobotsService $service): Response
    {
        $xml = $service->generateSitemapXml();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'X-Robots-Tag' => 'noindex', // standard practice for sitemap file itself
        ]);
    }

    /**
     * Render dynamic robots.txt file.
     */
    public function robots(SitemapRobotsService $service): Response
    {
        $content = $service->getRobotsTxtContent();

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }

    /**
     * Render machine-readable LLM context manifest (llms.txt standard).
     */
    public function llms(): Response
    {
        $filePath = public_path('llms.txt');
        $content = file_exists($filePath) ? (string) file_get_contents($filePath) : '';

        return response($content, 200, [
            'Content-Type' => 'text/markdown; charset=UTF-8',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    /**
     * Render full machine-readable LLM knowledge base (llms-full.txt standard).
     */
    public function llmsFull(): Response
    {
        $filePath = public_path('llms-full.txt');
        $content = file_exists($filePath) ? (string) file_get_contents($filePath) : '';

        return response($content, 200, [
            'Content-Type' => 'text/markdown; charset=UTF-8',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
