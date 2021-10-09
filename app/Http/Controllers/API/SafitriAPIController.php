<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSafitriAPIRequest;
use App\Http\Requests\API\UpdateSafitriAPIRequest;
use App\Models\Safitri;
use App\Repositories\SafitriRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\SafitriResource;
use Response;

/**
 * Class SafitriController
 * @package App\Http\Controllers\API
 */

class SafitriAPIController extends AppBaseController
{
    /** @var  SafitriRepository */
    private $safitriRepository;

    public function __construct(SafitriRepository $safitriRepo)
    {
        $this->safitriRepository = $safitriRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/safitris",
     *      summary="Get a listing of the Safitris.",
     *      tags={"Safitri"},
     *      description="Get all Safitris",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Safitri")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $safitris = $this->safitriRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            SafitriResource::collection($safitris),
            __('messages.retrieved', ['model' => __('models/safitris.plural')])
        );
    }

    /**
     * @param CreateSafitriAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/safitris",
     *      summary="Store a newly created Safitri in storage",
     *      tags={"Safitri"},
     *      description="Store Safitri",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Safitri that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Safitri")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Safitri"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSafitriAPIRequest $request)
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

        return $this->sendResponse(
            new SafitriResource($safitri),
            __('messages.saved', ['model' => __('models/safitris.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/safitris/{id}",
     *      summary="Display the specified Safitri",
     *      tags={"Safitri"},
     *      description="Get Safitri",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Safitri",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Safitri"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Safitri $safitri */
        $safitri = $this->safitriRepository->find($id);

        if (empty($safitri)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/safitris.singular')])
            );
        }

        return $this->sendResponse(
            new SafitriResource($safitri),
            __('messages.retrieved', ['model' => __('models/safitris.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateSafitriAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/safitris/{id}",
     *      summary="Update the specified Safitri in storage",
     *      tags={"Safitri"},
     *      description="Update Safitri",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Safitri",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Safitri that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Safitri")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Safitri"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSafitriAPIRequest $request)
    {
        $input = $request->all();

        /** @var Safitri $safitri */
        $safitri = $this->safitriRepository->find($id);

        if (empty($safitri)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/safitris.singular')])
            );
        }
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

        return $this->sendResponse(
            new SafitriResource($safitri),
            __('messages.updated', ['model' => __('models/safitris.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/safitris/{id}",
     *      summary="Remove the specified Safitri from storage",
     *      tags={"Safitri"},
     *      description="Delete Safitri",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Safitri",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Safitri $safitri */
        $safitri = $this->safitriRepository->find($id);

        if (empty($safitri)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/safitris.singular')])
            );
        }

        $safitri->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/safitris.singular')])
        );
    }
}
