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
					<!--begin::Table-->
					<table class="table table-striped table-bordered table-condensed" id="list-table">
						<!--begin::Thead-->
						<thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
							<tr>
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
								<td class="text-success"><?=number_format($row->debit)?></td>
								<td class="text-danger"><?=number_format($row->credit)?></td>
								<td class=""><?=number_format($currbalance)?></td>
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