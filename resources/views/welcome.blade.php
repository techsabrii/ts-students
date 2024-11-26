<form action="https://students.techsabrii.com/api/register" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Email Field -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Student Name Field -->
    <div class="form-group">
        <label for="student_name">Student Name</label>
        <input type="text" name="student_name" id="student_name" class="form-control" value="{{ old('student_name') }}" required>
        @error('student_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Father Name Field -->
    <div class="form-group">
        <label for="father_name">Father's Name</label>
        <input type="text" name="father_name" id="father_name" class="form-control" value="{{ old('father_name') }}" required>
        @error('father_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- NIC Field -->
    <div class="form-group">
        <label for="nic">NIC</label>
        <input type="text" name="nic" id="nic" class="form-control" value="{{ old('nic') }}" required>
        @error('nic')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Date of Birth Field -->
    <div class="form-group">
        <label for="date_of_birth">Date of Birth</label>
        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
        @error('date_of_birth')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Course Name Field -->
    <div class="form-group">
        <label for="course_name">Course Name</label>
        <input type="text" name="course_name" id="course_name" class="form-control" value="{{ old('course_name') }}" required>
        @error('course_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Duration Field -->
    <div class="form-group">
        <label for="duration">Duration</label>
        <input type="text" name="duration" id="duration" class="form-control" value="{{ old('duration') }}" required>
        @error('duration')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Details Field -->
    <div class="form-group">
        <label for="details">Details</label>
        <textarea name="details" id="details" class="form-control" rows="4" required><!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Web Development Course Details</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f8f9fa;
                        color: #333;
                        padding: 20px;
                    }
                    .course-header {
                        background-color: #007bff;
                        color: #fff;
                        padding: 20px;
                        border-radius: 8px;
                        margin-bottom: 20px;
                    }
                    .course-header h1 {
                        margin: 0;
                        font-size: 2.5rem;
                    }
                    .course-section {
                        margin-bottom: 20px;
                    }
                    .tech-list li {
                        margin-bottom: 10px;
                    }
                    .cta-button {
                        background-color: #007bff;
                        color: #fff;
                        padding: 10px 15px;
                        text-decoration: none;
                        border-radius: 5px;
                        display: inline-block;
                        margin-top: 20px;
                        font-weight: bold;
                    }
                    .cta-button:hover {
                        background-color: #0056b3;
                        text-decoration: none;
                    }
                </style>
            </head>
            <body>
                <div class="course-header">
                    <h1>Web Development Course</h1>
                    <p>Master the fundamentals of modern web development with hands-on experience.</p>
                </div>

                <div class="course-section">
                    <h2>Course Overview</h2>
                    <p>
                        This comprehensive course is designed to equip you with the skills and knowledge needed to create dynamic,
                        responsive, and user-friendly websites. Whether you're a beginner or looking to enhance your skills,
                        this course covers all the essential tools and technologies required to excel in web development.
                    </p>
                </div>

                <div class="course-section">
                    <h2>Technologies You Will Learn</h2>
                    <ul class="tech-list">
                        <li><strong>HTML:</strong> Learn the structure of web pages and the foundation of web development.</li>
                        <li><strong>CSS:</strong> Style your web pages with modern layouts, animations, and responsive design.</li>
                        <li><strong>Bootstrap:</strong> Build professional-grade, responsive websites quickly using the Bootstrap framework.</li>
                        <li><strong>JavaScript:</strong> Add interactivity and dynamic content to your websites.</li>
                        <li><strong>jQuery:</strong> Simplify JavaScript tasks with this powerful library.</li>
                        <li><strong>Ajax:</strong> Create seamless, real-time data interactions without reloading the page.</li>
                        <li><strong>PHP:</strong> Learn server-side scripting to build dynamic web applications.</li>
                        <li><strong>PHP-OOP:</strong> Master Object-Oriented Programming in PHP for scalable and reusable code.</li>
                        <li><strong>MySQL:</strong> Design and manage robust databases to store your application data.</li>
                        <li><strong>Laravel:</strong> Use the powerful Laravel framework to create scalable and maintainable web applications.</li>
                    </ul>
                </div>

                <div class="course-section">
                    <h2>Course Highlights</h2>
                    <ul>
                        <li>Real-world projects to build a portfolio.</li>
                        <li>Hands-on coding exercises and practical examples.</li>
                        <li>Step-by-step guidance from industry experts.</li>
                        <li>Modern tools and technologies covered in-depth.</li>
                        <li>Focus on best practices and performance optimization.</li>
                    </ul>
                </div>

                <div class="course-section">
                    <h2>Who Should Take This Course?</h2>
                    <p>
                        This course is ideal for:
                        <ul>
                            <li>Beginners looking to start a career in web development.</li>
                            <li>Students and professionals wanting to upgrade their technical skills.</li>
                            <li>Entrepreneurs who want to build and manage their own websites.</li>
                            <li>Anyone with a passion for technology and web development.</li>
                        </ul>
                    </p>
                </div>

                <a href="#" class="cta-button">Enroll Now</a>
            </body>
            </html>
            </textarea>
        @error('details')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Image Upload Field -->
    <div class="form-group">
        <label for="image">Profile Image (Optional)</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Last Result Image Field -->
    <div class="form-group">
        <label for="last_result_img">Last Result Image (Optional)</label>
        <input type="file" name="last_result_img" id="last_result_img" class="form-control" accept="image/*">
        @error('last_result_img')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
