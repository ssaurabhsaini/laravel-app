<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    function tempUpload() {
        return json_encode([1]);
    }
}
