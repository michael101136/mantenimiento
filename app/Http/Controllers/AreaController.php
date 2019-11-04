<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Repositories\AreaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use App\Helpers\publicFunction;
class AreaController extends AppBaseController
{
    /** @var  AreaRepository */
    private $areaRepository;

    public function __construct(AreaRepository $areaRepo)
    {
        $this->areaRepository = $areaRepo;
         $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Area.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        
        $areas=DB::table('areas')->where('deleted_at','=',null)->get();
        return view('admin.areas.index')
            ->with('areas', $areas);
    }

    /**
     * Show the form for creating a new Area.
     *
     * @return Response
     */
    public function create()
    {
        
        $max=publicFunction::maxCodigo('areas');
       
        $opcion=0;
        
        return view('admin.areas.create',['max'=>$max,'opcion'=>$opcion]);
        
    }

    /**
     * Store a newly created Area in storage.
     *
     * @param CreateAreaRequest $request
     *
     * @return Response
     */
    public function store(CreateAreaRequest $request)
    {
        $input = $request->all();

        $area = $this->areaRepository->create($input);

        Flash::success('El area se guardo correctamente.');

        return redirect(route('areas.index'));
    }

    /**
     * Display the specified Area.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            Flash::error('Area not found');

            return redirect(route('areas.index'));
        }

        return view('admin.areas.show')->with('area', $area);
    }

    /**
     * Show the form for editing the specified Area.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            Flash::error('Area not found');

            return redirect(route('areas.index'));
        }
        
        $opcion=1;
        
        return view('admin.areas.edit',['area'=>$area,'opcion'=>$opcion]);
    }

    /**
     * Update the specified Area in storage.
     *
     * @param int $id
     * @param UpdateAreaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAreaRequest $request)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            Flash::error('Area not found');

            return redirect(route('areas.index'));
        }

        $area = $this->areaRepository->update($request->all(), $id);

        Flash::success('El área se actualizó correctamente.');

        return redirect(route('areas.index'));
    }

    /**
     * Remove the specified Area from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            Flash::error('Area not found');

            return redirect(route('areas.index'));
        }

        DB::table('areas')->where('id', '=',$id)->delete();
        Flash::success('Se elimino el Area.');

        return redirect(route('areas.index'));
    }
    
    public function area_listar()
    {
         $area = db::table('areas')
           ->select('areas.id','areas.nombre','areas.codigo')
           ->get();
        return datatables()->of($area)
            ->make(true);
    }
}
