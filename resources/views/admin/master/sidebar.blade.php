<div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.html"><img class="main-logo" src="{{asset("source/admin/img/logo/logo.png")}}" alt="" /></a>
                <strong><img src="{{asset("source/admin/img/logo/logosn.png")}}" alt="" /></strong>
            </div>
			<div class="nalika-profile">
				<div class="profile-dtl">
					<a href="#">
                        @if($userLogin->avatar)
                        <img src="{{asset($userLogin->avatar)}}"/>
                        @elseif($userLogin->avatar_cdn)
                        <img src="{{asset($userLogin->avatar_cdn)}}"/>
                        @else
                        <img src="{{asset("source/admin/img/notification/4.jpg")}}">
                        @endif
                    </a>
					<h2>{{$userLogin->fullname}}</h2>
				</div>
				<div class="profile-social-dtl">
					<ul class="dtl-social">
						<li><a href="#"><i class="icon nalika-facebook"></i></a></li>
						<li><a href="#"><i class="icon nalika-twitter"></i></a></li>
						<li><a href="#"><i class="icon nalika-linkedin"></i></a></li>
					</ul>
				</div>
			</div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="">
                            <a href="{{route("admin.cart")}}">
								   <i class="icon nalika-home icon-wrap"></i>
								   <span class="mini-click-non">Đơn Hàng</span>
							</a>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i class="icon nalika-mail icon-wrap"></i>
                            <span class="mini-click-non">Khối Giao Diện</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li>
                                    <a title="Inbox" class="has-arrow" href="mailbox.html">
                                        <span class="mini-sub-pro">Thiết Lập Menu</span>
                                    </a>
                                    <ul class="submenu-angle" aria-expanded="false">
                                        <li><a href="{{route("admin.template.menu.add")}}">Danh Sách</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i class="icon nalika-diamond icon-wrap"></i> <span class="mini-click-non">Bài Viết</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Pdf Viewer" href="{{route("admin.post.add")}}"><span class="mini-sub-pro">Thêm</span></a></li>
                                <li><a title="Google Map" href="{{route("admin.post")}}"><span class="mini-sub-pro">Danh Sách</span></a></li>
                                <li><a title="Data Maps" href="{{route("admin.post.category.add")}}"><span class="mini-sub-pro">Danh Mục</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i class="icon nalika-pie-chart icon-wrap"></i> <span class="mini-click-non">Sản Phẩm</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="File Manager" href="{{route("admin.product.add")}}"><span class="mini-sub-pro">Thêm</span></a></li>
                                <li><a title="Google Map" href="{{route("admin.product")}}"><span class="mini-sub-pro">Danh Sách</span></a></li>
                                <li><a title="Blog" href="{{route("admin.product.category.add")}}"><span class="mini-sub-pro">Danh Mục</span></a></li>
                                <li><a title="Blog" href="{{route("admin.product.brand.add")}}"><span class="mini-sub-pro">Thêm Thương Hiệu</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i class="icon nalika-bar-chart icon-wrap"></i> <span class="mini-click-non">Thành Viên</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Line Charts" href="{{route("admin.user.add")}}"><span class="mini-sub-pro">Thêm Thành Viên</span></a></li>
                                <li><a title="Bar Charts" href="{{route("admin.user")}}"><span class="mini-sub-pro">Danh Sách</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i class="icon nalika-table icon-wrap"></i> <span class="mini-click-non">Trang</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Peity Charts" href="{{route("admin.page.add")}}"><span class="mini-sub-pro">Thêm</span></a></li>
                                <li><a title="Data Table" href="{{route("admin.page")}}"><span class="mini-sub-pro">Danh Sách</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i class="icon nalika-forms icon-wrap"></i> <span class="mini-click-non">Slider</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Basic Form Elements" href="{{route("admin.slider.add")}}"><span class="mini-sub-pro">Thêm</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i class="icon nalika-smartphone-call icon-wrap"></i> <span class="mini-click-non">App views</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Notifications" href="notifications.html"><span class="mini-sub-pro">Notifications</span></a></li>
                                <li><a title="Alerts" href="alerts.html"><span class="mini-sub-pro">Alerts</span></a></li>
                                <li><a title="Modals" href="modals.html"><span class="mini-sub-pro">Modals</span></a></li>
                                <li><a title="Buttons" href="buttons.html"><span class="mini-sub-pro">Buttons</span></a></li>
                                <li><a title="Tabs" href="tabs.html"><span class="mini-sub-pro">Tabs</span></a></li>
                                <li><a title="Accordion" href="accordion.html"><span class="mini-sub-pro">Accordion</span></a></li>
                            </ul>
                        </li>
                        <li id="removable">
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-new-file icon-wrap"></i> <span class="mini-click-non">Pages</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Login" href="login.html"><span class="mini-sub-pro">Login</span></a></li>
                                <li><a title="Register" href="register.html"><span class="mini-sub-pro">Register</span></a></li>
                                <li><a title="Lock" href="lock.html"><span class="mini-sub-pro">Lock</span></a></li>
                                <li><a title="Password Recovery" href="password-recovery.html"><span class="mini-sub-pro">Password Recovery</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>