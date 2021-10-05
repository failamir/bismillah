<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateIsnacategoryAPIRequest;
use App\Http\Requests\API\UpdateIsnacategoryAPIRequest;
use App\Models\Isnacategory;
use App\Repositories\IsnacategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\IsnacategoryResource;
use Response;

/**
 * Class IsnacategoryController
 * @package App\Http\Controllers\API
 */

class IsnacategoryAPIController extends AppBaseController
{
    /** @var  IsnacategoryRepository */
    private $isnacategoryRepository;

    public function __construct(IsnacategoryRepository $isnacategoryRepo)
    {
        $this->isnacategoryRepository = $isnacategoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/isnacategories",
     *      summary="Get a listing of the Isnacategories.",
     *      tags={"Isnacategory"},
     *      description="Get all Isnacategories",
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
     *                  @SWG\Items(ref="#/definitions/Isnacategory")
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
        $isnacategories = $this->isnacategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            IsnacategoryResource::collection($isnacategories),
            __('messages.retrieved', ['model' => __('models/isnacategories.plural')])
        );
    }

    /**
     * @param CreateIsnacategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/isnacategories",
     *      summary="Store a newly created Isnacategory in storage",
     *      tags={"Isnacategory"},
     *      description="Store Isnacategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Isnacategory that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Isnacategory")
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
     *                  ref="#/definitions/Isnacategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateIsnacategoryAPIRequest $request)
    {
        $input = $request->all();

        $isnacategory = $this->isnacategoryRepository->create($input);

        return $this->sendResponse(
            new IsnacategoryResource($isnacategory),
            __('messages.saved', ['model' => __('models/isnacategories.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/isnacategories/{id}",
     *      summary="Display the specified Isnacategory",
     *      tags={"Isnacategory"},
     *      description="Get Isnacategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Isnacategory",
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
     *                  ref="#/definitions/Isnacategory"
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
        /** @var Isnacategory $isnacategory */
        $isnacategory = $this->isnacategoryRepository->find($id);

        if (empty($isnacategory)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/isnacategories.singular')])
            );
        }

        return $this->sendResponse(
            new IsnacategoryResource($isnacategory),
            __('messages.retrieved', ['model' => __('models/isnacategories.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateIsnacategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/isnacategories/{id}",
     *      summary="Update the specified Isnacategory in storage",
     *      tags={"Isnacategory"},
     *      description="Update Isnacategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Isnacategory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Isnacategory that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Isnacategory")
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
     *                  ref="#/definitions/Isnacategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateIsnacategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Isnacategory $isnacategory */
        $isnacategory = $this->isnacategoryRepository->find($id);

        if (empty($isnacategory)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/isnacategories.singular')])
            );
        }

        $isnacategory = $this->isnacategoryRepository->update($input, $id);

        return $this->sendResponse(
            new IsnacategoryResource($isnacategory),
            __('messages.updated', ['model' => __('models/isnacategories.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/isnacategories/{id}",
     *      summary="Remove the specified Isnacategory from storage",
     *      tags={"Isnacategory"},
     *      description="Delete Isnacategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Isnacategory",
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
        /** @var Isnacategory $isnacategory */
        $isnacategory = $this->isnacategoryRepository->find($id);

        if (empty($isnacategory)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/isnacategories.singular')])
            );
        }

        $isnacategory->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/isnacategories.singular')])
        );
    }
}
