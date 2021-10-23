<?php

namespace App\Http\Controllers;

use App\DataTables\ContohDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateContohRequest;
use App\Http\Requests\UpdateContohRequest;
use App\Repositories\ContohRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ContohController extends AppBaseController
{
    /** @var  ContohRepository */
    private $contohRepository;

    public function __construct(ContohRepository $contohRepo)
    {
        $this->contohRepository = $contohRepo;
    }

    /**
     * Display a listing of the Contoh.
     *
     * @param ContohDataTable $contohDataTable
     * @return Response
     */
    public function index(ContohDataTable $contohDataTable)
    {
        return $contohDataTable->render('contohs.index');
    }

    /**
     * Show the form for creating a new Contoh.
     *
     * @return Response
     */
    public function create()
    {
        return view('contohs.create');
    }

    /**
     * Store a newly created Contoh in storage.
     *
     * @param CreateContohRequest $request
     *
     * @return Response
     */
    public function store(CreateContohRequest $request)
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

        $contoh = $this->contohRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/contohs.singular')]));

        return redirect(route('contohs.index'));
    }

    /**
     * Display the specified Contoh.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contohs.singular')]));

            return redirect(route('contohs.index'));
        }

        return view('contohs.show')->with('contoh', $contoh);
    }

    /**
     * Show the form for editing the specified Contoh.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contohs.singular')]));

            return redirect(route('contohs.index'));
        }

        return view('contohs.edit')->with('contoh', $contoh);
    }

    /**
     * Update the specified Contoh in storage.
     *
     * @param  int              $id
     * @param UpdateContohRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContohRequest $request)
    {
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contohs.singular')]));

            return redirect(route('contohs.index'));
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

        $contoh = $this->contohRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/contohs.singular')]));

        return redirect(route('contohs.index'));
    }

    /**
     * Remove the specified Contoh from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contohs.singular')]));

            return redirect(route('contohs.index'));
        }

        $this->contohRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/contohs.singular')]));

        return redirect(route('contohs.index'));
    }
}
