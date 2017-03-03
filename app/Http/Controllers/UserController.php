<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('pages.admin.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request  $r
     * @return Response
     */
    public function store(Request $r)
    {
        $v = Validator::make($r->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        if($v->fails()) {
            return redirect('/user/create');
        } else {
            $user = new User;
            $user->name = $r->input('name');
            $user->passowrd = $r->input('password');
            $user->email = $r->input('email');
            $user->role = $r->input('role');
            $user->save();
            return redirect('admin/user/create')->with('msg', 'Success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.user.show')->with('trio', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.trios.edit')->with('trio', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        foreach ($user->getFillable() as $field) {
            $this->registerChange($request, $user, $field);
            $user->$field = $request->input($field, $user->$field);
        }

        $user->save();

        return redirect("/admin/user/{$user->id}");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        $request->session()->flash('message', 'Użytkownik został usunięty!');
        return redirect()->action('TriosController@index');
    }
}