<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($scores as $score)
        <url>
            <loc>{{ route('score', ['slug_author' => $score->author->slug, 'slug_score' => $score->slug]) }}</loc>
            <lastmod>{{ $score->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>