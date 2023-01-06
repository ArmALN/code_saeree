
<script type="text/javascript">
    
    $(document).ready(function()
    {

        // $('#field_rp_topic').select2();

        // $('.field_rp_controller').select2();

        // $('#field_fixitem_id').select2();

        // $('#field_fixitem_sub_id').select2();
      
        autocomplete_stkissue();

        cal_sumrp();

        input_btn_function_share_add_edit();

        get_database_sqlserver();

        get_fixitem();
       
        get_topic();

        get_employee_controller();

        $(document).on('click','.removeHisRow',function(){
            remove_history(
				$(this).closest('tr').find('.field_docno').text(),
            );
            
		});
        
    });

    function remove_history(docno){
		swal({
			title: 'ต้องการลบรายการนี้หรือไม่',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'ลบรายการนี้',
			cancelButtonText: 'ยกเลิก',
		}).then((result) => {
			if (result.value) {
                // console.log(docno)
				// $(input).closest('tr').remove();
                $('#'+docno).remove();
				run_no();
			}
		});
	};

    function input_btn_function_share_add_edit() 
    {

        $('.row_fix_item').hide();
        $('#row_fixhistory').hide();
        // $("#field_rp_require_date").datepicker("destroy");
        // $("#field_rp_require_date").datepicker({dateFormat: 'dd/mm/yy'});

        $('#field_doc_type').change(function(){
            //สั่งผลิต = 1
            //สั่งซ่อม = 2
            if($('#field_doc_type').val() == '1'){
                $('#field_fixitem_id').val(null).trigger('change');
                $('#field_fixitem_sub_id').val(null).trigger('change');
                $('.row_fix_item , #row_fixhistory').hide();
            }else if($('#field_doc_type').val() == '2'){
                $('.row_fix_item').show();
            }else if($('#field_doc_type').val() == ''){
                $('#field_fixitem_id').val(null).trigger('change');
                $('#field_fixitem_sub_id').val(null).trigger('change');
                $('.row_fix_item , #row_fixhistory').hide();
            }
        });
        
        $('#field_fixitem_id').change(function(e){
            e.preventDefault();

            var id = $('#field_fixitem_id').val();
            get_fixitem_sub_byid(id);
         
        });

        $('#field_fixitem_sub_id').change(function(e){
            e.preventDefault();

            var id = $('#field_fixitem_sub_id').val();
            get_fixitem_item_byid(id);

        });

        $('#field_fixitem_item_id').change(function(e){
            e.preventDefault();


            var id = $('#field_fixitem_item_id').val();


            if(id != ''){
                $('#row_fixhistory').show();
                get_fixhistory(id);
            }else{
                $('#row_fixhistory').hide();
            }

            // check_fixitem(id);
        });




        $('#data_stkissue_doc').on('click','.btn_del_doc',function()
        {
            var docno =  $(this).closest('tr').find('.docno').text();
            delete_stkissue(docno);
        });

    };

</script>