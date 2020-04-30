<!-- Brand Logo -->
<a href="#" class="brand-link">
  <img src="{{asset('images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
       style="opacity: .8">
  <span class="brand-text font-weight-light">DoA</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i> 
            <p>National Level</p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('national')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>National Dashboard</p>
            </a>
          </li>
        <ul>
      </li>
    </ul>
  </nav>

  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!--  Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i> 
           <p> Aggregator Level</p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('aggregator')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Aggregator Dashboard</p>
            </a>
          <li class="nav-item">
            <a href="{{route('ca_surplus')}}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
                <p>Add Surplus Information</p>
            </a>

          <li class="nav-item">
              <a href="{{route('view_surplus_details')}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                  <p>View Surplus Information</p>
              </a>
           </li>
          </li>
        </li>

          <li class="nav-item">
            <a href="{{route('ca_surplus_demand')}}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
               <p>Demand Product</p>
            </a>
            
              <li class="nav-item">
                <a href="{{route('view_surplus_demand_details')}}" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                   <p>View Demand Information </p>
                </a>
              </li>
          </li>

            <li class="nav-item">
              <a href="{{route('ca_surplus')}}" class="nav-link">
                  <i class="nav-icon far fa-calendar-alt"></i>
                    <p>Search and Claim </p>
                </a>
            </li>
        <ul>
      </li>
    </ul>
  </nav>

  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!--  Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i> 
          <p>Extension Level</p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item"> 
            <a href="{{route('extension')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Extension Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('extension_supply')}}" class="nav-link">
               <i class="nav-icon far fa-calendar-alt"></i>
              <p>Supply Information</p>
            </a>
        
          <li class="nav-item">
            <a href="{{route('view_supply_details')}}" class="nav-link">
               <i class="nav-icon far fa-calendar-alt"></i>
              <p>View Supply Information </p>
            </a>
          </li>
        </li>

      <li class="nav-item">
        <a href="{{route('extension_demand')}}" class="nav-link">
          <i class="nav-icon far fa-image"></i>
          <p>Demand Information</p>
        </a>

          <li class="nav-item">
             <a href="{{route('view_demand_details')}}" class="nav-link">
               <i class="nav-icon far fa-calendar-alt"></i>
              <p>View Demand Information </p>
            </a>
          </li>
      </li>

      <li class="nav-item">
        <a href="{{route('extension_cultivation')}}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p> Area Under Cultivation</p>
        </a>
            <li class="nav-item">
              <a href="{{route('view_cultivation_details')}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>View Under Cultivation </p>
              </a>
            </li> 
        </li>
      <ul>
    </li>
  </ul>
</nav>
   
  <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
   <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon far fa-plus-square"></i>
          <p>Master Table</p>
        </a>

        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
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

      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                   <i class="nav-icon far fa-plus-square"></i>
                     <p> User Management</p>
                 </a>

        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Roles</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/examples/forgot-password.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Permissions</p>
            </a>
          <ul>
      </nav>
  
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                 <p>Contact Us</p>
              </a>
          </li>
        </ul>
      </nav>
</div>
