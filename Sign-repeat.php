<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction(); ?>
<?php $firstArray = explode('/',$_SERVER['PATH_INFO']); ?>

<head>
    <script src="<?= base_url('assets/js/jquery.table2excel.js') ?>"></script>
	<script src="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.js')?>" ></script>
	<link rel="stylesheet" href="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.css')?>">
</head>

<style type="text/css">

	.links img{padding: 5px;}
	.select2-container .select2-selection--single{height: 100%;}
    .select2-selection__choice__remove{float: left;} */
	.tools_topic{float: right;}
	.select{text-align-last:center; }
   
    @font-face {font-family: THSarabun;src: url(<?= base_url('assets/font/THSarabun.ttf')?>);}
	.THSarabun{font-family: THSarabun;font-size: 18px;line-height: 40px;}

	@font-face {font-family: supermarket;src: url(<?= base_url('assets/font/supermarket.ttf')?>);}
	.supermarket{font-family: supermarket;font-size: 18px;line-height: 40px;}

    .blank_row{
        height: 35px !important; /* overwrites any other rules */
        background-color: #FFFFFF;
    }

    .swal2-title{
        font-family : Sarabun-Regular;
        font-size: 16px;
    }
    
</style>
<?php 
    $arrow_down = '&#129147;';
    $arrow_up = '&#129145;';
    $arrow_left = '&#129144;';
    $arrow_right = '&#129146;';

?>
<div class="container" style="width: 95%;">
    <div class="panel panel-default">
        <input type="hidden" id="ArCode">
        <div class="panel-body " id="export_excel" >
            
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-body">
                        <div class="row row_export" id="row_export">
                            <div class="col-lg-12">
                                <div class="form-group col-lg-12">
                                    <label for="">เลือกรูปแบบกระดาษ</label>
                                        <select name="A4" id="A4" class="form-control">
                                            <option value="A4">A4 แนวตั้ง</option>
                                            <option value="A4-L">A4 แนวนอน</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-6">
                                    <label style="color:red;" for="">*เลือกเส้นทางลูกศร(เฉพาะโกดัง)</label>
                                        <select name="arrow" id="arrow" class="form-control">
                                            <option value="arrow_down">ลูกศรชี้ลง</option>
                                            <option value="arrow_up">ลูกศรชี้ขึ้น</option>
                                            <option value="arrow_left">ลูกศรชี้ซ้าย</option>
                                            <option value="arrow_right">ลูกศรชี้ขวา</option>
                                        </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label style="color:red;" for="">*รายละเอียดเพิ่มเติม(เฉพาะโกดัง)</label>
                                        <input class="form-control" type="text" id="detail" name="detail">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-6">
                                    <button type="button" id="print_sign"  class="btn btn-lg bg-green btn-block Sarabun-Regular">ปริ้นป้าย</button>
                                </div> 
                                <div class="form-group col-lg-6">
                                    <button type="button" id="print_sign_preview"  class="btn btn-lg bg-green btn-block Sarabun-Regular">PREVIEW</button>
                                </div> 

                                <div class="form-group col-lg-12">
                                    <button type="button" class="btn btn-lg bg-green btn-block Sarabun-Regular" id="btn_export"> DOWNLOAD EXCEL </button>
                                </div> 
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <body>
                <div class="row">
                    <div class="col-lg-12">
                        <table class='table table-bordered table-hover' id="title_data" >
                            <thead class="thead-light" >
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="19">
                                        <b> รายการจัดทำป้ายสินค้า </b><br>
                                        </th>
                                    </tr>
                                </thead>

                                <tr class="text-center">
                                    <th class="text-center">รหัสป้ายเดิม</th>
                                </tr>
                            </thead>
                            <tbody id="tb_packing_excel" class="text-center">
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="col-md-12">
                        <button type="button" class="btn btn-lg bg-green btn-block Sarabun-Regular" id="btn_confirm_packing"> ยืนยันทำป้าย </button>
                    </div> -->
                </div>
            </body> 
            
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        var xls_name = [];
        var id_sign = [];
        get_packing_excel();

        $('#btn_export').click(function (e) { 
            e.preventDefault();
            export_excel();
        });

        $('#btn_confirm_packing').click(function (e) { 
            e.preventDefault();
            update_packing();
        });

        $('#print_sign').click(function (e) { 
            e.preventDefault();
            print_sign();
        });

        $('#print_sign_preview').click(function (e) { 
            e.preventDefault();
            print_sign_preview();
        });


    });


    function print_person() {  

        $.ajax({
            type:'POST',
            url:'<?= site_url('Sign/update_print_person')?>',
            dataType:'json',
            data:{
                id : id_sign
            },
            success: function (data) {
                
            }
        });

    }


    function get_packing_excel(){
        swal({
				title: 'การประมวลผลข้อมูล',
				html: 'กรุณารอสักครู่',
				onOpen: () => {
				swal.showLoading()
				},
			});
		$.ajax({
			type:'POST',
			url:'<?= site_url('Sign/get_repeat')?>',
			dataType:'json',
		}).done(function(data){
            console.log(data);
            swal.close();

            // $.each(data['amount_sign'], function (id, val) { 
                 
            // });
            // id_sign = [];
            xls_name = [];
            var file_names = ''; 
            $.each(data['amount_sign'],function(id,val){

                $('#tb_packing_excel').append('<tr>'+
                    '<td width="5%" style="text-align:center;">'+val+'</td>'+
                '</tr>');
                
            });
            file_names = 'จำนวนป้ายซ้ำ';
            xls_name.push(file_names);

          
		}).fail(function(data){
            console.log(data)
		});
	}

    function export_excel(){
        var filename  = 'กลุ่มสินค้า'+xls_name;
        $("#title_data").table2excel({
            // exclude: "#data_wd_office",
            name: "Excel Document Name",
            filename: filename,
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true
        }); 
    };

    function formatDate(dateStr) 
    {
        const d = new Date(dateStr);
        var mm = String(d. getMonth() + 1). padStart(2, '0'); //January is 0!
        return d.getDate().toString().padStart(2, '0') + '/' + mm + '/' + d.getFullYear().toString().padStart(2, '0');
    }
</script>