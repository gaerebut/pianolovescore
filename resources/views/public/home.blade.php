@extends('layouts.public')

@section('title')Partition Gratuite de Piano : Téléchargez des partitions de piano gratuitement @endsection
@section('description')Partition Gratuite de Piano : Partitions Gratuites Piano, Téléchargements, Auteurs, Compositeurs, Astuces @endsection

@section('og_type')book @endsection
@section('og_title')Partitions Gratuites de Piano sur PianoLoveScore @endsection
@section('og_description')Téléchargement de partitions gratuites de piano. Trouvez les partitions libres de droits en libre accès, notez-les, commentez-les et faites des découvertes @endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection

@section('main')
    <?php \Carbon\Carbon::setLocale(config('app.locale')); ?>
    <section class="homesection">
        <h1 class="homesection__title">Piano Love Score</h1>
        <h2 class="homesection__subtitle">Partitions Gratuites de Piano</h2>
        <div class="homesection__content">
            <p>
                PianoLoveScore vous permet de télécharger des <a href="{{ route('home') }}">partitions gratuites de piano</a> au format PDF, de les noter en fonction de vos goûts, d'écouter leurs version audio et de partager votre expérience avec les autres membres.
            </p>
            <p>
                Vous avez un niveau débutant ou intermédiaire, découvrez notre rubrique d'<a href="#">astuces gratuites</a> pour perfectionner votre technique au <strong>piano</strong>.
            <p>
                Les <strong>partitions gratuites</strong> présentent sur PianoLoveScore sont toutes des <strong>partitions libre de droits et légales</strong>.
            </p>
            <p>
                Rejoingnez notre groupe Facebook <a href="#">Partition Gratuite Piano</a> et retrouvez les <strong>partitions de piano</strong>que les membres s'échangent gratuitement.
            </p>
        </div>
    </section>
    <section class="homesection">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <td colspan="4">
                        <h3 class="homesection__title">Nouvelles Partitions Gratuites de Piano</h3>
                    </td>
                </tr>
            </thead>
            <tbody class="homesection__content">
                @foreach($scores_new as $score)
                    <tr>
                        <td>
                            <a href="{{ route('score', ['slug_author'=>$score->author->slug, 'slug_score'=>$score->slug])}}">{{ $score->title }}</a>
                        </td>
                        <td>
                            de <a href="{{ route('author_scores', ['slug_author'=>$score->author->slug]) }}">{{ $score->author }}</a>
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
                        <h3 class="homesection__title">TOP Partitions Gratuites de Piano</h3>
                    </td>
                </tr>
            </thead>
            <tbody class="homesection__content">
                @foreach($scores_top as $score)
                    <tr>
                        <td>
                            <a href="{{ route('score', ['slug_author'=>$score->author->slug, 'slug_score'=>$score->slug])}}">{{ $score->title }}</a>
                        </td>
                        <td>
                            de <a href="{{ route('author_scores', ['slug_author'=>$score->author->slug]) }}">{{ $score->author }}</a>
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