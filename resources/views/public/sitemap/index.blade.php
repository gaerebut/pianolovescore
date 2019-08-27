<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ route(__('routes.sitemap_category')) }}</loc>
        <lastmod>{{ $score->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route(__('routes.sitemap_authors')) }}</loc>
        <lastmod>{{ $author->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
         <loc>{{ route(__('routes.sitemap_scores')) }}</loc>
        <lastmod>{{ $score->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
         <loc>{{ route(__('routes.sitemap_glossaries')) }}</loc>
        <lastmod>{{ $glossary->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
         <loc>{{ route(__('routes.sitemap_tricks')) }}</loc>
        <lastmod>{{ $trick->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
         <loc>{{ route(__('routes.sitemap_difficulties')) }}</loc>
        <lastmod>{{ $score->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
</sitemapindex>