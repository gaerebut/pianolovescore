@extends('layouts.public')

@section('title')@lang('title.glossary', ['letter' => $letter])@endsection
@section('description')@lang('description.glossary')@endsection

@section('og_type')books @endsection
@section('og_title')@lang('title.glossary', ['letter' => $letter])@endsection
@section('og_description')@lang('description.glossary')@endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection
@section('meta')
    @parent
    @php
        $other_lang = App::getLocale() == 'fr' ? 'en' : 'fr';
        $alternate_route = route(__('routes.glossary', [], $other_lang), ['slug_glossary' => $letter]);
    @endphp
    <link rel="alternate" hreflang="{{ $other_lang }}" href="{{ $alternate_route }}"/>
    <link rel="canonical" href="{{ route(__('routes.glossary'), ['slug_glossary' => $letter])}}" />
@endsection
@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <section class="scores__content">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="row scores__title">
                <h1>@lang('messages.glossary.title')</h1>
            </div>
        </div>
        <div class="col-sm-12 btn-toolbar center-block" role="toolbar" aria-label="Glossaries">
            @for($i=0;$i<=25;$i++)
                @if($letter==chr(65+$i))
                    <button role="group" class="btn btn-primary">{{ chr(65+$i) }}</a></button>
                @else
                    <a href="{{ route(__('routes.glossary'), ['letter' => chr(65+$i)]) }}" role="group" class="btn btn-default" title="@lang('message.glossary.word_letter', ['letter' => chr(65+$i)])">{{ chr(65+$i) }}</a>
                @endif
            @endfor
        </div>
        <div class="col-sm-8 col-sm-offset-2">
            @if(count($glossaries)>0)
                @php $cpt = 0; @endphp
                @foreach($glossaries as $glossary)
                    @php
                    $slug = 'slug_' . App::getLocale();
                    $title = 'glossary_' . App::getLocale();
                    $description = 'description_' . App::getLocale();
                    @endphp
                    <div class="row" id="{{ $glossary->$slug }}">
                        <div class="col-sm-3 glossary-image">
                        @if(!is_null($glossary->image))
                            <img src="{{ URL::to('/') }}/img/glossaries/{{ $glossary->image }}" height="50" title="{{ $glossary->$title }} - @lang('messages.glossary.in', ['letter' => $letter])" />
                        @endif
                        </div>
                        <div class="col-sm-9">
                            <h2>{{ $glossary->$title }}</h2>
                            <p>{{ $glossary->$description }}</p>
                        </div>
                    </div>
                    <hr />
                @endforeach
            @else
                <h2>@lang('messages.glossary.no_definition', ['letter' => $letter])</h2>
            @endif
        </div>
    </section>
@endsection