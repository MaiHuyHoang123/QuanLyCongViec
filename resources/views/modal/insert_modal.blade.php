<!-- addTaskModal.blade.php -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Nội dung của modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Thêm công việc</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Tên công việc:</label>
                        <input type="text" class="form-control bg-transparent border-primary" id="taskName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Mô tả:</label>
                        <input type="text" class="form-control bg-transparent border-primary" id="taskName" name="desc" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Nội dung:</label>
                        <textarea name="content" class="form-control bg-transparent border-primary" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="taskName" class="form-label">File công việc:</label>
                        <input type="file" class="form-control bg-transparent border-primary" id="taskName" name="start_file">
                    </div>
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Nhóm thực hiện:</label>
                        <select class="form-select selection-team bg-transparent border-primary" name="team_implement_job" aria-label="Default select example">
                            <option>Nhóm thực hiện ...</option>
                       </select>
                    </div>
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Nhân viên thực hiện:</label>
                        <x-multi-select class="form-control bg-transparent border-primary selection-staff" id="staff-implement-job" name="staff_implement_job"></x-multi-select>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Thời gian bắt đầu:</label>
                                <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                                    <span class="input-group-text input-group-addon bg-transparent border-primary"
                                        data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                                    <input type="text" class="form-control bg-transparent border-primary bg-transparent border-primary"
                                        placeholder="Select date" data-input name="start_time">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Thời gian kết thúc:</label>
                                <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                                    <span class="input-group-text input-group-addon bg-transparent border-primary"
                                        data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                                    <input type="text" class="form-control bg-transparent border-primary bg-transparent border-primary"
                                        placeholder="Select date" data-input name="end_time">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Ưu tiên:</label>
                        <div class="mb-4">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="radioInline">
                                    Có
                                </label>
                                <input type="radio" class="form-check-input" name="prioritize" id="radioInline" value="1" checked>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="radioInline1">
                                    Không
                                </label>
                                <input type="radio" class="form-check-input" name="prioritize" id="radioInline1" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
