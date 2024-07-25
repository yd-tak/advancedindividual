<div class="card-body" id="kt-<?=$htmlid?>-chat">
	<!--begin::Messages-->
	<div class="scroll-y me-n5 pe-5 h-400px h-lg-auto" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="450px" data-kt-scroll-offset="5px" id="kt-<?=$htmlid?>-chat-content" style="height:400px;max-height: 400px;">
		<?php 
		if($test->thread!=null && !empty($test->thread->chats)){?>
			<?php foreach($test->thread->chats as $row){?>
				<?php if($row->actor=='recruiter'){?>
				<!--begin::Message(in)-->
				<div class="d-flex justify-content-start mb-10">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column align-items-start">
						<!--begin::User-->
						<div class="d-flex align-items-center mb-2">
							<!--begin::Avatar-->
							<!-- <div class="symbol symbol-35px symbol-circle">
								<img alt="Pic" src="assets/media/avatars/300-25.jpg" />
							</div> -->
							<!--end::Avatar-->
							<!--begin::Details-->
							<div class="ms-3">
								<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1"><?=getcompany('name')?></a>
								<span class="text-muted fs-7 mb-1"><?=hi($row->createdt)?></span>
							</div>
							<!--end::Details-->
						</div>
						<!--end::User-->
						<!--begin::Text-->
						<div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start chat-content" data-kt-element="message-text"><?=$row->content?></div>
						<!--end::Text-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Message(in)-->
				<?php }
				else{?>
				<!--begin::Message(out)-->
				<div class="d-flex justify-content-end mb-10">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column align-items-end">
						<!--begin::User-->
						<div class="d-flex align-items-center mb-2">
							<!--begin::Details-->
							<div class="me-3">
								<span class="text-muted fs-7 mb-1"><?=hi($row->createdt)?></span>
								<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1"><?=$candidate->firstname?></a>
							</div>
							<!--end::Details-->
							<!--begin::Avatar-->
							<!-- <div class="symbol symbol-35px symbol-circle">
								<img alt="Pic" src="assets/media/avatars/300-1.jpg" />
							</div> -->
							<!--end::Avatar-->
						</div>
						<!--end::User-->
						<!--begin::Text-->
						<div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end chat-content" data-kt-element="message-text"><?=$row->content?></div>
						<!--end::Text-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Message(out)-->
				<?php } ?>
			<?php } ?>
		<?php } else{?>
			<div style="margin:auto;text-align: center;padding-top:20px;padding-bottom: 20px;">
				<button class="btn btn-primary" onclick="starttest(<?=$vc->id?>,'<?=$test->testid?>')">Start <?=$test->test?></button>
			</div>
		<?php } ?>
	</div>
	<!--end::Messages-->
</div>
<!--end::Card body-->
<!--begin::Card footer-->
<div class="card-footer pt-4" id="kt-<?=$htmlid?>-form">
	<?php if($test->thread!=null && $test->thread->finishdt==null && !empty($test->thread->chats)){?>
		<!--begin::Input-->
		<textarea class="form-control form-control-flush mb-3" rows="3" data-kt-element="input" placeholder="Type a message" id="kt-<?=$htmlid?>-chat-input"></textarea>
		<!--end::Input-->
		<!--begin:Toolbar-->
		<div class="d-flex flex-stack">
			<!--begin::Actions-->
			<div class="d-flex align-items-center me-2">
				
			</div>
			<!--end::Actions-->
			<!--begin::Send-->
			<button class="btn btn-primary" type="button" onclick="sendtestchat('kt-<?=$htmlid?>-chat','<?=$testid?>',this)">Send</button>
			<!--end::Send-->
		</div>
		<!--end::Toolbar-->
	<?php }else if($test->thread!=null && $test->thread->finishdt!=null){ ?>
		<div class="d-flex flex-stack">
			<!--begin::Actions-->
			<div class="d-flex align-items-center me-2">
				You have completed the test process.
			</div>
			<!--end::Actions-->
			<!--begin::Send-->
			<!-- <button class="btn btn-primary" type="button" onclick="viewavailabletest()">Continue to Other Test</button> -->
			<!--end::Send-->
		</div>
	<?php } ?>
</div>
