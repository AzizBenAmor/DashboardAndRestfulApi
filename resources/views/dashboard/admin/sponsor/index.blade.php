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
@include('dashboard.admin.layout.navsponsor')
       <div class="content">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-phoenix-primary me-1 mb-1" >Ajouter</a>
        <div class="pb-5">
          <div class="row g-5">  
            @if (Session::get('success'))
            <div class="alert alert-soft-success" role="alert"> {{ Session::get('success') }}</div>
            @endif
          <div>
            <section class="ftco-section">
                <div class="container">
                 
                  <div class="row">
                    <div class="col-md-12">
                      <ul class="nav nav-links mb-0 mx-n5">          
                        <li class="nav-item">
                          <p class="nav-link  text-900 me-1" aria-current="page"  >Tous <span class="text-700 fw-semi-bold">({{ Illuminate\Support\Facades\DB::table('sponsors')->where('deleted_at',null)->count() }})</span></p>
                        </li>    </ul></div>
                      <div class="table-wrap">
                        <table class="table">
                          <thead class="thead-primary">
                            <tr>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>Sponsor</th>
                              <th>Lien</th>
                              <th>Action</th>
                              
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="alert" role="alert">
                              @foreach ($sponsors as $s)
                                
                              <td>
                               
                              </td>
                              <td>
                                 
                              
                                 
                                             
                               <img class="rounded-circle" style="width: 50px;" src="{{ asset('uploads') }}/{{ $s->image }}">
                             
                             </td>
                              <td>
                               
                                 <span>{{ $s->nom }} </span>
                                
                                
                              </td>
                              <div class="email">
                              <td>{{ $s->link }}</td></div>
                              <td class="quantity">
                                <button class="btn btn-phoenix-primary me-1 mb-1" style="width: 100px; border: 1px solid rgb(24, 23, 23); " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $s->id }}">Modifier</button>
                                <a onclick="return confirm('voulez vous vraiment supprimer ce sponsor  ')"
                                href="{{ route('admin.SponsorDelete',$s->id) }}"
                                class="btn btn-phoenix-danger me-1 mb-1" style=" border: 1px solid rgb(24, 23, 23); ">Supprimer</a>
                                
                              </td>
                          
                              <td>
                                
                              </td>
                            </tr>
                            @endforeach

                          </tbody>
                          {{ $sponsors->links() }}

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
      <h5 class="modal-title" id="exampleModalLabel">Ajouter Sponsor</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
    </div>
     
    <div class="modal-body">
  
    
    <form action="{{ route('admin.SponsorStore') }}" method="post" enctype="multipart/form-data">
      @csrf
  
      <div class="mb-3">
        <label class="form-label" for="exampleFormControlInput1">Nom </label>
        <input name="nom" class="form-control" id="exampleFormControlInput1" type="text" placeholder="Nom" >
        @error('nom')
        <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
        @enderror
      </div>
  
    <div class="mb-3">
      <label class="form-label" for="exampleFormControlInput1">Lien </label>
      <input name="link" class="form-control" id="exampleFormControlInput1" type="text" placeholder="https://www.exemple.com" >
      @error('link')
      <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
      @enderror
    </div>
      <div class="mb-3">
        <label class="form-label" for="exampleFormControlInput1">Photo</label>
        <input name="photo" class="form-control" id="exampleFormControlInput1" type="file"
            placeholder="photo">
            @error('photo')
            <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
            @enderror
    </div>
    
  
    
  
    <div class="modal-footer"><button class="btn btn-primary" type="submit">Confirmer</button>
      <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
  </form>   </div>
  </div>
  </div>
</div>
{{-- Modal modifier --}}
@foreach ($sponsors as $s)
  

<div class="modal fade" id="exampleModal{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Sponsor</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.SponsorEdit',$s->id) }}" method="POSt" enctype="multipart/form-data">
            @method('PUT')
       @csrf
       <div class="mb-3">
        <label class="form-label" for="exampleFormControlInput1">Nom </label>
        <input name="nomU" class="form-control" id="exampleFormControlInput1" type="text" placeholder="Nom" value="{{ $s->nom }}">
        @error('nomU')
        <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
        @enderror
      </div>
  
    <div class="mb-3">
      <label class="form-label" for="exampleFormControlInput1">Lien </label>
      <input name="linkU" class="form-control" id="exampleFormControlInput1" type="text" placeholder="https://www.exemple.com" value="{{ $s->link }}">
      @error('linkU')
      <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
      @enderror
    </div>
      <div class="mb-3">
        <label class="form-label" for="exampleFormControlInput1">Photo</label>
        <input name="photoU" class="form-control" id="exampleFormControlInput1" type="file"
            placeholder="photo">
            @error('photoU')
            <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
            @enderror
 
            <div class="modal-footer"><button class="btn btn-primary" type="submit">Confirmer</button>
                <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
            </form></div>
      </div>
    </div>
  </div>
</div>
@endforeach
  </html>