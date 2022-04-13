<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBeritaAPIRequest;
use App\Http\Requests\API\UpdateBeritaAPIRequest;
use App\Models\Berita;
use App\Repositories\BeritaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\BeritaResource;
use Response;

/**
 * Class BeritaController
 * @package App\Http\Controllers\API
 */

class BeritaAPIController extends AppBaseController
{
    /** @var  BeritaRepository */
    private $beritaRepository;

    public function __construct(BeritaRepository $beritaRepo)
    {
        $this->beritaRepository = $beritaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/beritas",
     *      summary="Get a listing of the Beritas.",
     *      tags={"Berita"},
     *      description="Get all Beritas",
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
     *                  @SWG\Items(ref="#/definitions/Berita")
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
        $beritas = $this->beritaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            BeritaResource::collection($beritas),
            __('messages.retrieved', ['model' => __('models/beritas.plural')])
        );
    }

    /**
     * @param CreateBeritaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/beritas",
     *      summary="Store a newly created Berita in storage",
     *      tags={"Berita"},
     *      description="Store Berita",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Berita that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Berita")
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
     *                  ref="#/definitions/Berita"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBeritaAPIRequest $request)
    {
        $input = $request->all();

        $berita = $this->beritaRepository->create($input);

        return $this->sendResponse(
            new BeritaResource($berita),
            __('messages.saved', ['model' => __('models/beritas.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/beritas/{id}",
     *      summary="Display the specified Berita",
     *      tags={"Berita"},
     *      description="Get Berita",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Berita",
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
     *                  ref="#/definitions/Berita"
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
        /** @var Berita $berita */
        $berita = $this->beritaRepository->find($id);

        if (empty($berita)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/beritas.singular')])
            );
        }

        return $this->sendResponse(
            new BeritaResource($berita),
            __('messages.retrieved', ['model' => __('models/beritas.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateBeritaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/beritas/{id}",
     *      summary="Update the specified Berita in storage",
     *      tags={"Berita"},
     *      description="Update Berita",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Berita",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Berita that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Berita")
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
     *                  ref="#/definitions/Berita"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBeritaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Berita $berita */
        $berita = $this->beritaRepository->find($id);

        if (empty($berita)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/beritas.singular')])
            );
        }

        $berita = $this->beritaRepository->update($input, $id);

        return $this->sendResponse(
            new BeritaResource($berita),
            __('messages.updated', ['model' => __('models/beritas.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/beritas/{id}",
     *      summary="Remove the specified Berita from storage",
     *      tags={"Berita"},
     *      description="Delete Berita",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Berita",
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
        /** @var Berita $berita */
        $berita = $this->beritaRepository->find($id);

        if (empty($berita)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/beritas.singular')])
            );
        }

        $berita->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/beritas.singular')])
        );
    }
}
