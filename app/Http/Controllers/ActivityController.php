<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Repositories\ActivityRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;

use App\Models\Activity;
use App\Models\Exercise;
use App\Models\Alternative;
use App\Models\Topic;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\User;
use App\Models\Monster;
use App\Models\Achievement;
class ActivityController extends InfyOmBaseController
{
    /** @var  ActivityRepository */
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepo)
    {
        $this->middleware('auth');
        $this->activityRepository = $activityRepo;
    }

    /**
     * Display a listing of the Activity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->activityRepository->pushCriteria(new RequestCriteria($request));
        $activities = $this->activityRepository->all();

        return view('activities.index')
            ->with('activities', $activities);
    }

    /**
     * Show the form for creating a new Activity.
     *
     * @return Response
     */
    public function create()
    {
        $topics = Topic::pluck('name', 'id');
        $user = User::find(auth()->user()->id);
        return view('activities.create')->with('topics', $topics)->with('user', $user);
    }

    /**
     * Store a newly created Activity in storage.
     *
     * @param CreateActivityRequest $request
     *
     * @return Response
     */
    public function store(CreateActivityRequest $request)
    {
        $input = $request->all();

        $activity = $this->activityRepository->create($input);

        Flash::success('Atividade salva com sucesso');

        return redirect(route('activities.index'));
    }

    /**
     * Store a activity sent by JQuery Ajax
     *
    */
    public function storeAjax(Request $request){
        $values = json_decode($request['data']);
        $topic = Topic::where('id', $values->activity->id_topic)->first();
        $activity = new Activity;
        $activity->description = $values->activity->description;
        $activity->id_topic = $topic->id;
        $activity->id_creator = $values->activity->id_creator;
        $activity->save();
        foreach ($values->exercises as $keyExercise => $valueExercise) {
            $exercise = new Exercise;
            $exercise->stem = $valueExercise->stem;
            $exercise->type = $valueExercise->type;
            $exercise->image1_alt = $valueExercise->image_alt;
            $exercise->id_activity = $activity->id;
            $exercise->save();
            if(!empty($valueExercise->alternatives)) {
                foreach ($valueExercise->alternatives as $keyAlternative => $valueAlternative) {
                    $alternative = new Alternative;
                    $alternative->text = $valueAlternative->text;
                    if ($valueExercise->type == 1) {
                        $alternative->right = $valueAlternative->right;
                    } elseif ($valueExercise->type == 2) {
                        $alternative->right = TRUE;
                    }
                    $alternative->id_exercise = $exercise->id;
                    $alternative->save();
                }
            }
        }
        echo ($activity->id);
    }

    public function addImage(Request $request){
        $dataImg = $request->dataImg;
        $activity = Activity::find($dataImg['idActivity']);
        $exercise = $activity->exercises[$dataImg['indexExercise']];
        
        $filename = $exercise->id . '.' . $request->file('file')->getClientOriginalExtension();
        $path = base_path() . '/public/images/exercises/';
        $request->file('file')->move(
            $path, $filename
        );
        $exercise->image1 = $filename;
        $exercise->save();
    }

    /**
     * Display the specified Activity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($idActivity, $idModule)
    {
        $activity = Activity::with('exercises.alternatives')->where('id', $idActivity)->first();
        if (empty($activity)) {
            Flash::error('Atividade n«ªo encontrada');
            return redirect(route('activities.index'));
        }
        $monsters = Monster::all();
        $monsters = $monsters->shuffle();
        $activity->exercises = $activity->exercises->shuffle();
        $activity->exercises = $activity->exercises->slice(0, 5);
        $user = User::find(auth()->user()->id);
        $achievements = Achievement::all();
        return view('activities.show')->with('activity', $activity)->with('user', $user)->with('monster', $monsters[0])->with('idModule', $idModule)->with('achievements', $achievements);
    }

    /**
     * Show the form for editing the specified Activity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activity = $this->activityRepository->findWithoutFail($id);
        if (empty($activity)) {
            Flash::error('Activity not found');
            return redirect(route('activities.index'));
        }
        return view('activities.edit')->with('activity', $activity);
    }

    /**
     * Update the specified Activity in storage.
     *
     * @param  int              $id
     * @param UpdateActivityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivityRequest $request)
    {
        $activity = $this->activityRepository->findWithoutFail($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(route('activities.index'));
        }

        $activity = $this->activityRepository->update($request->all(), $id);

        Flash::success('Activity updated successfully.');

        return redirect(route('activities.index'));
    }

    /**
     * Remove the specified Activity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $activity = $this->activityRepository->findWithoutFail($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(route('activities.index'));
        }

        $this->activityRepository->delete($id);

        Flash::success('Activity deleted successfully.');

        return redirect(route('activities.index'));
    }
}
