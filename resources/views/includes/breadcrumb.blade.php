<div class="breadcrumb__container">
	<ol class="breadcrumb page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
				<a href="/">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		@for($i = 1; $i <= count(Request::segments()); $i++)
				@if($i < count(Request::segments()) & $i > 0)
					<li>
						<a href="">{{ ucfirst(Request::segment($i)) }}</a>
						{!!'<i class="fa fa-angle-right"></i>'!!}
					</li>
				@else
					<li class="active">Etude n°2 op n°34</li>
				@endif
		@endfor
	</ol>
</div>