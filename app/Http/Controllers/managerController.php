<?php

namespace App\Http\Controllers;

use App\DataTables\managerDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemanagerRequest;
use App\Http\Requests\UpdatemanagerRequest;
use App\Repositories\managerRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class managerController extends AppBaseController
{
    /** @var  managerRepository */
    private $managerRepository;

    public function __construct(managerRepository $managerRepo)
    {
        $this->managerRepository = $managerRepo;
    }

    /**
     * Display a listing of the manager.
     *
     * @param managerDataTable $managerDataTable
     * @return Response
     */
    public function index(managerDataTable $managerDataTable)
    {
        return $managerDataTable->render('managers.index');
    }

    /**
     * Show the form for creating a new manager.
     *
     * @return Response
     */
    public function create()
    {
        return view('managers.create');
    }

    /**
     * Store a newly created manager in storage.
     *
     * @param CreatemanagerRequest $request
     *
     * @return Response
     */
    public function store(CreatemanagerRequest $request)
    {
        $input = $request->all();

        $manager = $this->managerRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/managers.singular')]));

        return redirect(route('managers.index'));
    }

    /**
     * Display the specified manager.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $manager = $this->managerRepository->find($id);

        if (empty($manager)) {
            Flash::error(__('messages.not_found', ['model' => __('models/managers.singular')]));

            return redirect(route('managers.index'));
        }

        return view('managers.show')->with('manager', $manager);
    }

    /**
     * Show the form for editing the specified manager.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $manager = $this->managerRepository->find($id);

        if (empty($manager)) {
            Flash::error(__('messages.not_found', ['model' => __('models/managers.singular')]));

            return redirect(route('managers.index'));
        }

        return view('managers.edit')->with('manager', $manager);
    }

    /**
     * Update the specified manager in storage.
     *
     * @param  int              $id
     * @param UpdatemanagerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemanagerRequest $request)
    {
        $manager = $this->managerRepository->find($id);

        if (empty($manager)) {
            Flash::error(__('messages.not_found', ['model' => __('models/managers.singular')]));

            return redirect(route('managers.index'));
        }

        $manager = $this->managerRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/managers.singular')]));

        return redirect(route('managers.index'));
    }

    /**
     * Remove the specified manager from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $manager = $this->managerRepository->find($id);

        if (empty($manager)) {
            Flash::error(__('messages.not_found', ['model' => __('models/managers.singular')]));

            return redirect(route('managers.index'));
        }

        $this->managerRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/managers.singular')]));

        return redirect(route('managers.index'));
    }
}
