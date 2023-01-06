<head>
    <!-- script -->
    <script src="<?= base_url('assets/jquery-form/dist/jquery.form.min.js')?>" ></script>
    <script src="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js')?>" ></script>
    <script src="<?= base_url('assets/plugins/select2/select2.min.js')?>" ></script>  
    <script src="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.js')?>" ></script>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css')?>" >
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.css')?>">
 
    <style>
        .select2-selection__choice{width: 200px;text-align: center;}
        .select2-container .select2-selection--single{height: 34px;}
        .select2-selection__choice__remove{float: right;}

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

    </style>

</head>

<br><br>

<?php
    function getOS() { 
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform =   "Bilinmeyen İşletim Sistemi";
        $os_array =   array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
        
        foreach ( $os_array as $regex => $value ) { 
            if ( preg_match($regex, $user_agent ) ) {
                $os_platform = $value;
            }
        }   
        return $os_platform;
    }

    function getBrowser($user_agent){
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';

        return 'Other';
    }

    $browser = getBrowser($_SERVER['HTTP_USER_AGENT']);
    $ip =  $_SERVER['REMOTE_ADDR']; 
    $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); 

?>

<div class="container">
    <form id="formData_update">
        <div class="panel-group">
            <div class="panel panel-warning">
                <div class="panel-heading" style="height: 50px;"><h4>แก้ไขข้อมูลใบสั่งผลิต - สั่งซ่อมเลขที่ <b><span id="edit_rp_docno"></span></b></h4></div>
                    
                    <div class="panel-body">

                        <div class="info-box bg-red ceocomment">
                            <span class="info-box-icon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> </span>
                            <div class="info-box-content">
                                <h4> ความเห็นผู้บริหาร </h4>
                                <h4 ><span id="edit_rp_ceo"></h4>
                            </div>
                        </div>

                        <div class="panel-group">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label > ผู้ควบคุมการผลิต / การซ่อม </label>
                                                <select class="form-control" id="edit_rp_controller" required>
                                                    <option value=""> เลือกผู้ควบคุมการผลิต / การซ่อม </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label > แผนกที่รับผลิต / รับซ่อม </label>
                                                <select class="form-control" id="edit_rp_topic" required>
                                                    <option value=""> เลือกแผนกที่รับผลิต / รับซ่อม </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel-group">
                            <div class="panel panel-primary">
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label > ชื่องาน </label>
                                                <input type="text" class="form-control edit_rp_name"  id="edit_rp_name" >
                                                <input type="hidden" class="form-control edit_rp_id"  id="edit_rp_id" >
                                                <input type="hidden" class="form-control edit_docno"  id="edit_docno" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label > จำนวนบุคลากร (คน) </label>
                                                <input type="text" class="form-control edit_rp_worker"  id="edit_rp_worker" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label > วันที่ต้องการ </label>
                                                <input type="text" id="edit_rp_require_date" class="form-control pointer" name ="edit_rp_require_date" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label > เหตุผลการสั่งผลิต/สั่งซ่อม </label>
                                                <textarea  rows="3" class="form-control edit_rp_cause" id="edit_rp_cause" ></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label > ประวัติการซ่อม </label>
                                                <textarea  rows="3" class="form-control edit_rp_fix" id="edit_rp_fix" ></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label > รายละเอียดงาน </label>
                                                <textarea  rows="3" class="form-control edit_rp_description" id="edit_rp_description" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-group">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <div class="table-responsive" style="font-size:14px;">
                                        <table id="myTable" class=" table text-nowrap order-list1">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-left">รายการวัสดุ และค่าแรงที่ใช้</th>
                                                    <th class="text-left">จำนวน</th>
                                                    <th class="text-left">หน่วยนับ</th>
                                                    <th class="text-left">ราคาต่อหน่วย</th>
                                                    <th class="text-left">ราคารวม</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tb_itemlist">
                                            </tbody>
                                        </table> 
                                    
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="button" class="btn btn-block " id="addrow_item" value="เพิ่มรายการวัสดุ และค่าแรงที่ใช้" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-lg sum_price" id="sum_price" name="sum_price" placeholder="รวมราคาต้นทุนผลิต / ต้นทุนซ่อมทั้งหมด" style="text-align: center; border: 2px solid rgb(255, 128, 0);" ="" readonly>   
                                                <input type="number" step=".01" class="form-control sum_price2 hidden" id="sum_price2" name="sum_price2" >   
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <button type="submit" class=" form-control btn bg-orange btn-block" ><b> แก้ไขใบสั่งผลิต / ใบสั่งซ่อม </b></button>
                    </div> 

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">

    var edit_rp_topic_id = '';
    var edit_rp_controller_id = '';
    
    $(document).ready(function(){
        get_view_rp();
        get_image();
        get_employee();
        get_topic();
        list_item_request();

        $('textarea').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
            }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        $(document).on('keyup','.field_item_qty',function(){
			cal_item_price(this);
        });
        
        $(document).on('keyup','.field_item_priceunit',function(){
			cal_item_price(this);
		});

        $('#edit_rp_controller').select2();
        $('#edit_rp_topic').select2();
        $('.select2').css('width','100%');
        $('.select2-selection__choice').css('width','200px');

    });

    function get_view_rp(){

        $.ajax({
        type: "POST",
        url: "<?= site_url('Request_production/get_view_rp')?>",
        data: {id : <?= $id ?>},
        dataType: "JSON",
        async: false,
        success: function (response){

            id = response['field_id'];

            var monthNames = [];
            monthNames = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.","ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
         
            var edit_date = response['field_rp_require_date'];
            var edit_date_change = edit_date.split('-');
            var edit_rd = edit_date_change[2] + '/' + edit_date_change[1] + '/' + edit_date_change[0];

            $('#edit_rp_id').val(response['field_id']); 
            $('#edit_docno').val(response['field_docno']); 

            $('#edit_rp_controller').val(response['field_rp_controller']); 
            $('#edit_rp_topic').val(response['field_rp_topic']);

            $('#edit_rp_docno').html(response['field_docno']);
            $('#edit_rp_name').val(response['field_rp_name']);
           
            $('#edit_rp_worker').val(response['field_rp_worker']);
            $("#edit_rp_require_date").datepicker("destroy");
            $("#edit_rp_require_date").datepicker({dateFormat : 'dd/mm/yy'});
            $("#edit_rp_require_date" ).datepicker("setDate", edit_rd);

            $('#edit_rp_cause').val(response['field_rp_cause']);
            $('#edit_rp_fix').val(response['field_rp_fix']);
            $('#edit_rp_description').val(response['field_rp_description']);
           
            edit_rp_topic_id = response['field_rp_topic'];
            edit_rp_controller_id = response['field_rp_controller'];
          
            $('#sum_price2').val(response['field_rp_cost_estimate']);

            $('#tb_itemlist').empty();
            $.each(response['itemlist'], function( key, value ) {
            $('#tb_itemlist').append(

                '<tr id="tb_itemlist_id'+value['field_id']+'">' +
                   
                    '<td style="width:30%">' +
                        '<input type="hidden" name="field_item_id" class="form-control field_item_id"  id="field_item_id" value="'+value['field_id']+'">'+  
                        '<input type="hidden" class="form-control btn-sm check_item" name = "old_item" value="old_item"/>'+
                        '<input type="text" name="field_item_name" class="form-control field_item_name" id="field_item_name" value="'+value['field_item_name']+'">'+
                    '</td>' +

                    '<td>' +
                        '<input type="number" step=".01" name="field_item_qty" class="form-control field_item_qty" id="field_item_qty" value="'+value['field_item_qty']+'">'+
                    '</td>' +

                    '<td>' +
                        '<input type="text" name="field_item_unit" class="form-control field_item_unit" id="field_item_unit" value="'+value['field_item_unit']+'">'+
                    '</td>' +

                    '<td>' +
                        '<input type="number" step=".01" name="field_item_priceunit" class="form-control field_item_priceunit" id="field_item_priceunit" value="'+value['field_item_priceunit']+'">'+
                    '</td>' +

                    '</td>' +
                        '<td class="text-center">' +
                        '<input type="number" readonly name="field_item_price" class="form-control field_item_price" id="field_item_price" value="'+value['field_item_price']+'">'+
                    '</td>' +

                    '<td class="col-sm-1">' +
                        '<input type="text" class="form-control btn bg-red btn-block " onclick="delete_row('+value['field_id']+')" value="ลบ"/>'+
                    '</td>' +

                '</tr>'
                );
            });

            $('#sum_price').val('รวมต้นทุนทั้งสิ้น   ' +  comma(response['field_rp_cost_estimate']) + '   บาท');
          
            var ceocomment = '';
            ceocomment = response['field_ceo_comment'];

            if(ceocomment != null){
                $('#edit_rp_ceo').html(ceocomment);
            }else{
                $('.ceocomment').hide();
            }

        }
        });
    };

    function get_image(){
        var id = <?= $id ?>;
		$('#links').empty();
		$.ajax({
			type:'POST',
			url:'<?= site_url('Request_production/get_image')?>',
			dataType:'JSON',
            data: {id : <?= $id ?>},

		}).done(function(data){
			if(data){
                $('#links').empty();
				$.each(data['scandir'],function(ids,val){

					if(val != '.' && val != '..' && !val.match(/pdf.*/)){  
                        var url = '<?= base_url('assets/images/Request_production/')?>/'+id+'/'+val
                        $('#links').append('<a target="_blank" href="'+url+'" >'+
                            '<img src="'+url+'" width="110" height="110" >'+
                        '</a>');
					
                    }else{
                        var url = '<?= base_url('assets/images/Request_production/')?>/'+id+'/'+val
                        $('#links').append(
                            '<a target="_blank" href="'+url+'" title=" '+val+' ">'+'</a>'
                        );
                    }

				});

			}
		}).fail(function(data){
		});
    };
    
    function comma(val){
        while (/(\d+)(\d{3})/.test(val.toString())){
        val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
        }
        return val;
    }

    function get_employee(){    
        $.ajax({
            type:'GET',
            url:'<?= site_url('Request_production/get_employee')?>',
            dataType:'JSON',
            async: false,
        }).done(function(data){

            $('#edit_rp_controller').empty();
                $.each(data['employee'], function (id, val) {

                    $('#edit_rp_controller').append(
                        '<option value="'+val['id']+'">'+val['pepleid']+' '+val['firstname']+' ('+val['nickname']+')</option>'
                    );

                });

            $('#edit_rp_controller').val(edit_rp_controller_id).trigger('change');

        }).fail(function(data){
        });
    }

    function get_topic(){
        $.ajax({
            type:'GET',
            url:'<?= site_url('Request_production/get_topic')?>',
            dataType:'JSON',
            }).done(function(data){
               
                $('#edit_rp_topic').empty();
                $.each(data['topic'], function (id, value) {

                    $('#edit_rp_topic').append(
                        '<option value="'+value['field_id']+'">'+value['field_topic']+'&nbsp &nbsp'+'>>'+ '&nbsp &nbsp'+value['field_topic_description']+'</option>'
                    );

                });

                $('#edit_rp_topic').val(edit_rp_topic_id).trigger('change');


            }).fail(function(data){
        });
    }

    function cal_item_price(){ 
        // var sum = 0;
        // $('#tb_itemlist').find('tr').each(function(){
        //     sum = sum + Number($(this).find('.field_item_price').val()),2;
        // });

        // $('#sum_price').val('รวมราคาต้นทุนผลิต / ต้นทุนซ่อมทั้งสิ้น ' + (Math.round(sum * 100) / 100).toFixed(2)  + ' บาท');
        // $('#sum_price2').val((Math.round(sum * 100) / 100).toFixed(2));
        var sumrow = 0;
        var sum = 0;

        if($('#tb_itemlist').find('tr').length != 0){
			$('#tb_itemlist').find('tr').each(function(){
			
				if($(this).find('.field_item_qty').val() == ''){
					var item_qty = 0;
				}else{
					var item_qty = $(this).find('.field_item_qty').val();
				}

				if($(this).find('.field_item_priceunit').val() == ''){
					var priceunit = 0;
				}else{
					var priceunit = $(this).find('.field_item_priceunit').val();
				}

				sumrow = item_qty * priceunit;
				$(this).find('.field_item_price').val(parseFloat(sumrow).toFixed(2));
		
				if(sumrow > 0 ){
					sum = sum + sumrow ;
					$('#sum_price').val('รวมราคาต้นทุนผลิต / ต้นทุนซ่อมทั้งสิ้น ' + (Math.round(sum * 100) / 100).toFixed(2)  + ' บาท');
                    $('#sum_price2').val((Math.round(sum * 100) / 100).toFixed(2));
				}

			});
		}
    };

    function list_item_request() { 

        var counter_row = 0;
        $("#addrow_item").on("click", function () {

            $('.field_item_name').css('border','');
            $('.field_item_qty').css('border',''); 
            $('.field_item_unit').css('border','');
            $('.field_item_price').css('border','');
            $('.field_item_priceunit').css('border','');

            if($(".field_item_name").val() != '' && $(".field_item_qty").val() != '' && $(".field_item_unit").val() != '' && $(".field_item_price").val() != '' && $(".field_item_priceunit").val() != ''){

                var newRow = $("<tr>");
                var cols = "";
                cols += '<td class="col-sm-2"><input type="text" class="form-control field_item_name" name="field_item_name ' + counter_row + '" ><input type="text" class="form-control check_item hidden" name = "new_item" value="new_item"/></td>'
                cols += '<td class="col-sm-2"><input type="number" step=".01" class="form-control field_item_qty" name="field_item_qty ' + counter_row + '" ></td>'
                cols += '<td class="col-sm-2"><input type="text" class="form-control field_item_unit" name="field_item_unit ' + counter_row + '" ></td>'
                cols += '<td class="col-sm-2"><input type="number" step=".01" class="form-control field_item_priceunit" name="field_item_priceunit ' + counter_row + '" ></td>'
                cols += '<td class="col-sm-2"><input type="number" step=".01" readonly class="form-control field_item_price" name="field_item_price ' + counter_row + '" ></td>'
                cols += '<td class="col-sm-1"><input type="button" class="ibtnDel btn bg-red btn-block "  value="ลบ" ></td>';
               
                newRow.append(cols);
                $("table.order-list1").append(newRow);
                    }else{
                    if($('.field_item_name').val() == '' ){
                    $('.field_item_name').css('border','rgb(217, 83, 79) 2px solid');
                    } 
                    if($('.field_item_qty').val() == '' ){
                    $('.field_item_qty').css('border','rgb(217, 83, 79) 2px solid');
                    } 
                    if($('.field_item_unit').val() == '' ){
                    $('.field_item_unit').css('border','rgb(217, 83, 79) 2px solid');
                    }
                    if($('.field_item_priceunit').val() == '' ){
                    $('.field_item_priceunit').css('border','rgb(217, 83, 79) 2px solid');
                    }  
                    if($('.field_item_price').val() == '' ){
                    $('.field_item_price').css('border','rgb(217, 83, 79) 2px solid');
                    } 
                }
                counter_row++;
                });

            $("table.order-list1").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();       
                counter_row -= 1
                cal_item_price();
            });
        
        $(document).on('keyup','.field_item_price',function (e) { 
            cal_item_price();
        });

    };

    function delete_row(field_id){
        $('#tb_itemlist_id'+field_id).find('.check_item').val('delete_item');
        $('#tb_itemlist_id'+field_id).find('.field_item_priceunit').val(0);
        $('#tb_itemlist_id'+field_id).find('.field_item_price').val(0);
        $('#tb_itemlist_id'+field_id).addClass('hidden');
        cal_item_price();
    };
    
    $('#formData_update').submit(function(e){
        e.preventDefault();

        $('#edit_rp_name').css('border','');
        $('#edit_rp_worker').css('border','');
        $('#edit_rp_require_date').css('border','');
        $('#edit_rp_cause').css('border','');
        $('#edit_rp_fix').css('border','');
        $('#edit_rp_description').css('border','');

        if($('#edit_rp_name').val() == '' ){
            $('#edit_rp_name').css('border','rgb(217, 83, 79) 2px solid');
        } 

        if($('#edit_rp_worker').val() == '' ){
            $('#edit_rp_worker').css('border','rgb(217, 83, 79) 2px solid');
        }

        if($('#edit_rp_require_date').val() == '' ){
            $('#edit_rp_require_date').css('border','rgb(217, 83, 79) 2px solid');
        }

        if($('#edit_rp_cause').val() == '' ){
            $('#edit_rp_cause').css('border','rgb(217, 83, 79) 2px solid');
        }

        if($('#edit_rp_fix').val() == '' ){
            $('#edit_rp_fix').css('border','rgb(217, 83, 79) 2px solid');
        } 

        if($('#edit_rp_description').val() == '' ){
            $('#edit_rp_description').css('border','rgb(217, 83, 79) 2px solid');
        } 

        if($('#edit_rp_name').val() != '' &&  $('#edit_rp_worker').val() != ''
        && $('#edit_rp_require_date').val() != '' &&  $('#edit_rp_cause').val() != '' 
        && $('#edit_rp_fix').val() != '' && $('#edit_rp_description').val() != ''){
            swal({
            title: 'บันทึกการแก้ไขข้อมูลเหรอออ?',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1AA45F',
            cancelButtonColor: '#DB4B3F',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.value) {
                    update_rp_history();
                }
            });
        }
    });

    function update_rp_history(){

        var tb_itemlist = [];

        $('#tb_itemlist').find('tr').each(function(){
            
            var tb_itemlists = {};
            tb_itemlists['field_item_id'] = $(this).find('.field_item_id').val();
            tb_itemlists['field_item_name'] = $(this).find('.field_item_name').val();
            tb_itemlists['field_item_qty'] = $(this).find('.field_item_qty').val();
            tb_itemlists['field_item_unit'] = $(this).find('.field_item_unit').val();
            tb_itemlists['field_item_priceunit'] = $(this).find('.field_item_priceunit').val();
            tb_itemlists['field_item_price'] = $(this).find('.field_item_price').val();
            tb_itemlists['check_item'] = $(this).find('.check_item').val();
            tb_itemlist.push(tb_itemlists);

        });

        var ip = '<?php echo $ip; ?>';
        var comname = '<?php echo $hostname; ?>';
        var os_platform = '<?= getOS(); ?>';
        var browser = '<?php echo $browser; ?>';
        

        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/update_rp_history')?>',
            dataType:'JSON',
            data:{
                id:$('#edit_rp_id').val(),
                docno:$('#edit_docno').val(),
                rp_topic:$('#edit_rp_topic').val(),
                rp_controller:$('#edit_rp_controller').val(),
                rp_require_date:$('#edit_rp_require_date').val(),
                rp_name:$('#edit_rp_name').val(),
                rp_description:$('#edit_rp_description').val(),
                rp_cause:$('#edit_rp_cause').val(),
                rp_fix:$('#edit_rp_fix').val(),
                rp_worker:$('#edit_rp_worker').val(),
                rp_cost:$('#sum_price2').val(),
                tb_itemlist : tb_itemlist,
                ip : ip,
                comname : comname,
                os_platform : os_platform,
                browser : browser
               
            },
        }).done(function(data)
        {
            swal({ 
                title: 'สำเร็จ!',
                text: "บันทึกข้อมูลสำเร็จ",
                type: 'success',
            }).then((result) => {
                if (result.value) { 
                    location.reload();
                }
            });
        }).fail(function(data){
            swal({
                title: 'มีข้อผิดพลาด',
                text: "ติดต่อแผนกไอที 30",
                type: 'error',
                timer: 5000
            }).then((result) => {
                if (result.value) { 
                    location.reload();
                }
            });
        });
    };

</script>