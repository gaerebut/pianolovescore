@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('css')
    @parent
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
@endsection
@section('main')
	<div class="col-md-8 col-md-offset-2">
		<form action="{{ route('admin_scores_edit_store') }}" method="post" class="form-horizontal">
			<div class="row text-right">
				<label for="is_online" class="form-label">MISE EN LIGNE DE LA PARTITION</label>
				<input type="checkbox" id="is_online" name="is_online" value="1" @if($score->is_online) checked="checked" @endif />
			</div>
			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">Titre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="title" placeholder="Titre" value="{{ $score }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
					<textarea id="description" name="description">{{ $score->description }}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="difficulty" class="col-sm-2 control-label">Difficulté</label>
				<div class="col-sm-10">
					<select name="difficulty" id="difficulty" class="form-control label label-@if($score->difficulty == 1)info @elseif($score->difficulty==2)primary @elseif($score->difficulty==3)success @elseif($score->difficulty==4)warning @elseif($score->difficulty==5)danger @endif">
						<option value="1" class="label-info" @if($score->difficulty == 1) selected @endif>Très facile</option>
						<option value="2" class="label-primary" @if($score->difficulty == 2) selected @endif>Facile</option>
						<option value="3" class="label-success" @if($score->difficulty == 3) selected @endif>Intermédiaire</option>
						<option value="4" class="label-warning" @if($score->difficulty == 4) selected @endif>Difficile</option>
						<option value="5" class="label-danger" @if($score->difficulty == 5) selected @endif>Très difficile</option>
					</select>
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
					<input type="text" class="form-control" id="slug" name="slug" placeholder="Exemple: Titre ou Titre Nom Auteur"  value="{{ $score->slug }}" disabled required>
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
					<img src="{{ URL::to('/') }}/img/scores/{{ $score->score_image }}" height="500"/>
					<input type="text" class="form-control" id="score_image" name="score_image" placeholder="http://www.adressedusiteweb.com/miniature.png" value="{{ $score->score_image }}">
				</div>
			</div>
			<div class="form-group">
				<label for="nb_pages" class="col-sm-2 control-label">Nombre de pages</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nb_pages" name="nb_pages" placeholder="3" value="{{ $score->nb_pages }}" required>
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

			<a href="{{ route('admin_scores') }}" class="btn btn-warning pull-left">
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
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
	<script src="{{ elixir( '/js/sanitize.js' ) }}"></script>

	<script type="text/javascript">
	    $(function(){
	    	$('#description').summernote({
				placeholder: 'La description de la partition doit être la plus longue possible. Attention : ne surtout pas faire de copier/coller de n\'importe quel texte !',
				height: 200
			});

	        $( '#title' ).unbind().keyup( function()
	        {
	            var slug = sanitize( $( this ).val() );
	            var keywords = sanitize( $( this ).val(), ', ' );

	            $( '#slug' ).val( slug );
	            $( '#keywords' ).val( keywords );
	        } );

	        $('#difficulty').on('change', function()
	        {
	        	$(this).attr('class', 'form-control label ' + $(this).children(":selected").attr('class'));
	        });

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