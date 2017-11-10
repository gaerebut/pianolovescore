@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	<div class="col-md-8 col-md-offset-2">
		<form action="{{ route('admin_scores_edit_store') }}" method="post" class="form-horizontal">
			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">Titre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="title" placeholder="Titre" value="{{ $score }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="firstname" class="col-sm-2 control-label">Auteur</label>
				<div class="col-sm-10">
					<select name="author_id" class="form-control">
						@foreach($authors as $author)
							<option value="{{ $author->id }}" @if($score->author->id == $author->id) selected @endif>{{ $author->lastname . ' ' . $author->firstname }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="slug" class="col-sm-2 control-label">Identifiant URL</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="slug" name="slug" placeholder="Exempe: Titre ou Titre Nom Auteur"  value="{{ $score->slug }}" disabled required>
				</div>
				<div class="col-sm-2">
					<a class="btn btn-warning pull-right" id="edit-slug">
	                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
	                    Editer
	                </a>
               	</div>
			</div>
			<div class="form-group">
				<label for="keywords" class="col-sm-2 control-label">Mots clés (séparer par des virgules)</label>
				<div class="col-sm-10">
					@php
							$count_keywords = count($score->keywords);
							$keywords = '';
					@endphp

						@foreach($score->keywords as $keyword)
							@php $keywords .= $keyword; @endphp
							@if($loop->iteration < $count_keywords)
								@php
									$keywords .= ', ';
								@endphp
							@endif
						@endforeach
					<textarea class="form-control" id="keywords" name="keywords">{{ $keywords}}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="score_image" class="col-sm-2 control-label">URL miniature</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="score_image" name="score_image" placeholder="http://www.adressedusiteweb.com/miniature.png" value="{{ $score->score_image }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="score_url" class="col-sm-2 control-label">URL du fichier PDF</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="score_url" name="score_url" placeholder="http://www.adressedusiteweb.com/partition.pdf" value="{{ $score->score_url }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="score_sound_url" class="col-sm-2 control-label">URL du fichier audio (facultatif)</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="score_sound_url" name="score_sound_url" placeholder="http://www.adressedusiteweb.com/enregistrement.mp3" value="{{ $score->score_sound_url }}">
				</div>
			</div>

			<a href="{{ route('admin_scores_add') }}" class="btn btn-warning pull-left">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
				Annuler
			</a>
			<button type="submit" class="btn btn-success pull-right">
				<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
				Modifier
			</button>
			<input type="hidden" name="id" value="{{ $score->id }}" />
			{{ csrf_field() }}
		</form>
	</div>
@endsection
@section('js_code')
	@parent
	<script src="{{ elixir( '/js/sanitize.js' ) }}"></script>

	<script type="text/javascript">
	    $(function(){	
	        $( '#title' ).unbind().keyup( function()
	        {
	            var slug = sanitize( $( this ).val() );
	            var keywords = sanitize( $( this ).val(), ', ' );

	            $( '#slug' ).val( slug );
	            $( '#keywords' ).val( keywords );
	        } );

	        $( '#edit-slug' ).unbind().click( function()
	        {
	            $( '#slug' ).prop( 'disabled', function( id, val ){ return !val; } );
	        } );

	        $( 'form' ).submit( function()
	        {
	            $( '#slug' ).removeAttr( 'disabled' );
	        } );

	    });
	</script>
@endsection