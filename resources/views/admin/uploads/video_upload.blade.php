<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Upload</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="">


    @include('user.includes.admin_header')


    <div class="bg-white p-2 rounded-lg shadow-lg max-w-lg w-full mx-auto mt-2   justify-center items-center space-y-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Upload Video</h1>

        <!-- Course Selection -->
        <div>
            <label for="course_name" class="block text-gray-700 font-medium">Select Course Name</label>
            <select id="course_name" class="w-full mt-1 p-2 border border-gray-300 rounded-md" onchange="updateLanguages()" required>
                <option value="" disabled selected>---Select---</option>
                @foreach($courseNames as $courseName)
                    <option value="{{ $courseName }}">{{ $courseName }}</option>
                @endforeach
            </select>
        </div>

        <!-- Language Selection -->
        <div class="mt-4">
            <label for="language" class="block text-gray-700 font-medium">Select Language</label>
            <select id="language" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                <option value="" disabled selected>---Select a language---</option>
            </select>
        </div>

        <!-- Video Title -->
        <div class="mt-4">
            <label for="title" class="block text-gray-700 font-medium">Video Title</label>
            <input type="text" id="title" class="w-full mt-1 p-2 border border-gray-300 rounded-md" placeholder="Enter video title" required>
        </div>

        <!-- Video Description -->
        <div class="mt-4">
            <label for="description" class="block text-gray-700 font-medium">Video Description</label>
            <textarea id="description" class="w-full mt-1 p-2 border border-gray-300 rounded-md" rows="4" placeholder="Enter a brief description of the video..." required></textarea>
        </div>

        <!-- Video Upload -->
        <div class="mt-4">
            <label for="video_original" class="block text-gray-700 font-medium">Upload Video</label>
            <input type="file" id="video_original" class="w-full mt-1 p-2 border border-gray-300 rounded-md" accept="video/*" required>
        </div>

        <!-- Progress Bar -->
        <div class="mt-4">
            <label class="block text-gray-700 font-medium">Upload Progress</label>
            <div id="progress-container" class="w-full bg-gray-200 h-4 rounded-md mt-2">
                <div id="progress-bar" class="bg-blue-500 h-4 rounded-md" style="width: 0%;"></div>
            </div>
            <div id="progress-text" class="mt-2 text-center text-sm text-gray-600">0%</div> <!-- Percentage Text -->
        </div>

        <!-- Submit Button -->
        <button onclick="uploadVideo()" class="w-full bg-blue-500 text-white py-2 rounded-md mt-6 hover:bg-blue-600">
            Upload Video
        </button>
    </div>

    <!-- Success/Error Modal -->
    <div id="uploadStatusModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white rounded-lg p-6 w-80">
        <h2 id="modalTitle" class="text-xl font-semibold text-center"></h2>
        <p id="modalMessage" class="mt-2 text-center text-gray-600"></p>
        <div class="mt-4 flex justify-center">
            <button onclick="closeModal()" class="bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600">Close</button>
        </div>
    </div>
</div>

    <script>
        // Data from the controller
        const courseLanguages = @json($courseLanguages);

        // Update language dropdown based on course selection
        function updateLanguages() {
            const courseName = document.getElementById("course_name").value;
            const languageSelect = document.getElementById("language");

            // Clear existing options
            languageSelect.innerHTML = '<option value="" disabled selected>---Select a language---</option>';

            // Populate options if the course has languages
            if (courseName && courseLanguages[courseName]) {
                courseLanguages[courseName].forEach(language => {
                    const option = document.createElement("option");
                    option.value = language;
                    option.textContent = language;
                    languageSelect.appendChild(option);
                });
            }
        }

        // Upload video with progress tracking
        function uploadVideo() {
            const title = document.getElementById("title").value;
            const courseName = document.getElementById("course_name").value;
            const language = document.getElementById("language").value;
            const description = document.getElementById("description").value;
            const video = document.getElementById("video_original").files[0];
            const progressBar = document.getElementById("progress-bar");
            const progressText = document.getElementById("progress-text");

            if (!title || !courseName || !language || !description || !video) {
                alert("Please fill in all the fields and select a video.");
                return;
            }

            const formData = new FormData();
            formData.append("title", title);
            formData.append("course_name", courseName);
            formData.append("language", language);
            formData.append("description", description);
            formData.append("video_original", video);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "{{ route('video.upload.store') }}", true);
            xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            // Update progress bar and text
            xhr.upload.addEventListener("progress", function (e) {
                if (e.lengthComputable) {
                    const percentComplete = (e.loaded / e.total) * 100;
                    progressBar.style.width = percentComplete + "%";
                    progressText.textContent = Math.round(percentComplete) + "%"; // Update percentage text
                }
            });

            // Handle response
            xhr.onload = function () {
                const modal = document.getElementById("uploadStatusModal");
                const modalTitle = document.getElementById("modalTitle");
                const modalMessage = document.getElementById("modalMessage");

                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    modalTitle.textContent = "Upload Successful!";
                    modalMessage.textContent = response.message || "Your video has been uploaded successfully!";
                    openModal();
                    progressBar.style.width = "0%"; // Reset progress bar
                    progressText.textContent = "0%"; // Reset percentage text
                } else {
                    modalTitle.textContent = "Upload Failed!";
                    modalMessage.textContent = "Something went wrong. Please try again.";
                    openModal();
                }
            };

            // Send data
            xhr.send(formData);
        }

        // Open the modal
        function openModal() {
            document.getElementById("uploadStatusModal").classList.remove("hidden");
        }

        // Close the modal
        function closeModal() {
            document.getElementById("uploadStatusModal").classList.add("hidden");
        }
    </script>
</body>

</html>
