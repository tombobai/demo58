<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Route;
use Validator;


class TestController extends Controller
{
    public function index(Request $request)
    {
        echo md5(md5('admin123').'tTJBNZ');
    }
}