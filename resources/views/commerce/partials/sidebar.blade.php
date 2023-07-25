<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">TELKOM SEMARANG</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="index.html">St</a>
  </div>
  <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    @if(Auth::user()->role == "Commerce")
    <li class="nav-item dropdown {{ $title==='Laporan Commerce' || $title==='Draft' ? 'active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-file"></i> <span>Laporan Commerce</span></a>
      <ul class="dropdown-menu">
        <li class="{{ $title==='Laporan Commerce' ? ' active' : '' }}"><a class="nav-link" href="{{route('commerce.laporan.index')}}"><i class="fa fa-envelope"></i><span>Selesai</span></a></li>
        <li class="{{ $title==='Draft' ? ' active' : '' }}"><a class="nav-link" href="{{route('commerce.laporan.draft')}}"><i class="fa fa-envelope-open"></i><span>Draft</span></a></li>
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
    {{-- @if(Auth::user()->can('manage-users'))
      <li class="menu-header">Users</li>
      <li class="{{ Request::route()->getName() == 'admin.users' ? ' active' : '' }}"><a class="nav-link" href=""><i class="fa fa-users"></i> <span>Users</span></a>
    </li>
    @endif --}}
  </ul>
</aside>