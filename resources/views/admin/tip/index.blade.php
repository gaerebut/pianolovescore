@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')

@endsection
@section('js_code')
	@parent
	<script src="{{ elixir( '/js/bootstrap-confirmation.min.js' ) }}"></script>
	<script type="text/javascript">
		$(function()
		{
			$('[data-toggle=confirmation]').confirmation({
				rootSelector: '[data-toggle=confirmation]'
			});
		});
	</script>
@endsection