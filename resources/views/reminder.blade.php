@extends('dashboard')
@section('content')
    <div class="page-content" x-data="reminder">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Quản lý nhắc hẹn</h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                {{-- <div class="me-2 mb-md-0">
                    <select id="statusFilter" class="form-select">
                        <option value="">Tình trạng</option>
                        <option value="1">Đang thực hiện</option>
                        <option value="2">Đã hoàn thành</option>
                        <option value="3">Không hoàn thành</option>
                        <option value="4">Tạm dừng</option>
                        <option value="5">Hủy bỏ</option>
                        <option value="0">Tất cả</option>
                    </select>
                </div>
                <button @click="filterJobs()" type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0 mx-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path></svg>
                    <span class="mr-1">Lọc</span>
                </button> --}}
                <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                    <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i
                            data-feather="calendar" class="text-primary"></i></span>
                    <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date"
                        data-input>
                </div>
                <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0" data-bs-toggle="modal"
                    data-bs-target="#addRemindModal">
                    <i class="btn-icon-prepend" data-feather="edit"></i>
                    Thêm nhắc hẹn
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
                                <h2>Danh sách nhắc hẹn</h2>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="pt-0">Tiêu đề</th>
                                        <th class="pt-0">Mô tả</th>
                                        <th class="pt-0">Thời gian nhắc hẹn</th>
                                        <th class="pt-0">Nhắc nhở mỗi</th>
                                        <th class="pt-0">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reminds as $remind)
                                        <tr id="{{ $remind->id }}" class="clickable-row">
                                            <td>{{ $remind->name }}</td>
                                            <td>{{ $remind->description }}</td>
                                            <td>{{ \Carbon\Carbon::parse($remind->remind_date)->format('d-m-Y') }}
                                            </td>
                                            @php
                                                switch ($remind->period_remind) {
                                                    case 'per week':
                                                        $period = 'mỗi tuần 1 lần';
                                                        break;
                                                    
                                                    case 'per month':
                                                        $period = 'mỗi tháng 1 lần';
                                                        break;
    
                                                    case 'per 6 months':
                                                        $period = 'mỗi 6 tháng 1 lần';
                                                        break;
    
                                                    case 'per year':
                                                        $period = 'mỗi năm 1 lần';
                                                        break;
                                                    
                                                    default:
                                                        $period = '';
                                                        break;
                                                }
                                            @endphp
                                            <td>{{$period}}</td>
                                            <td class="d-flex">
                                                <div class="dropdown " id="dropdownMenuButton7" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="true">
                                                    <a type="button">
                                                        <i class="icon-lg text-muted pb-3px"
                                                            data-feather="more-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                                        <a @click="editRemind($event)"
                                                            class="dropdown-item d-flex align-items-center"
                                                            href="javascript:;" data-remind-id="{{ $remind->id }}"
                                                            data-bs-toggle="modal" data-bs-target="#updateRemindModal"><i
                                                                data-feather="edit-2" class="icon-sm me-2"></i> <span
                                                                data-remind-id="{{ $remind->id }}">Edit</span></a>
                                                        <a @click=deleteRemind($event)
                                                            class="dropdown-item d-flex align-items-center" href=""
                                                            data-remind-id="{{ $remind->id }}">
                                                            <i data-feather="trash" class="icon-sm me-2"></i>
                                                            <span data-remind-id="{{ $remind->id }}">Delete</span>
                                                        </a>
                                                    </div>
                                                </div>
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

        {{-- modal --}}
        {{-- form thêm nhắc hẹn --}}
        <div class="modal fade" id="addRemindModal" tabindex="-1" aria-labelledby="addRemindModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Nội dung của modal -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRemindModalLabel">Thêm nhắc hẹn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('reminds.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Tiêu đề:</label>
                                <input type="text" class="form-control bg-transparent border-primary" id="taskName"
                                    name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Mô tả:</label>
                                <textarea class="form-control bg-transparent border-primary" id="taskName" name="description" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="taskName" class="form-label">Thời gian nhắc nhở:</label>
                                        <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                                            <span class="input-group-text input-group-addon bg-transparent border-primary"
                                                data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                                            <input type="text"
                                                class="form-control bg-transparent border-primary bg-transparent border-primary"
                                                placeholder="Select date" data-input name="remind_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="taskName" class="form-label">Chu kì nhắc nhở:</label>
                                    <select class="form-select form-control bg-transparent border-primary" name="period_remind" aria-label="Default select example">
                                        <option selected>thông báo theo</option>
                                        <option value="per week">mỗi tuần</option>
                                        <option value="per month">mỗi tháng</option>
                                        <option value="per 6 months">mỗi 6 tháng</option>
                                        <option value="per year">mỗi năm</option>
                                      </select>
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
        {{-- form sửa nhắc hẹn --}}
        <div class="modal fade" id="updateRemindModal" tabindex="-1" aria-labelledby="updateRemindModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Nội dung của modal -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateRemindModalLabel">Sửa nhắc hẹn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('reminds.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" value="" name="remind_id" hidden>
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Tiêu đề:</label>
                                <input type="text" x-model="remindName"
                                    class="form-control bg-transparent border-primary" id="taskName" name="name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Mô tả:</label>
                                <textarea x-model="remindDescription" class="form-control bg-transparent border-primary" id="taskName"
                                    name="description" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="taskName" class="form-label">Thời gian nhắc nhở:</label>
                                        <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                                            <span class="input-group-text input-group-addon bg-transparent border-primary"
                                                data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                                            <input x-model="remindDate" type="text"
                                                class="form-control bg-transparent border-primary bg-transparent border-primary"
                                                placeholder="Select date" data-input name="remind_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="taskName" class="form-label">Chu kì nhắc nhở:</label>
                                    <select x-model='periodRemind' class="form-select form-control bg-transparent border-primary" name="period_remind" aria-label="Default select example">
                                        <option selected>thông báo theo</option>
                                        <option value="per week">mỗi tuần</option>
                                        <option value="per month">mỗi tháng</option>
                                        <option value="per 6 months">mỗi 6 tháng</option>
                                        <option value="per year">mỗi năm</option>
                                      </select>
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
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('reminder', () => ({
                remindName: '',
                remindDescription: '',
                remindDate: '',
                periodRemind: '',
                insertRemindForm: false,
                async editRemind(event) {
                    var remindId = event.target.getAttribute('data-remind-id');
                    $("input[name='remind_id']").val(remindId);
                    var remind = await (await fetch(`{{ route('reminds.show') }}/${remindId}`))
                        .json();
                    this.remindName = remind.name;
                    this.remindDescription = remind.description;
                    this.remindDate = remind.remind_date;
                    this.periodRemind = remind.period_remind;
                },
                async deleteRemind(event) {
                    var remindId = event.target.getAttribute('data-remind-id');
                    $.ajax({
                        url: `{{ route('reminds.delete') }}/${remindId}`,
                        type: 'GET',
                        dataType: 'html'
                    }).done(function(result) {
                        window.location.href = "{{ route('reminds.index') }}";
                        alert('xóa thành công');
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        // Xử lý lỗi
                        alert('có lỗi xảy ra');
                    });
                }
            }))
        })
    </script>
@endsection
