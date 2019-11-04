<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoRequest;
use App\Http\Requests\UpdateTipoRequest;
use App\Repositories\TipoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TipoController extends AppBaseController
{
    /** @var  TipoRepository */
    private $tipoRepository;

    public function __construct(TipoRepository $tipoRepo)
    {
        $this->tipoRepository = $tipoRepo;
         $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Tipo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tipos = $this->tipoRepository->all();

        return view('admin.tipos.index')
            ->with('tipos', $tipos);
    }

    public function listarTipos(Request $request)
    {
        $listar = $this->tipoRepository->all();

        $opcon=3;
        return response(['data' => $listar,'opcionUrl'=>$opcon]);
    }
    /**
     * Show the form for creating a new Tipo.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.tipos.create');
    }

    /**
     * Store a newly created Tipo in storage.
     *
     * @param CreateTipoRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoRequest $request)
    {
        $input = $request->all();

        $tipo = $this->tipoRepository->create($input);

        Flash::success('Se guardó correctamente el tipo.');

        return redirect(route('tipos.index'));
    }

    /**
     * Display the specified Tipo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipo = $this->tipoRepository->find($id);

        if (empty($tipo)) {
            Flash::error('Tipo not found');

            return redirect(route('tipos.index'));
        }

        return view('admin.tipos.show')->with('tipo', $tipo);
    }

    /**
     * Show the form for editing the specified Tipo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipo = $this->tipoRepository->find($id);

        if (empty($tipo)) {
            Flash::error('Tipo not found');

            return redirect(route('tipos.index'));
        }

        return view('admin.tipos.edit')->with('tipo', $tipo);
    }

    /**
     * Update the specified Tipo in storage.
     *
     * @param int $id
     * @param UpdateTipoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoRequest $request)
    {
        $tipo = $this->tipoRepository->find($id);

        if (empty($tipo)) {
            Flash::error('Tipo not found');

            return redirect(route('tipos.index'));
        }

        $tipo = $this->tipoRepository->update($request->all(), $id);

        Flash::success('Se actualizó correctamente el tipo.');

        return redirect(route('tipos.index'));
    }

    /**
     * Remove the specified Tipo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipo = $this->tipoRepository->find($id);

        if (empty($tipo)) {
            Flash::error('Tipo not found');

            return redirect(route('tipos.index'));
        }

        $this->tipoRepository->delete($id);

        Flash::success('Se eliminó correctamente el tipo.');

        return redirect(route('tipos.index'));
    }
}
