<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction(); ?>

<head>
	<script src="<?= base_url('assets/jquery-form/dist/jquery.form.min.js')?>" ></script>
	<script src="<?= base_url('assets/jquery-validation/dist/jquery.validate.js')?>" ></script>
	<script src="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js')?>" ></script>
	<script src="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.js')?>" ></script>
	<script src="<?= base_url('/assets/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('/assets/js/dataTables.bootstrap.min.js') ?>"></script>

	<link rel="stylesheet" href="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css')?>" >
	<link rel="stylesheet" href="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.css')?>"> 
</head>

<style>
	.ui-front {
		z-index: 1500 !important;
	}

	.ui-widget-content {
		border: none;
	}

	.label-radio {
		width: 100%;
		background-color: #eee;
		border: 1px solid #ccc;
		border-radius: 4px;
		text-align: left;
		padding: 5px;
		margin-bottom: 10px;
	}

	.span-radio {
		padding-left: 20px;
	}

	.select2-container .select2-selection--single{height: 34px;}
	.select2-selection__choice__remove{float: left;} */
	.pointer {cursor: pointer;}

	.icheck:hover{
		cursor: pointer;
		color: #550000;
	}

	.list{
		min-height: 50px;
		max-height: 200px;
		overflow-y: scroll;
	}

	.iradio .iradio-val{
		display: none;
	}

	.iradio:hover{
		cursor: pointer;
	}

	.icollapse{
		display: none;
	}

	.form-noborder{
		border:none;
	}

    .swal2-title{
        font-family : Sarabun-Regular;
        font-size: 16px;
    }

    .pageNumber
  {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #000;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #d2d6de;
    border-radius: 5px;
    margin-right: 5px;
  }

  button.active
  {
    color: #fff;
    cursor: default;
    background-color: #343a40;
    border-color: #343a40;
  }

</style>    

<body>
	<div class="container" style="width:90%;" >
        <?php $this->Function_model->BREADCRUMB(array('หน้าแรก' => base_url(),'ป้ายสินค้า' => base_url('index.php/Sign'), 'แผนกยืนยันทำป้าย' => '')); ?>

<br>
<!--  -->
                <form id="formData_save">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary hidden" id="tb_addsign_row">
                                
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control " id="search_itemcode" placeholder="กรอกรหัส หรือ ชื่อสินค้า เพื่อเพิ่มรายการสินค้า">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="au-card recent-report">
                                                <div class="au-card-inner">

                                                    <div class="row">
                                                        <div class="col-md-12 text-right">
                                                            <strong>รายการสินค้าทั้งหมด <span id="count_addsign">0</span> รายการ</strong>
                                                        </div>
                                                    </div>

                                                    <br>
                                    
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="5%" class="text-center">ลำดับ</th>
                                                                        <th width="10%" class="text-left">รหัสสินค้า</th>
                                                                        <th width="25%" class="text-left">ชื่อสินค้า</th>
                                                                        <th width="10%" class="text-center">หน่วยนับ</th>
                                                                        <th width="10%" class="text-center">ราคาขาย 1</th>
                                                                        <th width="20%" class="text-center">หมายเหตุ</th>
                                                                        <th width="5%" class="text-center"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tb_addsign">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        
                                                    </div>
   
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="box-footer">
                                        <button type="submit" class=" form-control btn bg-green btn-block"> บันทึกข้อมูล </button>
                                    </div>   -->

                                </div>

                            </div>
                        </div>
                        
                    </div>
 
                    <!-- <div class="row">
                            <div class="col-md-12" style="margin-top:5px;">
                                <a href="<?php echo site_url('Sign/depart_add');?>"><button type="button" class="btn btn-block bg-green btn-lg">ขอทำป้าย</button></a>
                            </div>
                            <div class="col-md-12" style="margin-top:5px;">
                                <a href="<?php echo site_url('Sign/depart_load_data');?>"><button type="button" class="btn btn-block bg-aqua btn-lg">ทำป้ายเอง</button></a>
                            </div>
                    </div>
                     -->
                    <br>
                    <!-- เจ้าของแผนก -->
                    <div class="panel-group" id="confirm_manage_row">
                        <div class="panel panel-primary">
                        
                            <div class="panel-heading"> 
                                <h4 class="modal-title Sarabun-Regular" style="font-size: 22px;" id="con_manage">แก้ไขข้อมูลขอทำป้าย</h4>
                            </div>
                            
                            <div class="panel-body bg-primary" style="color:black;">

                                <!-- เลือกทำป้าย -->
                                <!-- ต้องการทำป้าย -->
                                <div class="panel-group" id="confirmrow">
                                    <div class="panel panel-primary">
                                        <div class="panel-body"> 
                                        
                                            <div class = "row" id="dorow">
                                                <div class="col-md-12">
                                                    <div class="panel-group">
                                                        <div class="panel panel-primary "  style="color:black;">
                                                            <div class="panel-body"> 
                                                                <input type="hidden" name="item_code" id="item_code">
                                                                <input type="hidden" name="field_sign_id" id="field_sign_id">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div id="detail_confirm"></div>
                                                                        <span  style="color:orange;" class="btn" id="btn_edit_cause" >แก้ไขสาเหตุ</span>
                                                                        <div class="form-group">
                                                                            
                                                                            <table id="myTable" class=" table order-list">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">ไอดีป้าย</th>
                                                                                        <th class="text-center">บริเวณที่จะนำไปติด</th>
                                                                                        <th class="text-center">ประเภทราคา</th>
                                                                                        <th class="text-center">ขนาด</th>
                                                                                        <th class="text-center">จำนวน</th>
                                                                                        <th class="text-center">หมายเหตุ</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tb_dosign">

                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-8">
                                                                        <label for="" style="color:red;">*หมายเหตุการแก้ไข</label>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="edit_comment">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- <div class="row">

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <a href="<?php echo site_url('Sign/sign_test_print');?>"><u style="color:red;">*ตัวอย่างป้ายแต่ละแบบ</u></a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class = "row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                        <label><span style="color: white;"> . </span></label>
                                                                        <button type="button" class="btn btn-block bg-orange" id="submit_confirm">บันทึกข้อมูล</button>
                                                                        </div>
                                                                    </div>
                                                                </div> -->

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                        
                    </div>

                </form>

			
			
    	</div>

        <div class="modal fade" id="place_Modal">
            <div class="modal-dialog " style="width:30%" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange">
                        <h4 class="modal-title Sarabun-Regular">แก้ไขสถานที่ติดตั้งป้าย</h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control hidden field_sub_id" readonly>
                                    <input type="text" id="text_place" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <select name="confirmsign_place" class="form-control confirmsign_place" id="confirmsign_place">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-green" id="btn_place_submit">บันทึกข้อมูล</button>
                        <button type="button" class="btn bg-default" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="size_Modal">
            <div class="modal-dialog " style="width:30%" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange">
                        <h4 class="modal-title Sarabun-Regular">แก้ไขขนาดป้าย</h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control hidden field_sub_id" readonly>
                                    <input type="text" id="text_size" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <select name="search_size" class="form-control search_size" id="search_size">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-green" id="btn_size_submit">บันทึกข้อมูล</button>
                        <button type="button" class="btn bg-default" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="price_Modal">
            <div class="modal-dialog " style="width:30%" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange">
                        <h4 class="modal-title Sarabun-Regular">แก้ไขประเภทราคาป้าย</h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control hidden field_sub_id" readonly>
                                    <input type="text" id="text_price" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <select name="search_type" class="form-control search_type" id="search_type">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-green" id="btn_price_submit">บันทึกข้อมูล</button>
                        <button type="button" class="btn bg-default" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="amount_Modal">
            <div class="modal-dialog " style="width:30%" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange">
                        <h4 class="modal-title Sarabun-Regular">แก้ไขจำนวนป้าย</h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control hidden field_sub_id" readonly>
                                    <input type="text" id="text_amount" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="number" id="amount" min="0" class="form-control" placeholder="จำนวนป้ายที่ต้องการ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-green" id="btn_amount_submit">บันทึกข้อมูล</button>
                        <button type="button" class="btn bg-default" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="comment_Modal">
            <div class="modal-dialog " style="width:30%" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange">
                        <h4 class="modal-title Sarabun-Regular">แก้ไขหมายเหตุ</h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control hidden field_sub_id" readonly>
                                    <input type="text" id="text_comment" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="comment" class="form-control" placeholder="กรอกหมายเหตุ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-green" id="btn_comment_submit">บันทึกข้อมูล</button>
                        <button type="button" class="btn bg-default" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cause_Modal">
            <div class="modal-dialog " style="width:30%" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange">
                        <h4 class="modal-title Sarabun-Regular">แก้ไขสาเหตุการทำป้าย</h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <select name="search_cause" class="form-control search_cause" id="search_cause">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-green" id="btn_cause_submit">บันทึกข้อมูล</button>
                        <button type="button" class="btn bg-default" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>




	</div>
</body>

<script type="text/javascript">

    $(document).ready(function(){
        var search_text = '';
        var search_groupcode = '';
        var usersPerPage = '';
        var type_price = '';
        search_text = $('#search_text').val();
        search_groupcode = $('#search_groupcode').val();
        usersPerPage = $('#usersPerPage').val();
        $('#pageNumber').val(0);
        get_sign(search_text,search_groupcode);
        get_groupcode();
        get_employee();
        autocomplete_bcitem();
        confirm_sign_type_price();
        confirm_sign_size(type_price);
        get_sign_edit();






        // $('#confirm_manage_row').hide();

        $("#confirmsign_date").datepicker("destroy");
        $("#confirmsign_date").datepicker({dateFormat: 'yy-mm-dd',minDate: -0});
       

        $('#tb_addsign').on('change','.DefSaleUnitCode',function(){
			get_packingrate($(this).closest('tr'),$(this).val());
		});

        $(document).on('click','.remove_addsign',function(){
			remove_addsign(this);
		});

        $('#tb_list_sign').on('click','.btn_confirm',function(){
          field_id = $(this).closest('tr').find('.field_id').text();
          field_docno = $(this).closest('tr').find('.field_docno').text();
          var doit = '0';
          $('#confirm_manage_row').show();
          $('#con_manage').empty();
          $('#con_manage').append('ระบุจุดที่ต้องการนำไปติด ให้แผนกบรรจุภัณฑ์ทำ');
        //   console.log(field_id,field_docno);
          confirm_detail(field_id,field_docno,doit);
        });

        $('#tb_dosign').on('click','.btn_edit_place', function () {
            field_id = $(this).closest('tr').find('.field_id').text();
            field_place_name = $(this).closest('tr').find('.field_place_name').text();

            $('.field_sub_id').val(field_id);
            $('#text_place').val('สถานที่ติดเดิม : '+field_place_name+'');

            $('#place_Modal').modal('show');
            get_select_place();
            // console.log('ssss');
        });

        $('#tb_dosign').on('click','.btn_edit_sizename', function () {
            field_id = $(this).closest('tr').find('.field_id').text();
            field_size_name = $(this).closest('tr').find('.field_size_name').text();

            $('.field_sub_id').val(field_id);
            $('#text_size').val('ขนาดป้ายเดิม : '+field_size_name+'');

            $('#size_Modal').modal('show');
            confirm_sign_size();
            // console.log('ssss');
        });

        $('#tb_dosign').on('click','.btn_edit_pricename', function () {
            field_id = $(this).closest('tr').find('.field_id').text();
            field_price_name = $(this).closest('tr').find('.field_price_name').text();

            $('.field_sub_id').val(field_id);
            $('#text_price').val('ประเภทราคาเดิม : '+field_price_name+'');

            $('#price_Modal').modal('show');
            confirm_sign_type_price();
            // console.log('ssss');
        });

        $('#tb_dosign').on('click','.btn_edit_amount', function () {
            field_id = $(this).closest('tr').find('.field_id').text();
            field_amount = $(this).closest('tr').find('.field_amount').text();

            $('.field_sub_id').val(field_id);
            $('#text_amount').val('จำนวน : '+field_amount+' ป้าย');

            $('#amount_Modal').modal('show');
            // console.log(field_id);
        });

        $('#tb_dosign').on('click','.btn_edit_comment', function () {
            field_id = $(this).closest('tr').find('.field_id').text();
            field_comment = $(this).closest('tr').find('.field_comment').text();

            $('.field_sub_id').val(field_id);
            $('#text_comment').val('หมายเหตุเดิม : '+field_comment+'');

            $('#comment_Modal').modal('show');
            // console.log('ssss');
        });




        $('#tb_list_sign').on('click','.btn_do_yourself',function(){
          field_id = $(this).closest('tr').find('.field_id').text();
          field_docno = $(this).closest('tr').find('.field_docno').text();
          var doit = '1';
          $('#confirm_manage_row').show();
          $('#con_manage').empty();
          $('#con_manage').append('ระบุจุดที่ต้องการนำไปติด แผนกทำป้ายเอง');
        //   console.log(field_id,field_docno);
          confirm_detail(field_id,field_docno,doit);
        });

        $('#tb_list_sign').on('click','.btn_notconfirm',function(){
          field_id = $(this).closest('tr').find('.field_id').text();
            swal({
                title: 'หมายเหตุที่ไม่ทำ',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off',
                    id : 'notcomment'
                },
                confirmButtonText: 'ใช่',
                cancelButtonColor: '#DCDCDC',
                showCancelButton: true,
                cancelButtonText: 'ยกเลิก',

                }).then((result) => {
                    if (result.value){
                        var notCon_comment = result.value;
                        // not_confirm(field_id,notCon_comment);
                        // if (notCon_comment == '') {
                        if ($('#notcomment').val() == "") {
                            // $('#notcomment').css('border','rgb(217, 83, 79) 2px solid');
                            swal.showValidationError(
                                'please enter a refund amount.'
                            );
                        }
                        else{
                            // console.log(field_id,notCon_comment);
                            not_confirm(field_id,notCon_comment);
                        }
                    }
            });
            
        });

        $('#btn_cause_submit').click(function (e) { 
            e.preventDefault();
            if ($('#search_cause').val() != '' && $('#edit_comment').val() != '') {
                update_cause();
            }
            else{
                swal({
                    title: 'กรุณากรอกข้อมูล',
                    type: 'warning',
                    cancelButtonText: 'ปิด',
                });
            }
        });

        $('#btn_place_submit').click(function (e) { 
            e.preventDefault();
            var type_submit = 1;

            if ($('#confirmsign_place').val() != '' && $('#edit_comment').val() != '') {
                update_edit_data(type_submit);
            }
            else{
                swal({
                    title: 'กรุณากรอกข้อมูล',
                    type: 'warning',
                    cancelButtonText: 'ปิด',
                });
            }

        });


        $('#btn_edit_cause').click(function (e) { 
            e.preventDefault();
            $('#cause_Modal').modal('show');
            sign_cause();
        });

        $('#btn_price_submit').click(function (e) {
            e.preventDefault();
            var type_submit = 2;

            if ($('#search_type').val() != '' && $('#edit_comment').val() != '') {
                update_edit_data(type_submit);
            }
            else{
                swal({
                    title: 'กรุณากรอกข้อมูล',
                    type: 'warning',
                    cancelButtonText: 'ปิด',
                });
            }
        });

        $('#btn_size_submit').click(function (e) { 
            e.preventDefault();
            var type_submit = 3;
            
            if ($('#search_size').val() != '' && $('#edit_comment').val() != '') {
                update_edit_data(type_submit);
            }
            else{
                swal({
                    title: 'กรุณากรอกข้อมูล',
                    type: 'warning',
                    cancelButtonText: 'ปิด',
                });
            }
        });
        
        $('#btn_amount_submit').click(function (e) { 
            e.preventDefault();
            var type_submit = 4;

            if ($('#amount').val() != '' && $('#edit_comment').val() != '') {
                update_edit_data(type_submit);
            }
            else{
                swal({
                    title: 'กรุณากรอกข้อมูล',
                    type: 'warning',
                    cancelButtonText: 'ปิด',
                });
            }
        });

        $('#btn_comment_submit').click(function (e) { 
            e.preventDefault();
            var type_submit = 5;

            if ($('#comment').val() != '' && $('#edit_comment').val() != '') {
                update_edit_data(type_submit);
            }
            else{
                swal({
                    title: 'กรุณากรอกข้อมูล',
                    type: 'warning',
                    cancelButtonText: 'ปิด',
                });
            }
        });

        $('#search_text').keyup(function (e) { 
			e.preventDefault();
			var search_text = '';
			var search_groupcode = '';
			search_text = $('#search_text').val();
			search_groupcode = $('#search_groupcode').val();
			$('#pageNumber').val(0);
			get_sign(search_text,search_groupcode); 
		});

        $(document).on('click','.pageNumber',function(){
            var search_text = '';
			var search_groupcode = '';
			search_text = $('#search_text').val();
			search_groupcode = $('#search_groupcode').val();
			$('#pageNumber').val($(this).text()-1);
			get_sign(search_text,search_groupcode); 
        });

        $('#search_groupcode').change(function (e) { 
            e.preventDefault();
            var search_text = '';
			var search_groupcode = '';
			search_text = $('#search_text').val();
			search_groupcode = $('#search_groupcode').val();
			$('#pageNumber').val(0);
            get_sign(search_text,search_groupcode);
        });

        var count_sign = 0;
        $("#addrow_sign").on("click", function(){
            var newRow = $("<tr>");
            var cols = "";  

            cols += '<td><select class="form-control confirmsign_place" name="confirmsign_place" id="confirmsign_place'+count_sign+'"> </select></td>';                                       

            cols += '<td>'+
                '<select name="confirmsign_type_price'+count_sign+'" class="form-control confirmsign_type_price">' +
                '</select>'+
            '</td>';

            cols += '<td>'+
                '<select name="confirmsign_size'+count_sign+'" class="form-control confirmsign_size">' +
                '</select>'+
            '</td>';

            cols += '<td>'+
                '<select name="confirmsign_destroy '+count_sign+'" class="form-control confirmsign_destroy">'+
                    '<option value="1">ทำลาย</option>'+
                    '<option value="2">ไม่ทำลาย</option>'+
                '</select>'+
            '</td>'; 
            cols += '<td><input type="number" class="form-control confirmsign_amount"  min="1" value="1" name="confirmsign_amount' + count_sign + '"/></td>';   
            cols += '<td><input type="text" class="form-control comment" name="comment' + count_sign + '"/></td>';                             
           
            cols += '<td><input type="button" class="ibtnDel btn bg-red btn-block"  value="ลบ"></td>';
                newRow.append(cols);
                get_select_place();
                $("table.order-list").append(newRow);
                count_sign++;
                var type_price = '';
                confirm_sign_type_price();
                type_price = $('.confirmsign_type_price').val();
                confirm_sign_size(type_price);

                $('.confirmsign_type_price').change(function (e) { 
                    e.preventDefault();
                    var type_price = $('.confirmsign_type_price').val();
                    console.log(type_price);
                    confirm_sign_size(type_price);
                });
        });

        $('.confirmsign_type_price').change(function (e) { 
            e.preventDefault();
            var type_price = $('.confirmsign_type_price').val();
            confirm_sign_size(type_price);
        });
            
        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();       
            count_sign -= 1
        
        });

        $('#sign_type').change(function (e) { 
            e.preventDefault();
            var sign_type = '';
            sign_type = $('#sign_type').val();
            
            if(sign_type != ''){ 
                $('#tb_addsign_row').removeClass('hidden');
                $('#confirm_manage_row').removeClass('hidden');

            }else{
                $('#tb_addsign_row').addClass('hidden');
                $('#confirm_manage_row').addClass('hidden');
            
            }
        });

       
        $('#submit_confirm').click(function(){
            $('#sign_type').css('border','');
            $('#confirmsign_comment').css('border','');
            $('#confirmsign_date').css('border','');

            $('.confirmsign_place').css('border','');
            $('.confirmsign_size').css('border','');
            $('.confirmsign_amount').css('border','');
            $('.comment').css('border','');
            
            if($('#sign_type').val() == '' ){
                $('#sign_type').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('#confirmsign_comment').val() == '' ){
                $('#confirmsign_comment').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('#confirmsign_date').val() == '' ){
                $('#confirmsign_date').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('.confirmsign_place').val() == '' ){
                $('.confirmsign_place').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('.confirmsign_size').val() == '' ){
                $('.confirmsign_size').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('.confirmsign_amount').val() == '' ){
                $('.confirmsign_amount').css('border','rgb(217, 83, 79) 2px solid');
            }
            if($('.comment').val() == '' ){
                $('.comment').css('border','rgb(217, 83, 79) 2px solid');
            }
            if($('#sign_type').val() != '' 
            && $('#confirmsign_comment').val() != '' 
            && $('#confirmsign_date').val() != '' 
            
            && $('.confirmsign_place').val() != ''
            && $('.comment').val() != ''
            && $('.confirmsign_size').val() != ''
            && $('.confirmsign_amount').val() != ''){

                var cause_id = $('#cause_id').val();

                if (cause_id == '6') {

                    var tb_dosign = [];
                    $('#tb_dosign').find('tr').each(function(){
                        var tb_dosigns = {};

                        tb_dosigns['confirmsign_destroy'] = $(this).find('.confirmsign_destroy').val();

                    tb_dosign.push(tb_dosigns);
                    });

                    var check_destroy = 0;
                    $.each(tb_dosign, function (id, val) { 
                         if (val['confirmsign_destroy'] != 1) {
                            check_destroy = 1;
                         }
                    });

                    if (check_destroy == 1) {
                        swal({
                            title: 'ต้องทำลายป้ายเท่านั้น!',
                            text: "เนื่องจากเป็นการปรับราคาสินค้า ต้องทำลายป้ายเดิม",
                            type: 'warning'
                        });
                    }
                    else if (check_destroy != 1) {
                        validate_comfirm();
                    }
                }
                else if (cause_id != '6') {
                    validate_comfirm();
                }
                // validate_comfirm();
            }
		});

    });

    function get_sign_edit() {  
        $.ajax({
            type: "post",
            url: "<?= site_url('Sign/get_sign_edit')?>",
            data: {id : <?= $id ?>},
            dataType: "JSON",
            success: function (data) {
                console.log(data);

                $('#field_sign_id').val(data['Sign']['field_id']);

                $('#item_code').val(data['Sign']['field_itemcode']);
                $('#con_manage').empty();
                var title = 'แก้ไขข้อมูลป้าย เลขที่เอกสาร <span style="color:orange;">'+data['Sign']['field_docno']+'</span> สินค้า '+data['Sign']['field_itemcode']+' '+data['Sign']['field_itemname'];
                $('#con_manage').append(title);

                $('#tb_dosign').empty();

                $('#detail_confirm').empty();
                $('#detail_confirm').append(
                    '<h4>สาเหตุ : '+data['Sign']['type_name']+' </h4>'
                );

                var btn_edit_place = ' <span style="color:orange;" class="btn btn_edit_place" >แก้ไข</span>';
                var btn_edit_pricename = ' <span style="color:orange;" class="btn btn_edit_pricename" >แก้ไข</span>';
                var btn_edit_sizename = ' <span style="color:orange;" class="btn btn_edit_sizename" >แก้ไข</span>';
                var btn_edit_amount = ' <span style="color:orange;" class="btn btn_edit_amount" >แก้ไข</span>';
                var btn_edit_comment = ' <span style="color:orange;" class="btn btn_edit_comment" >แก้ไข</span>';

                $.each(data['Sign_sub'], function (id, val) { 
                    $('#tb_dosign').append(
                        '<tr>'+
                            '<td class="field_place_name text-center" hidden>'+val['field_place_name']+'</td>'+ 
                            '<td class="field_id text-center">'+val['field_id']+'</td>'+
                            '<td class="field_size_name text-center" hidden>'+val['size_name']+'</td>'+
                            '<td class="field_price_name text-center" hidden>'+val['type_name_price']+'</td>'+
                            '<td class="field_amount text-center" hidden>'+val['field_signamount']+'</td>'+
                            '<td class="field_comment text-center" hidden>'+val['field_comment']+'</td>'+
                            '<td class="text-center">'+val['field_place_name']+btn_edit_place +'</td>'+ 
                            '<td class="text-center">'+val['type_name_price']+btn_edit_pricename+'</td>'+ 
                            '<td class="text-center">'+val['size_name']+btn_edit_sizename+'</td>'+ 
                            '<td class="text-center">'+val['field_signamount']+btn_edit_amount+'</td>'+ 
                            '<td class="text-center">'+val['field_comment']+btn_edit_comment+'</td>'+ 
                        '</tr>'
                    );
                });

                
            }
        });
    }

    function get_employee(){
        $.ajax({
        type: "POST",
        url: "<?= site_url('Sign/get_employee')?>",
        dataType: "JSON",
        async: false,
        success: function (data) {
            $('#sign_creator_id').val(data[0]['employeeid']);      
            $('#sign_creator').val(data[0]['firstname'] +' '+ data[0]['lastname'] +' ('+data[0]['nickname']+ ')');
        }
        });
    };

    function autocomplete_bcitem(){
		$("#search_itemcode").autocomplete({
		source: function( request, response ) {
			$.ajax({
			type:'POST',
			url:'<?= site_url('Sign/autocomplete_bcitem')?>',
			dataType:'JSON',
			data:{search_itemcode : $('#search_itemcode').val()},
			}).done(function(data){

			response(data['BCITEM']);
			
			}).fail(function(data){

			});
		},
		autoFocus:true,
		delay: 0,
		minLength: 0,
		select: function( id,val ){
		
			$("#search_itemcode").val(val.item.value);
			check_itemcode(val.item.value);
			return false;
		}

		}).autocomplete('instance')._renderItem = function(ul,item){
			return $('<li>')
			.append('<div>'+ '<span class="bg-green text-white">' + item.value + '</span>' + '<span"> [ ' + item.name1 + ' ] ' + item.name2 + '</span>' + '<br> ราคาขาย ' + item.SalePrice1 + '</div>')
			.appendTo(ul);
		};
	};

    function check_itemcode(Code){
        var status = 'add';
        $.ajax({
			type:'POST',
			url:'<?= site_url('Sign/check_itemcode')?>',
			dataType:'JSON',
			data:{itemcode : Code},
		}).done(function(data){

        if(data['check_itemcode'] == 'have'){

            swal({
                title: 'มีรหัสสินค้านี้ รอดำเนินการอยู่แล้ว',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1AA45F',
                cancelButtonColor: '#DB4B3F',
                confirmButtonText: 'เพิ่มใหม่',
                cancelButtonText: 'ยกเลิก',
                }).then((result) => {
              
                if (result.value){
                    
                    itemcode = $('#search_itemcode').val();
                    $('#search_itemcode').val('');
                    getsign_type =  $('#sign_type').val();

                    $.ajax({
                        type:'POST',
                        url:'<?= site_url('Sign/get_bcitem')?>',
                        dataType:'JSON',
                        data:{itemcode : itemcode},
                    }).done(function(data){

                        if(status == 'add'){

                            var SalePrice1 = '<input type="text" class="form-control sub_focus SalePrice1 text-right" value="'+(parseFloat(data['BCITEM'][0]['SalePrice1']).toFixed(2))+'" >';

                            if(getsign_type == '5' || getsign_type == '6' || getsign_type == '7'){
                                var NewPrice = '<input type="number" class="form-control sub_focus NewPrice text-right" step="any">';
                            }else{
                                var NewPrice = '<input type="number" class="form-control sub_focus NewPrice text-right" step="any" readonly>';
                            }

                            btn_delete = '<button type="button" class="btn btn-sm bg-red btn_delete remove_addsign">ลบ</button>  ';
  
                            $('#tb_addsign').prepend(
                            '<tr id="'+data['BCITEM'][0]['Code']+'">'+

                                '<td  width="5%" class="text-center no"></td>'+
                                '<td  class="text-center date_change hidden">'+data['BCITEM'][0]['lastEditDateT']+'</td>'+
                                '<td width="10%" class="text-left Code">'+
                                    data['BCITEM'][0]['Code']+
                                '</td>'+

                                '<td width="25%" class="text-left Name1">'+data['BCITEM'][0]['Name1']+'</td>'+

                                '<td width="10%" style="padding:0px; class="text-center">'+data['BCITEM'][0]['DefSaleUnitCode']+ '</td>'+

                                '<td width="10%" style="padding:0px;">' + SalePrice1 + '</td>'+

                                '<td width="20%" style="padding:0px;"><input type="text" class="form-control sub_focus Comment text-left" > </td>'+

                                '<td width="5%" style="padding:0px;" class="text-center">'+ btn_delete +'</td>'+

                            '</tr>');


                            if(data['BCITEM'][0]['UnitType'] == 1){
                                get_bcstkpacking(data['BCITEM'][0]['Code']);
                            }

                        }else{
                        }

                        run_no();
                        count_addsign();
                    
                        }).fail(function(data){
                        $('#search_itemcode').val('');
                     
                    });
                    
                }else{
                    $('#search_itemcode').val('');
                }
            });

        }else if(data['check_itemcode'] == 'no_have'){

            itemcode = $('#search_itemcode').val();
			$('#search_itemcode').val('');

            getsign_type =  $('#sign_type').val();

			$.ajax({
				type:'POST',
				url:'<?= site_url('Sign/get_bcitem')?>',
				dataType:'JSON',
				data:{itemcode : itemcode},
			}).done(function(data){
               
                // console.log(data)

				if(status == 'add'){

					var SalePrice1 = '<input type="text" class="form-control sub_focus SalePrice1 text-right" value="'+(parseFloat(data['BCITEM'][0]['SalePrice1']).toFixed(2))+'" >';
                
                    if(data['BCITEM'][0]['UnitType'] == 0){
                        var UnitType = '<select class="DefSaleUnitCode form-control" tabindex="-1"><option value="'+data['BCITEM'][0]['DefSaleUnitCode']+'">'+data['BCITEM'][0]['DefSaleUnitCode']+'</option></select>';
                    }else{
                        var UnitType = data['BCITEM'][0]['DefSaleUnitCode'];
                    }

                    if(getsign_type == '5' || getsign_type == '6' || getsign_type == '7'){
                        var NewPrice = '<input type="number" class="form-control sub_focus NewPrice text-right" step="any">';
                    }else{
                        var NewPrice = '<input type="number" class="form-control sub_focus NewPrice text-right" step="any" readonly>';
                    }

					btn_delete = '<button type="button" class="btn btn-sm bg-red btn_delete remove_addsign">ลบ</button>  ';


                    $('#tb_addsign').prepend(
                    '<tr id="'+data['BCITEM'][0]['Code']+'">'+

                        '<td  width="5%" class="text-center no"></td>'+

                        '<td  class="text-center GroupCode hidden">'+data['BCITEM'][0]['GroupCode']+'</td>'+

                        '<td width="10%" class="text-left Code">'+
                            data['BCITEM'][0]['Code']+
                        '</td>'+

                        '<td width="25%" class="text-left Name1">'+data['BCITEM'][0]['Name1']+'</td>'+

                        '<td width="10%" class="text-center" style="padding:0px;" UnitType><input type="hidden" class="Rate" value="1"><input type="hidden" class="DefSaleUnitCode" value="'+UnitType+'">' +UnitType+ '</td>'+

                        '<td width="10%" style="padding:0px;padding-right:5px;">' + SalePrice1 + '</td>'+

                        '<td width="20%" style="padding:0px;padding-right:5px;"><input type="text" class="form-control sub_focus Comment text-left" > </td>'+

                        '<td width="5%" style="padding:0px;padding-right:5px;" class="text-center">'+ btn_delete +'</td>'+

                    '</tr>');

                    if(data['BCITEM'][0]['UnitType'] == 1){
                        get_bcstkpacking(data['BCITEM'][0]['Code']);
                    }

                }else{
				}

                run_no();
                count_addsign();
			
				}).fail(function(data){
					$('#search_itemcode').val('');
				});
			
			}

			}).fail(function(data){
			$('#search_itemcode').val('');
			
		});

	};

    //ดึงข้อมูลหลายหน่วยนับ
    function get_bcstkpacking(Code){
		$.ajax({
			type:'POST',
			url:'<?= site_url('Sign/get_bcstkpacking')?>',
			dataType:'JSON',
			data:{Code : Code},
		}).done(function(data){

            // console.log(data)

			$.each(data['BCPriceList'],function(id,value){
				$('#'+Code).find('.DefSaleUnitCode').append('<option value="'+value['UnitCode']+'">'+value['UnitCode']+'</option>');
			});

			$('#'+Code).find('.DefSaleUnitCode').val(data['BCITEM'][0]['DefSaleUnitCode']);
		
		}).fail(function(data){
			console.log(data['responseText']);
		});
	};
  
    // ดึงข้อมูลราคาหลายหน่วยนับ
    function get_packingrate(input,UnitCode){

		$.ajax({
			type:'POST',
			url:'<?= site_url('Sign/get_packingrate')?>',
			dataType:'JSON',
			data:{
            Code : $(input).find('.Code').text(),
            UnitCode : UnitCode 
            },
		}).done(function(data){

            // console.log(data)
			
			$(input).find('.Rate').val(data['Rate'][0]['Rate']);
			$(input).find('.SalePrice1').val(parseFloat(data['Rate'][0]['SalePrice1']).toFixed(2));
			
			count_addsign();

		}).fail(function(data){
			console.log(data['responseText']);
		});

	};

    function remove_addsign(input){
		swal({
			title: 'ต้องการลบรายการนี้หรือไม่',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'ลบรายการนี้',
			cancelButtonText: 'ยกเลิก',
		}).then((result) => {
			if (result.value) {
				
				$(input).closest('tr').remove();
				count_addsign();
				run_no();
			}
		});
	};

    function run_no(){
		var no = 1;
		$('#tb_addsign').find('tr').each(function(){
			$(this).find('.no').text(no);
			no++;
		});
	};

    function count_addsign(){
		$('#count_addsign').text($('#tb_addsign').find('tr').length);

        if($('#tb_addsign').find('tr').length > 0){
            $('#search_itemcode').addClass('hidden');
       
        }else{
            $('#search_itemcode').removeClass('hidden');

        }


	};

    function validate_comfirm(){


        var tb_dosign = [];
        $('#tb_dosign').find('tr').each(function(){
            var tb_dosigns = {};
            tb_dosigns['comment'] = $(this).find('.comment').val();
            tb_dosigns['confirmsign_place'] = $(this).find('.confirmsign_place').val();
            tb_dosigns['confirmsign_size'] = $(this).find('.confirmsign_size').val();
            tb_dosigns['confirmsign_type_price'] = $(this).find('.confirmsign_type_price').val();
            tb_dosigns['confirmsign_amount'] = $(this).find('.confirmsign_amount').val();
            tb_dosigns['confirmsign_destroy'] = $(this).find('.confirmsign_destroy').val();
            
            if (tb_dosigns['confirmsign_destroy'] == '1') {
                $('#confirm_destroy').val('1');
            }

        tb_dosign.push(tb_dosigns);
        });

        swal({
            title: 'ต้องการบันทึกข้อมูล?',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1AA45F',
            cancelButtonColor: '#DB4B3F',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
        if (result.value) {
            // console.log(tb_dosign);
            depart_addsign(tb_dosign);
        }
        });

    };

    function depart_addsign(tb_dosign){
        var destroy = $('#confirm_destroy').val();

        if (destroy == '') {
            destroy = '0';
        }
    
        $.ajax({
        type:'POST',
        url:'<?= site_url('Sign/depart_confirm_sign')?>',
        dataType:'JSON',
        data: {
            tb_dosign : tb_dosign,
            destroy : destroy,
            doit : $('#doit').val(),
            field_id : $('#field_id').val(),
            item_code : $('#item_code').val(),
            item_name : $('#item_name').val(),
            groupcode : $('#groupcode').val(),
            new_price1 : $('#new_price1').val(),
            new_price2 : $('#new_price2').val(),
            new_price3 : $('#new_price3').val(),
            sale_price1 : $('#sale_price1').val(),
            sale_price2 : $('#sale_price2').val(),
            sale_price3 : $('#sale_price3').val(),
            confirmsign_comment :$('#confirmsign_comment').val(),
            confirmsign_needdate :$('#confirmsign_date').val(),
            creator : $('#sign_creator_id').val(),
            field_confirm_status : '1'
        },
        }).done(function(data){
        swal({ 
            title: 'บันทึกข้อมูลสำเร็จ',
			type: 'success',
        }).then((result) => {
            if (result.value) {
            location.reload();
            }
            
        });

        }).fail(function(data){

        swal({
            title: 'มีข้อผิดพลาด!',
            text: "โปรดติดต่อแผนกไอที โทร.30",
            type: 'error'
        });

        });
    };

    function get_sign(search_text,search_groupcode){ 

        var usersPerPage = parseInt($('#usersPerPage').val());
        var pageNumber = $('#pageNumber').val();
        // console.log(search_groupcode);
        search_groupcode = $('#search_groupcode').val();

        // console.log(search_groupcode);
        $.ajax({
            type: "POST",
            url: "<?= site_url('Sign/sign_list')?>",
            data : {
                pageNumber : pageNumber ,
                usersPerPage : usersPerPage,
                search_text : search_text,
                search_groupcode : search_groupcode,
                field_confirm_status : '0'
                },
            dataType: "JSON",
            success: function (data) {
                
                // console.log(data);
                $('#tb_list_sign').empty();
                $.each(data['Sign'],function(id,val){
                
                var sign_type = '';

                var confirm_status = '';
                var packing_status = '';

                var btn_view = '<button class="btn bg-aqua btn_view btn-sm"type="button" > ดู </button> ';
                var btn_confirm = '<button class="btn bg-blue btn_confirm btn-sm"type="button" > ให้แผนกบรรจุภัณฑ์ </button>';
                var btn_notconfirm = '<button class="btn bg-red btn_notconfirm btn-sm"type="button" > ไม่ทำ </button>';
                var btn_do_yourself = '<button class="btn bg-aqua btn_do_yourself btn-sm"type="button" > แผนกทำเอง </button>';


                 $('#tb_list_sign').append(
                    '<tr>'+
                        '<td class="hidden field_id">'+val['field_id']+'</td>'+
                        '<td width="10%" class="field_docno" style="text-align:left;">'+ val['field_docno'] +'</td>'+
                        '<td width="15%" style="text-align:left;"> '+ val['field_itemcode'] +' </td>'+
                        '<td width="15%" style="text-align:left;"> '+ val['field_itemname'] +' </td>'+
                        '<td width="15%" style="text-align:center;">'+ formatDate(val['field_change_date']) +'</td>'+
                        '<td width="15%" style="text-align:center;">'+ val['creator_firstname'] +'('+val['creator_nickname']+')</td>'+
                        '<td width="15%" style="text-align:center;">'+ val['type_name'] +'</td>'+
                        '<td width="10%" style="text-align:center;">'+ btn_confirm +'<br>'+btn_do_yourself +'<br>'+btn_notconfirm+'</td>'+
                    '</tr>'
                    );
                });
                // สถานะการสั่งทำป้าย

                $('.pagination').empty();
                var total_sign = (Math.ceil(parseInt(data['Total_Sign']) / parseInt(usersPerPage)));
                if(parseInt(pageNumber) > 5){
                    $('.pagination').append('<li><button class="pageNumber">1</button></li>');
                }

                for (var i = 1; i <= total_sign; i++){
                    if(parseInt(pageNumber)-5 < i && parseInt(pageNumber)+7 > i){
                    if(parseInt(pageNumber)+1 == i){
                        $('.pagination').append('<li><button class="pageNumber active">'+i+'</button></li>');
                    }else{
                        $('.pagination').append('<li><button class="pageNumber">'+i+'</button></li>');
                    }
                    }
                }

                if(parseInt(pageNumber) < total_sign-6){
                    $('.pagination').append('<li><button class="pageNumber">'+total_sign+'</button></li>');
                }
                console.log(data['Total_Sign'],usersPerPage);
            }
        });
    };

    
	function get_groupcode(){
        $.ajax({
            type:'GET',
            url:'<?= site_url('Sign/get_groupcode')?>',
            dataType:'JSON',
        }).done(function(data){
            $('#search_groupcode').empty();
            $('#search_groupcode').append('<option value="">ค้นหาตามกลุ่มสินค้า</option>');
            $.each(data['groupcode'],function(id,val){
				$('#search_groupcode').append('<option value="'+val['Code']+'">'+val['Code']+'&emsp;'+'>'+'&emsp;'+val['Name']+'</option>');
            });
            
        }).fail(function(data){
        });
    };

    function confirm_detail(field_id,field_docno,doit) 
    {  

        // console.log(field_id,field_docno,doit);
        $.ajax({
            type: "POST",
            url: "<?= site_url('Sign/select_confirm_detail')?>",
            data: {
                field_id : field_id
            },
            dataType: "json",
            success: function (data) {
                var old_price = '';
                var new_price = data['field_price1'];
                if (data['field_new_price1'] != null && data['field_old_price1'] != null) {
                    old_price = data['field_old_price1'];
                    new_price = data['field_new_price1'];
                    if (data['field_new_price1'] == 0) {
                        new_price = data['field_price1'];
                    }
                }

                console.log(data);
                $('#detail_confirm').empty();
                $('#detail_confirm').append(
                    '<div class="row">'+
                        '<div class="col-md-6"><b>เลขที่เอกสาร</b> : '+field_docno+'</div>'+
                        '<div class="col-md-6"><b>สินค้า</b> : '+data['field_itemname']+'</div>'+
                      
                        '<div class="col-md-6"><b>ปรับเป็นราคา</b> : '+new_price+'</div>'+
                    '</div>'+
                    '<br>'+
                    '<div class="row">'+
                        '<div class="col-md-6"><b>สาเหตุ</b> : '+data['type_name']+'</div>'+
                    '</div>'+
                    '<input type="hidden" id="cause_id" name="cause_id" value="'+data['id']+'">'+
                    '<input type="hidden" id="field_id" name="field_id" value="'+field_id+'">'+
                    '<input type="hidden" id="item_code" name="item_code" value="'+data['field_itemcode']+'">'+
                    '<input type="hidden" id="groupcode" name="groupcode" value="'+data['field_groupcode']+'">'+
                    '<input type="hidden" id="item_name" name="item_name" value="'+escapeHtml(data['field_itemname'])+'">'+
                    '<input type="hidden" id="doit" name="doit" value="'+doit+'">'+
                    '<input type="hidden" id="new_price1" name="new_price1" value="'+data['field_new_price1']+'">'+
                    '<input type="hidden" id="new_price2" name="new_price2" value="'+data['field_new_price2']+'">'+
                    '<input type="hidden" id="new_price3" name="new_price3" value="'+data['field_new_price3']+'">'+
                    '<input type="hidden" id="new_price4" name="new_price4" value="'+data['field_new_price4']+'">'+
                    '<input type="hidden" id="sale_price1" name="sale_price1" value="'+data['field_price1']+'">'+
                    '<input type="hidden" id="sale_price2" name="sale_price2" value="'+data['field_price2']+'">'+
                    '<input type="hidden" id="sale_price3" name="sale_price3" value="'+data['field_price3']+'">'+
                    '<input type="hidden" id="sale_price4" name="sale_price4" value="'+data['field_price4']+'">'
                );

                get_select_place();
            }
            
        });
    };

    function get_select_place() {  
        var item_code = $('#item_code').val();
        $.ajax({
            type: "post",
            url: "<?= site_url('Sign/get_select_place')?>",
            data: {
                item_code : item_code
            },
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $('.confirmsign_place').empty();
                $('.confirmsign_place').append(
                    '<option value="">เลือกสถานที่ติดตั้ง</option>'
                );
                
                $.each(data, function (ind, val) { 
                    $('.confirmsign_place').append(
                        '<option value="'+val['field_place_id']+'">'+val['field_place_name']+'</option>'
                    );
                });
            }
        });
    }

    function confirm_sign_size() 
    { 
        $.ajax({
            type: "POST",
            url: "<?= site_url('Sign/select_sign_size')?>",
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $('.search_size').empty();
                $('.search_size').append(
                    '<option value="">เลือกขนาดป้าย</option>'
                );
                $.each(data, function (ida, val) {
                      $('.search_size').append(
                          '<option value="'+val['id']+'">'+val['size_name']+'</option>'
                      );
                });

            }
        });
    };

    function confirm_sign_type_price() 
    { 
        $.ajax({
            type: "POST",
            url: "<?= site_url('Sign/confirmsign_type_price')?>",
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $('.search_type').empty();
                $('.search_type').append(
                    '<option value="">เลือกประเภท</option>'
                );
                $.each(data, function (ida, val) {
                      $('.search_type').append(
                          '<option value="'+val['id']+'">'+val['type_name_price']+'</option>'
                      );
                });
            }
        });
    };

    function update_cause() {  

        var cause = $('#search_cause').val();
        var field_id = $('#field_sign_id').val();
        swal({
            title: 'ต้องการบันทึกข้อมูล?',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1AA45F',
            cancelButtonColor: '#DB4B3F',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.value){
                // console.log(field_id,data_update);
                $.ajax({
                    type:'POST',
                    url:'<?= site_url('Sign/cause_Modal')?>',
                    dataType:'JSON',
                    data:{
                        field_id : field_id,
                        cause : cause
                    },
                }).done(function(data){
                    console.log(data);
                    swal({ 
                        title: 'บันทึกข้อมูลสำเร็จ',
                        type: 'success',
                    }).then((result) => {
                        if (result.value) {
                            get_sign_edit();

                            $('#cause_Modal').modal('hide');
                        }
                    });
                }).fail(function(data){
                    
                });
            }
        });
    }

    function update_edit_data(type_submit) 
    {  
        var field_sign_id = $('#field_sign_id').val();
        var field_id = $('.field_sub_id').val();
        // console.log(field_id,type_submit);
        var data_update = '';
        if (type_submit == 1) {
            data_update = $('#confirmsign_place').val();
        }
        else if (type_submit == 2) {
            data_update = $('#search_type').val();
        }
        else if (type_submit == 3) {
            data_update = $('#search_size').val();
        }
        else if (type_submit == 4) {
            data_update = $('#amount').val();
        }
        else if (type_submit == 5) {
            data_update = $('#comment').val();
        }

        var edit_comment = $('#edit_comment').val();
    
        swal({
            title: 'ต้องการบันทึกข้อมูล?',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1AA45F',
            cancelButtonColor: '#DB4B3F',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.value){

                // console.log(field_id,data_update);
                $.ajax({
                    type:'POST',
                    url:'<?= site_url('Sign/update_edit_data')?>',
                    dataType:'JSON',
                    data:{
                        field_id : field_id,
                        type_submit : type_submit,
                        data_update : data_update,
                        field_sign_id : field_sign_id,
                        edit_comment : edit_comment
                    },
                }).done(function(data){
                    swal({ 
                        title: 'บันทึกข้อมูลสำเร็จ',
                        type: 'success',
                    }).then((result) => {
                        if (result.value) {
                            get_sign_edit();
                            $('#place_Modal').modal('hide');
                            $('#size_Modal').modal('hide');
                            $('#price_Modal').modal('hide');
                            $('#amount_Modal').modal('hide');
                            $('#comment_Modal').modal('hide');
                        } 
                    });
                }).fail(function(data){
                    
                });
            }
        });
    };

    function not_confirm(field_id,notCon_comment) 
    {  
        swal({
            title: 'คุณไม่ต้องการทำป้าย?',
            text: 'ไม่ทำป้าย!',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#BEBEBE',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ปิด',
            }).then((result) => {
            if (result.value){
                var confirm = '2';
                $.ajax({
                    type:'POST',
                    url:'<?= site_url('Sign/update_confirm')?>',
                    dataType:'JSON',
                    data:{
                        field_id : field_id,
                        field_confirm_status : confirm,
                        field_not_confirm_comment : notCon_comment
                    },
                }).done(function(data){
                    $('#confirm_manage_row').hide();
                    var search_text = '';
                    var search_groupcode = '';
                    var usersPerPage = '';
                    search_text = $('#search_text').val();
                    search_groupcode = $('#search_groupcode').val();
                    usersPerPage = $('#usersPerPage').val();
                    $('#pageNumber').val(0);
                    get_sign(search_text,search_groupcode);
                    
                }).fail(function(data){
                    
                });
            }
        });
        
    };

    function sign_cause() 
    { 
        $.ajax({
            type: "POST",
            url: "<?= site_url('Sign/sign_type')?>",
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $('#search_cause').empty();
                $('#search_cause').append(
                    '<option value="">เลือกสาเหตุ</option>'
                );
                $.each(data, function (ida, val) {
					$('#search_cause').append(
						'<option value="'+val['id']+'">'+val['type_name']+'</option>'
					);
                });
            }
        });
    };

    function escapeHtml(unsafe){
        return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    }

    function formatDate(dateStr) 
    {
        const d = new Date(dateStr);
        var mm = String(d. getMonth() + 1). padStart(2, '0'); //January is 0!
        return d.getDate().toString().padStart(2, '0') + '/' + mm + '/' + d.getFullYear().toString().padStart(2, '0');
    };



</script>