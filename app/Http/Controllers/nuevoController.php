<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatenuevoRequest;
use App\Http\Requests\UpdatenuevoRequest;
use App\Repositories\nuevoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class nuevoController extends AppBaseController
{
    /** @var  nuevoRepository */
    private $nuevoRepository;

    public function __construct(nuevoRepository $nuevoRepo)
    {
        $this->nuevoRepository = $nuevoRepo;
    }

    /**
     * Display a listing of the nuevo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $nuevos = $this->nuevoRepository->all();

        return view('nuevos.index')
            ->with('nuevos', $nuevos);
    }

    /**
     * Show the form for creating a new nuevo.
     *
     * @return Response
     */
    public function create()
    {
        return view('nuevos.create');
    }

    /**
     * Store a newly created nuevo in storage.
     *
     * @param CreatenuevoRequest $request
     *
     * @return Response
     */
    public function store(CreatenuevoRequest $request)
    {
        $input = $request->all();

        $nuevo = $this->nuevoRepository->create($input);

        Flash::success('Nuevo saved successfully.');

        return redirect(route('nuevos.index'));
    }

    /**
     * Display the specified nuevo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nuevo = $this->nuevoRepository->find($id);

        if (empty($nuevo)) {
            Flash::error('Nuevo not found');

            return redirect(route('nuevos.index'));
        }

        return view('nuevos.show')->with('nuevo', $nuevo);
    }

    /**
     * Show the form for editing the specified nuevo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nuevo = $this->nuevoRepository->find($id);

        if (empty($nuevo)) {
            Flash::error('Nuevo not found');

            return redirect(route('nuevos.index'));
        }

        return view('nuevos.edit')->with('nuevo', $nuevo);
    }

    /**
     * Update the specified nuevo in storage.
     *
     * @param int $id
     * @param UpdatenuevoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatenuevoRequest $request)
    {
        $nuevo = $this->nuevoRepository->find($id);

        if (empty($nuevo)) {
            Flash::error('Nuevo not found');

            return redirect(route('nuevos.index'));
        }

        $nuevo = $this->nuevoRepository->update($request->all(), $id);

        Flash::success('Nuevo updated successfully.');

        return redirect(route('nuevos.index'));
    }

    /**
     * Remove the specified nuevo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nuevo = $this->nuevoRepository->find($id);

        if (empty($nuevo)) {
            Flash::error('Nuevo not found');

            return redirect(route('nuevos.index'));
        }

        $this->nuevoRepository->delete($id);

        Flash::success('Nuevo deleted successfully.');

        return redirect(route('nuevos.index'));
    }
}
