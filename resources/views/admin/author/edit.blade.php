@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	<div class="col-md-8 col-md-offset-2">
		<form action="{{ route('admin_authors_add') }}" method="post" class="form-horizontal">
			<div class="form-group">
				<label for="lastname" class="col-sm-2 control-label">Nom</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom" value="{{ $author->lastname }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="firstname" class="col-sm-2 control-label">Prénom</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom" value="{{ $author->firstname }}" required>
				</div>
			</div>
			<div class="form-group">
				<label for="slug" class="col-sm-2 control-label">Identifiant URL</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="slug" name="slug" placeholder="Exempe: Nom ou NOM Prénom"  value="{{ $author->slug }}"disabled required>
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
					<input type="date" class="form-control" id="birthday" name="birthday" placeholder="01/01/1900" value="{{ $author->birth }}" required>
				</div>
			</div>
			<a href="{{ route('admin_authors') }}" class="btn btn-warning pull-left">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
				Annuler
			</a>
			<button type="submit" href="{{ route('admin_authors_edit') }}" class="btn btn-success pull-right">
				<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
				Modifier
			</button>
			<input type="hidden" name="id" value="{{ $author->id }}" />
			{{ csrf_field() }}
		</form>
	</div>
@endsection
@section('js_code')
	@parent
	<script src="{{ elixir( '/js/sanitize.js' ) }}"></script>

	<script type="text/javascript">
	    $(function(){	
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