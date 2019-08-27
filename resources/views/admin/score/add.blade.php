@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('css')
    @parent
    <link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
@endsection
@section('main')
	<div class="col-md-8 col-md-offset-2">
		<form action="{{ route('admin_scores_add') }}" method="post" class="form-horizontal">
			<div class="form-group">
				<label for="is_online" class="col-sm-2 control-label">Partition active</label>
				<label for="is_online_1">OUI</label> <input type="radio" id="is_online_1" name="is_online" value="1">&nbsp;&nbsp;&nbsp;
				<label for="is_online_0">NON</label> <input type="radio" id="is_online_0" name="is_online" value="0" checked>
			</div>
			<div class="form-group">
				<label for="author_id" class="col-sm-2 control-label">Auteur</label>
				<div class="col-sm-10">
					<select name="author_id" id="author_id" class="form-control">
						@foreach($authors as $author)
							<option value="{{ $author->id }}">{{ $author->lastname . ' ' . $author->firstname }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">Titre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="title" placeholder="Titre" value="{{ old('title') }}" autocomplete="off" required>
					<ul class="scores_exists"></ul>
				</div>
			</div>
			<div class="form-group">
				<label for="description_fr" class="col-sm-2 control-label">Description FR</label>
				<div class="col-sm-10">
					<textarea name="description_fr" id="description_fr">{{ old('description_fr') }}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="description_en" class="col-sm-2 control-label">Description EN</label>
				<div class="col-sm-10">
					<textarea name="description_en" id="description_en">{{ old('description_en') }}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="difficulty" class="col-sm-2 control-label">Difficulté</label>
				<div class="col-sm-10">
					<select name="difficulty" id="difficulty" class="form-control label label-success">
						<option value="1" class="label-info">Très facile</option>
						<option value="2" class="label-primary">Facile</option>
						<option value="3" class="label-success" selected>Intermédiaire</option>
						<option value="4" class="label-warning">Difficile</option>
						<option value="5" class="label-danger">Très difficile</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="slug" class="col-sm-2 control-label">Identifiant URL</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="slug" name="slug" placeholder="Exemple: Titre ou Titre Nom Auteur"  value="{{ old('slug') }}" disabled required>
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
					<textarea class="form-control" id="keywords" name="keywords">{{ old('keywords') }}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="score_image" class="col-sm-2 control-label">URL miniature</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="score_image" name="score_image" placeholder="http://www.adressedusiteweb.com/miniature.png" value="{{ old('score_image') }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="nb_pages" class="col-sm-2 control-label">Nombre de pages</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nb_pages" name="nb_pages" placeholder="3" value="{{ old('nb_pages') }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="score_url" class="col-sm-2 control-label">URL du fichier PDF</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="score_url" name="score_url" placeholder="http://www.adressedusiteweb.com/partition.pdf" value="{{ old('score_url') }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="score_sound_url" class="col-sm-2 control-label">URL du fichier audio (facultatif)</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="score_sound_url" name="score_sound_url" placeholder="http://www.adressedusiteweb.com/enregistrement.mp3" value="{{ old('score_sound_url') }}">
				</div>
			</div>

			<a href="{{ route('admin_scores') }}" class="btn btn-warning pull-left">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
				Annuler
			</a>
			<button type="submit" class="btn btn-success pull-right">
				<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
				Ajouter
			</button>
			{{ csrf_field() }}
		</form>
	</div>
@endsection
@section('js_code')
	@parent
	<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
	<script src="{{ elixir( '/js/sanitize.js' ) }}"></script>

	<script type="text/javascript">
	    $(function(){
	    	var scores_exists = { @for($i=0,$authors_count=count($authors);$i<$authors_count;$i++)
	    		@if(count($authors[$i]->scores)>0)
	    		'{{ $authors[$i]->id }}': [@for($j=0,$scores_count=count($authors[$i]->scores);$j<$scores_count;$j++)
	    			'{{ $authors[$i]->scores[$j] }}' @if(!empty($authors[$i]->scores[$j+1])),@endif
    			@endfor ]@if(!empty($authors[$i+1])),@endif
    			@endif
    		@endfor }
    		var current_author_scores = scores_exists[{{ $authors[0]->id }}];

	    	$('#description_fr, #description_en').summernote({
				placeholder: 'La description de la partition doit être la plus longue possible. Attention : ne surtout pas faire de copier/coller de n\'importe quel texte !',
				height: 200
			});

	        $( '#title' ).unbind().keyup( function()
	        {
	            var slug = sanitize( $(this).val() );
	            var keywords = sanitize( $(this).val(), ', ' );

	            $( '#slug' ).val( slug );
	            $( '#keywords' ).val( keywords );

	            var scores_text = '';
	            if($(this).val().length >= 1)
	            {
		           
		            var title_length = $(this).val().length;

	        		for(i=0,count_scores = current_author_scores.length;i<count_scores;i++)
	        		{
	        			if(sanitize($(this).val()) == sanitize(current_author_scores[i].substring(0, title_length)))
	        			{
		        			scores_text += '<li>'+current_author_scores[i]+'</li>';
		        		}
	        		}

	        		if(scores_text=='')
	        		{
	        			scores_text += '<li class="available">Disponible</li>';
	        		}
	        	}

	        	$('.scores_exists').html(scores_text);
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

	        $('#author_id').on('change', function()
	        {
	        	if(scores_exists[$(this).val()])
	        	{
	        		current_author_scores = scores_exists[$(this).val()];
	        	}
	        });
	    });
	</script>
@endsection