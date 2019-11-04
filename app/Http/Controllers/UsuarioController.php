<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Repositories\UsuarioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\User;
use Datatables;
use Illuminate\Support\Facades\Auth;
use DB;
class UsuarioController extends AppBaseController
{
    /** @var  UsuarioRepository */
    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepo)
    {
        $this->usuarioRepository = $usuarioRepo;
         $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Usuario.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        
        $user = Auth::user();


        $usuarios = User::all();
        return view('admin.usuarios.index')->with('usuarios', $usuarios);
    }

    public function usersList()
    {
        $users = DB::table('users')->select('*');
        return datatables()->of($users)
            ->make(true);
    }

    /**
     * Show the form for creating a new Usuario.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created Usuario in storage.
     *
     * @param CreateUsuarioRequest $request
     *
     * @return Response
     */
    public function store(CreateUsuarioRequest $request)
    {

      
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt( $request->input('password') ),
            'privilege'=>$request->privilege,
            'status'=>'A',
            'id_empresa'=>$request->id_empresa,
          ]);

        Flash::success('Usuario saved successfully.');

        return redirect(route('usuarios.index'));
    }

    /**
     * Display the specified Usuario.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $usuario = User::find($id);

        if (empty($usuario)) {
            Flash::error('Usuario not found');

            return redirect(route('admin.usuarios.index'));
        }

        return view('admin.usuarios.show')->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified Usuario.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);

        if (empty($usuario)) {
            Flash::error('Usuario not found');

            return redirect(route('admin.usuarios.index'));
        }

        return view('admin.usuarios.edit')->with('usuario', $usuario);
    }

    /**
     * Update the specified Usuario in storage.
     *
     * @param int $id
     * @param UpdateUsuarioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsuarioRequest $request)
    {

        $usuario = User::find($id);
        if (empty($usuario)) {
            Flash::error('Usuario not found');

            return redirect(route('usuarios.index'));
        }
        if(is_null($request->password))
        {

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->privilege = $request->privilege;
            $user->save();

        }else
        {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->privilege = $request->privilege;
            $user->password = bcrypt( $request->input('password') );
            $user->save();

        }

        Flash::success('Usuario updated successfully.');

        return redirect(route('usuarios.index'));
    }

    /**
     * Remove the specified Usuario from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);

        if (empty($usuario)) {
            Flash::error('Usuario not found');

            return redirect(route('usuarios.index'));
        }

        $user = User::find($id);

        $user->delete();


        Flash::success('Usuario deleted successfully.');

        return redirect(route('usuarios.index'));
    }
}
