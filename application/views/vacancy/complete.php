<style>
    .workexp-entry, .education-entry {
        background-color: #f8f9fa; /* Light grey background */
        border: 1px solid #dee2e6; /* Light border */
        border-radius: 0.25rem; /* Rounded corners */
        padding: 1rem; /* Padding inside the card */
        margin-bottom: 1rem; /* Space between cards */
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Light shadow for depth */
    }
    .workexp-entry .card-body, .education-entry .card-body {
        padding: 0; /* Remove padding from card body */
    }
    .workexp-entry .row, .education-entry .row {
        margin: 0; /* Remove row margins */
    }
    .workexp-entry .fv-row, .education-entry .fv-row {
        margin-bottom: 1rem; /* Space between form fields */
    }
    .workexp-entry label, .education-entry label {
        font-weight: 600; /* Bold labels */
    }
    .workexp-entry input, .education-entry input,
    .workexp-entry textarea, .education-entry textarea,
    input, textarea {
        background-color: #ffffff!important; /* White background for inputs */
    }
</style>


<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<div class="content flex-row-fluid" id="kt_content">
		<!--begin::Careers - List-->
		<div class="card">
			<!--begin::Body-->
			<div class="card-body p-lg-17">
				
				<!--begin::Layout-->
				<div class="d-flex flex-column flex-lg-row">
					<!--begin::Content-->
					<div class="flex-lg-row-fluid me-0 me-lg-20">
						<!--begin::Job-->
						<div class="">
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
												<h4 class="text-gray-900 fw-bold">Please complete your Application Data.</h4>
												
											</div>
											<!--end::Content-->
										</div>
										
										<!--end::Wrapper-->
									</div>
									<?php } ?>
									
									
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
				<div class="d-flex flex-column flex-lg-row">
					<div class="flex-lg-row-fluid me-0 me-lg-20">
						<!--end::Accordion-->
						<div class="mt-10">
							<!--begin::Title-->
							<h4 class="fs-1 text-gray-800 w-bolder mb-6">Complete your Application</h4>
							<!--end::Title-->
							
						</div>
						
						<?= form_open('vacancy/completep', ['method' => 'post', 'class' => 'form-horizontal']) ?>
							<input type="hidden" value="<?= $vcid ?>" name="vcid">

							<!-- General Information -->
							<div class="row mb-5">
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">First Name</label>
							        <input type="text" class="form-control form-control-solid form-control-sm" name="firstname" value="<?= $candidate->firstname ?>" required/>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Last Name</label>
							        <input type="text" class="form-control form-control-solid form-control-sm" name="lastname" value="<?= $candidate->lastname ?>" required/>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Email</label>
							        <input type="email" class="form-control form-control-solid form-control-sm" name="email" value="<?= $candidate->email ?>" required/>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Phone (+62)</label>
							        <input type="text" class="form-control form-control-solid form-control-sm" name="phone" value="<?= $candidate->phone ?>" required/>
							    </div>
							</div>

							<div class="row mb-5">
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Gender</label>
							        <select class="form-select form-control-solid form-select-sm" name="gender" required>
							            <option value="">Select Gender</option>
							            <option value="male" <?= $candidate->gender == 'male' ? 'selected' : '' ?>>Male</option>
							            <option value="female" <?= $candidate->gender == 'female' ? 'selected' : '' ?>>Female</option>
							            <option value="other" <?= $candidate->gender == 'other' ? 'selected' : '' ?>>Other</option>
							        </select>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Date of Birth</label>
							        <input type="text" class="form-control form-control-solid form-control-sm " placeholder="YYYY-MM-DD" name="dob" value="<?= $candidate->dob ?>" required/>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Age</label>
							        <input type="number" class="form-control form-control-solid form-control-sm" name="age" value="<?= $candidate->age ?>" required/>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Work Experience (Years)</label>
							        <input type="text" class="form-control form-control-solid form-control-sm" name="workexp" value="<?= $candidate->workexp ?>" required/>
							    </div>
							</div>

							<div class="row mb-5">
							    <div class="col-md-12 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Address</label>
							        <input type="text" class="form-control form-control-solid form-control-sm" name="address" value="<?= $candidate->address ?>" required/>
							    </div>
							</div>

							<div class="separator mb-3"></div>

							<!-- Work Experience -->
							<h4 class="mb-3">Work Experience</h4>
							<div id="workexp-section">
							    <?php foreach ($candidate->workexps as $workexp) : ?>
							    <div class="card mb-5 workexp-entry">
							        <div class="card-body">
							            <div class="row">
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Company</label>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="workexps[company][]" value="<?= $workexp->company ?>" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Position</label>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="workexps[position][]" value="<?= $workexp->position ?>" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Start Year</label>
							                    <input type="number" class="form-control form-control-solid form-control-sm" name="workexps[startyear][]" value="<?= $workexp->startyear ?>" min="1900" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">End Year</label>
							                    <input type="number" class="form-control form-control-solid form-control-sm" name="workexps[endyear][]" value="<?= $workexp->endyear ?>" min="1900" required/>
							                </div>
							                <div class="col-md-12 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Responsibilities</label>
							                    <textarea class="form-control form-control-solid form-control-sm" name="workexps[responsibilities][]"><?= $workexp->responsibilities ?></textarea>
							                </div>
							                <div class="col-md-12 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Achievements</label>
							                    <textarea class="form-control form-control-solid form-control-sm" name="workexps[achievements][]"><?= $workexp->achievements ?></textarea>
							                </div>
							            </div>
							        </div>
							    </div>
							    <?php endforeach; ?>
							</div>
							<button type="button" class="btn btn-secondary mb-5" id="add-workexp">Add Work Experience</button>

							<div class="separator mb-3"></div>

							<!-- Education History -->
							<h4 class="mb-3">Education History</h4>
							<div id="education-section">
							    <?php foreach ($candidate->educations as $education) : ?>
							    <div class="card mb-5 education-entry">
							        <div class="card-body">
							            <div class="row">
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Degree</label>
							                    <select class="form-select form-control-solid form-select-sm" name="educations[degree][]" required>
							                    	<option value="">Please Choose</option>
							                    	<?php foreach($degrees as $row){?>
														<option value="<?=$row->name?>" <?= $education->degree == $row->name ? 'selected' : '' ?>><?=$row->name?></option>
													<?php }?>
							                    </select>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Institution</label>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="educations[institution][]" value="<?= $education->institution ?>" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Field of Study</label>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="educations[field][]" value="<?= $education->field ?>" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Start Year</label>
							                    <input type="number" class="form-control form-control-solid form-control-sm" name="educations[startyear][]" value="<?= $education->startyear ?>" min="1900" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">End Year</label>
							                    <input type="number" class="form-control form-control-solid form-control-sm" name="educations[endyear][]" value="<?= $education->endyear ?>"  min="1900"required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">GPA</label>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="educations[gpa][]" value="<?= $education->gpa ?>"/>
							                </div>
							                <div class="col-md-12 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Notes</label>
							                    <textarea class="form-control form-control-solid form-control-sm" name="educations[notes][]"><?= $education->notes ?></textarea>
							                </div>
							            </div>
							        </div>
							    </div>
							    <?php endforeach; ?>
							</div>
							<button type="button" class="btn btn-secondary mb-5" id="add-education">Add Education</button>
							
							<div class="separator mb-3"></div>
							
							<!-- Skills -->
							<h4 class="mb-3">Skills</h4>
							<div id="skills-section">
							    <table class="table table-bordered table-sm">
							        <thead>
							            <tr>
							                <th>Skill</th>
							                <th>Proficiency Level</th>
							                <th>Action</th>
							            </tr>
							        </thead>
							        <tbody>
							            <?php foreach ($candidate->skills as $skill) : ?>
							            <tr class="skills-entry">
							                <td>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="skills[skill][]" value="<?= $skill->skill ?>"/>
							                </td>
							                <td>
							                    <select class="form-select form-control-solid form-select-sm" name="skills[proficiencylevel][]">
							                    	<option value="">Please Select</option>
							                    	<option value="Beginner" <?= ($skill->proficiencylevel=='Beginner')?'selected':'' ?>>Beginner</option>
							                    	<option value="Intermediate" <?= ($skill->proficiencylevel=='Intermediate')?'selected':'' ?>>Intermediate</option>
							                    	<option value="Advanced" <?= ($skill->proficiencylevel=='Advanced')?'selected':'' ?>>Advanced</option>
							                    	<option value="Expert" <?= ($skill->proficiencylevel=='Expert')?'selected':'' ?>>Expert</option>
							                    </select>
							                </td>
							                <td>
							                    <button type="button" class="btn btn-danger remove-skill btn-sm">Remove</button>
							                </td>
							            </tr>
							            <?php endforeach; ?>
							        </tbody>
							    </table>
							</div>
							<button type="button" class="btn btn-secondary mb-5" id="add-skill">Add Skill</button>

							<div class="separator mb-8"></div>

							<!-- Submit Button -->
							<button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
							    <span class="indicator-label">Confirm your Application</span>
							    <span class="indicator-progress">Please wait...
							    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>

						<?= form_close() ?>

					</div>
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
$(document).ready(function() {
    $('#add-workexp').click(function() {
        $('#workexp-section').append(`
            <div class="card mb-5 workexp-entry">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Company</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="workexps[company][]" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Position</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="workexps[position][]" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Start Year</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" name="workexps[startyear][]" min="1900" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">End Year</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" name="workexps[endyear][]" min="1900" required/>
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Responsibilities</label>
                            <textarea class="form-control form-control-solid form-control-sm" name="workexps[responsibilities][]"></textarea>
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Achievements</label>
                            <textarea class="form-control form-control-solid form-control-sm" name="workexps[achievements][]"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `);
    });

    $('#add-education').click(function() {
        $('#education-section').append(`
            <div class="card mb-5 education-entry">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Degree</label>
                            <select class="form-select form-control-solid form-select-sm" name="educations[degree][]" required>
                                <option value="">Please Choose</option>
                                <?php foreach($degrees as $row){?>
                                    <option value="<?=$row->name?>"><?=$row->name?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Institution</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="educations[institution][]" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Field of Study</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="educations[field][]" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Start Year</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" name="educations[startyear][]" min="1900" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">End Year</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" name="educations[endyear][]" min="1900" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">GPA</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="educations[gpa][]"/>
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Notes</label>
                            <textarea class="form-control form-control-solid form-control-sm" name="educations[notes][]"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `);
    });

    $('#add-skill').click(function() {
        $('#skills-section tbody').append(`
            <tr class="skills-entry">
                <td>
                    <input type="text" class="form-control form-control-solid form-control-sm" name="skills[skill][]" />
                </td>
                <td>
                    <select class="form-select form-control-solid form-select-sm" name="skills[proficiencylevel][]">
                        <option value="">Please Select</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                        <option value="Expert">Expert</option>
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-skill">Remove</button>
                </td>
            </tr>
        `);
    });

    // Delegate event to dynamically added elements
    $(document).on('click', '.remove-skill', function() {
        $(this).closest('tr').remove();
    });

});
</script>
