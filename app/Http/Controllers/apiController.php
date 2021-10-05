<?php

namespace App\Http\Controllers;

use App\DataTables\apiDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateapiRequest;
use App\Http\Requests\UpdateapiRequest;
use App\Repositories\apiRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class apiController extends AppBaseController
{
    /** @var  apiRepository */
    private $apiRepository;

    public function __construct(apiRepository $apiRepo)
    {
        $this->apiRepository = $apiRepo;
    }

    /**
     * Display a listing of the api.
     *
     * @param apiDataTable $apiDataTable
     * @return Response
     */
    public function index(apiDataTable $apiDataTable)
    {
        return $apiDataTable->render('apis.index');
    }

    /**
     * Show the form for creating a new api.
     *
     * @return Response
     */
    public function create()
    {
        return view('apis.create');
    }

    /**
     * Store a newly created api in storage.
     *
     * @param CreateapiRequest $request
     *
     * @return Response
     */
    public function store(CreateapiRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('image')){

            //Validate the uploaded file
            $Validation = $request->validate([
    
                'image' => 'required|file|mimes:pdf|max:30000'
            ]);
    
            // cache the file
            $file = $Validation['image'];
    
            // generate a new filename. getClientOriginalExtension() for the file extension
            $filename = 'image-' . time() . '.' . $file->getClientOriginalExtension();
    
            // save to storage/app/infrastructure as the new $filename
            $imageFileName = $file->storeAs('image', $filename);
    
            $path = "/storage/app/public/".$imageFileName;
        }
    
        $input['image'] = $path;

        $api = $this->apiRepository->create($input);
    
        Flash::success(__('messages.saved', ['model' => __('models/apis.singular')]));

        return redirect(route('apis.index'));
    }

    /**
     * Display the specified api.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $api = $this->apiRepository->find($id);

        if (empty($api)) {
            Flash::error(__('messages.not_found', ['model' => __('models/apis.singular')]));

            return redirect(route('apis.index'));
        }

        return view('apis.show')->with('api', $api);
    }

    /**
     * Show the form for editing the specified api.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $api = $this->apiRepository->find($id);

        if (empty($api)) {
            Flash::error(__('messages.not_found', ['model' => __('models/apis.singular')]));

            return redirect(route('apis.index'));
        }

        return view('apis.edit')->with('api', $api);
    }

    /**
     * Update the specified api in storage.
     *
     * @param  int              $id
     * @param UpdateapiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateapiRequest $request)
    {
        $api = $this->apiRepository->find($id);

        if (empty($api)) {
            Flash::error(__('messages.not_found', ['model' => __('models/apis.singular')]));

            return redirect(route('apis.index'));
        }

        $api = $this->apiRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/apis.singular')]));

        return redirect(route('apis.index'));
    }

    /**
     * Remove the specified api from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $api = $this->apiRepository->find($id);

        if (empty($api)) {
            Flash::error(__('messages.not_found', ['model' => __('models/apis.singular')]));

            return redirect(route('apis.index'));
        }

        $this->apiRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/apis.singular')]));

        return redirect(route('apis.index'));
    }
}
