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
                <h1>Etude n°2 op n°34</h1><h2><a href="#">Chopin</a></h2>
            </div>
        </div>
        <div class="row border-left-0 border-right-0 border-top-0">
            <div class="col-md-4">
                <a data-fancybox="gallery" href="http://cdn.imslp.org/images/thumb/pdfs/e9/aa5eb550e430c18e8c8b7b354f6915bbd9e065e7.png">
                    <img src="http://cdn.imslp.org/images/thumb/pdfs/e9/aa5eb550e430c18e8c8b7b354f6915bbd9e065e7.png" class="scores__icon">
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
                        <a href="#">
                            <img src="{{ URL::to('/') }}/img/pdf_download.png" class="scores__download"/>
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-9 scores__audio">
                        <h4>Ecoutez ci-dessous <strong>Etude n°2 op n°34</strong> de <strong>Chopin</strong></h4>
                        <audio controls="controls" preload="metadata" controlsList="nodownload">
                            <!--<source src="music.mp3" type="audio/mp3" />
                            <source src="music.aac" type="audio/aac" />-->
                            <source src="http://ks.imslp.info/files/imglnks/usimg/7/73/IMSLP113795-PMLP01649-Chopin-Ballade-Fminor-Seitzer.ogg" type="audio/ogg" />
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
        <div class="row">
            <div class="col-sm-5 col-md-7">
                <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
            </div>
            <div class="col-xs-7 col-sm-4 col-md-3">
                de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
            </div>
            <div class="col-xs-5 col-sm-2">
                <div class="star-ratings-css">
                    <div class="top" style="width: 50%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-7">
                <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
            </div>
            <div class="col-xs-7 col-sm-4 col-md-3">
                de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
            </div>
            <div class="col-xs-5 col-sm-2">
                <div class="star-ratings-css">
                    <div class="top" style="width: 50%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-7">
                <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
            </div>
            <div class="col-xs-7 col-sm-4 col-md-3">
                de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
            </div>
            <div class="col-xs-5 col-sm-2">
                <div class="star-ratings-css">
                    <div class="top" style="width: 50%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-7">
                <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
            </div>
            <div class="col-xs-7 col-sm-4 col-md-3">
                de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
            </div>
            <div class="col-xs-5 col-sm-2">
                <div class="star-ratings-css">
                    <div class="top" style="width: 50%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-7">
                <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
            </div>
            <div class="col-xs-7 col-sm-4 col-md-3">
                de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
            </div>
            <div class="col-xs-5 col-sm-2">
                <div class="star-ratings-css">
                    <div class="top" style="width: 50%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="scores__composer">
        <div class="row">
            <div class="col-xs-12">
                <h2>Autres partitions gratuites de Chopin</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-7">
                <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
            </div>
            <div class="col-xs-7 col-sm-4 col-md-3">
                de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
            </div>
            <div class="col-xs-5 col-sm-2">
                <div class="star-ratings-css">
                    <div class="top" style="width: 50%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-7">
                <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
            </div>
            <div class="col-xs-7 col-sm-4 col-md-3">
                de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
            </div>
            <div class="col-xs-5 col-sm-2">
                <div class="star-ratings-css">
                    <div class="top" style="width: 50%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-7">
                <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
            </div>
            <div class="col-xs-7 col-sm-4 col-md-3">
                de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
            </div>
            <div class="col-xs-5 col-sm-2">
                <div class="star-ratings-css">
                    <div class="top" style="width: 50%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-7">
                <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
            </div>
            <div class="col-xs-7 col-sm-4 col-md-3">
                de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
            </div>
            <div class="col-xs-5 col-sm-2">
                <div class="star-ratings-css">
                    <div class="top" style="width: 50%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-7">
                <a href="/partitions/chopin/etude_n_2_op_34">Titre de la partition BLABLABLAB BAL BLA BLA BLAB LA BLAB LAB L</a>
            </div>
            <div class="col-xs-7 col-sm-4 col-md-3">
                de <a href="/partitions/chopin/etude_n_2_op_34">Auteur NOM PRENOM</a>
            </div>
            <div class="col-xs-5 col-sm-2">
                <div class="star-ratings-css">
                    <div class="top" style="width: 50%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>
            </div>
        </div>
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