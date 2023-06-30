<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">TELKOM SEMARANG</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="index.html">St</a>
  </div>
  <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    @if(Auth::user()->role == "Admin")
    <li class="{{ $title==='Dashboard' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.index')}}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
    <li class="nav-item dropdown {{ $title==='City' || $title==='Role' || $title==='Status' || $title==='Status Tagihan' || $title==='Jenis Order' || $title==='Jenis Program' || $title==='Status Pekerjaan' || $title==='Tipe Kemitraan' ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Dropdown</span></a>
      <ul class="dropdown-menu">
        <li class="{{ $title==='City' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.city')}}"><span>Kota</span></a></li>
        <li class="{{ $title==='Role' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.role')}}"><span>Role</span></a></li>
        <li class="{{ $title==='Status'  ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.status')}}"><span>Status</span></a></li>
        <li class="{{ $title==='Status Tagihan'  ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.statustagihan')}}"><span>Status Tagihan</span></a></li>
        <li class="{{ $title==='Status Pekerjaan'  ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.status_pekerjaan')}}"><span>Status Pekerjaan</span></a></li>
        <li class="{{ $title==='Jenis Order'  ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.jenisOrder')}}"><span>Jenis Order</span></a></li>
        <li class="{{ $title==='Jenis Program'  ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.jenisprogram')}}"><span>Jenis Program</span></a></li>
        <li class="{{ $title==='Tipe Kemitraan'  ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.tipe_kemitraan')}}"><span>Tipe Kemitraan</span></a></li>
      </ul>
    </li>
    @endif
    {{-- @if(Auth::user()->can('manage-users'))
      <li class="menu-header">Users</li>
      <li class="{{ Request::route()->getName() == 'admin.users' ? ' active' : '' }}"><a class="nav-link" href=""><i class="fa fa-users"></i> <span>Users</span></a></li>
    @endif --}}
  </ul>
</aside>