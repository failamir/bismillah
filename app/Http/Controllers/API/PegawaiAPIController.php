<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePegawaiAPIRequest;
use App\Http\Requests\API\UpdatePegawaiAPIRequest;
use App\Models\Pegawai;
use App\Repositories\PegawaiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PegawaiResource;
use Response;

/**
 * Class PegawaiController
 * @package App\Http\Controllers\API
 */

class PegawaiAPIController extends AppBaseController
{
    /** @var  PegawaiRepository */
    private $pegawaiRepository;

    public function __construct(PegawaiRepository $pegawaiRepo)
    {
        $this->pegawaiRepository = $pegawaiRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/pegawais",
     *      summary="Get a listing of the Pegawais.",
     *      tags={"Pegawai"},
     *      description="Get all Pegawais",
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
     *                  @SWG\Items(ref="#/definitions/Pegawai")
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
        $pegawais = $this->pegawaiRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            PegawaiResource::collection($pegawais),
            __('messages.retrieved', ['model' => __('models/pegawais.plural')])
        );
    }

    /**
     * @param CreatePegawaiAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/pegawais",
     *      summary="Store a newly created Pegawai in storage",
     *      tags={"Pegawai"},
     *      description="Store Pegawai",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Pegawai that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Pegawai")
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
     *                  ref="#/definitions/Pegawai"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePegawaiAPIRequest $request)
    {
        $input = $request->all();

        $pegawai = $this->pegawaiRepository->create($input);

        return $this->sendResponse(
            new PegawaiResource($pegawai),
            __('messages.saved', ['model' => __('models/pegawais.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/pegawais/{id}",
     *      summary="Display the specified Pegawai",
     *      tags={"Pegawai"},
     *      description="Get Pegawai",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pegawai",
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
     *                  ref="#/definitions/Pegawai"
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
        /** @var Pegawai $pegawai */
        $pegawai = $this->pegawaiRepository->find($id);

        if (empty($pegawai)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/pegawais.singular')])
            );
        }

        return $this->sendResponse(
            new PegawaiResource($pegawai),
            __('messages.retrieved', ['model' => __('models/pegawais.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdatePegawaiAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/pegawais/{id}",
     *      summary="Update the specified Pegawai in storage",
     *      tags={"Pegawai"},
     *      description="Update Pegawai",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pegawai",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Pegawai that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Pegawai")
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
     *                  ref="#/definitions/Pegawai"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePegawaiAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pegawai $pegawai */
        $pegawai = $this->pegawaiRepository->find($id);

        if (empty($pegawai)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/pegawais.singular')])
            );
        }

        $pegawai = $this->pegawaiRepository->update($input, $id);

        return $this->sendResponse(
            new PegawaiResource($pegawai),
            __('messages.updated', ['model' => __('models/pegawais.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/pegawais/{id}",
     *      summary="Remove the specified Pegawai from storage",
     *      tags={"Pegawai"},
     *      description="Delete Pegawai",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pegawai",
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
        /** @var Pegawai $pegawai */
        $pegawai = $this->pegawaiRepository->find($id);

        if (empty($pegawai)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/pegawais.singular')])
            );
        }

        $pegawai->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/pegawais.singular')])
        );
    }
}
