<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Researche;
use App\Reorder;
use App\Labtest;
use DB;
use PDF;
class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labtest_lists = DB::table('labtests')->get();
        return view('research.create')->with('labtest_lists',$labtest_lists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    public function show()
    {
        $search = \Request::get('search');
        $data = Researche::with('reorders','reorders.labtest')->where('researcher_name', 'like', '%' .$search. '%')->orderBy('created_at', 'DESC')->paginate(8);
       
        return view('research.index',compact('data'));
    }

    public function print($id)
    {
        $result = Researche::with('reorders','reorders.labtest')->find($id);
        return view('research.result',compact('result'));
    }
    
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
    public function store(Request $request)
    {
        $researchers = new Researche;
        $researchers->researcher_name=$request->researcher_name;
        $researchers->researcher_address=$request->researcher_address;
        $researchers->type_spacimen=$request->type_spacimen;
        $researchers->type_animal=$request->type_animal;
        $researchers->researcher_sent=implode(" , ",$request->researcher_sent);
        if($researchers->save()){
            $id = $researchers->id;
            foreach ($request->lab_name as $key => $t)
            {
                $data =array('researche_id'=>$id,
                             'labtest_id'=>$t,
                             'price_or'=>$request->price_or[$key],
                             'qty_or'=>$request->qty_or[$key],
                             'amount_or'=>$request->amount_or[$key]);
                Reorder::insert($data);
            }
        }
        function send_line_notify($message, $token)
            { $ch = curl_init(); curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
                    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0); 
                    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0); 
                    curl_setopt( $ch, CURLOPT_POST, 1); 
                    curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=$message"); 
                    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1); 
                    $headers = array( "Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token", ); 
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1); 
                    $result = curl_exec( $ch ); curl_close( $ch ); 
                    return $result;
            }
            
            $message =  'มีแลบวิจัยมาจ้า' ;
            $token = 'sBrrwWnTt1ftPhjAZUeFj17cUev6qDc8LdpMZEZNPee';
            echo send_line_notify($message, $token);
        return redirect('/research')->with('success', 'เพิ่มข้อมูลผู้รับบริการเรียบร้อย!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $researchs = Researche::with('reorders','reorders.labtest')->find($id);
        return view('research.edit', compact('researchs')); 
        
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
        $researchs = Researche::with('reorders','reorders.labtest')->find($id);
        $researchs->researcher_medtech =  $request->get('researcher_medtech');
        $researchs->researcher_stat =  $request->get('researcher_stat');
        $researchs->researcher_rev =  $request->get('researcher_rev');
        $researchs->money_stat =  $request->get('money_stat');
        $researchs->money_rev =  $request->get('money_rev');
       
        $researchs->save();

        return redirect('/research')->with('success', 'อัพเดทสถานะเรียบร้อย!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Researche::with('reorders','reorders.labtest')->find($id);
        $result->delete();

        return redirect('/research')->with('success', 'ลบขุ้อมูลผู้รับบริการเรียบร้อย!');
    }
    public function findPrice(Request $request)
    {
        $data=Labtest::select('lab_price')->where('id',$request->id)->first();
        return response()->json($data);
    }

    public function findlabtest()
    {
        
    }
}
