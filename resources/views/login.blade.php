<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login Form</title>
      <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
      <div class="wrapper">
         <div class="title-text">
            <div class="title login">
               Login Form
            </div>
         </div>
         <div class="form-container">
            <div class="form-inner">
                <form action="{{route('login')}}" class="login" method="POST">
                    @csrf
                  <div class="field">
                     <input type="text" name="email" placeholder="Email Address" required value="{{old('email')}}">
                  </div>
                  <div class="field">
                     <input type="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input name="submit" type="submit" value="Login">
                  </div>
                  <div class="signup-link">
                     Not a member? <a href="{{ route('register') }}">Signup now</a>
                  </div>
                  @if ($errors->any())
                  <div class="alert alert-danger">
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
