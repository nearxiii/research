@extends('base')

@section('main')
<body style="background-color:white;">

    <div class="container-2" style="max-width: 1050px;">
            <div class="row">
              
                <div class="col-sm-9">
                <h3 class="display-5 text-success " style="margin-top: 1rem; margin-bottom: 1.5rem " >ลงทะเบียนรับแลบวิจัย</h3></div>
                <div class="col-sm-3">
                <a class="btn btn-success float-right" style="margin: 19px;" target="_blank" href="/labtest"><i class="fas fa-search"></i>  ค้นราคาค่าตรวจ</a></div>
                
            </div>
            @if(session()->get('success'))
              <script>
              Swal.fire({
                  type: 'success',
                  title: "{{ session('success') }}"
              });
              </script>
              @endif
    
       
        {!!Form::open(array('route'=>'store','id'=>'frmsave','method'=>'post'))!!}
        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                <label  for="date"><h5>วันที่รับ</h5></label>
                <input type="date" name="created_at" id="date" value="<?php echo date("Y-m-d");?>" class="form-control">
              </div>

              <div class="form-group">
                <label  for="name"><h5>รายละเอียดผู้ส่ง</h5></label>
                <input type="text" name="researcher_name" id="name" placeholder="ผู้ส่ง / หน่วยงาน" class="form-control">
              </div>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="researcher_address" placeholder="ที่อยู่ / e-mail / เบอร์โทร"></textarea>
              </div>
              <label ><h5>การรับผล</h5></label>
              <div class="col-sm-12">
              
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" name='researcher_sent[]' value="รับเอง">
                                <label class="custom-control-label" for="customCheck1">รับเอง</label>
                            </div> 
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="customCheck2" name='researcher_sent[]' value="email">
                                <label class="custom-control-label" for="customCheck2">email</label>
                            </div> 
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="customCheck3" name='researcher_sent[]' value="ไปษณีย์">
                                <label class="custom-control-label" for="customCheck3">ไปษณีย์</label>
                            </div> 
                          
              </div>
              <div include="form-input-select()" id="statid" >
              <label ><h5>ชนิดสิ่งส่งตรวจ</h5></label>
                    <select required class="custom-select mb-3" name="type_spacimen">
                        <option value="">เลือกชนิดสิ่งส่งตรวจ</option>
                        <option value="serum">serum</option>
                        <option value="plasma EDTA">plasma EDTA</option>
                        <option value="plasma haprin">plasma haprin</option>
                        <option value="ปัสสาวะ">ปัสสาวะ</option>
                        <option value="น้ำนม">น้ำนม</option>
                        <option value="sperm">sperm</option>
                        <option value="อุจาระ">อุจาระ</option>
                    </select>
              </div>
              <div class="form-group">
                <!-- <label for="name">ผู้ส่ง / หน่วยงาน</label> -->
                <input type="text" name="type_animal"  placeholder="ชนิดสัตว์ทดลอง" class="form-control">
              </div>
             
          </div>
          
<!-- -------------------culum right----------------------- -->
          <div class="col-md-8">
          <label ><h5>เพิ่มรายการสั่งตรวจ</h5></label>
              <div class="card" >
                <div class="card-body">
                <table  class="table " style="margin-bottom: 0rem; ">
                  <thead style="border-top: none; ">
                      <tr>
                        <th width="40%">รายการตรวจ</th>
                        <th width="20%" class="text-center">ราคา</th>
                        <th width="20%" class="text-center">จำนวน</th>
                        <th width="20%" class="text-center">รวม</th>
                        <th style="text-align:center; "><a href="#" class="btn btn-success  addRow"><i class="fas fa-plus"></i></a></th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                          <select class="form-control lab_name" name="lab_name[]" id="lab_name">
                              <option value=" ">เลือกรายการตรวจ</option>
                              @foreach($labtest_lists as $key )
                              <option value="{{$key->id}}">{{$key->lab_name}}</option>
                              @endforeach
                          </select>
                      </td>
                      <td><input type="text" name="price_or[]" style="border:none" readonly-2 class="form-control text-center price_or"></td>
                      <td><input type="text" name="qty_or[]"  class="form-control text-center qty_or"></td>
                      <td><input type="text" name="amount_or[]" style="border:none" readonly-2 class="form-control text-center amount_or"></td>
                      <td><a href="#" class="btn btn-danger  remove"><i class="fas fa-minus"></i></a></td>
                    </tr>
                  </tbody>
                  <tfoot>
                      <tr>
                          <td style="border:none" ></td>
                          <td style="border:none"></td>
                          <td class="text-right"><b>รวม</b></td>
                          <td class="text-center"><b class="total"></b></td>
                          <td style="border:none"><b>บาท</b> </td>
                      </tr>
                      <tr>
                      <td colspan="3">
                        <button type="submit" class="btn btn-info btn-block">บันทึก</button>
                        
                        </td>
                      <td colspan="2" ><a href="/research" class="btn btn-danger  btn-block">ยกเลิก</a></td>
                      </tr>
                  </tfoot>
                  
                      
          
              </div>
          </div>
        </div>
          {!!Form::hidden('_token',csrf_token())!!}
          {!!Form::close()!!}
        
    </div>  
</body>

  <script type="text/javascript">

  
    $('tbody').delegate('.lab_name','change',function(){
        var tr = $(this).parent().parent();
        var id = tr.find('.lab_name').val();
        var dataId={'id':id};
        $.ajax({
            type    : 'GET',
            url     : '{!!URL::route('findPrice')!!}',
            dataType: 'json',
            data    : dataId,
            success:function(data){
                tr.find('.price_or').val(data.lab_price);
            }
        })
    });
// ------- calulate price-----------------------------------
    $('tbody').delegate('.price_or,.qty_or','keyup',function(){
        var tr =$(this).parent().parent();
        var price = tr.find('.price_or').val();
        var qty = tr.find('.qty_or').val();
        var amount = (qty * price );
        tr.find('.amount_or').val(amount);
        total();
    });
//----- addrow and remove script ----------------------------
    $('.addRow').on('click',function(){
        addRow();
    });
// --------------calculate function-------------------------
    function total()
    {
      var total =0;
      $('.amount_or').each(function(i,e){
          var amount = $(this).val()-0;
          total +=amount;
      })
      $('.total').html(total);
    }
// ----------------addrow function ------------------------
    function addRow()
    {
      var tr='<tr>'+
                  '<td>'+
                  '<select class="form-control lab_name" name="lab_name[]" id="lab_name">'+
                  '<option value=" ">เลือกรายการตรวจ</option>'+
                  '@foreach($labtest_lists as $key)'+
                  '<option value="{{$key->id}}">{{$key->lab_name}}</option>'+
                  '@endforeach'+
                  '</select>'+
                  '</td>'+
                  '<td><input type="text" name="price_or[]" style="border:none"  class="form-control text-center price_or"></td>'+
                  '<td><input type="text" name="qty_or[]"  class="form-control text-center qty_or"></td>'+
                  '<td><input type="text" name="amount_or[]" style="border:none"  class="form-control text-center amount_or"></td>'+
                  '<td><a href="#" class="btn btn-danger  remove"><i class="fas fa-minus"></i></a></td>'+
                  '</tr>';
      $('tbody').append(tr);
    };
// ------------------remove row script-------------------------------
    $(document).on('click', '.remove', function(){
      var l=$('tbody tr').length;
      if (l==1){
        Swal.fire({
                            type: 'error',
                            title: 'ไม่สามารถลบได้!',
                            text: 'กรุณาเพิ่มรายการตรวจ',
                            
                            });
        
      }else{
        $(this).closest('tr').remove();
        total();
      }
 });
// ----------------select 2-----------------


 
  </script>




@endsection