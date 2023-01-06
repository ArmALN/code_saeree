<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
	$(document).ready (function(){

        search_input_1();

        input_btn_function_rp();

    });

    function input_btn_function_rp() 
    {

        // ----------------------------------- get_topic

            $('#search_text').keyup(function (e) { 
                e.preventDefault();
                search_input_1();
            }); 

            $(document).on('click','.pageNumber',function(){
                var search_text = '';
                search_text = $('#search_text').val();
                $('#pageNumber').val($(this).text()-1);
                get_topic(search_text);
            });  

        // ----------------------------------- get_topic
       
        // ----------------------------------- edit

            $('#data_topic').on('click','.btn_edit',function(){
                var id = $(this).closest('tr').find('.id').text();
                get_topic_byid(id);
                $('#editModal').modal('show');
            });

            $('#btn_edit_submit').click(function (e) { 
                e.preventDefault();
                
                var validate = validate_edit();

                if(validate == 'true' ){
                    
                    swal({
                        title: 'คุณแน่ใจไหม',
                        text: "การแก้ไขหัวข้องาน",
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#1CC88A',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                        cancelButtonText: 'ปิด',
                    }).then((result) => {
                        if (result.value){
                            edit_topic();
                        }else{

                            search_input_1();
                        
                            clear_input_edit();
                            
                        }
                    });

                }
                
            });
           

        // ----------------------------------- edit

        // ----------------------------------- del
            $('#data_topic').on('click','.btn_del',function(){  
                var id = $(this).closest('tr').find('.id').text();
                delete_topic(id);
            });
        // ----------------------------------- del

      
        // ----------------------------------- add

            $('#btn_add').click(function(){
                $('#addModal').modal('show');
            });

            $('#btn_add_submit').click(function (e) { 
                e.preventDefault();
                
                var validate = validate_add();

                if(validate == 'true' ){
                    
                    swal({
                        title: 'คุณแน่ใจไหม',
                        text: "การเพิ่มหัวข้องาน",
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#1CC88A',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'ใช่ ,ฉัน ตกลง',
                        cancelButtonText: 'ปิด',
                    }).then((result) => {
                        if (result.value){
                            add_topic();
                        }else{

                            search_input_1();
                        
                            clear_input_add();
                            
                        }
                    });

                }
                
            });

            $('#add_field_topic').focusout(function (e){ 
                e.preventDefault();
                if($('#add_field_topic').val()){
                    var add_field_topic = '';
                    add_field_topic = $('#add_field_topic').val();
                    check_topic(add_field_topic);
                }else{

                }
            });

        // ----------------------------------- add

    };

    function validate_add() 
	{
		var validate = 'true';

		if($('#add_field_topic').val() == '' ){
			$( "#add_field_topic" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#add_field_topic').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#add_field_topic').val() != '' ){
			$( "#add_field_topic" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#add_field_topic').css('border','');
		}

        if($('#add_field_topic_description').val() == '' ){
			$( "#add_field_topic_description" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#add_field_topic_description').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#add_field_topic_description').val() != '' ){
			$( "#add_field_topic_description" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#add_field_topic_description').css('border','');
		}

        return validate;
		
	};

    function validate_edit() 
	{
		var validate = 'true';

		if($('#edit_field_topic').val() == '' ){
			$( "#edit_field_topic" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#edit_field_topic').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#edit_field_topic').val() != '' ){
			$( "#edit_field_topic" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#edit_field_topic').css('border','');
		}

        if($('#edit_field_topic_description').val() == '' ){
			$( "#edit_field_topic_description" ).removeClass( "is-valid" ).addClass( "is-warning" );
			$('#edit_field_topic_description').css('border','rgb(243, 156, 18) 2px solid');
			validate = 'false';
		}else if($('#edit_field_topic_description').val() != '' ){
			$( "#edit_field_topic_description" ).removeClass( "is-warning" ).addClass( "is-valid" );
			$('#edit_field_topic_description').css('border','');
		}

        return validate;
		
	};

    function search_input_1() 
	{
		var search_text = '';
        search_text = $('#search_text').val();

        get_topic(
            search_text
        );
	};

    function search_input_2() 
	{
        var search_text = '';
        search_text = $('#search_text').val();
        $('#pageNumber').val(0);
        get_topic(
            search_text
        );
	};

    function check_topic(topic_name)
    {
        $.ajax({
        type: "POST",
        url:'<?= site_url('Request_production/check_topic')?>',
        data: {
            topic_name : topic_name
        },
        dataType: "JSON",
        success: function (data) {

            console.log(data)

            if(data['check_topic'] == 'no_have'){

            }else if(data['check_topic'] == 'have'){

                swal({
                    title: 'เตือน',
                    text: "มีหัวข้องานนี้แล้ว",
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

    function clear_input_add() 
	{

		$('#add_field_topic').val('');
        $('#add_field_topic_description').val('');

        $( "#add_field_topic" ).removeClass( "is-valid , is-warning" );
        $( "#add_field_topic_description" ).removeClass( "is-valid , is-warning" );

	};

    function clear_input_edit() 
	{

		$('#edit_field_topic').val('');
        $('#edit_field_topic_description').val('');

        $( "#edit_field_topic" ).removeClass( "is-valid , is-warning" );
        $( "#edit_field_topic_description" ).removeClass( "is-valid , is-warning" );

	};

    function add_topic()
    {
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/add_topic')?>',
            dataType:'JSON',
            data:{
                field_topic : $('#add_field_topic').val(),
                field_topic_description :$('#add_field_topic_description').val()
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

    function get_topic(search_text)
    { 
        var usersPerPage = parseInt($('#usersPerPage').val());
    	var pageNumber = $('#pageNumber').val();
        $.ajax({
            type: "POST",
            url: "<?= site_url('Request_production/get_main_topic')?>",
            data : {
					pageNumber : pageNumber ,
					usersPerPage : usersPerPage,
					search_text : search_text
				},
            dataType: "JSON",
            success: function (data) {

                console.log(data)

                $('#data_topic').empty();
                $.each(data['topic_data'],function(id,val){

                var btn_edit = '';
                var btn_del  = '';
                
                btn_edit = '<button class="btn btn-sm btn-warning btn_edit "type="button" > <i class="fa fa-edit"></i> </button> ';
                btn_del  = '<button class="btn btn-sm btn-danger  btn_del  "type="button" > <i class="fa fa-trash"></i> </button> ';
                
                $('#data_topic').append(
                    '<tr>'+
                        '<td class="text-center id">'+val['field_id']+'</td>'+
                        '<td class="text-left">'+val['field_topic']+'</td>'+
                        '<td class="text-left">'+val['field_topic_description']+'</td>'+
                        '<td class="text-left">'+btn_edit + btn_del + '</td>'+
                    '</tr>'
                    );
                });

                $('.pagination').empty();
                var totaltopic = (Math.ceil(parseInt(data['totaltopic']) / parseInt(usersPerPage)));
                if(parseInt(pageNumber) > 5){
                    $('.pagination').append('<li><button class="pageNumber">1</button></li>');
                }
                for (var i = 1; i <= totaltopic; i++) {
                    if(parseInt(pageNumber)-5 < i && parseInt(pageNumber)+7 > i){
                    if(parseInt(pageNumber)+1 == i){
                        $('.pagination').append('<li><button class="pageNumber active">'+i+'</button></li>');
                    }else{
                        $('.pagination').append('<li><button class="pageNumber">'+i+'</button></li>');
                    }
                    }
                }
                if(parseInt(pageNumber) < totaltopic-6){
                    $('.pagination').append('<li><button class="pageNumber">'+totaltopic+'</button></li>');
                }
            }
        });
    };     

    function get_topic_byid(id)
    {
        $.ajax({
            type: "POST",
            url: "<?= site_url('Request_production/get_topic_byid')?>",
            dataType: "JSON",
            data:{
                id : id
            },
            success: function (data) {

				$('#edit_field_id').val(data['field_id']);
                $('#edit_field_topic').val(data['field_topic']);
                $('#edit_field_topic_description').val(data['field_topic_description']);
                
            }
        });
    };

    function edit_topic()
    { 
        $.ajax({
            type:'POST',
            url:'<?= site_url('Request_production/edit_topic')?>',
            dataType:'JSON',
            data:{
                field_id : $('#edit_field_id').val(),
                field_topic : $('#edit_field_topic').val(),
                field_topic_description : $('#edit_field_topic_description').val()
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

    function delete_topic(id)
    { 
        swal({
            title: 'คุณแน่ใจไหม',
            text: "การลบหัวข้องาน",
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
                    url:'<?= site_url('Request_production/delete_topic')?>',
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

</script>

