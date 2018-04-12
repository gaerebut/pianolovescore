@extends('layouts.public')

@section('title')@lang('title.all_scores')@endsection
@section('description')Partitions Gratuites de Piano par Auteurs sur Piano Love Score. Téléchargez et notez les partitions après les avoir téléchargées @endsection

@section('og_type')book @endsection
@section('og_title')Partitions Gratuites de Piano sur PianoLoveScore @endsection
@section('og_description')Téléchargement de partitions gratuites de piano. Trouvez les partitions libres de droits en libre accès, notez-les, commentez-les et faites des découvertes @endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    @php
    $difficulties = [
        1 => ['title' => __('generic.very_easy_2'), 'class' => 'info'],
        2 => ['title' => __('generic.easy_2'), 'class' => 'primary'],
        3 => ['title' => __('generic.intermediate_2'), 'class' => 'success'],
        4 => ['title' => __('generic.hard_2'), 'class' => 'warning'],
        5 => ['title' => __('generic.very_hard_2'), 'class' => 'danger']
    ];
    @endphp
    <section class="scores__content">
        <div class="col-lg-offset-2 col-lg-8">
            <h3 class="difficulty">
                <p>@lang('messages.score.filter_by_difficulty')</p>
                <a href="{{ route('scores_difficulty', ['difficulty'=>__('generic.sheet_very_easy_href')]) }}" title="@lang('generic.sheet_very_easy_title')" class="label label-info">@lang('generic.very_easy_2')</a>
                <a href="{{ route('scores_difficulty', ['difficulty'=>__('generic.sheet_easy_href')]) }}" title="@lang('generic.sheet_easy_title')" class="label label-primary">@lang('generic.easy_2')</a>
                <a href="{{ route('scores_difficulty', ['difficulty'=>__('generic.sheet_intermediate_href')]) }}" title="@lang('generic.sheet_intermediate_title')" class="label label-success">@lang('generic.intermediate_2')</a>
                <a href="{{ route('scores_difficulty', ['difficulty'=>__('generic.sheet_hard_href')]) }}" title="@lang('generic.sheet_hard_title')" class="label label-warning">@lang('generic.hard_2')</a>
                <a href="{{ route('scores_difficulty', ['difficulty'=>__('generic.sheet_very_hard_href')]) }}" title="@lang('generic.sheet_very_hard_title')" class="label label-danger">@lang('generic.very_hard_2')</a>
            </h3>
            <table class="table table-condensed">
                @php $count_global_scores = 1; @endphp

                @foreach($authors as $author)
                    @if(count($author->scores)>0)
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <h3><a href="{{ route('author_scores', ['slug_author'=>$author->slug]) }}">{{ $author }}</a></h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $maximum_scores = Config::get('constants.public_scores_maximum_showed');
                            $count_author_scores = count($author->scores);
                            $maximum_scores_showed = min($count_author_scores, $maximum_scores);
                            ?>
                            @for($i=0; $i<$maximum_scores_showed; $i++, $count_global_scores++)
                                @if($count_global_scores%10 == 0)
                                    <tr>
                                        <td colspan="4">
                                            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                            <ins class="adsbygoogle"
                                                 style="display:block"
                                                 data-ad-format="fluid"
                                                 data-ad-layout-key="-hp-7+2n-1d-69"
                                                 data-ad-client="ca-pub-0114331985290768"
                                                 data-ad-slot="9757399046"></ins>
                                            <script>
                                                 (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                        </td>
                                    </tr>
                                @endif
                                <?php $current_score = $author->scores[$i]; ?>
                                <tr>
                                    <td>
                                        <a href="{{ route('score', ['composer_slug'=>$author->slug, 'score_slug'=>$current_score->slug]) }}">{{ $current_score }}</a>
                                    </td>
                                    <td>
                                        <span class="label label-{{ $difficulties[$current_score->difficulty]['class'] }}">{{ $difficulties[$current_score->difficulty]['title'] }}</span>
                                    </td>
                                    <td>
                                        @if(!is_null($current_score->avg_votes))
                                            <div class="star-ratings-css">
                                                <div class="top" style="width: {{ $current_score->avg_votes }}%">
                                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                </div>
                                                <div class="bottom">
                                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="scores__listing_downloaded">
                                        <img src="{{ URL::to('/') }}/img/pdf_download.png" /><strong> {{ $current_score->downloaded . ' ' . str_plural(__('generic.time'), $current_score->downloaded|1) }}</strong>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                        @if($count_author_scores > $maximum_scores)
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <a href="{{ route('author_scores', ['slug_author'=>$author->slug]) }}" class="btn btn-default btn-lg">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span> @lang('messages.score.see_other_of_author', ['nb_score' => $count_author_scores-$maximum_scores, 'author' => $author->fullname])
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    @endif
                @endforeach
            </table>
        </div>
    </section>
@endsection