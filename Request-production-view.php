<head>
    <!-- script -->
    <script src="<?= base_url('assets/jquery-form/dist/jquery.form.min.js')?>" ></script>
    <script src="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js')?>" ></script>
    <script src="<?= base_url('assets/plugins/select2/select2.min.js')?>" ></script>  
    <script src="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.js')?>" ></script>

    <script type="text/javascript" src="<?= base_url('assets/bootstrap-datepicker-thai-thai/js/bootstrap-datepicker.js')?>" charset="UTF-8"></script>
    <script type="text/javascript" src="<?= base_url('assets/bootstrap-datepicker-thai-thai/js/bootstrap-datepicker-thai.js')?>" charset="UTF-8"></script>
    <script type="text/javascript" src="<?= base_url('assets/bootstrap-datepicker-thai-thai/js/locales/bootstrap-datepicker.th.js')?>" charset="UTF-8"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css')?>" >
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-datepicker-thai-thai/css/datepicker.css')?>">
 
    <style>

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

        .links img{padding: 5px;}
        .links_edit img{padding: 5px;}

        .links a[href$=".pdf"]:before {
            width:48px;
            height:48px;
            background:url('http://10.10.11.14/sk_main/saereeHR/assets/images/PDF.png');
            display:inline-block;
            content:'';
        }

        .users-list>li img {
            border-radius: 5%;
            max-width: 89%;
            height: auto;
        }

    </style>

</head>

<br><br>

<div class="container" >
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading" style="height: 50px;"><h4>ข้อมูลใบสั่งผลิต - สั่งซ่อมเลขที่ <b><span id="view_docno"></span></b></h4></div>
                
                <div class="panel-body">

                    <div class="info-box bg-red ceocomment">
                        <span class="info-box-icon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> </span>
                        <div class="info-box-content">
                            <h4> ความเห็นผู้บริหาร </h4>
                            <h4 ><span id="view_ceo_comment"></h4>
                        </div>
                    </div>

                    <div class="panel-group">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label > ผู้สั่งผลิต / ผู้สั่งซ่อม </label>
                                            <input type="text" class="form-control"  id="view_creator" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label > วันที่สั่งผลิต / สั่งซ่อม </label>
                                            <input type="text" class="form-control"  id="view_create_date" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label > ผู้ควบคุมการผลิต / การซ่อม </label>
                                            <input type="text" class="form-control"  id="view_controller" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label > แผนกที่รับผลิต / รับซ่อม </label>
                                            <input type="text" class="form-control"  id="view_topic" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label > พนักงานรับทำงาน </label>
                                            <input type="text" class="form-control"  id="view_worker_name" readonly>
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
                                            <input type="text" class="form-control"  id="view_name" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label > จำนวนบุคลากร (คน) </label>
                                            <input type="text" class="form-control"  id="view_worker" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label > วันที่ต้องการ </label>
                                            <input type="text" class="form-control"  id="view_require_date" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label > เหตุผลการสั่งผลิต/สั่งซ่อม </label>
                                            <textarea  rows="3" class="form-control" id="view_cause" readonly></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label > ประวัติการซ่อม </label>
                                            <textarea  rows="3" class="form-control" id="view_fix" readonly></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label > รายละเอียดงาน </label>
                                            <textarea  rows="3" class="form-control" id="view_description" readonly></textarea>
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
                                    <table id="myTable" class=" table table-hover text-nowrap order-list1">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-left" >ลำดับ</th>
                                                <th class="text-left" >รายการวัสดุ และค่าแรงที่ใช้</th>
                                                <th class="text-right">จำนวน</th>
                                                <th class="text-right">หน่วยนับ</th>
                                                <th class="text-right">ราคาต่อหน่วย</th>
                                                <th class="text-right">ราคารวม</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb_itemlist">
                                        </tbody>
                                    </table> 

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control input-lg sum_price" id="sum_price" name="sum_price" placeholder="รวมราคาต้นทุนผลิต / ต้นทุนซ่อมทั้งหมด" style="text-align: center; border: 2px solid rgb(40, 180, 99);" readonly="">   
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
                                        <label > รูปภาพประกอบ </label>
                                            <div id="links" class="links text-left"></div>
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

<script type="text/javascript">
    
    $(document).ready(function(){
        get_view_rp();
        get_image();
        // get_employee();

        $('textarea').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
            }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

    });

    function get_view_rp(){

        $.ajax({
        type: "POST",
        url: "<?= site_url('Request_production/get_view_rp')?>",
        data: {id : <?= $id ?>},
        dataType: "JSON",
        async: false,
        success: function (response){

            console.log(response)

            id = response['field_id'];

            get_image(id);

            var monthNames = [];
            monthNames = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.","ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
         
            var d = new Date(response['field_rp_create_date']); 
            var rd = new Date(response['field_rp_require_date']);

            $('#view_docno').html(response['field_docno']);
            $('#view_name').val(response['field_rp_name']);
            $('#view_topic').val(response['topic_name']);
            
            $('#view_creator').val(response['creator_firstname']+' '+response['creator_lastname']+'('+response['creator_nickname']+')' +'  แผนก  '  +response['creator_departname']);

            if(response['controller_firstname'] != null){
                $('#view_controller').val(response['controller_firstname']+' '+response['controller_lastname']+'('+response['controller_nickname']+')' +'  แผนก  '  +response['controller_departname']);
            }else{
                $('#view_controller').val('ไม่ได้ระบุผู้ควบคุมการผลิต / การซ่อม');
            }  

            $('#view_create_date').val(d.getDate()+'  '+monthNames[d.getMonth()]+'  '+(d.getFullYear()+543));
            $('#view_worker').val(response['field_rp_worker']);
            $('#view_worker_name').val(response['field_rp_worker_id']);
            view_worker_name = response['field_rp_worker_id'];
            $('#view_require_date').val(rd.getDate()+'  '+monthNames[rd.getMonth()]+'  '+(rd.getFullYear()+543));

            $('#view_worker_name').val(response['rp_worker_name']);

            $('#view_cause').val(response['field_rp_cause']);
            $('#view_fix').val(response['field_rp_fix']);
            $('#view_description').val(response['field_rp_description']);

            $('#sum_price').val('รวมต้นทุนทั้งสิ้น   ' +  comma(response['field_rp_cost_estimate']) + '   บาท');

            var item_row = 0;
            $('#tb_itemlist').empty();
            $.each(response['itemlist'], function( key, value ) {
            item_row++
            $('#tb_itemlist').append(
                '<tr>' +
                    '<td class="text-left" >' +
                        '<span>'+item_row+'</span>'+
                    '</td>' +
                    '<td class="text-left" style="width:20%" >' +
                        '<span placeholder="*ไม่มีข้อมูล" id="field_item_name" >'+value['field_item_name']+'</span>'+
                    '</td>' +
                    '<td class="text-right">' +
                        '<span placeholder="*ไม่มีข้อมูล" id="field_item_qty" >'+value['field_item_qty']+'</span>'+
                    '</td>' +
                        '<td class="text-right">' +
                        '<span placeholder="*ไม่มีข้อมูล" id="field_item_unit" >'+comma(value['field_item_unit'])+'</span>'+
                    '</td>' +
                    '</td>' +
                        '<td class="text-right">' +
                        '<span placeholder="*ไม่มีข้อมูล" id="field_item_priceunit" >'+comma(value['field_item_priceunit'])+'</span>'+
                    '</td>' +
                    '</td>' +
                        '<td class="text-right">' +
                        '<span placeholder="*ไม่มีข้อมูล" id="field_item_price" >'+comma(value['field_item_price'])+'</span>'+
                    '</td>' +
                '</tr>'
                );
            });

            
            
            var ceocomment = '';
            ceocomment = response['field_ceo_comment'];

            if(ceocomment != null){
                $('#view_ceo_comment').html(ceocomment);
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

    // function get_employee(){
        //     $.ajax({
        //         type:'GET',
        //         url:'<?= site_url('Request_production/get_employee')?>',
        //         dataType:'JSON',
        //         }).done(function(data){

        // 			$('#view_worker_name').empty();
        //             $.each(data['employee'],function(id,val){
        // 				$('#view_worker_name').append('<option value="'+val['id']+'"> '+val['firstname']+' ('+val['nickname']+') แผนก'+val['dename']+'</option>');
        //             });

        // 			if(view_worker_name != '' ){
        // 				$.each(view_worker_name.split(','),function(id,val){
        // 					$('#view_worker_name').find('option').each(function(){
        // 					if($(this).val() == val){
        // 						$(this).attr('selected','selected');
        // 					}
        // 					});
        // 				});
        // 			}
        //             }).fail(function(data){
        //     });
    // }

</script>