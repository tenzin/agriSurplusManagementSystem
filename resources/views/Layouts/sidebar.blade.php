<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
  <img src="{{asset('images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
       style="opacity: .8">
  <span class="brand-text font-weight-light">AdminLTE 3</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{asset('images/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">Alexander Pierce</a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="{{route('extensiondashboard')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Extension Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index2.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Dashboard v2</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index3.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Dashboard v3</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-header"><h5>EO || Farmer</h5></li>
      <li class="nav-item">
      <a href="{{route('extension_supply')}}" class="nav-link">
          <i class="nav-icon far fa-calendar-alt"></i>
          <p>
            Supply Information
           
          </p>
        </a>
        <ul>
          <li class="nav-item">
          <a href="{{route('view_supply_details')}}" class="nav-link">
              <p>View Supply Information </p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
      <a href="{{route('extension_demand')}}" class="nav-link">
          <i class="nav-icon far fa-image"></i>
          <p>
            Demand Information
          </p>
        </a>
        <ul>
          <li class="nav-item">
          <a href="{{route('view_demand_details')}}" class="nav-link">
              <p>View Demand Information </p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="{{route('extension_cultivation')}}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Under Cultivation
            </p>
          </a>
          <ul>
            <li class="nav-item">
            <a href="{{route('view_cultivation_details')}}" class="nav-link">
                <p>View Under Cultivation </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header"><h5>CA || NVSC</h5></li>

        <li class="nav-item">
          <a href="{{route('ca_surplus')}}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Add Surplus Information
               
              </p>
            </a>
            <ul>
              <li class="nav-item">
              <a href="{{route('view_surplus_details')}}" class="nav-link">
                  <p>View Surplus  Information </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
          <a href="{{route('ca_surplus_demand')}}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Demand Product
              </p>
            </a>
            <ul>
              <li class="nav-item">
              <a href="{{route('view_surplus_demand_details')}}" class="nav-link">
                  <p>View Demand Information </p>
                </a>
              </li>
            </ul>
              <li class="nav-item">
                <a href="{{route('ca_surplus')}}" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                      Search and Claim
                    </p>
                  </a>
                </li>
            
          </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->