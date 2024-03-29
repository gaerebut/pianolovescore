@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	<a href="{{ route('admin_authors_add') }}" class="btn btn-success pull-right">
		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		Ajouter un auteur
	</a>
	@if(!empty($authors) && count($authors) > 0 )
		<table class="table ">
			<thead>
				<tr>
					<th>#</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Nombre de partitions</th>
					<th>Descriptions FR / EN</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($authors as $author)
					<tr @if(strlen($author->description_fr) == 0 || strlen($author->description_en) == 0) style="background-color: rgba(255,0,0,0.4)" @endif>
						<td>{{ $author->id }}</td>
						<td>{{ $author->lastname }}</td>
						<td>{{ $author->firstname }}</td>
						<td>{{ count($author->scores) }}</td>
						<td>{{ strlen(strip_tags(preg_replace("/\s/", "",$author->description_fr))) }} / {{ strlen(strip_tags(preg_replace("/\s/", "",$author->description_en))) }}</td>
						<td>
							<a href="{{ route('admin_authors_edit',['id_author'=>$author->id]) }}" class="btn btn-primary">
								<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
								Editer
							</a>
							<a href="{{ route('admin_authors_remove',['id_author'=>$author->id]) }}" class="btn btn-danger" data-toggle="confirmation" data-title="Confirmation" data-btn-ok-label="Supprimer" data-btn-ok-class="btn-success" data-btn-cancel-label="Annuler"data-btn-cancel-class="btn-danger" data-content="Êtes-vous sûr de vouloir supprimer cet auteur ?" data-placement="right" data-singleton="true" data-popout="true">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								Supprimer
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h2>Aucun auteur de référencé pour le moment.</h2>
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