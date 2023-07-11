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
@include('dashboard.admin.layout.navpublicite')
       <div class="content">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-phoenix-primary me-1 mb-1"  >Ajouter</a>
        
        
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
                     
                      <div class="table-wrap">
                        <table class="table">
                          <thead class="thead-primary">
                            <tr>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>Propriétaire</th>
                              <th>Fichier</th> 
                              <th>Date Debut</th>
                              <th>Date Fin</th>
                              <th>Action</th>
                              
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="alert" role="alert">
                              @foreach ($publicites as $p)
                              <td>
                               
                              </td>
                              <td>
                            
                                 
                                             
                              
                             </td>
                              <td>
                                <div class="email">
                               <span>{{ $p->owner }} </span>
                                
                                </div>
                              </td>
                            <td>                            
                              @if ( strpos("$p->file", "png") !== false)
                              <img  style="width: 50px;" src="{{ asset('uploads') }}/{{ $p->file }}">
                              @elseif (strpos("$p->file", "jpg") !== false)
                              <img  style="width: 50px;" src="{{ asset('uploads') }}/{{ $p->file }}">
                              @else
                                <video style="width: 150px;" src="{{ asset('uploads') }}/{{ $p->file }}" autoplay controls="false" >    </video>
                              @endif
                            </td>
                              <td>{{ $p->dateDebut }}</td>
                              <td>{{ $p->dateFin }}</td>
                             
                              <td class="quantity">
                               
                                @if ( $p->post == 0)
                                <a class="btn btn-phoenix-success me-1 mb-1" style="width: 120px; border: 1px solid rgb(24, 23, 23); " href="{{ route('admin.PublicitePost',$p->id) }}">Poster</a>
                                @else
                                <a class="btn btn-phoenix-danger me-1 mb-1" style="width: 120px; border: 1px solid rgb(24, 23, 23); " href="{{ route('admin.PubliciteUnPost',$p->id) }}">Archiver</a>
                                @endif
                                <a onclick=" return confirm('voulez vous vraiment supprimer cette Publicité') " class="btn btn-phoenix-danger me-1 mb-1" style=" border: 1px solid rgb(24, 23, 23); " href="{{ route('admin.PubliciteDelete',$p->id) }}">Supprimer</a>

                              </td>
                          
                              <td>
                                
                              </td>
                            </tr>
                            @endforeach

                          </tbody>
                          {{ $publicites->links() }}

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
      <h5 class="modal-title" id="exampleModalLabel">ajouter Publicite</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
    </div>
     
    <div class="modal-body">
  
    
    <form action="{{ route('admin.storePublicite') }}" method="post" enctype="multipart/form-data">
      @csrf
  
    
    <div class="mb-3">
      <label class="form-label" for="exampleFormControlInput1">Propriétaire </label>
      <input name="owner" class="form-control" id="exampleFormControlInput1" type="text" placeholder="publicite owner" >
      @error('owner')
      <div class="alert alert-soft-danger" role="alert">
          {{ $message }}
      </div>
  @enderror
    </div>
   
    <div class="mb-3">
      <label class="form-label" for="exampleFormControlInput1">Date Debut </label>
      <input name="dateDebut" class="form-control" id="exampleFormControlInput1" type="date">
      @error('dateDebut')
        <div class="alert alert-soft-danger" role="alert">
            {{ $message }}
        </div>
    @enderror
    </div>
    <div class="mb-3">
      <label class="form-label" for="exampleFormControlInput1">Date Fin </label>
      <input name="dateFin" class="form-control" id="exampleFormControlInput1" type="date">
      @error('dateFin')
        <div class="alert alert-soft-danger" role="alert">
            {{ $message }}
        </div>
    @enderror
    </div>
      <div class="mb-3">
        <label class="form-label" for="exampleFormControlInput1">Fichier</label>
        <input name="file" class="form-control" id="exampleFormControlInput1" type="file"
            placeholder="file">
            @error('file')
            <div class="alert alert-soft-danger" role="alert">
                {{ $message }}
            </div>
        @enderror
    </div> 
  
    <div class="modal-footer"><button class="btn btn-primary" type="submit">Okay</button>
      <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button></div>
  </form>   </div>
  </div>
  </div>
</div>
  </html>