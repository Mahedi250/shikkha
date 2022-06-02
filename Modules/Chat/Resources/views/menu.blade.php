<li>
    <a href="#subMenuChat" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <span class="flaticon-test"></span>
        @lang('lang.chat')
    </a>
    <ul class="collapse list-unstyled" id="subMenuChat">
        @if(userPermission(901) || userPermission(911))
        <li>
            <a href="{{ route('chat.index') }}">@lang('lang.chat') @lang('lang.box')</a>
        </li>
        @endif

        @if(userPermission(903) || userPermission(913))
        <li>
            <a href="{{ route('chat.invitation') }}">@lang('lang.invitation')</a>
        </li>
        @endif

        @if(userPermission(904) || userPermission(914))
            <li>
                <a href="{{ route('chat.blocked.users') }}">@lang('lang.blocked') @lang('lang.user')</a>
            </li>
        @endif

        @if(userPermission(905))
            <li>
                <a href="{{ route('chat.settings') }}">@lang('lang.settings')</a>
            </li>
        @endif
    </ul>
</li>
