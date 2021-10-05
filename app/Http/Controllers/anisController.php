<?php

namespace App\Http\Controllers;

use App\DataTables\anisDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateanisRequest;
use App\Http\Requests\UpdateanisRequest;
use App\Repositories\anisRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class anisController extends AppBaseController
{
    /** @var  anisRepository */
    private $anisRepository;

    public function __construct(anisRepository $anisRepo)
    {
        $this->anisRepository = $anisRepo;
    }

    /**
     * Display a listing of the anis.
     *
     * @param anisDataTable $anisDataTable
     * @return Response
     */
    public function index(anisDataTable $anisDataTable)
    {
        return $anisDataTable->render('anis.index');
    }

    /**
     * Show the form for creating a new anis.
     *
     * @return Response
     */
    public function create()
    {
        return view('anis.create');
    }

    /**
     * Store a newly created anis in storage.
     *
     * @param CreateanisRequest $request
     *
     * @return Response
     */
    public function store(CreateanisRequest $request)
    {
        $input = $request->all();

        $anis = $this->anisRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/anis.singular')]));

        return redirect(route('anis.index'));
    }

    /**
     * Display the specified anis.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $anis = $this->anisRepository->find($id);

        if (empty($anis)) {
            Flash::error(__('messages.not_found', ['model' => __('models/anis.singular')]));

            return redirect(route('anis.index'));
        }

        return view('anis.show')->with('anis', $anis);
    }

    /**
     * Show the form for editing the specified anis.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $anis = $this->anisRepository->find($id);

        if (empty($anis)) {
            Flash::error(__('messages.not_found', ['model' => __('models/anis.singular')]));

            return redirect(route('anis.index'));
        }

        return view('anis.edit')->with('anis', $anis);
    }

    /**
     * Update the specified anis in storage.
     *
     * @param  int              $id
     * @param UpdateanisRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateanisRequest $request)
    {
        $anis = $this->anisRepository->find($id);

        if (empty($anis)) {
            Flash::error(__('messages.not_found', ['model' => __('models/anis.singular')]));

            return redirect(route('anis.index'));
        }

        $anis = $this->anisRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/anis.singular')]));

        return redirect(route('anis.index'));
    }

    /**
     * Remove the specified anis from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $anis = $this->anisRepository->find($id);

        if (empty($anis)) {
            Flash::error(__('messages.not_found', ['model' => __('models/anis.singular')]));

            return redirect(route('anis.index'));
        }

        $this->anisRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/anis.singular')]));

        return redirect(route('anis.index'));
    }
}
