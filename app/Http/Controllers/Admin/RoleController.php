<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permission::all();
        return view('admin.roles.create',compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);
        return redirect(route('admin.roles.edit',$role))->with('mensaje','El Rol de Usuario se créo correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permisos = Permission::all();
        return view('admin.roles.edit',compact('role','permisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);
        return redirect(route('admin.roles.edit',$role))->with('mensaje','El rol se actualizó con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if($role->name == 'Admin' || $role->name == 'Blogger'){   
            return redirect(route('admin.roles.index'))->with('eliminar',"No puedes eliminar el rol: " . $role->name);
        }
        else     
        {
            $role->delete();
            return redirect(route('admin.roles.index'))->with('mensaje',"Se ha eliminado el rol: " . $role->name);
        }
    }
}
