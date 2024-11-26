<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        // Function to filt er the table based on selected filters
        function filterTable() {
            let courseNameFilter = document.getElementById("course_name").value.toLowerCase();
            let monthFilter = document.getElementById("month").value.toLowerCase();
            let statusFilter = document.getElementById("status").value.toLowerCase();

            // Get all table rows
            let rows = document.querySelectorAll("#courses-table tbody tr");

            rows.forEach(row => {
                let courseName = row.getAttribute("data-course-name").toLowerCase();
                let month = row.getAttribute("data-month").toLowerCase();
                let status = row.getAttribute("data-status").toLowerCase();

                // Check if the row matches the filters
                let showRow = true;

                if (courseNameFilter && !courseName.includes(courseNameFilter)) {
                    showRow = false;
                }

                if (monthFilter && !month.includes(monthFilter)) {
                    showRow = false;
                }

                if (statusFilter && !status.includes(statusFilter)) {
                    showRow = false;
                }

                // Show or hide the row based on filter criteria
                row.style.display = showRow ? "" : "none";
            });
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>


    @include('user.includes.admin_header')

    <div class="container mx-auto p-6">
        <div class="row mb-4">
            <!-- Filter Section -->
            <div class="w-full mb-6">
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <div class="bg-blue-600 text-white p-4 rounded-t-lg">
                        <h4 class="text-xl font-semibold">Filter Courses</h4>
                    </div>
                    <div class="p-4">
                        <form>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Course Name Filter -->
                                <div class="flex flex-col">
                                    <label for="course_name" class="mb-2 font-medium text-gray-700">Course Name</label>
                                    <select name="course_name" id="course_name" class="form-select block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="filterTable()">
                                        <option value="">Select Course</option>
                                        <option value="Web Development with Laravel">Web Development with Laravel</option>
                                        <option value="App Development with Flutter">App Development with Flutter</option>
                                    </select>
                                </div>

                                <!-- Month Filter -->
                                <div class="flex flex-col">
                                    <label for="month" class="mb-2 font-medium text-gray-700">Month</label>
                                    <select name="month" id="month" class="form-select block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="filterTable()">
                                        <option value="">Select Month</option>
                                        <option value="month 1">Month 1</option>
                                        <option value="month 2">Month 2</option>
                                        <option value="month 3">Month 3</option>
                                        <option value="month 4">Month 4</option>
                                        <option value="month 5">Month 5</option>
                                        <option value="month 6">Month 6</option>
                                        <option value="month 7">Month 7</option>
                                    </select>
                                </div>

                                <!-- Status Filter -->
                                <div class="flex flex-col">
                                    <label for="status" class="mb-2 font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" class="form-select block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="filterTable()">
                                        <option value="">Select Status</option>
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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

            <!-- Courses Table Section -->
            <div class="w-full">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="bg-green-600 text-white p-4 rounded-t-lg">
                        <h4 class="text-xl font-semibold">Courses List</h4>
                    </div>
                    <div class="p-4">
                        <table id="courses-table" class="table-auto w-full border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700">
                                    <th class="px-4 py-2 text-left">Course Name</th>
                                    <th class="px-4 py-2 text-left">Student Name</th>
                                    <th class="px-4 py-2 text-left">Fees</th>
                                    <th class="px-4 py-2 text-left">Month</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                    <th class="px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    @php
                                        $fees = json_decode($course->fees, true); // Decode the JSON field
                                    @endphp
                                    @foreach($fees as $month => $fee)
                                        <tr class="border-b hover:bg-gray-50"
                                            data-course-name="{{ $course->course_name }}"
                                            data-month="{{ $month }}"
                                            data-status="{{ $fee['status'] }}">
                                            <td class="px-4 py-2">{{ $course->course_name }}</td>
                                            <td class="px-4 py-2">{{ $course->user->student_name }}</td> <!-- Display student name -->
                                            <td class="px-4 py-2">
                                                <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded-full">{{ $fee['amount'] }}</span>
                                            </td>
                                            <td class="px-4 py-2">
                                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full">{{ ucfirst($month) }}</span>
                                            </td>
                                            <td class="px-4 py-2">
                                                <span class="bg-{{ $fee['status'] == 'paid' ? 'green' : 'yellow' }}-200 text-{{ $fee['status'] == 'paid' ? 'green' : 'yellow' }}-800 px-2 py-1 rounded-full">
                                                    {{ ucfirst($fee['status']) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2">
                                                <!-- Button to Update Status -->
                                                <form action="{{ route('user.updateStatus', $course->user->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT') <!-- Use PUT method for updating resources -->

                                                    <!-- Pass the necessary hidden inputs -->
                                                    <input type="hidden" name="month" value="{{ ucfirst($month) }}">
                                                    <input type="hidden" name="course_name" value="{{ $course->course_name }}">

                                                    <!-- Stealth Mode Select -->
                                                    <select name="stealth_mode" id="stealth_mode" class="form-control">
                                                        <option value="1" {{ $course->user->stealth_mode == 1 ? 'selected' : '' }}>Stealth</option>
                                                    </select>

                                                    <!-- Update Status Button -->
                                                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                                        Update Status
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- FontAwesome icons for edit action -->
</body>
</html>
