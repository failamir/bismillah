<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePembiayaanAPIRequest;
use App\Http\Requests\API\UpdatePembiayaanAPIRequest;
use App\Models\Pembiayaan;
use App\Repositories\PembiayaanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PembiayaanResource;
use Response;

/**
 * Class PembiayaanController
 * @package App\Http\Controllers\API
 */

class PembiayaanAPIController extends AppBaseController
{
    /** @var  PembiayaanRepository */
    private $pembiayaanRepository;

    public function __construct(PembiayaanRepository $pembiayaanRepo)
    {
        $this->pembiayaanRepository = $pembiayaanRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/pembiayaans",
     *      summary="Get a listing of the Pembiayaans.",
     *      tags={"Pembiayaan"},
     *      description="Get all Pembiayaans",
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
     *                  @SWG\Items(ref="#/definitions/Pembiayaan")
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
        $pembiayaans = $this->pembiayaanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            PembiayaanResource::collection($pembiayaans),
            __('messages.retrieved', ['model' => __('models/pembiayaans.plural')])
        );
    }

    /**
     * @param CreatePembiayaanAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/pembiayaans",
     *      summary="Store a newly created Pembiayaan in storage",
     *      tags={"Pembiayaan"},
     *      description="Store Pembiayaan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Pembiayaan that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Pembiayaan")
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
     *                  ref="#/definitions/Pembiayaan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePembiayaanAPIRequest $request)
    {
        $input = $request->all();

        $pembiayaan = $this->pembiayaanRepository->create($input);

        return $this->sendResponse(
            new PembiayaanResource($pembiayaan),
            __('messages.saved', ['model' => __('models/pembiayaans.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/pembiayaans/{id}",
     *      summary="Display the specified Pembiayaan",
     *      tags={"Pembiayaan"},
     *      description="Get Pembiayaan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pembiayaan",
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
     *                  ref="#/definitions/Pembiayaan"
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
        /** @var Pembiayaan $pembiayaan */
        $pembiayaan = $this->pembiayaanRepository->find($id);

        if (empty($pembiayaan)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/pembiayaans.singular')])
            );
        }

        return $this->sendResponse(
            new PembiayaanResource($pembiayaan),
            __('messages.retrieved', ['model' => __('models/pembiayaans.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdatePembiayaanAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/pembiayaans/{id}",
     *      summary="Update the specified Pembiayaan in storage",
     *      tags={"Pembiayaan"},
     *      description="Update Pembiayaan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pembiayaan",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Pembiayaan that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Pembiayaan")
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
     *                  ref="#/definitions/Pembiayaan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePembiayaanAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pembiayaan $pembiayaan */
        $pembiayaan = $this->pembiayaanRepository->find($id);

        if (empty($pembiayaan)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/pembiayaans.singular')])
            );
        }

        $pembiayaan = $this->pembiayaanRepository->update($input, $id);

        return $this->sendResponse(
            new PembiayaanResource($pembiayaan),
            __('messages.updated', ['model' => __('models/pembiayaans.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/pembiayaans/{id}",
     *      summary="Remove the specified Pembiayaan from storage",
     *      tags={"Pembiayaan"},
     *      description="Delete Pembiayaan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pembiayaan",
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
        /** @var Pembiayaan $pembiayaan */
        $pembiayaan = $this->pembiayaanRepository->find($id);

        if (empty($pembiayaan)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/pembiayaans.singular')])
            );
        }

        $pembiayaan->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/pembiayaans.singular')])
        );
    }
}
