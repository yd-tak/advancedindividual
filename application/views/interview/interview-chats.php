<div class="card-body" id="kt-interview-chat">
	<!--begin::Messages-->
	<div class="scroll-y me-n5 pe-5 h-400px h-lg-auto" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="400px" data-kt-scroll-offset="5px" id="kt-interview-chat-content" style="height:400px;max-height: 400px;">
		<?php 
		if($vc->aiinterviewstarted){?>
			<?php foreach($vc->interviews as $row){?>
				<?php if($row->actor=='recruiter'){?>
				<div class="d-flex justify-content-start mb-10">
					<div class="d-flex flex-column align-items-start">
						<div class="d-flex align-items-center mb-2">
							<div class="ms-3">
								<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1"><?=getcompany('name')?></a>
								<span class="text-muted fs-7 mb-1"><?=hi($row->createdt)?></span>
							</div>
						</div>
						<div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start chat-content" data-kt-element="message-text"><?=nl2br($row->content)?></div>
					</div>
				</div>
				<?php }
				else{?>
				<div class="d-flex justify-content-end mb-10">
					<div class="d-flex flex-column align-items-end">
						<div class="d-flex align-items-center mb-2">
							<div class="me-3">
								<span class="text-muted fs-7 mb-1"><?=hi($row->createdt)?></span>
								<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1"><?=$candidate->firstname?></a>
							</div>
						</div>
						<div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end chat-content" data-kt-element="message-text"><?=nl2br($row->content)?></div>
					</div>
				</div>
				<?php } ?>
			<?php } ?>
		<?php } else{?>
			<div style="margin:auto;text-align: center;padding-top:20px;padding-bottom: 20px;">
				<button class="btn btn-primary" onclick="startinterview(<?=$vc->id?>)">Start Interview</button>
			</div>
		<?php } ?>
	</div>
	<!--end::Messages-->
</div>
<!--end::Card body-->
<!--begin::Card footer-->
<div class="card-footer pt-4" id="kt-interview-form">
	<?php if($vc->aiinterviewstarted && !$vc->aiinterviewdone){?>
		<!--begin::Input-->
		<textarea class="form-control form-control-flush mb-3" rows="3" data-kt-element="input" placeholder="Type a message" id="kt-interview-chat"
		 data-intro="Di sini adalah tempat anda menjawab pertanyaan, pastikan anda menjawab seluruh pertanyaan dalam satu jawaban." data-step="5" ></textarea>
		<!--end::Input-->
		<!--begin:Toolbar-->
		<div class="d-flex flex-stack">
			<!--begin::Actions-->
			<div class="d-flex align-items-center me-2">
				<input type="hidden" id="post-url" value="<?= site_url('speech/recognize') ?>">
				<button class="btn btn-warning" type="button" id="record-button" style="display:none;" 
			 	data-intro="Klik tombol ini untuk menjawab dengan suara, jawaban anda akan direkam dan dikirim. PASTIKAN ANDA DALAM SUASANA HENING." data-step="7" ><i class="fa fa-microphone"></i> Record</button>
				
			</div>
			<!--end::Actions-->
			<!--begin::Send-->
			<button class="btn btn-primary" type="button" onclick="sendinterviewchat('kt-interview-chat',this)"
			 data-intro="Klik send jika anda sudah selesai menjawab pertanyaan untuk mengirim jawaban anda, lalu tunggu balasan selanjutnya." data-step="6" >Send</button>
			<!--end::Send-->
		</div>
		<!--end::Toolbar-->
	<?php }else if($vc->aiinterviewdone){ ?>
		<div class="d-flex flex-stack">
			<!--begin::Actions-->
			<div class="d-flex align-items-center me-2">
				You have completed the interview process.
			</div>
			<!--end::Actions-->
			<!--begin::Send-->
			<!-- <button class="btn btn-primary" type="button" onclick="viewavailabletest()">Continue to Online Test</button> -->
			<!--end::Send-->
		</div>
	<?php } ?>
</div>
<script type="module" src="<?=base_url('assets/js/custom/audiorecord/record.js')?>"></script>