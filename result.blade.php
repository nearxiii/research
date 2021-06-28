<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
                       integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
                       crossorigin="anonymous">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
  .container-3 {
    max-width: 1000px;
    padding-right: 15px;
    padding-left: 15px;
    padding-top: 20px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: auto;
    background-color: white;
 }
  </style>

  <title>ใบรับสิ่งส่งตรวจ</title>
</head>
<body class="bg-light ">
<div class="container d-print-none">
<div class="col-md-12 text-center" style="margin-top: 1.5rem; margin-bottom: 1.5rem">
            <button class="btn btn-info print d-print-none"  id="print">พิมพ์ใบรับสิ่งส่งตรวจ</button> </div>
        </div>

<div class="container-3 conprint " id="conprint">
<div class="row justify-content-center">
       
        <div class="col-sm-12" style=" padding-right: 2rem; padding-left: 2rem; margin-bottom: 3rem" >
         <div class="text-center"> <h5> <b>ใบส่งสิ่งส่งตรวจทางห้องปฏิบัติการ</b> </h5></div>
         <br>
         <div class="row" style="margin-bottom: 1rem">
          <div class="col-md-8 float-left"><h6> <b> ชื่อ ผู้ส่ง/หน่วยงาน</b> &nbsp;&nbsp;&nbsp;&emsp;{!! $result->researcher_name !!}</h6></div>    
             <div class="col-md-4 float-right"> <h6> <b> วันที่ส่ง </b>&nbsp;&nbsp;&nbsp;&emsp;{!! $result->created_at->format('d/m/Y') !!}</h6> </div>
              </div>
           <table id="patTable" class="table table-bordered table-sm text-center "  >
                   <thead>
                    <tr class="subtable ">
                    <th>รายการตรวจวิเคราะห์</th>
                    <th>ราคา</th>
                    <th>จำนวนสิ่งส่งตรวจ</th>
                    <th >ราคารวม </th>
                    </tr>
                    
                </thead>
                @foreach($result->reorders as $labtest)
                <tr class="subtable sub">
                  <td width="15%" class="text-left">&emsp;&emsp;{{ $labtest->labtest->lab_name }}  </td>
                  <td width="5%">{{ $labtest->price_or }}  </td>
                  <td width="5%">{{ $labtest->qty_or }}  </td>
                  <td width="5%">{{ $labtest->amount_or }}  </td>
               </tr >
                @endforeach 
                <tr class="subtable sub">
                 
                  <td colspan="3" class="text-right"> <b> รวมทั้งสิ้น &emsp;&emsp;</b> </td>
                  <td > <b> {{ $result->reorders->sum('amount_or') }} </b> </td>
                  </tr>
           </tbody>
      </table>
      <div class="row" style="margin-top: 1.5rem">
          <div class="col-md-8 float-left"><p>ผู้รับ.................................................................................  </p></h6></div>    
             <div class="col-md-4 float-right"> <h6><p>ผู้ส่ง..............................................................</p></h6> </div>
              </div>
        
      </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript" src="{{asset('js/printThis.js')}}"></script>
<script>
 $('.print').click(function(){
   window.print();
 })
</script>
</body>
</html>




