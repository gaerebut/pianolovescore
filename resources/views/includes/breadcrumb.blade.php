<div class="breadcrumb__container">
	<ol class="breadcrumb page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="/">Accueil</a>
		</li>
		@php
		    $link = url('/');
		@endphp
		@for($i = 1; $i <= count(Request::segments()); $i++)
		    <li class="breadcrumb-item">
		        @if($i < count(Request::segments()) & $i > 0)
		        	<?php $link .= "/" . Request::segment($i); ?>
		        	<a href="<?php echo $link; ?>">{{ ucfirst(Request::segment($i))}}</a>
		        @else
		        	{{ $breadcrumb_last_level }}
		        @endif
		    </li>
		@endfor
	</ol>
</div>