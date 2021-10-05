<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateanisAPIRequest;
use App\Http\Requests\API\UpdateanisAPIRequest;
use App\Models\anis;
use App\Repositories\anisRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\anisResource;
use Response;

/**
 * Class anisController
 * @package App\Http\Controllers\API
 */

class anisAPIController extends AppBaseController
{
    /** @var  anisRepository */
    private $anisRepository;

    public function __construct(anisRepository $anisRepo)
    {
        $this->anisRepository = $anisRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/anis",
     *      summary="Get a listing of the anis.",
     *      tags={"anis"},
     *      description="Get all anis",
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
     *                  @SWG\Items(ref="#/definitions/anis")
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
        $anis = $this->anisRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            anisResource::collection($anis),
            __('messages.retrieved', ['model' => __('models/anis.plural')])
        );
    }

    /**
     * @param CreateanisAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/anis",
     *      summary="Store a newly created anis in storage",
     *      tags={"anis"},
     *      description="Store anis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="anis that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/anis")
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
     *                  ref="#/definitions/anis"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateanisAPIRequest $request)
    {
        $input = $request->all();

        $anis = $this->anisRepository->create($input);

        return $this->sendResponse(
            new anisResource($anis),
            __('messages.saved', ['model' => __('models/anis.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/anis/{id}",
     *      summary="Display the specified anis",
     *      tags={"anis"},
     *      description="Get anis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of anis",
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
     *                  ref="#/definitions/anis"
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
        /** @var anis $anis */
        $anis = $this->anisRepository->find($id);

        if (empty($anis)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/anis.singular')])
            );
        }

        return $this->sendResponse(
            new anisResource($anis),
            __('messages.retrieved', ['model' => __('models/anis.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateanisAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/anis/{id}",
     *      summary="Update the specified anis in storage",
     *      tags={"anis"},
     *      description="Update anis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of anis",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="anis that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/anis")
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
     *                  ref="#/definitions/anis"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateanisAPIRequest $request)
    {
        $input = $request->all();

        /** @var anis $anis */
        $anis = $this->anisRepository->find($id);

        if (empty($anis)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/anis.singular')])
            );
        }

        $anis = $this->anisRepository->update($input, $id);

        return $this->sendResponse(
            new anisResource($anis),
            __('messages.updated', ['model' => __('models/anis.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/anis/{id}",
     *      summary="Remove the specified anis from storage",
     *      tags={"anis"},
     *      description="Delete anis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of anis",
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
        /** @var anis $anis */
        $anis = $this->anisRepository->find($id);

        if (empty($anis)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/anis.singular')])
            );
        }

        $anis->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/anis.singular')])
        );
    }
}
