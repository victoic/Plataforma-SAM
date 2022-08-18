<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Adventure;
use App\Models\Activity;
use App\Models\Module;
use App\Models\Achievement;
use App\Models\Student;
use App\Models\Teacher;

class UserController extends InfyOmBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $users = $this->userRepository->all();

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    public function showAchievements(){
        $user = $this->userRepository->findWithoutFail(auth()->user()->id);
        if (empty($user)) {
            Flash::error('Usuário não encontrado');
            return redirect(route('users.index'));
        }
        $userAchievements = $user->achievements;
        $achievements = Achievement::all();
        return view('userAchievements')->with('user', $user)->with('achievements', $achievements)->with('userAchievements', $userAchievements);

    }

    public function showSettings(){
        $user = $this->userRepository->findWithoutFail(auth()->user()->id);

        if (empty($user)) {
            Flash::error('Usuário não encontrado');

            return redirect(route('users.index'));
        }

        return view('settings')->with('user', $user);
    }

    public function showLibrary(){
        $user = $this->userRepository->findWithoutFail(auth()->user()->id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('library')->with('user', $user);
    }

    public function addAdventureToLibrary(Request $request){
        $user = $this->userRepository->findWithoutFail(auth()->user()->id);
        $teacher = $user->myTeacher;
        $adventure = Adventure::find($request['idAdventure']);
        $teacher->adventuresInLibrary()->attach($adventure);
        $teacher->save();
    }

    public function removeAdventureFromLibrary(Request $request){
        $user = $this->userRepository->findWithoutFail(auth()->user()->id);
        $teacher = $user->myTeacher;
        $adventure = Adventure::find($request['idAdventure']);
        $teacher->adventuresInLibrary()->detach($adventure);
        $teacher->save();
    }

    public function showClassroom(){
        $user = $this->userRepository->findWithoutFail(auth()->user()->id);
        if (empty($user)) {
            Flash::error('Usuário não encontrado');

            return redirect(url('/home'));
        }

        return view('classroom')->with('user', $user);
    }

    public function addStudent(Request $request) {
        $student = Student::find($request['data']['id']['idStudent']);
        $teacher = Teacher::find($request['data']['id']['idTeacher']);
        $response = array();
        if (count($student)) {
            $teacher->students()->save($student);
            $teacher->save();
            $student->id_teacher = $teacher->id;
            $student->save();
            $response[0] = TRUE;
        } else {
            $response[0] = FALSE;
        }
        return $response;
    }

    public function unlockActivity(Request $request) {
        $user = $this->userRepository->findWithoutFail($request['idUser']);
        $oldPoints = $user->points;
        $oldTime = $user->active_time;

        $student = $user->myStudent;
        if (empty($user)) {
            Flash::error('Usuário não encontrado');

            return redirect(route('users.index'));
        }
        $adventure = $student->adventure;

        //Looks for the order of the module and activity the user just finished
        $module = Module::find($request['idModule']);
        $module->idAdventureForSearch = $adventure->id;
        $activity = Activity::find($request['idActivity']);
        $module->idAdventureForSearch = $adventure->id;

        $moduleOrder = $module->adventuresWithId;
        $moduleOrder = $moduleOrder[0]->pivot->order;
        $activity->idModuleForSearch = $module->id;
        $activityOrder = $activity->modulesWithId;
        $activityOrder = $activityOrder[0]->pivot->order;
        
        //Looks for the order of the module and activity the user last unlocked in the adventure
        $student->activity->idModuleForSearch = $student->module->id;
        $lastActivityUnlockedOrder = $student->activity->modulesWithId;
        $lastActivityUnlockedOrder = $lastActivityUnlockedOrder[0]->pivot->order;
        $student->module->idAdventureForSearch = $adventure->id;
        $lastModuleUnlockedOrder = $student->module->adventuresWithId;
        $lastModuleUnlockedOrder = $lastModuleUnlockedOrder[0]->pivot->order;

        $user->points+=3;
        $student->num_activities_ended+=1;
        $adventureEnded=0;
        $adventureDone = Adventure::whereHas('adventurersDone', function($q) use ($adventure, $student){
            $q->where('id_adventure', $adventure->id)->where('id_student', $student->id);
        })->with(['adventurersDone'=>function($q) use ($student){
            $q->where('id_student', $student->id);
        }])->get();

        if ($lastActivityUnlockedOrder == $activityOrder && $lastModuleUnlockedOrder == $moduleOrder) {
            $newActivity = Activity::whereHas('modules', function($q) use ($module, $lastActivityUnlockedOrder){
                $q->where('id_module', $module->id)->where('order', $lastActivityUnlockedOrder+1);
            })->get();
            if (!empty($newActivity[0])){
                $student->id_current_activity = $newActivity[0]->id;
            } else {
                $newModule = Module::whereHas('adventures', function($q) use ($adventure, $lastModuleUnlockedOrder){
                    $q->where('id_adventure', $adventure->id)->where('order', $lastModuleUnlockedOrder+1);
                })->get();
                if (!empty($newModule[0])) {
                    $student->id_current_module = $newModule[0]->id;
                    $student->id_current_activity = $newModule[0]->activities[0]->id;
                    $user->points+=3;
                    $student->num_modules_ended+=1;
                } else {
                    if (!$adventureDone[0]->adventurersDone[0]->pivot->ended){
                        $user->points+=6;
                    }
                    $adventureEnded = 1;
                }
            }
        }
        $moduleDone = Module::whereHas('adventurersDone', function($q) use ($module, $student){
            $q->where('id_module', $module->id)->where('id_student', $student->id);
        })->with(['adventurersDone'=>function($q) use ($student){
            $q->where('id_student', $student->id);
        }])->get();
        $activityDone = Activity::whereHas('adventurersDone', function($q) use ($activity, $student){
            $q->where('id_activity', $activity->id)->where('id_student', $student->id);
        })->with(['adventurersDone'=>function($q) use ($student){
            $q->where('id_student', $student->id);
        }])->get();

        if (count($adventureDone) >= 1) {
            if ($adventureEnded) {
                $adventureDone[0]->adventurersDone[0]->pivot->ended = $adventureEnded;
            }
            $adventureDone[0]->adventurersDone[0]->pivot->mistakes+=$request['mistakes'];
            $adventureDone[0]->adventurersDone[0]->pivot->save();
        } else {
            if ($adventureEnded) {
                $student->adventuresDone()->attach($student->id_current_adventure, ['mistakes'=>$request['mistakes'], 'ended'=>$adventureEnded]);
            } else {
                $student->adventuresDone()->attach($student->id_current_adventure, ['mistakes'=>$request['mistakes']]);
            } 
        }

        //Set the mistakes
        if(count($moduleDone) >= 1){
            $moduleDone[0]->adventurersDone[0]->pivot->mistakes+=$request['mistakes'];
            $moduleDone[0]->adventurersDone[0]->pivot->save();
        } else {
            $student->modulesDone()->attach($student->id_current_module, ['mistakes'=>$request['mistakes']]);
        }
        if(count($activityDone) >= 1){
            $activityDone[0]->adventurersDone[0]->pivot->mistakes+=$request['mistakes'];
            if (($activityDone[0]->adventurersDone[0]->pivot->minTime > $request['time']) || ($activityDone[0]->adventurersDone[0]->pivot->minTime == NULL)) {
               $activityDone[0]->adventurersDone[0]->pivot->minTime = $request['time'];
            } 
            if (($activityDone[0]->adventurersDone[0]->pivot->maxTime < $request['time']) || ($activityDone[0]->adventurersDone[0]->pivot->maxTime == NULL)) {
                $activityDone[0]->adventurersDone[0]->pivot->maxTime = $request['time'];
            }
            $activityDone[0]->adventurersDone[0]->pivot->save();
        } else {
            $student->activitiesDone()->attach($request['idActivity'], ['mistakes'=>$request['mistakes'], 'minTime'=>$request['time'], 'maxTime'=>$request['time']]);
        }
        $user->active_time+=$request['time'];

        $user->save();
        $student->save();

        return $this->verifyAchievements($oldPoints, $oldTime, $adventureEnded);
    }

    function verifyAchievements($oldPoints, $oldTime, $adventureEnded){
        $user = $this->userRepository->findWithoutFail(auth()->user()->id);
        $student = $user->myStudent;
        $unlockedAchievements = [];
        $unlockedAchievements[0] = $user->points-$oldPoints;
        //Conquistas relacionadas a pontos
        if ($user->points >= 40 && $oldPoints < 40) {
            $user->achievements()->attach(21);
            array_push($unlockedAchievements, 21);
        } elseif ($user->points >= 30 && $oldPoints < 30) {
            $user->achievements()->attach(20);
            array_push($unlockedAchievements, 20);
        } elseif ($user->points >= 20 && $oldPoints < 20) {
            $user->achievements()->attach(19);
            array_push($unlockedAchievements, 19);
        } elseif ($user->points >= 10 && $oldPoints < 10) {
            $user->achievements()->attach(18);
            array_push($unlockedAchievements, 18);
        }
        $minutos = 60;
        $horas = 60*$minutos;
        //Conquistas relacionadas a tempo
        if ($user->active_time >= 30*$minutos && $oldTime < 30*$minutos) {
            $user->achievements()->attach(22);
            array_push($unlockedAchievements, 22);
        } elseif ($user->points >= 1*$horas && $oldTime < 1*$horas) {
            $user->achievements()->attach(23);
            array_push($unlockedAchievements, 23);
        } elseif ($user->points >= 2*$horas && $oldTime < 2*$horas) {
            $user->achievements()->attach(24);
            array_push($unlockedAchievements, 24);
        } elseif ($user->points >= 4*$horas && $oldTime < 4*$horas) {
            $user->achievements()->attach(25);
            array_push($unlockedAchievements, 25);
        }

        //Conquistas relacionadas a completar atividades
        $adventuresDone = Adventure::whereHas('adventurersDone', function($q) use ($student){
            $q->where('ended', 1)->where('id_student', $student->id);
        })->get();
        if ($adventureEnded && count($adventuresDone) == 5) {
            $user->achievements()->attach(17);
            array_push($unlockedAchievements, 17);
        } elseif ($adventureEnded && count($adventuresDone) == 1 && count($user->achievements->where('id', 16)) == 0) {
            $user->achievements()->attach(16);
            array_push($unlockedAchievements, 16);
        } elseif ($student->num_modules_ended == 1 && count($user->achievements->where('id', 15)) == 0) {
            $user->achievements()->attach(15);
            array_push($unlockedAchievements, 15);
        } elseif ($student->num_activities_ended == 1) {
            $user->achievements()->attach(14);
            array_push($unlockedAchievements, 14);
        }

        return $unlockedAchievements;
    }

    public function changeActiveAchievement(Request $request){
        $user = auth()->user();
        $user->id_active_achievement = $request['id'];
        $user->save();
    }
}
