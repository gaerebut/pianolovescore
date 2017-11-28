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
		<form action="{{ route('admin_authors_add') }}" method="post" class="form-horizontal">
			<div class="form-group">
				<label for="lastname" class="col-sm-2 control-label">Nom</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom" value="{{ old('lastname') }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="firstname" class="col-sm-2 control-label">Prénom</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom" value="{{ old('firstname') }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
					<textarea id="description" name="description">{{ old('description') }}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="slug" class="col-sm-2 control-label">Identifiant URL</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="slug" name="slug" placeholder="Exempe: Nom ou NOM Prénom"  value="{{ old('slug') }}" disabled required>
				</div>
				<div class="col-sm-2">
					<a class="btn btn-warning pull-right" id="edit-slug">
	                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
	                    Editer
	                </a>
               	</div>
			</div>
			<div class="form-group">
				<label for="birthday" class="col-sm-2 control-label">Date de naissance</label>
				<div class="col-sm-10">
					<input type="date" class="form-control" id="birthday" name="birthday" placeholder="01/01/1900" value="{{ old('birthday') }}" required>
				</div>
			</div>
			<a href="{{ route('admin_authors') }}" class="btn btn-warning pull-left">
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
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
	<script src="{{ elixir( '/js/sanitize.js' ) }}"></script>

	<script type="text/javascript">
	    $(function(){
	    	$('#description').summernote({
				placeholder: 'La description de l\'auteur doit être la plus longue possible. Attention : ne surtout pas faire de copier/coller de n\'importe quel texte !',
				height: 200
			});

	        $( '#lastname' ).unbind().keyup( function()
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