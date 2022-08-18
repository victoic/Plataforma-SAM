<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Repositories\TeacherRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TeacherController extends InfyOmBaseController
{
    /** @var  TeacherRepository */
    private $teacherRepository;

    public function __construct(TeacherRepository $teacherRepo)
    {
        $this->teacherRepository = $teacherRepo;
    }

    /**
     * Display a listing of the Teacher.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->teacherRepository->pushCriteria(new RequestCriteria($request));
        $teachers = $this->teacherRepository->all();

        return view('teachers.index')
            ->with('teachers', $teachers);
    }

    /**
     * Show the form for creating a new Teacher.
     *
     * @return Response
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created Teacher in storage.
     *
     * @param CreateTeacherRequest $request
     *
     * @return Response
     */
    public function store(CreateTeacherRequest $request)
    {
        $input = $request->all();

        $teacher = $this->teacherRepository->create($input);

        Flash::success('Teacher saved successfully.');

        return redirect(route('teachers.index'));
    }

    /**
     * Display the specified Teacher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $teacher = $this->teacherRepository->findWithoutFail($id);

        if (empty($teacher)) {
            Flash::error('Teacher not found');

            return redirect(route('teachers.index'));
        }

        return view('teachers.show')->with('teacher', $teacher);
    }

    /**
     * Show the form for editing the specified Teacher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $teacher = $this->teacherRepository->findWithoutFail($id);

        if (empty($teacher)) {
            Flash::error('Teacher not found');

            return redirect(route('teachers.index'));
        }

        return view('teachers.edit')->with('teacher', $teacher);
    }

    /**
     * Update the specified Teacher in storage.
     *
     * @param  int              $id
     * @param UpdateTeacherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTeacherRequest $request)
    {
        $teacher = $this->teacherRepository->findWithoutFail($id);

        if (empty($teacher)) {
            Flash::error('Teacher not found');

            return redirect(route('teachers.index'));
        }

        $teacher = $this->teacherRepository->update($request->all(), $id);

        Flash::success('Teacher updated successfully.');

        return redirect(route('teachers.index'));
    }

    /**
     * Remove the specified Teacher from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $teacher = $this->teacherRepository->findWithoutFail($id);

        if (empty($teacher)) {
            Flash::error('Teacher not found');

            return redirect(route('teachers.index'));
        }

        $this->teacherRepository->delete($id);

        Flash::success('Teacher deleted successfully.');

        return redirect(route('teachers.index'));
    }
}
