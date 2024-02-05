<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" style="width:150px;" src="{{asset('/images/sanad logo 2-05.png')}}" alt="User Image">
    </div>

    <ul class="app-menu">

        {{--admins--}}
        <li><a class="app-menu__item " href="{{route('overview')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">{{ trans('admin.overview') }}</span></a></li>
        <li><a class="app-menu__item " href="{{route('admins.index')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">{{ trans('admin.Admins') }}</span></a></li>
        <li><a class="app-menu__item " href="{{route('users.index')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">{{ trans('admin.Users') }}</span></a></li>
        <li><a class="app-menu__item " href="{{route('properties.index')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">{{ trans('admin.props') }}  </span></a></li>
        <li><a class="app-menu__item " href="{{route('accounts.index')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">{{ trans('admin.accounts') }}</span></a></li>
    <li class="treeview is-expanded"><a class="app-menu__item" href="{{route('settings.index')}}" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">{{ trans('admin.settings') }}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">


              <li><a class="treeview-item" href="{{route('settings.EditSetting','contact_us')}}">
                <i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">
                      {{ trans('admin.contact') }}</a></li>
               <li><a class="treeview-item" href="{{route('settings.EditSetting','about_us')}}">
                <i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">
                       {{ trans('admin.about') }}</a></li>
               <li><a class="treeview-item" href="{{route('settings.index')}}">
                <i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">
                       {{ trans('admin.FAQ') }}</a></li>
            </ul>
          </li>
        <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">{{ trans('admin.Transaction') }}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('transactions.index')}}">
                        <i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">
                        {{trans('admin.balanced') }}</a></li>
                <li><a class="treeview-item" href="{{route('withdraw.index')}}">
                        <i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">
                        {{ trans('admin.withdraw') }}</a></li>
                <li><a class="treeview-item" href="{{route('refund.index')}}">
                        <i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">
                        {{ trans('admin.refunds') }}</a></li>
                <li><a class="treeview-item" href="{{route('sell.index')}}">
                        <i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">
                        {{ trans('admin.sell') }}</a></li>

                <li><a class="treeview-item" href="{{route('prop.index')}}">
                        <i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">
                        {{ trans('admin.prop_account') }}</a></li>

            </ul>
        </li>

        <li><a class="app-menu__item " href="{{route('investments.index')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">     {{ trans('admin.invested') }}</span></a></li>

        <li><a class="app-menu__item " href="{{route('accounts_admin.index')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">     {{ trans('admin.account_admin') }}</span></a></li>

        <li><a class="app-menu__item " href="{{route('payment.index')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">     {{ trans('admin.payment') }}</span></a></li>
        <li><a class="app-menu__item " href="{{route('image.index')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">     {{ trans('admin.banners') }}</span></a></li>

        <li><a class="app-menu__item " href="{{route('person.index')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">      {{ trans('admin.person') }}</span></a></li>

        <li><a class="app-menu__item " href="{{route('showtosell')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">     {{ trans('admin.make_invest') }}</span></a></li>
        <li><a class="app-menu__item " href="{{route('all-notifications')}}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">      {{ trans('admin.notifications') }}</span></a></li>

    </ul>
</aside>
