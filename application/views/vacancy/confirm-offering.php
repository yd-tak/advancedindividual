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
						<div class="">
							<!--end::Accordion-->
							<div class="mt-10 mb-10">
								<!--begin::Title-->
								<h4 class="fs-1 text-gray-800 w-bolder mb-6">Confirm Your Offering | <?=$vc->name?></h4>
								<!--end::Title-->
								
							</div>
							<div class="m-0 row">
								<div class="col-md-2">Company</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: <?=getCompany('name')?></div>
								<div class="col-md-2">Address</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: <?=getCompany('address')?></div>
							</div>
							
							<div class="m-0 row">
								<div class="col-md-2">Title</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: <?=$vacancy->title?></div>
								<div class="col-md-2">Role</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: <?=$vacancy->jobrole?></div>
							</div>
							<div class="m-0 row">
								<div class="col-md-2">Commitment</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: <?=$vacancy->jobcommitment?></div>
								<div class="col-md-2">Arrangement</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: <?=$vacancy->arrangement?></div>
							</div>
							<div class="m-0 row">
								<div class="col-md-2">Location</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: <?=$vacancy->location?></div>
								<div class="col-md-2">Department</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: <?=$vacancy->department?></div>
							</div>
							<div class="m-0 row">
								<div class="col-md-2">Tech Skills</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: 
									<?php foreach($vacancy->techskills as $skill){?>
										<span class="badge badge-success"><?=$skill?></span>
									<?php } ?>
								</div>
							</div>
							<div class="m-0 row">
								<div class="col-md-2">Soft Skills</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: 
									<?php foreach($vacancy->softskills as $skill){?>
										<span class="badge badge-primary"><?=$skill?></span>
									<?php } ?>
								</div>
							</div>
							<div class="m-0 row">
								<div class="col-md-2">Languages</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: 
									<?php foreach($vacancy->languages as $skill){?>
										<span class="badge badge-success"><?=$skill?></span>
									<?php } ?>
								</div>
							</div>
							<div class="m-0 row">
								<div class="col-md-2">Certifications</div>
								<div class="fw-semibold fs-4 text-gray-600 mb-2 col-md-4">: 
									<?php foreach($vacancy->certifications as $skill){?>
										<span class="badge badge-success"><?=$skill?></span>
									<?php } ?>
								</div>
							</div>
							
						</div>
						<!--end::Job-->
					</div>
					<!--end::Content-->
					<!--begin::Sidebar-->
					<div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px" style="margin-top:80px;">
						<!--begin::Careers about-->
						<div class="card bg-light">
							<!--begin::Body-->
							<div class="card-body">
								<!--begin::Top-->
								<div class="mb-7 text-center">
									<!--begin::Title-->
									<h2 class="fs-1 text-gray-800 w-bolder mb-6">Offering Salary</h2>
									<!--end::Title-->
									<!--begin::Text-->
									<h4 class="text-gray-700 w-bolder mb-0">Rp <?=number_format($vc->offersalary)?></h4>
									<!--end::Text-->
									<div class="mt-10">
										<!--begin::Row-->
										<?php if($vc->isofferaccepted==null){?>
										<div class="row mb-5">
											<!--begin::Col-->
											<div class="col">
												<button type="button" value="accept" class="btn btn-success w-100" onclick="accept_offering()">Accept</a>
											</div>
											<!--end::Col-->
											<!--begin::Col-->
											<div class="col">
												<button type="button" value="reject" class="btn btn-danger w-100" onclick="reject_offering()">Reject</a>
											</div>
											<!--end::Col-->
										</div>
										<?php }
										elseif($vc->isofferaccepted){ ?>
											<div class="alert alert-success">You have accepted this offer on <?=ymd($vc->offeracceptdate)?></div>
										<?php }else{ ?>
											<div class="alert alert-danger">You have rejected this offer on <?=ymd($vc->offerrejectdate)?>, with reject reason: <?=$vc->rejectreason?></div>
										<?php } ?>
										
									</div>
									<!--end::Actions-->
								</div>
								</div>
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
<div class="modal fade" id="accept-offering-modal" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<!--begin::Modal title-->
				<h2 class="fw-bold">Accept Offering</h2>
				<!--end::Modal title-->
				<!--begin::Close-->
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-duotone ki-cross fs-1">
						<span class="path1"></span>
						<span class="path2"></span>
					</i>
				</div>
				<!--end::Close-->
			</div>
			<!--end::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body px-5 my-7">
				<!--begin::Form-->
				<?=form_open('vacancy/accept_offering',['id'=>'accept-offering-form'])?>
					<input type="hidden" name="vcsid" value="<?=$vc->lastvcstageid?>">
					<!--begin::Scroll-->
					<div class="d-flex flex-column scroll-y px-5 px-lg-10">
						<div class="fv-row mb-7">
							<label class="fw-semibold fs-6 mb-2">Are you sure you want to accept this offering?</label>
						</div>
						
					</div>
					<div class="text-center pt-10" id="accept-action">
						<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary" id="accept-btn" name="submit">Yes, I am Sure</button>
					</div>
					<div class="text-center pt-10 d-none" id="accept-action-loading">
						<button type="button" class="btn btn-secondary me-3" >Loading...</button>
					</div>
				<?=form_close()?>
				<!--end::Form-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
<div class="modal fade" id="reject-offering-modal" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<!--begin::Modal title-->
				<h2 class="fw-bold">Reject Offering</h2>
				<!--end::Modal title-->
				<!--begin::Close-->
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-duotone ki-cross fs-1">
						<span class="path1"></span>
						<span class="path2"></span>
					</i>
				</div>
				<!--end::Close-->
			</div>
			<!--end::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body px-5 my-7">
				<!--begin::Form-->
				<?=form_open('vacancy/reject_offering',['id'=>'reject-offering-form'])?>
					<input type="hidden" name="vcsid" value="<?=$vc->lastvcstageid?>">
					<!--begin::Scroll-->
					<div class="d-flex flex-column scroll-y px-5 px-lg-10">
						<div class="fv-row mb-7">
							<label class="fw-semibold fs-6 mb-2">Why do you reject this offer?</label>
							<div class="form-check form-check-solid mb-5">
							    <input class="form-check-input" type="radio" value="Salary Not Suitable" name="rejectreason" checked/>
							    <label class="form-check-label">
							        Salary Not Suitable
							    </label>
							</div>
							<div class="form-check form-check-solid mb-5">
							    <input class="form-check-input" type="radio" value="Accepted Other Offer" name="rejectreason" />
							    <label class="form-check-label">
							        Accepted Other Offer
							    </label>
							</div>
							<div class="form-check form-check-solid mb-5">
							    <input class="form-check-input" type="radio" value="Other" name="rejectreason" />
							    <label class="form-check-label">
							        Other
							    </label>
							</div>
						</div>
						
					</div>
					<div class="text-center pt-10" id="reject-action">
						<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary" id="reject-btn">Yes, I am Sure</button>
					</div>
				<?=form_close()?>
				<!--end::Form-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
<script>
	$(document).ready(function(){
		// Show the welcome modal
		
        $("#reject-offering-form").submit(function(e){
			$("#reject-btn").html("Loading... DO NOT CLOSE THIS WINDOW!");
			$("#reject-btn").prop("disabled",true);
		});
		$("#accept-offering-form").submit(function(e){
			$("#accept-btn").html("Loading... DO NOT CLOSE THIS WINDOW!");
			$("#accept-btn").prop("disabled",true);
		});
        
	});
	function accept_offering(){
		$("#accept-offering-modal").modal("show");
	}
	function reject_offering(){
		$("#reject-offering-modal").modal("show");
	}

	
</script>