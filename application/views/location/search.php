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
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-location-modal">Add <?=$objectname?></button>
					<!--end::Add customer-->
				</div>
				<!--begin::Table-->
				<div class="table-responsive">
					<table class="table align-middle table-row-bordered table-rounded g-2" id="list-table">
						<thead>
							<tr class="text-start fw-bold text-uppercase">
				
								<th>ID</th>
				                <th>Name</th>
				                <th>Address</th>
				                <th>Actions</th>
							</tr>
						</thead>
						<tbody class="fw-semibold text-gray-600">
							<?php foreach ($locations as $location): ?>
				            <tr>
				                <td><?= $location->id ?></td>
				                <td><?= $location->name ?></td>
				                <td><?= $location->address ?></td>
				                <td>
				                    <!-- Example actions -->
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
		<div class="modal fade" id="add-location-modal" tabindex="-1" aria-labelledby="add-location-modal-label" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="add-location-modal-label">Add <?=$objectname?></h5>
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		            </div>
		            <div class="modal-body">
		                <?= form_open('location/add', ['id' => 'add-location-form']) ?>
		                    <div class="mb-3">
		                        <label for="name" class="form-label">Location Name</label>
		                        <input type="text" class="form-control" id="name" name="name" required>
		                    </div>
		                    <div class="mb-3">
		                        <label for="address" class="form-label">Address</label>
		                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
		                    </div>
		                    <button type="submit" class="btn btn-primary">Add Location</button>
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