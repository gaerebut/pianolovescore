@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	<a href="{{ route('admin_tricks_add') }}" class="btn btn-success pull-right">
		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		Ajouter une astuce
	</a>
	@if(!empty($tricks) && count($tricks) > 0 )
		<table class="table ">
			<thead>
				<tr>
					<th>#</th>
					<th>Titre</th>
					<th>Introduction</th>
					<th>En ligne</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($tricks as $trick)
					<tr>
						<td>{{ $trick->id }}</td>
						<td>{{ $trick }}</td>
						<td>{{ $trick->introduction }}</td>
						<td>@if($trick->is_online) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> @else <span class="glyphicon glyphicon-remove"></span> @endif</td>
						<td>
							<a href="{{ route('admin_tricks_edit',['id_trick'=>$trick->id]) }}" class="btn btn-primary">
								<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
								Editer
							</a>
							<a href="{{ route('admin_tricks_remove',['id_trick'=>$trick->id]) }}" class="btn btn-danger" data-toggle="confirmation" data-title="Confirmation" data-btn-ok-label="Supprimer" data-btn-ok-class="btn-success" data-btn-cancel-label="Annuler"data-btn-cancel-class="btn-danger" data-content="Êtes-vous sûr de vouloir supprimer cette astuce ?" data-placement="right" data-singleton="true" data-popout="true">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								Supprimer
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h2>Aucune astuce n'est référencée pour le moment.</h2>
	@endif
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