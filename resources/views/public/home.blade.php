@extends('layouts.public')

@section('title')@lang('title.home')@endsection
@section('description')Partition Gratuite de Piano : Partitions Gratuites Piano, Téléchargements, Auteurs, Compositeurs, Astuces @endsection

@section('og_type')book @endsection
@section('og_title')Partitions Gratuites de Piano sur PianoLoveScore @endsection
@section('og_description')Téléchargement de partitions gratuites de piano. Trouvez les partitions libres de droits en libre accès, notez-les, commentez-les et faites des découvertes @endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection

@section('main')
    @php
    \Carbon\Carbon::setLocale(config('app.locale'));

    $difficulties = [
        1 => ['title' => 'Très facile', 'class' => 'info'],
        2 => ['title' => 'Facile', 'class' => 'primary'],
        3 => ['title' => 'Intermédiaire', 'class' => 'success'],
        4 => ['title' => 'Difficile', 'class' => 'warning'],
        5 => ['title' => 'Très difficile', 'class' => 'danger']
    ];
    @endphp
    <section class="homesection">
        <h1 class="homesection__title">@lang('messages.home.title')</h1>
        <h2 class="homesection__subtitle">@lang('messages.home.subtitle')</h2>
        <div class="homesection__content">@lang('messages.home.introduction')</div>
    </section>
    <section class="homesection">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <td colspan="4">
                        <h3 class="homesection__title">@lang('messages.home.scores_news')</h3>
                    </td>
                </tr>
            </thead>
            <tbody class="homesection__content">
                @foreach($scores_new as $score)
                    <tr>
                        <td width="5%">
                            <span class="label label-{{ $difficulties[$score->difficulty]['class'] }}">{{ $difficulties[$score->difficulty]['title'] }}</span>
                        </td>
                        <td>
                            <a href="{{ route( __('routes.score') , ['slug_author'=>$score->author->slug, 'slug_score'=>$score->slug])}}" title="@lang('generic.score_of_author', ['score' => $score->title, 'author' => $score->author->fullname])">{{ $score->title }}</a>
                        </td>
                        <td>
                            @lang('generic.by') <a href="{{ route( __('routes.author_scores'), ['slug_author'=>$score->author->slug]) }}" title="@lang('generic.author_scores', ['author' => $score->author])">{{ $score->author }}</a>
                        </td>
                        <td>
                            @if(!is_null($score->avg_votes))
                                <div class="star-ratings-css">
                                    <div class="top" style="width: {{ $score->avg_votes }}%">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                    <div class="bottom">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td>{{ $score->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <section class="homesection">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <td colspan="4">
                        <h3 class="homesection__title">@lang('messages.home.scores_top')</h3>
                    </td>
                </tr>
            </thead>
            <tbody class="homesection__content">
                @foreach($scores_top as $score)
                    <tr>
                        <td width="5%">
                            <span class="label label-{{ $difficulties[$score->difficulty]['class'] }}">{{ $difficulties[$score->difficulty]['title'] }}</span>
                        </td>
                        <td>
                            <a href="{{ route( __('routes.score'), ['slug_author'=>$score->author->slug, 'slug_score'=>$score->slug])}}" title="@lang('generic.score_of_author', ['score' => $score->title, 'author' => $score->author->fullname])">{{ $score->title }}</a>
                        </td>
                        <td>
                            @lang('generic.by') <a href="{{ route( __('routes.author_scores'), ['slug_author'=>$score->author->slug]) }}" title="@lang('generic.author_scores', ['author' => $score->author])">{{ $score->author }}</a>
                        </td>
                        <td>
                            @if(!is_null($score->avg_votes))
                                <div class="star-ratings-css">
                                    <div class="top" style="width: {{ $score->avg_votes }}%">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                    <div class="bottom">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td>{{ $score->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection