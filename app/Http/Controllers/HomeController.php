<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Adventure;
use App\Models\Teacher;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        
        if ($user->teacher == 1) {
            return view('classroom')->with('user', $user);
        } else {
            $student = $user->myStudent;
            $otherAdventures = [];
            $adventure = Adventure::with('modules.activities')->where('id', $student->adventure->id)->get()[0];
            if (isset($student->teacher)) {
                $teacher = $student->teacher;
                $otherAdventures = Adventure::whereHas('teachers', function($q) use ($teacher, $adventure){
                    $q->where('id_teacher', '=', $teacher->id);
                })->orWhereHas('creator', function($q) use ($teacher, $adventure){
                    $q->where('id', '=', $teacher->id);
                })->where('id', '<>', $adventure->id)->pluck('name', 'id')->prepend($adventure->name, $adventure->id);
            }
            $module = $adventure->modules->find($student->module->id);
            $activity = $module->activities->find($student->activity->id);
            $totalActivities = 0;
            $doneActivities = 0;
            foreach ($adventure->modules as $key => $value) {
                $totalActivities+=count($value->activities);
                if ($value->pivot->order < $module->pivot->order) {
                    $doneActivities+=count($value->activities);
                }
            }
            if ($student->adventure_ended) {
                $doneActivities+=$activity->pivot->order;
            } else {
                $doneActivities+=$activity->pivot->order-1;
            }
            return view('home')->with('user', $user)->with('adventure', $adventure)->with('currentModule', $module)->with('activity', $activity)->with('totalActivities', $totalActivities)->with('doneActivities', $doneActivities)->with('otherAdventures', $otherAdventures);
        }
    }
}
