
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
        "Action" => 'แผนก เพิ่มข้อมูลขอทำ'
    );

    $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>
    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
    <div class="row">
        <div class="col-md-3" >
            <a href="<?php echo site_url('SignV2/depart_confirm');?>"><button type="button" class="btn btn-block btn-primary">ไปหน้าขอทำป้าย</button></a>
        </div>
    </div>
    <br>
        <div class="card card-secondary">
            <div class="card-header">
                <h2 class="card-title">แผนก : เพิ่มรายการป้ายสินค้า</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>สาเหตุ</label>
                            <select class="form-control" id="sign_type">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >ผู้บันทึกข้อมูล</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="sign_creator" readonly="">
                                <input type="hidden" class="form-control" id="sign_creator_id" readonly="" value="2270">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="checkbox-inline text-danger" >
                                <input type="checkbox" value="1" id="doit_yourself"> ต้องการทำป้ายเอง
                            </label>
                        </div>
                    </div>
				</div>
                <form id="formData_save">
                    <div class="row hidden" id="tb_addsign_row">
                        <div class="col-md-12">
                            <div class="card card-info card-outline ">
                                <div class="card-header">
                                    <h2 class="card-title">รายการสินค้าทั้งหมด <span id="count_addsign">0</span> รายการ <b class="text-danger" id="unit_code_type"></b></h2>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control " id="search_itemcode" placeholder="กรอกรหัส หรือ ชื่อสินค้า เพื่อเพิ่มรายการสินค้า">
                                        <input type="hidden" id="item_code_select">
                                        <input type="hidden" id="input_select_type_price">
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">ลำดับ</th>
                                                <th width="30%" class="text-left">รหัสสินค้า</th>
                                                <th width="30%" class="text-left">ชื่อสินค้า</th>
                                                <th width="5%" class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb_addsign">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row hidden" id="confirm_manage_row">
                        <div class="col-md-7">
                            <div class="card card-primary card-outline ">
                                <div class="card-header">
                                    <input type="hidden" name="" id="detail_typeitem">
                                    <h2 class="card-title">ระบุจุดที่ต้องการนำไปติด <a href="<?php echo site_url('SignV2/sign_place_manage');?>" target="_blank"><span class="text-orange"> จัดการสถานที่ติดตั้ง</span> <small class="text-orange">(คลิกที่นี่)</small></a></h2>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex" >
                                        <input type="hidden" id="numrow" value=0>
                                        <table id="tb_signsub" class="table text-nowrap">
                                            <thead class="thead-light">
                                                <tr></tr>
                                            </thead>
                                            <tbody id="tbody_addsignsub">
                                                <tr>
                                                    <td class="col-sm-5">
                                                        <b>บริเวณที่จะนำไปติด</b><small> หากไม่มีสถานที่ให้ไปเพิ่มที่ จัดการสถานที่ติดตั้งป้าย</small>
                                                        <select class="form-control confirmsign_place" name="confirmsign_place" id="confirmsign_place"></select>
                                                        <br>
                                                        <b class="type_price">ประเภทราคา</b>
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
                        <div class="col-md-5">
                            <div class="card card-danger card-outline ">
                                <div class="card-header">
                                    <h2 class="card-title">ป้ายที่ใช้งาน <span id="count_active">0</span> ป้าย <small class="text-red"> เลือกป้ายที่ต้องการทำลาย</small></h2>
                                </div>
                                <div class="card-body">
                                    <table id="tb_active_sign" class="table table-hover">
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
                                <div class="card-footer">
                               
                                </div>
                            </div>
                            <button type="button" class="btn btn-block btn-success btn-lg" id="submit_confirm"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
