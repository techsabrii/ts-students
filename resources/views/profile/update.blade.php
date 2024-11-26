


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/icon/logo.png') }}"/>
    <title>AJK-Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/hstyle.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    .profile-photo-container {
    position: relative;
    width: 200px; /* Adjust as needed */
    height: 200px; /* Adjust as needed */

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
    z-index: 1000;
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
    </style>


  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
@include('user.includes.header')

<br><br><br>
<div class="container emp-profile col-10 mb-5 mt-5">



        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">


                    <div class="container d-flex justify-content-center align-items-center">
                        <div class="profile-photo-container">

                            <img src="{{ asset('storage/' . old('image_path', auth()->user()->image_path)) }}" class="img-fluid rounded-circle" alt="Profile Photo">


                            <label for="photo-upload" class="photo-upload-label">
                                <i class="fas fa-camera"></i> <!-- Font Awesome camera icon -->
                                <form action="{{ route('user.updatePhoto') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                                    @csrf
                                    <input type="file" id="photo-upload" name="image" accept=".jpg,.png,.jpeg" class="form-control @error('photo') is-invalid @enderror">
                                    @error('photo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <button type="submit" class="btn btn-primary" id="upload-button" style="display: none;" hidden>Upload Photo</button>
                                </form>
                            </label>

                        </div>
                    </div>


                <!-- Display current profile photo with upload button -->


                <!-- Upload photo form -->




                <!-- Display user information -->


                <script>
                    document.getElementById('photo-upload').addEventListener('change', function() {
                        // Display the upload button when a file is selected
                        document.getElementById('upload-button').style.display = 'block';
                        // Automatically submit the form when a file is selected
                        document.getElementById('upload-form').submit();
                    });
                </script>

                    <!-- Profile photo (optional) -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h3>
                        <a href="{{ url('profile') }}">{{ old('student_name', auth()->user()->student_name) }}</a>
                    </h3>
                    <p>{{ old('subject', auth()->user()->subject) }}</p>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <form action="{{ route('update-profile') }}" method="POST">
                    @csrf
                        <br>
                        <button class="btn btn-primary" type="submit">UPLOAD</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work"><br>
                            <div id="content">
                                <div class="col-md-2">

                                </div>
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
                                <h6 ></h6>Add Social Links</h6>
                                <div class="row">
                                    <div class="row">
                                        <!-- WhatsApp -->
                                        <div class="col-2 p-0">
                                            <span class="fa-brands fa-whatsapp" style="font-size:32px;color:#25D366;"></span> <!-- WhatsApp Green -->
                                        </div>
                                        <div class="col-10 p-0">
                                            <input type="number" name="whatsapp" value="{{ old('contact', auth()->user()->contact) }}" class="form-control" required placeholder="9234654......">
                                        </div>

                                        <!-- github -->
                                        <div class="col-2 p-0">
                                            <span class="fa-brands fa-github" style="font-size:32px;color:#000000;"></span> <!-- Facebook Blue -->
                                        </div>
                                        <div class="col-10 p-0">
                                            <input type="text" name="github" value="{{ old('github', auth()->user()->github) }}" class="form-control" placeholder="Paste UserId.....">
                                        </div>


                                    </div>

                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="row">
                                    <div class="col-md-6"><label>Username</label></div>
                                    <div class="col-md-6">
                                        <input type="text" placeholder="username" name="username" value="{{ Auth::user()->name }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>Name</label></div>
                                    <div class="col-md-6">
                                        <input type="text" name="student_name" value="{{ old('student_name', auth()->user()->student_name) }}" class="form-control" required>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>Father Name</label></div>
                                    <div class="col-md-6">
                                        <input type="text" name="father_name" value="{{ old('father_name', auth()->user()->father_name) }}" class="form-control" required>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6"><label>Enter Date of Birth</label></div>
                                    <div class="col-md-6">
                                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}" class="form-control">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>Gender</label></div>
                                    <div class="col-md-6">
                                        <select class="form-control" name="gender" required>
                                            <!-- Set the default selected option using old() or current user's gender -->
                                            <option value="" disabled {{ old('gender', auth()->user()->gender) ? '' : 'selected' }}>--Select Gender--</option>
                                            <option value="Male" {{ old('gender', auth()->user()->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender', auth()->user()->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Others" {{ old('gender', auth()->user()->gender) == 'Others' ? 'selected' : '' }}>Others</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>NIC-NO</label></div>
                                    <div class="col-md-6">
                                        <input type="number" name="nic" value="{{ old('nic', auth()->user()->nic) }}" class="form-control">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>Postal Address</label></div>
                                    <div class="col-md-6">
                                        <textarea name="postal_address" id="" cols="30" rows="3" class="form-control" >{{ old('postal_address', auth()->user()->postal_address) }}</textarea>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>home Address</label></div>
                                    <div class="col-md-6">
                                        <textarea name="home_address" id="" cols="30" rows="3" class="form-control" >{{ old('home_address', auth()->user()->home_address) }}</textarea>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>Phone</label></div>
                                    <div class="col-md-6">
                                        <input type="text" name="contact" value="{{ old('nic', auth()->user()->contact) }}" class="form-control">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6"><label>Education</label></div>
                                    <div class="col-md-6">
                                        <input type="text" name="education" value="{{ old('education', auth()->user()->education) }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>Subject</label></div>
                                    <div class="col-md-6">
                                        <input type="text" name="subject" value="{{ old('subject', auth()->user()->subject) }}" class="form-control">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><label>Bio</label></div>
                                    <div class="col-md-6">
                                        <textarea name="decs" id="" cols="30" rows="3" class="form-control" >{{ old('decs', auth()->user()->decs) }}</textarea>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
            </div>
        </div>
        </div>

</div>


</body>
</html>
   <!-- Bootstrap JS and jQuery -->

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/hscript.js') }}"></script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!-- resources/views/profile/update.blade.php -->

<!-- resources/views/profile/update.blade.php -->


<!-- resources/views/users/user-profile.blade.php -->




    <!-- Include your JavaScript here -->


