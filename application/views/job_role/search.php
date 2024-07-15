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
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-job-position-modal">Add <?=$objectname?></button>
					<!--end::Add customer-->
				</div>
				<!--begin::Table-->
				<div class="table-responsive">
					<table class="table align-middle table-row-bordered table-rounded g-2" id="list-table">
						<thead>
							<tr class="text-start fw-bold text-uppercase">
				
								<th>ID</th>
				                <th>Title</th>
				                <th>Description</th>
				                <th>Actions</th>
							</tr>
						</thead>
						<tbody class="fw-semibold text-gray-600">
							<?php foreach ($job_roles as $job_role): ?>
				            <tr>
				                <td><?= $job_role->id ?></td>
				                <td><?= $job_role->name ?></td>
				                <td><?= $job_role->description ?></td>
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
		<div class="modal fade" id="add-job-position-modal" tabindex="-1" aria-labelledby="add-job-position-modal-label" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="add-job-position-modal-label">Add <?=$objectname?></h5>
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		            </div>
		            <div class="modal-body">
		                <?= form_open('job_role/add', ['id' => 'add-job-position-form']) ?>
		                    <div class="mb-3">
		                        <label for="job-title" class="form-label">Title</label>
		                        <input type="text" class="form-control" id="title" name="name" required>
		                    </div>
		                    <div class="mb-3">
		                        <label for="description" class="form-label">Description</label>
		                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
		                    </div>
		                    <button type="submit" class="btn btn-primary">Add Job Role</button>
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