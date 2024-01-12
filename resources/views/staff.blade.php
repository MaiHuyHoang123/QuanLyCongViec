@extends('dashboard')
@section('content')
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Quản Lý Nhân Viên</h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="edit"></i>
                    Thêm nhân viên
                </button>
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
                            <table class="table table-hover mb-0" id="tbl">
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
                                                @if ($staff->role_id==1)
                                                    Admin
                                                @else
                                                    Người dùng
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown" id="dropdownMenuButton7" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <a type="button">
                                                        <i class="icon-lg text-muted pb-3px"
                                                            data-feather="more-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                                        <a class="dropdown-item d-flex align-items-center"
                                                            href="javascript:;"><i data-feather="eye"
                                                                class="icon-sm me-2"></i> <span
                                                                class="">Xem</span></a>
                                                        <a class="dropdown-item d-flex align-items-center"
                                                            href="javascript:;"><i data-feather="edit-2"
                                                                class="icon-sm me-2"></i> <span
                                                                class="">Sửa</span></a>
                                                        <a class="dropdown-item d-flex align-items-center"
                                                            href="javascript:;"><i data-feather="trash"
                                                                class="icon-sm me-2"></i> <span
                                                                class="">Xóa</span></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 25px">
                            {{ $staffs->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
