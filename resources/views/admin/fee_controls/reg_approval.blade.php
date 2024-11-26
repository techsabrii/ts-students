<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Records</title>

    <!-- Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<div class="bg-blue-900 text-white shadow-md">
    @include('user.includes.admin_header')


    <!-- Main Container -->
    <div class="container mt-5">

        <!-- Page Heading -->
        <div class="text-center mb-4">
            <h1 class="display-4 text-primary">User Registration Records</h1>
        </div>
        <form action="{{ route('registration.index') }}" method="GET" class="mb-4">
            <div class="row">
                <!-- Month Filter -->
                <div class="col-md-3 form-group">
                    <input type="text" name="tr_id" class="input-field" placeholder="Search by Transaction ID" value="{{ request('tr_id') }}" >
                </div>


                <!-- Filter Button -->
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>

                </div>
            </div>
        </form>
        <form method="GET" action="{{ route('registration.index') }}">


        </form>
        <!-- Display Success or Error Messages -->
        <div id="alert-container">
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>

        <!-- Table for Displaying User and Registration Records -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-light">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registration Status</th>
                        <th>Transaction ID (tr_id)</th>
                        <th>Fee</th>
                        <th>Receipt</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->student_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>

                        <!-- Registration Status -->
                        <td>
                            <span class="badge badge-{{ $user->reg_status == 'completed' ? 'success' : 'warning' }}">
                                {{ $user->reg_status }}
                            </span>
                        </td>

                        <!-- Transaction ID and Fee -->
                        <td>{{ $user->registration ? $user->registration->tr_id : 'No registration found' }}</td>
                        <td>{{ $user->registration ? $user->registration->fee : 'N/A' }}</td>

                        <!-- Receipt -->
                        <td>
                            @if($user->registration && $user->registration->receipt)
                            <img src="{{ asset('storage/' . $user->registration->receipt) }}" alt="Receipt"
                                class="img-thumbnail" width="100px">
                            @else
                            No receipt
                            @endif
                        </td>

                        <!-- Actions (Register Button) -->
                        <td>
                            <form action="{{ route('user.register', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    Register <i class="fas fa-check-circle"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
