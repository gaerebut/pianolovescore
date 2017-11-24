<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ route('sitemap_categories') }}</loc>
        <lastmod>{{ $score->updated_at }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap_authors') }}</loc>
        <lastmod>{{ $author->updated_at }}</lastmod>
    </sitemap>
    <sitemap>
         <loc>{{ route('sitemap_scores') }}</loc>
        <lastmod>{{ $score->updated_at }}</lastmod>
    </sitemap>
</sitemapindex>