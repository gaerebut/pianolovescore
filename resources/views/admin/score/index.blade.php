@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	<a href="{{ route('admin_scores_add') }}" class="btn btn-success pull-right">
		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		Ajouter une partition
	</a>
	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Nom</th>
				<th>Auteur<br />
					<select id="id_author">
						<option value="0" @if($id_author==0) selected @endif>Tous</option>
						@foreach($authors as $author)
							<option value="{{ $author->id }}" @if($id_author==$author->id) selected @endif>{{ $author }}</option>
						@endforeach
					</select>
				</th>
				<th>Votes</th>
				<th>Moyenne</th>
				<th>Téléchargements</th>
				<th>Longueur description</th>
				<th>Mots clés</th>
				<th>Difficulté<br />
					<select id="difficulty">
						<option value="0" @if($difficulty==0) selected @endif>Toutes</option>
						<option value="1" @if($difficulty==1) selected @endif>Très facile</option>
						<option value="2" @if($difficulty==2) selected @endif>Facile</option>
						<option value="3" @if($difficulty==3) selected @endif>Intermédiaire</option>
						<option value="4" @if($difficulty==4) selected @endif>Difficile</option>
						<option value="5" @if($difficulty==5) selected @endif>Très difficile</option>
					</select>
				</th>
				<th>En ligne<br />
					<select id="is_online">
						<option value="n" @if($is_online=="n") selected @endif>Tous</option>
						<option value="1" @if($is_online==1) selected @endif>En ligne</option>
						<option value="2" @if($is_online==2) selected @endif>Hors ligne</option>
					</select>
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@if(!empty($scores) && count($scores) > 0 )
				@foreach($scores as $score)
					<tr @if(strlen($score->description) == 0) style="background-color: rgba(255,0,0,0.5)" @endif>
						<td>{{ $score->id }}</td>
						<td>{{ $score }}</td>
						<td>{{ $score->author }}</td>
						<td>{{ $score->count_votes }}</td>
						<td>{{ $score->avg_votes }}</td>
						<td>{{ $score->downloaded }}</td>
						<td @if(strlen($score->description) == 0) style="font-weight:bold; color:red" @endif>{{ strlen($score->description) }}</td>
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
							<a href="{{ route('admin_scores_remove',['id_score'=>$score->id]) }}" class="btn btn-danger" data-toggle="confirmation" data-title="Confirmation" data-btn-ok-label="Supprimer" data-btn-ok-class="btn-success" data-btn-cancel-label="Annuler"data-btn-cancel-class="btn-danger" data-content="Êtes-vous sûr de vouloir supprimer cette partition ?" data-placement="right" data-singleton="true" data-popout="true">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								Supprimer
							</a>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="10"><h2>Aucune partition n'est référencée pour le moment.</h2></td>
				</tr>
			@endif
		</tbody>
	</table>
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

			$('.table select').on('change', function(){
				var route = "{{ route('admin_scores_filtered',['id_author'=>':id_author', 'difficulty'=>':difficulty','is_online'=>':is_online']) }}";

				route = route.replace(':id_author', $('select#id_author').val());
				route = route.replace(':difficulty', $('select#difficulty').val());
				route = route.replace(':is_online', $('select#is_online').val());
				window.location.href = route;
			})
		});
	</script>
@endsection