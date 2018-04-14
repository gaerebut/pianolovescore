@extends('layouts.public')

@section('title')@lang('title.trick', ['trick' => $trick])@endsection
@section('description')Astuce sur Partition Gratuite de Piano - {{ $trick }} - Découvrez des astuces sur le piano pour vous perfectionner et améliorer votre technique @endsection

@section('og_type')book @endsection
@section('og_title')Astuce de Piano - {{ $trick }} - Partition Gratuite de Piano @endsection
@section('og_description')Astuce sur Partition Gratuite de Piano - {{ $trick }}. Trouvez les partitions libres de droits en libre accès, notez-les, commentez-les et faites des découvertes @endsection
@section('og_image'){{ Request::url() }}{{ elixir('img/logo_full.png') }} @endsection

@section('css')
    @parent
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
@endsection
@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <?php \Carbon\Carbon::setLocale(config('app.locale')); ?>

    <section class="scores__content" itemscope="" itemtype="http://schema.org/Book">
        <div class="col-md-12">
            <div class="row tricks__title">
                <p class="pull-right">@lang('messages.tip.posted') <time itemprop="dateCreated" datetime="{{ $trick->created_at }}">{{ $trick->created_at->formatLocalized('%d/%m/%Y') }}</time></p>
                <h1 itemprop="name">{{ $trick }}</h1>
            </div>
        </div>
        <div class="col-md-12 tricks_introduction">
            <div class="row ">
                <h2><blockquote>{!! $trick->introduction !!}</blockquote></h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row tricks_description">
                <p>{!! $trick->description !!}</p>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#commentaires-astuce" aria-controls="commentsents-trick" role="tab" data-toggle="tab">@lang('messages.comment.comments')</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="commentaires-astuce">
                        <form class="reply_form" action="{{ route('ajax_comment') }}" onsubmit="return false">
                            <div class="form-group">
                                <input type="text" id="u" class="form-control" placeholder="@lang('messages.comment.your_nickname')" pattern=".{3,}" required />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="c" placeholder="@lang('messages.comment.your_comment')" pattern=".{3,}" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary reply_comment">@lang('messages.comment.post_comment')</button>
                            </div>
                        </form>
                        @if(count($trick->comments) > 0)
                            @foreach($trick->comments as $comment)
                                @include('public._comments', array('comment' => $comment))
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
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

            $('.scores__comment .reply').on('click', function(e)
            {
                e.preventDefault();

                var parent = $(this).parent();
                var commentForm = $(this).next();

                if(commentForm.hasClass('collapse'))
                {
                    commentForm.removeClass('collapse');
                    $(this).html("@lang('messages.comment.close')");
                }
                else
                {
                    commentForm.addClass('collapse');
                    $(this).html("@lang('messages.comment.reply')");
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
                        data: 'section=trick&trick_id={{ $trick->id }}'+parent_id_str+'&username='+$('#u', form).val()+'&comment=' + $('#c', form).val(),
                        success: function(data) {
                           if(data.success)
                           {
                                var parent_zone = parent_id_str == '' ? form.parent() : form.parents(':eq(1)');

                                parent_zone.append('<div class="scores__comment"><div id="'+data.id+'"><strong style="color:red">@lang("messages.comment.posted_wait")</strong><br /><strong>'+$('#u', form).val()+'</strong> - @lang("messages.comment.just_now")<div>'+$('#c', form).val()+'</div>');
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