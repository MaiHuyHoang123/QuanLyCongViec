@extends('dashboard')
@section('content')
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Quản Lý Công Việc</h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <div class="me-2 mb-md-0">
                    <select id="teamFilter" class="form-select">
                    </select>
                </div>
                <div class="me-2 mb-md-0">
                    <select id="statusFilter" class="form-select">
                        <option value="">Tình trạng</option>
                        <option value="1">Đang thực hiện</option>
                        <option value="2">Đã hoàn thành</option>
                        <option value="3">Không hoàn thành</option>
                        <option value="4">Tạm dừng</option>
                        <option value="5">Hủy bỏ</option>
                        <option value="6">Tất cả</option>
                    </select>
                </div>
                <button @click="filterJobs()" type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0 mx-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                        <path
                            d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z">
                        </path>
                    </svg>
                    <span class="mr-1">Lọc</span>
                </button>
                <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                    <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i
                            data-feather="calendar" class="text-primary"></i></span>
                    <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date"
                        data-input>
                </div>
                <button @click="showModalInsert()" type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0"
                    data-bs-toggle="modal" data-bs-target="#addTaskModal">
                    <i class="btn-icon-prepend" data-feather="edit"></i>
                    Thêm công việc
                </button>
            </div>
        </div>
        @if (session('success'))
            <div id="alertDiv" class="alert alert-success alert-dismissible fade show" role="alert">
                {{-- <strong>Lưu thành công!</strong> --}}
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>
            <script>
                // Sử dụng JavaScript để ẩn thông báo sau khoảng thời gian
                setTimeout(function() {
                    document.getElementById('alertDiv').style.display = 'none';
                }, 3000);
            </script>
        @endif
        @if (session('error'))
            <div id="alertDiv" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{-- <strong>Lưu thành công!</strong> --}}
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>
            <script>
                // Sử dụng JavaScript để ẩn thông báo sau khoảng thời gian
                setTimeout(function() {
                    document.getElementById('alertDiv').style.display = 'none';
                }, 3000);
            </script>
        @endif
        <div class="row">
            <div class="stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <div class="card-header" style="border-bottom: none; padding: 0 0 15px 0 ; background: white">
                                <h2>Danh sách công việc</h2>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="tbl">
                                <thead>
                                    <tr>
                                        <th class="pt-0">Tên</th>
                                        <th class="pt-0">Tiêu đề</th>
                                        <th class="pt-0">Bắt đầu</th>
                                        <th class="pt-0">Kết thúc</th>
                                        <th class="pt-0">Trạng thái</th>
                                        <th class="pt-0">Tình trạng</th>
                                        <th class="pt-0">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $job)
                                        <tr id="{{ $job->id }}" class="clickable-row">
                                            <td>{{ $job->name }}</td>
                                            <td>{{ $job->desc }}</td>
                                            <td>{{ \Carbon\Carbon::parse($job->start_time)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($job->end_time)->format('d-m-Y') }}</td>
                                            <td>
                                                @switch($job->status)
                                                    @case(1)
                                                        Đang thực hiện
                                                    @break

                                                    @case(2)
                                                        Đã hoàn thành
                                                    @break

                                                    @case(3)
                                                        Không hoàn thành
                                                    @break

                                                    @case(4)
                                                        Tạm dừng
                                                    @break

                                                    @case(5)
                                                        Hủy bỏ
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                @php
                                                    $date1 = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                                                    $formattedDate = $date1->format('Y-m-d');
                                                    $currentDate = new DateTime($formattedDate);
                                                    $deadline = new DateTime($job->end_time);
                                                    $interval = $currentDate->diff($deadline);
                                                    $numberOfDays = $interval->format('%r%d');
                                                @endphp
                                                @if ($job->status == 2)
                                                    <span class="badge bg-success">Hoàn thành</span>
                                                @else
                                                    @if ($numberOfDays >= 0)
                                                        @if ($numberOfDays < 1)
                                                            <span class="badge bg-warning">Đến hạn</span>
                                                        @else
                                                            <span class="badge bg-success">Trong hạn</span>
                                                        @endif
                                                    @else
                                                        <span class="badge bg-danger">Quá hạn</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="d-flex">
                                                {{-- <div class="dropdown" id="dropdownMenuButton7" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <a type="button">
                                                        <i class="icon-lg text-muted pb-3px"
                                                            data-feather="more-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                                        <a class="dropdown-item d-flex align-items-center"
                                                            href="javascript:;"><i data-feather="eye"
                                                                class="icon-sm me-2"></i> <span
                                                                class="">Xem</span></a> --}}
                                                <button type="button" class="border-0 bg-transparent" data-toggle="tooltip"
                                                    data-placement="bottom" title="Hoàn thành">
                                                    <div class="form-check form-switch">
                                                        <input @click="checkComplete({{ $job->id }},event)"
                                                            class="form-check-input check-complete cursor-pointer" type="checkbox"
                                                            name="{{ $job->id }}">
                                                    </div>
                                                </button>
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"
                                                    data-job-id="{{ $job->id }}"><i data-feather="edit-2"
                                                        class="icon-sm me-2"></i> <span class="">Sửa</span></a>
                                                {{-- <a class="dropdown-item d-flex align-items-center"
                                                            href="javascript:;"><i data-feather="trash"
                                                                class="icon-sm me-2"></i> <span
                                                                class="">Xóa</span></a>
                                                    </div>
                                                </div> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="d-flex justify-content-end" style="margin-top: 25px">
                            {{ $jobs->links('pagination::bootstrap-4') }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
