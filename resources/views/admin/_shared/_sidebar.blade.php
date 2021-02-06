<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand">
        <img class="c-sidebar-brand-full" src="{{asset('assets/brand/skroot-base-white.png')}}" width="118" height="46"
             alt="CoreUI Logo">
        <img class="c-sidebar-brand-minimized" src="{{asset('assets/brand/coreui-signet-white.svg')}}" width="118"
             height="46" alt="CoreUI Logo">
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('admin.home')}}">
                {{--<i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i> Kkk--}}
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-speedometer')}}"></use>
                </svg>
                Dashboard</a></li>

        <li class="c-sidebar-nav-title">Users</li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('admin.customers.index')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-pencil')}}"></use>
                </svg>
                Customers</a></li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('admin.suppliers.index')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-pencil')}}"></use>
                </svg>
                Suppliers</a></li>

{{--        <li class="c-sidebar-nav-item">--}}
{{--            <a class="c-sidebar-nav-link" href="{{route('admin.customers.index')}}">--}}
{{--                <svg class="c-sidebar-nav-icon">--}}
{{--                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-pencil')}}"></use>--}}
{{--                </svg>--}}
{{--                Admin Users</a></li>--}}

        <li class="c-sidebar-nav-title">Products</li>

        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route("admin.parts.index")}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-pencil')}}"></use>
                </svg>
                Parts</a></li>

{{--        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/typography">--}}
{{--                <svg class="c-sidebar-nav-icon">--}}
{{--                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-pencil')}}"></use>--}}
{{--                </svg>--}}
{{--                Used Part Requests<span class="badge badge-danger">2</span></a></li>--}}

{{--        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/typography">--}}
{{--                <svg class="c-sidebar-nav-icon">--}}
{{--                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-pencil')}}"></use>--}}
{{--                </svg>--}}
{{--                Used Parts</a></li>--}}

        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route("admin.accessories.index")}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-pencil')}}"></use>
                </svg>
                Accessories</a></li>

        <li class="c-sidebar-nav-title">System Wide</li>

{{--        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('admin.countries.index')}}">--}}
{{--                <svg class="c-sidebar-nav-icon">--}}
{{--                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-pencil')}}"></use>--}}
{{--                </svg>--}}
{{--                App Notifications</a></li>--}}

        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('admin.app-intro-slides.index')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-pencil')}}"></use>
                </svg>
                App intro slides</a></li>

        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('admin.countries.index')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-pencil')}}"></use>
                </svg>
                Countries</a></li>

{{--        <li class="c-sidebar-nav-title">Admin Panel</li>--}}

{{--        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/typography">--}}
{{--                <svg class="c-sidebar-nav-icon">--}}
{{--                    <use xlink:href="{{asset('/assets/icons/coreui/free-symbol-defs.svg#cui-pencil')}}"></use>--}}
{{--                </svg>--}}
{{--                Roles</a></li>--}}

    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
