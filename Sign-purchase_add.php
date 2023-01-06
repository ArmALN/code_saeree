
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
        "Action" => 'แผนกจัดซื้อ เพิ่มข้อมูล'
    );
    $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>

    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h2 class="card-title">แผนกจัดซื้อ : เพิ่มรายการป้ายสินค้า</h2>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label>สาเหตุ</label>
                        <div class="form-group">
                            <select class="form-control" id="sign_type">
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label >วันที่ต้องการเปลี่ยนข้อมูล</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" id="sign_date"  class="form-control pointer"  placeholder="คลิกเพื่อเลือกวันที่"  name ="sign_date" readonly value="<?= date('Y-m-d'); ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label >ผู้บันทึกข้อมูล</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="sign_creator" readonly>
                                <input type="hidden" class="form-control"  id="sign_creator_id" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-secondary card-outline hidden" id="tb_addsign_row">
            <div class="card-header">
                <h3 class="card-title">ค้นหาด้วยรหัสสินค้าหรือชื่อสินค้า</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control " id="search_itemcode" placeholder="กรอกรหัส หรือ ชื่อสินค้า เพื่อเพิ่มรายการสินค้า">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-info btn-block" id="btn_multisearch"><i class="fa fa-search"></i> เลือกหลายรายการ</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="au-card recent-report">
                            <div class="au-card-inner">

                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <strong>รายการสินค้า <span id="count_addsign">0</span> รหัส</strong>
                                    </div>
                                </div>

                                <div class="row">	
                                    <div class="col-md-12">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th width="5%" class="text-left">ลำดับ</th>
                                                    <th width="10%" class="text-left">รหัสสินค้า</th>
                                                    <th width="25%" class="text-left">ชื่อสินค้า</th>
                                                    <th width="10%" class="text-left">หน่วยนับ</th>
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
                    </div>
                </div>

            </div>
  

        </div>

        <div class="card card-info card-outline hidden" id="tb_addsign_sub_row">
            <div class="card-header">
                <h3 class="card-title">รายการสินค้า</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group hidden" id="div_changePrice">
                            <label class="checkbox-inline" style="color:red;">
                                <input type="checkbox" value="1" id="changePrice"> ปรับราคาใน BC ไปก่อนแล้ว
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="au-card recent-report">
                            <div class="au-card-inner">
                                <div class="row">	
                                    <div class="col-md-12">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th width="10%" class="text-left">รหัสสินค้า</th>
                                                    <th width="25%" class="text-left">ชื่อสินค้า</th>
                                                    <th width="25%" class="text-left">หน่วยนับ</th>
                                                    <th width="20%" class="text-right">ราคาเดิม</th>
                                                    <th width="20%" class="text-right" bgcolor="#AED6F1" >ราคาใหม่</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tb_addsign_sub">
                                            </tbody>
                                        </table>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="purchase_comment" name="purchase_comment" placeholder="กรอกหมายเหตุเพิ่มเติม">
                                        </div>
                                    </div>

                                </div>                                            
                            </div>
                        </div>
                    </div>
                </div>
                <span class="text-danger">*หากเป็นประเภทสเต็ปราคาหรือหลายหน่วยนับ โปรดบันทึกทีละรายการ</span>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" id="btn_saveone" class=" form-control btn btn-outline-success btn-block"><i class="fa fa-save"></i> บันทึกข้อมูล (ราคาเดียว)</button>
                    </div> 
                    <div class="col-md-4">
                        <button type="button" id="btn_savestep" class=" form-control btn btn-outline-success btn-block"><i class="fa fa-save"></i> บันทึกข้อมูล (สเต็ปราคา)</button>
                    </div> 
                    <div class="col-md-4">
                        <button type="button" id="btn_saveunit" class=" form-control btn btn-outline-success btn-block"><i class="fa fa-save"></i> บันทึกข้อมูล (หลายหน่วยนับ)</button>
                    </div> 
                </div>
            </div>  
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="button" id="btn_confirm_change" class="form-control btn btn-primary btn-block">ยืนยันปรับราคา</button>
            </div>
        </div>

	</div>
    </section>
</body>

<div class="modal fade" id="item_Modal" role="dialog">
    <div class="modal-dialog modal-xl" role="document" style="left:0%;">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" style="color:#FFF;"><b>ค้นหาสินค้า</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <input type="text" class="form-control" id="search_listitem" placeholder="ค้นหาด้วยรหัสสินค้าหรือชื่อสินค้า">
                        </div>
                        <div style="overflow-y: auto; height: 600px;">
                            <table id="tb_item" class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th  width="10%" style="text-align:left;">รหัสสินค้า</th>
                                        <th  width="20%" style="text-align:left;">ชื่อสินค้า</th>
                                        <th  width="30%" style="text-align:left;">ชื่ออ้างอิง</th>
                                        <th  width="10%" style="text-align:center;">หน่วยนับ</th>
                                    </tr>
                                </thead>
                                <tbody id="tb_itemlist">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-success" id="select_item_submit">ตกลง</button>
                <button type="button" class="btn " data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

