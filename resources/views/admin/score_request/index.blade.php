@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	@if(!empty($scores_requests) && count($scores_requests) > 0 )
		<?php \Carbon\Carbon::setLocale(config('app.locale')); ?>
		<table class="table ">
			<thead>
				<tr>
					<th>#</th>
					<th>Titre</th>
					<th>Auteur</th>
					<th>Demandeur</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($scores_requests as $score_request)
					<tr>
						<td>{{ $score_request->id }}</td>
						<td>{{ $score_request }}</td>
						<td>{{ $score_request->author }}</td>
						<td>{{ strtoupper($score_request->contact_lastname) . ' ' . ucfirst($score_request->contact_firstname) }}</td>
						<td>{{ $score_request->created_at->diffForHumans() }}</td>
						<td>
							<a href="{{ route('admin_scoresrequests_edit',['id_scorerequest'=>$score_request->id]) }}" class="btn btn-primary">
								<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
								Editer
							</a>
							<a href="{{ route('admin_scoresrequests_remove',['id_scorerequest'=>$score_request->id]) }}" class="btn btn-danger" data-toggle="confirmation" data-title="Confirmation" data-btn-ok-label="Supprimer" data-btn-ok-class="btn-success" data-btn-cancel-label="Annuler"data-btn-cancel-class="btn-danger" data-content="Êtes-vous sûr de vouloir supprimer cette demande de partition" data-placement="right" data-singleton="true" data-popout="true">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								Supprimer
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h2>Aucune demande de partition pour le moment.</h2>
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