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
					My Credit Balance
					<span class="badge badge-success" style="font-size:20px;display: block;"><?=number_format($creditbalance)?></span>
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->
				<div class="card-toolbar">
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
					<table class="table align-middle table-row-bordered table-rounded table-striped table-condensed g-2" id="list-table">
						<thead>
							<tr class="text-start fw-bold text-uppercase">
								<th class="min-w-175px ps-9">Date</th>
								<th class="min-w-150px px-0">Transaction</th>
								<th class="min-w-100px">Debit</th>
								<th class="min-w-100px">Credit</th>
								<th class="min-w-150px">Balance</th>
								<th class="min-w-200px text-center">Note</th>
							</tr>
						</thead>
						<!--end::Thead-->
						<!--begin::Tbody-->
						<tbody class="">
							<?php 
							$currbalance=0;
							foreach($cbs as $row){
								$currbalance+=$row->debit-$row->credit;
								?>
							<tr>
								<td class="ps-9"><?=ymd($row->balancedt)?></td>
								<td class="ps-0"><?=associatedwith($row->associatedwith).' #'.$row->associatedid?></td>
								<td class="text-success fw-bold"><?=number_format($row->debit)?></td>
								<td class="text-danger fw-bold"><?=number_format($row->credit)?></td>
								<td class=" fw-bold"><?=number_format($currbalance)?></td>
								<td class="text-center">
									<?=$row->note?>
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
</script>