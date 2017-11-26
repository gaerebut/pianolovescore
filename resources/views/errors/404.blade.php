@extends('layouts.public')

@section('title')Page introuvable - Partition Gratuite de Piano @endsection
@section('description')Partition Gratuite de Piano - La ressource demandée est introuvable - Téléchargez gratuitement cette partition @endsection

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <div class="text-center">
        <h4>{{ $exception->getMessage() }}</h4>
        <h1>LA RESSOURCE DEMANDEE EST INTROUVABLE!</h1>
    </div>
@endsection