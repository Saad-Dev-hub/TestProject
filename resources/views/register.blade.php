<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login and Registration Form in HTML</title>
      <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
      <div class="wrapper">
         <div class="title-text">
            <div class="title signup">
               Signup Form
            </div>
         </div>
         <div class="form-container">

            <div class="form-inner">
               <form action="{{ route('register') }}" class="signup" method="POST">
                    @csrf
                <div class="field">
                    <input type="text" name="name" placeholder="Name" required value="{{old('name')}}">
                </div>
                  <div class="field">
                     <input type="text" name="email" placeholder="Email Address" required  value="{{ old('email') }}">
                  </div>
                  <div class="field">
                     <input type="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="field">
                     <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input name="submit" type="submit" value="Signup">
                  </div>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <p><strong>Whoops!</strong> There were some problems with your input.</p>
                      <br>
                      <ul style="margin-left: 20px;">
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif
               </form>
            </div>
         </div>
      </div>

   </body>
</html>
