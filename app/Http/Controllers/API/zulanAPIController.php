<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatezulanAPIRequest;
use App\Http\Requests\API\UpdatezulanAPIRequest;
use App\Models\zulan;
use App\Repositories\zulanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\zulanResource;
use Response;

/**
 * Class zulanController
 * @package App\Http\Controllers\API
 */

class zulanAPIController extends AppBaseController
{
    /** @var  zulanRepository */
    private $zulanRepository;

    public function __construct(zulanRepository $zulanRepo)
    {
        $this->zulanRepository = $zulanRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/zulans",
     *      summary="Get a listing of the zulans.",
     *      tags={"zulan"},
     *      description="Get all zulans",
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
     *                  @SWG\Items(ref="#/definitions/zulan")
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
        $zulans = $this->zulanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            zulanResource::collection($zulans),
            __('messages.retrieved', ['model' => __('models/zulans.plural')])
        );
    }

    /**
     * @param CreatezulanAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/zulans",
     *      summary="Store a newly created zulan in storage",
     *      tags={"zulan"},
     *      description="Store zulan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="zulan that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/zulan")
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
     *                  ref="#/definitions/zulan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatezulanAPIRequest $request)
    {
        $input = $request->all();

        $zulan = $this->zulanRepository->create($input);

        return $this->sendResponse(
            new zulanResource($zulan),
            __('messages.saved', ['model' => __('models/zulans.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/zulans/{id}",
     *      summary="Display the specified zulan",
     *      tags={"zulan"},
     *      description="Get zulan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of zulan",
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
     *                  ref="#/definitions/zulan"
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
        /** @var zulan $zulan */
        $zulan = $this->zulanRepository->find($id);

        if (empty($zulan)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/zulans.singular')])
            );
        }

        return $this->sendResponse(
            new zulanResource($zulan),
            __('messages.retrieved', ['model' => __('models/zulans.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdatezulanAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/zulans/{id}",
     *      summary="Update the specified zulan in storage",
     *      tags={"zulan"},
     *      description="Update zulan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of zulan",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="zulan that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/zulan")
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
     *                  ref="#/definitions/zulan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatezulanAPIRequest $request)
    {
        $input = $request->all();

        /** @var zulan $zulan */
        $zulan = $this->zulanRepository->find($id);

        if (empty($zulan)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/zulans.singular')])
            );
        }

        $zulan = $this->zulanRepository->update($input, $id);

        return $this->sendResponse(
            new zulanResource($zulan),
            __('messages.updated', ['model' => __('models/zulans.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/zulans/{id}",
     *      summary="Remove the specified zulan from storage",
     *      tags={"zulan"},
     *      description="Delete zulan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of zulan",
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
        /** @var zulan $zulan */
        $zulan = $this->zulanRepository->find($id);

        if (empty($zulan)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/zulans.singular')])
            );
        }

        $zulan->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/zulans.singular')])
        );
    }
}
