<div class="breadcrumb__container">
	<ol class="breadcrumb page-breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
		@php
		    $link = url('/');
		@endphp
		@for($i = 1; $i <= count(Request::segments()); $i++)
		    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		        @if($i < count(Request::segments()) & $i > 0)
		        	<?php $link .= "/" . Request::segment($i); ?>
		        	<a href="<?php echo $link; ?>" itemscope itemtype="http://schema.org/Thing" itemprop="item">
		        		<span itemprop="name">{{ ucfirst(Request::segment($i))}}</span>
		        	</a>
		        @else
		        	<span itemscope itemtype="http://schema.org/Thing" itemprop="item">
		        		<span itemprop="name">{{ $breadcrumb_last_level }}</span>
		        	</span>
		        @endif
		        <meta itemprop="position" content="{{ $i+1 }}" />
		    </li>
		@endfor
	</ol>
</div>