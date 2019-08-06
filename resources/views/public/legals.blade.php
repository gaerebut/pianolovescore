@extends('layouts.public')

@section('title')@lang('title.legals')@endsection
@section('description')@lang('description.legals')@endsection

@section('og_type')book @endsection
@section('og_title')@lang('title.legals')@endsection
@section('og_description')@lang('description.legals')@endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection
@section('meta')
    @parent
    @php
        $other_lang = App::getLocale() == 'fr' ? 'en' : 'fr';
        $alternate_route = route(__('routes.legals', [], $other_lang));
    @endphp
    <link rel="alternate" hreflang="{{ $other_lang }}" href="{{ $alternate_route }}"/>
@endsection
@section('main')
	<h1>Mentions légales de PianoLoveScore</h1>

	<h3>Editeur</h3>

	<p>pianolovescore.com et en.pianolovescore.com</p>

	<p>Éditeur: Reb'Invest,<br />
	Société A Responsabilité Limité Unipersonnelle<br />
	Au capital social de 2000 euros<br />
	Numéro SIREN : 823 366 141<br />
	Numéro SIRET : 823 366 141 000 13<br />
	Numéro TVA : FR31 823366141</p>

	<p>Code APE : 6420Z / Activités des sociétés holding</p>

	<p>Email : contact @pianolovescore . com</p>

	<h3>Hébergeur</h3>

	<p>Les sites pianolovescore.com et en.pianolovescore.com dont hébergés par :<br /> 
	GANDI SAS,<br />
	63-65 boulevard Massena, Paris (75013) FRANCE,<br />
	N° TVA FR81423093459<br />
	Tél : 01 70 37 76 61<br />
	Fax : 01 43 73 18 51</p>

	<h3>Données à caractère personnel</h3>

	<p>Conformément aux dispositions de la loi n° 78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés, vous disposez d'un droit d'accès, de modification, de rectification et de suppression des données qui vous concernent. Pour demander une modification, rectification ou suppression des données vous concernant, il vous suffit d'envoyer un courrier par voie électronique en justifiant de votre identité.</p>


	<h3>Gestionnaire des statistiques</h3>

	<p>Le site pianolovescore.com utilise l'outil Google Analytics pour le traitement de ses données statistiques anonymes.</p>

	<h3>Messagerie</h3>

	<p>Le site pianolovescore.com utilise la solution Webmail de la société Gandi pour la gestion de sa messagerie.</p>
	 

	<h3>Conditions générales d'utilisation</h3>

	<p>L'ensemble des Conditions Générales d'Utilisation sont disponible sur cette page.</p>
@endsection