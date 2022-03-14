<nav class="user-menu-widget mt-0 navbar-expand-lg navbar-light bg-white">
    <div class="d-flex justify-content-end">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="user-menu">
            <li class="sidebar-menu-item {{ menuActive('user.home') }}">
                <a href="{{ route('user.home') }}"><i class="las la-layer-group"></i>
                    <span>@lang('Dashboard')</span></a>
            </li>
            <li class="sidebar-menu-item {{ menuActive('user.post.create') }}">
                <a href="{{ route('user.post.create') }}"><i class="las la-plus-circle"></i>
                    <span>@lang('Create Post')</span></a>
            </li>
            <li class="sidebar-menu-item {{ menuActive('user.purchase.point.form') }}">
                <a href="{{ route('user.purchase.point.form') }}"><i class="las la-money-check-alt"></i>
                    <span>@lang('Purchase Point') </span></a>
            </li>
            <li class="sidebar-menu-item {{ menuActive('user.convert.point') }}">
                <a href="{{ route('user.convert.point') }}"><i class="las la-money-bill"></i>
                    <span>@lang('Convert to Balance') </span></a>
            </li>
            <li class="sidebar-menu-item {{ menuActive('user.deposit') }}">
                <a href="{{ route('user.deposit') }}"><i class="las la-sort-numeric-up"></i>
                    <span>@lang('Deposit') </span></a>
            </li>
            <li class="sidebar-menu-item {{ menuActive('user.deposit.history') }}">
                <a href="{{ route('user.deposit.history') }}"><i class="las la-wallet"></i>
                    <span>@lang('Deposit Log') </span></a>
            </li>
            <li class="sidebar-menu-item {{ menuActive('user.withdraw') }}">
                <a href="{{ route('user.withdraw') }}"><i class="las la-sort-numeric-down"></i>
                    <span>@lang('Withdraw') </span></a>
            </li>

            <li class="sidebar-menu-item {{ menuActive('user.withdraw.history') }}">
                <a href="{{ route('user.withdraw.history') }}"><i class="las la-history"></i>
                    <span>@lang('Withdraw Log') </span></a>
            </li>
            <li class="sidebar-menu-item {{ menuActive('ticket') }}">
                <a href="{{ route('ticket') }}"><i class="las la-ticket-alt"></i>
                    <span>@lang('Ticket') </span></a>
            </li>
            <li class="sidebar-menu-item {{ menuActive('user.profile.view') }}"><a class=""
                    href="{{ route('user.profile.view') }}"><i class="las la-user"></i>@lang('Profile')</a></li>

            <li class="sidebar-menu-item {{ menuActive('user.profile.setting') }}">
                <a class="" href="{{ route('user.profile.setting') }}">
                    <i class="las la-tools"></i> <span>@lang('Settings')</span></a>
            </li>
            <li class="sidebar-menu-item {{ menuActive('user.change.password') }}">
                <a class="" href="{{ route('user.change.password') }}">
                    <i class="las la-key"></i> <span>@lang('Change Password')</span></a>
            </li>
            <li class="sidebar-menu-item {{ menuActive('user.twofactor') }}">
                <a class="" href="{{ route('user.twofactor') }}">
                    <i class="las la-lock"></i> <span>@lang('2FA Security')</span></a>
            </li>
            <li>
                <a class="" href="{{ route('user.logout') }}">
                    <i class="las la-sign-out-alt"></i> <span>@lang('Logout')</span></a>
            </li>
        </ul>
    </div>
</nav>
