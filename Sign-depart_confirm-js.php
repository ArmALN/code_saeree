
<script type="text/javascript">

    $(document).ready(function(){

        select2();
        all_click();
        get_sign();
        get_groupcode();
        get_employee();
        // confirm_sign_type_price(price);
        // confirm_sign_size(type_price);
        $('#confirm_manage_modal').modal('hide');
        datepicker();
    });

    function datepicker() {
        $("#confirmsign_date").datepicker("destroy");
        $("#confirmsign_date").datepicker({dateFormat: 'yy-mm-dd',minDate: -0});
    }

    function select2() {  
        $( "#search_groupcode" ).select2({
            theme: "bootstrap4"
        });
    }

    function all_click() {  

        $('#detail_active').delegate('tr', 'click', function(e) {
            if($(this).hasClass('select')){
                $(this).removeClass('select');
                $('#dataSelect tr#'+$(this).attr('id')).remove();
                if($('#tb_active_sign tbody tr.select').length == 0){
                }
            }else{
                $(this).addClass('select');
                $(this).clone().appendTo('#dataSelect tbody');
                $('#dataSelect tr#'+$(this).attr('id')+' td.remove').remove();
                $('#dataSelect tr#'+$(this).attr('id')).removeClass('select');
            }
        });

        $(document).on('click','.rowDel',function(){
            remove_addsign(
				$(this).closest('tr').find('.numrow').text(),
            );
		});

        $('#addrow_signsub').click(function (e) { 
            e.preventDefault();
            add_rowsignsub();

            get_select_place();

            if ($('#cause_id').val() == '6' || $('#cause_id').val() == '7') {
                var price = '1';
                confirm_sign_type_price(price);
                $('.confirmsign_type_price').val('5');
                confirm_sign_size(5);
            }else{
                var price = '2';
                confirm_sign_type_price(price);
                $('.confirmsign_type_price').val(price);
                confirm_sign_size(price);
            }
        });

        $('#tb_addsign').on('change','.DefSaleUnitCode',function(){
			get_packingrate($(this).closest('tr'),$(this).val());
		});

        // $(document).on('click','.remove_addsign',function(){
		// 	remove_addsign(this);
		// });

        $('#formData_save').submit(function(e){
            e.preventDefault();

            $('#sign_type').css('border','');
            $('#confirmsign_date').css('border','');

            if($('#sign_type').val() == '' ){
                $('#sign_type').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('#confirmsign_date').val() == '' ){
                $('#confirmsign_date').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('#sign_type').val() != '' 
            && $('#confirmsign_date').val() != ''){
                validate();
            }

        });

        $('#tb_list_sign').on('click','.btn_confirm',function(){
          field_id = $(this).closest('tr').find('.field_id').text();
          field_docno = $(this).closest('tr').find('.field_docno').text();
          var doit = '0';
          $('#confirm_manage_modal').modal('show');
          $('#con_manage').empty();
          $('#con_manage').append('ระบุจุดที่ต้องการนำไปติด ให้แผนกบรรจุภัณฑ์ทำ '+field_docno);
            //   console.log(field_id,field_docno);
          all_clear();
          confirm_detail(field_id,field_docno,doit);
          datepicker();
        });

        $('#tb_list_sign').on('click','.btn_do_yourself',function(){
          field_id = $(this).closest('tr').find('.field_id').text();
          field_docno = $(this).closest('tr').find('.field_docno').text();
          var doit = '1';
          $('#confirm_manage_modal').modal('show');
          $('#con_manage').empty();
          $('#con_manage').append('ระบุจุดที่ต้องการนำไปติด แผนกทำป้ายเอง '+field_docno);
            //   console.log(field_id,field_docno);
          all_clear();
          confirm_detail(field_id,field_docno,doit);
          datepicker();
        });

        $('#tb_list_sign').on('click','.btn_notconfirm',function(){
          field_id = $(this).closest('tr').find('.field_id').text();
            swal({
                title: 'หมายเหตุที่ไม่ทำ',
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

        $('#search_text').keyup(function (e) { 
			e.preventDefault();
			$('#pageNumber').val(0);
			get_sign(); 
		});

        $(document).on('click','.pageNumber',function(){
			$('#pageNumber').val($(this).text()-1);
			get_sign(); 
        });

        $('#search_groupcode').change(function (e) { 
            e.preventDefault();
			$('#pageNumber').val(0);
            get_sign();
        });

        var count_sign = 0;

        $('.confirmsign_type_price').change(function (e) { 
            e.preventDefault();
            var type_price = $('.confirmsign_type_price').val();
            confirm_sign_size(type_price);
        });
            
        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();       
            count_sign -= 1
        
        });

       
        $('#submit_confirm').click(function(){
            $('#sign_type').css('border','');
            $('#confirmsign_comment').css('border','');
            $('#confirmsign_date').css('border','');

            $('.confirmsign_place').css('border','');
            $('.confirmsign_size').css('border','');
            $('.confirmsign_amount').css('border','');
            $('.comment').css('border','');
            
            if($('#sign_type').val() == '' ){
                $('#sign_type').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('#confirmsign_comment').val() == '' ){
                $('#confirmsign_comment').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('#confirmsign_date').val() == '' ){
                $('#confirmsign_date').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('.confirmsign_place').val() == '' ){
                $('.confirmsign_place').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('.confirmsign_size').val() == '' ){
                $('.confirmsign_size').css('border','rgb(217, 83, 79) 2px solid');
            }

            if($('.confirmsign_amount').val() == '' ){
                $('.confirmsign_amount').css('border','rgb(217, 83, 79) 2px solid');
            }
            if($('.comment').val() == '' ){
                $('.comment').css('border','rgb(217, 83, 79) 2px solid');
            }
            if($('#sign_type').val() != '' 
            && $('#confirmsign_comment').val() != '' 
            && $('#confirmsign_date').val() != '' 
            
            && $('.confirmsign_place').val() != ''
            && $('.comment').val() != ''
            && $('.confirmsign_size').val() != ''
            && $('.confirmsign_amount').val() != ''){

             validate_comfirm();
            }
		});

        
    }

    function get_employee(){
        $.ajax({
        type: "POST",
        url: "<?= site_url('SignV2/get_employee')?>",
        dataType: "JSON",
        async: false,
        success: function (data) {
            $('#sign_creator_id').val(data[0]['employeeid']);      
            $('#sign_creator').val(data[0]['firstname'] +' '+ data[0]['lastname'] +' ('+data[0]['nickname']+ ')');
        }
        });
    };
  
    function remove_addsign(input){
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
				
				$(input).closest('tr').remove();
				count_addsign();
				run_no();
			}
		});
	};

    function run_no(){
		var no = 1;
		$('#tb_addsign').find('tr').each(function(){
			$(this).find('.no').text(no);
			no++;
		});
	};

    function count_addsign(){
		$('#count_addsign').text($('#tb_addsign').find('tr').length);

        if($('#tb_addsign').find('tr').length > 0){
            $('#search_itemcode').addClass('hidden');
       
        }else{
            $('#search_itemcode').removeClass('hidden');

        }
	};

    function validate_comfirm(){

        var tb_dosign = [];

        var count_sign = 0;
        $('#tbody_addsignsub').find('tr').each(function(){
            if ($(this).find('.comment').val() != '') {
                if ($(this).find('.confirmsign_amount').val() > 0) {
                    var tb_dosigns = {};
                    tb_dosigns['comment'] = $(this).find('.comment').val();
                    tb_dosigns['confirmsign_place'] = $(this).find('.confirmsign_place').val();
                    tb_dosigns['confirmsign_size'] = $(this).find('.confirmsign_size').val();
                    tb_dosigns['confirmsign_type_price'] = $(this).find('.confirmsign_type_price').val();
                    tb_dosigns['confirmsign_amount'] = $(this).find('.confirmsign_amount').val();
                    tb_dosigns['confirmsign_destroy'] = $(this).find('.confirmsign_destroy').val();
                    if (tb_dosigns['confirmsign_destroy'] == '1') {
                        $('#confirm_destroy').val('1');
                    }
                    tb_dosign.push(tb_dosigns);
                }else{
                    count_sign++;
                }
            }
        });

        var destroy_id = '';
        // var field_sign_id = '';
        var i = 0;
        for( i ; i < $('#detail_active tr.select').length; i++ ){
            destroy_id += $('#detail_active tr.select').eq(i).attr('id')+',';
        }

        if (count_sign > 0) {
            swal({
                title: 'ผิดพลาด',
                text: "จำนวนป้ายไม่ถูกต้องกรุณาตรวจสอบ",
                type: 'error'
            });
        }else{
            if ($('#cause_id').val() == 2 || $('#cause_id').val() == 3 || $('#cause_id').val() == 6 || $('#cause_id').val() == 7 || $('#cause_id').val() == 18) {
                var active_count = 0;
                $('#detail_active').find('tr').each(function(){
                    active_count++;
                });

                if (active_count > 0) {
                    if (i > 0) {
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
                                console.log(tb_dosign,destroy_id);
                                depart_addsign(tb_dosign,destroy_id);
                            }
                        });
                    }else{
                        swal({
                            title: 'ผิดพลาด',
                            text: "กรุณาเลือกป้ายทำลาย",
                            type: 'error'
                        });
                    }
                }else{
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
                            console.log(tb_dosign,destroy_id);
                            depart_addsign(tb_dosign,destroy_id);
                        }
                    });
                }
            }else{
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
                        console.log(tb_dosign,destroy_id);
                        depart_addsign(tb_dosign,destroy_id);
                    }
                });
            }
        }



    };

    function depart_addsign(tb_dosign,destroy_id){

        var destroy_status = 0;
        if (destroy_id == '') {
            destroy_status = 0;
        }else{
            destroy_status = 1;
        }
    
        $.ajax({
        type:'POST',
        url:'<?= site_url('SignV2/depart_confirm_sign')?>',
        dataType:'JSON',
        data: {
            tb_dosign : tb_dosign,
            destroy_id : destroy_id,
            doit : $('#doit').val(),
            destroy_status : destroy_status,
            field_id : $('#field_id').val(),
            item_code : $('#item_code').val(),
            item_name : $('#item_name').val(),
            groupcode : $('#groupcode').val(),
            new_price1 : $('#new_price1').val(),
            new_price2 : $('#new_price2').val(),
            new_price3 : $('#new_price3').val(),
            new_price4 : $('#new_price4').val(),
            new_price5 : $('#new_price5').val(),
            sale_price1 : $('#sale_price1').val(),
            sale_price2 : $('#sale_price2').val(),
            sale_price3 : $('#sale_price3').val(),
            sale_price4 : $('#sale_price4').val(),
            sale_price5 : $('#sale_price5').val(),
            confirmsign_comment :$('#confirmsign_comment').val(),
            confirmsign_needdate :$('#confirmsign_date').val(),
            creator : $('#sign_creator_id').val(),
            field_confirm_status : '1'
        },
        }).done(function(data){
        swal({ 
            title: 'บันทึกข้อมูลสำเร็จ',
			type: 'success',
        }).then((result) => {
            if (result.value) {

                console.log(data);
                $('#confirm_manage_modal').modal('hide');
                get_sign(); 
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

    function get_sign(){ 
        var search_text = $('#search_text').val();
        var search_groupcode = $('#search_groupcode').val();
        var usersPerPage = $('#usersPerPage').val();
        var usersPerPage = parseInt($('#usersPerPage').val());
        var pageNumber = $('#pageNumber').val();

        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/sign_list')?>",
            data : {
                pageNumber : pageNumber ,
                usersPerPage : usersPerPage,
                search_text : search_text,
                search_groupcode : search_groupcode,
                field_confirm_status : '0'
                },
            dataType: "JSON",
            success: function (data) {
                
                // console.log(data);
                $('#tb_list_sign').empty();
                $.each(data['Sign'],function(id,val){
                
                var sign_type = '';

                var confirm_status = '';
                var packing_status = '';

                var btn_view = ' <button class="btn bg-aqua btn_view "type="button" > ดู </button> ';
                var btn_confirm = ' <button class="btn btn-primary btn_confirm "type="button" > บรรจุภัณฑ์ทำ </button>';
                var btn_notconfirm = ' <button class="btn btn-danger btn_notconfirm "type="button" > ไม่ทำ </button>';
                var btn_do_yourself = ' <button class="btn btn-info btn_do_yourself "type="button" > แผนกทำเอง </button>';


                 $('#tb_list_sign').append(
                    '<tr>'+
                        '<td class="hidden field_id">'+val['field_id']+'</td>'+
                        '<td width="10%" class="field_docno" style="text-align:left;">'+ val['field_docno'] +'</td>'+
                        '<td width="10%" style="text-align:left;"> '+ val['field_itemcode'] +' </td>'+
                        '<td width="20%" style="text-align:left;"> '+ val['field_itemname'] +' </td>'+
                        '<td width="15%" style="text-align:center;">'+ formatDate(val['field_change_date']) +'</td>'+
                        '<td width="10%" style="text-align:center;">'+ val['creator_firstname'] +'('+val['creator_nickname']+')</td>'+
                        '<td width="10%" style="text-align:center;">'+ val['type_name'] +'</td>'+
                        '<td width="20%" style="text-align:center;">'+ btn_confirm+btn_do_yourself+btn_notconfirm+'</td>'+
                    '</tr>'
                    );
                });
                // สถานะการสั่งทำป้าย

                $('.pagination').empty();
                var total_sign = (Math.ceil(parseInt(data['Total_Sign']) / parseInt(usersPerPage)));
                if(parseInt(pageNumber) > 5){
                    $('.pagination').append('<li><button class="pageNumber">1</button></li>');
                }

                for (var i = 1; i <= total_sign; i++){
                    if(parseInt(pageNumber)-5 < i && parseInt(pageNumber)+7 > i){
                    if(parseInt(pageNumber)+1 == i){
                        $('.pagination').append('<li><button class="pageNumber active">'+i+'</button></li>');
                    }else{
                        $('.pagination').append('<li><button class="pageNumber">'+i+'</button></li>');
                    }
                    }
                }

                if(parseInt(pageNumber) < total_sign-6){
                    $('.pagination').append('<li><button class="pageNumber">'+total_sign+'</button></li>');
                }
                console.log(data['Total_Sign'],usersPerPage);
            }
        });
    };

    function add_rowsignsub() {  
        var numrow = parseInt($('#numrow').val()) + 1;
        $('#numrow').val(numrow);

        $('#tbody_addsignsub').append(
            '<tr id="rowsignsub'+numrow+'">'+
                '<td class="hidden numrow">'+numrow+'</td>'+
                '<td class="col-sm-5">'+
                    '<b>บริเวณที่จะนำไปติด</b><small> หากไม่มีสถานที่ให้ไปเพิ่มที่ จัดการสถานที่ติดตั้งป้าย</small>'+
                    '<select class="form-control confirmsign_place" name="confirmsign_place" id="confirmsign_place"></select>'+
                    '<br>'+
                    '<b>ประเภทราคา <span class="text-danger">'+$('#detail_typeitem').val()+'</span></b>'+
                    '<select name="confirmsign_type_price" class="form-control confirmsign_type_price" id="confirmsign_type_price"></select>'+
                    '<br>'+
                    '<b>หมายเหตุ</b>'+
                    '<input type="text" name="comment" class="form-control comment" id="comment">'+
                '</td>'+
                '<td class="col-sm-5">'+
                    '<b>จำนวนที่ต้องการ</b>'+
                    '<input type="number" name="confirmsign_amount" min="1" value="1" class="text-right form-control confirmsign_amount" id="confirmsign_amount">'+
                    '<br>'+
                    '<b>ขนาด</b>'+
                    '<select name="confirmsign_size" class="form-control confirmsign_size" id="confirmsign_size"></select>'+
                    '<br><input type="button" class="rowDel btn bg-red btn-block" style="margin-top:25px;" value="ลบ">'+
                '</td>'+
            '</tr>'
        );

        select2();
    }

    function remove_addsign(numrow){
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
                $('#rowsignsub'+numrow).remove();
                select2();
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
				$('#search_groupcode').append('<option value="'+val['Code']+'">'+val['Code']+'&emsp;'+'>'+'&emsp;'+val['Name']+'</option>');
            });
        }).fail(function(data){
        });
    };

    function confirm_detail(field_id,field_docno,doit) 
    {  
        console.log(field_id,field_docno,doit);


        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/select_confirm_detail')?>",
            data: {
                field_id : field_id
            },
            dataType: "json",
            success: function (data) {
                var old_price = '';
                var new_price = data['tb_signv2_sub']['field_price1'];
                if (data['tb_signv2_sub']['field_new_price1'] != null && data['tb_signv2_sub']['field_old_price1'] != null) {
                    old_price = data['tb_signv2_sub']['field_old_price1'];
                    new_price = data['tb_signv2_sub']['field_new_price1'];
                    if (data['tb_signv2_sub']['field_new_price1'] == 0) {
                        new_price = data['tb_signv2_sub']['field_price1'];
                    }
                }
                console.log(data);
                $('#detail_confirm').empty();
                $('#detail_confirm').append(
                    '<div class="row">'+
                        '<div class="col-md-6"><b>รหัสสินค้า</b> : '+data['tb_signv2_sub']['field_itemcode']+'</div>'+
                        '<div class="col-md-6"><b>สินค้า</b> : '+data['tb_signv2_sub']['field_itemname']+'</div>'+
                        '<div class="col-md-12" id="price_row"></div>'+
                        '<div class="col-md-12"><b>สาเหตุ</b> : '+data['tb_signv2_sub']['type_name']+'</div>'+
                    '</div>'+
                    '<input type="hidden" id="cause_id" name="cause_id" value="'+data['tb_signv2_sub']['id']+'">'+
                    '<input type="hidden" id="field_id" name="field_id" value="'+field_id+'">'+
                    '<input type="hidden" id="item_code" name="item_code" value="'+data['tb_signv2_sub']['field_itemcode']+'">'+
                    '<input type="hidden" id="groupcode" name="groupcode" value="'+data['tb_signv2_sub']['field_groupcode']+'">'+
                    '<input type="hidden" id="item_name" name="item_name" value="'+escapeHtml(data['tb_signv2_sub']['field_itemname'])+'">'+
                    '<input type="hidden" id="doit" name="doit" value="'+doit+'">'+
                    '<input type="hidden" id="new_price1" name="new_price1" value="'+data['tb_signv2_sub']['field_new_price1']+'">'+
                    '<input type="hidden" id="new_price2" name="new_price2" value="'+data['tb_signv2_sub']['field_new_price2']+'">'+
                    '<input type="hidden" id="new_price3" name="new_price3" value="'+data['tb_signv2_sub']['field_new_price3']+'">'+
                    '<input type="hidden" id="new_price4" name="new_price4" value="'+data['tb_signv2_sub']['field_new_price4']+'">'+
                    '<input type="hidden" id="new_price5" name="new_price5" value="'+data['tb_signv2_sub']['field_new_price5']+'">'+
                    '<input type="hidden" id="sale_price1" name="sale_price1" value="'+data['tb_signv2_sub']['field_price1']+'">'+
                    '<input type="hidden" id="sale_price2" name="sale_price2" value="'+data['tb_signv2_sub']['field_price2']+'">'+
                    '<input type="hidden" id="sale_price3" name="sale_price3" value="'+data['tb_signv2_sub']['field_price3']+'">'+
                    '<input type="hidden" id="sale_price4" name="sale_price4" value="'+data['tb_signv2_sub']['field_price4']+'">'+
                    '<input type="hidden" id="sale_price6" name="sale_price5" value="'+data['tb_signv2_sub']['field_price5']+'">'
                );

                var i = 0;
                var BCPrice = [];
                $.each(data['ic_unit_use'], function (idx, val) { 
                    BCPrice[i] = val['unit_code'];

                    var sh_price = 0;
                    if (val['sale_price2'] != null) {
                        sh_price = val['sale_price2'];
                    }else{
                        $.each(data['ic_inventory_price'], function (id3, val2) { 
                            if (val['unit_code'] == val2['unit_code']) {
                                sh_price = val2['price_0'];
                            }
                        });
                    }

                    i++;
                    if (i == 1) {
                        var price = data['field_new_price1'];
                    }else if (i == 2) {
                        var price = data['field_new_price2'];
                    }else if (i == 3) {
                        var price = data['field_new_price3'];
                    }else if (i == 4) {
                        var price = data['field_new_price4'];
                    }else if (i == 5) {
                        var price = data['field_new_price5'];
                    }
                    if (price == null || price == 0) {
                        price = 'ไม่ได้ปรับราคา';
                    }
                    $('#price_row').append(
                        '<div class="row">'+
                            '<div class="col-md-6">'+
                                '<b>ราคาจัดซื้อกรอก '+i+' :</b> '+price+''+
                            '</div>'+
                            '<div class="col-md-6">'+
                                '<b>ราคาS&H '+i+' :</b> '+sh_price+''+
                            '</div>'+
                        '</div>'
                    );
                });

                if (i == 1) {
                    $('#detail_typeitem').val('ราคาเดียว');
                }
                else{
                    if (BCPrice[0] == BCPrice[1]) {
                        $('#detail_typeitem').val('สเต็ปราคา');
                    }else{
                        $('#detail_typeitem').val('หลายหน่วยนับ');
                    }
                }

                $('#input_title').empty();
                $('#input_title').append(
                    'ระบุข้อมูล สินค้า<b class="text-warning">'+$('#detail_typeitem').val()+'</b>'
                );
                // $('#input_title').text('ระบุข้อมูล สินค้า<span class="text-danger">'+$('#detail_typeitem').val()+'</span>');
                // console.log(BCPrice);

                $('.type_price_title').empty();
                $('.type_price_title').append(
                    'ประเภทราคา <span class="text-danger">'+$('#detail_typeitem').val()+'</span>'
                );

                $('#detail_active').empty();
                var num_row = 0;
                $.each(data['sign_old'], function (id, val) {
                    num_row ++;
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

                    var select = ''; 

                    if ( $('#cause_id').val() == 6 || $('#cause_id').val() == 7 || $('#cause_id').val() == 18) {
                        if ( val['field_type_sign_price'] != '8' && val['field_type_sign_price'] != '9') {
                            if (val['sign_size'] != '5' && val['sign_size'] != '7' && val['sign_size'] != '10' && val['sign_size'] != '11') {
                                select = 'select';
                                // console.log(val['field_type_sign_price'],val['sign_size']);
                            }else{
                                // select = '';
                            }
                        }
                    }else if ($('#cause_id').val() == 2 || $('#cause_id').val() == 3) {
                        select = 'select';
                    }

                    $('#detail_active').append(
                        '<tr id="'+val['field_old_id']+'" class="'+select+'">'+
                            '<td hidden class="field_id">'+ val['field_old_id'] +'</td>'+
                            '<td hidden width="20%">'+num_row+'</td>'+
                            '<td width="20%">'+docno+'</td>'+
                            '<td width="30%" style="text-align:left;">'+ val['field_place_name'] +'</td>'+
                            '<td width="20%" style="text-align:left;">'+ val['size_name'] +'</td>'+
                            '<td width="20%" style="text-align:left;">'+ type_sign_price +'</td>'+
                            '<td class="text-right" width="10%">'+val['sign_amount']+'</td>'+
                        '</tr>'
                    );
                });
                
                get_select_place();

                if (data['id'] == '6' || data['id'] == '7') {
                    var price = '1';
                    confirm_sign_type_price(price);
                    $('.confirmsign_type_price').val('5');
                    confirm_sign_size(5);
                }else{
                    var price = '2';
                    confirm_sign_type_price(price);
                    $('.confirmsign_type_price').val(price);
                    confirm_sign_size(price);
                }

                if (data['ic_inventory_price'][0]['price_0'] == '.00') {
                    var price = '8';
                    confirm_sign_type_price(price);
                    $('.confirmsign_type_price').val('8');
                    confirm_sign_size(8);
                }

                $('#btn_refresh').click(function (e) { 
                    e.preventDefault();
                    confirm_detail(field_id,field_docno,doit);
                });

            }
            
        });
    };

    function all_clear() {  
        $('.comment').val('');
        $('.confirmsign_amount').val(1);
    }

    function get_select_place() {
        var item_code = $('#item_code').val();
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_select_place')?>",
            data: {
                item_code : item_code
            },
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $('.confirmsign_place').empty();
                $('.confirmsign_place').append(
                    '<option value="">เลือกสถานที่ติดตั้ง</option>'
                );
                
                $.each(data, function (ind, val) { 
                    $('.confirmsign_place').append(
                        '<option value="'+val['field_place_id']+'">'+val['field_place_name']+'</option>'
                    );
                });
            }
        });

        select2();
    }

    function confirm_sign_size(type_price) 
    { 
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/confirm_sign_size')?>",
            data : {
                type_price : type_price
            },
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $('.confirmsign_size').empty();
                $('.confirmsign_size').append(
                    '<option value="">เลือกขนาดป้าย</option>'
                );
                $.each(data, function (ida, val) {
                      $('.confirmsign_size').append(
                          '<option value="'+val['id']+'">'+val['size_name']+'</option>'
                      );
                });
            }
        });

        select2();
    };

    function confirm_sign_type_price(price) 
    { 
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/confirmsign_type_price')?>",
            data : {price : price},
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $('.confirmsign_type_price').empty();
                $('.confirmsign_type_price').append(
                    '<option value="">เลือกประเภท</option>'
                );
                $.each(data, function (ida, val) {
                      $('.confirmsign_type_price').append(
                          '<option value="'+val['id']+'">'+val['type_name_price']+'</option>'
                      );
                });
            }
        });
        select2();
    };

    function not_confirm(field_id,notCon_comment) 
    {  
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
                    url:'<?= site_url('SignV2/update_confirm')?>',
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
                            get_sign();
                        }
                        
                    });
                }).fail(function(data){
                    
                });
            }
        });
    };

    function escapeHtml(unsafe){
        return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    }

    function formatDate(dateStr) 
    {
        const d = new Date(dateStr);
        var mm = String(d. getMonth() + 1). padStart(2, '0'); //January is 0!
        return d.getDate().toString().padStart(2, '0') + '/' + mm + '/' + d.getFullYear().toString().padStart(2, '0');
    };



</script>