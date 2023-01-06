
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
        "Action" => 'ตรวจสอบข้อมูลยืนยันทำ'
    );

    $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>
    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
        <div class="card">
            <div class="card-header bg-olive">
                <h2 class="card-title">เลือกรูปแบบการปริ้นป้าย</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group ">
                            <label class="text-danger" for="">เลือกรูปแบบกระดาษ</label>
                                <select name="A4" id="A4" class="form-control">
                                    <option value="A4">A4 แนวตั้ง</option>
                                    <option value="A4-L">A4 แนวนอน</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="text-danger" for="">*เลือกเส้นทางลูกศร(เฉพาะโกดัง)</label>
                            <select name="arrow" id="arrow" class="form-control">
                                <option value="arrow_down">ลูกศรชี้ลง</option>
                                <option value="arrow_up">ลูกศรชี้ขึ้น</option>
                                <option value="arrow_left">ลูกศรชี้ซ้าย</option>
                                <option value="arrow_right">ลูกศรชี้ขวา</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="text-danger" for="">*เลือกรูปแบบการเรียง</label>
                            <select name="orderby" id="orderby" class="form-control">
                                <option value="">ซ้าย->ขวา</option>
                                <option value="2">บน->ล่าง</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="text-danger" for="">*รายละเอียดเพิ่มเติม(เฉพาะโกดัง)</label>
                            <input class="form-control" type="text" id="detail" name="detail">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <button type="button" id="print_sign"  class="btn btn-lg btn-success btn-block Sarabun-Regular">ปริ้นป้าย</button>
                        </div> 
                        <!-- <div class="form-group">
                            <button type="button" class="btn btn-lg bg-green btn-block Sarabun-Regular" id="btn_export"> DOWNLOAD EXCEL </button>
                        </div>  -->
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <button type="button" id="print_sign_preview"  class="btn btn-lg btn-primary btn-block Sarabun-Regular">PREVIEW</button>
                        </div> 
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
