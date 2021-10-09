<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Repositories\PegawaiRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Response;

class PegawaiController extends AppBaseController
{
    /** @var  PegawaiRepository */
    private $pegawaiRepository;

    public function __construct(PegawaiRepository $pegawaiRepo)
    {
        $this->pegawaiRepository = $pegawaiRepo;
    }

    /**
     * Display a listing of the Pegawai.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $pegawais = $this->pegawaiRepository->paginate(10);

        return view('pegawais.index')
            ->with('pegawais', $pegawais);
    }

    /**
     * Show the form for creating a new Pegawai.
     *
     * @return Response
     */
    public function create()
    {
        return view('pegawais.create');
    }

    /**
     * Store a newly created Pegawai in storage.
     *
     * @param CreatePegawaiRequest $request
     *
     * @return Response
     */
    public function store(CreatePegawaiRequest $request)
    {
        $input = $request->all();
        // $input = $request->collect();
        // var_dump($input['image']);
        foreach ($input as $value) {
            var_dump($value);
        }
        die;
        if ($request->hasFile('image')){

            //Validate the uploaded file
            $Validation = $request->validate([
    
                'image' => 'required|file|mimes:png,jpg,pdf|max:30000'
            ]);
    
            // cache the file
            $file = $Validation['image'];
    
            // generate a new filename. getClientOriginalExtension() for the file extension
            $filename = 'image-' . time() . '.' . $file->getClientOriginalExtension();
    
            // save to storage/app/infrastructure as the new $filename
            $imageFileName = $file->storeAs('image', $filename);
    
            $path = "/storage/app/public/".$imageFileName;
        }
    
        $input['image'] = $path;

        $pegawai = $this->pegawaiRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/pegawais.singular')]));

        return redirect(route('pegawais.index'));
    }

    /**
     * Display the specified Pegawai.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pegawai = $this->pegawaiRepository->find($id);

        if (empty($pegawai)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pegawais.singular')]));

            return redirect(route('pegawais.index'));
        }

        return view('pegawais.show')->with('pegawai', $pegawai);
    }

    /**
     * Show the form for editing the specified Pegawai.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pegawai = $this->pegawaiRepository->find($id);

        if (empty($pegawai)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pegawais.singular')]));

            return redirect(route('pegawais.index'));
        }

        return view('pegawais.edit')->with('pegawai', $pegawai);
    }

    /**
     * Update the specified Pegawai in storage.
     *
     * @param int $id
     * @param UpdatePegawaiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePegawaiRequest $request)
    {
        $pegawai = $this->pegawaiRepository->find($id);

        if (empty($pegawai)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pegawais.singular')]));

            return redirect(route('pegawais.index'));
        }

        $pegawai = $this->pegawaiRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/pegawais.singular')]));

        return redirect(route('pegawais.index'));
    }

    /**
     * Remove the specified Pegawai from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pegawai = $this->pegawaiRepository->find($id);

        if (empty($pegawai)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pegawais.singular')]));

            return redirect(route('pegawais.index'));
        }

        $this->pegawaiRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/pegawais.singular')]));

        return redirect(route('pegawais.index'));
    }
}
