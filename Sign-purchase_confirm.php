
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
        "Action" => 'จัดซื้อยืนยันปรับราคา'
    );

    $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>
    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
        <div class="row">
            <div class="col-md-3" >
                <a href="<?php echo site_url('SignV2/purchase_add');?>"><button type="button" class="btn btn-block btn-primary">ไปหน้าเพิ่มข้อมูลป้ายสินค้า</button></a>
            </div>
        </div>
        <br>
        <div class="card card-secondary">
            <div class="card-header">
                <h2 class="card-title">ยืนยันรายการที่ปรับราคาในBCแล้ว</h2>
            </div>
            <div class="card-body">
                <div  class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> จำนวนแถวที่แสดง </label>
                            <select class="form-control" id="usersPerPage">
                                <option value="15">15 แถว</option>
                                <option value="20">20 แถว</option>
                                <option value="30">30 แถว</option>
                                <option value="50">50 แถว</option>
                                <option value="100">100 แถว</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> ค้นหาตามกลุ่มสินค้า </label>
                            <select class="form-control search_groupcode" id="search_groupcode">
                                <option value=""> ทั้งหมด </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> ค้นหาตามประเภท </label>
                            <select class="form-control search_type" id="search_type">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> ค้นหาตามขนาด </label>
                            <select class="form-control search_size" id="search_size">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <input type="hidden" class="form-control" id="pageNumber" value="0">
                            <label> ค้นหาตามเลขที่เอกสาร รหัสสินค้า หรือชื่อสินค้า </label>
                            <input type="text" class="form-control" id="search_text" >  
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="button" id="btn_selectall" class="btn btn-block btn-primary">เลือกทั้งหมด</button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="btn_confirm" class="btn btn-block btn-success hidden">ยืนยันปรับราคา</button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="btn_unconfirm" class="btn btn-block btn-danger hidden">ยกเลิกปรับราคา</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover text-nowrap" id="tb_sign">
                            <thead>
                                <tr>
                                    <th class="text-left">รหัสสินค้า</th>
                                    <th class="text-left">ชื่อสินค้า</th>
                                    <th class="text-left">สาเหตุ</th>
                                    <th class="text-left">เวลาที่บันทึก</th>
                                    <th class="text-left">วันที่จะเปลี่ยนข้อมูล</th>
                                    <th class="text-left">ผู้บันทึกข้อมูล</th>
                                    <th>จัดการ</th>
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

<div class="modal fade" id="view_modal" role="dialog">
    <div class="modal-dialog modal-xl" role="document" style="left:0%;">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" style="color:#FFF;" id="view_title"></h4>
            </div>
            <div class="modal-body">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"><b>ข้อมูลสินค้า</b></h3>
                            <input type="hidden" id="field_view_id">
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="price_row">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-info btn-lg" id="btn_refresh">รีเฟรช</button>
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
