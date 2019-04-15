<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Route;
use Validator;
use Intervention\Image\Facades\Image;


class TestController extends Controller
{
    public function index(Request $request)
    {
                $img = Image::canvas(800, 600, '#ff0000');
        return $img->response();//直接做为http响应
    }
}