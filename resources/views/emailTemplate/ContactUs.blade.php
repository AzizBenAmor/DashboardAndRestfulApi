<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body class="bg-light">
    <div class="container">
      <img class="ax-center my-10 w-24 " style="border: 1px solid #ddd;
      border-radius: 4px;
      padding: 5px;
      width: 150px;"   src="https://yooreed.tn/front_files/assets/img/yooreed.png" />
      <div class="card p-6 p-lg-10 space-y-4">
        <h1 class="h3 fw-700">
         Contact US
        </h1>
        <h3>Email was sent by {{ $fromEmail }}</h3>
        <h4>{{ $fromName }}</h4>
        <p>
         {{$body}}
        </p>
        <a class="btn btn-primary p-3 fw-700" href="https://yooreed.tn">Visit Website</a>
      </div>
      <div class="text-muted text-center my-6">
        Sent with <3 from Yooreed. <br>
        Rue Alraed Bjaoui <br>
        Sousse, 4000 <br>
      </div>
    </div>
  </body>