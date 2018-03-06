@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	<a href="#add-glossary" class="btn btn-success pull-right">
		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		Ajouter un mot au lexique
	</a>
	<div class="btn-toolbar" role="toolbar" aria-label="Glossaries">
		@for($i=0;$i<=25;$i++)
			@if($letter==chr(65+$i))
				<button role="group" class="btn btn-primary">{{ chr(65+$i) }}</a></button>
			@else
				<button role="group" class="btn btn-default">
					<a href="{{ route('admin_glossaries', ['slug_glossary' => chr(65+$i)]) }}">{{ chr(65+$i) }}</a>
				</button>
			@endif
		@endfor
	</div>
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