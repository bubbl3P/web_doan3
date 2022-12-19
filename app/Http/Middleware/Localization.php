<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;

    class Localization
    {

        public function handle(Request $request, Closure $next)
        {
            $locale = session()->get('locale');
//            if (empty($locale)) {
//                $locale = $_COOKIE('locale');
//            }
            if (!in_array($locale, config('app.locales'))) {
                $locale = config('app.fallback_locale');
            }

            app()->setLocale($locale);
//            setcookie('locale', $locale, time() + (8600 * 30));

            return $next($request);
        }
    }
