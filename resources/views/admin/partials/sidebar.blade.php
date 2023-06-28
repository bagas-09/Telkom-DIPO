<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">TELKOM SEMARANG</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="index.html">St</a>
  </div>
  <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="{{ Request::route()->getName() == 'admin.dashboard.index' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.index')}}"><i class="fa fa-columns"></i> <span>Dashboard</span></a></li>
      <li class="{{ Request::route()->getName() == 'admin.dashboard.city' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.city')}}"><i class="fa fa-columns"></i> <span>Kota</span></a></li>
      <li class="{{ Request::route()->getName() == 'admin.dashboard.role' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.role')}}"><i class="fa fa-columns"></i> <span>Role</span></a></li>
      <li class="{{ Request::route()->getName() == 'admin.dashboard.status' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.status')}}"><i class="fa fa-columns"></i> <span>Status</span></a></li>
      <li class="{{ Request::route()->getName() == 'admin.dashboard.statustagihan' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.statustagihan')}}"><i class="fa fa-columns"></i> <span>Status Tagihan</span></a></li>
      <li class="{{ Request::route()->getName() == 'admin.dashboard.jenisOrder' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.jenisOrder')}}"><i class="fa fa-columns"></i> <span>Jenis Order</span></a></li>
      <li class="{{ Request::route()->getName() == 'admin.dashboard.jenisprogram' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.jenisprogram')}}"><i class="fa fa-columns"></i> <span>Jenis Program</span></a></li>
      {{-- @if(Auth::user()->can('manage-users'))
      <li class="menu-header">Users</li>
      <li class="{{ Request::route()->getName() == 'admin.users' ? ' active' : '' }}"><a class="nav-link" href=""><i class="fa fa-users"></i> <span>Users</span></a></li>
      @endif --}}
    </ul>
</aside>
