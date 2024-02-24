	
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
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" >
						<i class="fa fa-users sidemenu_icon"></i>
						<span class="side-menu__label">اطلاعات پایه</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						@can('view specialties')
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="{{route('admin.specialties')}}">
								<i class="specialtie sidemenu_icon"></i>
								<span class="side-menu__label">تخصص ها</span>
							</a>
						</li>
						@endcan
						@can('view role_doctors')
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="{{route('admin.roles-doctor')}}">
						<i class="fa fa-doctors sidemenu_icon"></i>
						<span class="side-menu__label">نقش دکتر ها</span>
					</a>
				</li>
				@endcan
				@can('view operations')
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" href="{{route('admin.operations')}}">
						<i class="fa fa-doctors sidemenu_icon"></i>
						<span class="side-menu__label">عمل ها</span>
					</a>
				</li>
				@endcan
				@can('view insurances')
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" href="{{route('admin.insurances.index')}}">
						<i class="fa fa-insurances sidemenu_icon"></i>
						<span class="side-menu__label">بیمه ها</span>
					</a>
				</li>
				@endcan
			</ul>
		</li>
		@can('view doctors')
		<li class="slide">
			<a class="side-menu__item" data-toggle="slide">
				<i class="fa fa-doctors sidemenu_icon"></i>
						<span class="side-menu__label">دکتر ها</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{route('admin.doctors.index')}}" class="slide-item">لیست دکتر ها</a></li>
						<li><a href="{{route('admin.doctors.create')}}" class="slide-item">ثبت دکتر</a></li>
					</ul>
				</li>
				@endcan
				@can('view surguries')
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide">
						<i class="fa fa-doctors sidemenu_icon"></i>
						<span class="side-menu__label">جراحی ها</span><i class="angle fa fa-angle-left"></i>
					</a>
					<ul class="slide-menu">
						<li><a href="{{route('admin.surgeries.index')}}" class="slide-item">لیست جراحی ها</a></li>
						<li><a href="{{route('admin.surgeries.create')}}" class="slide-item">ثبت جراحی</a></li>
					</ul>
				</li>
				@endcan
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide"  href="{{route('admin.filter-doctor')}}">
						<i class="fa fa-insurances sidemenu_icon"></i>
						<span class="side-menu__label">پرداخت به پزشک</span>
					</a>
				</li>
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide"  href="{{route('admin.invoice.index')}}">
						<i class="fa fa-insurances sidemenu_icon"></i>
						<span class="side-menu__label">لیست صورت حساب ها</span>
					</a>
				</li>
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide"  href="{{route('admin.payments.index')}}">
						<i class="fa fa-insurances sidemenu_icon"></i>
						<span class="side-menu__label">لیست پرداختی ها</span>
					</a>
				</li>
				@can('edit settings')
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" href="{{route('admin.edit-setting')}}">
						<i class=" las la-cog sidemenu_icon"></i>
						<span class="side-menu__label">تنظیمات</span>
					</a>
				</li>
				@endcan
				<li class="slide">
					<a class="side-menu__item" data-toggle="slide" href="{{route('admin.logActivitys')}}">
						<span class="side-menu__label">فعالیت ادمین ها</span>
					</a>
				</li>
			</ul>
		</div>