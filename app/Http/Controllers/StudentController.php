<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Repositories\StudentRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Adventure;
use App\Models\Module;
use App\Models\Activity;
use App\Models\User;

class StudentController extends InfyOmBaseController
{
    /** @var  StudentRepository */
    private $studentRepository;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepository = $studentRepo;
    }

    /**
     * Display a listing of the Student.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->studentRepository->pushCriteria(new RequestCriteria($request));
        $students = $this->studentRepository->all();

        return view('students.index')
            ->with('students', $students);
    }

    /**
     * Show the form for creating a new Student.
     *
     * @return Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created Student in storage.
     *
     * @param CreateStudentRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentRequest $request)
    {
        $input = $request->all();

        $student = $this->studentRepository->create($input);

        Flash::success('Student saved successfully.');

        return redirect(route('students.index'));
    }

    /**
     * Display the specified Student.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        return view('students.show')->with('student', $student);
    }

    /**
     * Show the form for editing the specified Student.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        return view('students.edit')->with('student', $student);
    }

    public function changeAdventure(Request $request){
        $user = User::find(auth()->user()->id);
        $idAdventure = ($request['val']);
        $student = $user->myStudent;
        $isDone = Adventure::whereHas('adventurersDone', function($q) use($idAdventure, $student) {
            $q->where('id_adventure', $idAdventure)->where('id_student', $student->id);
        })->with(['adventurersDone'=>function($q) use ($student){
            $q->where('id_student', $student->id);
        }])->get();
        error_log(print_r($isDone));
        if (!empty($isDone[0])){
            $isDone = $isDone[0]->adventurersDone[0]->pivot->ended;
            $student->adventure_ended = $isDone;
        }
        $adventure = Adventure::find($idAdventure);
        $module = $adventure->modules[0];
        $activity = $module->activities[0];
        $student->id_current_adventure = $adventure->id;
        $student->id_current_module = $module->id;
        $student->id_current_activity = $activity->id;
        $student->save();
    }

    public function setMistakes(Request $request){
        $module = Module::find($request['idModule']);
        $activity = Activity::find($request['idActivity']);
        $student = User::find(auth()->user()->id)->myStudent;
        $adventure = $student->adventure;

        $adventureDone = Adventure::whereHas('adventurersDone', function($q) use ($adventure, $student){
            $q->where('id_adventure', $adventure->id)->where('id_student', $student->id);
        })->with(['adventurersDone'=>function($q) use ($student){
            $q->where('id_student', $student->id);
        }])->get();
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
            $adventureDone[0]->adventurersDone[0]->pivot->mistakes+=$request['mistakes'];
            $adventureDone[0]->adventurersDone[0]->pivot->save();
        } else {
            $student->adventuresDone()->attach($student->id_current_adventure, ['mistakes'=>$request['mistakes']]);
        }
        if(count($moduleDone) >= 1){
            $moduleDone[0]->adventurersDone[0]->pivot->mistakes+=$request['mistakes'];
            $moduleDone[0]->adventurersDone[0]->pivot->save();
        } else {
            $student->modulesDone()->attach($student->id_current_module, ['mistakes'=>$request['mistakes']]);
        }
        if(count($activityDone) >= 1){
            $activityDone[0]->adventurersDone[0]->pivot->mistakes+=$request['mistakes'];
            $activityDone[0]->adventurersDone[0]->pivot->save();
        } else {
            $student->activitiesDone()->attach($student->id_current_activity, ['mistakes'=>$request['mistakes']]);
        }
        $user = $student->user;
        $user->active_time+=$request['time'];
        $user->save();
    }

    /**
     * Update the specified Student in storage.
     *
     * @param  int              $id
     * @param UpdateStudentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentRequest $request)
    {
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        $student = $this->studentRepository->update($request->all(), $id);

        Flash::success('Student updated successfully.');

        return redirect(route('students.index'));
    }

    /**
     * Remove the specified Student from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        $this->studentRepository->delete($id);

        Flash::success('Student deleted successfully.');

        return redirect(route('students.index'));
    }
}
