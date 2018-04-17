@extends('layouts.public')

@section('title')@lang('title.score_request')@endsection
@section('description')@lang('description.score_request')@endsection

@section('og_type')book @endsection
@section('og_title')@lang('title.score_request')@endsection
@section('og_description')@lang('description.score_request')@endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection
@section('meta')
    @parent
    @php $other_lang = App::getLocale() == 'fr' ? 'en' : 'fr'; @endphp
    <link rel="alternate" hreflang="{{ $other_lang }}" href="{{ route(__('routes.score_request', [], $other_lang))}}"/>
    <link rel="canonical" href="{{ route(__('routes.score_request'))}}" />
@endsection
@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <section class="scores__content">
        <div class="col-sm-offset-2 col-sm-8">
            @lang('messages.score_request.description')
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
            <form action="{{ route(__('routes.score_request_submit')) }}" method="post" class="form-horizontal request">
                <div class="form-group">
                    <label for="contact_lastname" class="col-sm-2 control-label">@lang('generic.lastname')</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="contact_lastname"  id="contact_lastname" value="{{ old('contact_lastname') }}" placeholder="Exemple : HEBERT" required />
                    </div>
                    <label for="contact_firstname" class="col-sm-2 control-label">@lang('generic.firstname')</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="contact_firstname"  id="contact_firstname" value="{{ old('contact_firstname') }}" placeholder="Exemple : Jean" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_email" class="col-sm-2 control-label">@lang('generic.email')</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="contact_email"  id="contact_email" value="{{ old('contact_email') }}" placeholder="Exemple : jean.hebert@hotmail.com" required /><i>@lang('messages.contact.response_email')</i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">@lang('messages.score_request.title')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title"  id="title" value="{{ old('title') }}" placeholder="Exemple : Prelude n°12 Opus 12" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="author" class="col-sm-2 control-label">@lang('messages.score_request.author')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="author" id="author" value="{{ old('author') }}" placeholder="Exemple : Frederic Chopin" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_message" class="col-sm-2 control-label">@lang('messages.score_request.comment')</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="contact_message"  id="contact_message" required >{{ old('contact_message') }}</textarea>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-sm-offset-4">
                        {!! NoCaptcha::display() !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2">
                        <button type="submit" class="btn btn-default">@lang('generic.send')</button>
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