	
		<div class="app-sidebar3">
			<div class="app-sidebar__user">
				<div class="dropdown user-pro-body text-center">
					<div class="user-pic">
						<img src="{{asset('images.jfif')}}" alt="user-img" class="avatar-xxl rounded-circle mb-1">
					</div>
					<div class="user-info">
						<h5 class=" mb-2">عرشیا</h5>
						<span class="text-muted app-sidebar__user-name text-sm"></span>
					</div>
				</div>
			</div>
			<ul class="side-menu">
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" href="{{route('admin.dashboard')}}">
						<i class="feather feather-home sidemenu_icon"></i>
						<span class="side-menu__label">داشبورد</span></i>
					</a>
				</li>
				@can('view users')
					
				<!-- کد HTML برای نمایش عملیات مخصوص super admin -->
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" >
						<i class="fa fa-users sidemenu_icon"></i>
						<span class="side-menu__label">مدیریت ادمین ها</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{route('admin.users.index')}}" class="slide-item">لیست ادمین ها</a></li>
						<li><a href="{{route('admin.users.create')}}" class="slide-item">ثبت ادمین </a></li>
					</ul>
				</li>
				@endcan
				@can('view specialties')
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" >
						<i class="specialtie sidemenu_icon"></i>
						<span class="side-menu__label">تخصص ها</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{route('admin.specialties')}}" class="slide-item">لیست تخصص ها</a></li>
					</ul>
				</li>
				@endcan
				@can('view role_doctors')
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" >
						<i class="fa fa-doctors sidemenu_icon"></i>
						<span class="side-menu__label">نقش دکتر ها</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{route('admin.roles-doctor')}}" class="slide-item">نقش دکتر ها</a></li>
					</ul>
				</li>
				@endcan
				@can('view operations')
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" >
						<i class="fa fa-doctors sidemenu_icon"></i>
						<span class="side-menu__label">عمل ها</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{route('admin.operations')}}" class="slide-item">لیست عمل ها</a></li>
					</ul>
				</li>
				@endcan

				{{-- <li class="slide">
					<a class="side-menu__item" data-toggle="slide"  href="{{route('menus')}}">
						<i class="fa fa-get-pocket sidemenu_icon"></i>
						<span class="side-menu__label">منو ساز</span></i>
					</a>
				</li>

				<li class="slide">
					<a class="side-menu__item" data-toggle="slide">
						<i class="fa fa-newspaper-o sidemenu_icon"></i>
						<span class="side-menu__label">اخبار</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{route('posts.create')}}" class="slide-item">اخبار جدید</a></li>
						<li><a href="{{route('posts.index')}}" class="slide-item">اخبار ها</a></li>
					</ul>
				</li>

				<li class="slide">
					<a class="side-menu__item" data-toggle="slide">
						<i class="fa fa-bullhorn sidemenu_icon"></i>
						<span class="side-menu__label">اطلاعیه</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{ route('announcements.create') }}" class="slide-item">اطلاعیه جدید</a></li>
						<li><a href="{{ route('announcements.index') }}" class="slide-item">اطلاعیه ها</a></li>
					</ul>
				</li>

				<li class="slide">
					<a class="side-menu__item" data-toggle="slide"  >
						<i class="fa fa-book sidemenu_icon"></i>
						<span class="side-menu__label">آموزش</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{ route('articles.create')}}" class="slide-item">آموزش جدید</a></li>
						<li><a href="{{ route('articles.index')}}" class="slide-item">آموزش ها</a></li>
					</ul>
				</li>

				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" >
						<i class="fa fa-sliders sidemenu_icon"></i>
						<span class="side-menu__label">اسلایدر</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{ route('sliders.create')}}" class="slide-item">اسلایدر جدید</a></li>
						<li><a href="{{ route('sliders.index')}}" class="slide-item">اسلایدر ها</a></li>
					</ul>
				</li>

				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" >
						<i class="fa fa-link sidemenu_icon"></i>
						<span class="side-menu__label">لينک</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{ route('links.create')}}" class="slide-item">لينک جدید</a></li>
						<li><a href="{{ route('links.index')}}" class="slide-item">لينک ها</a></li>
					</ul>
				</li>
			
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" >
						<i class="sidemenu_icon">#</i>
						<span class="side-menu__label">برچسب</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{ route('tags.index')}}" class="slide-item">برچسب ها</a></li>
					</ul>
				</li>

				<li class="slide">
					<a class="side-menu__item" data-toggle="slide"  href="{{ route('edit-setting')}}">
						<i class=" las la-cog sidemenu_icon"></i>
						<span class="side-menu__label">تنظیمات</span></i>
					</a>
				</li> --}}
			</ul>
		</div>