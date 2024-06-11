<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="/" class="app-brand-link">
        <span class="app-brand-logo demo">
            <img height="100px" width="220px" src="{{ asset('backend/img/logo.jpeg') }}" alt="">
        </span>
        {{-- <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-decoration: upperCase;">BPDAC</span> --}}
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-lg-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>

    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item {{ $data['active_menu'] == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>
      {{-- User panel --}}
      <li class="menu-item {{ $data['active_menu']  == 'user' || $data['active_menu']  == 'userApprove' ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">User Panel</div>
        </a>
        <ul class="menu-sub ">
          <li class="menu-item {{ $data['active_menu'] == 'user' ? 'active' : '' }}">
            <a href="{{ route('user_all') }}" class="menu-link">
              <div data-i18n="Without menu">User All</div>
            </a>
          </li>
          <li class="menu-item {{ $data['active_menu'] == 'userCreate' ? 'active' : '' }}">
            <a href="{{ route('user_create') }}" class="menu-link">
              <div data-i18n="Without menu">User Create</div>
            </a>
          </li>
          <li class="menu-item {{ $data['active_menu'] == 'userApprove' ? 'active' : '' }}">
            <a href="{{ route('user_approve') }}" class="menu-link">
              <div data-i18n="Without navbar">User Approve List</div>
            </a>
          </li>
        </ul>
      </li>

      {{-- Event panel --}}
      <li class="menu-item {{ $data['active_menu']  == 'Event'  ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Event Panel</div>
        </a>
        <ul class="menu-sub {{ $data['active_menu'] == 'Event' ? 'active' : '' }}">
            <li class="menu-item ">
              <a href="{{ route('eventCreate') }}" class="menu-link">
                <div data-i18n="Without menu">Event Create</div>
              </a>
            </li>
          </ul>
        <ul class="menu-sub {{ $data['active_menu'] == 'Event' ? 'active' : '' }}">
          <li class="menu-item ">
            <a href="{{ route('event') }}" class="menu-link">
              <div data-i18n="Without menu">All Event</div>
            </a>
          </li>
        </ul>
        <ul class="menu-sub {{ $data['active_menu'] == 'Event' ? 'active' : '' }}">
            <li class="menu-item ">
              <a href="{{ route('event_user') }}" class="menu-link">
                <div data-i18n="Without menu">Event's User</div>
              </a>
            </li>
          </ul>
          <ul class="menu-sub {{ $data['active_menu'] == 'Event' ? 'active' : '' }}">
            <li class="menu-item ">
              <a href="{{ route('user.event.list') }}" class="menu-link">
                <div data-i18n="Without menu">Users Event List</div>
              </a>
            </li>
          </ul>
      </li>
      {{-- Attendance panel --}}
      <li class="menu-item {{ $data['active_menu']  == 'attendance'  ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Attendance Panel</div>
        </a>
        <ul class="menu-sub {{ $data['active_menu'] == 'attendance' ? 'active' : '' }}">
          <li class="menu-item ">
            <a href="{{ route('attendance.form') }}" class="menu-link">
              <div data-i18n="Without menu">Attendance Form</div>
            </a>
          </li>
        </ul>
        <ul class="menu-sub {{ $data['active_menu'] == 'attendance_list' ? 'active' : '' }}">
          <li class="menu-item ">
            <a href="{{ route('attendance.list') }}" class="menu-link">
              <div data-i18n="Without menu">Attendance List</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item {{ $data['active_menu']  == 'contact'  ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Contact Panel</div>
        </a>
        <ul class="menu-sub {{ $data['active_menu'] == 'contact_list' ? 'active' : '' }}">
          <li class="menu-item ">
            <a href="{{ route('contact.list') }}" class="menu-link">
              <div data-i18n="Without menu">Contact List</div>
            </a>
          </li>
        </ul>
      </li>
      {{-- questionaries --}}
      <li class="menu-item {{ $data['active_menu']  == 'questionnaires_list'  ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Questionaries Panel</div>
        </a>
        <ul class="menu-sub {{ $data['active_menu'] == 'questionnaires_list' ? 'active' : '' }}">
          <li class="menu-item ">
            <a href="{{ route('questionnaires.list') }}" class="menu-link">
              <div data-i18n="Without menu">Questionaries List</div>
            </a>
          </li>
        </ul>
      </li>
  <!-- Our team -->
  <li class="menu-item {{ $data['active_menu']  == 'ourTeam'  ? 'active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-layout"></i>
      <div data-i18n="Layouts">Our Team</div>
    </a>

    <ul class="menu-sub {{ $data['active_menu'] == 'ourTeam' ? 'active' : '' }}">
      <li class="menu-item ">
        <a href="{{ route('ourTeam.create') }}" class="menu-link">
          <div data-i18n="Without menu">Create Our Team </div>
        </a>
      </li>
    </ul>
      <ul class="menu-sub {{ $data['active_menu'] == 'ourTeam' ? 'active' : '' }}">
      <li class="menu-item">
        <a href="{{ route('ourTeam.list') }}" class="menu-link">
          <div data-i18n="Without menu">Our Team List</div>
        </a>
      </li>
      </ul>

  </li>
    </ul>
  </aside>
  <!-- / Menu -->


