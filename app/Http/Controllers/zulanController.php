<?php

namespace App\Http\Controllers;

use App\DataTables\zulanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatezulanRequest;
use App\Http\Requests\UpdatezulanRequest;
use App\Repositories\zulanRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class zulanController extends AppBaseController
{
    /** @var  zulanRepository */
    private $zulanRepository;

    public function __construct(zulanRepository $zulanRepo)
    {
        $this->zulanRepository = $zulanRepo;
    }

    /**
     * Display a listing of the zulan.
     *
     * @param zulanDataTable $zulanDataTable
     * @return Response
     */
    public function index(zulanDataTable $zulanDataTable)
    {
        return $zulanDataTable->render('zulans.index');
    }

    /**
     * Show the form for creating a new zulan.
     *
     * @return Response
     */
    public function create()
    {
        return view('zulans.create');
    }

    /**
     * Store a newly created zulan in storage.
     *
     * @param CreatezulanRequest $request
     *
     * @return Response
     */
    public function store(CreatezulanRequest $request)
    {
        $input = $request->all();

        $zulan = $this->zulanRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/zulans.singular')]));

        return redirect(route('zulans.index'));
    }

    /**
     * Display the specified zulan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $zulan = $this->zulanRepository->find($id);

        if (empty($zulan)) {
            Flash::error(__('messages.not_found', ['model' => __('models/zulans.singular')]));

            return redirect(route('zulans.index'));
        }

        return view('zulans.show')->with('zulan', $zulan);
    }

    /**
     * Show the form for editing the specified zulan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $zulan = $this->zulanRepository->find($id);

        if (empty($zulan)) {
            Flash::error(__('messages.not_found', ['model' => __('models/zulans.singular')]));

            return redirect(route('zulans.index'));
        }

        return view('zulans.edit')->with('zulan', $zulan);
    }

    /**
     * Update the specified zulan in storage.
     *
     * @param  int              $id
     * @param UpdatezulanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatezulanRequest $request)
    {
        $zulan = $this->zulanRepository->find($id);

        if (empty($zulan)) {
            Flash::error(__('messages.not_found', ['model' => __('models/zulans.singular')]));

            return redirect(route('zulans.index'));
        }

        $zulan = $this->zulanRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/zulans.singular')]));

        return redirect(route('zulans.index'));
    }

    /**
     * Remove the specified zulan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $zulan = $this->zulanRepository->find($id);

        if (empty($zulan)) {
            Flash::error(__('messages.not_found', ['model' => __('models/zulans.singular')]));

            return redirect(route('zulans.index'));
        }

        $this->zulanRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/zulans.singular')]));

        return redirect(route('zulans.index'));
    }
}
