
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
        "Action" => 'แผนกทำป้ายเอง ดึงข้อมูลก่อนทำ'
    );

    $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>
    <?php $this->load->view('Tools/Panel-message-1'); ?>
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h2 class="card-title">แผนกทำป้ายเอง : ดึงข้อมูลก่อนทำป้าย</h2>
                <input type="hidden" id="doit" value="1">
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
                    <div class="col-md-12">
                        <table  class="table table-hover" show-filter="true" id="sign_packing">
                            <thead>
                                <tr>
                                    <th class="text-left">รหัสสินค้า</th>
                                    <th class="text-left">ชื่อสินค้า</th>
                                    <th class="text-left">ชื่อผู้ขอทำ</th>
                                    <th class="text-center">ประเภท</th>
                                    <th class="text-center">ขนาด</th>
                                    <th class="text-center">จำนวน</th>
                                    <th class="text-center">สาเหตุ</th>
                                    <th class="text-center">ดึงข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_sign_packing">
                            </tbody>
                        </table>
                    </div>
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
        <div class="row">
            <div class="col-md-12" >
                <a href="<?php echo site_url('SignV2/depart_packing');?>"><button type="button" class="btn btn-block bg-green btn-lg">ทำป้าย</button></a>
            </div>
        </div>
    </section>
</div>

<form id="form_load_data">
    <div class="modal fade" id="load_data_modal" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">ดึงข้อมูล</h4>
                </div>
                <div class="modal-body">
                    <h4 id="title_unittype"></h4>
                    <div id="detail_item">

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">ข้อมูลจาก BC</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="show_data_itemBC"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">ข้อมูลจากจัดซื้อกรอก(หากปรับราคา)</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="show_data_itemINFO"></div>
                                </div>
                            </div>
                        </div>
                    </div>

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
