<?php

    namespace App\Http\Controllers\Hr;

    use App\Http\Controllers\Controller;
    use App\Models\Post;
    use Illuminate\Http\Request;

    class PostManager extends Controller
    {
        public function index()
        {
            return view('hr.post-manager');
        }
    }
