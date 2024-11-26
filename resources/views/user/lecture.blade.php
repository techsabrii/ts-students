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
    <link rel="stylesheet" href="{{ asset('css/hstyle.css') }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>


        .course-card {
            margin-bottom: 20px;

        }

        .language-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;

            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .language-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }



        .language-title {
            font-size: 18px;
            font-weight: 500;
            margin-top: 10px;
        }

        .no-languages {
            text-align: center;
            color: #666;
            font-style: italic;
        }
        .icon{
            width: 100px;
            height: auto;
        }
    </style>
</head>

<body>


    @include('user.includes.header')
    <div class="custom-container mt-5">
        <h1 class="mb-4">Your Courses</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('user.lectures') }}" class="mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="courseFilter" class="form-label">Filter by Course:</label>
                </div>
                <div class="col-auto">
                    <select name="course_name" id="courseFilter" class="form-select">
                        <option value="">-- Select a Course --</option>
                        @foreach($userCourses as $course)
                            <option value="{{ $course->course_name }}" {{ $selectedCourse === $course->course_name ? 'selected' : '' }}>
                                {{ $course->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('user.lectures') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>


        @foreach($groupedLanguages as $courseName => $languages)
        <div class="course-card card">
            <div class="card-header">
                <h3 class="mb-0">{{ $courseName }}</h3>
            </div>
            <div class="card-body">
                @if($languages->isEmpty())
                    <p class="no-languages">No available languages.</p>
                @else
                    <div class="row g-3">
                        @foreach($languages as $language)
                            <div class="col-md-4 col-sm-6">
                                <a href="{{ route('video.show', ['language' => $language]) }}" class="language-link text-decoration-none">
                                    <div class="language-card">
                                        @php
                                            // Query the icon for each language directly from the database
                                            $languageIcon = \App\Models\LanguageIcon::where('language_name', $language)->first();
                                        @endphp

                                        @if($languageIcon)
                                            <img src="{{ asset('storage/' . $languageIcon->icon_path) }}" alt="{{ $language }} icon" class="icon" />
                                        @else
                                            <p>No icon available</p>
                                        @endif

                                        <div class="language-title">{{ $language }}</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach




    </div>

    <!-- JS Libraries -->
    <script src="{{ asset('js/hscript.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
