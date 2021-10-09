<?php

namespace App\Http\Controllers;

use App\DataTables\contohDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecontohRequest;
use App\Http\Requests\UpdatecontohRequest;
use App\Repositories\contohRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class contohController extends AppBaseController
{
    /** @var  contohRepository */
    private $contohRepository;

    public function __construct(contohRepository $contohRepo)
    {
        $this->contohRepository = $contohRepo;
    }

    /**
     * Display a listing of the contoh.
     *
     * @param contohDataTable $contohDataTable
     * @return Response
     */
    public function index(contohDataTable $contohDataTable)
    {
        return $contohDataTable->render('contohs.index');
    }

    /**
     * Show the form for creating a new contoh.
     *
     * @return Response
     */
    public function create()
    {
        return view('contohs.create');
    }

    /**
     * Store a newly created contoh in storage.
     *
     * @param CreatecontohRequest $request
     *
     * @return Response
     */
    public function store(CreatecontohRequest $request)
    {
        $input = $request->all();

        $contoh = $this->contohRepository->create($input);

        Flash::success('Contoh saved successfully.');

        return redirect(route('contohs.index'));
    }

    /**
     * Display the specified contoh.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            Flash::error('Contoh not found');

            return redirect(route('contohs.index'));
        }

        return view('contohs.show')->with('contoh', $contoh);
    }

    /**
     * Show the form for editing the specified contoh.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            Flash::error('Contoh not found');

            return redirect(route('contohs.index'));
        }

        return view('contohs.edit')->with('contoh', $contoh);
    }

    /**
     * Update the specified contoh in storage.
     *
     * @param  int              $id
     * @param UpdatecontohRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecontohRequest $request)
    {
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            Flash::error('Contoh not found');

            return redirect(route('contohs.index'));
        }

        $contoh = $this->contohRepository->update($request->all(), $id);

        Flash::success('Contoh updated successfully.');

        return redirect(route('contohs.index'));
    }

    /**
     * Remove the specified contoh from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            Flash::error('Contoh not found');

            return redirect(route('contohs.index'));
        }

        $this->contohRepository->delete($id);

        Flash::success('Contoh deleted successfully.');

        return redirect(route('contohs.index'));
    }
}
