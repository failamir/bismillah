<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLailaAPIRequest;
use App\Http\Requests\API\UpdateLailaAPIRequest;
use App\Models\Laila;
use App\Repositories\LailaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\LailaResource;
use Response;

/**
 * Class LailaController
 * @package App\Http\Controllers\API
 */

class LailaAPIController extends AppBaseController
{
    /** @var  LailaRepository */
    private $lailaRepository;

    public function __construct(LailaRepository $lailaRepo)
    {
        $this->lailaRepository = $lailaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/lailas",
     *      summary="Get a listing of the Lailas.",
     *      tags={"Laila"},
     *      description="Get all Lailas",
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
     *                  @SWG\Items(ref="#/definitions/Laila")
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
        $lailas = $this->lailaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            LailaResource::collection($lailas),
            __('messages.retrieved', ['model' => __('models/lailas.plural')])
        );
    }

    /**
     * @param CreateLailaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/lailas",
     *      summary="Store a newly created Laila in storage",
     *      tags={"Laila"},
     *      description="Store Laila",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Laila that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Laila")
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
     *                  ref="#/definitions/Laila"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLailaAPIRequest $request)
    {
        $input = $request->all();

        $laila = $this->lailaRepository->create($input);

        return $this->sendResponse(
            new LailaResource($laila),
            __('messages.saved', ['model' => __('models/lailas.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/lailas/{id}",
     *      summary="Display the specified Laila",
     *      tags={"Laila"},
     *      description="Get Laila",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Laila",
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
     *                  ref="#/definitions/Laila"
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
        /** @var Laila $laila */
        $laila = $this->lailaRepository->find($id);

        if (empty($laila)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/lailas.singular')])
            );
        }

        return $this->sendResponse(
            new LailaResource($laila),
            __('messages.retrieved', ['model' => __('models/lailas.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateLailaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/lailas/{id}",
     *      summary="Update the specified Laila in storage",
     *      tags={"Laila"},
     *      description="Update Laila",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Laila",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Laila that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Laila")
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
     *                  ref="#/definitions/Laila"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLailaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Laila $laila */
        $laila = $this->lailaRepository->find($id);

        if (empty($laila)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/lailas.singular')])
            );
        }

        $laila = $this->lailaRepository->update($input, $id);

        return $this->sendResponse(
            new LailaResource($laila),
            __('messages.updated', ['model' => __('models/lailas.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/lailas/{id}",
     *      summary="Remove the specified Laila from storage",
     *      tags={"Laila"},
     *      description="Delete Laila",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Laila",
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
        /** @var Laila $laila */
        $laila = $this->lailaRepository->find($id);

        if (empty($laila)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/lailas.singular')])
            );
        }

        $laila->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/lailas.singular')])
        );
    }
}
