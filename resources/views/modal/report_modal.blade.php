<!-- Modal Báo cáo -->
<div class="modal-content">
    <form action="{{ route('job.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="jobModalLabel">Báo cáo công việc</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <div class="mb-3">
                    <label class="fw-bolder mb-0 text-uppercase">Tên:</label>
                    <p class="text-muted">{{ $job->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bolder mb-0 text-uppercase">Mô tả công việc:</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="comment"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Báo cáo</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        </div>
    </form>
</div>
