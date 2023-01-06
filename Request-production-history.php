<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<head>
    <!-- script -->
    <script src="<?= base_url('assets/jquery-form/dist/jquery.form.min.js')?>" ></script>
    <script src="<?= base_url('assets/jquery-validation/dist/jquery.validate.js')?>" ></script>
    <script src="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js')?>" ></script>
    <script src="<?= base_url('assets/plugins/select2/select2.min.js')?>" ></script>  
    <script src="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.js')?>" ></script>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css')?>" >
    <link href="<?= base_url('assets/css/style.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.css')?>">    
</head>

<style>

    td.ellipsis {
        max-width: 10px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

</style>

<div class="container"  style="width: 80%;">
    <?php $this->Function_model->BREADCRUMB(array('หน้าแรก' => base_url(), 'ใบสั่งผลิต - ใบสั่งซ่อม' => base_url('index.php/Request_production'), 'ประวัติใบสั่งผลิต - ใบสั่งซ่อม' => '')); ?>
    
    <div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title"> Request Production History </h3></div>
        <div class="box-body">

            <div class="row" id="rp_history">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="table-responsive">  
                            <table  class="table table-hover" show-filter="true">
                                <thead >
                                    <tr>  
                                        <th class="text-left" width="10%">ลำดับ</th>      
                                        <th class="text-left" width="10%">วันที่</th>      
                                        <th class="text-left" width="20%">สถานะ</th>      
                                        <th class="text-left" width="15%">ผู้แก้ไข</th> 
                                        <th class="text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_rp_history"> 

                                </tbody>
                            </table>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-success">
        <div class="box-header with-border"><h3 class="box-title"> Progress </h3></div>
            
            <div class="box-body">
                <div class="row" id="rp_progress">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="table-responsive">  
                                <table  class="table table-hover" show-filter="true">
                                    <thead >
                                        <tr>  
                                            <th class="text-left"  width="10%">ลำดับ</th>      
                                            <th class="text-left"  width="10%">วันที่</th>      
                                            <th class="text-left"  width="20%">ความคืบหน้า</th> 
                                            <th class="text-left"  width="15%">ผู้บันทึก</th> 
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_rp_progress"> 
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="historyModal" role="dialog" >
        <div class="modal-dialog modal-lg" role="document">		
            <div class="modal-content" >
                <div class="modal-header bg-primary">
                    <h4 class="modal-title"><b>ประวัติใบสั่งผลิต / ใบสั่งซ่อม</span> </b></h4>
                </div>
        
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label > ผู้แก้ไข </label>
                                <input type="text" class="form-control"  id="history_rp_editor" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label > วันที่แก้ไข </label>
                                <input type="text" class="form-control"  id="history_rp_edit_date" readonly>
                            </div>
                        </div>
                    </div>

                    <hr style="border-color:#0ea3cc;"></hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label > หัวข้องาน </label>
                                <input type="text" class="form-control"  id="history_rp_topic" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label > ชื่องาน </label>
                                <input type="text" class="form-control"  id="history_rp_name" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label > วันที่ต้องการ </label>
                                <input type="text" class="form-control"  id="history_rp_require_date" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label > จำนวนบุคลากร (คน) </label>
                                <input type="text" class="form-control"  id="history_rp_worker" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label > รายละเอียดงาน </label>
                                <textarea  rows="4" class="form-control" id="history_rp_description" readonly></textarea>
                            </div>
                        </div>
                    </div>

                    <hr style="border-color:#0ea3cc;"></hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label > ความเห็นผู้บริหาร </label>
                                <textarea  rows="3" class="form-control" id="history_rp_ceo_comment" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="progressModal" role="dialog" >
    <div class="modal-dialog modal-lg" role="document">		
            <div class="modal-content" >
                <div class="modal-header bg-green">
                    <h4 class="modal-title"><b>ความคืบหน้าใบสั่งผลิต / ใบสั่งซ่อม</span> </b></h4>
                </div>
        
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label > ผู้บันทึก </label>
                                <input type="text" class="form-control"  id="progress_editor" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label > วันที่บันทึก </label>
                                <input type="text" class="form-control"  id="progress_date" readonly>
                            </div>
                        </div>
                    </div>

                    <hr style="border-color:#00a002;"></hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label > ความคืบหน้า </label>
                                <textarea  rows="4" class="form-control" id="progress_update" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">close</button>
                </div>

            </div>
        </div>

</div>

<script>
    $(document).ready (function(){
        get_rp_history();

        get_rp_progress();

        $('#tbody_rp_history').on('click','.btn_view_history',function(){  
            get_view_history(
                $(this).closest('tr').find('.id').text(),
            );
        });

        $('#tbody_rp_progress').on('click','.btn_view_progress',function(){  
            get_view_progress(
                $(this).closest('tr').find('.id').text(),
            );
        });


    });

    function get_rp_history() { 
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/get_rp_history')?>',
            dataType:'JSON',
            data : {
                id : <?= $id ?>
            },
            }).done(function(data){

                    console.log(data)
                    
                   
                    var num_row = 0;    
                    $('#tbody_rp_history').empty();
                    $.each(data['rp_history'], function (id, value) {
                        num_row++
                        var d = new Date(value['field_edit_date']);

                        var editor = '';
						if(value['field_editor'] == "ceo"){
                            // editor = 'ผู้บริหาร';
                            editor = value['ceo_id'] + '(ผู้บริหาร)'
                        }else{
                            editor = value['firstname'] +'   ('+ value['nickname']+')' 
                        }
                        
                        var status = '';
                        if(value['field_editor'] == "ceo"){
                            status = 'ผู้บริหารสั่งแก้ไข';
                        }else{
                            status = 'แก้ไข'
                        }

                        var btn_view_history  = '<button class="btn bg-aqua btn_view_history "type="button" > ดู </i></button> ';	

                        $('#tbody_rp_history').append(
                        '<tr>'+
                        '<td class="hidden id">'+value['field_id']+'</td>'+
                        '<td class="text-left">'+num_row+'</td>'+
                        '<td class="text-left">'+d.getDate()+'/'+(d.getMonth()+1)+'/'+(d.getFullYear())+'  '+(d.getHours())+':'+(d.getMinutes()<10?'0':'') + d.getMinutes()+' น.</td>'+
                        '<td class="text-left">'+status+'</td>'+
                        '<td class="text-left">'+editor+'</td>'+
						'<td class="text-center">'+btn_view_history+'</td>'+
                        '</tr>'
                        );
                    });
                
            }).fail(function(data){
        });
    };

    function get_rp_progress() { 
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/get_rp_progress')?>',
            dataType:'JSON',
            data : {
                id : <?= $id ?>
            },
            }).done(function(data){

                    
                    var num_row = 0;    
                    $('#tbody_rp_progress').empty();
                    $.each(data['rp_progress'], function (id, value) {
                        num_row++
                        var d = new Date(value['field_update_date']);

                        var editor = '';
						if(value['field_editor'] == "ceo"){
                            editor = 'ผู้บริหาร';
                        }else{
                            editor = value['firstname'] + value['nickname']
                        }
                        
                        var status = '';
                        if(value['field_editor'] == "ceo"){
                            
                            status = 'ผู้บริหารสั่งแก้ไข';
                        }else{
                            status = 'แก้ไข'
                        }

                        var btn_view_progress  = '<button class="btn bg-aqua btn_view_progress "type="button" > ดู </i></button> ';	

                        $('#tbody_rp_progress').append(
                        '<tr>'+
                        '<td class="hidden id">'+value['field_id']+'</td>'+
                        '<td class="text-left">'+num_row+'</td>'+
                        '<td class="text-left">'+d.getDate()+'/'+(d.getMonth()+1)+'/'+(d.getFullYear())+'  '+(d.getHours())+':'+(d.getMinutes()<10?'0':'') + d.getMinutes()+' น.</td>'+
                        '<td class="text-left ellipsis" >'+value['field_update']+'</td>'+
                        '<td class="text-left">'+editor+'</td>'+
						'<td class="text-center">'+btn_view_progress+'</td>'+
                        '</tr>'
                        );
                    });
                
            }).fail(function(data){
        });
    };
  
    function get_view_history(id){
        $('#historyModal').modal('show');
        $.ajax({
            type: "POST",
            url: "<?= site_url('Request_production/get_view_history')?>",
            dataType: "JSON",
            data:{
                id : id
                },
            async: false,
            success: function (response){

                    var d = new Date(response['field_edit_date']); 
                    var rd = new Date(response['field_rp_history_require_date']); 
                    var editor = (response['editor_firstname']); 

                    $('#history_rp_edit_date').val(d.getDate()+' / '+(d.getMonth()+1)+' / '+(d.getFullYear()));
                    $('#history_rp_topic').val(response['topic_name']); 
                    $('#history_rp_name').val(response['field_rp_history_name']);   
                    $('#history_rp_description').val(response['field_rp_history_description']);
                    $('#history_rp_require_date').val(rd.getDate()+' / '+(rd.getMonth()+1)+' / '+(rd.getFullYear()));
                    $('#history_rp_worker').val(response['field_rp_history_worker']);
                    $('#history_rp_ceo_comment').val(response['field_rp_history_ceo']);

                    if(editor != null){    
                        $('#history_rp_editor').val(response['editor_firstname']+' ('+response['editor_nickname']+')' +'  แผนก  '  +response['editor_departname']);
                    }else{
                        $('#history_rp_editor').val('ผู้บริหาร')
                    }
            }
        
        });
    };

    function get_view_progress(id){

        $('#progressModal').modal('show');
        $.ajax({
            type: "POST",
            url: "<?= site_url('Request_production/get_view_progress')?>",
            dataType: "JSON",
            data:{
                id : id
                },
            async: false,
            success: function (response){

                var d = new Date(response['field_update_date']); 
                $('#progress_editor').val(response['editor_firstname']+' ('+response['editor_nickname']+')' +'  แผนก  '  +response['editor_departname']);
                $('#progress_date').val(d.getDate()+' / '+(d.getMonth()+1)+' / '+(d.getFullYear()));
                $('#progress_update').val(response['field_update']);
                    
            }
        
        });
    };
</script>