<script>
    $(document).ready(function () {
        get_view();
    });

    function get_view() {  
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_signandsignsub')?>",
            data: {field_id : <?= $id ?>},
            dataType: "JSON",
            success: function (data) {
                var main_sign = data['Sign'];
                var val = data['Sign_sub'][0];

                console.log(data);

                if (main_sign['field_upload_status'] == 1) {
                    get_file1(main_sign['field_id']);
                }else{
                    $('#div_links_file_recheck').addClass('hidden');
                }
                
                if (data['sign_destroy_list']) {
                    get_file2(data['sign_destroy_list']['field_id']);
                }else{
                    $('#div_links_file_recheck_destroy').addClass('hidden');
                }
              
                $('#title_docno').text('เลขที่เอกสาร '+data['Sign']['field_docno']);
                $('#title_itemcode').text(data['Sign']['field_itemcode']);
                $('#title_itemname').text(data['Sign']['field_itemname']);
                // div_purchase ข้อมูลการแชร์ป้าย
                if (main_sign['field_change_date'] != null) {
                    //  ข้อมูลจัดซื้อแชร์ป้าย
                    $('#div_purchase').removeClass('hidden');
                    $('#div_purchase_body').empty();
                    $('#div_purchase_body').append(
                        '<div class="row">'+
                            '<div class="col-md-4">'+
                                '<span><b>สาเหตุ : </b>'+main_sign['type_name']+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>ผู้บันทึก : </b>'+name_text(main_sign['creator_firstname'],main_sign['creator_lastname'])+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>วันที่บันทึกข้อมูล : </b>'+formatDatetime(main_sign['field_createdate'])+'</span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row" style="padding-top:5px;">'+
                            '<div class="col-md-4">'+
                                '<span><b>วันที่ต้องการเปลี่ยนแปลงข้อมูล : </b>'+formatDate(main_sign['field_change_date'])+'</span>'+
                            '</div>'+
                            '<div class="col-md-8">'+
                                '<span><b>หมายเหตุ : </b>'+main_sign['field_purchase_comment']+'</span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row" style="padding-top:10px;">'+
                            '<div class="col-md-6">'+
                                '<div class="card card-primary card-outline">'+
                                    '<div class="card-header ">'+
                                        '<h2 class="card-title">ราคาที่จัดซื้อกรอก</h2>'+
                                    '</div>'+
                                    '<div class="card-body" id="purchase_item_list">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                                '<div class="card card-info card-outline">'+
                                    '<div class="card-header ">'+
                                        '<h2 class="card-title">ราคาตอนดึงข้อมูล</h2>'+
                                    '</div>'+
                                    '<div class="card-body" id="loaddata_item_list">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                                '<div class="card card-secondary card-outline">'+
                                    '<div class="card-header ">'+
                                        '<h2 class="card-title">ราคาเดิม</h2>'+
                                    '</div>'+
                                    '<div class="card-body" id="old_item_list">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );

                    $('#purchase_item_list').empty();
                    for (let i = 0; i < 6; i++) {
                        if (val['field_load_data'] == 1) {
                            if (val['field_unitcode'+i+''] != null) {
                                if (val['field_rate'+i+''] != null) {
                                    if (i == 1) {
                                        $('#purchase_item_list').append(
                                            '<div>'+
                                                '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                                ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_new_price'+i+'']+'</span>'+
                                                ' <label>บาท</label>'+
                                            '</div>'
                                        );
                                    }
                                    else{
                                        $('#purchase_item_list').append(
                                            '<div>'+
                                                '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                                ' <label>มี</label> <span>'+val['field_rate'+i+'']+'</span> <label>'+val['field_unitcode1']+'</label>'+
                                                ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_new_price'+i+'']+'</span>'+
                                                ' <label>บาท</label>'+
                                            '</div>'
                                        );
                                    }                      
                                }else{
                                    $('#purchase_item_list').append(
                                        '<div>'+
                                            '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                            ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_new_price'+i+'']+'</span>'+
                                            ' <label>บาท</label>'+
                                        '</div>'
                                    );
                                }

                            }
                        }else{
                            if (val['field_new_price'+i+''] != null && val['field_new_price'+i+''] != 0) {
                                $('#purchase_item_list').append(
                                    '<div>'+
                                        '<label> ราคา '+i+' : </label><span> '+val['field_new_price'+i+'']+'</span> <label>บาท</label>'+
                                    '</div>'
                                )
                            }

                        }
                    }

                    $('#loaddata_item_list').empty();
                    if (val['field_load_data'] == 1) {
                        for (let i = 0; i < 6; i++) {
                            if (val['field_price'+i+''] != null && val['field_price'+i+''] != 0) {
                                if (val['field_rate'+i+''] != null) {
                                    if (i == 1) {
                                        $('#loaddata_item_list').append(
                                            '<div>'+
                                                '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                                ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_price'+i+'']+'</span>'+
                                                ' <label>บาท</label>'+
                                            '</div>'
                                        );
                                    }
                                    else{
                                        $('#loaddata_item_list').append(
                                            '<div>'+
                                                '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                                ' <label>มี</label> <span>'+val['field_rate'+i+'']+'</span> <label>'+val['field_unitcode1']+'</label>'+
                                                ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_price'+i+'']+'</span>'+
                                                ' <label>บาท</label>'+
                                            '</div>'
                                        );
                                    }                      
                                }else{
                                    $('#loaddata_item_list').append(
                                        '<div>'+
                                            '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                            ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_price'+i+'']+'</span>'+
                                            ' <label>บาท</label>'+
                                        '</div>'
                                    );
                                }

                            }
                        }
                    }else{
                        $('#loaddata_item_list').append(
                            '<div><h3 class="text-secondary">ยังไม่ได้ดึงข้อมูล</h3></div>'
                        );
                    }

                    $('#old_item_list').empty();
                    for (let i = 0; i < 6; i++) {
                        if (val['field_load_data'] == 1) {
                            if (val['field_unitcode'+i+''] != null) {
                                if (val['field_rate'+i+''] != null) {
                                    if (i == 1) {
                                        $('#old_item_list').append(
                                            '<div>'+
                                                '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                                ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_old_price'+i+'']+'</span>'+
                                                ' <label>บาท</label>'+
                                            '</div>'
                                        );
                                    }
                                    else{
                                        $('#old_item_list').append(
                                            '<div>'+
                                                '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                                ' <label>มี</label> <span>'+val['field_rate'+i+'']+'</span> <label>'+val['field_unitcode1']+'</label>'+
                                                ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_old_price'+i+'']+'</span>'+
                                                ' <label>บาท</label>'+
                                            '</div>'
                                        );
                                    }                      
                                }else{
                                    $('#old_item_list').append(
                                        '<div>'+
                                            '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                            ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_old_price'+i+'']+'</span>'+
                                            ' <label>บาท</label>'+
                                        '</div>'
                                    );
                                }

                            }
                        }else{
                            if (val['field_old_price'+i+''] != null && val['field_old_price'+i+''] != 0) {
                                $('#old_item_list').append(
                                    '<div>'+
                                        '<label> ราคา '+i+' : </label><span> '+val['field_old_price'+i+'']+'</span> <label>บาท</label>'+
                                    '</div>'
                                )
                            }
                        }
                    }
                }else{
                    // ข้อมูลจัดซื้อแชร์ป้าย
                    $('#div_depart').removeClass('hidden');
                    $('#div_depart_body').empty();
                    $('#div_depart_body').append(
                        '<div class="row">'+
                            '<div class="col-md-4">'+
                                '<span><b>สาเหตุ : </b>'+main_sign['type_name']+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>ผู้บันทึก : </b>'+name_text(main_sign['creator_firstname'],main_sign['creator_lastname'])+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>วันที่บันทึกข้อมูล : </b>'+formatDatetime(main_sign['field_createdate'])+'</span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row" style="padding-top:10px;">'+
                            '<div class="col-md-6">'+
                                '<div class="card card-info card-outline">'+
                                    '<div class="card-header ">'+
                                        '<h2 class="card-title">ราคาตอนดึงข้อมูล</h2>'+
                                    '</div>'+
                                    '<div class="card-body" id="loaddata_item_list">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );

                    $('#loaddata_item_list').empty();
                    if (val['field_load_data'] == 1) {
                        for (let i = 0; i < 6; i++) {
                            if (val['field_price'+i+''] != null) {
                                if (val['field_rate'+i+''] != null) {
                                    if (i == 1) {
                                        $('#loaddata_item_list').append(
                                            '<div>'+
                                                '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                                ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_price'+i+'']+'</span>'+
                                                ' <label>บาท</label>'+
                                            '</div>'
                                        );
                                    }
                                    else{
                                        $('#loaddata_item_list').append(
                                            '<div>'+
                                                '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                                ' <label>มี</label> <span>'+val['field_rate'+i+'']+'</span> <label>'+val['field_unitcode1']+'</label>'+
                                                ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_price'+i+'']+'</span>'+
                                                ' <label>บาท</label>'+
                                            '</div>'
                                        );
                                    }                      
                                }else{
                                    $('#loaddata_item_list').append(
                                        '<div>'+
                                            '<label>สินค้า </label><span> '+val['field_fromQty'+i+'']+'<span> <label>'+val['field_unitcode'+i+'']+'</label>'+
                                            ' <label>ราคา'+val['field_unitcode'+i+'']+'ละ</label> <span>  '+val['field_price'+i+'']+'</span>'+
                                            ' <label>บาท</label>'+
                                        '</div>'
                                    );
                                }

                            }
                        }
                    }else{
                        $('#loaddata_item_list').append(
                            '<div><h3 class="text-secondary">ยังไม่ได้ดึงข้อมูล</h3></div>'
                        );
                    }

                }

                // div_depart_detail ข้อมูลการจัดทำป้าย
                if (main_sign['field_confirm_status'] == 1) {
                    $('#div_depart_detail').removeClass('hidden');
                    $('#div_depart_detail_body').empty();
                    $('#div_depart_detail_body').append(
                        '<div class="row">'+
                            '<div class="col-md-4">'+
                                '<b>ความต้องการ : </b><span class="text-success"><i class="fa fa-check"></i> ต้องการทำป้าย</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>ผู้บันทึก : </b>'+name_text(main_sign['confirm_firstname'],main_sign['confirm_nickname'])+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>วันที่บันทึกข้อมูล : </b>'+formatDatetime(main_sign['field_confirmdate'])+'</span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row" style="padding-top:5px;">'+
                            '<div class="col-md-4">'+
                                '<span><b>วันที่ต้องการป้าย : </b>'+formatDate(main_sign['field_comfirm_needdate'])+'</span>'+
                            '</div>'+
                            '<div class="col-md-8">'+
                                '<span><b>หมายเหตุเพิ่มเติม : </b>'+main_sign['field_comfirm_comment']+'</span>'+
                            '</div>'+
                        '</div>'+
                        '<br>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<table class="table table-hover" show-filter="true">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th class="text-left">ลำดับ</th>'+
                                            '<th class="text-left">บริเวณที่ติด</th>'+
                                            '<th class="text-center">ประเภท</th>'+
                                            '<th class="text-center">ขนาด</th>'+
                                            '<th class="text-center">จำนวน</th>'+
                                            '<th class="text-center">หมายเหตุ</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody id="tb_depart_sign">'+
                                    '</tbody>'+
                                '</table>'+
                            '</div>'+
                        '</div>'
                    );

                    $('#tb_depart_sign').empty();
                    var row_no = 0;
                    $.each(data['Sign_sub'], function (id, value) { 
                        row_no++;
                        $('#tb_depart_sign').append(
                            '<tr>'+
                                '<td width="10%" class="text-left Code">' +
                                    '<span>'+row_no+'</span>'+
                                '</td>'+
                                '<td width="25%" class="text-left Name1">' +
                                    '<span>'+value['field_place_name']+'</span>'+
                                '</td>'+
                                '<td width="15%" style="text-align:center;">' +
                                    '<span>'+value['type_name_price']+'</span>'+
                                '</td>'+
                                '<td width="15%" style="text-align:center;">' +
                                    '<span>'+value['size_name']+'</span>'+
                                '</td>'+
                                '<td width="15%" style="text-align:center;">' +
                                    '<span>'+value['field_signamount']+'</span>'+
                                '</td>'+
                                '<td width="25%" style="text-align:center;">' +
                                    '<span>'+value['field_comment']+'</span>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }else if(main_sign['field_confirm_status'] == 2){
                    $('#div_depart_detail').removeClass('hidden');
                    $('#div_depart_detail_body').empty();
                    $('#div_depart_detail_body').append(
                        '<div class="row">'+
                            '<div class="col-md-4">'+
                                '<b>ความต้องการ : </b><span class="text-danger"><i class="fa fa-times"></i> ต้องการทำป้าย</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>ผู้บันทึก : </b>'+name_text(main_sign['confirm_firstname'],main_sign['confirm_nickname'])+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>วันที่บันทึกข้อมูล : </b>'+formatDatetime(main_sign['field_confirmdate'])+'</span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row" style="padding-top:5px;">'+
                            '<div class="col-md-12">'+
                                '<span><b>หมายเหตุที่ไม่ทำ : </b>'+main_sign['field_not_confirm_comment']+'</span>'+
                            '</div>'+
                        '</div>'
                    );
                }

                // div_packing_body ข้อมูลผู้ทำป้าย
                if (main_sign['field_packing_status'] != 0) {
                   $('#div_packing').removeClass('hidden');
                   $('#div_packing_body').empty();

                   var status_packing = '';
                   if (main_sign['field_packing_status'] == 1) {
                       status_packing = '<span class="text-warning"><i class="fas fa-clock"></i> กำลังทำป้าย</span>';
                   }else if(main_sign['field_packing_status'] == 2){
                        status_packing = '<span class="text-success"><i class="fas fa-check"></i> ทำป้ายเรียบร้อย</span>';
                   }

                   $('#div_packing_body').append(
                        '<div class="row">'+
                            '<div class="col-md-4">'+
                                '<b>สถานะการทำ : </b>'+status_packing+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>ผู้บันทึก : </b>'+name_text(main_sign['packing_firstname'],main_sign['packing_nickname'])+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>วันที่บันทึกข้อมูล : </b>'+formatDatetime(main_sign['field_packingdate'])+'</span>'+
                            '</div>'+
                        '</div>'+
                        '<br>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<table class="table table-hover" show-filter="true">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th class="text-left">ลำดับ</th>'+
                                            '<th class="text-left">บริเวณที่ติด</th>'+
                                            '<th class="text-center">ประเภท</th>'+
                                            '<th class="text-center">ขนาด</th>'+
                                            '<th class="text-center">จำนวน</th>'+
                                            '<th class="text-center">ผู้ปริ้น</th>'+
                                            '<th class="text-center">เวลา</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody id="tb_packing_sign">'+
                                    '</tbody>'+
                                '</table>'+
                            '</div>'+
                        '</div>'
                    );

                    $('#tb_packing_sign').empty();
                    var row_no = 0;
                    $.each(data['Sign_sub'], function (id, value) { 
                        row_no++;
                        $('#tb_packing_sign').append(
                            '<tr>'+
                                '<td width="10%" class="text-left Code">' +
                                    '<span>'+row_no+'</span>'+
                                '</td>'+
                                '<td width="10%" class="text-left Name1">' +
                                    '<span>'+value['field_place_name']+'</span>'+
                                '</td>'+
                                '<td width="15%" style="text-align:center;">' +
                                    '<span>'+value['type_name_price']+'</span>'+
                                '</td>'+
                                '<td width="15%" style="text-align:center;">' +
                                    '<span>'+value['size_name']+'</span>'+
                                '</td>'+
                                '<td width="15%" style="text-align:center;">' +
                                    '<span>'+value['field_signamount']+'</span>'+
                                '</td>'+
                                '<td width="15%" style="text-align:center;">' +
                                    '<span>'+name_text(value['packing_firstname'],value['packing_nickname'])+'</span>'+
                                '</td>'+
                                '<td width="15%" style="text-align:center;">' +
                                    '<span>'+formatDatetime(value['field_pack_datetime'])+'</span>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }

                // div_destroy
                if (main_sign['field_destroy_status'] != 0) {
                    $('#div_destroy').removeClass('hidden');


                    if (main_sign['field_destroy_status'] == 1 ) {
                        var destroy_status = '<span class="text-warning"><i class="fas fa-clock"></i> รอทำลาย</span>';
                        var name = name_text(main_sign['confirm_firstname'],main_sign['confirm_nickname']);
                        var date_destroy = formatDatetime(main_sign['field_confirmdate']);
                        var destroy_comment = '-';
                    }else if(main_sign['field_destroy_status'] == 2){
                        var destroy_status = '<span class="text-success"><i class="fas fa-check"></i> ทำลายเรียบร้อย</span>';
                        var name = name_text(main_sign['destroy_firstname'],main_sign['destroy_nickname']);
                        var date_destroy = formatDatetime(main_sign['field_destroy_date']);
                        var destroy_comment = '-';
                    }

                    if (data['sign_destroy_list']['field_status'] == 0) {
                        var destroy_img_status = '<span class="text-warning"><i class="fas fa-clock"></i> รออัปโหลดรูป</span>';
                    }else if (data['sign_destroy_list']['field_status'] == 1) {
                        var destroy_img_status = '<span class="text-success"><i class="fas fa-check"></i> ไม่มีรูปทำลาย</span>';
                    }else if (data['sign_destroy_list']['field_status'] == 2) {
                        var destroy_img_status = '<span class="text-success"><i class="fas fa-check"></i> อัปโหลดรูปเรียบร้อย</span>';
                    }


                    $('#div_destroy_body').empty();
                    $('#div_destroy_body').append(
                        '<div class="row">'+
                            '<div class="col-md-4">'+
                                '<b>สถานะการทำ : </b>'+destroy_status+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>ผู้บันทึก : </b>'+name+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>วันที่บันทึกข้อมูล : </b>'+formatDatetime(main_sign['field_confirmdate'])+'</span>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<b>หมายเหตุ : </b><span>'+main_sign['field_destroy_comment']+'</span>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<b>สถานะอัปโหลดรูป : </b>'+destroy_img_status+
                            '</div>'+
                        '</div>'+
                        '<br>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<table class="table table-hover" show-filter="true">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th class="text-left">ลำดับ</th>'+
                                            '<th class="text-left">บริเวณที่ติด</th>'+
                                            '<th class="text-center">ประเภท</th>'+
                                            '<th class="text-center">ขนาด</th>'+
                                            '<th class="text-center">จำนวน</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody id="tb_destroy_sign">'+
                                    '</tbody>'+
                                '</table>'+
                            '</div>'+
                        '</div>'
                    );

                    $('#tb_destroy_sign').empty();
                    var row_no = 0;
                    $.each(data['sign_prepare'], function (id, value) { 
                        row_no++;

                        var type_name_price = 'ไม่ได้เก็บข้อมูล';
                        if (value['type_name_price'] != null) {
                            type_name_price = value['type_name_price'];
                        }
                        $('#tb_destroy_sign').append(
                            '<tr>'+
                                '<td class="text-left Code">' +
                                    '<span>'+row_no+'</span>'+
                                '</td>'+
                                '<td class="text-left Name1">' +
                                    '<span>'+value['field_place_name']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+type_name_price+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+value['size_name']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+value['sign_amount']+'</span>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }

                // div_recieve
                if (main_sign['field_recieve_status'] != 0 && main_sign['field_recieve_status'] != 1) {
                    $('#div_recieve').removeClass('hidden');
                    $('#div_recieve_body').empty();
                    var name = name_text(main_sign['recieve_firstname'],main_sign['recieve_nickname']);
                    $('#div_recieve_body').append(
                        '<div class="row">'+
                            '<div class="col-md-4">'+
                                '<span><b>ฝ่ายที่รับป้าย : </b>'+data['sign_part']['name']+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>ผู้บันทึก : </b>'+name+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>วันที่บันทึกข้อมูล : </b>'+formatDatetime(main_sign['field_recievedate'])+'</span>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<b>หมายเหตุ : </b><span>'+main_sign['field_recieve_comment']+'</span>'+
                            '</div>'+
                        '</div>'+
                        '<br>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<table class="table table-hover" show-filter="true">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th class="text-left">ลำดับ</th>'+
                                            '<th class="text-left">บริเวณที่ติด</th>'+
                                            '<th class="text-center">ประเภท</th>'+
                                            '<th class="text-center">ขนาด</th>'+
                                            '<th class="text-center">จำนวน</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody id="tb_recieve_sign">'+
                                    '</tbody>'+
                                '</table>'+
                            '</div>'+
                        '</div>'
                    );

                    $('#tb_recieve_sign').empty();
                    var row_no = 0;
                    $.each(data['Sign_sub'], function (id, value) { 
                        row_no++;

                        $('#tb_recieve_sign').append(
                            '<tr>'+
                                '<td class="text-left Code">' +
                                    '<span>'+row_no+'</span>'+
                                '</td>'+
                                '<td class="text-left Name1">' +
                                    '<span>'+value['field_place_name']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+value['type_name_price']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+value['size_name']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+value['field_signamount']+'</span>'+
                                '</td>'+
                            '</tr>'
                        );
                    });

                }

                // div_setup
                if (main_sign['field_setup_status'] != 0 && main_sign['field_setup_status'] != 1) {
                    $('#div_setup').removeClass('hidden');
                    $('#div_setup_body').empty();
                    var name = name_text(main_sign['setup_firstname'],main_sign['setup_nickname']);

                    if (main_sign['field_setup_status'] == 2) {
                        var setup_status = '<span class="text-success"><i class="fas fa-check"></i> ติดตั้งเรียบร้อยแล้ว</span>';
                        var comment = '-';
                    }else if (main_sign['field_setup_status'] == 3) {
                        var setup_status = '<span class="text-success"><i class="fas fa-check"></i> ไม่ติดตั้ง</span>';
                        var comment = main_sign['field_setup_comment'];
                    }
                    else if (main_sign['field_setup_status'] == 4) {
                        var setup_status = '<span class="text-warning"><i class="fas fa-clock"></i> ยังไม่พร้อมติดตั้ง</span>';
                        var comment = main_sign['field_setup_comment'];
                    }

                    $('#div_setup_body').append(
                        '<div class="row">'+
                            '<div class="col-md-4">'+
                                '<b>สถานะติดตั้ง : </b>'+setup_status+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>ผู้บันทึก : </b>'+name+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>วันที่บันทึกข้อมูล : </b>'+formatDatetime(main_sign['field_setupdate'])+'</span>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<b>หมายเหตุ : </b><span>'+comment+'</span>'+
                            '</div>'+
                        '</div>'+
                        '<br>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<table class="table table-hover" show-filter="true">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th class="text-left">ลำดับ</th>'+
                                            '<th class="text-left">บริเวณที่ติด</th>'+
                                            '<th class="text-center">ประเภท</th>'+
                                            '<th class="text-center">ขนาด</th>'+
                                            '<th class="text-center">จำนวน</th>'+
                                            '<th class="text-center">ผู้ติดตั้ง</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody id="tb_setup_sign">'+
                                    '</tbody>'+
                                '</table>'+
                            '</div>'+
                        '</div>'
                    );

                    $('#tb_setup_sign').empty();
                    var row_no = 0;
                    $.each(data['Sign_sub'], function (id, value) { 
                        row_no++;
                        var name_setup = name_text(value['setup_firstname'],value['setup_nickname']);
                        if (main_sign['field_setup_status'] == 2) {
                            var name_setup = name_text(value['setup_firstname'],value['setup_nickname']);
                        }else if (main_sign['field_setup_status'] == 3) {
                            var name_setup = 'ไม่มีผู้ติดตั้ง';
                        }

                        $('#tb_setup_sign').append(
                            '<tr>'+
                                '<td class="text-left Code">' +
                                    '<span>'+row_no+'</span>'+
                                '</td>'+
                                '<td class="text-left Name1">' +
                                    '<span>'+value['field_place_name']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+value['type_name_price']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+value['size_name']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+value['field_signamount']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+name_setup+'</span>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }

                // div_recheck
                if (main_sign['field_recheck_status'] != 0 && main_sign['field_recheck_status'] != 1) {
                    $('#div_recheck').removeClass('hidden');
                    var name = name_text(main_sign['recheck_firstname'],main_sign['recheck_nickname']);

                    if (main_sign['field_recheck_status'] == 2) {
                        var recheck_status = '<span class="text-success"><i class="fas fa-check"></i> ผ่านการตรวจสอบ</span>';
                        var comment = '-';
                    }else if (main_sign['field_recheck_status'] == 3) {
                        var recheck_status = '<span class="text-danger"><i class="fas fa-times"></i> ไม่ผ่านการตรวจสอบ</span>';
                        var comment = main_sign['field_recheck_comment'];
                    }
                    else if (main_sign['field_recheck_status'] == 4) {
                        var recheck_status = '<span class="text-danger"><i class="fas fa-times"></i> ไม่ผ่านการตรวจสอบ</span>';
                        var comment = main_sign['field_recheck_comment'];
                    }
                    $('#div_recheck_body').empty();
                    $('#div_recheck_body').append(
                        '<div class="row">'+
                            '<div class="col-md-4">'+
                                '<b>สถานะการตรวจสอบ : </b>'+recheck_status+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>ผู้บันทึก : </b>'+name+'</span>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<span><b>วันที่บันทึกข้อมูล : </b>'+formatDatetime(main_sign['field_recheckdate'])+'</span>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<b>หมายเหตุ : </b><span>'+comment+'</span>'+
                            '</div>'+
                        '</div>'+
                        '<br>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<table class="table table-hover" show-filter="true">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th class="text-left">ลำดับ</th>'+
                                            '<th class="text-left">บริเวณที่ติด</th>'+
                                            '<th class="text-center">ประเภท</th>'+
                                            '<th class="text-center">ขนาด</th>'+
                                            '<th class="text-center">จำนวน</th>'+
   
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody id="tb_recheck_sign">'+
                                    '</tbody>'+
                                '</table>'+
                            '</div>'+
                        '</div>'
                    );

                    $('#tb_recheck_sign').empty();
                    var row_no = 0;
                    $.each(data['Sign_sub'], function (id, value) { 
                        row_no++;
                        $('#tb_recheck_sign').append(
                            '<tr>'+
                                '<td class="text-left Code">' +
                                    '<span>'+row_no+'</span>'+
                                '</td>'+
                                '<td class="text-left Name1">' +
                                    '<span>'+value['field_place_name']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+value['type_name_price']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+value['size_name']+'</span>'+
                                '</td>'+
                                '<td style="text-align:center;">' +
                                    '<span>'+value['field_signamount']+'</span>'+
                                '</td>'+

                            '</tr>'
                        );
                    });
                }
            }
        });
    }

    function get_file1(id)
    {
      var field_id = id;

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
						var url = '<?= base_url('assets/images/SignV2')?>/'+field_id+'/'+val

						$('#links_file_recheck').append('' +
						'<div class="col-sm-6">'+
							'<a target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
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

    function get_file2(id)
    {
      var field_id = id;

      $('#links_file_recheck_destroy').empty();
      $.ajax({
		type:'POST',
		url:'<?= site_url('SignV2/get_file_view_destroy')?>',
		dataType:'JSON',
		data:
		{
			field_id : <?= $id ?>,
			link_1 : 'SignV2Destroy'
		},
		}).done(function(data){

			// console.log(data);
			if(data){
                $.each(data['sign_destroy_list'], function (id, value) { 
                    $.each(data['scandir'][id],function(ids,val){
                        if(val != '.' && val != '..'){
                            var url = '<?= base_url('assets/images/SignV2Destroy')?>/'+value['field_id']+'/'+val

                            $('#links_file_recheck_destroy').append('' +
                            '<div class="col-sm-6">'+
                                '<a target="_blank" href="'+url+'" data-toggle="lightbox" data-title="" data-gallery="gallery">' +
                                    '<img src="'+ url +'?buster=a_random_number" class="img-fluid mb-2" alt="">'+
                                '</a>'+
                            '</div>'
                            );

                        }
                    });
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