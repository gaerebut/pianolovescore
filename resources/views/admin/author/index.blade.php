@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	
	@if(!empty($authors) && count($authors) > 0 )
		<table class="table ">
			<thead>
				<tr>
					<th>#</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Nombre de partitions</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($authors as $author)
					<tr>
						<td>{{ $author->id }}</td>
						<td>{{ $author->lastname }}</td>
						<td>{{ $author->firstname }}</td>
						<td>{{ count($author->scores) }}</td>
						<td>
							<a href="#" class="btn btn-primary">Editer</a>
							<a href="#" class="btn btn-danger">Supprimer</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h2>Aucun auteur de référencé pour le moment.</h2>
	@endif
@endsection