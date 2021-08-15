<!-- Modal Content -->
<div class="modal fade" id="deleteDoctor" tabindex="-1" role="dialog" aria-labelledby="deleteDoctor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h2 class="h4 modal-title text-center mb-3">Are you sure?</h2>
                <p>This action cannot be undone once completed.</p>
                <p>Do you want to continue?.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-gray-600 me-auto" data-bs-dismiss="modal">Close</button>
                <form method="POST" action="{{ route('doctors.destroy',$doctor->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Content -->