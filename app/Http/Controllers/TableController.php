<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ApiTrait;
use App\Models\table;
use App\Models\User;

class TableController extends Controller
{
    use ApiTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = table::get();
        $message= 'list table';
        return $this->responseSuccess($message,$table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        $fields = $request->validate([
            'number'=>'required|numeric|min:1|unique:tables,number'
        ]);
        $table = auth()->user()->table()->create([
            'number'=>$fields['number'],
            'status'=>true
        ]);
        $message = 'Create table successfully';
        // return $this->responseSuccess($message,$table,201);
        return response()->json([
            "status" => "success",
            "message" => $message,
            "data" => $table
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(table $table)
    {

        $table->delete();
        return response()->json([
            'status'=>'success',
            "message" => 'delete table success',
        ],200);

    }
}
