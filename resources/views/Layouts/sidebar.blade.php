
<!-- Brand Logo -->
<a href="#" class="brand-link">
  <img src="{{asset('images/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
       style="opacity: .8">
  <span class="brand-text font-weight-light">DoA</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar Menu -->

@can('view_national_dashboard')
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="fas fa-bars"></i> 
          <ion-icon name="stats-chart-outline"></ion-icon>
            <p>National Level</p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('national')}}" class="nav-link">
            <i class="far fa-chart-bar"></i> 
              <p>National Dashboard</p>
            </a>
          </li>
        <ul>
      </li>
    </ul>
  </nav>
@endcan

@can('aggregator_level')
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!--  Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="fas fa-bars"></i> 
           <p> Aggregator Level</p>
        </a>
        <ul class="nav nav-treeview">

              @can('view_aggregator_dashboard')
                    <li class="nav-item">
                      <a href="{{route('aggregator')}}" class="nav-link">
                      <i class="far fa-chart-bar"></i> 
                        <p>Aggregator Dashboard</p>
                      </a>
                    </li>
                @endcan

                @can('aggregator_add_surplus')
                <li class="nav-item">
                  <a href="{{route('ca_surplus')}}" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                      <p>Add Surplus Information</p>
                  </a>
                @endcan

                @can('aggregator_view_surplus')
                <li class="nav-item">
                    <a href="{{route('view_surplus_details')}}" class="nav-link">
                      <i class="nav-icon far fa-calendar-alt"></i>
                        <p>View Surplus Information</p>
                    </a>
                </li>
              </li>
              @endcan

            @can('aggregator_demand_surplus')
          <li class="nav-item">
            <a href="{{route('ca_surplus_demand')}}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
               <p>Demand Product</p>
            </a>
            @endcan

            @can('aggregator_view_demand_surplus')
              <li class="nav-item">
                <a href="{{route('view_surplus_demand_details')}}" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                   <p>View Demand Information </p>
                </a>
              </li>
          </li>
          @endcan

          @can('aggregator_search_surplus')
          <li class="nav-item">
            <a href="{{route('scopefilter')}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Search and Claim
                </p>
              </a>
            </li>
          @endcan

          @can('aggregator_view_search_surplus')
            <li class="nav-item">
              <a href="{{route('view_claim')}}" class="nav-link">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    View Claim
                  </p>
                </a>
              </li>
              @endcan
        <ul>
      </li>
    </ul>
  </nav>
@endcan

@can('extension_level')
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!--  Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-bars"></i> 
            <p>Extension Level</p>
          </a>
          <ul class="nav nav-treeview">

            @can('view_extension_dashboard')
              <li class="nav-item"> 
                <a href="{{route('extension')}}" class="nav-link">
                <i class="far fa-chart-bar"></i> 
                  <p>Extension Dashboard</p>
                </a>
              </li>
            @endcan

            @can('extension_add_surplus')
            <li class="nav-item">
              <a href="{{route('extension_supply')}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>Supply Information</p>
              </a>
            @endcan

            @can('view_extension_surplus')
              <li class="nav-item">
                <a href="{{route('view_supply_details')}}" class="nav-link">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>View Supply Information </p>
                </a>
              </li>
            </li>
          @endcan

        @can('extension_add_under_cultivation') 
            <li class="nav-item">
              <a href="{{route('extension_cultivation')}}" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p> Area Under Cultivation</p>
              </a>
          @endcan

          @can('extension_view_under_cultivation')
          <li class="nav-item">
            <a href="{{route('view_cultivation_details')}}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>View Under Cultivation </p>
            </a>
          </li>
          @endcan 
          </li>
        <ul>
      </li>
    </ul>
  </nav>
@endcan

  <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
   <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="fab fa-elementor"></i>
          <p>Master Table</p>
        </a>

        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-list"></i>
              <p>Dzongkhag and Thromde</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Geog</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Product Type</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Product Name</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Units</p>
            </a>
          </li> 
          <ul>
      </nav>
      @can('access_control_list')
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link">
                   <i class="nav-icon far fa-plus-square"></i>
                     <p> User Management</p>
                 </a>

        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('system-user')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Users</p>
            </a>
            <ul>
              <li><a href="{{route('system-user')}}" class="nav-link">
                <p>Add New User</p>
              </a>
              </li>
              <li><a href="{{route('indexUser')}}" class="nav-link">
                <p>User List</p>
              </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
          <a href="{{route('indexRole')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Roles</p>
            </a>
          </li>
          <li class="nav-item">
          <a href="{{route('indexPermission')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Permissions</p>
            </a>
          <ul>
      </nav>
  @endcan
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
              <a href="{{route('contact-us')}}" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                 <p>Contact Us</p>
              </a>
          </li>
        </ul>
      </nav>
</div>
