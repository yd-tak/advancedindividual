<!--begin::Container-->
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<!--begin::Post-->
	<div class="content flex-row-fluid" id="kt_content">
		<!--begin::Card-->
		<div class="card">
			
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<div class="dt-action-button" data-kt-customer-table-toolbar="base">
					<!--begin::Add customer-->
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-candidate-modal">Add <?=$objectname?></button>
					<!--end::Add customer-->
					<!--begin::Filter-->
					<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
					<i class="ki-duotone ki-filter fs-2">
						<span class="path1"></span>
						<span class="path2"></span>
					</i>Filter</button>
					<!--begin::Menu 1-->
					
					<div class="menu menu-sub menu-sub-dropdown w-300px w-md-500px" data-kt-menu="true" id="kt-toolbar-filter">
						<?=form_open('candidate/search',['method'=>'get'])?>
						<!--begin::Header-->
						<div class="px-7 py-5">
							<div class="fs-4 text-dark fw-bold">Filter Data</div>
						</div>
						<!--end::Header-->
						<!--begin::Separator-->
						<div class="separator border-gray-200"></div>
						<!--end::Separator-->
						<!--begin::Content-->
						<div class="px-7 py-5">
							<div class="mb-10">
								<label class="form-label fs-5 fw-semibold">Keyword (OR)</label>
								<div class="">
									<select class="form-select form-select-sm select2-tag" name="keywords[]" multiple="multiple" style="width:100%">
										<?php if(isset($input)){
											foreach($input['keywords'] as $keyword){?>
												<option value="<?=ucwords($keyword)?>" selected><?=ucwords($keyword)?></option>
											<?php }
										}?>
									</select>
								</div>
							</div>
							<div class="d-flex justify-content-end">
								<button type="reset" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">Reset</button>
								<button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter">Apply</button>
							</div><!--end::Actions-->
						</div>
						<!--end::Content-->
						<?=form_close()?>
					</div>
					
					<!--end::Menu 1-->
					<!--end::Filter-->
					
				</div>
				<!--begin::Table-->
				<div class="table-responsive">
					<table class="table align-middle table-row-bordered table-rounded table-condensed" id="list-table">
						<thead>
							<tr class="text-start fw-bold text-uppercase">
								<th>ID</th>
				                <th>Name</th>
				                <!-- <th>Email</th> -->
				                <th>Phone</th>
				                <th>Experience</th>
				                <!-- <th>Status</th> -->
				                <th>Desc</th>
				                <th>Actions</th>
							</tr>
						</thead>
						<tbody class="">
							<?php foreach ($candidates as $row): ?>
				            <tr>
				                <td><?= $row->id ?></td>
				                <td><?= $row->firstname." ".$row->lastname ?></td>
				                <!-- <td><?= $row->email ?></td> -->
				                <td><?= $row->phone ?></td>
				                <td><?= $row->lastworkexp ?></td>
				                <!-- <td><?= $row->status ?></td> -->
				                <td><?= (isset($row->desc)?$row->desc:'') ?></td>
				                <td>
				                    <a class="btn btn-primary btn-sm" href="<?=site_url('candidate/view/'.$row->id)?>">View</a>
				                    <!-- <button class="btn btn-danger btn-sm">Delete</button> -->
				                </td>
				            </tr>
				            <?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<!--end::Table-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
		<!--begin::Modals-->
		<!--begin::Modal - Add Object-->
		<div class="modal fade" id="add-candidate-modal" tabindex="-1" aria-labelledby="add-candidate-modal-label" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="add-candidate-modal-label">Add <?=$objectname?></h5>
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		            </div>
		            <div class="modal-body">
		                <!-- Add your form fields for adding a new candidate here -->
		                <?php echo form_open('candidate/add', 'class="row g-3"'); ?>
		                    <div class="col-md-6">
		                        <label for="name" class="form-label">Name</label>
		                        <input type="text" class="form-control" id="name" name="name">
		                    </div>
		                    <div class="col-md-6">
		                        <label for="email" class="form-label">Email</label>
		                        <input type="email" class="form-control" id="email" name="email">
		                    </div>
		                    <div class="col-md-6">
		                        <label for="phone" class="form-label">Phone</label>
		                        <input type="text" class="form-control" id="phone" name="phone">
		                    </div>
		                    <div class="col-md-6">
		                        <label for="address" class="form-label">Address</label>
		                        <input type="text" class="form-control" id="address" name="address">
		                    </div>
		                    <!-- Add more input fields as needed -->
		                    <div class="col-12">
		                        <button type="submit" class="btn btn-primary">Save <?=$objectname?></button>
		                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
		                    </div>
		                <?php echo form_close(); ?>
		            </div>
		        </div>
		    </div>
		</div>
		<!--end::Modal - Add Object-->
		<!--end::Modals-->
	</div>
	<!--end::Post-->
</div>
<!--end::Container-->
<script>
	$("#list-table").DataTable({
		dom: 'Bfrtip',
        buttons: [
            // 'csv', 'pdf'
        ]
	});
</script>