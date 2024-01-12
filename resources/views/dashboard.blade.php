<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dist/dropify.min.css') }}">


    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/custom.css') }}">
    <!-- End layout styles -->

    <style>
        #dropdownMenuButton7:hover {
            cursor: pointer;
        }

        td {
            vertical-align: middle;
        }
        .text-muted:hover{
            cursor: pointer;
        }
        .scroll-notify{
            height: 400px;
            overflow: scroll;
            scroll-behavior: smooth;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- import alpinejs -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <!-- import sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body x-data="app">
    @include('layout.sidebar')
    <div class="page-wrapper relative">
        @include('layout.navbar')
        @yield('content')
        @include('layout.footer')
        @include('modal.insert_modal')
    </div>
    </div>

    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- core:js -->
    <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>


    <!-- inject:js -->
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard-dark.js') }}"></script>
    <!-- End custom js for this page -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var table = document.getElementById('tbl');
            var rows = table.querySelectorAll('tbody tr');

            // Thêm sự kiện click cho mỗi hàng
            rows.forEach(function(row) {
                row.addEventListener('click', function(event) {
                    var targetCell = event.target.closest('td');
                    var isLastCell = targetCell && targetCell.cellIndex === targetCell.parentNode
                        .cells.length - 1;
                    var isFirstCell = targetCell && targetCell.cellIndex === 0;

                    // Kiểm tra xem sự kiện click có xuất phát từ cột cuối cùng hoặc cột gần cuối không
                    if (!isLastCell && !isFirstCell) {
                        // Reset màu cho tất cả các hàng
                        rows.forEach(function(r) {
                            r.classList.remove('table-active');
                        });

                        // Đặt màu cho hàng được click
                        row.classList.add('table-active');

                        var jobId = row.id;

                        // Chỉ hiển thị modal nếu không click vào ô cuối cùng hoặc ô đầu tiên
                        showJobModal(jobId);
                    }
                });
            });

            // Thêm sự kiện click cho toàn bộ document
            document.addEventListener('click', function(event) {
                // Kiểm tra xem sự kiện click có xuất phát từ bảng hay không
                if (!event.target.closest('#tbl')) {
                    // Reset màu cho tất cả các hàng
                    rows.forEach(function(r) {
                        r.classList.remove('table-active');
                    });
                }
            });
        });

        // Hàm hiển thị modal
        function showJobModal(jobId) {
            // Gọi Ajax để lấy thông tin chi tiết của công việc với ID jobId
            // Hiển thị thông tin trong modal
            // Mở modal
            $.ajax({
                url: '/chi-tiet/' + jobId, // Đường dẫn mới đã định nghĩa
                type: 'GET',
                success: function(data) {
                    $('#modalContent').html(data);
                    $('#myModal').modal('show');
                },
                error: function() {
                    alert('Đã xảy ra lỗi khi lấy thông tin chi tiết công việc.');
                }
            });
        }
    </script>

    <script>
        $(document).ready(async () => {
            // Thêm sự kiện click cho button
            $('.btn-add-task').on('click', function() {
                // Hiển thị modal khi button được click
                $('#addTaskModal').modal('show');
            });

            // Xử lý sự kiện submit form thêm công việc
            $('#addTaskForm').on('submit', function(e) {
                e.preventDefault();
                // Thực hiện xử lý khi submit form, ví dụ: gửi dữ liệu thông qua AJAX
                // Sau khi thêm công việc thành công, có thể đóng modal
                $('#addTaskModal').modal('hide');
            });

            // lấy danh sách các team
            var listTeam = await (await fetch(
                '{{ route('team.all') }}')).json();
            var optionTeam = `<option value="">lọc theo nhóm</option>
                <option value="0">Tất cả</option>`;
            listTeam.forEach((element) => {
                optionTeam +=
                    `<option value="${element.id}">${element.name}</option>`;
            })
            $('#teamFilter').html(optionTeam);

            // URL cần xử lý
            let urlString = window.location.href;

            // Tạo một đối tượng URL
            let url = new URL(urlString);

            // Lấy tất cả query parameters
            let queryParams = url.searchParams;

            // Hiển thị giá trị của các query parameters
            queryParams.forEach((value, key) => {
                if (key === 'status') {
                    $('#statusFilter').val(value);
                }
                if (key === 'team') {
                    $('#teamFilter').val(value);
                }
            });
            var notifications = await (await fetch("{{ route('notifications.index') }}")).json();

        });
    </script>

    {{-- CLICK VÀO NÚT SỬA --}}
    <script>
        $(document).ready(function() {
            $('.dropdown-item:contains("Sửa")').on('click', function() {
                $('input[name="staff_implement_job"]').val('');
                // Lấy giá trị data-job-id từ thẻ <a>
                var jobId = $(this).data('job-id');
                $.ajax({
                    url: '/sua/' + jobId,
                    type: 'GET',
                    success: async (data) => {
                        $('#modalContent').html(data);
                        $('#myModal').modal('show');
                        // lấy thông tin các team
                        var listTeam = await (await fetch(
                            '{{ route('team.all') }}')).json();
                        var teamImplementJob = await (await fetch(
                            `{{ route('team.implement-job') }}/${jobId}`)).json();
                        var optionTeam = '<option class="team-option"></option>';
                        listTeam.forEach((element) => {
                            if (element.id === teamImplementJob.id) {
                                optionTeam +=
                                    `<option selected class="team-option" value="${element.id}">${element.name}</option>`;
                            } else {
                                optionTeam +=
                                    `<option class="team-option" value="${element.id}">${element.name}</option>`;
                            }
                        })
                        $('.selection-team').html(optionTeam);

                        // lấy dữ liệu về nhân viên
                        var listStaff = await (await fetch(
                            '{{ route('staff.all') }}')).json();
                        // lấy mảng các nhân viên thực hiện job đó
                        var listStaffImplementJob = await (await fetch(
                            `{{ route('staff.implement-job') }}/${jobId}`)).json();
                        // lấy ra mảng id của các đối tượng
                        var listStaffIdImplementJob = listStaffImplementJob.map((element) => {
                            return element.id;
                        })
                        // thêm các option nhân viên
                        var optionStaff = '';
                        listStaff.forEach((element) => {
                            if (listStaffIdImplementJob.includes(element.id)) {
                                optionStaff +=
                                    `<option class="staff-option" disabled value="${element.id}" @click="staffSelected(${element.id},'${element.name}',event)">${element.name}</option>`;
                            } else {
                                optionStaff +=
                                    `<option class="staff-option" value="${element.id}" @click="staffSelected(${element.id},'${element.name}',event)">${element.name}</option>`;
                            }
                        })

                        $('#staff-implement-job-edit').html(optionStaff);
                        // tạo các ô hiển thị tên nhân viên đã chọn lên màn hình
                        var selectedStaff = '';
                        listStaffImplementJob.forEach((element) => {
                            // thêm giá trị cũ vào ô input
                            if(!$('input[name="staff_implement_job"]').val()){
                                $('input[name="staff_implement_job"]').val($('input[name="staff_implement_job"]').val() + element.id);
                            }else{
                                $('input[name="staff_implement_job"]').val($('input[name="staff_implement_job"]').val() + ',' + element.id);
                            }
                            
                            // tạo các ô hiển thị tên nhân viên thực hiện
                            selectedStaff += `<div class="item-selected ${element.id}">
                        <span >${element.name}</span>
                        <svg @click="removeStaffSelected(${element.id},'${element.name}')" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;cursor: pointer"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
                    </div>`;
                        });
                        $('.list-item-selected').html(selectedStaff);
                        console.log($('input[name="staff_implement_job"]').val());
                    },
                    error: function() {
                        alert('Đã xảy ra lỗi khi lấy thông tin chi tiết công việc.');
                    }
                });

            });
        });
    </script>
    <script>
        // Lấy tất cả các phần tử có class là 'report-btn'
        var reportButtons = document.querySelectorAll('.report-btn');
        // Lặp qua mỗi nút và thêm sự kiện click
        reportButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Lấy giá trị data-job-id
                var jobId = this.getAttribute('data-job-id');

                $.ajax({
                    url: '/bao-cao/' + jobId, // Đường dẫn mới đã định nghĩa
                    type: 'GET',
                    success: function(data) {
                        $('#modalContent').html(data);
                        $('#myModal').modal('show');
                    },
                    error: function() {
                        alert('Đã xảy ra lỗi khi lấy thông tin chi tiết công việc.');
                    }
                });
            });
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modalContent">
                <!-- Nội dung modal sẽ được cập nhật từ Ajax response -->
            </div>
        </div>
    </div>

    <!-- code alpinejs -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                // lưu trữ thông báo nhắc hẹn
                numberOfNotification: null,
                notifications: null,
                // biến lưu trữ danh sách các nhân viên
                listStaff: null,
                listTeam: null,
                value: null,
                async init() {
                    var jobs = await (await fetch('{{ route('job.index') }}')).json();

                    // thêm sự kiện click cho ô chọn nhân viên thực hiện
                    $('.selection-team').one('mousedown', async (event) => {
                        this.listTeam = await (await fetch('{{ route('team.all') }}'))
                            .json();
                        var optionTeam = '';
                        this.listTeam.forEach((element) => {
                            optionTeam +=
                                `<option @click="selectedTeam()" class="team-option" value="${element.id}" >${element.name}</option>`;
                        })
                        event.target.innerHTML = optionTeam;

                    })

                    // click vào ô chọn nhân viên thực hiện và lấy dữ liệu về nhân viên
                    $('.list-item-selected').one('mousedown', async (event) => {
                        this.listStaff = await (await fetch(
                            '{{ route('staff.all') }}')).json();
                        var optionStaff = '';
                        this.listStaff.forEach((element) => {
                            optionStaff +=
                                `<option class="staff-option" value="${element.id}" @click="staffSelected(${element.id},'${element.name}',event)">${element.name}</option>`;
                        })
                        $('#staff-implement-job').html(optionStaff);

                    })

                    // check các dự án đã hoàn thành
                    jobs.forEach(function(element) {
                        if (element.status === 2) {
                            $(`input[name="${element.id}"]`).attr('checked', true);
                        }
                    })

                    // lấy thông báo nhắc hẹn
                    this.notifications = await (await fetch('{{ route('notifications.index') }}'))
                        .json();
                    this.numberOfNotification = this.notifications.length;
                },
                // xác nhận khi người dùng chọn hoàn thành công việc
                checkComplete(id, event) {
                    Swal.fire({
                        title: "Bạn có muốn thực hiện thay đổi?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy bỏ"
                    }).then((result) => {
                        // Kiểm tra xem người dùng đã nhấn nút Confirm hay không
                        if (result.isConfirmed) {
                            var csrfToken = $('meta[name="csrf-token"]').attr('content');
                            $.ajax({
                                url: "{{ route('job.complete') }}",
                                method: "POST",
                                data: {
                                    jobId: id
                                },
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                success: function(data) {
                                    // Xử lý dữ liệu khi yêu cầu thành công
                                    Swal.fire({
                                        title: "Thay đổi thành công",
                                        icon: "success",
                                    }).then((result) => {
                                        location.reload();
                                    })
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    // Xử lý lỗi khi yêu cầu thất bại
                                    if (jqXHR.status === 401) {
                                        window.location =
                                            '{{ route('voyager.login') }}'
                                    } else {
                                        Swal.fire({
                                            title: "Có lỗi xảy ra vui lòng thử lại",
                                            icon: "error"
                                        })
                                        event.target.checked = false;
                                    }
                                },
                            });
                            // Thực hiện hành động sau khi người dùng nhấn Confirm
                        } else {
                            event.target.checked = false;
                            // Thực hiện hành động sau khi người dùng nhấn cancel
                        }
                    });;
                },
                // xử lý khi chọn nhân viên
                staffSelected(staffId, staffName, event) {
                    // hiển thị nhân viên vừa chọn
                    var selectedItem = `<div class="item-selected ${staffId}">
                        <span >${staffName}</span>
                        <svg @click="removeStaffSelected(${staffId},'${staffName}')" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;cursor: pointer"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
                    </div>`;
                    $('.list-item-selected').append(selectedItem);

                    // disable option đã chọn
                    event.target.disabled = true;

                    // thêm id của nhân viên đã chọn vào ô input
                    var listStaffIdSelected = $('.selection-staff').val();
                    if (!listStaffIdSelected) {
                        listStaffIdSelected = staffId;
                    } else {
                        listStaffIdSelected = listStaffIdSelected + ',' + staffId;
                    }
                    $('.selection-staff').val(listStaffIdSelected);
                },
                // nhấn nút xóa nhân viên đã chọn
                removeStaffSelected(staffId, staffName) {
                    // xóa nhân viên đã chọn
                    $(`.${staffId}`).remove();
                    // đặt lại disabled của nhân viên vừa xóa thành false
                    $(`option[value="${staffId}"]`).prop('disabled', false);
                    // xóa id của nhân viên vừa chọn khỏi ô input
                    var listStaffIdSelected = $('.selection-staff').val().split(',');
                    staffId = staffId.toString();
                    listStaffIdSelected.forEach(function(item, index) {
                        if (item === staffId) {
                            listStaffIdSelected.splice(index, 1);
                        }
                    });
                    listStaffIdSelected.join(',');
                    $('.selection-staff').val(listStaffIdSelected);
                },
                // nhấn nút thêm công việc
                showModalInsert() {
                    $('.selection-team').val(null);
                    $('.list-item-selected').empty();
                    $('.staff-option').each((index, element) => {
                        element.disabled = false;
                    });
                },
                selectedTeam() {
                    console.log($('.selection-team').val());
                },
                filterJobs() {
                    var queryString = '?';
                    if ($('#teamFilter').val() !== '') {
                        queryString = queryString + 'team=' + $('#teamFilter').val() + '&';
                    }
                    if ($('#statusFilter').val() !== '') {
                        queryString = queryString + 'status=' + $('#statusFilter').val() + '&';
                    }
                    var url = window.location.href.split('?');
                    if (url[0] === "{{ route('/') }}/") {
                        window.location.href = "{{ route('/') }}" + queryString;
                    }
                    if (url[0] === "{{ route('job-by-team') }}") {
                        window.location.href = "{{ route('job-by-team') }}" + queryString;
                    }
                },
                clearNotify(){
                    this.notifications = [];
                    this.numberOfNotification = 0;
                    $.ajax({
                        type: 'GET',
                        url: '{{route("notifications.clear")}}',
                        success: function (data) {
                            // Xử lý khi request thành công
                            console.log('Success:', data);
                        },
                        error: function (error) {
                            // Xử lý khi request gặp lỗi
                            console.log('Error:', error);
                        }
                    });
                }
            }))
        })
    </script>

    <style>
        .item-selected {
            display: inline-block;
            border-width: 1px;
            border-style: solid;
            border-radius: 0.5rem;
            background-color: rgb(229 231 235);
            border-color: rgb(3 7 18);
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            margin: 3px;
        }
    </style>
</body>

</html>
