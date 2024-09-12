<?php $notifs=get_notifs();?>
<!--begin::Activities drawer-->
<div id="kt_activities" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'lg': '600px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close">
	<div class="card shadow-none border-0 rounded-0">
		<!--begin::Header-->
		<div class="card-header" id="kt_activities_header">
			<h3 class="card-title fw-bold text-dark">Notification</h3>
			<div class="card-toolbar">
				<button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="kt_activities_close">
					<i class="ki-duotone ki-cross fs-1">
						<span class="path1"></span>
						<span class="path2"></span>
					</i>
				</button>
			</div>
		</div>
		<!--end::Header-->
		<!--begin::Body-->
		<div class="card-body position-relative" id="kt_activities_body">
			<!--begin::Content-->
			<div id="kt_activities_scroll" class="position-relative scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_activities_body" data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer" data-kt-scroll-offset="5px">
				<!--begin::Timeline items-->
				<div class="timeline">
					<?php foreach($notifs as $row){?>
					<div class="timeline-item" onclick="location.href='<?=site_url('notif/view/'.$row->id)?>'">
						<div class="timeline-line w-40px"></div>
						<div class="timeline-icon symbol symbol-circle symbol-40px">
							<div class="symbol-label bg-light">
								<i class="ki-duotone ki-flag fs-2 text-gray-500">
								</i>
							</div>
						</div>
						<div class="timeline-content mb-10 mt-n2">
							<div class="overflow-auto pe-3">
								<div class="fs-5 fw-semibold mb-2"><?=$row->description?></div>
								<div class="d-flex align-items-center mt-1 fs-6">
									<div class="text-muted me-2 fs-7">Last Updated at <?=ymd($row->notifdt)?></div>
									
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				<!--end::Timeline items-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Body-->
	</div>
</div>
<!--end::Activities drawer-->