@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	<?php \Carbon\Carbon::setLocale(config('app.locale')); ?>
	<fieldset>
		<legend>Récapitulatif - Partition demandée {{ $score_request->created_at->diffForHumans() }}</legend>
		<div class="form-group">
			<label class="col-sm-2 control-label">Demandeur</label>
			<div class="col-sm-10">
				<p class="form-control-static">{{ ucfirst($score_request->contact_firstname) }} {{ strtoupper($score_request->contact_lastname) }}</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Partition / Auteur</label>
			<div class="col-sm-10">
				<p class="form-control-static">{{ $score_request->title }} de <u>{{ $score_request->author }}</u></p>
			</div>
		</div>
		@if(!empty($score_request->contact_message))
			<div class="form-group">
				<label class="col-sm-2 control-label">Informations supplémentaire</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{ $score_request->contact_message }}</p>
				</div>
			</div>
		@endif
	</fieldset>
	<br /><br />
	<fieldset id="step1">
		<legend>Etape 1 / 3</legend>
		<div class="form-group">
			<button type="button" class="col-sm-4 col-sm-offset-1 btn btn-lg btn-success" id="accepted">Lier une partition à cette demande</button>
			<button type="button" class="col-sm-4 col-sm-offset-1 btn btn-lg btn-danger" id="refused">Refuser cette demande</button>
		</div>
	</fieldset>
	<br /><br />
	<fieldset id="step2-accepted" class="collapse">
		<legend>Etape 2 / 3</legend>
		<div class="form-group">
			<label class="col-sm-2 control-label">Lier la partition</label>
			<div class="col-sm-10">
				<select id="score_id_listing">
					<option></option>
					@foreach($scores as $score)
						<option value="{{ $score->id }}"><u>{{ $score->author }} {{ $score->author->firstname}}</u> - {{ $score }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</fieldset>
	<fieldset id="step2-refused" class="collapse">
		<legend>Etape 2 / 3</legend>
		<div class="form-group">
			<label class="col-sm-2 control-label">Motif du refus</label>
			<div class="col-sm-10">
				<select id="admin_message_1">
					<option></option>
					<option value="La partition demandée n'est pas dans le domaine public et/ou n'est pas libre de droit">La partition demandée n'est pas dans le domaine public et/ou n'est pas libre de droit</option>
					<option value="La partition demandée n'existe pas">La partition demandée n'existe pas</option>
					<option value="Nous ne trouvons pas la partition">Nous ne trouvons pas la partition</option>
					<option value="0">Message personnalisé</option>
				</select>
			</div>
		</div>
	</fieldset>
	<br /><br />
	<fieldset id="step3" class="collapse">
		<legend>Etape 3 / 3</legend>
		<div class="form-group admin_message">
			<label class="col-sm-2 control-label">Commentaire (facultatif)</label>
			<div class="col-sm-10">
				<textarea id="admin_message_2" class="form-control"></textarea>
				<br /><br />
			</div>
		</div>
		<div class="form-group">
			<form action="{{ route('admin_scoresrequests_edit_store') }}" method="post" id="send_form">
				<input type="hidden" name="score_id" id="score_id" />
				<input type="hidden" name="state" id="state"/>
				<input type="hidden" name="admin_message" id="admin_message"/>
				<input type="hidden" name="id" value="{{ $score_request->id }}" />
				{{ csrf_field() }}
				<button type="button" class="col-sm-4 col-sm-offset-4 btn btn-lg btn-success">Je confirme mon choix !</button>
			</form>
		</div>
	</fieldset>
	<br />
@endsection
@section('js_code')
	@parent
	<script type="text/javascript">
		$(function()
		{
			var slideDelay = 300;
			var step2ID = '';

			$('#step1 button').on('click', function(){
				var buttonID = $(this).attr('id');

				$('#step3').slideUp(slideDelay, function(){
					$('.admin_message').slideDown(slideDelay)
				});
				
				if(step2ID != '' && step2ID != buttonID)
				{
					$('#step2-' + step2ID).slideUp(slideDelay, function(){
						$('#step2-' + buttonID).slideDown(slideDelay);
					})
				}
				else
				{
					$('#step2-' + buttonID).slideDown(slideDelay);
				}

				step2ID = buttonID;
			});

			$('#score_id_listing, #admin_message_1').on('change', function(){
				if(step2ID == 'refused')
				{
					$('#step3 button').removeClass('btn-success').addClass('btn-danger');
				}
				else
				{
					$('#step3 button').removeClass('btn-danger').addClass('btn-success');
				}
				$('#step3').slideDown(slideDelay);
			});

			$('#admin_message_1').on('change', function(){
				if($(this).val() != '0')
				{
					$('.admin_message').slideUp(slideDelay);
				}
				else
				{
					$('.admin_message').slideDown(slideDelay);
				}
			});

			$('#send_form').on('click', function(e){
				e.preventDefault();

				var score_id = '';
				var state = 2; // Default = refused
				var admin_message = '';

				if(step2ID == 'accepted')
				{
					score_id = $('#score_id_listing').val();
					state = 1;
					admin_message = $('#admin_message_2').val();
				}
				else
				{
					if($('#admin_message_1').val() == '0')
					{
						admin_message = $('#admin_message_2').val();
					}
					else
					{
						admin_message = $('#admin_message_1').val();
					}
				}

				$('#score_id').val(score_id);
				$('#state').val(state);
				$('#admin_message').val(admin_message);

				$(this).submit();
			});
		});
	</script>
@endsection