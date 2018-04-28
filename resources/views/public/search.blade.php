@extends('layouts.public')

@section('title')@lang('title.search', ['keywords' => $keywords])@endsection
@section('description')@lang('description.search', ['keywords' => $keywords]) @endsection

@section('og_type')book @endsection
@section('og_title')@lang('title.search', ['keywords' => $keywords])@endsection
@section('og_description')@lang('description.search', ['keywords' => $keywords])@endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('meta')
    @parent
    @php
        $other_lang = App::getLocale() == 'fr' ? 'en' : 'fr';
        $alternate_route = route(__('routes.search', [], $other_lang), ['q'=>$keywords]);
    @endphp
    <link rel="alternate" hreflang="{{ $other_lang }}" href="{{ $alternate_route }}"/>
    <link rel="canonical" href="{{ route(__('routes.search'), ['q'=>$keywords])}}" />
@endsection
@section('main')
    <?php \Carbon\Carbon::setLocale(config('app.locale')); ?>
    <section class="scores__content">
        @if(count($scores) > 0 || count($authors)>0)
            <h2>@lang('messages.search.result_for') "{{ $keywords }}"</h2>
            @if(count($scores) > 0)
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <td colspan="4">
                                <h3 class="homesection__title">{{ count($scores) }} {{ count($scores)>1?__('messages.search.free_sheet_found_2'):__('messages.search.free_sheet_found') }} :</h3>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="homesection__content">
                        @foreach($scores as $score)
                            <tr>
                                <td>
                                    <a href="{{ route(__('routes.score'), ['slug_author'=>$score->author->slug, 'slug_score'=>$score->slug])}}">{{ $score->title }}</a>
                                </td>
                                <td>
                                    @lang('generic.by') <a href="{{ route(__('routes.author_scores'), ['slug_author'=>$score->author->slug]) }}">{{ $score->author }}</a>
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
            @endif

            @if(count($authors)>0)
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <td colspan="2">
                                <h3 class="homesection__title">{{ count($authors) . ' ' . str_plural(__('messages.search.author_composer'), count($authors)) }} :</h3>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="homesection__content">
                        @foreach($authors as $author)
                            <tr>
                                <td>
                                    <a href="{{ route(__('routes.author_scores'), ['slug_author'=>$author->slug]) }}">{{ $author->fullname }}</a>
                                </td>
                                <td>
                                    {{ count($author->scores) . ' ' . __('generic.free_sheet_2') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @else
            <h2>@lang('messages.search.no_result') "{{ $keywords }}"</h2>
        @endif
    </section>
@endsection