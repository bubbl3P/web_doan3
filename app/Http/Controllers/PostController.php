<?php

    namespace App\Http\Controllers;

    use App\Models\Post;
    use App\Models\User;
    use Illuminate\Http\Request;

    class PostController extends Controller
    {
        private $model;

        public function __construct()
        {
            $this->model = Post::query();
        }

        public function index()
        {
            return $this->model->simplePaginate();
        }
    }
