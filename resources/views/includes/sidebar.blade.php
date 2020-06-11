@php
    
    $myuser = Auth::user()->id;

    $permissions = DB::table('menus')
    ->select('menus.*')
    ->leftJoin('previllages', 'menus.id', '=', 'previllages.menu_id')
    ->leftJoin('users_roles', 'previllages.role_id', '=', 'users_roles.role_id')
    ->where('users_roles.user_id', $myuser)
    ->get();
    
@endphp

<div class="main-menu menu-static menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            @foreach($permissions as $permission)

                @if($permission->sub_id == '0')
                    @if($permission->key != '#')
                        <li class="nav-item"><a href="{{ URL::to('/') }}/{{ $permission->key }}"><i class="la {{ $permission->desc }}"></i><span class="menu-title">{{ $permission->name }}</span></a></li>
                    @else
                        <li class="nav-item"><a href="{{ URL::to('/') }}/{{ $permission->key }}"><i class="la {{ $permission->desc }}"></i><span class="menu-title">{{ $permission->name }}</span></a>
                        <ul class="menu-content">
                            @php
                            $anaks = DB::table('menus')
                            ->select('menus.*')
                            ->leftJoin('previllages', 'menus.id', '=', 'previllages.menu_id')
                            ->leftJoin('users_roles', 'previllages.role_id', '=', 'users_roles.role_id')
                            ->where([
                                ['menus.sub_id', '=', $permission->id],
                                ['users_roles.user_id', '=', $myuser]
                            ])
                            ->orderBy("menus.antrian", "asc")
                            ->get();
                            @endphp

                            @foreach($anaks as $anak)
                                <li><a class="menu-item" href="{{ URL::to('/') }}/{{ $anak->key }}"><span data-i18n="nav.search_pages.search_page">{{ $anak->name }}</span></a></li>

                            @endforeach

                        </ul>
                    </li>

                    @endif

                @endif

            @endforeach
            
        </ul>
    </div>
</div>

<!-- END: Main Menu-->