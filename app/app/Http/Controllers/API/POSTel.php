<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class POSTel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('EmploymentsTable')->get();
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rq)
    {
        $rq->validate([
            'company_name'=>'required|string',
            'job_title'=>'required|string',
            'start_date'=>'required|date',
            'end_date'=>'nullable|date',
            'user_id'=>'required|integer',
        ]);
        $name = $rq->company_name;
        $title = $rq->job_title;
        $start = $rq->start_date;
        $end = $rq->end_date;
        $uid = $rq->user_id;
        $user = DB::table('EmploymentsTable')->insert([
            'company_name'=>$name,
            'job_title'=>$title,
            'start_date'=>$start,
            'end_date'=>$end,
            'user_id'=>$uid
        ]);
        if($user==true)
        {
            $get = DB::table('EmploymentsTable')->get();
            return json_decode($get);
        }
        else{
            return response([
                'error'=>[
                    'code'=>403,
                    'message'=>'Forbidden',
                ]
            ]);
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
        $user = DB::table('EmploymentsTable')->where('employment_id',$id)->get();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $rq, $id)
    {
        $rq->validate([
            'company_name'=>'required|string',
            'job_title'=>'required|string',
            'start_date'=>'required|date',
            'end_date'=>'nullable|date',
            'user_id'=>'required|integer',
        ]);
        $name = $rq->company_name;
        $title = $rq->job_title;
        $start = $rq->start_date;
        $end = $rq->end_date;
        $uid = $rq->user_id;
        $user = DB::table('EmploymentsTable')->where('employment_id',$id)->update([
            'company_name'=>$name,
            'job_title'=>$title,
            'start_date'=>$start,
            'end_date'=>$end,
            'user_id'=>$uid
        ]);
        if($user==true)
        {
            $get = DB::table('EmploymentsTable')->get();
            return json_decode($get);
        }
        else{
            return [
                'error'=>[
                    'code'=>403,
                    'message'=>'Forbidden',
                ]
            ];
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
        $delete = DB::table('EmploymentsTable')->where('employment_id',$id)->delete();
        if($delete == true)
        {
            $max = DB::table('EmploymentsTable')->max('employment_id') + 1; 
            $reset = DB::statement("ALTER TABLE Products AUTO_INCREMENT =  $max");
            if($reset == true)
            {
                $products = DB::table('EmploymentsTable')->get();
                return json_encode($products);
            }
        }
        else{
            return 'err delete';
        }
    }
}
