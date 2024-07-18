<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<div class="content flex-row-fluid" id="kt_content">
		<div class="card">
			<div class="card-header" style="background: #f7f7f7;padding:20px 20px 0px 20px">
				<!--begin::Modal title-->
				<h2 class="fw-bold">
					<?=$candidate->name?>
						<br>
						<p class="fs-12">
						<?=$candidate->address?> | <?=$candidate->phone?> | <?=$candidate->workexp." years of experience"?>
						</p>
				
				</h2>
				<!--end::Modal title-->
			</div>
			<div class="card-body">
				<div class="card-body pt-0 pb-0">
					<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold p-5" id="candidate-tab" role="tablist" style="background: white;">
						<li class="nav-item mt-2" role="presentation">
							<button class="nav-link text-active-primary ms-0 me-10 py-5 active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#candidate-profile" type="button" role="tab" >Profile</button>
						</li>
						<li class="nav-item mt-2" role="presentation">
							<button class="nav-link text-active-primary ms-0 me-10 py-5" id="workexp-tab" data-bs-toggle="tab" data-bs-target="#candidate-workexp" type="button" role="tab" >Work Experience</button>
						</li>
						<li class="nav-item mt-2 d-none" role="presentation">
							<button class="nav-link text-active-primary ms-0 me-10 py-5" id="project-tab" data-bs-toggle="tab" data-bs-target="#candidate-project" type="button" role="tab" >Projects</button>
						</li>
						<li class="nav-item mt-2" role="presentation">
							<button class="nav-link text-active-primary ms-0 me-10 py-5" id="education-tab" data-bs-toggle="tab" data-bs-target="#candidate-education" type="button" role="tab" >Educations</button>
						</li>
						<li class="nav-item mt-2" role="presentation">
							<button class="nav-link text-active-primary ms-0 me-10 py-5" id="cv-tab" data-bs-toggle="tab" data-bs-target="#candidate-cv" type="button" role="tab" >CV</button>
						</li>
					</ul>
					<div class="tab-content mt-5" id="candidate-tabcontent">
						<div class="tab-pane show active p-5" id="candidate-profile" role="tabpanel" style="background: white;">
							<div class="row p-5">
								<div class="col-md-4 mb-7">
									<label class="row fw-semibold text-muted">Name</label>
									<span class="fw-semibold text-gray-800 fs-6"><?=$candidate->name?></span>
								</div>
								<div class="col-md-4 mb-7">
									<label class="row fw-semibold text-muted">Email</label>
									<span class="fw-semibold text-gray-800 fs-6"><?=$candidate->email?></span>
								</div>
								<div class="col-md-4 mb-7">
									<label class="row fw-semibold text-muted">Phone</label>
									<span class="fw-semibold text-gray-800 fs-6"><?=$candidate->phone?></span>
								</div>
								<div class="col-md-4 mb-7">
									<label class="row fw-semibold text-muted">Age</label>
									<span class="fw-semibold text-gray-800 fs-6"><?=$candidate->age?></span>
								</div>
								<div class="col-md-4 mb-7">
									<label class="row fw-semibold text-muted">Address</label>
									<span class="fw-semibold text-gray-800 fs-6"><?=$candidate->address?></span>
								</div>
							</div>
							<hr>
							<div class="row p-5">
								<div class="col-md-6 mb-7">
									<label class="row fw-semibold text-muted">Technical Skills</label>
									<?php foreach($candidate->techskills as $skill){?>
										<span class="badge badge-lg badge-light fw-bold"><?=$skill?></span>
									<?php } ?>
								</div>
								<div class="col-md-6 mb-7">
									<label class="row fw-semibold text-muted">Soft Skills</label>
									<?php foreach($candidate->softskills as $skill){?>
										<span class="badge badge-lg badge-light fw-bold"><?=$skill?></span>
									<?php } ?>
								</div>
								<div class="col-md-6 mb-7">
									<label class="row fw-semibold text-muted">Language Skills</label>
									<?php foreach($candidate->languages as $skill){?>
										<span class="badge badge-lg badge-light fw-bold"><?=$skill?></span>
									<?php } ?>
								</div>
								<div class="col-md-6 mb-7">
									<label class="row fw-semibold text-muted">Certifications</label>
									<?php foreach($candidate->certifications as $skill){?>
										<span class="badge badge-lg badge-light fw-bold"><?=$skill?></span>
									<?php } ?>
								</div>
							</div>
							<hr>
						</div>
						<div class="tab-pane" id="candidate-workexp" role="tabpanel">
							<div class="row">
							<?php foreach($candidate->workexps as $row){?>
								<div class="col-md-6">
									<div class="card border-hover-primary mb-5">
										<div class="card-body p-9">
											<div class="fs-3 fw-bold text-dark"><?=$row->position?></div>
											<p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7"><?=$row->company?></p>
											<div class="d-flex flex-wrap mb-5">
												<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
													<div class="fs-6 text-gray-800 fw-bold"><?=($row->startyear)?></div>
													<div class="fw-semibold text-gray-400">From</div>
												</div>
												<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
													<div class="fs-6 text-gray-800 fw-bold"><?=($row->endyear)?></div>
													<div class="fw-semibold text-gray-400">Until</div>
												</div>
											</div>
											<p class="fs-5 mt-1"><?=$row->responsibilities?></p>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
						</div>
						<div class="tab-pane" id="candidate-project" role="tabpanel">
							<div class="row">
							<?php foreach($candidate->projects as $row){?>
								<div class="col-md-6">
									<div class="card border-hover-primary mb-5">
										<div class="card-body p-9">
											<div class="fs-3 fw-bold text-dark"><?=$row->projectname?></div>
											<p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7"><?=$row->projecturl?></p>
											<div class="d-flex flex-wrap mb-5">
												<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
													<div class="fs-6 text-gray-800 fw-bold"><?=($row->startyear).' - '.($row->endyear)?></div>
													<div class="fw-semibold text-gray-400">Length of Study</div>
												</div>
											</div>
											<p class="fs-5 mt-1"><?=$row->role?></p>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
						</div>
						<div class="tab-pane" id="candidate-education" role="tabpanel">
							<div class="row">
							<?php foreach($candidate->educations as $row){?>
								<div class="col-md-6">
									<div class="card border-hover-primary mb-5">
										<div class="card-body p-9">
											<div class="fs-3 fw-bold text-dark"><?=$row->degree?></div>
											<p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7"><?=$row->institution?></p>
											<div class="d-flex flex-wrap mb-5">
												<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
													<div class="fs-6 text-gray-800 fw-bold"><?=($row->startyear).' - '.($row->endyear)?></div>
													<div class="fw-semibold text-gray-400">Length of Study</div>
												</div>
												<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
													<div class="fs-6 text-gray-800 fw-bold"><?=$row->gpa?></div>
													<div class="fw-semibold text-gray-400">GPA</div>
												</div>
											</div>
											<p class="fs-5 mt-1"><?=$row->field?></p>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
						</div>
						<div class="tab-pane" id="candidate-cv" role="tabpanel" style="background: white;padding:10px;">
							<?php if($candidate->cvfile!=null){?>
								<iframe width="100%" height="600px" src="<?=base_url('assets/uploads/cvs/'.$candidate->cvfile)?>"></iframe>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
</script>