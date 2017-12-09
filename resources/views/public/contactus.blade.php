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
            <p>Remplissez le formulaire ci-dessous pour contacter l'équipe</p>
            <p>Une réponse vous sera apportée par email dans les plus brefs délais</p>
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
                    <h4>Votre message à bien été envoyé.</h4>
                    <h4>Une réponse vous sera apportée par email</h4>
                </div>
            @endif
            <form action="{{ route('contactus_submit') }}" method="post" class="form-horizontal request">
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
                        <input type="email" class="form-control" name="contact_email"  id="contact_email" value="{{ old('contact_email') }}" placeholder="Exemple : jean.hebert@hotmail.com" required /><i>Une réponse vous sera apportée par email.</i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject" class="col-sm-2 control-label">Objet de votre demande</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="subject"  id="subject" value="{{ old('subject') }}" placeholder="Exemple : Amélioration / Bug / Problème / Question ..." required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="message" class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="message" id="message" rows="4" required>{{ !empty(old('message'))?old('message'):'Bonjour,' }}</textarea>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-sm-offset-4">
                        {!! NoCaptcha::display() !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2">
                        <button type="submit" class="btn btn-default">Envoyer le message</button>
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