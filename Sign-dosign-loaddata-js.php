

<script type="text/javascript">
    $(document).ready(function () {
        get_groupcode();
        confirm_sign_size();
        confirm_sign_type_price();
        get_sign_packing(); 
        all_click();
        select2();

        var ar_packing = [];
        var ar_price_list = [];
    });

    function select2() { 
        $( "#search_groupcode" ).select2({
            theme: "bootstrap4"
        });

        $( "#search_type" ).select2({
            theme: "bootstrap4"
        });
        
        $( "#search_size" ).select2({
            theme: "bootstrap4"
        });
    }

    function all_click() {  
        $('#form_load_data').submit(function(e){
            e.preventDefault();
            update_load_data();
        });	

        $('#tbody_sign_packing').on('click','.btn_loaddata',function(){
            var item_id = $(this).closest('tr').find('.field_id').text();
            var item_code = $(this).closest('tr').find('.Code').text();
            $('#load_data_modal').modal('show');
            // console.log(item_code,item_id);
            load_data(item_code,item_id);
        });
		
		$('#search_text').keyup(function (e) { 
			e.preventDefault();
            $('#pageNumber').val(0);
            get_sign_packing(); 
		});

		$('#search_groupcode').change(function (e){ 
			e.preventDefault();
            $('#pageNumber').val(0);
            get_sign_packing(); 
		});

        $('#search_type').change(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
			get_sign_packing(); 
        });

		$('#search_size').change(function (e){ 
			e.preventDefault();
            $('#pageNumber').val(0);
            get_sign_packing(); 
		});

        $('#usersPerPage').change(function (e){ 
			e.preventDefault();
            $('#pageNumber').val(0);
            get_sign_packing(); 
		});

        $(document).on('click','.pageNumber',function(){
			$('#pageNumber').val($(this).text()-1);
			get_sign_packing();
        });
    }

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

	function get_sign_packing(){
        var search_text = $('#search_text').val();
        var search_groupcode = $('#search_groupcode').val();
        var search_size = $('#search_size').val();
        var search_type = $('#search_type').val();
        var usersPerPage = parseInt($('#usersPerPage').val());
        var pageNumber = $('#pageNumber').val(); 
        var doit = $('#doit').val();

        $.ajax({
            type: "POST",
            url: "<?= site_url('SignV2/get_sign_packing')?>",
            data : {
                usersPerPage:usersPerPage,
                pageNumber:pageNumber,
				search_text : search_text,
				search_groupcode : search_groupcode,
				search_size : search_size,
                search_type : search_type,
                field_load_data : '0',
                doit : doit
			},
            dataType: "JSON",
            success: function (data){
                $('#tbody_sign_packing').empty();
                $.each(data['SignPacking'],function(id,val){
                    $('#tbody_sign_packing').append(
                        '<tr id='+val['field_sign_id']+'>'+
                            '<td class="text-left field_id" hidden>' +
                                '<span>'+val['field_id']+'</span>'+
                            '</td>'+
                            '<td width="10%" class="text-left Code">' +
                                '<span>'+val['field_itemcode']+'</span>'+
                            '</td>'+
                            '<td width="20%" class="text-left Name1">' +
                                '<span>'+val['field_itemname']+'</span>'+
                            '</td>'+
                            '<td width="10%" class="text-left Name1">' +
                                '<span>'+val['depart_firstname']+'('+val['depart_nickname']+')'+'</span>'+
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
                            '<td width="10%" style="text-align:center;">' +
                                '<span>'+val['type_name']+'</span>'+
                            '</td>'+
                            '<td width="10%" style="text-align:center;">' +
                                '<span><button type="button" class="btn bg-blue btn-sm btn_loaddata"><i class="fa fa-download"></i></button></span>'+
                            '</td>'+
                        '</tr>'
                    );
                });

                $('.pagination').empty();
                var total_packing = (Math.ceil(parseInt(data['total_packing']) / parseInt(usersPerPage)));
                if(parseInt(pageNumber) > 5){
                    $('.pagination').append('<li><button class="pageNumber">1</button></li>');
                }
                for (var i = 1; i <= total_packing; i++) {
                    if(parseInt(pageNumber)-5 < i && parseInt(pageNumber)+7 > i){
                        if(parseInt(pageNumber)+1 == i){
                            $('.pagination').append('<li><button class="pageNumber active">'+i+'</button></li>');
                        }else{
                            $('.pagination').append('<li><button class="pageNumber">'+i+'</button></li>');
                        }
                    }
                }
                if(parseInt(pageNumber) < total_packing-6){
                    $('.pagination').append('<li><button class="pageNumber">'+total_packing+'</button></li>');
                }
            }
        });
    };

    function date(dateObject){
		var d = new Date(dateObject);
		var day = d.getDate();
		var month = d.getMonth() + 1;
		var year = d.getFullYear();
		if (day < 10) {
			day = "0" + day;
		}
		if (month < 10) {
			month = "0" + month;
		}
		var date = day + "/" + month + "/" + year;

		return date;
	};
    
    function select_item(item) {
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/get_packing_excel')?>",
            data: {
                id : item
            },
            dataType: "json",
            success: function (data) {
                $('#tb_success_packing').empty();
                $.each(data,function(id,val){
                    $.each(val,function(id,value){
                        var sign_price = '';
                        if(value['field_type'] == 5 || value['field_type'] == 6 || value['field_type'] == 7){
                            sign_price = value['field_newprice'] +'.-'; 
                        }else{
                            sign_price = value['field_oldprice'] +'.-'; 
                        }
                        $('#tb_success_packing').append(
                        '<tr>'+
                            '<td width="10%" style="text-align:left;">'+value['field_itemcode']+'</td>'+
                            '<td width="25%" style="text-align:left;">'+value['field_itemname']+'</td>'+
                            '<td width="10%" style="text-align:center;">'+date(value['field_packingdate'])+'</td>'+	
                            '<td width="10%" style="text-align:center;">'+date(value['field_comfirm_needdate'])+'</td>'+
                            '<td width="10%" style="text-align:center;">'+ value['field_signsize'] +'</td>'+
                            '<td width="10%" style="text-align:center;">'+ value['field_signamount'] +'</td>'+
                        '</tr>');
                    });
                });
            }
        });
    }

    function confirm_sign_size()
    {
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
            }
        });
    };

    function load_data(item_code,item_id) {

        console.log(item_code,item_id);
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/show_data_item')?>",
            data: {
                item_id : item_id,
                item_code : item_code
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                var type_price = ''; 

                var i = 0;
                var BCPrice = [];
                $.each(data['ic_unit_use'], function (idx, val) { 
                    BCPrice[i] = val['unit_code'];
                    i++;
                });
                // console.log(data['BCITEM']);
                if (i == 1) {
                    $('#title_unittype').text('สินค้าแบบราคาเดียว');
                    type_price = 'single';
                }
                else{
                    if (BCPrice[0] == BCPrice[1]) {
                        $('#title_unittype').text('สินค้าแบบสเต็ปราคา');
                        type_price = 'step';
                    }else{
                        $('#title_unittype').text('สินค้าแบบหลายหน่วยนับ');
                        type_price = 'unit';
                    }
                }

                $('#detail_item').empty();
                $('#show_data_itemBC').empty();
                $('#show_data_itemINFO').empty();

                console.log(data['sign_sub_data']);

                $.each(data['sign_sub_data'], function (idn, val) { 
                    $('#detail_item').append(
                        
                        '<div class="row">'+
                            '<div class="col-md-3">'+
                                '<p><b>รหัสสินค้า</b> : '+val['field_itemcode']+' </p>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                                '<p><b>ชื่อสินค้า</b> : '+val['field_itemname']+' </p>'+
                            '</div>'+
                            '<div class="col-md-3">'+
                                '<p><b>ประเภทป้าย</b> : '+val['type_name']+' </p>'+
                            '</div>'+
                        '</div>'+
                        '<input type="hidden" value="'+val['field_id']+'" class="field_id form-control" name="field_id" id="field_id">'  
                    );

                    for (var i = 0; i < 6; i++) {
                        if (val['field_new_price'+i+''] != null) {
                            $('#show_data_itemINFO').append(
                                '<div>'+
                                    'ราคา '+i+' : '+val['field_new_price'+i+'']+
                                '</div>'
                            );
                        }
                    }
                });

                ar_packing = [];
                $.each(data['ic_unit_use'], function (idn, val) { 
                    var ar_Rates = {};
                    var Rate = 0;

                    if (val['from_qty'] == null) {
                        val['from_qty'] = val['stand_value'];
                    }

                    ar_Rates['Rate'] = val['from_qty'];
                    ar_Rates['packUnitcode'] = val['unit_code'];

                    Rate =  parseFloat(val['from_qty']);
                    Rate = Rate.toFixed(0);

                    if (type_price == 'step') {
                        if (idn == 0) {
                            $('#show_data_itemBC').append(
                                '<div class="row">'+

                                    '<div class="col-md-12">'+
                                        '<p><b>จำนวน  </b> 1 '+val['unit_code']+' มี '+commaSeparateNumber(Rate)+' หน่วย</p>'+
                                    '</div>'+
                                '</div>'+
                                '<input type="hidden" value="'+val['from_qty']+'" class="Rate form-control" name="Rate">'+
                                '<input type="hidden" value="'+val['unit_code']+'" class="packUnitcode form-control" name="packUnitcode">'
                            );

                        }
                    }else{
                        $('#show_data_itemBC').append(
                            '<div class="row">'+
                                '<div class="col-md-12">'+
                                    '<p><b>จำนวน  </b> 1 '+val['unit_code']+' มี '+commaSeparateNumber(Rate)+' หน่วย</p>'+
                                '</div>'+
                            '</div>'+
                            '<input type="hidden" value="'+val['from_qty']+'" class="Rate form-control" name="Rate">'+
                            '<input type="hidden" value="'+val['unit_code']+'" class="packUnitcode form-control" name="packUnitcode">'
                        );
                    }

                    ar_packing.push(ar_Rates);
                });

                ar_price_list = [];
                $.each(data['ic_unit_use'], function (idn, val) { 
                    var ar_price_lists = {};

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

                    ar_price_lists['SalePrice1'] = sh_price;
                    ar_price_lists['FromQty'] = val['from_qty'];
                    ar_price_lists['priceUnitcode'] = val['unit_code'];

                    var price = 0;
                    var FromQty = 0;
                    var price_all = 0;
                    price =  parseFloat(sh_price);
                    price = price.toFixed(2);
                    FromQty =  parseFloat(val['from_qty']);
                    FromQty = FromQty.toFixed(0);
                    price_all = parseFloat(sh_price) * parseFloat(val['from_qty']);

                    ar_price_lists['price_all'] =  parseFloat(price_all);
                    price_all = price_all.toFixed(2);

                    $('#show_data_itemBC').append(
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<p> <b>จำนวน</b> : '+commaSeparateNumber(FromQty)+' '+val['unit_code']+' <b>ราคา</b> '+commaSeparateNumber(price_all)+' บาท <b>ราคา '+val['unit_code']+ 'ละ</b> '+commaSeparateNumber(price)+' บาท</p>'+
                            '</div>'+
                        '</div>'+
                            '<input type="hidden" value="'+val['from_qty']+'" class="FromQty form-control" name="FromQty">'+
                            '<input type="hidden" value="'+val['unit_code']+'" class="priceUnitcode form-control" name="priceUnitcode">'+
                            '<input type="hidden" value="'+sh_price+'" class="SalePrice1 form-control" name="SalePrice1">'+
                            '<input type="hidden" value="'+price_all+'" class="price_all form-control" name="price_all">'
                    );
                    ar_price_list.push(ar_price_lists);
                });

                $('#barcode_select').empty();
                if (data['sign_barcode'] == '' ) {
                    $('#barcode_select').append(
                        '<option value="">ไม่มีบาร์โค้ด</option>'
                    );
                }
                else{
                    $.each(data['sign_barcode'], function (idn, val) { 
                        $('#barcode_select').append(
                            '<option value="'+val['barcode']+'">'+val['barcode']+' --> '+val['barcodeUnitcode']+'</option>'
                        );
                    });
                    $('#barcode_select').append(
                        '<option value="">ไม่ใส่บาร์โค้ด</option>'
                    );
                }
            }
        });
    }


    function commaSeparateNumber(val)
    {
        while (/(\d+)(\d{3})/.test(val.toString())){
        val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
        }
        return val;
    };

    function update_load_data() 
    {
        var field_id = $('#field_id').val();
        var barcode_select = $('#barcode_select').val();
        
        swal({
			title: 'คุณต้องการดึงข้อมูล?',
            type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#DCDCDC',
			confirmButtonText: 'ใช่',
			cancelButtonText: 'ปิด',
		}).then((result) => {
            if (result.value) {
           // console.log(field_id,ar_packing[0]['Rate'],ar_packing['packUnitcode'],ar_price_list['SalePrice1'],ar_price_list['FromQty'],ar_price_list['price_all'],barcode_select);
                if (ar_packing == '') {
                    $.ajax({
                        type: "post",
                        url: "<?= site_url('SignV2/update_load_data_nopacking')?>",
                        data: {
                            field_id : field_id,
                            ar_price_list : ar_price_list,
                            barcode_select : barcode_select
                        },
                        dataType: "json",
                        success: function (data) {
                            swal({
                                title: 'สำเร็จ',
                                text: "ดึงข้อมูลเรียบร้อยแล้ว",
                                type: 'success' ,
                                confirmButtonColor: '#6c757d',
                                confirmButtonText: 'ปิด' ,
                            }).then((result) => {
                                if (result.value) {
                                    $('#load_data_modal').modal('hide');
                                    get_sign_packing(); 
                                }
                            });
                        }
                    });
                }
                else{
                    $.ajax({
                        type: "post",
                        url: "<?= site_url('SignV2/update_load_data_packing')?>",
                        data: {
                            field_id : field_id,
                            ar_packing : ar_packing,
                            ar_price_list : ar_price_list,
                            barcode_select : barcode_select
                        },
                        dataType: "json",
                        success: function (data) {
                            swal({
                                    title: 'สำเร็จ',
                                    text: "ดึงข้อมูลเรียบร้อยแล้ว",
                                    type: 'success' ,
                                    confirmButtonColor: '#6c757d',
                                    confirmButtonText: 'ปิด' ,
                                }).then((result) => {
                                    if (result.value) {
                                        $('#load_data_modal').modal('hide');
                                        get_sign_packing(); 
                                    }
                                });
                        }
                    });
                }
            }
            else{
                
            }
		});
    };

</script>