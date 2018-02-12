@extends('layouts.public')

@section('title')Les partitions Gratuites de Piano sur PianoLoveScore @endsection
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
        1 => ['title' => 'Très facile', 'class' => 'info'],
        2 => ['title' => 'Facile', 'class' => 'primary'],
        3 => ['title' => 'Intermédiaire', 'class' => 'success'],
        4 => ['title' => 'Difficile', 'class' => 'warning'],
        5 => ['title' => 'Très difficile', 'class' => 'danger']
    ];
    @endphp
    <section class="scores__content">
        <div class="col-lg-offset-2 col-lg-8">
            <h3 class="difficulty">
                <p>Filtrer par difficulté</p>
                <a href="{{ route('scores_difficulty', ['difficulty'=>'tres-faciles']) }}" title="Partitions gratuites de piano très faciles" class="label label-info">Très facile</a>
                <a href="{{ route('scores_difficulty', ['difficulty'=>'faciles']) }}" title="Partitions gratuites de piano faciles" class="label label-primary">Partition facile</a>
                <a href="{{ route('scores_difficulty', ['difficulty'=>'intermediaires']) }}" title="Partitions gratuites de piano intermédiaires" class="label label-success">Intermédiaire</a>
                <a href="{{ route('scores_difficulty', ['difficulty'=>'difficiles']) }}" title="Partitions gratuites de piano difficiles" class="label label-warning">Difficile</a>
                <a href="{{ route('scores_difficulty', ['difficulty'=>'tres-difficiles']) }}" title="Partitions gratuites de piano très difficiles" class="label label-danger">Très difficile</a>
            </h3>
            <table class="table table-condensed">
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
                            @for($i=0; $i<$maximum_scores_showed; $i++)
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
                                        <img src="{{ URL::to('/') }}/img/pdf_download.png" /><strong>{{ $current_score->downloaded }} fois</strong>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                        @if($count_author_scores > $maximum_scores)
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <a href="{{ route('author_scores', ['slug_author'=>$author->slug]) }}" class="btn btn-default btn-lg">
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