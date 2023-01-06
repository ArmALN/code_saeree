
<?php $firstArray = explode('/',$_SERVER['PATH_INFO']); ?>
<script src="<?= base_url('assets/js/jquery.table2excel.js') ?>"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        get_employee_setup();
        get_groupcode();

        $( "#search_creator" ).select2({
            theme: "bootstrap4"
        });

        $( "#search_groupcode" ).select2({
            theme: "bootstrap4"
        });

        all_click();
        
        $('#btn_downloadExcel').addClass('hidden');
        $('#btn_printbar').addClass('hidden');
    });

    function all_click() {  
        $('#btn_printbar').click(function (e) { 
            e.preventDefault();
            var tbody_signloaddata = '';
            $('#tbody_signloaddata').find('tr').each(function(){
                tbody_signloaddata += $(this).find('.field_docno').text()+',';
            });

            var search_status_sign = $('#search_status_sign').val();
            var title_list = $('#title_tb').text();
            window.open('<?php echo site_url('SignV2/Sign_loaddata_check');?>'+'?docno='+tbody_signloaddata+'&title_list='+title_list+'&search_status_sign='+search_status_sign, '_blank');
        });

        $('#btn_downloadExcel').click(function (e) { 
            e.preventDefault();
            export_excel();
        });

        $('#btn_loaddata').click(function (e) { 
            e.preventDefault();
            if ($('#search_status_sign').val() != '') {
                get_loaddata_tocheck();
            }else{
                swal({
                    title: 'เลือกสถานะ',
                    text: "กรุณาเลือกสถานะป้ายที่ต้องการ",
                    type: 'warning'
                });
            }
        });
    }

    function get_loaddata_tocheck() {  
        var search_status_sign = $('#search_status_sign').val();
        var search_creator = $('#search_creator').val();
        var search_groupcode = $('#search_groupcode').val();
        $('#tbody_signloaddata').empty();
        swal({
            title: 'กำลังโหลดข้อมูล',
            html: 'กรุณารอสักครู่',
            onOpen: () => {
            swal.showLoading()
            },
        });
        $.ajax({
            type: "post",
			url:'<?= site_url('SignV2/get_loaddata_tocheck')?>',
            data: {
                search_status_sign : search_status_sign,
                search_creator : search_creator,
                search_groupcode : search_groupcode
            },
            dataType: "json",
            success: function (data) {
                swal.close();
                
                $('#btn_downloadExcel').removeClass('hidden');
                $('#btn_printbar').removeClass('hidden');
                console.log(data);
                var search_creator_name = '';
                var search_groupcode_name = '';

                if (search_groupcode != null) {
                    search_groupcode_name = ' กลุ่มสินค้า ';

                    $.each(search_groupcode, function (id, val) { 
                        search_groupcode_name += val+',';
                    });
                }

                var status_name = '';
                var save_creator = '';
                var before_status = '';
            
                $.each(data['sign'], function (id, val) { 

                    if ($('#search_status_sign').val() == 1){
                        status_name = 'รอสั่งทำ';
                        before_status = ' แชร์โดย ';
                        save_creator = '[จัดซื้อแชร์] '+ name_text(val['creator_nickname'],val['creator_firstname']);
                    }else if($('#search_status_sign').val() == 2){
                        status_name = 'รอรับป้าย';
                        before_status = ' ยืนยันทำโดย ';
                        save_creator = '[ยืนยันทำ] '+ name_text(val['confirm_nickname'],val['confirm_firstname']);
                    }else if($('#search_status_sign').val() == 3){
                        status_name = 'รอติดตั้งป้าย';
                        before_status = ' รับโดย ';
                        save_creator = '[รับป้าย] '+ name_text(val['recieve_nickname'],val['recieve_firstname']);
                    }else if($('#search_status_sign').val() == 4){
                        status_name = 'รอทำลาย';
                        before_status = ' ยืนยันทำโดย ';
                        save_creator = '[ยืนยันทำ] '+ name_text(val['confirm_nickname'],val['confirm_firstname']);
                    }else if($('#search_status_sign').val() == 5){
                        status_name = 'รอตรวจสอบ';
                        before_status = ' ติดตั้งโดย ';
                        save_creator = '[ติดตั้ง] '+ name_text(val['setup_nickname'],val['setup_firstname']);
                    }

                    $('#tbody_signloaddata').append(
                        '<tr>'+
                            '<td class="field_docno">'+val['field_docno']+'</td>'+
                            '<td>'+val['field_groupcode']+'</td>'+
                            '<td>'+val['field_itemcode']+'</td>'+
                            '<td>'+val['field_itemname']+'</td>'+
                            '<td>'+val['type_name']+'</td>'+
                            '<td>'+save_creator+'</td>'+
                            '<td>'+status_name+'</td>'+
                        '</tr>'
                    );

                });

                if (search_creator != null) {
                    $.each(data['employee'], function (id, val) { 
                        search_creator_name += name_text(val['nickname'],val['firstname'])+',';
                    });
                }else{
                    before_status = '';
                }
                
                $('#title_tb').text('รายการสินค้า สถานะ ' +status_name+before_status+search_creator_name+search_groupcode_name);
            }
        });
    }

    function export_excel(){
        var title_list = $('#title_tb').text();

        var filename  = title_list;
        $("#table_data").table2excel({
            // exclude: "#data_wd_office",
            name: "Excel Document Name",
            filename: filename,
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true
        }); 
    };

	function get_employee_setup(){
		$.ajax({
			type:'GET',
			url:'<?= site_url('SignV2/get_employee_setup')?>',
			dataType:'JSON',
			async: false,
		}).done(function(data){

			// console.log(data)

			$('#search_creator').empty();
			$('.select2-selection__choice').remove();
			$.each(data['employee'],function(id,val){
				$('#search_creator').append('<option value="'+val['id']+'">'+val['firstname']+' ('+val['nickname']+')   '+val['departname']+'</option>');
			});

		}).fail(function(data){
		});
	}

	function get_groupcode(){
        $.ajax({
            type:'GET',
            url:'<?= site_url('SignV2/get_groupcode')?>',
            dataType:'JSON',
        }).done(function(data){
            $('#search_groupcode').empty();
            $.each(data['groupcode'],function(id,val){
				$('#search_groupcode').append('<option value="'+val['Code']+'">'+val['Code']+'&emsp;'+'>'+'&emsp;'+val['Name']+'</option>');
            });
            
        }).fail(function(data){
        });
    }

    function name_text(firstname,nickname) {  
        var name = firstname+' ('+nickname+')';
        return name ;
    }


</script>