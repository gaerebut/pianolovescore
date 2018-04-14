<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($authors as $author)
        <url>
            <loc>{{ route(__('routes.author_scores'), ['slug_author' => $author->slug]) }}</loc>
            <lastmod>{{ $author->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>