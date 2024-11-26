<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Language Icons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .custom-card:hover {
            transform: scale(1.02);
        }

        .icon-preview {
            height: 60px;
            width: 60px;
            object-fit: cover;
            border-radius: 50%;
        }

        .icon-upload-section {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    @include('user.includes.admin_header')

<div class="container mt-5">
    <!-- Page Header -->
    <h1 class="mb-4 text-center">Manage Programming Language Icons</h1>
    <hr class="mb-5">

    <!-- Success Message -->
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

    <!-- Upload Icon Section -->
    <div class="icon-upload-section p-4 mb-5 bg-light rounded">
        <h2 class="mb-3 text-center">Upload a New Language Icon</h2>
        <form action="{{ route('language-icons.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">

                <!-- Language Select Dropdown -->
                <div class="form-group">
                    <label for="language">Select Language</label>
                    <select name="language_name" id="language" class="form-control">
                        <option value="" disabled selected>Select a language</option>
                @foreach($languages as $language)
                    <option value="{{ $language }}">{{ $language }}</option>
                @endforeach
                    </select>
                </div>

            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Upload Icon</label>
                <input type="file" name="icon" id="icon" class="form-control" accept="image/*" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Upload Icon</button>
            </div>
        </form>

    </div>

    <!-- Display Language Icons -->
    <div class="row g-4">
        @forelse($languageIcons as $icon)
            <div class="col-md-4 col-lg-3">
                <div class="custom-card p-3 text-center">
                    <img src="{{ asset('storage/' . $icon->icon_path) }}" alt="{{ ucfirst($icon->language_name) }} Icon" class="icon-preview mb-3">
                    <h5 class="mb-2">{{ ucfirst($icon->language_name) }}</h5>
                    <form action="{{ route('language-icons.destroy', $icon->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No icons available. Please upload a new icon.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
