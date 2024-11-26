<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Course Details">
    <meta name="keywords" content="Course, details, registration, fees">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - Course Details</title>
    <link rel="icon" href="{{ asset('img/icon/logo.png') }}"/>

    <!-- Bootstrap 5 and Custom Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/hstyle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" >
    <style>
        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 1.3rem;
            font-weight: bold;
        }
        .badge {
            font-size: 0.9rem;
        }
        .list-group-item {
            font-size: 1rem;
        }
        .btn-sm {
            font-size: 0.85rem;
        }
        .text-muted {
            color: #6c757d;
        }
        .accordion-button {
            font-size: 1.1rem;
            padding: 1rem;
        }
        .accordion-button:not(.collapsed) {
            background-color: #0d6efd;
            color: white;
        }
        .accordion-item {
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    @include('user.includes.header')

    <div class="custom-container mt-5">
        <h1 class="mb-4">My Registered Courses</h1>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($courses->isEmpty())
            <div class="text-center mt-5">
                <p class="text-muted">You have no Course Registration.</p>
            </div>
        @else
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->course_name }}</h5>
                                <p class="card-text">
                                    <strong>Language:</strong> {{ implode(', ', json_decode($course->language, true) ?? []) }}<br>
                                </p>


                                <!-- Accordion for collapsible sections -->
                                <div class="accordion" id="courseAccordion-{{ $course->id }}">
                                    <!-- Fee Details Section -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFee-{{ $course->id }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#feeDetails-{{ $course->id }}" aria-expanded="false" aria-controls="feeDetails-{{ $course->id }}">
                                                Fee Details
                                            </button>
                                        </h2>
                                        <div id="feeDetails-{{ $course->id }}" class="accordion-collapse collapse" aria-labelledby="headingFee-{{ $course->id }}" data-bs-parent="#courseAccordion-{{ $course->id }}">
                                            <div class="accordion-body">

                                                    <ul class="list-group list-group-flush">
                                                        @foreach (json_decode($course->fees, true) as $month => $fee)
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                {{ ucfirst($month) }}
                                                                <span class="badge {{ $fee['status'] === 'paid' ? 'bg-success' : 'bg-danger' }}">
                                                                    {{ ucfirst($fee['status']) }}
                                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>


                                            </div>
                                        </div>
                                    </div>

                                    <!-- Duration Section -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingDuration-{{ $course->id }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#duration-{{ $course->id }}" aria-expanded="false" aria-controls="duration-{{ $course->id }}">
                                                Duration
                                            </button>
                                        </h2>
                                        <div id="duration-{{ $course->id }}" class="accordion-collapse collapse" aria-labelledby="headingDuration-{{ $course->id }}" data-bs-parent="#courseAccordion-{{ $course->id }}">
                                            <div class="accordion-body">
                                                <strong>{{ $course->duration }} months</strong> - Total duration of the course.
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Info Section -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingInfo-{{ $course->id }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#info-{{ $course->id }}" aria-expanded="false" aria-controls="info-{{ $course->id }}">
                                                More Information
                                            </button>
                                        </h2>
                                        <div id="info-{{ $course->id }}" class="accordion-collapse collapse" aria-labelledby="headingInfo-{{ $course->id }}" data-bs-parent="#courseAccordion-{{ $course->id }}">
                                            <div class="accordion-body">
                                                {!! $course->details !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="card-footer text-center">
                                <a href="#" class="btn btn-primary btn-sm">View Course</a>

                                    <a href="#" class="btn btn-success btn-sm">Pay Now</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Bootstrap 5 JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
