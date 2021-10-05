<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateapiAPIRequest;
use App\Http\Requests\API\UpdateapiAPIRequest;
use App\Models\api;
use App\Repositories\apiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\apiResource;
use Response;

/**
 * Class apiController
 * @package App\Http\Controllers\API
 */

class apiAPIController extends AppBaseController
{
    /** @var  apiRepository */
    private $apiRepository;

    public function __construct(apiRepository $apiRepo)
    {
        $this->apiRepository = $apiRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/apis",
     *      summary="Get a listing of the apis.",
     *      tags={"api"},
     *      description="Get all apis",
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
     *                  @SWG\Items(ref="#/definitions/api")
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
        $apis = $this->apiRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            apiResource::collection($apis),
            __('messages.retrieved', ['model' => __('models/apis.plural')])
        );
    }

    /**
     * @param CreateapiAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/apis",
     *      summary="Store a newly created api in storage",
     *      tags={"api"},
     *      description="Store api",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="api that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/api")
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
     *                  ref="#/definitions/api"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateapiAPIRequest $request)
    {
        $input = $request->all();

        $api = $this->apiRepository->create($input);

        return $this->sendResponse(
            new apiResource($api),
            __('messages.saved', ['model' => __('models/apis.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/apis/{id}",
     *      summary="Display the specified api",
     *      tags={"api"},
     *      description="Get api",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of api",
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
     *                  ref="#/definitions/api"
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
        /** @var api $api */
        $api = $this->apiRepository->find($id);

        if (empty($api)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/apis.singular')])
            );
        }

        return $this->sendResponse(
            new apiResource($api),
            __('messages.retrieved', ['model' => __('models/apis.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateapiAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/apis/{id}",
     *      summary="Update the specified api in storage",
     *      tags={"api"},
     *      description="Update api",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of api",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="api that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/api")
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
     *                  ref="#/definitions/api"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateapiAPIRequest $request)
    {
        $input = $request->all();

        /** @var api $api */
        $api = $this->apiRepository->find($id);

        if (empty($api)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/apis.singular')])
            );
        }

        $api = $this->apiRepository->update($input, $id);

        return $this->sendResponse(
            new apiResource($api),
            __('messages.updated', ['model' => __('models/apis.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/apis/{id}",
     *      summary="Remove the specified api from storage",
     *      tags={"api"},
     *      description="Delete api",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of api",
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
        /** @var api $api */
        $api = $this->apiRepository->find($id);

        if (empty($api)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/apis.singular')])
            );
        }

        $api->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/apis.singular')])
        );
    }
}
