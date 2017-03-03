<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 19.12.2016
 * Time: 00:31
 */
namespace App\Http\Controllers;

use App\Trio;
use App\TrioChange;
use Illuminate\Http\Request;
use \Validator;

class TriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $trios = Trio::paginate(15);
        return view('pages.admin.trios.index')->withTrios($trios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.admin.trios.trio');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request  $r
     * @return Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'sentence1' => 'required',
            'sentence2' => 'required',
            'sentence3' => 'required',
            'explanation1' => 'required',
            'explanation2' => 'required',
            'explanation3' => 'required',
            'answer' => 'required'
        ]);
        if($v->fails()) {
            return redirect()->action('TriosController@create');
        } else {
            $trio = new Trio;
            foreach ($trio->getFillable() as $field) {
                $trio->$field = $request->input($field, $trio->$field);
            }
            $trio->save();
            return redirect()
                ->action('TriosController@index')
                ->with('message', 'Trio added successfully');
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
        $trio = Trio::findOrFail($id);
        return view('pages.admin.trios.show')->with('trio', $trio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $trio = Trio::findOrFail($id);
        return view('pages.admin.trios.trio')->with('trio', $trio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Trio $trio)
    {
        foreach ($trio->getFillable() as $field) {
            $this->registerChange($request, $trio, $field);
            $trio->$field = $request->input($field, $trio->$field);
        }

        $trio->save();

        return redirect("/admin/trios/{$trio->id}");
    }

    /**
     * Check if change occurred and register it.
     *
     * @param $request
     * @param $trio
     * @param $field
     */
    private function registerChange(Request $request, Trio $trio, $field)
    {
        if($trio[$field] !== $request->input($field)) {
            $trioChange = new TrioChange;

            $trioChange->trio_id = $trio->id;
            // Set to 0 if user is not logged in
            $trioChange->user_id = $request->user() ? $request->user()->id : 0;
            $trioChange->field_name = $field;
            $trioChange->before = $trio[$field];
            $trioChange->after = $request->input($field);

            $trioChange->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, Trio $trio)
    {
        $trio->delete();
        $request->session()->flash('message', 'Trio zostało usunięte!');
        return redirect()->action('TriosController@index');
    }

}
