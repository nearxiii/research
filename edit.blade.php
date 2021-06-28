@extends('base') 
@section('main')

<div class="container-2">

    <div class="row">
    <div class="col-md-12">
    <h1 class="display-5 text-success text-center"style="margin: 1.5rem; ">อัพเดทสถานะการรับผล</h1></div>
       <div class="col-md-7 ">
            <div class="card" >
                    <div class="card-body">
                    <div class="col-md text-center"><h4 class="card-title">รายละเอียดการส่งตรวจ</h4></div>
                    <div class="col-md"><p > <b>ผู้ส่ง   :</b>   {{ $researchs->researcher_name }}</p></div>
                    
                            
                            <table  class="table table-borderless">
                            <thead>
                            
                                    <tr>
                                    <th></th>
                                    <th>test</th>
                                    <th>จำนวน</th>
                                    <th >ราคา</th>
                                    <th  class="text-center">รวม</th>
                                    </tr>
                                    
                                </thead>
                                @foreach($researchs->reorders as $labtest)
                                <tr>
                                <td></td>
                                <td >{{ $labtest->labtest->lab_name }}  </td>
                                <td >{{ $labtest->qty_or }}  </td>
                                <td >{{ $labtest->price_or }}  </td>
                                <td class="text-center">{{ $labtest->amount_or }}  </td>
                                <td class="text-left">บาท </td>
                            </tr >
                                @endforeach 
                                <tr >
                                <td >  </td>
                                <td></td>
                                <td >  </td>
                                <td class="text-right"><b>รวมทั้งหมด</b></td>
                                <td class="text-center"><b>{{ $researchs->reorders->sum('amount_or') }}   </b></td>
                                <td class="text-left"><b>บาท </b></td>
                                </tr>
                            </table>
                            <div class="col-md">ผู้รายงานผล : <?php
                                                                if($researchs['researcher_medtech']=="คมกฤษณ์")
                                                                    {echo "<b>ทนพ.คมกฤษณ์ สุขไมตรี</b>";}
                                                                    elseif($researchs['researcher_medtech']=="มานะ")
                                                                        {echo "<b>ทนพ.มานะ กระแสโสม</b>";}
                                                                        elseif($researchs['researcher_medtech']=="ชญานิศ")
                                                                        {echo "<b>ทนพญ.ชญานิศ สัญญารักษ์</b>";}
                                                                        elseif($researchs['researcher_medtech']=="ฉัตรลดา")
                                                                        {echo "<b>ทนพญ.ฉัตรลดา ทับทิมงาม</b>";}
                                                            ?></div>
                            <div class="col-md">สถานะการส่งผล : <?php
                                                                if($researchs['researcher_stat']=="รอผลตรวจ")
                                                                    {echo "<span class='badge badge-pill badge-danger'>รอผลตรวจ</span>";}
                                                                        elseif($researchs['researcher_stat']=="ออกผลแล้ว")
                                                                        {echo "<span class='badge badge-pill badge-primary'>ออกผลแล้ว</span>";}
                                                                        elseif($researchs['researcher_stat']=="โทรแจ้งแล้ว")
                                                                        {echo "<span class='badge badge-pill badge-warning'>โทรแจ้งแล้ว</span>";}
                                                                        elseif($researchs['researcher_stat']=="รับผลแล้ว")
                                                                        {echo "<span class='badge badge-pill badge-success'>รับผลแล้ว</span>";}
                                                                ?></div>
                            <div class="col-md">สถานะการชำระเงิน : <?php
                                                                if($researchs['money_stat']=="ยังไม่ชำระเงิน")
                                                                    {echo "<span class='badge badge-pill badge-danger'>ยังไม่ชำระเงิน</span>";}
                                                                    elseif($researchs['money_stat']=="รอชำระจบโครงการ")
                                                                        {echo "<span class='badge badge-pill badge-warning'>รอชำระจบโครงการ</span>";}
                                                                        elseif($researchs['money_stat']=="ชำระแล้ว")
                                                                        {echo "<span class='badge badge-pill badge-success'>ชำระแล้ว</span>";}
                                                            ?></div>
                    </div>
            </div>
       </div>
<!-- ----------form --------- -->
            <div class="col-md-5">
            <div class="card" >
                    <div class="card-body">
                    <form  method="post" action="/research/update/{{ $researchs->id  }}">
                        @method('PATCH') 
                        @csrf
                            
                    <div class="form-group row">
                        
                        <div class="col-sm-12">
                        <div class="col-md text-center"><h4 class="card-title">การรายงานผล</h4></div>

                            <div include="form-input-select()" id="medtech"  >
                                <select required class="custom-select mb-3" name="researcher_stat" >
                                <option value="{{ $researchs->researcher_stat }}">สถานะการส่งผล</option>
                                    <option value="ออกผลแล้ว"  <?php if( $researchs->researcher_stat == "ออกผลแล้ว") echo "SELECTED";?>>ออกผลแล้ว</option>
                                    <option value="โทรแจ้งแล้ว" <?php if( $researchs->researcher_stat == "โทรแจ้งแล้ว") echo "SELECTED";?>>โทรแจ้งแล้ว</option>
                                    <option value="รับผลแล้ว" <?php if( $researchs->researcher_stat == "รับผลแล้ว") echo "SELECTED";?>>รับผลแล้ว</option>
                                </select>
                            </div>
                            <div include="form-input-select()" id="medtech"  >
                                <select required class="custom-select mb-3" name="researcher_medtech" >
                                <option value="{{ $researchs->researcher_medtech }}">ผู้รายงานผล</option>
                                    <option value="มานะ" <?php if( $researchs->researcher_medtech == "มานะ") echo "SELECTED";?>>มานะ</option>
                                    <option value="คมกฤษณ์" <?php if( $researchs->researcher_medtech == "คมกฤษณ์") echo "SELECTED";?>>คมกฤษณ์</option>
                                    <option value="ชญานิศ" <?php if( $researchs->researcher_medtech == "ชญานิศ") echo "SELECTED";?>>ชญานิศ</option>
                                    <option value="ฉัตรลดา" <?php if( $researchs->researcher_medtech == "ฉัตรลดา") echo "SELECTED";?>>ฉัตรลดา</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <!-- <label for="pat_sent" class="col-sm-2 col-form-label">การรับผล</label> -->
                                <div class="col-md">
                                <input type="text"  class="form-control" name="researcher_rev" value="{{ $researchs->researcher_rev }}" placeholder="ผู้รับผลตรวจ"/>
                            </div>
                        </div>

                        <div class="row">
                    <div class="col-md text-center"><h4 class="card-title">การชำระเงิน</h4></div></div>

                            <div include="form-input-select()" id="medtech"  >
                                <select required class="custom-select mb-3" name="money_stat" >
                                <option value="{{ $researchs->money_stat }}">สถานะการชำระเงิน</option>
                                    <option value="ยังไม่ชำระเงิน" <?php if( $researchs->money_stat == "ยังไม่ชำระเงิน") echo "SELECTED";?>>ยังไม่ชำระเงิน</option>
                                    <option value="รอชำระจบโครงการ" <?php if( $researchs->money_stat == "รอชำระจบโครงการ") echo "SELECTED";?>>รอชำระจบโครงการ</option>
                                    <option value="ชำระแล้ว" <?php if( $researchs->money_stat == "ชำระแล้ว") echo "SELECTED";?>>ชำระแล้ว</option>
                                </select>
                            </div>
                            <div include="form-input-select()" id="medtech"  >
                                <select required class="custom-select mb-3" name="money_rev" >
                                <option value="-">ผู้รับเงิน</option>
                                    <option value="หนึ่งฤทัย">หนึ่งฤทัย</option>
                                    <option value="ปุริน">ปุริน</option>
                                    <option value="น้ำฝน">น้ำฝน</option>
                                    
                                </select>
                            </div>
                           <div class="row">
                            <div class="col-md-6">
                            <button type="submit" class="btn btn-success btn-block">อัพเดท</button></div>
                            <div class="col-md-6">
                            <a href="/research" class="btn btn-danger  btn-block">ยกเลิก</a></div>
                            </div>
                            
                    </div>
                    </form>
                    </div>
                    
            </div>
            </div>
    </div>
    </div>
</div>    
@endsection