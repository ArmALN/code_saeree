<head>

    <script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js')?>"></script>

    <link href="<?= base_url('assets/css/style.css');?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css')?>" >

    <title>รายการตรวจสอบ การติดตั้งป้ายสินค้า</title>

    <?php 
        $thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
        $thaiweek=array("วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัสบดี","วันศุกร์","วันเสาร์");
    ?>

    <style media="all">

        .fonts_SarabunPSK {
            font-size: 12px;
        }
       
        @font-face {font-family: Sarabun-Regular;src: url(<?= base_url('assets/fonts/Sarabun-Regular.ttf')?>);}
        .Sarabun-Regular{font-family: Sarabun-Regular;font-size: 12px;}
        .center-table{
            /* width: 80px; */
            vertical-align: middle;
            text-align: center;
        }

        .right-table{
            /* width: 80px; */
            vertical-align: middle;
            text-align: right;
        }

        .topic-font{
            font-size: 12px;
        }

        .bg{
            background-color: #D5F5E3;
        }

        .table-bordered>tbody>tr>td, 
        .table-bordered>tbody>tr>th, 
        .table-bordered>tfoot>tr>td, 
        .table-bordered>tfoot>tr>th, 
        .table-bordered>thead>tr>td, 
        .table-bordered>thead>tr>th{
            border: 1px solid #000;
            padding: 5px;
            line-height: 1.42857143;
            vertical-align: middle;
            border-bottom: 1px solid #000;
            /* border-top: 1px solid #000; */
            border-collapse: collapse;
        }

        @media print{
        .table-bordered>tbody>tr>td,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>td,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>thead>tr>th {
            border: 1px solid #000 !important;
            padding: 5px !important;
            line-height: 1.42857143 !important;
            vertical-align: middle !important;
            /* border-bottom: 1px solid #000 !important; */
            /* border-top: 1px solid #000 !important; */
            border-collapse: collapse !important;
        }

        .bg{
            background-color: #D5F5E3 !important;
        }

        .center-table{
        vertical-align: middle !important;
        text-align: center !important;
        }

        .right-table{
        vertical-align: middle !important;
        text-align: right !important;
        }

        .topic-font{
        font-size: 12px !important;
        }

        @media print{
            @page {size: A4 landscape; }
        }
    
        }


    </style>    

    <script>
        window.onload = function(){
            window.print();
            setTimeout(function(){window.close();}, 1);
        } 
    </script>

</head>

<body class="Sarabun-Regular">
    <div style="background:white; margin:1px; padding:1px;">
        <div  class="row ">
            <div class="col-md-12">
            
                    <table  class="table table-bordered Sarabun-Regular">
                        
                        <thead>
                            <tr>
                                <td style="background-color:#F7DC6F" colspan="7" class="center-table topic-font">
                                    รายการตรวจสอบ การติดตั้งป้ายสินค้า
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" class="left-table topic-font">
                                    <b>รหัสสินค้า </b><?= $Sign['field_itemcode']?> / <?= $Sign['field_itemname']?>  )
                                    <br>
                                    <b>ผู้ติดตั้ง </b><?= $Sign['setup_firstname']?>  (<?= $Sign['setup_nickname']?>)</b>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="width:3%;"><b>ลำดับ</b></td>
                                <td align="center" style="width:15%;"><b>บริเวณที่ติดตั้ง</b></td>
                                <td align="center" style="width:7%;"><b>ขนาดป้าย</b></td>
                                <td align="center" style="width:7%;"><b>ประเภทป้าย</b></td>
                                <td align="center" style="width:12%;"><b>จำนวนป้าย</b></td>
                                <td align="center" style="width:12%;"><b>การตรวจสอบ</b></td>   
                                <td align="center" style="width:12%;"><b>ผู้ตรวจสอบ</b></td>   
                            </tr>
                        </thead>

                        <tbody>
                            <?php  $row_no = 0; foreach($SignSub as $item) { $row_no++; ?>
                                <tr>
                                    <td style="text-align:center;"><?= $row_no ?></td>
                                    <td style="text-align:center;"><?= $item['field_place_name'] ?></td>
                                    <td style="text-align:center;"><?= $item['type_name_price'] ?></td>
                                    <td style="text-align:center;"><?= $item['size_name'] ?></td>

                                    <td style="text-align:center;"><?= $item['field_signamount'] ?></td>
                                    <td style="text-align:center;"></td>
                                    <td style="text-align:center;"></td>
                                </tr>
                            <?php }  ?>
                        </tbody>

                    </table>
                    <b>ตรวจสอบความถูกต้องของป้าย ทำเครื่องหมาย &#10003; หากข้อมูลถูกต้อง</b>
                    <table class="Sarabun-Regular">
                        <tr >
                            <td width="25%">
                                <div class="form-group">
                                    <div class="checkbox">
                                            <label><input type="checkbox" name="remember"> สถานที่ติดตั้ง</label>
                                    </div>
                                </div>
                            </td>
                            <td width="25%">
                                <div class="form-group">
                                    <div class="checkbox">
                                            <label><input type="checkbox" name="remember"> ขนาดป้าย</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr >
                            <td width="25%">
                                <div class="form-group">
                                    <div class="checkbox">
                                            <label><input type="checkbox" name="remember"> ประเภทป้าย</label>
                                    </div>
                                </div>
                            </td>
                            <td width="25%">
                                <div class="form-group">
                                    <div class="checkbox">
                                            <label><input type="checkbox" name="remember"> จำนวนป้าย</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr >
                            <td width="25%">
                                <div class="form-group">
                                    <div class="checkbox">
                                            <label><input type="checkbox" name="remember"> ราคา</label>
                                    </div>
                                </div>
                            </td>
                            <td width="25%">
                                <div class="form-group">
                                    <div class="checkbox">
                                            <label><input type="checkbox" name="remember"> หน่วยนับ</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr >
                            <td width="25%">
                                <div class="form-group">
                                    <div class="checkbox">
                                            <label><input type="checkbox" name="remember"> ติดตั้งป้ายตรงตัวสินค้า</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <!-- <div class="row">
                        <div class="form-group">        
                            <div class="col-md-2 ">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="remember"> สถานที่ติดตั้ง</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 ">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="remember"> ขนาดป้าย</label>
                                </div>
                            </div>
                        </div>
                    </div>
                     -->

                
                
            </div>
        </div>      
        </div>    
        <!-- <b>ผู้พิมพ์ :  </b>  <?=$_SESSION[saeree_name] ?> -->
        <b>วันที่พิมพ์ : </b><?php echo $thaiweek[date("w")] ,"ที่",date(" j "), $thaimonth[date(" m ")-1] , " พ.ศ. ",date(" Y ")+543, date(" H:i:s"); ?>
</body>