<?php

namespace App\Http\Controllers;

use App\DataTables\BeritaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use App\Repositories\BeritaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class BeritaController extends AppBaseController
{
    /** @var  BeritaRepository */
    private $beritaRepository;

    public function __construct(BeritaRepository $beritaRepo)
    {
        $this->beritaRepository = $beritaRepo;
    }

    /**
     * Display a listing of the Berita.
     *
     * @param BeritaDataTable $beritaDataTable
     * @return Response
     */
    public function index(BeritaDataTable $beritaDataTable)
    {
        return $beritaDataTable->render('beritas.index');
    }

    /**
     * Show the form for creating a new Berita.
     *
     * @return Response
     */
    public function create()
    {
        return view('beritas.create');
    }

    /**
     * Store a newly created Berita in storage.
     *
     * @param CreateBeritaRequest $request
     *
     * @return Response
     */
    public function store(CreateBeritaRequest $request)
    {
        $input = $request->all();

        $berita = $this->beritaRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/beritas.singular')]));

        return redirect(route('beritas.index'));
    }

    /**
     * Display the specified Berita.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $berita = $this->beritaRepository->find($id);

        if (empty($berita)) {
            Flash::error(__('messages.not_found', ['model' => __('models/beritas.singular')]));

            return redirect(route('beritas.index'));
        }

        return view('beritas.show')->with('berita', $berita);
    }

    /**
     * Show the form for editing the specified Berita.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $berita = $this->beritaRepository->find($id);

        if (empty($berita)) {
            Flash::error(__('messages.not_found', ['model' => __('models/beritas.singular')]));

            return redirect(route('beritas.index'));
        }

        return view('beritas.edit')->with('berita', $berita);
    }

    /**
     * Update the specified Berita in storage.
     *
     * @param  int              $id
     * @param UpdateBeritaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBeritaRequest $request)
    {
        $berita = $this->beritaRepository->find($id);

        if (empty($berita)) {
            Flash::error(__('messages.not_found', ['model' => __('models/beritas.singular')]));

            return redirect(route('beritas.index'));
        }

        $berita = $this->beritaRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/beritas.singular')]));

        return redirect(route('beritas.index'));
    }

    /**
     * Remove the specified Berita from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $berita = $this->beritaRepository->find($id);

        if (empty($berita)) {
            Flash::error(__('messages.not_found', ['model' => __('models/beritas.singular')]));

            return redirect(route('beritas.index'));
        }

        $this->beritaRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/beritas.singular')]));

        return redirect(route('beritas.index'));
    }
}
