<?php

    namespace App\Http\Controllers;

    use App\Enums\UserRoleEnum;
    use App\Http\Requests\Auth\RegisteringRequest;
    use App\Models\User;
    use Illuminate\Http\RedirectResponse;
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
            $user->role = UserRoleEnum::ADMIN;
            $user->save();
            $role = getRoleByKey($user->role);

            Auth::login($user, true);


            if ($checkExit) {
                return redirect()->route("$role.welcome");
            }
            return redirect()->route('register');

        }

        public function registering(RegisteringRequest $request): RedirectResponse
        {
            $password = Hash::make($request->password);
            $roleKey = $request->role;
            $role = getRoleByKey($roleKey);
            if (!auth()->check()) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $password,
                    'role' => $roleKey,
                ]);
                Auth::guard($role)->login($user);
            }

            return redirect()->route("$role.welcome");

        }

        public function logout(Request $request): RedirectResponse
        {
            Auth::logout();
            $request->session()->invalidate();

            return redirect()->route('login');

        }

    }
