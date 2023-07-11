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
                

                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Changer Mot De Passe</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.update') }}" method="Post">
                                @csrf
                                
                               
                                <div class="form-group">
                                    <label for="inputPasswordNew">Nouveau Mot De Passe</label>
                                    <input type="password" class="form-control" name="password" required="">
                                    @php
                                    $foundMatch = false; // Flag to track if a match is found
                                @endphp
                                    @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @php
                                    $foundMatch = true;
                                @endphp
                                    @enderror
                                    @if (!$foundMatch)
                                    <span class="form-text small text-muted">  
                        Le mot de passe doit comporter entre 5 et 30 caractères et ne doit <em>pas</em> contenir d'espaces.
                                    </span> 
                                    @endif
                                 
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNewVerify">Confirmer</label>
                                    <input type="password" class="form-control" name="cpassword" required="">
                                    @php
                                    $foundMatch = false; // Flag to track if a match is found
                                @endphp
                                    @error('cpassword')
                                    <p class="text-danger">{{ $message }}</p>
                                    @php
                                    $foundMatch = true;
                                @endphp
                                    @enderror
                                    @if (!$foundMatch)
                                    <span class="form-text small text-muted">
                                        Pour confirmer, saisissez à nouveau le nouveau mot de passe.
                                    </span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg float-right mt-5">Confirmer</button>
                                </div>
                            </form>
                        </div>
                    </div>
      </div></div></div>
     
       
        </div></main>
    </body>
</html>