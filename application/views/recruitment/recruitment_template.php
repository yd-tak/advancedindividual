<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<!--begin::Post-->
	<div class="spinner-overlay hidden" id="content-page-loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
	<div class="content flex-row-fluid" id="kt_content">
		
		
		<!--begin::Layout-->
		<?=form_open('recruitment/recruitment_templatep',['id'=>'recruitment-form'])?>
		<input type="hidden" name="language" value="<?=$language?>">
		<input type="hidden" name="templatecode" value="<?=$templatecode?>">
		<div class="d-flex flex-column flex-lg-row">
			<!--begin::Content-->
			
			<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
				
				<div class="card mb-10">
					<div class="card-header">
						<div class="card-title">
							<?=$pagename?> (<?=strtoupper($language)?>)
						</div>
						<div class="card-toolbar">
							<button type="button" class="btn btn-success" onclick="generate_recruitment_template()">
								<i class="ki-duotone ki-artificial-intelligence fs-1">
									<span class="path1"></span>
									<span class="path2"></span>
								</i> Generate with AI
							</button>
						</div>
					</div>
					<div class="card-body p-8">
						<div class="mb-0">
							<div class="row gx-10 mb-5">
								<div class="col-lg-12">
									<div class="mb-5">
										<textarea id="template" name="val"><?=$template?></textarea>
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
						<div class="mb-5">
							<!--begin::Label-->
							<label class="form-label fw-bold fs-6 text-gray-700">Instruction</label>
							<!--end::Label-->
						</div>
						<div class="mb-10 d-block">
							Template Variables:<br>
							<br>
							[DATE]: Date of Letter<br>
							[COM]: Your Company Name<br>
							[COM_ADDRESS]: Your Company Address<br>
							[JOB_TITLE]: Job Title for the Vacancy<br>
							[CAN_NAME]: Candidate Name<br>
							[CAN_ADDRESS]: Candidate Address<br>
							[ARRANGEMENT]: On-Site, Hybrid<br>
            				[COMMITMENT]: Full Time, Part Time<br>
							<?php switch($templatecode){
								case "offering_template":?>
									[OFF_SALARY]: Offered Salary<br>
									[START_DATE]: Starting Work Date<br>
									[DEADLINE]: Deadline of Confirmation<br>
									[CONFIRMATION_URL]: Offering Confirmation URL<br>
	            			<?php 	break;
	            				case "accepted_template":?>
									[OFF_SALARY]: Offered Salary<br>
									[START_DATE]: Starting Work Date<br>
	            			<?php 	break;
	            				case "rejected_template":?>
	            			<?php 	break;
	            				case "interview_template":?>
	            					[GMEET_URL]: Google Meet URL<br>
	            					[GMEET_DATE]: Google Meet Date & Time<br>
	            			<?php 	break;
	            			} ?>
							[YOUR_NAME]: Your login name
						</div>
						<!--end::Input group-->
						<!--begin::Separator-->
						<div class="separator separator-dashed mb-8"></div>
						<!--end::Separator-->
						<!--begin::Actions-->
						<div class="mb-0">
							<div class="row mb-5">
								<!--begin::Col-->
								
									<a class="btn btn-warning" href="<?=site_url('recruitment/recruitment_template/'.$templatecode.'/'.$language2)?>">Switch to <?=strtoupper($language2)?></a>
								
							</div>
							<!--begin::Separator-->
							<div class="separator separator-dashed mb-8"></div>
							<!--end::Separator-->
							
							<button type="submit" class="btn btn-primary w-100" id="submit-btn" onsubmit="startloading('content-page-loader')">
							<i class="ki-duotone ki-triangle fs-3">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
							</i>Save</button>
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
    .create(document.querySelector('#template'))
    .then(editor => {
        console.log(editor);
        xeditor=editor;
    })
    .catch(error => {
        console.error(error);
    });
    function generate_recruitment_template(){
		var ajax_data="";
		ajax_data=$("#vacancy-form").serialize();
		startloading("content-page-loader");
		$.ajax({
			url:"<?=site_url('recruitment/generate_recruitment_template/'.$templatecode.'/'.$language)?>",
			method:"get",
			dataType:"JSON",
			data:ajax_data,
			success:function(response){
				xeditor.setData(response.template);
				stoploading("content-page-loader");
			}
		});
	}
	
</script>