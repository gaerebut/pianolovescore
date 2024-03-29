@extends('layouts.public')

<?php
    $count_scores = count($author->scores);
?>

@section('title')@lang('title.author', ['author' => $author, 'author_fullname' => $author->fullname])@endsection
@section('description')@lang('description.author', ['author' => $author->fullname])@endsection

@section('og_type')books.author @endsection
@section('og_title')@lang('title.author', ['author' => $author, 'author_fullname' => $author->fullname])@endsection
@section('og_description')@lang('description.author', ['author' => $author->fullname])@endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('meta')
    @parent
    @php
        $other_lang = App::getLocale() == 'fr' ? 'en' : 'fr';
        $alternate_route = route(__('routes.author_scores', [], $other_lang), ['slug_author'=>$author->slug]);
    @endphp
    <link rel="alternate" hreflang="{{ $other_lang }}" href="{{ $alternate_route }}"/>
    <link rel="canonical" href="{{ route(__('routes.author_scores'), ['slug_author'=>$author->slug])}}" />
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
            <div class="row scores__title">
                <h1>{{ $author->fullname }}</h1><h2>{{ $count_scores }} <?php echo $count_scores>1?__('generic.free_sheet_2'):__('generic.free_sheet'); ?></h2>
            </div>
            <div class="row text-left">
                <p>{!! $author->description !!}</p>
            </div>
        </div>
        <div class="col-lg-offset-2 col-lg-8">
            <table class="table table-condensed">
                <?php
                    $current_letter = null;
                    $first_score_of_this_letter = true;
                ?>

                @for($i=0; $i<$count_scores; $i++)
                    <?php
                        $current_score = $author->scores[$i];
                        $first_letter = substr($current_score, 0, 1);
                    ?>
                    @if($first_letter != $current_letter)
                        <?php
                            $current_letter = $first_letter;
                            $first_score_of_this_letter = true;
                        ?>
                        @if($i>0)
                            </tbody>
                        @endif

                        <thead>
                            <tr>
                                <th colspan="2">
                                    <h3>{{ ucfirst($current_letter) }}</h3>
                                </th>
                            </tr>
                        </thead>
                    @endif
                    @if($first_score_of_this_letter)
                        <?php $first_score_of_this_letter = false; ?>
                        <tbody>
                    @endif
                    <tr>
                        <td>
                            <a href="{{ route(__('routes.score'), ['composer_slug'=>$author->slug, 'score_slug'=>$current_score->slug]) }}">{{ $current_score }}</a>
                        </td>
                        <td>
                        <td>
                            <span class="label label-{{ $difficulties[$current_score->difficulty]['class'] }}">{{ $difficulties[$current_score->difficulty]['title'] }}</span>
                        </td>
                        <td class="star-rating">
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
                            <img src="{{ URL::to('/') }}/img/pdf_download.png" /><strong>{{ $current_score->downloaded . ' ' . str_plural(__('generic.time'), $current_score->downloaded|1) }}</strong>
                        </td>
                    </tr>
                    @if(empty($author->scores[$i+1]))
                        </tbody>
                    @endif
                @endfor
            </table>
        </div>
    </section>
@endsection