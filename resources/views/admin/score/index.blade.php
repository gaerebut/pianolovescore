@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	<a href="{{ route('admin_scores_add') }}" class="btn btn-success pull-right">
		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		Ajouter une partition
	</a>
	@if(!empty($scores) && count($scores) > 0 )
		<table class="table ">
			<thead>
				<tr>
					<th>#</th>
					<th>Nom</th>
					<th>Auteur</th>
					<th>Votes</th>
					<th>Moyenne</th>
					<th>Téléchargements</th>
					<th>Mots clés</th>
					<th>Difficulté</th>
					<th>En ligne</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($scores as $score)
					<tr>
						<td>{{ $score->id }}</td>
						<td>{{ $score }}</td>
						<td>{{ $score->author }}</td>
						<td>{{ $score->count_votes }}</td>
						<td>{{ $score->avg_votes }}</td>
						<td>{{ $score->downloaded }}</td>
						<td>
							@foreach($score->keywords as $keyword)
								{{ $keyword . ' ' }}
							@endforeach
						</td>
						<td>
							@if($score->difficulty==1)
								<span class="label label-info">Très facile</span>
							@elseif($score->difficulty==2)
								<span class="label label-primary">Facile</span>
							@elseif($score->difficulty==3)
								<span class="label label-success">Intermédiaire</span>
							@elseif($score->difficulty==4)
								<span class="label label-warning">Difficile</span>
							@elseif($score->difficulty==5)
								<span class="label label-danger">Très difficile</span>
							@endif
						</td>
						<td>@if($score->is_online) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> @else <span class="glyphicon glyphicon-remove"></span> @endif</td>
						<td>
							<a href="{{ route('admin_scores_edit',['id_score'=>$score->id]) }}" class="btn btn-primary">
								<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
								Editer
							</a>
							<a href="{{ route('admin_scores_remove',['id_score'=>$score->id]) }}" class="btn btn-danger" data-toggle="confirmation" data-title="Confirmation" data-btn-ok-label="Supprimer" data-btn-ok-class="btn-success" data-btn-cancel-label="Annuler"data-btn-cancel-class="btn-danger" data-content="Êtes-vous sûr de vouloir supprimer cet utilisateur ?" data-placement="right" data-singleton="true" data-popout="true">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								Supprimer
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h2>Aucune partition n'est référencée pour le moment.</h2>
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