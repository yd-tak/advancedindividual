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
					<a type="button" class="btn btn-primary" href="<?=site_url('vacancy/new')?>">Add <?=$objectname?></a>
					<!--end::Add customer-->
				</div>
				<div class="table-responsive">
					<table class="table align-middle table-row-bordered table-rounded g-2" id="list-table">
						<thead>
							<tr class="text-start fw-bold text-uppercase">
								<th>ID</th>
				                <th>Name</th>
				                <th>Commitment</th>
				                <th>Location</th>
				                <th>Credit Spent</th>
				                <th>Candidates</th>
				                <th>Actions</th>
							</tr>
						</thead>
						<tbody class="fw-semibold text-gray-600">
							<?php foreach ($vacancies as $row): ?>
				            <tr>
				                <td><?= $row->id ?></td>
				                <td><?= $row->title ?></td>
				                <td><?= $row->jobcommitment ?></td>
				                <td><?= $row->location ?></td>
				                <td><?= $row->creditused ?></td>
				                <td>
				                	<ul class="list-group list-group-horizontal text-center">
										<li class="list-group-item" onclick="location.href='<?=site_url('vacancy/viewstage/'.$row->id.'/1')?>'"><?=number_format($row->vc_pending)?><br><small style="font-weight: normal;">Pending</small></li>
										<li class="list-group-item" onclick="location.href='<?=site_url('vacancy/viewstage/'.$row->id.'/2')?>'"><?=number_format($row->vc_interviewing)?><br><small style="font-weight: normal;">Interviewing</small></li>
										<li class="list-group-item" onclick="location.href='<?=site_url('vacancy/viewstage/'.$row->id.'/3')?>'"><?=number_format($row->vc_onprocess)?><br><small style="font-weight: normal;">On Progress</small></li>
										<li class="list-group-item" onclick="location.href='<?=site_url('vacancy/viewstage/'.$row->id.'/8')?>'"><?=number_format($row->vc_hired)?><br><small style="font-weight: normal;">Hired</small></li>
										<li class="list-group-item" onclick="location.href='<?=site_url('vacancy/viewstage/'.$row->id.'/9')?>'"><?=number_format($row->vc_rejected)?><br><small style="font-weight: normal;">Rejected</small></li>
									</ul>
								</td>
				                <td>
				                    <a href="<?=site_url('vacancy/view/'.$row->id)?>" class="btn btn-primary btn-sm">View</a>
				                    
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
		<div class="modal fade" id="add-vacancy-modal" tabindex="-1" aria-labelledby="add-vacancy-modal-label" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="add-vacancy-modal-label">Add <?=$objectname?></h5>
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		            </div>
		            <div class="modal-body">
		                <!-- Add your form fields for adding a new vacancy here -->
		                <?php echo form_open('vacancy/add', 'class="row g-3"'); ?>
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
            
        ]
	});
</script>