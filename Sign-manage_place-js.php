
<script type="text/javascript">
    $(document).ready(function () {
        $('#place_vertion_old').hide();
        $('#place_newvertion_add').hide();
        $('#item_info').hide();
        autocomplete_bcitem();
        all_click();    
    });

    function all_click() {  
        $('#btn_search').click(function (e) { 
            e.preventDefault();
            sg_detail();
            // get_select_place();
        });

        $('#btn_add_place').click(function (e) { 
            e.preventDefault();
            var place_name = $('#input_add_place').val();
            var itemcode = $('#search_itemcode').val();
            if (place_name == '') {
                swal({
                  title:'เตือน',
                  text: "กรุณากรอกชื่อสถานที่",
                  type: 'warning',
                  confirmButtonColor:'#6c757d',
                  confirmButtonText:'ปิด',
                });
            }
            else if (place_name != '') {
                $.ajax({
                    type: "post",
                    url:'<?= site_url('SignV2/insert_place')?>',
                    data: {
                        place_name:place_name,
                        itemcode:itemcode
                    },
                    dataType: "json",
                    success: function (data) {
                        swal({ 
                            title: 'สำเร็จ',
                            text: "บันทึกข้อมูลเรียบร้อย",
                            type: 'success',
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        }).then((result) => {
                            $('#input_add_place').val('');
                            get_select_place();
                		});
                    }
                });
            }
        });

        $('#btn_change_place').click(function (e) { 
            e.preventDefault();
            swal({
				title: 'การประมวลผลข้อมูล',
				html: 'กรุณารอสักครู่',
				onOpen: () => {
				swal.showLoading()
				},
			});
            $.ajax({
                type: "post",
                url:'<?= site_url('SignV2/change_place')?>',
                dataType: "json",
                success: function (data) {
                    swal.close();
                    console.log(data);
                    swal({ 
                        title: 'สำเร็จ',
                        text: "บันทึกข้อมูลเรียบร้อย",
                        type: 'success',
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                    }).then((result) => {
                        // $('#input_add_place').val('');
                        // get_select_place();
					});
                }
            });
        });

        $('#btn_loaddata_place').click(function (e) { 
            e.preventDefault();
            swal({
				title: 'การประมวลผลข้อมูล',
				html: 'กรุณารอสักครู่',
				onOpen: () => {
				swal.showLoading()
				},
			});
            $.ajax({
                type: "post",
                url:'<?= site_url('SignV2/loaddata_place')?>',
                dataType: "json",
                success: function (data) {
                    swal.close();
                    console.log(data);
                    // swal({ 
                    //     title: 'สำเร็จ',
                    //     text: "บันทึกข้อมูลเรียบร้อย",
                    //     type: 'success',
                    //     confirmButtonColor: '#6c757d',
                    //     confirmButtonText: 'ปิด' ,
                    // }).then((result) => {
                    //     $('#input_add_place').val('');
                    //     get_select_place();
					// });
                }
            });
            
        });

        $('#select_place').change(function (e) { 
            e.preventDefault();
            
            var place_id = $('#select_place').val();
            $.ajax({
                type: "post",
                url: "<?= site_url('SignV2/get_signold_inplace')?>",
                data: {
                    place_id : place_id
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $('#detail_signold').empty();
                    if (data == '') {
                        $('#detail_signold').append(
                            '<span>ยังไม่มีป้ายในสถานที่นี้</span>'
                        );
                    }
                    else if (data != '') {
                        $.each(data, function (idx, val) { 
                            $('#detail_signold').append(
                                '<span>ขนาด '+val['size_name']+' จำนวน '+val['sign_amount']+' ป้าย</span><br>'
                            );
                        });
                    }

                }
            });
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
            get_item_info(val.item.code);
            // $('#place_vertion_old').show();
            $('#place_newvertion_add').show();
            $('#item_info').show();
            get_select_place();
			return false;
		}

		}).autocomplete('instance')._renderItem = function(ul,item){
			return $('<li>')
			.append('<div>'+ '<span class="bg-green text-white">' + item.code + '</span>' + '<span"> [ ' + item.name_1 + ' ] ' + item.name_2 + '</span></div>')
			.appendTo(ul);
		};
	};


    // function autocomplete_bcitem(){
	// 	$("#search_itemcode").autocomplete({
	// 	source: function( request, response ) {
	// 		$.ajax({
	// 		type:'POST',
	// 		url:'<?= site_url('SignV2/autocomplete_bcitem')?>',
	// 		dataType:'JSON',
	// 		data:{search_itemcode : $('#search_itemcode').val()},
	// 		}).done(function(data){
	// 		response(data['BCITEM']);
	// 		}).fail(function(data){

	// 		});
	// 	},
	// 	autoFocus:true,
	// 	delay: 0,
	// 	minLength: 0,
	// 	select: function( id,val ){
	// 		$("#search_itemcode").val(val.item.value);
    //         // get_sign_place_old_list(val.item.value);
    //         get_item_info(val.item.value);
    //         // $('#place_vertion_old').show();
    //         $('#place_newvertion_add').show();
    //         $('#item_info').show();
    //         get_select_place();
    //         // $('#detail_signold').empty();
	// 		return false;
	// 	}

	// 	}).autocomplete('instance')._renderItem = function(ul,item){
	// 		return $('<li>')
	// 		.append('<div>'+ '<span class="bg-green text-white">' + item.value + '</span>' + '<span"> [ ' + item.name1 + ' ] ' + item.name2 + '</span>' + '<br> ราคาขาย ' + item.SalePrice1 + '</div>')
	// 		.appendTo(ul);
	// 	};
	// };

    function get_item_info(item_code) {  
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/get_item_info')?>",
            data: {
                field_itemcode : item_code
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                var ic_inventory =  data['ic_inventory'][0];
                
                $('#item_info_div').empty();
                $('#item_info_div').append(
                    '<div class="row">'+
                        '<div class="col-md-7">'+
                            '<h4> รหัสสินค้า : '+ic_inventory['code']+'</h4>'+
                        '</div>'+
                        '<div class="col-md-5">'+
                            '<h4> กลุ่มสินค้า : '+ic_inventory['group_main']+'</h4>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<h4> ชื่อสินค้า : '+ic_inventory['name_1']+'</h4>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<h4> ราคา : '+parseFloat(data['ic_inventory_price'][0]['price_0']).toFixed(2)+' บาท ต่อ 1 '+ic_inventory['unit_standard']+'</h4>'+
                        '</div>'+
                    '</div>'
                );
            }
        });
    }

    function get_sign_place_old_list(item_code) {
        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/get_sign_place_old_list')?>",
            data: {
                field_itemcode : item_code
            },
            dataType: "JSON",
            success: function (data) {
               $('#name_item').empty();
               $('#tb_sign_old_list').empty();
               $('#name_item').append(
                   'สินค้า : '+ data['sign_old'][0]['item_code']+' '+data['sign_old'][0]['field_itemname']
               );

                // $('#name_item').val(data['sign_old'][0]['item_code']+' '+data['sign_old'][0]['field_itemname']);
            //    console.log(data);
                var i = 1;
                $.each(data['sign_old'], function (idx, val) { 
                     $('#tb_sign_old_list').append(
                         '<tr>'+
                            '<td class="text-center">'+i+'</td>'+
                            '<td class="text-left">'+val['place']+'</td>'+
                            '<td class="text-left">'+val['size_name']+'</td>'+
                            '<td class="text-center">'+1+'</td>'+
                         '</tr>'
                     );
                     i++
                });
            }
        });
    }

    function get_select_place() {  
        var item_code = $('#search_itemcode').val();

        console.log(item_code);
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_select_place')?>",
            data: {
                item_code : item_code
            },
            dataType: "json",
            success: function (data) {
                // console.log(data);

                $('#place_div').empty();
                $.each(data, function (idx, val) { 
                    $('#place_div').append(
                        '<div class="card card-info">'+
                            '<div class="card-header">'+
                                '<h2 class="card-title"> สถานที่ '+val['field_place_name']+' </h2>'+
                                '<div class="card-tools">'+
                                ' <button type="button" id="del'+val['field_place_id']+'" class="btn btn-sm btn-danger pull-right" title="ลบ"><i class="fa fa-trash"></i></button> '+
                                ' <button type="button" id="edit'+val['field_place_id']+'" class="btn btn-sm btn-warning pull-right" title="แก้ไข"><i class="fa fa-edit"></i></button> '+
                                ' <button type="button" id="view'+val['field_place_id']+'"  class="btn btn-sm btn-primary pull-right" title="ดูป้าย"><i class="fa fa-eye"></i></button> '+
                                '</div>'+
                            '</div>'+
                        '<div class="card-body">'+
                            '<div id="sign_show'+val['field_place_id']+'">'+
                            '</div>'+
                        '</div>'
                    );

                    $('#view'+val['field_place_id']+'').click(function (e) {
                        e.preventDefault();
                        // console.log(val['field_place_id']);
                        signold_inplace(val['field_place_id']);
                    });


                    $('#edit'+val['field_place_id']+'').click(function (e) {
                        e.preventDefault();
                        // console.log(val['field_place_id']);
                        swal({
                            title: 'แก้ไขชื่อสถานที่<br><br>ชื่อเดิม<br><br>('+val['field_place_name']+')',
                            input: 'text',
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            confirmButtonText: 'ยืนยัน',
                            }).then((result) => {
                                if (result.value){
                                    var place_id = val['field_place_id'];
                                    var place_new_name = result.value;

                                    update_place_name(place_id, place_new_name);
                                }
                            });
                    });

                    $('#del'+val['field_place_id']+'').click(function (e) {
                        e.preventDefault();
                        // console.log(val['field_place_id']);

                        swal({
                            title: 'ต้องการลบข้อมูลหรือไม่?',
                            text: 'ลบ'+val['field_place_name']+'!',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#BEBEBE',
                            confirmButtonText: 'ใช่',
                            cancelButtonText: 'ปิด',
                            }).then((result) => {
                            if (result.value){
                                var place_id = val['field_place_id'];
                                del_place(place_id);
                            }
                        });
                    });

                });
            }
        });
    }

    function del_place(place_id) {  
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/del_place')?>",
            data: {
                place_id : place_id
            },
            dataType: "json",
            success: function (data) {
                // console.log(data);
                if (data == 'success') {
                    swal({
                        title: 'สำเร็จ!',
                        text: 'ลบข้อมูลเรียบร้อย',
                        type: 'success',
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                    }).then((result) => {
                        get_select_place();
                    });
                }
                else if(data == 'fail'){
                    swal({
                        title: 'มีข้อผิดพลาด!',
                        text: "มีสินค้าที่ติดตั้งในสถานที่นี้อยู่",
                        type: 'error'
                    });
                }
                // swal({
                //     title: 'สำเร็จ!',
                //     text: 'ลบข้อมูลเรียบร้อย',
                //     type: 'success',
                //     confirmButtonColor: '#6c757d',
                //     confirmButtonText: 'ปิด' ,
                // }).then((result) => {
                //     get_select_place();
                // });
            }
        });
    }


    function update_place_name(place_id,place_new_name) {  
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/update_place_name')?>",
            data: {
                place_id : place_id,
                place_new_name : place_new_name
            },
            dataType: "json",
            success: function (data) {
                swal({
                title: 'สำเร็จ!',
                text: 'แก้ไขข้อมูลเรียบร้อย',
                type: 'success',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            }).then((result) => {
                get_select_place();
            });
            }
        });
    }

    function signold_inplace(place_id) {  
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_signold_inplace')?>",
            data: {
                place_id : place_id
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#sign_show'+place_id+'').empty();
                if (data == '') {
                    $('#sign_show'+place_id+'').append(
                        '<span>ยังไม่มีป้ายในสถานที่นี้</span>'
                    );
                }
                else if (data != '') {
                    $.each(data, function (id, val) { 
                        $('#sign_show'+place_id+'').append(
                            '<li class="list-group-item">ขนาด '+val['size_name']+' จำนวน '+val['sign_amount']+' ป้าย'
                        );
                    });
                }
            }
        });
    }

    function sg_detail() {  
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_signdata_bydocno')?>",
            data: {
                field_docno : $('#search_signdocno').val()
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                get_select_place_sign(data['Sign_sub'][0]['field_itemcode']);

                $('#div_place_signsub').removeClass('hidden');
                $('#tb_signsub').empty();

                $('#title_place_itemcode').text('รายการป้ายที่ต้องการเปลี่ยนสถานที่ติดตั้ง รหัส '+data['Sign_sub'][0]['field_itemcode']+'');

                var i = 0;
                $.each(data['Sign_sub'], function (id, val) { 
                    i++;
                    var input_place = '<select class="form-control confirmsign_place" name="confirmsign_place" id="confirmsign_place'+val['field_id']+'"></select>';
                    var btn_update = '<button class="btn btn-success btn-sm" id="btn_update'+val['field_id']+'"><i class="fas fa-check"></i></button>'

                    $('#tb_signsub').append(
                        '<tr>'+
                            '<td class="text-center">'+i+'</td>'+
                            '<td class="text-left">'+val['field_place_name']+'</td>'+
                            '<td class="text-left">'+input_place+'</td>'+
                            '<td class="text-left">'+val['type_name_price']+'</td>'+
                            '<td class="text-left">'+val['size_name']+'</td>'+
                            '<td>'+btn_update+'</td>'+
                        '</tr>'
                    );

                    $('#btn_update'+val['field_id']+'').click(function (e) { 
                        e.preventDefault();

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
                                update_change_place(val['field_id'],$('#confirmsign_place'+val['field_id']+'').val());
                            }
                        });
                    });
                });
            }
        });
    }

    function update_change_place(field_id,place_id) {  

        // console.log(field_id,place_id);
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/update_change_place')?>",
            data: {
                place_id : place_id,
                field_id : field_id
            },
            dataType: "json",
            success: function (data) {
                swal({
                title: 'สำเร็จ!',
                text: 'แก้ไขข้อมูลเรียบร้อย',
                type: 'success',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            }).then((result) => {
                sg_detail();
            });
            }
        });
    }

    function get_select_place_sign(item_code) {
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

                select2();
            }
        });

    }


    function select2() {  

        $( ".confirmsign_place" ).select2({
            theme: "bootstrap4"
        });
    }

</script>
