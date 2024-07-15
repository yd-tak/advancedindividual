<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column mt-lg-4 ps-2 pe-2 ps-lg-7 pe-lg-4" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
	<div class="app-sidebar-logo flex-shrink-0 d-none d-md-flex flex-center align-items-center" id="kt_app_sidebar_logo">
		<!--begin::Logo-->
		<a href="<?=site_url('dashboard')?>">
			<img alt="Logo" src="<?=base_url('assets/logo.png')?>" class="h-35px d-none d-sm-inline app-sidebar-logo-default theme-light-show" />
			<img alt="Logo" src="<?=base_url('assets/logo.png')?>" class="h-35px theme-dark-show" />
		</a>
		<!--end::Logo-->
		<!--begin::Aside toggle-->
		<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
			<div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
				<i class="ki-outline ki-abstract-14 fs-1"></i>
			</div>
		</div>
		<!--end::Aside toggle-->
	</div>
	<!--begin::sidebar menu-->
	<div class="app-sidebar-menu flex-column-fluid">
		<!--begin::Menu wrapper-->
		<div id="kt_app_sidebar_menu_wrapper" class="hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
			<!--begin::Menu-->
			<div class="menu menu-column menu-rounded menu-sub-indention fw-bold px-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
				<!--begin:Menu item-->
				<div class="menu-item">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?=site_url('dashboard')?>">
						<span class="menu-icon">
							<i class="ki-solid ki-home fs-2"></i>
						</span>
						<span class="menu-title">Dashboards</span>
						<span class="menu-arrow"></span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<!--begin:Menu link-->
					<span class="menu-link">
						<span class="menu-icon">
							<i class="ki-solid ki-profile-user text-gray-900 fs-2"></i>
						</span>
						<span class="menu-title">Candidate</span>
						<span class="menu-arrow"></span>
					</span>
					<!--end:Menu link-->
					<!--begin:Menu sub-->
					<div class="menu-sub menu-sub-accordion">
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link " href="<?=site_url('candidate/search')?>"  title="View all candidate in the system" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">All Candidate</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link " href="<?=site_url('candidate/search?status=Available')?>"  title="Browse through all available candidates" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Available</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link " href="<?=site_url('candidate/search?status=Hired')?>"  title="View all candidate that you are currently hiring" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Hired</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
					</div>
					<!--end:Menu sub-->
				</div>
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<!--begin:Menu link-->
					<span class="menu-link">
						<span class="menu-icon">
							<i class="ki-solid ki-category fs-2"></i>
						</span>
						<span class="menu-title">Recruitment</span>
						<span class="menu-arrow"></span>
					</span>
					<!--end:Menu link-->
					<!--begin:Menu sub-->
					<div class="menu-sub menu-sub-accordion">
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link " href="<?=site_url('vacancy/new')?>"  title="Create a New Recruitment / Job Vacancies" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Create New</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link " href="<?=site_url('vacancy/search?status=open')?>"  title="Search Ongoing Recruitment" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Ongoing</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link " href="<?=site_url('vacancy/search?status=closed')?>"  title="Search Closed/Finished Recruitment" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Closed</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link " href="<?=site_url('recruitment/setting')?>"  title="Recruitment Stages Settings" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Setting</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link " href="<?=site_url('recruitment/offering_template')?>"  title="Offering Letter Template" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Offering Template</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
					</div>
					<!--end:Menu sub-->
				</div>
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<!--begin:Menu link-->
					<span class="menu-link">
						<span class="menu-icon">
							<i class="ki-outline ki-rescue fs-2"></i>
						</span>
						<span class="menu-title">Settings</span>
						<span class="menu-arrow"></span>
					</span>
					<!--end:Menu link-->
					<!--begin:Menu sub-->
					<div class="menu-sub menu-sub-accordion">
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link " href="<?=site_url('department/search')?>"  title="Check out over 200 in-house components, plugins and ready for use solutions" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Departments</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link " href="<?=site_url('job_role/search')?>"  title="Check out the complete documentation" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Job Role</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link " href="<?=site_url('location/search')?>"  title="Check out the complete documentation" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Location</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
					</div>
					<!--end:Menu sub-->
				</div>
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<div class="menu-item">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?=site_url('users/search')?>">
						<span class="menu-icon">
							<i class="ki-solid ki-user fs-2"></i>
						</span>
						<span class="menu-title">Users</span>
						<span class="menu-arrow"></span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->
			</div>
			<!--end::Menu-->
		</div>
		<!--end::Menu wrapper-->
	</div>
	<!--end::sidebar menu-->
	<!--begin::Footer-->
	<div class="app-sidebar-footer d-flex align-items-center px-8 pb-10" id="kt_app_sidebar_footer">
		<!--begin::User-->
		<div class="">
			<!--begin::User info-->
			<div class="d-flex align-items-center" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true" data-kt-menu-placement="top-start">
				<div class="d-flex flex-center cursor-pointer symbol symbol-circle symbol-40px">
					<!-- <img src="assets/media/avatars/300-1.jpg" alt="image" /> -->
				</div>
				<!--begin::Name-->
				<div class="d-flex flex-column align-items-start justify-content-center ms-3">
					<span class="text-gray-500 fs-8 fw-semibold">Hello</span>
					<a href="#" class="text-gray-800 fs-7 fw-bold text-hover-primary"><?=$this->session->login->name?></a>
				</div>
				<!--end::Name-->
			</div>
			<!--end::User info-->
			<!--begin::User account menu-->
			<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
				<!--begin::Menu item-->
				<div class="menu-item px-3">
					<div class="menu-content d-flex align-items-center px-3">
						<!--begin::Avatar-->
						<!-- <div class="symbol symbol-50px me-5">
							<img alt="Logo" src="assets/media/avatars/300-1.jpg" />
						</div> -->
						<!--end::Avatar-->
						<!--begin::Username-->
						<div class="d-flex flex-column">
							<div class="fw-bold d-flex align-items-center fs-5"><?=$this->session->login->name?></div>
							<!-- <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">jeroen@kt.com</a> -->
						</div>
						<!--end::Username-->
					</div>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu separator-->
				<div class="separator my-2"></div>
				<!--end::Menu separator-->
				<!--begin::Menu item-->
				<div class="menu-item px-5">
					<a href="<?=site_url('profile/view')?>" class="menu-link px-5">View Profile</a>
				</div>
				<!--end::Menu item-->
				
				<!--begin::Menu item-->
				<div class="menu-item px-5">
					<a href="<?=site_url('credit/statements')?>" class="menu-link px-5">My Credit Statements</a>
				</div>
				<!--end::Menu item-->
				<div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
					<a href="#" class="menu-link px-5">
						<span class="menu-title position-relative">Mode
						<span class="ms-5 position-absolute translate-middle-y top-50 end-0">
							<i class="ki-outline ki-night-day theme-light-show fs-2"></i>
							<i class="ki-outline ki-moon theme-dark-show fs-2"></i>
						</span></span>
					</a>
					<!--begin::Menu-->
					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
						<!--begin::Menu item-->
						<div class="menu-item px-3 my-0">
							<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
								<span class="menu-icon" data-kt-element="icon">
									<i class="ki-outline ki-night-day fs-2"></i>
								</span>
								<span class="menu-title">Light</span>
							</a>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu item-->
						<div class="menu-item px-3 my-0">
							<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
								<span class="menu-icon" data-kt-element="icon">
									<i class="ki-outline ki-moon fs-2"></i>
								</span>
								<span class="menu-title">Dark</span>
							</a>
						</div>
						<!--end::Menu item-->
					</div>
					<!--end::Menu-->
				</div>
				<!--begin::Menu separator-->
				<div class="separator my-2"></div>
				<!--end::Menu separator-->
				
				<!--begin::Menu item-->
				<div class="menu-item px-5">
					<a href="<?=site_url('auth/signout')?>" class="menu-link px-5">Sign Out</a>
				</div>
				<!--end::Menu item-->
			</div>
			<!--end::User account menu-->
		</div>
		<!--end::User-->
	</div>
	<!--end::Footer-->
</div>
<!--end::Sidebar-->