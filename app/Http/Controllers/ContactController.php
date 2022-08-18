<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Repositories\ContactRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\User;
use App\Models\Adventure;

class ContactController extends InfyOmBaseController
{
    /** @var  ContactRepository */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepository = $contactRepo;
    }

    /**
     * Display a listing of the Contact.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contactRepository->pushCriteria(new RequestCriteria($request));
        $contacts = $this->contactRepository->all();

        return view('contacts.index')
            ->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new Contact.
     *
     * @return Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created Contact in storage.
     *
     * @param CreateContactRequest $request
     *
     * @return Response
     */
    public function store(CreateContactRequest $request)
    {
        $input = $request->all();

        $contact = $this->contactRepository->create($input);

        Flash::success('Contact saved successfully.');

        $user = User::find(auth()->user()->id);
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

    /**
     * Display the specified Contact.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contact = $this->contactRepository->findWithoutFail($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        return view('contacts.show')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified Contact.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contact = $this->contactRepository->findWithoutFail($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        return view('contacts.edit')->with('contact', $contact);
    }

    /**
     * Update the specified Contact in storage.
     *
     * @param  int              $id
     * @param UpdateContactRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactRequest $request)
    {
        $contact = $this->contactRepository->findWithoutFail($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        $contact = $this->contactRepository->update($request->all(), $id);

        Flash::success('Contact updated successfully.');

        return redirect(route('contacts.index'));
    }

    /**
     * Remove the specified Contact from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contact = $this->contactRepository->findWithoutFail($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        $this->contactRepository->delete($id);

        Flash::success('Contact deleted successfully.');

        return redirect(route('contacts.index'));
    }
}
