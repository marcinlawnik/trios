<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 19.12.2016
 * Time: 00:31
 */
namespace App\Http\Controllers;

use App\Trio;
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
        $trios = Trio::all();
        return view('pages.admin.trios.index')->withTrios($trios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.admin.trios.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request  $r
     * @return Response
     */
    public function store(Request $r)
    {
        $v = Validator::make($r->all(), [
            's1' => 'required',
            's2' => 'required',
            's3' => 'required',
            'e1' => 'required',
            'e2' => 'required',
            'e3' => 'required',
            'a' => 'required'
        ]);
        if($v->fails()) {
            return redirect('/trios/create');
        } else {
            $trios = new Trio;
            $trios->sentence1 = $r->input('s1');
            $trios->sentence2 = $r->input('s2');
            $trios->sentence3 = $r->input('s3');
            $trios->explanation1 = $r->input('e1');
            $trios->explanation2 = $r->input('e2');
            $trios->explanation3 = $r->input('e3');
            $trios->answer = $r->input('a');
            $trios->save();
            return redirect('/trios/create')->with('msg', 'Success');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}