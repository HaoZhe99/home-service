<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('merchant_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/categories*") ? "menu-open" : "" }} {{ request()->is("admin/merchants*") ? "menu-open" : "" }} {{ request()->is("admin/packages*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-industry">

                            </i>
                            <p>
                                {{ trans('cruds.merchantManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.categories.index") }}" class="nav-link {{ request()->is("admin/categories") || request()->is("admin/categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cog">

                                        </i>
                                        <p>
                                            {{ trans('cruds.category.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('merchant_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.merchants.index") }}" class="nav-link {{ request()->is("admin/merchants") || request()->is("admin/merchants/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-home">

                                        </i>
                                        <p>
                                            {{ trans('cruds.merchant.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('package_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.packages.index") }}" class="nav-link {{ request()->is("admin/packages") || request()->is("admin/packages/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.package.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('address_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/countries*") ? "menu-open" : "" }} {{ request()->is("admin/states*") ? "menu-open" : "" }} {{ request()->is("admin/addresses*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-map-marked-alt">

                            </i>
                            <p>
                                {{ trans('cruds.addressManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('country_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.countries.index") }}" class="nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-globe-africa">

                                        </i>
                                        <p>
                                            {{ trans('cruds.country.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('state_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.states.index") }}" class="nav-link {{ request()->is("admin/states") || request()->is("admin/states/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-location-arrow">

                                        </i>
                                        <p>
                                            {{ trans('cruds.state.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('address_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.addresses.index") }}" class="nav-link {{ request()->is("admin/addresses") || request()->is("admin/addresses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-map-marker-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.address.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('servier_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/servicers*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-user-tag">

                            </i>
                            <p>
                                {{ trans('cruds.servierManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('servicer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.servicers.index") }}" class="nav-link {{ request()->is("admin/servicers") || request()->is("admin/servicers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.servicer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('oder_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/orders*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-file-invoice">

                            </i>
                            <p>
                                {{ trans('cruds.oderManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('order_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.orders.index") }}" class="nav-link {{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-receipt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.order.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('card_management_access')
                <li class="nav-item has-treeview {{ request()->is("admin/cards*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-credit-card">

                        </i>
                        <p>
                            {{ trans('cruds.cardManagement.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('card_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.cards.index") }}" class="nav-link {{ request()->is("admin/cards") || request()->is("admin/cards/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-credit-card">

                                    </i>
                                    <p>
                                        {{ trans('cruds.card.title') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
                @can('e_billing_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/ebillings*") ? "menu-open" : "" }} {{ request()->is("admin/payment-methods*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-money-bill-alt">

                            </i>
                            <p>
                                {{ trans('cruds.eBillingManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('ebilling_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.ebillings.index") }}" class="nav-link {{ request()->is("admin/ebillings") || request()->is("admin/ebillings/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-money-bill-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.ebilling.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('payment_method_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.payment-methods.index") }}" class="nav-link {{ request()->is("admin/payment-methods") || request()->is("admin/payment-methods/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-wallet">

                                        </i>
                                        <p>
                                            {{ trans('cruds.paymentMethod.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                {{-- @can('qr_code_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/qr-codes*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-qrcode">

                            </i>
                            <p>
                                {{ trans('cruds.qrCodeManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('qr_code_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.qr-codes.index") }}" class="nav-link {{ request()->is("admin/qr-codes") || request()->is("admin/qr-codes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-qrcode">

                                        </i>
                                        <p>
                                            {{ trans('cruds.qrCode.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan --}}
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>