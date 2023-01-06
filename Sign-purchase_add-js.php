<script type="text/javascript">

    $(document).ready(function(){

        get_employee();
        autocomplete_bcitem();
        sign_type();
        $("#sign_date").datepicker("destroy");
        $("#sign_date").datepicker({dateFormat: 'yy-mm-dd',minDate: -0});

        all_click();
        select2();
    });

    function select2() { 
        $( "#sign_type" ).select2({
            theme: "bootstrap4"
        });
    }

    function all_click() {  

        $('#btn_confirm_change').click(function (e) { 
            e.preventDefault();
            window.open('<?php echo site_url('SignV2/purchase_confirm/');?>', '_blank');
        });

        $('#btn_saveone').click(function (e) { 
            e.preventDefault();
            $('#sign_type').addClass('is-valid');
            $('#sign_date').addClass('is-valid');

            if($('#sign_type').val() == '' ){
                $('#sign_type').addClass('is-invalid');
            } 

            if($('#sign_date').val() == '' ){
                $('#sign_date').addClass('is-invalid');
            }

            if($('#purchase_comment').val() == '' ){
                $('#purchase_comment').addClass('is-invalid');
            }

            if($('#sign_type').val() != '' 
            && $('#purchase_comment').val() != ''
            && $('#sign_date').val() != ''){
                $('#sign_type').addClass('is-valid');
                $('#sign_date').addClass('is-valid');
                $('#purchase_comment').addClass('is-valid');
                var type_save = 'one';
                validate(type_save);
            }
        });

        $('#btn_savestep').click(function (e) { 
            e.preventDefault();
            $('#sign_type').addClass('is-valid');
            $('#sign_date').addClass('is-valid');

            if($('#sign_type').val() == '' ){
                $('#sign_type').addClass('is-invalid');
            } 

            if($('#sign_date').val() == '' ){
                $('#sign_date').addClass('is-invalid');
            }

            if($('#purchase_comment').val() == '' ){
                $('#purchase_comment').addClass('is-invalid');
            }

            if($('#sign_type').val() != '' 
            && $('#purchase_comment').val() != ''
            && $('#sign_date').val() != ''){
                $('#sign_type').addClass('is-valid');
                $('#sign_date').addClass('is-valid');
                $('#purchase_comment').addClass('is-valid');
                var type_save = 'step';

                validate(type_save);
              
            }
        });

        $('#btn_saveunit').click(function (e) { 
            e.preventDefault();
            $('#sign_type').addClass('is-valid');
            $('#sign_date').addClass('is-valid');

            if($('#sign_type').val() == '' ){
                $('#sign_type').addClass('is-invalid');
            } 

            if($('#sign_date').val() == '' ){
                $('#sign_date').addClass('is-invalid');
            }

            if($('#purchase_comment').val() == '' ){
                $('#purchase_comment').addClass('is-invalid');
            }

            if($('#sign_type').val() != '' 
            && $('#purchase_comment').val() != ''
            && $('#sign_date').val() != ''){
                $('#sign_type').addClass('is-valid');
                $('#sign_date').addClass('is-valid');
                $('#purchase_comment').addClass('is-valid');
                var type_save = 'unit';

                validate(type_save);
              
            }
        });

        $('#select_item_submit').click(function(e) {
            e.preventDefault();
            if($('#tb_itemlist tr.select').length > 0){
                var itemcode = '';
                var i = 0;
                for( i ; i < $('#tb_itemlist tr.select').length; i++ ){
                    itemcode += $('#tb_itemlist tr.select').eq(i).attr('id')+',';
                }

                // console.log(itemcode);
                    $('#item_Modal').modal('hide');
                    check_itemcode(itemcode);
                }else{
                swal({
                    title: 'โปรดเลือกข้อมูลก่อน',
                    type: 'error',
                    timer: 3000
                });
            }
        });

        $('#tb_itemlist').delegate('tr', 'click', function(e) {
            if($(this).hasClass('select')){
                $(this).removeClass('select');
                $('#dataSelect tr#'+$(this).attr('id')).remove();
                if($('#tb_item tbody tr.select').length == 0){
                }
            }else{
                $(this).addClass('select');
                $(this).clone().appendTo('#dataSelect tbody');
                $('#dataSelect tr#'+$(this).attr('id')+' td.remove').remove();
                $('#dataSelect tr#'+$(this).attr('id')).removeClass('select');
            }
        });

        $('#search_listitem').keyup(function (e) { 
            e.preventDefault();
            itemlist(); 
        });

        $('#btn_multisearch').click(function (e) { 
            e.preventDefault();
            $('#item_Modal').modal('show');
            itemlist();
        });

        $(document).on('click','.remove_addsign',function(){
            remove_addsign(
				$(this).closest('tr').find('.Code').text(),
            );
		});

        $('#sign_type').change(function (e) {
            e.preventDefault();
            var sign_type = '';
            sign_type = $('#sign_type').val();
            console.log(sign_type);

            if(sign_type == '6' || sign_type == '7' || sign_type == '8' || sign_type == '18' ){ 
                $('#tb_addsign_row').removeClass('hidden');
                $('#div_changePrice').removeClass('hidden');
                $('#tb_addsign_sub_row').removeClass('hidden');
                $('#btn_confirm_change').removeClass('hidden');
                $('.NewPrice').prop('readonly', false);
            }else if(sign_type == '1' || sign_type == '2' || sign_type == '3' || sign_type == '4' || sign_type == '5' || sign_type == '12' || sign_type == '19'){
                $('#tb_addsign_row').removeClass('hidden');
                $('#div_changePrice').removeClass('hidden');
                $('#tb_addsign_sub_row').removeClass('hidden');
                $('#btn_confirm_change').removeClass('hidden');
                $('.NewPrice').val('');
                $('.NewPrice').prop('readonly', true);
            }else{
                $('#tb_addsign_row').addClass('hidden');
                $('#div_changePrice').removeClass('hidden');
                $('#tb_addsign_sub_row').addClass('hidden');
                $('#btn_confirm_change').addClass('hidden');
                $('.NewPrice').val('');
                $('.NewPrice').prop('readonly', true);
            }
        });
    }

    function validate(type_save){
        var tb_addsign = [];
            $('#tb_addsign').find('tr').each(function(){
            var tb_addsign_list = {};
            tb_addsign_list['Code'] = $(this).find('.Code').text();
            tb_addsign_list['Name1'] = $(this).find('.Name1').text();
            tb_addsign_list['GroupCode'] = $(this).find('.GroupCode').text();
            tb_addsign_list['sign_type'] = $('#sign_type').val();
            tb_addsign_list['sign_creator'] = $('#sign_creator_id').val();
            tb_addsign_list['date_change'] = $('#sign_date').val();
            tb_addsign_list['purchase_comment'] = $('#purchase_comment').val();
            tb_addsign.push(tb_addsign_list);
        });

        var tb_addsign_sub = [];
            $('#tb_addsign_sub').find('tr').each(function(){
            var tb_addsign_sub_list = {};
            tb_addsign_sub_list['Code'] = $(this).find('.Code').text();
            tb_addsign_sub_list['Name1'] = $(this).find('.Name1').text();
            tb_addsign_sub_list['GroupCode'] = $(this).find('.GroupCode').text();
            tb_addsign_sub_list['SalePrice1'] = $(this).find('.SalePrice1').val();
            tb_addsign_sub_list['Oldprice'] = $(this).find('.NewPrice').val();
            tb_addsign_sub.push(tb_addsign_sub_list);
        });

        var check_price = '0';

        if (type_save == 'one') {
            $.each(tb_addsign_sub, function (idx, val) { 
                var total = 0;
                total = parseFloat(val['SalePrice1']) - parseFloat(val['Oldprice']);
                if (total == 0) {
                    check_price = '1';
                }
            });

            if ($('#changePrice').is(":checked"))
            {
                check_price = '0';
            }

            if (check_price == 1) {
                swal({
                    type: 'warning',
                    title: 'ต้องปรับราคาให้เพิ่มหรือลด<br>ถึงจะบันทึกข้อมูลได้',
                    allowOutsideClick: false,
                });
            }
            else{
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
                        //  console.log(tb_addsign,tb_addsign_sub);
                        save(tb_addsign,tb_addsign_sub);
                    }
                });
            }
        }
        else if(type_save == 'step'){
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
                    //   console.log(tb_addsign,tb_addsign_sub);
                    save_step(tb_addsign,tb_addsign_sub);
                }
            });
        }
        else if(type_save == 'unit'){
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
                    //   console.log(tb_addsign,tb_addsign_sub);
                    save_step(tb_addsign,tb_addsign_sub);
                }
            });
        }
    };

    function save(tb_addsign,tb_addsign_sub){
        $.ajax({
            type:'POST',
            url:'<?= site_url('SignV2/save')?>',
            dataType:'JSON',
            data:{
                tb_addsign : tb_addsign,
                tb_addsign_sub : tb_addsign_sub,
                sign_type : $('#sign_type').val(),
                sign_date : $('#sign_date').val(),
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

        });
    };

    function save_step(tb_addsign,tb_addsign_sub){
        $.ajax({
            type:'POST',
            url:'<?= site_url('SignV2/save_step_model')?>',
            dataType:'JSON',
            data:{
                tb_addsign : tb_addsign,
                tb_addsign_sub : tb_addsign_sub,
                sign_type : $('#sign_type').val(),
                sign_date : $('#sign_date').val()
            },
        }).done(function(data){
            // console.log(data);
            swal({ 
                title: 'บันทึกข้อมูลสำเร็จ',
                type: 'success',
            }).then((result) => {
                if (result.value) { 
                    location.reload();
                }
            });
        }).fail(function(data){

        });
    };

    function itemlist() {  
        var search_itemcode = $('#search_listitem').val();
        $.ajax({
            type: "POST",
			url:'<?= site_url('SignV2/search_itemlist')?>',
            data: {search_itemcode : search_itemcode},
            dataType: "JSON",
            success: function (data) {
                $('#tb_itemlist').empty();
                $.each(data['ic_inventory'], function (id, val) { 
                    $('#tb_itemlist').append(
                        '<tr id="'+val['code']+'">'+
                            '<td>'+val['code']+'</td>'+
                            '<td>'+val['name_1']+'</td>'+
                            '<td>'+val['name_2']+'</td>'+
                            // '<td>'+val['SalePrice1']+'</td>'+
                            '<td>'+val['unit_standard_name']+'</td>'+
                        '</tr>'
                    );
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
			check_itemcode(val.item.code);
			return false;
		}

		}).autocomplete('instance')._renderItem = function(ul,item){
			return $('<li>')
			.append('<div>'+ '<span class="bg-green text-white">' + item.code + '</span>' + '<span"> [ ' + item.name_1 + ' ] ' + item.name_2 + '</span></div>')
			.appendTo(ul);
		};
	};

    function check_itemcode(Code) {  
        var status = 'add';
        $.ajax({
            type: "POST",
			url:'<?= site_url('SignV2/check_itemcode')?>',
			data:{itemcode : Code},
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                if (data['check_itemcode'] == 'have') {
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
                            add_item(Code);
                        }
                    });
                }else{
                    $('#search_itemcode').val('');
                    add_item(Code)
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
                $('#sign_type').empty();
                $('#sign_type').append(
                    '<option value="">เลือกสาเหตุ</option>'
                );
                $.each(data, function (ida, val) {
                    if (val['id'] == '9' || val['id'] == '10' || val['id'] == '11' || val['id'] == '13' || val['id'] == '14' || val['id'] == '15' || val['id'] == '16' ) {
                    }
                    else {
                        $('#sign_type').append(
                          '<option value="'+val['id']+'">'+val['type_name']+'</option>'
                        );
                    }
                });
            }
        });
    };

    function add_item(itemcode) {
        getsign_type =  $('#sign_type').val();
        status = 'add';
        $.ajax({
            type: "POST",
            url:'<?= site_url('SignV2/get_bcitem')?>',
            data:{itemcode : itemcode},
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                $.each(data['ic_inventory'], function (id, val) { 
                    $('#tb_addsign').find('tr').each(function(){
                        if($(this).find('.Code').text() == val['code']){
                            swal({
                                type: 'error',
                                title: 'รหัสสินค้านี้มีอยู่แล้ว',
                                allowOutsideClick: false,
                            });
                            status = 'duplicate';
                        }
                    });
                });

                if (status == 'add') {
                    $.each(data['ic_inventory'], function (id, val) { 
                        btn_delete = '<button type="button" class="btn btn-sm bg-red btn_delete remove_addsign">ลบ</button>  ';
                        $('#tb_addsign').prepend(
                            '<tr id="tb_addsign'+val['code']+'">' +
                                '<td  width="5%" class="text-left no"></td>'+
                                '<td  class="text-center GroupCode hidden">'+val['group_main']+'</td>'+
                                '<td width="10%" class="text-left Code">'+val['code']+'</td>'+
                                '<td width="25%" class="text-left Name1">'+val['name_1']+'</td>'+
                                '<td width="25%" class="text-left DefSaleUnitCode">'+val['unit_standard']+'</td>'+
                                '<td width="5%" style="padding-top:10px;" class="text-right btn-block">'+ btn_delete +'</td>'+
                            '</tr>'
                        );
                    });

                    $.each(data['ic_unit_use'], function (id2, val) { 

                        var price = 0;
                        if (val['sale_price2'] != null) {
                            price = val['sale_price2'];
                        }else{
                            $.each(data['ic_inventory_price'], function (id3, val2) { 
                                if (val['unit_code'] == val2['unit_code']) {
                                    price = val2['price_0'];
                                }
                            });
                        }
                        // console.log(id2);
                        var SalePrice1 = '<input type="text" class="form-control sub_focus SalePrice1 text-right" value="'+round(price,4)+'" readonly>';
                        if(getsign_type == '6' || getsign_type == '7' || getsign_type == '8' || getsign_type == '18'){
                            var NewPrice = '<input type="number" class="form-control sub_focus NewPrice text-right" id="newprice'+val['ic_code']+id2+'" step="any">';
                        }
                        else{
                            var NewPrice = '<input type="number" class="form-control sub_focus NewPrice text-right" step="any" readonly>';
                        }
                        $('#tb_addsign_sub').prepend(
                            '<tr id="tb_addsign_sub'+val['ic_code']+'">' +
                                '<td class="id hidden">'+val['ic_code']+id2+'</td>'+
                                '<td  class="text-center GroupCode hidden">'+val['group_main']+'</td>'+
                                '<td width="10%" class="text-left Code">'+val['ic_code']+'</td>'+
                                '<td width="25%" class="text-left Name1">'+val['name_1']+'</td>'+
                                '<td width="25%" class="text-left DefSaleUnitCode">'+val['unit_code']+'</td>'+
                                '<td width="20%" style="padding:0px;">' + SalePrice1 + '</td>'+
                                '<td width="25%" style="padding:0px;">' + NewPrice + '</td>'+
                                '<td width="5%" style="padding-top:8px;font-size:16px" id="change_p'+val['ic_code']+id2+'"></td>'+
                            '</tr>'
                        );

                        $('#newprice'+val['ic_code']+id2+'').bind('keyup mouseup', function () {
                             
                            var newprice_txt = $('#newprice'+val['ic_code']+id2+'').val();
                            var newprice = parseInt(newprice_txt);
                            var oldprice = parseInt(price);
                            var total_change = 0;
                            total_change = newprice - oldprice;
                            if (total_change > 0) {
                                change_price = '<span style="color:green;">+'+total_change+'</span>';
                            }
                            else if (total_change < 0) {
                                change_price = '<span style="color:red;">'+total_change+'</span>';
                            }
                            else if (total_change == 0) {
                                change_price = '<span >0</span>';
                            }
                            else if(newprice_txt == ''){
                                change_price = '';
                            }

                            $('#change_p'+val['ic_code']+id2+'').empty();
                            $('#change_p'+val['ic_code']+id2+'').append(change_price);      
                        });

                        $('#newprice'+val['ic_code']+id2+'').keyup(function (e) { 
                            e.preventDefault();
                            var newprice_txt = $('#newprice'+val['ic_code']+id2+'').val();
                            var newprice = parseInt(newprice_txt);
                            var oldprice = parseInt(price);
                            var total_change = 0;
                            total_change = newprice - oldprice;
                            if (total_change >= 1) {
                                change_price = '<span style="color:green;">+'+total_change+'</span>';
                            }
                            else if (total_change < 0) {
                                change_price = '<span style="color:red;">'+total_change+'</span>';
                            }
                            else if (total_change == 0) {
                                change_price = '<span >0</span>';
                            }
                            else if(newprice_txt == ''){
                                change_price = '';
                            }
                            $('#change_p'+val['ic_code']+id2+'').empty();
                            $('#change_p'+val['ic_code']+id2+'').append(change_price);
                        });
                    });
                }

                run_no();
                count_addsign();
            }
        });
    }

    function remove_addsign(Code){
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
				// $(input).closest('tr').remove();

                $('#tb_addsign'+Code).remove();

                $('#tb_addsign_sub > tr').each(function(index, tr){ 
                    $('#tb_addsign_sub'+Code).remove();
                });


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

    function round(value, decimals) 
    { 
        return Number(Math.round(value+'e'+decimals)+'e-'+decimals); 
    }

</script>