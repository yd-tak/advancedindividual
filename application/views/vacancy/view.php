<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<!--begin::Post-->
	<div class="content flex-row-fluid" id="kt_content">
		<!--begin::Navbar-->
		<div class="card mb-5 mb-xxl-8">
			<div class="card-body pt-9 pb-0">
				<div class="d-flex flex-wrap flex-sm-nowrap">
					<!--begin::Info-->
					<div class="flex-grow-1">
						<!--begin::Title-->
						<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
							<!--begin::User-->
							<div class="d-flex flex-column">
								<!--begin::Name-->
								<div class="d-flex align-items-center mb-2">
									<a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"><?=$vacancy->title?></a>
									<a href="#">
										<i class="ki-duotone ki-verify fs-1 text-primary">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</a>
								</div>
								<!--end::Name-->
								<!--begin::Info-->
								
								<div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
									<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
									<i class="ki-duotone ki-profile-circle fs-4 me-1">
										<span class="path1"></span>
										<span class="path2"></span>
										<span class="path3"></span>
									</i><?=$vacancy->jobrole?></a>
									<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
									<i class="ki-duotone ki-geolocation fs-4 me-1">
										<span class="path1"></span>
										<span class="path2"></span>
									</i><?=$vacancy->location?></a>
									<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
									<i class="ki-duotone ki-sms fs-4 me-1">
										<span class="path1"></span>
										<span class="path2"></span>
									</i><?=ucwords($vacancy->arrangement)?></a>
								</div>
								<div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
									<a href="<?=site_url('vacancy/apply/'.$vacancy->id)?>" target="_blank" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2" style="text-decoration: underline;color:blue!important;">
										<i class="fa fa-external-link"></i>&nbsp;Application URL
									</a>
								</div>
								<!--end::Info-->
							</div>
							<!--end::User-->
							<!--begin::Actions-->
							<div class="d-flex">
								<!--begin::Stats-->
								<div class="d-flex flex-wrap">
									<!--begin::Stat-->
									<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
										<!--begin::Number-->
										<div class="d-flex align-items-center">
											<i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
											<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="<?=$vacancy->countcandidate?>" data-kt-countup-prefix="">0</div>
										</div>
										<!--end::Number-->
										<!--begin::Label-->
										<div class="fw-semibold fs-6 text-gray-400">Application</div>
										<!--end::Label-->
									</div>
									<!--end::Stat-->
									<!--begin::Stat-->
									<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
										<!--begin::Number-->
										<div class="d-flex align-items-center">
											<i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
											<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="<?=$vacancy->aiprocessed?>">0</div>
										</div>
										<!--end::Number-->
										<!--begin::Label-->
										<div class="fw-semibold fs-6 text-gray-400">CV Interviewed</div>
										<!--end::Label-->
									</div>
									<!--end::Stat-->
									<!--begin::Stat-->
									<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
										<!--begin::Number-->
										<div class="d-flex align-items-center">
											<i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
											<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="<?=$vacancy->totalcredit?>" data-kt-countup-prefix="">0</div>
										</div>
										<!--end::Number-->
										<!--begin::Label-->
										<div class="fw-semibold fs-6 text-gray-400">Credit Used</div>
										<!--end::Label-->
									</div>
									<!--end::Stat-->
								</div>
								<!--end::Stats-->
							</div>
							<!--end::Actions-->
						</div>
						<!--end::Title-->
					</div>
					<!--end::Info-->
				</div>
				<!--begin::Navs-->
				<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
					<!--begin::Nav item-->
					<li class="nav-item mt-2">
						<a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="<?=site_url('vacancy/view/'.$vacancy->id)?>">Overview</a>
					</li>
					<!--end::Nav item-->
					<?php foreach($vacancy->stages as $vc){?>
					<!--begin::Nav item-->
					<li class="nav-item mt-2">
						<a class="nav-link text-active-primary ms-0 me-10 py-5" href="<?=site_url('vacancy/viewstage/'.$vacancy->id.'/'.$vc->id)?>"><?=$vc->name?>&nbsp;<span class="badge badge-secondary"><?=count($vc->candidates)?></span></a>
					</li>
					<!--end::Nav item-->
					<?php } ?>
					<!--begin::Nav item-->
					
				</ul>
				<!--begin::Navs-->
			</div>
		</div>
		<!--end::Navbar-->
		<!--begin::details View-->
		<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
			<!--begin::Card header-->
			<div class="card-header cursor-pointer">
				<!--begin::Card title-->
				<div class="card-title m-0">
					<h3 class="fw-bold m-0">Vacancy Details</h3>
				</div>
				<!--end::Card title-->
				<!--begin::Action-->
				<a href="../../demo2/dist/account/settings.html" class="btn btn-sm btn-primary align-self-center">Edit Vacancies</a>
				<!--end::Action-->
			</div>
			<!--begin::Card header-->
			<!--begin::Card body-->
			<div class="card-body p-9 row">
				<!--begin::Row-->
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Role</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->jobrole?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Job Title</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->title?></span>
				</div>
				<div class="col-md-3 mb-7">
					<!--begin::Label-->
					<label class="row fw-semibold text-muted">Commitment Type</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->jobcommitment?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Work Arrangement</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->jobcommitment?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Location</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->location?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Department</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->department?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Salary</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=number_format($vacancy->minsalary)." to ".number_format($vacancy->maxsalary)?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Gender</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->gender?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Age</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->age?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Min Education</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->mindegree?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Work Experience</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->workexp?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Tech Skills</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->techskill_str?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Soft Skills</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->softskill_str?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Language</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->language_str?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Certification</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->certification_str?></span>
				</div>
				<div class="col-md-3 mb-7">
					<label class="row fw-semibold text-muted">Online Test</label>
					<span class="fw-semibold text-gray-800 fs-6"><?=$vacancy->test_str?></span>
				</div>
			</div>
			<!--end::Card body-->
		</div>
		<!--end::details View-->
	</div>
	<!--end::Post-->
</div>