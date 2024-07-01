<!--begin::Toolbar-->
<div class="toolbar py-5 pb-lg-5" id="kt_toolbar">
	<!--begin::Container-->
	<div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
		<!--begin::Page title-->
		<div class="page-title d-flex flex-column me-3">
			<!--begin::Title-->
			<h1 class="d-flex text-white fw-bold my-1 fs-3"><?=$pagename?></h1>
			<!--end::Title-->
			<!--begin::Breadcrumb-->
			<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">

				<!--begin::Item-->
				<li class="breadcrumb-item text-white opacity-75">
					<a href="<?=site_url()?>" class="text-white text-hover-primary">Home</a>
				</li>
				<!--end::Item-->
				<?php foreach($breadcrumbs as $row){?>
				<!--begin::Item-->
				<li class="breadcrumb-item">
					<span class="bullet bg-white opacity-75 w-5px h-2px"></span>
				</li>
				<!--end::Item-->
				<!--begin::Item-->
				<li class="breadcrumb-item text-white opacity-75"><?=$row?></li>
				<!--end::Item-->
				<?php } ?>
			</ul>
			<!--end::Breadcrumb-->
		</div>
		<!--end::Page title-->
		
	</div>
	<!--end::Container-->
</div>
<!--end::Toolbar-->