<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateAlternativeRequest;
use App\Http\Requests\UpdateAlternativeRequest;
use App\Repositories\AlternativeRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AlternativeController extends InfyOmBaseController
{
    /** @var  AlternativeRepository */
    private $alternativeRepository;

    public function __construct(AlternativeRepository $alternativeRepo)
    {
        $this->alternativeRepository = $alternativeRepo;
    }

    /**
     * Display a listing of the Alternative.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->alternativeRepository->pushCriteria(new RequestCriteria($request));
        $alternatives = $this->alternativeRepository->all();

        return view('alternatives.index')
            ->with('alternatives', $alternatives);
    }

    /**
     * Show the form for creating a new Alternative.
     *
     * @return Response
     */
    public function create()
    {
        return view('alternatives.create');
    }

    /**
     * Store a newly created Alternative in storage.
     *
     * @param CreateAlternativeRequest $request
     *
     * @return Response
     */
    public function store(CreateAlternativeRequest $request)
    {
        $input = $request->all();

        $alternative = $this->alternativeRepository->create($input);

        Flash::success('Alternative saved successfully.');

        return redirect(route('alternatives.index'));
    }

    /**
     * Display the specified Alternative.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $alternative = $this->alternativeRepository->findWithoutFail($id);

        if (empty($alternative)) {
            Flash::error('Alternative not found');

            return redirect(route('alternatives.index'));
        }

        return view('alternatives.show')->with('alternative', $alternative);
    }

    /**
     * Show the form for editing the specified Alternative.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $alternative = $this->alternativeRepository->findWithoutFail($id);

        if (empty($alternative)) {
            Flash::error('Alternative not found');

            return redirect(route('alternatives.index'));
        }

        return view('alternatives.edit')->with('alternative', $alternative);
    }

    /**
     * Update the specified Alternative in storage.
     *
     * @param  int              $id
     * @param UpdateAlternativeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAlternativeRequest $request)
    {
        $alternative = $this->alternativeRepository->findWithoutFail($id);

        if (empty($alternative)) {
            Flash::error('Alternative not found');

            return redirect(route('alternatives.index'));
        }

        $alternative = $this->alternativeRepository->update($request->all(), $id);

        Flash::success('Alternative updated successfully.');

        return redirect(route('alternatives.index'));
    }

    /**
     * Remove the specified Alternative from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $alternative = $this->alternativeRepository->findWithoutFail($id);

        if (empty($alternative)) {
            Flash::error('Alternative not found');

            return redirect(route('alternatives.index'));
        }

        $this->alternativeRepository->delete($id);

        Flash::success('Alternative deleted successfully.');

        return redirect(route('alternatives.index'));
    }
}
