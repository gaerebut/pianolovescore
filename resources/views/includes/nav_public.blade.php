<nav class="col-xm-12 navbar">
    <div class="navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="social">
                <a href="https://www.facebook.com/partitions.gratuites.piano" title="Partitions Gratuites de Piano sur Facebook" target="_blank">
                    <img src="{{ URL::to('/') }}/img/facebook.png" class="pull-left" alt="Facebook"/>
                </a>
                <a href="https://twitter.com/PartitionsPiano" title="Partitions Gratuites de Piano sur Twitter" target="_blank">
                    <img src="{{ URL::to('/') }}/img/twitter.png" class="pull-left" alt="Twitter"/>
                </a>
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
            <li class="lang">
                @if(App::getLocale() == 'en')
                    <img src="{{ URL::to('/') }}/img/flag_en.png" class="active pull-right" alt="Free Scores Piano"/>
                    <a href="{{ $alternate_route }}" class="pull-right" title="Partition Gratuites de Piano"><img src="{{ URL::to('/') }}/img/flag_fr.png" alt="Partitions Gratuites de Piano"/></a>
                @elseif(App::getLocale() == 'fr')
                    <a href="{{ $alternate_route }}" class="pull-right" title="Free Scores Piano"><img src="{{ URL::to('/') }}/img/flag_en.png" alt="Free Scores Piano"/></a>
                    <img src="{{ URL::to('/') }}/img/flag_fr.png" class="active pull-right" alt="Partitions Gratuites de Piano"/>
                @endif
            </li>
        </ul>
        <ul class="nav nav-pills nav-stacked nav-mobile">
            <li></li>
        </ul>
    </div>
</nav>