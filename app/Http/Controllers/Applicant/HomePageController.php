<?php

    namespace App\Http\Controllers\Applicant;

    use App\Enums\SystemCacheKeyEnum;
    use App\Http\Controllers\Controller;
    use App\Models\Post;
    use Illuminate\Http\Request;


    class HomePageController extends Controller
    {
        public function __construct()
        {

        }

        public function index(Request $request)
        {
            $searchCities = $request->get('cities', []);


            $arrCity = getPostCities();

            $query = Post::query()
                ->with([
                    'languages',
                    'company' => function ($q) {
                        return $q->select([
                            'id',
                            'name',
                            'logo',
                        ]);
                    }
                ])
                ->latest();
            if (!empty($searchCities)) {
                $query->where(function($q) use ($searchCities) {
                    foreach ($searchCities as $searchCity) {
                        $q->orWhere('city', 'like', '%' . $searchCity . '%');
                    }
                    $q->orWhereNull('city');
                    return $q;
                });
            }
            $posts = $query->paginate();


            return view('applicant.index', [
                'posts' => $posts,
                'arrCity' => $arrCity,
                'searchCities' => $searchCities,
            ]);
        }
    }
