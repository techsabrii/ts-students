<!-- Pills navs -->
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
  <!-- Basic -->
<meta charset="UTF-8">
    <meta name="description" content="TS-Students Sigin">
    <meta name="keywords" content="Designing, Development, Coding, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Mobile Metas -->
  <meta name="language" content="English"> <!-- Replace with the appropriate language -->
<meta http-equiv="Content-Language" content="en">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Site Metas -->
  <meta name="keywords" content="web development, Laravel, PHP, HTML5, Bootstrap, IT support, tech services, tech sabrii, TS, Developers, Sabrii, Abdul Basit is Founder," />
  <meta name="description" content="TS Developers offers innovative web Development Course and app development Courses, including Laravel development, PHP, HTML5, Bootstrap, Flutter,Django,React,Angular" />
  <meta name="author" content="TS Developers" />
  <meta name="robots" content="index, follow" />

  <!-- Social Media Meta Tags -->
  <meta property="og:title" content="TS Developers - Innovative Web Solutions" />
  <meta property="og:description" content="Discover cutting-edge technology solutions with TS Developers. From Laravel development to IT support, explore our services and projects." />
  <meta property="og:image" content="{{ asset('img/icon/logo.png') }}" />
  <meta property="og:url" content="https://students.techsabrii.com/" />
  <meta property="og:type" content="website" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="TS Developers - Innovative Web Solutions" />
  <meta name="twitter:description" content="Discover cutting-edge technology solutions with TS Developers. From Laravel development to IT support, explore our services and projects." />
  <meta name="twitter:image" content="{{ asset('img/icon/logo.png') }}" />

<meta name="google-site-verification" content="6mQiO6BumQqQDF2BG9207iS19QiGEVV7OzBCnuAlk3c" />

  <link rel="icon" href="{{ asset('img/icon/logo.png') }}"/>
  <title>TS-Students Login</title>

  <!-- slider stylesheet -->
  <!-- slider stylesheet -->


  <!-- bootstrap core css -->
  
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- responsive style -->
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    
    
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/hstyle.css') }}">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body{background-image:url({{ asset('img/hero-bg.jpg') }})}
  </style>
</head>
<body>
    <section class="vh-100" style="  background-image:url({{ asset('img/hero-bg.jpg') }});">
        <div class="container py-5 h-100" >
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10" >
              <div class="card" style="border-radius: 1rem;" >
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="{{ asset('img/lognimage.jpg') }}"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">

                        <form method="POST" action="{{ url('login') }}">
                            @csrf

                        <div class="d-flex align-items-center mb-3 pb-1">
                          <i ><img src="{{ asset('img/icon/logo.png') }}" alt="" style="width: 40px;height: auto" ></i>
                          <span class="h1 fw-bold mb-0"> &nbsp;Students Login</span>
                        </div>

                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                        <div data-mdb-input-init class="form-outline mb-4">
                          <input type="email" id="form2Example17" class="form-control form-control-lg" name="email" />
                          <label class="form-label" for="form2Example17">Email address</label>
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                          <input type="password" id="form2Example27" class="form-control form-control-lg"  name="password"/>
                          <label class="form-label" for="form2Example27">Password</label>
                        </div>

                        <div class="pt-1 mb-4">
                          <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                        </div>
                    </form>
                    @if(session('success'))
                    <div class="alert alert-success floating-alert" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger floating-alert" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                        <a class="small text-muted" href="{{ url('forget') }}">Forgot password?</a>
                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="https://techsabrii.com/registration"
                            style="color: #393f81;">Register here</a></p>
                        <a href="#!" class="small text-muted">Terms of use.</a>
                        <a href="#!" class="small text-muted">Privacy policy</a>


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
