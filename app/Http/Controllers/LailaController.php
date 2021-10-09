<?php

namespace App\Http\Controllers;

use App\DataTables\LailaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLailaRequest;
use App\Http\Requests\UpdateLailaRequest;
use App\Repositories\LailaRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class LailaController extends AppBaseController
{
    /** @var  LailaRepository */
    private $lailaRepository;

    public function __construct(LailaRepository $lailaRepo)
    {
        $this->lailaRepository = $lailaRepo;
    }

    /**
     * Display a listing of the Laila.
     *
     * @param LailaDataTable $lailaDataTable
     * @return Response
     */
    public function index(LailaDataTable $lailaDataTable)
    {
        return $lailaDataTable->render('lailas.index');
    }

    /**
     * Show the form for creating a new Laila.
     *
     * @return Response
     */
    public function create()
    {
        return view('lailas.create');
    }

    /**
     * Store a newly created Laila in storage.
     *
     * @param CreateLailaRequest $request
     *
     * @return Response
     */
    public function store(CreateLailaRequest $request)
    {
        $input = $request->all();

        $laila = $this->lailaRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/lailas.singular')]));

        return redirect(route('lailas.index'));
    }

    /**
     * Display the specified Laila.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $laila = $this->lailaRepository->find($id);

        if (empty($laila)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lailas.singular')]));

            return redirect(route('lailas.index'));
        }

        return view('lailas.show')->with('laila', $laila);
    }

    /**
     * Show the form for editing the specified Laila.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $laila = $this->lailaRepository->find($id);

        if (empty($laila)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lailas.singular')]));

            return redirect(route('lailas.index'));
        }

        return view('lailas.edit')->with('laila', $laila);
    }

    /**
     * Update the specified Laila in storage.
     *
     * @param  int              $id
     * @param UpdateLailaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLailaRequest $request)
    {
        $laila = $this->lailaRepository->find($id);

        if (empty($laila)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lailas.singular')]));

            return redirect(route('lailas.index'));
        }

        $laila = $this->lailaRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/lailas.singular')]));

        return redirect(route('lailas.index'));
    }

    /**
     * Remove the specified Laila from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $laila = $this->lailaRepository->find($id);

        if (empty($laila)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lailas.singular')]));

            return redirect(route('lailas.index'));
        }

        $this->lailaRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/lailas.singular')]));

        return redirect(route('lailas.index'));
    }
}
