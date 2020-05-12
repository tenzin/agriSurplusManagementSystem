
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
                  <a href="{{route('date')}}" class="nav-link">
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
        <li class="nav-item has-treeview  menu-open">
          <a href="#" class="nav-link">
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
              <a href="{{route('ex-date')}}" class="nav-link">
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
@can('master_data')
  <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
   <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <p>Master Table</p>
        </a>

        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('dzongkhag-list')}}" class="nav-link">
              <i class="nav-icon fas fa-fw fa-city"></i>
              <p>Dzongkhag and Thromde</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('region-list')}}" class="nav-link">
              <i class="nav-icon fas fa-fw fa-city"></i>
              <p>Region</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/product-type" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Product Type</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('product-create')}}" class="nav-link">
              <i class="nav-icon fas fa-carrot"></i>
              <p>Product Name</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/unit-create" class="nav-link">
              <i class=" nav-icon fas fa-balance-scale"></i>
              <p>Product Unit</p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="/cunit-create" class="nav-link">
              <i class="nav-icon fas fa-balance-scale"></i>
              <p>Cultivation Units</p>
            </a>
          </li> 
          <ul>
      </nav>
  @endcan
  @can('access_control_list')
  <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
                  <p> User Management</p>
              </a>

    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{route('system-user')}}" class="nav-link">
          <i class="fas fa-users nav-icon"></i>
          <p>Users</p>
        </a>
      </li>

      <li class="nav-item">
      <a href="{{route('view-role')}}" class="nav-link">
          <i class="fas fa-street-view nav-icon"></i>
          <p>Roles</p>
        </a>
      </li>
      <li class="nav-item">
      <a href="{{route('view-permission')}}" class="nav-link">
          <i class="fas fa-key nav-icon"></i>
          <p>Permissions</p>
        </a>
      <ul>
  </nav>
  @endcan

  <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
              <a href="/reports" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                 <p>Reports</p>               
              </a>
          </li>
        </ul>
      </nav>


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
