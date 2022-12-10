<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Imports\PostImport;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Maatwebsite\Excel\Facades\Excel;

    class PostController extends Controller
    {
        private $model;
        private $table;

        public function __construct()
        {
            $this->model = User::query();
            $this->table = (new User())->getTable();

        }

        public function index()
        {
            $data = $this->model->get();


            return view('admin.posts.index', [
                'data' => $data,
            ]);
        }

        public function importCSV(Request $request)
        {
            Excel::import(new PostImport, $request->file('file'));

        }
    }
