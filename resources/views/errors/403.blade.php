@php
	$alternate_route = Request::url()
@endphp
@extends('layouts.public')

@section('title')Acces non autorise - Partition Gratuite de Piano @endsection
@section('description')Partition Gratuite de Piano - La ressource demandée est introuvable @endsection

@section('main')
    <div class="text-center">
        <br /><br /><br /><br /><br /><br />
        <h1>VOUS N'AVEZ PAS ACCES A CETTE RESSOURCE !</h1>
        <br /><br /><br /><br /><br /><br />
    </div>
@endsection