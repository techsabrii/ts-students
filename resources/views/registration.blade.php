<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetched Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card img {
            height: 150px;
            object-fit: cover;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
          .list-group-item {
        padding: 0.5rem 1rem; /* Adjust the padding to decrease height */
        font-size: 0.9rem;    /* Optional: Slightly reduce font size */
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>


    @include('user.includes.admin_header')

<div class="container py-5">
    <h1 class="text-center mb-5 text-primary">Fetched Data</h1>


@if(session('success'))
    <!-- Success Alert -->
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <!-- Error Alert -->
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@elseif(isset($error))
    <!-- Error Alert -->
    <div class="alert alert-danger">
        {{ $error }}
    </div>

  @endif

        <!-- Cards Display -->
        <div class="row g-3">
            @foreach($records as $record)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ $record['student_image'] ? 'https://techsabrii.com/storage/' . $record['student_image'] : 'https://techsabrii.com/images/default-avatar.png' }}"
                             class="card-img-top rounded-top"
                             alt="Student Image">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $record['student_name'] }}</h5>
                            <li class="list-group-item"><strong>Father's Name:</strong> {{ $record['father_name'] }}</li>
                            <li class="list-group-item"><strong>Date of Birth:</strong> {{ $record['date_of_birth'] }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $record['email'] }}</li>
                            <li class="list-group-item"><strong>Status:</strong> {{ $record['status'] }}</li>
                            <li class="list-group-item"><strong>NIC:</strong> {{ $record['nic'] }}</li>
                            <li class="list-group-item"><strong>Education:</strong> {{ $record['education'] }}</li>
                            <li class="list-group-item"><strong>Description:</strong> {{ $record['decs'] }}</li>
                            <div class="mb-3">
                                <strong>Last Result Image:</strong>

                                    <img src="{{ $record['last_result_img'] ? 'https://techsabrii.com/storage/' . $record['last_result_img'] : 'https://techsabrii.com/images/default-avatar.png' }}"
                                         alt="Result Image"
                                         class="img-fluid rounded mt-2" width="100">

                            </div>
                            <form action="{{route('students.register.admin')}}" method="POST" class="text-center"   enctype="multipart/form-data">
                                @csrf
                                <!-- Hidden Inputs -->

                                    <input type="hidden" name="student_name" value="{{ $record['student_name'] }}">
                                    <input type="hidden" name="father_name" value="{{ $record['father_name'] }}">
                                    <input type="hidden" name="date_of_birth" value="{{ $record['date_of_birth'] }}">
                                    <input type="hidden" name="email" value="{{ $record['email'] }}">
                                    <input type="hidden" name="nic" value="{{ $record['nic'] }}">
                                    <input type="hidden" name="home_address" value="{{ $record['home_address'] }}">
                                    <input type="hidden" name="contact" value="{{ $record['contact'] }}">
                                    <input type="hidden" name="education" value="{{ $record['education'] }}">
                                    <input type="hidden" name="subject" value="{{ $record['subject'] }}">
                                    <input type="hidden" name="decs" value="{{ $record['decs'] }}">
                                   <input type="file" hiddenname="image" value="Student Image">
                                   <input type="file" hidden name="last_result_img" value="Result Image">
                                    <select name="course_name">
                                        <option value="Web Development with Laravel">Web Development with Laravel</option>
                                        <option value="App Development with Flutter">App Development with Flutter</option>
                                        <option value="CCNA">CCNA</option>
                                    </select>

                                <button type="submit" class="btn btn-primary w-100">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
