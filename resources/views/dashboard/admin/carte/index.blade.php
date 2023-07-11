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
        <link href="{{ asset('assets/style.css') }}" rel="stylesheet" id="style-default">
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
            @include('dashboard.admin.layout.navcarte')
            <div class="content">
                @if (Session::get('errorAffectation'))
          <div class="alert alert-soft-danger">
              {{ Session::get('errorAffectation') }}
          </div>@endif
          
                @if (Session::get('Affectation'))
          <div class="alert alert-soft-success">
              {{ Session::get('Affectation') }}
          </div>
          @endif
                @if (session('message'))
                <div class="alert alert-danger" >{{ session('message') }}</div>
            @endif
            <div class="row align-items-center justify-content-between g-3 mb-4">
              <div class="col-auto">
                <form action="{{ route('admin.importCarte') }} " method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="file" name="import">
                  <button class="btn btn-link text-900 me-1" value="Import File"><span class="fas fa-cloud-download-alt fs--1 me-2"></span>Import</button>
                  
                  @if (Session::has('import_errors'))
                  @foreach (Session::get('import_errors') as $failure)
                  <div class="alert alert-soft-danger" >{{ $failure->errors()[0] }} at line number{{ $failure->row() }}</div>
                  @endforeach @endif
                  @error('import')
                  <span class='alert alert-soft-danger'>  {{ $message }}</span>
                @enderror
                  </form>
              </div>
              <div class="col-auto">
                <div class="d-flex align-items-center">
                  <div class="row">
                    <div class="col-3">
                  <a data-bs-toggle="modal" data-bs-target="#exampleModaladd" class="btn btn-phoenix-primary me-1 mb-1" type="button">Ajouter</a> 
                    </div></div>
                    <div class="row">
                    <div class="col-4">
                  <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-phoenix-primary me-1 mb-1">Affecter </a>
                </div></div></div>
              </div>
            </div>
            <ul class="nav nav-links mb-0 mx-n2">          
              <li class="nav-item">
                <p class="nav-link  text-900 me-1" aria-current="page"  >Tous <span class="text-700 fw-semi-bold">({{ Illuminate\Support\Facades\DB::table('cartes')->where('deleted_at',null)->count() }})</span></p>
              </li>             
              <li class="nav-item">              
                <p class="nav-link  text-900 me-1">Active <span class="text-700 fw-semi-bold">({{ Illuminate\Support\Facades\DB::table('cartes')->where('is_active',1)->where('deleted_at',null)->count() }})</span></p>
              </li>
              <li class="nav-item">
                <p class="nav-link  active" >Bloquer <span class="text-700 fw-semi-bold">({{ Illuminate\Support\Facades\DB::table('cartes')->where('is_active',0)->where('deleted_at',null)->count() }})</span></p>
              </li>
             
            </ul>

                <div class="pb-5">
                    <div class="row g-3">

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

                                                            <th>Id</th>
                                                            <th>Code a Barres</th>
                                                            <th>Cause</th>
                                                         
                                                    
                                                            <th>Amicale</th>
                                                            <th>Etat</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="alert" role="alert">
                                                            @foreach ($cartes as $c)
                                                                <td>
                                                                </td>
                                                                <td>
                                                                    {{ $c->id }}
                                                                </td>

                                                                <td>
                                                                    {{ $c->codeBar }}
                                                                </td>
                                                                
                                                                @php
                                                                $foundMatchh = false; // Flag to track if a match is found
                                                            @endphp
                                                                @foreach ($causes as $cause)
                                                                @if ($c->cause_id == $cause->id )
                                                                      <td>{{ $cause->description }}</td>
                                                                      @php
                                                                      $foundMatchh = true;
                                                                  @endphp
                                                                     @endif
                                                                     @endforeach
                                                             @if (!$foundMatchh)
                                                             <td>
                                                            </td>
                                                             @endif
                                                                   
                                                                    
                                                                      
                                                               
                                                                @php
                                                                $foundMatch = false; // Flag to track if a match is found
                                                            @endphp
                                                            
                                                            @foreach ($amicale as $a)
                                                                @if ($c->amicale_id == $a->id)
                                                                    <td>{{ $a->nom }}</td>
                                                                    @php
                                                                        $foundMatch = true;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            
                                                            @if (!$foundMatch)
                                                                <td>Libre</td>
                                                            @endif
                                                                @if ($c->is_active)
                                                                    <td><span class="badge bg-success text-white  fs--1 px-1 mb-2" style=" border-radius: 25px;">Active</span>

                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-phoenix-primary me-1 mb-1" style="width:110px; border: 1px solid rgb(24, 23, 23); " type="button" data-bs-toggle="modal" data-bs-target="#exampleModala{{ $c->id }}">Affectation</button>
                                                                      <button class="btn btn-phoenix-danger me-1 mb-1" style="width: 90px; border: 1px solid rgb(24, 23, 23); " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $c->id }}">Bloquer</button>
                                                                   
                                                                      <a onclick="return confirm('voulez vous vraiment supprimer cette Carte')"
                                                                      href="{{ route('admin.destroyCarte',$c->id) }}"
                                                                      class="btn btn-phoenix-danger me-1 mb-1" style="width: 110px; border: 1px solid rgb(24, 23, 23); ">Supprimer</a>
                                                                     
                                                                    </td>
                                                                @else
                                                                    <td><span class="badge bg-danger text-white  fs--1 px-1 mb-2" style=" border-radius: 25px;">Bloquer</span>
                                                                    </td>
                                                                    <td> <button class="btn btn-phoenix-primary me-1 mb-1 " style="width: 110px; border: 1px solid rgb(24, 23, 23); " type="button" data-bs-toggle="modal" data-bs-target="#exampleModala{{ $c->id }}">Affectation</button>
                                                                        <a href="{{ route('admin.CarteUnblock', $c->id) }}"
                                                                            class="btn btn-phoenix-success me-1 mb-1" style="width:110px; border: 1px solid rgb(24, 23, 23); ">Débloquer </a>
                                                                            <a onclick="return confirm('voulez vous vraiment supprimer cette Carte')"
                                                href="{{ route('admin.destroyCarte',$c->id) }}"
                                                class="btn btn-phoenix-danger me-1 mb-1" style="width: 110px; border: 1px solid rgb(24, 23, 23); ">Supprimer</a>
                                                                          </td>
                                                                @endif

                                                               
                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                    {{ $cartes->links() }}
                                                </table>

                                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>



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


<!--block Modal-->
@foreach ($cartes as $c)
  

<div class="modal fade" id="exampleModal{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bloque</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.Carteblock',$c->id) }}" method="POSt">
       @csrf
       <label class="form-label" for="exampleFormControlInput1">Cause</label>   <br>       <select name='cause_id'>
            @foreach ($causes as $cause)
            <option value={{ $cause->id }}>{{ $cause->description }}</option>
        @endforeach</select>
        <div class="modal-footer"><button class="btn btn-primary" type="submit">Confirmer</button>
             <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
 </form>
      </div>
    </div>
  </div>
</div>
@endforeach

<!--range affectation Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Affectation</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.AddAmicaleToCarte') }}" method="POSt">
         @csrf
         @error('amicale_id')
          <div class="alert alert-soft-danger" >{{ $message }}</div>
          @enderror
          @if (Session::get('errorAffectation'))
          <div class="alert alert-soft-danger">
              {{ Session::get('errorAffectation') }}
          </div>
      @endif
      <label class="form-label" for="exampleFormControlInput1">Amicale</label><br>
            <select name='amicale'>
              @foreach ($amicale as $a)
              <?php $gouvernorat = Illuminate\Support\Facades\DB::table('gouvernorats')->where('id', $a->gov_id)->value('nom'); ?>
              <option value={{ $a->id }}> {{ $a->nom }}-{{$gouvernorat}}</option>
          @endforeach</select>
          @error('amicale')
          <div class="alert alert-soft-danger" >{{ $message }}</div>
          @enderror
         <h4> De</h4>
          <select name='minid'>
            @foreach ($cartes as $c)
            <option value={{ $c->id }}>{{ $c->id }}</option>
        @endforeach</select>
        @error('minid')
        <div class="alert alert-soft-danger" >{{ $message }}</div>
        @enderror
        <h4>A</h4>
        <select name='maxid'>
          @foreach ($cartes as $c)
          <option value={{ $c->id }}>{{ $c->id }}</option>
      @endforeach</select>
      @error('maxid')
      <div class="alert alert-soft-danger" >{{ $message }}</div>
      @enderror
          <div class="modal-footer"><button class="btn btn-primary" type="submit">Confirmer</button>
               <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
   </form>
        </div>
      </div>
    </div>
  </div>

<!--affectation Modal-->
@foreach ($cartes as $c)
  

<div class="modal fade" id="exampleModala{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Affecter Carte</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.AffectAmicale',$c->id) }}" method="POSt">
       @csrf
       <label class="form-label" for="exampleFormControlInput1">Amicale</label><br>
       <select name='amicale'>
         @foreach ($amicale as $a)
         <?php $gouvernorat = Illuminate\Support\Facades\DB::table('gouvernorats')->where('id', $a->gov_id)->value('nom'); ?>
              <option value={{ $a->id }}> {{ $a->nom }}-{{$gouvernorat}}</option>
     @endforeach</select>
     @error('amicale')
     <div class="alert alert-soft-danger" >{{ $message }}</div>
     @enderror
        <div class="modal-footer"><button class="btn btn-primary" type="submit">Confirmer</button>
             <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
 </form>
      </div>
    </div>
  </div>
</div>
@endforeach





<!--Add Card modal-->

  

<div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Carte</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.CarteStore') }}" method="POSt">
       @csrf
       <div class="mb-3">
        <label class="form-label" for="exampleFormControlInput1">Code a Barre </label>
        <input name="codeBar" class="form-control" id="exampleFormControlInput1" type="text" placeholder=" Code a Barre" required>
        @error('codeBar')
        <div class="alert alert-soft-danger" role="alert">{{ $message }}</div>
        @enderror
      </div>
      <label class="form-label" for="exampleFormControlInput1">Amicale</label><br>
      <select name='amicale_id'>
        <option value="">Libre</option>
         @foreach ($amicale as $a)
         <?php $gouvernorat = Illuminate\Support\Facades\DB::table('gouvernorats')->where('id', $a->gov_id)->value('nom'); ?>
         <option value={{ $a->id }}> {{ $a->nom }}-{{$gouvernorat}}</option>
     @endforeach</select>
     @error('amicale')
     <div class="alert alert-soft-danger" >{{ $message }}</div>
     @enderror
        <div class="modal-footer"><button class="btn btn-primary" type="submit">Confirmer</button>
             <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button></div>
 </form>
      </div>
    </div>
  </div>
</div>

</html>