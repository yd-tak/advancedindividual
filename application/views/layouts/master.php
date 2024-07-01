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
	        .dt-action-button{
	        	display: block;
	        	position: fixed;
	        	margin-top:20px;
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
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<?php if(!isset($hideheader) || !$hideheader){?>
						<?php $this->load->view('layouts/header',$view)?>
						
					<?php } ?>
					<?php if(!isset($hidetoolbar) || !$hidetoolbar){?>
						<?php $this->load->view('layouts/toolbar',$view)?>
					<?php } ?>
					<?= $view['content']?>
					<?php $this->load->view('layouts/modal',$view)?>
					<?php $this->load->view('layouts/footer',$view)?>
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--begin::Drawers-->
		<?php $this->load->view('layouts/activities',$view)?>
		<!--end::Drawers-->
		<!--end::Main-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-duotone ki-arrow-up">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>
		<!--end::Scrolltop-->
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