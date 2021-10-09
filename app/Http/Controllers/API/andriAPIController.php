<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateandriAPIRequest;
use App\Http\Requests\API\UpdateandriAPIRequest;
use App\Models\andri;
use App\Repositories\andriRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\andriResource;
use Response;

/**
 * Class andriController
 * @package App\Http\Controllers\API
 */

class andriAPIController extends AppBaseController
{
    /** @var  andriRepository */
    private $andriRepository;

    public function __construct(andriRepository $andriRepo)
    {
        $this->andriRepository = $andriRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/andris",
     *      summary="Get a listing of the andris.",
     *      tags={"andri"},
     *      description="Get all andris",
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
     *                  @SWG\Items(ref="#/definitions/andri")
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
        $andris = $this->andriRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            andriResource::collection($andris),
            __('messages.retrieved', ['model' => __('models/andris.plural')])
        );
    }

    /**
     * @param CreateandriAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/andris",
     *      summary="Store a newly created andri in storage",
     *      tags={"andri"},
     *      description="Store andri",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="andri that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/andri")
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
     *                  ref="#/definitions/andri"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateandriAPIRequest $request)
    {
        $input = $request->all();

        $andri = $this->andriRepository->create($input);

        return $this->sendResponse(
            new andriResource($andri),
            __('messages.saved', ['model' => __('models/andris.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/andris/{id}",
     *      summary="Display the specified andri",
     *      tags={"andri"},
     *      description="Get andri",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of andri",
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
     *                  ref="#/definitions/andri"
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
        /** @var andri $andri */
        $andri = $this->andriRepository->find($id);

        if (empty($andri)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/andris.singular')])
            );
        }

        return $this->sendResponse(
            new andriResource($andri),
            __('messages.retrieved', ['model' => __('models/andris.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateandriAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/andris/{id}",
     *      summary="Update the specified andri in storage",
     *      tags={"andri"},
     *      description="Update andri",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of andri",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="andri that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/andri")
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
     *                  ref="#/definitions/andri"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateandriAPIRequest $request)
    {
        $input = $request->all();

        /** @var andri $andri */
        $andri = $this->andriRepository->find($id);

        if (empty($andri)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/andris.singular')])
            );
        }

        $andri = $this->andriRepository->update($input, $id);

        return $this->sendResponse(
            new andriResource($andri),
            __('messages.updated', ['model' => __('models/andris.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/andris/{id}",
     *      summary="Remove the specified andri from storage",
     *      tags={"andri"},
     *      description="Delete andri",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of andri",
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
        /** @var andri $andri */
        $andri = $this->andriRepository->find($id);

        if (empty($andri)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/andris.singular')])
            );
        }

        $andri->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/andris.singular')])
        );
    }
}
