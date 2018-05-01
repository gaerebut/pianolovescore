<nav class="col-xs-12 navbar">
    <div class="navbar-collapse">
        <ul class="nav navbar-nav">
            <li>
                <a href="{{ route(__('routes.home')) }}">@lang('nav.homepage')</a>
            </li>
            <li>
                <a href="{{ route(__('routes.scores')) }}">@lang('nav.scores')</a>
            </li>
            <li>
                <a href="{{ route(__('routes.glossary')) }}">@lang('nav.glossary')</a>
            </li>
            <li>
                <a href="{{ route(__('routes.tricks')) }}">@lang('nav.tricks')</a>
            </li>
            <li>
                <a href="{{ route(__('routes.score_request')) }}">@lang('nav.request_a_score')</a>
            </li>
            <li>
                <a href="{{ route('contact_us') }}">@lang('nav.contact_us')</a>
            </li>
            <li class="lang">
                @if(App::getLocale() == 'en')
                    <img src="{{ URL::to('/') }}/img/flag_en.png" class="active pull-right"/>
                    <a href="{{ $alternate_route }}" class="pull-right"><img src="{{ URL::to('/') }}/img/flag_fr.png"/></a>
                @elseif(App::getLocale() == 'fr')
                    <a href="{{ $alternate_route }}" class="pull-right"><img src="{{ URL::to('/') }}/img/flag_en.png"/></a>
                    <img src="{{ URL::to('/') }}/img/flag_fr.png" class="active pull-right"/>
                @endif
            </li>
        </ul>
    </div>
</nav>