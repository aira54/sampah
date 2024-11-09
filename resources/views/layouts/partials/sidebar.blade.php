<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
      <a href="#" class="app-brand-link">
          <span class="app-brand-logo demo">
              <!-- SVG logo -->
              <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <!-- SVG content -->
              </svg>
          </span>
          <span class="app-brand-text demo menu-text fw-bold ms-2">sneat</span>
      </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
          <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
      </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
      @if(Auth::check())
          @if(Auth::user()->hasRole('admin'))
              <!-- Admin Menu Items -->
              <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                  <a href="{{ route('admin.dashboard') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-home-smile"></i>
                      <div>Admin Dashboard</div>
                  </a>
              </li>
              <li class="menu-item {{ request()->is('waste_categories.index') ? 'active' : '' }}">
                <a href="{{ route('waste_categories.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-smile"></i>
                    <div>Kategori Sampah</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('trash_bins.index') ? 'active' : '' }}">
                <a href="{{ route('trash_bins.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-smile"></i>
                    <div>Data TPS</div>
                </a>
            </li>
              <!-- More admin menu items -->
          @elseif(Auth::user()->hasRole('user'))
              <!-- User Menu Items -->
              <li class="menu-item {{ request()->is('user/dashboard') ? 'active' : '' }}">
                  <a href="{{ route('user.dashboard') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-home-smile"></i>
                      <div>User Dashboard</div>
                  </a>
              </li>
              <!-- More user menu items -->
          @endif
      @endif
  </ul>
</aside>
