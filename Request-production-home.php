<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction(); ?>

<head>
    <style type="text/css">
        /* .select2-selection__choice {
            width: 200px;
            text-align: center;
        }

        .select2-container .select2-selection--single {
            height: 34px;
        }

        .select2-selection__choice__remove {
            float: right;
        } */

        .pageNumber {
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

        button.active {
            color: #fff;
            cursor: default;
            background-color: #343a40;
            border-color: #343a40;
        }

        .users-list>li img {
            border-radius: 5%;
            max-width: 89%;
            height: auto;
        }

        .ui-autocomplete { 
			z-index:2147483647; 
		}
		.ui-widget-content {
			border: none;
		}
    </style>
</head>



<div class="content-wrapper">

    <?php 

        $data['data_breadcrumb'] = array();
        $data['data_breadcrumb'] = array(
        "Link" => 'Check_StkPOV2',
        "Name" => 'รายการใบสั่งผลิต - ใบสั่งซ่อม',
        "Action" => 'Request_production'
        );

        $this->load->view('Tools/Breadcrumb-1',$data); 

    ?>

    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box shadow-sm">
                                <span class="info-box-icon bg-light" id="info_no_1"><i class="fas fa-edit"></i></span>

                                <div class="info-box-content">
                                    <small class="info-box-text">ลำดับ 1 <i
                                            class="fas fa-arrow-circle-right"></i></small>
                                    <span class="info-box-number">เพิ่ม ,แก้ไข ,เพิ่มรูปภาพก่อนทำ </span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box shadow-sm">
                                <span class="info-box-icon bg-light" id="info_no_2"><i class="fas fa-check"></i></span>

                                <div class="info-box-content">
                                    <small class="info-box-text">ลำดับ 2 <i
                                            class="fas fa-arrow-circle-right"></i></small>
                                    <span class="info-box-number">อนุมัติ </span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box shadow-sm">
                                <span class="info-box-icon bg-light" id="info_no_3"><i
                                        class="fas fa-user-tag"></i></span>

                                <div class="info-box-content">
                                    <small class="info-box-text">ลำดับ 3 <i
                                            class="fas fa-arrow-circle-right"></i></small>
                                    <span class="info-box-number">ระบุผู้รับทำงาน ,พิมพ์ใบสั่งผลิต-สั่งซ่อม </span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box shadow-sm">
                                <span class="info-box-icon bg-light" id="info_no_4"><i
                                        class="fas fa-check-double"></i></span>

                                <div class="info-box-content">
                                    <small class="info-box-text">ลำดับ 4 <i class="fas fa-dot-circle"></i></small>
                                    <span class="info-box-number">ตรวจรับงาน, เพิ่มรูปภาพหลังทำ </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card  card-solid">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-block btn-secondary" id="btn_open_history_modal"><i class="fas fa-history"></i> ลงประวัติการซ่อมย้อนหลัง</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Manage_topic"])) :?>
                                        <div class="form-group">

                                            <button type="button" class="btn btn-block btn-primary"
                                                onclick="location.href='Request_production/topic_Request_production'">
                                                จัดการหัวข้องาน</button>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <div class="form-group">

                                            <button type="button" class="btn btn-block btn-primary"
                                                onclick="location.href='Request_production/fixitem_Request_production'">
                                                จัดการหัวข้อการซ่อม</button>
                                        </div>
                                    </div> -->
                                    <div class="col-md-3">
                                        <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Add"])) :?>

                                        <button type="button" class="btn  btn-block btn-success"
                                            onclick="location.href='Request_production/gotoadd_request_production'">
                                            <small class="badge bg-success border border-light">1</small>
                                            เพิ่มใบสั่งผลิต -
                                            ใบสั่งซ่อม</button>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                placeholder="ค้นหาตามเลขที่เอกสาร หรือ ชื่องาน" id="search_text">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control search_doc_type" id="search_doc_type">
                                                <option value="">ค้นหาตามประเภทงาน</option>
                                                <option value="1">งานสั่งผลิต</option>
                                                <option value="2">งานสั่งซ่อม</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control search_status" id="search_status">
                                                <option value="">ค้นหาตามสถานะ</option>
                                                <option value="0">รอผู้บริหารอนุมัติ</option>
                                                <option value="1">ผู้บริหารอนุมัติ</option>
                                                <option value="5">ผู้บริหารไม่อนุมัติ</option>
                                                <option value="8">ผู้บริหารสั่งแก้ไข</option>
                                                <option value="9">แก้ไขตามผู้บริหารสั่งแล้ว</option>
                                                <option value="2">รอตรวจรับงาน</option>
                                                <option value="4">รับงานเรียบร้อย</option>
                                                <option value="7">งานไม่ผ่าน</option>
                                                <option value="10">ขอผู้บริหารถอยอนุมัติ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control search_depart" id="search_depart">
                                                <option value=""> ค้นหาตามแผนก </option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <p class="mb-2">
                        <b class="text-warning">แถบรายการ</b>  <span class="text-warning">สีส้ม</span>  เตือนการดำเนินการใบสั่งผลิต - ใบสั่งซ่อม เกิน 3 วัน ในกรณีที่ผู้บริหารอนุมัติแล้ว
                    </p>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <input type="hidden" id="pageNumber" value="0">
                            <input type="hidden" id="usersPerPage" value="20">
                            <div class="table-responsive" style="font-size:14px;">
                                <table class="table table-hover" id="" show-filter="true">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-left"> เลขที่เอกสาร </th>
                                            <th class="text-left"> ชื่องาน </th>
                                            <!-- <th class="text-left"> ผู้ขอทำ </th> -->
                                            <th class="text-left"> งบประมาณ (บาท) </th>
                                            <th class="text-left" style="width: 20%;"> สถานะ</th>
                                            <th class="text-left" style="width: 20%;"> เครื่องมือ </th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_rp">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-left">

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<div class="modal fade" id="receiveModal" role="dialog" data-toggle="modal" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="receive">
            <div class="modal-header bg-blue">
                <h4 class="modal-title " id="DataModalLabel">ระบุพนักงานรับทำงาน</h4>
            </div>
            <div class="modal-body">

                <input type="hidden" id="receive_rp_id">

                <div class="row">
                    <div class="col-md-6">
                        <blockquote class="quote-info">
                            <dl>
                                <dt>เลขที่เอกสาร</dt>
                                <dd id="receive_rp_docno"></dd>
                                <dt>ชื่องาน</dt>
                                <dd id="receive_rp_name"></dd>
                            </dl>
                        </blockquote>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <div class="table-responsive" style="font-size:14px;">
                                    <table class="table table-hover" id="" show-filter="true">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="150">ระบุพนักงานรับทำงาน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control employee_id" id="list_employee"
                                                        multiple="multiple" required>
                                                        <option value="">เลือกพนักงาน</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn_receive_submit">บันทึก</button>
                <button type="button" class="btn btn-light" data-dismiss="modal"
                    onclick="javascript:clear_input_receive()">ปิด</button>
            </div>
        </div>
    </div>
</div>

<form id="uploadimage" method="post" enctype="multipart/form-data" accept-charset="utf-8" method="get">
    <div class="modal fade" id="uploadModal" role="dialog" data-toggle="modal" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-blue">
                    <h4 class="modal-title "> เพิ่มรูปภาพหลังทำ</h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="callout callout-info">
                                <h4 class=""> ข้อกำหนด</h4>
                                <p>1.สามารถเพิ่มรูปได้ 2 รูปเท่านั้น</p>
                                <p>2.ไม่สามารถลบไฟล์รูปได้ เมื่อมีการเพิ่มรูปหลังทำไปแล้ว</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="file" name="file[]" id="file" multiple="multiple"
                                    required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="id" id="upload_id" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="users-list clearfix links_file" id="links_file_after">
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">เพิ่มรูปภาพ</button>
                    <button type="button" class="btn btn-light cancel_uploadModal" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="edituploadimage" method="post" enctype="multipart/form-data" accept-charset="utf-8" method="get">
    <div class="modal fade" id="edituploadModal" role="dialog" data-toggle="modal" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog " role="document">
            <div class="modal-content">

                <div class="modal-header bg-blue">
                    <h4 class="modal-title "> เพิ่มรูปภาพก่อนทำ</h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="callout callout-info">
                                <h4 class=""> ข้อกำหนด</h4>
                                <p>1.สามารถเพิ่มรูปได้ 2 รูปเท่านั้น</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="file" name="file_edit[]" id="file_edit"
                                    multiple="multiple" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="id" id="editupload_id" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="users-list clearfix links_file" id="links_file_before">
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">เพิ่มรูปภาพ</button>
                    <button type="button" class="btn btn-light ancel_edituploadModal" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

</form>

<div class="modal fade" id="confirmModal" role="dialog" data-toggle="modal" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h4 class="modal-title ">จัดการใบสั่งผลิต - สั่งซ่อม</h4>
            </div>

            <div class="modal-body">

                <input type="hidden" id="confirm_rp_id">
                <input type="hidden" id="status_print">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="card card-secondary card-solid ">
                                <div class="card-header with-border">
                                    <h3 class="card-title ">อนุมัติ (สำหรับผู้ที่มีสิทธิ์)</h3>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <table class="table">
                                                    <tbody id="data_managerconfirm">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if(isset($CheckPrivilegeFunction[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/Approve_ceo"])) :?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="card card-secondary card-solid ">
                                <div class="card-header with-border">
                                    <h3 class="card-title ">อนุมัติ (ผู้บริหาร)</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                            <h1 class="text-center " id="confirm_ceoconfirm_status">...
                                            </h1>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="btn-group ">
                                                <button type="button" class="btn btn-success btn_ceoconfirm_submit"
                                                    data-id="1" id="">ผ่านการอนุมัติ</button>
                                                <button type="button" class="btn btn-warning btn_ceoconfirm_submit"
                                                    data-id="8" id="">แก้ไข</button>
                                                <button type="button" class="btn btn-danger btn_ceoconfirm_submit"
                                                    data-id="5" id="">ไม่อนุมัติ</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> ความคิดเห็นของผู้บริหาร ในกรณีให้แก้ไข </label>
                                                <textarea rows="4" class="form-control "
                                                    placeholder="ความคิดเห็นของผู้บริหาร ในกรณีให้แก้ไข"
                                                    id="confirm_ceo_comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="backwardModal" role="dialog" data-toggle="modal" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h4 class="modal-title ">ถอยเอกสาร</h4>
            </div>

            <div class="modal-body">

                <input type="hidden" id="backward_rp_id">

                <div class="row div_request_backward">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="card card-warning card-solid ">
                                <div class="card-header with-border">
                                    <h3 class="card-title ">ขอถอยเอกสาร</h3>
                                </div>
                                <div class="card-body">
                                    <!-- <div class="row text-center">
                                        <div class="col-md-12">
                                            <div class="btn-group ">
                                               
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-md-12" id="div_person_request_backward">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> เหตุผล ในการขอถอยเอกสาร </label>
                                                <label id="name_request_backward"></label>
                                                <textarea rows="4" class="form-control "
                                                    placeholder="เหตุผล ในการขอถอยเอกสาร"
                                                    id="backward_request_comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-warning"
                                        data-id="8" id="btn_requestbackward_submit">ขอถอยเอกสาร</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row div_ceo_backward">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="card card-secondary card-solid ">
                                <div class="card-header with-border">
                                    <h3 class="card-title ">ผู้บริหาร</h3>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> ความคิดเห็นของผู้บริหาร ในกรณีถอยเอกสาร </label>
                                                <textarea rows="4" class="form-control "
                                                    placeholder="ความคิดเห็นของผู้บริหาร ในกรณีถอยเอกสาร"
                                                    id="backward_ceo_comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-warning btn_ceobackward_submit"
                                        data-id="8" id="">ถอยเอกสาร</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="print_first_Modal" role="dialog" data-toggle="modal" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title "><i class="fas fa-print"></i> พิมพ์ใบสั่งผลิต-สั่งซ่อมก่อนอนุมัติ</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <div class="card card-secondary">
                                <div class="card-header ">
                                    เลือกการพิมพ์
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <select id="select_print_type" class="form-control">
                                            <option value="1">พิมพ์รวม</option>
                                            <option value="2">พิมพ์แยก</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header ">
                                    สถานะการพิมพ์
                                </div>
                                <input type="hidden" id="field_id_print">
                                <div class="card-body" id="div_status_print">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" id="div_labor_print">
                        <div class="card card-solid text-center">
                            <div class="card-header">
                                <h5>พิมพ์แยก ค่าบริการ</h5>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-primary" id="btn_print_labor">พิมพ์ <i class="fa fa-print"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="div_item_print">
                        <div class="card card-solid text-center">
                            <div class="card-header">
                                <h5>พิมพ์แยก ค่าวัสดุ</h5>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-primary" id="btn_print_item">พิมพ์ <i class="fa fa-print"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="div_laboritem_print">
                        <div class="card card-solid text-center">
                            <div class="card-header">
                                <h5>พิมพ์รวม ค่าบริการและค่าวัสดุ</h5>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-primary" id="btn_print_all">พิมพ์ <i class="fa fa-print"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-success" id="btn_save_histroy"><i class="fa fa-plus"></i> บันทึก</button> -->
                <button type="button" class="btn btn-light" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_history_Modal" role="dialog" data-toggle="modal" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title "><i class="fas fa-history"></i> ลงประวัติการสั่งซ่อมย้อนหลัง</h4>
            </div>
            <div class="modal-body">
                <div class="row row_fix_item" id="">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><small class="badge bg-secondary border border-light">1</small> ประเภทสิ่งที่ต้องการลงประวัติการซ่อม </label>
                            <select class="form-control field_fixitem_id" id="field_fixitem_id">
                                <option value="">เลือกประเภทสิ่งที่ต้องการลงประวัติการซ่อม</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row row_fix_item" id="">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><small class="badge bg-secondary border border-light">2</small> ประเภทย่อยสิ่งที่ต้องการลงประวัติการซ่อม </label>
                            <select class="form-control field_fixitem_sub_id" id="field_fixitem_sub_id">
                                <option value="">เลือกประเภทย่อยสิ่งที่ต้องการลงประวัติการซ่อม</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row row_fix_item" id="">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><small class="badge bg-secondary border border-light">3</small> สินทรัพย์ที่ต้องการลงประวัติการซ่อม </label>
                            <select class="form-control field_fixitem_item_id" id="field_fixitem_item_id">
                                <option value="">เลือกสินทรัพย์ที่ต้องการลงประวัติการซ่อม</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card card-solid ">
                    <div class="card-body table-responsive p-0">
                        <div class="table-responsive" style="font-size:14px;">
                            <table id="myTable" class=" table text-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="4"><small class="badge bg-secondary border border-light">4</small> ประวัติการซ่อมในระบบสั่งซ่อม <span class="text-primary">แถบสีน้ำเงิน = ลงประวัติย้อนหลัง</span></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-left">เลขที่เอกสาร</th>
                                        <th class="text-left">ชื่องาน</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="data_fixhistory">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="search_request_product" placeholder="ค้นหาเลขที่ใบสั่งซ่อม/สั่งผลิต เพื่อเพิ่มประวัติ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_save_histroy"><i class="fa fa-plus"></i> บันทึก</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>