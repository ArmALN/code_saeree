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
</style>    

<body>
	<div class="container" style="width:80%;" >
        <?php $this->Function_model->BREADCRUMB(array('หน้าแรก' => base_url(),'ป้ายสินค้า' => base_url('index.php/Sign'), 'เจ้าของแผนก' => '')); ?>

        <!-- จัดซื้อ -->
		<div class="box box-default box-solid">

            <div class="modal-header bg-green">
				<h4 class="modal-title Sarabun-Regular" style="font-size: 20px;"> ข้อมูลแผนกจัดซื้อ </h4>
			</div>

            <div class="box-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >ผู้บันทึกข้อมูล :</label>
                            <span class="view_purchase_creator" id="view_purchase_creator"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label >วันที่บันทึก :</label>
                            <span class="view_purchase_creator" id="view_purchase_createdate"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>สาเหตุ :</label>
                            <span class="view_purchase_type" id="view_purchase_type"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >วันที่ต้องการเปลี่ยนข้อมูล :</label>
                            <span class="view_purchase_date" id="view_purchase_date"></span>
                        </div>
                    </div>
                </div>

                <br>
                                
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-left">รหัสสินค้า</th>
                                    <th class="text-left">ชื่อสินค้า</th>
                                    <th class="text-center">หน่วยนับ</th>
                                    <th class="text-center">จากจำนวน</th>
                                    <th class="text-center">ถึงจำนวน</th>
                                    <th class="text-center">ราคาขาย 1</th>
                                    <th class="text-center NewPriceRow" bgcolor="#AED6F1" >ราคาใหม่</th>
                                    <th class="text-right">หมายเหตุ</th>
                                </tr>
                            </thead>
                            <tbody id="tb_view_purchasesign">
                            </tbody>
                        </table>
                    </div>
                </div>
             
            </div>
		
    	</div>

        <!-- รายการป้ายเดิม -->
        <div class="box box-default box-solid hidden" id="oldsign_row" name="oldsign_row">

            <div class="modal-header bg-blue">
				<h4 class="modal-title Sarabun-Regular" style="font-size: 20px;"> รายการป้ายเดิมในระบบ </h4>
			</div>

            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-left">ลำดับ</th>
                                    <th class="text-left">บริเวณที่ติด</th>
                                    <th class="text-left">ขนาด</th>
                                    <th class="text-center">จำนวนป้าย</th>
                                    <th class="text-center"></th>
                                    <th class="text-center"></th>
                                    <th class="text-center"></th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody id="tb_depart_oldsign">
                            </tbody>
                        </table>
                    </div>
                </div>
             
            </div>
		
    	</div>

        <!-- เจ้าของแผนก -->
        <div class="panel-group" id="confirm_manage_row">
            <div class="panel panel-primary">
                <div class="panel-body bg-primary" style="color:black;">

                    <!-- เลือกทำป้าย -->
                    <div class="panel-group">
                        <div class="panel panel-primary">
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label style="color: red;">ต้องการทำป้ายหรือไม่ ?</label>
                                            <select class="form-control" id="confirm_status">
                                                <option value="">เลือก</option>
                                                <option value="1">ต้องการสั่งทำป้าย</option>
                                                <option value="2">ไม่ต้องการสั่งทำป้าย</option>
                                            </select>

                                            <input type="text" class="form-control hidden" name="depart_signid" id="depart_signid"/>
                                            <input type="text" class="form-control hidden" name="depart_itemcode" id="depart_itemcode"/>

                                        </div>
                                    </div>

                                    
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- ไม่ต้องการทำป้าย -->
                    <div class="panel-group hidden" id="undorow">
                        <div class="panel panel-primary ">
                            <div class="panel-body"> 

                                <div class = "row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label> ระบุเหตุผลที่ไม่ต้องการสั่งทำป้าย </label>
                                            <input type="text" class="form-control" name="undo_comment"  id="undo_comment"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label><span style="color: white;"> . </span></label>
                                        <button type="button" class="btn btn-block bg-green" id="submit_undo">บันทึกข้อมูล</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- ต้องการทำป้าย -->
                    <div class="panel-group hidden" id="confirmrow">
                        <div class="panel panel-primary">
                            <div class="panel-body"> 
                               
                                <div class = "row" id="dorow">
                                    <div class="col-md-12">
                                        <div class="panel-group">
                                            <div class="panel panel-primary ">
                                                <div class="panel-body"> 
                                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <table id="myTable" class=" table order-list">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>บริเวณที่จะนำไปติด</th>
                                                                            <th>ขนาด</th>
                                                                            <th>จำนวน</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tb_dosign">
                                                                        <tr>
                                                                            <td class="col-sm-5">
                                                                                <input type="text" class="form-control confirmsign_place" name="confirmsign_place" id="confirmsign_place">
                                                                            </td>
                                                                            <td class="col-sm-3">
                                                                                <select name="confirmsign_size" class="form-control confirmsign_size" id="confirmsign_size">
                                                                                    <option value="">เลือก</option>
                                                                                    <option value="0"> A4 </option>
                                                                                    <option value="1"> ครึ่ง A4 </option>
                                                                                    <option value="2"> สี่ส่วน A4 </option>
                                                                                    <option value="3"> ป้ายหน้าชั้น </option>
                                                                                    <option value="4"> ป้ายสต็อก </option>
                                                                                    <option value="5"> บาร์แท็ก </option>
                                                                                </select>
                                                                            </td>
                                                                            <td class="col-sm-3">
                                                                                <input type="number" name="confirmsign_amount" class="form-control confirmsign_amount" id="confirmsign_amount">
                                                                            </td>
                                                                        
                                                                            <td class="col-sm-1"><a class="deleteRow_confirmsign"></a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td colspan="5" style="text-align: left;">
                                                                                <input type="button" class="btn btn btn-block " id="addrow_sign" value="เพิ่มรายการป้าย" />
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label>หมายเหตุเพิ่มเติม</label>
                                                                    <input type="text" class="form-control" name="confirmsign_comment"  id="confirmsign_comment"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label >วันที่ต้องการป้าย</label>
                                                                <input type="text" id="confirmsign_date"  class="form-control pointer"  placeholder="คลิกเพื่อเลือกวันที่"  name ="confirmsign_date" readonly />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class = "row">
                                                        <div class="col-md-8">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                            <label><span style="color: white;"> . </span></label>
                                                            <button type="button" class="btn btn-block bg-green" id="submit_confirm">บันทึกข้อมูล</button>
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
                    
                </div>
            </div>
            
        </div>

	</div>
</body>

<script type="text/javascript">

    $(document).ready(function(){

        get_view();

        $("#confirmsign_date").datepicker("destroy");
        $("#confirmsign_date").datepicker({dateFormat: 'dd/mm/yy',minDate: -0});

        $('#confirm_status').change(function(e){
            e.preventDefault();
            var confirm_status = '';
            confirm_status = $('#confirm_status').val();
            
            if(confirm_status == '1'){ 
                $('#confirmrow').removeClass('hidden');
                $("#undo_comment").val('');
                $("#undo_comment").val('');

                $('#undorow').addClass('hidden');
                $("#undo_comment").val('');
                
            }else if(confirm_status == '2'){
                $('#undorow').removeClass('hidden');
                $('#confirmrow').addClass('hidden');

                $("#confirmsign_comment").val('');
                $("#confirmsign_date").val('');
                $("#tb_dosign tr").remove();

            }else{
                $('#confirmrow').addClass('hidden');
                $('#undorow').addClass('hidden');

                $("#undo_comment").val('');
                $("#undo_destroy_status").val('');

                $("#confirmsign_comment").val('');
                $("#confirmsign_date").val('');
                // $("#confirmsign_destroy_status").val('');

            }

        });

        var count_sign = 0;
        $("#addrow_sign").on("click", function(){
            var newRow = $("<tr>");
            var cols = "";  

            cols += '<td><input type="text" class="form-control confirmsign_place" name="confirmsign_place' + count_sign + '"/></td>';                                

            cols += '<td>'+
                '<select name="confirmsign_size' + count_sign + '" class="form-control confirmsign_size">' +
                    '<option value="">เลือก</option>'+
                    '<option value="0"> A4 </option>' +
                    '<option value="1"> ครึ่ง A4 </option>' +
                    '<option value="2"> สี่ส่วน A4 </option>' +
                    '<option value="3"> ป้ายหน้าชั้น </option>' +
                    '<option value="4"> ป้ายสต็อก </option>' +
                    '<option value="5"> บาร์แท็ก </option>' +
                '</select>'+
            '</td>';

            cols += '<td><input type="number" class="form-control confirmsign_amount" name="confirmsign_amount' + count_sign + '"/></td>';                                
           
            cols += '<td><input type="button" class="ibtnDel btn bg-red btn-block"  value="ลบ"></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                count_sign++;
            });

            $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();       
            count_sign -= 1
        });

        $('#submit_undo').click(function(){
            $('#undo_comment').css('border','');
            $('#undo_destroy_status').css('border','');
            
            if($('#undo_comment').val() == '' ){
                $('#undo_comment').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('#undo_destroy_status').val() == '' ){
                $('#undo_destroy_status').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('#undo_comment').val() != '' && $('#undo_destroy_status').val() != ''){
                confirm_undo();
            }
		});

        $('#submit_confirm').click(function(){
            $('#confirmsign_comment').css('border','');
            $('#confirmsign_date').css('border','');
            // $('#confirmsign_destroy_status').css('border','');
            
            if($('#confirmsign_comment').val() == '' ){
                $('#confirmsign_comment').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('#confirmsign_date').val() == '' ){
                $('#confirmsign_date').css('border','rgb(217, 83, 79) 2px solid');
            }

            // if($('#confirmsign_destroy_status').val() == '' ){
            //     $('#confirmsign_destroy_status').css('border','rgb(217, 83, 79) 2px solid');
            // }

            if($('#confirmsign_comment').val() != '' && $('#confirmsign_date').val() != ''){
                validate_comfirm();
            }
		});
       
    });

    function validate_comfirm(){

        var tb_dosign = [];

        $('#tb_dosign').find('tr').each(function(){
        
        var tb_dosigns = {};
        tb_dosigns['confirmsign_place'] = $(this).find('.confirmsign_place').val();
        tb_dosigns['confirmsign_size'] = $(this).find('.confirmsign_size').val();
        tb_dosigns['confirmsign_amount'] = $(this).find('.confirmsign_amount').val();

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
            confirmsign(tb_dosign);
        }
        });

    };

    function confirmsign(tb_dosign){
        $.ajax({
        type:'POST',
        url:'<?= site_url('Sign/confirmsign')?>',
        dataType:'JSON',
        data: {
            signid :$('#depart_signid').val(),
            itemcode :$('#depart_itemcode').val(),
            confirm_status : $('#confirm_status').val(),
            confirmsign_comment :$('#confirmsign_comment').val(),
            confirmsign_date :$('#confirmsign_date').val(),
            tb_dosign : tb_dosign
        },
        }).done(function(data){
        swal({ 
            title: 'บันทึกข้อมูลสำเร็จ',
			type: 'success',
        }).then((result) => {
            if (result.value) {
            id : <?= $id ?>
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

    function delete_row(field_id){
        $('#tb_dosign'+field_id).remove();
    };

    function confirm_undo(){

        confirm_status = $('#confirm_status').val();
		undo_comment = $('#undo_comment').val();
		
		swal({	
		title: "ต้องการบันทึกข้อมูล?",
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#1AA45F',
		cancelButtonColor: '#DB4B3F',
		confirmButtonText: 'ใช่',
		cancelButtonText: 'ยกเลิก',
		}).then((result) => {
			if (result.value) {

				$.ajax({
					type: "POST",
					url: "<?= site_url('Sign/confirm_undo')?>", 
					data: {
                        signid :$('#depart_signid').val(),
                        confirm_status:confirm_status,
						undo_comment :undo_comment
					},
					dataType: "JSON",
					success: function (data) {
						swal({ 
						title: 'บันทึกข้อมูลสำเร็จ',
						type: 'success',
						}).then((result) => {
							if (result.value) {
								location.reload();
							}  
						});
						
					}
				});
			}
		});
    };
 
</script>