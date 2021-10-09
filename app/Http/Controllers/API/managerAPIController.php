<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemanagerAPIRequest;
use App\Http\Requests\API\UpdatemanagerAPIRequest;
use App\Models\manager;
use App\Repositories\managerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\managerResource;
use Response;

/**
 * Class managerController
 * @package App\Http\Controllers\API
 */

class managerAPIController extends AppBaseController
{
    /** @var  managerRepository */
    private $managerRepository;

    public function __construct(managerRepository $managerRepo)
    {
        $this->managerRepository = $managerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/managers",
     *      summary="Get a listing of the managers.",
     *      tags={"manager"},
     *      description="Get all managers",
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
     *                  @SWG\Items(ref="#/definitions/manager")
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
        $managers = $this->managerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            managerResource::collection($managers),
            __('messages.retrieved', ['model' => __('models/managers.plural')])
        );
    }

    /**
     * @param CreatemanagerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/managers",
     *      summary="Store a newly created manager in storage",
     *      tags={"manager"},
     *      description="Store manager",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="manager that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/manager")
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
     *                  ref="#/definitions/manager"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatemanagerAPIRequest $request)
    {
        $input = $request->all();

        $manager = $this->managerRepository->create($input);

        return $this->sendResponse(
            new managerResource($manager),
            __('messages.saved', ['model' => __('models/managers.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/managers/{id}",
     *      summary="Display the specified manager",
     *      tags={"manager"},
     *      description="Get manager",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of manager",
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
     *                  ref="#/definitions/manager"
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
        /** @var manager $manager */
        $manager = $this->managerRepository->find($id);

        if (empty($manager)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/managers.singular')])
            );
        }

        return $this->sendResponse(
            new managerResource($manager),
            __('messages.retrieved', ['model' => __('models/managers.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdatemanagerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/managers/{id}",
     *      summary="Update the specified manager in storage",
     *      tags={"manager"},
     *      description="Update manager",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of manager",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="manager that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/manager")
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
     *                  ref="#/definitions/manager"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatemanagerAPIRequest $request)
    {
        $input = $request->all();

        /** @var manager $manager */
        $manager = $this->managerRepository->find($id);

        if (empty($manager)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/managers.singular')])
            );
        }

        $manager = $this->managerRepository->update($input, $id);

        return $this->sendResponse(
            new managerResource($manager),
            __('messages.updated', ['model' => __('models/managers.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/managers/{id}",
     *      summary="Remove the specified manager from storage",
     *      tags={"manager"},
     *      description="Delete manager",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of manager",
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
        /** @var manager $manager */
        $manager = $this->managerRepository->find($id);

        if (empty($manager)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/managers.singular')])
            );
        }

        $manager->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/managers.singular')])
        );
    }
}
