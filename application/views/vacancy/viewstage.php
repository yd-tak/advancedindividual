<style>
	#selected-candidate-box{
		position: fixed;
		left:35%;
		width:30%;
		bottom:10px;
		border:1px solid grey;

	}
	#selected-candidate-box .card-body{
		padding:5px;
	}
	tr.active, tr.active>td{
		background-color:rgb(234, 249, 255)!important;
	}
	tr{
		cursor:pointer;
	}
</style>
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<!--begin::Post-->
	<div class="content flex-row-fluid" id="kt_content">

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
							<a class="nav-link text-active-primary ms-0 me-10 py-5" href="<?=site_url('vacancy/view/'.$vacancy->id)?>">Overview</a>
						</li>
						<!--end::Nav item-->
						<?php foreach($vacancy->stages as $vc){?>
						<!--begin::Nav item-->
						<li class="nav-item mt-2">
							<a class="nav-link text-active-primary ms-0 me-10 py-5 <?=($vc->id==$stage->id)?'active':''?>" href="<?=site_url('vacancy/viewstage/'.$vacancy->id.'/'.$vc->id)?>"><?=$vc->name?>&nbsp;<span class="badge badge-secondary"><?=count($vc->candidates)?></span></a>
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
			<div class="card mb-5 mb-xl-10">
				<!-- Loader -->
				<div class="spinner-overlay hidden" id="content-page-loader">
	                <div class="spinner-border text-primary" role="status">
	                    <span class="sr-only">Loading...</span>
	                </div>
	            </div>
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card title-->
					<div class="card-title">
						<!--begin::Search-->
						<div class="d-flex align-items-center position-relative my-1">
							<i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
							<input type="text" onchange="filterdt(this)" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Candidate" />
						</div>
						<!--end::Search-->
					</div>
					<!--begin::Card title-->
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
						<!--begin::Toolbar-->
						<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
							<!--begin::Filter-->
							<button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
							<i class="ki-duotone ki-filter fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>Filter</button>
							<!--begin::Menu 1-->
							<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
								<!--begin::Header-->
								<div class="px-7 py-5">
									<div class="fs-5 text-dark fw-bold">Filter Options</div>
								</div>
								<!--end::Header-->
								<!--begin::Separator-->
								<div class="separator border-gray-200"></div>
								<!--end::Separator-->
								<!--begin::Content-->
								<?=form_open('vacancy/viewstage/'.$vacancy->id.'/'.$stage->id,['method'=>'get'])?>
								<div class="px-7 py-5" data-kt-user-table-filter="form">
									<div class="mb-10">
										<label class="form-label fs-6 fw-semibold">Name</label>
										<input class="form-control form-control-solid form-control-sm" name="name" value="<?=(isset($get['name']))?$get['name']:''?>">
									</div>
									<div class="mb-10">
										<label class="form-label fs-6 fw-semibold">Min Ask Salary</label>
										<input class="form-control form-control-solid form-control-sm" name="minasksalary" value="<?=(isset($get['minasksalary']))?$get['minasksalary']:''?>">
									</div>
									<div class="mb-10">
										<label class="form-label fs-6 fw-semibold">Max Ask Salary</label>
										<input class="form-control form-control-solid form-control-sm" name="maxasksalary" value="<?=(isset($get['maxasksalary']))?$get['maxasksalary']:''?>">
									</div>
									<div class="mb-10">
										<label class="form-label fs-6 fw-semibold">Min Score</label>
										<select class="form-select form-select-solid form-select-sm" name="minscore">
											<option value="">All Score</option>
											<option value="90" <?=(isset($get['minscore']) && $get['minscore']=='90')?'selected':''?>>90</option>
											<option value="80" <?=(isset($get['minscore']) && $get['minscore']=='80')?'selected':''?>>80</option>
											<option value="70" <?=(isset($get['minscore']) && $get['minscore']=='70')?'selected':''?>>70</option>
											<option value="60" <?=(isset($get['minscore']) && $get['minscore']=='60')?'selected':''?>>60</option>
										</select>
									</div>
									<div class="mb-10">
										<label class="form-label fs-6 fw-semibold">Min Exp</label>
										<select class="form-select form-select-solid form-select-sm" name="minworkexp">
											<option value="">All Work Exp</option>
											<option value="1" <?=(isset($get['minworkexp']) && $get['minworkexp']=='1')?'selected':''?>>1 year</option>
											<option value="3" <?=(isset($get['minworkexp']) && $get['minworkexp']=='3')?'selected':''?>>3 year</option>
											<option value="5" <?=(isset($get['minworkexp']) && $get['minworkexp']=='5')?'selected':''?>>5 year</option>
											<option value="10" <?=(isset($get['minworkexp']) && $get['minworkexp']=='10')?'selected':''?>>10 year</option>
											<option value="15" <?=(isset($get['minworkexp']) && $get['minworkexp']=='15')?'selected':''?>>15 year</option>
											<option value="20" <?=(isset($get['minworkexp']) && $get['minworkexp']=='20')?'selected':''?>>20 year</option>
										</select>
									</div>
									<!--begin::Actions-->
									<div class="d-flex justify-content-end">
										<button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
										<button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
									</div>
									<!--end::Actions-->
								</div>
								<?=form_close()?>
								<!--end::Content-->
							</div>
							<!--end::Menu 1-->
							<!--end::Filter-->
							<!--begin::Add user-->
							<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-candidate-modal">
							<i class="ki-duotone ki-plus fs-2"></i>Add Candidate</button>
							<!--end::Add user-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Group actions-->
						<div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
							<div class="fw-bold me-5">
							<span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
							<button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
						</div>
						<!--end::Group actions-->
						<!--end::Modal - New Card-->
						<div class="modal fade" id="add-candidate-modal" tabindex="-1" aria-hidden="true">
							<!--begin::Modal dialog-->
							<div class="modal-dialog modal-dialog-centered mw-650px">
								<!--begin::Modal content-->
								<div class="modal-content">
									<!--begin::Modal header-->
									<div class="modal-header">
										<!--begin::Modal title-->
										<h2 class="fw-bold">Add Candidate</h2>
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
										<?=form_open_multipart('vacancy/upload_candidate')?>
											<input type="hidden" name="vacancyid" value="<?=$vacancy->id?>">
											<!--begin::Scroll-->
											<div class="d-flex flex-column scroll-y px-5 px-lg-10">
												<div class="fv-row mb-7">
													<label class="required fw-semibold fs-6 mb-2">Candidate CVs (PDF)</label>
													<input type="file" name="cvs" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Choose CV's" multiple/>
												</div>
												
											</div>
											<div class="text-center pt-10">
												<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-primary">
													<span class="indicator-label">Submit</span>
													<span class="indicator-progress">Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
												</button>
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
						<div class="modal fade" id="accept-candidate-modal" tabindex="-1" aria-hidden="true">
							<!--begin::Modal dialog-->
							<div class="modal-dialog modal-dialog-centered mw-650px">
								<!--begin::Modal content-->
								<div class="modal-content">
									<!--begin::Modal header-->
									<div class="modal-header">
										<!--begin::Modal title-->
										<h2 class="fw-bold">Accept <b id="accept-selected-candidate"></b> Candidate</h2>
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
										<?=form_open('#',['id'=>'accept-vcs-form'])?>
											<input type="hidden" name="vacancyid" value="<?=$vacancy->id?>">
											<input type="hidden" name="vcsids" value="" id="accept-vcs-ids">
											<!--begin::Scroll-->
											<div class="d-flex flex-column scroll-y px-5 px-lg-10">
												<div class="fv-row mb-7">
													<label class="fw-semibold fs-6 mb-2">Accept & Move Candidate to</label>
													<select class="form-select form-select-solid fw-bold" name="stageid">
														<?php foreach($stages as $row){
															if($row->no>$stage->no && $row->isfinish!=2){?>
																<option value="<?=$row->id?>"><?=$row->no.". ".$row->name?></option>
														<?php }
														} ?>
													</select>
												</div>
												
											</div>
											<div class="text-center pt-10">
												<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
												<button type="button" class="btn btn-primary" onclick="acceptvcs()">
													<span class="indicator-label">Submit</span>
													<span class="indicator-progress">Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
												</button>
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
						<div class="modal fade" id="reject-candidate-modal" tabindex="-1" aria-hidden="true">
							<!--begin::Modal dialog-->
							<div class="modal-dialog modal-dialog-centered mw-650px">
								<!--begin::Modal content-->
								<div class="modal-content">
									<!--begin::Modal header-->
									<div class="modal-header">
										<!--begin::Modal title-->
										<h2 class="fw-bold">Reject <b id="reject-selected-candidate"></b> Candidate</h2>
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
										<?=form_open('#',['id'=>'reject-vcs-form'])?>
											<input type="hidden" name="vacancyid" value="<?=$vacancy->id?>">
											<input type="hidden" name="vcsids" value="" id="reject-vcs-ids">
											<!--begin::Scroll-->
											<div class="d-flex flex-column scroll-y px-5 px-lg-10">
												<div class="fv-row mb-7">
													<label class="fw-semibold fs-6 mb-2">Reject Reasons</label>
													<div class="form-check form-check-solid mb-5">
													    <input class="form-check-input" type="radio" value="Skill Set Mismatch" name="rejectreason" checked/>
													    <label class="form-check-label">
													        Skill Set Mismatch
													    </label>
													</div>
													<div class="form-check form-check-solid mb-5">
													    <input class="form-check-input" type="radio" value="Lack of Experience" name="rejectreason"/>
													    <label class="form-check-label">
													        Lack of Experience
													    </label>
													</div>
													<div class="form-check form-check-solid mb-5">
													    <input class="form-check-input" type="radio" value="Industry Background Mismatch" name="rejectreason" />
													    <label class="form-check-label">
													        Industry Background Mismatch
													    </label>
													</div>
													<div class="form-check form-check-solid mb-5">
													    <input class="form-check-input" type="radio" value="Education Background Mismatch" name="rejectreason" />
													    <label class="form-check-label">
													        Education Background Mismatch
													    </label>
													</div>
													<div class="form-check form-check-solid mb-5">
													    <input class="form-check-input" type="radio" value="Salary Mismatch" name="rejectreason" />
													    <label class="form-check-label">
													        Salary Mismatch
													    </label>
													</div>
													<div class="form-check form-check-solid mb-5">
													    <input class="form-check-input" type="radio" value="Candidate Unresponsive" name="rejectreason" />
													    <label class="form-check-label">
													        Candidate Unresponsive
													    </label>
													</div>
													<div class="form-check form-check-solid mb-5">
													    <input class="form-check-input" type="radio" value="Offer Rejected" name="rejectreason" />
													    <label class="form-check-label">
													        OFFER REJECTED by CANDIDATE
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
											<div class="text-center pt-10">
												<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
												<button type="button" class="btn btn-primary" onclick="rejectvcs()">
													<span class="indicator-label">Submit</span>
													<span class="indicator-progress">Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
												</button>
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
						<div class="modal fade" id="candidate-modal" tabindex="-1" aria-hidden="true">
						</div>
						<div class="modal fade" id="offer-candidate-modal" tabindex="-1" aria-hidden="true">
							<!--begin::Modal dialog-->
							<div class="modal-dialog modal-dialog-centered mw-650px">
								<!--begin::Modal content-->
								<div class="modal-content">
									<!--begin::Modal header-->
									<div class="modal-header">
										<!--begin::Modal title-->
										<h2 class="fw-bold">Offer <b id="offer-selected-candidate"></b> Candidate</h2>
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
										<?=form_open('#',['id'=>'offer-vc-form'])?>
											<input type="hidden" name="id" id="offer-vc-id" value="">
											<!--begin::Scroll-->
											<div class="d-flex flex-column scroll-y px-5 px-lg-10">
												<div class="row mb-7">
													<div class="col-md-6">
														<label class="fw-semibold fs-6 mb-2">Offer Salary</label>
														<input class="form-control" name="offersalary" id="offer-vc-salary" type="number">
													</div>
													<div class="col-md-6">
														<label class="fw-semibold fs-6 mb-2">Start Work Date</label>
														<input class="form-control date-picker" name="startworkdate" type="text" placeholder="YYYY-MM-DD">
													</div>
												</div>
												
											</div>
											<div class="text-center pt-10">
												<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
												<button type="button" class="btn btn-primary" onclick="offervc()">
													<span class="indicator-label">Submit</span>
													<span class="indicator-progress">Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
												</button>
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
					</div>
					<!--end::Card toolbar-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body py-4">
					<!--begin::Table-->
					<table class="table align-middle table-row-dashed fs-6 gy-5" id="candidate-table">
						<thead>
							<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
								<th class="w-10px pe-2">
									
								</th>
								<th class="min-w-125px">Name & Location</th>
								<th class="min-w-125px">Gender & Age</th>
								<th class="min-w-125px">Expected Salary</th>
								<th class="min-w-125px">Years of Exp</th>
								<th class="min-w-125px">Last Exp</th>
								<th class="min-w-125px">Score</th>
								<th class="text-end min-w-100px">Actions</th>
							</tr>
						</thead>
						<tbody class="text-gray-600 fw-semibold">
							<?php foreach($vacancy->stages[$stage->id]->candidates as $row){?>
							<tr>
								<td id="vcs-<?=$row->lastvcstageid?>">
									<div class="form-check form-check-sm form-check-custom form-check-solid">
										<input class="form-check-input check-candidate" id="check-candidate-<?=$row->id?>" type="checkbox" value="<?=$row->id?>" name="vcsids[]" onchange="checkcandidate(<?=$row->lastvcstageid?>,this)" />
									</div>
								</td>
								<td class="align-items-center" onclick="viewvc(<?=$row->id?>)">
									<div class="d-flex flex-column">
										<a href="#" class="text-gray-800 text-hover-primary mb-1"><?=$row->name?></a>
										<span><?=$row->address?></span>
									</div>
								</td>
								<td onclick="viewvc(<?=$row->id?>)"><?=ucwords(sanitize($row->gender))."<br>".$row->age." y.o."?></td>
								<td onclick="viewvc(<?=$row->id?>)">
									<div class="badge badge-lg badge-light fw-bold"><?=number_format(sanitize($row->asksalary,0))?></div>
								</td>
								<td onclick="viewvc(<?=$row->id?>)"><?=$row->workexp." years"?></td>
								<td onclick="viewvc(<?=$row->id?>)"><?=$row->lastworkexp?></td>
								<td onclick="viewvc(<?=$row->id?>)"><?=($stage->id==1)?$row->cvscore:$row->avgscore?></td>
								<td class="text-end d-flex">
									<?php if(!$vacancy->stages[$stage->id]->isfinish){?>
										<?php if($stage->id==7){?>
											<?php if(!$row->isoffered){?>
												<button onclick="offersingle(<?=$row->id?>,<?=$row->asksalary?>,this)" class="btn btn-primary btn-center btn-sm">
												<i class="fa fa-envelope"></i></button>
											<?php }else{ ?>
												<a href="<?=site_url('vacancy/view_offered/'.$row->id)?>" target="_blank" class="btn btn-primary btn-center btn-sm">
												<i class="fa fa-external-link"></i></a>
										<?php }
										} ?>
										<button onclick="acceptsingle(<?=$row->lastvcstageid?>,this)" class="btn btn-success btn-center btn-sm">
										<i class="fa fa-check"></i></button>
										<button onclick="rejectsingle(<?=$row->lastvcstageid?>,this)" class="btn btn-danger btn-center btn-sm">
										<i class="fa fa-times"></i></button>
									<?php } ?>
									<div class="dropdown">
										<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdown-accept" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-setting"></i></button>
										<ul class="dropdown-menu" aria-labelledby="dropdown-accept">
											<?php if($stage->id==2){?>
												<li><a class="dropdown-item" href="javascript:navigator.clipboard.writeText('<?=site_url('interview/run/'.$row->id)?>')">Copy Interview URL</a></li>
											<?php }?>
											<?php if($row->useaiinterview){?>
												<li><a class="dropdown-item" href="<?=site_url('interview/view/'.$row->id)?>" target="_blank">View Interview Result</a></li>
											<?php } ?>	
											
										</ul>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<!--end::Table-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::details View-->
	</div>
	<!--end::Post-->

</div>
<div class="card d-none" id="selected-candidate-box">
	<div class="card-body">
		<div class="text-center">
			<b id="selected-candidate">0</b>&nbsp;Candidate Selected
			<br>
			<button class="btn btn-success btn-sm" onclick="accept()">Accept</button>
			<button class="btn btn-danger btn-sm" onclick="reject()">Reject</button>
		</div>

	</div>	
</div>
<script>
	var candidatedt=$("#candidate-table").DataTable({
		search:true
	});
	var vcsids=[];
	function viewvc(vcid){
		$.ajax({
			url:"<?=site_url('vacancy/viewvc')?>/"+vcid,
			method:"get",
			dataType:"json",
			beforeSend:function(){

			},
			success:function(response){
				$("#candidate-modal").html(response.html);

				$("#candidate-modal").modal("show");
			}

		});
	}
	function checkcandidate(vcsid,elm){
		if(vcsids.indexOf(vcsid)>=0){
			vcsids.splice(vcsids.indexOf(vcsid),1);
			$(elm).closest("tr").removeClass("active");
		}
		else{
			vcsids.push(vcsid);
			$(elm).closest("tr").addClass("active");
		}
		drawselectedcandidate();
	}
	function drawselectedcandidate(){
		var countvcid=vcsids.length;
		$("#selected-candidate").html(countvcid);
		if(countvcid>0)
			$("#selected-candidate-box").removeClass("d-none");
		else
			$("#selected-candidate-box").addClass("d-none");
	}
	function rejectsingle(vcsid,elm){
		if(vcsids.indexOf(vcsid)==-1){
			$("#check-candidate-"+vcsid).prop("checked",1);
			checkcandidate(vcsid,elm);
		}
		reject();
	}
	function acceptsingle(vcsid,elm){
		if(vcsids.indexOf(vcsid)==-1){
			$("#check-candidate-"+vcsid).prop("checked",1);
			checkcandidate(vcsid,elm);
		}
		accept();
	}
	function reject(){
		console.log(vcsids.join(","));
		$("#reject-vcs-ids").val(vcsids.join(","));
		$("#reject-selected-candidate").html(vcsids.length);
		$("#reject-candidate-modal").modal("show");
	}
	function accept(){
		console.log(vcsids.join(","));
		$("#accept-vcs-ids").val(vcsids.join(","));
		$("#accept-selected-candidate").html(vcsids.length);
		$("#accept-candidate-modal").modal("show");
	}
	function filterdt(elm){
		var search=$(elm).val();
		candidatedt.search(search).draw();

	}
	function removevcsrow(){
		for(var i=0;i<vcsids.length;i++){
			candidatedt.row($("#vcs-"+vcsids[i]).closest("tr")).remove();
		}
		candidatedt.draw();
	}
	function offersingle(vcid,asksalary){
		$("#offer-vc-id").val(vcid);
		$("#offer-vc-salary").val(asksalary);
		$("#offer-candidate-modal").modal("show");
	}
	function offervc(){
		
		startloading("content-page-loader");
		
		$.ajax({
			url:"<?=site_url('vacancy/offer_vc')?>",
			type:"POST",
			dataType:"json",
			data:$("#offer-vc-form").serialize(),
			success:function(response){
				alert("Offering Letter Sent to the candidate email");
				stoploading("content-page-loader");
				
			},
			error:function(err){
				alert(err);
				stoploading("content-page-loader");
			}
		});
	}
	function acceptvcs(){
		$("#accept-candidate-modal").modal("hide");
		startloading("content-page-loader");
		console.log($("#accept-vcs-ids").val());
		$.ajax({
			url:"<?=site_url('vacancy/accept_vcs')?>",
			type:"POST",
			dataType:"json",
			data:$("#accept-vcs-form").serialize(),
			success:function(response){
				removevcsrow();
				vcsids=[];
				drawselectedcandidate();
				stoploading("content-page-loader");
				
			},
			error:function(err){
				alert(err);
				stoploading("content-page-loader");
			}
		});
	}
	function rejectvcs(){
		$("#reject-candidate-modal").modal("hide");
		startloading("content-page-loader");
		console.log($("#reject-vcs-ids").val());
		$.ajax({
			url:"<?=site_url('vacancy/reject_vcs')?>",
			type:"POST",
			dataType:"json",
			data:$("#reject-vcs-form").serialize(),
			success:function(response){
				removevcsrow();
				vcsids=[];
				drawselectedcandidate();
				stoploading("content-page-loader");
			},
			error:function(err){
				alert(err);
				stoploading("content-page-loader");
			}
		});

	}
</script>