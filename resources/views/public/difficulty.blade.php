@extends('layouts.public')

@section('title')@lang('title.difficulty', ['difficulty' => $difficulty])@endsection
@section('description')Partitions Gratuites de Piano {{ $difficulty }} par Auteurs sur Piano Love Score. Téléchargez et notez les partitions {{ $difficulty }} après les avoir téléchargées @endsection

@section('og_type')book @endsection
@section('og_title')Partitions Gratuites de Piano {{ $difficulty }} sur PianoLoveScore @endsection
@section('og_description')Téléchargement de partitions gratuites de piano {{ $difficulty }}. Trouvez les partitions {{ $difficulty }} libres de droits en libre accès, notez-les, commentez-les et faites des découvertes @endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <section class="scores__content">
        <div class="col-lg-offset-2 col-lg-8">
            <h3 class="difficulty">
                @if($difficulty_number==1)
                    <span class="label label-info active">Partitions très faciles</span>
                @else
                    <a href="{{ route('scores_difficulty', ['difficulty'=>'tres-faciles']) }}" title="Partitions gratuites de piano très faciles" class="label label-info">Très facile</a>
                @endif
                @if($difficulty_number==2)
                    <span class="label label-primary active">Partitions faciles</span>
                @else
                    <a href="{{ route('scores_difficulty', ['difficulty'=>'faciles']) }}" title="Partitions gratuites de piano faciles" class="label label-primary">Faciles</a>
                @endif
                @if($difficulty_number==3)
                    <span class="label label-success active">Partitions intermédiaires</span>
                @else
                    <a href="{{ route('scores_difficulty', ['difficulty'=>'intermediaires']) }}" title="Partitions gratuites de piano intermédiaires" class="label label-success">Intermédiaire</a>
                @endif
                @if($difficulty_number==4)
                    <span class="label label-warning active">Partitions difficiles</span>
                @else
                    <a href="{{ route('scores_difficulty', ['difficulty'=>'difficiles']) }}" title="Partitions gratuites de piano difficiles" class="label label-warning">Difficile</a>
                @endif
                @if($difficulty_number==5)
                    <span class="label label-danger active">Partitions très difficiles</span>
                @else
                    <a href="{{ route('scores_difficulty', ['difficulty'=>'tres-difficiles']) }}" title="Partitions gratuites de piano très difficiles" class="label label-danger">Très difficile</a>
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
                                        <a href="{{ route('score', ['composer_slug'=>$author->slug, 'score_slug'=>$score->slug]) }}">{{ $score }}</a>
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
                                        <img src="{{ URL::to('/') }}/img/pdf_download.png" /><strong>{{ $score->downloaded }} fois</strong>
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
                    <h2>Il n'y a aucune partition gratuite de piano de cette difficulté pour le moment</h2>
                @endif
            </table>
        </div>
    </section>
@endsection