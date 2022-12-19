<?php

    namespace App\Http\Controllers;

    use App\Enums\FileTypeEnum;
    use App\Enums\PostStatusEnum;
    use App\Models\Company;
    use App\Models\File;
    use App\Models\Language;
    use App\Models\Post;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class TestController extends Controller
    {
        private object $model;
        private string $table;

        public function __construct()
        {
            $this->model = User::query();
            $this->table = (new User())->getTable();

        }

        public function test()
        {

            return view('layout_frontpage.posts');

        }
    }
