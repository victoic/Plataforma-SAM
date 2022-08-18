<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Student;
use App\Models\Teacher;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Carbon\Carbon;

use App\Models\User as UserModel;
use App\Models\Achievement;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'birth_date' => 'required|min:10'
        ]);
    }

    private function lockoutTime() 
    {
        return property_exists($this, 'lockoutTime') ? $this->lockoutTime : 3600;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {   
        setlocale(LC_ALL, 'pt_BR');
        $teacher = FALSE;
        if (isset($data['teacher'])) {
            $teacher = TRUE;
        }
        $birth_date = $date = str_replace('/', '-', $data['birth_date']);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'birth_date' => date('Y-m-d', strtotime($birth_date)),
            'points' => 0,
            'active_time' => 0,
            'teacher' => $teacher,
        ]);
        $userModel = UserModel::find($user->id);
        if($teacher){
            $user->id_active_achievement = 26;
            $userModel->achievements()->save(Achievement::find(26));
        } else {
            $user->id_active_achievement = 13;
            $userModel->achievements()->save(Achievement::find(13));
        }
        if($teacher){
            $teacher = Teacher::create([
                'id_user' => $user->id,
            ]);
            $teacher->adventuresInLibrary()->attach(4);
            $teacher->save();
            $user->id_teacher = $teacher->id;
            $user->save();
        } else {
            $student = Student::create([
                'id_current_adventure' => 4,
                'id_current_module' => 34,
                'id_current_activity' => 109,
                'id_user' => $user->id,
            ]);
            $user->id_student = $student->id;
            $user->save();
        }
        return $user;    
    }
}
