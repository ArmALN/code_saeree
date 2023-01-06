
<head>

<style>

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
        "Action" => 'แผนกยืนยันทำ'
    );

    $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>
    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
        <div class="card card-secondary">
            <div class="card-header">
                <h2 class="card-title">รายการสินค้าที่มีการเปลี่ยนแปลง</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <input type="hidden" class="form-control" id="sign_creator_id">
                        <input type="hidden" class="form-control" id="pageNumber" value="0">
                        <input type="hidden" class="form-control" id="usersPerPage" value="15">
                            <label>ค้นหารายการ</label>
                            <input type="text" class="form-control" id="search_text" placeholder="ค้าหาจาก...ชื่อสินค้า,รหัสสินค้า">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label >ค้าหาตามกลุ่มสินค้า </label>
                            <select class="form-control search_groupcode" id="search_groupcode">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo site_url('SignV2/depart_add');?>"><button type="button" class="btn btn-block btn-success">ขอทำป้าย</button></a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo site_url('SignV2/depart_load_data');?>"><button type="button" class="btn btn-block btn-info">ทำป้ายเอง</button></a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th class="text-left">เลขที่เอกสาร</th>
                                    <th class="text-left">รหัสสินค้า</th>
                                    <th class="text-left">ชื่อสินค้า</th>
                                    <th class="text-center">วันที่จะเปลี่ยนข้อมูล</th>
                                    <th class="text-center">ผู้บันทึกข้อมูล</th>
                                    <th class="text-center">สาเหตุ</th>
                                    <th class="text-center">ยืนยัน</th>
                                </tr>
                            </thead>
                            <tbody id="tb_list_sign">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <div class="row text-center" >
                        <nav aria-label="Page navigation">
                            <ul class="pagination"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<div class="modal fade" id="confirm_manage_modal" role="dialog">
    <div class="modal-dialog modal-xl" role="document" style="left:0%;">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" style="color:#FFF;" id="con_manage"></h4>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"><b>ข้อมูลสินค้า</b></h3>
                            <input type="hidden" id="detail_typeitem">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex" id="detail_confirm">
                        </div>
                    </div>
                </div>

                <div class="card card-danger">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"><b>ป้ายที่ใช้งาน</b><b> เลือกป้ายที่ต้องการทำลาย</b></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex" >
                            <table id="tb_active_sign" class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>อ้างอิงSG</th>
                                        <th style="text-align:left;">บริเวณที่ติดตั้ง</th>
                                        <th style="text-align:left;">ขนาด</th>
                                        <th style="text-align:left;">ประเภท</th>
                                        <th style="text-align:right;">จำนวน</th>
                                    </tr>
                                </thead>
                                <tbody id="detail_active">
                                </tbody>
                            </table>

                        </div>
                        <span class="text-danger">*คลิกที่รายการให้เป็นแถบสีน้ำเงินเพื่อเลือกรายการ (ถ้ามีป้ายที่ใช้งานที่ต้องการทำลาย)</span>
                    </div>
                </div>
                <div class="card card-secondary">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title" id="input_title"><b>ระบุข้อมูล</b></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex" >
                            <input type="hidden" id="numrow" value=0>
                                <table id="tb_signsub" class="table ">
                                    <thead class="thead-light">
                                        <tr></tr>
                                    </thead>
                                    <tbody id="tbody_addsignsub">
                                        <tr>
                                            <td class="col-sm-5">
                                                <b>บริเวณที่จะนำไปติด</b><a href="<?php echo site_url('SignV2/sign_place_manage');?>" target="_blank"><span class="text-orange"> จัดการสถานที่ติดตั้ง</span> <small class="text-orange">(คลิกที่นี่)</small></a>
                                                <select class="form-control confirmsign_place" name="confirmsign_place" id="confirmsign_place"></select>
                                                <br>
                                                <b class="type_price_title">ประเภทราคา</b>
                                                <select name="confirmsign_type_price" class="form-control confirmsign_type_price" id="confirmsign_type_price"></select>
                                                <br>
                                                <b>หมายเหตุ</b>
                                                <input type="text" name="comment" class="form-control comment" id="comment">
                                            </td>
                                            <td class="col-sm-5">
                                                <b>จำนวนที่ต้องการ</b>
                                                <input type="number" name="confirmsign_amount" min="1" value="1" class="text-right form-control confirmsign_amount" id="confirmsign_amount">
                                                <br>
                                                <b>ขนาด</b>
                                                <select name="confirmsign_size" class="form-control confirmsign_size" id="confirmsign_size"></select>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <input type="button" class="btn  btn-block bg-primary " id="addrow_signsub"
                                                    value="เพิ่มรายการป้าย" />
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </tfoot>
                                </table>

                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>หมายเหตุเพิ่มเติม</label>
                                        <input type="text" class="form-control" name="confirmsign_comment"  id="confirmsign_comment"/>
                                        <input type="text" class="form-control hidden" name="undo_id" id="undo_id"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="confirm_destroy" id="confirm_destroy">
                                    <label >วันที่ต้องการป้าย</label>
                                    <input type="text" id="confirmsign_date"  class="form-control pointer"  placeholder="คลิกเพื่อเลือกวันที่"  name ="confirmsign_date" readonly value="<?= date('Y-m-d'); ?>" />
                                    <!-- <input type="text" id="confirmsign_date"  class="form-control pointer"  placeholder="คลิกเพื่อเลือกวันที่"  name ="confirmsign_date" readonly value="<?= date('Y-m-d'); ?>" /> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <a href="<?php echo site_url('SignV2/sign_test_print');?>"><u style="color:red;">*ตัวอย่างป้ายแต่ละแบบ</u></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-info btn-lg" id="btn_refresh"><i class="fas fa-sync-alt"></i></button>
                <button type="button"  class="btn btn-success btn-lg" id="submit_confirm">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
