<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePonenteRequest;
use App\Http\Requests\UpdatePonenteRequest;
use App\Repositories\PonenteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PonenteController extends AppBaseController
{
    /** @var  PonenteRepository */
    private $ponenteRepository;

    public function __construct(PonenteRepository $ponenteRepo)
    {
        $this->ponenteRepository = $ponenteRepo;
        $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Ponente.
     *
     * @param Request $request
     *
     * @return Response
     */

     public function getPonentes()
     {

        return $this->ponenteRepository->all();
     }

     public function guardar(Request $request)
     {
         $this->validate($request,[
            'name' => 'required',
            'apellido' => 'required'
         ]);
         $input = $request->all();
         $ponente = $this->ponenteRepository->create($input);
         return;
     }

    public function index(Request $request)
    {
        $ponentes = $this->ponenteRepository->all();

        return view('admin.ponentes.index')
            ->with('ponentes', $ponentes);
    }

    /**
     * Show the form for creating a new Ponente.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.ponentes.create');
    }

    /**
     * Store a newly created Ponente in storage.
     *
     * @param CreatePonenteRequest $request
     *
     * @return Response
     */
    public function store(CreatePonenteRequest $request)
    {
        $input = $request->all();

        $ponente = $this->ponenteRepository->create($input);

        Flash::success('Ponente saved successfully.');

        return redirect(route('ponentes.index'));
    }

    /**
     * Display the specified Ponente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ponente = $this->ponenteRepository->find($id);

        if (empty($ponente)) {
            Flash::error('Ponente not found');

            return redirect(route('ponentes.index'));
        }

        return view('admin.ponentes.show')->with('ponente', $ponente);
    }

    /**
     * Show the form for editing the specified Ponente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ponente = $this->ponenteRepository->find($id);

        if (empty($ponente)) {
            Flash::error('Ponente not found');

            return redirect(route('ponentes.index'));
        }

        return view('admin.ponentes.edit')->with('ponente', $ponente);
    }

    /**
     * Update the specified Ponente in storage.
     *
     * @param int $id
     * @param UpdatePonenteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePonenteRequest $request)
    {
        $ponente = $this->ponenteRepository->find($id);

        if (empty($ponente)) {
            Flash::error('Ponente not found');

            return redirect(route('ponentes.index'));
        }

        $ponente = $this->ponenteRepository->update($request->all(), $id);

        Flash::success('Ponente updated successfully.');

        return redirect(route('ponentes.index'));
    }

    /**
     * Remove the specified Ponente from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ponente = $this->ponenteRepository->find($id);

        if (empty($ponente)) {
            Flash::error('Ponente not found');

            return redirect(route('ponentes.index'));
        }

        $this->ponenteRepository->delete($id);

        Flash::success('Ponente deleted successfully.');

        return redirect(route('ponentes.index'));
    }
}
