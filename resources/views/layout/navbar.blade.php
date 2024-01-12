<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-text">
                    <i data-feather="search"></i>
                </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Tìm kiếm...">
            </div>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-vn mt-1" title="us"></i> <span
                        class="ms-1 me-1 d-none d-md-inline-block">Tiếng Việt</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                    <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-vn"
                        title="us" id="us"></i> <span class="ms-1"> Tiếng Việt </span></a>
                    <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-us"
                            title="us" id="us"></i> <span class="ms-1"> English </span></a>
                    <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-fr"
                            title="fr" id="fr"></i> <span class="ms-1"> French </span></a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    <div class="indicator">
                        <div class="circle"></div>
                    </div>
                </a>
                <div class="dropdown-menu p-0 scroll-notify" aria-labelledby="notificationDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p class="me-2">
                            <span x-text="numberOfNotification"></span> New Notifications
                        </p>
                        <a @click='clearNotify()' class="text-muted">Clear all</a>
                    </div>
                    <div class="p-1">
                        <template x-for="(notification,index) in notifications">
                            <a href="{{route('reminds.index')}}" class="dropdown-item d-flex align-items-center py-2">
                                <div class="d-flex justify-content-center align-items-center me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(100, 80, 197);transform: ;msFilter:;"><path d="m5.705 3.71-1.41-1.42C1 5.563 1 7.935 1 11h1l1-.063C3 8.009 3 6.396 5.705 3.71zm13.999-1.42-1.408 1.42C21 6.396 21 8.009 21 11l2-.063c0-3.002 0-5.374-3.296-8.647zM12 22a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22zm7-7.414V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.184 4.073 5 6.783 5 10v4.586l-1.707 1.707A.996.996 0 0 0 3 17v1a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-1a.996.996 0 0 0-.293-.707L19 14.586z"></path></svg>
                                </div>
                                <div class="flex-grow-1 me-2">
                                    <h5 class="text-indigo-600">Thông báo</h5>
                                    <p x-text="notification.name" class="line-clamp-3"></p>
                                    <p class="tx-12 text-muted" x-text="notification.date_notify"></p>
                                </div>
                            </a>
                        </template>
                        
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{-- <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30"
                        alt="profile"> --}}
                    <i class="me-2 icon-md" data-feather="user"></i>

                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        {{-- <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80"
                                alt="">
                        </div> --}}
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">Hoàng Dương</p>
                            <p class="tx-12 text-muted">kennatech@gmail.com</p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="pages/general/profile.html" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="user"></i>
                                <span>Thông tin</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a href="{{route('logout')}}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

