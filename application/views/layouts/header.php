<!--begin::Header-->
<div id="kt_header" class="header align-items-stretch mb-5 " data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
	<!--begin::Container-->
	<div class="container-xxl d-flex align-items-center">
		<!--begin::Heaeder menu toggle-->
		<div class="d-flex topbar align-items-center d-lg-none ms-n2 me-3" title="Show aside menu">
			<div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
				<i class="ki-duotone ki-abstract-14 fs-1">
					<span class="path1"></span>
					<span class="path2"></span>
				</i>
			</div>
		</div>
		<!--end::Heaeder menu toggle-->
		<!--begin::Header Logo-->
		<div class="header-logo me-5 me-md-10 flex-grow-1 flex-lg-grow-0">
			<a href="<?=site_url()?>">
				<img alt="Logo" src="<?=base_url('assets/logo.png')?>" class="logo-default h-50px" />
				<img alt="Logo" src="<?=base_url('assets/logo.png')?>" class="logo-sticky h-50px" />
			</a>
		</div>
		<!--end::Header Logo-->
		<!--begin::Wrapper-->
		<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
			<!--begin::Navbar-->
			<div class="d-flex align-items-stretch" id="kt_header_nav">
				<!--begin::Menu wrapper-->
				<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
					<!--begin::Menu-->
					<div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-400 fw-semibold my-5 my-lg-0 align-items-stretch px-2 px-lg-0" id="#kt_header_menu" data-kt-menu="true">
						
						<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
							
							<span class="menu-link py-3">
								<span class="menu-title">Dashboards</span>
								<span class="menu-arrow d-lg-none"></span>
							</span>
							
							<!--begin:Menu sub-->
							<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
								<!--begin:Dashboards menu-->
								<div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible" data-kt-menu-dismiss="true">
									<!--begin:Row-->
									<div class="row">
										<!--begin:Col-->
										<div class="col-lg-12 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6">
											<!--begin:Row-->
											<div class="row">
												<!--begin:Col-->
												<div class="col-lg-4 mb-3">
													
													<div class="menu-item p-0 m-0">
														
														<a href="../../demo2/dist/index.html" class="menu-link">
															<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
																<i class="ki-duotone ki-element-11 text-primary fs-1">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																</i>
															</span>
															<span class="d-flex flex-column">
																<span class="fs-6 fw-bold text-gray-800">Default</span>
																<span class="fs-7 fw-semibold text-muted">Overall Summary</span>
															</span>
														</a>
														
													</div>
													
												</div>
												<!--end:Col-->
												<!--begin:Col-->
												<div class="col-lg-4 mb-3">
													
													<div class="menu-item p-0 m-0">
														
														<a href="../../demo2/dist/dashboards/ecommerce.html" class="menu-link">
															<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
																<i class="ki-duotone ki-user-tick text-danger fs-1">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																</i>
															</span>
															<span class="d-flex flex-column">
																<span class="fs-6 fw-bold text-gray-800">Recruitment</span>
																<span class="fs-7 fw-semibold text-muted">Performance of Recruitment</span>
															</span>
														</a>
														
													</div>
													
												</div>
												<!--end:Col-->
												
											</div>
											<!--end:Row-->
											
										</div>
										<!--end:Col-->
									</div>
									<!--end:Row-->
								</div>
								<!--end:Dashboards menu-->
							</div>
							<!--end:Menu sub-->
						</div>
						
						
						<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
							
							<span class="menu-link py-3">
								<span class="menu-title">Candidate</span>
								<span class="menu-arrow d-lg-none"></span>
							</span>
							
							<!--begin:Menu sub-->
							<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
								
								<div class="menu-item">
									
									<a class="menu-link py-3" href="<?=site_url('candidate/search')?>"  title="View all candidate in the system" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon">
											<i class="ki-duotone ki-magnifier text-primary fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
										<span class="menu-title">All Candidate</span>
									</a>
									
								</div>
								
								
								<div class="menu-item">
									
									<a class="menu-link py-3" href="<?=site_url('candidate/search?status=Available')?>"  title="Browse through all available candidates" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon">
											<i class="ki-duotone ki-abstract-34 text-success fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
										<span class="menu-title">Available</span>
									</a>
									
								</div>
								
								<div class="menu-item">
									
									<a class="menu-link py-3" href="<?=site_url('candidate/search?status=Hired')?>"  title="View all candidate that you are currently hiring" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon">
											<i class="ki-duotone ki-abstract-22 text-danger fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
										<span class="menu-title">Hired</span>
									</a>
									
								</div>
							</div>
						</div>
						
						
						<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
							
							<span class="menu-link py-3">
								<span class="menu-title">Recruitment</span>
								<span class="menu-arrow d-lg-none"></span>
							</span>
							
							<!--begin:Menu sub-->
							<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
								
								<div class="menu-item"> 
									<a class="menu-link py-3" href="<?=site_url('vacancy/new')?>"  title="Create a New Recruitment / Job Vacancies" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon">
											<i class="ki-duotone ki-plus text-primary fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
										<span class="menu-title">Create New</span>
									</a>
								</div>
								<div class="menu-item"> 
									<a class="menu-link py-3" href="<?=site_url('vacancy/search?status=open')?>"  title="Search Ongoing Recruitment" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon">
											<i class="ki-duotone ki-abstract-31 text-primary fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
										<span class="menu-title">Ongoing</span>
									</a>
								</div>
								
								
								<div class="menu-item">
									<a class="menu-link py-3" href="<?=site_url('vacancy/search?status=closed')?>"  title="Search Closed/Finished Recruitment" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon">
											<i class="ki-duotone ki-abstract-43 text-success fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
										<span class="menu-title">Closed</span>
									</a>
								</div>
								
								<div class="menu-item">
									<a class="menu-link py-3" href="<?=site_url('recruitment/setting')?>"  title="Recruitment Stages Settings" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon">
											<i class="ki-duotone ki-abstract-9 text-warning fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
										<span class="menu-title">Setting</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link py-3" href="<?=site_url('recruitment/offering_template')?>"  title="Offering Letter Template" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon">
											<i class="ki-duotone ki-abstract-10 text-success fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
										<span class="menu-title">Offering Template</span>
									</a>
								</div>
							</div>
						</div>
						
						
						<div class="menu-item me-0 me-lg-2 menu-url" data-href="<?=site_url('users/search')?>">
							
							<span class="menu-link py-3">
								<span class="menu-title">Users</span>
								<span class="menu-arrow d-lg-none"></span>
							</span>
							
						</div>
						
						
						<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
							
							<span class="menu-link py-3">
								<span class="menu-title">Setup</span>
								<span class="menu-arrow d-lg-none"></span>
							</span>
							
							<!--begin:Menu sub-->
							<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
								
								<div class="menu-item">
									
									<a class="menu-link py-3" href="<?=site_url('department/search')?>"  title="Check out over 200 in-house components, plugins and ready for use solutions" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon">
											<i class="ki-duotone ki-abstract-15 text-info fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
										<span class="menu-title">Departments</span>
									</a>
									
								</div>
								
								
								<div class="menu-item">
									
									<a class="menu-link py-3" href="<?=site_url('job_role/search')?>"  title="Check out the complete documentation" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon">
											<i class="ki-duotone ki-abstract-14 text-success fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
										<span class="menu-title">Job Role</span>
									</a>
									
								</div>
								
								
								<div class="menu-item">
									<a class="menu-link py-3" href="<?=site_url('location/search')?>"  title="Check out the complete documentation" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon">
											<i class="ki-duotone ki-geolocation text-primary fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
										<span class="menu-title">Locations</span>
									</a>
								</div>

							</div>
							<!--end:Menu sub-->
						</div>
						
					</div>
					<!--end::Menu-->
				</div>
				<!--end::Menu wrapper-->
			</div>
			<!--end::Navbar-->
			<!--begin::Toolbar wrapper-->
			<div class="topbar d-flex align-items-stretch flex-shrink-0">
				<!--begin::Notifications-->
				<div class="d-flex align-items-center ms-1 ms-lg-3">
					<!--begin::Menu- wrapper-->
					<div class="position-relative btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
						<i class="ki-duotone ki-binance fs-1">
							<span class="path1"></span>
							<span class="path2"></span>
							<span class="path3"></span>
							<span class="path4"></span>
							<span class="path5"></span>
						</i>
					</div>
					<!--begin::Menu-->
					<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
						<!--begin::Heading-->
						<div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('<?=base_url('/assets/media/misc/menu-header-bg.jpg')?>')">
							<!--begin::Title-->
							<h3 class="text-white fw-semibold px-9 mt-10 mb-6">Notifications
							<span class="fs-8 opacity-75 ps-3">24 reports</span></h3>
							<!--end::Title-->
							<!--begin::Tabs-->
							<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
								<li class="nav-item">
									<a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#kt_topbar_notifications_1">Alerts</a>
								</li>
								
							</ul>
							<!--end::Tabs-->
						</div>
						<!--end::Heading-->
						<!--begin::Tab content-->
						<div class="tab-content">
							<!--begin::Tab panel-->
							<div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
								<!--begin::Items-->
								<div class="scroll-y mh-325px my-5 px-8">
									<!--begin::Item-->
									<div class="d-flex flex-stack py-4">
										<!--begin::Section-->
										<div class="d-flex align-items-center">
											<!--begin::Symbol-->
											<div class="symbol symbol-35px me-4">
												<span class="symbol-label bg-light-primary">
													<i class="ki-duotone ki-abstract-28 fs-2 text-primary">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="mb-0 me-2">
												<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Project Alice</a>
												<div class="text-gray-400 fs-7">Phase 1 development</div>
											</div>
											<!--end::Title-->
										</div>
										<!--end::Section-->
										<!--begin::Label-->
										<span class="badge badge-light fs-8">1 hr</span>
										<!--end::Label-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="d-flex flex-stack py-4">
										<!--begin::Section-->
										<div class="d-flex align-items-center">
											<!--begin::Symbol-->
											<div class="symbol symbol-35px me-4">
												<span class="symbol-label bg-light-danger">
													<i class="ki-duotone ki-information fs-2 text-danger">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span>
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="mb-0 me-2">
												<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">HR Confidential</a>
												<div class="text-gray-400 fs-7">Confidential staff documents</div>
											</div>
											<!--end::Title-->
										</div>
										<!--end::Section-->
										<!--begin::Label-->
										<span class="badge badge-light fs-8">2 hrs</span>
										<!--end::Label-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="d-flex flex-stack py-4">
										<!--begin::Section-->
										<div class="d-flex align-items-center">
											<!--begin::Symbol-->
											<div class="symbol symbol-35px me-4">
												<span class="symbol-label bg-light-warning">
													<i class="ki-duotone ki-briefcase fs-2 text-warning">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="mb-0 me-2">
												<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Company HR</a>
												<div class="text-gray-400 fs-7">Corporeate staff profiles</div>
											</div>
											<!--end::Title-->
										</div>
										<!--end::Section-->
										<!--begin::Label-->
										<span class="badge badge-light fs-8">5 hrs</span>
										<!--end::Label-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="d-flex flex-stack py-4">
										<!--begin::Section-->
										<div class="d-flex align-items-center">
											<!--begin::Symbol-->
											<div class="symbol symbol-35px me-4">
												<span class="symbol-label bg-light-success">
													<i class="ki-duotone ki-abstract-12 fs-2 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="mb-0 me-2">
												<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Project Redux</a>
												<div class="text-gray-400 fs-7">New frontend admin theme</div>
											</div>
											<!--end::Title-->
										</div>
										<!--end::Section-->
										<!--begin::Label-->
										<span class="badge badge-light fs-8">2 days</span>
										<!--end::Label-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="d-flex flex-stack py-4">
										<!--begin::Section-->
										<div class="d-flex align-items-center">
											<!--begin::Symbol-->
											<div class="symbol symbol-35px me-4">
												<span class="symbol-label bg-light-primary">
													<i class="ki-duotone ki-colors-square fs-2 text-primary">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
													</i>
												</span>
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="mb-0 me-2">
												<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Project Breafing</a>
												<div class="text-gray-400 fs-7">Product launch status update</div>
											</div>
											<!--end::Title-->
										</div>
										<!--end::Section-->
										<!--begin::Label-->
										<span class="badge badge-light fs-8">21 Jan</span>
										<!--end::Label-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="d-flex flex-stack py-4">
										<!--begin::Section-->
										<div class="d-flex align-items-center">
											<!--begin::Symbol-->
											<div class="symbol symbol-35px me-4">
												<span class="symbol-label bg-light-info">
													<i class="ki-duotone ki-picture fs-2 text-info"></i>
												</span>
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="mb-0 me-2">
												<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Banner Assets</a>
												<div class="text-gray-400 fs-7">Collection of banner images</div>
											</div>
											<!--end::Title-->
										</div>
										<!--end::Section-->
										<!--begin::Label-->
										<span class="badge badge-light fs-8">21 Jan</span>
										<!--end::Label-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="d-flex flex-stack py-4">
										<!--begin::Section-->
										<div class="d-flex align-items-center">
											<!--begin::Symbol-->
											<div class="symbol symbol-35px me-4">
												<span class="symbol-label bg-light-warning">
													<i class="ki-duotone ki-color-swatch fs-2 text-warning">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
														<span class="path5"></span>
														<span class="path6"></span>
														<span class="path7"></span>
														<span class="path8"></span>
														<span class="path9"></span>
														<span class="path10"></span>
														<span class="path11"></span>
														<span class="path12"></span>
														<span class="path13"></span>
														<span class="path14"></span>
														<span class="path15"></span>
														<span class="path16"></span>
														<span class="path17"></span>
														<span class="path18"></span>
														<span class="path19"></span>
														<span class="path20"></span>
														<span class="path21"></span>
													</i>
												</span>
											</div>
											<!--end::Symbol-->
											<!--begin::Title-->
											<div class="mb-0 me-2">
												<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Icon Assets</a>
												<div class="text-gray-400 fs-7">Collection of SVG icons</div>
											</div>
											<!--end::Title-->
										</div>
										<!--end::Section-->
										<!--begin::Label-->
										<span class="badge badge-light fs-8">20 March</span>
										<!--end::Label-->
									</div>
									<!--end::Item-->
								</div>
								<!--end::Items-->
								<!--begin::View more-->
								<div class="py-3 text-center border-top">
									<a href="../../demo2/dist/pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All
									<i class="ki-duotone ki-arrow-right fs-5">
										<span class="path1"></span>
										<span class="path2"></span>
									</i></a>
								</div>
								<!--end::View more-->
							</div>
							<!--end::Tab panel-->
						</div>
						<!--end::Tab content-->
					</div>
					<!--end::Menu-->
					<!--end::Menu wrapper-->
				</div>
				<!--end::Notifications-->
				<!--begin::User-->
				<div class="d-flex align-items-center me-lg-n2 ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
					<!--begin::Menu wrapper-->
					<div class="btn btn-light" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
						My Account
					</div>
					<!--begin::User account menu-->
					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<div class="menu-content d-flex align-items-center px-3">
								<!--begin::Avatar-->
								
								<!--end::Avatar-->
								<!--begin::Username-->
								<div class="d-flex flex-column">
									<div class="fw-bold d-flex align-items-center fs-5"><?=$this->session->login->name?>
									<span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span></div>
									<a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?=$this->session->login->role?></a>
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
					<!--end::Menu wrapper-->
				</div>
				<!--end::User -->
				<!--begin::Aside mobile toggle-->
				<!--end::Aside mobile toggle-->
			</div>
			<!--end::Toolbar wrapper-->
		</div>
		<!--end::Wrapper-->
	</div>
	<!--end::Container-->
</div>
<!--end::Header-->