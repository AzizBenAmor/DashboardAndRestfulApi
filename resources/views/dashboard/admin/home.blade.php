<!doctype html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>YOOREED</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashassets/img/favicons/favicon16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashassets/img/yoo.ico') }}">
    <meta name="msapplication-TileImage" content="{{ asset('dashassets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('dashassets/css/phoenix.min.css') }}" rel="stylesheet" id="style-default">
    
    <style>
        body {
            opacity: 0;
        }
    </style>
</head>
  <body>
    <main class="main" id="top">
      <div class="container-fluid px-0">
        @include('dashboard.admin.layout.sidebar')
@include('dashboard.admin.layout.nav')
       <div class="content">
        <div class="pb-5">
          <div class="row g-5">
          
            @if (Session::has('success'))
            <div class="alert alert-soft-danger" >{{ Session::get('success') }}</div>
            @endif
            <div class="row">

              <div class="col-4">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Partenaire</h5>
                        <span class="h2 font-weight-bold mb-0">{{$pa}}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <img src="{{ asset('assets/handshake.jpg') }}" alt="handshake" width="32">
                        </div>
                      </div>
                    </div>
              
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Amicale</h5>
                        <span class="h2 font-weight-bold mb-0">{{$am}}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                          <img src="{{ asset('assets/amicale.png') }}" alt="amicale" width="32">
                        </div>
                      </div>
                    </div>
                 
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Adherent</h5>
                        <span class="h2 font-weight-bold mb-0">{{$ad}}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <img src="{{ asset('assets/adherent.png') }}" alt="adherent" width="32">
                        </div>
                      </div>
                    </div>
                
                  </div>
                </div>
              </div>
             
              <div style="margin-top: 1cm">
                <div>
                <div class="row">
                  <div class="col-xl-6">
                      <div class="card mb-4">
                          <div class="card-header">
                              <i class="fas fa-chart-bar me-1"></i>
                              Bar Chart de Transaction
                          </div>
                          <div class="card-body"><canvas id="myChart"></canvas></div>
                      </div>
                  </div>
              </div>
</div>
              </div>

        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      
      const ctx = document.getElementById('myChart');
    
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: JSON.parse('{!! json_encode($months) !!}'),
          datasets: [{
            label: '# Transactions',
            data:JSON.parse('{!! json_encode($monthCount) !!}'),
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script> <script>
      
      const ctx = document.getElementById('myChart2');
    
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: JSON.parse('{!! json_encode($months) !!}'),
          datasets: [{
            label: '# Transactions',
            data:JSON.parse('{!! json_encode($monthCount) !!}'),
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>

  </body>

</html>  