<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Announcement</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    @include('user.includes.admin_header')
    <div class="container mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Send Announcement</h1>

        <!-- Announcement Form -->
        <form action="{{ route('announcements.send') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg space-y-6">
            @csrf

            <!-- Message Field -->
            <div class="mb-6">
                <label for="message" class="block text-lg font-medium text-gray-700 mb-2">Announcement Message</label>
                <textarea name="message" id="message" rows="6" class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required></textarea>
            </div>

            <!-- Students Selection -->
            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-700 mb-2">Select Students</label>
                <div class="h-48 overflow-y-auto border border-gray-300 p-4 rounded-lg bg-gray-50">
                    @foreach($students as $student)
                        <div class="flex items-center mb-4">
                            <input type="checkbox" name="students[]" value="{{ $student->id }}" class="mr-4 rounded-md focus:ring-2 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">
                                {{ $student->student_name ?? 'No Name' }} - {{ $student->email }} -
                                <span class="font-semibold text-gray-500">Status: {{ $student->reg_status == '1' ? 'Registered' : 'Not Registered' }}</span>
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white text-lg rounded-lg hover:bg-blue-700 transition duration-300">Send Email</button>
            </div>
        </form>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mt-6 p-4 bg-green-100 text-green-800 rounded-md shadow-md">
                <strong class="font-semibold">Success!</strong> {{ session('success') }}
            </div>
        @endif
    </div>
</body>

</html>
