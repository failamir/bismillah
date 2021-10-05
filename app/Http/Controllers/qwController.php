<?php

namespace App\Http\Controllers;

use App\DataTables\qwDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateqwRequest;
use App\Http\Requests\UpdateqwRequest;
use App\Repositories\qwRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class qwController extends AppBaseController
{
    /** @var  qwRepository */
    private $qwRepository;

    public function __construct(qwRepository $qwRepo)
    {
        $this->qwRepository = $qwRepo;
    }

    /**
     * Display a listing of the qw.
     *
     * @param qwDataTable $qwDataTable
     * @return Response
     */
    public function index(qwDataTable $qwDataTable)
    {
        return $qwDataTable->render('qws.index');
    }

    /**
     * Show the form for creating a new qw.
     *
     * @return Response
     */
    public function create()
    {
        return view('qws.create');
    }

    /**
     * Store a newly created qw in storage.
     *
     * @param CreateqwRequest $request
     *
     * @return Response
     */
    public function store(CreateqwRequest $request)
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

        $qw = $this->qwRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/qws.singular')]));

        return redirect(route('qws.index'));
    }

    /**
     * Display the specified qw.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $qw = $this->qwRepository->find($id);

        if (empty($qw)) {
            Flash::error(__('messages.not_found', ['model' => __('models/qws.singular')]));

            return redirect(route('qws.index'));
        }

        return view('qws.show')->with('qw', $qw);
    }

    /**
     * Show the form for editing the specified qw.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $qw = $this->qwRepository->find($id);

        if (empty($qw)) {
            Flash::error(__('messages.not_found', ['model' => __('models/qws.singular')]));

            return redirect(route('qws.index'));
        }

        return view('qws.edit')->with('qw', $qw);
    }

    /**
     * Update the specified qw in storage.
     *
     * @param  int              $id
     * @param UpdateqwRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateqwRequest $request)
    {
        $qw = $this->qwRepository->find($id);

        if (empty($qw)) {
            Flash::error(__('messages.not_found', ['model' => __('models/qws.singular')]));

            return redirect(route('qws.index'));
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

        $qw = $this->qwRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/qws.singular')]));

        return redirect(route('qws.index'));
    }

    /**
     * Remove the specified qw from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $qw = $this->qwRepository->find($id);

        if (empty($qw)) {
            Flash::error(__('messages.not_found', ['model' => __('models/qws.singular')]));

            return redirect(route('qws.index'));
        }

        $this->qwRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/qws.singular')]));

        return redirect(route('qws.index'));
    }
}
