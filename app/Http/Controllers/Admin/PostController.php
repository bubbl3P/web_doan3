<?php

    namespace App\Http\Controllers\Admin;

    use App\Enums\ObjectLanguageTypeEnum;

    use App\Enums\PostRemotableEnum;
    use App\Enums\PostStatusEnum;
    use App\Http\Controllers\Controller;
    use App\Http\Controllers\ResponseTrait;
    use App\Http\Controllers\SystemConfigController;
    use App\Http\Requests\Post\StoreRequest;
    use App\Imports\PostImport;
    use App\Models\Company;
    use App\Models\File;
    use App\Models\Language;
    use App\Models\ObjectLanguage;
    use App\Models\Post;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\View;
    use Maatwebsite\Excel\Facades\Excel;
    use Throwable;

    class PostController extends Controller
    {
        use ResponseTrait;

        private $model;
        private $table;

        public function __construct()
        {

            $this->model = Post::query();
            $this->table = (new Post())->getTable();
            View::share('title', ucwords($this->table));
            View::share('table', $this->table);
        }

        public function index(Request $request)
        {


            $data = Post::query()
            ->get();


            $status = Post::query()
                ->select('status')
                ->get();
            return view('admin.posts.index', [
                'data' => $data,
                'status' => $status,

            ]);
        }

        public function create()
        {
            $configs = SystemConfigController::getAndCache();

            return view('admin.posts.create', [
                'currencies' => $configs['currencies'],
                'countries' => $configs['countries'],

            ]);
        }

        public function importCSV(Request $request): JsonResponse
        {
            try {
                Excel::import(new PostImport, $request->file('file'));
                return $this->successResponse();
            } catch (Throwable $e) {
                return $this->errorResponse();
            }


        }

        public function store(StoreRequest $request)
        {
            DB::beginTransaction();
            try {
                $arr = $request->only([
                    "job_title",
                    "district",
                    "city",
                    "min_salary",
                    "max_salary",
                    "currency_salary",
                    "requirement",
                    "start_date",
                    "end_date",
                    "number_applicants",
                    "experience",
                    "slug",
                ]);

                $link = $request->get('link');
                $companyName = $request->get('company');

                if (!empty($companyName)) {
                    $arr['company_id'] = Company::firstOrCreate(
                        [
                            'name' => $companyName,
                        ])->id;
                }

                if(!empty($link)){
                    $arr['link'] = File::firstOrCreate(
                        [
                            'link' => $link
                        ]
                    )->id;
                }

                if ($request->has('remotables')) {
                    $remotables = $request->get('remotables');
                    if (!empty($remotables['remote']) && !empty($remotables['office'])) {
                        $arr['remotable'] = PostRemotableEnum::HYBRID;
                    } elseif (!empty($remotables['remote'])) {
                        $arr['remotable'] = PostRemotableEnum::REMOTE_ONLY;
                    } else {
                        $arr['remotable'] = PostRemotableEnum::OFFICE_ONLY;
                    }

                }
                if ($request->has('can_parttime')) {
                    $arr['can_parttime'] = 1;
                }

                $post = Post::create($arr);
                $languages = $request->get('languages');

                foreach ($languages as $language) {
                    $language = Language::firstOrCreate(['name' => $language]);
                    ObjectLanguage::create([
                        'object_id' => $post->id,
                        'language_id' => $language->id,
                        'object_type' => Post::class,
                    ]);

                }
//
//                $companyName = $request->get('company');
//                $companyName = $request->get('company');
                DB::commit();
                return $this->successResponse();
            } catch (Throwable $e) {
                DB::rollBack();
                return $this->errorResponse($e->getMessage());
            }
        }

        public function changeStatus(Request $request): JsonResponse
        {
            $post = Post::find($request->status_id);
            $post->status = $request->status;
            $post->save();

            return $this->successResponse();

        }
    }
