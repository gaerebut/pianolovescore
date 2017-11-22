@extends('layouts.public')

@section('title')Demande de partition gratuite sur Piano Love Score @endsection
@section('description')Demandez une partition gratuite de piano que vous cherchez et un administrateur vous la postera en ligne @endsection

@section('og_type')book @endsection
@section('og_title')Demandez une partition gratuite de piano @endsection
@section('og_description')Vous recherchez une partition gratuite de piano ? Demandez-la et nous vous la mettrons à disposition. @endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <section class="scores__content">
        <div class="col-sm-offset-2 col-sm-8">
            <p>Vous ne trouvez pas votre <strong>partition de piano</strong> sur PianoLoveScore ?</p>
            <p>Demandez-la !</p>
            <p>Rentrez toutes les informations pour la décrire et nous nous efforcerons de vous le proposer <strong>gratuitement</strong></p>
            <p>ATTENTION: seules les <strong>partitions légales et libres de droits</strong> se verront publiées.</p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(!empty($sent) && $sent==true)
                <div class="alert alert-success">
                    <h3>Merci !</h3>
                    <h4>Votre demande de partition à bien été envoyée.</h4>
                    <h4>Un email vous sera envoyé quand elle sera traitée</h4>
                </div>
            @endif
            <form action="{{ route('score_request_submit') }}" method="post" class="form-horizontal request">
                <div class="form-group">
                    <label for="contact_lastname" class="col-sm-2 control-label">Nom</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="contact_lastname"  id="contact_lastname" value="{{ old('contact_lastname') }}" placeholder="Exemple : HEBERT" required />
                    </div>
                    <label for="contact_firstname" class="col-sm-2 control-label">Prénom</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="contact_firstname"  id="contact_firstname" value="{{ old('contact_firstname') }}" placeholder="Exemple : Jean" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="contact_email"  id="contact_email" value="{{ old('contact_email') }}" placeholder="Exemple : jean.hebert@siteweb.com" required /><i>Vous serez informé par email lorsque votre demande sera traitée.</i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Titre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title"  id="title" value="{{ old('title') }}" placeholder="Exemple : Prelude n°12 Opus 12" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="author" class="col-sm-2 control-label">Auteur</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="author" id="author" value="{{ old('author') }}" placeholder="Exemple : Frederic Chopin" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_message" class="col-sm-2 control-label">Commentaire (optionnel)</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="contact_message"  id="contact_message" value="{{ old('contact_message') }}" required /></textarea>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-sm-offset-4">
                        {!! NoCaptcha::display() !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2">
                        <button type="submit" class="btn btn-default">Envoyer la demande</button>
                    </div>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </section>
@endsection
@section('js_code')
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    {!! NoCaptcha::renderJs() !!}
    <script type="text/javascript">
        $(function(){
            $('.request').on('submit', function(){
                if( grecaptcha.getResponse().length > 0){
                    $(this).submit();
                }
                else
                {
                    alert('Merci de vérifier que vous ne soyez pas un robot');
                    return false;
                }
            });
        })
    </script>
@endsection