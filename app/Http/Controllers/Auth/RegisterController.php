<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/volunteer/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
            'icno'         => ['required', 'string', 'max:255'],
            'gender'       => ['required', 'string', 'max:10'],
            'dob'          => ['required', 'date'],
            'phone_number' => ['required', 'string', 'max:20'],
            'address'      => ['required', 'string', 'max:255'],
            'state'        => ['required', 'string', 'max:255'],
            'postcode'     => ['required', 'string', 'max:10'],
            'about'        => ['nullable', 'string'],
            'role_id'      => ['nullable', 'integer'],
            'image'        => ['nullable', 'image', 'max:2048'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    /* protected function create(array $data)
    {
        $userData = [
            'name'         => $data['name'],
            'email'        => $data['email'],
            'password'     => Hash::make($data['password']),
            'icno'         => $data['icno'],
            'gender'       => $data['gender'],
            'dob'          => $data['dob'],
            'phone_number' => $data['phone_number'],
            'address'      => $data['address'],
            'state'        => $data['state'],
            'postcode'     => $data['postcode'],
            'about'        => $data['about'],
            'role_id'      => 3,
        ];

        if (isset($data['image'])) {
            $path = $data['image']->store('profile_images', 'public'); // Store the image in the 'profile_images' directory in the 'public' disk
            $userData['image'] = $path;
        }

        return User::create($userData);
    } */

    protected function create(array $data)
    {
        $userData = [
            'name'         => $data['name'],
            'email'        => $data['email'],
            'password'     => Hash::make($data['password']),
            'icno'         => $data['icno'],
            'gender'       => $data['gender'],
            'dob'          => $data['dob'],
            'phone_number' => $data['phone_number'],
            'address'      => $data['address'],
            'state'        => $data['state'],
            'postcode'     => $data['postcode'],
            'about'        => $data['about'],
            'role_id'      => 3,
        ];

        if (isset($data['image'])) {
            $path = $data['image']->store('profile_images', 'public');
            $userData['image'] = $path;
        }

        $user = User::create($userData);

        if (isset($data['skills'])) {
            foreach ($data['skills'] as $skillName) {
                $skill = Skill::firstOrCreate(['name' => $skillName, 'description' => $skillName]);
                UserSkill::create([
                    'user_id' => $user->id,
                    'skill_id' => $skill->id,
                ]);
            }
        }

        return $user;
    }
}
