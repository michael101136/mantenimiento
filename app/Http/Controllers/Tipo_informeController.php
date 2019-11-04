<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipo_informeRequest;
use App\Http\Requests\UpdateTipo_informeRequest;
use App\Repositories\Tipo_informeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use App\Helpers\publicFunction;
class Tipo_informeController extends AppBaseController
{
    /** @var  Tipo_informeRepository */
    private $tipoInformeRepository;

    public function __construct(Tipo_informeRepository $tipoInformeRepo)
    {
        $this->tipoInformeRepository = $tipoInformeRepo;
         $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Tipo_informe.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tipoInformes = $this->tipoInformeRepository->all();

        return view('admin.tipo_informes.index')
            ->with('tipoInformes', $tipoInformes);
    }

    /**
     * Show the form for creating a new Tipo_informe.
     *
     * @return Response
     */
    public function create()
    {
        $maxCodigo=publicFunction::maxCodigo('tipo_informes');
        $opcion=0;
        return view('admin.tipo_informes.create',['opcion'=>$opcion,'maxCodigo'=>$maxCodigo]);
    }

    /**
     * Store a newly created Tipo_informe in storage.
     *
     * @param CreateTipo_informeRequest $request
     *
     * @return Response
     */
    public function store(CreateTipo_informeRequest $request)
    {
        $input = $request->all();

        $tipoInforme = $this->tipoInformeRepository->create($input);

        Flash::success('Se guardó correctamente el tipo de informe.');

        return redirect(route('tipoInformes.index'));
    }

    /**
     * Display the specified Tipo_informe.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoInforme = $this->tipoInformeRepository->find($id);

        if (empty($tipoInforme)) {
            Flash::error('Tipo Informe not found');

            return redirect(route('tipoInformes.index'));
        }

        return view('admin.tipo_informes.show')->with('tipoInforme', $tipoInforme);
    }

    /**
     * Show the form for editing the specified Tipo_informe.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoInforme = $this->tipoInformeRepository->find($id);

        if (empty($tipoInforme)) {
            Flash::error('Tipo Informe not found');

            return redirect(route('tipoInformes.index'));
        }
         $opcion=1;
        return view('admin.tipo_informes.edit',['tipoInforme'=>$tipoInforme,'opcion'=>$opcion]);
    }

    /**
     * Update the specified Tipo_informe in storage.
     *
     * @param int $id
     * @param UpdateTipo_informeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipo_informeRequest $request)
    {
        $tipoInforme = $this->tipoInformeRepository->find($id);

        if (empty($tipoInforme)) {
            Flash::error('Tipo Informe not found');

            return redirect(route('tipoInformes.index'));
        }

        $tipoInforme = $this->tipoInformeRepository->update($request->all(), $id);

        Flash::success('Se actualizó correctamente el tipo de informe.');

        return redirect(route('tipoInformes.index'));
    }

    /**
     * Remove the specified Tipo_informe from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoInforme = $this->tipoInformeRepository->find($id);

        if (empty($tipoInforme)) {
            Flash::error('Tipo Informe not found');

            return redirect(route('tipoInformes.index'));
        }

        DB::table('tipo_informes')->where('id', '=', $id)->delete();

        Flash::success('Se eliminó correctamente el tipo de informe.');

        return redirect(route('tipoInformes.index'));
    }
}
