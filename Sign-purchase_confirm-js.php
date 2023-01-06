<script type="text/javascript">
    $(document).ready(function () {
        all_click();

        get_groupcode();
        confirm_sign_type_price();
        confirm_sign_size();
        select2();
        get_sign();
    });

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

        $( "#usersPerPage" ).select2({
            theme: "bootstrap4"
        });
    }

    function all_click() {  

        $('#btn_refresh').click(function (e) { 
            e.preventDefault();
            var field_id = $('#field_view_id').val();
            detail_sign(field_id);

        });

        $('#tb_list_sign').on('click','.btn_view ',function(){ 
			var field_id = $(this).closest('tr').find('.field_id').text();
			var field_docno = $(this).closest('tr').find('.field_docno').text();
			$('#view_modal').modal('show');
            detail_sign(field_id);
		});

        $('#btn_unconfirm').click(function (e) { 
            e.preventDefault();
            swal({
            title: 'ยกเลิกปรับราคา?',
            text: 'หากยกเลิกแล้วรายการจะหายไป',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#BEBEBE',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value){
                    var field_id = '';
                    var i = 0;
                    for( i ; i < $('#tb_list_sign tr.select').length; i++ ){
                        field_id += $('#tb_list_sign tr.select').eq(i).attr('id')+'-';
                    }

                    update_purcease_unconfirm(field_id);
                }
            });
        });

        $('#search_text').keyup(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
            get_sign();
        });

        $('#usersPerPage').change(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
            get_sign();
        });

        $('#search_groupcode').change(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
            get_sign();
        });

        $('#search_type').change(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
            get_sign();
        });

        $('#search_size').change(function (e) { 
            e.preventDefault();
            $('#pageNumber').val(0);
            get_sign();
        });

        $(document).on('click','.pageNumber',function(){
			$('#pageNumber').val($(this).text()-1);
			get_sign();
        });


        $('#btn_confirm').click(function (e) { 
            e.preventDefault();
            var field_id = '';
            var i = 0;
            for( i ; i < $('#tb_list_sign tr.select').length; i++ ){
                field_id += $('#tb_list_sign tr.select').eq(i).attr('id')+'-';
            }

            swal({
                title: 'คุณต้องการยืนยันการปรับราคา?',
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#DCDCDC',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value) {
                    update_purcease_confirm(field_id);
                }
            });
        });

        $('#btn_selectall').click(function (e) { 
            e.preventDefault();
            if($("#tb_sign tbody tr:not(.select)").length == 0){
                $("#tb_sign tbody tr.select").removeClass('select');
                $("#btn_confirm").addClass('hidden');
                $("#btn_unconfirm").addClass('hidden');
            }else{
                $("#tb_sign tbody tr:not(.select)").addClass('select');
                $("#btn_confirm").removeClass('hidden');
                $("#btn_unconfirm").removeClass('hidden');
            }
        });

        $('#tb_list_sign').delegate('tr', 'click', function(e) {
            if($(this).hasClass('select')){
                $(this).removeClass('select');
                $('#dataSelect tr#'+$(this).attr('id')).remove();
                if($('#tb_sign tbody tr.select').length == 0){
                    $("#btn_confirm").addClass('hidden');
                    $("#btn_unconfirm").addClass('hidden');
                }
            }else{
                $(this).addClass('select');
                $(this).clone().appendTo('#dataSelect tbody');
                $('#dataSelect tr#'+$(this).attr('id')+' td.remove').remove();
                $('#dataSelect tr#'+$(this).attr('id')).removeClass('select');
                $("#btn_confirm").removeClass('hidden');
                $("#btn_unconfirm").removeClass('hidden');
            }
        });
    }

    function update_purcease_unconfirm(field_id) {  
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/update_purcease_unconfirm')?>",
            data: {
                field_id : field_id
            },
            dataType: "json",
            success: function (data) {
                swal({
                    title: 'สำเร็จ',
                    text: "ยกเลิกการปรับราคาเรียบร้อย",
                    type: 'success' ,
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {
                    if (result.value) {
                        get_sign(); 
                        $("#btn_confirm").addClass('hidden');
                        $("#btn_unconfirm").addClass('hidden');
                    }
                });
            }
        });
    }

    function update_purcease_confirm(field_id) {  
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/update_purcease_confirm')?>",
            data: {
                field_id : field_id
            },
            dataType: "json",
            success: function (data) {
                swal({
                        title: 'สำเร็จ',
                        text: "ยืนยันปรับราคาเรียบร้อย",
                        type: 'success' ,
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                    }).then((result) => {
                        if (result.value) {
                            get_sign(); 
                            $("#btn_confirm").addClass('hidden');
                            $("#btn_unconfirm").addClass('hidden');
                        }
                    });
            }
        });
    }

    function detail_sign(field_id) {  
        $('#field_view_id').val(field_id);
        $('#price_row').empty();
        $.ajax({
            type: "post",
            url: "<?= site_url('SignV2/select_confirm_detail')?>",
            data: {
                field_id : field_id
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#view_title').text('สินค้า '+data['tb_signv2_sub']['field_itemcode']+' '+data['tb_signv2_sub']['field_itemname']);

                var old_price = '';
                var new_price = data['tb_signv2_sub']['field_price1'];
                if (data['tb_signv2_sub']['field_new_price1'] != null && data['tb_signv2_sub']['field_old_price1'] != null) {
                    old_price = data['tb_signv2_sub']['field_old_price1'];
                    new_price = data['tb_signv2_sub']['field_new_price1'];
                    if (data['tb_signv2_sub']['field_new_price1'] == 0) {
                        new_price = data['tb_signv2_sub']['field_price1'];
                    }
                }

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
                        var price = data['tb_signv2_sub']['field_new_price1'];
                    }else if (i == 2) {
                        var price = data['tb_signv2_sub']['field_new_price2'];
                    }else if (i == 3) {
                        var price = data['tb_signv2_sub']['field_new_price3'];
                    }else if (i == 4) {
                        var price = data['tb_signv2_sub']['field_new_price4'];
                    }else if (i == 5) {
                        var price = data['tb_signv2_sub']['field_new_price5'];
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
            }
        });
    }

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
                field_confirm_status : '3'
                },
            dataType: "JSON",
            success: function (data) {
                
                // console.log(data);
                $('#tb_list_sign').empty();
                $.each(data['Sign'],function(id,val){
                
                var sign_type = '';

                var confirm_status = '';
                var packing_status = '';

                var btn_view = ' <button class="btn btn-info btn_view "type="button" > ดู </button> ';

                 $('#tb_list_sign').append(
                    '<tr id='+val['field_id']+'>'+
                        '<td class="hidden field_id">'+val['field_id']+'</td>'+
                        '<td width="10%" class="field_docno hidden" style="text-align:left;">'+ val['field_docno'] +'</td>'+
                        '<td width="10%" class="text-left"> '+ val['field_itemcode'] +' </td>'+
                        '<td width="20%" class="text-left"> '+ val['field_itemname'] +' </td>'+
                        '<td width="10%" class="text-left">'+ val['type_name'] +'</td>'+
                        '<td width="10%" class="text-left">'+ formatDatetime(val['field_createdate']) +'</td>'+
                        '<td width="10%" class="text-left">'+ formatDate(val['field_change_date']) +'</td>'+
                        '<td width="10%" class="text-left">'+ val['creator_firstname'] +'('+val['creator_nickname']+')</td>'+
                        '<td width="10%">'+btn_view+'</td>'+
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
            
        }).fail(function(data){
        });
    }

    function formatDate(dateStr) 
    {
        const d = new Date(dateStr);
        var mm = String(d. getMonth() + 1). padStart(2, '0'); //January is 0!
        return d.getDate().toString().padStart(2, '0') + '/' + mm + '/' + d.getFullYear().toString().padStart(2, '0');
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