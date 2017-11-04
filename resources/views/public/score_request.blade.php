@extends('layouts.common')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <section class="scores__content">
        {!! NoCaptcha::display() !!}
        {!! NoCaptcha::renderJs() !!}
    </section>
@endsection