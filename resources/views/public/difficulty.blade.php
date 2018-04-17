@extends('layouts.public')

@section('title')@lang('title.difficulty', ['difficulty' => $difficulty])@endsection
@section('description')@lang('description.difficulty', ['difficulty' => $difficulty])@endsection

@section('og_type')book @endsection
@section('og_title')@lang('title.difficulty', ['difficulty' => $difficulty])@endsection
@section('og_description')@lang('description.difficulty', ['difficulty' => $difficulty])@endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection
@section('meta')
    @parent
    @php $other_lang = App::getLocale() == 'fr' ? 'en' : 'fr'; @endphp
    <link rel="alternate" hreflang="{{ $other_lang }}" href="{{ route(__('routes.scores_difficulty', [], $other_lang), ['difficulty' => $difficulty])}}"/>
    <link rel="canonical" href="{{ route(__('routes.scores_difficulty'), ['difficulty' => $difficulty])}}" />
@endsection
@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <section class="scores__content">
        <div class="col-lg-offset-2 col-lg-8">
            <h3 class="difficulty">
                @if($difficulty_number==1)
                    <span class="label label-info active">@lang('generic.sheet_very_easy_2')</span>
                @else
                    <a href="{{ route(__('routes.scores_difficulty'), ['difficulty'=>__('generic.sheet_very_easy_href')]) }}" title="@lang('generic.sheet_very_easy_title')" class="label label-info">@lang('generic.very_easy_2')</a>
                @endif
                @if($difficulty_number==2)
                    <span class="label label-primary active">@lang('generic.sheet_easy_2')</span>
                @else
                    <a href="{{ route(__('routes.scores_difficulty'), ['difficulty'=>__('generic.sheet_easy_href')]) }}" title="@lang('generic.sheet_easy_title')" class="label label-primary">@lang('generic.easy_2')</a>
                @endif
                @if($difficulty_number==3)
                    <span class="label label-success active">@lang('generic.sheet_intermediate_2')</span>
                @else
                    <a href="{{ route(__('routes.scores_difficulty'), ['difficulty'=>__('generic.sheet_intermediate_href')]) }}" title="@lang('generic.sheet_intermediate_title')" class="label label-success">@lang('generic.intermediate_2')</a>
                @endif
                @if($difficulty_number==4)
                    <span class="label label-warning active">@lang('generic.sheet_hard_2')</span>
                @else
                    <a href="{{ route(__('routes.scores_difficulty'), ['difficulty'=>__('generic.sheet_hard_href')]) }}" title="@lang('generic.sheet_hard_title')" class="label label-warning">@lang('generic.hard_2')</a>
                @endif
                @if($difficulty_number==5)
                    <span class="label label-danger active">@lang('generic.sheet_very_hard_2')</span>
                @else
                    <a href="{{ route(__('routes.scores_difficulty'), ['difficulty'=>__('generic.sheet_very_hard_href')]) }}" title="@lang('generic.sheet_very_hard_title')" class="label label-danger">@lang('generic.very_hard_2')</a>
                @endif
            </h3>
            <table class="table table-condensed">
                @php
                $have_score = false;
                @endphp
                @foreach($authors as $author)
                    <?php
                    $have_score_difficulty = false;
                    ?>
                    @if(count($author->scores)>0)
                        @foreach($author->scores as $score)
                            @if($score->difficulty == $difficulty_number)
                                @php $have_score = true; @endphp
                                @if(!$have_score_difficulty)
                                    @php
                                    $have_score_difficulty = true;
                                    @endphp
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>{{ $author }}</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                @endif
                                <tr>
                                    <td>
                                        <a href="{{ route(__('routes.score'), ['composer_slug'=>$author->slug, 'score_slug'=>$score->slug]) }}">{{ $score }}</a>
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
                                    <td class="scores__listing_downloaded">
                                        <img src="{{ URL::to('/') }}/img/pdf_download.png" /><strong>{{ $score->downloaded . ' ' . str_plural(__('generic.time'), $score->downloaded|1) }}</strong>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        @if($have_score_difficulty)
                            </tbody>
                        @endif
                    @endif
                @endforeach

                @if(!$have_score)
                    <h2>@lang('messages.score.no_score_difficulty')</h2>
                @endif
            </table>
        </div>
    </section>
@endsection