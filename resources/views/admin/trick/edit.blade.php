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
		<form action="{{ route('admin_tricks_edit_store') }}" method="post" class="form-horizontal">
			<div class="row text-right">
				<label for="is_online" class="form-label">MISE EN LIGNE DE L'ASTUCE</label>
				<input type="checkbox" id="is_online" name="is_online" value="1" @if($trick->is_online) checked="checked" @endif />
			</div>
			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">Titre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="title" placeholder="Titre" value="{{ $trick }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="introduction" class="col-sm-2 control-label">Introduction</label>
				<div class="col-sm-10">
					<textarea id="introduction" name="introduction">{{ $trick->introduction }}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
					<textarea id="description" name="description">{{ $trick->description }}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="slug" class="col-sm-2 control-label">Identifiant URL</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="slug" name="slug" placeholder="Exemple: Titre"  value="{{ $trick->slug }}" disabled required>
				</div>
				<div class="col-sm-2">
					<a class="btn btn-warning pull-right" id="edit-slug">
	                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
	                    Editer
	                </a>
               	</div>
			</div>
			<a href="{{ route('admin_tricks') }}" class="btn btn-warning pull-left">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
				Annuler
			</a>
			<button type="submit" class="btn btn-success pull-right">
				<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
				Modifier
			</button>
			<input type="hidden" name="id" value="{{ $trick->id }}" />
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
	    	$('#introduction, #description').summernote({
				placeholder: 'Ce texte doit être le plus long possible. Attention : ne surtout pas faire de copier/coller de n\'importe quel texte !',
				height: 200
			});

	        $( '#title' ).unbind().keyup( function()
	        {
	            var slug = sanitize( $( this ).val() );
	            $( '#slug' ).val( slug );
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