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
    <li class="nav-item dropdown {{ $title==='Mitra' || $title==='City' || $title==='Role' || $title==='Status' || $title==='Status Tagihan' || $title==='Jenis Order' || $title==='Jenis Program' || $title==='Status Pekerjaan' || $title==='Tipe Kemitraan' ? 'active' : '' }}">
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
        <li class="{{ $title==='Mitra'  ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.mitra')}}"><span>Mitra</span></a></li>
        <li class="{{ $title==='Tipe Provisioning'  ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.tipe_provisioning')}}"><span>Tipe Provisioning</span></a></li>

      </ul>
    </li>
    <li class="nav-item dropdown {{ $title==='Laporan Commerce' || $title==='OGP' ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-file"></i> <span>Laporan Commerce</span></a>
      <ul class="dropdown-menu">
        <li class="{{ $title==='Laporan Commerce' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.laporan_commerce.index')}}"><i class="fa fa-envelope"></i><span>Selesai</span></a></li>
        <li class="{{ $title==='OGP' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.laporan_commerce.draft')}}"><i class="fa fa-envelope-open"></i><span>OGP</span>@if($count != 0)<span style="color:red">{{$count}}</span>@endif</a></li>
      </ul>
    </li>
    <li class="{{ $title==='Laporan Konstruksi' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.laporan_konstruksi')}}"><i class="fa fa-home"></i><span>Laporan Konstruksi</span></a></li>
    <li class="{{ $title==='Laporan Maintenance' ? ' active' : '' }}"><a class="nav-link" href="{{route('maintenance.laporan_maintenance')}}"><i class="fa fa-home"></i><span>Laporan Maintenance</span></a></li>
    @endif
    @if(Auth::user()->role == "Commerce")
    <li class="nav-item dropdown {{ $title==='Laporan Commerce' || $title==='OGP' ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-file"></i> <span>Laporan Commerce</span></a>
      <ul class="dropdown-menu">
        <li class="{{ $title==='Laporan Commerce' ? ' active' : '' }}"><a class="nav-link" href="{{route('commerce.laporan.index')}}"><i class="fa fa-envelope"></i><span>Selesai</span></a></li>
        <li class="{{ $title==='OGP' ? ' active' : '' }}"><a class="nav-link" href="{{route('commerce.laporan.draft')}}"><i class="fa fa-envelope-open"></i><span>OGP</span>@if($count != 0)<span style="color:red">{{$count}}</span>@endif</a></li>
      </ul>
    </li>
    <li class="nav-item dropdown {{ $title==='Laporan Maintenance' || $title==='Laporan Konstruksi' ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Laporan</span></a>
      <ul class="dropdown-menu">
        <li class="{{ $title==='Laporan Konstruksi' ? ' active' : '' }}"><a class="nav-link" href="{{route('commerce.konstruksi.index')}}"><i class="fa fa-home"></i><span>Konstruksi</span></a></li>
        <li class="{{ $title==='Laporan Maintenance' ? ' active' : '' }}"><a class="nav-link" href="{{route('commerce.maintenance.index')}}"><i class="fa fa-home"></i><span>Maintenance</span></a></li>
      </ul>
    </li>
    @endif
    @if(Auth::user()->role == "Konstruksi")
    <li class="{{ $title==='Laporan Konstruksi' ? ' active' : '' }}"><a class="nav-link" href="{{route('konstruksi.laporanKonstruksi.index')}}"><i class="fa fa-home"></i><span>Laporan Konstruksi</span></a></li>
    @endif
    {{-- @if(Auth::user()->can('manage-users'))
      <li class="menu-header">Users</li>
      <li class="{{ Request::route()->getName() == 'admin.users' ? ' active' : '' }}"><a class="nav-link" href=""><i class="fa fa-users"></i> <span>Users</span></a>
    </li>
    @endif --}}
  </ul>
</aside>