<?php

namespace App\Http\Controllers;

use App\DataTables\IsnacategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateIsnacategoryRequest;
use App\Http\Requests\UpdateIsnacategoryRequest;
use App\Repositories\IsnacategoryRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class IsnacategoryController extends AppBaseController
{
    /** @var  IsnacategoryRepository */
    private $isnacategoryRepository;

    public function __construct(IsnacategoryRepository $isnacategoryRepo)
    {
        $this->isnacategoryRepository = $isnacategoryRepo;
    }

    /**
     * Display a listing of the Isnacategory.
     *
     * @param IsnacategoryDataTable $isnacategoryDataTable
     * @return Response
     */
    public function index(IsnacategoryDataTable $isnacategoryDataTable)
    {
        return $isnacategoryDataTable->render('isnacategories.index');
    }

    /**
     * Show the form for creating a new Isnacategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('isnacategories.create');
    }

    /**
     * Store a newly created Isnacategory in storage.
     *
     * @param CreateIsnacategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateIsnacategoryRequest $request)
    {
        $input = $request->all();

        $isnacategory = $this->isnacategoryRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/isnacategories.singular')]));

        return redirect(route('isnacategories.index'));
    }

    /**
     * Display the specified Isnacategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $isnacategory = $this->isnacategoryRepository->find($id);

        if (empty($isnacategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/isnacategories.singular')]));

            return redirect(route('isnacategories.index'));
        }

        return view('isnacategories.show')->with('isnacategory', $isnacategory);
    }

    /**
     * Show the form for editing the specified Isnacategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $isnacategory = $this->isnacategoryRepository->find($id);

        if (empty($isnacategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/isnacategories.singular')]));

            return redirect(route('isnacategories.index'));
        }

        return view('isnacategories.edit')->with('isnacategory', $isnacategory);
    }

    /**
     * Update the specified Isnacategory in storage.
     *
     * @param  int              $id
     * @param UpdateIsnacategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIsnacategoryRequest $request)
    {
        $isnacategory = $this->isnacategoryRepository->find($id);

        if (empty($isnacategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/isnacategories.singular')]));

            return redirect(route('isnacategories.index'));
        }

        $isnacategory = $this->isnacategoryRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/isnacategories.singular')]));

        return redirect(route('isnacategories.index'));
    }

    /**
     * Remove the specified Isnacategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $isnacategory = $this->isnacategoryRepository->find($id);

        if (empty($isnacategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/isnacategories.singular')]));

            return redirect(route('isnacategories.index'));
        }

        $this->isnacategoryRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/isnacategories.singular')]));

        return redirect(route('isnacategories.index'));
    }
}
