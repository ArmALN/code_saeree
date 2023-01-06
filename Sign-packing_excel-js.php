
<script type="text/javascript">
    
    $(document).ready(function(){
        all_click();
        get_packing_excel();
    });

    function all_click() {  
        $('#print_sign').click(function (e) { 
            e.preventDefault();
            print_sign();
        });

        $('#print_sign_preview').click(function (e) { 
            e.preventDefault();
            print_sign_preview();
        });
    }

    function print_sign() {
        swal({
            title: "คุณต้องการปริ้นและ<br><br>อัพเดทสถานะเป็นกำลังทำป้าย?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1AA45F',
            cancelButtonColor: '#DB4B3F',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก',
		}).then((result) => {
			if (result.value){
                update_packing();
                var paper = $('#A4').val();
                var arrow = $('#arrow').val();
                var detail = $('#detail').val();
                var orderby = $('#orderby').val();
                window.open('<?php echo site_url('SignV2/Sign_dosign_print');?>'+'?id=<?php echo $id ?>&paper='+paper+'&arrow='+arrow+'&detail='+detail.replace("+", "%2B")+'&orderby='+orderby, '_blank');
            }
		});
    }

    function print_sign_preview() {
        var paper = $('#A4').val();
        var arrow = $('#arrow').val();
        var detail = $('#detail').val();
        var orderby = $('#orderby').val();
        window.open('<?php echo site_url('SignV2/Sign_dosign_print_preview');?>'+'?id=<?php echo $id ?>&paper='+paper+'&arrow='+arrow+'&detail='+detail.replace("+", "%2B")+'&orderby='+orderby, '_blank');
    }

    function get_packing_excel(){
		$.ajax({
			type:'POST',
			url:'<?= site_url('SignV2/get_packing_excel')?>',
			dataType:'json',
			data:{id : "<?= $id ?>" },
		}).done(function(data){
            console.log(data);
            $('#detail').val(data['ic_unit_use'][0][0]['name_1']);
            var check_price = 0;
            $.each(data['list'],function(id,val){ 
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

                // ข้อมูลป้ายที่ต้องทำ
                for (var i = 0; i < 6; i++) {
                    if (val['field_type_sign_price'] == '4' || val['field_type_sign_price'] == '5' || val['field_type_sign_price'] == '6' || val['field_type_sign_price'] == '7') {
                        if (val['field_unitcode'+i+''] != null) {
                            if (val['field_rate'+i+''] != null) {
                                if (i == 1) {
                                    $('#item_list'+val['field_itemcode']+'').append(
                                        '<div>'+
                                            '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                            ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_new_price'+i+'']+'</span>'+
                                            ' <label>บาท</label>'+
                                        '</div>'
                                    );
                                }
                                else{
                                    $('#item_list'+val['field_itemcode']+'').append(
                                        '<div>'+
                                            '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                            ' <label>มี</label> <span>'+val['field_rate'+i+'']+'</span> <label>'+val['field_unitcode1']+'</label>'+
                                            ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_new_price'+i+'']+'</span>'+
                                            ' <label>บาท</label>'+
                                        '</div>'
                                    );
                                }                      
                            }else{
                                $('#item_list'+val['field_itemcode']+'').append(
                                    '<div>'+
                                        '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                        ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_new_price'+i+'']+'</span>'+
                                        ' <label>บาท</label>'+
                                    '</div>'
                                );
                            }
                        }
                    }else{
                        if (val['field_price'+i+''] != null) {
                            if (val['field_rate'+i+''] != null) {
                                if (i == 1) {
                                    $('#item_list'+val['field_itemcode']+'').append(
                                        '<div>'+
                                            '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                            ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_price'+i+'']+'</span>'+
                                            ' <label>บาท</label>'+
                                        '</div>'
                                    );
                                }
                                else{
                                    $('#item_list'+val['field_itemcode']+'').append(
                                        '<div>'+
                                            '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                            ' <label>มี</label> <span>'+val['field_rate'+i+'']+'</span> <label>'+val['field_unitcode1']+'</label>'+
                                            ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_price'+i+'']+'</span>'+
                                            ' <label>บาท</label>'+
                                        '</div>'
                                    );
                                }                      
                            }else{
                                $('#item_list'+val['field_itemcode']+'').append(
                                    '<div>'+
                                        '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                        ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_price'+i+'']+'</span>'+
                                        ' <label>บาท</label>'+
                                    '</div>'
                                );
                            }

                        }
                    }

                }

                if (val['field_signsize'] == '8' || val['field_signsize'] == '10' || val['field_signsize'] == '11' || val['field_signsize'] == '12' || val['field_signsize'] == '13') {
                    

                    var name2 = '';
                    if (val['field_bc_name2'] != '') {
                        name2 = val['field_bc_name2'];
                    }else{
                        name2 = data['ic_unit_use'][id][0]['name_2'];
                    }


                    $('#item_list'+val['field_itemcode']+'').append(
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<label>รายละเอียดเพิ่มเติม</label>'+
                                '<input type="text" class="form-control" id="input_name2'+val['field_id']+'" value="'+name2+'">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-md-3">'+
                            '<div class="form-group">'+
                                '<button type="button" class="btn btn-success btn-block" id="btn_save_name2'+val['field_id']+'">บันทึก ['+val['field_count_update']+']</button>'+
                            '</div>'+
                        '</div>'
                    )

                    $('#btn_save_name2'+val['field_id']+'').click(function (e) { 
                        e.preventDefault();
                        $.ajax({
                            type:'POST',
                            url:'<?= site_url('SignV2/update_signsub_name2')?>',
                            dataType:'json',
                            data:{
                                field_id :  val['field_id'],
                                field_bc_name2 : $('#input_name2'+val['field_id']+'').val(),
                                field_count_update : val['field_count_update']
                            },
                        success: function (data) {
                            // console.log(data);
                            swal({
                                title: 'สำเร็จ',
                                text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                                type: 'success' ,
                                confirmButtonColor: '#6c757d',
                                confirmButtonText: 'ปิด' ,
                            }).then((result) => {
                                if (result.value) {
                                    $('#div_data_item').empty();
                                    get_packing_excel();
                                }
                            });
                        }
                        });
                    });

                    // console.log('ssssssssssssssssssssssssssssssss');
                }
                // ข้อมูล BC
                var y = 1 ;
                $.each(data['ic_unit_use'][id], function (id2, val2) { 

                    var sh_price = 0;

                    if (val2['sale_price2'] != null) {
                        sh_price = val2['sale_price2']
                    }else{
                        $.each(data['ic_inventory_price'][id], function (id3, val3) { 
                            if (val2['unit_code'] == val3['unit_code']) {
                                sh_price = val3['price_0'];
                            }
                        });
                    }

                    if (val2['from_qty'] != null) {
                        if (id2 == 0) {
                            $('#BC_list'+val['field_itemcode']+'').append(
                                '<div>'+
                                    '<label>สินค้า </label><span> '+val2['stand_value']+'<span> <label>'+val2['unit_code']+'</label>'+
                                    ' <label>ราคา'+val2['unit_code']+'ละ</label> <span>  '+sh_price+'</span>'+
                                    ' <label>บาท</label>'+
                                '</div>'
                            );
                        }else{
                            $('#BC_list'+val['field_itemcode']+'').append(
                                '<div>'+
                                    '<label>สินค้า </label><span> '+val2['from_qty']+'<span>  <label>'+val2['unit_code']+'ขึ้นไป</label>'+
                                    ' <label>ราคา'+val2['unit_code']+'ละ</label> <span>  '+sh_price+'</span>'+
                                    ' <label>บาท</label>'+
                                '</div>'
                            ); 
                        }
                    }else{
                        if (id2 == 0) {
                                $('#BC_list'+val['field_itemcode']+'').append(
                                    '<div>'+
                                        '<label>สินค้า </label><span> '+val2['stand_value']+'<span> <label>'+val2['unit_code']+'</label>'+
                                        ' <label>ราคา'+val2['unit_code']+'ละ</label> <span>  '+sh_price+'</span>'+
                                        ' <label>บาท</label>'+
                                    '</div>'
                                );
                        }else{
                            $('#BC_list'+val['field_itemcode']+'').append(
                                '<div>'+
                                    '<label>สินค้า </label><span> '+data['ic_unit_use'][id][0]['stand_value']+'<span> <label>'+val2['unit_code']+'</label>'+
                                    ' <label>มี</label> <span>'+val2['stand_value']+'</span> <label>'+data['ic_unit_use'][id][0]['unit_code']+'</label>'+
                                    ' <label>ราคา'+val2['unit_code']+'ละ</label> <span>  '+sh_price+'</span>'+
                                    ' <label>บาท</label>'+
                                '</div>'
                            );
                        }
                    }
                    if ( val['field_type_sign_price'] == '5' || val['field_type_sign_price'] == '6' || val['field_type_sign_price'] == '7') {
                        if (parseFloat(sh_price,2) != parseFloat(val['field_new_price'+y+''],2)) {
                            check_price = 1

                            console.log(sh_price,val['field_new_price'+y+'']);
                            $("#print_sign").prop('disabled', true);
                        }
                    }else{
                        check_price = 0
                        $("#print_sign").prop('disabled', false);
                    }
                    y++
                });

                // console.log(val['field_type_sign_price']);
            });


		}).fail(function(data){
            console.log(data)
		});
	}

    function update_packing() {  

        var field_packing_status = '1';
        var field_recieve_status = '0';
        var field_pack_status = '1';
        //  console.log(id_sign);
        $.ajax({
        type:'POST',
        url:'<?= site_url('SignV2/update_packing_excel')?>',
        dataType:'json',
        data:{
            id_sub :  "<?= $id ?>",
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
                console.log(data);
            }
            });
        }
    });

}

</script>