
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

<?php 
    $arrow_down = '&#129147;';
    $arrow_up = '&#129145;';
    $arrow_left = '&#129144;';
    $arrow_right = '&#129146;';

?>
<div class="content-wrapper">
    <?php 

    $data['data_breadcrumb'] = array();
    $data['data_breadcrumb'] = array(
        "Link" => 'SignV2/packing_loaddata',
        "Name" => 'ป้ายสินค้า',
        "Action" => 'เปรียบเทียบราคาในBCกับราคาใน'
    );

    $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>
    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class=" form-group">
                            <label for="">เลือกเวอร์ชั่นโปรแกรมป้าย</label>
                            <select class="form-control" id="select_sign_ver">
                                <option value="1">ป้ายV1</option>
                                <option value="2" selected>ป้ายV2</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <!-- <div class="card-header bg-olive">
                <h2 class="card-title"></h2>
            </div> -->
            <div class="card-body">
                <div class="form-group row row_export_hide">
                    <label class="col-md-2 col-form-label text-right">ค้นหาตามสินค้า</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" placeholder="จาก รหัสสินค้า และ ชื่อสินค้า" value="" id="search_str_code">
                        <span id="error_search_str_code" class="text-danger"></span>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" placeholder="ถึง รหัสสินค้า และ ชื่อสินค้า" value="" id="search_end_code">
                        <span id="error_search_end_code" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-7"></div>
                    <div class="col-md-5">
                        <button class="btn btn-block btn-primary" id="btn_process_sign"><i class="fa fa-spinner"></i> ประมวลเปรียบเทียบ</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="div_data_item">

        </div>
        <!-- <div class="card ">
            <div class="card-header bg-secondary">
                <h2 class="card-title">เลือกรูปแบบการปริ้นป้าย</h2>
            </div>
            <div class="card-body">
            </div>
        </div> -->
    </section>
</div>
