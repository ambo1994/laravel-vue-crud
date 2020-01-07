<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /*
    *Post lists
    */
    public function index() {
        return view('blogDashBoard');
    }
    /*
    *Post form
    */
    public function addPost() {
        return view('add-post');   
    }
}
