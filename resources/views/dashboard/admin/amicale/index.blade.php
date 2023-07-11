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
@include('dashboard.admin.layout.navamicale')
       <div class="content">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-phoenix-primary me-1 mb-1" >Ajouter </a>
        
        
        <div class="pb-5">
          <div class="row g-5">
            @if (session('success'))
            <span class='alert alert-soft-success'>{{ session('success') }}</span>
        @endif
          <div>
            <section class="ftco-section">
                <div class="container">
                 
                  <div class="row">
                    <div class="col-md-12">
                      <ul class="nav nav-links mb-0 mx-n5">          
                        <li class="nav-item">
                          <p class="nav-link  text-900 me-1" aria-current="page"  >Tout <span class="text-700 fw-semi-bold">({{ Illuminate\Support\Facades\DB::table('amicales')->where('deleted_at',null)->count() }})</span></p>
                        </li>    </ul></div>
                      <div class="table-wrap">
                        <table class="table">
                          <thead class="thead-primary">
                            <tr>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>Amicale</th>
                              <th>Email</th>
                              <th>action</th>
                              
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="alert" role="alert">
                              @foreach ($amicales as $a)
                                
                              <td>
                               
                              </td>
                              <td>
                               <img class="rounded-circle" style="width: 50px;" src="{{ asset('uploads') }}/{{ $a->image }}">
                             
                             </td>
                              <td>
                                <div class="email">
                                 <a style="color: rgb(0, 0, 0)" href="{{ route('admin.AdherentIndex',$a->id) }}" ><span>{{ $a->nom }} </span></a>
                                
                                </div>
                              </td>
                            
                              <td>{{ $a->email }}</td>
                              <td class="quantity">
                                <button class="btn btn-phoenix-success me-1 mb-1" style="width: 100px; border: 1px solid rgb(24, 23, 23); " type="button" data-bs-toggle="modal" data-bs-target="#verticallyCentered{{ $a->id }}">Consulter</button>
                                <button class="btn btn-phoenix-primary me-1 mb-1" style="width: 100px; border: 1px solid rgb(24, 23, 23); " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $a->id }}">Modifier</button>
                                <a onclick="return confirm('voulez vous vraiment supprimer cette amicale qui contient {{ Illuminate\Support\Facades\DB::table('adherents')->where('amicale_id',$a->id)->count() }} adherents')"
                                href="{{ route('admin.AmicaleDestroy',$a->id) }}"
                                class="btn btn-phoenix-danger me-1 mb-1" style=" border: 1px solid rgb(24, 23, 23); ">Supprimer</a>
                              </td>
                          
                              <td>
                                
                              </td>
                            </tr>
                            @endforeach

                          </tbody>
                          {{ $amicales->links() }}
                        </table>

                       
                      </div>
                    </div>
                  </div></section>
                </div>
       
  


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
        
      
    </main>
    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
      <!-- Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
      $(document).ready(function () {
          $('#gov-dd').on('change', function () {
              var idGov = this.value;
              $("#ville-dd").html('');
              $.ajax({
                  url: "{{url('api/fetch-villes')}}",
                  type: "POST",
                  data: {
                      gov_id: idGov,
                      _token: '{{csrf_token()}}'
                  },
                  dataType: 'json',
                  success: function (result) {
                      $('#ville-dd').html('<option value="">Select ville</option>');
                      $.each(result.villes, function (key, value) {
                          $("#ville-dd").append('<option value="' + value
                              .id + '">' + value.nom + '</option>');
                      });
                  }
              });
          });   
      });
  </script>
  </body>

<!-- model Ajout -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">ajouter amicale</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
    </div>
     
    <div class="modal-body">
  
    
    <form action="{{ route('admin.amicalestore') }}" method="post" enctype="multipart/form-data">
      @csrf
  
     
  

        <div class="container">
               
                    
                 <div class="form-group mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Gouvernorat </label>

                            <select  name="gov_id" id="gov-dd" class="form-control">
                                <option value="">Gouvernorat</option>
                                @foreach ($gouvernorats as $data)
                                <option value="{{$data->id}}">
                                    {{$data->nom}}
                                </option>
                                @endforeach
                            </select>
                            @error('gov_id')
                            <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
                            @enderror
                  
                        <div class="form-group mb-3">
                          <label class="form-label" for="exampleFormControlInput1">Ville </label>

                            <select id="ville-dd" name="ville_id"  class="form-control">
                            </select>
                            @error('ville_id')
                            <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div> </div>
        
      
    
        
       
     
    <div class="mb-3">
      <label class="form-label" for="exampleFormControlInput1">Nom </label>
      <input name="nom" class="form-control" id="exampleFormControlInput1" type="text" placeholder="Nom de l'amicale" required>
      @error('nom')
      <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label class="form-label" for="exampleFormControlInput1">Nom Responsable </label>
      <input name="nom_responsable" class="form-control" id="exampleFormControlInput1" type="text" placeholder="Nom Responsable" >
      @error('nom_responsable')
      <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label class="form-label" for="exampleFormControlInput1">Email </label>
      <input name="email" class="form-control" id="exampleFormControlInput1" type="text" placeholder="exemple@gmail.com" >
      @error('email')
      <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label class="form-label" for="exampleFormControlInput1">Numéro </label>
      <input name="numero" class="form-control" id="exampleFormControlInput1" type="text" placeholder="Numero de telephone  " >
      @error('numero')
      <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label class="form-label" for="exampleFormControlInput1">Cin </label>
      <input name="cin" class="form-control" id="exampleFormControlInput1" type="text" placeholder="carte identité nationale" >
      @error('cin')
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
      <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div></div>
  </form> </div>  </div> </div>
  </div>
  

{{-- Modal Show --}}
@foreach ($amicales as $s)

<div class="modal fade" id="verticallyCentered{{ $s->id }}" tabindex="-1" aria-labelledby="verticallyCenteredModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="scrollingLongModalLabel2">Amicale</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
          </div>
          <div class="modal-body">
            <div class="d-flex justify-content-center mb-4">
              <div class="p-2"><img class="rounded-none" style="width: 150px;" src="{{ asset('uploads') }}/{{ $s->image }}"></div>
            </div>
                    
              
                 <div class="row">
                    <div class="col-12   ">
                    <strong>    Amicale:</strong> &thinsp;{{ $s->nom }} 
                    </div>
                </div>
                <div class="row">
                  <div class="col-12   ">
                  <strong>    Nom Responsable:</strong> &thinsp;  {{ $s->nom_responsable }} 
                  </div>
              </div>
              <div class="row">
                <div class="col-12   ">
                <strong>    Email:</strong> &thinsp;  {{ $s->email }} 
              </div>
              </div>
        <div class="row">
          <div class="col-12   ">
          <strong>    CIN:</strong>&thinsp;{{ $s->cin }} 
          </div>
      </div>
      <div class="row">
        <div class="col-12   ">
        <strong>    Numero:</strong>&thinsp;{{ $s->numero }} 
        </div>
    </div>
    <div class="row">
      <div class="col-12   ">
      <strong>    Gouvernorat:</strong>&thinsp;@foreach ($gouvernorats as $g)
          @if ($g->id==$s->gov_id)
              {{ $g->nom }}
          @endif
      @endforeach
      </div>
  </div>
  <div class="row">
    <div class="col-12   ">
    <strong>    Ville:</strong>&thinsp;@foreach ($villes as $v)
    @if ($v->id==$s->ville_id)
        {{ $v->nom }}
    @endif
@endforeach
    </div></div>
  

          <div class="modal-footer"><button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button></div>
       
      </div>
    </div></div></div>
  @endforeach
{{-- Modal modifier --}}
@foreach ($amicales as $s)
  

<div class="modal fade" id="exampleModal{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Amicale</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.UpdateAmicale',$s->id) }}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf

      
              <div class="container">

          <div class="mb-3">
            <label class="form-label" for="exampleFormControlInput1">Nom </label>
            <input name="nomU" class="form-control" id="exampleFormControlInput1" type="text" placeholder="amicale Name" value="{{$s->nom}}">
            @error('nomU')
            <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="exampleFormControlInput1">Nom Responsable </label>
            <input name="nom_responsableU" class="form-control" id="exampleFormControlInput1" type="text" placeholder="Nom Responsable" value="{{$s->nom_responsable}}" >
            @error('nom_responsableU')
            <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="exampleFormControlInput1">Numéro </label>
            <input name="numeroU" class="form-control" id="exampleFormControlInput1" type="text" placeholder="20555555" value="{{$s->numero}}">
            @error('numeroU')
            <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="exampleFormControlInput1">Cin </label>
            <input name="cinU" class="form-control" id="exampleFormControlInput1" type="text" placeholder="01555555" value="{{$s->cin}}">
            @error('cinU')
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
          </div>
          
        
          
        
          <div class="modal-footer"><button class="btn btn-primary" type="submit">Confirmer</button>
            <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div></div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
  </html>