<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guest</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <h4>Contact us</h4><hr>
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <form action="{{ route('ContactUs') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror</div>
                        <div class="form-group">
                        <label for="">email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                    <label for="">Subject</label>
                    <input type="text" class="form-control" name="subject" placeholder="Enter subject">
                    @error('subject')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror</div>
                    <div class="form-group">
                        <label for="">Message</label>
                       <textarea name="message" class="form-control" cols="4" rows="4"></textarea>
                        @error('subject')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror</div>
                        <button  class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
 
</body>
</html>