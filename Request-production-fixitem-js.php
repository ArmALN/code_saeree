
<script type="text/javascript">
    
    $(document).ready(function()
    {

        search_input_1();

        input_btn_function_rp();

        get_database_sqlserver();

    });

    function input_btn_function_rp() 
    {

        $('#row_add_sub').hide();

        $('#row_add_history').hide();

        // ----------------------------------- get_fixitem

          $('#search_text').keyup(function (e) { 
                e.preventDefault();
                search_input_1();
            }); 

            $(document).on('click','.pageNumber',function(){
                var search_text = '';
                search_text = $('#search_text').val();
                $('#pageNumber').val($(this).text()-1);
                get_fixitem(search_text);
            });  

        // ----------------------------------- get_fixitem

        // ----------------------------------- main add

         $('#btn_add').click(function(){
                $('#addModal').modal('show');
                var type = $('#add_type').val();
                autocomplete_project_department(type);
            });

            $('#add_field_code').focusout(function (e){ 
                e.preventDefault();
                if($('#add_field_code').val()){
                    var code = '';
                    code = $('#add_field_code').val();
                    check_fixitem(code);
                }else{

                }
            });

            $('#btn_add_submit').click(function (e) { 
                e.preventDefault();
                
                var validate = validate_add();

                if(validate == 'true' ){
                    
                    swal({
                        title: 'คุณแน่ใจไหม',
                        text: "การเพิ่มหัวข้อการซ่อม",
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#1CC88A',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                        cancelButtonText: 'ปิด',
                    }).then((result) => {
                        if (result.value){
                            add_fixitem();
                        }else{

                            search_input_1();
                        
                            clear_input_add();
                            
                        }
                    });

                }
                
            });

        // ----------------------------------- main add

        // ----------------------------------- main edit

            $('#data_fixitem').on('click','.btn_edit',function(){
                var id = $(this).closest('tr').find('.id').text();
                get_fixitem_byid(id);
                $('#editModal').modal('show');
                var type = $('#edit_type').val();
                autocomplete_project_department(type);
            });

            $('#edit_field_code').focusout(function (e){ 
                e.preventDefault();
                if($('#edit_field_code').val()){
                    var code = '';
                    code = $('#edit_field_code').val();
                    check_fixitem(code);
                }else{

                }
            });

            $('#btn_edit_submit').click(function (e) { 
                e.preventDefault();
                
                var validate = validate_edit();

                if(validate == 'true' ){
                    
                    swal({
                        title: 'คุณแน่ใจไหม',
                        text: "การแก้ไขหัวข้อการซ่อม",
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#1CC88A',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                        cancelButtonText: 'ปิด',
                    }).then((result) => {
                        if (result.value){
                            edit_fixitem();
                        }else{

                            search_input_1();
                        
                            clear_input_edit();
                            
                        }
                    });

                }
                
            });

        // ----------------------------------- main edit

        // ----------------------------------- main del
            $('#data_fixitem').on('click','.btn_del',function(){  
                var id = $(this).closest('tr').find('.id').text();
                delete_fixitem(id);
            });
        // ----------------------------------- main del
       
        // ----------------------------------- sub add

            $('#data_fixitem').on('click','.btn_sub',function(){  

                var id = $(this).closest('tr').find('.id').text();

                $('#data_fixitem tr').removeClass("info");

                $(this).closest('tr').addClass("info");

                $('#add_sub_field_fixitem_id , #edit_sub_field_fixitem_id').val(id);

                $('#row_add_sub').show();

                $('#row_add_history').hide();

                get_fixitem_sub_byid(id);
                

            });

            $('#btn_add_sub').click(function(){
                $('#addsubModal').modal('show');
            });

            $('#btn_add_sub_submit').click(function (e) { 
                e.preventDefault();
                
                var validate = validate_add_sub();

                if(validate == 'true' ){
                    
                    swal({
                        title: 'คุณแน่ใจไหม',
                        text: "การเพิ่มหัวข้อการซ่อมย่อย",
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#1CC88A',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                        cancelButtonText: 'ปิด',
                    }).then((result) => {
                        if (result.value){
                            add_fixitem_sub();
                        }else{
                        
                            clear_input_add_sub();
                            
                        }
                    });

                }
                
            });

        // ----------------------------------- sub add

        // ----------------------------------- sub edit

            $('#data_fixitem_sub').on('click','.btn_edit',function(){
                var id = $(this).closest('tr').find('.id').text();
                get_fixitem_sub_byid2(id);
                $('#editsubModal').modal('show');
            });

            $('#btn_edit_sub_submit').click(function (e) { 
                e.preventDefault();
                
                var validate = validate_edit_sub();

                if(validate == 'true' ){
                    
                    swal({
                        title: 'คุณแน่ใจไหม',
                        text: "การแก้ไขหัวข้อการซ่อมย่อย",
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#1CC88A',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                        cancelButtonText: 'ปิด',
                    }).then((result) => {
                        if (result.value){
                            edit_fixitem_sub();
                        }else{

                            clear_input_edit_sub();
                            
                        }
                    });

                }
                
            });

        // ----------------------------------- sub edit

        // ----------------------------------- sub del
            $('#data_fixitem_sub').on('click','.btn_del',function(){  
                var id = $(this).closest('tr').find('.id').text();
                delete_fixitem_sub(id);
            });
        // ----------------------------------- sub del

        // ----------------------------------- history

            $('#data_fixitem_sub').on('click','.btn_history ',function(){  

                var id = $(this).closest('tr').find('.id').text();

                $('#data_fixitem_sub tr').removeClass("info");

                $(this).closest('tr').addClass("info");

                $('#addhistory_field_fixitem_id').val(id);

                $('#row_add_history').show();

                get_fixhistory(id);

               

            });

            $('#btn_add_history').click(function(){
                $('#addhistoryModal').modal('show');
                autocomplete_request_production();
            });

            $('#btn_add_history_submit').click(function (e) { 
                e.preventDefault();
                
                var validate = validate_add_history();

                if(validate == 'true' ){
                    
                    swal({
                        title: 'คุณแน่ใจไหม',
                        text: "การเพิ่มใบสั่งซ่อมในหัวข้อการซ่อมย่อย",
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#1CC88A',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                        cancelButtonText: 'ปิด',
                    }).then((result) => {
                        if (result.value){
                            add_history_fixitem();
                        }else{

                            // search_input_1();
                        
                            // clear_input_add_history();
                            
                        }
                    });

                }
                
            });

        // ----------------------------------- history

    };

    function search_input_1() 
	{
		var search_text = '';
        search_text = $('#search_text').val();

        get_fixitem(
            search_text
        );

        $('#data_fixhistory').empty();
	};

    function search_input_2() 
	{
        var search_text = '';
        search_text = $('#search_text').val();
        $('#pageNumber').val(0);
        get_fixitem(
            search_text
        );
	};

    function validate_add() 
	{
		var validate = 'true';

        if($('#add_field_code').val() == '' ){
			$( "#add_field_code" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#add_field_code').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#add_field_code').val() != '' ){
			$( "#add_field_code" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#add_field_code').css('border','');
		}

		if($('#add_field_name').val() == '' ){
			$( "#add_field_name" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#add_field_name').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#add_field_name').val() != '' ){
			$( "#add_field_name" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#add_field_name').css('border','');
		}

        if($('#add_field_detail').val() == '' ){
			$( "#add_field_detail" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#add_field_detail').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#add_field_detail').val() != '' ){
			$( "#add_field_detail" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#add_field_detail').css('border','');
		}

        return validate;
		
	};

    function validate_edit() 
	{
		var validate = 'true';

        if($('#edit_field_code').val() == '' ){
			$( "#edit_field_code" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#edit_field_code').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#edit_field_code').val() != '' ){
			$( "#edit_field_code" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#edit_field_code').css('border','');
		}

		if($('#edit_field_name').val() == '' ){
			$( "#edit_field_name" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#edit_field_name').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#edit_field_name').val() != '' ){
			$( "#edit_field_name" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#edit_field_name').css('border','');
		}

        if($('#edit_field_detail').val() == '' ){
			$( "#edit_field_detail" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#edit_field_detail').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#edit_field_detail').val() != '' ){
			$( "#edit_field_detail" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#edit_field_detail').css('border','');
		}

        return validate;
		
	};

    function validate_add_sub() 
	{
		var validate = 'true';

		if($('#add_sub_field_name').val() == '' ){
			$( "#add_sub_field_name" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#add_sub_field_name').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#add_sub_field_name').val() != '' ){
			$( "#add_sub_field_name" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#add_sub_field_name').css('border','');
		}

        if($('#add_sub_field_detail').val() == '' ){
			$( "#add_sub_field_detail" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#add_sub_field_detail').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#add_sub_field_detail').val() != '' ){
			$( "#add_sub_field_detail" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#add_sub_field_detail').css('border','');
		}

        return validate;
		
	};

    function validate_edit_sub() 
	{
		var validate = 'true';

		if($('#edit_sub_field_name').val() == '' ){
			$( "#edit_sub_field_name" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#edit_sub_field_name').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#edit_sub_field_name').val() != '' ){
			$( "#edit_sub_field_name" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#edit_sub_field_name').css('border','');
		}

        if($('#edit_sub_field_detail').val() == '' ){
			$( "#edit_sub_field_detail" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#edit_sub_field_detail').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#edit_sub_field_detail').val() != '' ){
			$( "#edit_sub_field_detail" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#edit_sub_field_detail').css('border','');
		}

        return validate;
		
	};

    function validate_add_history() 
	{
		var validate = 'true';

		if($('#addhistory_field_ids').val() == '' ){
			$( "#addhistory_field_ids" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#addhistory_field_ids').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#addhistory_field_ids').val() != '' ){
			$( "#addhistory_field_ids" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#addhistory_field_ids').css('border','');
		}

        return validate;
		
	};

    function clear_input_add() 
	{

		$('#add_field_code').val('');
		$('#add_field_name').val('');
		$('#add_field_detail').val('');
		$('#add_search_database').val('');

		$('#add_field_code').css('border','');
		$('#add_field_name').css('border','');
		$('#add_field_detail').css('border','');

	};

    function clear_input_edit() 
	{

		$('#edit_field_code').val('');
		$('#edit_field_name').val('');
		$('#edit_field_detail').val('');
        $('#edit_search_database').val('');

		$('#edit_field_code').css('border','');
		$('#edit_field_name').css('border','');
		$('#edit_field_detail').css('border','');

	};

    function clear_input_add_sub() 
	{
		
		$('#add_sub_field_name').val('');
		$('#add_sub_field_detail').val('');
		
		$('#add_sub_field_name').css('border','');
		$('#add_sub_field_detail').css('border','');

	};

    function clear_input_edit_sub() 
	{
		
		$('#edit_sub_field_name').val('');
		$('#edit_sub_field_detail').val('');
		
		$('#edit_sub_field_name').css('border','');
		$('#edit_sub_field_detail').css('border','');

	};

    function clear_input_add_history() 
	{

		$('#addhistory_field_ids').val('');
		$('#addhistory_field_id').val('');
		// $('#addhistory_field_fixitem_id').val('');

		$('#addhistory_field_ids').css('border','');

	};

    function get_fixitem(search_text)
    {

        var usersPerPage = parseInt($('#usersPerPage').val());
    	var pageNumber = $('#pageNumber').val();
        $.ajax({
            type: "POST",
            url: "<?= site_url('Request_production/get_main_fixitem')?>",
            data : {
					pageNumber : pageNumber ,
					usersPerPage : usersPerPage,
					search_text : search_text
				},
            dataType: "JSON",
            success: function (data) {

                console.log(data)

                $('#data_fixitem').empty();
                $.each(data['data_fixitem'],function(id,val){

                var btn_edit = '';
                var btn_del  = '';
                var btn_sub  = '';

                btn_edit = '<button class="btn btn-sm bg-orange btn_edit "type="button" > <i class="fa fa-edit"></i> </button> ';
               
                btn_sub = '<button class="btn btn-sm bg-blue btn_sub "type="button" > <i class="fa fa-link"></i> <i class="fa  fa-arrow-right"></i> 2 </button> ';

                if(val['count_fixitem_sub'] == 0){
                    btn_del  = '<button class="btn btn-sm bg-red    btn_del  "type="button" > <i class="fa fa-trash"></i> </button> ';
                }
                
                $('#data_fixitem').append(
                    '<tr>'+
                        '<td class="text-center id">'+val['field_id']+'</td>'+
                        '<td class="text-left ">'+
                            '<b>' + checknull(val['field_code']) + '</b>' +
                            '<br>' +
                            checknull(val['field_name']) +
                            '<br>' +
                            '<small>' + checknull(val['field_detail']) + '</small>' +

                        '</td>'+
                        '<td class="text-left">'+btn_edit + btn_del + btn_sub + '</td>'+
                    '</tr>'
                    );
                });

                $('.pagination').empty();
                var totalfixitem = (Math.ceil(parseInt(data['totalfixitem']) / parseInt(usersPerPage)));
                if(parseInt(pageNumber) > 5){
                    $('.pagination').append('<li><button class="pageNumber">1</button></li>');
                }
                for (var i = 1; i <= totalfixitem; i++) {
                    if(parseInt(pageNumber)-5 < i && parseInt(pageNumber)+7 > i){
                    if(parseInt(pageNumber)+1 == i){
                        $('.pagination').append('<li><button class="pageNumber active">'+i+'</button></li>');
                    }else{
                        $('.pagination').append('<li><button class="pageNumber">'+i+'</button></li>');
                    }
                    }
                }
                if(parseInt(pageNumber) < totalfixitem-6){
                    $('.pagination').append('<li><button class="pageNumber">'+totalfixitem+'</button></li>');
                }
            }
        });
       
    };

    function get_fixitem_byid(id)
    {
        $.ajax({
            type: "POST",
            url: "<?= site_url('Request_production/get_fixitem_byid')?>",
            dataType: "JSON",
            data:{
                id : id
            },
            success: function (data) {
				$('#edit_field_id').val(data['field_id']);
                $('#edit_field_code').val(data['field_code']);
                $('#edit_field_name').val(data['field_name']);
                $('#edit_field_detail').val(data['field_detail']);
            }
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
            

            if( data['fix_history'].length > 0){

                $('#data_fixhistory').empty();
                $.each(data['fix_history'],function(id,val){

                    // var btn_move = '';
                    // if(val['field_rp_status'] == 0){
                    //     btn_move = '<button type="button" class="btn bg-blue btn_move" > <i class="fa fa-external-link"></i> </button> ';
                    // }

                    $('#data_fixhistory').append(
                        '<tr>'+
                            '<td class="text-left"><b>'+val['field_docno']+ '</b><br>' +val['field_rp_name']+ '</td>'+
                            // '<td class="text-left">'+ btn_move +'</td>'+
                        '</tr>'
                    );
                });
            }else{
                $('#data_fixhistory').empty();
                $('#data_fixhistory').append(
                    '<tr>'+
                        '<td class="text-left" colspan="2">ไม่มีข้อมูลประวัติการซ่อมในระบบสั่งซ่อม</td>'+
                    '</tr>'
                );
            }
            
        }).fail(function(data){
            
        });
    };

    function get_fixitem_sub_byid(id)
    {
        $.ajax({
        type:'POST',
        url:'<?= site_url('Request_production/get_fixitem_sub_byid')?>',
        data: {
            field_fixitem_no : id
        },
        dataType:'JSON',
        }).done(function(data){

            console.log(data);
            

            if( data['data_fixitem_sub'].length > 0){

                $('#data_fixitem_sub').empty();
                $.each(data['data_fixitem_sub'],function(id,val){

                    var btn_edit = '';
                    var btn_del  = '';
                    var btn_history  = '';

                    btn_edit = '<button class="btn btn-sm bg-orange btn_edit "type="button" > <i class="fa fa-edit"></i> </button> ';

                    btn_history = '<button class="btn btn-sm bg-blue btn_history "type="button" > <i class="fa fa-link"></i> <i class="fa  fa-arrow-right"></i> 3 </button> ';

                    if(val['count_request_production'] == 0){
                        btn_del  = '<button class="btn btn-sm bg-red    btn_del  "type="button" > <i class="fa fa-trash"></i> </button> ';
                    }

                    $('#data_fixitem_sub').append(
                        '<tr>'+
                            '<td class="hidden field_fixitem_no">' + val['field_fixitem_no'] + '</td>'+
                            '<td class="text-center id">' + val['field_id'] + '</td>'+
                            '<td class="text-left ">'+
                            checknull(val['field_name']) +
                            '<br>' +
                            '<small>' + checknull(val['field_detail']) + '</small>' +
                        '</td>'+
                            '<td class="text-left">'+ btn_edit + btn_del + btn_history +'</td>'+
                        '</tr>'
                    );
                });
            }else{
                $('#data_fixitem_sub').empty();
                $('#data_fixitem_sub').append(
                    '<tr>'+
                        '<td class="text-left" colspan="3">ไม่มีข้อมูล</td>'+
                    '</tr>'
                );
            }
            
        }).fail(function(data){
            
        });
    };

    function get_fixitem_sub_byid2(id)
    {
        $.ajax({
        type:'POST',
        url:'<?= site_url('Request_production/get_fixitem_sub_byid2')?>',
        data: {
            field_id : id
        },
        dataType:'JSON',
        }).done(function(data){

            console.log(data);

            $('#edit_sub_field_id').val(data['field_id']);
            $('#edit_sub_field_name').val(data['field_name']);
            $('#edit_sub_field_detail').val(data['field_detail']);
            
        }).fail(function(data){
            
        });
    };

    function check_fixitem(code)
    {
        $.ajax({
        type: "POST",
        url:'<?= site_url('Request_production/check_fixitem')?>',
        data: {
            field_code : code
        },
        dataType: "JSON",
        success: function (data) {

            console.log(data)

            if(data['check_fixitem'] == 'no_have'){

            }else if(data['check_fixitem'] == 'have'){

                swal({
                    title: 'เตือน',
                    text: "มีรหัสนี้แล้ว",
                    type: 'warning',
                    confirmButtonColor: '#6c757d',
                    confirmButtonText: 'ปิด' ,
                }).then((result) => {

                    if (result.value) {

                        clear_input_add();

                    }  
                   
                });
            }
        }
        });
    };

    function add_fixitem()
    {
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/add_fixitem')?>',
            dataType:'JSON',
            data:{
                field_code : $('#add_field_code').val(),
                field_name : $('#add_field_name').val(),
                field_detail :$('#add_field_detail').val()
            }, 
        }).done(function(data)
        {
            $('#addModal').modal('hide');

            swal({ 
                title: 'สำเร็จ',
                text: "บันทึกข้อมูลสำเร็จ",
                type: 'success',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            }).then((result) => {
                if (result.value) { 
                   
                    search_input_1();

                    clear_input_add();

                    $('#row_add_sub').hide();

                    $('#row_add_history').hide();

                }
            });
        }).fail(function(data){

            $('#addModal').modal('hide');
            
            swal({
                title: 'ERROR',
                text: "เกิดข้อผิดพลาดบางอย่าง",
                type: 'error',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            });
        });
    };

    function add_fixitem_sub()
    {
        var field_fixitem_id = $('#add_sub_field_fixitem_id').val();

        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/add_fixitem_sub')?>',
            dataType:'JSON',
            data:{
                field_name : $('#add_sub_field_name').val(),
                field_detail :$('#add_sub_field_detail').val(),
                field_fixitem_no :$('#add_sub_field_fixitem_id').val()
            }, 
        }).done(function(data)
        {
            $('#addsubModal').modal('hide');

            swal({ 
                title: 'สำเร็จ',
                text: "บันทึกข้อมูลสำเร็จ",
                type: 'success',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            }).then((result) => {
                if (result.value) { 

                    get_fixitem_sub_byid(field_fixitem_id);

                    clear_input_add_sub();

                }
            });
        }).fail(function(data){

            $('#addsubModal').modal('hide');
            
            swal({
                title: 'ERROR',
                text: "เกิดข้อผิดพลาดบางอย่าง",
                type: 'error',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            });
        });
    };

    function add_history_fixitem()
    {
        var field_id = $('#addhistory_field_id').val();
        var field_fixitem_sub_id = $('#addhistory_field_fixitem_id').val();

        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/add_history_fixitem')?>',
            dataType:'JSON',
            data:{
                field_id : field_id,
                field_fixitem_sub_id : field_fixitem_sub_id
            }, 
        }).done(function(data)
        {
            $('#addhistoryModal').modal('hide');

            swal({ 
                title: 'สำเร็จ',
                text: "บันทึกข้อมูลสำเร็จ",
                type: 'success',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            }).then((result) => {
                if (result.value) { 

                    clear_input_add_history();

                    get_fixhistory(field_fixitem_sub_id);

                }
            });
        }).fail(function(data){

            clear_input_add_history();

            $('#addhistoryModal').modal('hide');
            
            swal({
                title: 'ERROR',
                text: "เกิดข้อผิดพลาดบางอย่าง",
                type: 'error',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            });
        });
    };

    function edit_fixitem()
    { 
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/edit_fixitem')?>',
            dataType:'JSON',
            data:{
                field_id : $('#edit_field_id').val(),
                field_code : $('#edit_field_code').val(),
                field_name : $('#edit_field_name').val(),
                field_detail : $('#edit_field_detail').val()
            },
        }).done(function(data)
        {
            $('#editModal').modal('hide');
            swal({ 
                title: 'สำเร็จ',
                text: "บันทึกข้อมูลสำเร็จ",
                type: 'success',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            }).then((result) => {
                if (result.value) { 

                    search_input_1();

                    clear_input_edit();

                    $('#row_add_sub').hide();

                    $('#row_add_history').hide();

                }
            });
        }).fail(function(data){
            $('#editModal').modal('hide');
            swal({
                title: 'ERROR',
                text: "เกิดข้อผิดพลาดบางอย่าง",
                type: 'error',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            });
        });
    };

    function edit_fixitem_sub()
    { 
        var field_fixitem_id = $('#edit_sub_field_fixitem_id').val();

        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/edit_fixitem_sub')?>',
            dataType:'JSON',
            data:{
                field_id : $('#edit_sub_field_id').val(),
                field_name : $('#edit_sub_field_name').val(),
                field_detail : $('#edit_sub_field_detail').val()
            },
        }).done(function(data)
        {
            $('#editsubModal').modal('hide');
            swal({ 
                title: 'สำเร็จ',
                text: "บันทึกข้อมูลสำเร็จ",
                type: 'success',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            }).then((result) => {
                if (result.value) { 

                    get_fixitem_sub_byid(field_fixitem_id);

                    clear_input_edit_sub();

                }
            });
        }).fail(function(data){
            $('#editsubModal').modal('hide');
            swal({
                title: 'ERROR',
                text: "เกิดข้อผิดพลาดบางอย่าง",
                type: 'error',
                confirmButtonColor: '#6c757d',
                confirmButtonText: 'ปิด' ,
            });
        });
    };

    function delete_fixitem(id)
    { 
        swal({
            title: 'คุณแน่ใจไหม',
            text: "การลบหัวข้อการซ่อม",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1CC88A',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'ใช่ ,ฉัน ตกลง',
            cancelButtonText: 'ปิด',
            }).then((result) => {
            if (result.value) {	
                $.ajax({
                    type:'POST',
                    url:'<?= site_url('Request_production/delete_fixitem')?>',
                    dataType:'json',
                    data:	{
                        id : id
                    },
                }).done(function(data)
                {
                    swal({ 
                        title: 'สำเร็จ',
                        text: "บันทึกข้อมูลสำเร็จ",
                        type: 'success',
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                    }).then((result) => {
                        if (result.value) { 

                            search_input_1();

                            $('#row_add_sub').hide();

                            $('#row_add_history').hide();
                            
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
            }
        });
    };

    function delete_fixitem_sub(id)
    { 
        var field_fixitem_id = $('#add_sub_field_fixitem_id').val();

        swal({
            title: 'คุณแน่ใจไหม',
            text: "การลบหัวข้อการซ่อมย่อย",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1CC88A',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'ใช่ ,ฉัน ตกลง',
            cancelButtonText: 'ปิด',
            }).then((result) => {
            if (result.value) {	
                $.ajax({
                    type:'POST',
                    url:'<?= site_url('Request_production/delete_fixitem_sub')?>',
                    dataType:'json',
                    data:	{
                        id : id
                    },
                }).done(function(data)
                {
                    swal({ 
                        title: 'สำเร็จ',
                        text: "บันทึกข้อมูลสำเร็จ",
                        type: 'success',
                        confirmButtonColor: '#6c757d',
                        confirmButtonText: 'ปิด' ,
                    }).then((result) => {
                        if (result.value) { 
                           
                            get_fixitem_sub_byid(field_fixitem_id);

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
            }
        });
    };

    function autocomplete_request_production()
    {
		$("#addhistory_field_ids").autocomplete({
		source: function(request,response){
			$.ajax({
            type:'POST',
            url:'<?= site_url("Request_production/autocomplete_request_production")?>',
            dataType:'json',
            data:{
                search : request.term 
            },
			}).done(function(data){
				response(data['request_production']);
			}).fail(function(){
				console.log('fail');
			});
		},
		autoFocus:true,
		delay: 0,
		minLength: 0,
		select: function(id,val){

                var id = val.item.field_id;
                var docno = val.item.field_docno;

                $("#addhistory_field_id").val(id);
                $("#addhistory_field_ids").val(docno);

			return false;
			},
		}).autocomplete("instance")._renderItem = function(ul,item){
            return $("<li>")
			.append("<div>"+item.field_docno+"<br>"+item.field_rp_name+"</div>")
			.appendTo(ul);
		};
		
    };

    function checknull(data) 
    {

        if(data == '' || data == null){
            result = '';
        }else{
            result = data;
        }

        return result;
    };	

    function get_database_sqlserver() 
    { 
      
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

    function autocomplete_project_department(type)
    {
		$( '#' + type + "_field_code").autocomplete({
		source: function(request,response){
			$.ajax({
            type:'POST',
            url:'<?= site_url("Request_production/autocomplete_project_department")?>',
            dataType:'json',
            data:{
                search : request.term ,
                database : $('#' + type + '_search_database').val()
            },
			}).done(function(data){
				response(data['project_department']);
			}).fail(function(){
				console.log('fail');
			});
		},
		autoFocus:true,
		delay: 0,
		minLength: 0,
		select: function(id,val){

                var Code = val.item.Code;
                var Name = val.item.Name;

                if(type == 'add'){

                    $('#add_field_code').val(Code);
                    $('#add_field_name').val(Name);

                } else if(type == 'edit'){
                    $('#edit_field_code').val(Code);
                    $('#edit_field_name').val(Name);
                } 

			return false;
			},
		}).autocomplete("instance")._renderItem = function(ul,item){
            return $("<li>")
			.append("<div>"+item.Code+"<br>"+item.Name+"</div>")
			.appendTo(ul);
		};
		
    };

</script>