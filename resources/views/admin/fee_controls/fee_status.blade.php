<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Records</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div class="bg-blue-900 text-white shadow-md">
    @include('user.includes.admin_header')


    <div class="container mt-5">
        <h1 class="text-center mb-4">All Transaction Records</h1>

        <!-- Month and Course Name Filter Form -->
        <form action="{{ route('transactions.index') }}" method="GET" class="mb-4">
            <div class="row">
                <!-- Month Filter -->
                <div class="col-md-2">
                    <input type="text" name="tr_id" class="input-field" placeholder="Search by Transaction ID" value="{{ request('tr_id') }}" >
                </div>
                <div class="col-md-2">
                    <select name="month" class="form-control">
                        <option value="">Select Month</option>
                        <option value="1" {{ request('month') == '1' ? 'selected' : '' }}>Month 1</option>
                        <option value="2" {{ request('month') == '2' ? 'selected' : '' }}>Month 2</option>
                        <option value="3" {{ request('month') == '3' ? 'selected' : '' }}>Month 3</option>
                        <option value="4" {{ request('month') == '4' ? 'selected' : '' }}>Month 4</option>
                        <option value="5" {{ request('month') == '5' ? 'selected' : '' }}>Month 5</option>
                        <option value="6" {{ request('month') == '6' ? 'selected' : '' }}>Month 6</option>
                        <option value="7" {{ request('month') == '7' ? 'selected' : '' }}>Month 7</option>
                    </select>
                </div>

                <!-- Course Name Filter -->
                <div class="col-md-2">
                    <select class="form-control" name="course_name">
                        <option value="">Select Course</option>
                        <option value="Web Development with Laravel" {{ request('course_name') == 'Web Development with Laravel' ? 'selected' : '' }}>Web Development with Laravel</option>
                        <option value="Flutter" {{ request('course_name') == 'Flutter' ? 'selected' : '' }}>Flutter</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="status">
                        <option value="">Select Course</option>
                        <option value="Paid" {{ request('status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Display Success or Error Messages -->
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

        <!-- Table to Display Transaction Records -->
        <table class="table table-bordered table-striped text-light">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Month</th>
                    <th>Course Name</th>
                    <th>Transaction ID</th>
                    <th>Receipt</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                    <th>Mode</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactionRecords as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->user->student_name }}</td>
                    <td>{{ $transaction->user->email }}</td>
                    <td>{{ $transaction->month }}</td>
                    <td>{{ $transaction->course_name }}</td>
                    <td>{{ $transaction->tr_id }}</td>
                    <td>
                        @if($transaction->receipt_url)
                            <img src="{{ asset('storage/' . $transaction->receipt_url) }}" alt="Receipt" width="100px">
                        @else
                            No receipt
                        @endif
                    </td>
                    <td>{{ $transaction->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('h:i A - d M') }}</td>
                    <td>
                        <form action="{{ route('updateTransactionStatus') }}" method="POST">
                            @csrf
                            <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                            <select name="status" id="status" class="form-control">
                                <option value="Paid">Paid</option>
                                <option value="Pending">Pending</option>
                            </select>
                            <input type="text" name="month" value="{{ $transaction->month }}" readonly hidden>
                            <input type="text" name="course_name" value="{{ $transaction->course_name }}" readonly hidden>
                            <button type="submit" class="btn btn-sm btn-primary">Update Status</button>
                        </form>

                    </td>
                    <td><form action="{{ route('user.updateStatus', $transaction->user->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating resources -->
                        <input type="hidden" name="transaction_id" value="{{ $transaction->user->id }}">
                        <select name="stealth_mode" id="stealth_mode" class="form-control">
                            <option value="1" {{ $transaction->user->stealth_mode == 1 ? 'selected' : '' }}>Stealth</option>
                            <option value="0" {{ $transaction->user->stealth_mode == 0 ? 'selected' : '' }}>Active</option>
                        </select>
                        <input type="text" name="month" value="{{ $transaction->month }}" hidden>
                        <input type="text" name="course_name" value="{{ $transaction->course_name }}" hidden>

                        <button type="submit" class="btn btn-sm btn-primary">Update Status</button>
                    </form>


                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


 


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
