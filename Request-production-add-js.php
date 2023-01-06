
<script type="text/javascript">
    
    $(document).ready(function()
    {

        input_btn_function_rp();
     
        addrow_labor_list();

        all_change();

    });

    function all_change() {  
        $('#field_fixitem_item_id').change(function(e){
            e.preventDefault();


            var id = $('#field_fixitem_item_id').val();

            check_fixitem(id);
        });
    }

    function input_btn_function_rp() 
    {
        $( "#field_doc_type" ).select2({
            theme: "bootstrap4"
        });

        $('#btn_add_submit').click(function (e) {
            e.preventDefault();

            var validate = validate_add();

            if(validate == 'true' ){
                // console.log(data_fixhistory);
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
                        add_request_production(data_labor_list,data_item_request,data_fixhistory);
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
                cols += '<td class="col-sm-2"><input type="text" class="form-control field_labor_name" name="field_labor_name ' + counter_row + '" placeholder="กรุณากรอกข้อมูล"></td>'
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

    function validate_add() 
	{
		var validate = 'true';

		if($('#field_doc_type').val() == '' ){
			$( "#field_doc_type" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#field_doc_type').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#field_doc_type').val() != '' ){
			$( "#field_doc_type" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#field_doc_type').css('border','');
		}

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

        if($('#field_doc_type').val() == 2 && $('#field_fixitem_item_id').val() == '' ){
			$( "#field_fixitem_item_id" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#field_fixitem_item_id').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#field_doc_type').val() == 2 && $('#field_fixitem_item_id').val() != '' ){
			$( "#field_fixitem_item_id" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#field_fixitem_item_id').css('border','');
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

        // if($('#field_rp_fix').val() == '' ){
		// 	$( "#field_rp_fix" ).removeClass( "is-valid" ).addClass( "is-warning" );
		// 	$('#field_rp_fix').css('border','rgb(243, 156, 18) 2px solid');
		// 	validate = 'false';
		// }else if($('#field_rp_fix').val() != '' ){
		// 	$( "#field_rp_fix" ).removeClass( "is-warning" ).addClass( "is-valid" );
		// 	$('#field_rp_fix').css('border','');
		// }

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

    function update_requestbackward() {  
        $.ajax({
            type: "post",
            url:'<?= site_url('Request_production/update_requestbackward')?>',
            data: {
                field_id : $('#backward_rp_id').val(),
                backward_request_comment : $('#backward_request_comment').val()
            },
            dataType: "json",
            success: function (data) {
                
            }
        });
    }

    function add_request_production(
        data_labor_list,
        data_item_request
    )
    {
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/add_request_production')?>',
            dataType:'JSON',
            data:{
                data_labor_list : data_labor_list,
                data_item_request : data_item_request,
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
            console.log(data)
            swal({
                title: 'ERROR',
                text: "เกิดข้อผิดพลาดบางอย่าง",
                type: 'error',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            });
        });
    };


</script>