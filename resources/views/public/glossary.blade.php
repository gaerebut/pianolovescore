@extends('layouts.public')

@section('title')Lexique en {{ $letter }} des partitions de piano @endsection
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
                <h1>Lexique des partitions de Piano</h1>
            </div>
        </div>
        <div class="col-sm-12 btn-toolbar center-block" role="toolbar" aria-label="Glossaries">
            @for($i=0;$i<=25;$i++)
                @if($letter==chr(65+$i))
                    <button role="group" class="btn btn-primary">{{ chr(65+$i) }}</a></button>
                @else
                    <a href="{{ route('glossary', ['slug_glossary' => chr(65+$i)]) }}" role="group" class="btn btn-default" title="Lexique des mots commençant par la lettre {{ chr(65+$i) }} sur les partitions de piano">{{ chr(65+$i) }}</a>
                @endif
            @endfor
        </div>
        <div class="col-sm-8 col-sm-offset-2">
            @if(count($glossaries)>0)
                @php $cpt = 0; @endphp
                @foreach($glossaries as $glossary)
                    <div class="row" id="{{ $glossary->slug }}-{{ $cpt++ }}">
                        <div class="col-sm-2">
                        @if(!is_null($glossary->image))
                            <img src="{{ URL::to('/') }}/img/glossaries/{{ $glossary->image }}" width="100%" title="{{ $glossary }} - Lexique en {{ $letter }}" />
                        @endif
                        </div>
                        <div class="col-sm-10">
                            <h2>{{ $glossary }}</h2>
                            <p>{{ $glossary->description }}</p>
                        </div>
                        <hr />
                    </div>
                @endforeach
            @else
                <h2>Il n'y a pas encore de définition pour la lettre <strong>{{ $letter }}</strong> du lexique</h2>
            @endif
        </div>
    </section>
@endsection