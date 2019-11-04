<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedidorRequest;
use App\Http\Requests\UpdateMedidorRequest;
use App\Repositories\MedidorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Helpers\publicFunction; 
use DB;
class MedidorController extends AppBaseController
{
    /** @var  MedidorRepository */
    private $medidorRepository;

    public function __construct(MedidorRepository $medidorRepo)
    {
        $this->medidorRepository = $medidorRepo;
          $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Medidor.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $medidors = $this->medidorRepository->all();

        return view('admin.medidors.index')
            ->with('medidors', $medidors);
    }

    /**
     * Show the form for creating a new Medidor.
     *
     * @return Response
     */
    public function create()
    {
        $max=publicFunction::maxCodigo('medidors');
        return view('admin.medidors.create')->with('opcion',0)->with('max',$max);
    }

    /**
     * Store a newly created Medidor in storage.
     *
     * @param CreateMedidorRequest $request
     *
     * @return Response
     */
    public function store(CreateMedidorRequest $request)
    {
        $input = $request->all();

        $medidor = $this->medidorRepository->create($input);

        Flash::success('Medidor saved successfully.');

        return redirect(route('medidors.index'));
    }

    /**
     * Display the specified Medidor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medidor = $this->medidorRepository->find($id);

        if (empty($medidor)) {
            Flash::error('Medidor not found');

            return redirect(route('medidors.index'));
        }

        return view('admin.medidors.show')->with('medidor', $medidor);
    }

    /**
     * Show the form for editing the specified Medidor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medidor = $this->medidorRepository->find($id);

        if (empty($medidor)) {
            Flash::error('Medidor not found');

            return redirect(route('medidors.index'));
        }

        return view('admin.medidors.edit')->with('medidor', $medidor)->with('opcion',1);
    }

    /**
     * Update the specified Medidor in storage.
     *
     * @param int $id
     * @param UpdateMedidorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedidorRequest $request)
    {
        $medidor = $this->medidorRepository->find($id);

        if (empty($medidor)) {
            Flash::error('Medidor not found');

            return redirect(route('medidors.index'));
        }

        $medidor = $this->medidorRepository->update($request->all(), $id);

        Flash::success('Se actualizó correctamente el medidor.');

        return redirect(route('medidors.index'));
    }

    /**
     * Remove the specified Medidor from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medidor = $this->medidorRepository->find($id);

        if (empty($medidor)) {
            Flash::error('Medidor not found');

            return redirect(route('medidors.index'));
        }

        DB::table('medidors')->where('id', '=', $id)->delete();
        Flash::success('Se eliminó correctamente.');

        return redirect(route('medidors.index'));
    }

    public function listarMedidor(Request $request)
    {
        $listar = $this->medidorRepository->all();
        return response(['data' => $listar]);
    }
     
}
