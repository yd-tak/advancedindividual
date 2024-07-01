<!--begin::Container-->
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<!--begin::Post-->
	<div class="content flex-row-fluid" id="kt_content">
		<!--begin::Card-->
		<div class="card">
			<!--begin::Card header-->
			<div class="card-header border-0 pt-6">
				<!--begin::Card title-->
				<div class="card-title">
					
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->
				<div class="card-toolbar">
					<!--begin::Toolbar-->
					<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
						<!--begin::Filter-->
						<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
						<i class="ki-duotone ki-filter fs-2">
							<span class="path1"></span>
							<span class="path2"></span>
						</i>Filter</button>
						<!--begin::Menu 1-->
						<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
							<!--begin::Header-->
							<div class="px-7 py-5">
								<div class="fs-4 text-dark fw-bold">Filter Options</div>
							</div>
							<!--end::Header-->
							<!--begin::Separator-->
							<div class="separator border-gray-200"></div>
							<!--end::Separator-->
							<!--begin::Content-->
							<div class="px-7 py-5">
								<div class="mb-10">
									<label class="form-label fs-5 fw-semibold mb-3">Name:</label>
									<input class="form-control fw-bold" name="name">
								</div>
								<div class="mb-10">
									<label class="form-label fs-5 fw-semibold mb-3">Skills:</label>
									<select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter">
										<option></option>
										<option value="aug">August</option>
										<option value="sep">September</option>
										<option value="oct">October</option>
										<option value="nov">November</option>
										<option value="dec">December</option>
									</select>
								</div>
								<div class="d-flex justify-content-end">
									<button type="reset" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">Reset</button>
									<button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter">Apply</button>
								</div><!--end::Actions-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Menu 1-->
						<!--end::Filter-->
						<!--begin::Add customer-->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-candidate-modal">Add <?=$objectname?></button>
						<!--end::Add customer-->
					</div>
					<!--end::Toolbar-->
					<!--begin::Group actions-->
					<div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
						<div class="fw-bold me-5">
						<span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
						<button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
					</div>
					<!--end::Group actions-->
				</div>
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Table-->
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="list-table">
					<thead>
						<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
							<th>ID</th>
			                <th>Name</th>
			                <th>Email</th>
			                <th>Phone</th>
			                <th>Experience</th>
			                <th>Status</th>
			                <th>Actions</th>
						</tr>
					</thead>
					<tbody class="fw-semibold text-gray-600">
						<?php foreach ($candidates as $row): ?>
			            <tr>
			                <td><?= $row->id ?></td>
			                <td><?= $row->firstname." ".$row->lastname ?></td>
			                <td><?= $row->email ?></td>
			                <td><?= $row->phone ?></td>
			                <td><?= $row->lastworkexp ?></td>
			                <td><?= $row->status ?></td>
			                <td>
			                    <button class="btn btn-primary btn-sm">View</button>
			                    <button class="btn btn-danger btn-sm">Delete</button>
			                </td>
			            </tr>
			            <?php endforeach; ?>
					</tbody>
				</table>
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
            'csv', 'pdf'
        ]
	});
</script>