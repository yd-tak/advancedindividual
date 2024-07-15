<!--begin::Container-->
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<!--begin::Post-->
	<div class="content flex-row-fluid" id="kt_content">
		<!--begin::Card-->
		<div class="card">
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Table-->
				<div class="dt-action-button" data-kt-customer-table-toolbar="base">
					<!--begin::Add customer-->
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-department-modal">Add <?=$objectname?></button>
					<!--end::Add customer-->
				</div>
				
				<div class="table-responsive">
					<table class="table align-middle table-row-bordered table-rounded g-2" id="list-table">
						<thead>
							<tr class="text-start fw-bold text-uppercase">
								<th>ID</th>
				                <th>Name</th>
				                <th>Description</th>
				                <th>Actions</th>
							</tr>
						</thead>
						<tbody class="fw-semibold text-gray-600">
							<?php foreach ($departments as $department): ?>
				            <tr>
				                <td><?= $department->id ?></td>
				                <td><?= $department->name ?></td>
				                <td><?= $department->description ?></td>
				                <td>
				                    <button class="btn btn-primary btn-sm">Edit</button>
				                    <button class="btn btn-danger btn-sm">Delete</button>
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
		<div class="modal fade" id="add-department-modal" tabindex="-1" aria-labelledby="add-department-modal-label" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="add-department-modal-label">Add <?=$objectname?></h5>
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		            </div>
		            <div class="modal-body">
		                <?= form_open('department/add', ['id' => 'add-department-form']) ?>
		                    <div class="mb-3">
		                        <label for="department-name" class="form-label">Department Name</label>
		                        <input type="text" class="form-control" id="department-name" name="name" required>
		                    </div>
		                    <div class="mb-3">
		                        <label for="department-description" class="form-label">Description</label>
		                        <textarea class="form-control" id="department-description" name="description" rows="3"></textarea>
		                    </div>
		                    <button type="submit" class="btn btn-primary">Add Department</button>
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
            // 'csv', 'pdf'
        ]
	});
</script>