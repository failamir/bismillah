<?php

namespace App\Http\Controllers;

use App\DataTables\PembiayaanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePembiayaanRequest;
use App\Http\Requests\UpdatePembiayaanRequest;
use App\Repositories\PembiayaanRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PembiayaanController extends AppBaseController
{
    /** @var  PembiayaanRepository */
    private $pembiayaanRepository;

    public function __construct(PembiayaanRepository $pembiayaanRepo)
    {
        $this->pembiayaanRepository = $pembiayaanRepo;
    }

    /**
     * Display a listing of the Pembiayaan.
     *
     * @param PembiayaanDataTable $pembiayaanDataTable
     * @return Response
     */
    public function index(PembiayaanDataTable $pembiayaanDataTable)
    {
        return $pembiayaanDataTable->render('pembiayaans.index');
    }

    /**
     * Show the form for creating a new Pembiayaan.
     *
     * @return Response
     */
    public function create()
    {
        return view('pembiayaans.create');
    }

    /**
     * Store a newly created Pembiayaan in storage.
     *
     * @param CreatePembiayaanRequest $request
     *
     * @return Response
     */
    public function store(CreatePembiayaanRequest $request)
    {
        $input = $request->all();

        $pembiayaan = $this->pembiayaanRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/pembiayaans.singular')]));

        return redirect(route('pembiayaans.index'));
    }

    /**
     * Display the specified Pembiayaan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pembiayaan = $this->pembiayaanRepository->find($id);

        if (empty($pembiayaan)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pembiayaans.singular')]));

            return redirect(route('pembiayaans.index'));
        }

        return view('pembiayaans.show')->with('pembiayaan', $pembiayaan);
    }

    /**
     * Show the form for editing the specified Pembiayaan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pembiayaan = $this->pembiayaanRepository->find($id);

        if (empty($pembiayaan)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pembiayaans.singular')]));

            return redirect(route('pembiayaans.index'));
        }

        return view('pembiayaans.edit')->with('pembiayaan', $pembiayaan);
    }

    /**
     * Update the specified Pembiayaan in storage.
     *
     * @param  int              $id
     * @param UpdatePembiayaanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePembiayaanRequest $request)
    {
        $pembiayaan = $this->pembiayaanRepository->find($id);

        if (empty($pembiayaan)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pembiayaans.singular')]));

            return redirect(route('pembiayaans.index'));
        }

        $pembiayaan = $this->pembiayaanRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/pembiayaans.singular')]));

        return redirect(route('pembiayaans.index'));
    }

    /**
     * Remove the specified Pembiayaan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pembiayaan = $this->pembiayaanRepository->find($id);

        if (empty($pembiayaan)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pembiayaans.singular')]));

            return redirect(route('pembiayaans.index'));
        }

        $this->pembiayaanRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/pembiayaans.singular')]));

        return redirect(route('pembiayaans.index'));
    }
}
