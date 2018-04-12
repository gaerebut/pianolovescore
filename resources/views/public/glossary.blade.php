@extends('layouts.public')

@section('title')@lang('title.glossary', ['letter' => $letter])@endsection
@section('description')Retrouvez la définition des différents symboles que vous trouvez sur les partitions de piano. Comprenez maintenant chacun des signes présents sur les partitions gratuites de piano. @endsection

@section('og_type')books @endsection
@section('og_title')Lexique des symboles de partitions de Piano @endsection
@section('og_description')Comprenez chacun des différents symboles présents sur vos partitions de piano. @endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection
@section('meta')
    @parent
    <link rel="canonical" href="{{ route('glossary', ['slug_glossary' => $letter]) }}" />
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
                    <a href="{{ route('glossary', ['letter' => chr(65+$i)]) }}" role="group" class="btn btn-default" title="@lang('message.glossary.word_letter', ['letter' => chr(65+$i)])">{{ chr(65+$i) }}</a>
                @endif
            @endfor
        </div>
        <div class="col-sm-8 col-sm-offset-2">
            @if(count($glossaries)>0)
                @php $cpt = 0; @endphp
                @foreach($glossaries as $glossary)
                    <div class="row" id="{{ $glossary->slug }}">
                        <div class="col-sm-3 glossary-image">
                        @if(!is_null($glossary->image))
                            <img src="{{ URL::to('/') }}/img/glossaries/{{ $glossary->image }}" height="50" title="{{ $glossary }} - @lang('messages.glossary.in', ['letter => $letter'])" />
                        @endif
                        </div>
                        <div class="col-sm-9">
                            <h2>{{ $glossary }}</h2>
                            <p>{{ $glossary->description }}</p>
                        </div>
                    </div>
                    <hr />
                @endforeach
            @else
                <h2>@lang('messages.glossary.no_definition')</h2>
            @endif
        </div>
    </section>
@endsection