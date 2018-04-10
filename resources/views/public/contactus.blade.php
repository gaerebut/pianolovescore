@extends('layouts.public')

@section('title')@lang('title.contact_us')@endsection
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
            @lang('messages.contact.page_description')
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
                    @lang('messages.contact.sent')
                </div>
            @endif
            <form action="{{ route('contact_us_submit') }}" method="post" class="form-horizontal request">
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
                    <label for="subject" class="col-sm-2 control-label">@lang('generic.object')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="subject"  id="subject" value="{{ old('subject') }}" placeholder="@lang('messages.contact.object_sample')" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="message" class="col-sm-2 control-label">@lang('generic.message')</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="message" id="message" rows="4" required>{{ !empty(old('message'))?old('message'):__('messages.contact.hello') }}</textarea>
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