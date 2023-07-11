<nav class="navbar navbar-light navbar-vertical navbar-vibrant navbar-expand-lg">
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
      <div class="navbar-vertical-content scrollbar">
        <ul class="navbar-nav flex-column" id="navbarVerticalNav">
            <li class="nav-item"><a class="nav-link active" href="{{ route('admin.home') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="cast"></span></span><span class="nav-link-text">Dashboard</span></div>
              </a></li>
              <li class="nav-item"><a class="nav-link active" href="{{ route('admin.Amicale') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="users"></span></span><span class="nav-link-text">Amicale</span></div>
              </a></li>
              <li class="nav-item"><a class="nav-link active" href="{{ route('admin.Carte') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="credit-card"></span></span><span class="nav-link-text">Carte</span></div>
              </a></li>
              <a class="nav-link dropdown-indicator" href="#utilities" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="utilities">
                <div class="d-flex align-items-center">
                  <div class="dropdown-indicator-icon d-flex flex-center"><span class="fas fa-caret-right fs-0"></span></div><span class="nav-link-icon"><span data-feather="user"></span></span><span class="nav-link-text">Adherent</span>
                </div>
              </a>
              <ul class="nav collapse parent" id="utilities">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.AdherentActiveIndex') }}"  aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-text">Active</span></div>
                  </a></li>
                  
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.AdherentBloquerIndex') }}" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-text">Bloquer</span></div>
                      </a></li>
            
              </ul>
              <li class="nav-item"><a class="nav-link active" href="{{ route('admin.EvenementIndex') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="sun"></span></span><span class="nav-link-text">Evenement</span></div>
              </a></li>
              <li class="nav-item"><a class="nav-link active" href="{{ route('admin.PromoIndex') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="gift"></span></span><span class="nav-link-text">Promo</span></div>
              </a></li>
              <li class="nav-item"><a class="nav-link active" href="{{ route('admin.PartenaireIndex') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="users"></span></span><span class="nav-link-text">Partenaire</span></div>
              </a></li>
              <li class="nav-item"><a class="nav-link active" href="{{ route('admin.NotificationIndex') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="bell"></span></span><span class="nav-link-text">Notfication</span></div>
              </a></li>
              <li class="nav-item"><a class="nav-link active" href="{{ route('admin.GouvernoratIndex') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="map"></span></span><span class="nav-link-text">Gouvernorat</span></div>
              </a></li>
              <li class="nav-item"><a class="nav-link active" href="{{ route('admin.indexPublicite') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="dollar-sign"></span></span><span class="nav-link-text">Publicite</span></div>
              </a></li>
              <a class="nav-link dropdown-indicator" href="#utilitiess" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="utilities">
                <div class="d-flex align-items-center">
                  <div class="dropdown-indicator-icon d-flex flex-center"><span class="fas fa-caret-right fs-0"></span></div><span class="nav-link-icon"><span data-feather="smile"></span></span><span class="nav-link-text">Offers({{ Illuminate\Support\Facades\DB::table('offers')->where('stat',0)->count() }})   </span>
                </div>
              </a>
              <ul class="nav collapse parent" id="utilitiess">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.PendingOffer') }}"  aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-text">En Attend</span></div>
                  </a></li>
                  
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.AcceptedOffer') }}" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-text">Accepter</span></div>
                      </a></li>
            
                      <li class="nav-item"><a class="nav-link" href="{{ route('admin.RefusedOffer') }}" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-text">Refuser</span></div>
                      </a></li>
                      <li class="nav-item"><a class="nav-link" href="{{ route('admin.YooreedOffer') }}" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-text">Yooreed</span></div>
                      </a></li>
              </ul>
              <li class="nav-item"><a class="nav-link active" href="{{ route('admin.SecteurIndex') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="briefcase"></span></span><span class="nav-link-text">Secteur</span></div>
              </a></li>
              <li class="nav-item"><a class="nav-link active" href="{{ route('admin.sponsorIndex') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="dollar-sign"></span></span><span class="nav-link-text">Sponsor</span></div>
              </a></li>
              <li class="nav-item"><a class="nav-link active" href="{{ route('admin.serviceIndex') }}">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="tool"></span></span><span class="nav-link-text">Service</span></div>
              </a></li>
        </ul>
  </nav>