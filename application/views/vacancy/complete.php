<style>
    .workexp-entry, .education-entry {
        background-color: #f8f9fa; /* Light grey background */
        border: 1px solid #dee2e6; /* Light border */
        border-radius: 0.25rem; /* Rounded corners */
        padding: 1rem; /* Padding inside the card */
        margin-bottom: 1rem; /* Space between cards */
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Light shadow for depth */
    }
    .workexp-entry .card-body, .education-entry .card-body {
        padding: 0; /* Remove padding from card body */
    }
    .workexp-entry .row, .education-entry .row {
        margin: 0; /* Remove row margins */
    }
    .workexp-entry .fv-row, .education-entry .fv-row {
        margin-bottom: 1rem; /* Space between form fields */
    }
    .workexp-entry label, .education-entry label {
        font-weight: 600; /* Bold labels */
    }
    .workexp-entry input, .education-entry input,
    .workexp-entry textarea, .education-entry textarea,
    input, textarea {
        background-color: #ffffff!important; /* White background for inputs */
    }
</style>


<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
	<div class="content flex-row-fluid" id="kt_content">
		<!--begin::Careers - List-->
		<div class="card">
			<!--begin::Body-->
			<div class="card-body p-lg-17">
				<div class="d-flex flex-column flex-lg-row">
					<div class="flex-lg-row-fluid me-0 me-lg-20">
						<!--end::Accordion-->
						<div class="mt-10">
							<!--begin::Title-->
							<h4 class="fs-1 text-gray-800 w-bolder mb-6">Complete your Application</h4>
							<!--end::Title-->
							
						</div>
						
						<?= form_open('vacancy/completep', ['method' => 'post', 'class' => 'form-horizontal','id'=>'complete-form']) ?>
							<input type="hidden" value="<?= $vcid ?>" name="vcid">

							<!-- General Information -->
							<div class="row mb-5" id="basic-section">
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">First Name</label>
							        <input type="text" class="form-control form-control-solid form-control-sm" name="firstname" value="<?= $candidate->firstname ?>" required/>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Last Name</label>
							        <input type="text" class="form-control form-control-solid form-control-sm" name="lastname" value="<?= $candidate->lastname ?>" required/>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Email</label>
							        <input type="email" class="form-control form-control-solid form-control-sm" name="email" value="<?= $candidate->email ?>" required/>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Phone (+62)</label>
							        <input type="text" class="form-control form-control-solid form-control-sm" name="phone" value="<?= $candidate->phone ?>" required/>
							    </div>
							</div>

							<div class="row mb-5">
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Gender</label>
							        <select class="form-select form-control-solid form-select-sm" name="gender" required>
							            <option value="">Select Gender</option>
							            <option value="male" <?= $candidate->gender == 'male' ? 'selected' : '' ?>>Male</option>
							            <option value="female" <?= $candidate->gender == 'female' ? 'selected' : '' ?>>Female</option>
							            <option value="other" <?= $candidate->gender == 'other' ? 'selected' : '' ?>>Other</option>
							        </select>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Date of Birth</label>
							        <input type="text" class="form-control form-control-solid form-control-sm " placeholder="YYYY-MM-DD" name="dob" value="<?= $candidate->dob ?>" required/>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Age</label>
							        <input type="number" class="form-control form-control-solid form-control-sm" name="age" value="<?= $candidate->age ?>" required/>
							    </div>
							    <div class="col-md-3 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Work Experience (Years)</label>
							        <input type="text" class="form-control form-control-solid form-control-sm" name="workexp" value="<?= $candidate->workexp ?>" required/>
							    </div>
							</div>

							<div class="row mb-5">
							    <div class="col-md-12 fv-row">
							        <label class="fs-5 fw-semibold mb-2">Address</label>
							        <input type="text" class="form-control form-control-solid form-control-sm" name="address" value="<?= $candidate->address ?>" required/>
							    </div>
							</div>

							<div class="separator mb-3"></div>

							<!-- Work Experience -->
							<h4 class="mb-3">Work Experience</h4>
							<div id="workexp-section">
							    <?php foreach ($candidate->workexps as $i=>$workexp) : ?>
							    <div class="card mb-5 workexp-entry" <?php if($i==0){?>id="work-section"<?php } ?>>
							        <div class="card-body">
							            <div class="row">
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Company</label>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="workexps[company][]" value="<?= $workexp->company ?>" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Position</label>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="workexps[position][]" value="<?= $workexp->position ?>" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Start Year</label>
							                    <input type="number" class="form-control form-control-solid form-control-sm" name="workexps[startyear][]" value="<?= $workexp->startyear ?>" min="1900" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">End Year</label>
							                    <input type="number" class="form-control form-control-solid form-control-sm" name="workexps[endyear][]" value="<?= $workexp->endyear ?>" min="1900" required/>
							                </div>
							                <div class="col-md-12 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Responsibilities</label>
							                    <textarea class="form-control form-control-solid form-control-sm" name="workexps[responsibilities][]"><?= $workexp->responsibilities ?></textarea>
							                </div>
							                <div class="col-md-12 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Achievements</label>
							                    <textarea class="form-control form-control-solid form-control-sm" name="workexps[achievements][]"><?= $workexp->achievements ?></textarea>
							                </div>
							            </div>
							        </div>
							    </div>
							    <?php endforeach; ?>
							</div>
							<button type="button" class="btn btn-secondary mb-5" id="add-workexp">Add Work Experience</button>

							<div class="separator mb-3"></div>

							<!-- Education History -->
							<h4 class="mb-3">Education History</h4>
							<div id="education-section">
							    <?php foreach ($candidate->educations as $i=>$education) : ?>
							    <div class="card mb-5 education-entry" <?php if($i==0){?>id="education-section"<?php } ?>>
							        <div class="card-body">
							            <div class="row">
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Degree</label>
							                    <select class="form-select form-control-solid form-select-sm" name="educations[degree][]" required>
							                    	<option value="">Please Choose</option>
							                    	<?php foreach($degrees as $row){?>
														<option value="<?=$row->name?>" <?= $education->degree == $row->name ? 'selected' : '' ?>><?=$row->name?></option>
													<?php }?>
							                    </select>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Institution</label>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="educations[institution][]" value="<?= $education->institution ?>" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Field of Study</label>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="educations[field][]" value="<?= $education->field ?>" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Start Year</label>
							                    <input type="number" class="form-control form-control-solid form-control-sm" name="educations[startyear][]" value="<?= $education->startyear ?>" min="1900" required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">End Year</label>
							                    <input type="number" class="form-control form-control-solid form-control-sm" name="educations[endyear][]" value="<?= $education->endyear ?>"  min="1900"required/>
							                </div>
							                <div class="col-md-3 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">GPA</label>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="educations[gpa][]" value="<?= $education->gpa ?>"/>
							                </div>
							                <div class="col-md-12 fv-row">
							                    <label class="fs-5 fw-semibold mb-2">Notes</label>
							                    <textarea class="form-control form-control-solid form-control-sm" name="educations[notes][]"><?= $education->notes ?></textarea>
							                </div>
							            </div>
							        </div>
							    </div>
							    <?php endforeach; ?>
							</div>
							<button type="button" class="btn btn-secondary mb-5" id="add-education">Add Education</button>
							
							<div class="separator mb-3"></div>
							
							<!-- Skills -->
							<h4 class="mb-3">Skills</h4>
							<div id="skills-section">
							    <table class="table table-bordered table-sm">
							        <thead>
							            <tr>
							                <th>Skill</th>
							                <th>Proficiency Level</th>
							                <th>Action</th>
							            </tr>
							        </thead>
							        <tbody>
							            <?php foreach ($candidate->skills as $skill) : ?>
							            <tr class="skills-entry">
							                <td>
							                    <input type="text" class="form-control form-control-solid form-control-sm" name="skills[skill][]" value="<?= $skill->skill ?>"/>
							                </td>
							                <td>
							                    <select class="form-select form-control-solid form-select-sm" name="skills[proficiencylevel][]">
							                    	<option value="">Please Select</option>
							                    	<option value="Beginner" <?= ($skill->proficiencylevel=='Beginner')?'selected':'' ?>>Beginner</option>
							                    	<option value="Intermediate" <?= ($skill->proficiencylevel=='Intermediate')?'selected':'' ?>>Intermediate</option>
							                    	<option value="Advanced" <?= ($skill->proficiencylevel=='Advanced')?'selected':'' ?>>Advanced</option>
							                    	<option value="Expert" <?= ($skill->proficiencylevel=='Expert')?'selected':'' ?>>Expert</option>
							                    </select>
							                </td>
							                <td>
							                    <button type="button" class="btn btn-danger remove-skill btn-sm">Remove</button>
							                </td>
							            </tr>
							            <?php endforeach; ?>
							        </tbody>
							    </table>
							</div>
							<button type="button" class="btn btn-secondary mb-5" id="add-skill">Add Skill</button>

							<div class="separator mb-8"></div>

							<!-- Submit Button -->
							<button type="submit" class="btn btn-primary" id="submit-btn">
							    <span class="indicator-label">Confirm your Application</span>
							</button>

						<?= form_close() ?>

					</div>
				</div>
				<!--end::Layout-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Careers - List-->
	</div>
	<!--end::Post-->
</div>
<!-- Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="completeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="completeModalLabel">Konfirmasi dan Lengkapi Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Di halaman ini, Anda harus mengonfirmasi informasi Anda dan melengkapi informasi yang belum lengkap. Ikuti langkah-langkah berikut:</p>
                <ul>
                    <li>Masukkan informasi dasar Anda.</li>
                    <li>Lengkapi riwayat pekerjaan Anda dan tambahkan pengalaman kerja baru jika diperlukan.</li>
                    <li>Lengkapi riwayat pendidikan Anda dan tambahkan informasi pendidikan baru jika diperlukan.</li>
                    <li>Masukkan keterampilan teknis Anda.</li>
                    <li>Klik tombol kirim untuk menyelesaikan pengajuan.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="startTour">Mengerti</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#add-workexp').click(function() {
        $('#workexp-section').append(`
            <div class="card mb-5 workexp-entry">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Company</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="workexps[company][]" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Position</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="workexps[position][]" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Start Year</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" name="workexps[startyear][]" min="1900" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">End Year</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" name="workexps[endyear][]" min="1900" required/>
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Responsibilities</label>
                            <textarea class="form-control form-control-solid form-control-sm" name="workexps[responsibilities][]"></textarea>
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Achievements</label>
                            <textarea class="form-control form-control-solid form-control-sm" name="workexps[achievements][]"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `);
    });

    $('#add-education').click(function() {
        $('#education-section').append(`
            <div class="card mb-5 education-entry">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Degree</label>
                            <select class="form-select form-control-solid form-select-sm" name="educations[degree][]" required>
                                <option value="">Please Choose</option>
                                <?php foreach($degrees as $row){?>
                                    <option value="<?=$row->name?>"><?=$row->name?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Institution</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="educations[institution][]" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Field of Study</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="educations[field][]" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Start Year</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" name="educations[startyear][]" min="1900" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">End Year</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" name="educations[endyear][]" min="1900" required/>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-5 fw-semibold mb-2">GPA</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="educations[gpa][]"/>
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Notes</label>
                            <textarea class="form-control form-control-solid form-control-sm" name="educations[notes][]"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `);
    });

    $('#add-skill').click(function() {
        $('#skills-section tbody').append(`
            <tr class="skills-entry">
                <td>
                    <input type="text" class="form-control form-control-solid form-control-sm" name="skills[skill][]" />
                </td>
                <td>
                    <select class="form-select form-control-solid form-select-sm" name="skills[proficiencylevel][]">
                        <option value="">Please Select</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                        <option value="Expert">Expert</option>
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-skill">Remove</button>
                </td>
            </tr>
        `);
    });

    // Delegate event to dynamically added elements
    $(document).on('click', '.remove-skill', function() {
        $(this).closest('tr').remove();
    });
    $("#complete-form").submit(function(e){
		$("#submit-btn").html("Loading... DO NOT CLOSE THIS WINDOW!");
		$("#submit-btn").prop("disabled",true);
	});
	$('#completeModal').modal('show');

    // Define the tour steps
    var tourSteps = [
        {
            element: '#basic-section',
            intro: 'Ini adalah bagian di mana Anda harus memasukkan informasi dasar Anda.'
        },
        {
            element: '#work-section',
            intro: 'Di sini Anda dapat melengkapi riwayat pekerjaan Anda dan menambahkan pengalaman kerja baru jika diperlukan.'
        },
        {
            element: '#education-section',
            intro: 'Lengkapi riwayat pendidikan Anda di bagian ini dan tambahkan informasi pendidikan baru jika diperlukan.'
        },
        {
            element: '#skills-section',
            intro: 'Masukkan keterampilan teknis Anda di sini.'
        },
        {
            element: '#submit-btn',
            intro: 'Klik tombol ini setelah semua informasi lengkap untuk menyelesaikan pengajuan Anda.'
        }
    ];

    // Start the tour when the user clicks "Mengerti"
    $('#startTour').on('click', function() {
        $('#completeModal').modal('hide');
        setTimeout(function() {
            introJs().setOptions({
                steps: tourSteps
            }).start();
        }, 500); // Delay to ensure the modal is fully hidden
    });
});
</script>
