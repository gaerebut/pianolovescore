<div class="breadcrumb__container">
	<ol class="breadcrumb page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="/">Home</a>
		</li>
		@php
		    $link = url('/');
		@endphp
		@for($i = 1; $i <= count(Request::segments()); $i++)
		    <li class="breadcrumb-item">
		        @if($i < count(Request::segments()) & $i > 0)
		        	<?php $link .= "/" . Request::segment($i); ?>
		        	<a href="<?php echo $link; ?>">{{Request::segment($i)}}</a>
		        @else
		        	Etude n°2 op n°34
		        @endif
		    </li>
		@endfor
	</ol>
</div>