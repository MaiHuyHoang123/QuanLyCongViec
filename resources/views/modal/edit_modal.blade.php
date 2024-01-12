<div class="modal-header">
    <h5 class="modal-title" id="editTaskModalLabel">Sửa công việc</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('update-job')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" value="{{$job->id}}" name="job_id" hidden>
        <div class="mb-3">
            <label for="taskName" class="form-label">Tên công việc:</label>
            <input type="text" class="form-control bg-transparent border-primary" id="taskName" name="name" required value="{{ $job->name }}">
        </div>
        <div class="mb-3">
            <label for="taskName" class="form-label">Mô tả:</label>
            <input type="text" class="form-control bg-transparent border-primary" id="taskName" name="desc" required value="{{ $job->desc }}">
        </div>
        <div class="mb-3">
            <label for="taskName" class="form-label">Nội dung:</label>
            <textarea name="content" class="form-control bg-transparent border-primary" cols="30" rows="10">{!! $job->content !!}</textarea>
        </div>
        <div class="mb-3">
            <label for="taskName" class="form-label">File công việc:</label>
            <p class="text-muted">File đã chọn: {{ $job->file_name }}</p>
            <input type="file" class="form-control bg-transparent border-primary" id="taskName" name="start_file" value="">
        </div>
        <div class="mb-3">
            <label for="taskName" class="form-label">Nhóm thực hiện:</label>
            <select value="{{$team->name ?? ''}}" class="form-select selection-team bg-transparent border-primary" name="team_implement_job" aria-label="Default select example">
                <option>Nhóm thực hiện ...</option>
           </select>
        </div>
        <div class="mb-3">
            <label for="taskName" class="form-label">Nhân viên thực hiện:</label>
            <x-multi-select class="form-control bg-transparent border-primary selection-staff" id="staff-implement-job-edit" name="staff_implement_job"></x-multi-select>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="taskName" class="form-label">Thời gian bắt đầu:</label>
                    <input type="text" class="form-control bg-transparent border-primary"
                        placeholder="Select date" data-input name="start_time" value="{{ \Carbon\Carbon::parse($job->start_time)->format('d-m-Y') }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="taskName" class="form-label">Thời gian kết thúc:</label>
                    <input type="text" class="form-control bg-transparent border-primary"
                        placeholder="Select date" data-input name="end_time" value="{{ \Carbon\Carbon::parse($job->end_time)->format('d-m-Y') }}">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="taskName" class="form-label">Ưu tiên:</label>
            <div class="mb-4">
                @if ($job->prioritize==1)
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="radioInline">
                            Có
                        </label>
                        <input checked type="radio" class="form-check-input" name="prioritize" id="radioInline" value="1">
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="radioInline1">
                            Không
                        </label>
                        <input type="radio" class="form-check-input" name="prioritize" id="radioInline1" value="0">
                    </div>
                @else
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="radioInline">
                            Có
                        </label>
                        <input type="radio" class="form-check-input" name="prioritize" id="radioInline" value="1">
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="radioInline1">
                            Không
                        </label>
                        <input checked type="radio" class="form-check-input" name="prioritize" id="radioInline1" value="0">
                    </div>
                @endif
                
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        </div>
    </form>
</div>
