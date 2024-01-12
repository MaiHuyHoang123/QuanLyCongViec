<div class="modal-content">
    <form action="{{ route('job.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="jobModalLabel">Chi tiết công việc</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <div class="mb-3">
                    <label class="fw-bolder mb-0 text-uppercase">Tên:</label>
                    <p class="text-muted">{{ $job->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bolder mb-0 text-uppercase">Tiêu đề:</label>
                    <p class="text-muted">{{ $job->desc }}</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bolder mb-0 text-uppercase">Nội dung:</label>
                    <p class="text-muted">{!! $job->content !!}</p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="fw-bolder mb-0 text-uppercase">File:</label>
                            <p class="text-muted">{{ $job->file_name }}</p>
                            <a class="badge bg-info" href="{{ $job->file_link }}"><i
                                    data-feather="download"></i>Tải xuống</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="fw-bolder mb-0 text-uppercase">File hoàn thành:</label>
                            @if ($job->file_name_comp != 'None')
                                <p class="text-muted">{{ $job->file_name_comp }}</p>
                                <a class="badge bg-info" href="{{ $job->file_link_comp }}">Tải xuống</a>
                            @else
                                <p class="text-muted">{{ $job->file_name_comp }}</p>
                                <input class="form-control bg-transparent border-primary " name="complete_file" type="file" id="formFile">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="fw-bolder mb-0 text-uppercase">Bắt đầu:</label>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($job->start_time)->format('d-m-Y') }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="fw-bolder mb-0 text-uppercase">Kết thúc:</label>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($job->end_time)->format('d-m-Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="fw-bolder mb-0 text-uppercase">Trạng thái:</label>
                            <select class="form-select bg-transparent border-primary" name="status" style="width: 80%">
                                @switch($job->status)
                                    @case(1)
                                        <option value="1" selected>Đang thực hiện</option>
                                        <option value="2">Đã hoàn thành</option>
                                        <option value="3">Không hoàn thành</option>
                                        <option value="4">Tạm dừng</option>
                                        <option value="5">Hủy bỏ</option>
                                    @break

                                    @case(2)
                                        <option value="1">Đang thực hiện</option>
                                        <option value="2" selected>Đã hoàn thành</option>
                                        <option value="3">Không hoàn thành</option>
                                        <option value="4">Tạm dừng</option>
                                        <option value="5">Hủy bỏ</option>
                                    @break

                                    @case(3)
                                        <option value="1">Đang thực hiện</option>
                                        <option value="2">Đã hoàn thành</option>
                                        <option value="3" selected>Không hoàn thành</option>
                                        <option value="4">Tạm dừng</option>
                                        <option value="5">Hủy bỏ</option>
                                    @break

                                    @case(4)
                                        <option value="1">Đang thực hiện</option>
                                        <option value="2">Đã hoàn thành</option>
                                        <option value="3">Không hoàn thành</option>
                                        <option value="4" selected>Tạm dừng</option>
                                        <option value="5">Hủy bỏ</option>
                                    @break

                                    @case(5)
                                        <option value="1">Đang thực hiện</option>
                                        <option value="2">Đã hoàn thành</option>
                                        <option value="3">Không hoàn thành</option>
                                        <option value="4">Tạm dừng</option>
                                        <option value="5" selected>Hủy bỏ</option>
                                    @break
                                @endswitch
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <i class="icon-sm text-white" data-feather="alert-circle"></i>
                            <label class="fw-bolder mb-0 text-uppercase">Tình trạng:</label>
                            <p class="text-muted">
                                @php
                                    $date1 = new DateTime();
                                    $date2 = new DateTime($job->end_time);
                                    $interval = $date1->diff($date2);
                                    $numberOfDays = $interval->format('%r%a');
                                @endphp
                                @if ($job->status == 2)
                                    <span class="badge bg-success">Hoàn thành</span>
                                @else
                                    @if ($numberOfDays >= 0)
                                        @if ($numberOfDays < 4)
                                            <span class="badge bg-warning">Đến hạn</span>
                                        @else
                                            <span class="badge bg-success">Trong hạn</span>
                                        @endif
                                    @else
                                        <span class="badge bg-danger">Quá hạn</span>
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="fw-bolder mb-0 text-uppercase">Bình luận:</label>
                    <textarea class="form-control bg-transparent border-primary" id="exampleFormControlTextarea1" rows="5" name="comment">{{ $job->comment }}</textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        </div>
    </form>
</div>
