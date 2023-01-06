
<script type="text/javascript">
    
    $(document).ready(function()
    {

        input_btn_function_rp();
     
        addrow_labor_list();
        
        setTimeout(() => { 
            get_view_rp();
        }, 1000);

    });

    function input_btn_function_rp() 
    {

        $('#btn_edit_submit').click(function (e) {
            e.preventDefault();

            var validate = validate_edit();

            console.log(validate);
            if(validate == 'true' ){

                var data_labor_list = [];
                    $('#data_labor_list').find('tr').each(function(){
                    var data_labor_lists = {};
                    data_labor_lists['field_labor_name'] = $(this).find('.field_labor_name').val();
                    data_labor_lists['field_labor_qty'] = $(this).find('.field_labor_qty').val();
                    data_labor_lists['field_labor_unit'] = $(this).find('.field_labor_unit').val();
                    data_labor_lists['field_labor_unitprice'] = $(this).find('.field_labor_unitprice').val();
                    data_labor_lists['field_labor_sumprice'] = $(this).find('.field_labor_sumprice').val();
                    data_labor_list.push(data_labor_lists);
                });

                var data_item_request = [];
                    $('#data_item_request').find('tr').each(function(){
                    var data_item_requests = {};
                    data_item_requests['Database'] = $(this).find('.Database').val();
                    data_item_requests['Docno'] = $(this).find('.Docno').text();
                    data_item_requests['ItemCode'] = $(this).find('.ItemCode').text();
                    data_item_requests['ItemName'] = $(this).find('.ItemName').text();
                    data_item_requests['Qty'] = $(this).find('.Qty').text();
                    data_item_requests['UnitCode'] = $(this).find('.UnitCode').text();
                    data_item_requests['Price'] = $(this).find('.Price').text();
                    data_item_requests['Amount'] = $(this).find('.Amount').val();
                    data_item_requests['StkIssueSub2MyDescription'] = $(this).find('.StkIssueSub2MyDescription').text();
                    data_item_requests['StkIssueMyDescription'] = $(this).find('.StkIssueMyDescription').text();
                    data_item_request.push(data_item_requests);
                });

                // console.log(data_labor_list,data_item_request);

                swal({
                    title: 'คุณแน่ใจไหม',
                    text: "การบันทึกใบสั่งผลิต-สั่งซ่อม",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#1CC88A',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                    cancelButtonText: 'ปิด',
                }).then((result) => {
                    if (result.value){
                        edit_request_production(data_labor_list,data_item_request,data_fixhistory);
                    }
                });

            }
            
        });

    };
   
    function addrow_labor_list()
    {

        var counter_row = 0;
        $("#addrow_labor_list").on("click", function(){

            $('.field_labor_name').css('border','');
            $('.field_labor_qty').css('border',''); 
            $('.field_labor_unit').css('border','');
            $('.field_labor_unitprice').css('border','');
            $('.field_labor_sumprice').css('border','');

            if(
                $(".field_labor_name").val() != '' 
                && $(".field_labor_qty").val() != '' 
                && $(".field_labor_unit").val() != '' 
                && $(".field_labor_unitprice").val() != '' 
                && $(".field_labor_sumprice").val() != ''
            ){

                var newRow = $("<tr>");
                var cols = "";
                cols += '<td class="col-sm-2">'
                    cols += '<input type="hidden" class="form-control check_labor " name = "new_labor" value="new_labor"/>'
                    cols += '<input type="text" class="form-control field_labor_name" name="field_labor_name ' + counter_row + '" placeholder="กรุณากรอกข้อมูล"></td>'
                cols += '</td>'
                cols += '<td class="col-sm-2"><input type="number" class="form-control field_labor_qty" step=".01" name="field_labor_qty ' + counter_row + '" placeholder="กรุณากรอกข้อมูล"></td>'
                cols += '<td class="col-sm-2"><input type="text" class="form-control field_labor_unit" name="field_labor_unit ' + counter_row + '" placeholder="กรุณากรอกข้อมูล"></td>'
                cols += '<td class="col-sm-2"><input type="text" class="form-control field_labor_unitprice" step=".01" name="field_labor_unitprice ' + counter_row + '" placeholder="กรุณากรอกข้อมูล"></td>'
                cols += '<td class="col-sm-2"><input type="number" class="form-control field_labor_sumprice" name="field_labor_sumprice ' + counter_row + '" placeholder="ไม่พบข้อมูล" readonly></td>'
                cols += '<td class="col-sm-1"><button class="btn bg-red ibtnDel" type="button" ><i class="fa fa-trash"></i></button></td>';
                newRow.append(cols);
                $("table.order-listlabor").append(newRow);
            }else{
                
                if($('.field_labor_name').val() == '' ){
                    $(".field_labor_name" ).removeClass( "is-valid" ).addClass( "is-warning" );
			        $(".field_labor_name").css('border','rgb(243, 156, 18) 2px solid');
                } 
                if($('.field_labor_qty').val() == '' ){
                    $(".field_labor_qty" ).removeClass( "is-valid" ).addClass( "is-warning" );
			        $(".field_labor_qty").css('border','rgb(243, 156, 18) 2px solid');
                } 
                if($('.field_labor_unit').val() == '' ){
                    $(".field_labor_unit" ).removeClass( "is-valid" ).addClass( "is-warning" );
			        $(".field_labor_unit").css('border','rgb(243, 156, 18) 2px solid');
                } 
                if($('.field_labor_unitprice').val() == '' ){
                    $(".field_labor_unitprice" ).removeClass( "is-valid" ).addClass( "is-warning" );
			        $(".field_labor_unitprice").css('border','rgb(243, 156, 18) 2px solid');
                } 
                if($('.field_labor_sumprice').val() == '' ){
                    $(".field_labor_sumprice" ).removeClass( "is-valid" ).addClass( "is-warning" );
			        $(".field_labor_sumprice").css('border','rgb(243, 156, 18) 2px solid');
                }
            }
                counter_row++;
            });

            $("table.order-listlabor").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();       
                counter_row -= 1
                cal_labor_price();
            });
    
            $(document).on('keyup','.field_labor_unitprice',function(e){
                cal_labor_price();
            });

            $(document).on('keyup','.field_labor_qty',function(e){
                cal_labor_price();
        });

    };

    function validate_edit() 
	{
		var validate = 'true';

		// if($('#field_doc_type').val() == '' ){
		// 	$( "#field_doc_type" ).removeClass( "is-valid" ).addClass( "is-warning" );
		// 	$('#field_doc_type').css('border','rgb(243, 156, 18) 2px solid');
		// 	validate = 'false';
		// }else if($('#field_doc_type').val() != '' ){
		// 	$( "#field_doc_type" ).removeClass( "is-warning" ).addClass( "is-valid" );
		// 	$('#field_doc_type').css('border','');
		// }

        if($('#field_doc_type').val() == 2 && $('#field_fixitem_id').val() == '' ){
			$( "#field_fixitem_id" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#field_fixitem_id').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#field_doc_type').val() == 2 && $('#field_fixitem_id').val() != '' ){
			$( "#field_fixitem_id" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#field_fixitem_id').css('border','');
		}

        if($('#field_doc_type').val() == 2 && $('#field_fixitem_sub_id').val() == '' ){
			$( "#field_fixitem_sub_id" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#field_fixitem_sub_id').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#field_doc_type').val() == 2 && $('#field_fixitem_sub_id').val() != '' ){
			$( "#field_fixitem_sub_id" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#field_fixitem_sub_id').css('border','');
		}

        if($('#field_rp_topic').val() == '' ){
			$( "#field_rp_topic" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#field_rp_topic').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#field_rp_topic').val() != '' ){
			$( "#field_rp_topic" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#field_rp_topic').css('border','');
		}

        if($('#field_rp_controller').val() == '' ){
			$( "#field_rp_controller" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#field_rp_controller').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#field_rp_controller').val() != '' ){
			$( "#field_rp_controller" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#field_rp_controller').css('border','');
		}

        if($('#field_rp_name').val() == '' ){
			$( "#field_rp_name" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#field_rp_name').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#field_rp_name').val() != '' ){
			$( "#field_rp_name" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#field_rp_name').css('border','');
		}

        if($('#field_rp_worker').val() == '' ){
			$( "#field_rp_worker" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#field_rp_worker').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#field_rp_worker').val() != '' ){
			$( "#field_rp_worker" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#field_rp_worker').css('border','');
		}

        if($('#field_rp_require_date').val() == '' ){
			$( "#field_rp_require_date" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#field_rp_require_date').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#field_rp_require_date').val() != '' ){
			$( "#field_rp_require_date" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#field_rp_require_date').css('border','');
		}

        if($('#field_rp_cause').val() == '' ){
			$( "#field_rp_cause" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#field_rp_cause').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#field_rp_cause').val() != '' ){
			$( "#field_rp_cause" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#field_rp_cause').css('border','');
		}

        if($('#field_rp_description').val() == '' ){
			$( "#field_rp_description" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#field_rp_description').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#field_rp_description').val() != '' ){
			$( "#field_rp_description" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#field_rp_description').css('border','');
		}

      
        return validate;
		
	};

    function edit_request_production(
        data_labor_list,
        data_item_request
    )
    {

        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/edit_request_production')?>',
            dataType:'JSON',
            data:{
                data_labor_list : data_labor_list,
                data_item_request : data_item_request,
                field_id : $('#edit_id').val(),
                field_docno : $('#edit_docno').val(),
                field_rp_status : $('#edit_status').val(),
                field_doc_type : $('#field_doc_type').val(),
                field_fixitem_sub_id : $('#field_fixitem_item_id').val(),
                field_rp_topic : $('#field_rp_topic').val(),
                field_rp_controller : $('#field_rp_controller').val(),
                field_rp_require_date : $('#field_rp_require_date').val(),
                field_rp_name : $('#field_rp_name').val(),  
                field_rp_worker : $('#field_rp_worker').val(),
                field_rp_cause : $('#field_rp_cause').val(),
                field_rp_description : $('#field_rp_description').val(),
                field_rp_cost_estimate : $('#field_rp_cost_estimate').text()
            },
        }).done(function(data){
            
            console.log(data)

            swal({ 
            title: 'สำเร็จ',
            text: "คุณบันทึกใบสั่งผลิต-สั่งซ่อมสำเร็จ",
            type: 'success',
            confirmButtonColor: '#6c757d',
            confirmButtonText: 'ปิด' ,
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            });

        }).fail(function(data){

            swal({
                title: 'ERROR',
                text: "เกิดข้อผิดพลาดบางอย่าง",
                type: 'error',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            });
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

            $('#edit_id').val(data['request_production']['field_id']); 
            $('#edit_docno').val(data['request_production']['field_docno']); 
            $('#view_field_docno').val(data['request_production']['field_docno']);
            $('#edit_status').val(data['request_production']['field_rp_status']); 

            // console.log($('#edit_docno').val());
            
            // --------------- type-----------------
                $('#field_doc_type').val(data['request_production']['field_doc_type']);
                if(data['request_production']['field_doc_type'] == 2){
                    console.log(data);
                    $('#field_fixitem_id').val(data['data_field_fixitem_id']['main_field_id']).trigger('change');

                    $('.row_fix_item').show();

                    get_fixitem_sub_byid(data['data_field_fixitem_id']['main_field_id']);

                    setTimeout(function() { 
                        $('#field_fixitem_sub_id').val(data['data_field_fixitem_id']['sub_field_id']).trigger('change');
                    }, 2000);

                    setTimeout(function() { 
                        get_fixitem_item_byid(data['data_field_fixitem_id']['sub_field_id']);
                    }, 1000);

                    setTimeout(function() { 
                        $('#field_fixitem_item_id').val(data['data_field_fixitem_id']['field_id']).trigger('change');
                    }, 2500);
                }
            // --------------- END type-------------

            // --------------- detail-----------------

                $('#field_rp_topic').val(data['request_production']['field_rp_topic']).trigger('change');
                $('#field_rp_controller').val(data['request_production']['field_rp_controller']).trigger('change');
               
                $('#field_rp_name').val(data['request_production']['field_rp_name']);
                $('#field_rp_worker').val(data['request_production']['field_rp_worker']);
                $('#field_rp_require_date').val(data['request_production']['field_rp_require_date']);
                $('#field_rp_cause').val(data['request_production']['field_rp_cause']);
                $('#field_rp_fix').val(data['request_production']['field_rp_fix']);
                $('#field_rp_description').val(data['request_production']['field_rp_description']);

            // --------------- END detail-------------

            get_view_rp_laborlist(data);

            get_view_rp_doclist(data);

            get_view_rp_itemlist(data);

            setTimeout(() => { 
           
                cal_labor_price();

                cal_item_price();

                cal_sumrp();

            }, 1500);

        }

        });


    };

    function get_view_rp_laborlist(data) 
    {
        
        $('#data_labor_list').empty();
            $.each(data['laborlist'], function( key, value ) {
            $('#data_labor_list').append(
            '<tr id="data_labor_list'+value['field_id']+'">' +
            
                '<td class="col-sm-2">' +
                    '<input type="hidden" name="field_labor_id" class="field_labor_id"  id="field_labor_id" value="'+value['field_id']+'">'+  
                    '<input type="hidden" class="check_labor" name = "old_labor" value="old_labor"/>'+
                    '<input type="text" name="field_labor_name" class="form-control field_labor_name" id="field_labor_name" value="'+escapeHtml(value['field_item_name'])+'" placeholder="กรุณากรอกข้อมูล">'+
                '</td>' +
                '<td class="col-sm-2">' +
                    '<input type="number" step=".01" name="field_labor_qty" class="form-control field_labor_qty" id="field_labor_qty" value="'+value['field_item_qty']+'" placeholder="กรุณากรอกข้อมูล">'+
                '</td>' +
                '<td class="col-sm-2">' +
                    '<input type="text" name="field_labor_unit" class="form-control field_labor_unit" id="field_labor_unit" value="'+value['field_item_unit']+'" placeholder="กรุณากรอกข้อมูล">'+
                '</td>' +
                '<td class="col-sm-2">' +
                    '<input type="number" step=".01" name="field_labor_unitprice" class="form-control field_labor_unitprice" id="field_labor_unitprice" value="'+value['field_item_priceunit']+'" placeholder="กรุณากรอกข้อมูล">'+
                '</td>' +
                '<td class="col-sm-2">' +
                    '<input type="number" readonly name="field_labor_sumprice" class="form-control field_labor_sumprice" id="field_labor_sumprice" value="'+value['field_item_price']+'" placeholder="ไม่พบข้อมูล">'+
                '</td>' +
                '<td class="col-sm-1">' +
                    '<button class="btn bg-red ibtnDel" type="button" onclick="delete_labor('+value['field_id']+')"><i class="fa fa-trash"></i></button>' +
                '</td>' +
            '</tr>'
            );
        });

    };

    function get_view_rp_doclist(data) 
    {
        console.log(data);
        $('#data_stkissue_doc').empty();
            $.each(data['doclist'], function( key, value ) {

            var btn_del_doc = '<button class="btn bg-red btn_del_doc" type="button" ><i class="fa fa-trash"></i></button> ';

            var count_datalist = 0;
            $.each(data['itemlist'], function (id, value2) { 
                if (value['field_bc_docno'] == value2['field_bc_docno']) {
                    if (value2['stkissue_docno'] != '') {
                        count_datalist++;
                    }
                }
            });

            // console.log(count_datalist);

            if (count_datalist != 0) {
                btn_del_doc = '<span class="text-green">ถูกเบิกใช้งานเรียบร้อย</span>';
            }else if(count_datalist == 0){
                btn_del_doc = '<button class="btn bg-red btn_del_doc" type="button" ><i class="fa fa-trash"></i></button> ';
            }

            $('#data_stkissue_doc').append(
                '<tr id="data_stkissue_doc'+value['field_bc_docno']+'">' +
                    '<td class="text-left docno">' +
                        '<p>'+ value['field_bc_docno'] +'</p>'+
                    '</td>' +
                    '<td id="btn_del_doc'+value['field_bc_docno']+'" class="text-left">' +
                        '<p>'+ btn_del_doc +'</p>'+
                    '</td>' +
                '</tr>'
            );
        });

    };

    function get_view_rp_itemlist(data) 
    {
        console.log(data['itemlist']);
        
        $.each(data['itemlist'], function( key, value ){


            $('#data_item_request').append(

                '<tr id="data_item_request'+value['field_bc_docno']+'">' +

                    '<td class="text-left hidden">' +
                        '<input type="hidden" class="check_item" value="old_item" >'+
                        '<input type="hidden" class="Amount" value="' + value['field_item_price'] + '" >'+
                        '<input type="hidden" class="Database" value="' + value['field_database'] + '" >'+
                        '<p class="Docno">'+ value['field_bc_docno'] +'</p>'+
                    '</td>' +

                    '<td class="text-left">' +
                        '<p class="ItemCode"><b>'+ value['field_bc_item_code'] +'</b></p>'+
                        '<p class="ItemName">'+ value['field_item_name'] +'</p>'+
                        '<small><b>หมายเหตุ รหัสสินค้า</b> : <span class="StkIssueSub2MyDescription">'+ checknull(value['field_bc_item_code_detail']) +'</span> </small>'+
                        '<br>'+
                        '<small><b>หมายเหตุ ใบขอเบิกสินค้า,วัตถุดิบ</b> : <span class="StkIssueMyDescription">'+ checknull(value['field_bc_docno_detail']) +'</span></small>'+
                    '</td>' +
                    
                    '<td class="text-center">' +
                        '<p class="Qty">'+ value['field_item_qty'] +'</p>'+
                    '</td>' +

                    '<td class="text-center">' +
                        '<p class="UnitCode">'+ value['field_item_unit'] +'</p>'+
                    '</td>' +

                    '<td class="text-right">' +
                        '<p class="Price">'+ value['field_item_priceunit'] +'</p>'+
                    '</td>' +

                    '<td class="text-right">' +
                        '<p>'+ value['field_item_price'] +'</p>'+
                    '</td>' +
                    
                '</tr>'
            );
        });

    };

    function delete_labor(field_id)
    {
        $('#data_labor_list'+field_id).find('.check_labor').val('delete_labor');
        $('#data_labor_list'+field_id).find('.field_labor_unit').val(0);
        $('#data_labor_list'+field_id).find('.field_labor_unitprice').val(0);
        $('#data_labor_list'+field_id).remove();
        cal_labor_price();
    };


</script>