<script type="text/javascript">
    
    $(document).ready(function(){

        get_view_rp();

        get_request_production_history();

        get_request_production_progress();

        accept_rp();

        get_image();

        input_btn_function_rp();

        all_click();

    });

    function all_click() {  
        $('#btn_print_labor').click(function (e) { 
            e.preventDefault();
            swal({
                title: 'คุณต้องการพิมพ์เฉพาะค่าแรง',
                text: "เมื่อพิมพ์แล้วจะไม่สามารถพิมพ์ค่าแรงอีกได้",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1CC88A',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value) {
                    var type = 1;
                    export_rp(type);
                    update_print(type);
                }
            });
        });

        $('#btn_print_item').click(function (e) { 
            e.preventDefault();
            swal({
                title: 'คุณต้องการพิมพ์เฉพาะค่าวัสดุ',
                text: "เมื่อพิมพ์แล้วจะไม่สามารถพิมพ์ค่าวัสดุอีกได้",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1CC88A',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value) {
                    var type = 2;
                    export_rp(type);
                    update_print(type);
                }
            });
        });

        $('#btn_print_all').click(function (e) { 
            e.preventDefault();
            swal({
                title: 'คุณต้องการพิมพ์ค่าแรงและวัสดุ',
                text: "เมื่อพิมพ์แล้วจะไม่สามารถพิมพ์อีกได้",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1CC88A',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value) {
                    var type = 3;
                    export_rp(type);
                    update_print(type);
                }
            });
        });
    }

    function export_rp(type) {  
        window.open('<?php echo site_url('Request_production/print_rp_first');?>'+'?id='+<?= $id ?>+'&type='+type+'');
        location.reload();
    }

    function update_print(type) {  
        $.ajax({
            type: "POST",
            url: "<?= site_url('Request_production/update_print_rp')?>",
            data: {
                field_id : <?= $id ?>,
                type : type 
            },
            dataType: "JSON",
            success: function (data) {
                
            }
        });
    }

    function input_btn_function_rp() 
    {

        // cal_rp_cost_final

            $('.finalnew_text').hide();

            $('#field_rp_cost_textnew').hide();

            $('#field_rp_cost_finalnew').hide();

            $('.row_cal_rp_cost_final').hide();

            $('#cal_rp_cost_final').keyup(function (e) { 
                cal_cost_final('');
            });

        // END cal_rp_cost_final

        setTimeout(function() { 

            if("<?= $type?>" == 'accept'){
                
            }else if("<?= $type?>" == 'summary'){

                $('.row_cal_rp_cost_final').hide();
                $('#btn_accept_submit').hide();
                
            }else if("<?= $type?>" == 'view'){

                $('.row_cal_rp_cost_final').hide();
                $('.row_info').show();
                $('.row_history').show();
                // $('.row_summary').hide();
                $('.row_labor').show();
                $('.row_item').show();
                
                $('#btn_accept_submit').hide();
            }
            
        }, 3000);

        $('textarea').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
            }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        $('#accept_employee').on('click','.btn_accept',function(){
            var id = $(this).closest('tr').find('.accept_id').text();
            var status = 0;
            accept_employee(id,status);
        });

        $('#accept_employee').on('click','.btn_unaccept',function(){
            var id = $(this).closest('tr').find('.accept_id').text();
            var status = 1;
            accept_employee(id,status);
        });


        $('#btn_accept_submit').click(function (e) {
            e.preventDefault();

            var validate = validate_accept();

            if(validate == 'true' ){
                
                update_cost_final();

            }
            
        });

    };

    function get_view_rp()
    {
		swal({
			title: 'การดึงข้อมูล',
			html: 'กรุณารอสักครู่',
			onOpen: () => {
			swal.showLoading()
			},
		});
        $.ajax({
        type: "POST",
        url: "<?= site_url('Request_production/get_view_rp')?>",
        data: {
            id : <?= $id ?>
        },
        dataType: "JSON",
        success: function(data){
            swal.close();
            console.log(data)
            if (data['request_production']['field_doc_type'] == 1) {
                $('#info_field_fix_itemname').html('&emsp;' + data['request_production']['field_rp_name']);
            }else{
                if (data['request_production']['field_fixitem_sub_id'] != null) {
                    get_fixitem_sub_byid(data['data_field_fixitem_id']['field_type_sub_no'])
                    get_fixhistory(data['request_production']['field_fixitem_sub_id'])
                    $('#info_field_fix_itemname').html('&emsp;' + data['data_field_fixitem_id']['field_name_th']);
                }else{
                    $('#info_field_fix_itemname').html('&emsp;' + data['request_production']['field_rp_name']);
                }
            }

            if (data['request_production']['field_rp_fix'] != null) {
                $('#info_field_rp_fix').html('&emsp;' + data['request_production']['field_rp_fix']);
            }else{
                $('#info_field_rp_fix').html('&emsp; ไม่มี');
            }

            // --------------- info-----------------

            $('#info_creator_fullname').html('&emsp;' + data['request_production']['ecfullname']);
            $('#info_create_date').html('&emsp;' + date(data['request_production']['field_rp_create_date']));
            $('#info_controller_fullname').html('&emsp;' + data['request_production']['ectfullname']);
            $('#info_topic_name').html('&emsp;' + data['request_production']['topic_name']);
            
            $('#info_info_field_docno').html('&emsp;' + data['request_production']['field_docno']);
            $('#info_info_field_rp_name').html('&emsp;' + data['request_production']['field_rp_name']);
            $('#info_doc_type_status').html('&emsp;' + data['request_production']['doc_type_status']);

            $('#info_field_rp_worker').html('&emsp;' + data['request_production']['field_rp_worker']);
            $('#info_field_rp_require_date').html('&emsp;' + date(data['request_production']['field_rp_require_date']));
            $('#info_field_rp_cause').html('&emsp;' + data['request_production']['field_rp_cause']);
            $('#info_field_rp_description').html('&emsp;' + data['request_production']['field_rp_description']);
            

            $('#field_rp_cost_final').text(data['request_production']['field_rp_cost_final']);

            if("<?= $type?>" == 'summary')
            {
                $('#cal_rp_cost_final').val(data['request_production']['field_rp_cost_final']);
            }

            // --------------- END info-------------

            $('#field_rp_cost_estimate').text(data['request_production']['field_rp_cost_estimate']);

            $('#field_rp_cost_final_comment').val(checknull(data['request_production']['field_rp_cost_final_comment']));

            id = data['request_production']['field_id'];
        
            var labor_type = 0;
            var item_type = 0;
            var all_type = 0;

            if(data['laborlist'].length > 0){
                // $('.row_labor').show();
                $('#data_labor_list').empty();
                $.each(data['laborlist'], function( key, value){

                    $('#data_labor_list').append(
                        '<tr>' +
                            '<td class="text-center" >' +
                                '<span>'+ ( key + 1) +'</span>'+
                            '</td>' +
                            '<td class="text-left" >' +
                                '<span id="field_item_name" >'+value['field_item_name']+'</span>'+
                            '</td>' +
                            '<td class="text-right" >' +
                                '<span id="field_item_qty" class="field_item_qty">'+value['field_item_qty']+'</span>'+
                            '</td>' +
                            '<td class="text-right" >' +
                                '<span id="field_item_unit" >'+value['field_item_unit']+'</span>'+
                            '</td>' +
                            '</td>' +
                                '<td class="text-right" >' +
                                '<span id="field_item_priceunit" class="field_item_priceunit">'+value['field_item_priceunit']+'</span>'+
                            '</td>' +
                            '</td>' +
                                '<td class="text-right" >' +
                                '<span id="field_item_price" >'+comma(value['field_item_price'])+'</span>'+
                            '</td>' +
                            '</td>' +
                        '</tr>'
                    );
                });
                labor_type = 1;
            }else{
                $('.row_labor').hide();

                labor_type = 0;
            }

            if(data['itemlist'].length > 0){
                // console.log(data['itemlist']);
                $('#data_itemlist').empty();
                $.each(data['itemlist'], function( key, value){

                    var stkissue_doc = '';
                    var stkissueret_doc = '';
                    var status = '';
                    var sum_qty = '';

                    var stkissue_qty = 0;
                    var sum_diffrow = 0;
                    var stkissueRet_qty = 0;
                    

                    var item_qty = parseFloat(value['field_item_qty']);
                    var unit_price = parseFloat(value['field_item_priceunit']);
                    
                    if(value['stkissue_docno'] !== ''){
                        stkissue_qty = parseFloat(value['stkissue_qty']);
                    }

                    if(value['stkissueRet_docno'] !== ''){
                        stkissueRet_qty = parseFloat(value['stkissueRet_qty']);

                        if (value['stkissueRet_qty2']) {
                            stkissueRet_qty = stkissueRet_qty + parseFloat(value['stkissueRet_qty2'])
                        }

                        sum_diffrow = stkissueRet_qty * unit_price;
                    }

                    sum_qty = stkissue_qty - stkissueRet_qty;

                    // console.log();

                    if(value['stkissue_docno'] !== ''){

                        if(value['stkissueRet_docno'] !== ''){
                            stkissue_doc = '<span class="text-green Sarabun-Regular"><i class="fa fa-clock-o"></i> เบิกสินค้าจริง<br>'+value['stkissue_docno']+'('+sum_qty.toFixed(2)+')</span><br>';
                            stkissueret_doc = '<span class="text-yellow Sarabun-Regular"><i class="fa fa-cube"></i> รับคืนสินค้า<br>'+value['stkissueRet_docno']+'('+parseFloat(value['stkissueRet_qty']).toFixed(2)+')</span><br>';
                            stkissueret_doc += '<small class="Sarabun-Regular"><b>หมายเหตุ รับคืนสินค้า :</b> '+value['BCStkIssueRetSub_MyDescription']+'</small>';

                        if (value['stkissueRet_qty2']) {
                            // stkissue_doc += '<br><span class="text-green Sarabun-Regular"><i class="fa fa-clock-o"></i> เบิกสินค้าจริง<br>'+value['stkissue_docno']+'('+sum_qty.toFixed(2)+')</span><br>';
                            stkissueret_doc += '<span class="text-yellow Sarabun-Regular"><i class="fa fa-cube"></i> รับคืนสินค้า<br>'+value['stkissueRet_docno2']+'('+parseFloat(value['stkissueRet_qty2']).toFixed(2)+')</span><br>';
                            stkissueret_doc += '<small class="Sarabun-Regular"><b>หมายเหตุ รับคืนสินค้า :</b> '+value['BCStkIssueRetSub_MyDescription2']+'</small>';


                        }


                        }else{
                            stkissue_doc = '<span class="text-green Sarabun-Regular"><i class="fa fa-cubes"></i> เบิกสินค้าเต็มจำนวน<br>'+value['stkissue_docno']+'('+stkissue_qty.toFixed(2)+')</span><br>';
                        }

                    }else{
                        stkissue_doc = '<span class="text-yellow Sarabun-Regular"><i class="fa fa-clock-o"></i> ไม่ได้ทำเบิกสินค้า</span><br>';
                    }

                    $('#data_itemlist').append(
                        '<tr>' +

                            '<td class="text-center">' +
                                '<span>'+ (key+1 )+'</span>'+
                            '</td>' +

                            '<td class="text-center">' +
                                '<span id="field_item_name" >'+value['field_bc_docno']+'</span>'+
                            '</td>' +

                            '<td class="text-left">' +
                                '<p id="field_bc_item_code"><b>'+ value['field_bc_item_code'] +'</b></p>'+
                                '<p id="field_item_name">'+ value['field_item_name'] +'</p>'+
                                '<small><b>หมายเหตุ รหัสสินค้า</b> : <span id="field_bc_item_code_detail">'+ checknull(value['field_bc_item_code_detail']) +'</span> </small>'+
                                '<br>'+
                                '<small><b>หมายเหตุ ใบขอเบิกสินค้า,วัตถุดิบ</b> : <span id="field_bc_docno_detail">'+ checknull(value['field_bc_docno_detail']) +'</span></small>'+
                            '</td>' +

                            '<td class="text-right">' +
                                '<span id="field_item_qty" class="field_item_qty">'+value['field_item_qty']+'</span>'+
                            '</td>' +

                            '<td class="text-right">' +
                                '<span id="field_item_unit" >'+value['field_item_unit']+'</span>'+
                            '</td>' +
                           
                            '<td class="text-right">' +
                                '<span id="field_item_priceunit" class="field_item_priceunit">'+value['field_item_priceunit']+'</span>'+
                            '</td>' +
                            '<td class="hidden field_ret_qty">'+stkissueRet_qty+'</td>'+
                            '<td class="text-right">' +
                                '<span id="field_item_price" >'+comma(value['field_item_price'])+'</span>'+
                            '</td>' +
                            
                            '<td class="text-center">' +
                                '<span id="field_bc_docno" >'+ stkissue_doc + stkissueret_doc +'</span>'+
                            '</td>' +
                        
                            '<td class="text-center hidden">' +
                                '<input type="text" class="field_diff_row" id="field_diff_row" value="'+ sum_diffrow +'">'+
                            '</td>' +

                        '</tr>'
                    );
                });
               
                item_type = 1;
            }else{
                $('.row_item').hide();
                $('.row_cal_rp_cost_final').show();
                item_type = 0;
            }

            check_active_print(data['request_production']['field_labor_print'],labor_type,data['request_production']['field_item_print'],item_type,data['request_production']['field_laboritem_print'],all_type)
        }

        });

       

        setTimeout(function() { 

            var field_rp_cost_final = $('#field_rp_cost_final').text();
            var field_rp_cost_estimate = $('#field_rp_cost_estimate').text();

            if("<?= $type?>" == 'summary'){
                if(parseFloat(field_rp_cost_final)){
                    cal_cost_final_text(
                        '',
                        parseFloat(field_rp_cost_final),
                        parseFloat(field_rp_cost_estimate)
                    );
                    cal_cost_final('new');
                }else{
                    cal_cost_final('');
                }
            }else{
                cal_cost_final('');
            }
            

        }, 4000);


    };


    function check_active_print(labor,labor_type,item,item_type,all,all_type) {  

        // console.log(labor_type,labor);
        if (labor_type == 1) {
            if (labor == 0) {
                $('#btn_print_labor').addClass('btn-primary');
                $('#btn_print_labor').removeClass('btn-default');
                $('#btn_print_labor').prop( "disabled", false );
            }else{
                $('#btn_print_labor').removeClass('btn-primary');
                $('#btn_print_labor').addClass('btn-default');
                $('#btn_print_labor').prop( "disabled", true );
            }
        }else{
            $('#btn_print_labor').removeClass('btn-primary');
            $('#btn_print_labor').addClass('btn-default');
            $('#btn_print_labor').prop( "disabled", true );
        }

        if (item_type == 1) {
            if (item == 0) {
                $('#btn_print_item').addClass('btn-primary');
                $('#btn_print_item').removeClass('btn-default');
                $('#btn_print_item').prop( "disabled", false );
            }else{
                $('#btn_print_item').removeClass('btn-primary');
                $('#btn_print_item').addClass('btn-default');
                $('#btn_print_item').prop( "disabled", true );
            }
        }else{
            $('#btn_print_item').removeClass('btn-primary');
            $('#btn_print_item').addClass('btn-default');
            $('#btn_print_item').prop( "disabled", true );
        }

        if (labor_type == 1 || item_type == 1) {
            $('#btn_print_all').removeClass('btn-primary');
            $('#btn_print_all').addClass('btn-default');
            $('#btn_print_all').prop( "disabled", true );
        }else{
            if (all == 0) {
                $('#btn_print_all').addClass('btn-primary');
                $('#btn_print_all').removeClass('btn-default');
                $('#btn_print_all').prop( "disabled", false );
            }else{
                $('#btn_print_all').removeClass('btn-primary');
                $('#btn_print_all').addClass('btn-default');
                $('#btn_print_all').prop( "disabled", true );
            }
        }

    }

    function accept_rp()
    { 
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/accept_rp')?>',
            data: {
                id : <?= $id ?>
            },
            dataType:'JSON',
        }).done(function(data){

            console.log(data);

            $('#accept_employee').empty();
            $.each(data['data_accept_status'], function (id,val) { 
        
                var btn_action = '';
                var mg_confirm = '';
                var btn_accept = '';
                var btn_unaccept = '';

                btn_accept = '<span class="col-md-6"><button type="button" class="btn btn-primary btn_accept" > ทำงาน </button></span>';
                btn_unaccept = '<span class="col-md-6"><button type="button" class="btn btn-secondary btn_unaccept "> ไม่ได้ทำงาน </button></span>';    

                if("<?= $type?>" == 'accept'){

                    if(val['field_status'] == null ){

                        $('#btn_accept_submit').hide();

                        btn_action  = btn_accept ; 
                        btn_action += btn_unaccept;

                    }else{
                        $('#btn_accept_submit').show();
                    }

                }

                $('#accept_employee').append(
                    '<tr>'+
                        '<td class="hidden accept_id">'+ val['field_id'] +'</td>'+
                        '<td class="col-md-4">' + val['accept_status'] + '<br>' + '<b>' + val['ewlastposition'] + '</b> <br>' + val['ewfullname'] +'</td>'+
                        '<td class="col-md-4">'+ btn_action +'</td>'+
                    '</tr>'
                    );
                });

                $('#data_rp_id').val(data['data_accept']['field_id']);

        }).fail(function(data){
            
        });
    };

    function cal_cost_final(type)
    { 
        var field_diff_row = 0;
        var sum = 0;
        var cost_final = 0;
        var cost_text = '';
        var cost_estimate =  round($('#field_rp_cost_estimate').text(),4);
           
        if($('#data_itemlist').find('tr').length != 0){

            if ($('#data_labor_list').find('tr').length != 0) {
                $('#data_labor_list').find('tr').each(function(){
                    var total = 0;
                    var field_qty = $(this).find('.field_item_qty').text();
                    var field_item_priceunit = $(this).find('.field_item_priceunit').text();

                    total = round(field_qty,4) * round(field_item_priceunit,4);

                    if (total > 0) {
                        sum = sum + parseFloat(total) ;
                    }

                    // console.log(sum);
                });
            }
            
            $('#data_itemlist').find('tr').each(function(){
                
                // var field_diff_row = $(this).find('.field_diff_row').val();
                // if(field_diff_row > 0 ){
                //     sum = sum + parseFloat(field_diff_row) ;
                // }
                var field_qty = $(this).find('.field_item_qty').text();
                var field_ret_qty = $(this).find('.field_ret_qty').text();
                var field_item_priceunit = $(this).find('.field_item_priceunit').text();

                var total = 0;
                total = (round(field_qty,4) - round(field_ret_qty,4)) * round(field_item_priceunit,4);
             
                if (total > 0) {
                    sum = sum + round(total,2) ;
                }
                // console.log(sum);
                
            });

            if(parseFloat(cost_estimate) != 0){
                // cost_final = parseFloat(cost_estimate) - parseFloat(sum);
                // console.log(cost_estimate,sum);
                cost_final = sum;
                $('#field_rp_cost_final'+type).text((sum).toFixed(2));
            }else{
                $('#field_rp_cost_final'+type).text('...');
            }

            // console.log(cost_final,cost_estimate,'aaaaaa');
            
            // cal_cost_final_text( type,cost_final,cost_estimate);
        }else{

            if ($('#data_labor_list').find('tr').length != 0) {
                $('#data_labor_list').find('tr').each(function(){
                    var total = 0;
                    var field_qty = $(this).find('.field_item_qty').text();
                    var field_item_priceunit = $(this).find('.field_item_priceunit').text();

                    total = round(field_qty,4) * round(field_item_priceunit,4);

                    if (total > 0) {
                        sum = sum + parseFloat(total) ;
                    }

             
                });
            }
           
            // sum =  parseFloat($('#cal_rp_cost_final').val());
            if(parseFloat(sum) != 0){
                $('#field_rp_cost_final'+type).text((sum).toFixed(2));
                cost_final = parseFloat(sum) ;
            }else{
                $('#field_rp_cost_final'+type).text('...');
            }

            // console.log('aaa');
           
        }

        // console.log(cost_estimate,cost_final,type);


        cal_cost_final_text( type,cost_final,cost_estimate);

    };

    function cal_cost_final_text(
        type,
        cost_final,
        cost_estimate
    )
    {
     

        console.log(cost_estimate,cost_final,type);

        if(round(cost_final,4) != 0){
            if(round(cost_estimate,4) > round(cost_final,4)){
                $('#field_rp_cost_text'+type).text("ใช้จริงน้อยกว่าประมาณการ");
            }else if(round(cost_estimate,4) == round(cost_final,4)){
                $('#field_rp_cost_text'+type).text("ใช้จริงเท่ากับประมาณการ");
            }else if(round(cost_estimate,4) < round(cost_final,4)){
                $('#field_rp_cost_text'+type).text("ใช้จริงมากกว่าประมาณการ");
            }else{
                $('#field_rp_cost_text'+type).text("...");
            }
        }else{
            $('#field_rp_cost_text'+type).text('...');
        }

        if(type == 'new'){
            compare_cost_last();
        }

    };

    function compare_cost_last() 
    {
        var cost_final = $('#field_rp_cost_final').text();
        var cost_finalnew = $('#field_rp_cost_finalnew').text();
        if((parseFloat(cost_finalnew) || 0) != 0){
            if(parseFloat(cost_final) !=  parseFloat(cost_finalnew))
            {
                $('.finalnew_text').show();
                $('#field_rp_cost_textnew').show();
                $('#field_rp_cost_finalnew').show();
            }
        }
        
    };

    function accept_employee(id,status)
    { 

        swal({
            title: 'คุณแน่ใจไหม',
            text: "การระบุสถานะการทำงาน",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1CC88A',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'ใช่ ,ฉัน ตกลง',
            cancelButtonText: 'ปิด',
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: "<?= site_url('Request_production/accept_employee')?>",
                    data: {
                        accept_id : id,
                        accept_type : status 
                    },
                    dataType: "JSON",
            
                    success: function (data) {

                        swal({ 
                            title: 'สำเร็จ',
                            text: "คุณระบุสถานะการทำงานสำเร็จ",
                            type: 'success',
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        }).then((result) => {
                            if (result.value) {

                                get_view_rp();

                                accept_rp();
                            
                            }
                            
                        });

                    } ,
                    error: function (data) {
                        swal({
                            title: 'ERROR',
                            text: "เกิดข้อผิดพลาดบางอย่าง",
                            type: 'error',
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        });
                    }
                });

            }
        });

    };

    function update_cost_final()
    { 

        swal({
        title: 'คุณแน่ใจไหม',
        text: "การบันทึกสรุปงานสั่งผลิต-สั่งซ่อม",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#1CC88A',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'ใช่ ,ฉัน ตกลง',
        cancelButtonText: 'ปิด',
        }).then((result) => {
            if (result.value){

                $.ajax({
                    type: "POST",
                    url: "<?= site_url('Request_production/update_cost_final')?>",
                    data: {
                        rp_id : $('#data_rp_id').val(),
                        rp_cost_final : $('#field_rp_cost_final').text(),
                        rp_cost_final_comment : $('#field_rp_cost_final_comment').val()
                    },
                    dataType: "JSON",
                    success: function (data) {

                        swal({ 
                        title: 'สำเร็จ',
                        text: "คุณบันทึกสรุปงานสั่งผลิต-สั่งซ่อมสำเร็จ",
                        type: 'success',
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                        }).then((result) => {
                            if (result.value) {
                                window.top.close();
                            }
                        });
                        
                        
                    },error: function (data) {
                        swal({
                            title: 'ERROR',
                            text: "เกิดข้อผิดพลาดบางอย่าง",
                            type: 'error',
                            confirmButtonColor: '#6c757d',
                            confirmButtonText: 'ปิด' ,
                        });
                    }
                });
                
            }
        });
    };

    function validate_accept() 
    {
        var validate = 'true';

        if($('#field_rp_cost_final_comment').val() == '' ){
            $( "#field_rp_cost_final_comment" ).removeClass( "is-valid" ).addClass( "is-warning" );
            $('#field_rp_cost_final_comment').css('border','rgb(243, 156, 18) 2px solid');
            validate = 'false';
        }else if($('#field_rp_cost_final_comment').val() != '' ){
            $( "#field_rp_cost_final_comment" ).removeClass( "is-warning" ).addClass( "is-valid" );
            $('#field_rp_cost_final_comment').css('border','');
        }

        return validate;
    };

    function get_image()
    {
        var id = <?= $id ?>;
        $('#links').empty();
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/get_image')?>',
            dataType:'JSON',
            data: {id : <?= $id ?>},

        }).done(function(data){

            if(data){
                $('#links').empty();
                $.each(data['scandir'],function(ids,val){

                    if(val != '.' && val != '..' && !val.match(/pdf.*/)){  
                        var url = '<?= base_url('assets/images/Request_production/')?>/'+id+'/'+val
                        $('#links').append('<a target="_blank" href="'+url+'" >'+
                            '<img src="'+url+'" width="110" height="110" >'+
                        '</a>');
                    
                    }else{
                        var url = '<?= base_url('assets/images/Request_production/')?>/'+id+'/'+val
                        $('#links').append(
                            '<a target="_blank" href="'+url+'" title=" '+val+' ">'+'</a>'
                        );
                    }

                });

            }
        }).fail(function(data){
        });
    };

    function get_request_production_history() 
    { 
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/get_rp_history')?>',
            dataType:'JSON',
            data : {
                id : <?= $id ?>
            },
            }).done(function(data){

                    $('#data_request_production_history').empty();

                    if (data['request_production_history'] != '') {
                    
                        $.each(data['request_production_history'], function (key, value) {

                            $('#data_request_production_history').append(
                            '<tr>'+
                                '<td class="text-left">'+ 
                                    '<b>' + value['history_status'] + '</b>' + '<br>' +
                                    value['editor_status']  + '<br>' +
                                    date(value['field_edit_date']) + ' ' + time(value['field_edit_date'])  + '<br>' +
                                    '<i class="fa fa-comment"></i> ' + value['field_rp_history_ceo']  + 
                                '</td>'+
                                '<td class="text-left">'+ 
                                    '<b>' + value['field_rp_history_name'] + '</b>' + '<br>' +
                                    value['field_rp_history_description'] +
                                '</td>'+
                            '</tr>'
                            );
                        });
                    }else{
                        $('#data_request_production_history').append(
                            '<tr>'+
                                '<td class="text-left" colspan="2">ไม่มีข้อมูลประวัติ</td>'+
                            '</tr>'
                        );
                    }

            }).fail(function(data){
        });
    };

    function get_request_production_progress() 
    { 
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/get_rp_progress')?>',
            dataType:'JSON',
            data : {
                id : <?= $id ?>
            },
            }).done(function(data){
                
                $('#data_request_production_progress').empty();
                $.each(data['request_production_progress'], function (id, value) {

                    $('#data_request_production_progress').append(
                        '<tr>'+
                            '<td class="text-left">'+ 
                                '<b>' + value['eufullname'] + '</b>' + '<br>' +
                                date(value['field_update_date']) + ' ' + time(value['field_update_date']) +
                            '</td>'+
                            '<td class="text-left" >'+value['field_update']+'</td>'+
                        '</tr>'
                    );
                });
                
            }).fail(function(data){
        });
    };

    function round(value, decimals) 
    { 
        return Number(Math.round(value+'e'+decimals)+'e-'+decimals); 
    }

   
</script>