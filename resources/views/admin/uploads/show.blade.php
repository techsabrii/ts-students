<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Plyr.js CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />

    <!-- Custom CSS for video player page -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #222;
            color: #fff;
            padding: 20px;
            overflow-y: auto;
            border-radius: 10px;
            margin-top: 20px;
        }

        .sidebar a {
            color: #ddd;
            display: block;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .sidebar .video-item {
            display: flex;
            align-items: center;
        }

        .sidebar .video-item video {
            width: 150px;
        }

        .video-container {
            margin-top: 30px;
            flex: 1;
        }

        .plyr__video-embed {
            position: relative;
            overflow: hidden;
            display: block;
            box-shadow: 0 0 10px 10px #222;
            border-radius: 15px; /* Apply border-radius to the video container */
        }

        .plyr__video-embed video {
            width: 100%;
            height: auto;
            border-radius: 15px; /* Rounded corners on the video itself */
        }

        .video-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .video-description {
            margin-top: 20px;
            font-size: 16px;
            color: #555;
        }

        /* Highlight the current video in the sidebar */
        .highlighted {
            background-color: #007bff !important; /* Change the background color when highlighted */
            color: #fff; /* Change text color */
        }

        /* For responsive design */
        @media (max-width: 768px) {
            .sidebar {
                margin-top: 20px;
                margin-bottom: 20px;
                width: 100%;
                position: static;
            }

            .video-container {
                margin-left: 0;

            }
        }

        body {
    background-image: url({{ asset('img/hero-bg.jpg') }});
    background-repeat: no-repeat;
    background-attachment: fixed; /* Keeps the background fixed when scrolling */
    background-size: cover; /* Ensures the background image covers the entire viewport */
    background-position: center center; /* Centers the background image */
    height: 100vh; /* Ensures the body takes up the full height of the screen */
    margin: 0; /* Removes the default margin */
}


    </style>
    <link rel="stylesheet" href="{{ asset('css/hstyle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>


       @include('user.includes.header')


    <!-- Main container -->
    <div class="container-fluid mt-5">

        <!-- Row for larger screens -->
        <div class="row mt-5">

            <!-- Main Video Player Section -->
            <div class="col-md-9 col-12 video-container">

                <!-- Video Player Embed -->
                <div class="plyr__video-embed embed-responsive embed-responsive-16by9">
                    <video id="videoPlayer" autoplay loop controls crossorigin playsinline poster="{{ Storage::url($currentVideo->original_video) }}">
                        <source src="{{ Storage::url($currentVideo->original_video) }}" type="video/mp4" id="videoSource">
                    </video>
                </div>

                <!-- Description Section -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h1 class="video-title">{{ $currentVideo->title }}</h1>
                        <p class="card-text video-description">{{ $currentVideo->description }}</p>
                    </div>
                </div>

                <!-- Next Video Button -->
                <a href="{{ route('video.show', ['video' => $nextVideoIndex]) }}" class="btn btn-primary mt-3">Next Video</a>
            </div>

            <!-- Sidebar (video list) -->
            <div class="col-md-3 col-12 sidebar">
                <h4>All Videos</h4>

                <!-- Filters -->
                <form method="GET" action="{{ route('video.show') }}" class="mb-3">

                    <!-- Language Filter -->
                    <div class="mb-3">
                        <select name="language" id="languageFilter" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Select Language --</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language }}" {{ $selectedLanguage === $language ? 'selected' : '' }}>
                                    {{ ucfirst($language) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </form>

                <!-- Filtered Video List -->
                <div id="videoList">
                    @forelse ($videos as $index => $videoItem)
                    <a href="{{ route('video.show', ['video' => $index, 'language' => $selectedLanguage, 'course_name' => $selectedCourse]) }}" class="video-link">
                        <div class="video-item d-flex align-items-center mb-2">
                            <video src="{{ Storage::url($videoItem->original_video) }}" class="me-2" style="width: 100px; height: 100px;"></video>
                            <span>{{ $index + 1 }} - {{ $videoItem->title }}</span>
                        </div>
                    </a>
                @empty
                    <p>No videos found for the selected filters.</p>
                @endforelse
                </div>
            </div>

        </div>

    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/hscript.js') }}"></script>
    <!-- Plyr.js Script -->
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>

    <script>
        // Initialize Plyr.js player
        const player = new Plyr('#videoPlayer');

        // Get all video links in the sidebar
        const videoLinks = document.querySelectorAll('.video-link');

        // Get the currently playing video source URL
        const currentVideoSrc = document.querySelector('#videoPlayer source').src;

        // Add the 'highlighted' class to the video whose source matches the current video
        videoLinks.forEach(link => {
            const videoItemSrc = link.querySelector('video').src;
            if (currentVideoSrc === videoItemSrc) {
                link.classList.add('highlighted');
            }
        });

        // Optional: Add an event listener to detect when the video changes (e.g., next video)
        player.on('ended', () => {
            console.log('Video ended');
        });

        // Disable right-click on the entire page
        document.addEventListener('contextmenu', function(event) {
            event.preventDefault(); // Prevent the default right-click menu
        });
    </script>

</body>
</html>
