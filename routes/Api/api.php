<?php

use Illuminate\Support\Facades\Route;

// routes/Api/test.php

// routes/api.php

Route::get('test', function () {
    return response('API is working!', 200)
        ->header('Content-Type', 'text/plain');
});



