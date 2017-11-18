@extends('layouts.public')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <?php \Carbon\Carbon::setLocale(config('app.locale')); ?>
    <section class="scores__content">
        @if(count($scores) > 0 || count($authors)>0)
            <h2>Résultat de la recherche pour "{{ $keywords }}"</h2>
            @if(count($scores) > 0)
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <td colspan="4">
                                <h3 class="homesection__title">{{ count($scores) }} {{ count($scores)>1?'partitions gratuites trouvées':'partition gratuite trouvée' }} :</h3>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="homesection__content">
                        @foreach($scores as $score)
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
            @endif

            @if(count($authors)>0)
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <td colspan="2">
                                <h3 class="homesection__title">{{ count($authors) }} {{ count($authors)>1?'auteurs/compositeurs':'auteur/compositeur'}} :</h3>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="homesection__content">
                        @foreach($authors as $author)
                            <tr>
                                <td>
                                    <a href="{{ route('author_scores', ['slug_author'=>$author->slug]) }}">{{ $author->fullname }}</a>
                                </td>
                                <td>
                                    {{ count($author->scores) }} partitions gratuites</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @else
            <h2>Nous n'avons trouvé aucun auteur/compositeur et aucune partition gratuite de piano pour la recherche "{{ $keywords }}"</h2>
        @endif
    </section>
@endsection