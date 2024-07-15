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
						<!--begin::Add customer-->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-stage-modal">Add Stage</button>
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
				<div class="table-responsive">
					<table class="table align-middle table-row-bordered table-rounded g-2" id="list-table">
						<thead>
							<tr class="text-start fw-bold text-uppercase">
				
								<th>No</th>
				                <th>Stage</th>
				                <th>Description</th>
				                <th>Status</th>
				                <th>Actions</th>
							</tr>
						</thead>
						<tbody class="fw-semibold text-gray-600">
							<?php foreach ($stages as $row): ?>
				            <tr>
				                <td><?= $row->no ?></td>
				                <td><?= $row->name ?></td>
				                <td><?= $row->description ?></td>
				                <td><?= $row->status ?></td>
				                <td>
				                	<?php if($row->iseditable){?>
					                    <button class="btn btn-primary btn-sm" onclick="viewstage(<?=$row->id?>)">View</button>
					                    <button class="btn btn-danger btn-sm" onclick="deletestage(<?=$row->id?>)">Delete</button>
				                	<?php } ?>
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
		<div class="modal fade" id="add-stage-modal" tabindex="-1" aria-labelledby="add-stage-modal-label" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="add-stage-modal-label">Add Stage</h5>
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		            </div>
		            <div class="modal-body">
		                <!-- Add your form fields for adding a new stage here -->
		                <?php echo form_open('recruitment/addstage', 'class="row g-3"'); ?>
		                	<div class="col-md-6">
		                        <label class="form-label">No</label>
		                        <input type="number" class="form-control" id="no" name="no">
		                    </div>
		                    <div class="col-md-6">
		                        <label class="form-label">Stage</label>
		                        <input type="text" class="form-control" id="name" name="name">
		                    </div>
		                    <div class="col-md-12">
		                        <label class="form-label">Description</label>
		                        <textarea class="form-control" id="description" name="description"></textarea>
		                    </div>
		                    <div class="col-md-6">
		                        <label class="form-label">Tahap Pertama?</label>
		                        <input type="checkbox" id="isstart" name="isstart" value="1">
		                    </div>
		                    <div class="col-md-6">
		                        <label class="form-label">Tahap Terakhir?</label>
		                        <input type="checkbox" id="isfinish" name="isfinish" value="1">
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
		<!--begin::Modal - View Object-->
		<div class="modal fade" id="view-stage-modal" tabindex="-1" aria-labelledby="view-stage-modal-label" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="view-stage-modal-label">View Stage</h5>
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		            </div>
		            <div class="modal-body">
		                <!-- View your form fields for adding a new stage here -->
		                <?php echo form_open('#', 'class="row g-3" id="edit-form"'); ?>
		                	<div class="col-md-6">
		                        <label class="form-label">No</label>
		                        <input type="number" class="form-control" id="v-no" name="no">
		                    </div>
		                    <div class="col-md-6">
		                        <label class="form-label">Stage</label>
		                        <input type="text" class="form-control" id="v-name" name="name">
		                    </div>
		                    <div class="col-md-12">
		                        <label class="form-label">Description</label>
		                        <textarea class="form-control" id="v-description" name="description"></textarea>
		                    </div>
		                    <div class="col-md-6">
		                        <label class="form-label">Tahap Pertama?</label>
		                        <input type="checkbox" id="v-isstart" name="isstart" value="1">
		                    </div>
		                    <div class="col-md-6">
		                        <label class="form-label">Tahap Terakhir?</label>
		                        <input type="checkbox" id="v-isfinish" name="isfinish" value="1">
		                    </div>
		                    
		                    <!-- View more input fields as needed -->
		                    <div class="col-12">
		                        <button type="submit" class="btn btn-primary">Save <?=$objectname?></button>
		                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
		                    </div>
		                <?php echo form_close(); ?>
		            </div>
		        </div>
		    </div>
		</div>
		<!--end::Modal - View Object-->
		<!--end::Modals-->
	</div>
	<!--end::Post-->
</div>
<!--end::Container-->
<script>
	$("#list-table").DataTable({
		// dom: 'Bfrtip',
        // buttons: [
            // 'csv', 'pdf'
        // ]
	});
	function viewstage(id){
		$.ajax({
			url:"<?=site_url('recruitment/viewstage')?>/"+id,
			method:"get",
			data:"",
			dataType:"json",
			success:function(response){
				console.log(response);
				$("#v-no").val(response.stage.no);
				$("#v-name").val(response.stage.name);
				$("#v-description").html(response.stage.description);
				if(response.stage.isstart==1){
					$("#v-isstart").prop("checked",true);
				}
				else{
					$("#v-isstart").prop("checked","");
				}
				if(response.stage.isfinish==1){
					$("#v-isfinish").prop("checked",true);
				}
				else{
					$("#v-isfinish").prop("checked","");
				}
				$("#edit-form").prop("action","<?=site_url('recruitment/editstage')?>/"+id);
				$("#view-stage-modal").modal("show");
				
			}
		});
	}
	function deletestage(id){
		$("#setdelete-form").prop("action","<?=site_url('recruitment/deletestage')?>");
		$("#setdelete-id").val(id);
		$("#setdelete-modal").modal("show");
	}
</script>