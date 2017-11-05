@extends('layouts.public')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <section class="scores__content">
        <div class="col-lg-offset-2 col-lg-8">
            <table class="table table-condensed">
                @foreach($authors as $author)
                    @if(!empty($author->scores))
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <h3>{{ $author }}</h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $maximum_scores = Config::get('constants.public_scores_maximum_showed');
                                $count_author_scores = count($author->scores);
                                $maximum_scores_showed = min($count_author_scores, $maximum_scores);
                            ?>
                            @for($i=0; $i<$maximum_scores_showed; $i++)
                                <?php $current_score = $author->scores[$i]; ?>
                                <tr>
                                    <td>
                                        <a href="{{ route('score', ['composer_slug'=>$author->slug, 'score_slug'=>$current_score->slug]) }}">{{ $current_score }}</a>
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
                                        <img src="{{ URL::to('/') }}/img/pdf_download.png" /><strong>{{ $current_score->downloaded }} fois</strong>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                        @if($count_author_scores > $maximum_scores)
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <a href="{{ route('scores.showForAComposer', ['author_slug'=>$author->slug]) }}" class="btn btn-default btn-lg">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Voir les {{ $count_author_scores-$maximum_scores }} autres partitions gratuites de {{ $author->fullname }}
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