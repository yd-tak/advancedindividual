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
									<input class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter">
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
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-employee-modal">Add <?=$objectname?></button>
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
			                <th>Department</th>
			                <th>Job Role</th>
			                <th>Actions</th>
						</tr>
					</thead>
					<tbody class="fw-semibold text-gray-600">
						<?php foreach ($employees as $employee): ?>
			            <tr>
			                <td><?= $employee->id ?></td>
			                <td><?= $employee->firstname." ".$employee->lastname ?></td>
			                <td><?= $employee->email ?></td>
			                <td><?= $employee->department ?></td>
			                <td><?= $employee->job_role ?></td>
			                <td>
			                    <button class="btn btn-primary btn-sm">Edit</button>
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
		<div class="modal fade" id="add-employee-modal" tabindex="-1" aria-labelledby="add-employee-modal-label" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="add-employee-modal-label">Add <?=$objectname?></h5>
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		            </div>
		            <div class="modal-body">
		                <?= form_open('employee/add', ['id' => 'add-employee-form']) ?>
		                    <div class="mb-3">
		                        <label for="employee-firstname" class="form-label">First Name</label>
		                        <input type="text" class="form-control" id="employee-firstname" name="firstname" required>
		                    </div>
		                    <div class="mb-3">
		                        <label for="employee-lastname" class="form-label">Last Name</label>
		                        <input type="text" class="form-control" id="employee-lastname" name="lastname" required>
		                    </div>
		                    <div class="mb-3">
		                        <label for="employee-email" class="form-label">Email</label>
		                        <input type="email" class="form-control" id="employee-email" name="email">
		                    </div>
		                    <div class="mb-3">
		                        <label for="employee-phone" class="form-label">Phone</label>
		                        <input type="text" class="form-control" id="employee-phone" name="phone">
		                    </div>
		                    <div class="mb-3">
		                        <label for="employee-jobposition" class="form-label">Job Role</label>
		                        <select class="form-select" id="employee-jobposition" name="jobpositionid">
		                            <?php foreach ($job_roles as $position): ?>
		                                <option value="<?= $position->id ?>"><?= $position->name ?></option>
		                            <?php endforeach; ?>
		                        </select>
		                    </div>
		                    <div class="mb-3">
		                        <label for="employee-department" class="form-label">Department</label>
		                        <select class="form-select" id="employee-department" name="departmentid">
		                            <?php foreach ($departments as $department): ?>
		                                <option value="<?= $department->id ?>"><?= $department->name ?></option>
		                            <?php endforeach; ?>
		                        </select>
		                    </div>
		                    <div class="mb-3">
		                        <label for="employee-location" class="form-label">Location</label>
		                        <select class="form-select" id="employee-location" name="locationid">
		                            <?php foreach ($locations as $location): ?>
		                                <option value="<?= $location->id ?>"><?= $location->name ?></option>
		                            <?php endforeach; ?>
		                        </select>
		                    </div>
		                    <!-- Checkbox to decide if user data should be created -->
		                    <div class="mb-3 form-check">
		                        <input type="checkbox" class="form-check-input" id="create-user-checkbox" name="create_user" value="1">
		                        <label class="form-check-label" for="create-user-checkbox">Create User Data</label>
		                    </div>

		                    <!-- Additional fields for user data -->
		                    <div id="user-data-fields" style="display: none;">
		                        <div class="mb-3">
		                            <label for="user-password" class="form-label">Password</label>
		                            <input type="password" class="form-control" id="user-password" name="password">
		                        </div>
		                        <div class="mb-3">
		                            <label for="user-role" class="form-label">User Role</label>
		                            <select class="form-select" id="user-role" name="roleid">
		                                <!-- Dynamically populate with user roles -->
		                            </select>
		                        </div>
		                    </div>
		                    <button type="submit" class="btn btn-primary">Add Employee</button>
		                <?= form_close() ?>
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
	$('#create-user-checkbox').change(function() {
        if ($(this).is(':checked')) {
            $('#user-data-fields').show();
        } else {
            $('#user-data-fields').hide();
        }
    });
</script>