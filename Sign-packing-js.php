

<script type="text/javascript">
    $(document).ready(function () {
        all_click();
        select2();
        get_groupcode();
        confirm_sign_type_price();
        confirm_sign_size();
        get_sign_packing();
        get_sign_packing_do();

        all_hide();

    });

    function all_clear_valid() {  
        $('#input_reprint_comment').removeClass('is-invalid');
        $('#input_reprint_comment').removeClass('is-valid');
    }

    function all_hide(){
        if($('#tbody_sign_packing_do').hasClass('select')){
            $('#success_packing').removeClass('hidden');
            $('#success_recive').removeClass('hidden');
            $('#reprint').removeClass('hidden');
        }else{
            $('#success_packing').addClass('hidden');
            $('#success_recive').addClass('hidden');
            $('#reprint').addClass('hidden');
            // $('#success_packing').addClass('hidden');
        }
    };

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

        $( "#usersPerPage1" ).select2({
            theme: "bootstrap4"
        });

        $( "#usersPerPage2" ).select2({
            theme: "bootstrap4"
        });

        $( "#search_status_do" ).select2({
            theme: "bootstrap4"
        });

    }

    function all_click() {

        $(document).on('click','.pageNumber2',function(){
			$('#pageNumber2').val($(this).text()-1);
            get_sign_packing_do(); 
        });

        $(document).on('click','.pageNumber1',function(){
			$('#pageNumber1').val($(this).text()-1);
            get_sign_packing(); 
        });

        $('#btn_refresh').click(function (e) { 
            e.preventDefault();
            $('#pageNumber1').val(0);
			get_sign_packing(); 
        });

        $('#btn_refresh_do').click(function (e) { 
            e.preventDefault();
            $('#pageNumber2').val(0);
			get_sign_packing_do(); 
        });


        $('#tbody_sign_packing_do').delegate('tr', 'click', function(e) {
            if($(this).hasClass('select')){
                $(this).removeClass('select');
                $('#dataSelect tr#'+$(this).attr('id')).remove();
                if($('#sign_packing_do tbody tr.select').length == 0){
                    $('#success_packing').addClass('hidden');
                    $('#success_recive').addClass('hidden');
                    $('#reprint').removeClass('hidden');
                    // $('#reprint').addClass('hidden');
                }
            }else{
                $(this).addClass('select');
                $(this).clone().appendTo('#dataSelect tbody');
                $('#dataSelect tr#'+$(this).attr('id')+' td.remove').remove();
                $('#dataSelect tr#'+$(this).attr('id')).removeClass('select');
                $('#success_packing').removeClass('hidden');
                $('#success_recive').removeClass('hidden');
                $('#reprint').removeClass('hidden');
                if ($('#search_status_do').val() == 3) {
                    $('#success_recive').removeClass('hidden');
                    $('#success_packing').addClass('hidden');
                    // $('#reprint').addClass('hidden');
                }
                else if ($('#search_status_do').val() == 1) {
                    $('#success_recive').addClass('hidden');
                    $('#success_packing').removeClass('hidden');
                    // $('#reprint').removeClass('hidden');
                }
                else{
                    $('#success_packing').addClass('hidden');
                    $('#success_recive').addClass('hidden');
                    // $('#reprint').addClass('hidden');
                }
            }
        });

        $(document).delegate('#SelectAll_do', 'click', function(e){
            if($("#sign_packing_do tbody tr:not(.select)").length == 0){
                $("#sign_packing_do tbody tr.select").removeClass('select');

                $('#success_packing').addClass('hidden');
                $('#success_recive').addClass('hidden');
                $('#reprint').addClass('hidden');
            }else{
                $("#sign_packing_do tbody tr:not(.select)").addClass('select');
                $('#success_packing').removeClass('hidden');
                $('#success_recive').removeClass('hidden');
                $('#reprint').removeClass('hidden');
                
                if ($('#search_status_do').val() == 3) {
                    $('#success_recive').removeClass('hidden');
                    $('#success_packing').addClass('hidden');
                    $('#reprint').addClass('hidden');
                }
                else if ($('#search_status_do').val() == 1) {
                    $('#success_recive').addClass('hidden');
                    $('#success_packing').removeClass('hidden');
                    $('#reprint').removeClass('hidden');
                }
                else{
                    $('#success_packing').addClass('hidden');
                    $('#success_recive').addClass('hidden');
                    $('#reprint').addClass('hidden');
                }
            }

            
        });

        $('#reprint_row').click(function(e) {
            e.preventDefault();
            if($('#tbody_sign_packing_do tr.select').length > 0){
                var itemcode = '';
                var i = 0;
                for( i ; i < $('#tbody_sign_packing_do tr.select').length; i++ ){
                    itemcode += $('#tbody_sign_packing_do tr.select').eq(i).attr('id')+'-';
                }
                window.open('<?php echo site_url('SignV2/packing_excel/');?>'+'/'+ itemcode, '_blank');
                }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'error',
                    timer: 3000
                });
            }
        });

        $('#submit_reprint').click(function (e) { 
            e.preventDefault();
            if($('#tbody_sign_packing_do tr.select').length > 0){
                var itemcode = '';
                var field_sign_id = '';
                var i = 0;
                for( i ; i < $('#tbody_sign_packing_do tr.select').length; i++ ){
                    itemcode += $('#tbody_sign_packing_do tr.select').eq(i).attr('id')+'-';
                }

                if ($('#input_reprint_comment').val() != '') {

                    $('#input_reprint_comment').addClass('is-valid');
                    $('#input_reprint_comment').removeClass('is-invalid');

                    update_reprint(itemcode);

                    // console.log(itemcode);
                }else{
                    swal({
                        title: 'โปรดกรอกหมายเหตุเพิ่มเติม',
                        type: 'warning',
                        timer: 3000
                    });

                    $('#input_reprint_comment').removeClass('is-valid');
                    $('#input_reprint_comment').addClass('is-invalid');
                }

            }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'error',
                    timer: 3000
                });
            }
        });

        $('#submit_reloaddata').click(function (e) { 
            e.preventDefault();
            if($('#tbody_sign_packing tr.select').length > 0){
                var itemcode = '';
                var field_sign_id = '';
                var i = 0;
                for( i ; i < $('#tbody_sign_packing tr.select').length; i++ ){
                    itemcode += $('#tbody_sign_packing tr.select').eq(i).attr('id')+'-';
                }

                if ($('#input_reloaddata_comment').val() != '') {

                    $('#input_reloaddata_comment').addClass('is-valid');
                    $('#input_reloaddata_comment').removeClass('is-invalid');

                    update_reloaddata(itemcode);

                    // console.log(itemcode);
                }else{
                    swal({
                        title: 'โปรดกรอกหมายเหตุเพิ่มเติม',
                        type: 'warning',
                        timer: 3000
                    });

                    $('#input_reloaddata_comment').removeClass('is-valid');
                    $('#input_reloaddata_comment').addClass('is-invalid');
                }

            }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'error',
                    timer: 3000
                });
            }
        });


        $('#form_confirm_success_packing').submit(function(e){
            e.preventDefault();
            if($('#tbody_sign_packing_do tr.select').length > 0){
                var itemcode = '';
                var field_sign_id = '';
                var i = 0;
                for( i ; i < $('#tbody_sign_packing_do tr.select').length; i++ ){
                    itemcode += $('#tbody_sign_packing_do tr.select').eq(i).attr('id')+'-';
                }
                 update_packing(itemcode);
            }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'error',
                    timer: 3000
                });
            }
        });	

        $('#form_confirm_success_recive').submit(function(e){
            e.preventDefault();
            if($('#tbody_sign_packing_do tr.select').length > 0){
                var itemcode = '';
                var i = 0;
                for( i ; i < $('#tbody_sign_packing_do tr.select').length; i++ ){
                    itemcode += $('#tbody_sign_packing_do tr.select').eq(i).attr('id')+'-';
                }
                    update_recive(itemcode);
                }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'error',
                    timer: 3000
                });
            }
        });	

        $('#success_recive').click(function(e) {
            e.preventDefault();
            if($('#tbody_sign_packing_do tr.select').length > 0){
                var itemcode = '';
                var i = 0;
                for( i ; i < $('#tbody_sign_packing_do tr.select').length; i++ ){
                    itemcode += $('#tbody_sign_packing_do tr.select').eq(i).attr('id')+'-';
                }
                $('#recive_modal').modal('show');
                    select_item_recive(itemcode);
                }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'error',
                    timer: 3000
                });
            }
        }); 
        $('#success_packing').click(function(e) {
            e.preventDefault();
            if($('#tbody_sign_packing_do tr.select').length > 0){
                var itemcode = '';
                var i = 0;
                for( i ; i < $('#tbody_sign_packing_do tr.select').length; i++ ){
                    itemcode += $('#tbody_sign_packing_do tr.select').eq(i).attr('id')+'-';
                }
                $('#packing_modal').modal('show');
                    select_item(itemcode);

            }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'error',
                    timer: 3000
                });
            }
        });

        $('#reprint').click(function(e) {
            e.preventDefault();
            if($('#tbody_sign_packing_do tr.select').length > 0){
                var itemcode = '';
                var i = 0;
                for( i ; i < $('#tbody_sign_packing_do tr.select').length; i++ ){
                    itemcode += $('#tbody_sign_packing_do tr.select').eq(i).attr('id')+'-';
                }
                all_clear_valid();
                $('#reprint_modal').modal('show');
                select_item_reprint(itemcode);
            }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'error',
                    timer: 3000
                });
            }
        });

        $('#Excel').click(function(e) {
            e.preventDefault();
            if($('#tbody_sign_packing tr.select').length > 0){
                var itemcode = '';
                var i = 0;
                for( i ; i < $('#tbody_sign_packing tr.select').length; i++ ){
                    itemcode += $('#tbody_sign_packing tr.select').eq(i).attr('id')+'-';
                }
                // console.log(itemcode);
                window.open('<?php echo site_url('SignV2/packing_excel/');?>'+'/'+ itemcode, '_blank');
            }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'error',
                    timer: 3000
                });
            }
        });

        $('#btn_re_loaddata').click(function(e) {
            e.preventDefault();
            if($('#tbody_sign_packing tr.select').length > 0){
                var itemcode = '';
                var i = 0;
                for( i ; i < $('#tbody_sign_packing tr.select').length; i++ ){
                    itemcode += $('#tbody_sign_packing tr.select').eq(i).attr('id')+'-';
                }
                $('#reloaddata_modal').modal('show');
                select_item_reloaddata(itemcode);
            }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'error',
                    timer: 3000
                });
            }
        });

        $('#btn_submit_edit').click(function (e) { 
            e.preventDefault();
            
            swal({
                title: "ต้องการบันทึกการแก้ไข?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1AA45F',
                cancelButtonColor: '#DB4B3F',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก',
        	}).then((result) => {
        		if (result.value){
                    edit_name();
        		}
        	});
            
        });

        $('#tbody_sign_packing').on('click','.btn_edit',function(){
            field_id = $(this).closest('tr').find('.field_id').text();
            itemcode = $(this).closest('tr').find('.Code').text();
            itemname = $(this).closest('tr').find('.Name1').text();
            var doit = $('#doit').val();
            $('#editname_modal').modal('show');
            $('#input_nameedit').val(itemname);
            $('#field_editname_id').val(field_id);
            $('#editname_title').text('แก้ไขชื่อสินค้าที่แสดงในป้าย รหัส '+itemcode+'');
        });

        $(document).delegate('#SelectAll', 'click', function(e){
            if($("#sign_packing tbody tr:not(.select)").length == 0){
                $("#sign_packing tbody tr.select").removeClass('select');
                $("#Excel").addClass('hidden');
                $("#btn_re_loaddata").addClass('hidden');
            }else{
                $("#sign_packing tbody tr:not(.select)").addClass('select');
                $("#Excel").removeClass('hidden');
                $("#btn_re_loaddata").removeClass('hidden');
            }
        });

        $('#tbody_sign_packing').delegate('tr', 'click', function(e) {
            if($(this).hasClass('select')){
                $(this).removeClass('select');
                $('#dataSelect tr#'+$(this).attr('id')).remove();
                if($('#sign_packing tbody tr.select').length == 0){
                    $("#Excel").addClass('hidden');
                    $("#btn_re_loaddata").addClass('hidden');
                }
            }else{
                $(this).addClass('select');
                $(this).clone().appendTo('#dataSelect tbody');
                $('#dataSelect tr#'+$(this).attr('id')+' td.remove').remove();
                $('#dataSelect tr#'+$(this).attr('id')).removeClass('select');
                $("#Excel").removeClass('hidden');
                $("#btn_re_loaddata").removeClass('hidden');
            }
        });

        $('#search_status_do').change(function (e) { 
            e.preventDefault();
            $('#pageNumber2').val(0);
            get_sign_packing_do();
        });

        $('#search_groupcode_do').change(function (e){ 
			e.preventDefault();
            $('#pageNumber2').val(0);
            get_sign_packing_do();
		});

        $('#search_type_do').change(function (e) { 
            e.preventDefault();
            $('#pageNumber2').val(0);
            get_sign_packing_do();
        });

        $('#usersPerPage1_do').change(function (e) { 
            e.preventDefault();
            $('#pageNumber2').val(0);
            get_sign_packing_do();
        });

        $('#search_size_do').change(function (e) { 
            e.preventDefault();
            $('#pageNumber2').val(0);
            get_sign_packing_do();
        });

        $('#search_text_do').keyup(function (e) { 
            $('#pageNumber2').val(0);
            get_sign_packing_do();   
        });

        $('#search_groupcode').change(function (e){ 
			e.preventDefault();
            $('#pageNumber1').val(0);
			get_sign_packing();
		});

        $('#search_size').change(function (e) { 
            e.preventDefault();
            $('#pageNumber1').val(0);
			get_sign_packing(); 
        });

        $('#search_type').change(function (e) { 
            e.preventDefault();
            $('#pageNumber1').val(0);
			get_sign_packing(); 
        });

        $('#usersPerPage1').change(function (e) { 
            e.preventDefault();
            $('#pageNumber1').val(0);
			get_sign_packing(); 
        });

        $('#search_text').keyup(function (e) { 
            e.preventDefault();
            $('#pageNumber1').val(0);
			get_sign_packing(); 
        });
    }

    function edit_name() {  
        var field_id = $('#field_editname_id').val();
        var name_edit = $('#input_nameedit').val();
        $.ajax({
            type:'POST',
            url:'<?= site_url('SignV2/update_itemname')?>',
            dataType:'JSON',
            data:{
                field_id : field_id,
                field_itemname : name_edit
            },
            success: function (data) {
                swal({
                    title: 'สำเร็จ',
                    text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                    type: 'success' ,
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {
                    if (result.value) {
                        get_sign_packing();
                        $('#editname_modal').modal('hide');
                    }
                });
            }
        });
    };

    function get_sign_packing() {  
        var search_text = $('#search_text').val();
        var search_groupcode = $('#search_groupcode').val();
        var search_size = $('#search_size').val();
        var search_type = $('#search_type').val();
        var usersPerPage1 = parseInt($('#usersPerPage1').val());
        var pageNumber1 = parseInt($('#pageNumber1').val()); 
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/get_sign_packing')?>",
            data : {
                usersPerPage:usersPerPage1,
                pageNumber:pageNumber1,
				search_text : search_text,
				search_groupcode : search_groupcode,
				search_size : search_size,
                search_type : search_type,
                field_load_data : '1',
                doit : $('#doit').val()
			},
            dataType: "JSON",
            success: function (data){
				//  console.log(data)
                var btn_edit = '<button title="แก้ไขชื่อสินค้า" class="btn btn-warning btn_edit "type="button" ><i class="fas fa-edit"></i></button>';
                $('#tbody_sign_packing').empty();
                $.each(data['SignPacking'],function(id,val){
        
                    $('#tbody_sign_packing').append(
                        '<tr id='+val['field_id']+'>'+
                            '<td class="text-left field_id" hidden>' +
                                '<span>'+val['field_id']+'</span>'+
                            '</td>'+
                            '<td width="10%" class="text-left Code">' +
                                '<span>'+val['field_itemcode']+'</span>'+
                            '</td>'+
                            '<td width="15%" class="text-left Name1">' +
                                '<span>'+val['field_itemname']+'</span>'+
                            '</td>'+
                            '<td width="10%" style="text-align:center;">' +
                                '<span>'+val['type_name_price']+'</span>'+
                            '</td>'+
                            '<td width="10%" style="text-align:center;" >' +
                                '<span>'+val['size_name']+'</span>'+
                            '</td>'+
                            '<td width="10%" style="text-align:center;" >' +
                                '<span>'+val['field_signamount']+'</span>'+
                            '</td>'+
                            '<td width="15%" style="text-align:center;">' +
                                '<span>'+val['type_name']+'</span>'+
                            '</td>'+
                            '<td width="15%" style="text-align:center;">' +
                                '<span>'+val['field_comment']+'</span>'+
                            '</td>'+
                            '<td width="15%" style="text-align:center;">' +
                                '<span>'+val['field_comfirm_comment']+'</span>'+
                            '</td>'+
                            '<td width="10%" style="text-align:center;">' +
                                '<span>'+btn_edit+'</span>'+
                            '</td>'+
                        '</tr>'
                    );
                });

                $('.pagination1').empty();
                var total_packing = (Math.ceil(parseInt(data['total_packing']) / parseInt(usersPerPage1)));
                if(parseInt(pageNumber1) > 5){
                $('.pagination1').append('<li><button class="pageNumber1">1</button></li>');
                $('.pagination1').append('<li><button class="pageNumber1" disabled>...</button></li>');
                }

                for (var i = 1; i <= total_packing; i++) {
                if(parseInt(pageNumber1)-5 < i && parseInt(pageNumber1)+7 > i){
                    if(parseInt(pageNumber1)+1 == i){
                    $('.pagination1').append('<li><button class="pageNumber1 active">'+i+'</button></li>');
                    }else{
                    $('.pagination1').append('<li><button class="pageNumber1">'+i+'</button></li>');
                    }
                }
                }
                if(parseInt(pageNumber1) < total_packing-6){
                    $('.pagination1').append('<li><button class="pageNumber1" disabled>...</button></li>');
                    $('.pagination1').append('<li><button class="pageNumber1">'+total_packing+'</button></li>');
                }
            }
        });
    }

    function get_sign_packing_do(){
        var search_type_do = $('#search_type_do').val();
        var search_size_do = $('#search_size_do').val();
        var search_groupcode_do = $('#search_groupcode_do').val();
        var search_text_do = $('#search_text_do').val();
        var usersPerPage2 = parseInt($('#usersPerPage2').val());
        var pageNumber2 = parseInt($('#pageNumber2').val());
        var search_status_do = $('#search_status_do').val();
        // console.log(usersPerPage);
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/get_sign_packing_do_model')?>",
            data : {
                usersPerPage:usersPerPage2,
                pageNumber:pageNumber2,
				search_text : search_text_do,
				search_groupcode : search_groupcode_do,
				search_size : search_size_do,
                search_type : search_type_do,
                search_status_do : search_status_do,
                doit : $('#doit').val()
				},
            dataType: "JSON",
            success: function (data){
				 console.log(data)
                $('#tbody_sign_packing_do').empty();
                $.each(data['SignPacking'],function(id,val){
                
                    confirm_person = '' +val['confirm_firstname']+' ('+val['confirm_nickname']+')<br>';
                    status_recive = '';
                    if (val['field_packing_status'] == '1') {
                        status_packing = '<span class="text-warning"><i class="fas fa-clock"></i> กำลังทำป้าย </span><br>';
                        status_recive = '<span class="text-warning"><i class="fas fa-clock"></i> รอทำป้ายเสร็จ </span><br>';
                    }
                    else if(val['field_packing_status'] == '2'){
                      
                        status_packing = '<span class="text-success"><i class="fa fa-check" aria-hidden="true" class="text-success"> เสร็จแล้ว </i></span><br>';
                        if (val['field_recieve_status'] == '1') {
                            status_recive = '<span class="text-warning"><i class="fas fa-clock"></i> รอรับป้าย </span><br>';
                        }
                        else if(val['field_recieve_status'] == '2'){
                            if (val['field_recieve_success'] == null) {
                                status_recive = '<span class="text-warning"><i class="fas fa-clock"></i> รอส่งมอบ </span><br>';
                            }
                            else if(val['field_recieve_success'] == '1'){ 
                                status_recive = '<span class="text-success"><i class="fa fa-check" aria-hidden="true" class="text-success"> เรียบร้อย </i></span><br>';
                            }
                           
                        }
                    }
                    $('#tbody_sign_packing_do').append(
                        '<tr id='+val['field_id']+'>'+

                                '<td class="text-left field_id" hidden>' +
                                    '<span>'+val['field_id']+'</span>'+
                                '</td>'+

                                '<td width="10%" class="text-left Code">' +
                                    '<span>'+val['field_itemcode']+'</span>'+
                                '</td>'+

                                '<td width="15%" class="text-left Name1">' +
                                    '<span>'+val['field_itemname']+'</span>'+
                                '</td>'+

                                '<td width="10%" style="text-align:center;">' +
                                    '<span>'+formatDate(val['field_comfirm_needdate'])+'</span>'+
                                '</td>'+

                                '<td width="10%" style="text-align:center;">' +
                                    '<span>'+val['size_name']+'</span>'+
                                '</td>'+

                                '<td width="10%" style="text-align:center;">' +
                                    '<span>'+val['type_name']+'</span>'+
                                '</td>'+

                                '<td width="15%" style="text-align:center;">' +
                                    '<span>'+val['firstname']+' ('+val['nickname']+')</span>'+
                                '</td>'+

                                '<td width="5%" class="text-right">' +
                                    '<span>'+val['field_print_count']+'</span>'+
                                '</td>'+

                                '<td width="15%" style="text-align:center;">' +
                                    '<span>'+status_packing+'</span>'+
                                '</td>'+

                                '<td width="15%" style="text-align:center;">' +
                                    '<span>'+status_recive+'</span>'+
                                '</td>'+



                            '</tr>'
                        );
                });

                $('.pagination2').empty();
                var total_packing = (Math.ceil(parseInt(data['total_packing']) / parseInt(usersPerPage2)));
                if(parseInt(pageNumber2) > 5){
                $('.pagination2').append('<li><button class="pageNumber2">1</button></li>');
                $('.pagination2').append('<li><button class="pageNumber2" disabled>...</button></li>');
                }

                for (var i = 1; i <= total_packing; i++) {
                if(parseInt(pageNumber2)-5 < i && parseInt(pageNumber2)+7 > i){
                    if(parseInt(pageNumber2)+1 == i){
                    $('.pagination2').append('<li><button class="pageNumber2 active">'+i+'</button></li>');
                    }else{
                    $('.pagination2').append('<li><button class="pageNumber2">'+i+'</button></li>');
                    }
                }
                }
                if(parseInt(pageNumber2) < total_packing-6){
                    $('.pagination2').append('<li><button class="pageNumber2" disabled>...</button></li>');
                    $('.pagination2').append('<li><button class="pageNumber2">'+total_packing+'</button></li>');
                }

                }
        });
    };

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

                $('.search_size_do').empty();
                $('.search_size_do').append(
                    '<option value="">เลือกขนาดป้าย</option>'
                );
                $.each(data, function (ida, val) {
                      $('.search_size_do').append(
                          '<option value="'+val['id']+'">'+val['size_name']+'</option>'
                      );
                });
            }
        });
    };

    function update_reprint(item) 
    {  
        swal({
			title: 'คุณต้องการขอปริ้นอีกครั้ง?',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#DCDCDC',
			confirmButtonText: 'ใช่',
			cancelButtonText: 'ปิด',
		}).then((result) => {
			if (result.value) {
                var type_name = 'ขอถอยปริ้น';
                var type_request = '1';
                var comment_request = $('#input_reprint_comment').val();
                $.ajax({
                    type:'POST',
                    url:'<?= site_url('SignV2/request_sign')?>',
                    dataType:'json',
                    data:{
                        id : item,
                        type_name : type_name,
                        type_request : type_request,
                        comment_request : comment_request
                    },
                    success: function (data) {
                        console.log(data);
                        swal({
                            title: 'สำเร็จ',
                            text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                            type: 'success' ,
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        }).then((result) => {
                            if (result.value) {
                                $('#reprint_modal').modal('hide');
                                all_hide();
                                get_sign_packing_do(); 
                            }
                        });
                    }
                });
			}
		});
    };

    function update_reloaddata(item) 
    {  
        swal({
			title: 'คุณต้องการขอดึงข้อมูลอีกครั้ง?',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#DCDCDC',
			confirmButtonText: 'ใช่',
			cancelButtonText: 'ปิด',
		}).then((result) => {
			if (result.value) {
                var type_name = 'ขอถอยดึงข้อมูล';
                var type_request = '2';
                var comment_request = $('#input_reloaddata_comment').val();
                $.ajax({
                    type:'POST',
                    url:'<?= site_url('SignV2/request_sign')?>',
                    dataType:'json',
                    data:{
                        id : item,
                        type_name : type_name,
                        type_request : type_request,
                        comment_request : comment_request
                    },
                    success: function (data) {
                        console.log(data);
                        swal({
                            title: 'สำเร็จ',
                            text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                            type: 'success' ,
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        }).then((result) => {
                            if (result.value) {
                                $('#reloaddata_modal').modal('hide');
                                all_hide();
                                get_sign_packing(); 
                            }
                        });
                    }
                });
			}
		});
    };

    function update_packing(item) 
    {  
        swal({
			title: 'คุณทำป้ายเสร็จแล้ว?',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#DCDCDC',
			confirmButtonText: 'ใช่',
			cancelButtonText: 'ปิด',
		}).then((result) => {
			if (result.value) {
                var field_packing_status = '2';
                var field_recieve_status = '1';
                var field_pack_status = '2';
                // console.log(item);
                $.ajax({
                    type:'POST',
                    url:'<?= site_url('SignV2/update_packing')?>',
                    dataType:'json',
                    data:{
                        id : item,
                        field_recieve_status : field_recieve_status,
                        field_packing_status : field_packing_status,
                        field_pack_status : field_pack_status
                    },
                    success: function (data) {
                        console.log(data);
                        swal({
                            title: 'สำเร็จ',
                            text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                            type: 'success' ,
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        }).then((result) => {
                            if (result.value) {
                                $('#packing_modal').modal('hide');
                                all_hide();
                                get_sign_packing_do(); 
                            }
                        });
                    }
                });
			}
		});
    };

    function update_recive(item) 
    {  
        swal({
			title: 'มีคนมารับป้ายแล้ว?',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#DCDCDC',
			confirmButtonText: 'ใช่',
			cancelButtonText: 'ปิด',
		}).then((result) => {
			if (result.value) {
                var field_packing_status = '2';
                var field_recieve_status = '2';
                var field_pack_status = '2';
                // console.log(item);
                $.ajax({
                    type:'POST',
                    url:'<?= site_url('SignV2/update_recive')?>',
                    dataType:'json',
                    data:{
                        id : item,
                        field_recieve_status : field_recieve_status,
                        field_packing_status : field_packing_status,
                        field_pack_status : field_pack_status
                    },
                    success: function (data) {
                        console.log(data);
                        swal({
                            title: 'สำเร็จ',
                            text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                            type: 'success' ,
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        }).then((result) => {
                            if (result.value) {
                                $('#recive_modal').modal('hide');
                                all_hide();
                                get_sign_packing_do(); 
                            }
                        });
                    }
                });
			}
		});
    };

    function select_item_reprint(item) { 
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_packing_excel')?>",
            data: {
                id : item
            },
            dataType: "json",
            success: function (data) {

                console.log(data);
                $('#tb_reprint').empty();
                $.each(data['list'],function(id,val){
                    $('#tb_reprint').append('<tr>'+
                        '<td style="text-align:left;" hidden class="field_sign_id">'+val['field_sign_id']+'</td>'+
                        '<td>'+val['field_docno']+'</td>'+
                        '<td>'+val['field_itemcode']+'</td>'+
                        '<td>'+val['field_itemname']+'</td>'+
                        '<td class="text-center">'+formatDatetime(val['field_pack_datetime'])+'</td>'+	
                        '<td class="text-center">'+formatDate(val['field_comfirm_needdate'])+'</td>'+
                        '<td class="text-center">'+ val['size_name'] +'</td>'+
                        '<td class="text-right">'+ val['field_signamount'] +'</td>'+
                    '</tr>');
                });
            }
        });
    }

    function select_item_reloaddata(item) { 
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_packing_excel')?>",
            data: {
                id : item
            },
            dataType: "json",
            success: function (data) {

                console.log(data);
                $('#tb_reloaddata').empty();
                $.each(data['list'],function(id,val){
                    $('#tb_reloaddata').append('<tr>'+
                        '<td style="text-align:left;" hidden class="field_sign_id">'+val['field_sign_id']+'</td>'+
                        '<td>'+val['field_docno']+'</td>'+
                        '<td>'+val['field_itemcode']+'</td>'+
                        '<td>'+val['field_itemname']+'</td>'+
                        '<td class="text-center">'+formatDate(val['field_comfirm_needdate'])+'</td>'+
                        '<td class="text-center">'+ val['size_name'] +'</td>'+
                        '<td class="text-right">'+ val['field_signamount'] +'</td>'+
                    '</tr>');
                });
            }
        });
    }

    function select_item(item) { 
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_packing_excel')?>",
            data: {
                id : item
            },
            dataType: "json",
            success: function (data) {

                console.log(data);
                $('#tb_success_packing').empty();
                $.each(data['list'],function(id,val){
                    $('#tb_success_packing').append('<tr>'+
                        '<td style="text-align:left;" hidden class="field_sign_id">'+val['field_sign_id']+'</td>'+
                        '<td>'+val['field_docno']+'</td>'+
                        '<td>'+val['field_itemcode']+'</td>'+
                        '<td>'+val['field_itemname']+'</td>'+
                        '<td class="text-center">'+formatDatetime(val['field_pack_datetime'])+'</td>'+	
                        '<td class="text-center">'+formatDate(val['field_comfirm_needdate'])+'</td>'+
                        '<td class="text-center">'+ val['size_name'] +'</td>'+
                        '<td class="text-right">'+ val['field_signamount'] +'</td>'+
                    '</tr>');
                });
            }
        });
    }

    function select_item_recive(item) { 
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_packing_excel')?>",
            data: {
                id : item
            },
            dataType: "json",
            success: function (data) {

                console.log(data);
                $('#tb_success_recive').empty();
                $.each(data['list'],function(id,val){
                    $('#tb_success_recive').append('<tr>'+
                        '<td style="text-align:left;" hidden class="field_sign_id">'+val['field_sign_id']+'</td>'+
                        '<td>'+val['field_docno']+'</td>'+
                        '<td>'+val['field_itemcode']+'</td>'+
                        '<td>'+val['field_itemname']+'</td>'+
                        '<td class="text-center">'+formatDatetime(val['field_pack_datetime'])+'</td>'+	
                        '<td class="text-center">'+formatDate(val['field_comfirm_needdate'])+'</td>'+
                        '<td class="text-center">'+ val['size_name'] +'</td>'+
                        '<td class="text-right">'+ val['field_signamount'] +'</td>'+
                    '</tr>');
                });
            }
        });
    }

    function confirm_sign_type_price() 
    { 
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/confirmsign_type_price')?>",
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

                $('.search_type_do').empty();
                $('.search_type_do').append(
                    '<option value="">เลือกประเภท</option>'
                );
                $.each(data, function (ida, val) {
                      $('.search_type_do').append(
                          '<option value="'+val['id']+'">'+val['type_name_price']+'</option>'
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
            $('#search_groupcode').empty();
            $('#search_groupcode').append('<option value="">ค้นหาตามกลุ่มสินค้า</option>');
            $.each(data['groupcode'],function(id,val){
				$('#search_groupcode').append('<option value="'+val['code']+'">'+val['code']+'&emsp;'+'>'+'&emsp;'+val['name_1']+'</option>');
            });

            $('#search_groupcode_do').empty();
            $('#search_groupcode_do').append('<option value="">ค้นหาตามกลุ่มสินค้า</option>');
            $.each(data['groupcode'],function(id,val){
				$('#search_groupcode_do').append('<option value="'+val['code']+'">'+val['code']+'&emsp;'+'>'+'&emsp;'+val['name_1']+'</option>');
            });
            
        }).fail(function(data){
        });
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