<!--app header-->
						<div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="index.html">
										<img src="{{asset('assets/images/brand/logo.png')}}" class="header-brand-img desktop-lgo" alt="Dayonelogo">
										<img src="{{asset('assets/images/brand/logo-white.png')}}" class="header-brand-img dark-logo" alt="Dayonelogo">
										<img src="{{asset('assets/images/brand/favicon.png')}}" class="header-brand-img mobile-logo" alt="Dayonelogo">
										<img src="{{asset('assets/images/brand/favicon1.png')}}" class="header-brand-img darkmobile-logo" alt="Dayonelogo">
									</a>
									<div class="app-sidebar__toggle" data-toggle="sidebar">
										<a class="open-toggle" href="#">
											<i class="feather feather-menu"></i>
										</a>
										<a class="close-toggle" href="#">
											<i class="feather feather-x"></i>
										</a>
									</div>
									<div class="mt-0">
										<form class="form-inline">
											<div class="search-element">
												<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
												<button class="btn btn-primary-color" >
													<i class="feather feather-search"></i>
												</button>
											</div>
										</form>
									</div><!-- SEARCH -->
									<div class="d-flex order-lg-2 my-auto mr-auto">
										<a class="nav-link my-auto icon p-0 nav-link-lg d-md-none navsearch" href="#" data-toggle="search">
											<i class="feather feather-search search-icon header-icon"></i>
										</a>
										<div class="dropdown header-fullscreen">
											<a class="nav-link icon full-screen-link">
												<i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
												<i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
											</a>
										</div>
										<div class="dropdown header-notify">
											<a class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
												<i class="feather feather-bell header-icon"></i>
												<span class="bg-dot"></span>
											</a>
										</div>
										<div class="dropdown profile-dropdown">
											<a  class="nav-link pr-1 pl-0 leading-none" data-toggle="dropdown">
												<span>
													<img src="{{asset('public/assets/images/photos/images.jfif')}}">
												</span>
											</a>
											<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow animated">
											
												<a class="dropdown-item d-flex">
													<i class="feather feather-user ml-3 fs-16 my-auto"></i>
													<div class="mt-1">Profile</div>
												</a>
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-settings ml-3 fs-16 my-auto"></i>
													<div class="mt-1">Settings</div>
												</a>
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-mail ml-3 fs-16 my-auto"></i>
													<div class="mt-1">Messages</div>
												</a>
												<a class="dropdown-item d-flex" href="#" data-toggle="modal" data-target="#changepasswordnmodal">
													<i class="feather feather-edit-2 ml-3 fs-16 my-auto"></i>
													<div class="mt-1">Change Password</div>
												</a>
												<a class="dropdown-item d-flex" href="{{route('admin.logout')}}">
													<i class="feather feather-power ml-3 fs-16 my-auto"></i>
													<div class="mt-1">Sign Out</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
						<!--/app header-->
						<div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="index.html">
										<img src="{{asset('assets/images/brand/logo.png')}}" class="header-brand-img desktop-lgo" alt="Dayonelogo">
										<img src="{{asset('assets/images/brand/logo-white.png')}}" class="header-brand-img dark-logo" alt="Dayonelogo">
										<img src="{{asset('assets/images/brand/favicon.png')}}" class="header-brand-img mobile-logo" alt="Dayonelogo">
										<img src="{{asset('assets/images/brand/favicon1.png')}}" class="header-brand-img darkmobile-logo" alt="Dayonelogo">
									</a>
									<div class="app-sidebar__toggle" data-toggle="sidebar">
										<a class="open-toggle" href="#">
											<i class="feather feather-menu"></i>
										</a>
										<a class="close-toggle" href="#">
											<i class="feather feather-x"></i>
										</a>
									</div>
									{{-- <div class="mt-0">
										<form class="form-inline">
											<div class="search-element">
												<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
												<button class="btn btn-primary-color" >
													<i class="feather feather-search"></i>
												</button>
											</div>
										</form>
									</div>  --}}
									<div class="d-flex order-lg-2 my-auto mr-auto">
										<div class="dropdown header-fullscreen">
											<a class="nav-link icon full-screen-link">
												<i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
												<i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
											</a>
										</div>
										<div class="dropdown header-notify">
											<a class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
												<i class="feather feather-bell header-icon"></i>
												@if($notifications->where('viewed_at', null)->isNotEmpty())
													<span class="bg-dot"></span>
												@endif
											</a>
										</div>
										<div class="dropdown profile-dropdown">
											<a href="#" class="nav-link pr-1 pl-0 leading-none" data-toggle="dropdown">
												<span>
													<img src="{{asset('images.jfif')}}" alt="img" class="avatar avatar-md bradius">
												</span>
											</a>
											<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow animated">
												<a class="dropdown-item d-flex" href="{{route('admin.edit-setting')}}">
													<i class="feather feather-settings ml-3 fs-16 my-auto"></i>
													<div class="mt-1">تنظیمات</div>
												</a>
												{{-- <a class="dropdown-item d-flex" href="{{route('admin-profile-edit',[session()->get('user_id')])}}">
													<i class="feather feather-user ml-3 fs-16 my-auto"></i>
													<div class="mt-1">پروفایل</div>
												</a>
												<a class="dropdown-item d-flex" href="#" data-toggle="modal" data-target="#changepasswordnmodal">
													<i class="feather feather-edit-2 ml-3 fs-16 my-auto"></i>
													<div class="mt-1">تغییر کلمه عبور</div>
												</a> --}}
												<form method="POST" action="{{ route('admin.logout') }}">
													@csrf
													<a class="dropdown-item d-flex">
														<i class="feather feather-power ml-3 fs-16 my-auto"></i>
														<button class="mt-1">خروج</button>
													</a>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> 
						<div class="sidebar sidebar-right sidebar-animate">
							<div class="card-header border-bottom pb-5">
								<h4 class="card-title">اعلان ها</h4>
								<div class="card-options">
									<a href="#" class="btn btn-sm btn-icon btn-light text-primary"  data-toggle="sidebar-right" data-target=".sidebar-right"><i class="feather feather-x"></i> </a>
								</div>
							</div>
							<div class="">
								@foreach ($notifications as $notify)
									@if($notify->viewed_at === null)
									<div class="list-group-item  align-items-center border-0">
										<div class="d-flex">
											<div class="mt-1">
												<a href="{{route('admin.notify.show',$notify->id)}}" class="font-weight-semibold fs-16"> {{$notify->title}} <span class="text-muted font-weight-normal"> {{Str::limit($notify->body,17,'')}} </span></a>
												<span class="clearfix"></span>
												<span class="text-muted fs-13 ml-auto">{{$notify->created_at->diffForHumans()}}<i class="mdi mdi-clock text-muted mr-1"></i></span>
											</div>
											<div class="ml-auto">
												<a href="{{route('admin.notify.show',$notify->id)}}" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
													<span class="feather feather-more-horizontal"></span>
												</a>
												{{-- <ul class="dropdown-menu dropdown-menu-left" role="menu">
													<li><a href="#"><i class="feather feather-eye ml-2"></i>View</a></li>
													<li><a href="#"><i class="feather feather-plus-circle ml-2"></i>Add</a></li>
													<li><a href="#"><i class="feather feather-trash-2 ml-2"></i>Remove</a></li>
													<li><a href="#"><i class="feather feather-settings ml-2"></i>More</a></li>
												</ul> --}}
											</div>
										</div>
									</div>
									<hr>
									@endif
								@endforeach
							</div>
						</div>