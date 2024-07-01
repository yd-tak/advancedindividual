<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<!--begin::Post-->
	<div class="content flex-row-fluid" id="kt_content">
		<div class="spinner-overlay hidden" id="content-page-loader">
	        <div class="spinner-border text-primary" role="status">
	            <span class="sr-only">Loading...</span>
	        </div>
	    </div>
		
		<!--begin::Layout-->
		<?=form_open('vacancy/add',['id'=>'vacancy-form'])?>
		<div class="d-flex flex-column flex-lg-row">
			<!--begin::Content-->
			
			<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
				
				<div class="card mb-10">
					<div class="card-body p-8">
						<div class="d-flex flex-column align-items-start flex-xxl-row">
							<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" title="">
								<span class="fs-1-5rem fw-bold text-gray-800">Job Details & Type</span>
							</div>
						</div>
						<div class="separator separator-dashed my-10"></div>
						<div class="mb-0">
							<div class="row gx-10 mb-5">
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Interview Language <span class="required"></span></label>
									<div class="mb-5">
										<select class="form-select select2" name="interviewlang" id="interview-lang" required>
											<option value="Indonesia">Indonesia</option>
											<option value="English">English</option>
										</select>
									</div>
								</div>
							</div>
							
							<div class="row gx-10 mb-5">
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Job Role <span class="required"></span></label>
									<div class="mb-5">
										<select class="form-select select2" name="jobroleid" id="job-role-id" required>
											<option value="">-- Select Job Role --</option>
											<?php foreach($jobroles as $row){?>
											<option value="<?=$row->id?>"><?=$row->name?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Job Title <span class="required"></span></label>
									<div class="mb-5">
										<input type="text" class="form-control" placeholder="Enter Job Title" id="job-title" name="title" required />
									</div>
								</div>
							</div>
							<div class="row gx-10 mb-5">
								<div class="col-lg-12">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Commitment Type <span class="required"></span></label>
									<div class="mb-5">
										<?php $sel=true;foreach($jobcommitments as $row){?>
										<div class="form-check form-check-inline form-check-solid me-10">
										    <input class="form-check-input" type="radio" value="<?=$row->id?>" name="jobcommitmentid" <?php if($sel){echo "checked";$sel=false;}?>/>
										    <label class="form-check-label">
										        <?=$row->name?>
										    </label>
										</div>
										<?php } ?>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-10">
					<div class="card-body p-8">
						<div class="d-flex flex-column align-items-start flex-xxl-row">
							<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" title="">
								<span class="fs-1-5rem fw-bold text-gray-800">Job Placement</span>
							</div>
						</div>
						<div class="separator separator-dashed my-10"></div>
						<div class="mb-0">
							<div class="row gx-10 mb-5">
								<div class="col-lg-12">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Work Arrangement <span class="required"></span></label>
									<div class="mb-5">
										<div class="form-check form-check-inline form-check-solid me-10">
										    <input class="form-check-input" type="radio" value="onsite" name="arrangement" checked/>
										    <label class="form-check-label">
										        On-Site
										    </label>
										</div>
										<div class="form-check form-check-inline form-check-solid me-10">
										    <input class="form-check-input" type="radio" value="hybrid" name="arrangement"/>
										    <label class="form-check-label">
										        Hybrid
										    </label>
										</div>
										<div class="form-check form-check-inline form-check-solid me-10">
										    <input class="form-check-input" type="radio" value="remote" name="arrangement"/>
										    <label class="form-check-label">
										        Remote
										    </label>
										</div>
									</div>
								</div>
							</div>
							<div class="row gx-10 mb-5">
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Location <span class="required"></span></label>
									<div class="mb-5">
										
										<select class="form-select" name="locationid" id="location-id">
											<option value="">No Preference</option>
											<?php foreach($locations as $row){?>
												<option value="<?=$row->id?>"><?=$row->name?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Departments <span class="required"></span></label>
									<div class="mb-5">
										<select class="form-select select2-tag" name="departmentid" id="department-id" data-placeholder="Select Department" required>
											<option value="">-- Select Department --</option>
											<?php foreach($departments as $row){?>
												<option value="<?=$row->id?>"><?=$row->name?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="card mb-10">
					<div class="card-body p-8">
						<div class="d-flex flex-column align-items-start flex-xxl-row">
							<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" title="">
								<span class="fs-1-5rem fw-bold text-gray-800">Salary <span class="required"></span></span>
							</div>
						</div>
						<div class="separator separator-dashed my-10"></div>
						<div class="mb-0">
							<div class="row gx-10 mb-5">
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Min. Amount</label>
									<div class="mb-5">
										<input type="number" class="form-control" placeholder="Enter Min. Amount" name="minsalary" required />
									</div>
								</div>
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Max. Amount</label>
									<div class="mb-5">
										<input type="number" class="form-control" placeholder="Enter Max. Amount" name="maxsalary" required />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body p-8">
						<div class="d-flex flex-column align-items-start flex-xxl-row">
							<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" title="">
								<span class="fs-1-5rem fw-bold text-gray-800">Job Requirements</span>
							</div>
						</div>
						<div class="separator separator-dashed my-10"></div>
						<div class="mb-0">
							<div class="row gx-10 mb-5">
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Gender <span class="required"></span></label>
									<div class="mb-5">
										<div class="form-check form-check-inline form-check-solid me-10">
										    <input class="form-check-input" type="radio" value="male" name="gender"/>
										    <label class="form-check-label">
										        Male
										    </label>
										</div>
										<div class="form-check form-check-inline form-check-solid me-10">
										    <input class="form-check-input" type="radio" value="female" name="gender"/>
										    <label class="form-check-label">
										        Female
										    </label>
										</div>
										<div class="form-check form-check-inline form-check-solid me-10">
										    <input class="form-check-input" type="radio" value="nopreference" name="gender" checked/>
										    <label class="form-check-label">
										        No Preference
										    </label>
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Min Age</label>
									<div class="mb-5">
										<input type="number" class="form-control" placeholder="Enter Min. Age" name="minage" />
									</div>
								</div>
								<div class="col-lg-3">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Max Age</label>
									<div class="mb-5">
										<input type="number" class="form-control" placeholder="Enter Max. Age" name="maxage" />
									</div>
								</div>
							</div>
							<div class="row gx-10 mb-5">
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Min Education <span class="required"></span></label>
									<div class="mb-5">
										<select class="form-select select2" name="mindegree">
											<option value="" >No Preference</option>
											<?php foreach($degrees as $row){?>
												<option value="<?=$row->name?>"><?=$row->name?></option>
											<?php }?>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Work Experience <span class="required"></span></label>
									<div class="mb-5">
										<select class="form-select select2" name="workexperience">
											<option value="" >No Preference</option>
											<option value="0-1">Less than a Year</option>
											<option value="1-3">1 to 3 Years</option>
											<option value="3-5">3 to 5 Years</option>
											<option value="5-10">5 to 10 Years</option>
											<option value="10-15">10 to 15 Years</option>
											<option value="15-100">More than 15 Years</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row gx-10 mb-5">
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Technical Skills Required <span class="required"></span></label>
									<div>
										<select class="form-select select2-tag" data-placeholder="Select Technical Skills" name="techskills[]"  multiple required style="width:100%!important;" id="tech-skills" required>
											<option value="">-- Select Tech Skills --</option>
											<?php foreach($techskills as $row){?>
												<option value="<?=$row->id?>"><?=$row->name?></option>
											<?php }?>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Soft Skills Required <span class="required"></span></label>
									<div>
										<select class="form-select select2-tag" data-placeholder="Select Soft Skills" name="softskills[]" multiple  style="width:100%!important;" required>
											<?php foreach($softskills as $row){?>
												<option value="<?=$row->id?>"><?=$row->name?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="row gx-10 mb-5">
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Language Skills Required <span class="required"></span></label>
									<div>
										<select class="form-select select2-tag" data-placeholder="Select Languages" name="langskills[]" multiple required style="width:100%!important;" required>
											<?php foreach($langskills as $row){?>
												<option value="<?=$row->id?>"><?=$row->name?></option>
											<?php }?>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Certification Required</span></label>
									<div>
										<select class="form-select select2-tag" data-placeholder="Select Languages" name="certskills[]" multiple  style="width:100%!important;" >
											<?php foreach($certskills as $row){?>
												<option value="<?=$row->id?>"><?=$row->name?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>	
				<div class="card mb-10">
					<div class="card-body p-8">
						<div class="d-flex flex-column align-items-start flex-xxl-row">
							<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" title="">
								<span class="fs-1-5rem fw-bold text-gray-800">Job Description <span class="required"></span></span>
							</div>
						</div>
						<div class="separator separator-dashed my-10"></div>
						<div class="mb-0">
							<div class="row gx-10 mb-5">
								<div class="col-lg-12">
									<div class="mb-5 text-right">
										<button type="button" class="btn btn-primary" onclick="generate_jobdesc()">
											<i class="ki-duotone ki-artificial-intelligence fs-1">
												<span class="path1"></span>
												<span class="path2"></span>
											</i> Generate with AI
										</button>
									</div>
									<div class="mb-5">
										<textarea id="jobdesc" name="jobdesc" ></textarea>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body p-8">
						<div class="d-flex flex-column align-items-start flex-xxl-row">
							<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" title="">
								<span class="fs-1-5rem fw-bold text-gray-800">Online Test</span>
							</div>
						</div>
						<div class="separator separator-dashed my-10"></div>
						<div class="mb-0">
							<div class="row gx-10 mb-5">
								<div class="col-lg-12">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3"> Test Required<span class="required">&nbsp;*Select one or more test that all interviewing candidates must fulfill</span></label>
									<div class="mb-5">
										<?php foreach($tests as $row){?>
										<div class="form-check form-check-solid mb-5">
										    <input class="form-check-input" type="checkbox" value="<?=$row->id?>" name="tests[]" onchange="modifycredit(<?=$row->test_credit?>,this)"/>
										    <label class="form-check-label">
										        <?=$row->name." (".$row->test_credit." Credit)"?>
										    </label>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="flex-lg-auto min-w-lg-300px">
				<!--begin::Card-->
				<div class="card" data-kt-sticky="true" data-kt-sticky-name="invoice" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', lg: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
					<!--begin::Card body-->
					<div class="card-body p-10">
						<!--begin::Input group-->
						<div class="mb-10">
							<!--begin::Label-->
							<label class="form-label fw-bold fs-6 text-gray-700">Available Credit</label>
							<!--end::Label-->
							<!--begin::Select-->
							<h1><?=number_format($creditbalance)?> Credit</h1>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
						<!--begin::Separator-->
						<div class="separator separator-dashed mb-8"></div>
						<!--end::Separator-->
						<!--begin::Input group-->
						<div class="mb-8">
							<!--begin::Option-->
							Each Interview will cost you <h3 id="interview-credit"><?=getsetting('interview_credit')?> Credit</h3>
						</div>
						<!--end::Input group-->
						<!--begin::Separator-->
						<div class="separator separator-dashed mb-8"></div>
						<!--end::Separator-->
						<!--begin::Actions-->
						<div class="mb-0">
							<!--begin::Row-->
							<div class="row mb-5">
								<!--begin::Col-->
								<div class="col">
									<a href="#" class="btn btn-warning w-100">Preview</a>
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col">
									<a href="#" class="btn btn-success w-100">Save</a>
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
							<button type="submit" class="btn btn-primary w-100" id="submit-btn" onsubmit="startloading('content-page-loader')">
							<i class="ki-duotone ki-triangle fs-3">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
							</i>Create Job Vacancy</button>
						</div>
						<!--end::Actions-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			
		</div>
		<!--end::Layout-->
		<?=form_close()?>
	</div>
	<!--end::Post-->
</div>
<script>
	var xeditor;
	ClassicEditor
    .create(document.querySelector('#jobdesc'))
    .then(editor => {
        console.log(editor);
        xeditor=editor;
    })
    .catch(error => {
        console.error(error);
    });
    // $('#tech-skills').select2({
    //   theme: 'classic',
	//   ajax: {
	//     url: "<?=site_url('skill/ajax_search')?>",
	//     type:"get",
	//     dataType:"json",
	//     delay:250,
	//     data: function (params) {
	//       var query = {
	//         search: params.term,
	//         type:"Technical"
	//       }

	//       // Query parameters will be ?search=[term]&type=public
	//       return query;
	//     }
	//   }
	// });
	var interviewcredit=<?=getsetting('interview_credit')?>;
	var currcredit=interviewcredit;
	function generate_jobdesc(){
		var ajax_data="";
		ajax_data=$("#vacancy-form").serialize();
		startloading("content-page-loader");
		$.ajax({
			url:"<?=site_url('vacancy/generate_jobdesc')?>",
			method:"get",
			dataType:"JSON",
			data:ajax_data,
			success:function(response){
				// $("#jobdesc").setData(response.jobdesc);
				xeditor.setData(response.jobdesc);
				stoploading("content-page-loader");
			}
		});
	}
	function modifycredit(credit,elm){
		if($(elm).is(":checked")){
			currcredit=parseInt(currcredit)+parseInt(credit);
		}
		else{
			currcredit=parseInt(currcredit)-parseInt(credit);
		}
		$("#interview-credit").html(currcredit+" Credit");
	}
</script>