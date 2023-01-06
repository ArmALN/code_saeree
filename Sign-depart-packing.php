
<head>

<style>

.pagination1 {
        display: inline-block;
        padding-left: 0;

        border-radius: 4px;
    }

    .pagination1>li {
        display: inline;
    }

    .pagination1>li>a,
    .pagination1>li>span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 0.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }

    .pagination1>li:first-child>a,
    .pagination1>li:first-child>span {
        margin-left: 0;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .pagination1>li:last-child>a,
    .pagination1>li:last-child>span {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    .pagination1>li>a:hover,
    .pagination1>li>span:hover,
    .pagination1>li>a:focus,
    .pagination1>li>span:focus {
        z-index: 2;
        color: #23527c;
        background-color: #eee;
        border-color: #ddd;
    }

    .pagination1>.active>a,
    .pagination1>.active>span,
    .pagination1>.active>a:hover,
    .pagination1>.active>span:hover,
    .pagination1>.active>a:focus,
    .pagination1>.active>span:focus {
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #337ab7;
        border-color: #337ab7;
    }

    .pagination1>.disabled>span,
    .pagination1>.disabled>span:hover,
    .pagination1>.disabled>span:focus,
    .pagination1>.disabled>a,
    .pagination1>.disabled>a:hover,
    .pagination1>.disabled>a:focus {
        color: #777;
        cursor: not-allowed;
        background-color: #fff;
        border-color: #ddd;
    }

    .pagination1-lg>li>a,
    .pagination1-lg>li>span {
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.3333333;
    }

    .pagination1-lg>li:first-child>a,
    .pagination1-lg>li:first-child>span {
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
    }

    .pagination1-lg>li:last-child>a,
    .pagination1-lg>li:last-child>span {
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
    }

    .pagination1-sm>li>a,
    .pagination1-sm>li>span {
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
    }

    .pagination1-sm>li:first-child>a,
    .pagination1-sm>li:first-child>span {
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
    }

    .pagination1-sm>li:last-child>a,
    .pagination1-sm>li:last-child>span {
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
    }

    .pagination2 {
			display: inline-block;
			padding-left: 0;
			border-radius: 4px;
		}

		.pagination2>li {
			display: inline;
		}

		.pagination2>li>a,
		.pagination2>li>span {
			position: relative;
			float: left;
			padding: 6px 12px;
			margin-left: -1px;
			line-height: 1.42857143;
			color: #337ab7;
			text-decoration: none;
			background-color: #fff;
			border: 1px solid #ddd;
		}

		.pagination2>li:first-child>a,
		.pagination2>li:first-child>span {
			margin-left: 0;
			border-top-left-radius: 4px;
			border-bottom-left-radius: 4px;
		}

		.pagination2>li:last-child>a,
		.pagination2>li:last-child>span {
			border-top-right-radius: 4px;
			border-bottom-right-radius: 4px;
		}

		.pagination2>li>a:hover,
		.pagination2>li>span:hover,
		.pagination2>li>a:focus,
		.pagination2>li>span:focus {
			z-index: 2;
			color: #23527c;
			background-color: #eee;
			border-color: #ddd;
		}

		.pagination2>.active>a,
		.pagination2>.active>span,
		.pagination2>.active>a:hover,
		.pagination2>.active>span:hover,
		.pagination2>.active>a:focus,
		.pagination2>.active>span:focus {
			z-index: 3;
			color: #fff;
			cursor: default;
			background-color: #337ab7;
			border-color: #337ab7;
		}

		.pagination2>.disabled>span,
		.pagination2>.disabled>span:hover,
		.pagination2>.disabled>span:focus,
		.pagination2>.disabled>a,
		.pagination2>.disabled>a:hover,
		.pagination2>.disabled>a:focus {
			color: #777;
			cursor: not-allowed;
			background-color: #fff;
			border-color: #ddd;
		}

		.pagination2-lg>li>a,
		.pagination2-lg>li>span {
			padding: 10px 16px;
			font-size: 18px;
			line-height: 1.3333333;
		}

		.pagination2-lg>li:first-child>a,
		.pagination2-lg>li:first-child>span {
			border-top-left-radius: 6px;
			border-bottom-left-radius: 6px;
		}

		.pagination2-lg>li:last-child>a,
		.pagination2-lg>li:last-child>span {
			border-top-right-radius: 6px;
			border-bottom-right-radius: 6px;
		}

		.pagination2-sm>li>a,
		.pagination2-sm>li>span {
			padding: 5px 10px;
			font-size: 12px;
			line-height: 1.5;
		}

		.pagination2-sm>li:first-child>a,
		.pagination2-sm>li:first-child>span {
			border-top-left-radius: 3px;
			border-bottom-left-radius: 3px;
		}

		.pagination2-sm>li:last-child>a,
		.pagination2-sm>li:last-child>span {
			border-top-right-radius: 3px;
			border-bottom-right-radius: 3px;
		}

    .pageNumber1
    {
        position: relative;
        float: left;
        padding: 2px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #000;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #d2d6de;
        border-radius: 5px;
        margin-right: 5px;
    }

    .pageNumber2
    {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #000;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #d2d6de;
        border-radius: 5px;
        margin-right: 5px;
    }

    button.active
    {
        color: #fff;
        cursor: default;
        background-color: #343a40;
        border-color: #343a40;
    }

    .select{
        background-color: #4d72df;
        color: white;
    }

</style>

</head>

<div class="content-wrapper">
    <?php 

    $data['data_breadcrumb'] = array();
    $data['data_breadcrumb'] = array(
        "Link" => 'SignV2',
        "Name" => 'ป้ายสินค้า',
        "Action" => 'แผนกทำป้ายเองยืนยันทำ'
    );

    $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>
    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
    <div class="row">
        <div class="col-md-3" >
            <a href="<?php echo site_url('SignV2/depart_load_data');?>"><button type="button" class="btn btn-block btn-primary">ไปหน้าดึงข้อมูล</button></a>
        </div>
    </div>
    <br>
    <div class="card "> 
        <div class="card-header bg-indigo">
            <input type="hidden" id="doit" value="1">
            <h2 class="card-title">แผนกทำป้ายเอง : รายการรอทำป้าย</h2>
        </div>
        <div class="card-body">
            <div  class="row">
                <div class="col-md-4">
                    <div class="form-group">
						<label> ค้นหาตามประเภท </label>
                        <select class="form-control search_type" id="search_type">
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
						<label> ค้นหาตามกลุ่มสินค้า </label>
						<select class="form-control search_groupcode" id="search_groupcode">
							<option value=""> ทั้งหมด </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
						<label> ค้นหาตามขนาด </label>
                        <select class="form-control search_size" id="search_size">
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label> จำนวนแถวที่แสดง </label>
                        <select class="form-control" id="usersPerPage1">
                            <option value="15">15 แถว</option>
                            <option value="20">20 แถว</option>
                            <option value="30">30 แถว</option>
                            <option value="50">50 แถว</option>
                            <option value="100">100 แถว</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
					<div class="form-group">
                    <input type="hidden" class="form-control" id="pageNumber1" value="0">
						<label> ค้นหาตามเลขที่เอกสาร รหัสสินค้า หรือชื่อสินค้า </label>
						<input type="text" class="form-control" id="search_text" >  
					</div>
				</div>  
			</div>
            <div  class="row">
                <div class="col-md-1">
                    <button type="button" title="รีเฟรช" id="btn_refresh" class="btn btn-info btn_refresh btn-block">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <div class="col-md-2">
				</div> 

				<div class="col-md-3">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block" name="button " id="SelectAll"> เลือกทั้งหมด </button>
                    </div>
				</div>  
                <div class="col-md-3">
                    <button type="button" class="btn btn-block btn-secondary hidden" id="btn_re_loaddata"><i class="fas fa-history"></i> ขอถอยดึงข้อมูล</button>
                </div>
                <div class="col-md-3">
                    <div class="form-group excel_row">
                        <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-success btn-block hidden" id="Excel" > ปริ้นป้าย </button>
                        </div> 
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-hover" show-filter="true" id="sign_packing">
                        <thead>
                            <tr>
                                <th class="text-left">รหัสสินค้า</th>
                                <th class="text-left">ชื่อสินค้า</th>
                                <th class="text-center">ประเภท</th>
                                <th class="text-center">ขนาด</th>
                                <th class="text-center">จำนวน</th>
                                <th class="text-center">สาเหตุ</th>
                                <th class="text-center">หมายเหตุ</th>
                                <th class="text-center">หมายเหตุเพิ่มเติม</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_sign_packing">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <div class="row text-center" >
                    <nav aria-label="Page navigation">
                        <ul class="pagination1"></ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <div class="card "> 
        <div class="card-header bg-indigo">
            <h2 class="card-title">แผนกทำป้ายเอง : รายการสถานะป้าย</h2>
        </div>
        <div class="card-body">
            <div  class="row">
                <div class="col-md-4">
                    <div class="form-group">
						<label> ค้นหาตามประเภท </label>
                        <select class="form-control search_type" id="search_type_do">
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
						<label> ค้นหาตามกลุ่มสินค้า </label>
						<select class="form-control search_groupcode" id="search_groupcode_do">
							<option value=""> ทั้งหมด </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
						<label> ค้นหาตามขนาด </label>
                        <select class="form-control search_size" id="search_size_do">
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label> จำนวนแถวที่แสดง </label>
                        <select class="form-control" id="usersPerPage2">
                            <option value="15">15 แถว</option>
                            <option value="20">20 แถว</option>
                            <option value="30">30 แถว</option>
                            <option value="50">50 แถว</option>
                            <option value="100">100 แถว</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
						<label> ค้นหาตามสถานะทำป้าย </label>
						<select class="form-control search_status_do" id="search_status_do">
							<option value=""> ทั้งหมด </option>
                            <option value="1"> กำลังทำ </option>
                            <option value="4"> รอรับป้าย </option>
                            <option value="3"> รอยืนยัน </option>
                            <option value="2"> เสร็จแล้ว </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
					<div class="form-group">
                    <input type="hidden" class="form-control" id="pageNumber2" value="0">
						<label> ค้นหาตามเลขที่เอกสาร รหัสสินค้า หรือชื่อสินค้า </label>
						<input type="text" class="form-control" id="search_text_do" >  
					</div>
				</div>  
			</div>
            <div  class="row">
                <div class="col-md-1">
                    <button type="button" title="รีเฟรช" id="btn_refresh_do" class="btn btn-info btn_refresh btn-block">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block" name="button " id="SelectAll_do"> เลือกทั้งหมด </button>
                    </div>
				</div> 
				<div class="col-md-3">
                    <div class="form-group sucess_row">
                        <div class="btn-group btn-block">
                            <button type="submit" class="btn btn-success btn-block" id="success_packing" ><i class="fas fa-check"></i> ทำป้ายเสร็จแล้ว </button>
                        </div> 
                    </div>
				</div>  
                <div class="col-md-3">
                    <div class="form-group recive_row">
                        <div class="btn-group btn-block">
                            <button type="submit" class="btn btn-info btn-block" id="success_recive" ><i class="fas fa-check"></i> รับป้ายเรียบร้อยแล้ว </button>
                        </div> 
                    </div>
				</div>  
                <div class="col-md-3">
                    <div class="form-group recive_row">
                        <div class="btn-group btn-block">
                            <button type="button" class="btn btn-secondary btn-block" id="reprint" ><i class="fas fa-history"></i> ขอปริ้นอีกครั้ง </button>
                        </div> 
                    </div>
				</div>  
			</div>
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-hover" show-filter="true" id="sign_packing_do">
                        <thead>
                            <tr>
                                <th class="text-left">รหัสสินค้า</th>
                                <th class="text-left">ชื่อสินค้า</th>
                                <th class="text-center">วันที่ต้องการ</th>
                                <th class="text-center">ขนาด</th>
                                <th class="text-center">สาเหตุ</th>
                                <th class="text-center">ผู้ทำ</th>
                                <th class="text-right">ปริ้น(ครั้ง)</th>
                                <th class="text-center">หมายเหตุ</th>
                                <th class="text-center">หมายเหตุเพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_sign_packing_do">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <div class="row text-center" >
                    <nav aria-label="Page navigation">
                        <ul class="pagination2"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>


<form id="form_load_data">
    <div class="modal fade" id="load_data_modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ดึงข้อมูล</h4>
                </div>
                <div class="modal-body">
                    <div id="show_data_item"></div>
                    <label for="barcode_select">เลือกบาร์โค้ด </label>
                    <select name="barcode_select" class="form-control barcode_select" id="barcode_select">
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-blue">ดึงข้อมูล</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                </div>
            
            </div>
            
        </div>
    </div>
</form>

<div class="modal fade" id="reloaddata_modal" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title"> ขอดึงข้อมูลอีกครั้ง</h4>
            </div>
            <div class="modal-body">
                <table  class="table table-hover" show-filter="true" >
                    <thead>
                        <tr>
                            <th class="text-left">เลขที่เอกสาร</th>
                            <th class="text-left">รหัสสินค้า</th>
                            <th class="text-left">ชื่อสินค้า</th>
                            <th class="text-center">วันที่ต้องการ</th>
                            <th class="text-center">ขนาด</th>
                            <th class="text-right">จำนวน</th>
                        </tr>
                    </thead>
                    <tbody id="tb_reloaddata">
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-danger">หมายเหตุการขอถอยดึงข้อมูล</label>
                            <input type="text" class="form-control" id="input_reloaddata_comment" placeholder="กรอกหมายเหตุ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="submit_reloaddata">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        
        </div>
        
    </div>
</div>

<div class="modal fade" id="reprint_modal" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title"> ขอถอยปริ้น</h4>
            </div>
            <div class="modal-body">
                <table  class="table table-hover" show-filter="true" >
                    <thead>
                        <tr>
                            <th class="text-left">เลขที่เอกสาร</th>
                            <th class="text-left">รหัสสินค้า</th>
                            <th class="text-left">ชื่อสินค้า</th>
                            <th class="text-center">วันที่ทำ</th>
                            <th class="text-center">วันที่ต้องการ</th>
                            <th class="text-center">ขนาด</th>
                            <th class="text-right">จำนวน</th>
                        </tr>
                    </thead>
                    <tbody id="tb_reprint">
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-danger">หมายเหตุการขอถอยปริ้น</label>
                            <input type="text" class="form-control" id="input_reprint_comment" placeholder="กรอกหมายเหตุ">
                        </div>
                    </div>
                </div>
                <span class="text-danger">*หากขอถอยปริ้นรอบที่ 3 ต้องขอผู้บริหารเป็นคนอนุมัติ</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="submit_reprint">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        
        </div>
        
    </div>
</div>

<form id="form_confirm_success_packing">
    <div class="modal fade" id="packing_modal" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title"> ยืนยันทำป้ายเสร็จเรียบร้อย</h4>
                </div>
                <div class="modal-body">
                    <table  class="table table-hover" show-filter="true" >
                        <thead>
                            <tr>
                                <th class="text-left">เลขที่เอกสาร</th>
                                <th class="text-left">รหัสสินค้า</th>
                                <th class="text-left">ชื่อสินค้า</th>
                                <th class="text-center">วันที่ทำ</th>
                                <th class="text-center">วันที่ต้องการ</th>
                                <th class="text-center">ขนาด</th>
                                <th class="text-right">จำนวน</th>
                            </tr>
                        </thead>
                        <tbody id="tb_success_packing">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >บันทึกข้อมูล</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                </div>
            
            </div>
            
        </div>
    </div>
</form>

<form id="form_confirm_success_recive">
    <div class="modal fade" id="recive_modal" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title"> ยืนยันรับป้ายเรียบร้อย</h4>
                </div>
                <div class="modal-body">
                    <table  class="table table-hover" show-filter="true" >
                        <thead>
                            <tr>
                                <th class="text-left">รหัสสินค้า</th>
                                <th class="text-left">ชื่อสินค้า</th>
                                <th class="text-center">วันที่ทำ</th>
                                <th class="text-center">วันที่ต้องการ</th>
                                <th class="text-center">ขนาด</th>
                                <th class="text-center">จำนวน</th>
                            </tr>
                        </thead>
                        <tbody id="tb_success_recive">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" >บันทึกข้อมูล</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                </div>
            
            </div>
            
        </div>
    </div>
</form>

<div class="modal fade" id="editname_modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document" style="left:0%;">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title" id="editname_title">แก้ไขชื่อสินค้า ที่แสดงในป้าย</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label >ชื่อสินค้า</label>
                            <input type="hidden" id="field_editname_id">
                            <input type="text" class="form-control" placeholder="กรอกชื่อสินสินค้าที่ต้องการแก้" id="input_nameedit">
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-warning btn-lg" id="btn_submit_edit">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-light btn-lg" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>