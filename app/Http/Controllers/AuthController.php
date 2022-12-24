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
            $roles = UserRoleEnum::getRolesForRegister();
            return view('auth.register', [
                'roles' => $roles,
            ]);
        }

        public function callback($provider): RedirectResponse
        {
            $data = Socialite::driver($provider)->user();

            $user = User::query()
                ->where('email', $data->getEmail())
                ->first();

            $checkExit = true;


            if (is_null($user)) {
                $user = new User();

                $user->email = $data->getEmail();
                $user->role = UserRoleEnum::APPLICANT;
                $checkExit = false;
            }

            $user->name   = $data->getName();
            $user->avatar = $data->getAvatar();

            auth()->login($user, true);


            if ($checkExit) {
                $role = getRoleByKey($user->role);


                return redirect()->route("$role.index");
            }
            return redirect()->route('register');

        }

        public function registering(RegisteringRequest $request): RedirectResponse
        {
            $password = Hash::make($request->get('password'));
            $role = $request->get('role');

            if (auth()->check()) {
                User::where('id', auth()->user()->id)
                    ->update([
                        'password' => $password,
                        'role' => $role,
                    ]);
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $password,
                    'role' => $role,
                ]);

                Auth::login($user);
            }

            $role = getRoleByKey($role);

            dd($role);
            return redirect()->route("$role.index");

        }

        public function logout(Request $request): RedirectResponse
        {
            Auth::logout();
            $request->session()->invalidate();

            return redirect()->route('login');

        }

    }
