<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/icon/logo.png') }}"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/icon/logo.png') }}"/>
    <title>TS-Students</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <!-- Google Font -->

    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="{{ asset('css/hstyle.css') }}">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
.profile-photo-container {
    position: relative;
    width: 180px; /* Adjust as needed */
    height: 180px; /* Adjust as needed */

    overflow: hidden; /* Ensures the image fits within the circle */
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-photo-container img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the image covers the container while maintaining its aspect ratio */
    border-radius: 50%;
}

.photo-upload-label {
    position: absolute;
    bottom: 10px; /* Adjust spacing from the bottom as needed */
    right: 10px; /* Adjust spacing from the right as needed */
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border-radius: 50%;
    width: 50px; /* Adjust size as needed */
    height: 50px; /* Adjust size as needed */
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1;
    transition: background-color 0.3s ease;
}

.photo-upload-label i {
    font-size: 20px; /* Adjust icon size as needed */
}

.photo-upload-label:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

#photo-upload {
    display: none; /* Hides the file input field */
}


.photo-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
  justify-content: center; /* Center the grid items */
}

.photo-grid-item {
  width: 100px; /* Adjust based on how many items per row */
  height: 100px;
  margin-bottom: 10px;
  position: relative;
}

.photo-grid-item img {
  width: 100px;
  height: 100px;
  border-radius: 8px;
  object-fit: cover;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s ease;
}

.photo-grid-item img:hover {
  transform: scale(1.05); /* Slight zoom on hover */
}

.delete-icon {
  position: absolute;
  top: 5px;
  right: 5px;
  background: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  border-radius: 50%;
  padding: 5px;
  cursor: pointer;
  font-size: 14px;
  transition: background-color 0.3s ease;
}

.delete-icon:hover {
  background: rgba(0, 0, 0, 0.8);
}

.delete-form {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
}


/* Show full details on larger screens */
/* Default layout for larger screens */
.social-links {
    display: block;
}
.social-links i{
        font-size: 18px;
    }

.social-links a {
    display: inline-block;
    margin-right: 15px;
    margin-bottom: 10px;
}

/* Show full details on larger screens */
.social-links .social-text {
    display: inline;
}

/* Responsive layout for screens smaller than 768px */
@media screen and (max-width: 768px) {
    .social-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center; /* Center icons */
    }
    .social-links p{
        display: none;
    }
    .hi{
        display: none;
    }
    .social-links i{
        font-size: 20px;
    }
    .social-links a {
        display: flex;
        align-items: center;
        margin-right: 10px;
        margin-bottom: 0;
    }

    /* Hide the text part */
    .social-links .social-text {
        display: none;
    }
}

  </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

@include('user.includes.header')

<div class="container emp-profile mt-5 mb-5">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
               <a href="{{ url('update')}}">
                <div class="profile-img">





                    <div class="container d-flex justify-content-center align-items-center">
                        <div class="profile-photo-container">
                            <img src="{{ asset('storage/' . old('image_path', auth()->user()->image_path)) }}" class="img-fluid rounded-circle" alt="Profile Photo">

                            <label for="photo-upload" class="photo-upload-label">
                                <i class="fas fa-edit"></i> <!-- Font Awesome camera icon -->
                            </label>

                        </div>
                    </div>

                    <br><br>

                </div></a>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <br>
                            <h3>
                                {{ old('student_name', Auth::user()->student_name ?? '') }}

                            </h3>
                            <h6>{{ old('subject', Auth::user()->subject ?? '') }}</h6>
                            <br>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#Timeline" role="tab" aria-controls="profile" aria-selected="false">Course Details</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-md-2">
               </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    <div id="content">

                        <p class="hi">Social Links<p>
                            <div class="social-links">
                                <a href="https://wa.me/{{ old('contact', Auth::user()->contact ?? '') }}">
                                    <i class="fa-brands fa-whatsapp" aria-hidden="true" style="color: #25d366; "></i>
                                    <span class="social-text">{{ old('contact', Auth::user()->contact ?? '') }}</span>
                                </a>
                                <a href="mailto:{{ Auth::user()->email }}">
                                    <i class="fa-solid fa-envelope" aria-hidden="true" style="color: rgb(72, 133, 237); "></i>
                                    <span class="social-text">{{ Auth::user()->email }}</span>
                                </a>
                                <a href="{{ old('github', Auth::user()->github ?? '') }}">
                                    <i class="fa-brands fa-github" style="color: rgb(13, 19, 29); "></i>
                                    <span class="social-text">{{ old('github', Auth::user()->github ?? '') }}</span>
                                </a>

                            </div>


                        </div>





                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="row">
                                    <div class="col-md-6">
                                        <label>User id</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ Auth::user()->name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ old('student_name', Auth::user()->student_name ?? '') }}</p>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Father Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ old('father_name', Auth::user()->father_name ?? '') }}</p>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Date of Birth</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ old('date_of_birth', Auth::user()->date_of_birth ?? '') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>NIC-NO</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ old('nic', Auth::user()->nic ?? '') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Postal Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ old('postal_address', Auth::user()->postal_address ?? '') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ old('contact', Auth::user()->contact ?? '') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Gender</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ old('gender', Auth::user()->gender ?? '') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Subject</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ old('subject', Auth::user()->subject ?? '') }}</p>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <label>High Eduction</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ old('education', Auth::user()->education ?? '') }}</p>
                                    </div>
                                </div>



                        <div class="row">
                            <div class="col-md-12">
                               <a href="{{url('setting')}}"> <p>Click to Change Password</p></a>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="Timeline" role="tabpanel" aria-labelledby="profile-tab">


                    </div>


</div>
</div>


            </div>
                </form>

                </div>

            </div>

        </div>

</div>
<script>
    $(".gallery").magnificPopup({
      delegate: 'a',
      type: 'image',
      gallery:{
        enabled: true
      }
    });
  </script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/hscript.js') }}"></script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!-- resources/views/users/user-profile.blade.php -->



    <!-- Include your JavaScript here -->

