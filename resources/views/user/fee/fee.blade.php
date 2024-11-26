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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/hstyle.css') }}">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    /* Overall Container */
/* Global body and html styles to make sure the form is centered */
/* Global body and html styles */


/* Form Container Styling */
.fee-submission-container {
  max-width: 500px;
  width: 100%;
  padding: 20px;
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow:  0 10px 30px 10px rgba(36, 29, 29, 0.9);
  transition: transform 0.3s ease; /* Add transition to form for a slight movement effect */
}

.fee-submission-container:hover {
  transform: translateY(-10px); /* Slight upward movement on hover */
}

/* Header */
.header {
  text-align: center;
  color: #2c3e50;
  font-size: 24px;
  margin-bottom: 20px;
  transition: color 0.3s ease; /* Smooth color transition */
}

.header:hover {
  color: #3498db; /* Change color when hovered */
}

/* Form layout */
.fee-form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

/* Form Group (Flex Layout for buttons and inputs) */
.form-group {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

/* Input Fields */
.input-field {
  padding: 12px;
  font-size: 16px;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth border and shadow transition */
}

/* Focus effect on input */
.input-field:focus {
  outline: none;
  border-color: #3498db;
  box-shadow: 0 0 5px rgba(52, 152, 219, 0.4);
}

/* Status Button Styles */
.statuss-btn {
  padding: 12px 15px;
  font-size: 16px;
  background-color: #f39c12;  /* Orange for Fee */
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth background and transform transition */
  display: flex;
  align-items: center;
  gap: 8px;
}

.statuss-btn:hover {
  background-color: #e67e22;  /* Darker orange on hover */
  transform: scale(1.05); /* Slight scaling effect on hover */
}

.statuss-btn i {
  font-size: 18px;
  transition: transform 0.3s ease; /* Icon smooth transition */
}

.statuss-btn:hover i {
  transform: rotate(10deg); /* Rotate icon slightly on hover */
}

/* Buttons container */
.status-buttons {
  justify-content: center;
  display: flex;
  gap: 10px;
  margin-top: 10px;
}

/* File Upload Styling */
.file-upload {
  display: flex;
  align-items: center;
  gap: 10px;
  transition: transform 0.3s ease; /* Smooth transition for file upload */
}

.file-upload input {
  display: none; /* Hide default file input */
}

.file-label {
  background-color: #3498db;
  color: white;
  padding: 12px 20px;
  border-radius: 5px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 16px;
  transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition for background color */
}

.file-label:hover {
  background-color: #2980b9;
  transform: scale(1.05); /* Slight scaling effect on hover */
}

.file-label i {
  font-size: 18px;
  transition: transform 0.3s ease; /* Icon transition */
}

.file-label:hover i {
  transform: rotate(15deg);

  transition: transform 0.3s ease; /* Rotate icon slightly on hover */
}

/* Submit Button Styling */
.submit-btn {
  padding: 12px 20px;
  font-size: 18px;
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition for background color */
}

.submit-btn:hover {
  background-color: #2980b9;
  transform: scale(1.05); /* Slight scaling effect on hover */
}

/* General Transition for Text and Labels */
label {
  transition: color 0.3s ease;
}

label:hover {
  color: #3498db; /* Color change on label hover */
}


</style>
<style>
    body{background-image:url({{ asset('img/hero-bg.jpg') }})}.height-100{height:100vh}.card{width:400px;border:none;height:350px;box-shadow: 0px 5px 40px 0px #4c5d6f;z-index:1;display:flex;justify-content:center;align-items:center}.card h6{color:red;font-size:20px}.inputs input{width:40px;height:40px}input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button{-webkit-appearance: none;-moz-appearance: none;appearance: none;margin: 0}.card-2{background-color:#fff;box-shadow: 0px 5px 40px 0px #4c5d6f;padding:10px;width:350px;height:100px;bottom:-50px;left:20px;position:absolute;border-radius:5px}.card-2 .content{margin-top:50px}.card-2 .content a{color:red}.form-control:focus{box-shadow:none;border:2px solid red}.validate{border-radius:20px;height:40px;background-color:red;border:1px solid red;width:140px}
</style>
<body>

    @include('user.includes.header')





    <div class="container mt-5">
        <div class="row">
            <!-- Instructions Section -->
            <div class="col-md-6">
                <div class="fee-submission-container mt-5">
                    <img src="{{ asset('img/2500.jpg') }}" alt="Registration Fee QR">
                    <p class="instruction-text text-danger">
                        This QR Code will expire on 10/12/2024 and also Valid For First 3 Months fee.
                    </p>
                    <p class="instruction-text">
                        Please follow these steps to complete your  payment:
                    </p>
                    <ul>
                        <li>Open any payment application (e.g., mobile banking, EasyPaisa,JazzCash).</li>
                        <li>Scan the Above QR code to pay Course fee <strong>(2500)</strong> by Month. Visit <strong> Course</strong> Fee Structure</li>
                        <li>Once the payment is successful, save the receipt.</li>
                        <li>Upload the receipt along with the transaction ID in the Given Form</li>
                    </ul>
                    <p class="text-center mt-4">
                        <strong>Note:</strong> Ensure you keep the receipt safe, as it will be required for verification.
                    </p>
                </div>
            </div>

            <!-- Student Registration Section -->
            <div class="col-md-6">
   <!-- Link to Font Awesome (for icons) -->
   <div class="fee-submission-container mt-5">

    <h2 class="header">Monthly Fee Submission</h2>

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
    <!-- Loop through the courses of the logged-in user -->
    @foreach ($courses as $course)
        <form class="fee-form" data-course-id="{{ $course->id }}" action="{{ route('transaction-records.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3 class="header">{{ $course->course_name }}</h3>
            <input type="text" name="course_name" id="course_name" value="{{ $course->course_name }}" hidden>
            <div class="form-group">
                <!-- Month Dropdown -->
                <select class="input-field month-dropdown" name="month">
                    <option value="">Select Month</option>
                    @foreach (json_decode($course->fees, true) as $month => $data)
                        <option value="{{ $loop->iteration }}">{{ 'Month ' . $loop->iteration }}</option>
                    @endforeach
                </select>

                <!-- Fee, Status, and Date Buttons with Dynamic Content -->
                <div class="status-buttons">
                    <button type="button" class="student-name-btn statuss-btn">
                        {{ old('student_name', Auth::user()->student_name ?? 'Student Name') }}
                    </button>
                    <button type="button" class="statuss-btn amount-btn">
                        0
                    </button>
                    <button type="button" class="statuss-btn status-btn">
                        Pending
                    </button>
                    <button type="button" class="statuss-btn submit-date-btn">
                        <i class="fas fa-clock"></i> Date
                    </button>
                </div>
            </div>

            <!-- Transaction ID Field -->
            <div class="form-group">
                <label for="tr_id" class="label">Transaction-Id</label>
                <input type="number" name="tr_id" class="input-field" required placeholder="*************">
            </div>

            <!-- Upload Receipt Field -->
            <div class="form-group">
                <label for="receipt" class="label">Upload Receipt</label>
                <div class="file-upload">
                    <!-- Hide the actual file input and use the label to trigger it -->
                    <input type="file" name="receipt" id="receipt" class="input-field" accept="image/*,application/pdf" required style="display: none;">
                    <label for="receipt" class="file-label">
                        <i class="fas fa-upload"></i> Choose File
                    </label>
                </div>
            </div>


            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    @endforeach
</div>

            </div>
        </div>
    </div>


<script>
    // Log the selected file when a file is chosen
    document.getElementById('receipt').addEventListener('change', function(e) {
        console.log('Selected file:', e.target.files[0]);
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fetch the course data (pass the course object with fees)
    var coursesData = @json($courses);

    // Loop through each course form and handle the dropdown logic
    $('.month-dropdown').change(function() {
        var selectedMonth = $(this).val();  // Get the selected month (1, 2, 3, ...)
        var form = $(this).closest('form');  // Get the closest form element for the course

        var courseId = form.data('course-id');  // Get the course ID from the form data attribute
        var courseData = coursesData.find(course => course.id === courseId);  // Find the course data based on the ID

        if (courseData && selectedMonth) {
            // Get the fee data for the selected course (parse the fees JSON for the current course)
            var feesData = JSON.parse(courseData.fees);

            // Get the key for the selected month (e.g., 'month 1', 'month 2', ...)
            var monthKey = 'month ' + selectedMonth;

            // Ensure the data for that month exists
            if (feesData[monthKey]) {
                var monthData = feesData[monthKey];  // Get data for the selected month

                // Update the UI with the fee amount, status, and submit date for the specific month
                form.find('.amount-btn').text(monthData.amount);  // Display the fee amount
                form.find('.status-btn').text(monthData.status.charAt(0).toUpperCase() + monthData.status.slice(1));  // Display the status

                // Apply styling based on the status (e.g., paid or pending)
                if (monthData.status === 'paid') {
                    form.find('.status-btn').removeClass('pending').addClass('paid');
                } else if (monthData.status === 'pending') {
                    form.find('.status-btn').removeClass('paid').addClass('pending');
                }

                // Show the submit date if available, otherwise display 'No Date'
                var submitDate = monthData.submit_date ? new Date(monthData.submit_date).toLocaleDateString() : 'Date';
                form.find('.submit-date-btn').text(submitDate);
            }
        } else {
            // Reset UI if the selected month does not exist or if no month is selected
            form.find('.amount-btn').text('0');
            form.find('.status-btn').text('Pending');
            form.find('.submit-date-btn').text('Date');
            form.find('.status-btn').removeClass('paid pending');
        }
    });
</script>


</body>
</html>
<script>

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap CSS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- FontAwesome (for icons) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet">



<script src="{{ asset('js/hscript.js') }}"></script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
