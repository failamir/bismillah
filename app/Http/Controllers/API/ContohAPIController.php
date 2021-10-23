<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContohAPIRequest;
use App\Http\Requests\API\UpdateContohAPIRequest;
use App\Models\Contoh;
use App\Repositories\ContohRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContohResource;
use Response;

/**
 * Class ContohController
 * @package App\Http\Controllers\API
 */

class ContohAPIController extends AppBaseController
{
    /** @var  ContohRepository */
    private $contohRepository;

    public function __construct(ContohRepository $contohRepo)
    {
        $this->contohRepository = $contohRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/contohs",
     *      summary="Get a listing of the Contohs.",
     *      tags={"Contoh"},
     *      description="Get all Contohs",
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
     *                  @SWG\Items(ref="#/definitions/Contoh")
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
        $contohs = $this->contohRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            ContohResource::collection($contohs),
            __('messages.retrieved', ['model' => __('models/contohs.plural')])
        );
    }

    /**
     * @param CreateContohAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/contohs",
     *      summary="Store a newly created Contoh in storage",
     *      tags={"Contoh"},
     *      description="Store Contoh",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Contoh that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Contoh")
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
     *                  ref="#/definitions/Contoh"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContohAPIRequest $request)
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

        return $this->sendResponse(
            new ContohResource($contoh),
            __('messages.saved', ['model' => __('models/contohs.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/contohs/{id}",
     *      summary="Display the specified Contoh",
     *      tags={"Contoh"},
     *      description="Get Contoh",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Contoh",
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
     *                  ref="#/definitions/Contoh"
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
        /** @var Contoh $contoh */
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/contohs.singular')])
            );
        }

        return $this->sendResponse(
            new ContohResource($contoh),
            __('messages.retrieved', ['model' => __('models/contohs.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateContohAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/contohs/{id}",
     *      summary="Update the specified Contoh in storage",
     *      tags={"Contoh"},
     *      description="Update Contoh",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Contoh",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Contoh that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Contoh")
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
     *                  ref="#/definitions/Contoh"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContohAPIRequest $request)
    {
        $input = $request->all();

        /** @var Contoh $contoh */
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/contohs.singular')])
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
        $contoh = $this->contohRepository->update($input, $id);

        return $this->sendResponse(
            new ContohResource($contoh),
            __('messages.updated', ['model' => __('models/contohs.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/contohs/{id}",
     *      summary="Remove the specified Contoh from storage",
     *      tags={"Contoh"},
     *      description="Delete Contoh",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Contoh",
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
        /** @var Contoh $contoh */
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/contohs.singular')])
            );
        }

        $contoh->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/contohs.singular')])
        );
    }
}
