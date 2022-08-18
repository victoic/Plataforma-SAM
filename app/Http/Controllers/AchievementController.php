<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;
use App\Repositories\AchievementRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Intervention\Image\ImageManagerStatic as Image;
use finfo;
use App\Models\Achievement;
class AchievementController extends InfyOmBaseController
{
    /** @var  AchievementRepository */
    private $achievementRepository;

    public function __construct(AchievementRepository $achievementRepo)
    {
        $this->middleware('auth');
        $this->achievementRepository = $achievementRepo;
    }

    /**
     * Display a listing of the Achievement.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->achievementRepository->pushCriteria(new RequestCriteria($request));
        $achievements = $this->achievementRepository->all();

        return view('achievements.index')
            ->with('achievements', $achievements);
    }

    /**
     * Show the form for creating a new Achievement.
     *
     * @return Response
     */
    public function create()
    {
        return view('achievements.create');
    }

    /**
     * Store a newly created Achievement in storage.
     *
     * @param CreateAchievementRequest $request
     *
     * @return Response
     */
    public function store(CreateAchievementRequest $request)
    {
        $icon = Image::make($request->file('icon')->getRealPath());
        $achievement = new Achievement;
        $achievement->name = $request->dataAchievement['name'];
        $achievement->description = $request->dataAchievement['description'];
        $achievement->points = $request->dataAchievement['points'];
        $filename = strtolower($achievement->name) . '.' . $request->file('icon')->getClientOriginalExtension();
        $path = base_path() . '/public/images/achievements/';
        $request->file('icon')->move(
            $path, $filename
        );
        $achievement->icon = $filename;
        $achievement->save();
        Flash::success('Conquista salva com sucesso.');
    }

    /**
     * Display the specified Achievement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $achievement = $this->achievementRepository->findWithoutFail($id);

        if (empty($achievement)) {
            Flash::error('Achievement not found');

            return redirect(route('achievements.index'));
        }

        return view('achievements.show')->with('achievement', $achievement);
    }

    /**
     * Show the form for editing the specified Achievement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $achievement = $this->achievementRepository->findWithoutFail($id);

        if (empty($achievement)) {
            Flash::error('Achievement not found');

            return redirect(route('achievements.index'));
        }

        return view('achievements.edit')->with('achievement', $achievement);
    }

    /**
     * Update the specified Achievement in storage.
     *
     * @param  int              $id
     * @param UpdateAchievementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAchievementRequest $request)
    {
        $achievement = $this->achievementRepository->findWithoutFail($id);

        if (empty($achievement)) {
            Flash::error('Achievement not found');

            return redirect(route('achievements.index'));
        }

        $achievement = $this->achievementRepository->update($request->all(), $id);

        Flash::success('Achievement updated successfully.');

        return redirect(route('achievements.index'));
    }

    /**
     * Remove the specified Achievement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $achievement = $this->achievementRepository->findWithoutFail($id);

        if (empty($achievement)) {
            Flash::error('Achievement not found');

            return redirect(route('achievements.index'));
        }

        $this->achievementRepository->delete($id);

        Flash::success('Achievement deleted successfully.');

        return redirect(route('achievements.index'));
    }
}
