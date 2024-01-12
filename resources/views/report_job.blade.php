@extends('dashboard')
@section('content')
    <div class="page-content" x-data="reportJobModal">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Quản Lý Nhân Viên</h4>
            </div>
        </div>
        <div class="row">
            <div class="stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <div class="card-header" style="border-bottom: none; padding: 0 0 15px 0 ; background: white">
                                <h2>Danh sách nhân viên</h2>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="pt-0">ID</th>
                                        <th class="pt-0">Tên nhân viên</th>
                                        <th class="pt-0">Nhóm</th>
                                        <th class="pt-0">Chức vụ</th>
                                        <th class="pt-0">Hành động</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffs as $staff)
                                        <tr id="{{ $staff->id }}">
                                            <td>{{ $staff->id }}</td>
                                            <td>{{ $staff->name }}</td>
                                            <td>
                                                @switch($staff->team_id)
                                                    @case(1)
                                                        Thiết kế
                                                    @break

                                                    @case(2)
                                                        Lập trình
                                                    @break

                                                    @case(3)
                                                        Truyền thông
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                @if ($staff->role_id == 1)
                                                    Admin
                                                @elseif($staff->role_id == 2)
                                                    Quản lý
                                                @else
                                                    Người dùng
                                                @endif
                                            </td>
                                            <td>
                                                <div @click="showReportForStaff($event)" data-bs-toggle="modal"
                                                    data-bs-target="#reportJobModal" data-staff-id="{{ $staff->id }}"
                                                    class="d-flex align-items-center flex-wrap text-nowrap">
                                                    <button data-staff-id="{{ $staff->id }}" type="button"
                                                        class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                                                        <i class="btn-icon-prepend" data-feather="edit"></i>
                                                        Tạo báo cáo
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- form báo cáo --}}
        <div class="modal fade" id="reportJobModal" tabindex="-1" aria-labelledby="reportJobModalLabel" aria-hidden="true">
            <div class="modal-dialog max-vw-80">
                <div class="modal-content overflow-scroll max-vw-80">
                    <!-- Nội dung của modal -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportJobModalLabel">Báo cáo công việc</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex">
                            <div>
                                <label for="start-date">Ngày bắt đầu</label>
                                <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                                    <span class="input-group-text input-group-addon bg-transparent border-primary"
                                        data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                                    <input id="start-date" name="start_date" type="text" class="form-control bg-transparent border-primary"
                                        placeholder="Select date" data-input>
                                </div>
                            </div>
                            <div>
                                <label for="end-date">Ngày kết thúc</label>
                                <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0 d-flex flex-row"
                                    id="dashboardDate">
                                    <span class="input-group-text input-group-addon bg-transparent border-primary"
                                        data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                                    <input id="end-date" name="end_date" type="text" class="form-control bg-transparent border-primary"
                                        placeholder="Select date" data-input>
                                </div>
                            </div>
                            <div class="d-flex flex-column-reverse flex-wrap text-nowrap">
                                <button @click="filterReportJob()" type="button"
                                    class="btn btn-primary btn-icon-text mb-2 mb-md-0 mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                        <path
                                            d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z">
                                        </path>
                                    </svg>
                                    <span class="mr-1">Lọc</span>
                                </button>
                            </div>
                            <div @click='exportReportJob()' class="d-flex flex-column-reverse flex-wrap text-nowrap">
                                <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0 bottom-0">
                                    <i class="btn-icon-prepend" data-feather="edit"></i>
                                    Tạo báo cáo
                                </button>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên công việc</th>
                                    <th scope="col">Ngày bắt đầu</th>
                                    <th scope="col">Thời gian hoàn thành</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(job,index) in jobCompleteByStaff">
                                    <tr>
                                        <th scope="row" x-text="index"></th>
                                        <td x-text="job.name"></td>
                                        <td x-text="job.start_time"></td>
                                        <td x-text="job.completed_at"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('reportJobModal', () => ({
                jobCompleteByStaff: [],
                staffId: null,
                async showReportForStaff(event) {
                    this.staffId = event.target.getAttribute('data-staff-id');
                    this.jobCompleteByStaff = await (await fetch(
                        `{{ route('job_complete') }}?staffId=${this.staffId}`)).json();
                },
                async exportReportJob() {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ route('excel') }}", // Đường dẫn tới API hoặc trang máy chủ
                        method: "POST", // Phương thức HTTP (GET, POST, PUT, DELETE, vv.)
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            'reportJob' : this.jobCompleteByStaff,
                            'staffId' : this.staffId
                        },
                        success: function(data) {
                            window.location.href = `{{ route('excel.export') }}/${data}`;
                        },
                        error: function(xhr, status, error) {
                            // Xử lý lỗi nếu có
                            console.error("Error:", status, error);
                        }
                    });
                },
                async filterReportJob(){
                    var start_date = $('input[name="start_date"]').val();
                    var end_date = $('input[name="end_date"]').val();
                    this.jobCompleteByStaff = await (await fetch(
                        `{{ route('job_complete') }}?staffId=${this.staffId}&start_date=${start_date}&end_date=${end_date}`)).json();
                }
            }))
        })
    </script>
@endsection
