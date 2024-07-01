<div class="modal fade" id="setdelete-modal" tabindex="-1" aria-labelledby="view-setdelete-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="view-stage-modal-label">Delete Data?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- View your form fields for adding a new stage here -->
                <?php echo form_open('#', 'class="row g-3" id="setdelete-form"'); ?>
                	<input type="hidden" id="setdelete-id" name="id">
                    <div class="col-md-12">
                        <h4>Are you sure you want to delete this data?</h4>
                        <b>This process is irreversible, please proceed with caution!!!</b>
                    </div>
                    
                    <!-- View more input fields as needed -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Confirm Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>