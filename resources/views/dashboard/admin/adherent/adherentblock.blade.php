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
            @include('dashboard.admin.layout.navadherent')
            <div class="content">



                <div class="pb-5">
                    <div class="row g-5">
                        <h1>Liste des Adherents Bloquer </h1>
                        <hr>
                        @if (Session::get('Affectation'))
                        <div class="alert alert-soft-success">
                            {{ Session::get('Affectation') }}
                        </div>
                        @endif
                        @if (Session::has('successAdherent'))
                        <div class="alert alert-soft-success" >{{ Session::get('successAdherent') }}</div>
                        @endif
                        @if (Session::has('errorAdherent'))
                        <div class="alert alert-soft-danger" >{{ Session::get('errorAdherent') }}</div>
                        @endif
                        @error('import')
              <span class='alert alert-soft-danger'>  {{ $message }}</span>
            @enderror
                        @if (session('message'))
                <div class="alert alert-danger" >{{ session('message') }}</div>
            @endif
            <form action="{{ route('admin.ImportAdhernet') }} " method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="import">
            <button class="btn btn-link text-900 me-1" value="Import File"><span class="fas fa-cloud-download-alt fs--1 me-2"></span>Import</button>
            
            </form>
                        
                        <div class="mt-3">
                        
                            <div class="table-wrap">
                                <table class="table">
                                    <thead class="thead-primary">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom </th>
                                        <th scope="col">email</th>
                                        <th scope="col">Code a Barres</th>
                                        <th scope="col">Etat</th>
                                        <th scope="col">action</th>
                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($adherents as $item => $a)
                                    @foreach ($cartes as $c)
                                    @if ($c->id === $a->carte_id )
                                    <tr>
                                            <th scope="row">{{ $item + 1 }}</th>
                                            <td>    {{ $a->nom }}</td>
                                            <td>{{ $a->email }}</td>  
                                            
                                           
                                            <td>{{ $c->codeBar }}</td>
                                                @if (!$c->is_active)
                                         
                                           <td><span class="badge bg-100 text-danger  fs--1 px-1 mb-2">bloquer</span></td>
                                           <td> 
                                            <button class="btn btn-phoenix-success me-1 mb-1" style="width: 100px; border: 1px solid rgb(24, 23, 23); " type="button" data-bs-toggle="modal" data-bs-target="#verticallyCentered{{ $a->id }}">Consulter</button>
                                                <button class="btn btn-phoenix-primary me-1 mb-1" style="width: 100px; border: 1px solid rgb(24, 23, 23); " type="button" data-bs-toggle="modal" data-bs-target="#exampleModale{{ $a->id }}">Modifier</button>
                                            <a href="{{ route('admin.CarteUnblock',$c->id) }}" class="btn btn-phoenix-success me-1 mb-1" style=" border: 1px solid rgb(24, 23, 23); " >Unblock </a>
                                            <a onclick="return confirm('voulez vous vraiment supprimer ce adherent')"
                                            href="{{ route('admin.destroyAdherent',$a->id) }}"
                                            class="btn btn-phoenix-danger me-1 mb-1" style=" border: 1px solid rgb(24, 23, 23); " >Supprimer</a></td>
                        
                                            @endif
                                               
                                            
                                            @endif
                                            @endforeach
                                           
                                        </tr>
                                    @endforeach
                                    {{ $adherents->links() }}

                                </tbody>
                            </table></div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-900"> -----------------------------------------Yooreed<span
                                class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br
                                class="d-sm-none">2023 &copy; </p>
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



  {{-- Modal Show --}}
  @foreach ($adherents as $s)

  <div class="modal fade" id="verticallyCentered{{ $s->id }}" tabindex="-1" aria-labelledby="verticallyCenteredModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="scrollingLongModalLabel2">Adherent</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
            </div>
            <div class="modal-body">
             
                      
                
                   <div class="row">
                      <div class="col-12   ">
                      <strong>    Amicale:</strong> &thinsp;@foreach ($amicale as $am)
                      @if ($s->amicale_id==$am->id)
                      {{ $am->nom }} 
                      @endif
                    
                      @endforeach
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-12   ">
                    <strong>    Adherent:</strong> &thinsp;  {{ $s->nom }} 
                    </div>
                </div>
                <div class="row">
                  <div class="col-12   ">
                  <strong>    Email:</strong> &thinsp;  {{ $s->email }} 
                </div>
                </div>
                <div class="row">
                 <div class="col-12   ">
                 <strong>    Carte:</strong>&thinsp;@foreach ($cartes as $c)
                 @if ($s->carte_id==$c->id)
                 {{ $c->codeBar }} 
                
               @if ($c->is_active==0)
               <div class="row">
                 <div class="col-12   ">
                 <strong>    Status:</strong>&thinsp;Blocked
                 </div></div>
                 <div class="row">
                   <div class="col-12   ">
                   <strong>    Cause:</strong>&thinsp;@foreach ($causes as $ca)
                   @if ($c->cause_id==$ca->id)
                   {{ $ca->description }} 
                   @endif
                 
                   @endforeach
                   </div></div>
               @endif @endif
                 @endforeach
                 </div>
             </div>
          <div class="row">
            <div class="col-12   ">
            <strong>    CIN:</strong>&thinsp;{{ $s->cin }} 
            </div>
        </div>
        <div class="row">
          <div class="col-12   ">
          <strong>    Numero:</strong>&thinsp;{{ $s->tel }} 
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
      <div class="row">
        <div class="col-12   ">
        <strong>    Adresse:</strong>&thinsp;{{ $s->adress }} 
        </div>
        </div>
  
            <div class="modal-footer"><button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
         
        </div>
      </div></div></div>
    @endforeach
 {{-- Modal modifier --}}
 @foreach ($adherents as $s)
   
 
 <div class="modal fade" id="exampleModale{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Modifier Adherent</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
       </div>
       <div class="modal-body">
         <form action="{{ route('admin.UpdateAdherent',$s->id) }}" method="post" enctype="multipart/form-data">
           @method('PUT')
           @csrf
               <div class="container">
                
      <div class="mb-3">
        <label class="form-label" for="exampleFormControlInput1">Nom </label>
        <input name="nomU" class="form-control" id="exampleFormControlInput1" type="text" placeholder=" Nom de l'adherent" value="{{$s->nom}}">
        @error('nomU')
        <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="exampleFormControlInput1">Adress </label>
        <input name="adressU" class="form-control" id="exampleFormControlInput1" type="text" placeholder="Adresse" value="{{$s->adress}}">
        @error('adressU')
        <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="exampleFormControlInput1">Numéro </label>
        <input name="telU" class="form-control" id="exampleFormControlInput1" type="text" placeholder="Numero de telephone"  value="{{$s->tel}}">
        @error('telU')
        <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label class="form-label" for="exampleFormControlInput1">Cin </label>
        <input name="cinU" class="form-control" id="exampleFormControlInput1" type="text" placeholder="carte identité nationale" value="{{$s->cin}}" >
        @error('cinU')
        <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
        @enderror
      </div>
    

 
                  
       <div class="mb-3">
         <label class="form-label" for="exampleFormControlInput1">Cartes </label><br>

       <select name="carte_idU" >
        <option value="">Carte </option>
         @foreach ($cartes as $c )
        
         @foreach ($adherents as $a)
         @if (!$a->carte_id==$c->id)
         <option value="{{ $c->id }}">{{ $c->codeBar }}</option>

         @endif
         @endforeach
        
         @endforeach
        
        </select>
        @error('carte_idU')
<div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
@enderror
      </div>  
      <div class="mb-3">
          <label class="form-label" for="exampleFormControlInput1">Amicale </label><br>

        <select name="amicale_idU" >
          <option value="">Amicale </option>

          @foreach ($amicale as $c )
         
   
          <option value="{{ $c->id }}">{{ $c->nom }}</option>
         
          @endforeach
         
        </select>
        @error('amicale_idU')
<div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
@enderror
      </div>


    
     
      
    
      
    
      <div class="modal-footer"><button class="btn btn-primary" type="submit">Confirmer</button>
        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
    </form>  </div>
       </div>
     </div>
   </div>
 </div>
 @endforeach

 
 
</html>