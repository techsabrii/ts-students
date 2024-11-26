<!-- resources/views/media-list.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media List</title>
</head>
<body>

<h1>Uploaded Media</h1>

<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Original Video</th>
            <th>Low Quality</th>
            <th>Medium Quality</th>
            <th>High Quality</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($media as $item)
            <tr>
                <td><img src="{{ $item->image_url }}" alt="Image" width="100"></td>
                <td><a href="{{ $item->video_url }}" target="_blank">Download Original Video</a></td>
                <td><a href="{{ $item->low_quality_video_url }}" target="_blank">Download Low Quality</a></td>
                <td><a href="{{ $item->medium_quality_video_url }}" target="_blank">Download Medium Quality</a></td>
                <td><a href="{{ $item->high_quality_video_url }}" target="_blank">Download High Quality</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
