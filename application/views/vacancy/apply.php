<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<div class="content flex-row-fluid" id="kt_content">
		<!--begin::Careers - List-->
		<div class="card">
			<!--begin::Body-->
			<div class="card-body p-lg-17">
				
				<!--begin::Layout-->
				<div class="d-flex flex-column flex-lg-row mb-17">
					<!--begin::Content-->
					<div class="flex-lg-row-fluid me-0 me-lg-20">
						<!--begin::Job-->
						<div class="mb-17">
							<!--begin::Description-->
							<div class="m-0">
								<!--begin::Title-->
								<h4 class="fs-1 text-gray-800 w-bolder mb-6"><?=$vacancy->title?></h4>
								<!--end::Title-->
								<!--begin::Text-->
								<p class="fw-semibold fs-4 text-gray-600 mb-2"><?=$vacancy->jobdesc?></p>
								<!--end::Text-->
							</div>
							<!--end::Description-->
							<!--begin::Accordion-->
							<!--begin::Section-->
							<div class="m-0">
								<!--begin::Heading-->
								<div class="d-flex align-items-center collapsible py-3 toggle mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_1_1">
									<!--begin::Icon-->
									<div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
										<i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
										<i class="ki-duotone ki-plus-square toggle-off fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</div>
									<!--end::Icon-->
									<!--begin::Title-->
									<h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Job Details & Type</h4>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Body-->
								<div id="kt_job_1_1" class="collapse show fs-6 ms-1">
									<!--begin::Item-->
									<div class="mb-4">
										<!--begin::Item-->
										<div class="d-flex align-items-center ps-10 mb-n1">
											<!--begin::Bullet-->
											<span class="bullet me-3"></span>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="text-gray-600 fw-semibold fs-6">Job Role: <?=$vacancy->jobrole?></div>
											<!--end::Label-->
										</div>
										<!--end::Item-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="mb-4">
										<!--begin::Item-->
										<div class="d-flex align-items-center ps-10 mb-n1">
											<!--begin::Bullet-->
											<span class="bullet me-3"></span>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="text-gray-600 fw-semibold fs-6">Job Title: <?=$vacancy->title?></div>
											<!--end::Label-->
										</div>
										<!--end::Item-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="mb-4">
										<!--begin::Item-->
										<div class="d-flex align-items-center ps-10 mb-n1">
											<!--begin::Bullet-->
											<span class="bullet me-3"></span>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="text-gray-600 fw-semibold fs-6">Commitment Type: <?=$vacancy->jobcommitment?></div>
											<!--end::Label-->
										</div>
										<!--end::Item-->
									</div>
									<!--end::Item-->
								</div>
								<!--end::Content-->
								<!--begin::Separator-->
								<div class="separator separator-dashed"></div>
								<!--end::Separator-->
							</div>
							<!--end::Section-->
							<!--begin::Section-->
							<div class="m-0">
								<!--begin::Heading-->
								<div class="d-flex align-items-center collapsible py-3 toggle mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_1_2">
									<!--begin::Icon-->
									<div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
										<i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
										<i class="ki-duotone ki-plus-square toggle-off fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</div>
									<!--end::Icon-->
									<!--begin::Title-->
									<h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Job Placement</h4>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Body-->
								<div id="kt_job_1_2" class="collapse show fs-6 ms-1">
									<!--begin::Item-->
									<div class="mb-4">
										<!--begin::Item-->
										<div class="d-flex align-items-center ps-10 mb-n1">
											<!--begin::Bullet-->
											<span class="bullet me-3"></span>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="text-gray-600 fw-semibold fs-6">Work Arrangement: <?=$vacancy->arrangement?></div>
											<!--end::Label-->
										</div>
										<!--end::Item-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="mb-4">
										<!--begin::Item-->
										<div class="d-flex align-items-center ps-10 mb-n1">
											<!--begin::Bullet-->
											<span class="bullet me-3"></span>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="text-gray-600 fw-semibold fs-6">Departments: <?=$vacancy->department?></div>
											<!--end::Label-->
										</div>
										<!--end::Item-->
									</div>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="mb-4">
										<!--begin::Item-->
										<div class="d-flex align-items-center ps-10 mb-n1">
											<!--begin::Bullet-->
											<span class="bullet me-3"></span>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="text-gray-600 fw-semibold fs-6">Work Location: <?=$vacancy->location?></div>
											<!--end::Label-->
										</div>
										<!--end::Item-->
									</div>
									<!--end::Item-->
								</div>
								<!--end::Content-->
								<!--begin::Separator-->
								<div class="separator separator-dashed"></div>
								<!--end::Separator-->
							</div>
							<!--end::Section-->
							<!--begin::Section-->
							<div class="m-0">
								<!--begin::Heading-->
								<div class="d-flex align-items-center collapsible py-3 toggle mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_1_3">
									<!--begin::Icon-->
									<div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
										<i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
										<i class="ki-duotone ki-plus-square toggle-off fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</div>
									<!--end::Icon-->
									<!--begin::Title-->
									<h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Test Screening</h4>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Body-->
								<div id="kt_job_1_3" class="collapse show fs-6 ms-1">
									<?php foreach($vacancy->tests as $row){?>
									<!--begin::Item-->
									<div class="mb-4">
										<!--begin::Item-->
										<div class="d-flex align-items-center ps-10 mb-n1">
											<!--begin::Bullet-->
											<span class="bullet me-3"></span>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="text-gray-600 fw-semibold fs-6"><?=$row->test?></div>
											<!--end::Label-->
										</div>
										<!--end::Item-->
									</div>
									<!--end::Item-->
									<?php } ?>
									
								</div>
								<!--end::Content-->
								<!--begin::Separator-->
								<div class="separator separator-dashed"></div>
								<!--end::Separator-->
							</div>
							<!--end::Section-->
							<!--end::Accordion-->
							<div class="mt-10">
								<!--begin::Title-->
								<h4 class="fs-1 text-gray-800 w-bolder mb-6">Submit your Application</h4>
								<!--end::Title-->
								
							</div>
							
							<div class="m-0">
								<!--begin::Heading-->
								<div class="align-items-center py-3 toggle mb-0">
									<?php if(isset($status) && $status=='success'){?>
									<div class="notice d-flex bg-light-success rounded border-success border border-dashed p-6">
										<!--begin::Icon-->
										<i class="ki-duotone ki-information fs-2tx text-success me-4">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
										<!--end::Icon-->
										<!--begin::Wrapper-->
										
										<div class="d-flex flex-stack flex-grow-1">
											<!--begin::Content-->
											<div class="fw-semibold">
												<h4 class="text-gray-900 fw-bold">Thank you for your application, we'll update you via E-Mail.<br>Please make sure to check your E-Mail periodically.</h4>
												
											</div>
											<!--end::Content-->
										</div>
										
										<!--end::Wrapper-->
									</div>
									<?php } ?>
									
									<?=form_open_multipart('vacancy/applyp',['method'=>'post','class'=>'form-horizontal','id'=>'apply-form'])?>
										<input type="hidden" value="<?=$vacancy->id?>" name="vacancyid">
										<!--begin::Input group-->
										<div class="row mb-5">
											<!--begin::Col-->
											<div class="col-md-6 fv-row">
												<!--begin::Label-->
												<label class="fs-5 fw-semibold mb-2">First Name</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="" name="firstname" />
												<!--end::Input-->
											</div>
											<!--end::Col-->
											<!--begin::Col-->
											<div class="col-md-6 fv-row">
												<!--end::Label-->
												<label class="fs-5 fw-semibold mb-2">Last Name</label>
												<!--end::Label-->
												<!--end::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="" name="lastname" />
												<!--end::Input-->
											</div>
											<!--end::Col-->
										</div>
										<div class="row mb-5">
											<!--begin::Col-->
											<div class="col-md-6 fv-row">
												<!--begin::Label-->
												<label class="fs-5 fw-semibold mb-2">Email</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="" name="email" />
												<!--end::Input-->
											</div>
											<!--end::Col-->
											<!--begin::Col-->
											<div class="col-md-6 fv-row">
												<!--end::Label-->
												<label class="fs-5 fw-semibold mb-2">Phone (+62)</label>
												<!--end::Label-->
												<!--end::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="8..." name="phone" />
												<!--end::Input-->
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="row mb-5">
											<!--begin::Col-->
											<div class="col-md-12 fv-row">
												<!--begin::Label-->
												<label class="fs-5 fw-semibold mb-2">CV</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input class="form-control form-control-solid" type="file" placeholder="Upload your CV" name="userfile" required />
												<!--end::Input-->
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										
										<!--begin::Input group-->
										<div class="d-flex flex-column mb-8">
											<label class="fs-6 fw-semibold mb-2">Why we should hire you?</label>
											<textarea class="form-control form-control-solid" rows="4" name="application" placeholder=""></textarea>
										</div>
										<!--end::Input group-->
										<!--begin::Separator-->
										<div class="separator mb-8"></div>
										<!--end::Separator-->
										<!--begin::Submit-->
										<button type="submit" class="btn btn-primary" id="submit-btn">
											Apply Now
										</button>
										<!--end::Submit-->
									<?=form_close()?>
								</div>
							</div>
						</div>
						<!--end::Job-->
					</div>
					<!--end::Content-->
					<!--begin::Sidebar-->
					<div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px">
						<!--begin::Careers about-->
						<div class="card bg-light">
							<!--begin::Body-->
							<div class="card-body">
								<!--begin::Top-->
								<div class="mb-7">
									<!--begin::Title-->
									<h2 class="fs-1 text-gray-800 w-bolder mb-6">Job Requirements</h2>
									<!--end::Title-->
									<!--begin::Text-->
									<p class="fw-semibold fs-6 text-gray-600"></p>
									<!--end::Text-->
								</div>
								<!--end::Top-->
								<!--begin::Item-->
								<div class="mb-8">
									<!--begin::Title-->
									<h4 class="text-gray-700 w-bolder mb-0">Salary</h4>
									<!--end::Title-->
									<!--begin::Section-->
									<div class="my-2">
										<!--begin::Row-->
										<div class="d-flex align-items-center mb-3">
											<!--begin::Bullet-->
											<span class="bullet me-3"></span>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="text-gray-600 fw-semibold fs-6"><?=number_format($vacancy->minsalary)." to ".number_format($vacancy->maxsalary)?></div>
											<!--end::Label-->
										</div>
										<!--end::Row-->
										
									</div>
									<!--end::Section-->
								</div>
								<!--end::Item-->
								<!--begin::Item-->
								<div class="mb-8">
									<!--begin::Title-->
									<h4 class="text-gray-700 w-bolder mb-0">Candidate Profile</h4>
									<!--end::Title-->
									<!--begin::Section-->
									<div class="my-2">
										<!--begin::Row-->
										<div class="d-flex align-items-center mb-3">
											<!--begin::Bullet-->
											<span class="bullet me-3"></span>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="text-gray-600 fw-semibold fs-6">Age: <?=$vacancy->age?></div>
											<!--end::Label-->
										</div>
										<!--end::Row-->
										<!--begin::Row-->
										<div class="d-flex align-items-center mb-3">
											<!--begin::Bullet-->
											<span class="bullet me-3"></span>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="text-gray-600 fw-semibold fs-6">Experience: <?=$vacancy->workexp?></div>
											<!--end::Label-->
										</div>
										<!--end::Row-->
										<!--begin::Row-->
										<div class="d-flex align-items-center">
											<!--begin::Bullet-->
											<span class="bullet me-3"></span>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="text-gray-600 fw-semibold fs-6">Education: <?=$vacancy->mindegree?></div>
											<!--end::Label-->
										</div>
										<!--end::Row-->
									</div>
									<!--end::Section-->
								</div>
								<div class="mb-8">
									<!--begin::Title-->
									<h4 class="text-gray-700 w-bolder mb-0">Technical Skills</h4>
									<!--end::Title-->
									<!--begin::Section-->
									<div class="my-2">
										<!--begin::Row-->
										<?php foreach($vacancy->techskills as $skill){?>
											<span class="badge badge-success"><?=$skill?></span>
										<?php } ?>
									</div>
									<!--end::Section-->
								</div>
								<div class="mb-8">
									<!--begin::Title-->
									<h4 class="text-gray-700 w-bolder mb-0">Soft Skills</h4>
									<!--end::Title-->
									<!--begin::Section-->
									<div class="my-2">
										<!--begin::Row-->
										<?php foreach($vacancy->softskills as $skill){?>
											<span class="badge badge-primary"><?=$skill?></span>
										<?php } ?>
									</div>
									<!--end::Section-->
								</div>
								<!--end::Item-->
								<div class="mb-8">
									<!--begin::Title-->
									<h4 class="text-gray-700 w-bolder mb-0">Languages</h4>
									<!--end::Title-->
									<!--begin::Section-->
									<div class="my-2">
										<!--begin::Row-->
										<?php foreach($vacancy->languages as $skill){?>
											<span class="badge badge-secondary"><?=$skill?></span>
										<?php } ?>
									</div>
									<!--end::Section-->
								</div>
								<div class="mb-8">
									<!--begin::Title-->
									<h4 class="text-gray-700 w-bolder mb-0">Certifications</h4>
									<!--end::Title-->
									<!--begin::Section-->
									<div class="my-2">
										<!--begin::Row-->
										<?php foreach($vacancy->certifications as $skill){?>
											<span class="badge badge-dark"><?=$skill?></span>
										<?php } ?>
									</div>
									<!--end::Section-->
								</div>
								<!--begin::Link-->
								
								<!--end::Link-->
							</div>
							<!--end::Body-->
						</div>
						<!--end::Careers about-->
					</div>
					<!--end::Sidebar-->
				</div>
				<!--end::Layout-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Careers - List-->
	</div>
	<!--end::Post-->
</div>
<script>
	$("#apply-form").submit(function(e){
		$("#submit-btn").html("Loading... DO NOT CLOSE THIS WINDOW!");
		$("#submit-btn").prop("disabled",true);
	});
</script>