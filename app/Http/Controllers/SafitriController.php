<?php

namespace App\Http\Controllers;

use App\DataTables\SafitriDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSafitriRequest;
use App\Http\Requests\UpdateSafitriRequest;
use App\Repositories\SafitriRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SafitriController extends AppBaseController
{
    /** @var  SafitriRepository */
    private $safitriRepository;

    public function __construct(SafitriRepository $safitriRepo)
    {
        $this->safitriRepository = $safitriRepo;
    }

    /**
     * Display a listing of the Safitri.
     *
     * @param SafitriDataTable $safitriDataTable
     * @return Response
     */
    public function index(SafitriDataTable $safitriDataTable)
    {
        return $safitriDataTable->render('safitris.index');
    }

    /**
     * Show the form for creating a new Safitri.
     *
     * @return Response
     */
    public function create()
    {
        return view('safitris.create');
    }

    /**
     * Store a newly created Safitri in storage.
     *
     * @param CreateSafitriRequest $request
     *
     * @return Response
     */
    public function store(CreateSafitriRequest $request)
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

        $safitri = $this->safitriRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/safitris.singular')]));

        return redirect(route('safitris.index'));
    }

    /**
     * Display the specified Safitri.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $safitri = $this->safitriRepository->find($id);

        if (empty($safitri)) {
            Flash::error(__('messages.not_found', ['model' => __('models/safitris.singular')]));

            return redirect(route('safitris.index'));
        }

        return view('safitris.show')->with('safitri', $safitri);
    }

    /**
     * Show the form for editing the specified Safitri.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $safitri = $this->safitriRepository->find($id);

        if (empty($safitri)) {
            Flash::error(__('messages.not_found', ['model' => __('models/safitris.singular')]));

            return redirect(route('safitris.index'));
        }

        return view('safitris.edit')->with('safitri', $safitri);
    }

    /**
     * Update the specified Safitri in storage.
     *
     * @param  int              $id
     * @param UpdateSafitriRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSafitriRequest $request)
    {
        $safitri = $this->safitriRepository->find($id);

        if (empty($safitri)) {
            Flash::error(__('messages.not_found', ['model' => __('models/safitris.singular')]));

            return redirect(route('safitris.index'));
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

        $safitri = $this->safitriRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/safitris.singular')]));

        return redirect(route('safitris.index'));
    }

    /**
     * Remove the specified Safitri from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $safitri = $this->safitriRepository->find($id);

        if (empty($safitri)) {
            Flash::error(__('messages.not_found', ['model' => __('models/safitris.singular')]));

            return redirect(route('safitris.index'));
        }

        $this->safitriRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/safitris.singular')]));

        return redirect(route('safitris.index'));
    }
}
