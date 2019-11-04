<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFrecuenciaRequest;
use App\Http\Requests\UpdateFrecuenciaRequest;
use App\Repositories\FrecuenciaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
class FrecuenciaController extends AppBaseController
{
    /** @var  FrecuenciaRepository */
    private $frecuenciaRepository;

    public function __construct(FrecuenciaRepository $frecuenciaRepo)
    {
        $this->frecuenciaRepository = $frecuenciaRepo;
         $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Frecuencia.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $frecuencias = $this->frecuenciaRepository->all();

        return view('admin.frecuencias.index')
            ->with('frecuencias', $frecuencias);
    }

    /**
     * Show the form for creating a new Frecuencia.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.frecuencias.create');
    }

    /**
     * Store a newly created Frecuencia in storage.
     *
     * @param CreateFrecuenciaRequest $request
     *
     * @return Response
     */
    public function store(CreateFrecuenciaRequest $request)
    {
        $input = $request->all();

        $frecuencia = $this->frecuenciaRepository->create($input);

        Flash::success('Frecuencia saved successfully.');

        return redirect(route('frecuencias.index'));
    }

    /**
     * Display the specified Frecuencia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $frecuencia = $this->frecuenciaRepository->find($id);

        if (empty($frecuencia)) {
            Flash::error('Frecuencia not found');

            return redirect(route('frecuencias.index'));
        }

        return view('admin.frecuencias.show')->with('frecuencia', $frecuencia);
    }

    /**
     * Show the form for editing the specified Frecuencia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $frecuencia = $this->frecuenciaRepository->find($id);

        if (empty($frecuencia)) {
            Flash::error('Frecuencia not found');

            return redirect(route('frecuencias.index'));
        }

        return view('admin.frecuencias.edit')->with('frecuencia', $frecuencia);
    }

    /**
     * Update the specified Frecuencia in storage.
     *
     * @param int $id
     * @param UpdateFrecuenciaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFrecuenciaRequest $request)
    {
        $frecuencia = $this->frecuenciaRepository->find($id);

        if (empty($frecuencia)) {
            Flash::error('Frecuencia not found');

            return redirect(route('frecuencias.index'));
        }

        $frecuencia = $this->frecuenciaRepository->update($request->all(), $id);

        Flash::success('Frecuencia updated successfully.');

        return redirect(route('frecuencias.index'));
    }

    /**
     * Remove the specified Frecuencia from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $frecuencia = $this->frecuenciaRepository->find($id);

        if (empty($frecuencia)) {
            Flash::error('Frecuencia not found');

            return redirect(route('frecuencias.index'));
        }

         DB::table('frecuencias')->where('id', '=', $id)->delete();

        Flash::success('La frecuencia se elimino.');

        return redirect(route('frecuencias.index'));
    }
}
