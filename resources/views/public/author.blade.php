@extends('layouts.common')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
<?php
    $count_scores = count($author->scores);
    $score_per_column = floor($count_scores/3);
?>
    <section class="scores__content">
        <div class="col-md-offset-4 col-md-8">
            <div class="row scores__title">
                <h1>{{ $author->fullname }}</h1><h2>{{ $count_scores }} <?php echo $count_scores>1?'partitions gratuites':'partition gratuite'; ?></h2>
            </div>
        </div>
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
                    <a href="{{ route('scores.show', ['composer_slug'=>$author->slug, 'score_slug'=>$current_score->slug]) }}">{{ $current_score }}</a>
                </td>
                <td>
                    <div class="star-ratings-css">
                        <div class="top" style="width: 50%">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <div class="bottom">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                    </div>
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

<?php
/***
        @for ($i=0, $j=0; $i < 3; $i++)
            <div class="col-sm-6 col-md-4">
                @for ($k=0; $k < $score_per_column; $j++, $k++)
                    <?php
                        $current_score = $author->scores[$j];
                        $first_letter = substr($current_score, 0, 1);
                    ?>
                    @if($first_letter == $current_letter)
                        @if($first_score_of_this_letter)
                            <?php $first_score_of_this_letter = false; ?>
                            <h3>{{ ucfirst($current_letter) }}</h3>
                            <table class="table"><tbody>
                        @endif
                        <tr>
                            <td>
                                <a href="{{ route('scores.show', ['composer_slug'=>$author->slug, 'score_slug'=>$current_score->slug]) }}">{{ $current_score }}</a>
                            </td>
                            <td>
                                <div class="star-ratings-css">
                                    <div class="top" style="width: 50%">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                    <div class="bottom">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @else
                        @if(!$first_score_of_this_letter)
                                </tbody>
                            </table>
                        @endif
                        <?php
                            $current_letter = $first_letter;
                            $first_score_of_this_letter = true;
                        ?>
                    @endif
                @endfor
                </tbody></table>
            </div>
        @endfor
***/
?>
    </section>
@endsection