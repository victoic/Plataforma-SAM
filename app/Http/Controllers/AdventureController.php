<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateAdventureRequest;
use App\Http\Requests\UpdateAdventureRequest;
use App\Repositories\AdventureRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Topic;
use App\Models\Module;
use App\Models\Activity;
use App\Models\Exercise;
use App\Models\Adventure;
use App\Models\User;

class AdventureController extends InfyOmBaseController
{
    /** @var  AdventureRepository */
    private $adventureRepository;

    public function __construct(AdventureRepository $adventureRepo)
    {
        $this->middleware('auth');
        $this->adventureRepository = $adventureRepo;
    }

    /**
     * Display a listing of the Adventure.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $adventures = Adventure::with(["modules.activities.topic", "modules.activities.creator", "creator.user", "teachers"=>function($q){
            $user = User::find(auth()->user()->id);
            $q->where('id_teacher', '=', $user->myTeacher->id);
        }])->where('id_creator', '<>', $user->myTeacher->id)->get();

        return view('adventures.index')
            ->with('adventures', $adventures);
    }

    /**
     * Show the form for creating a new Adventure.
     *
     * @return Response
     */
    public function create()
    {
        $modules = Module::with('activities')->get();
        $topics = Topic::pluck('name', 'id')->prepend('Selecione um tópico', '');
        $activities = Activity::with('exercises')->get();
        $exercises = Exercise::all();
        $user = User::find(auth()->user()->id);
        return view('adventures.create')->with('topics', $topics)->with('modules', $modules)->with('activities', $activities)->with('exercises', $exercises)->with('user', $user);
    }

    /**
     * Store a newly created Adventure in storage.
     *
     * @param CreateAdventureRequest $request
     *
     * @return Response
     */
    public function store(CreateAdventureRequest $request)
    {
        $input = $request->all();

        $adventure = $this->adventureRepository->create($input);

        Flash::success('Adventure saved successfully.');

        return redirect(route('adventures.index'));
    }
    public function storeAjax(Request $request){
        $values = json_decode($request['data']);
        $adventure = new Adventure;
        $adventure->name = $values->adventure->name;
        $adventure->description = $values->adventure->description;
        $adventure->story = $values->adventure->story;
        $adventure->id_creator = $values->adventure->id_creator;
        $adventure->save();

        foreach ($values->modules as $key => $value) {
            $adventure->modules()->attach($value->id, ['order'=> $value->order]);
        }
        return $adventure->id;
    }

    /**
     * Display the specified Adventure.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $adventure = $this->adventureRepository->findWithoutFail($id);

        if (empty($adventure)) {
            Flash::error('Adventure not found');

            return redirect(route('adventures.index'));
        }

        return view('adventures.show')->with('adventure', $adventure);
    }

    /**
     * Show the form for editing the specified Adventure.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $adventure = $this->adventureRepository->findWithoutFail($id);

        if (empty($adventure)) {
            Flash::error('Adventure not found');

            return redirect(route('adventures.index'));
        }

        return view('adventures.edit')->with('adventure', $adventure);
    }

    /**
     * Update the specified Adventure in storage.
     *
     * @param  int              $id
     * @param UpdateAdventureRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdventureRequest $request)
    {
        $adventure = $this->adventureRepository->findWithoutFail($id);

        if (empty($adventure)) {
            Flash::error('Adventure not found');

            return redirect(route('adventures.index'));
        }

        $adventure = $this->adventureRepository->update($request->all(), $id);

        Flash::success('Adventure updated successfully.');

        return redirect(route('adventures.index'));
    }

    /**
     * Remove the specified Adventure from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $adventure = $this->adventureRepository->findWithoutFail($id);

        if (empty($adventure)) {
            Flash::error('Adventure not found');

            return redirect(route('adventures.index'));
        }

        $this->adventureRepository->delete($id);

        Flash::success('Adventure deleted successfully.');

        return redirect(route('adventures.index'));
    }
}
