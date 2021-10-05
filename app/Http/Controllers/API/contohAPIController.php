<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecontohAPIRequest;
use App\Http\Requests\API\UpdatecontohAPIRequest;
use App\Models\contoh;
use App\Repositories\contohRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class contohController
 * @package App\Http\Controllers\API
 */

class contohAPIController extends AppBaseController
{
    /** @var  contohRepository */
    private $contohRepository;

    public function __construct(contohRepository $contohRepo)
    {
        $this->contohRepository = $contohRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/contohs",
     *      summary="Get a listing of the contohs.",
     *      tags={"contoh"},
     *      description="Get all contohs",
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
     *                  @SWG\Items(ref="#/definitions/contoh")
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
        $contohs = $this->contohRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($contohs->toArray(), 'Contohs retrieved successfully');
    }

    /**
     * @param CreatecontohAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/contohs",
     *      summary="Store a newly created contoh in storage",
     *      tags={"contoh"},
     *      description="Store contoh",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="contoh that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/contoh")
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
     *                  ref="#/definitions/contoh"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatecontohAPIRequest $request)
    {
        $input = $request->all();

        $contoh = $this->contohRepository->create($input);

        return $this->sendResponse($contoh->toArray(), 'Contoh saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/contohs/{id}",
     *      summary="Display the specified contoh",
     *      tags={"contoh"},
     *      description="Get contoh",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of contoh",
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
     *                  ref="#/definitions/contoh"
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
        /** @var contoh $contoh */
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            return $this->sendError('Contoh not found');
        }

        return $this->sendResponse($contoh->toArray(), 'Contoh retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatecontohAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/contohs/{id}",
     *      summary="Update the specified contoh in storage",
     *      tags={"contoh"},
     *      description="Update contoh",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of contoh",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="contoh that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/contoh")
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
     *                  ref="#/definitions/contoh"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatecontohAPIRequest $request)
    {
        $input = $request->all();

        /** @var contoh $contoh */
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            return $this->sendError('Contoh not found');
        }

        $contoh = $this->contohRepository->update($input, $id);

        return $this->sendResponse($contoh->toArray(), 'contoh updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/contohs/{id}",
     *      summary="Remove the specified contoh from storage",
     *      tags={"contoh"},
     *      description="Delete contoh",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of contoh",
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
        /** @var contoh $contoh */
        $contoh = $this->contohRepository->find($id);

        if (empty($contoh)) {
            return $this->sendError('Contoh not found');
        }

        $contoh->delete();

        return $this->sendSuccess('Contoh deleted successfully');
    }
}
