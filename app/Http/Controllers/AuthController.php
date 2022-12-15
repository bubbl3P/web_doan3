<?php

    namespace App\Http\Controllers;

    use App\Enums\UserRoleEnum;
    use App\Http\Requests\Auth\RegisteringRequest;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Laravel\Socialite\Facades\Socialite;

    class AuthController extends Controller
    {
//        public function admin()
//        {
//            return view('layout.master');
//        }

        public function login()
        {
            return view('auth.login');
        }

        public function register()
        {
            return view('auth.register');
        }

        public function callback($provider)
        {
            $data = Socialite::driver($provider)->user();

            $user = User::query()
                ->where('email', $data->getEmail())
                ->first();
            $checkExit = true;
            if (is_null($user)) {
                $user = new User();
                $user->email = $data->getEmail();
                $checkExit = false;
            }
            $user->name = $data->getName();
            $user->avatar = $data->getAvatar();
            $user->role =UserRoleEnum::ADMIN;
            $user->save();

            $role = strtolower(UserRoleEnum::getKeys($user->role)[0]);

            Auth::guard($role)->login($user);
            if ($checkExit) {
                return redirect()->route("$role.welcome");
            }
            return redirect()->route('register');

        }

        public function registering(RegisteringRequest $request)
        {
            $password = Hash::make($request->password);
            if (auth()->check()) {
                if (auth()->check()) {
                    User::where('id', auth()->user()->id)
                        ->update([
                            'password' => $password,

                        ]);
                } else {
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $password,
                    ]);
                    Auth::login($user);
                    return view('layout.master');
                }

            }
        }

    }
