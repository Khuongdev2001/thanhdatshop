@foreach($menuMobiles as $key => $menu)
    @if($menu["parent_id"]==$parent_id)
        @if(isset($isChild))
        <ul class="submenu">
        @endif
            <li class="menu-item">
                <span class="menu-text">
                    <a href="{{$menu->menu_link ? $menu->menu_link :"javavscript:void(0) "}}" 
                    class="menu-link">{{$menu->menu_title}}</a>
                    <span class="icon"><i class="fas fa-chevron-right"></i></span>
                </span>
                @php
                unset($menuMobiles[$key])
                @endphp
                @include("user.master.menuMobile",[
                    "menuMobiles"=>$menuMobiles,
                    "parent_id" => $menu->menu_id,
                    "isChild"=>true
                ])
            </li>
        @if(isset($isChild))
        </ul>
        @endif
    @endif
@endforeach