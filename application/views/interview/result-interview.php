<style>
	.text-title{
		font-size: 16px;
	}
</style>
<!--begin::details View-->
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
	<!--begin::Card header-->
	<div class="card-header cursor-pointer">
		<!--begin::Card title-->
		<div class="card-title m-0">
			<h3 class="fw-bold m-0">Interview Result</h3>
		</div>
		<!--end::Card title-->
		
	</div>
	<!--begin::Card header-->
	<!--begin::Card body-->
	<div class="card-body p-9">
		<!--begin::Row-->
		<div class="row mb-7">
		<?php foreach($interview->jsonarr as $key=>$val){?>
			<div class="col-lg-6 row">
				<!--begin::Label-->
				<label class="col-lg-4 fw-semibold text-title"><?=ucwords(str_replace("_", " ", $key))?></label>
				<!--end::Label-->
				<!--begin::Col-->
				<div class="col-lg-8">
					<span class="fw-bold fs-6 text-gray-800"><?php
					if(is_array($val) || is_object($val)){
						foreach($val as $row){
							if(is_object($row)){
								$rowarr=get_object_vars($row);
								foreach($rowarr as $key2=>$val2){
									echo "<b>".ucwords(str_replace("_", " ", $key2))."</b><span class='text-muted'>: ".$val2."</span><br>";
								}
								echo '<div class="separator separator-dashed"></div>';
							}
							else{
								echo "<span class='text-muted'>".$row.", </span>";
							}
							
						}
					}
					else{
						// if(is_object($val))
						// pre($val);
						echo "<span class='text-muted'>".$val."</span>";
					}
					?></span>
				</div>
				<!--end::Col-->
				<div class="separator separator-dashed"></div>
			</div>

		
		<?php } ?>
		</div>
		<!--end::Row-->
	</div>
	<!--end::Card body-->
</div>
<?php foreach($tests as $row){?>
<!--end::details View-->
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
	<!--begin::Card header-->
	<div class="card-header cursor-pointer">
		<!--begin::Card title-->
		<div class="card-title m-0">
			<h3 class="fw-bold m-0"><?=$row->test?> Result</h3>
		</div>
		<!--end::Card title-->
		
	</div>
	<!--begin::Card header-->
	<!--begin::Card body-->
	<div class="card-body p-9">
		<!--begin::Row-->
		<div class="row mb-7">
			<?php if($row->json!=null && isset($row->json->evaluation)){?>
			<div class="col-lg-6 row">
				<!--begin::Label-->
				<label class="col-lg-4 fw-semibold text-title">Evaluation</label>
				<!--end::Label-->
				<!--begin::Col-->
				<div class="col-lg-8">
					<span class="fw-bold fs-6 text-gray-800">
						<?php foreach($row->json->evaluation as $traits=>$eval){
							if(is_string($eval)){
								echo "<b>".ucwords(str_replace("_", " ", $traits))."</b><span class='text-muted'>: ".$eval."</span><br>";
							}
							else{
								foreach(get_object_vars($eval) as $traits2=>$eval2){
									echo "<b>".ucwords(str_replace("_", " ", $traits2))."</b><span class='text-muted'>: ".$eval2."</span><br>";
								}
							}
						}?>
					</span>
				</div>
				<!--end::Col-->
				<div class="separator separator-dashed"></div>
			</div>
			<?php } ?>
			<?php if($row->json!=null && isset($row->json->reasoning)){?>
			<div class="col-lg-6 row">
				<!--begin::Label-->
				<label class="col-lg-4 fw-semibold text-title">Reasoning</label>
				<!--end::Label-->
				<!--begin::Col-->
				<div class="col-lg-8">
					<span class="fw-bold fs-6 text-gray-800">
						<?php foreach($row->json->reasoning as $traits=>$eval){
							echo "<b>".ucwords(str_replace("_", " ", $traits))."</b><span class='text-muted'>: ".$eval."</span><br>";
						}?>
					</span>
				</div>
				<!--end::Col-->
				<div class="separator separator-dashed"></div>
			</div>
			<?php } ?>
		</div>
		<!--end::Row-->
	</div>
	<!--end::Card body-->
</div>
<?php } ?>