<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	@php $letters = []; @endphp
    @foreach($glossaries as $glossary)
    	@php
    		$letter = strtoupper($glossary->glossary[0]);
    		if(in_array($letter, $letters))
	    	{
	    		continue;
	    	}
	    	else
	    	{
	    		@endphp
		        <url>
		            <loc>{{ route('glossary', ['letter' => $letter]) }}</loc>
		            <lastmod>{{ $glossary->updated_at->tz('UTC')->toAtomString() }}</lastmod>
		            <changefreq>weekly</changefreq>
		            <priority>0.7</priority>
		        </url>
	    		@php
	    		$letters[] = $letter;
	    	}
	    @endphp
    @endforeach
</urlset>