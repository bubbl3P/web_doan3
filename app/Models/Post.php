<?php

    namespace App\Models;

    use App\Enums\PostCurrencySalaryEnum;
    use App\Enums\PostStatusEnum;
    use App\Enums\SystemCacheKeyEnum;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Spatie\Sluggable\SlugOptions;

    class Post extends Model
    {
        use HasFactory;
        use Sluggable;

        protected $fillable = [
            'company_id',
            'job_title',
            'city',
            'status',

        ];
//    // protected $appends = [
//    //     'currency_salary_code',
//    // ];
//    protected $casts = [
//        'start_date' => 'date',
//        'end_date'   => 'date',
//    ];
//
//    protected static function booted(): void
//    {
//        static::creating(static function ($object) {
//            $object->user_id = user()->id;
//            $object->status  = PostStatusEnum::getByRole();
//        });
//    }

        public function sluggable(): array
        {
            return [
                'slug' => [
                    'source' => 'job_title'
                ]
            ];
        }

        protected static function booted()
        {
            static::creating(static function ($object) {
//            $object->user_id =  auth()->id();
                $object->user_id = 1;
            });
        }

        public function getCurrencySalaryCodeAttribute()
        {
            return PostCurrencySalaryEnum::getKey($this->currency_salary);
        }

        public function getStatusNameAttribute()
        {
            return PostStatusEnum::getKey($this->status);
        }

        public function getSlugOptions(): SlugOptions
        {
            return SlugOptions::create()
                ->generateSLugFrom('name')
                ->saveSlugTo('slug');
        }
//    protected $casts = [
//      'currency_salary' => PostCurrencySalaryEnum::class,
//    ];


    }
