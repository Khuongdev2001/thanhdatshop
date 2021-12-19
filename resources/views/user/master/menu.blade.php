@foreach($menus as $key => $menu)
@if($menu["parent_id"]==$parent_id)
    @if(isset($isChild))
    <ul class="sub-menu">
    @endif
        <li class="menu-item">
            <a href="{{$menu->menu_link ? $menu->menu_link :"javavscript:void(0) "}}" 
                class="menu-link">{{$menu->menu_title}}</a>
            @php
                unset($menus[$key])
            @endphp
            @include("user.master.menu",[
                "menus"=>$menus,
                "parent_id" => $menu->menu_id,
                "isChild"=>true
            ])
        </li>
    @if(isset($isChild))
    </ul>
    @endif
@endif
@endforeach