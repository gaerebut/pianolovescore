<nav class="col-xs-12 navbar">
    <div class="navbar-collapse">
        <ul class="nav navbar-nav">
            <li>
                <a href="{{ route('home') }}">@lang('messages.nav_homepage')</a>
            </li>
            <li>
                <a href="{{ route(__('routes.scores')) }}">@lang('messages.nav_scores')</a>
            </li>
            <li>
                <a href="{{ route(__('routes.glossary')) }}">@lang('messages.nav_glossary')</a>
            </li>
            <li>
                <a href="{{ route(__('routes.tricks')) }}">@lang('messages.nav_tricks')</a>
            </li>
            <li>
                <a href="{{ route(__('routes.score_request')) }}">@lang('messages.nav_request_a_score')</a>
            </li>
            <li>
                <a href="{{ route('contact_us') }}">@lang('messages.nav_contact_us')</a>
            </li>
        </ul>
    </div>
</nav>