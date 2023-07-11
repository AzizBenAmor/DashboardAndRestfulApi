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
@include('dashboard.admin.layout.navgouvernorat')
       <div class="content">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-phoenix-primary me-1 mb-1">Ajouter</a>
        
        
        <div class="pb-5">
          <div class="row g-5">
            @if (Session::get('success'))
            <div class="alert alert-soft-success">
                {{ Session::get('success') }}
            </div>@endif
            @if (Session::get('error'))
            <div class="alert alert-soft-danger">
                {{ Session::get('error') }}
            </div>@endif
          <div>
            <section class="ftco-section">
                <div class="container">
                 
                  <div class="row">
                    <div class="col-md-12">
                     
                      <div class="table-wrap">
                        <table class="table">
                          <thead class="thead-primary">
                            <tr>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>Gouvernorat</th>
                         
                              <th>Action</th>
                              
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="alert" role="alert">
                              @foreach ($gov as $g)
                                
                              <td>
                               
                              </td>
                              <td>
                                
                             </td>
                              <td>
                                <div class="email">
                                 <a style="color: rgb(0, 0, 0)" href="{{ route('admin.VilleIndex',$g->id) }}" ><span>{{ $g->nom }} </span></a>
                                
                                </div>
                              </td>
                            
                            
                              <td class="quantity">
                                <button class="btn btn-phoenix-success me-1 mb-1" style="width: 100px; border: 1px solid rgb(24, 23, 23); " type="button" data-bs-toggle="modal" data-bs-target="#verticallyCentered{{ $g->id }}">Consulter</button>
                                <button class="btn btn-phoenix-primary me-1 mb-1" style="width: 90px; border: 1px solid rgb(24, 23, 23); " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $g->id }}">Modifier</button>
                                <a onclick="return confirm('voulez vous vraiment supprimer cete gouvernorat ')"
                                href="{{ route('admin.GouvernoratDelete',$g->id) }}"
                                class="btn btn-phoenix-danger me-1 mb-1" style=" border: 1px solid rgb(24, 23, 23); ">Supprimer</a>
                              </td>
                          
                              <td>
                                
                              </td>
                            </tr>
                            @endforeach

                          </tbody>
                          {{ $gov->links() }}

                        </table>

                     
                      </div>
                    </div>
                  </div>
                </div>
              </section>
  


          </div>
          </div></div></div>
          <footer class="footer">
            <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-900"> -----------------------------------------Yooreed<span class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br class="d-sm-none">2023 &copy; </p>
              </div>
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">v1.0</p>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </main>
    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
   
  </body>

<!-- model Ajout -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Ajouter Gouvernorat</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
    </div>
     
    <div class="modal-body">
  
    
    <form action="{{ route('admin.GouvernoratStore') }}" method="post" enctype="multipart/form-data">
      @csrf
        
    <div class="mb-3">
      <label class="form-label" for="exampleFormControlInput1">Nom </label>
      <input name="nom" class="form-control" id="exampleFormControlInput1" type="text" placeholder=" Nom De Gouvernorat " >
      @error('nom')
      <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
      @enderror
    </div>
  
    <div class="modal-footer"><button class="btn btn-primary" type="submit">Confirmer</button>
      <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
  </form>   </div>
  </div>
  </div>
</div>
{{-- Modal show --}}
@foreach ($gov as $s)

<div class="modal fade" id="verticallyCentered{{ $s->id }}" tabindex="-1" aria-labelledby="verticallyCenteredModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="scrollingLongModalLabel2">Gouvernorat</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
          </div>
          <div class="modal-body">
            <div class="row">
               
                <div class="col-3">
                 <strong> Gouvernorat:  </strong>
                 <div class="row">
                    <div class="col-3   ">
                    <strong> Ville:</strong>
                    </div>
                </div>
                </div>
                <div class="col-9">
                  {{ $s->nom }}
                  <div class="row">
                   @foreach ($villes as $p)
                   @if ($s->id==$p->gov_id)
                   {{ $p->nom }}<br>  
                   @endif
                   
                   @endforeach
                    
                    
                </div>
                </div>
              </div>
            </div>
          
                
          
          <div class="modal-footer"><button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
        </div>
      </div>
    </div>
  @endforeach
  {{-- Modal modifier --}}
@foreach ($gov as $s)
  

<div class="modal fade" id="exampleModal{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Gouvernorat</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.UpdateGouvernorat',$s->id) }}" method="POSt" enctype="multipart/form-data">
            @method('PUT')
       @csrf
       <div class="mb-3">
        <label class="form-label" for="exampleFormControlInput1">Gouvernorat </label>
        <input name="nomU" class="form-control" id="exampleFormControlInput1" type="text" placeholder="Nom de gouvernorat" required value="{{ $s->nom }}">
        @error('nomU')
        <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
        @enderror
      </div>
            <div class="modal-footer"><button class="btn btn-primary" type="submit">Confirmer</button>
                <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
            </form>
      </div>
    </div>
  </div>
</div>
@endforeach
  </html>