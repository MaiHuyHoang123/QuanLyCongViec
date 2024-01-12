@php
  use TCG\Voyager\Models\Role;
  if(Auth::guard('staff')->check())
    $role = Role::where('id',Auth::guard('staff')->user()->role_id)->first();
@endphp
<div class="main-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
  <div class="sidebar-header">
    <a href="/" class="sidebar-brand">
      Kenna<span>Tech</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Home</li>
      <li class="nav-item">
        <a href="/" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Công việc</span>
        </a>
      </li>
      @if(Auth::check() || $role->name == "manager")
      <li class="nav-item">
        <a href="/jobs/team" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Công việc theo nhóm</span>
        </a>
      </li>
      @endif
      <li class="nav-item">
        <a href="{{route('reminds.index')}}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Nhắc hẹn</span>
        </a>
      </li>
      @if(Auth::check() || $role->name == "manager")
      <li class="nav-item nav-category">Quản lý</li>
      <li class="nav-item">
        <a href="{{ route('staff') }}" class="nav-link">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Nhân viên</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('team') }}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Nhóm</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('report_job.index') }}" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Báo cáo công việc</span>
        </a>
      </li>
      @endif
    </ul>
  </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme:</h6>
            <a class="theme-item" href="demo1/dashboard.html">
                <img src="{{ asset('assets/images/screenshots/light.jpg') }}" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme:</h6>
            <a class="theme-item active" href="demo2/dashboard.html">
                <img src="{{ asset('assets/images/screenshots/dark.jpg') }}" alt="light theme">
            </a>
        </div>
    </div>
</nav>