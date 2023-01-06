<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction(); ?>

<head>

<style>
    .ui-front {
		z-index: 1500 !important;
	}

	.ui-widget-content {
		border: none;
	}

	.label-radio {
		width: 100%;
		background-color: #eee;
		border: 1px solid #ccc;
		border-radius: 4px;
		text-align: left;
		padding: 5px;
		margin-bottom: 10px;
	}

    .pull-padding{
        margin-right : 5px;
    }

	.span-radio {
		padding-left: 20px;
	}

    .pageNumber
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
        "Action" => 'รายการทำลาย'
    );

    $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>
    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <button type="button" id="destroy" class="btn bg-red btn-block"><i class="fa fa-trash"></i> เลือกทำลายป้าย</button>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select name="search_status" id="search_status" class="form-control" >
                        <option value="">ค้นหาตามสถานะอัปโหลด</option>
                        <option value="0">รออัปโหลดรูป</option>
                        <option value="2">อัปโหลดรูปเรียบร้อย</option>
                        <option value="1">ไม่มีรูปทำลาย</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select name="search_recheck" id="search_recheck" class="form-control" >
                        <option value="">ค้นหาตามสถานะตรวจสอบ</option>
                        <option value="0">รอตรวจสอบ</option>
                        <option value="2">ตรวจสอบเรียบร้อย</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label> ค้นหาตามเลขที่เอกสาร รหัสสินค้า หรือชื่อสินค้า</label>
                    <input type="text" class="form-control" id="search_text" >
                </div>
            </div>
        </div>
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <select class="form-control float-right" id="usersPerPage">
                            <option value="15">15 แถว</option>
                            <option value="20">20 แถว</option>
                            <option value="30">30 แถว</option>
                            <option value="50">50 แถว</option>
                            <option value="100">100 แถว</option>
                        </select>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-default">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-tools">
                    <div class="input-group input-group-sm float-right" style="width: 60px;">
                        <button type="button" title="รีเฟรช" id="btn_refresh" class="btn btn-info btn_refresh btn-sm">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <input type="hidden" id="pageNumber" value="0">
                <table  class="table table-hover" show-filter="true">
                    <thead >
                        <tr>
                            <th>เลขที่เอกสาร</th>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th> 
                            <th>หมายเหตุ</th> 
                            <th>พนักงานที่ทำลาย</th> 
                            <th>สถานะ</th> 
                            <th>จัดการ</th> 
                            <th>ตรวจสอบ</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody_sign"></tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="row text-center" >
                    <nav aria-label="Page navigation">
                        <ul class="pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</div>

<body>
    
    <div class="modal fade" id="destroy_info_Modal" role="dialog">
        <div class="modal-dialog modal-xl" style="width:80%" role="document">
            <div class="modal-content" >

                <div class="modal-header bg-info ">
                    <h4 class="modal-title Sarabun-Regular" id="title_info"> ข้อมูลป้ายที่ทำลาย </h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >รหัสสินค้า</label>
                                <input type="text" class="form-control" id="destroy_itemcode_info" readonly> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label >ชื่อสินค้า</label>
                                <input type="text" class="form-control" id="destroy_itemname_info" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-group">
                                <div class="panel panel-primary ">
                                    <div class="panel-body"> 
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    
                                                    <table id="sign_destroy_list" class=" table order-list">
                                                        <thead>
                                                            <tr>
                                                                <th>ลำดับ</th>
                                                                <th style="text-align:left;">บริเวณที่ติดตั้ง</th>
                                                                <th style="text-align:left;">ขนาด</th>
                                                                <th style="text-align:left;">ประเภท</th>
                                                                <th style="text-align:right;">จำนวน</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tb_destroy_info_list">
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >หมายเหตุการทำลาย</label>
                                <input type="text" class="form-control destroy_comment" id="destroy_comment_info" readonly>
                                <!-- <select  class="form-control" id="destroy_comment_success" > 
                                </select> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
							<div class="card card-secondary">
								<div class="card-header">
									<div class="card-title">
										รูป
									</div>
								</div>
								<div class="card-body">
									<div class="row" id="links_file_info">

									</div>
								</div>
							</div>
						</div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="destroy_success_Modal" role="dialog">
        <form id="form_confirm_success_destroy">
            <div class="modal-dialog modal-xl" style="width:80%" role="document">
                <div class="modal-content" >

                    <div class="modal-header bg-danger">
                        <h4 class="modal-title Sarabun-Regular"> ทำลายป้ายเดิมที่คงค้าง </h4>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >รหัสสินค้า</label>
                                    <input type="text" class="form-control" id="search_itemcode">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label >ชื่อสินค้า</label>
                                    <input type="text" class="form-control" id="destroy_itemname_success" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="div_status_destroy">
                                 
                                </div>
                                <div class="form-group">
                                    <table id="sign_destroy_list" class=" table order-list table-hover">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>อ้างอิงSG</th>
                                                <th>บริเวณที่ติดตั้ง</th>
                                                <th>ขนาด</th>
                                                <th>ประเภทราคา</th>
                                                <th class="text-right">จำนวน</th>
                                                <th>สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb_destroy_success_list">
                                        </tbody>
                                    </table>
                                </div>  
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >หมายเหตุการทำลาย</label>
                                    <!-- <input type="text" class="form-control" id="destroy_comment_success" > -->
                                    <select  class="form-control destroy_comment" id="destroy_comment_success" > 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="checkbox-inline" style="color:red;">
                                        <input type="checkbox" value="1" id="no_image"> *-->ไม่มีรูปทำลายป้าย(เนื่องจากป้ายหาย)<--
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>หมายเหตุเพิ่มเติม </label><span class="text-danger"> ** หากพบเจอป้ายที่แจ้งว่าหาย จะมีบทลงโทษภายหลัง</span>
                                    <input type="text" class="form-control" id="destroy_comment_more" placeholder="เช่น เนื่องจากป้ายติดไปกับสินค้าที่ขายให้ลูกค้า">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-danger" id="submit_destroy_success">ทำลายป้าย</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="destroy_edit_Modal" role="dialog">
        <div class="modal-dialog modal-xl" style="width:50%" role="document">
            <div class="modal-content" >

                <div class="modal-header bg-warning">
                    <h4 class="modal-title Sarabun-Regular"> แก้ไขหมายเหตุการทำลาย </h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="destroy_edit_id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >หมายเหตุการทำลาย(เดิม)</label>
                                <!-- <input type="text" class="form-control" id="destroy_comment_success" > -->
                                <input type="text"  class="form-control " id="destroy_comment_edit_info" readonly> 
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >หมายเหตุการทำลาย(ใหม่)</label>
                                <!-- <input type="text" class="form-control" id="destroy_comment_success" > -->
                                <select  class="form-control destroy_comment" id="destroy_comment_edit"> 
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit"  class="btn btn-warning" id="submit_edit_success">แก้ไข</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>


    <form id="uploadimage" method="post" enctype="multipart/form-data" accept-charset="utf-8" method="get">
        <div class="modal fade" id="uploadModal" role="dialog" data-keyboard="false">  
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" >
                    <div class="modal-header bg-secondary">
                        <h4 class="modal-title Sarabun-Regular" id="upmodal_name"> เพิ่มรูปภาพ </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="file" name="file[]" id="file" accept="image/*" multiple="multiple" required />
                                </div>
                                <p style="color:#FF0000";><b>* รับเฉพาะไฟล์ .jpg สามารถเพิ่มรูปได้ 2 รูปเท่านั้น</b></p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="id" id="upload_id" />                   
                                </div>
                            </div>
                        </div>
                        <div class="row" id="links_file">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">เพิ่มรูปภาพ</button>
                        <button type="button" class="btn btn-default cancel_uploadModal" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </div> 
        </div>
    </form>

</body>
