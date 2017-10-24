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
        <div class="col-md-offset-5 col-md-8">
            <div class="row scores__title">
                <h1>Etude n°2 op n°34</h1><h2><a href="#">Chopin</a></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a data-fancybox="gallery" href="http://cdn.imslp.org/images/thumb/pdfs/e9/aa5eb550e430c18e8c8b7b354f6915bbd9e065e7.png">
                    <img src="http://cdn.imslp.org/images/thumb/pdfs/e9/aa5eb550e430c18e8c8b7b354f6915bbd9e065e7.png" class="scores__icon">
                </a>
            </div>
            <div class="col-md-8">
                <div class="row text-center">
                    <h4>Quelle difficulté attribuez-vous à cette partition ?</h4>
                </div>
                <div class="row stars text-center">
                    <form action="">
                        <input class="star star-5" id="star-5" type="radio" name="star"/>
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" type="radio" name="star"/>
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" type="radio" name="star"/>
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" type="radio" name="star"/>
                        <label class="star star-2" for="star-2"></label>
                        <input class="star star-1" id="star-1" type="radio" name="star"/>
                        <label class="star star-1" for="star-1"></label>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="scores__alike"></section>
    <section class="scores__composer"></section>
@endsection

@section('js_code')
<script type="text/javascript">
/*
    $(function()){
        $('[type*="radio"]').change(function () {
            var me = $(this);
            log.html(me.attr('value'));
        });
    }
*/
</script>
@endsection