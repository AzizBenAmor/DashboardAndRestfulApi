<nav class="navbar navbar-light navbar-top navbar-expand">
    <div class="navbar-logo"><button class="btn navbar-toggler navbar-toggler-humburger-icon" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button> <a class="navbar-brand me-1 me-sm-3" href="index.html">
        <div class="d-flex align-items-center">
          <div class="d-flex align-items-center"><img src="{{ asset('dashassets/img/yooreed.png') }}" alt="phoenix" width="32">
            <p class="logo-text ms-2 d-none d-sm-block">YOOREED</p>
          </div>
        </div>
      </a></div>
    <div class="collapse navbar-collapse">
      {{-- sreach bar --}}
      <div class="search-box d-none d-lg-block" style="width:25rem;">
        <form action="{{ route('admin.SearchSecteur') }}" method="POST" class="position-relative" data-bs-toggle="search" data-bs-display="static">
          @csrf
          <input name="secteur" class="form-control form-control-sm search-input search min-h-auto" type="search" placeholder="Recherche..." aria-label="Search">
           <span class="fas fa-search search-box-icon"></span></form>
      </div>
      <ul class="navbar-nav navbar-nav-icons ms-auto flex-row">
        
         
        <li class="nav-item dropdown"><a class="nav-link lh-1 px-0 ms-5" id="navbarDropdownUser" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="avatar avatar-l"><img class="rounded-circle" src="{{ asset('dashassets/img/admin.jpg') }}" alt=""></div>
          </a>
          <div class="dropdown-menu dropdown-menu-end py-0 dropdown-profile shadow border border-300" aria-labelledby="navbarDropdownUser">
            <div class="card bg-white position-relative border-0">
              <div class="card-body p-0 overflow-auto scrollbar" style="height: 12rem;">
                <div class="text-center pt-4 pb-3">
                  <div class="avatar avatar-xl"><img class="rounded-circle" src="{{ asset('dashassets/img/admin.jpg') }}" alt=""></div>
                 admin
                </div> 
                
                <ul class="nav d-flex flex-column mb-2 pb-1">
                  {{-- <li class="nav-item"><a class="nav-link px-3" href="{{ route('profile.edit') }}"><span class="me-2 text-900" data-feather="user"></span>Profile</a></li> --}}
                  <li class="nav-item"><a class="nav-link px-3" href="{{ route('admin.home') }}"><span class="me-2 text-900" data-feather="pie-chart"></span>Dashboard</a></li> 
                  <li class="nav-item"><a class="nav-link px-3" href="{{ route('admin.changePassword') }}"><span class="me-2 text-900" data-feather="settings"></span>Change Password</a></li>
                  <li class="nav-item"> <a class="nav-link px-3" href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="me-2 text-900" data-feather="pie-chart"></span>Logout</a></li>
                  <form action="{{ route('admin.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
                </ul>
              </div>
              <div class="card-footer p-0 border-top">
               
                <hr>
                <div class="px-3">
            
                   </div>
                <div>
            
         
          
        </li>
      </ul>
    </div>
  </nav>