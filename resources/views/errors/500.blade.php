@php
	$alternate_route = Request::url()
@endphp
@extends('layouts.public')

@section('title')Erreur interne - Partition Gratuite de Piano @endsection
@section('description')Partition Gratuite de Piano - La ressource demandée est introuvable @endsection

@section('main')
    <div class="text-center">
        <br /><br /><br /><br /><br /><br />
        <h1>UNE ERREUR INTERNE EMPECHE LA PAGE DE S'AFFICHER !</h1>
        <h6>{{ $exception->getMessage() }}</h6>
        <br /><br /><br /><br /><br /><br />
    </div>
@endsection