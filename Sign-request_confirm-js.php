<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        all_click();
        select2();
        get_sign();
        
    });

    function all_clear() {  
        $('#input_confirm_reprint').val('');
    }

    function select2() { 
        $( ".search_groupcode" ).select2({
            theme: "bootstrap4"
        });

        $( ".search_type" ).select2({
            theme: "bootstrap4"
        });
        
        $( ".search_size" ).select2({
            theme: "bootstrap4"
        });

        $( "#usersPerPage" ).select2({
            theme: "bootstrap4"
        });
    }

    function all_click() {  
        $('#btn_refresh').click(function (e) { 
            e.preventDefault();
            get_sign();
        });

        $('#search_text').keyup(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
            get_sign();
        });

        $('#usersPerPage').change(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
            get_sign();
        });

        $('#search_type').change(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
            get_sign();
        });

        $(document).on('click','.pageNumber',function(){
			$('#pageNumber').val($(this).text()-1);
			get_sign();
        });

        $('#btn_submit_backtoedit').click(function (e) { 
            e.preventDefault();
            swal({
                title: "ต้องการอนุมัติถอยเอกสาร?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1AA45F',
                cancelButtonColor: '#DB4B3F',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
        	}).then((result) => {
        		if (result.value){
                   var field_id = $('#field_id_backtoedit').val();
                   confirm_backtoedit(field_id);
        		}
        	});
        });

        $('#btn_cancel_backtoedit').click(function (e) { 
            e.preventDefault();
            swal({
                title: "ต้องการอนุมัติถอยเอกสาร?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1AA45F',
                cancelButtonColor: '#DB4B3F',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
        	}).then((result) => {
        		if (result.value){
                   var field_id = $('#field_id_backtoedit').val();
                   cancel_backtoedit(field_id);
        		}
        	});
        });

        $('#btn_submit_reprint').click(function (e) { 
            e.preventDefault();
            swal({
                title: "ต้องการอนุมัติถอยปริ้น?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1AA45F',
                cancelButtonColor: '#DB4B3F',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
        	}).then((result) => {
        		if (result.value){
                   var field_id = $('#field_id_reprint').val();
                   confirm_reprint(field_id);
        		}
        	});
        });

        $('#btn_cancel_reprint').click(function (e) { 
            e.preventDefault();
            swal({
                title: "ต้องการอนุมัติถอยปริ้น?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1AA45F',
                cancelButtonColor: '#DB4B3F',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
        	}).then((result) => {
        		if (result.value){
                   var field_id = $('#field_id_reprint').val();
                   cancel_reprint(field_id);
        		}
        	});
        });

        $('#btn_ceo_submit_reprint').click(function (e) { 
            e.preventDefault();
            swal({
                title: "ต้องการอนุมัติถอยปริ้น?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1AA45F',
                cancelButtonColor: '#DB4B3F',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
        	}).then((result) => {
        		if (result.value){
                   var field_id = $('#field_id_reprint').val();
                   confirm_reprint(field_id);
        		}
        	});
        });

        $('#btn_ceo_cancel_reprint').click(function (e) { 
            e.preventDefault();
            swal({
                title: "ต้องการอนุมัติถอยปริ้น?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1AA45F',
                cancelButtonColor: '#DB4B3F',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
        	}).then((result) => {
        		if (result.value){
                   var field_id = $('#field_id_reprint').val();
                   cancel_reprint(field_id);
        		}
        	});
        });

        $('#btn_submit_reloaddata').click(function (e) { 
            e.preventDefault();
            swal({
                title: "ต้องการอนุมัติถอยดึงข้อมูล?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1AA45F',
                cancelButtonColor: '#DB4B3F',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
        	}).then((result) => {
        		if (result.value){
                   var field_id = $('#field_id_reloaddata').val();
                   confirm_reloaddata(field_id);
        		}
        	});
        });

        $('#btn_cancel_reloaddata').click(function (e) { 
            e.preventDefault();
            swal({
                title: "ไม่ต้องการอนุมัติถอยดึงข้อมู,?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1AA45F',
                cancelButtonColor: '#DB4B3F',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
        	}).then((result) => {
        		if (result.value){
                   var field_id = $('#field_id_reloaddata').val();
                   cancel_reloaddata(field_id);
        		}
        	});
        });

        $('#tb_list_sign').on('click','.btn_view',function(){ 
            var field_id = $(this).closest('tr').find('.field_id').text();
			var field_docno = $(this).closest('tr').find('.field_docno').text();
			var field_request_type = $(this).closest('tr').find('.field_request_type').text();
            all_clear();
            if (field_request_type == 1) {
                $('#confirm_reprint_modal').modal('show');
                list_request_sub(field_id,field_request_type);
                $('#field_id_reprint').val(field_id);
                $('#title_reprint').text('ข้อมูลรายการขอถอยปริ้น เลขที่เอกสาร '+field_docno);
                
            }else if (field_request_type == 2) {
                $('#confirm_reloaddata_modal').modal('show');
                list_request_sub(field_id,field_request_type);
                $('#field_id_reloaddata').val(field_id);
                $('#title_reloaddata').text('ข้อมูลรายการขอถอยดึงข้อมูล เลขที่เอกสาร '+field_docno);
            }else if (field_request_type == 3) {
                $('#confirm_backtoedit_modal').modal('show');
                list_request_main(field_id);
                $('#field_id_backtoedit').val(field_id);
                $('#title_backtoedit').text('ข้อมูลการขอถอยเอกสาร เลขที่เอกสาร '+field_docno);
            }
            
        });

        $('#btn_confirm').click(function (e) {
            e.preventDefault();
            var field_id = '';
            var i = 0;
            for( i ; i < $('#tb_list_sign tr.select').length; i++ ){
                field_id += $('#tb_list_sign tr.select').eq(i).attr('id')+'-';
            }

            swal({
                title: 'คุณต้องการยืนยันการปรับราคา?',
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#DCDCDC',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value) {
                    update_purcease_confirm(field_id);
                }
            });
        });

        $('#btn_selectall').click(function (e) { 
            e.preventDefault();
            if($("#tb_sign tbody tr:not(.select)").length == 0){
                $("#tb_sign tbody tr.select").removeClass('select');
                $("#btn_confirm").addClass('hidden');
            }else{
                $("#tb_sign tbody tr:not(.select)").addClass('select');
                $("#btn_confirm").removeClass('hidden');
            }
        });

        // $('#tb_list_sign').delegate('tr', 'click', function(e) {
        //     if($(this).hasClass('select')){
        //         $(this).removeClass('select');
        //         $('#dataSelect tr#'+$(this).attr('id')).remove();
        //         if($('#tb_sign tbody tr.select').length == 0){
        //             $("#btn_confirm").addClass('hidden');
        //         }
        //     }else{
        //         $(this).addClass('select');
        //         $(this).clone().appendTo('#dataSelect tbody');
        //         $('#dataSelect tr#'+$(this).attr('id')+' td.remove').remove();
        //         $('#dataSelect tr#'+$(this).attr('id')).removeClass('select');
        //         $("#btn_confirm").removeClass('hidden');
        //     }
        // });
    }

    function update_purcease_confirm(field_id) {  
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/update_purcease_confirm')?>",
            data: {
                field_id : field_id
            },
            dataType: "json",
            success: function (data) {
                swal({
                        title: 'สำเร็จ',
                        text: "ยืนยันปรับราคาเรียบร้อย",
                        type: 'success' ,
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                    }).then((result) => {
                        if (result.value) {
                            get_sign(); 
                            $("#btn_confirm").addClass('hidden');
                        }
                    });
            }
        });
    }

    function get_sign(){ 
        var search_text = $('#search_text').val();
        var search_type = $('#search_type').val();
        var usersPerPage = parseInt($('#usersPerPage').val());
        var pageNumber = $('#pageNumber').val();

        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/sign_request_list')?>",
            data : {
                pageNumber : pageNumber ,
                usersPerPage : usersPerPage,
                search_type : search_type,
                search_text : search_text
            },
            dataType: "JSON",
            success: function (data) {
                
                console.log(data);
                $('#tb_list_sign').empty();
                $.each(data['SignRequest'],function(id,val){
                    var name = name_text(val['request_firstname'],val['request_nickname']);
                    var date_request = '<br><small>'+formatDatetime(val['field_request_date'])+'</small>';

                    if (val['field_confirm_status'] == 0) {
                        var confirm_status = '<span class="text-warning"><i class="fas fa-clock"></i> รออนุมัติ </span>';
                    }else if (val['field_confirm_status'] == 1) {
                        var confirm_status = '<span class="text-success"><i class="fas fa-check"></i> อนุมัติเรียบร้อย </span>';
                        confirm_status += '<br><span class="text-success">'+name_text(val['confirm_firstname'],val['confirm_nickname'])+'</span>';
                        confirm_status += '<br><small class="text-success">'+formatDatetime(val['field_confirm_date'])+'</small>';
                    }
                    else if (val['field_confirm_status'] == 2) {
                        var confirm_status = '<span class="text-danger"><i class="fas fa-check"></i> ไม่อนุมัติ </span>';
                        confirm_status += '<br><span class="text-danger">'+name_text(val['confirm_firstname'],val['confirm_nickname'])+'</span>';
                        confirm_status += '<br><small class="text-danger">'+formatDatetime(val['field_confirm_date'])+'</small>';
                    }

                    var request_type = '';

                    if (val['field_request_type'] == '1') {
                         request_type = 'ขอถอยปริ้น'
                    }else if (val['field_request_type'] == '2') {
                        request_type = 'ขอถอยดึงข้อมูล'
                    }else if (val['field_request_type'] == '3') {
                        request_type = 'ขอถอยเอกสาร'
                    }

                    var btn_view = '<button class="btn btn_view btn-sm btn-info">อนุมัติ</button>';

                    // console.log(count_diff_date(val['field_request_date']));

                    if (count_diff_date(val['field_request_date']) < -1) {
                        btn_view = '<span class="text-danger">หมดเวลาการอนุมัติ</span>' ;
                        <?php if ($_SESSION['saeree_departid'] == '11') { ?>
                            btn_view = '<button class="btn btn_view btn-sm btn-info">(หมดเวลา)อนุมัติ</button>';
                        <?php } ?>
                    }

                    var list_item = '';

                    if (val['itemcode_sub'] != '') {
                        list_item = val['itemcode_sub'];
                    }
                    if (val['sg_sub'] != ''){
                        list_item = val['sg_sub'];
                    }

                    $('#tb_list_sign').append(
                        '<tr>'+
                            '<td class="hidden field_request_type">'+val['field_request_type']+'</td>'+
                            '<td class="hidden field_id">'+val['field_id']+'</td>'+
                            '<td class="field_docno">'+val['field_docno']+'</td>'+
                            '<td>'+list_item+'</td>'+
                            '<td>'+val['field_request_comment']+'</td>'+
                            '<td>'+request_type+'</td>'+
                            '<td>'+name+date_request+'</td>'+
                            '<td>'+confirm_status+'</td>'+
                            '<td>'+btn_view+'</td>'+
                        '</tr>'
                    );
                });
                // สถานะการสั่งทำป้าย

                $('.pagination').empty();
                var total_request = (Math.ceil(parseInt(data['total_request']) / parseInt(usersPerPage)));
                if(parseInt(pageNumber) > 5){
                    $('.pagination').append('<li><button class="pageNumber">1</button></li>');
                }
                for (var i = 1; i <= total_request; i++){
                    if(parseInt(pageNumber)-5 < i && parseInt(pageNumber)+7 > i){
                        if(parseInt(pageNumber)+1 == i){
                            $('.pagination').append('<li><button class="pageNumber active">'+i+'</button></li>');
                        }else{
                            $('.pagination').append('<li><button class="pageNumber">'+i+'</button></li>');
                        }
                    }
                }
                if(parseInt(pageNumber) < total_request-6){
                    $('.pagination').append('<li><button class="pageNumber">'+total_request+'</button></li>');
                }
            }
        });
    };

    function list_request_sub(field_id,field_request_type) { 
        $('.input_comment').val('');
        $(".input_comment").prop("readonly",false);
        $('.btn_confirm').removeClass('hidden');
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/list_request_sub')?>",
            data: {field_id:field_id},
            dataType: "json",
            success: function (data) {
                $('.tbody_request_sub').empty();
                console.log(data);

                $.each(data['SignRequest_sub'], function (id, val) { 
                    $('.tbody_request_sub').append(
                        '<tr>'+
                            '<td>'+val['field_itemcode']+'</td>'+
                            '<td>'+val['field_itemname']+'</td>'+
                            '<td>'+val['size_name']+'</td>'+
                            '<td>'+val['type_name_price']+'</td>'+
                            '<td class="text-right">'+val['field_signamount']+'</td>'+
                            '<td class="text-right field_print_count">'+val['field_print_count']+'</td>'+
                        '</tr>'
                    );
                });


                var print_count = '';
                $('.tbody_request_sub').find('tr').each(function(){
                    if(parseFloat($(this).find('.field_print_count').text()) > 2){
                        print_count = 1;
                    }
                });

                if (field_request_type == 1 && print_count == 1) {
                    $('.btn_confirm').addClass('hidden');
                    $('.btn_ceo_confirm').removeClass('hidden');
                }else{
                    $('.btn_confirm').removeClass('hidden');
                    $('.btn_ceo_confirm').addClass('hidden');
                }

                if (data['SignRequest'][0]['field_confirm_status'] == 1 || data['SignRequest'][0]['field_confirm_status'] == 2) {
                    $('.input_comment').val(data['SignRequest'][0]['field_confirm_comment']);
                    $('.input_comment').prop('readonly', true);
                    $('.btn_confirm').addClass('hidden');
                }


            }

        });
    }

    function list_request_main(field_id) { 
        $('.input_comment').val('');
        $(".input_comment").prop("readonly",false);
        $('.btn_confirm').removeClass('hidden');
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/list_request_sub')?>",
            data: {field_id:field_id},
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('.show_sg').empty();
                $.each(data['SignRequest_signmain'], function (id, val) { 
                    $('.show_sg').append(
                        '<div class="col-md-12">'+
                            '<div class="card card-primary">'+
                                '<div class="card-header">'+
                                    '<h2 class="card-title"> เลขที่เอกสารที่ขอถอย '+val['field_docno']+'</h2>'+
                                '</div>'+
                                '<div class="card-body">'+
                                    '<div class="row">'+
                                        '<div class="col-md-3">'+val['field_itemcode']+'</div>'+
                                        '<div class="col-md-9">'+val['field_itemname']+'</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                });

                if (data['SignRequest'][0]['field_confirm_status'] == 1 || data['SignRequest'][0]['field_confirm_status'] == 2) {
                    $('.input_comment').val(data['SignRequest'][0]['field_confirm_comment']);
                    $('.input_comment').prop('readonly', true);
                    $('.btn_confirm').addClass('hidden');
                }
            }
        });
    }

    function confirm_backtoedit(field_id) {  
        var comment = $('#input_confirm_backtoedit').val();
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/confirm_backtoedit')?>",
            data :{
                field_id : field_id,
                comment : comment
            },
            dataType: "json",
            success: function (data) {
                swal({
                    title: 'สำเร็จ',
                    text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                    type: 'success' ,
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {
                    if (result.value) {
                        $('#confirm_backtoedit_modal').modal('hide');
                        get_sign();

                        console.log(data);
                    }
                });
            }
        });
    }

    function cancel_backtoedit(field_id) {  
        var comment = $('#input_confirm_backtoedit').val();
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/cancel_backtoedit')?>",
            data :{
                field_id : field_id,
                comment : comment
            },
            dataType: "json",
            success: function (data) {
                swal({
                    title: 'สำเร็จ',
                    text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                    type: 'success' ,
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {
                    if (result.value) {
                        $('#confirm_backtoedit_modal').modal('hide');
                        get_sign();

                        console.log(data);
                    }
                });
            }
        });
    }


    function confirm_reprint(field_id) {  
        var comment = $('#input_confirm_reprint').val();
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/confirm_reprint')?>",
            data :{
                field_id : field_id,
                comment : comment
            },
            dataType: "json",
            success: function (data) {
                swal({
                    title: 'สำเร็จ',
                    text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                    type: 'success' ,
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {
                    if (result.value) {
                        $('#confirm_reprint_modal').modal('hide');
                        get_sign();
                    }
                });
            }
        });
    }

    function cancel_reprint(field_id) {  
        var comment = $('#input_confirm_reprint').val();
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/cancel_reprint')?>",
            data :{
                field_id : field_id,
                comment : comment
            },
            dataType: "json",
            success: function (data) {
                swal({
                    title: 'สำเร็จ',
                    text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                    type: 'success' ,
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {
                    if (result.value) {
                        $('#confirm_reprint_modal').modal('hide');
                        get_sign();
                    }
                });
            }
        });
    }


    function confirm_reloaddata(field_id) {  
        var comment = $('#input_confirm_reloaddata').val();
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/confirm_reloaddata')?>",
            data :{
                field_id : field_id,
                comment : comment
            },
            dataType: "json",
            success: function (data) {
                swal({
                    title: 'สำเร็จ',
                    text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                    type: 'success' ,
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {
                    if (result.value) {
                        $('#confirm_reloaddata_modal').modal('hide');
                        get_sign();
                    }
                });
            }
        });
    }

    function cancel_reloaddata(field_id) {  
        var comment = $('#input_confirm_reloaddata').val();
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/cancel_reloaddata')?>",
            data :{
                field_id : field_id,
                comment : comment
            },
            dataType: "json",
            success: function (data) {
                swal({
                    title: 'สำเร็จ',
                    text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                    type: 'success' ,
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {
                    if (result.value) {
                        $('#confirm_reloaddata_modal').modal('hide');
                        get_sign();
                    }
                });
            }
        });
    }


    function confirm_sign_size() {
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/select_sign_size')?>",
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

    function name_text(firstname,nickname) {  
        var name = firstname+' ('+nickname+')';
        return name ;
    }

    function formatDate(dateStr) 
    {
        const d = new Date(dateStr);
        var mm = String(d. getMonth() + 1). padStart(2, '0'); //January is 0!
        return d.getDate().toString().padStart(2, '0') + '/' + mm + '/' + d.getFullYear().toString().padStart(2, '0');
    };


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

    function count_diff_date(dayend) { 
		var dt1 = new Date();
		var dt2 = new Date(dayend);
	
		var time_difference = dt2.getTime() - dt1.getTime();
		var result = (time_difference / (1000 * 60 * 60 * 24));
		return result;
	}

</script>