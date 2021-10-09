<?php

namespace App\Http\Controllers;

use App\DataTables\andriDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateandriRequest;
use App\Http\Requests\UpdateandriRequest;
use App\Repositories\andriRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class andriController extends AppBaseController
{
    /** @var  andriRepository */
    private $andriRepository;

    public function __construct(andriRepository $andriRepo)
    {
        $this->andriRepository = $andriRepo;
    }

    /**
     * Display a listing of the andri.
     *
     * @param andriDataTable $andriDataTable
     * @return Response
     */
    public function index(andriDataTable $andriDataTable)
    {
        return $andriDataTable->render('andris.index');
    }

    /**
     * Show the form for creating a new andri.
     *
     * @return Response
     */
    public function create()
    {
        return view('andris.create');
    }

    /**
     * Store a newly created andri in storage.
     *
     * @param CreateandriRequest $request
     *
     * @return Response
     */
    public function store(CreateandriRequest $request)
    {
        $input = $request->all();
        if ($request->hasFile('image')){
            $Validation = $request->validate([
                'image' => 'required|file|mimes:png,jpg,jpeg,gif|max:8000'
            ]);
            $file = $Validation['image'];
            $filename = 'image-' . time() . '.' . $file->getClientOriginalExtension();
            $imageFileName = $file->storeAs('image', $filename);
            $path = "/storage/app/public/".$imageFileName;
        }
        $input['image'] = $path;
        if ($request->hasFile('photo')){
            $Validation = $request->validate([
                'photo' => 'required|file|mimes:png,jpg,jpeg,gif|max:8000'
            ]);
            $file = $Validation['photo'];
            $filename = 'photo-' . time() . '.' . $file->getClientOriginalExtension();
            $photoFileName = $file->storeAs('photo', $filename);
            $path = "/storage/app/public/".$photoFileName;
        }
        $input['photo'] = $path;
        if ($request->hasFile('picture')){
            $Validation = $request->validate([
                'picture' => 'required|file|mimes:png,jpg,jpeg,gif,doc,csv,docx,xls,xlsx,pdf|max:8000'
            ]);
            $file = $Validation['picture'];
            $filename = 'picture-' . time() . '.' . $file->getClientOriginalExtension();
            $pictureFileName = $file->storeAs('picture', $filename);
            $path = "/storage/app/public/".$pictureFileName;
        }
        $input['picture'] = $path;
        if ($request->hasFile('file')){
            $Validation = $request->validate([
                'file' => 'required|file|mimes:doc,csv,docx,xls,xlsx,pdf|max:8000'
            ]);
            $file = $Validation['file'];
            $filename = 'file-' . time() . '.' . $file->getClientOriginalExtension();
            $fileFileName = $file->storeAs('file', $filename);
            $path = "/storage/app/public/".$fileFileName;
        }
        $input['file'] = $path;
        if ($request->hasFile('document')){
            $Validation = $request->validate([
                'document' => 'required|file|mimes:doc,csv,docx,xls,xlsx,pdf|max:8000'
            ]);
            $file = $Validation['document'];
            $filename = 'document-' . time() . '.' . $file->getClientOriginalExtension();
            $documentFileName = $file->storeAs('document', $filename);
            $path = "/storage/app/public/".$documentFileName;
        }
        $input['document'] = $path;

        $andri = $this->andriRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/andris.singular')]));

        return redirect(route('andris.index'));
    }

    /**
     * Display the specified andri.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $andri = $this->andriRepository->find($id);

        if (empty($andri)) {
            Flash::error(__('messages.not_found', ['model' => __('models/andris.singular')]));

            return redirect(route('andris.index'));
        }

        return view('andris.show')->with('andri', $andri);
    }

    /**
     * Show the form for editing the specified andri.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $andri = $this->andriRepository->find($id);

        if (empty($andri)) {
            Flash::error(__('messages.not_found', ['model' => __('models/andris.singular')]));

            return redirect(route('andris.index'));
        }

        return view('andris.edit')->with('andri', $andri);
    }

    /**
     * Update the specified andri in storage.
     *
     * @param  int              $id
     * @param UpdateandriRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateandriRequest $request)
    {
        $andri = $this->andriRepository->find($id);

        if (empty($andri)) {
            Flash::error(__('messages.not_found', ['model' => __('models/andris.singular')]));

            return redirect(route('andris.index'));
        }
        $input = $request->all();
        if ($request->hasFile('image')){
            $Validation = $request->validate([
                'image' => 'required|file|mimes:png,jpg,jpeg,gif|max:8000'
            ]);
            $file = $Validation['image'];
            $filename = 'image-' . time() . '.' . $file->getClientOriginalExtension();
            $imageFileName = $file->storeAs('image', $filename);
            $path = "/storage/app/public/".$imageFileName;
        }
        $input['image'] = $path;
        if ($request->hasFile('photo')){
            $Validation = $request->validate([
                'photo' => 'required|file|mimes:png,jpg,jpeg,gif|max:8000'
            ]);
            $file = $Validation['photo'];
            $filename = 'photo-' . time() . '.' . $file->getClientOriginalExtension();
            $photoFileName = $file->storeAs('photo', $filename);
            $path = "/storage/app/public/".$photoFileName;
        }
        $input['photo'] = $path;
        if ($request->hasFile('picture')){
            $Validation = $request->validate([
                'picture' => 'required|file|mimes:png,jpg,jpeg,gif,doc,csv,docx,xls,xlsx,pdf|max:8000'
            ]);
            $file = $Validation['picture'];
            $filename = 'picture-' . time() . '.' . $file->getClientOriginalExtension();
            $pictureFileName = $file->storeAs('picture', $filename);
            $path = "/storage/app/public/".$pictureFileName;
        }
        $input['picture'] = $path;
        if ($request->hasFile('file')){
            $Validation = $request->validate([
                'file' => 'required|file|mimes:doc,csv,docx,xls,xlsx,pdf|max:8000'
            ]);
            $file = $Validation['file'];
            $filename = 'file-' . time() . '.' . $file->getClientOriginalExtension();
            $fileFileName = $file->storeAs('file', $filename);
            $path = "/storage/app/public/".$fileFileName;
        }
        $input['file'] = $path;
        if ($request->hasFile('document')){
            $Validation = $request->validate([
                'document' => 'required|file|mimes:doc,csv,docx,xls,xlsx,pdf|max:8000'
            ]);
            $file = $Validation['document'];
            $filename = 'document-' . time() . '.' . $file->getClientOriginalExtension();
            $documentFileName = $file->storeAs('document', $filename);
            $path = "/storage/app/public/".$documentFileName;
        }
        $input['document'] = $path;

        $andri = $this->andriRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/andris.singular')]));

        return redirect(route('andris.index'));
    }

    /**
     * Remove the specified andri from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $andri = $this->andriRepository->find($id);

        if (empty($andri)) {
            Flash::error(__('messages.not_found', ['model' => __('models/andris.singular')]));

            return redirect(route('andris.index'));
        }

        $this->andriRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/andris.singular')]));

        return redirect(route('andris.index'));
    }
}
