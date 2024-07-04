<style>
	.chat-content{
		font-size: 13px !important;
		font-weight: normal;
		white-space: pre-line;
	}
	.typing-indicator {
        display: flex;
        align-items: center;
    }

    .typing-indicator .dot {
        height: 8px;
        width: 8px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        animation: blink 1.4s infinite both;
    }

    .typing-indicator .dot:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator .dot:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes blink {
        0%, 80%, 100% {
            opacity: 0;
        }
        40% {
            opacity: 1;
        }
    }
    .timer-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .timer {
        font-size: 3rem;
        font-weight: bold;
        background: #007bff;
        color: white;
        padding: 1rem 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }
</style>
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<!--begin::Post-->
	<div class="content flex-row-fluid" id="kt_content">
		<!--begin::Layout-->
		<div class="d-flex flex-column flex-lg-row">
			<!--begin::Sidebar-->
			<div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
				<!--begin::Contacts-->
				<div class="card card-flush">
					<!--begin::Card header-->
					<div class="card-header pt-7" id="kt_chat_contacts_header">
						<div class="text-center margin-auto" style="margin:auto;">
							<h4>Interview & Test List</h4>
						</div>
					</div>
					<!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body pt-5" id="kt_chat_contacts_body">
						<!--begin::List-->
						<div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"  data-kt-scroll-offset="5px">
							<div class="separator separator-dashed"></div>
							<div class="d-flex flex-stack py-4">
								<div class="d-flex align-items-center">
									<div class="symbol symbol-45px symbol-circle">
										<span class="symbol-label <?=(!$vc->aiinterviewstarted)?'bg-light-danger text-danger':'bg-light-success text-success'?> fs-6 fw-bolder">1</span>
									</div>
									<div class="ms-5">
										<a href="javascript:viewinterview()" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">AI Interview</a>
										<div class="fw-semibold text-muted"><?=$vc->interviewstatus?></div>
									</div>
								</div>
								<div class="d-flex flex-column align-items-end ms-2">
									<!-- Date Here -->
								</div>
							</div>
							
							<?php $ctr=1;foreach($vc->tests as $i=>$row){?>
							<div class="separator separator-dashed"></div>
							<div class="d-flex flex-stack py-4 <?=($row->thread==null)?'':''?>">
								<div class="d-flex align-items-center">
									<div class="symbol symbol-45px symbol-circle">
										<span class="symbol-label <?=($row->thread==null)?'bg-light-danger text-danger':'bg-light-success text-success'?>  fs-6 fw-bolder"><?=(1+$ctr++)?></span>
									</div>
									<div class="ms-5">
										<a href="javascript:viewtest('<?=$row->testid?>')" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2"><?=$row->test?></a>
										<div class="fw-semibold text-muted"><?=$row->teststatus?></div>
									</div>
								</div>
								<div class="d-flex flex-column align-items-end ms-2">
									<?=($row->thread!=null)?ymd($row->thread->createdt):''?>
								</div>
							</div>
							<div class="separator separator-dashed d-none"></div>
							<?php } ?>

						</div>
						<!--end::List-->

					</div>
					<?php if(!$isuser){?>
					<div class="card-footer">
						<div class="d-grid">
							<a class="btn btn-success btn-block" target="_blank" href="<?=site_url('interview/result/'.$vc->id)?>">Show Interview & Test Result</a>
						</div>
					</div>
						<?php } ?>
					<!--end::Card body-->
				</div>
				<!--end::Contacts-->
			</div>
			<!--end::Sidebar-->
			<!--begin::Content-->
			<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10 <?=($istest)?'d-none':''?>" id="interview-content">
				<!--begin::Messenger-->
				<div class="card" id="kt_chat_messenger">
					<!--begin::Card header-->
					<div class="card-header" id="kt_chat_messenger_header">
						<!--begin::Title-->
						<div class="card-title">
							<!--begin::User-->
							<div class="d-flex justify-content-center flex-column me-3">
								<a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Interview</a>
								<!--begin::Info-->
								<div class="mb-0 lh-1">
									<span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
									<span class="fs-7 fw-semibold text-muted"><?=(!$vc->aiinterviewstarted)?'Not Started':(($vc->aiinterviewdone)?'Finished '.ymd($vc->createdt):'Started '.ymd($vc->createdt));?></span>
								</div>
								<!--end::Info-->
							</div>
							<!--end::User-->
						</div>
						<!--end::Title-->
						<!--begin::Card toolbar-->
						<div class="card-toolbar">
							
						</div>
						<!--end::Card toolbar-->
					</div>
					<!--end::Card header-->
					<!--begin::Card body-->
					<div class="spinner-overlay hidden" id="content-page-loader">
		                <div class="spinner-border text-primary" role="status">
		                    <span class="sr-only">Loading...</span>
		                </div>
		            </div>
					
					<?php $this->load->view('interview/interview-chats',['title'=>'Interview','vc'=>$vc,'htmlid'=>'interview-content','candidate'=>$candidate])?>
				</div>
				<!--end::Messenger-->
			</div>
			<?php foreach($vc->tests as $i=>$row){?>
			<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10 <?=(!$istest || $currtestid!=$row->testid)?'d-none':''?>" id="<?=$row->testid?>-content">
				<!--begin::Messenger-->
				<div class="card" id="kt_chat_messenger">
					<!--begin::Card header-->
					<div class="card-header" id="kt_chat_messenger_header">
						<!--begin::Title-->
						<div class="card-title">
							<!--begin::User-->
							<div class="d-flex justify-content-center flex-column me-3">
								<a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1"><?=$row->test?></a>
								<!--begin::Info-->
								<div class="mb-0 lh-1">
									<span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
									<span class="fs-7 fw-semibold text-muted"><?=($row->thread==null)?'Not Started':(($row->thread->finishdt!=null)?'Finished '.ymd($row->thread->finishdt):'Started '.ymd($row->thread->createdt));?></span>
								</div>
								<!--end::Info-->
							</div>
							<!--end::User-->
						</div>
						<!--end::Title-->
						<!--begin::Card toolbar-->
						<div class="card-toolbar">
							
						</div>
						<!--end::Card toolbar-->
					</div>
					<!--end::Card header-->
					<!--begin::Card body-->
					<div class="spinner-overlay hidden" id="<?=$row->testid?>-content-page-loader">
		                <div class="spinner-border text-primary" role="status">
		                    <span class="sr-only">Loading...</span>
		                </div>
		            </div>
					
					<?php $this->load->view('interview/test-chats',['title'=>$row->test,'testid'=>$row->testid,'test'=>$row,'vc'=>$vc,'htmlid'=>$row->testid,'candidate'=>$candidate])?>

				</div>
				<!--end::Messenger-->
			</div>
			<?php } ?>
			<!--end::Content-->
		</div>
		<!--end::Layout-->
	</div>
	<!--end::Post-->
</div>
<!-- Full Screen Warning Modal -->
 <div class="modal fade" id="fullscreenModal" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullscreenModalLabel">Attention</h5>
            </div>
            <div class="modal-body">
                Please switch to full screen mode to continue the interview. <br>Click on CTRL+SHIFT+F on Windows or Command+Shift+F on Macbook.
            </div>
        </div>
    </div>
</div>
<script>
	function startinterview(vcid){
		startloading("content-page-loader");
		$.ajax({
			url:"<?=site_url('interview/loadinterviewchats')?>/"+vcid,
			method:"GET",
			data:"start=1",
			dataType:"json",
			success:function(response){
				$("#kt-interview-chat").replaceWith(response.html);
				stoploading("content-page-loader");
			}
		});
	}
	function starttest(vcid,testid){
		startloading(testid+"-content-page-loader");
		$.ajax({
			url:"<?=site_url('interview/loadtestchats')?>/"+vcid+"/"+testid,
			method:"GET",
			data:"start=1",
			dataType:"json",
			success:function(response){
				$("#kt-"+testid+"-chat").replaceWith(response.html);
				stoploading(testid+"-content-page-loader");
			}
		});
	}
	function viewtest(testid){
		if(<?=intval(!$vc->aiinterviewdone)?>){
			alert("You must finish your interview first!");
		}
		else{
			location.href="<?=site_url('interview/view/'.$vc->id)?>/"+testid;
		}
		
	}
	function viewinterview(){
		location.href="<?=site_url('interview/view/'.$vc->id)?>";
		
	}
	var chattyping='<div class="d-flex justify-content-start mb-10" id="chat-loading">\
			<div class="d-flex flex-column align-items-start">\
				<div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start chat-content" data-kt-element="message-text">\
					<div class="typing-indicator" id="typingIndicator">\
			            <div class="dot"></div>\
			            <div class="dot"></div>\
			            <div class="dot"></div>\
			        </div>\
			    </div>\
			</div>\
		</div>\
		';
	function sendinterviewchat(htmlid,elm){
		const now = new Date();
		const hours = String(now.getHours()).padStart(2, '0');
		const minutes = String(now.getMinutes()).padStart(2, '0');
		const currentTime = `${hours}:${minutes}`;

		$(elm).prop('disabled',true);
		var message=$("#"+htmlid+"-input").val();
		$("#"+htmlid+"-content").append('\
			<div class="d-flex justify-content-end mb-10">\
					<div class="d-flex flex-column align-items-end">\
						<div class="d-flex align-items-center mb-2">\
							<div class="me-3">\
								<span class="text-muted fs-7 mb-1">'+currentTime+'</span>\
								<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1"><?=$candidate->firstname?></a>\
							</div>\
						</div>\
						<div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end chat-content" \data-kt-element="message-text">'+message+'</div>\
					</div>\
				</div>\
			');
		$("#"+htmlid+"-content").append(chattyping);
		$("#"+htmlid+"-input").val("");
		var scrollableDiv = $("#"+htmlid+"-content");
		scrollableDiv.scrollTop(scrollableDiv[0].scrollHeight);
				
		$.ajax({
			url:"<?=site_url('interview/replyinterview')?>",
			type:"post",
			data:"vcid=<?=$vc->id?>&message="+message,
			dataType:"json",
			success:function(response){
				console.log(response);
				$("#chat-loading").remove();
				$("#"+htmlid+"-content").append('\
					<div class="d-flex justify-content-start mb-10">\
						<div class="d-flex flex-column align-items-start">\
							<div class="d-flex align-items-center mb-2">\
								<div class="ms-3">\
									<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1"><?=getcompany('name')?></a>\
									<span class="text-muted fs-7 mb-1">'+currentTime+'</span>\
								</div>\
							</div>\
							<div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start chat-content" data-kt-element="message-text">'+response.replyresponse+'</div>\
						</div>\
					</div>\
					');
			
				scrollableDiv.scrollTop(scrollableDiv[0].scrollHeight);
				$(elm).prop('disabled',false);
				
			},
			error:function(err){
				$("#chat-loading").remove();
			}
		});
	}
	function sendtestchat(htmlid,testid,elm){
		const now = new Date();
		const hours = String(now.getHours()).padStart(2, '0');
		const minutes = String(now.getMinutes()).padStart(2, '0');
		const currentTime = `${hours}:${minutes}`;

		$(elm).prop('disabled',true);
		var message=$("#"+htmlid+"-input").val();
		$("#"+htmlid+"-content").append('\
			<div class="d-flex justify-content-end mb-10">\
					<div class="d-flex flex-column align-items-end">\
						<div class="d-flex align-items-center mb-2">\
							<div class="me-3">\
								<span class="text-muted fs-7 mb-1">'+currentTime+'</span>\
								<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1"><?=$candidate->firstname?></a>\
							</div>\
						</div>\
						<div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end chat-content" \data-kt-element="message-text">'+message+'</div>\
					</div>\
				</div>\
			');
		$("#"+htmlid+"-content").append(chattyping);
		$("#"+htmlid+"-input").val("");
		var scrollableDiv = $("#"+htmlid+"-content");
		scrollableDiv.scrollTop(scrollableDiv[0].scrollHeight);
				
		$.ajax({
			url:"<?=site_url('interview/replytest')?>",
			type:"post",
			data:"vcid=<?=$vc->id?>&testid="+testid+"&message="+message,
			dataType:"json",
			success:function(response){
				console.log(response);
				$("#chat-loading").remove();
				$("#"+htmlid+"-content").append('\
					<div class="d-flex justify-content-start mb-10">\
						<div class="d-flex flex-column align-items-start">\
							<div class="d-flex align-items-center mb-2">\
								<div class="ms-3">\
									<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1"><?=getcompany('name')?></a>\
									<span class="text-muted fs-7 mb-1">'+currentTime+'</span>\
								</div>\
							</div>\
							<div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start chat-content" data-kt-element="message-text">'+response.replyresponse+'</div>\
						</div>\
					</div>\
					');
				scrollableDiv.scrollTop(scrollableDiv[0].scrollHeight);
				$(elm).prop('disabled',false);
				
			},
			error:function(err){
				$("#chat-loading").remove();
			}
		});
	}
	// Timer variables
    let timerInterval;
    let totalSeconds = 0;

    // Start Timer function
    function startTimer() {
        timerInterval = setInterval(function() {
            totalSeconds++;
            let hours = Math.floor(totalSeconds / 3600);
            let minutes = Math.floor((totalSeconds % 3600) / 60);
            let seconds = totalSeconds % 60;
            $('#timer').text(
                `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`
            );
        }, 1000);
    }

    // Stop Timer function
    function stopTimer() {
        clearInterval(timerInterval);
    }
	$(document).ready(function() {
        // Function to check full screen mode
        function checkFullScreen() {
        	// console.log($(document).fullscreenElement);
        	console.log(window.innerHeight+" "+screen.height);
        	if( window.innerHeight == screen.height) {
        		return true;
        	}
            else
            	return false;
            	// return true;
        }

        // Show modal if not in full screen
        function enforceFullScreen() {
        	console.log("CHECK");
            if (!checkFullScreen()) {
                $('#fullscreenModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#fullscreenModal').modal('show');
            } else {
                $('#fullscreenModal').modal('hide');
            }
        }

        // Event listeners for fullscreen change
        setInterval(enforceFullScreen, 1000);



        // Track if user leaves the tab
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                alert('You have exited out of the interview. This action is being recorded.');
            }
        });

        // Example usage: startTimer();
        // To start the timer, call startTimer();
        // To stop the timer, call stopTimer();

        // Block copy-paste on the whole page
        $(document).on('copy paste cut', function(e) {
            e.preventDefault();
        });
        // Initial check
        enforceFullScreen();
        // startTimer();
    });
</script>