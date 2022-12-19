<?php

    namespace App\Models;

    use App\Enums\PostCurrencySalaryEnum;
    use App\Enums\PostRemotableEnum;
    use App\Enums\PostStatusEnum;
    use App\Enums\SystemCacheKeyEnum;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\MorphToMany;
    use Spatie\Sluggable\SlugOptions;

    class Post extends Model
    {
        use HasFactory;
        use Sluggable;

        protected $fillable = [
            "company_id",
            "job_title",
            "district",
            "city",
            "remotable",
            "can_parttime",
            "min_salary",
            "max_salary",
            "currency_salary",
            "requirement",
            "start_date",
            "end_date",
            "number_applicants",
            "status",
            "slug",
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

        protected static function booted(): void
        {
            static::creating(static function ($object) {
                $object->user_id = user()->id;

                $object->status = 1;
            });
            static::saved(static function ($object) {
                $city = $object->city;
                $arr = explode(', ', $city);
                $arrCity = getPostCities();
                foreach ($arr as $item) {
                    if (in_array($item, $arrCity)) {
                        continue;
                    }
                    $arrCity[] = $item;
                }
                cache()->put(SystemCacheKeyEnum::POST_CITIES, $arrCity);
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

        public function languages(): MorphToMany
        {
            return $this->morphToMany(
                Language::class,
                'object',
                ObjectLanguage::class,
                'object_id',
                'language_id',
            );
        }

        public function company(): BelongsTo
        {
            return $this->belongsTo(Company::class);

        }

        public function getLocationAttribute(): ?string
        {
            if (!empty($this->district)) {
                return $this->district . ', ' . $this->city;
            }

            return $this->city;
        }


//        public function getSlugOptions(): SlugOptions
//        {
//            return SlugOptions::create()
//                ->generateSLugFrom('name')
//                ->saveSlugTo('slug');
//        }
//    protected $casts = [
//      'currency_salary' => PostCurrencySalaryEnum::class,
//    ];


    }
