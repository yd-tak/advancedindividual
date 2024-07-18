<?php $recentViews=getRecentViews(getLoginSession('id'));?>
<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-animation="false" data-kt-sticky-offset="{default: '0px', lg: '0px'}">
	<!--begin::Header container-->
	<div class="app-container container-fluid d-flex align-items-stretch flex-stack mt-lg-8" id="kt_app_header_container">
		<!--begin::Sidebar toggle-->
		<div class="d-flex align-items-center d-block d-lg-none ms-n3" title="Show sidebar menu">
			<div class="btn btn-icon btn-active-color-primary w-35px h-35px me-1" id="kt_app_sidebar_mobile_toggle">
				<i class="ki-outline ki-abstract-14 fs-2"></i>
			</div>
			<!--begin::Logo image-->
			<a href="../../demo55/dist/index.html">
				<img alt="Logo" src="<?=base_url('assets/media/logos/demo55-small.svg')?>" class="h-25px theme-light-show" />
				<img alt="Logo" src="<?=base_url('assets/media/logos/demo55-small-dark.svg')?>" class="h-25px theme-dark-show" />
			</a>
			<!--end::Logo image-->
		</div>
		<!--end::Sidebar toggle-->
		<!--begin::Navbar-->
		<div class="app-navbar flex-lg-grow-1" id="kt_app_header_navbar">
			<div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1 me-1 me-lg-0">
				<!--begin::Search-->
				<div
				    id="kt-universal-search"
				    class="d-flex align-items-center w-lg-400px"

				    data-kt-search-keypress="true"
				    data-kt-search-min-length="2"
				    data-kt-search-enter="enter"
				    data-kt-search-layout="menu"
				    data-kt-search-responsive="lg"

				    data-kt-menu-trigger="auto"
				    data-kt-menu-permanent="true"
				    data-kt-menu-placement="bottom-start">
					<!--begin::Tablet and mobile search toggle-->
					<div data-kt-search-element="toggle" class="search-toggle-mobile d-flex d-lg-none align-items-center">
						<div class="d-flex">
							<i class="ki-outline ki-magnifier fs-1"></i>
						</div>
					</div>
					<!--end::Tablet and mobile search toggle-->
					<!--begin::Form(use d-none d-lg-block classes for responsive search)-->
					<form data-kt-search-element="form" class="d-none d-lg-block w-100 position-relative mb-5 mb-lg-0" autocomplete="off">
						<!--begin::Hidden input(Added to disable form autocomplete)-->
						<input type="hidden" />
						<!--end::Hidden input-->
						<!--begin::Icon-->
						<i class="ki-outline ki-magnifier search-icon fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-5"></i>
						<!--end::Icon-->
						<!--begin::Input-->
						<input type="text" class="search-input form-control form-control-solid ps-13" name="search" value="" placeholder="Universal Search" data-kt-search-element="input" />
						<!--end::Input-->
						<!--begin::Spinner-->
						<span class="search-spinner position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
							<span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
						</span>
						<!--end::Spinner-->
						<!--begin::Reset-->
						<span class="search-reset btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4" data-kt-search-element="clear">
							<i class="ki-outline ki-cross fs-2 fs-lg-1 me-0"></i>
						</span>
						<!--end::Reset-->
					</form>
					<!--end::Form-->
					<!--begin::Menu-->
					<div data-kt-search-element="content" class="menu menu-sub menu-sub-dropdown py-7 px-7 overflow-hidden w-300px w-md-350px">
						<!--begin::Wrapper-->
						<div data-kt-search-element="wrapper">
							<!--begin::Recently viewed-->
							<div data-kt-search-element="results" class="d-none">
							</div>
							<!--end::Recently viewed-->
							<!--begin::Recently viewed-->
							<div class="" data-kt-search-element="main">
								<!--begin::Heading-->
								<div class="d-flex flex-stack fw-semibold mb-4">
									<!--begin::Label-->
									<span class="text-muted fs-6 me-2">Recently Viewed:</span>
									<!--end::Label-->
									<!--begin::Toolbar-->
									<div class="d-flex" data-kt-search-element="toolbar">
									</div>
									<!--end::Toolbar-->
								</div>
								<!--end::Heading-->
								<!--begin::Items-->
								<div class="scroll-y mh-200px mh-lg-325px">
									<?php foreach($recentViews as $row){?>
									<div class="d-flex align-items-center mb-5">
										<!--begin::Symbol-->
										<div class="symbol symbol-40px me-4">
											<span class="symbol-label bg-light">
												<i class="ki-outline <?=$row->kiicon?> fs-2 text-primary"></i>
											</span>
										</div>
										<!--end::Symbol-->
										<!--begin::Title-->
										<div class="d-flex flex-column">
											<a href="<?=site_url($row->uri)?>" class="fs-6 text-gray-800 text-hover-primary fw-semibold"><?=$row->objectname?></a>
											<span class="fs-7 text-muted fw-semibold"><?=$row->object?></span>
										</div>
										<!--end::Title-->
									</div>
									<?php } ?>
								</div>
								<!--end::Items-->
							</div>
							<!--end::Recently viewed-->
							<!--begin::Empty-->
							<div data-kt-search-element="empty" class="text-center d-none">
								<!--begin::Icon-->
								<div class="pt-10 pb-10">
									<i class="ki-outline ki-search-list fs-4x opacity-50"></i>
								</div>
								<!--end::Icon-->
								<!--begin::Message-->
								<div class="pb-15 fw-semibold">
									<h3 class="text-gray-600 fs-5 mb-2">No result found</h3>
									<div class="text-muted fs-7">Please try again with a different query</div>
								</div>
								<!--end::Message-->
							</div>
							<!--end::Empty-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Menu-->
				</div>
				<!--end::Search-->
			</div>
			<!--begin::Activities-->
			<div class="app-navbar-item ms-1 ms-md-3">
				<!--begin::Menu- wrapper-->
				<span class="badge badge-secondary">Credit: <?=number_format(getCreditBalance())?></span>
				<div class="btn btn-icon btn-custom btn-color-gray-500 btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" id="kt_activities_toggle">
					<i class="ki-outline ki-notification-on fs-2"></i>
				</div>
				<!--end::Menu wrapper-->
			</div>
			<!--end::Activities-->
			<!--begin::Action-->
			<!-- <div class="app-navbar-item ms-1 ms-md-3">
				<a href="#" class="btn btn-flex btn-icon align-self-center fw-bold btn-secondary w-30px w-md-100 h-30px h-md-35px px-4 ms-3" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">
					<i class="ki-outline ki-crown-2 fs-3"></i>
					<span class="d-none d-md-inline ms-2 fs-7">Try Premium</span>
				</a>
			</div> -->
			<!--end::Action-->
		</div>
		<!--end::Navbar-->
	</div>
	<!--end::Header container-->
</div>
<script>
var processs = function(search) {
    var timeout = setTimeout(function() {
        // Hide recently viewed
        recentlyViewedElement.classList.add("d-none");
        var keyword=search.getQuery();
        $.ajax({//do universal search
        	url:"<?=site_url('tools/universalsearch')?>",
        	method:"get",
        	dataType:"json",
        	data:"keyword="+keyword,
        	success:function(response){
        		$(resultsElement).html(response.html);
        		$(emptyElement).addClass("d-none");
        		$(resultsElement).removeClass("d-none");
        		search.complete();
        	},
        	error:function(response){
        		$(emptyElement).removeClass("d-none");
        		$(resultsElement).addClass("d-none");
        		search.complete();
        	}

        });
        // Complete search
        
    }, 1500);
}

var clear = function(search) {
    // Show recently viewed
    recentlyViewedElement.classList.remove("d-none");
    // Hide results
    resultsElement.classList.add("d-none");
    // Hide empty message
    emptyElement.classList.add("d-none");
}

// Elements
element = document.querySelector("#kt-universal-search");


wrapperElement = element.querySelector('[data-kt-search-element="wrapper"]');
recentlyViewedElement = element.querySelector('[data-kt-search-element="main"]');
resultsElement = element.querySelector('[data-kt-search-element="results"]');
emptyElement = element.querySelector('[data-kt-search-element="empty"]');

// Initialize search handler
searchObject = new KTSearch(element);

// Search handler
searchObject.on("kt.search.process", processs);

// Clear handler
searchObject.on("kt.search.clear", clear);


</script>