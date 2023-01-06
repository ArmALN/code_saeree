<head>

    <script src="<?= base_url('assets/jquery-form/dist/jquery.form.min.js')?>"></script>
    <script src="<?= base_url('assets/jquery-validation/dist/jquery.validate.js')?>"></script>
    <script src="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js')?>"></script>
    <script src="<?= base_url('assets/plugins/select2/select2.min.js')?>"></script>
    <script src="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.js')?>"></script>

    <link rel="stylesheet" href="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css')?>">
    <link href="<?= base_url('assets/css/style.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.css')?>">

    <style>
        .ui-widget-content {
            border: none;
        }

        /* .select2-selection__choice {
            width: 150px;
            text-align: center;
        } */

        .select2-container .select2-selection--single {
            height: 34px;
        }

        .select2-selection__choice__remove {
            float: right;
        }

        .select2 {
            width: 100% !important;
        }

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

        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 0px 0;
            border-radius: 4px;
        }

        button.active {
            color: #000;
            cursor: default;
            background-color: #d2d6de;
            border-color: #d2d6de;
        }

        .ui-autocomplete {
            z-index: 2147483647;
        }

        .ui-widget-content {
            border: none;
        }
    </style>

</head>

<section class="content-header ">
    <?php $this->Function_model->BREADCRUMB(array('หน้าแรก' => base_url(),'ใบสั่งผลิต - ใบสั่งซ่อม' => base_url('index.php/Request_production'),'หัวข้อการซ่อม' => '')); ?>
    <h1 class="Sarabun-Regular">
        รายการหัวข้อการซ่อม
    </h1>
</section>

<section class="content ">

    <div class="row ">
        <div class="col-md-6">
            <div class="form-group">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control pull-right" placeholder="ค้นหา หัวข้อการซ่อม"
                                    id="search_text">
                                <div class="input-group-btn">
                                    <button class="btn bg-gray"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-solid ">
                    <div class="box-body ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <input type="hidden" id="pageNumber" value="0">
                                        <input type="hidden" id="usersPerPage" value="10">
                                        <table id="" class=" table ">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-left" colspan="3"><small
                                                            class="label bg-gray">1</small> หัวข้อการซ่อม</th>
                                                </tr>
                                            </thead>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-left">หัวข้อการซ่อม</th>
                                                    <!-- <th class="text-center">รหัส</th>
                                                    <th class="text-left">ชื่อหัวข้อการซ่อม</th>
                                                    <th class="text-left">รายละเอียด</th> -->
                                                    <th class="text-left">เครื่องมือ</th>
                                                </tr>
                                            </thead>
                                            <tbody id="data_fixitem">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination"></ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="button" class="btn bg-green pull-right" id="btn_add">
                                        เพิ่มหัวข้อการซ่อม
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" name="">

            <div class="row row_add_sub" id="row_add_sub">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <div class="box box-solid ">
                            <div class="box-body ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <table id="" class=" table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th colspan="3"> <small class="label bg-gray">2</small>
                                                            หัวข้อการซ่อมย่อย</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">ID</th>
                                                        <th class="text-left">หัวข้อการซ่อมย่อย</th>
                                                        <th class="text-left">เครื่องมือ</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="data_fixitem_sub">
                                                    <tr>
                                                        <td class="text-left" colspan="3">ไม่มีข้อมูล</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn bg-green pull-right" id="btn_add_sub">
                                            เพิ่มหัวข้อการซ่อมย่อย
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row row_add_history" id="row_add_history">
                <div class="col-md-12" id="" name="">
                    <div class="form-group">
                        <div class="box box-solid ">
                            <div class="box-body ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <table id="" class=" table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th colspan="3"> <small class="label bg-gray">3</small>
                                                            ประวัติการซ่อมในระบบสั่งซ่อม</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-left">รายการ</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="data_fixhistory">
                                                    <tr>
                                                        <td class="text-left" colspan="2">ไม่มีข้อมูล</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn bg-blue pull-right" id="btn_add_history">
                                            เพิ่มใบสั่งซ่อมในหัวข้อการซ่อม
                                        </button>
                                    </div>
                                </div>
                                <!-- <div class="row">
                            <div class="col-md-12">
                                <span>หมายเหตุ
                                    *การย้ายใบสั่งซ่อมได้ก็ต่อเมื่อสถานะ<b>รอผู้บริหารอนุมัติ</b>เท่านั้น</span>
                            </div>
                        </div> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>




    </div>

    <div class="modal fade" id="addModal" role="dialog" data-toggle="modal" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog" role="document" style="left:0%;">
            <div class="modal-content ">
                <div class="modal-header bg-green">
                    <h4 class="modal-title Sarabun-Regular ">เพิ่มหัวข้อการซ่อม</h4>
                </div>

                <div class="modal-body">

                    <input type="hidden" id=add_type value="add" readonly>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>แหล่งข้อมูล </label>
                                        <select class="form-control search_database" id="add_search_database">
                                            <option value="">เลือกแหล่งข้อมูล</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> รหัส </label>
                                        <input type="text" class="form-control" id="add_field_code"
                                            placeholder="กรุณากรอกข้อมูล รหัส">
                                        <small>* รหัสเลขที่โครงการ / รหัสแผนก</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> ชื่อหัวข้อการซ่อม </label>
                                        <input type="text" class="form-control" id="add_field_name"
                                            placeholder="กรุณากรอกข้อมูล ชื่อหัวข้อการซ่อม">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> รายละเอียด </label>
                                        <input type="text" class="form-control" id="add_field_detail"
                                            placeholder="กรุณากรอกข้อมูล รายละเอียด">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn bg-green" id="btn_add_submit">บันทึก</button>
                    <button type="button" class="btn" onclick="javascript:clear_input_add()"
                        data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" role="dialog" data-toggle="modal" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog" role="document" style="left:0%;">
            <div class="modal-content ">
                <div class="modal-header bg-orange">
                    <h4 class="modal-title Sarabun-Regular">แก้ไขหัวข้อการซ่อม</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id=edit_type value="edit" readonly>

                    <input type="hidden" id=edit_field_id readonly>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>แหล่งข้อมูล </label>
                                <select class="form-control search_database" id="edit_search_database">
                                    <option value="">เลือกแหล่งข้อมูล</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> รหัส </label>
                                <input type="text" class="form-control" id="edit_field_code"
                                    placeholder="กรุณากรอกข้อมูล รหัส">
                                <small>* รหัสเลขที่โครงการ / รหัสแผนก</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> ชื่อหัวข้อการซ่อม </label>
                                        <input type="text" class="form-control" id="edit_field_name"
                                            placeholder="กรุณากรอกข้อมูล ชื่อหัวข้อการซ่อม">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>รายละเอียด</label>
                                        <input type="text" class="form-control" id="edit_field_detail"
                                            placeholder="กรุณากรอกข้อมูล รายละเอียด">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="btn_edit_submit" class="btn bg-orange">บันทึก</button>
                    <button type="button" class="btn" onclick="javascript:clear_input_edit()"
                        data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addsubModal" role="dialog" data-toggle="modal" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog" role="document" style="left:0%;">
            <div class="modal-content ">
                <div class="modal-header bg-green">
                    <h4 class="modal-title Sarabun-Regular ">เพิ่มหัวข้อการซ่อมย่อย</h4>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="add_sub_field_fixitem_id" readonly>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> ชื่อหัวข้อการซ่อมย่อย </label>
                                        <input type="text" class="form-control" id="add_sub_field_name"
                                            placeholder="กรุณากรอกข้อมูล ชื่อหัวข้อการซ่อมย่อย">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> รายละเอียด </label>
                                        <input type="text" class="form-control" id="add_sub_field_detail"
                                            placeholder="กรุณากรอกข้อมูล รายละเอียด">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn bg-green" id="btn_add_sub_submit">บันทึก</button>
                    <button type="button" class="btn" onclick="javascript:clear_input_add_sub()"
                        data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editsubModal" role="dialog" data-toggle="modal" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog" role="document" style="left:0%;">
            <div class="modal-content ">
                <div class="modal-header bg-orange">
                    <h4 class="modal-title Sarabun-Regular">แก้ไขหัวข้อการซ่อมย่อย</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="edit_sub_field_id" readonly>
                    <input type="hidden" id="edit_sub_field_fixitem_id" readonly>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> ชื่อหัวข้อการซ่อมย่อย </label>
                                        <input type="text" class="form-control" id="edit_sub_field_name"
                                            placeholder="กรุณากรอกข้อมูล ชื่อหัวข้อการซ่อมย่อย">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> รายละเอียด </label>
                                        <input type="text" class="form-control" id="edit_sub_field_detail"
                                            placeholder="กรุณากรอกข้อมูล รายละเอียด">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" id="btn_edit_sub_submit" class="btn bg-orange">บันทึก</button>
                    <button type="button" class="btn" onclick="javascript:clear_input_edit_sub()"
                        data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addhistoryModal" role="dialog" data-toggle="modal" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog" role="document" style="left:0%;">
            <div class="modal-content ">
                <div class="modal-header bg-blue">
                    <h4 class="modal-title Sarabun-Regular">เพิ่มใบสั่งซ่อมในหัวข้อการซ่อม</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="addhistory_field_id" readonly>
                    <input type="hidden" id="addhistory_field_fixitem_id" readonly>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> เลขที่เอกสาร </label>
                                        <input type="text" class="form-control" id="addhistory_field_ids"
                                            placeholder="กรุณากรอกข้อมูล เลขที่เอกสาร">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="btn_add_history_submit" class="btn bg-blue">บันทึก</button>
                    <button type="button" class="btn" onclick="javascript:clear_input_add_history()"
                        data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

</section>