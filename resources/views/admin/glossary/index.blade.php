@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	<form action="{{ route('admin_glossaries_add_store') }}" method="post" class="form-horizontal hide" id="form_glossary">
		<h1 id="form_title">Ajouter un mot au lexique</h1>
		<div class="form-group">
			<label for="glossary_fr" class="col-sm-2 control-label">Mot FR</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="glossary_fr" name="glossary_fr" placeholder="Nom en Français" value="{{ old('glossary_fr') }}" required>
			</div>
		</div>
		<div class="form-group">
			<label for="glossary_en" class="col-sm-2 control-label">Mot EN</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="glossary_en" name="glossary_en" placeholder="Nom en Anglais" value="{{ old('glossary_en') }}" required>
			</div>
		</div>
		<div class="form-group">
			<label for="description_fr" class="col-sm-2 control-label">Description FR</label>
			<div class="col-sm-10">
				<textarea class="form-control" id="description_fr" name="description_fr" placeholder="Description du mot en Français">{{ old('description_fr') }}</textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="description_en" class="col-sm-2 control-label">Description EN</label>
			<div class="col-sm-10">
				<textarea class="form-control" id="description_en" name="description_en" placeholder="Description du mot en Anglais">{{ old('description_en') }}</textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="slug_fr" class="col-sm-2 control-label">Identifiant URL FR</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="slug_fr" name="slug_fr" placeholder="Exemple: mezzo-forte"  value="{{ old('slug_fr') }}" disabled required>
			</div>
			<div class="col-sm-2">
				<a class="btn btn-warning pull-right" id="edit-slug_fr">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    Editer
                </a>
           	</div>
		</div>
		<div class="form-group">
			<label for="slug_en" class="col-sm-2 control-label">Identifiant URL EN</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="slug_en" name="slug_en" placeholder="Exemple: mezzo-forte"  value="{{ old('slug_en') }}" disabled required>
			</div>
			<div class="col-sm-2">
				<a class="btn btn-warning pull-right" id="edit-slug_en">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    Editer
                </a>
           	</div>
		</div>
		<div class="form-group">
			<label for="image" class="col-sm-2 control-label">URL image illustrative</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="image" name="image" placeholder="http://www.adressedusiteweb.com/miniature.png" value="{{ old('image') }}"> 
			</div>
			<div class="col-sm-2">
				<a class="btn btn-warning pull-right" id="show_image">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    Voir l'image
                </a>
           	</div>
           	<div class="col-sm-6 col-sm-offset-3 hide" id="current_image">
				<h3>
					<input type="checkbox" name="delete_image" id="delete_image"/> <label for="delete_image">Supprimer l'image actuelle</label>
				</h3>
           		<br />
           		<span></span>
           	</div>
		</div>
		<div class="col-sm-6 text-right">
			<button type="button" class="btn btn-danger center-block reset_form">
				<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
				Effacer le formulaire
			</button>
		</div>
		<div class="col-sm-6 text-left">
			<button type="submit" class="btn btn-success center-block">
				<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
				Enregistrer
			</button>
		</div>
		<input type="hidden" name="id" id="id" value="" />
		{{ csrf_field() }}
	</form>
	<br />
	<button id="show_hide_form" class="btn btn-primary center-block">∨ Montrer le formulaire ∨</button>
	<br /><br />
	<div class="btn-toolbar" role="toolbar" aria-label="Glossaries">
		@for($i=0;$i<=25;$i++)
			@if($letter==chr(65+$i))
				<button role="group" class="btn btn-primary">{{ chr(65+$i) }}</a></button>
			@else
				<a href="{{ route('admin_glossaries', ['slug_glossary' => chr(65+$i)]) }}" role="group" class="btn btn-default">{{ chr(65+$i) }}</a>
			@endif
		@endfor
	</div>
	@foreach($glossaries as $glossary)
		<h2>@if(!is_null($glossary->image))<img src="{{ URL::to('/') }}/img/glossaries/{{ $glossary->image }}" width="50px" /> @endif {{ $glossary }}</h2>
		<button class="btn btn-primary edit-glossary">
			<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			Editer
			<input type="hidden" class="id" value="{{ $glossary->id }}"/>
			<input type="hidden" class="slug_fr" value="{{ $glossary->slug_fr }}"/>
			<input type="hidden" class="slug_en" value="{{ $glossary->slug_en }}"/>
			<input type="hidden" class="glossary_fr" value="{{ $glossary->glossary_fr }}"/>
			<input type="hidden" class="glossary_en" value="{{ $glossary->glossary_en }}"/>
			<input type="hidden" class="description_fr" value="{{ $glossary->description_fr }}"/>
			<input type="hidden" class="description_en" value="{{ $glossary->description_en }}"/>
			<input type="hidden" class="image" value="{{ $glossary->image }}"/>
		</button>
		<a href="{{ route('admin_glossaries_remove',['id_glossary'=>$glossary->id]) }}" class="btn btn-danger" data-toggle="confirmation" data-title="Confirmation" data-btn-ok-label="Supprimer" data-btn-ok-class="btn-success" data-btn-cancel-label="Annuler"data-btn-cancel-class="btn-danger" data-content="Êtes-vous sûr de vouloir supprimer ce mot du lexique ?" data-placement="right" data-singleton="true" data-popout="true">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			Supprimer
		</a>
		<hr />
	@endforeach
@endsection
@section('js_code')
	@parent
	<script src="{{ elixir( '/js/bootstrap-confirmation.min.js' ) }}"></script>
	<script src="{{ elixir( '/js/sanitize.js' ) }}"></script>
	<script type="text/javascript">
		$(function()
		{
			var url_add = "{{ route('admin_glossaries_add_store') }}";
			var url_edit = "{{ route('admin_glossaries_edit_store') }}";

			var root_image_path = "{{ URL::to('/') }}/img/glossaries/";
			var form = $('#form_glossary');

			function show_hide_form()
			{
				if( $('#show_hide_form').text() == '∧ Cacher le formulaire ∧')
	        	{	
	        		form.addClass('hide');
	        		 $('#show_hide_form').text('∨ Montrer le formulaire ∨');
	        	}
	        	else
	        	{
	        		form.removeClass('hide');
	        		 $('#show_hide_form').text('∧ Cacher le formulaire ∧');
	        	}
			}

			$('[data-toggle=confirmation]').confirmation({
				rootSelector: '[data-toggle=confirmation]'
			});

			$( '#glossary_fr', form ).unbind().keyup( function()
	        {
	            $( '#slug_fr', form ).val( sanitize( $( this ).val() ) );
	        } );

	        $( '#glossary_en', form ).unbind().keyup( function()
	        {
	            $( '#slug_en', form ).val( sanitize( $( this ).val() ) );
	        } );

	        $( '#edit-slug_fr', form ).unbind().click( function()
	        {
	            $( '#slug_fr', form ).prop( 'disabled', function( id, val ){ return !val; } );
	        } );

	        $( '#edit-slug_en', form ).unbind().click( function()
	        {
	            $( '#slug_en', form ).prop( 'disabled', function( id, val ){ return !val; } );
	        } );

	        form.submit( function()
	        {
	            $( '#slug_fr', form ).removeAttr( 'disabled' );
	            $( '#slug_en', form ).removeAttr( 'disabled' );
	        } );

	        $('#show_hide_form').on('click', show_hide_form);

	        $(".edit-glossary").on('click', function()
	        {
	        	form.attr('action', url_edit);
	        	$('#form_title').html('Modifier un mot du lexique');
	        	$('#id', form).val($('.id', this).val());
	        	$('#glossary_fr', form).val($('.glossary_fr', this).val());
	        	$('#glossary_en', form).val($('.glossary_en', this).val());
	        	$('#slug_fr', form).val($('.slug_fr', this).val());
	        	$('#slug_en', form).val($('.slug_en', this).val());
	        	$('#description_fr', form).val($('.description_fr', this).val());
	        	$('#description_en', form).val($('.description_en', this).val());
	        	$('#current_image span', form).html($('<img src="' + root_image_path + $('.image', this).val() + '"/>')).parents('div:eq(0)').removeClass('hide');

	        	show_hide_form();
	        });

	        $('#show_image', form).on('click', function()
	        {
	        	if($('#image', form).val() != '')
	        	{
		        	var win = window.open($('#image', form).val(), '_blank');
		        	win.focus();
		        }
	        });

	        $('.reset_form').on('click', function()
	        {
	        	form.attr('action', url_add);
	        	$('#form_title').html('Ajouter un mot au lexique');
	        	$('#id, #glossary_fr, #glossary_en, #slug_fr, #slug_en, #description_fr, #description_en, #image', form).val('');
	        	$('#current_image').addClass('hide');
	        });
		});
	</script>
@endsection