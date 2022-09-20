<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class POSTu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('User')->get();
        return $user;
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
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'required|string',
        ]);
        $fname=$request->first_name;
        $lname=$request->last_name;
        $email=$request->email;
        $insert = DB::table('User')->insert([
            'first_name'=>$fname,
            'last_name'=>$lname,
            'email'=>$email,
        ]);
        if($insert==true)
        {
            dd('them thanh cong');
        }
        else{
            return 'err';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('User')->where('user_id',$id)->get();
        return $user;
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
        $request->validate([
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'required|string',
        ]);
        $fname=$request->first_name;
        $lname=$request->last_name;
        $email=$request->email;
        $update = DB::table('User')->where('user_id',$id)->update([
            'first_name'=>$fname,
            'last_name'=>$lname,
            'email'=>$email,
        ]);
        if($update==true)
        {
            dd('sua thanh cong');
        }
        else{
            return 'err';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('User')->delete($id);
        if($delete == true)
        {
            $max = DB::table('User')->max('user_id') + 1; 
            $reset = DB::statement("ALTER TABLE Products AUTO_INCREMENT =  $max");
            if($reset == true)
            {
                $products = DB::table('User')->get();
                return json_encode($products);
            }
        }
        else{
            return 'err delete';
        }
    }
}
