<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction(); ?>

<script type="text/javascript">

    $(document).ready (function()
    {

       
        get_depart();

        check_file_upload();

        upload_file_before();

        upload_file_after();
     
        search_input_1();

        input_btn_function_rp();

        all_click();
        
        all_change();

    });

    function all_click() {  

        $('#btn_print_labor').click(function (e) { 
            e.preventDefault();
            swal({
                title: 'คุณต้องการพิมพ์เฉพาะค่าแรง',
                text: "เมื่อพิมพ์แล้วจะไม่สามารถพิมพ์ค่าแรงอีกได้",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1CC88A',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value) {
                    var type = 1;
                    export_rp(type);

                }
            });
        });

        $('#btn_print_item').click(function (e) { 
            e.preventDefault();
            swal({
                title: 'คุณต้องการพิมพ์เฉพาะค่าวัสดุ',
                text: "เมื่อพิมพ์แล้วจะไม่สามารถพิมพ์ค่าวัสดุอีกได้",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1CC88A',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value) {
                    var type = 2;
                    export_rp(type);

                }
            });
        });

        $('#btn_print_all').click(function (e) { 
            e.preventDefault();
            swal({
                title: 'คุณต้องการพิมพ์ค่าแรงและวัสดุ',
                text: "เมื่อพิมพ์แล้วจะไม่สามารถพิมพ์อีกได้",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1CC88A',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value) {
                    var type = 3;
                    export_rp(type);

                }
            });
        });

        $('#btn_requestbackward_submit').click(function (e) { 
            e.preventDefault();
            if ($('#backward_request_comment').val() != '') {

                $( "#backward_request_comment" ).removeClass( "is-warning" ).addClass( "is-valid" );
			    $('#backward_request_comment').css('border','');
                swal({
                    title: 'คุณแน่ใจไหม',
                    text: "ต้องการขอถอยใบสั่งผลิต-สั่งซ่อม",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#1CC88A',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                    cancelButtonText: 'ปิด',
                }).then((result) => {
                    if (result.value){
                        update_requestbackward();
                    }
                });
            }else{
                swal({
                    title: 'เตือน',
                    text: "กรุณากรอกสาเหตุการขอถอย",
                    type: 'warning',
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                });
                $( "#backward_request_comment" ).removeClass( "is-valid" ).addClass( "is-warning" );
			    $('#backward_request_comment').css('border','rgb(243, 156, 18) 2px solid');
            }
        });

        $('#btn_open_history_modal').click(function (e) { 
            e.preventDefault();
            $('#add_history_Modal').modal('show');

            get_fixitem();

            $('#field_fixitem_id').val(null).trigger('change');
            $('#field_fixitem_sub_id').val(null).trigger('change');
            $('#field_fixitem_item_id').val(null).trigger('change');

            $('#data_fixhistory').empty();
        });

        $('#btn_save_histroy').click(function (e) { 
            e.preventDefault();

            var check = 0;
            $('#data_fixhistory').find('tr').each(function(){
                if ($(this).find('.status').text() == 'history_add') {
                    check++;
                }
            });

            if (check > 0) {

                if ($('#field_fixitem_item_id').val() != '') {
                    swal({
                        title: 'คุณแน่ใจไหม',
                        text: "การบันทึกใบสั่งผลิต-สั่งซ่อม",
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#1CC88A',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                        cancelButtonText: 'ปิด',
                    }).then((result) => {
                        if (result.value){
                            add_request_production();
                        }
                    });
                }else{
                    swal({
                        title: 'เตือน',
                        text: "กรุณาเลือกสินทรัพย์ก่อนบันทึก",
                        type: 'warning',
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                    });
                }

            }else{
                swal({
                    title: 'เตือน',
                    text: "กรุณาเพิ่มรายการก่อนบันทึก",
                    type: 'warning',
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                });
            }
        });
    }

    function all_change() {  
        $('#field_fixitem_id').change(function (e) { 
            e.preventDefault();
            get_fixitem_sub_byid($('#field_fixitem_id').val());
            $('#data_fixhistory').empty();
            $('#field_fixitem_sub_id').val('').trigger('change');
            $('#field_fixitem_item_id').val('').trigger('change');
        });

        $('#field_fixitem_sub_id').change(function (e) { 
            e.preventDefault();
            get_fixitem_item_byid($('#field_fixitem_sub_id').val());
            $('#data_fixhistory').empty();
            $('#field_fixitem_item_id').val('').trigger('change');
        });

        $('#field_fixitem_item_id').change(function (e) { 
            e.preventDefault();
            get_fixhistory($('#field_fixitem_item_id').val());
            $('#data_fixhistory').empty();

            autocomplete_request_production();
        });

        $(document).on('click','.removeHisRow',function(){
            remove_history(
				$(this).closest('tr').find('.field_docno').text(),
            );
            
		});
    }

    function add_request_production()
    {

        var data_fixhistory = [];
        $('#data_fixhistory').find('tr').each(function(){
            if ($(this).find('.status').text() == 'history_add') {
                var data_fixhistorys = {};
                data_fixhistorys['field_id'] = $(this).find('.field_id').text();
                data_fixhistorys['field_rp_name'] = $(this).find('.field_rp_name').text();
                data_fixhistorys['field_docno'] = $(this).find('.field_docno').text();
                data_fixhistory.push(data_fixhistorys);
            }
        });
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/add_request_production_history')?>',
            dataType:'JSON',
            data:{
                data_fixhistory : data_fixhistory,
                field_fixitem_sub_id : $('#field_fixitem_item_id').val()
            },
        }).done(function(data){
            
            console.log(data)

            swal({ 
            title: 'สำเร็จ',
            text: "คุณบันทึกประวัติย้อนหลังเรียบร้อย",
            type: 'success',
            confirmButtonColor: '#6c757d',
            confirmButtonText: 'ปิด' ,
            }).then((result) => {
                if (result.value) {
                    get_fixhistory($('#field_fixitem_item_id').val());
                }
            });

        }).fail(function(data){
            console.log(data)
            swal({
                title: 'ERROR',
                text: "เกิดข้อผิดพลาดบางอย่าง",
                type: 'error',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            });
        });
    };

    function get_fixitem()
    {
        $( "#field_fixitem_id" ).select2({
            theme: "bootstrap4"
        });

        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/get_fixitem')?>',
            dataType:'JSON',
            }).done(function(data){

                $('#field_fixitem_id').empty();
                $('#field_fixitem_id').append('<option value=""> ระบุสิ่งที่ต้องการลงประวัติการซ่อม </option>');
                $.each(data['fixitem'],function(id,val){
                    $('#field_fixitem_id').append('<option value="'+val['field_id']+'">'+val['field_name_th']+' ['+val['field_name_en']+']</option>');
                });

            }).fail(function(data){
        });
    };

    function get_fixitem_sub_byid(id)
    {
        $( "#field_fixitem_sub_id" ).select2({
            theme: "bootstrap4"
        });

        $.ajax({
        type:'POST',
        url:'<?= site_url('Request_production/get_fixitem_sub_byid')?>',
        data: {
            field_fixitem_no : id
        },
        dataType:'JSON',
        }).done(function(data){

            console.log(data);

            $('#field_fixitem_sub_id').empty();
            $('#field_fixitem_sub_id').append('<option value=""> ระบุสิ่งที่ต้องการลงประวัติการซ่อมย่อย </option>');
            $.each(data['data_fixitem_sub'],function(id,val){
                $('#field_fixitem_sub_id').append('<option value="'+val['field_id']+'">'+val['field_name_th']+' ['+val['field_name_en']+']</option>');
                
            });
            
        }).fail(function(data){
            
        });
    };

    function get_fixitem_item_byid(id)
    {
        $( "#field_fixitem_item_id" ).select2({
            theme: "bootstrap4"
        });

        $.ajax({
        type:'POST',
        url:'<?= site_url('Request_production/get_fixitem_item_byid')?>',
        data: {
            field_fixitem_sub_no : id
        },
        dataType:'JSON',
        }).done(function(data){

            console.log(data);

            $('#field_fixitem_item_id').empty();
            $('#field_fixitem_item_id').append('<option value=""> ระบุสิ่งที่ต้องการลงประวัติการซ่อมย่อย </option>');
            $.each(data['data_fixitem_sub'],function(id,val){
                $('#field_fixitem_item_id').append('<option value="'+val['field_id']+'">'+val['field_name_th']+'</option>');
                
            });
            
        }).fail(function(data){
            
        });
    };

    function get_fixhistory(id)
    {
        $.ajax({
        type:'POST',
        url:'<?= site_url('Request_production/get_fixhistory')?>',
        data: {
            field_fixitem_sub_id : id
        },
        dataType:'JSON',
        }).done(function(data){
            console.log(data);

            var no = 1;
            $('#data_fixhistory').empty();
            if( data['fix_history'].length > 0){

                $.each(data['fix_history'],function(id,val){
                    $('#data_fixhistory').append(
                        '<tr>'+
                            '<td class="hidden status">history</td>'+
                            '<td class="hidden field_id">'+val['field_id']+'</td>'+
                            '<td class="text-center">'+no+'</td>'+
                            '<td class="text-left field_docno">'+val['field_docno']+'</td>'+
                            '<td class="text-left field_rp_name">'+val['field_rp_name']+'</td>'+
                            '<td></td>'+
                        '</tr>'
                    );

                    no++;
                });
            }

            if( data['fix_history_return'].length > 0){

                $.each(data['fix_history_return'],function(id,val){
                    $('#data_fixhistory').append(
                        '<tr class="bg-primary">'+
                            '<td class="hidden status">history</td>'+
                            '<td class="hidden field_id">'+val['field_rp_id']+'</td>'+
                            '<td class="text-center">'+no+'</td>'+
                            '<td class="text-left field_docno">'+val['field_rp_docno']+'</td>'+
                            '<td class="text-left field_rp_name">'+val['field_rp_name']+'</td>'+
                            '<td></td>'+
                        '</tr>'
                    );
                    no++;
                });

            }
            
        }).fail(function(data){
            
        });
    };

    function autocomplete_request_production()
    {
        $("#search_request_product").autocomplete({
        source: function(request,response){
            $.ajax({
            type:'POST',
            url:'<?= site_url("Request_production/autocomplete_request_production")?>',
            dataType:'json',
            data:{
                search : request.term ,
            },
            }).done(function(data){
                response(data['request_production']);
            }).fail(function(){
                console.log('fail');
            });
        },
        autoFocus:true,
        delay: 0,
        minLength: 0,
        select: function(id,val){

                var docno = val.item.field_docno;

                $("#search_request_product").val('');

                check_request_product(docno);

            return false;
            },
        }).autocomplete("instance")._renderItem = function(ul,item){
            return $("<li>")
            .append("<div>"+item.field_docno+"<br>"+item.field_rp_name+"</div>")
            .appendTo(ul);
        };
        
    };

    function check_request_product(docno) {  
        $.ajax({
            type: "POST",
            url: "<?= site_url('Request_production/check_request_product')?>",
            dataType: "JSON",
            data: {
                docno : docno 
            },
            success: function (data) {

                console.log(data);

                var i = 1;
                var check = 0;
                $('#data_fixhistory').find('tr').each(function(){
                    i++;
                    if ($(this).find('.field_docno').text() == docno) {
                        check++;
                    }
                });

                var val = data['request_production'];

                if (check == 0) {
                    var status_history = 'history_add';
                    addRow_fixitemHistory(val['field_docno'],val['field_id'],i,val['field_docno'],val['field_rp_name'],status_history);
                }else{
                    swal({
                        title: 'เตือน',
                        text: "เอกสารนี้ถูกดึงมาอ้างอิงแล้ว",
                        type: 'warning',
                        allowOutsideClick: false,
                    });
                }
            },error: function (data) {

            },

        });
    }

    function addRow_fixitemHistory(field_docno,field_id,i,field_docno,field_rp_name,status_history) {  
        $('#data_fixhistory').append(
            '<tr class="bg-primary  color-palette" id="'+field_docno+'">'+
                '<td class="hidden status">'+status_history+'</td>'+
                '<td class="hidden field_id">'+field_id+'</td>'+
                '<td class="text-center no">'+i+'</td>'+
                '<td class="field_docno">'+field_docno+'</td>'+
                '<td class="field_rp_name">'+field_rp_name+'</td>'+
                '<td><button type="button" class="btn btn-danger btn-sm removeHisRow"><i class="fa fa-trash"></i></button></td>'+
            '</tr>'
        );
    }

    function run_no(){
        var no = 1;
        $('#data_fixhistory').find('tr').each(function(){
            $(this).find('.no').text(no);
            no++;
        });
    };

    function remove_history(docno){
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
                // console.log(docno)
				// $(input).closest('tr').remove();
                $('#'+docno).remove();
				run_no();
			}
		});
	};

    function input_btn_function_rp() 
    {

        $( "#search_depart" ).select2({
            theme: "bootstrap4"
        });

        $( "#search_doc_type" ).select2({
            theme: "bootstrap4"
        });

        $( "#search_status" ).select2({
            theme: "bootstrap4"
        });

        $( ".employee_id" ).select2({
            theme: "bootstrap4"
        });


        // ----------------------------------- get_rp
        
            $('#search_text').keyup(function(e){ 
                e.preventDefault();
                search_input_1();
            }); 

            $('#search_depart').change(function(e){ 
                e.preventDefault();
                search_input_1();
            }); 

            $('#search_status').change(function(e){ 
                e.preventDefault();
                search_input_1();
            }); 

            $('#search_doc_type').change(function(e){ 
                e.preventDefault();
                search_input_1();
            });

            $(document).on('click','.pageNumber',function(){
                var search_text = '';
                var search_depart = '';
                var search_status = '';
                var search_doc_type = '';

                search_text = $('#search_text').val();
                search_depart = $('#search_depart').val();
                search_status = $('#search_status').val();
                search_doc_type = $('#search_doc_type').val();
                $('#pageNumber').val($(this).text()-1);
                get_rp(
                    search_text,
                    search_depart,
                    search_status,
                    search_doc_type
                );
            }); 
        // -----------------------------------get_rp

        // -----------------------------------btn action

            $('#data_rp').on('click','.btn_view',function(){ 
                var field_id = $(this).closest('tr').find('.id').text();
                window.open('<?php echo site_url('Request_production/view_Request_production/');?>'+'/'+ field_id  , '_blank');
            });

            $('#data_rp').on('click','.btn_view_sum',function(){ 
                var field_id = $(this).closest('tr').find('.id').text();
                window.open('<?php echo site_url('Request_production/view_summary_Request_production/');?>'+'/'+ field_id  , '_blank');
            });

            //แก้ไขข้อมูลก่อนผู้บริหารอนุมัติ
            $('#data_rp').on('click','.btn_edit_data',function(){ 
                var field_id = $(this).closest('tr').find('.id').text();
                window.open('<?php echo site_url('Request_production/gotoedit_Request_production/');?>'+'/'+ field_id  , '_blank');
            });

            $('#data_rp').on('click','.btn_comment',function(){
                var field_id = $(this).closest('tr').find('.id').text();
                window.open('<?php echo site_url('Request_production/summary_Request_production/');?>'+'/'+ field_id  , '_blank');
            });

        // -----------------------------------btn action

        // --------------------------editupload before

            // จัดการรูปภาพก่อนผู้บริหารอนุมัติ
            $('#data_rp').on('click','.btn_editupload',function(){ 
                var field_id = $(this).closest('tr').find('.id').text();
                $('#editupload_id').val(field_id);
                $('#edituploadModal').modal('show');
                get_editimg(field_id,'before');
            });

            $('.cancel_edituploadModal').click(function (){ 
                $('#editupload_id').val('');
                $('#file_edit').val('');
            });

            $('#edituploadModal').on('hidden.bs.modal', function (e) {
                $('#upload_id').val('');
                $('#file_edit').val('')
            });

            $('.links_file').on('click','.btn_delete_file',function(){ 
                var delete_id = $(this).closest('li').find('#delete_id').val();
                var delete_file_name = $(this).closest('li').find('#delete_file_name').val();
                delete_file(delete_id,delete_file_name);
            });

        // -----------------------ENDeditupload before


        // -----------------------upload after

            // เพิ่มรูปได้อย่างเดียว
            $('#data_rp').on('click','.btn_upload',function(){ 
                var field_id = $(this).closest('tr').find('.id').text();
                $('#upload_id').val(field_id);
                $('#uploadModal').modal('show');
                get_editimg(field_id,'after');
            });

            $('.cancel_uploadModal').click(function () { 
                $('#upload_id').val('');
                $('#file').val('');
            });

            $('#uploadModal').on('hidden.bs.modal', function (e) {
                $('#upload_id').val('');
                $('#file').val('')
            });

         // -----------------------------------backward

            $('#data_rp').on('click','.btn_backward',function()
            { 
                var id = $(this).closest('tr').find('.id').text();
                manage_confirm(id);
                $('#div_person_request_backward').removeClass('hidden');
                $('.div_request_backward').addClass('hidden');
                $('.div_ceo_backward').removeClass('hidden');
                $('.backward_request_comment').addClass('hidden');
                $('#backwardModal').modal('show');
            });

            $('#data_rp').on('click','.btn_backward_request',function()
            { 
                var id = $(this).closest('tr').find('.id').text();
                $('#name_request_backward').text('');
                // manage_confirm(id);
                $('#backward_rp_id').val(id);
                $('#div_person_request_backward').addClass('hidden');
                $('.div_ceo_backward').addClass('hidden');
                $('.backward_request_comment').removeClass('hidden');
                $('.div_request_backward').removeClass('hidden');
                $('#btn_requestbackward_submit').removeClass('hidden');
                $('#backwardModal').modal('show');
            });

            $('.btn_ceobackward_submit').click(function (e) { 
				e.preventDefault();
                var approve = $(this).attr("data-id");
                var id = $('#backward_rp_id').val();
                var comment = $('#backward_ceo_comment').val();
                rp_confirm(approve,id,comment);
			});

        // -----------------------------------END backward// -----------------------ENDupload after

        // -----------------------------------confirm

            $('#data_rp').on('click','.btn_confirm',function()
            { 
                var id = $(this).closest('tr').find('.id').text();
                manage_confirm(id);
                $('#confirmModal').modal('show');
            });
            
            $('#data_managerconfirm').on('click','.btn_managerconfirm_submit ',function(){
                // type 0 = เจ้าของ 
                // type 1 = ตัวแทน 
                
                console.log( $('#status_print').val());

                if ($('#status_print').val() == 0) {
                    swal({
                        title: 'ค้างพิมพ์ใบสั่งผลิต-ใบสั่งซ่อม',
                        text: "เนื่องจากพิมพ์แยกคุณต้องพิมพ์ให้ครบ",
                        type: 'warning',
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                    });
                }else{
                    var confirm_id = $(this).closest('tr').find('.manager_confirm_id').text();
                    var id = $(this).closest('tr').find('.rp_id').text();
                    var approve = $(this).attr("data-id");
                    var type = 0;
                    rp_pre_confirm(
                        confirm_id,
                        id ,
                        approve,
                        type
                    );
                }

            });

            $('#data_managerconfirm').on('click','.btn_managerconfirm_submit_instead ',function(){
                // type 0 = เจ้าของ 
                // type 1 = ตัวแทน 
                console.log( $('#status_print').val());
                if ($('#status_print').val() == 0) {
                    swal({
                        title: 'ค้างพิมพ์ใบสั่งผลิต-ใบสั่งซ่อม',
                        text: "เนื่องจากพิมพ์แยกคุณต้องพิมพ์ให้ครบ",
                        type: 'warning',
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                    });
                }else{
                    var confirm_id = $(this).closest('tr').find('.manager_confirm_id').text();
                    var id = $(this).closest('tr').find('.rp_id').text();
                    var approve = $(this).attr("data-id");
                    var type = 1;
                    rp_pre_confirm(
                        confirm_id,
                        id ,
                        approve,
                        type
                    );
                }
            });

            $('.btn_ceoconfirm_submit').click(function (e) { 
				e.preventDefault();
                var approve = $(this).attr("data-id");
                var id = $('#confirm_rp_id').val();
                var comment = $('#confirm_ceo_comment').val();
                rp_confirm(approve,id,comment);
			});

        // -----------------------------------END confirm

        $('#data_rp').on('click','.btn_print_first',function(){
            $('#print_first_Modal').modal('show');
            var id = $(this).closest('tr').find('.id').text();
            get_rp_detail(id)
        });	

        $('#data_rp').on('click','.btn_print',function(){
            swal({
                title: 'ต้องการพิมพ์ใบสั่งผลิต-สั่งซ่อม',
                text: 'ระบบจะทำการบันทึกจำนวนครั้งที่พิมพ์',
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1CC88A',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value) {
                    var id = $(this).closest('tr').find('.id').text();
                    window.open('<?php echo site_url('Request_production/print_rp');?>'+'/'+id);
                    search_input_1();
                }
            });
        });	


        // -----------------------------------receive

            $('#data_rp').on('click','.btn_receive',function(){

                var type = 4;
                var id = $(this).closest('tr').find('.id').text();
                var topic_depart = $(this).closest('tr').find('.topic_depart').text();

                get_view_rp(id, type);

                get_employee_depart(topic_depart);

                $('#receiveModal').modal('show');

            });

            $('#btn_receive_submit').click(function (e) { 
                e.preventDefault();
                swal({
                    title: 'คุณแน่ใจไหม',
                    text: 'การระบุพนักงานรับทำงาน',
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#1CC88A',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                    cancelButtonText: 'ปิด',
                }).then((result) => {
                    if (result.value) {	

                        var list_employee = [];
                        $.each($('#list_employee').val(), function (data, val) { 
                            var list_employees = {};
                            list_employees['employee_id'] = val;
                            list_employee.push(list_employees);
                        });

                        receive_rp(list_employee);

                    }
                });
            });

        // -----------------------------------END receive

        $('#data_rp').on('click','.btn_sum',function(){
            swal({
                title: 'คุณแน่ใจไหม',
                text: 'ต้องการพิมพ์ใบสรุปงาน',
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1CC88A',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value) {

                    var id = $(this).closest('tr').find('.id').text();

                    window.open('<?php echo site_url('Request_production/print_sum');?>'+'/'+id);
                   
                    search_input_1();
                }
            });
        });

    };

    function search_input_1() 
	{
		var search_text = '';
        var search_depart = '';
        var search_status = '';
        var search_doc_type = '';

        search_text = $('#search_text').val();
        search_depart = $('#search_depart').val();
        search_status = $('#search_status').val();
        search_doc_type = $('#search_doc_type').val();

        get_rp(
            search_text,
            search_depart,
            search_status,
            search_doc_type
        );
	};

    function search_input_2() 
	{
		var search_text = '';
        var search_depart = '';
        var search_status = '';
        var search_doc_type = '';

        search_text = $('#search_text').val();
        search_depart = $('#search_depart').val();
        search_status = $('#search_status').val();
        search_doc_type = $('#search_doc_type').val();
        $('#pageNumber').val(0);
        get_rp(
            search_text,
            search_depart,
            search_status,
            search_doc_type
        );
	};

    function get_depart(error_depart)
    {
        $.ajax({
            type:'GET',
            url:'<?= site_url('Request_production/get_depart')?>',
            dataType:'JSON',
            }).done(function(data){
                $('#search_depart').empty();
                $('#search_depart').append('<option value=""> ค้นหาตามแผนก </option>');
                $.each(data['depart'],function(id,val){
                    $('#search_depart').append('<option value="'+val['id']+'">'+val['name']+'</option>');
                });
            }).fail(function(data){
        });
    }

    function get_rp(
        search_text,
        search_depart,
        search_status,
        search_doc_type
    )
    { 

        var usersPerPage = parseInt($('#usersPerPage').val());
        var pageNumber = $('#pageNumber').val();
        
        $.ajax({
            type: "POST",
            url: "<?= site_url('Request_production/get_rp')?>",
            data : {
                pageNumber : pageNumber ,
                usersPerPage : usersPerPage,
                search_text : search_text,
                search_depart : search_depart,
                search_status : search_status,
                search_doc_type : search_doc_type
            },
            dataType: "JSON",
            success: function (data) {

                console.log(data)
                
                $('#data_rp').empty();
                $.each(data['rp_data'],function(id,val){

                //STATUS
                    var manager_status = '' ; 
                    var ceo_status = '' ; 
                    var work_status = '' ; 
                    var success_status = '' ; 
                    var all_status = '' ; 
                    var status_cost_estimate = '' ; 
                    var status_doc_type = '' ; 
                    var status = '';

                    var status_doc_type = '';
                    var status_cost_final =  '';
                    var field_manager_status = '';

                    $.each(data['manager_confirm'][id], function (id2, val2) { 
                         if (val2['field_approve'] == 0) {
                            field_manager_status += '&emsp;<span class="text-warning"><i class="fas fa-clock"></i> รอ'+val2['lastposition'] + ' ' + val2['firstname']+ '(' + val2['nickname'] + ') อนุมัติ' + '</span><br>';
                         }else if (val2['field_approve'] == 1) {
                            field_manager_status += '&emsp;<span class="text-success"><i class="fa fa-check-circle"></i> '+val2['lastposition'] + ' ' + val2['firstname']+ '(' + val2['nickname'] + ') อนุมัติแล้ว' + '</span><br>';
                            
                            if (val2['field_approve_date'] != null) {
                                field_manager_status += '&emsp;<small class="text-success">'+formatDatetime(val2['field_approve_date'])+'</small><br>';
                            }

                        }else if (val2['field_approve'] == 2) {
                            field_manager_status += '&emsp;<span class="text-danger"><i class="fa fa-times-circle"></i> '+val2['lastposition'] + ' ' + val2['firstname']+ '(' + val2['nickname'] + ') ไม่อนุมัติ' + '</span><br>';
                        }
                    });

                    status += field_manager_status;
                    status +=  val['ceo_status'].replace(',', '');
                    ceo_status +=  status.replace(',', '');
                    // work_status = val['work_status'];
                    // success_status = val['success_status'];

                    if(ceo_status != ''){
                        all_status +=  '<span class="badge bg-light"><i class="fa  fa-arrow-circle-down"></i> อนุมัติ</span>'+ '<br>' + ceo_status + '<br>' ;
                    }

                    if(val['work_status'] != ''){
                        all_status += '<span class="badge bg-light"><i class="fa  fa-arrow-circle-down"></i> ดำเนินงาน</span>'+ '<br>' + val['work_status'] + '<br>';
                    }

                    if(val['work_status'] != ''){
                        all_status += '<span class="badge bg-light"><i class="fa  fa-arrow-circle-down"></i> ตรวจรับงาน</span>'+ '<br>' + val['success_status']  +'<br>'+ val['request_backward_status'];
                    }

                    status_doc_type =  val['doc_type_status'];
              
                    status_cost_estimate = val['rp_cost_estimate_status'];
                    
                    status_cost_final =  val['rp_cost_final_status'];
                      
                //END STATUS

                //ACTION
                    var btn_view = '';   
                    var btn_edit = '';  
                    var btn_upload = '';  
                    var btn_confirm = '';
                    var btn_print = '';
                    var btn_del = '';
                    // var btn_history = '';
                    var btn_sum = '';
                    var btn_receive = '';
                    var btn_comment = '';
                    var btn_backward = '';
                    var btn_view_sum = '';
                    var row_color = '';
                    var text_color = '';

                    btn_view = '<button class="btn btn-info btn_view btn-sm" type="button" > <i class="fa fa-info-circle"></i> </button> ';
                   
                    
                    if(val['field_rp_status'] == 0){ //รออนุมัติ
                       

                        btn_edit = '<button class="btn btn-warning btn_edit_data btn-sm" type="button" > <small class="badge bg-warning border border-light">1</small> <i class="fa fa-edit"></i> </button> ';

                        btn_upload = '<button class="btn btn-primary btn_editupload btn-sm" type="button" title="เพิ่ม-แก้ไข รูป"> <small class="badge bg-primary border border-light">1</small> <i class="fa fa-image " aria-hidden="true"></i> </button> ';

                        btn_confirm = '<button class="btn btn-primary btn_confirm btn-sm" type="button" title="จัดการใบสั่งผลิต-ใบสั่งซ่อม">  <small class="badge bg-primary border border-light">2</small> <i class="fa fa fa-user-cog"></i></i></button> ';

                        btn_print = '<button class="btn btn-primary btn_print_first btn-sm" type="button" title="พิมพ์ใบสั่งผลิต-ใบสั่งซ่อม (ก่อนอนุมัติ)"><small class="badge bg-primary border border-light">1</small> <i class="fa fa-print " aria-hidden="true"></i>  </button> ';
                    }else if(val['field_rp_status'] == 8){  //ผู้บริหารสั่งแก้

                        btn_edit = '<button class="btn btn-warning btn_edit_data btn-sm" type="button" > <small class="badge bg-warning border border-light">1</small> <i class="fa fa-edit"></i> </button> ';
                        
                        btn_upload = '<button class="btn btn-primary btn_editupload btn-sm" type="button" title="เพิ่ม-แก้ไข รูป"> <small class="badge bg-primary border border-light">1</small> <i class="fa fa-image " aria-hidden="true"></i> </button> ';

                        btn_confirm = '<button class="btn btn-primary btn_confirm btn-sm" type="button" title="จัดการใบสั่งผลิต-ใบสั่งซ่อม"> <small class="badge bg-primary border border-light">2</small> <i class="fa fa fa-user-cog"></i></i></button> ';

                        // btn_print = '<button class="btn btn-primary btn_print_first btn-sm" type="button" title="พิมพ์ใบสั่งผลิต-ใบสั่งซ่อม (ก่อนอนุมัติ)"><small class="badge bg-primary border border-light">1</small> <i class="fa fa-print " aria-hidden="true"></i>  </button> ';

                    }else if(val['field_rp_status'] == 1){
                       
                        btn_receive = '<button class="btn btn-primary btn_receive btn-sm" type="button" > <small class="badge bg-primary border border-light">3</small> <i class="fa fa-male " aria-hidden="true"></i></button> ';

                        // btn_print = '<button class="btn btn-primary btn_print_first btn-sm" type="button" title="พิมพ์ใบสั่งผลิต-ใบสั่งซ่อม (ก่อนอนุมัติ)"><small class="badge bg-primary border border-light">1</small> <i class="fa fa-print " aria-hidden="true"></i>  </button> ';
                        // btn_upload = '<button class="btn btn-primary btn_upload btn-sm" type="button" title="เพิ่มรูป"> <small class="badge bg-primary border border-light">4</small> <i class="fa fa-image " aria-hidden="true"></i> </button> ';

                        // btn_print = '<button class="btn btn-primary btn_print btn-sm" type="button" title="พิมพ์ใบสั่งผลิต-ใบสั่งซ่อม"> <small class="badge bg-primary border border-light">3</small> <i class="fa fa-print " aria-hidden="true"></i>  </button> ';

                        // btn_backward = '<button class="btn btn-warning btn_backward btn-sm" type="button" title="ถอยเอกสาร"> <small class="badge bg-warning border border-light">1</small> <i class="fa fa-arrow-left " aria-hidden="true"></i> <i class="fa fa-backward " aria-hidden="true"></i> </button> ';
                       
                    }else if(val['field_rp_status'] == 2){

                        btn_comment = '<button class="btn btn-primary btn_comment btn-sm" type="button" > <small class="badge bg-primary border border-light">4</small> <i class="fa  fa-cube " aria-hidden="true"></i> </button> ';
                        
                        btn_upload = '<button class="btn btn-primary btn_upload btn-sm" type="button" title="เพิ่มรูป"> <small class="badge bg-primary border border-light">4</small> <i class="fa fa-image " aria-hidden="true"></i> </button> ';
                    
                        // btn_print = '<button class="btn btn-primary btn_print btn-sm" type="button" title="พิมพ์ใบสั่งผลิต-ใบสั่งซ่อม"><small class="badge bg-primary border border-light">3</small> <i class="fa fa-print " aria-hidden="true"></i>  </button> ';

                        // btn_backward = '<button class="btn btn-warning btn_backward btn-sm" type="button" title="ถอยเอกสาร"> <small class="badge bg-warning border border-light">1</small> <i class="fa fa-arrow-left " aria-hidden="true"></i> <i class="fa fa-backward " aria-hidden="true"></i> </button> ';
                       
                    }else if(val['field_rp_status'] == 4 || (val['field_rp_status'] == 7) ) {

                        btn_view = '<button class="btn btn-info btn_view_sum btn-sm" type="button" > <i class="fa fa-info-circle"></i> </button> ';

                        // btn_sum  = '<button class="btn btn-primary btn_sum btn-sm" type="button" title="พิมพ์ใบสรุปงาน"><i class="fa fa-check-circle" aria-hidden="true"></i> <i class="fa fa-print " aria-hidden="true"></i></button> ';

                        // btn_print = '<button class="btn btn-primary btn_print_first btn-sm" type="button" title="พิมพ์ใบสั่งผลิต-ใบสั่งซ่อม (ก่อนอนุมัติ)"><small class="badge bg-primary border border-light">1</small> <i class="fa fa-print " aria-hidden="true"></i>  </button> ';
                    }else if(val['field_rp_status'] == 5 || (val['field_rp_status'] == 6)) {

                    
                    }else if(val['field_rp_status'] == 9){//ผู้บริหารสั่งแก้
                        // btn_print = '<button class="btn btn-primary btn_print_first btn-sm" type="button" title="พิมพ์ใบสั่งผลิต-ใบสั่งซ่อม (ก่อนอนุมัติ)"><small class="badge bg-primary border border-light">1</small> <i class="fa fa-print " aria-hidden="true"></i>  </button> ';

                        btn_edit = '<button class="btn btn-warning btn_edit_data btn-sm" type="button" > <small class="badge bg-warning border border-light">1</small> <i class="fa fa-edit"></i> </button> ';

                        btn_upload = '<button class="btn btn-primary btn_editupload btn-sm" type="button" title="เพิ่ม-แก้ไข รูป"> <small class="badge bg-primary border border-light">1</small> <i class="fa fa-image " aria-hidden="true"></i> </button> ';

                        btn_confirm = '<button class="btn btn-primary btn_confirm btn-sm" type="button" title="จัดการใบสั่งผลิต-ใบสั่งซ่อม"> <small class="badge bg-primary border border-light">2</small> <i class="fa fa fa-user-cog"></i></i></button> ';

                        btn_print = '<button class="btn btn-primary btn_print_first btn-sm" type="button" title="พิมพ์ใบสั่งผลิต-ใบสั่งซ่อม (ก่อนอนุมัติ)"><small class="badge bg-primary border border-light">1</small> <i class="fa fa-print " aria-hidden="true"></i>  </button> ';
                      
                    }else{
                        
                        btn_confirm = '<button class="btn btn-primary btn_confirm btn-sm" type="button" title="จัดการใบสั่งผลิต-ใบสั่งซ่อม"> <small class="badge bg-primary border border-light">2</small> <i class="fa fa fa-user-cog"></i></i></button> ';

                        // btn_print = '<button class="btn btn-primary btn_print btn-sm" type="button" title="พิมพ์ใบสั่งผลิต-ใบสั่งซ่อม"><small class="badge bg-primary border border-light">3</small> <i class="fa fa-print " aria-hidden="true"></i>  </button> ';
                        
                    }

                //END ACTION

                if(val['data_duedate_3_day'] == 'duedate'){
					row_color = 'table-warning';
                    text_color = '';

				}

                if(val['field_rp_status'] == 1 || val['field_rp_status'] == 2 || val['field_rp_status'] == 4 || val['field_rp_status'] == 7) {
                    if (val['field_request_backward_status'] == 0) {
                        <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Request_Backward"])) :?>
                            btn_backward = '<button class="btn btn-warning btn_backward_request btn-sm" type="button" title="ขอถอยเอกสาร"> <small class="badge bg-warning border border-light">1</small> <i class="fa fa-arrow-left " aria-hidden="true"></i> <i class="fa fa-backward " aria-hidden="true"></i> </button> ';
                        <?php endif; ?>
                        
                    }else{

                        <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Backward"])) :?>
                            btn_backward = '<button class="btn btn-primary btn_backward btn-sm" type="button" title="ถอยเอกสาร"> <small class="badge bg-primary border border-light">1</small> <i class="fa fa-arrow-left " aria-hidden="true"></i> <i class="fa fa-backward " aria-hidden="true"></i> </button> ';
                        <?php endif; ?>
                       
                    
                    }
                }

                $.each(data['manager_confirm'][id], function (id2, val2) { 
                        if (val2['field_approve'] == 0) {
                        }else if (val2['field_approve'] == 1) {
                            btn_upload = '';
                        if (val2['field_approve_date'] != null) {
                        }
                    }else if (val2['field_approve'] == 2) {
                    }
                });

                $('#data_rp').append(
                    '<tr class="'+row_color+'">'+ 

                        '<td class="hidden id">'+val['field_id']+'</td>'+
                        '<td class="hidden topic_depart">'+val['topic_depart']+'</td>'+

                        '<td class="text-left"  >'+ status_doc_type + '<br>'+val['field_docno']+'</td>'+
                        '<td class="text-left"  >'+ 
                            '<b>' + val['topic_name'] + '</b>'  + 
                            '<br>' + 
                            val['field_rp_name'] +
                            '<br>' + 
                            '<small class="text-muted">' + 'สั่งทำโดย :' + val['ecfullname'] + '<small>' +
                        '</td>'+
                        '<td class="text-left"  >'+ status_cost_estimate + '<br>' + status_cost_final +'</td>'+
                        '<td class="text-left"  >'+ all_status +'</td>'+
                        '<td class="text-left"  >'+ 

                            btn_view + 

                            <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Edit"])) :?>
                                btn_edit + 
                            <?php endif; ?>

                            <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Receive"])) :?>
                                btn_receive + 
                            <?php endif; ?>

                            <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Print_rp"])) :?>
                                btn_print + 
                            <?php endif; ?>

                            <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Summary"])) :?>
                                btn_comment + 
                            <?php endif; ?>

                            <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Upload"])) :?>
                                btn_upload + 
                            <?php endif; ?>
                           
                                btn_confirm + 

                            <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Print_rp_summary"])) :?>
                                btn_sum + 
                            <?php endif; ?>
                            btn_backward+

                        '</td>'+
                    '</tr>'
                    );
                });

                $('.pagination').empty();
                    var totalrp = (Math.ceil(parseInt(data['totalrp']) / parseInt(usersPerPage)));
                    if(parseInt(pageNumber) > 5){
                        $('.pagination').append('<li><button class="pageNumber">1</button></li>');
                        $('.pagination').append('<li><button class="pageNumber" disabled>...</button></li>');
                    }
                    for (var i = 1; i <= totalrp; i++) {
                        if(parseInt(pageNumber)-5 < i && parseInt(pageNumber)+7 > i){
                        if(parseInt(pageNumber)+1 == i){
                            $('.pagination').append('<li><button class="pageNumber active">'+i+'</button></li>');
                        }else{
                            $('.pagination').append('<li><button class="pageNumber">'+i+'</button></li>');
                            }
                        }   
                    }
                    if(parseInt(pageNumber) < totalrp-6){
                    $('.pagination').append('<li><button class="pageNumber" disabled>...</button></li>');
                    $('.pagination').append('<li><button class="pageNumber">'+totalrp+'</button></li>');
                }
            }
        });
    }; 

    function get_view_rp(id,type)
    {

        $.ajax({
            type: "POST",
            url: "<?= site_url('Request_production/get_view_rp')?>",
            dataType: "JSON",
            data : {
                id : id
            },
            success: function(data){

                console.log(data)
                
                if(type == 4){

                    $('#receive_rp_id').val(data['request_production']['field_id']);
                    $('#receive_rp_docno').text(data['request_production']['field_docno']);
                    $('#receive_rp_name').text(data['request_production']['field_rp_name']);

                }else if(type == 5){

                    $('#comment_rp_id').val(data['request_production']['field_id']);
                    $('#comment_rp_docno').text(data['request_production']['field_docno']);
                    $('#comment_rp_name').text(data['request_production']['field_rp_name']);

                }

            } ,
            error: function(data){
                swal({
                    title: 'ERROR',
                    text: "เกิดข้อผิดพลาดบางอย่าง",
                    type: 'error',
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                });
            }
            
        });
    };

    function get_rp_detail(id)
    {

        $.ajax({
            type: "POST",
            url: "<?= site_url('Request_production/get_view_rp')?>",
            dataType: "JSON",
            data : {
                id : id
            },
            success: function(data){

                $('#field_id_print').val(id);

                console.log(data);
                var labor_type = 0;
                var item_type = 0;
                var all_type = 0;

                if (data['itemlist'].length > 0) {
                    labor_type = 1;
                }else{
                    labor_type = 0;
                }

                if (data['laborlist'].length > 0){
                    item_type = 1;
                }else{
                    item_type = 0;
                }
                
                if (data['laborlist'].length == 0 || data['itemlist'].length == 0) {
                     type = 1;
                    // show_select_print_type(type)
                }else if (data['laborlist'].length > 0 && data['itemlist'].length > 0) {
                    var type = 2;
                }

                show_select_print_type(type,data['request_production']['field_labor_print'],labor_type,data['request_production']['field_item_print'],item_type,data['request_production']['field_laboritem_print'],all_type)
            } ,
            error: function(data){
                swal({
                    title: 'ERROR',
                    text: "เกิดข้อผิดพลาดบางอย่าง",
                    type: 'error',
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                });
            }
            
        });
    };

    function show_select_print_type(type,labor,labor_type,item,item_type,all,all_type) {  
        $('#select_print_type').empty();
        $('#div_status_print').empty();
        hidden_div_all();

        var print_status = '';

        var type_print = 0;

        if (all == '0' && labor == '0' && item == '0') {
            print_status = '<span class="text-warning"><i class="fas fa-clock"></i> ยังไม่ได้พิมพ์</span>';

            type_print = 3;
            
        }else if (all == '0' && labor == '1' && item == '0') {
            print_status = '<span class="text-success"><i class="fa fa-check-circle"></i> พิมพ์ค่าบริการเรียบร้อย</span>';
            print_status += '<br><span class="text-warning"><i class="fas fa-clock"></i> รอพิมพ์ค่าวัสดุ</span>';

            type = 3;

            type_print = 2;

        }else if (all == '0' && labor == '0' && item == '1') {
            print_status = '<span class="text-warning"><i class="fas fa-clock"></i> รอพิมพ์ค่าบริการ</span>';
            print_status += '<br><span class="text-success"><i class="fa fa-check-circle"></i> พิมพ์ค่าวัสดุเรียบร้อย</span>';

            type = 3;

            type_print = 1;

        }else if (all == '0' && labor == '1' && item == '1') {
            print_status = '<span class="text-success"><i class="fa fa-check-circle"></i> พิมพ์ค่าบริการเรียบร้อย</span>';
            print_status += '<br><span class="text-success"><i class="fa fa-check-circle"></i> พิมพ์ค่าวัสดุเรียบร้อย</span>';

            type = 3;
            
        }else if (all == '1' && labor == '0' && item == '0') {
            print_status = '<span class="text-success"><i class="fa fa-check-circle"></i> พิมพ์รวมเรียบร้อย</span>';

            type = 1;
        }

        // if (type == 1) {
        //     $('#select_print_type').append(
        //         '<option value="1">พิมพ์รวม</option>'
        //     );
           
        // }else if (type == 2) {
        //     $('#select_print_type').append(
        //         '<option value="1">พิมพ์รวม</option>'+
        //         '<option value="2">พิมพ์แยก</option>'
        //     );

        // }else if (type == 3) {
        //     $('#select_print_type').append(
        //         '<option value="2">พิมพ์แยก</option>'
        //     );
        // }

        if (type_print == 3 && type == 1) {
            $('#div_laboritem_print').removeClass('hidden');
        }else if (type_print == 1 && type == 3) {
            $('#div_labor_print').removeClass('hidden');
        }else if (type_print == 2 && type == 3) {
            $('#div_item_print').removeClass('hidden');
        }else if (type_print == 3 && type == 2) {
            $('#div_labor_print').removeClass('hidden');
            $('#div_item_print').removeClass('hidden');
            $('#div_laboritem_print').removeClass('hidden');
        }

        $('#div_status_print').append(print_status);
    }

    function hidden_div_all() {  
        $('#div_labor_print').addClass('hidden');
        $('#div_item_print').addClass('hidden');
        $('#div_laboritem_print').addClass('hidden');
    }


    function update_requestbackward() {  
        var field_id = $('#backward_rp_id').val();
        var comment = $('#backward_request_comment').val();

        $.ajax({
            type: "post",
            url:'<?= site_url('Request_production/update_requestbackward')?>',
            data: {
                field_id : field_id,
                comment : comment
            },
            dataType: "json",
        }).done(function(data){
            swal({ 
                title: 'สำเร็จ',
                text: "คุณขอถอยเอกสารเรียบร้อย",
                type: 'success',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            }).then((result) => {
                if (result.value) {
                    var search_text = '';
                    var search_depart = '';
                    var search_status = '';
                    var search_doc_type = '';

                    search_text = $('#search_text').val();
                    search_depart = $('#search_depart').val();
                    search_status = $('#search_status').val();
                    search_doc_type = $('#search_doc_type').val();
                    $('#pageNumber').val(0);
                    get_rp(
                        search_text,
                        search_depart,
                        search_status,
                        search_doc_type
                    );

                    $('#backwardModal').modal('hide');
                }
            });
        }).fail(function(data){
            swal({
                title: 'ERROR',
                text: "เกิดข้อผิดพลาดบางอย่าง",
                type: 'error',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            });
        });
    }

    function manage_confirm(id)
    {
        
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/get_manage_confirm')?>',
            data : {
                id : id
            },
            dataType:'JSON',
        }).done(function(data){

            console.log(data)

            var status_print = 1;

            if (data['data_rp']['field_labor_print'] == 0 && data['data_rp']['field_item_print'] == 0) {
                status_print = 1;
            }else if (data['data_rp']['field_labor_print'] == 1 && data['data_rp']['field_item_print'] == 1) {
                status_print = 1;
            }else if (data['data_rp']['field_labor_print'] == 1 && data['data_rp']['field_item_print'] == 0) {
                status_print = 0;
            }else if (data['data_rp']['field_labor_print'] == 0 && data['data_rp']['field_item_print'] == 1) {
                status_print = 0;
            }

            $('#status_print').val(status_print);

            if (data['data_rp']['field_request_backward_status'] == 1)  {
                $('.div_request_backward').removeClass('hidden');
                $('#backward_request_comment').val(data['data_rp']['field_request_backward_comment']);
                $('#btn_requestbackward_submit').addClass('hidden');
            }

            $('#data_managerconfirm').empty();
            $.each(data['data_preconfirm'], function (id,val) { 

                var btn_action = '';
                var btn_confirm = '';
                var btn_cancel = '';
                var btn_confirm_instead = '';
                var btn_cancel_instead = '';
                var data_confirm_id = <?= $_SESSION['saeree_employee'] ?> ;

                if(data_confirm_id == val['field_employee_id']){
                    <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Approve_group_2"])) :?>
                    btn_confirm = '<span class="col-md-6"><button type="button" class="btn btn-success   btn_managerconfirm_submit" data-id="1" > อนุมัติ </button></span>';
                    btn_cancel = '<span class="col-md-6"><button type="button" class="btn btn-success  btn_managerconfirm_submit " data-id="2"> ไม่อนุมัติ </button></span>';  
                    <?php endif; ?>
                }
               
                if(!btn_confirm){
                    <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Approve_instead"])) :?>
                        btn_confirm_instead = '<br><span class="col-md-6"><button type="button" class="btn btn-primary   btn_managerconfirm_submit_instead" data-id="1" > อนุมัติแทน </button></span>';
                        btn_cancel_instead = '<span class="col-md-6"><button type="button" class="btn btn-primary  btn_managerconfirm_submit_instead " data-id="2"> ไม่อนุมัติแทน </button></span>';  
                    <?php endif; ?>
                }

                if(val['field_approve'] == 0 ){
                    btn_action  = btn_confirm + btn_cancel  ; 
                    btn_action  += btn_confirm_instead + btn_cancel_instead  ; 
                }

                $('#data_managerconfirm').append(
                '<tr>'+
                    '<td class="hidden manager_confirm_id">'+ val['field_id'] +'</td>'+
                    '<td class="hidden rp_id">'+ val['field_rp_id'] +'</td>'+
                    '<td class="col-md-4">' + val['approve_status'] + '<br>' + '<b>' + val['lastposition'] + '</b> <br>' + val['fullname'] +'</td>'+
                    '<td class="col-md-4">' + btn_action +'</td>'+
                '</tr>'
                );
            });
            

            $('#confirm_rp_id').val(data['data_rp']['field_id']);
            $('#confirm_ceoconfirm_status').html(data['data_rp']['approve_status']);

            $('#backward_rp_id').val(data['data_rp']['field_id']);
            $('#backward_ceoconfirm_status').html(data['data_rp']['approve_status']);
        

        }).fail(function(data){

        });
    };

    function rp_pre_confirm(confirm_id,id ,approve,type) 
    { 
		
		var alert_text = '';
		if(approve == 1 ){
			alert_text = 'การอนุมัติใบสั่งผลิต/ใบสั่งซ่อม';
		}else if(approve == 2){
			alert_text = 'ยกเลิกอนุมัติใบสั่งผลิต/ใบสั่งซ่อม';
		}


		swal({
            title: 'คุณแน่ใจไหม',
			text: alert_text,
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#1CC88A',
			cancelButtonColor: '#6c757d',
			confirmButtonText: 'ใช่ ,ฉัน ตกลง',
			cancelButtonText: 'ปิด',

		}).then((result) => {
			if (result.value) {

				$.ajax({
					type: "POST",
					url: "<?= site_url('Request_production/pre_confirm')?>",
					data: {
						manager_id : confirm_id,
						rp_id : id,
						pre_confirm : approve ,
						type : type
					},
					dataType: "JSON",
			
					success: function (data) {
						
						swal({ 
                            title: 'สำเร็จ',
                            text: 'คุณบันทึกข้อมูลสำเร็จ',
                            type: 'success',
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
						}).then((result) => {
							if (result.value) {
                                manage_confirm(id);
                                search_input_1();
							}  
						});

					} ,
                    error : function (data) {
                        
                        $('#confirmModal').modal('hide');
                        
                        swal({
                            title: 'ERROR',
                            text: "เกิดข้อผิดพลาดบางอย่าง",
                            type: 'error',
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        });
                    }
				});

			}
		});

    };

    function rp_confirm(
        approve,
        id,
        comment
        )
    {
		var alert_text = '';
		if(approve == 1){
			alert_text = 'ต้องการอนุมัติใบสั่งผลิต-สั่งซ่อม';
		}else if(approve == 8){
			alert_text = 'ต้องการให้ปรับแก้ไข';
		}else if(approve == 5){
			alert_text = 'ไม่อนุมัติใบสั่งผลิต-สั่งซ่อม';
		}

		swal({
            title: 'คุณแน่ใจไหม',
			text: alert_text,
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#1CC88A',
			cancelButtonColor: '#6c757d',
			confirmButtonText: 'ใช่ ,ฉัน ตกลง',
			cancelButtonText: 'ปิด',
		}).then((result) => {
			if (result.value) {

				$.ajax({
					type: "POST",
					url: "<?= site_url('Request_production/rp_confirm')?>",
					data: {
						id : id,
						comment : comment,
                        ceo_confirm : approve
					},
					dataType: "JSON",
					success: function (data) {


                       
						swal({ 
                            title: 'สำเร็จ',
                            text: 'คุณบันทึกข้อมูลสำเร็จ',
                            type: 'success',
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
						}).then((result) => {
							if (result.value) {
                                manage_confirm($('.confirm_rp_id').val())

                                $('#confirmModal').modal('hide');
                                $('#backwardModal').modal('hide');
                                search_input_1();


							}  
						});
					},
                    error : function (data) {
                        
                        $('#confirmModal').modal('hide');
                        $('#backwardModal').modal('hide');

                        swal({
                            title: 'ERROR',
                            text: "เกิดข้อผิดพลาดบางอย่าง",
                            type: 'error',
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        });
                    }
				});             

			}
		});

    };
    
    function get_employee_depart(topic_depart)
    {

        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/get_employee_depart')?>',
            dataType:'JSON',
            data:{ 
                topic_depart : topic_depart 
            },
        }).done(function(data){

            // console.log(data)

            $('.employee_id').empty();
            $('.employee_id').append('<option value="">เลือกพนักงาน</option>');
            $('.select2-selection__choice').remove();
            $.each(data['employee'],function(id,val){
                $('.employee_id').append('<option value="'+val['id']+'">'+val['pepleid']+' '+val['firstname']+' ('+val['nickname']+')</option>');
            });

        }).fail(function(data){
        });
    }

    function receive_rp(list_employee)
    {
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/receive_rp')?>',
            dataType:'JSON',
            data : {
                id : $('#receive_rp_id').val(),
                list_employee : list_employee
            },
        }).done(function(data){

            $('#receiveModal').modal('hide');

            swal({ 
                title: 'สำเร็จ',
                text: 'คุณระบุพนักงานรับทำงานสำเร็จ',
                type: 'success',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            }).then((result) => {
                if (result.value) {

                    search_input_1();

                    clear_input_receive() 
                }  
            });

         

        }).fail(function(data){

            $('#receiveModal').modal('hide');
            swal({
				title: 'ERROR',
				text: "เกิดข้อผิดพลาดบางอย่าง",
				type: 'error',
				confirmButtonColor: '#6c757d',
				confirmButtonText: 'ปิด' ,
			});
        });
    };

    function clear_input_receive() 
	{
        $('#list_employee').val(null).trigger('change');

		$('#receive_rp_id').val('');
        $('#receive_rp_docno').text('');
        $('#receive_rp_name').text('');

        $('#employee_id').val('');

		$('#employee_id').css('border','');

	};

    function upload_file_before() 
    {
        
        $("#edituploadimage").on('submit',(function(e){
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('Request_production/editupload_image')?>", 
                type: "POST",             
                data: new FormData(this), 
                contentType: false,      
                cache: false,
                processData:false,
                dataType: "JSON",  
            success: function(data){

                if(data['check_pic'] == 'error_data_type' ){
                        swal({
                            title: 'เตือน',
                            text: "ขนาดไฟล์เอกสารไม่ถูกต้อง",
                            type: 'warning' ,
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        });
                }else if(data['check_pic'] == 'maxvalue' ){

                    swal({
                        title: 'เตือน',
                        text: "เพิ่มเอกสารเต็มจำนวนที่กำหนดแล้ว",
                        type: 'warning' ,
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                    });

                }else if(data['check_pic'] == 'maxvalue_more' ){

                    $('#edituploadModal').modal('hide');

                    swal({ 
                        title: 'สำเร็จ',
                        text: 'เพิ่มได้ 2 ไฟล์เท่านั้น',
                        type: 'success',
                        confirmButtonColor: '#6c757d',
					    confirmButtonText: 'ปิด' ,
                    }).then((result) => {
                    if (result.value) {

                        $('#editupload_id').val('');
                        $('#file_edit').val('');

                        search_input_1();
                    }
                    });


                }else if(data['check_pic'] == 'error_data_file'){
                        swal({
                            title: 'เตือน',
                            text: "ไพล์เอกสารมีปัญหา",
                            type: 'warning' ,
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        });
                }else if(data['check_pic'] == 'success'){

                    $('#edituploadModal').modal('hide');

                    swal({ 
                        title: 'สำเร็จ',
                        text: 'เพิ่มเอกสารสำเร็จ',
                        type: 'success',
                        confirmButtonColor: '#6c757d',
					    confirmButtonText: 'ปิด' ,
                    }).then((result) => {
                    if (result.value) {

                        $('#editupload_id').val('');
                        $('#file_edit').val('');
                        
                        search_input_1();
                    }
                    });
                }
            }
        });
        }));
       

    };

    function export_rp(type) {  

        var id = $('#field_id_print').val();
        window.open('<?php echo site_url('Request_production/print_rp_first');?>'+'?id='+id+'&type='+type+'');

        $('#print_first_Modal').modal('hide');
    }

    function upload_file_after() 
    {
        $(document).ready(function(e){
            $("#uploadimage").on('submit',(function(e){
                e.preventDefault();
                $.ajax({
                url: "<?= site_url('Request_production/upload_image')?>", 
                type: "POST",             
                data: new FormData(this), 
                contentType: false,      
                cache: false,
                processData:false,    
                dataType: "JSON",  
                success: function(data){

                    if(data['check_pic'] == 'error_data_type' ){
                            swal({
                                title: 'เตือน',
                                text: "ขนาดไฟล์เอกสารไม่ถูกต้อง",
                                type: 'warning' ,
                                confirmButtonColor: '#6c757d',
                                confirmButtonText: 'ปิด' ,
                            });
                    }else if(data['check_pic'] == 'maxvalue' ){

                        swal({
                            title: 'เตือน',
                            text: "เพิ่มเอกสารเต็มจำนวนที่กำหนดแล้ว",
                            type: 'warning' ,
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        });

                    }else if(data['check_pic'] == 'maxvalue_more' ){

                        $('#uploadModal').modal('hide');

                        swal({ 
                            title: 'สำเร็จ',
                            text: 'เพิ่มได้ 2 ไฟล์เท่านั้น',
                            type: 'success',
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        }).then((result) => {
                        if (result.value) {

                            $('#upload_id').val('');
                            $('#file').val('');
                            
                            search_input_1();
                        }
                        });


                    }else if(data['check_pic'] == 'error_data_file'){
                            swal({
                                title: 'เตือน',
                                text: "ไพล์เอกสารมีปัญหา",
                                type: 'warning' ,
                                confirmButtonColor: '#6c757d',
                                confirmButtonText: 'ปิด' ,
                            });
                    }else if(data['check_pic'] == 'success'){

                        $('#uploadModal').modal('hide');

                        swal({ 
                            title: 'สำเร็จ',
                            text: 'เพิ่มเอกสารสำเร็จ',
                            type: 'success',
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        }).then((result) => {
                        if (result.value) {

                            $('#upload_id').val('');
                            $('#file').val('');
                            
                            search_input_1();
                        }
                        });
                    }
                    
                }
            });
            }));
        });
    };

    function check_file_upload() 
    {
        $(function()
        {
            $("#file").change(function() {
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/jpg","application/pdf"];
                if(!((imagefile==match[0]) || (imagefile==match[1])  || (imagefile==match[2]))){
                    swal({
                        title: 'เตือน',
                        text: "ไพล์เอกสารมีปัญหา",
                        type: 'warning' ,
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                    });
                    document.getElementById("file").value = '';
                    return false;
                }else{
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    };

    function imageIsLoaded(e)
    {
        $("#file").css("color","green");
    };

    function get_image(id)
    {
		$('#links').empty();
		$.ajax({
			type:'POST',
			url:'<?= site_url('Request_production/get_image')?>',
			dataType:'JSON',
			data:{id:id},
		}).done(function(data){
			if(data){

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

    function get_editimg(field_id,type)
    {
    
		$('.links_file').empty();
		
		$.ajax({
		type:'POST',
		url:'<?= site_url('Request_production/get_editimg')?>',
		dataType:'JSON',
		data:{
            field_id : field_id
        },
		}).done(function(data){
	
            if(data){
                $.each(data['scandir'],function(ids,val){

                    var btn_del = '';
                
                    if(val != '.' && val != '..'){
                        var url = '<?= base_url('assets/images/Request_production/')?>/'+field_id+'/'+val

                        if(type == 'before'){
                            btn_del =  '<a class="users-list-name btn_delete_file" id="btn_delete_file">ลบไฟล์</a>';
                            btn_del += '<input type="hidden" name="delete_id" id="delete_id" value="'+ field_id +'">';
                            btn_del += '<input type="hidden" name="delete_file_name" id="delete_file_name" value="'+ val +'">';
                        }
                        
                        $('.links_file').append(
                        '<li>'+
                            '<a target="_blank" href="'+url+'" >'+
                                '<img src="'+url+'" width="100"  >'+
                                btn_del +
                            '</a>' +
                        '</li>'
                        );
                    }
                });
		    }

		}).fail(function(data){
		
		});

    };
    
    function delete_file(
        delete_id,
        delete_file_name
    )
    {
		$.ajax({
		type:'POST',
		url:'<?= site_url('Request_production/delete_file')?>',
		data :{
            field_id : delete_id,
            field_name : delete_file_name
        },
		dataType:'JSON',
		}).done(function(data){
		
		$('#uploadModal').modal('hide');
			swal({
			title: 'สำเร็จ',
			text: "ลบไฟล์เอกสารสำเร็จ",
			type: 'success' ,
			confirmButtonColor: '#6c757d',
			confirmButtonText: 'ปิด' ,
			}).then((result) => {
			if (result.value) {
                get_editimg(delete_id);
                search_input_1();
			}
			});

		}).fail(function(data){
		
		});

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


</script>