@extends('layouts.public')

<?php
    \Carbon\Carbon::setLocale(config('app.locale'));
    $count_tricks = count($tricks);
?>

@section('title')@lang('title.tricks', ['nb_tricks' => $count_tricks . ' ' . str_plural(__('generic.tip'), $count_tricks)])@endsection
@section('description')Retrouvez l'ensemble des astuces de piano sur PianoLoveScore pour perfectionner votre technique au piano @endsection

@section('og_type')books @endsection
@section('og_title')@lang('title.tricks', ['nb_tricks' => $count_tricks . ' ' . str_plural(__('generic.tip'), $count_tricks)])@endsection
@section('og_description')Astuces de piano. Trouvez les astuces de piano, commentez-les et faites des découvertes.@endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <section class="scores__content">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="row scores__title">
                <h1>@lang('messages.tip.piano_tips')</h1><h2>{{ $count_tricks . ' ' . str_plural(__('generic.tip'), $count_tricks) }}</h2>
            </div>
        </div>
        <div class="col-lg-offset-2 col-lg-8">
            @foreach($tricks as $trick)
                <div class="row">
                    <h3>
                        <a href="{{ route('trick', ['slug'=>$trick->slug]) }}">{{ $trick }}</a>
                    </h3>
                </div>
                <div class="row">
                    <p>{!! $trick->introduction !!}</p>
                    <h5 class="pull-right">@lang('messages.tip.posted') {{ $trick->created_at->diffForHumans() }}</h5>
                </div>
            @endforeach
        </div>
    </section>
@endsection