<div class="scroll-y mh-200px mh-lg-350px">
	<h3 class="fs-5 text-muted m-0 pb-5" data-kt-search-element="category-title">Candidates</h3>

		<?php foreach($searchresults as $row){
			if($row->type!='candidate')continue;
			?>
			<a href="<?=site_url($row->uri)?>" class="d-flex text-dark text-hover-primary align-items-center mb-5">
				<div class="symbol symbol-40px me-4">
					<i class="ki-outline ki-user"></i>
				</div>
				<div class="d-flex flex-column justify-content-start fw-semibold">
					<span class="fs-6 fw-semibold"><?=$row->title?></span>
					<span class="fs-7 fw-semibold text-muted"><?=$row->desc?></span>
				</div>
			</a>
		<?php } ?>
	
	<h3 class="fs-5 text-muted m-0 pt-5 pb-5" data-kt-search-element="category-title">Job Vacancies</h3>
	
		<?php foreach($searchresults as $row){
			if($row->type!='vacancy')continue;
			?>
			<a href="<?=site_url($row->uri)?>" class="d-flex text-dark text-hover-primary align-items-center mb-5">
				<div class="symbol symbol-40px me-4">
					<span class="symbol-label bg-light">
						<i class="ki-outline ki-abstract-20"></i>
					</span>
				</div>
				<div class="d-flex flex-column justify-content-start fw-semibold">
					<span class="fs-6 fw-semibold"><?=$row->title?></span>
					<span class="fs-7 fw-semibold text-muted"><?=$row->desc?></span>
				</div>
			</a>
		<?php } ?>
</div>