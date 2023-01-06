<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction(); ?>

<script type="text/javascript">

    $(document).ready(function () {
        all_click();
        get_destroy_list();
        autocomplete_bcitem();
        select2();
    });

    function select2() {  
        $( "#search_status" ).select2({
            theme: "bootstrap4"
        });

        $( "#destroy_comment_success" ).select2({
            theme: "bootstrap4"
        });
    }

    function all_click() {

        $('#btn_refresh').click(function (e) { 
            e.preventDefault();
            get_destroy_list();
        });

        $('#usersPerPage').change(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
            get_destroy_list();
        });

        $('#search_recheck').change(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
            get_destroy_list();
        });


        $('#search_status').change(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
            get_destroy_list();
        });

		$('#search_text').keyup(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
            get_destroy_list();
		});

		$(document).on('click','.pageNumber',function(){
			$('#pageNumber').val($(this).text()-1);
            get_destroy_list();
		});


		$('#links_file').on('click','.btn_delete_file',function(){ 
			delete_id = $('#delete_id').val();
			delete_file_name = $('#delete_file_name').val();
			delete_file(delete_id,delete_file_name);
		});

        $("#uploadimage").on('submit',(function(e){
            e.preventDefault();
                $.ajax({
                url: "<?= site_url('SignV2/upload_image_destroy')?>", 
                type: "POST",             
                data: new FormData(this), 
                contentType: false,      
                cache: false,
                processData:false,    
                dataType: "JSON",  
                success: function(data){

                    if(data['check_pic'] == 'error_data_type' ){
                        swal({
                            title: 'ผิดพลาด',
                            text: "ประเภทไฟล์ไม่ถูกต้อง",
                            type: 'warning'
                        });

                    }else if(data['check_pic'] == 'error_data_file'){
                        swal({
                            title: 'ผิดพลาด',
                            text: "เฉพาะไฟล์ .jpg เท่านนั้น!",
                            type: 'warning'
                        });

                    }else if(data['check_pic'] == 'maxvalue' ){
                        swal({
                            title: 'ผิดพลาด',
                            text: "ท่านอัปโหลดรูปภาพเต็มจำนวนที่กำหนดแล้ว",
                            type: 'warning'
                        });

                    }else if(data['check_pic'] == 'maxvalue_more' ){
                        $('#uploadModal').modal('hide');
                        swal({ 
                            title: 'สำเร็จ!',
                            text: 'อัปโหลดได้ 2 รูปเท่านั้น',
                            type: 'success',
                        }).then((result) => {
                        if (result.value) {
                                get_destroy_list();
                            }
                        });
                    
                    }else if(data['check_pic'] == 'success'){
                        $('#uploadModal').modal('hide');
                        swal({ 
                            title: 'สำเร็จ!',
                            text: 'เพิ่มรูปภาพสำเร็จ',
                            type: 'success',
                        }).then((result) => {
                        if (result.value) {
                            get_destroy_list();
                        }
                        });
                    }
                }
            });
        }));

        $('#submit_edit_success').click(function (e) { 
            e.preventDefault();
            var field_id = $('#destroy_edit_id').val();
            swal({
                title: 'ต้องการทำลายป้ายนี้หรือไม่?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.value) {
                    update_edit_destroy_comment(field_id);
                }
            });
        });

        $('#destroy').click(function (e) { 
            e.preventDefault();
            $('#text_status_destroy').empty();
            $('#text_status_destroy').append('<b>สถานะสินค้า : </b>');
            $('#search_itemcode').val('');
            $('#destroy_comment_success').val('');
            $('#destroy_itemname_success').val('');
            $('#tb_destroy_success_list').empty();
            destroy_comment();
            $('#destroy_success_Modal').modal('show');


        });

        $('#tbody_sign').on('click','.btn_upload',function(){ 
            var id = $(this).closest('tr').find('.field_id').text();
			// var check_status = $(this).closest('tr').find('.field_recheck').text();
			var docno = $(this).closest('tr').find('.field_docno').text();
            var field_recheck_status = $(this).closest('tr').find('.field_recheck_status').text();
			// var code = $(this).closest('tr').find('.field_itemcode').text();
			$('#upload_id').val(id);
			$('#upmodal_name').text('เพิ่มรูปภาพของเลขที่เอกสาร '+docno);
			$('#uploadModal').modal('show');
 
			get_file(id,field_recheck_status);
        });

        $('#tbody_sign').on('click','.btn_info',function(){ 
            var id = $(this).closest('tr').find('.field_id').text();
			var name = $(this).closest('tr').find('.field_itemname').text();
			var code = $(this).closest('tr').find('.field_itemcode').text();
            var docno = $(this).closest('tr').find('.field_docno').text();
            var comment = $(this).closest('tr').find('.field_comment').text();
			$('#destroy_info_Modal').modal('show');

            $('#destroy_itemcode_info').val(code);
            $('#destroy_itemname_info').val(name);
            $('#title_info').text('ข้อมูลป้ายที่ทำลาย เลขที่เอกสาร '+docno);
            $('#destroy_comment_info').val(comment);
            get_file(id)
            get_destroy_info(id);
        });

        $('#tbody_sign').on('click','.btn_edit',function(){ 
            var id = $(this).closest('tr').find('.field_id').text();
			var name = $(this).closest('tr').find('.field_itemname').text();
			var code = $(this).closest('tr').find('.field_itemcode').text();
            var docno = $(this).closest('tr').find('.field_docno').text();
            var comment = $(this).closest('tr').find('.field_comment').text();

            $('#destroy_edit_id').val(id);
            $('#destroy_comment_edit_info').val(comment);
			$('#destroy_edit_Modal').modal('show');

            destroy_comment();
            $( "#destroy_comment_edit" ).select2({
                theme: "bootstrap4"
            });

            get_file(id)
            get_destroy_info(id);
        });

        $('#tbody_sign').on('click','.btn_check',function(){ 
            var field_id = $(this).closest('tr').find('.field_id').text();
            var status_recheck = '2';

            swal({
                title: 'ต้องการตรวจสอบป้ายนี้หรือไม่?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
		    }).then((result) => {
                if (result.value){
                    update_recheck(field_id,status_recheck);
                }
            });
        });

        $('#tbody_sign').on('click','.btn_change_status',function(){ 
            var field_id = $(this).closest('tr').find('.field_id').text();
            swal({
                title: 'ต้องการเปลี่ยนสถานะเป็นไม่มีรูปทำลาย?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
		    }).then((result) => {
                if (result.value){
                    update_change_status_destroy(field_id);
                }
            });
        });

        $('#tbody_sign').on('click','.btn_destroy_cancel',function(){ 
            var field_id = $(this).closest('tr').find('.field_id').text();
            swal({
                title: 'ต้องการถอยการทำลาย?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
		    }).then((result) => {
                if (result.value){
                    update_cancel_destroy(field_id);
                }
            });
        });

        $('#tbody_sign').on('click','.btn_cancel',function(){ 
            var field_id = $(this).closest('tr').find('.field_id').text();
            var status_recheck = '3';
            swal({
                title: 'ต้องการตรวจสอบป้ายนี้หรือไม่?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
		    }).then((result) => {
                if (result.value){
                    update_recheck(field_id,status_recheck);
                }
            });

        });

        $('#tb_destroy_success_list').delegate('tr', 'click', function(e) {
            if($(this).hasClass('select')){
                $(this).removeClass('select');
                $('#dataSelect tr#'+$(this).attr('id')).remove();
                if($('#sign_destroy_list tbody tr.select').length == 0){
                }
            }else{
                if ($(this).closest('tr').find('.active_status').text() == 'ทำลายได้') {
                    $(this).addClass('select');
                    $(this).clone().appendTo('#dataSelect tbody');
                    $('#dataSelect tr#'+$(this).attr('id')+' td.remove').remove();
                    $('#dataSelect tr#'+$(this).attr('id')).removeClass('select');
                }
            }
        });

        $('#form_confirm_success_destroy').submit(function(e){
            e.preventDefault();
            if($('#tb_destroy_success_list tr.select').length > 0 ){
                var id = '';
                var field_sign_id = '';
                var i = 0;
                for( i ; i < $('#tb_destroy_success_list tr.select').length; i++ ){
                    id += $('#tb_destroy_success_list tr.select').eq(i).attr('id')+'-';
                }
                //field_sign_id = $('#tb_success_packing').closest('tr').find('.field_sign_id').text();
                //console.log(id,field_sign_id);
                //update_packing(id);
                if ($('#destroy_comment_success').val() != '') {
                    update_destroy(id,$('#destroy_comment_success').val());
                }
                else{
                    swal({
                        title: 'กรุณากรอกหมายเหตุ',
                        type: 'warning',
                        timer: 3000
                    });
                }
                
                }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'warning',
                    timer: 3000
                });
            }
        });	
    }

    function update_destroy(id,destroy_comment) {  
        var itemname = $('#destroy_itemname_success').val();

        var img = '0';
        if ($('#no_image').is(":checked"))
        {
            img = '1';
        }

        swal({
			title: 'ต้องการทำลายป้ายนี้หรือไม่?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'ใช่',
			cancelButtonText: 'ยกเลิก',
		}).then((result) => {
			if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('SignV2/update_destroy_sub')?>",
                    data: {
                        id : id,
                        destroy_comment : destroy_comment,
                        destroy_comment_more : $('#destroy_comment_more').val(),
                        img : img,
                        itemname : itemname
                    },
                    dataType: "JSON",
                    success: function (data) {
                        swal({ 
                            title: 'สำเร็จ!',
                            text: 'ทำลายป้ายเรียบร้อยแล้ว',
                            type: 'success',
                        }).then((result) => {
                            if (result.value) {
                                $('#destroy_success_Modal').modal('hide');
                                get_destroy_list();
                            }
                        });
                    }
                });
			}
		});
    }
    

    function autocomplete_bcitem(){
		$("#search_itemcode").autocomplete({
		source: function( request, response ) {
			$.ajax({
			type:'POST',
			url:'<?= site_url('SignV2/autocomplete_bcitem')?>',
			dataType:'JSON',
			data:{search_itemcode : $('#search_itemcode').val()},
			}).done(function(data){
			response(data);
                console.log(data);
			}).fail(function(data){

			});
		},
		autoFocus:true,
		delay: 0,
		minLength: 0,
		select: function( id,val ){
		
			$("#search_itemcode").val(val.item.code);
            // get_sign_place_old_list(val.item.value);
            // get_item_info(val.item.value);
            $('#destroy_itemname_success').val(val.item.name_1);
            get_select_destroy();
			return false;
		}

		}).autocomplete('instance')._renderItem = function(ul,item){
			return $('<li>')
			.append('<div>'+ '<span class="bg-green text-white">' + item.code + '</span>' + '<span"> [ ' + item.name_1 + ' ] ' + item.name_2 + '</span></div>')
			.appendTo(ul);
		};
	};



    function update_edit_destroy_comment(field_id) {  
        var destroy_comment = $('#destroy_comment_edit').val();

        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/update_edit_destroy_comment')?>",
            data: {
                field_id : field_id,
                destroy_comment : destroy_comment
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                swal({ 
                    title: 'สำเร็จ!',
                    text: 'แก้ไขเรียบร้อยแล้ว',
                    type: 'success',
                }).then((result) => {
                    if (result.value) {
                        $('#destroy_edit_Modal').modal('hide');
                        get_destroy_list();
                    }
                });
            }
        });
    }

    function get_select_destroy() {  
        var item_code = $('#search_itemcode').val();
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_select_destroy')?>",
            data: {
                item_code : item_code
            },
            dataType: "json",
            success: function (data) {
                $('#div_status_destroy').empty();
                console.log(data);
                $('#tb_destroy_success_list').empty();
                var num_row = 0;
                if (data['ic_inventory_detail'] != null) {
                    if (data['ic_inventory_detail']['is_hold_purchase'] == 1 && data['ic_inventory_detail']['is_hold_sale'] == 1) {
                        $('#div_status_destroy').append(
                            '<b>สถานะสินค้า : </b>'+
                            '<span class="text-danger">เลิกใช้งาน </span>'+
                            '<span class="text-success">[ สามารถทำลายได้ ]</span>'
                        );
                    }else{
                        $('#div_status_destroy').append(
                            '<b>สถานะสินค้า : </b>'+
                            '<span class="text-success">ใช้งาน </span>'+
                            '<span class="text-danger">[ ไม่สามารถทำลายได้ ]</span>'
                        );
                    }
                }else{
                    $('#div_status_destroy').append(
                        '<b>สถานะสินค้า : </b>'+
                        '<span class="text-danger">รหัสถูกลบ </span>'+
                        '<span class="text-success">[ สามารถทำลายได้ ]</span>'
                    );
                }

                $.each(data['destroy'], function (idx, val) { 
                    num_row ++;

                    var type_status_destroy = 'ทำลายไม่ได้';
                    if (data['ic_inventory_detail'] != null) {
                        if (data['ic_inventory_detail']['is_hold_purchase'] == 1 && data['ic_inventory_detail']['is_hold_sale'] == 1) {
                            type_status_destroy = 'ทำลายได้'

                        }else{

                        }
                    }else{
                        type_status_destroy = 'ทำลายได้'
                    }

                    if (val['field_special_destroy'] == 1) {
                        type_status_destroy = 'ทำลายได้'
                    }

                    var type_sign_price = 'ไม่ได้เก็บข้อมูล';
                    if (val['field_type_sign_price'] != null) {
                        type_sign_price = val['type_name_price'];
                    }
                    var docno = '';
                    if (val['field_sg_docno']) {
                        docno = val['field_sg_docno'];
                    }else{
                        docno = 'ยังไม่ได้อ้างอิง';
                    }

                    if (val['field_type_sign_price'] == 9) {
                        type_status_destroy = 'ทำลายได้'
                    }

                    $('#tb_destroy_success_list').append(
                        '<tr id='+val['field_old_id']+'>'+
                            '<td>'+num_row+'</td>'+
                            '<td hidden class="field_id" >'+ val['size_name'] +'</td>'+
                            '<td>'+ docno +'</td>'+
                            '<td>'+ val['field_place_name'] +'</td>'+
                            '<td>'+ val['size_name'] +'</td>'+
                            '<td>'+ type_sign_price +'</td>'+
                            '<td class="text-right">'+val['sign_amount']+'</td>'+
                            '<td class="active_status">'+ type_status_destroy +'</td>'+
                        '</tr>'
                    );
                });
            }
        });
    }

    function get_destroy_info(id) {  
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_destroy_info')?>",
            data: {
                id : id
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#tb_destroy_info_list').empty();
                var num_row = 0;
                $.each(data, function (idx, val) { 
                    num_row ++;
                    var type_sign_price = 'ไม่ได้เก็บข้อมูล';
                    if (val['field_type_sign_price'] != null) {
                        type_sign_price = val['type_name_price'];
                    }

                    $('#tb_destroy_info_list').append(
                        '<tr id='+val['field_destroy_id']+'>'+
                            '<td width="20%">'+num_row+'</td>'+	
                            '<td hidden class="field_id" style="text-align:left;">'+ val['size_name'] +'</td>'+
                            '<td width="30%" style="text-align:left;">'+ val['field_place_name'] +'</td>'+
                            '<td width="20%" style="text-align:left;">'+ val['size_name'] +'</td>'+
                            '<td width="20%" style="text-align:left;">'+ type_sign_price +'</td>'+
                            '<td class="text-right" width="10%">'+val['sign_amount']+'</td>'+
                        '</tr>'
                    );
                });
            }
        });
    }


    function get_destroy_list() {  

        var search_text = $('#search_text').val();
        var usersPerPage = parseInt($('#usersPerPage').val());
        var pageNumber = parseInt($('#pageNumber').val());
        var search_status = $('#search_status').val();
        var search_recheck = $('#search_recheck').val();
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_destroy_list')?>",
            data: {
				pageNumber : pageNumber ,
				usersPerPage : usersPerPage,
				search_text : search_text,
                search_status : search_status,
                search_recheck : search_recheck
            },
            dataType: "json",
            success: function (data) {
                console.log(data);

   
                $('#tbody_sign').empty();
                $.each(data['destroy_list'], function (idx, val) { 

                    var name = val['creator_firstname']+'('+val['creator_nickname']+')<br><small>'+Fordatetime_th(val['field_docdate'])+'</small></span>';

                    var btn_upload = ' <button class="btn btn-primary btn_upload btn-sm" type="button" > เพิ่มรูป </button> ';
                    var btn_info = ' <button class="btn btn-info btn_info btn-sm" type="button"> ดู </button> ';
                    var btn_recheck_success = '';
                    var btn_recheck_cancel = '';
                    var status_img = '';
                    var status_recheck= '';
                    var btn_change_status = '';
                    var btn_destroy_cancel = '';
                    var btn_edit = '';

                    <?php if ($_SESSION['saeree_departid'] == '11') { ?>
                        btn_destroy_cancel = ' <button class="btn btn-danger btn_destroy_cancel btn-sm" type="button"><i class="fa fa-trash"></i> </button>';
                     <?php }?>

                    if (val['field_status'] == 0) {
                        status_img = '<span class="text-warning"><i class="fa fa-spinner" aria-hidden="true"></i> รออัปโหลดรูป</span>';
                        <?php if ($_SESSION['saeree_departid'] == '11') { ?>
                        btn_change_status = '<button class="btn btn-secondary btn_change_status btn-sm" type="button"> ไม่มีรูป </button>';
                        <?php }?>
                    }
                    else if (val['field_status'] == 1) {
                        status_img = '<span class="text-success"> ไม่มีรูปทำลาย</span>';
                        btn_upload = '';
                        if (val['field_recheck_status'] == 2) {
                            status_recheck = '<br><span class="text-success"><i class="fa fa-check-circle"></i>'+name_text(val['check_nickname'],val['check_firstname'])+' ตรวจ</span>';
                            status_recheck += '<br><small class="text-success">'+Fordatetime_th(val['field_recheck_date'])+'</small>';
                        }
                        else if(val['field_recheck_status'] == 0){
                            status_recheck += '<br><span class="text-warning"><i class="fa fa-spinner" aria-hidden="true"></i> รอตรวจสอบ</span>';
                            btn_edit = '<button title="แก้ไขหมายเหตุ" class="btn btn-warning btn_edit btn-sm" type="button"> แก้ไข </button>';
    
                                <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Recheck"])) {?>
                                btn_recheck_success = '<button class="btn btn-success btn_check btn-sm"><i class="fa fa-check-circle"></i></button>';
                                btn_recheck_cancel = ' <button class="btn btn-danger btn_cancel btn-sm"><i class="fa fa-times-circle"></i></button>';
                                <?php }; ?>
                        }
                    }
                    else if (val['field_status'] == 2) {
                        status_img = '<span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i> อัปโหลดรูปเรียบร้อย</span>';

                        if (val['field_upload_date'] != null) {
                            status_img += '<br><small class="text-success">'+name_text(val['upload_nickname'],val['upload_firstname'])+'</small>';
                            status_img += '<br><small class="text-success">'+Fordatetime_th(val['field_upload_date'])+'</small>';
                            // console.log(val['field_recheck_status']);

                            if (val['field_recheck_status'] == 2) {
                                status_recheck = '<br><span class="text-success"><i class="fa fa-check-circle"></i>'+name_text(val['check_nickname'],val['check_firstname'])+' ตรวจ</span>';
                                status_recheck += '<br><small class="text-success">'+Fordatetime_th(val['field_recheck_date'])+'</small>';
                                btn_upload = '';
                            }
                            else if(val['field_recheck_status'] == 0){
                                status_recheck += '<br><span class="text-warning"><i class="fa fa-spinner" aria-hidden="true"></i> รอตรวจสอบ</span>';
                                btn_edit = '<button title="แก้ไขหมายเหตุ" class="btn btn-warning btn_edit btn-sm" type="button"> แก้ไข </button>';

                                    <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Recheck"])) {?>
                                    btn_recheck_success = '<button class="btn btn-success btn_check btn-sm"><i class="fa fa-check-circle"></i></button>';
                                    btn_recheck_cancel = ' <button class="btn btn-danger btn_cancel btn-sm"><i class="fa fa-times-circle"></i></button>';
                                    <?php }; ?>
                           
                            }

                        }
                    }

                    if (val['field_recheck_status'] == null) {
                        btn_upload = '';
                    }

                    $('#tbody_sign').append(
                        '<tr>'+
                            '<td hidden class="field_id">'+ val['field_id'] +'</td>'+
                            '<td hidden class="field_recheck_status">'+ val['field_recheck_status'] +'</td>'+
                            '<td width="10%" class="field_docno">'+val['field_docno']+'</td>'+	
                            '<td width="10%" class="field_itemcode" style="text-align:left;">'+ val['field_itemcode'] +'</td>'+
                            '<td width="20%" class="field_itemname" style="text-align:left;">'+ val['field_itemname'] +'</td>'+
                            '<td width="15%" class="field_comment" style="text-align:left;">'+ val['field_destroy_comment'] +'</td>'+
                            '<td width="10%" style="text-align:left;">'+name+'</td>'+
                            '<td width="20%" style="text-align:left;">'+status_img+status_recheck+'</td>'+
                            '<td width="10%">'+btn_info+btn_upload+btn_edit+btn_change_status+btn_destroy_cancel+'</td>'+
                            '<td width="5%">'+btn_recheck_success+btn_recheck_cancel+'</td>'+
                        '</tr>'
                    );
                });

                $('.pagination').empty();
				var destroy_total = (Math.ceil(parseInt(data['destroy_total']) / parseInt(usersPerPage)));
				// console.log(destroy_total,data['destroy_total'],usersPerPage);
				if(parseInt(pageNumber) > 5){
					$('.pagination').append('<li><button class="pageNumber">1</button></li>');
					$('.pagination').append('<li><button class="pageNumber" disabled>...</button></li>');
				}
				for (var i = 1; i <= destroy_total; i++) {
					if(parseInt(pageNumber)-5 < i && parseInt(pageNumber)+7 > i){
						if(parseInt(pageNumber)+1 == i){
							$('.pagination').append('<li><button class="pageNumber active">'+i+'</button></li>');
						}else{
							$('.pagination').append('<li><button class="pageNumber">'+i+'</button></li>');
						}
					}
				}

				if(parseInt(pageNumber) < destroy_total-6){
					$('.pagination').append('<li><button class="pageNumber" disabled>...</button></li>');
					$('.pagination').append('<li><button class="pageNumber">'+destroy_total+'</button></li>');
				}

            }
        });
    }

	function delete_file (
      delete_id,
      delete_file_name
    ) 
    {

      $.ajax({
      type:'POST',
      url:'<?= site_url('SignV2/delete_file_1')?>',
      data :{
        file_id : delete_id,
        file_name : delete_file_name,
        link_1 : 'SignV2Destroy'
      },
      dataType:'JSON',
      }).done(function(data){
      
      $('#uploadModal').modal('hide');
      swal({
        title: 'สำเร็จ',
        text: "ลบไฟล์สำเร็จ",
        type: 'success' ,
        confirmButtonColor: '#6c757d',
        confirmButtonText: 'ปิด' ,
      }).then((result) => {
      if (result.value) {
        get_destroy_list();
      }
      });

      }).fail(function(data){
      
      });

    };

    function update_cancel_destroy(field_id) {  
        $.ajax({
            type: "post",
            url:'<?= site_url('SignV2/update_cancel_destroy')?>',
            data: {
                field_id : field_id
            },
            dataType: "JSON",
            success: function (data) {
                swal({
                    title: 'สำเร็จ',
                    text: "เปลี่ยนสถานะเรียบร้อย",
                    type: 'success' ,
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {
                    if (result.value) {
                        get_destroy_list();
                    }
                });
            }
        });
    }

    function update_change_status_destroy(field_id) {  
        $.ajax({
            type: "post",
            url:'<?= site_url('SignV2/update_change_status_destroy')?>',
            data: {
                field_id : field_id
            },
            dataType: "JSON",
            success: function (data) {
                swal({
                    title: 'สำเร็จ',
                    text: "เปลี่ยนสถานะเรียบร้อย",
                    type: 'success' ,
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {
                    if (result.value) {
                        get_destroy_list();
                    }
                });
            }
        });
    }

    function update_recheck(field_id,status_recheck) {  
        $.ajax({
            type: "post",
            url:'<?= site_url('SignV2/update_recheck_destroy')?>',
            data: {
                field_id : field_id,
                status_recheck : status_recheck
            },
            dataType: "JSON",
            success: function (data) {
                swal({
                    title: 'สำเร็จ',
                    text: "ตรวจสอบเรียบร้อย",
                    type: 'success' ,
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {
                    if (result.value) {
                        get_destroy_list();
                    }
                });
            }
        });
    }

	function get_file(id,field_recheck_status)
    {

        jQuery('img').each(function(){
			jQuery(this).attr('src',jQuery(this).attr('src')+ '?' + (new Date()).getTime());
		});
        
      var field_id = id;

      $('#links_file').empty();
      $('#links_file_info').empty();
      $.ajax({
		type:'POST',
		url:'<?= site_url('SignV2/get_file_2')?>',
		dataType:'JSON',
		data:
		{
			field_id : id,
			link_1 : 'SignV2Destroy'
		},
		}).done(function(data){
        
			// console.log(data);
		
			if(data){
				$.each(data['scandir'],function(ids,val){
				
					if(val != '.' && val != '..'){
						var url = '<?= base_url('assets/images/SignV2Destroy')?>/'+field_id+'/'+val
						<?php if ($_SESSION['saeree_departid'] == '11') { ?>
                            
							$('#links_file').append(
                                '<input type="hidden" name="delete_id" id="delete_id" value="'+ field_id +'">'+
                                '<input type="hidden" name="delete_file_name" id="delete_file_name" value="'+ val +'">'+
                                '<div class="col-sm-6">'+
                                    '<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
                                        '<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
                                    '</a>'+
                                    '<button type="button" class="btn btn-danger btn-sm btn-block btn_delete_file" id="btn_delete_file">ลบไฟล์</button>'+
                                '</div>'
                            );

                            $('#links_file_info').append(
                                '<div class="col-sm-6">'+
                                    '<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
                                        '<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
                                    '</a>'+
                                '</div>'
                            );
						<?php }
						else{ ?>
                            if (field_recheck_status == 0) {
                                $('#links_file').append(
                                    '<input type="hidden" name="delete_id" id="delete_id" value="'+ field_id +'">'+
                                    '<input type="hidden" name="delete_file_name" id="delete_file_name" value="'+ val +'">'+
                                    '<div class="col-sm-6">'+
                                        '<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
                                            '<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
                                        '</a>'+
                                        '<button type="button" class="btn btn-danger btn-sm btn-block btn_delete_file" id="btn_delete_file">ลบไฟล์</button>'+
                                    '</div>'
                                );
                            }else{
                                $('#links_file').append(
                                    '<div class="col-sm-6">'+
                                        '<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
                                            '<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
                                        '</a>'+
                                    '</div>'
                                );
                            }
                            $('#links_file_info').append(
                                '<div class="col-sm-6">'+
                                    '<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
                                        '<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
                                    '</a>'+
                                '</div>'
                            );
						<?php } ?>

					}
				});
			}

		}).fail(function(data){
			
      });

    };

    function destroy_comment() 
    { 
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/comment_type_sub')?>",
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('.destroy_comment').empty();
                $('.destroy_comment').append(
                    '<option value="">เลือกหมายเหตุ</option>'
                );
                $.each(data, function (ida, val) {
                    if (val['id'] != 1) {
                        $('.destroy_comment').append(
                            '<option value="'+val['detail']+'">'+val['detail']+'</option>'
                        );
                    }

                });
				$('.destroy_comment').append(
						'<option value="">*เพิ่มหมายเหตุโทรหา IT 30(หรือแจ้งไลน์ ไอที)*</option>'
				);
            }
        });
    };

    function name_text(firstname,nickname) {  
        var name = firstname+' ('+nickname+')';
        return name ;
    }

	function Fordatetime_th(datetime) 
    {  
        monthNames = ["01", "02", "03", "04", "05", "06","07", "08", "09", "10", "11", "12"];

        var New_date = new Date(datetime);
		if (datetime != null) {
			var New_date = new Date(datetime.replace(/\s/, 'T'));
		}
        currentHours = New_date.getHours();
        currentHours = ("0" + currentHours).slice(-2);
        currentMinutes = New_date.getMinutes();
        currentMinutes = ("0" + currentMinutes).slice(-2);
        var new_datetime = New_date.getDate()+'/'+monthNames[New_date.getMonth()]+'/'+(New_date.getFullYear()+543)+ ' '+currentHours+':'+currentMinutes+' น.';

        return new_datetime;
    }
</script>

<script>


</script>