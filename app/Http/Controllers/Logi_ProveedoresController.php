<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLogi_ProveedoresRequest;
use App\Http\Requests\UpdateLogi_ProveedoresRequest;
use App\Repositories\Logi_ProveedoresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class Logi_ProveedoresController extends AppBaseController
{
    /** @var  Logi_ProveedoresRepository */
    private $logiProveedoresRepository;

    public function __construct(Logi_ProveedoresRepository $logiProveedoresRepo)
    {
        $this->logiProveedoresRepository = $logiProveedoresRepo;
          $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Logi_Proveedores.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logiProveedores = $this->logiProveedoresRepository->all();

        return view('admin.logi__proveedores.index')
            ->with('logiProveedores', $logiProveedores);
    }

    /**
     * Show the form for creating a new Logi_Proveedores.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.logi__proveedores.create');
    }

    /**
     * Store a newly created Logi_Proveedores in storage.
     *
     * @param CreateLogi_ProveedoresRequest $request
     *
     * @return Response
     */
    public function store(CreateLogi_ProveedoresRequest $request)
    {
        $input = $request->all();

        $logiProveedores = $this->logiProveedoresRepository->create($input);

        Flash::success('Se guardó correctamente los proveedores.');

        return redirect(route('logiProveedores.index'));
    }

    /**
     * Display the specified Logi_Proveedores.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logiProveedores = $this->logiProveedoresRepository->find($id);

        if (empty($logiProveedores)) {
            Flash::error('Logi  Proveedores not found');

            return redirect(route('logiProveedores.index'));
        }

        return view('admin.logi__proveedores.show')->with('logiProveedores', $logiProveedores);
    }

    /**
     * Show the form for editing the specified Logi_Proveedores.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logiProveedores = $this->logiProveedoresRepository->find($id);

        if (empty($logiProveedores)) {
            Flash::error('Logi  Proveedores not found');

            return redirect(route('logiProveedores.index'));
        }

        return view('admin.logi__proveedores.edit')->with('logiProveedores', $logiProveedores);
    }

    /**
     * Update the specified Logi_Proveedores in storage.
     *
     * @param int $id
     * @param UpdateLogi_ProveedoresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLogi_ProveedoresRequest $request)
    {
        $logiProveedores = $this->logiProveedoresRepository->find($id);

        if (empty($logiProveedores)) {
            Flash::error('Logi  Proveedores not found');

            return redirect(route('logiProveedores.index'));
        }

        $logiProveedores = $this->logiProveedoresRepository->update($request->all(), $id);

        Flash::success('Se actualizó correctamente los proovedores.');

        return redirect(route('logiProveedores.index'));
    }

    /**
     * Remove the specified Logi_Proveedores from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logiProveedores = $this->logiProveedoresRepository->find($id);

        if (empty($logiProveedores)) {
            Flash::error('Logi  Proveedores not found');

            return redirect(route('logiProveedores.index'));
        }

        $this->logiProveedoresRepository->delete($id);

        Flash::success('Se eliminó correctamente los proveedores.');

        return redirect(route('logiProveedores.index'));
    }
}
