<?php

    namespace App\Http\Controllers;

    use App\Enums\FileTypeEnum;
    use App\Enums\PostCurrencySalaryEnum;
    use App\Enums\PostRemotableEnum;
    use App\Enums\PostStatusEnum;
    use App\Models\Company;
    use App\Models\File;
    use App\Models\Language;
    use App\Models\Post;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\DB;

    class TestController extends Controller
    {
        private object $model;
        private string $table;

        public function __construct()
        {
            $this->model = Post::query();
            $this->table = (new User())->getTable();

        }

        public function test()
        {
            $start = Post::query()
                ->where('start_date')

                ->get('id');
            echo $start;
            echo Carbon::createFromFormat('Y-m-d', '1975-05-21')->toDateTimeString();

        }
    }
