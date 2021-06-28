@extends('base')

<meta name="_token" content="{{ csrf_token() }}">
@section('main')
<script>
  $(document).ready(function(){
    $('.subtable').hide();


    $('.btn_subtable_show').click(function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('.sub'+id).toggle();
        
    })
    $('.btn_subtable_hide').click(function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('.sub'+id).hide();
    })
    $('.show_hide').click(function(){
        $('.subtable').toggle();
        $(this).val( $(this).val() == 'แสดงทั้งหมด' ? 'ซ่อนทั้งหมด' : 'แสดงทั้งหมด' );
    })
    // $('.btn_subtable_hideall').click(function(){
    //     $('.subtable').hide();
    // })

    // ---------change btn------------
    $(".btn_subtable_show").click(function() {
        $(this).children().toggleClass('fa-angle-down fa-angle-up');
        })

        
  });
  
</script>

<div class="row">
    <div class="col-sm-12">
    <div class="row"  style="margin-top: 1rem;">
    <div class="col-md-5">
    <h3 class="d-inline-block align-middle " style="margin-top: 1rem; margin-bottom: 1.5rem" >รายชื่อผู้รับบริการ</h3></div> 
       <!-- <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addModal" style="margin: 19px; "><i class="fas fa-plus"></i>
        เพิ่มผู้รับบริการ
        </button> -->
        <div class="col-md-4">
        <form action="/research/search" method="GET">
        <div class="input-group  " style="margin-top: 1rem; margin-bottom: 1.5rem">
          <input type="search" name="search"  class="form-control ">
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary ">ค้นหา</button>
          </span>
        </div>
        </form>
        </div>
        <div class="col-md-3">
        <!-- <button type="button" class="btn btn-warning btn_subtable_hideall"  >ซ่อนทั้งหมด</button> -->
        <a href="/research/create" class="btn btn-success float-right" style="margin-top: 1rem; margin-bottom: 1.5rem; "><i class="fas fa-plus"></i> ลงทะเบียนแลบวิจัย</a>
        <input type="button" class="btn btn-warning show_hide float-right" style="margin-top: 1rem; margin-bottom: 1.5rem; margin-right: 1rem;" value="แสดงทั้งหมด"> 
        </div>
        <!-- <button type="button" class="btn btn-primary btn_subtable_all"  >แสดงทั้งหมด</button> -->
        </div>
        </div> 
    <div class="col-sm-12">
    
        @if(session()->get('success'))
          <script>
            Swal.fire({
              type: 'success',
              title: "{{ session('success') }}"
            });
          </script>
        @endif
</div>
    <div class="col-sm-12">
       <table id="patTable" class="table table-hover ">
        <thead>
            <tr>
            <th></th>
              <th width="8%">วันที่</th>
              <th width="15%">ผู้ส่ง/โครงการวิจัย</th>
              <th>การรับผล</th>
              <th>ติดต่อ</th>
              <th>สถานะ</th>
              <th>ผู้รายงาน</th>
              <th>การชำระเงิน</th>
              <th width="10%" colspan="2">การอัพเดท</th>
              
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td width="3%" style="padding: .3rem;" ><button type="button" class="btn btn-link btn_subtable_show" id="{!! $d->id !!}" >
                    <i class="fas fa-angle-down" id="donw"></i>
                    </button></td>
                <td width="9%">{!! $d->created_at->format('d-m-Y') !!}  </td>
                <td width="15%">{!! $d->researcher_name !!}</td>
                <td width="10%">{!! $d->researcher_sent !!}</td>
                <td width="15%">{!! $d->researcher_address !!}</td>
                <td width="10%">
                  <?php
                      if($d['researcher_stat']=="รอผลตรวจ")
                          {echo "<span class='badge badge-pill badge-danger'>รอผลตรวจ</span>";}
                            elseif($d['researcher_stat']=="ออกผลแล้ว")
                              {echo "<span class='badge badge-pill badge-primary'>ออกผลแล้ว</span>";}
                              elseif($d['researcher_stat']=="โทรแจ้งแล้ว")
                              {echo "<span class='badge badge-pill badge-warning'>โทรแจ้งแล้ว</span>";}
                              elseif($d['researcher_stat']=="รับผลแล้ว")
                              {echo "<span class='badge badge-pill badge-success'>รับผลแล้ว</span>";}
                    ?><br> 
                    @if($d['researcher_stat']=="รับผลแล้ว")
                    {!! $d->updated_at->format('d-m-Y') !!}
                      @endif </td>
                <td width="10%">{!! $d->researcher_medtech !!}</td>
                <td width="12%">
                  <?php
                        if($d['money_stat']=="ยังไม่ชำระเงิน")
                            {echo "<span class='badge badge-pill badge-danger'>ยังไม่ชำระเงิน</span>";}
                              elseif($d['money_stat']=="รอชำระจบโครงการ")
                                {echo "<span class='badge badge-pill badge-warning'>รอชำระจบโครงการ</span>";}
                                elseif($d['money_stat']=="ชำระแล้ว")
                                {echo "<span class='badge badge-pill badge-success'>ชำระแล้ว</span>";}
                      ?><br>{!! $d->money_rev !!} </td>
                
                    
                    <td style="padding: .3rem;" width="2%"><a href="{{ route('research.result', $d->id)}}" target="_blank" class="btn btn-outline-success btn_print" ><i class="far fa-file-alt"></i></a></td>
                    <td style="padding: .3rem;"width="2%">
                    <a href="{{ route('research.edit',$d->id)}}" class="btn btn-outline-info" target="_blank"><i class="far fa-edit"></i></a></td>
                   <td style="padding: .3rem;" width="2%"><form action="/research/destroy/{{ $d->id  }}" method="post" style="margin-block-end: 0px;">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-outline-danger" type="submit" ><i class="far fa-trash-alt"></i></button>
                    </form></td> 
                 
             </tr >
                <thead>
               
                <tr class="table-borderless subtable sub{!! $d->id !!}"><td colspan="5">&emsp;&emsp;&emsp;ชนิดสิ่งส่งตรวจ&emsp;<b>{!! $d->type_spacimen !!}</b>  &emsp;จากสัตว์ทดลอง&emsp;<b> {!! $d->type_animal !!}</b> &emsp; &emsp; &emsp; &emsp; &emsp;ผู้รับผล &emsp; <b>{!! $d->researcher_rev !!}</b> </td> </tr>
                    <tr class="subtable sub{!! $d->id !!}">
                    
                    <th></th>
                    <th width="10%">รายการตรวจ</th>
                    <th class="text-center">จำนวน</th>
                    <th class="text-center">ราคา</th>
                    <th  class="text-center">ราคารวม</th>
                    <th >หน่วย</th>
                    </tr>
                    
                </thead>
                @foreach($d->reorders as $labtest)
                <tr class="table-borderless subtable sub{!! $d->id !!}">
                <td></td>
                  <td >{{ $labtest->labtest->lab_name }}  </td>
                  <td class="text-center">{{ $labtest->qty_or }}  </td>
                  <td class="text-center">{{ $labtest->price_or }}  </td>
                  <td class="text-center">{{ $labtest->amount_or }}  </td>
                  <td class="text-left">บาท </td>
               </tr >
                @endforeach 
                <tr class="subtable sub{!! $d->id !!}">
                  <td >  </td>
                  <td></td>
                  <td >  </td>
                  <td class="text-right"><b>รวมทั้งหมด</b></td>
                  <td class="text-center amount_or"><b>{{ $d->reorders->sum('amount_or') }}   </b></td>
                  <td class="text-left"><b>บาท </b></td>
                  </tr>
            @endforeach
        </tbody>
       
      </table>
      
      {{ $data->links()}}
<div>
</div>

@endsection
