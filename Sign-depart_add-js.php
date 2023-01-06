

<script type="text/javascript">

    $(document).ready(function(){
        all_click();
        var addcon_person = [];
        var type_price = '';
        var price = '';
        get_employee();
        autocomplete_bcitem();
        sign_type();
        select2();
        confirm_sign_size(type_price);
        confirm_sign_type_price(price);

        $("#confirmsign_date").datepicker("destroy");
        $("#confirmsign_date").datepicker({dateFormat: 'yy-mm-dd',minDate: -0});

    });

    function select2() { 
        $( "#sign_type" ).select2({
            theme: "bootstrap4"
        });
    }

    function all_click() {  

        $(document).on('click','.remove_addsign',function(){
			remove_sign(this);
		});

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

        $('#addrow_signsub').click(function (e) { 
            e.preventDefault();
            add_rowsignsub();

            get_select_place();

            var type_price = '';
            var price = $('#input_select_type_price').val();
            confirm_sign_size(type_price);
            confirm_sign_type_price(price);
        });

        $(document).on('click','.rowDel',function(){
            remove_addsign(
				$(this).closest('tr').find('.numrow').text(),
            );
		});

        $('#formData_save').submit(function(e){
            e.preventDefault();

            $('#sign_type').addClass('is-valid');
            $('#sign_date').addClass('is-valid');

            if($('#sign_type').val() == '' ){
                $('#sign_type').addClass('is-invalid');
            } 

            if($('#sign_date').val() == '' ){
                $('#sign_date').addClass('is-invalid');
            }

            if($('#sign_type').val() != '' 
            && $('#sign_date').val() != ''){

                // validate();
            }

        });

        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();       
            count_sign -= 1
        });

        $('.confirmsign_type_price').change(function (e) { 
            e.preventDefault();
            var type_price = $('.confirmsign_type_price').val();
            // console.log(type_price);
            confirm_sign_size(type_price);
        });

        $('#sign_type').change(function (e) { 
            e.preventDefault();
            var sign_type = '';
            sign_type = $('#sign_type').val();
            
            if(sign_type != ''){ 
                $('#tb_addsign_row').removeClass('hidden');
                $('#confirm_manage_row').removeClass('hidden');

            }else{
                $('#tb_addsign_row').addClass('hidden');
                $('#confirm_manage_row').addClass('hidden');
            
            }
        });

    
        $('#submit_confirm').click(function(){
            $('#sign_type').addClass('is-valid');
            $('#confirmsign_comment').addClass('is-valid');
            $('#confirmsign_date').addClass('is-valid');

            $('.confirmsign_place').addClass('is-valid');
            $('#confirmsign_size').addClass('is-valid');
            $('#confirmsign_amount').addClass('is-valid');
            
            if($('#sign_type').val() == '' ){
                $('#sign_type').addClass('is-invalid');
            }

            if($('#confirmsign_comment').val() == '' ){
                $('#confirmsign_comment').addClass('is-invalid');
            }

            if($('#confirmsign_date').val() == '' ){
                $('#confirmsign_date').addClass('is-invalid');
            }

            if($('.confirmsign_place').val() == '' ){
                $('.confirmsign_place').addClass('is-invalid');
            }

            if($('#confirmsign_size').val() == '' ){
                $('#confirmsign_size').addClass('is-invalid');
            }


            if($('#confirmsign_amount').val() == '' ){
                $('#confirmsign_amount').addClass('is-invalid');
            }

            if($('#sign_type').val() != '' 
            && $('#confirmsign_comment').val() != '' 
            && $('#confirmsign_date').val() != '' 
            && $('#confirmsign_place').val() != ''
            && $('#confirmsign_size').val() != ''
            && $('#confirmsign_amount').val() != ''){
                
                validate_comfirm();
            }

        });

       
    };

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

    function sign_type() 
    { 
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/sign_type')?>",
            dataType: "json",
            success: function (data) {
                // console.log(data);
                $('#sign_type').empty();

                $('#sign_type').append(
                    '<option value="">เลือกสาเหตุ</option>'
                );
                $.each(data, function (ida, val) {
                    if (val['id'] == '2' || val['id'] == '9' || val['id'] == '10' || val['id'] == '11' || val['id'] == '13' ||  val['id'] == '14' || val['id'] == '15' || val['id'] == '16') {
                        $('#sign_type').append(
                          '<option value="'+val['id']+'">'+val['type_name']+'</option>'
                        );
                    }
                });
            }
        });
    };

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
                    '<b class="type_price">ประเภทราคา <span class="text-danger">'+$('#detail_typeitem').val()+'</span></b>'+
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
            $('#item_code_select').val(val.item.code);
			check_itemcode(val.item.code);

            get_select_place();
			return false;
		}

		}).autocomplete('instance')._renderItem = function(ul,item){
			return $('<li>')
			.append('<div>'+ '<span class="bg-green text-white">' + item.code + '</span>' + '<span"> [ ' + item.name_1 + ' ] ' + item.name_2 + '</span></div>')
			.appendTo(ul);
		};
	};

    function check_itemcode(Code){
        var status = 'add';
        // console.log(Code);
        active_sign(Code);
        $.ajax({
			type:'POST',
			url:'<?= site_url('SignV2/check_itemcode')?>',
			dataType:'JSON',
			data:{itemcode : Code},
		}).done(function(data){
            console.log(data);
        if(data['check_itemcode'] == 'have'){
            addcon_person = 'add_again';
            swal({
                title: 'มีรหัสสินค้านี้ รอดำเนินการอยู่แล้ว<br>เลขที่เอกสาร'+data['data'][0]['field_docno']+'<br>สถานที่ติดตั้ง '+data['data'][0]['field_place_name']+'',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1AA45F',
                cancelButtonColor: '#DB4B3F',
                confirmButtonText: 'เพิ่มใหม่',
                cancelButtonText: 'ยกเลิก',
                }).then((result) => {
              
                if (result.value){
                    
                    itemcode = $('#search_itemcode').val();
                    $('#search_itemcode').val('');
                    getsign_type =  $('#sign_type').val();

                    $.ajax({
                        type:'POST',
                        url:'<?= site_url('SignV2/get_bcitem')?>',
                        dataType:'JSON',
                        data:{itemcode : itemcode},
                    }).done(function(data){

                        console.log(data);
                        if(status == 'add'){
                            btn_delete = '<button type="button" class="btn btn-sm bg-red btn_delete remove_addsign">ลบ</button>  ';
                            $('#tb_addsign').prepend(
                            '<tr id="'+data['ic_inventory'][0]['Code']+'">'+
                                '<td  width="5%" class="text-center no"></td>'+
                                // '<td  class="text-center date_change hidden">'+data['BCITEM'][0]['lastEditDateT']+'</td>'+
                                '<td  class="text-center groupcode hidden">'+data['ic_inventory'][0]['group_main']+'</td>'+
                                '<td width="30%" class="text-left Code">'+
                                    data['ic_inventory'][0]['code']+
                                '</td>'+
                                '<td width="30%" class="text-left Name1">'+data['ic_inventory'][0]['name_1']+'</td>'+
                                '<td width="10%" style="padding:0px;" class="text-center">'+ btn_delete +'</td>'+
                            '</tr>');

                            var i = 0;
                            var BCPrice = [];
                            $.each(data['ic_unit_use'], function (idx, val) { 
                                BCPrice[i] = val['unit_code'];
                                i++;
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

                            // console.log(data['ic_inventory_price']);

                            if (data['ic_inventory_price'][0]['price_0'] == '.00') {
                                var price = '8';
                                confirm_sign_type_price(price);
                                $('#input_select_type_price').val(price);
                                $('.confirmsign_type_price').val('8');
                                confirm_sign_size(8);
                            }else{
                                var price = '';
                                $('#input_select_type_price').val(price);
                                confirm_sign_type_price(price);
                                $('.confirmsign_type_price').val(price);
                                confirm_sign_size(price);
                            }
                            console.log($('#detail_typeitem').val());

                            $('#unit_code_type').text($('#detail_typeitem').val());

                        }else{
                        }

                        run_no();
                        count_addsign();
                    
                        }).fail(function(data){
                        $('#search_itemcode').val('');
                     
                    });
                    
                }else{
                    $('#search_itemcode').val('');
                }
            });

        }else if(data['check_itemcode'] == 'no_have' || data == null){
            addcon_person = '';
            itemcode = $('#search_itemcode').val();
			$('#search_itemcode').val('');

            getsign_type =  $('#sign_type').val();

			$.ajax({
				type:'POST',
				url:'<?= site_url('SignV2/get_bcitem')?>',
				dataType:'JSON',
				data:{itemcode : itemcode},
			}).done(function(data){
               
                console.log(data)
				if(status == 'add'){
					btn_delete = '<button type="button" class="btn btn-danger btn_delete remove_addsign">ลบ</button>  ';

                    $('#tb_addsign').prepend(
                    '<tr id="'+data['ic_inventory'][0]['code']+'">'+

                        '<td  width="5%" class="text-center no"></td>'+
                        // '<td  class="text-center date_change hidden">'+data['BCITEM'][0]['lastEditDateT']+'</td>'+
                        '<td  class="text-center groupcode hidden">'+data['ic_inventory'][0]['group_main']+'</td>'+
                        '<td width="30%" class="text-left Code">'+
                            data['ic_inventory'][0]['code']+
                        '</td>'+

                        '<td width="30%" class="text-left Name1">'+data['ic_inventory'][0]['name_1']+'</td>'+
                        '<td width="10%" style="padding:0px;" class="text-center">'+ btn_delete +'</td>'+
                    '</tr>');
                    // if(data['BCITEM'][0]['UnitType'] == 1){
                    //     get_bcstkpacking(data['BCITEM'][0]['Code']);
                    // }

                    var i = 0;
                    var BCPrice = [];
                    $.each(data['ic_inventory_price'], function (idx, val) { 
                        BCPrice[i] = val['unit_code'];
                        i++;
                    });
                    // console.log(data['BCITEM']);

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

                   $('.type_price').empty();
                   $('.type_price').append(
                       'ประเภทราคา <span class="text-danger">'+$('#detail_typeitem').val()+'</span>'
                   );

                    if (data['ic_inventory_price'][0]['price_0'] == '.00') {
                        var price = '8';
                        $('#input_select_type_price').val(price);
                        confirm_sign_type_price(price);
                        $('.confirmsign_type_price').val(price);
                        confirm_sign_size(price);
                    }else{
                        var price = '';
                        $('#input_select_type_price').val(price);
                        confirm_sign_type_price(price);
                        $('.confirmsign_type_price').val(price);
                        confirm_sign_size(price);
                    }

                    console.log($('#detail_typeitem').val());

                    $('#unit_code_type').text($('#detail_typeitem').val());

                }else{
				}

                run_no();
                count_addsign();
			
				}).fail(function(data){
					$('#search_itemcode').val('');
				});
			
			}

			}).fail(function(data){
			$('#search_itemcode').val('');
			
		});

	};

    //ดึงข้อมูลหลายหน่วยนับ
    function get_bcstkpacking(Code){
		$.ajax({
			type:'POST',
			url:'<?= site_url('SignV2/get_bcstkpacking')?>',
			dataType:'JSON',
			data:{Code : Code},
		}).done(function(data){

            // console.log(data)

			$.each(data['BCPriceList'],function(id,value){
				$('#'+Code).find('.DefSaleUnitCode').append('<option value="'+value['UnitCode']+'">'+value['UnitCode']+'</option>');
			});

			$('#'+Code).find('.DefSaleUnitCode').val(data['BCITEM'][0]['DefSaleUnitCode']);
		
		}).fail(function(data){
			console.log(data['responseText']);
		});
	};

    function remove_sign(input){
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
				$('#unit_code_type').text('');
				$(input).closest('tr').remove();
				count_addsign();
				run_no();
			}
		});
	};

  
    // ดึงข้อมูลราคาหลายหน่วยนับ
    function get_packingrate(input,UnitCode){

		$.ajax({
			type:'POST',
			url:'<?= site_url('SignV2/get_packingrate')?>',
			dataType:'JSON',
			data:{
            Code : $(input).find('.Code').text(),
            UnitCode : UnitCode 
            },
		}).done(function(data){

            // console.log(data)
			
			$(input).find('.Rate').val(data['Rate'][0]['Rate']);
			$(input).find('.SalePrice1').val(parseFloat(data['Rate'][0]['SalePrice1']).toFixed(2));
			
			count_addsign();

		}).fail(function(data){
			console.log(data['responseText']);
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

        var tb_addsign = [];

            $('#tb_addsign').find('tr').each(function(){
            var tb_addsign_list = {};
            tb_addsign_list['Code'] = $(this).find('.Code').text();
            tb_addsign_list['Name1'] = escapeHtml($(this).find('.Name1').text());
            tb_addsign_list['GroupCode'] = $(this).find('.groupcode').text();
            tb_addsign.push(tb_addsign_list);
        });

        var tb_dosign = [];
        $('#tbody_addsignsub').find('tr').each(function(){
            var tb_dosigns = {};
            tb_dosigns['Code'] = $('.Code').text();
            tb_dosigns['confirmsign_comment'] = $(this).find('.comment').val();
            tb_dosigns['GroupCode'] = $('#tb_addsign').find('.groupcode').text();
            tb_dosigns['Name1'] =  escapeHtml($('#tb_addsign').find('.Name1').text());
            tb_dosigns['confirmsign_place'] = $(this).find('.confirmsign_place').val();
            tb_dosigns['confirmsign_size'] = $(this).find('.confirmsign_size').val();
            tb_dosigns['confirmsign_amount'] = $(this).find('.confirmsign_amount').val();
            tb_dosigns['confirmsign_type_price'] = $(this).find('.confirmsign_type_price').val();
            tb_dosign.push(tb_dosigns);
        });

        var status_destroy = 0;
        var destroy_id = '';
        // var field_sign_id = '';
        var i = 0;
        for( i ; i < $('#detail_active tr.select').length; i++ ){
            destroy_id += $('#detail_active tr.select').eq(i).attr('id')+',';
        }

        if ($('#sign_type').val() == '2' || $('#sign_type').val() == '9' || $('#sign_type').val() == '14' || $('#sign_type').val() == '15') {
            if (destroy_id != '') {
                status_destroy = 1;
            }else{
                status_destroy = 0;
            }
        }else{
            status_destroy = 1;
        }
        
        if (status_destroy == 1) {
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
                    if (tb_addsign == '') {
                        swal({
                        title:'เตือน',
                        text: "กรุณาเลือกสินค้า",
                        type: 'warning',
                        confirmButtonColor:'#6c757d',
                        confirmButtonText:'ปิด',
                        });
                    }
                    else {
                        // console.log(tb_addsign,tb_dosign);
                        depart_addsign(tb_addsign,tb_dosign,destroy_id);
                    }
                    // depart_addsign(tb_addsign,tb_dosign);
                }
            });
        }else{
            swal({
                title: 'ผิดพลาด',
                text: "กรุณาเลือกป้ายทำลาย",
                type: 'warning'
            });
        }

    };

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

                $( ".confirmsign_size" ).select2({
                    theme: "bootstrap4"
                });
            }
        });
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

                $( ".confirmsign_type_price" ).select2({
                    theme: "bootstrap4"
                });
            }
        });
    };

    function active_sign(item_code) {  
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/active_sign')?>",
            data: {item_code:item_code},
            dataType: "json",
            success: function (data) {
                // console.log(data['sign_old']);
                $('#detail_active').empty();
                $.each(data['sign_old'], function (id, val) {
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
                    
                    $('#detail_active').append(
                        '<tr id="'+val['field_old_id']+'">'+
                            '<td hidden class="field_id">'+ val['field_old_id'] +'</td>'+
                            '<td width="20%">'+docno+'</td>'+
                            '<td width="30%" style="text-align:left;">'+ val['field_place_name'] +'</td>'+
                            '<td width="20%" style="text-align:left;">'+ val['size_name'] +'</td>'+
                            '<td width="20%" style="text-align:left;">'+ type_sign_price +'</td>'+
                            '<td class="text-right" width="10%">'+val['sign_amount']+'</td>'+
                        '</tr>'
                    );
                });

                $('#count_active').text($('#detail_active').find('tr').length);
            }
        });
    }

    function depart_addsign(tb_addsign,tb_dosign,destroy_id){
        var destroy_status = 0;
        if (destroy_id == '') {
            destroy_status = 0;
        }else{
            destroy_status = 1;
        }

        var doit = '0';
        if ($('#doit_yourself').is(":checked"))
        {
            doit = '1';
        }
        // console.log(tb_addsign,tb_dosign,destroy_id);
        $.ajax({
            type:'POST',
            url:'<?= site_url('SignV2/depart_addsign')?>',
            dataType:'JSON',
            data: {
                sign_type :$('#sign_type').val(),
                destroy_status : destroy_status,
                destroy_id : destroy_id,
                tb_addsign : tb_addsign,
                tb_dosign : tb_dosign,
                confirmsign_comment :$('#confirmsign_comment').val(),
                confirmsign_needdate :$('#confirmsign_date').val(),
                field_confirm_status : '1',
                doit : doit
            },
        }).done(function(data){
        swal({ 
            title: 'บันทึกข้อมูลสำเร็จ',
			type: 'success',
        }).then((result) => {
            if (result.value) {
                location.reload();
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

    function get_select_place() {  
        var item_code = $('#item_code_select').val();

        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_select_place')?>",
            data: {
                item_code : item_code
            },
            dataType: "json",
            success: function (data) {

                $('.confirmsign_place').empty();
                $('.confirmsign_place').append(
                    '<option value="">เลือกสถานที่ติดตั้ง</option>'
                );

                $.each(data, function (ind, val) { 
                    $('.confirmsign_place').append(
                        '<option value="'+val['field_place_id']+'">'+val['field_place_name']+'</option>'
                    );
                });

                $( ".confirmsign_place" ).select2({
                    theme: "bootstrap4"
                });
            }
        });
    }

    function escapeHtml(unsafe){
        return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    };

    function save_addcon() { 
        $.ajax({
            type:'POST',
            url:'<?= site_url('Sign/save_addcon')?>',
            dataType:'JSON',
            success: function (data) {
                
            }
        });
    };


</script>