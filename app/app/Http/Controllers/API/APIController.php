<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $json_array = DB::table('User')->join('EmploymentsTable','User.user_id','=','EmploymentsTable.employment_id')->get();
        if($json_array==true){

            $jsond_array = json_decode($json_array,true);
            foreach($jsond_array as $value)
            {
                return[
                    'user_id'=>$value['user_id'],
                    'first_name'=>$value['first_name'],
                    'last_name'=>$value['last_name'],
                    'email'=>$value['email'],
                    'employment'=>[
                        'employment_id'=>$value['employment_id'],
                        'company_name'=>$value['company_name'],
                        'job_title'=>$value['job_title'],
                        'start_date'=>$value['start_date'],
                        'end_date'=>$value['end_date'],
                    ]
                    ];
            }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
