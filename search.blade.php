@extends('base')

<meta name="_token" content="{{ csrf_token() }}">
@section('main')
<div class="container-2">
<h3 class="d-inline-block align-center" style="margin-top: 1rem; margin-bottom: 1.5rem" >รายการตรวจ</h3> 

<div class="row">
<div class="col-sm-9">
        <input type="text" name="saerch" id="search" placeholder="ค้นหารายการตรวจ" class="form-control align-middle" style="margin-top: 1.1rem; margin-bottom: 1.4rem">
      </div>
             
    <div class="col-sm-3">
    
   
            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addModal" style="margin: 19px; "><i class="fas fa-plus"></i>
            เพิ่มรายการตรวจ
            </button>
            
      </div>  
     
</div>

        

    <!-- Modal add-->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title text-success" style="margin: 0 auto; " id="addModalLabel">เพิ่มรายการตรวจ</h3>
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                  <span aria-hidden="true">&times;</span>
                  </button> -->
              </div>
              <div class="modal-body">
              <div class="row">
                <div class="col-md-10 offset-sm-1">
                   <div>
                    @if ($errors->any())
                      <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div><br />
                    @endif
                      <form method="post" action="{{ route('labtest.store') }}">
                          @csrf
                          <div class="form-group">    
                              <!-- <label for="pat_name">ชื่อ-นามสกุล:</label> -->
                              <input type="text" class="form-control" name="lab_name" placeholder="ชื่อรายการตรวจ"/>
                          </div>

                          <div class="form-group">
                              <select required class="custom-select mb-3" name="lab_type">
                                  <option value="">เลือกชนิดสิ่งส่งตรวจ</option>
                                  <option value="serum/plasma">serum/plasma</option>
                                  <option value="EDTA">EDTA</option>
                                  <option value="plasma(NaF)">plasma(NaF)</option>
                                  <option value="ปัสสาวะ">ปัสสาวะ</option>
                                  <option value="อุจาระ">อุจาระ</option>
                                  <option value="น้ำคร่ำ">น้ำคร่ำ</option>
                                  <!-- <option value="4">Option 4</option>
                                  <option value="5">Option 5</option> -->
                              </select>
                          </div>
                          <div class="form-group">    
                              <!-- <label for="pat_name">ชื่อ-นามสกุล:</label> -->
                              <input type="text" class="form-control" name="lab_price" placeholder="ราคา"/>
                          </div>


                                
                          <div class="modal-footer">                
                          <button type="submit" class="btn btn-success btn-lg btn-block ">เพิ่มข้อมูล</button><br />
                          <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">ยกเลิก</button>
                          </div>
                      </form>
                  </div>
                </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
    <!-- end moal add -->


    
      <table id="labtestTable" class="table table-hover ">
        <thead>
            <tr>
              <th>ID</th>
              <th>รายการตรวจ</th>
              <th>ชนิดสิ่งส่งตรวจ</th>
              <th>ราคา</th>
              
            
            </tr>
        </thead>
            <tbody>
            
            </tbody>
      </table>
          

</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        fetch_data();
    });
    $(document).on('keyup','#search', function(){
        var query = $(this).val();
        fetch_data(query);
    });
    function fetch_data(query = '')
    {
      $.ajax({
        url:"{{ route('labtest.action')}}",
        medthod:'GET',
        data:{query:query},
        dataType:'json',
        success:function(data)
        {
          $('tbody').html(data.table_data);
        }
      })
    }
</script>
@endsection
