@extends('layouts.common')

@section('css')
    @parent
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
@endsection

@section('js')
    @parent
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>
@endsection

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <section class="scores__content">
        <div class="col-md-offset-4 col-md-8">
            <div class="row scores__title">
                <h1>{{ $score->title }}</h1><h2><a href="#">{{ $score->author->lastname }}</a></h2>
            </div>
        </div>
        <div class="row border-left-0 border-right-0 border-top-0">
            <div class="col-md-4">
                <a data-fancybox="gallery" href="{{ $score->score_image }}">
                    <img src="{{ $score->score_image }}" class="scores__icon">
                </a>
            </div>
            <div class="col-md-8 scores__infos">
                <div class="row">
                    <h4>Quelle difficulté attribuez-vous à cette <strong>partition de piano</strong> ?</h4>
                </div>
                <div class="row stars">
                    <form action="#">
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
                </div>
                <div class="row">
                    <div class="col-xs-offset-4 col-xs-4 col-md-offset-0 col-md-3">
                        <h4><strong>Télécharger gratuitement</strong></h4>
                        <a href="{{ $score->score_url }}">
                            <img src="{{ URL::to('/') }}/img/pdf_download.png" class="scores__download"/>
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-9 scores__audio">
                        <h4>Ecoutez ci-dessous <strong>{{ $score->title }}</strong> de <strong>{{ $score->author->lastname }}</strong></h4>
                        <audio controls="controls" preload="metadata" controlsList="nodownload">
                            <source src="{{ $score->score_sound_url }}" type="audio/{{ $score->score_sound_format }}" />
                            Votre navigateur n'est pas compatible
                        </audio>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="scores__alike">
        <div class="row">
            <div class="col-xs-12">
                <h2>Partitions gratuites que vous aimerez également</h2>
            </div>
        </div>
        <table class="table">
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
        <div class="row">
            <div class="col-xs-12">
                <h2>Autres partitions gratuites de Chopin</h2>
            </div>
        </div>
        <table class="table">
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
@endsection

@section('js_code')
<script type="text/javascript">
    $(function(){
        $('[type*="radio"]').change(function () {
            console.log( $(this).attr('value') );
        });
    });
</script>
@endsection