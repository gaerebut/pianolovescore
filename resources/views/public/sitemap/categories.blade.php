<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>2017-11-17T21:21:21+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route(__('routes.score_request')) }}</loc>
        <lastmod>2017-11-17T21:21:21+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route(__('routes.scores')) }}</loc>
        <lastmod>2017-11-17T21:21:21+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route(__('routes.contact')) }}</loc>
        <lastmod>2018-10-10T21:20:36+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route(__('routes.legals')) }}</loc>
        <lastmod>2018-10-10T21:21:21+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
</urlset>