<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidateController extends Controller
{
    public function index(Request $request)
    {
        // $images = Submission::with('image')->get();
        // return view('admin.validate.index')->with([
        //     'submissions' => Images->with('image')->get(),
        // ]);
    }
}
