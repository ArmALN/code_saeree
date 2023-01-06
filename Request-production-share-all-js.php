
<script type="text/javascript">
    
    $(document).ready(function()
    {
      
        // $('.select2').css('width','100%');

        // $('.select2-selection__choice').css('width','200px');
    });

    // Add Edit

        function get_fixitem()
        {
            $( "#field_fixitem_id" ).select2({
                theme: "bootstrap4"
            });

            $.ajax({
                type:'POST',
                url:'<?= site_url('Request_production/get_fixitem')?>',
                dataType:'JSON',
                }).done(function(data){

                    $('#field_fixitem_id').empty();
                    $('#field_fixitem_id').append('<option value=""> ระบุสิ่งที่ต้องการซ่อม </option>');
                    $.each(data['fixitem'],function(id,val){
                        $('#field_fixitem_id').append('<option value="'+val['field_id']+'">'+val['field_name_th']+' ['+val['field_name_en']+']</option>');
                    });

                }).fail(function(data){
            });
        };

        function get_fixitem_sub_byid(id)
        {
            $( "#field_fixitem_sub_id" ).select2({
                theme: "bootstrap4"
            });

            $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/get_fixitem_sub_byid')?>',
            data: {
                field_fixitem_no : id
            },
            dataType:'JSON',
            }).done(function(data){

                console.log(data);

                $('#field_fixitem_sub_id').empty();
                $('#field_fixitem_sub_id').append('<option value=""> ระบุสิ่งที่ต้องการซ่อมย่อย </option>');
                $.each(data['data_fixitem_sub'],function(id,val){
                    $('#field_fixitem_sub_id').append('<option value="'+val['field_id']+'">'+val['field_name_th']+' ['+val['field_name_en']+']</option>');
                    
                });
                
            }).fail(function(data){
                
            });
        };

        function check_fixitem(id) {  
            $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/check_fixitem_item_byid')?>',
            data: {
                field_fixitem_item_no : id
            },
            dataType:'JSON',
            }).done(function(data){
                if (data['data_fixitem_sub']['field_qty_fix'] != 0) {

                    swal({
                        title: 'เตือน',
                        text: "สินทรัพย์นี้กำลังซ่อมอยู่",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#1CC88A',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                        cancelButtonText: 'ปิด',
                    }).then((result) => {
                        if (result.value){
                            swal({
                                title: 'หมายเหตุที่ต้องการซ่อมอีกครั้ง',
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
                                    fixit_again(id,result.value);
                                }
                            });
                        }else{
                            $('#field_fixitem_id').val(null).trigger('change');
                            $('#field_fixitem_sub_id').val(null).trigger('change');
                            $('#row_fixhistory').hide();
                        }
                    });
                }

            }).fail(function(data){
                
            });
        }

        function fixit_again(id,comment) {  
            $.ajax({
                type: "post",
                url:'<?= site_url('Request_production/fixit_again')?>',
                data:{
                    id : id,
                    comment : comment
                },
                dataType: "json",
                success: function (data) {
                    
                }
            });
        }

        function get_fixitem_item_byid(id)
        {
            $( "#field_fixitem_item_id" ).select2({
                theme: "bootstrap4"
            });

            $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/get_fixitem_item_byid')?>',
            data: {
                field_fixitem_sub_no : id
            },
            dataType:'JSON',
            }).done(function(data){

                console.log(data);

                $('#field_fixitem_item_id').empty();
                $('#field_fixitem_item_id').append('<option value=""> ระบุสิ่งที่ต้องการซ่อมย่อย </option>');
                $.each(data['data_fixitem_sub'],function(id,val){
                    $('#field_fixitem_item_id').append('<option value="'+val['field_id']+'">'+val['field_name_th']+'</option>');
                    
                });
                
            }).fail(function(data){
                
            });
        };

        function get_fixhistory(id)
        {
            $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/get_fixhistory')?>',
            data: {
                field_fixitem_sub_id : id
            },
            dataType:'JSON',
            }).done(function(data){

                console.log(id);
                console.log(data);
                var no = 1;
                $('#data_fixhistory').empty();
                if( data['fix_history'].length > 0){
        
                    $.each(data['fix_history'],function(id,val){
                        $('#data_fixhistory').append(
                            '<tr>'+
                                '<td class="hidden status">history</td>'+
                                '<td class="hidden field_id">'+val['field_id']+'</td>'+
                                '<td class="text-center">'+no+'</td>'+
                                '<td class="text-left field_docno"><a href="<?= site_url('Request_production/view_summary_Request_production/')?>/'+val['field_id']+'">'+val['field_docno']+'</a></td>'+
                                '<td class="text-left field_rp_name">'+val['field_rp_name']+'</td>'+
                                '<td></td>'+
                            '</tr>'
                        );

                        no++;
                    });

                    // $.each(data['fix_history_return'],function(id,val){
                    //     console.log(val);
                    //     $('#data_fixhistory').append(
                    //         '<tr >'+
                    //             '<td class="hidden status">history</td>'+
                    //             '<td class="hidden field_id">'+val['field_rp_id']+'</td>'+
                    //             '<td class="text-center">'+no+'</td>'+
                    //             '<td class="text-left field_docno"><a href="<?= site_url('Request_production/view_summary_Request_production/')?>/'+val['field_id']+'">'+val['field_rp_docno']+'</a></td>'+
                    //             '<td class="text-left field_rp_name">'+val['field_rp_name']+'</td>'+
                    //             '<td></td>'+
                    //         '</tr>'
                    //     );
                    //     no++;
                    // });

                }

                if( data['fix_history_return'].length > 0){

                    $.each(data['fix_history_return'],function(id,val){
                        // console.log(val);
                        $('#data_fixhistory').append(
                            '<tr >'+
                                '<td class="hidden status">history</td>'+
                                '<td class="hidden field_id">'+val['field_rp_id']+'</td>'+
                                '<td class="text-center">'+no+'</td>'+
                                '<td class="text-left field_docno"><a href="<?= site_url('Request_production/view_summary_Request_production/')?>/'+val['field_rp_id']+'">'+val['field_rp_docno']+'</a></td>'+
                                '<td class="text-left field_rp_name">'+val['field_rp_name']+'</td>'+
                                '<td></td>'+
                            '</tr>'
                        );
                        no++;
                    });

                }
                
            }).fail(function(data){
                
            });
        };

        function get_topic()
        {
            $( "#field_rp_topic" ).select2({
                theme: "bootstrap4"
            });

            $.ajax({
                type:'POST',
                url:'<?= site_url('Request_production/get_topic')?>',
                dataType:'JSON',
                }).done(function(data){

                    $('#field_rp_topic').empty();
                    $('#field_rp_topic').append('<option value=""> เลือกแผนกที่รับผลิต / รับซ่อม </option>');
                    $.each(data['topic'],function(id,val){
                        $('#field_rp_topic').append('<option value="'+val['field_id']+'">'+val['field_topic']+'&nbsp &nbsp'+'>>'+ '&nbsp &nbsp'+val['field_topic_description']+'</option>');
                    });

                }).fail(function(data){
            });
        };

        function get_employee_controller()
        {
            $( "#field_rp_controller" ).select2({
                theme: "bootstrap4"
            });

            $.ajax({
                type:'POST',
                url:'<?= site_url('Request_production/get_employee_controller')?>',
                dataType:'JSON',
            }).done(function(data){

                $('.field_rp_controller').empty();
                $('.field_rp_controller').append('<option value="">เลือกพนักงาน</option>');
                $('.select2-selection__choice').remove();

                $.each(data['employee'],function(id,val){
                    $('.field_rp_controller').append(
                        '<option value="'+val['id']+'">'+val['pepleid']+' '+val['firstname']+'   '+val['lastname']+' ('+val['nickname']+') แผนก'+val['dename']+'</option>'
                    );
                });

            }).fail(function(data){

            });
        };

        function autocomplete_stkissue()
        {
            $("#search_stkissue").autocomplete({
            source: function(request,response){
                $.ajax({
                type:'POST',
                url:'<?= site_url("Request_production/autocomplete_stkissue")?>',
                dataType:'json',
                data:{
                    search_stkissue : request.term ,
                    database : $('#search_database').val(),
                    field_docno : $('#edit_docno').val()
                },
                }).done(function(data){
                    response(data['stkissue']);
                    console.log(data);
                }).fail(function(){
                    console.log('fail');
                });
            },
            autoFocus:true,
            delay: 0,
            minLength: 0,
            select: function(id,val){

                    var docno = val.item.Docno;

                    $("#search_stkissue").val('');

                    check_bill(docno, $('#search_database').val());

                return false;
                },
            }).autocomplete("instance")._renderItem = function(ul,item){
                return $("<li>")
                .append("<div>"+item.Docno+"<br>"+item.MyDescription+"</div>")
                .appendTo(ul);
            };
            
        };

        // function autocomplete_request_production()
        // {
        //     $("#search_request_product").autocomplete({
        //     source: function(request,response){
        //         $.ajax({
        //         type:'POST',
        //         url:'<?= site_url("Request_production/autocomplete_request_production")?>',
        //         dataType:'json',
        //         data:{
        //             search : request.term ,
        //         },
        //         }).done(function(data){
        //             response(data['request_production']);
        //         }).fail(function(){
        //             console.log('fail');
        //         });
        //     },
        //     autoFocus:true,
        //     delay: 0,
        //     minLength: 0,
        //     select: function(id,val){

        //             var docno = val.item.field_docno;

        //             $("#search_request_product").val('');

        //             check_request_product(docno);

        //         return false;
        //         },
        //     }).autocomplete("instance")._renderItem = function(ul,item){
        //         return $("<li>")
        //         .append("<div>"+item.field_docno+"<br>"+item.field_rp_name+"</div>")
        //         .appendTo(ul);
        //     };
            
        // };

        function check_request_product(docno) {  
            $.ajax({
                type: "POST",
                url: "<?= site_url('Request_production/check_request_product')?>",
                dataType: "JSON",
                data: {
                    docno : docno 
                },
                success: function (data) {

                    console.log(data);

                    var i = 1;
                    var check = 0;
                    $('#data_fixhistory').find('tr').each(function(){
                        i++;
                        if ($(this).find('.field_docno').text() == docno) {
                            check++;
                        }
                    });

                    var val = data['request_production'];

                    if (check == 0) {
                        var status_history = 'history_add';
                        addRow_fixitemHistory(val['field_docno'],val['field_id'],i,val['field_docno'],val['field_rp_name'],status_history);
                    }else{
                        swal({
                            title: 'เตือน',
                            text: "เอกสารนี้ถูกดึงมาอ้างอิงแล้ว",
                            type: 'warning',
                            allowOutsideClick: false,
                        });
                    }
                },error: function (data) {

                },

            });
        }

        function addRow_fixitemHistory(field_docno,field_id,i,field_docno,field_rp_name,status_history) {  
            $('#data_fixhistory').append(
                '<tr class="bg-primary  color-palette" id="'+field_docno+'">'+
                    '<td class="hidden status">'+status_history+'</td>'+
                    '<td class="hidden field_id">'+field_id+'</td>'+
                    '<td class="text-center no">'+i+'</td>'+
                    '<td class="field_docno">'+field_docno+'</td>'+
                    '<td class="field_rp_name">'+field_rp_name+'</td>'+
                    '<td><button type="button" class="btn btn-danger btn-sm removeHisRow"><i class="fa fa-trash"></i></button></td>'+
                '</tr>'
            );
        }

        function run_no(){
            var no = 1;
            $('#data_fixhistory').find('tr').each(function(){
                $(this).find('.no').text(no);
                no++;
            });
        };
        
        function check_bill(docno,database)
        {
            
            var type = 'add';

            $.ajax({
                type: "POST",
                url: "<?= site_url('Request_production/check_bill')?>",
                dataType: "JSON",
                data: {
                    docno : docno 
                },
                success: function (data) {

                    if(data['check_bill'] == 'have'){
                        swal({
                            title: 'เตือน',
                            text: "บิลนี้ถูกดึงมาอ้างอิงแล้ว",
                            type: 'warning',
                            allowOutsideClick: false,
                        });
                    }else if(data['check_bill'] == 'no_have'){

                        if($('#data_item_request').find('#data_item_request'+ docno).length > 0){
                            swal({
                                title: 'เตือน',
                                text: "บิลนี้ถูกดึงมาอ้างอิงแล้ว",
                                type: 'warning',
                                allowOutsideClick: false,
                            });
                        }else{
                            get_stkissue_bydocno(docno,type,database);
                        }

                    }else{
                    }

                },error: function (data) {

                },

            });

        };

        function get_stkissue_bydocno(docno,type,database) 
        {
            
            $.ajax({
                type:'POST',
                url:'<?= site_url('Request_production/get_stkissue_bydocno')?>',
                dataType:'JSON',
                data:{
                    docno : docno ,
                    database : database
                },
            }).done(function(data){

                console.log(data);

                $('#data_stkissue_doc').find('tr').each(function(){
                    if($(this).find('.docno').text() == data['ISSUE_DOC']['Docno']){
                        swal({
                            title: 'เตือน',
                            text: "บิลนี้ถูกดึงมาอ้างอิงแล้ว",
                            type: 'warning',
                            allowOutsideClick: false,
                        });
                        type = 'duplicate';
                    }
                });

                if(type == 'add'){

                    var btn_del_doc = '<button class="btn bg-red btn_del_doc" type="button" ><i class="fa fa-trash"></i></button> ';

                    $('#data_stkissue_doc').append(
                        '<tr id="data_stkissue_doc'+data['ISSUE_DOC']['Docno']+'">' +
                            '<td class="text-left docno">' +
                                '<p>'+ data['ISSUE_DOC']['Docno'] +'</p>'+
                            '</td>' +
                            '<td class="text-left">' +
                                '<p>'+ btn_del_doc +'</p>'+
                            '</td>' +
                        '</tr>'
                    );

                    var data_Database = $('#search_database').val();



                    $.each(data['ISSUE_ITEM'], function( key, value ){
                        var amount = 0;
                        amount = round(value['Qty'],4) * round(value['price'],4);

                            $('#data_item_request').append(

                                '<tr id="data_item_request'+value['Docno']+'">' +

                                '<td class="text-left hidden">' +
                                    '<input type="hidden" class="Amount" value="' + amount + '" >'+
                                    '<input type="hidden" class="Database" value="' + data_Database + '" >'+
                                    '<p class="Docno">'+ value['Docno'] +'</p>'+
                                '</td>' +

                                // '<td class="text-left hidden">' +
                                
                                // '</td>' +
                                
                                '<td class="text-left">' +
                                    '<p class="ItemCode"><b>'+ value['ItemCode'] +'</b></p>'+
                                    '<p class="ItemName">'+ value['ItemName'] +'</p>'+
                                    '<small><b>หมายเหตุ รหัสสินค้า</b> : <span class="StkIssueSub2MyDescription">'+ checknull(value['StkIssueSub2MyDescription']) +'</span> </small>'+
                                    '<br>'+
                                    '<small><b>หมายเหตุ ใบขอเบิกสินค้า,วัตถุดิบ</b> : <span class="StkIssueMyDescription">'+ checknull(value['StkIssueMyDescription']) +'</span></small>'+
                                '</td>' +
                                
                                '<td class="text-center">' +
                                    '<p class="Qty">'+ value['Qty'] +'</p>'+
                                '</td>' +

                                '<td class="text-center">' +
                                    '<p class="UnitCode">'+ value['UnitCode'] +'</p>'+
                                '</td>' +

                                '<td class="text-right">' +
                                    '<p class="Price">'+ value['price'] +'</p>'+
                                '</td>' +

                                '<td class="text-right">' +
                                    '<p>'+ amount +'</p>'+
                                '</td>' +
                                
                            '</tr>'
                        );
                    });

                    cal_item_price();
                }

            });

        };
        
        function delete_stkissue(docno)
        {
            swal({
                title: 'คุณแน่ใจไหม',
                text: "การลบเอกสาร",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1CC88A',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value){

                    $('#data_stkissue_doc'+docno).remove();

                    $('#data_item_request > tr').each(function(index, tr) { 
                        $('#data_item_request'+docno).remove();
                    });



                    cal_labor_price();

                    cal_item_price();

                }
            });
            
    
        };

        function cal_labor_price()
        {
            var sum_laborrow = 0;
            var sum = 0;
        
            if($('#data_labor_list').find('tr').length != 0){
                $('#data_labor_list').find('tr').each(function(){
                
                    if($(this).find('.field_labor_qty').val() == ''){
                        var labor_qty = 0;
                    }else{
                        var labor_qty = $(this).find('.field_labor_qty').val();
                    }

                    if($(this).find('.field_labor_unitprice').val() == ''){
                        var priceunit = 0;
                    }else{
                        var priceunit = $(this).find('.field_labor_unitprice').val();
                    }

                    sum_laborrow = labor_qty * priceunit;
                    $(this).find('.field_labor_sumprice').val(parseFloat(sum_laborrow).toFixed(2));

                    if(sum_laborrow > 0 ){
                        sum = sum + sum_laborrow;
                        $('#sum_labor').text((Math.round(sum * 100) / 100).toFixed(2));
                    }else{
                        $('#sum_labor').text(0);

                    }
                    
                });
            }else{
                $('#sum_labor').text(0);
            }

            cal_sumrp();
            
        };

        function cal_item_price()
        {
            var sum_itemrow = 0;
            var sum = 0;

            if($('#data_item_request').find('tr').length != 0){
                $('#data_item_request').find('tr').each(function(){
                
                    if($(this).find('.Amount').val() == ''){
                        var sum_itemrow = 0;
                    }else{
                        var sum_itemrow = $(this).find('.Amount').val();
                    }

                    if(parseFloat(sum_itemrow) > 0 ){
                        sum = sum + parseFloat(sum_itemrow);
                        $('#sum_item').text((Math.round(sum * 100) / 100).toFixed(2));
                    }
                
                });
                
            }else{
                $('#sum_item').text((Math.round(sum * 100) / 100).toFixed(2));
            }

            cal_sumrp();
            
        };

        function cal_sumrp()
        {

            var cal_labor = 0;
            var cal_item = 0;
            var cal_sumrp = 0;
            
            if($('#sum_labor').text() == ''){
                cal_labor = 0;
            }else{
                cal_labor =  $('#sum_labor').text(); 
            }

            if($('#sum_item').text() == ''){
                cal_item = 0;
            }else{
                cal_item =  $('#sum_item').text(); 
            }

            cal_sumrp = parseFloat(cal_labor) + parseFloat(cal_item);

            // console.log(cal_sumrp);

            // if(cal_sumrp){
                $('#field_rp_cost_estimate').text((Math.round(cal_sumrp * 100) / 100).toFixed(2));
            // }

        };

        function number_format(amount)
        {
        
            // return chang_num;
            var delimiter = ","; 
            // replace comma if desired
            amount = new String(parseFloat(amount).toFixed(2));
            var a = amount.split('.',2)
            var d = a[1];
            var i = parseInt(a[0]);
            if(isNaN(i)) { return ''; }
            var minus = '';
            if(i < 0) { 
                minus = '-'; 
            }
            i = Math.abs(i);
            var n = new String(i);
            var a = [];
            while(n.length > 3)
            {
                var nn = n.substr(n.length-3);
                a.unshift(nn);
                n = n.substr(0,n.length-3);
            }
            if(n.length > 0) 
            { 
                a.unshift(n); 
            }
            n = a.join(delimiter);
            if(d.length < 1){ 
                amount = n; 
            }else{ 
                amount = n + '.' +  d;
            }
            
            amount = minus + amount;

            return amount ;
        };

        function get_database_sqlserver() 
        { 

            $( ".search_database" ).select2({
                theme: "bootstrap4"
            });
        
            $.ajax({
                type: 'POST',
                url: '<?= site_url('All_tools_search/get_all_tools_database_sqlserver')?>',
                dataType: "JSON",
                success: function (data) {

                    $('.search_database').empty();
                    $('.search_database').append(
                        '<option value="">เลือกแหล่งข้อมูล</option>'
                    );

                    $.each(data, function (id,val) { 
            
                        $('.search_database').append(
                            '<option value="'+id+'">'+ val +'</option>'
                        );

                    });

                }
            });

        };

        function escapeHtml(unsafe)
        {
            return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
        }

        function checknull(data) 
        {

            if(data == '' || data == null){
                result = '';
            }else{
                result = data;
            }

            return result;
        };

    // Add Edit	

    // Summary

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
                    if(data['request_production_history'].length > 0){
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
                    if(data['request_production_progress'].length > 0){
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
                    }else{
                        $('#data_request_production_progress').append(
                        '<tr>'+
                            '<td class="text-left" colspan="2">ไม่มีข้อมูลความคืบหน้า</td>'+
                        '</tr>'
                        );
                    }
                    
                }).fail(function(data){
            });
        };
        
        function date(dateObject)
        {
            var d = new Date(dateObject.replace(/\s/, 'T'));
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

        function time(dateObject)
        {
            var t = new Date(dateObject.replace(/\s/, 'T'));
            var Hour = t.getHours();
            var Minutes = t.getMinutes() ;
            var Seconds = t.getSeconds();

            var time = Hour + ":" + Minutes + ":" + Seconds;

            return time;
        };

    // Summary

    function comma(val)
    {

        while (/(\d+)(\d{3})/.test(val.toString())){
            val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
        }
        
        return val;
    };

    function round(value, decimals) 
    { 
        return Number(Math.round(value+'e'+decimals)+'e-'+decimals); 
    }

   
</script>