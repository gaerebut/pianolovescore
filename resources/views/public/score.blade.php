@extends('layouts.public')

@section('title'){{ $score->title }} de {{ $score->author }} - Partition Gratuite de Piano @endsection
@section('description')Partition Gratuite de Piano - {{ $score->title }} de {{ $score->author }} - Téléchargez gratuitement cette partition @endsection

@section('og_type')book @endsection
@section('og_title'){{ $score->title }} de {{ $score->author}} - Partition Gratuite de Piano @endsection
@section('og_description')Télécharger la partition gratuite de piano: {{ $score->title }} de {{ $score->author}}. Trouvez les partitions libres de droits en libre accès, notez-les, commentez-les et faites des découvertes @endsection
@section('og_image'){{ $score->score_image }} @endsection

@section('css')
    @parent
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
@endsection
@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <?php \Carbon\Carbon::setLocale(config('app.locale')); ?>

    <section class="scores__content" itemscope="" itemtype="http://schema.org/Book">
        <div class="col-md-offset-4 col-md-8">
            <div class="row scores__title">
                <h1 itemprop="name">{{ $score->title }}</h1><h2><a href="{{ route('author_scores', ['slug_author'=>$score->author->slug]) }}" itemprop="author" itemscope itemtype="http://schema.org/Person" itemid="#author"><meta itemprop="name" content="{{ $score->author->fullname }}"/>{{ $score->author->fullname }}</a></h2>
            </div>
        </div>
        <div class="row border-left-0 border-right-0 border-top-0">
            <div class="col-md-4 text-center">
                <a data-fancybox="gallery" href="{{ $score->score_image }}">
                    <img src="{{ $score->score_image }}" class="scores__icon" itemprop="image">
                </a>
                <h6><strong>Cliquez sur l'image pour l'agrandir</strong></h6>
            </div>
            <div class="col-md-8 scores__infos">
                <div class="row text-left">
                    <p itemprop="description">{!! $score->description !!}</p>
                    <p>Cette oeuvre contient <span itemprop="numberOfPages">{{ $score->nb_pages }}</span> {{ str_plural('page', $score->nb_pages) }}</h6>
                </div>
                <div class="row">
                    <div class="col-xs-offset-4 col-xs-4 col-md-offset-1 col-md-3">
                        <h4><strong>Télécharger gratuitement</strong></h4>
                        <a href="{{ route('score_download', ['slug' => $score->slug]) }}">
                            <img src="{{ URL::to('/') }}/img/pdf_download.png" class="scores__download"/>
                        </a>
                        <h6><strong>{{ $score->downloaded . str_plural(' téléchargement', $score->downloaded|1
                        )}}</strong></h6>
                    </div>
                    <div class="col-xs-12 col-md-8" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                        @if(!$user_already_vote)
                            <h5>Quelle difficulté attribuez-vous à cette <strong>partition de piano</strong> ?</h5>
                        @else
                            <h5>Vous avez déjà voté pour cette <strong>partition gratuite</strong></h5>
                        @endif
                        <div class="stars">
                            <div class="star-ratings-css result @if(!$user_already_vote) off @endif">
                                <div class="top" style="width: {{ $score->avg_votes }}%">
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>
                                <div class="bottom">
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>
                            </div>
                            @if(!$user_already_vote)
                                <form action="{{ route('ajax_rating') }}" id="rating_form">
                                    <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                                    <label class="star star-1" for="star-1"></label>
                                </form>
                                <h3 class="scores__rating__thanks">Merci pour votre vote</h3>
                            @endif
                            <div class="scores__rating__result">Moyenne : <strong class="avg_votes" itemprop="ratingValue"><?php echo round($score->avg_votes/20, 2); ?></strong>/5 (<strong class="count_votes" itemprop="reviewCount">{{ $score->count_votes }}</strong> votes)</div>
                        </div>
                        @if(!is_null($score->score_sound_url))
                            <div class="scores__audio">
                                <h4>Ecoutez ci-dessous <strong>{{ $score->title }}</strong> de <strong>{{ $score->author->lastname }}</strong></h4>
                                <audio controls="controls" preload="metadata" controlsList="nodownload" itemprop="audio">
                                    <source src="{{ $score->score_sound_url }}" type="audio/{{ $score->score_sound_format }}" />
                                    Votre navigateur n'est pas compatible
                                </audio>
                            </div>
                        @endif
                    </div>
                </div>
                @if(count($score->keywords) > 1)
                    <div class="row scores__keywords text-left">
                        <h4>Recherches associées : <strong><mark>
                            @foreach($score->keywords as $keyword)
                                <a href="{{ route('search', ['q' => $keyword->keyword]) }}">#{{ $keyword }}</a>
                            @endforeach
                        </mark></strong></h4>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="card">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#commentaires-partition" aria-controls="commentsents-score" role="tab" data-toggle="tab">Commentaires</a></li>
                    @if(!is_null($score->youtube_playlist_id))
                        <li role="presentation" @if(count($score->comments)==0) class="active" @endif ><a href="#videos-piano" aria-controls="videos-piano" role="tab" data-toggle="tab">Vos vidéos</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="commentaires-partition">
                        <form class="reply_form" action="{{ route('ajax_comment') }}" onsubmit="return false">
                            <div class="form-group">
                                <input type="text" id="u" class="form-control" placeholder="Votre pseudo..." pattern=".{3,}" required />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="c" placeholder="Votre commentaire..." pattern=".{3,}" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary reply_comment">Poster le commentaire</button>
                            </div>
                        </form>
                        @if(count($score->comments) > 0)
                            @foreach($score->comments as $comment)
                                @include('public._comments', array('comment' => $comment))
                            @endforeach
                        @endif
                    </div>
                    @if(!is_null($score->youtube_playlist_id))
                        <div role="tabpanel" class="tab-pane @if(count($score->comments)==0) active @endif" id="videos-piano"><iframe width="100%" height="400" src="https://www.youtube-nocookie.com/embed/videoseries?list={{ $score->youtube_playlist_id }}" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe></div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--
    <section class="scores__alike">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <td colspan="3">
                        <h2>Partitions gratuites que vous aimerez également</h2>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
                    </td>
                    <td>
                        de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
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
                <tr>
                    <td>
                        <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
                    </td>
                    <td>
                        de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
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
                <tr>
                    <td>
                        <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
                    </td>
                    <td>
                        de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
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
                <tr>
                    <td>
                        <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
                    </td>
                    <td>
                        de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
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
                <tr>
                    <td>
                        <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
                    </td>
                    <td>
                        de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
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
            </tbody>
        </table>
    </section>
    <section class="scores__composer">
        <table class="table">
            <thead>
                <tr>
                    <td colspan="3">
                        <h2>Autres partitions gratuites de Chopin</h2>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
                    </td>
                    <td>
                        de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
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
                <tr>
                    <td>
                        <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
                    </td>
                    <td>
                        de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
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
                <tr>
                    <td>
                        <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
                    </td>
                    <td>
                        de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
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
                <tr>
                    <td>
                        <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
                    </td>
                    <td>
                        de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
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
                <tr>
                    <td>
                        <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
                    </td>
                    <td>
                        de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
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
            </tbody>
        </table>
    </section>
    -->
@endsection
@section('js_code')
    <script src="//load.sumome.com/" data-sumo-site-id="492cf06dd4417e64435c1585751ab4124d7c3fbfcf4021d3dfba6cbcc0a43f9e" async="async"></script>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function(){
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });

            $("a#inline").fancybox({
                'hideOnContentClick': true
            });

            $('[type*="radio"]').change(function ()
            {
                $.ajax({
                    url: $('#rating_form').attr('action'),
                    method: 'POST',
                    dataType: 'JSON',
                    data: 'slug={{ $score->slug }}&rate=' + $(this).attr('value'),
                    success: function(data) {
                       if(data.success)
                       {
                            $('.stars form').fadeOut(1000, function(){
                                $('.scores__rating__thanks').fadeIn();
                                $('.stars .result .top').css('width', data.avg_votes + '%').parent().fadeIn();
                            });

                            $('.avg_votes').html((data.avg_votes/20).toFixed(2));
                            $('.count_votes').html(data.count_votes);
                       }
                    },
                    error: function(data) {
                        alert('ERROR : ' + data);
                    }
                }); 
            });

            $('.scores__comment .reply').on('click', function(e)
            {
                e.preventDefault();

                var parent = $(this).parent();
                var commentForm = $(this).next();

                if(commentForm.hasClass('collapse'))
                {
                    commentForm.removeClass('collapse');
                    $(this).html('Fermer');
                }
                else
                {
                    commentForm.addClass('collapse');
                    $(this).html('Répondre');
                }
            });

            $('button.reply_comment').on('click', function(e)
            {
                /**/
                var form = $(this).parents('form:first');

                if(form[0].checkValidity())
                {
                    var parent = $('>div:first', form.parents('.scores__comment:first'));

                    var parent_id_str = '';
                    if(typeof parent.attr('id') != 'undefined')
                    {
                        parent_id_str = '&parent_id='+parent.attr('id');
                    }
                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        dataType: 'JSON',
                        data: 'score_id={{ $score->id }}'+parent_id_str+'&username='+$('#u', form).val()+'&comment=' + $('#c', form).val(),
                        success: function(data) {
                           if(data.success)
                           {
                                var parent_zone = parent_id_str == '' ? form.parent() : form.parents(':eq(1)');

                                parent_zone.append('<div class="scores__comment"><div id="'+data.id+'"><strong>'+$('#u', form).val()+'</strong> - A l\'instant<div>'+$('#c', form).val()+'</div>');
                                $('#c, #u', form).val('');
                           }
                        },
                        error: function(data) {
                            alert('ERROR : ' + data);
                        }
                    }); 
                }
                else
                {
                    alert('error');
                }
                /**/
            });
        });
    </script>
@endsection