<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="#"/>
		<title>Advanced Individual - Automate & Optimize your Recruitment Process</title>
		<meta charset="utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="" />
		<meta property="og:url" content="" />
		<meta property="og:site_name" content="" />
		<link rel="canonical" href="" />
		<link rel="shortcut icon" href="<?=base_url('assets/media/logos/favicon.ico')?>" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap5.min.css" rel="stylesheet">

		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="<?=base_url('assets/plugins/global/plugins.bundle.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets/css/style.bundle.css')?>" rel="stylesheet" type="text/css" />
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="<?=base_url('assets/plugins/custom/datatables/datatables.bundle.css')?>" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<link href="<?=base_url('assets/css/select2.min.css')?>" rel="stylesheet" type="text/css" />

		<style>
			.ki-outline{
				position: relative;
			    display: inline-flex;
			    direction: ltr;
			}
			.form-check-label{
				color:black!important;
			}
			.fs-1-5rem{
				font-size: 1.5rem !important;
			}
			.text-right{
				text-align: right;
			}
			.select2-selection{
				height:3rem !important;
				padding:0.5rem !important;
			}
			.select2-selection__arrow{
				margin-top: 0.5rem !important;
			}
			.required{
				color:red;
				font-weight: bold;
			}
			.select2-selection__choice{
				margin:0!important;
			}
			.fs-12{
				font-size: 12px;
			}
			.spinner-overlay {
	            position: absolute;
	            top: 0;
	            left: 0;
	            right: 0;
	            bottom: 0;
	            background-color: rgba(255, 255, 255, 0.8);
	            z-index: 1000;
	            display: flex;
	            justify-content: center;
	            align-items: center;
	        }

	        .spinner-overlay.hidden {
	            display: none;
	        }
	        .list-group-item{
	        	cursor:pointer;
	        }
		</style>
		<!--begin::Javascript-->
		<script>var hostUrl = "<?=base_url('assets/')?>";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?=base_url('assets/plugins/global/plugins.bundle.js')?>"></script>
		<script src="<?=base_url('assets/js/scripts.bundle.js')?>"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.bootstrap5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.colVis.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
		<!--end::Vendors Javascript-->
		<script src="<?=base_url('assets/plugins/custom/datatables/datatables.bundle.js')?>"></script>
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="<?=base_url('assets/js/widgets.bundle.js')?>"></script>
		<script src="<?=base_url('assets/js/custom/widgets.js')?>"></script>
		<script src="<?=base_url('assets/js/custom/apps/chat/chat.js')?>"></script>
		<script src="<?=base_url('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')?>"></script>
		<!-- <script src="<?=base_url('assets/js/custom/utilities/modals/upgrade-plan.js')?>"></script>
		<script src="<?=base_url('assets/js/custom/utilities/modals/create-app.js')?>"></script>
		<script src="<?=base_url('assets/js/custom/utilities/modals/users-search.js')?>"></script> -->
		<script src="<?=base_url('assets/js/select2.min.js')?>"></script>
		<!--end::Custom Javascript-->
		<script>
			$(document).ready(function(){
				$(".menu-url").click(function(){
					window.location=$(this).data("href");
				});
				$(".select2").select2();
				$(".select2-tag").select2({
					tags: true,
					createTag: function (params) {
				    var term = $.trim(params.term);

				    if (term === '') {
				      return null;
				    }

				    return {
				      id: term,
				      text: term,
				      newTag: true // add additional parameters
				    }
				  }
				});
			});
			
		</script>
		<!--end::Javascript-->

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page bg image-->
			<style>body { background-image: url('assets/media/auth/bg10.jpeg'); } [data-bs-theme="dark"] body { background-image: url('assets/media/auth/bg10-dark.jpeg'); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
						<!--begin::Image-->
						<img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="<?=base_url('assets/media/auth/agency.png')?>" alt="" />
						<img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="<?=base_url('assets/media/auth/agency-dark.png')?>" alt="" />
						<!--end::Image-->
						<!--begin::Title-->
						<h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Advanced Individual</h1>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="text-gray-600 fs-base text-center fw-semibold">Automate & Optimize your Recruitment Process</div>
						<!--end::Text-->
					</div>
					<!--end::Content-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
					<!--begin::Wrapper-->
					<div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
						<!--begin::Content-->
						<div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
							<!--begin::Wrapper-->
							<div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
								<!--begin::Form-->
								<?=form_open('auth/signin',['method'=>'post','class'=>'form w-100','id'=>'kt_sign_in_form'])?>
									<!--begin::Heading-->
									<div class="text-center mb-11">
										<!--begin::Title-->
										<img src="<?=base_url('assets/logo.png')?>"class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-2" >
										<!-- <h1 class="text-dark fw-bolder mb-3">Sign In</h1> -->
										<!--end::Title-->
										<!--begin::Subtitle-->
										<!--end::Subtitle=-->
									</div>
									<!--begin::Heading-->
									<!--end::Login options-->
									<!--end::Separator-->
									<!--begin::Input group=-->
									<div class="fv-row mb-8">
										<!--begin::Email-->
										<input type="text" placeholder="Email" name="username" autocomplete="off" class="form-control bg-transparent" />
										<!--end::Email-->
									</div>
									<!--end::Input group=-->
									<div class="fv-row mb-3">
										<!--begin::Password-->
										<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
										<!--end::Password-->
									</div>
									<!--end::Input group=-->
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
										<div></div>
										<!--begin::Link-->
										<a href="<?=site_url('auth/forget_password')?>" class="link-primary">Forgot Password ?</a>
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Submit button-->
									<div class="d-grid mb-10">
										<button type="submit" id="kt_sign_in_submit" class="btn btn-primary" name="signin" value="1">
											<!--begin::Indicator label-->
											<span class="indicator-label">Sign In</span>
											<!--end::Indicator label-->
											<!--begin::Indicator progress-->
											<span class="indicator-progress">Please wait...
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											<!--end::Indicator progress-->
										</button>
									</div>
									<!--end::Submit button-->
									
								<?=form_close()?>
								<!--end::Form-->
							</div>
							<!--end::Wrapper-->
							<!--begin::Footer-->
							<div class="d-flex flex-stack">
							
							</div>
							<!--end::Footer-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
	</body>
	<!--end::Body-->
	<script>
		function startloading(loaderid){
			$("#"+loaderid).removeClass("hidden");
		}
		function stoploading(loaderid){
			$("#"+loaderid).addClass("hidden");
		}
		// startloading();
	</script>
</html>