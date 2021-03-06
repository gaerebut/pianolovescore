@extends('layouts.public')

@section('title')@lang('title.score', ['title' => $score->title, 'author' => $score->author])@endsection
@section('description')@lang('description.score', ['title' => $score->title, 'author' => $score->author, 'description' => str_limit(strip_tags($score->description), 175)]) @endsection

@section('og_type')book @endsection
@section('og_title')@lang('title.score', ['title' => $score->title, 'author' => $score->author])@endsection
@section('og_description')@lang('description.score', ['title' => $score->title, 'author' => $score->author])@endsection
@section('og_image'){{ $score->score_image }} @endsection
@section('meta')
    @parent
    @php
        $other_lang = App::getLocale() == 'fr' ? 'en' : 'fr';
        $alternate_route = route(__('routes.score', [], $other_lang), ['slug_author' => $score->author->slug, 'slug_score' => $score->slug]);
    @endphp
    <link rel="alternate" hreflang="{{ $other_lang }}" href="{{ $alternate_route }}"/>
    <link rel="canonical" href="{{ route(__('routes.score'), ['slug_author' => $score->author->slug, 'slug_score' => $score->slug])}}" />
@endsection
@section('css')
    @parent
    <link rel="preload" as="style" onload="this.rel = 'stylesheet'" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css">
    <link rel="preload" as="style" onload="this.rel = 'stylesheet'" href="//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!--<link rel="preload" as="style" onload="this.rel = 'stylesheet'" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">-->
@endsection
@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
    <?php
    \Carbon\Carbon::setLocale(config('app.locale'));

    $difficulties = [
        1 => ['title' => __('generic.very_easy_2'), 'class' => 'info'],
        2 => ['title' => __('generic.easy_2'), 'class' => 'primary'],
        3 => ['title' => __('generic.intermediate_2'), 'class' => 'success'],
        4 => ['title' => __('generic.hard_2'), 'class' => 'warning'],
        5 => ['title' => __('generic.very_hard_2'), 'class' => 'danger']
    ];
    ?>
<<<<<<< HEAD
    <section class="scores__content" itemscope itemtype="http://schema.org/SheetMusic">
=======
    <section class="scores__content" itemscope="" itemtype="//schema.org/Book">
>>>>>>> a11367f17b57c4f787b5a3181426d4e10427663a
        <div class="col-md-offset-4 col-md-8">
            <div class="row scores__title">
                <div class="row text-right">
                    <div class="col-md-12">@lang('messages.score.posted_on') <time itemprop="dateCreated" datetime="{{ $score->created_at }}">{{ $score->created_at->formatLocalized('%d/%m/%Y') }}</time></div>
                </div>
<<<<<<< HEAD
                <h1 itemprop="name">{{ $score->title }}</h1><h2><a href="{{ route(__('routes.author_scores'), ['slug_author'=>$score->author->slug]) }}" itemprop="author" itemscope itemtype="//schema.org/Person"><meta itemprop="knowsAbout" content="{{ route(__('routes.author_scores'), ['slug_author'=>$score->author->slug]) }}"/><meta itemprop="name" content="{{ $score->author->fullname }}"/>{{ $score->author->fullname }}</a></h2>
=======
                <h1 itemprop="name">{{ $score->title }}</h1><h2><a href="{{ route(__('routes.author_scores'), ['slug_author'=>$score->author->slug]) }}" itemprop="author" itemscope itemtype="//schema.org/Person" itemid="#author"><meta itemprop="name" content="{{ $score->author->fullname }}"/>{{ $score->author->fullname }}</a></h2>
>>>>>>> a11367f17b57c4f787b5a3181426d4e10427663a
                <p class="difficulty">
                    @if($score->difficulty==1)
                        <span class="label label-info active">@lang('generic.sheet_very_easy')</span>
                    @else
                        <a href="{{ route(__('routes.scores_difficulty'), ['difficulty'=>__('generic.sheet_very_easy_href')]) }}" title="@lang('generic.sheet_very_easy_title')" class="label label-info">@lang('generic.sheet_very_easy')</a>
                    @endif
                    @if($score->difficulty==2)
                        <span class="label label-primary active">@lang('generic.sheet_easy')</span>
                    @else
                        <a href="{{ route(__('routes.scores_difficulty'), ['difficulty'=>__('generic.sheet_easy_href')]) }}" title="@lang('generic.sheet_easy_title')" class="label label-primary">@lang('generic.sheet_easy')</a>
                    @endif
                    @if($score->difficulty==3)
                        <span class="label label-success active">@lang('generic.sheet_intermediate')</span>
                    @else
                        <a href="{{ route(__('routes.scores_difficulty'), ['difficulty'=>__('generic.sheet_intermediate_href')]) }}" title="@lang('generic.sheet_intermediate_title')" class="label label-success">@lang('generic.sheet_intermediate')</a>
                    @endif
                    @if($score->difficulty==4)
                        <span class="label label-warning active">@lang('generic.sheet_hard')</span>
                    @else
                        <a href="{{ route(__('routes.scores_difficulty'), ['difficulty'=>__('generic.sheet_hard_href')]) }}" title="@lang('generic.sheet_hard_title')" class="label label-warning">@lang('generic.sheet_hard')</a>
                    @endif
                    @if($score->difficulty==5)
                        <span class="label label-danger active">@lang('generic.sheet_very_hard')</span>
                    @else
                        <a href="{{ route(__('routes.scores_difficulty'), ['difficulty'=>__('generic.sheet_very_hard_href')]) }}" title="@lang('generic.sheet_very_hard_title')" class="label label-danger">@lang('generic.sheet_very_hard')</a>
                    @endif
                </p>
            </div>
        </div>
        <div class="row border-left-0 border-right-0 border-top-0">
            <div class="col-md-4 text-center">
                <a data-fancybox="gallery" href="{{ URL::to('/') }}/img/scores/{{ $score->score_image }}">
                    <img src="{{ URL::to('/') }}/img/scores/{{ $score->score_image }}" class="scores__icon" itemprop="image" alt="{{ $score->title }} @lang('generic.by') {{ $score->author }}" title="@lang('messages.score.free_sheet') {{ $score->title }} @lang('generic.by') {{ $score->author }}">
                    <meta itemprop="thumbnailUrl" content="{{ URL::to('/') }}/img/scores/{{ $score->score_image }}"/>
                </a>
                <h6><strong>@lang('messages.score.enlarge_image')</strong></h6>
            </div>
            <div class="col-md-8 scores__infos">
                <div class="row text-left">
                    <p itemprop="description">{!! $score->description !!}</p>
                    <p>@lang('messages.score.nb_pages') {{ $score->nb_pages }} {{ str_plural('page', $score->nb_pages) }}</h6>
                </div>
                <div class="row">
                    <div class="col-xs-offset-4 col-xs-4 col-md-offset-1 col-md-3">
                        <h4><strong>@lang('messages.score.free_download')</strong></h4>
                        <a href="{{ route(__('routes.score_download'), ['slug' => $score->slug]) }}" title="@lang('messages.score.download_free_sheet') {{ $score->title }} @lang('generic.by') {{ $score->author }}">
                            <img src="{{ URL::to('/') }}/img/pdf_download.png" class="scores__download" alt="@lang('messages.score.download_free_sheet') {{ $score->title }} @lang('generic.by') {{ $score->author }}" title="@lang('messages.score.download_free_sheet') {{ $score->title }} {{ $score->author }}""/>
                        </a>
                        <h6><strong>{{ $score->downloaded . ' ' . str_plural(__('generic.download'), $score->downloaded|1
                        )}}</strong></h6>
                    </div>
<<<<<<< HEAD
                    <div class="col-xs-12 col-md-8">
=======
                    <div class="col-xs-12 col-md-8" @if($score->count_votes > 0)itemprop="aggregateRating" itemscope itemtype="//schema.org/AggregateRating" @endif >
>>>>>>> a11367f17b57c4f787b5a3181426d4e10427663a
                        @if(!$user_already_vote)
                            <h5>@lang('messages.score.rate')</h5>
                        @else
                            <h5>@lang('messages.score.already_rate')</h5>
                        @endif
                        <div class="stars" @if($score->count_votes > 0)itemprop="aggregateRating" itemscope itemtype="//schema.org/aggregateRating" @endif>
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
                                <h3 class="scores__rating__thanks">@lang('messages.score.thanks_rate')</h3>
                            @endif
                            @if($score->count_votes > 0)
                                <meta itemprop="worstRating" content = "1">
                            @endif
                            <div class="scores__rating__result">{{ ucfirst(__('generic.average')) }} : <strong class="avg_votes" @if($score->count_votes > 0)itemprop="ratingValue" @endif><?php echo round($score->avg_votes/20, 2); ?></strong>/<span @if($score->count_votes > 0)itemprop="bestRating" @endif>5</span> (<strong class="count_votes" @if($score->count_votes > 0)itemprop="reviewCount" @endif>{{ $score->count_votes }}</strong> votes)</div>
                        </div>
                        @if(!is_null($score->score_sound_url))
                            <div class="scores__audio" itemprop="associatedMedia" itemscope itemtype="//schema.org/MediaObject">
                                <h4>@lang('messages.score.listen') <strong>{{ $score->title }}</strong> @lang('generic.by') <strong>{{ $score->author->lastname }}</strong></h4>
                                <audio controls="controls" preload="metadata" controlsList="nodownload" >
                                    <source src="{{ $score->score_sound_url }}" type="audio/{{ $score->score_sound_format }}" />
                                    <meta itemprop="encodingFormat" content="audio/{{ $score->score_sound_format }}" />
                                    <meta itemprop="embedUrl" content="{{ $score->score_sound_url }}" />
                                    @lang('generic.browser_compatible')
                                </audio>
                            </div>
                        @endif
                    </div>
                </div>
                @if(count($score->keywords) > 1)
                    <div class="row scores__keywords text-left">
                        <h4>@lang('messages.score.associated_researches') : <strong><mark>
                            @foreach($score->keywords as $keyword)
                                <a href="{{ route(__('routes.search'), ['q' => $keyword->keyword]) }}">#{{ $keyword }}</a>
                            @endforeach
                        </mark></strong></h4>
                    </div>
                @endif
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Score2 -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-0114331985290768"
                 data-ad-slot="7224768306"
                 data-ad-format="auto"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            </div>
        </div>
        @if(!empty($scores_similar))
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <td colspan="4">
                                    <h3 class="homesection__title">@lang('messages.score.scores_similar')</h3>
                                </td>
                            </tr>
                        </thead>
                        <tbody class="homesection__content">
                            @foreach($scores_similar as $other_score)
                                <tr>
                                    <td width="5%">
                                        <span class="label label-{{ $difficulties[$other_score->difficulty]['class'] }}">{{ $difficulties[$other_score->difficulty]['title'] }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route( __('routes.score') , ['slug_author'=>$other_score->author->slug, 'slug_score'=>$other_score->slug])}}" title="@lang('generic.score_of_author', ['score' => $other_score->title, 'author' => $other_score->author->fullname])">{{ $other_score->title }}</a>
                                    </td>
                                    <td class="star-rating">
                                        @if(!is_null($other_score->avg_votes))
                                            <div class="star-ratings-css">
                                                <div class="top" style="width: {{ $other_score->avg_votes }}%">
                                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                </div>
                                                <div class="bottom">
                                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="scores__listing_downloaded">
<<<<<<< HEAD
                                        <img src="{{ URL::to('/') }}/img/pdf_download.png" alt="@lang('messages.score.download_free_sheet') - PDF"/><strong>{{ $other_score->downloaded . ' ' . str_plural(__('generic.time'), $other_score->downloaded|1) }}</strong>
=======
                                        <img src="{{ URL::to('/') }}/img/pdf_download.png" /><strong>{{ $other_score->downloaded . ' ' . str_plural(__('generic.time'), $other_score->downloaded|1) }}</strong>
>>>>>>> a11367f17b57c4f787b5a3181426d4e10427663a
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="card">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#sheet-comments" aria-controls="commentsents-score" role="tab" data-toggle="tab">@lang('messages.comment.comments')</a></li>
                    @if(!is_null($score->youtube_playlist_id))
                        <li role="presentation" @if(count($score->comments)==0) class="active" @endif ><a href="#videos-piano" aria-controls="videos-piano" role="tab" data-toggle="tab">@lang('messages.comment.your_videos')</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="sheet-comments">
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
@endsection
@section('js_code')
    @parent
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
                    $(this).html('@lang("messages.comment.reply")');
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
                        data: 'section=score&score_id={{ $score->id }}'+parent_id_str+'&username='+$('#u', form).val()+'&comment=' + $('#c', form).val(),
                        success: function(data) {
                           if(data.success)
                           {
                                var parent_zone = parent_id_str == '' ? form.parent() : form.parents(':eq(1)');

                                parent_zone.append("<div class=\"scores__comment\"><div id=\""+data.id+"\"><strong style=\"color:red\">@lang('messages.comment.posted_wait')</strong><br /><strong>"+$('#u', form).val()+"</strong> - @lang('messages.comment.just_now')<div>"+$('#c', form).val()+"</div>");
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