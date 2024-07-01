<!--begin::Container-->
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<!--begin::Post-->
	<div class="content flex-row-fluid" id="kt_content">
		<!--begin::Card-->
		<div class="card">
			<!--begin::Card header-->
			<div class="card-header border-0 pt-6">
				<!--begin::Card title-->
				<div class="card-title d-block">
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->
				<div class="card-toolbar">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-users-modal">Add <?=$objectname?></button>
				</div>
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->

			<div class="card-body pt-0">
				<!--begin::Table-->
				<div class="table-responsive">
					<!--begin::Table-->
					<table class="table align-middle table-row-bordered table-row-solid gy-4 gs-9" id="list-table">
						<!--begin::Thead-->
						<thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
							<tr>
								<th class="min-w-175px ps-9">Username</th>
								<th class="min-w-150px px-0">Role</th>
								<th class="min-w-350px">Status</th>
								<th class="min-w-125px text-center">Action</th>
							</tr>
						</thead>
						<!--end::Thead-->
						<!--begin::Tbody-->
						<tbody class="fs-6 fw-semibold text-gray-600">
							<?php foreach($users as $row){?>
							<tr>
								<td class="ps-9"><?=$row->username?></td>
								<td class="ps-0"><?=$row->role?></td>
								<td class="ps-0"><?=$row->status?></td>
								<td class="text-center">
									<button class="btn btn-primary btn-sm" onclick="editrole(<?=$row->id?>,'<?=$row->username?>',<?=$row->roleid?>,<?=$row->isactive?>)">Edit</button>
								</td>
							</tr>
							<?php } ?>
						</tbody>
						<!--end::Tbody-->
					</table>
					<!--end::Table-->
				</div>
				<!--end::Table-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
		<!--begin::Modals-->
		<!--begin::Modal - Add Object-->
		<div class="modal fade" id="add-users-modal" tabindex="-1" aria-labelledby="add-users-modal-label" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="add-users-modal-label">Add <?=$objectname?></h5>
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		            </div>
		            <div class="modal-body">
		                <!-- Add your form fields for adding a new users here -->
		                <?php echo form_open('users/add', 'class="row g-3"'); ?>
		                    <div class="col-md-6">
		                        <label for="username" class="form-label">Username</label>
		                        <input type="text" class="form-control" name="username" required>
		                    </div>
		                    <div class="col-md-6">
		                        <label for="password" class="form-label">Password</label>
		                        <input type="password" class="form-control" name="password" required>
		                    </div>
		                    <div class="col-md-6">
		                        <label class="form-label">Role</label>
		                        	<select class="form-control" name="roleid">
			                        	<?php foreach($roles as $row){?>
			                        		<option value="<?=$row->id?>"><?=$row->name?></option>
			                        	<?php } ?>
		                        	</select>
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
		<div class="modal fade" id="edit-users-modal" tabindex="-1" aria-labelledby="edit-users-modal-label" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="edit-users-modal-label">Edit <?=$objectname?></h5>
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		            </div>
		            <div class="modal-body">
		                <!-- Edit your form fields for editing a new users here -->
		                <?php echo form_open('users/edit', 'class="row g-3"'); ?>
		                	<input type="hidden" name="id" id="edit-id">
		                    <div class="col-md-6">
		                        <label for="username" class="form-label">Username</label>
		                        <input type="text" class="form-control" name="username" id="edit-username" required>
		                    </div>
		                    <div class="col-md-6">
		                        <label for="password" class="form-label">Password</label>
		                        <input type="password" class="form-control" name="password" placeholder="Leave blank if you do not wish to change password.">
		                    </div>
		                    <div class="col-md-6">
		                        <label class="form-label">Role</label>
		                        	<select class="form-control" name="roleid" id="edit-roleid">
			                        	<?php foreach($roles as $row){?>
			                        		<option value="<?=$row->id?>"><?=$row->name?></option>
			                        	<?php } ?>
		                        	</select>
		                    </div>
		                    <div class="col-md-6">
		                        <label class="form-label">Status</label>
		                        	<select class="form-control" name="isactive" id="edit-isactive">
			                        	<option value="0">Inactive</option>
			                        	<option value="1">Active</option>
		                        	</select>
		                    </div>
		                    <!-- Edit more input fields as needed -->
		                    <div class="col-12">
		                        <button type="submit" class="btn btn-primary">Save <?=$objectname?></button>
		                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
		                    </div>
		                <?php echo form_close(); ?>
		            </div>
		        </div>
		    </div>
		</div>
		<!--end::Modals-->
	</div>
	<!--end::Post-->
</div>
<!--end::Container-->
<script>
	$("#list-table").DataTable({
		sort:false,
		dom: 'Bfrtip',
        buttons: [
            // 'csv', 'pdf'
        ]
	});
	function editrole(userid,username,roleid,isactive){
		$("#edit-username").val(username);
		$("#edit-roleid").val(roleid);
		$("#edit-isactive").val(isactive);
		$("#edit-id").val(userid);
		$("#edit-users-modal").modal("show");
	}
</script>