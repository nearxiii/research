<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\labtest;
use DB;

class LabtestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labtests = labtest::all();
        $labtests = labtest::orderBy('id','asc')->paginate(8);

        return view('labtest.search', compact('labtests'));
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
    public function store(Request $request)
    {
        $request->validate([
            'lab_name'=>'required',
            'lab_price'=>'required',
            
        ]);
        
        $labtests = new labtest([
            'lab_name' => $request->get('lab_name'),
            'lab_type' => $request->get('lab_type'),
            'lab_price' => $request->get('lab_price')
            ]);
        $labtests->save();
        return redirect('labtest')->with('success', 'เพิ่มข้อมูลผู้รับบริการเรียบร้อย!');
    
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
    public function destroy($id)
    {
        //
    }

    function search(){
        return view('labtest.search');
    }

    function action(Request $request){
        if($request->ajax()){
            $output='';
            $result=$request->get('query');
            if($result !=''){
                $data=DB::table('labtests')->where('lab_name','like','%'.$result.'%')->get();
            }else{
                $data=DB::table('labtests')->get();
            }
            $total_row=$data->count();
            if($total_row>0){
                foreach ($data as $row) {
                    $output.='<tr>
                    <td>'.$row->id.'</td>
                    <td>'.$row->lab_name.'</td>
                    <td>'.$row->lab_type.'</td>
                    <td>'.$row->lab_price.'</td>
                    </tr>';
                }
            }else{
                $output="<tr><td alige='center' colspan='5'>ไม่พบรายการที่ค้นหา</td></tr>";
            }
            $data=array('table_data'=>$output);
            echo json_encode($data);
        }
    }
}
