
<script type="text/javascript">
    
    $(document).ready(function(){
        all_click();

        autocomplete_bcitem_str();

        autocomplete_bcitem_end();
    });

    function all_click() {  
        $('#btn_process_sign').click(function (e) { 
            e.preventDefault();

            $('#search_str_code').removeClass('is-warning');
            $('#search_end_code').removeClass('is-warning');

            if ($('#search_str_code').val() == '') {
                $('#search_str_code').addClass('is-warning');
            }

            if ($('#search_end_code').val() == '') {
                $('#search_end_code').addClass('is-warning');
            }

            if ($('#search_str_code').val() != '' &&
                $('#search_end_code').val() != ''
            ) {
                $('#search_str_code').removeClass('is-warning');
                $('#search_end_code').removeClass('is-warning');

                check_price_onBC();
            }
        });
    }

    function autocomplete_bcitem_str(){
		$("#search_str_code").autocomplete({
		source: function( request, response ) {
			$.ajax({
			type:'POST',
			url:'<?= site_url('SignV2/autocomplete_bcitem')?>',
			dataType:'JSON',
			data:{search_itemcode : $('#search_str_code').val()},
			}).done(function(data){

			response(data['BCITEM']);
			
			}).fail(function(data){

			});
		},
		autoFocus:true,
		delay: 0,
		minLength: 0,
		select: function( id,val ){
			$("#search_str_code").val(val.item.value);
            $("#search_end_code").val(val.item.value);
			// check_itemcode(val.item.value);
			return false;
		}

		}).autocomplete('instance')._renderItem = function(ul,item){
			return $('<li>')
			.append('<div>'+ '<span class="bg-green text-white">' + item.value + '</span>' + '<span"> [ ' + item.name1 + ' ] ' + item.name2 + '</span>' + '<br> ราคาขาย ' + item.SalePrice1 + '</div>')
			.appendTo(ul);
		};
	};

    function autocomplete_bcitem_end(){
		$("#search_end_code").autocomplete({
		source: function( request, response ) {
			$.ajax({
			type:'POST',
			url:'<?= site_url('SignV2/autocomplete_bcitem')?>',
			dataType:'JSON',
			data:{search_itemcode : $('#search_end_code').val()},
			}).done(function(data){

			response(data['BCITEM']);
			
			}).fail(function(data){

			});
		},
		autoFocus:true,
		delay: 0,
		minLength: 0,
		select: function( id,val ){
			$("#search_end_code").val(val.item.value);
			// check_itemcode(val.item.value);
			return false;
		}

		}).autocomplete('instance')._renderItem = function(ul,item){
			return $('<li>')
			.append('<div>'+ '<span class="bg-green text-white">' + item.value + '</span>' + '<span"> [ ' + item.name1 + ' ] ' + item.name2 + '</span>' + '<br> ราคาขาย ' + item.SalePrice1 + '</div>')
			.appendTo(ul);
		};
	};

    function check_price_onBC() {  
		swal({
			title: 'การประมวลผลข้อมูล',
			html: 'กรุณารอสักครู่',
			onOpen: () => {
			swal.showLoading()
			},
		});
        $.ajax({
            type: "post",
            url:'<?= site_url('SignV2/check_price_onBC')?>',
            data: {
               search_str : $('#search_str_code').val(),
               search_end : $('#search_end_code').val(),
			   search_signver : $('#select_sign_ver').val()
            },
            dataType: "json",
            success: function (data) {
				swal.close();
                console.log(data);
				$('#div_data_item').empty();
                var check_price = 0;
				var count = 0;
                $.each(data['Sign'],function(id,val){ 
					var y = 1 ;
					var i = 0;
					$.each(data['BCITEM'][id], function (id2, val2) { 
						if (parseFloat(val['field_new_price'+y+'']) != 0 && parseFloat(val['field_price'+y+'']) != 0) {
							if (parseFloat(val2['SalePrice1'],2) != parseFloat(val['field_new_price'+y+''],2)) {
								if (parseFloat(val2['SalePrice1'],2) != parseFloat(val['field_price'+y+''],2)) {
									if (parseFloat(val2['SalePrice1'],2) != 0 || parseFloat(val2['SalePrice1'],2) != null) {
										if (val2['SalePrice1'],2 != null) {
											// console.log(val2['SalePrice1']);

											// console.log(parseFloat(val2['SalePrice1'],2),parseFloat(val['field_new_price'+y+''],2),parseFloat(val['field_price'+y+''],2),val['field_id']);
											i++;
										}
									}
								}
							}else{
							}
						}
						y++
                	});

					if (i > 0) {
						count++;
						$('#div_data_item').append(
							'<div class="col-md-12">'+
								'<div class="card ">'+
									'<div class="card-header bg-secondary">'+
										'<h2 class="card-title">ตรวจสอบข้อมูลของรหัสสินค้า '+val['field_itemcode']+'</h2>'+
									'</div>'+
									'<div class="card-body">'+
										'<div class="row">'+
											'<div class="col-md-6">'+
												'<div class="card">'+
													'<div class="card-header bg-primary">'+
														'<h2 class="card-title">ข้อมูลที่แสดงในป้าย</h2>'+
													'</div>'+
													'<div class="card-body" id="item_list'+val['field_itemcode']+'">'+
													'</div>'+
												'</div>'+
											'</div>'+
											'<div class="col-md-6">'+
												'<div class="card">'+
													'<div class="card-header bg-info">'+
														'<h2 class="card-title">ข้อมูลสินค้าใน BC</h2>'+
													'</div>'+
													'<div class="card-body" id="BC_list'+val['field_itemcode']+'">'+
													'</div>'+
												'</div>'+
											'</div>'+
										'</div>'+
										'<div class="row">'+
											'<div class="col-md-12">'+
												'ประเภทราคาที่ต้องการ <b>'+val['type_name_price']+'</b> ขนาดป้ายที่ต้องการ <b>'+val['size_name']+'</b> จำนวนที่ต้องการ <b>'+val['field_signamount']+'</b> ป้าย'+
												' หมายเหตุ <b>'+val['field_comment']+'</b>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'
						);

                		// ข้อมูลป้าย
						for (var x = 0; x < 6; x++) {
							// console.log(val['field_new_price1']);

							if (val['field_type_sign_price'] == '4' || val['field_type_sign_price'] == '5' || val['field_type_sign_price'] == '6' || val['field_type_sign_price'] == '7') {
								if (val['field_unitcode'+x+''] != null) {
									if (val['field_rate'+x+''] != null) {
										if (x == 1) {
											$('#item_list'+val['field_itemcode']+'').append(
												'<div>'+
													'<label>สินค้า </label><span> '+val['field_fromQty'+x+'']+'<span> <label>'+val['field_unitcode'+x+'']+'</label>'+
													' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_new_price'+x+'']+'</span>'+
													' <label>บาท</label>'+
												'</div>'
											);
										}
										else{
											$('#item_list'+val['field_itemcode']+'').append(
												'<div>'+
													'<label>สินค้า </label><span> '+val['field_fromQty'+x+'']+'<span> <label>'+val['field_unitcode'+x+'']+'</label>'+
													' <label>มี</label> <span>'+val['field_rate'+x+'']+'</span> <label>'+val['field_unitcode1']+'</label>'+
													' <label>ราคา'+val['field_unitcode'+x+'']+'ละ</label> <span>  '+val['field_new_price'+x+'']+'</span>'+
													' <label>บาท</label>'+
												'</div>'
											);
										}                      
									}else{
										$('#item_list'+val['field_itemcode']+'').append(
											'<div>'+
												'<label>สินค้า </label><span> '+val['field_fromQty'+x+'']+'<span> <label>'+val['field_unitcode'+x+'']+'</label>'+
												' <label>ราคา'+val['field_unitcode'+x+'']+'ละ</label> <span>  '+val['field_new_price'+i+'']+'</span>'+
												' <label>บาท</label>'+
											'</div>'
										);
									}
								}
							}else{
								if (val['field_price'+x+''] != null) {
									if (val['field_rate'+x+''] != null) {
										if (i == 1) {
											$('#item_list'+val['field_itemcode']+'').append(
												'<div>'+
													'<label>สินค้า </label><span> '+val['field_fromQty'+x+'']+'<span> <label>'+val['field_unitcode'+x+'']+'</label>'+
													' <label>ราคา'+val['field_unitcode'+x+'']+'ละ</label> <span>  '+val['field_price'+x+'']+'</span>'+
													' <label>บาท</label>'+
												'</div>'
											);
										}
										else{
											$('#item_list'+val['field_itemcode']+'').append(
												'<div>'+
													'<label>สินค้า </label><span> '+val['field_fromQty'+x+'']+'<span> <label>'+val['field_unitcode'+x+'']+'</label>'+
													' <label>มี</label> <span>'+val['field_rate'+x+'']+'</span> <label>'+val['field_unitcode1']+'</label>'+
													' <label>ราคา'+val['field_unitcode'+x+'']+'ละ</label> <span>  '+val['field_price'+x+'']+'</span>'+
													' <label>บาท</label>'+
												'</div>'
											);
										}                      
									}else{
										$('#item_list'+val['field_itemcode']+'').append(
											'<div>'+
												'<label>สินค้า </label><span> '+val['field_fromQty'+x+'']+'<span> <label>'+val['field_unitcode'+x+'']+'</label>'+
												' <label>ราคา'+val['field_unitcode'+x+'']+'ละ</label> <span>  '+val['field_price'+x+'']+'</span>'+
												' <label>บาท</label>'+
											'</div>'
										);
									}

								}
							}
						}

						var y = 1 ;
						$.each(data['BCITEM'][id], function (id2, val2) { 
							if (val2['Rate'] != null) {
								if (id2 == 0) {
									$('#BC_list'+val['field_itemcode']+'').append(
										'<div>'+
											'<label>สินค้า </label><span> '+val2['FromQty']+'<span> <label>'+val2['DefSaleUnitCode']+'</label>'+
											' <label>ราคา'+val2['DefSaleUnitCode']+'ละ</label> <span>  '+val2['SalePrice1']+'</span>'+
											' <label>บาท</label>'+
										'</div>'
									);
								}else{
									$('#BC_list'+val['field_itemcode']+'').append(
										'<div>'+
											'<label>สินค้า </label><span> '+val2['FromQty']+'<span> <label>'+val2['DefSaleUnitCode']+'</label>'+
											' <label>มี</label> <span>'+val2['Rate']+'</span> <label>'+data['BCITEM'][id][0]['DefSaleUnitCode']+'</label>'+
											' <label>ราคา'+val2['DefSaleUnitCode']+'ละ</label> <span>  '+val2['SalePrice1']+'</span>'+
											' <label>บาท</label>'+
										'</div>'
									); 
								}
							}else{
								$('#BC_list'+val['field_itemcode']+'').append(
									'<div>'+
										'<label>สินค้า </label><span> '+val2['FromQty']+'<span> <label>'+val2['DefSaleUnitCode']+'</label>'+
										' <label>ราคา'+val2['DefSaleUnitCode']+'ละ</label> <span>  '+val2['SalePrice1']+'</span>'+
										' <label>บาท</label>'+
									'</div>'
								);
							}
							if ( val['field_type_sign_price'] == '5' || val['field_type_sign_price'] == '6' || val['field_type_sign_price'] == '7') {
								if (parseFloat(val2['SalePrice1'],2) != parseFloat(val['field_new_price'+y+''],2)) {
									check_price = 1

									// console.log(val2['SalePrice1'],val['field_new_price'+y+'']);
									$("#print_sign").prop('disabled', true);
								}
							}else{
								check_price = 0
								$("#print_sign").prop('disabled', false);
							}
							y++
						});

					}
                });

				// console.log(count);
            }
        });
    }

</script>