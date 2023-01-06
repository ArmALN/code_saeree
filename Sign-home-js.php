<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction(); ?>
<script type="text/javascript">
	$(document).ready(function () {

		var id_destroy = [];

		all_click();

		get_all_sign();

		all_change();

		get_groupcode();

		sign_type();

		select2();

		all_clear_invalid();
	});

	function all_clear() {  
		$('#recieve_toperson').val('');
		$('#recieve_comment').val('');
		$('#recheck_status').val('');
		$('#recheck_comment').val('');
		$('#recieve_comment').val('');
		$('#setup_comment').val('');
		$('.setup_person').val('');
		$('#destroy_comment').val('');
		$('#destroy_recheck_comment').val('');
		$('#recheck_destroy').val('');
		$('#backtoedit_comment').val('');

		jQuery('img').each(function(){
			jQuery(this).attr('src',jQuery(this).attr('src')+ '?' + (new Date()).getTime());
		});
	}
	
	function all_clear_invalid() {  
		$('#recieve_toperson').removeClass('is-invalid');
		$('#recieve_toperson').removeClass('is-valid');
		$('#recieve_comment').removeClass('is-invalid');
		$('#recieve_comment').removeClass('is-valid');
		$('#recheck_status').removeClass('is-invalid');
		$('#recheck_status').removeClass('is-valid');
		$('#recieve_comment').removeClass('is-valid');
		$('#recheck_comment').removeClass('is-invalid');
		$('#recheck_comment').removeClass('is-valid');
		$('#setup_comment').removeClass('is-invalid');
		$('#setup_comment').removeClass('is-valid');
		$('.setup_person').removeClass('is-invalid');
		$('.setup_person').removeClass('is-valid');
		$('#destroy_comment').removeClass('is-invalid');
		$('#destroy_comment').removeClass('is-valid');
		$('#destroy_recheck_comment').removeClass('is-invalid');
		$('#destroy_recheck_comment').removeClass('is-valid');
		$('#backtoedit_comment').removeClass('is-invalid');
		$('#backtoedit_comment').removeClass('is-valid');

		jQuery('img').each(function(){
			jQuery(this).attr('src',jQuery(this).attr('src')+ '?' + (new Date()).getTime());
		});
	}

	function select2() {
		$( ".search_groupcode" ).select2({
            theme: "bootstrap4"
        });

        $( ".search_type" ).select2({
            theme: "bootstrap4"
        });

		$( "#search_status_packing" ).select2({
            theme: "bootstrap4"
        });

		$( "#search_status_setup" ).select2({
            theme: "bootstrap4"
        });

		$( "#search_status_check" ).select2({
            theme: "bootstrap4"
        });

		$( "#search_status_destroy" ).select2({
            theme: "bootstrap4"
        });

		$( "#search_status" ).select2({
            theme: "bootstrap4"
        });

		$( "#search_status_active" ).select2({
            theme: "bootstrap4"
        });
	}

	function all_click() {  
		$('#submit_backtoedit').click(function (e) { 
			e.preventDefault();
			var save = 'save';
			$('#backtoedit_comment').addClass('is-valid');
			$('#backtoedit_comment').removeClass('is-invalid');
			if($('#backtoedit_comment').val() == '' ){
				$('#backtoedit_comment').removeClass('is-valid');
				$('#backtoedit_comment').addClass('is-invalid');
				save = 'fail';
			}
			if(save == 'save'){
				swal({
				title: "ต้องการถอยเอกสารนี้?",
				type: 'question',
				showCancelButton: true,
				confirmButtonColor: '#1AA45F',
				cancelButtonColor: '#DB4B3F',
				confirmButtonText: 'ใช่',
				cancelButtonText: 'ยกเลิก',
				}).then((result) => {
					if (result.value){
						backtoedit_confirm($('#field_id_backtoedit').val(),$('#backtoedit_comment').val());
					}
				});
			}
		});

		$('#btn_refresh').click(function (e) { 
			e.preventDefault();
			get_all_sign();

			jQuery('img').each(function(){
				jQuery(this).attr('src',jQuery(this).attr('src')+ '?' + (new Date()).getTime());
			});
		});
	
		$("#uploadimage").on('submit',(function(e){
			e.preventDefault();
			swal({
				title: 'กำลังโหลดข้อมูล',
				html: 'กรุณารอสักครู่',
				onOpen: () => {
				swal.showLoading()
				},
			});
			$.ajax({
				url: "<?= site_url('SignV2/upload_image')?>", 
				type: "POST",             
				data: new FormData(this), 
				contentType: false,      
				cache: false,
				processData:false,    
				dataType: "JSON",  
				success: function(data){
					swal.close();
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
						swal({ 
							title: 'สำเร็จ!',
							text: 'อัปโหลดได้ 2 รูปเท่านั้น',
							type: 'success',
							}).then((result) => {
							if (result.value) {
								get_all_sign();
								get_file($('#upload_id').val(),$("#recheck_status_img").val());
								$('#upload_id').val('');
								$('#file').val('');
							}
						});
					}else if(data['check_pic'] == 'success'){
						swal({ 
							title: 'สำเร็จ!',
							text: 'เพิ่มรูปภาพสำเร็จ',
							type: 'success',
							}).then((result) => {
							if (result.value) {
								get_all_sign();
								get_file($('#upload_id').val(),$("#recheck_status_img").val());
								$('#upload_id').val('');
								$('#file').val('');
							}
						});
					}
				}
			});
		}));

		$('#submit_destroy_recheck').click(function (e) { 
			e.preventDefault();
			var save = 'save';
			$('#destroy_recheck_comment').addClass('is-valid');
			$('#destroy_recheck_comment').removeClass('is-invalid');
			if($('#destroy_recheck_comment').val() == '' ){
				$('#destroy_recheck_comment').addClass('is-invalid');
				$('#destroy_recheck_comment').removeClass('is-valid');
				save = 'fail';
			}
			if(save == 'save'){
				swal({
					title: "ต้องการทำลายป้ายเดิมของSGนี้?",
					type: 'question',
					showCancelButton: true,
					confirmButtonColor: '#1AA45F',
					cancelButtonColor: '#DB4B3F',
					confirmButtonText: 'ใช่',
					cancelButtonText: 'ยกเลิก',
				}).then((result) => {
					if (result.value) {
						destroy_recheck_confirm();
					}
				});
			}
		});

		$('#submit_destroy').click(function (e) { 
			e.preventDefault();
			var save = 'save';
			$('#destroy_comment').addClass('is-valid');
			$('#destroy_comment').removeClass('is-invalid');
			if($('#destroy_comment').val() == '' ){
				$('#destroy_comment').addClass('is-invalid');
				$('#destroy_comment').removeClass('is-valid');
				save = 'fail';
			}
			if(save == 'save'){
				swal({
					title: "ต้องการทำลายป้ายเดิม?",
					type: 'question',
					showCancelButton: true,
					confirmButtonColor: '#1AA45F',
					cancelButtonColor: '#DB4B3F',
					confirmButtonText: 'ใช่',
					cancelButtonText: 'ยกเลิก',
				}).then((result) => {
					if (result.value) {
						destroy_confirm();
					}
				});
			}
		});
  
		$('#submit_recheck').click(function(){ 
			var save = 'save';
			$('#recheck_status').addClass('is-valid');
			$('#recheck_comment').addClass('is-valid');
			$('#recheck_status').removeClass('is-invalid');
			$('#recheck_comment').removeClass('is-invalid');
			if($('#recheck_status').val() == '' ){
				$('#recheck_status').addClass('is-invalid');
				$('#recheck_status').removeClass('is-valid');
				save = 'fail';
			}
			if($('#recheck_comment').val() == '' ){
				$('#recheck_comment').addClass('is-invalid');
				$('#recheck_comment').removeClass('is-valid');
				save = 'fail';
			}
			if($('#recheck_comment').val() != '' && $('#recheck_status').val() != ''){
				recheck_confirm();
			}
		});

		$('#submit_setup').click(function(){ 
			var save = 'save';
			$('.setup_person').addClass('is-valid');
			$('.setup_person').removeClass('is-invalid');
			if($('.setup_person').val() == '' ){
				$('.setup_person').removeClass('is-valid');
				$('.setup_person').addClass('is-invalid');
				save = 'fail';
			}
			if(save == 'save'){
				id =  $('#setup_id').val();
				setup_personid =  $('#setup_personid').val();
				setup_confirm(id,setup_personid);
			}
        });

		$('#submit_unsetup').click(function(){ 
			var save = 'save';
			$('#setup_comment').addClass('is-valid');
			$('#setup_comment').removeClass('is-invalid');
			if($('#setup_comment').val() == '' ){
				$('#setup_comment').removeClass('is-valid');
				$('#setup_comment').addClass('is-invalid');
				save = 'fail';
			}
			if(save == 'save'){
				id =  $('#setup_id').val();
				comment = $('#setup_comment').val();
				unsetup_confirm(id,comment);
			}


        });

		$('#submit_waitsetup').click(function(){ 
			var save = 'save';
			$('#setup_comment').addClass('is-valid');
			$('#setup_comment').removeClass('is-invalid');
			if($('#setup_comment').val() == '' ){
				$('#setup_comment').removeClass('is-valid');
				$('#setup_comment').addClass('is-invalid');
				save = 'fail';
			}
			if(save == 'save'){
				id =  $('#setup_id').val();
				comment = $('#setup_comment').val();
				waitsetup_confirm(id,comment);
			}
        });

		$('#submit_recieve').click(function(){ 
			var save = 'save';
			$('#recieve_toperson').addClass('is-valid');
			$('#recieve_toperson').removeClass('is-invalid');
			if($('#recieve_toperson').val() == '' ){
				$('#recieve_toperson').removeClass('is-valid');
				$('#recieve_toperson').addClass('is-invalid');
				save = 'fail';
			}
			if(save == 'save'){
				recieve_confirm();
			}
        });

		$('#tbody_sign').on('click','.btn_recheck_print',function(){
			window.open('<?php echo site_url('SignV2/recheck_print');?>'+'/'+$(this).closest('tr').find('.field_id').text() , '_blank');
		});	

		$('#tbody_sign').on('click','.btn_signcancel',function(){
          field_id = $(this).closest('tr').find('.field_id').text();
            swal({
                title: 'หมายเหตุที่ยกเลิก(ตามใบขอ)',
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

		$('#links_file').on('click','.btn_delete_file',function(){ 
			delete_id = $('#delete_id').val();
			delete_file_name = $('#delete_file_name').val();
			delete_file(delete_id,delete_file_name);
		});

		$('#tbody_sign').on('click','.btn_upload',function(){ 
			
            var id = $(this).closest('tr').find('.field_id').text();
			var check_status = $(this).closest('tr').find('.field_recheck').text();
			var name = $(this).closest('tr').find('.field_itemname').text();
			var code = $(this).closest('tr').find('.field_itemcode').text();
			all_clear_invalid();
			all_clear();
			$('#upload_id').val(id);
			$('#upmodal_name').text('เพิ่มรูปภาพของสินค้า '+code+' '+name);
			$('#uploadModal').modal('show');
			$('#recheck_status_img').val(check_status);
			get_file(id,check_status);
        });

		$('#tbody_sign').on('click','.btn_reActive ',function(){ 
			var field_id = $(this).closest('tr').find('.field_id').text();
			var field_docno = $(this).closest('tr').find('.field_docno').text();
			var code = $(this).closest('tr').find('.field_itemcode').text();

			swal({
			title: "ต้องการเปลี่ยนสถานะเป็นใช้งาน?",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#1AA45F',
			cancelButtonColor: '#DB4B3F',
			confirmButtonText: 'ใช่',
			cancelButtonText: 'ยกเลิก',
			}).then((result) => {
				if (result.value){
					change_active_status(field_id);
				}
			});
		});

		$('#tbody_sign').on('click','.btn_destroy_recheck ',function(){ 
			var field_id = $(this).closest('tr').find('.field_id').text();
			var field_docno = $(this).closest('tr').find('.field_docno').text();
			var field_itemname = $(this).closest('tr').find('.field_itemname').text();
			all_clear_invalid();
			all_clear();
			get_destory_recheck_detail(field_id,field_docno,field_itemname);

			$('#destroy_recheck_Modal').modal('show');

		});

		$('#tbody_sign').on('click','.btn_timeline ',function(){ 
			var field_id = $(this).closest('tr').find('.field_id').text();
			var field_docno = $(this).closest('tr').find('.field_docno').text();

			timeline(field_id);
			$('#timeline_title').text('ไทมไลน์ของเลขที่เอกสาร '+field_docno+'');

			$('#timeline_Modal').modal('show');

		});

		$('#tbody_sign').on('click','.btn_destroy ',function(){ 
			var field_id = $(this).closest('tr').find('.field_id').text();
			var field_docno = $(this).closest('tr').find('.field_docno').text();
			var field_itemname = $(this).closest('tr').find('.field_itemname').text();
			all_clear_invalid();
			all_clear();
			get_destory_detail(field_id,field_docno,field_itemname);
			$('#destroy_comment_more').val('');
			$('#destroy_Modal').modal('show');

		});

		$('#tbody_sign').on('click','.btn_edit ',function(){ 
			var field_id = $(this).closest('tr').find('.field_id').text();
			var field_docno = $(this).closest('tr').find('.field_docno').text();
			all_clear_invalid();
			all_clear();
			$('#backtoedit_title').text('ขอถอยเอกสารเลขที่ '+field_docno);
			$('#backtoedit_Modal').modal('show');
			$('#field_id_backtoedit').val(field_id);

		});

		$('#tbody_sign').on('click','.btn_recheck ',function(){ 
			var field_id = $(this).closest('tr').find('.field_id').text();
			var field_itemname = $(this).closest('tr').find('.field_itemname').text();
			all_clear_invalid();
			all_clear();
			var type_getemployee = 4;
			get_employee(type_getemployee);
			get_file(field_id);
			get_recheck_detail(field_id,field_itemname);
			$('#recheckModal').modal('show');

			$( "#recheck_status" ).select2({
				theme: "bootstrap4"
			});

		});

		$('#tbody_sign').on('click','.btn_setup',function(){ 
			var field_id = $(this).closest('tr').find('.field_id').text();
			var field_itemname = $(this).closest('tr').find('.field_itemname').text();
			all_clear_invalid();
			all_clear();
			var type_getemployee = 3;
			get_employee(type_getemployee);
			$('#setupModal').modal('show');
			get_setup_detail(field_id,field_itemname);
		});

		$('#tbody_sign').on('click','.btn_recieve',function(){
			var field_id = $(this).closest('tr').find('.field_id').text();
			var field_itemname = $(this).closest('tr').find('.field_itemname').text();
			all_clear_invalid();
			all_clear();
			var type_getemployee = 2;
			get_employee(type_getemployee);
			get_employee_tosetup();
			$('#recieveModal').modal('show');
			$( ".recieve_toperson" ).select2({
				theme: "bootstrap4"
			});
			get_recieve_detail(field_id,field_itemname);
		});

		$('#tbody_sign').on('click','.btn_view',function(){ 
			var field_id = $(this).closest('tr').find('.field_id').text();
			window.open('<?php echo site_url('SignV2/view_sign/');?>'+'/'+ field_id  , '_blank');
        });

	}

	function all_change() {  
		$(document).on('click','.pageNumber',function(){
			$('#pageNumber').val($(this).text()-1);
			get_all_sign();
        });

		$('#search_status_active').change(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
			get_all_sign();
		});
		
		$('#usersPerPage').change(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
			get_all_sign();
		});

		$('#search_status_packing').change(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
			get_all_sign();
		});

		$('#search_status_setup').change(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
			get_all_sign();
		});

		$('#search_status_check').change(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
			get_all_sign();
		});

		$('#search_type').change(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
			get_all_sign();
		});

		$('#search_status_destroy').change(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
			get_all_sign();
		});

		$('#search_groupcode').change(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
			get_all_sign();
		});

		$('#search_status').change(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
			get_all_sign();
		});

		$('#search_text').keyup(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
			get_all_sign();
		});
	}

	function get_setup_detail(field_id,field_itemname) {  
		$.ajax({
			type: "post",
			url: "<?= site_url('SignV2/get_signandsignsub')?>",
			data: {field_id : field_id},
			dataType: "JSON",
			success: function (data) {
				console.log(data);
				$('#setup_id').val(data['Sign']['field_id']);
				$('#setup_docno').val(data['Sign']['field_docno']);
				$('#setup_itemcodename').val('['+data['Sign']['field_itemcode']+'] '+field_itemname);
				$('#setup_confirmperson').val(data['Sign']['confirm_firstname'] +" ("+ data['Sign']['confirm_nickname']+")");
				$('#setup_recieve_toperson').val(data['Sign']['recievetoperson_firstname'] +" ("+ data['Sign']['recievetoperson_nickname']+")");

				$('#tb_setuplist').empty();
				num_row = 0;
				id_destroy = data['Sign_sub'];
				$.each(data['Sign_sub'],function(id,val){
					var select_setup_person = '<select  class="form-control select2 setup_person" id="setup_person'+val['field_id']+'" ></select>';
					num_row++
					
					$('#tb_setuplist').append(
						'<tr>'+
							'<td width="10%">'+num_row+'</td>'+	
							'<td width="20%" style="text-align:left;">'+ val['field_place_name'] +'</td>'+
							'<td width="20%" style="text-align:left;">'+ val['type_name_price'] +'</td>'+
							'<td width="15%" style="text-align:left;">'+ val['size_name'] +'</td>'+
							'<td width="5%" style="text-align:left;">'+val['field_signamount']+'</td>'+
							'<td width="30%" style="text-align:left;">'+ select_setup_person +'</td>'+
						'</tr>'
						);

						get_employee_setup();
						$( ".setup_person" ).select2({
							theme: "bootstrap4"
						});

				});

			}
		});
	}

	function get_destory_recheck_detail(field_id,field_docno,field_itemname) {  
		$('#tb_destroy_recheck_list').empty();
		$.ajax({
			type: "post",
			url: "<?= site_url('SignV2/get_signandsignsub')?>",
			data: {field_id},
			dataType: "JSON",
			success: function (data) {
				$('#destroy_recheck_id').val(data['Sign']['field_id']);
				$('#destroy_recheck_docno').val(data['Sign']['field_docno']);
				$('#destroy_recheck_itemcodename').val('['+data['Sign']['field_itemcode']+'] '+field_itemname);
				$('#destroy_recheck_confirmperson').val(data['Sign']['confirm_firstname'] +" ("+ data['Sign']['confirm_nickname']+")");
				console.log(data);
				$('#tb_destroy_list').empty();
				num_row = 0;
				id_destroy = data['sign_destroy_this_sg'];
				$.each(data['sign_destroy_this_sg'],function(id,val){
					var select_des_person = '<select  class="form-control select2 des_person" id="destroy_person'+val['field_id']+'" ></select>';
					num_row++;
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

					$('#tb_destroy_recheck_list').append(
						'<tr id='+val['field_old_id']+'>'+
							'<td width="10%">'+num_row+'</td>'+	
							'<td hidden class="field_id">'+ val['field_old_id'] +'</td>'+
							'<td width="15%">'+docno+'</td>'+
							'<td width="30%">'+ val['field_place_name'] +'</td>'+
							'<td width="15%">'+ val['size_name'] +'</td>'+
							'<td width="20%">'+ type_sign_price +'</td>'+
							'<td class="text-right" width="10%">'+val['sign_amount']+'</td>'+
						'</tr>'
					);
				});
			}
		});
	}

	function get_destory_detail(field_id,field_docno,field_itemname) {  
		$.ajax({
			type: "post",
			url: "<?= site_url('SignV2/get_signandsignsub')?>",
			data: {field_id},
			dataType: "JSON",
			success: function (data) {
				$('#destroy_id').val(data['Sign']['field_id']);
				$('#destroy_docno').val(data['Sign']['field_docno']);
				$('#destroy_itemcodename').val('['+data['Sign']['field_itemcode']+'] '+field_itemname);
				$('#destroy_confirmperson').val(data['Sign']['confirm_firstname'] +" ("+ data['Sign']['confirm_nickname']+")");
				console.log(data);
				$('#tb_destroy_list').empty();
				num_row = 0;
				id_destroy = data['signold_new'];
				$.each(data['signold_new'],function(id,val){
					var select_des_person = '<select  class="form-control select2 des_person" id="destroy_person'+val['field_id']+'" ></select>';
					num_row++;
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

					$('#tb_destroy_list').append(
						'<tr id='+val['field_old_id']+'>'+
							'<td width="10%">'+num_row+'</td>'+	
							'<td hidden class="field_id">'+ val['field_old_id'] +'</td>'+
							'<td width="15%">'+docno+'</td>'+
							'<td width="30%">'+ val['field_place_name'] +'</td>'+
							'<td width="15%">'+ val['size_name'] +'</td>'+
							'<td width="20%">'+ type_sign_price +'</td>'+
							'<td class="text-right" width="10%">'+val['sign_amount']+'</td>'+
						'</tr>'
					);
				});
				destroy_comment();

				$( "#destroy_comment" ).select2({
					theme: "bootstrap4"
				});
			}
		});
	}

	function get_recheck_detail(field_id,field_itemname) {  
		$.ajax({
			type: "post",
			url: "<?= site_url('SignV2/get_signandsignsub')?>",
			data: {field_id},
			dataType: "JSON",
			success: function (data) {
				console.log(data);

				if (data['sign_destroy_list']) {
					$('#div_recheck_destroy').removeClass('hidden');
					$('#recheck_destroy').val(data['sign_destroy_list']['field_docno']);
					get_file2(data['sign_destroy_list']['field_id']);
				}
				
				$('#recheck_id').val(data['Sign']['field_id']);
				$('#recheck_docno').val(data['Sign']['field_docno']);
				$('#recheck_itemcodename').val('['+data['Sign']['field_itemcode']+'] '+field_itemname);
				$('#recheck_confirmperson').val(data['Sign']['confirm_firstname'] +" ("+ data['Sign']['confirm_nickname']+")");
				$('#recheck_setupperson').val(data['Sign']['setup_firstname'] +" ("+ data['Sign']['setup_nickname']+")");
				$('#tb_rechecklist').empty();
				num_row = 0;
				$.each(data['Sign_sub'],function(id,val){	
					num_row++
					$('#tb_rechecklist').append(
						'<tr>'+
							'<td>'+num_row+'</td>'+	
							'<td>'+ val['field_place_name'] +'</td>'+
							'<td style="text-align:left;">'+ val['type_name_price'] +'</td>'+
							'<td style="text-align:left;">'+ val['size_name'] +'</td>'+
							'<td style="text-align:left;">'+val['field_signamount']+'</td>'+
							'<td style="text-align:left;">'+ val['setup_firstname'] +' ('+val['setup_nickname']+')</td>'+
						'</tr>'
					);
				});

				$('#recheck_price_row').empty();
				for (let i = 0; i < 5; i++) {
					if (data['Sign_sub'][0]['field_price'+i+'']) {
						$('#recheck_price_row').append(
							'<div class="col-md-3">'+
								'<blockquote class="quote-info">'+
									'<dl>'+
										'<dt>ราคา '+i+'</dt>'+
										'<dd>'+data['Sign_sub'][0]['field_price'+i+'']+' บาท</dd>'+
									'</dl>'+
								'</blockquote>'+
							'</div>'
						);
					}
				}

				var barcode = 'ไม่มีบาร์โค้ด';
				if (data['Sign_sub'][0]['field_barcode'] != '') {
					barcode = data['Sign_sub'][0]['field_barcode'] ;
				}

				$('#recheck_price_row').append(
					'<div class="col-md-12">'+
						'<label>เลขบาร์โค้ด : </label> <span>'+barcode+'</span>'+
					'</div>'
				);


			}
		});
	}


	function get_recieve_detail(field_id,field_itemname) {  
		$.ajax({
			type: "post",
			url: "<?= site_url('SignV2/get_signandsignsub')?>",
			data: {field_id},
			dataType: "JSON",
			success: function (data) {
				
				console.log(data);
				$('#recieve_id').val(data['Sign']['field_id']);
				$('#recieve_docno').val(data['Sign']['field_docno']);
				$('#recieve_itemcodename').val('['+data['Sign']['field_itemcode']+'] '+field_itemname);
				$('#recieve_confirmperson').val(data['Sign']['confirm_firstname'] +" ("+ data['Sign']['confirm_nickname']+")");
				$('#recieve_packingperson').val(data['Sign']['packing_firstname'] +" ("+ data['Sign']['packing_nickname']+")");
				$('#recieve_packingdate').val(formatDatetime(data['Sign']['field_packingdate']));
				$('#recieve_needdate').val(formatDate(data['Sign']['field_comfirm_needdate']));
				$('#tb_recievelist').empty();
					num_row = 0;
				$.each(data['Sign_sub'],function(id,val){
					num_row++
					$('#tb_recievelist').append(
						'<tr>'+
							'<td>'+num_row+'</td>'+	
							'<td>'+ val['field_place_name'] +'</td>'+
							'<td>'+ val['type_name_price'] +'</td>'+
							'<td>'+ val['size_name'] +'</td>'+
							'<td class="text-right">'+val['field_signamount']+'</td>'+
						'</tr>'
					);
				});
			}
		});
	}

	function recheck_confirm(){
		var recheck_id = $('#recheck_id').val();
		var recheck_status = $('#recheck_status').val();
		var recheck_comment = $('#recheck_comment').val();
		var recheck_personid = $('#recheck_personid').val();
		var recheck_docno = $('#recheck_docno').val();
		swal({
		title: "ต้องการอัปเดทสถานะตรวจสอบงาน?",
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#1AA45F',
		cancelButtonColor: '#DB4B3F',
		confirmButtonText: 'ใช่',
		cancelButtonText: 'ยกเลิก',
		}).then((result) => {
			if (result.value){
				$.ajax({
					type: "POST",
					url: "<?= site_url('SignV2/recheck_confirm')?>",
					data: {
						recheck_id:recheck_id,
						recheck_status :recheck_status,
						recheck_comment : recheck_comment,
						recheck_personid : recheck_personid,
						recheck_docno : recheck_docno
					},
					dataType: "JSON",
					success: function (data){
						// console.log(data);
						if (data['check'] == 'success') {
							swal({ 
							title: 'สำเร็จ',
							type: 'success',
							}).then((result) => {
								if (result.value) {
			
									$('#recheckModal').modal('hide');
									get_all_sign();
								}  
							});
						}else if(data['check'] == 'error'){
							swal({
								title: 'ผิดพลาด',
								text: "กรุณาตรวจสอบอีกครั้ง",
								type: 'warning'
							});
							console.log(data);
						}else if(data['check'] == 'nope'){
							swal({
								title: 'ผิดพลาด',
								text: "ไม่ได้เพิ่มรูปทำลาย",
								type: 'warning'
							});
							console.log(data);
						}


					}
				});
			}
		});
	};

	function destroy_recheck_confirm() {

		var img = '0';
        if ($('#no_image_recheck').is(":checked"))
        {
            img = '1';
        }

		$.ajax({
			type: "POST",
			url: "<?= site_url('SignV2/update_main_destroy_sg')?>",
			data: {
				sign_id : $('#destroy_recheck_id').val(),
				destroy_comment : $('#destroy_recheck_comment').val(),
				img : img
			},
			dataType: "JSON",
			success: function (data) {
				window.open('<?php echo site_url('SignV2/sign_destroy_manage');?>', '_blank');
				console.log(data);
				swal({ 
					title: 'สำเร็จ!',
					text: 'ทำลายป้ายเรียบร้อยแล้ว',
					type: 'success',
				}).then((result) => {
					if (result.value) {
						
						$('#destroy_recheck_Modal').modal('hide');
						get_all_sign();
					}
				});
			}
		});
	}

	function destroy_confirm() { 
		var img = '0';
        if ($('#no_image').is(":checked"))
        {
            img = '1';
        }

		$.ajax({
			type: "POST",
			url: "<?= site_url('SignV2/update_main_destroy_sub')?>",
			data: {
				sign_id : $('#destroy_id').val(),
				destroy_comment : $('#destroy_comment').val(),
				destroy_comment_more : $('#destroy_comment_more').val(),
				img : img
			},
			dataType: "JSON",
			success: function (data) {
				window.open('<?php echo site_url('SignV2/sign_destroy_manage');?>', '_blank');
				console.log(data);
				swal({ 
					title: 'สำเร็จ!',
					text: 'ทำลายป้ายเรียบร้อยแล้ว',
					type: 'success',
				}).then((result) => {
					if (result.value) {
						
						$('#destroy_Modal').modal('hide');
						get_all_sign();
					}
				});
			}
		});
	}

	function setup_confirm(id,setup_personid){ 

		var setup_per = [];
		var i = 0;
		$.each(id_destroy, function (idx, val) { 
			setup_per[i] = $('#setup_person'+val['field_id']+'').val();
			i++;
		});
		// console.log(setup_per);
		swal({
			title: 'ต้องการอัปเดทสถานะติดตั้งป้าย?',
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#1AA45F',
			cancelButtonColor: '#DB4B3F',
			confirmButtonText: 'ใช่',
			cancelButtonText: 'ปิด',
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "<?= site_url('SignV2/setup_confirm')?>",
					data: {
						id : id,
						setup_personid : setup_personid,
						setup_per : setup_per
					},
					dataType: "JSON",
					success: function(data){
						swal({ 
							title: 'สำเร็จ',
							type: 'success',
						}).then((result) => {
							if (result.value) {
								$('#setupModal').modal('hide');
								get_all_sign();
								console.log(data);
							}
						});

						// console.log(data);
					}
				});

			}
		});
	};

	function unsetup_confirm(id,comment){ 

		// console.log(setup_per);
		swal({
			title: 'ต้องการอัปเดทสถานะติดตั้งป้าย?',
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#1AA45F',
			cancelButtonColor: '#DB4B3F',
			confirmButtonText: 'ใช่',
			cancelButtonText: 'ปิด',
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "<?= site_url('SignV2/unsetup_confirm')?>",
					data: {
						id : id,
						comment : comment
					},
					dataType: "JSON",
					success: function(data){
						swal({ 
							title: 'สำเร็จ',
							type: 'success',
						}).then((result) => {
							if (result.value) {
								$('#setupModal').modal('hide');
								get_all_sign();
								console.log(data);
							}
						});
					}
				});

			}
		});
	};

	function waitsetup_confirm(id,comment){ 
		swal({
			title: 'ต้องการอัปเดทสถานะติดตั้งป้าย?',
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#1AA45F',
			cancelButtonColor: '#DB4B3F',
			confirmButtonText: 'ใช่',
			cancelButtonText: 'ปิด',
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "<?= site_url('SignV2/waitsetup_confirm')?>",
					data: {
						id : id,
						comment : comment
					},
					dataType: "JSON",
					success: function(data){
						swal({ 
							title: 'สำเร็จ',
							type: 'success',
						}).then((result) => {
							if (result.value) {
								$('#setupModal').modal('hide');
								get_all_sign();
								console.log(data);
							}
						});
					}
				});

			}
		});
	};


	function backtoedit_confirm(field_id,comment) {  
		$.ajax({
			type: "POST",
			url: "<?= site_url('SignV2/request_sign')?>",
			data: {
				field_id : field_id,
				comment_request : comment,
				type_request : 3
			},
			dataType: "JSON",
			success: function(data){
				swal({ 
					title: 'สำเร็จ',
					type: 'success',
				}).then((result) => {
					if (result.value) {
						$('#backtoedit_Modal').modal('hide');
						get_all_sign();
						console.log(data);
					}
				});
			}
		});
	}
	
	function recieve_confirm(){
		recieve_id = $('#recieve_id').val();
		recieve_person_id = $('#recieve_person_id').val();
		recieve_toperson = $('#recieve_toperson').val();
		recieve_comment = $('#recieve_comment').val();
		swal({
			title: "ต้องการอัปเดทสถานะรับป้าย?",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#1AA45F',
			cancelButtonColor: '#DB4B3F',
			confirmButtonText: 'ใช่',
			cancelButtonText: 'ยกเลิก',
		}).then((result) => {
			if (result.value){
				// console.log(recieve_id,recieve_person_id,recieve_toperson,recieve_comment);
				$.ajax({
					type: "POST",
					url: "<?= site_url('SignV2/recieve_confirm')?>",
					data: {
						recieve_id:recieve_id,
						recieve_person_id :recieve_person_id,
						recieve_toperson : recieve_toperson,
						recieve_comment : recieve_comment
					},
					dataType: "JSON",
					success: function (data) {
						swal({ 
						title: 'สำเร็จ',
						type: 'success',
						}).then((result) => {
							if (result.value) {
								// console.log(data);
								$('#recieveModal').modal('hide');
								get_all_sign(); 
							}  
						});
					}
				});
			}
		});
	};

	function timeline(field_id) {  
		$('#comment_timeline').empty();
		$.ajax({
			type: "post",
            url: "<?= site_url('SignV2/sign_timeline')?>",
			data: {field_id : field_id},
			dataType: "json",
			success: function (data) {
				console.log(data);
				
				$.each(data['timeline'], function (id, val) { 

					var color_text = '';
					var color_bg ='';
					if (val['field_status'] == 0) {
						color_text = 'text-secondary';
						color_bg = 'bg-gray';
					}else if(val['field_status'] == 1){
						color_text = 'text-success';
						color_bg = 'bg-green';
					}else if(val['field_status'] == 2){
						color_text = 'text-primary';
						color_bg = 'bg-blue';
					}else if(val['field_status'] == 3){
						color_text = 'text-info';
						color_bg = 'bg-info';
					}else if(val['field_status'] == 4){
						color_text = 'text-purple';
						color_bg = 'bg-purple';
					}else if(val['field_status'] == 5){
						color_text = 'text-danger';
						color_bg = 'bg-red';
					}else if(val['field_status'] == 6){
						color_text = 'text-warning';
						color_bg = 'bg-yellow';
					}

					$('#comment_timeline').append(
						'<div class="time-label">'+
							'<span class="'+color_bg+'">'+formatDatetime(val['field_createdate'])+'</span>'+
						'</div>'+
						'<div>'+
							'<i class="fas fa-comment '+color_bg+'"></i>'+
							'<div class="timeline-item ">'+
								'<h3 class="timeline-header '+color_bg+'">'+name_text(val['creator_firstname'],val['creator_nickname'])+' แผนก '+val['depart_name']+'</h3>'+
								'<div class="timeline-body">'+
									val['field_detail']+
								'</div>'+
								'<div class="timeline-footer">'+

								'</div>'+
							'</div>'+
						'</div>'
					);

				});
			}
		});
	}


	function get_all_sign() {  
		var usersPerPage = parseInt($('#usersPerPage').val());
        var pageNumber = parseInt($('#pageNumber').val());
		var search_status_packing = $('#search_status_packing').val();
		var search_status_setup = $('#search_status_setup').val();
		var search_status_check = $('#search_status_check').val();
		var search_type = $('#search_type').val();
		var search_status_destroy = $('#search_status_destroy').val();
		var search_text = $('#search_text').val();
		var search_groupcode = $('#search_groupcode').val();
		var search_status = $('#search_status').val();
		var search_status_active = $('#search_status_active').val();

		$.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/all_sign')?>",
            data : {
				pageNumber : pageNumber ,
				usersPerPage : usersPerPage,
				search_text : search_text,
				search_groupcode : search_groupcode,
				search_type : search_type,
				search_status_destroy : search_status_destroy,
				search_status_packing : search_status_packing,
				search_status_setup : search_status_setup,
				search_status : search_status,
				search_status_active : search_status_active,
				search_status_check : search_status_check
				},
            dataType: "JSON",
            success: function (data) {
				clearinput();
				$('#tbody_sign').empty();
				console.log(data);
				$.each(data['Sign'], function (id, val) { 

					var timeline = ' <button class="btn btn-default btn_timeline btn-sm" type="button"><i class="fas fa-history"></i></button> ';
					var confirm_status = '';
					var packing_status = '';
					var recieve_status = '';
					var setup_status = '';
					var recheck_status = '';
					var btn_destroy = '';
					var loadding = '';
					var btn_view = '';
					var btn_confirm = '';
					var btn_packing = '';
					var btn_recieve = '';
					var btn_setup = '';
					var btn_recheck = '';
					var btn_upload = '';
					var btn_edit = '<button title="ถอยเอกสารเพื่อยกเลิก" class="btn btn-warning btn_edit btn-sm"type="button" > ถอย </button> ';
					var btn_edit_page = '';
					var confirm_return = '';
					var return_status = '';
					var btn_destroy_recheck = '';
					var btn_reActive = '';
					var btn_signcancel = '';

					btn_view = '<button class="btn btn-info btn_view btn-sm" type="button" > ดู </button> ';

					<?php if ($_SESSION['saeree_departid'] == '11') { ?>
						btn_edit_page = '<button title="แก้ไขข้อมูลป้าย" class="btn btn-warning btn_edit_page btn-sm"type="button" > แก้ไข </button> ';
						btn_signcancel = ' <button title="ยกเลิก" class="btn btn-danger btn_signcancel btn-sm"type="button" > <i class="fa fa-trash"></i> </button> ';
					<?php } ?>

					if (val['field_confirm_status'] == '0') {
						btn_edit_page = '';
						btn_edit = '';
						confirm_status = '<span class="text-warning"><i class="fas fa-clock"></i> รอสั่งทำป้าย </span><br>';
					}else if(val['field_confirm_status'] == '3'){
						btn_edit_page = '';
						btn_edit = '';
						confirm_status = '<span class="text-warning"><i class="fas fa-clock"></i> รอยันยืนปรับราคา </span><br>';
					}
					else if(val['field_confirm_status'] == '1'){
						confirm_status = '<span class="text-success"><i class="fa fa-check-circle" aria-hidden="true" class="text-success"></i> ต้องการทำป้าย</span><br>';
						// btn_confirm = '<button class="btn bg-green btn_confirm btn-sm"type="button" > เจ้าของแผนก </button> ';
						if(val['field_packing_status'] == '0' || val['field_destroy_status'] == ''){	
							packing_status = '<span class="text-warning"><i class="fas fa-clock"></i> รอรับเรื่อง </span><br>';
							if (val['field_load_data'] == '1') {
								loadding = '<span class="text-success">ดึงข้อมูลแล้ว</span><br>';
							}
							else if(val['field_load_data'] == '0'){
								packing_status = '<span class="text-warning"><i class="fas fa-clock"></i> รอรับเรื่อง </span><br>';
							}
						}
						else if(val['field_packing_status'] == '1' || val['field_destroy_status'] == ''){
							packing_status = '<span class="text-warning"><i class="fas fa-clock"></i> กำลังทำป้าย </span><br>';
							btn_edit = '';
							btn_edit_page = '';
							// btn_packing = '<button class="btn bg-primary btn_packing btn-sm"type="button" > บรรจุภัณฑ์ </button> ';
						}else if(val['field_packing_status'] == '2'){
							btn_edit_page = '';
							btn_edit = '';
							packing_status = '<span class="text-success"><i class="fas fa-check-circle"></i> ทำป้ายเรียบร้อย<br><small>'+formatDatetime(val['field_packingdate'])+'</small></span><br>';
							if(val['field_recieve_status'] == '1' || val['field_recieve_status'] == '1'){
								recieve_status = '<span class="text-warning"><i class="fas fa-clock"></i> รอรับป้าย </span><br>';
								btn_recieve = '<button class="btn btn-secondary btn_recieve btn-sm"type="button" > รับป้าย </button> ';
							}else if(val['field_recieve_status'] == '2'){
								recieve_status = '<span class="text-success"><i class="fas fa-check-circle"></i> รับป้ายแล้ว<br><small>('+formatDatetime(val['field_recievedate'])+')</small></span><br>';
								if(val['field_setup_status'] == '1' || val['field_setup_status'] == ''){
									if (val['field_do_yourself'] == 0) {
										// btn_setup = '<button class="btn btn-secondary btn_setup btn-sm"type="button" > ติดตั้งป้าย </button> ';
										if (val['field_recieve_success'] == null ) {
											setup_status = '<span class="text-warning"><i class="fas fa-clock"></i> รอยืนยันรับป้าย </span><br>';
										}
										else if (val['field_recieve_success'] == 1) {
											setup_status = '<span class="text-warning"><i class="fas fa-clock"></i> รอติดตั้ง </span><br>';
											btn_setup = '<button class="btn btn-secondary btn_setup btn-sm"type="button" > ติดตั้งป้าย </button> ';
											
										}
									}
									else if(val['field_do_yourself'] == 1){
										setup_status = '<span class="text-warning"><i class="fas fa-clock"></i> รอติดตั้ง </span><br>';
										btn_setup = '<button class="btn btn-secondary btn_setup btn-sm"type="button" > ติดตั้งป้าย </button> ';
									}
								}else if(val['field_setup_status'] != 0 && val['field_setup_status'] != 1 && val['field_setup_status'] != 4){
									if (val['field_setup_status'] == 2) {
										setup_status = '<span class="text-success"><i class="fas fa-check-circle"></i> ติดตั้งแล้ว </span><br>';
										setup_status += '<small class="text-success">'+val['firstname']+'('+val['nickname']+')</small><br>';	
										setup_status += '<small class="text-success">('+formatDatetime(val['field_setupdate'])+')</small><br>';
									}else if(val['field_setup_status'] == 3){
										setup_status = '<span class="text-success"><i class="fas fa-check-circle"></i> ไม่ติดตั้ง </span><br>';	
										setup_status += '<small class="text-success">('+formatDatetime(val['field_setupdate'])+')</small><br>';
									}
									btn_edit_page = '';

									if (val['field_upload_status'] == '0') {
										btn_upload = '<button class="btn btn-primary btn_upload btn-sm"type="button" > เพิ่มรูป </button> ';
										recheck_status = '<span class="text-warning"><i class="fas fa-clock"></i> รออัปโหลดรูป </span><br>';
									}else if(val['field_upload_status'] == '1'){
										recheck_status = '<span class="text-success"><i class="fas fa-check-circle"></i> อัปโหลดรูปเรียบร้อย </span><br>';
										if (val['field_upload_date'] != null) {
											recheck_status += '<small class="text-success">('+formatDatetime(val['field_upload_date'])+')</small><br>';
										}
										if(val['field_recheck_status'] == '1'){
											recheck_status += '<span class="text-warning"><i class="fas fa-clock"></i> รอตรวจสอบ </span><br>';
											<?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Recheck"])) {?>
												btn_recheck = ' <div class="btn-group">';
												btn_recheck += '<button class="btn btn-secondary btn_recheck btn-sm" type="button" id="btn_recheck"> ตรวจสอบ </button> ';
												btn_recheck += '<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
												btn_recheck += '<span class="caret"></span>';
												btn_recheck += ' <span class="sr-only">Toggle Dropdown</span>';
												btn_recheck += '</button>';
												btn_recheck += '<ul class="dropdown-menu" role="menu">';
												btn_recheck += '<li><a href="#" class="btn_recheck_print btn-sm"> พิมพ์ใบตรวจ </a></li>';
												btn_recheck += '</ul>';
												btn_recheck += '</div> ';
											<?php }; ?>
											btn_upload = '<button class="btn btn-primary btn_upload btn-sm"type="button" > เพิ่มรูป </button> ';
										}else if(val['field_recheck_status'] == '2'){
											recheck_status += '<span class="text-success"><i class="fa fa-check-circle"></i> ผ่านการตรวจสอบ </span><br>';
											btn_upload = ' ';
										}else if(val['field_recheck_status'] == '3'){
											recheck_status += '<span class="text-danger""> ไม่ผ่านการตรวจสอบ </span><br>'; 
											// 	btn_recheck = ' <div class="btn-group">';
											// 	btn_recheck += '<button class="btn btn-secondary btn_recheck btn-sm" type="button" id="btn_recheck"> เสร็จสิ้น </button> ';
											// 	btn_recheck += '<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
											// 	btn_recheck += '<span class="caret"></span>';
											// 	btn_recheck += ' <span class="sr-only">Toggle Dropdown</span>';
											// 	btn_recheck += '</button>';
											// 	btn_recheck += '<ul class="dropdown-menu" role="menu">';
											// 	btn_recheck += '<li><a href="#" class="btn_recheck_print btn-sm"> พิมพ์ใบตรวจ </a></li>';
											// 	btn_recheck += '</ul>';
											// 	btn_recheck += '</div> ';
											btn_edit = '<button title="ถอยเอกสารเพื่อยกเลิก" class="btn btn-warning btn_edit btn-sm"type="button" > ถอย </button> ';
											btn_upload = ' ';
											// btn_upload = '<button class="btn btn-primary btn_upload btn-sm"type="button" > เพิ่มรูป </button> ';
										}else if(val['field_recheck_status'] == '4'){
											recheck_status += '<span class="text-danger""> ไม่ผ่านการตรวจสอบ </span><br>'; 
											recheck_status += '<span class="text-warning"><i class="fas fa-clock"></i> รอทำลายก่อนถอย </span><br>'; 
											btn_destroy_recheck = '<button class="btn btn-danger btn_destroy_recheck btn-sm"type="button" ><small>ทำลาย</small></button> ';
											btn_upload = ' ';
											// btn_edit_page = '<button class="btn bg-orange btn_edit_page btn-sm"type="button" > แก้ไข </button> ';
										}
									}
								}else if(val['field_setup_status'] == 4) {
									setup_status = '<span class="text-warning"><i class="fas fa-clock"></i> ยังไม่พร้อมติดตั้ง </span><br>';
									setup_status += '<small class="text-warning">('+formatDatetime(val['field_setupdate'])+')</small><br>';
									btn_setup = '<button class="btn btn-secondary btn_setup btn-sm"type="button" > ติดตั้งป้าย </button> ';
								}
							}
						}

						var confirm_return = '';
						var return_status = '';
						var btn_destroy = '';
						if(val['status_destroy'] == '1'){
							confirm_return = '<span class="text-warning"><small>มีป้ายเก่ารอทำลาย</small></span>';
							btn_destroy = '<button class="btn btn-danger btn_destroy btn-sm"type="button" ><small>ทำลาย</small></button> ';
						}else if(val['status_destroy'] == '0'){
							confirm_return = '<span class="text-success"><small>ไม่มีป้ายเก่าต้องทำลาย</small></span><br>';
						}else if(val['status_destroy'] == '2'){
							return_status = '<span class="text-success"><small>ทำลายป้ายเก่าเรียบร้อย</small></span><br>';
						}
					}
					else if (val['field_confirm_status'] == '2') {
						confirm_status = '<span class="text-danger"><i class="fas fa-times-circle"></i> ไม่ต้องการทำป้าย </span><br>';
						btn_edit = '';
						btn_edit_page = '';
					}

					var active_color = '';
					if (val['field_active_status'] == 0) {
						active_color = 'text-secondary';
						confirm_return += 'เลิกใช้งาน';
						btn_edit_page = '';
						btn_confirm = '';
						btn_packing = '';
						btn_destroy = '';
						btn_recieve = '';
						btn_setup = '';
						btn_recheck = '';
						btn_upload = '';
						btn_edit = '';
						<?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/ReActive"])) {?>
						btn_reActive = '<button class="btn btn-success btn_reActive btn-sm"type="button" > คืนค่า </button> ';
						<?php }; ?>
					}

					if (val['field_request_status'] == 1) {
						btn_edit_page = '';
						btn_confirm = '';
						btn_packing = '';
						btn_destroy = '';
						btn_recieve = '';
						btn_setup = '';
						btn_recheck = '';
						btn_upload = '';
						btn_edit = '';
						recheck_status = '<span class="text-warning""><i class="fas fa-clock"></i> รออนุมัติถอย </span><br>'; 
					}

					$('#tbody_sign').append(
						'<tr class="'+active_color+'">'+
							'<td class="hidden field_id">'+val['sign_id']+'</td>'+
							'<td class="hidden field_recheck">'+val['field_recheck_status']+'</td>'+
							'<td width="8%" class="field_docno">'+val['field_docno']+'</td>'+
							'<td width="8%" class="field_itemcode">'+val['field_itemcode']+'</td>'+
							'<td width="20%" class="field_itemname">'+val['field_itemname']+'</td>'+
							'<td width="10%">'+val['type_name']+'</td>'+
							'<td width="10%" class="text-center">'+data['sign_old_count'][id][0]['count']+'</td>'+
							'<td width="10%">'+ confirm_status + confirm_return +'</td>'+
							'<td width="10%">'+ packing_status + loadding + return_status +'</td>'+
							'<td width="10%">'+ recieve_status + setup_status + recheck_status +'</td>'+
							'<td width="15%">'+ btn_view  + btn_confirm + btn_packing + btn_destroy +btn_destroy_recheck+ btn_recieve + btn_setup + btn_recheck + btn_upload +btn_edit+timeline+btn_reActive+btn_signcancel+'</td>'+
						'</tr>'
					);

				});
				
				$('.pagination').empty();
				var Total_Sign = (Math.ceil(parseInt(data['Total_Sign']) / parseInt(usersPerPage)));
				// console.log(Total_Sign,data['Total_Sign'],usersPerPage);
				if(parseInt(pageNumber) > 5){
					$('.pagination').append('<li><button class="pageNumber">1</button></li>');
					$('.pagination').append('<li><button class="pageNumber" disabled>...</button></li>');
				}
				for (var i = 1; i <= Total_Sign; i++) {
					if(parseInt(pageNumber)-5 < i && parseInt(pageNumber)+7 > i){
						if(parseInt(pageNumber)+1 == i){
							$('.pagination').append('<li><button class="pageNumber active">'+i+'</button></li>');
						}else{
							$('.pagination').append('<li><button class="pageNumber">'+i+'</button></li>');
						}
					}
				}

				if(parseInt(pageNumber) < Total_Sign-6){
					$('.pagination').append('<li><button class="pageNumber" disabled>...</button></li>');
					$('.pagination').append('<li><button class="pageNumber">'+Total_Sign+'</button></li>');
				}
            }
        });
	}

	function sign_type() 
    { 
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/sign_type')?>",
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $('.search_type').empty();
                $('.search_type').append(
                    '<option value="">ทั้งหมด</option>'
                );
                $.each(data, function (ida, val) {
					$('.search_type').append(
						'<option value="'+val['id']+'">'+val['type_name']+'</option>'
					);
                });
            }
        });
    };

	function get_groupcode(){
        $.ajax({
            type:'GET',
            url:'<?= site_url('SignV2/get_groupcode')?>',
            dataType:'JSON',
        }).done(function(data){
            $('.search_groupcode').empty();
            $('.search_groupcode').append('<option value="">ทั้งหมด</option>');
            $.each(data['groupcode'],function(id,val){
				$('.search_groupcode').append('<option value="'+val['Code']+'">'+val['Code']+'&emsp;'+'>'+'&emsp;'+val['Name']+'</option>');
            });
            
        }).fail(function(data){
        });
    }

	function get_employee(type_employee){
        $.ajax({
        type: "POST",
        url: "<?= site_url('SignV2/get_employee')?>",
        dataType: "JSON",
        async: false,
        success: function (data) {

			if(type_employee == 1){
				$('#destroy_person_id').val(data[0]['employeeid']);      
				$('#destroy_person').val(data[0]['firstname'] +' '+ data[0]['lastname'] +' ('+data[0]['nickname']+ ')');
			
			}else if(type_employee == 2){
				$('#recieve_person_id').val(data[0]['employeeid']);      
				$('#recieve_person').val(data[0]['firstname'] +' '+ data[0]['lastname'] +' ('+data[0]['nickname']+ ')');
	
			}else if(type_employee == 3){
				$('#setup_personid').val(data[0]['employeeid']);      
				$('#setup_person').val(data[0]['firstname'] +' '+ data[0]['lastname'] +' ('+data[0]['nickname']+ ')');
			
			}else if(type_employee == 4){
				$('#recheck_personid').val(data[0]['employeeid']);      
				$('#recheck_person').val(data[0]['firstname'] +' '+ data[0]['lastname'] +' ('+data[0]['nickname']+ ')');
			}
			else if(type_employee == 7){
				$('#destroy_person_id_success').val(data[0]['employeeid']);      
				$('#destroy_person_success').val(data[0]['firstname'] +' '+ data[0]['lastname'] +' ('+data[0]['nickname']+ ')');
			
			}

        }
        });
    };

	function get_employee_setup(){
		$.ajax({
			type:'GET',
			url:'<?= site_url('SignV2/get_employee_setup')?>',
			dataType:'JSON',
			async: false,
		}).done(function(data){

			// console.log(data)

			$('.setup_person').empty();
			$('.setup_person').append('<option value="">เลือกพนักงานติดตั้งป้าย</option>');
			$('.select2-selection__choice').remove();
			$.each(data['employee'],function(id,val){
				$('.setup_person').append('<option value="'+val['id']+'">'+val['firstname']+' ('+val['nickname']+')   '+val['departname']+'</option>');
			});

		}).fail(function(data){
		});
	}

	function get_employee_tosetup(){

		$.ajax({
            type:'GET',
            url:'<?= site_url('SignV2/get_employee_tosetup')?>',
            dataType:'JSON',
            async: false,
        }).done(function(data){
            // console.log(data)
            $('.recieve_toperson').empty();
			 $('.recieve_toperson').append('<option value="">เลือกฝ่าย</option>');
            $('.select2-selection__choice').remove();
            $.each(data['PART'],function(id,val){
                $('.recieve_toperson').append('<option value="'+val['id']+'">'+val['name']+'</option>');
            });

        }).fail(function(data){
        });
    }

	function destroy_comment() 
    { 
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/comment_type')?>",
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $('#destroy_comment').empty();
                $('#destroy_comment').append(
                    '<option value="">เลือกหมายเหตุ</option>'
                );
                $.each(data, function (ida, val) {
					$('#destroy_comment').append(
						'<option value="'+val['id']+'">'+val['detail']+'</option>'
					);
                });
				$('#destroy_comment').append(
						'<option value="">*เพิ่มหมายเหตุโทรหา IT 30(หรือแจ้งไลน์ ไอที)*</option>'
				);
            }
        });
    };

	function change_active_status(field_id) {  
		$.ajax({
			type: "POST",
            url: "<?= site_url('SignV2/change_active_status')?>",
			data: {
				field_id : field_id
			},
			dataType: "json",
			success: function (data) {
				swal({ 
					title: 'สำเร็จ',
					type: 'success',
				}).then((result) => {
					if (result.value) {
						get_all_sign();
						console.log(data);
					}
				});
			}
		});
	}

	function clearinput() {
		$('#file').val('');
		$('#recheck_comment').val('');
		$('#recheck_status').val(null).trigger('change');
		$('#recieve_toperson').val(null).trigger('change');
		$('#destroy_comment').val('');
		$('#destroy_comment_success').val('');
	};

	function delete_file (delete_id,delete_file_name)
    {
      $.ajax({
      type:'POST',
      url:'<?= site_url('SignV2/delete_file_1')?>',
      data :{
        file_id : delete_id,
        file_name : delete_file_name,
        link_1 : 'SignV2'
      },
      dataType:'JSON',
      }).done(function(data){
      swal({
        title: 'สำเร็จ',
        text: "ลบไฟล์สำเร็จ",
        type: 'success' ,
        confirmButtonColor: '#6c757d',
        confirmButtonText: 'ปิด' ,
      }).then((result) => {
      if (result.value) {
		console.log(data);
		get_all_sign();
		get_file(delete_id,$('#recheck_status_img').val());
      }
      });

      }).fail(function(data){
      
      });

    };

	function get_file(id,check_status)
    {
		jQuery('img').each(function(){
			jQuery(this).attr('src',jQuery(this).attr('src')+ '?' + (new Date()).getTime());
		});

      var field_id = id;

      $('#links_file').empty();
      $('#links_file_recheck').empty();
      $.ajax({
		type:'POST',
		url:'<?= site_url('SignV2/get_file_1')?>',
		dataType:'JSON',
		data:
		{
			field_id : id,
			link_1 : 'SignV2'
		},
		}).done(function(data){

			// console.log(data);
		
			if(data){
				$.each(data['scandir'],function(ids,val){
				
					if(val != '.' && val != '..'){
						
						var url = '<?= base_url('assets/images/SignV2/')?>/'+field_id+'/'+val
						<?php if ($_SESSION['saeree_departid'] == '11') { ?>
							$('#links_file').append('' +
								'<div class="col-sm-6">'+
									'<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
										'<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
									'</a>'+
									'<button type="button" class="btn btn-danger btn-sm btn-block btn_delete_file">ลบไฟล์</button>'+
									'<input type="hidden" name="delete_id" id="delete_id" value="'+ field_id +'">'+
									'<input type="hidden" name="delete_file_name" id="delete_file_name" value="'+ val +'">'+
								'</div>'
							);

							$('#links_file_recheck').append('' +
							'<div class="col-sm-6">'+
								'<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
									'<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
								'</a>'+
							'</div>'
							);
						<?php }
						else{ ?>
							if (check_status != 2) {
								$('#links_file').append('' +
									'<div class="col-sm-6">'+
										'<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
											'<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
										'</a>'+
										'<button type="button" class="btn btn-danger btn-sm btn-block btn_delete_file">ลบไฟล์</button>'+
										'<input type="hidden" name="delete_id" id="delete_id" value="'+ field_id +'">'+
										'<input type="hidden" name="delete_file_name" id="delete_file_name" value="'+ val +'">'+
									'</div>'
								);

								$('#links_file_recheck').append('' +
									'<div class="col-sm-6">'+
										'<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
											'<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
										'</a>'+
									'</div>'
								);
							}
							else if(check_status == 2){
								$('#links_file').append('' +
									'<div class="col-sm-6">'+
										'<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
											'<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
										'</a>'+
									'</div>'
								);

								$('#links_file_recheck').append('' +
									'<div class="col-sm-6">'+
										'<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
											'<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
										'</a>'+
									'</div>'
								);
							}
						<?php } ?>

					}
				});
			}

		}).fail(function(data){
			
      });

    };

	function not_confirm(field_id,notCon_comment) 
    {  
		// console.log(field_id,notCon_comment);
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
                    url:'<?= site_url('SignV2/update_it_unconfirm')?>',
                    dataType:'JSON',
                    data:{
                        field_id : field_id,
                        field_confirm_status : confirm,
                        field_not_confirm_comment : notCon_comment
                    },
                }).done(function(data){
                    swal({ 
                        title: 'บันทึกข้อมูลสำเร็จ',
                        type: 'success',
                    }).then((result) => {
                        if (result.value) {
                            $('#pageNumber').val(0);
                            get_all_sign();
                        }
                        
                    });
                }).fail(function(data){
                    
                });
            }
        });
    };


	function get_file2(id)
    {

		jQuery('img').each(function(){
			jQuery(this).attr('src',jQuery(this).attr('src')+ '?' + (new Date()).getTime());
		});

      var field_id = id;

      $('#links_file_recheck_destroy').empty();
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

						$('#links_file_recheck_destroy').append('' +
						'<div class="col-sm-6">'+
							'<a  target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
								'<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
							'</a>'+
						'</div>'
						);


					}
				});
			}

		}).fail(function(data){
			
      });

    };

	function name_text(firstname,nickname) {  
        var name = firstname+' ('+nickname+')';
        return name ;
    }

	function formatDatetime(datetime) 
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
        var new_datetime = New_date.getDate()+'/'+monthNames[New_date.getMonth()]+'/'+(New_date.getFullYear())+ ' '+currentHours+':'+currentMinutes+' น.';

        return new_datetime;
    }

    function formatDate(datetime) 
    {  
        monthNames = ["01", "02", "03", "04", "05", "06","07", "08", "09", "10", "11", "12"];

        var New_date = new Date(datetime);
		if (datetime != null) {
			var New_date = new Date(datetime.replace(/\s/, 'T'));
		}

        var new_datetime = New_date.getDate()+'/'+monthNames[New_date.getMonth()]+'/'+(New_date.getFullYear());

        return new_datetime;
    }

</script>

<script>

</script>