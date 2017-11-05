@extends('layouts.public')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
<?php
    $count_scores = count($author->scores);
?>
    <section class="scores__content">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="row scores__title">
                <h1>{{ $author->fullname }}</h1><h2>{{ $count_scores }} <?php echo $count_scores>1?'partitions gratuites':'partition gratuite'; ?></h2>
            </div>
        </div>
        <div class="col-lg-offset-2 col-lg-8">
            <table class="table table-condensed">
                <?php
                    $current_letter = 'A';
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
                    @if(empty($author->scores[$i+1]))
                        </tbody>
                    @endif
                @endfor
            </table>
        </div>
    </section>
@endsection