<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
       {{-- <img class="img-responsive" src="{{URL::asset('/images/logo.jpg')}}"style="height:40px;width:40px;"> --}}
       <h5><b>&nbsp;&nbsp;Vegetable Market Information System</b></h5>
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li>
        <a class="nav-link">

          @if(Auth()->user()->role->role == 'Gewog Extension officer' || Auth()->user()->role->role == 'Land User Certificate' || Auth()->user()->role->role == 'Farmer Group' )

          {{Auth()->user()->name.' - '.Auth()->user()->role->role.' - '.Auth()->user()->gewog->gewog}} 

          @elseif(Auth()->user()->role->role == 'Commercial Aggregator' || Auth()->user()->role->role == 'Vegetable Supply Company' || Auth()->user()->role->role == 'Agriculture Research Development Center'  )

          {{Auth()->user()->name.' - '.Auth()->user()->role->role.' - '.Auth()->user()->dzongkhag->dzongkhag}}

          @else

          {{Auth()->user()->name.' - '.Auth()->user()->role->role}}
          
          @endif

        </a> 
      </li>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell mr-2"></i>
        @if(auth()->user()->unreadNotifications->count() >= 1)
        <span class="badge badge-danger navbar-badge">{{auth()->user()->unreadnotifications->count()}}</span>
        @else
        <span class="badge badge-danger navbar-badge"></span>
        @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        @if(auth()->user()->unreadNotifications->isEmpty())
        {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> --}}
              <div class="media">
                  <div class="body">
                    <h3 class="dropdown-item-title">
                      No Notification 
                    </h3>
        
                  </div>
              </div>
        @else
       
        {{-- <a href="" class="dropdown-item"> --}}
        @foreach(Auth::User()->unreadNotifications as $notification)
        {{-- <a href="{{route('read')}}" class="dropdown-item"> --}}
        {{-- {{$notification->markAsRead()}} --}}
        <a class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    {{$notification->data['dzongkhag']}}-&nbsp;{{$notification->data['Gewog']}}
                  </h3>
                   <p class="text-sm">
                        {{$notification->data['product']}}&nbsp;
                        Qty:&nbsp;{{$notification->data['quantity']}}&nbsp;
                        @&nbsp;Nu.{{$notification->data['price']}}&nbsp;
                   </p>
                </div>
            </div>
            <!-- Message End -->
            @endforeach
        </a>
            <div class="dropdown-divider"></div>
            <a href="{{route('read')}}" class="dropdown-item dropdown-footer">Mark all To read</a>
          </div>
        @endif
         
          
      </li>
      
      <li class="nav-item dropdown">
          <a class="nav-link" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class=" fas fa-user mr-2"></i>
            <p>
              <span class="d-lg-none d-md-block">Account</span>
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{route('profile')}}">View Profile</a>
            <a class="dropdown-item" href="/logout">Logout</a>
          </div>
        </li>
    </ul>
  </nav>