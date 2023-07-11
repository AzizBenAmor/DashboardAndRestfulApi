<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashassets/img/favicons/favicon16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashassets/img/yoo.ico') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

</head>
<body style="background-color: rgb(255, 255, 255);">
    <section class="h-100 gradient-form">
        <div class="container py-5  h-150">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                  <div class="row g-0">
                    <div class="col-lg-6">
                      <div class="card-body p-md-5 mx-md-4">
        
                        <div class="text-center">
                          <img src="{{ asset('assets/yooreed.png') }}"
                            style="width: 185px;" alt="logo">
                          <h4 class="mt-1 mb-5 pb-1 "style="color:#eb4949" >Admin</h4>
                        </div>
                  <form action="{{ route('admin.check') }}" method="post" autocomplete="off">
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <div class="form-outline mb-4">
                            <label for="email"> Email</label>
                            <input type="Email" id="form2Example11" class="form-control" name="email"
                              placeholder="Email" value="{{ old('email') }}"/>
                              @error('email')
                              <p class="text-danger">{{ $message }}</p>
                              @enderror
                              
                          </div>
                          <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example22">Password</label>
        
                            <input type="password" id="form2Example22" class="form-control" placeholder="Password" name="password"/>
                            
                            @error('password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                          </div>
                     
                      <div class="text-center pt-1 mb-5 pb-1">
                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log
                          in</button>
                    
                      </div>
                      
                      </div>
                  </form>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just a company</h4>
                <p class="small mb-0">Welcome to the admin login page of our e-commerce site! Here, you can access a wide range of powerful tools and features that will empower you to manage and grow your online business. With our user-friendly interface and robust security measures, you can confidently handle tasks such as inventory management, order processing, customer support, and much more. We value your trust and are committed to providing you with a seamless and efficient experience. Enter your credentials below to unlock the full potential of our e-commerce platform and take your business to new heights.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
</body>
</html>
