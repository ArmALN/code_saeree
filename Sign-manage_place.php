
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
        "Action" => 'สถานที่ติดตั้ง'
    );

    $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>
    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="search_itemcode" placeholder="ค้นหารหัสสินค้า หรือ ชื่อสินค้า เพื่อเลือกสินค้าที่จะจัดการสถานที่ติดตั้ง">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="card card-success" id="place_newvertion_add">
                    <div class="card-header">
                        <h2 class="card-title" style="font-size: 24px;"> สถานที่ติดตั้งป้ายเวอร์ชั่นใหม่ </h2>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="input_add_place" placeholder="กรอกชื่อสถานที่ติดตั้ง เพื่อเพิ่มสถานที่">
                            </div>
                            <div class="col-md-3">
                                <button title="เพิ่ม" class="btn btn-block bg-green" id="btn_add_place"><i class="fa fa-plus"></i></button>
                            </div>
                            <!-- <div class="col-md-1">
                                <button title="ดึงข้อมูล" class="btn btn-block bg-blue" id="btn_loaddata_place"><i class="fa fa-download"></i></button>
                            </div>
                            <div class="col-md-1">
                                <button title="โยกข้อมูล" class="btn btn-block bg-orange" id="btn_change_place"><i class="fa fa-random"></i></button>
                            </div> -->
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 " id="place_div">
                                <!-- <select class="form-control" name="select_place" id="select_place"> 
                                </select> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card card-primary" id="item_info">
                    <div class="card-header">
                        <h2 class="card-title" style="font-size: 24px;"> ข้อมูลสินค้า </h2>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="item_info_div">
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                 
                    <input type="text" class="form-control" id="search_signdocno" placeholder="ค้นหาเลขที่เอกสารเพื่อแก้ไขสถานที่ติดตั้ง">
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-block btn-primary" id="btn_search"> <i class="fas fa-search"></i> ค้นหา</button>
            </div>
        </div>

        <div class="card card-warning hidden" id="div_place_signsub">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 24px;" id="title_place_itemcode">  รายการป้ายที่ต้องการเปลี่ยนสถานที่ติดตั้ง </h2>
            </div>
            
            <div class="card-body">
  
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">ลำดับ</th>
                                    <th class="text-left">สถานที่ติดตั้งเดิม</th>
                                    <th class="text-left">สถานที่ติดตั้งใหม่</th>
                                    <th class="text-left">ประเภทราคา</th>
                                    <th class="text-left">ขนาด</th>
                                    <th class="text-left">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody id="tb_signsub">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="card card-secondary hidden" id="place_vertion_old">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 24px;"> สถานที่ติดตั้งป้ายเวอร์ชั่นเดิม </h2>
            </div>
            
            <div class="card-body">
                <h4 id="name_item"></h4>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">ลำดับ</th>
                                    <th class="text-left">สถานที่ติดตั้ง</th>
                                    <th class="text-left">ขนาด</th>
                                    <th class="text-center">จำนวน</th>
                                </tr>
                            </thead>
                            <tbody id="tb_sign_old_list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->

    </section>
</div>
