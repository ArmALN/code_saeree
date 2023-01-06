<head>
    <!-- 
    <script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js')?>"></script>

    <link href="<?= base_url('assets/css/style.css');?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css')?>" > 
    <!-- <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet"> -->
    <title>ปริ้นป้าย</title>
    <?php 
        $thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
        $thaiweek=array("วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัสบดี","วันศุกร์","วันเสาร์");
    ?>
    <style>
        table {
            border-collapse: collapse;
        }
        
        .itemname {
            font-size: 20px;
        }

        .right {
            float: right;
        }

        .c {
            vertical-align: text-bottom;
        }

        .vertical-center {
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .bg-img-size1 {
            background-image: url(<?= base_url('assets/images/sk_model.png');
            ?>);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: 105% 110%;
            background-size: 900px 900px;
        }

        .bg-img-size2 {
            background-image: url(<?= base_url('assets/images/sk_model.png');
            ?>);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: 105% 110%;
            background-size: 600px 600px;
        }

        .bg-img-size8 {
            background-image: url(<?= base_url('assets/images/sk_model.png');
            ?>);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: 105% 110%;
            background-size: 400px 400px;
        }

        .bg-img-size3 {
            background-image: url(<?= base_url('assets/images/sk_model.png');
            ?>);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: 105% 110%;
            background-size: 400px 400px;
        }

        .bg-stock {
            background: RoyalBlue;
            color: #FFF;
        }

        .bg-stock5 {
            background: RoyalBlue;
            text-rotate: 90;
            color: #FFF;
        }

        .row {
            margin: 10px 0px 0px 0px !important;
            padding: 0px !important;
        }

        /* .col-p-1{width: 7.83333333%!important;}
        .col-p-2{width: 16.16666667%!important;}
        .col-p-3{width: 24.5%!important;}
        .col-p-4{width: 32.83333333%!important;}
        .col-p-5{width: 41.16666667%!important;}
        .col-p-6{width: 49.5%!important;}
        .col-p-7{width: 57.83333333%!important;}
        .col-p-8{width: 66.16666667%!important;}
        .col-p-9{width: 74.5%!important;}
        .col-p-10{width: 82.83333333%!important;}
        .col-p-11{width: 91,16666666%!important;}
        .col-p-12{width: 99.5%!important;} */

        .div1 {
            float: left;
            padding: 10px;
            border: 3px solid #73AD21;
        }

        .div2 {
            padding: 10px;
            border: 3px solid red;
        }


        .col-md-1,
        .col-ml-6,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-10,
        .col-md-11,
        .col-md-12 {
            float: left;
        }

        .col-md-12 {
            width: 100%;
        }

        .col-md-11 {
            width: 91.66666667%;
        }

        .col-md-10 {
            width: 83.33333333%;
        }

        .col-md-9 {
            width: 75%;
        }

        .col-md-8 {
            width: 66.66666667%;
        }

        .col-md-7 {
            width: 58.33333333%;
        }

        .col-md-6 {
            width: 50%;
        }
        .col-ml-6 {
            width: 49%;
        }

        .col-md-5 {
            width: 41.66666667%;
        }

        .col-md-4 {
            width: 32%;
        }

        .col-md-3 {
            width: 25%;
        }

        .col-md-2 {
            /* width: 16.66666667%; */
            width: 16.66666667%;
        }

        .col-md-1 {
            width: 8.33333333%;
        }

        .col-md-pull-12 {
            right: 100%;
        }

        .col-md-pull-11 {
            right: 91.66666667%;
        }

        .col-md-pull-10 {
            right: 83.33333333%;
        }

        .col-md-pull-9 {
            right: 75%;
        }

        .col-md-pull-8 {
            right: 66.66666667%;
        }

        .col-md-pull-7 {
            right: 58.33333333%;
        }

        .col-md-pull-6 {
            right: 50%;
        }

        .col-md-pull-5 {
            right: 41.66666667%;
        }

        .col-md-pull-4 {
            right: 33.33333333%;
        }

        .col-md-pull-3 {
            right: 25%;
        }

        .col-md-pull-2 {
            right: 16.66666667%;
        }

        .col-md-pull-1 {
            right: 8.33333333%;
        }

        .col-md-pull-0 {
            right: auto;
        }

        .col-md-push-12 {
            left: 100%;
        }

        .col-md-push-11 {
            left: 91.66666667%;
        }

        .col-md-push-10 {
            left: 83.33333333%;
        }

        .col-md-push-9 {
            left: 75%;
        }

        .col-md-push-8 {
            left: 66.66666667%;
        }

        .col-md-push-7 {
            left: 58.33333333%;
        }

        .col-md-push-6 {
            left: 50%;
        }

        .col-md-push-5 {
            left: 41.66666667%;
        }

        .col-md-push-4 {
            left: 33.33333333%;
        }

        .col-md-push-3 {
            left: 25%;
        }

        .col-md-push-2 {
            left: 16.66666667%;
        }

        .col-md-push-1 {
            left: 8.33333333%;
        }

        .col-md-push-0 {
            left: auto;
        }

        .col-md-offset-12 {
            margin-left: 100%;
        }

        .col-md-offset-11 {
            margin-left: 91.66666667%;
        }

        .col-md-offset-10 {
            margin-left: 83.33333333%;
        }

        .col-md-offset-9 {
            margin-left: 75%;
        }

        .col-md-offset-8 {
            margin-left: 66.66666667%;
        }

        .col-md-offset-7 {
            margin-left: 58.33333333%;
        }

        .col-md-offset-6 {
            margin-left: 50%;
        }

        .col-md-offset-5 {
            margin-left: 41.66666667%;
        }

        .col-md-offset-4 {
            margin-left: 33.33333333%;
        }

        .col-md-offset-3 {
            margin-left: 25%;
        }

        .col-md-offset-2 {
            margin-left: 16.66666667%;
        }

        .col-md-offset-1 {
            margin-left: 8.33333333%;
        }

        .col-md-offset-0 {
            margin-left: 0%;
        }

        .visible-xs {
            display: none !important;
        }

        .hidden-xs {
            display: block !important;
        }

        table.hidden-xs {
            display: table;
        }

        tr.hidden-xs {
            display: table-row !important;
        }

        th.hidden-xs,
        td.hidden-xs {
            display: table-cell !important;
        }

        .hidden-xs.hidden-print {
            display: none !important;
        }

        .hidden-sm {
            display: none !important;
        }

        .visible-sm {
            display: block !important;
        }

        table.visible-sm {
            display: table;
        }

        tr.visible-sm {
            display: table-row !important;
        }

        th.visible-sm,
        td.visible-sm {
            display: table-cell !important;
        }


        .form-group {
            margin-bottom: $form-group-margin-bottom;
        }

        /* _forms.scss:284 */
        .form-group {
            display: flex;
            flex: 0 0 auto;
            flex-flow: row wrap;
            align-items: center;
            margin-bottom: 0;
        }

        .text-center {
            text-align: center !important;
        }
    </style>
</head>

<body>
    <?php 


            // $code = "000001";//รหัส Barcode ที่ต้องการสร้าง
            // echo $generator->getBarcode($code , $generator::TYPE_CODE_128,$border,$height);
            // echo $code ;
            // echo "<hr>";
        foreach ($sign as $val) {
            foreach($val as $val2){
                // if (fmod($val2['field_price1']) !== 0.00) {
                //     print_r($val2['field_price1']);
                // }
                $price1 =  number_format($val2['field_price1']);
                $price2 =  number_format($val2['field_price2']);
                $price3 =  number_format($val2['field_price3']);
                $price4 =  number_format($val2['field_price4']);
                $price5 =  number_format($val2['field_price5']);

                $new_price1 =  number_format($val2['field_new_price1']);
                $new_price2 =  number_format($val2['field_new_price2']);
                $new_price3 =  number_format($val2['field_new_price3']);
                $new_price4 =  number_format($val2['field_new_price4']);
                $new_price5 =  number_format($val2['field_new_price5']);


                if (fmod($val2['field_new_price1'],1) !== 0.00) {
                    $new_price1 = number_format($val2['field_new_price1'],2);
                }
                if (fmod($val2['field_new_price2'],1) !== 0.00) {
                    $new_price2 = number_format($val2['field_new_price2'],2);
                }
                if (fmod($val2['field_new_price3'],1) !== 0.00) {
                    $new_price3 = number_format($val2['field_new_price3'],2);
                }
                if (fmod($val2['field_new_price4'],1) !== 0.00) {
                    $new_price4 = number_format($val2['field_new_price4'],2);
                }
                if (fmod($val2['field_new_price5'],1) !== 0.00) {
                    $new_price5 = number_format($val2['field_new_price5'],2);
                }
                
                if (fmod($val2['field_price1'],1) !== 0.00) {
                    $price1 = number_format($val2['field_price1'],2);
                }
                if (fmod($val2['field_price2'],1) !== 0.00) {
                    $price2 = number_format($val2['field_price2'],2);
                }
                if (fmod($val2['field_price3'],1) !== 0.00) {
                    $price3 = number_format($val2['field_price3'],2);
                }
                if (fmod($val2['field_price4'],1) !== 0.00) {
                    $price4 = number_format($val2['field_price4'],2);
                }
                if (fmod($val2['field_price5'],1) !== 0.00) {
                    $price5 = number_format($val2['field_price5'],2);
                }
                // ?>
    <?php
               $count_str = utf8_strlen($val2['field_itemname']);
               $date_year = date(" Y ")+543; 
               $code = $val2['field_barcode']; 
                //ป้ายหน้าชั้น ราคาเดียว
                if ($val2['field_signsize'] == '4' && $val2['field_type_sign_price'] == '1') {
                    if ($count_str <= 20) {
                        $font_size = "font-size:22 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:21 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:20 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:19 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:18 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:17 px;";
                    }
                    // # code...$val2['field_signamount']
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <!-- <div class="row"> -->
                        <div class="col-md-6">
                        <div class="col-md-11" style="padding:5px;">
                            <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                <tr>
                                    <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                            height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                    <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                        rowspan="2" colspan="2" class="itemname">
                                        <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                    </td>
                                </tr>
                                <tr>

                                    <td rowspan="2" width="4cm"
                                        style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                        <br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                        <p><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="padding-bottom:5px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="5cm" colspan="2"
                                        style="text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <h1> <?php echo $price1.".-/".$val2['field_unitcode1']; ?> </h1>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </div>
                        <!-- </div> -->

                        <?php
                    }
                }
                //A4 ราคาเดียว
                // elseif ($val2['field_type_sign_price'] == '1') {
                elseif ($val2['field_signsize'] == '1' && $val2['field_type_sign_price'] == '1') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์

                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>

                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="360px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <div height="100px" style="padding-left:100px;text-align:left;">
                                <span
                                    style="text-align:left;font-size:120 px;color:IndianRed;"><?php echo $price1." .- / "; ?></span>
                                    <span
                                    style="text-align:left;font-size:80 px;color:IndianRed;"><?php echo $val2['field_unitcode1']; ?></span>
                            </div>
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }
                //8ส่วนA4 ราคาเดียว
                elseif ($val2['field_signsize'] == '17' && $val2['field_type_sign_price'] == '1') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:40 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:35 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:30 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:22 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:20 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                         ?>
                                              <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                 <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                             </div> -->
                        <div class="col-md-6">
                            <div class="bg-img-size8" height="50px"
                                style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                                <div height="110px" style="padding-top:10px;line-height: 1.2;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                    <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                                </div>
                                <div height="50px" style="padding-left:25px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:40 px;color:IndianRed;"><?php echo $price1." .- / "; ?></span>
                                        <span
                                        style="text-align:left;font-size:25 px;color:IndianRed;"><?php echo $val2['field_unitcode1']; ?></span>
                                </div>
                            </div>
                            <div height="40px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:20px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="175px" style="padding:10px">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.7"
                                                height="1.5" /><br>
                                            <p style="font-size:13;"><?php echo $val2['field_barcode']; ?></p>

                                        </td>
                                        <td width="175px" style="padding:10px">
                                            <p style="font-size:16px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:13px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="150px" style="padding:10px">
                                            <img height="25px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                                        <?php
                    }
                     
                }

                //8ส่วนA4 หลายหน่วยนับ
                elseif ($val2['field_signsize'] == '17' && $val2['field_type_sign_price'] == '3') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:33 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:28 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:22 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:20 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                                <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                    <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                                </div> -->
                        <div class="col-md-6">
                            <div class="bg-img-size8" height="50px"
                                style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                                <div height="80px" style="padding-top:10px;line-height: 1.2;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                    <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                                </div>
                                <?php if ($val2['field_price3'] != 0) { ?>
                                <div height="45px" style="padding-left:25px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:22 px;color:IndianRed;"><?php echo $price1." .- / "; ?></span>
                                        <span
                                        style="text-align:left;font-size:20 px;color:IndianRed;"><?php echo $val2['field_unitcode1']; ?></span>
                                </div>
                                <div height="45px" style="padding-left:25px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:22 px;color:IndianRed;"><?php echo $price2." .- / "; ?></span>
                                        <span
                                        style="text-align:left;font-size:20 px;color:IndianRed;"><?php echo $val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?></span>
                                </div>
                                <?php } ?> 
                                <?php if ($val2['field_price3'] == 0) { ?>
                                    <div height="30px" style="padding-left:25px;text-align:left;">
                                        <span
                                            style="text-align:left;font-size:16 px;color:IndianRed;"><?php echo $price1." .- / "; ?></span>
                                            <span
                                            style="text-align:left;font-size:14 px;color:IndianRed;"><?php echo $val2['field_unitcode1']; ?></span>
                                    </div>
                                    <div height="30px" style="padding-left:25px;text-align:left;">
                                        <span
                                            style="text-align:left;font-size:16 px;color:IndianRed;"><?php echo $price2." .- / "; ?></span>
                                            <span
                                            style="text-align:left;font-size:14 px;color:IndianRed;"><?php echo $val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?></span>
                                    </div>
                                    <div height="30px" style="padding-left:25px;text-align:left;">
                                        <span
                                            style="text-align:left;font-size:16 px;color:IndianRed;"><?php echo $price3." .- / "; ?></span>
                                            <span
                                            style="text-align:left;font-size:14 px;color:IndianRed;"><?php echo $val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?></span>
                                    </div>
                                <?php } ?> 
                            </div>
                            <div height="40px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:20px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="175px" style="padding:10px">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.7"
                                                height="1.5" /><br>
                                            <p style="font-size:13;"><?php echo $val2['field_barcode']; ?></p>

                                        </td>
                                        <td width="175px" style="padding:10px">
                                            <p style="font-size:16px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:13px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="150px" style="padding:10px">
                                            <img height="25px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                                        <?php
                    }
                        
                }

                //8ส่วนA4 ปรับราคาเดียว
                elseif ($val2['field_signsize'] == '17' && $val2['field_type_sign_price'] == '5') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:35 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:30 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:20 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:18 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:16 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                                                <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                    <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                                </div> -->
                        <div class="col-md-6">
                            <div class="bg-img-size8" height="50px"
                                style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                                <div height="110px" style="padding-top:10px;line-height: 1.2;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                    <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                                </div>
                                <div height="50px" style="padding-left:25px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:40 px;color:IndianRed;"><?php echo $new_price1." .- / "; ?></span>
                                        <span
                                        style="text-align:left;font-size:25 px;color:IndianRed;"><?php echo $val2['field_unitcode1']; ?></span>
                                </div>
                            </div>
                            <div height="40px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:20px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="175px" style="padding:10px">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.7"
                                                height="1.5" /><br>
                                            <p style="font-size:13;"><?php echo $val2['field_barcode']; ?></p>

                                        </td>
                                        <td width="175px" style="padding:10px">
                                            <p style="font-size:16px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:13px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="150px" style="padding:10px">
                                            <img height="25px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                                        <?php
                    }
                        
                }

                //8ส่วนA4 ปรับหลายหน่วยนับ
                elseif ($val2['field_signsize'] == '17' && $val2['field_type_sign_price'] == '7') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:33 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:28 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:22 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:20 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                                <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                    <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                                </div> -->
                        <div class="col-md-6">
                            <div class="bg-img-size8" height="50px"
                                style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                                <div height="80px" style="padding-top:10px;line-height: 1.2;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                    <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                                </div>
                                <?php if ($val2['field_new_price3'] == 0) { ?>
                                <div height="45px" style="padding-left:25px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:22 px;color:IndianRed;"><?php echo $new_price1." .- / "; ?></span>
                                        <span
                                        style="text-align:left;font-size:20 px;color:IndianRed;"><?php echo $val2['field_unitcode1']; ?></span>
                                </div>
                                <div height="45px" style="padding-left:25px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:22 px;color:IndianRed;"><?php echo $new_price2." .- / "; ?></span>
                                        <span
                                        style="text-align:left;font-size:20 px;color:IndianRed;"><?php echo $val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?></span>
                                </div>
                                <?php } ?> 
                                <?php if ($val2['field_new_price3'] != 0) { ?>
                                    <div height="30px" style="padding-left:25px;text-align:left;">
                                        <span
                                            style="text-align:left;font-size:16 px;color:IndianRed;"><?php echo $new_price1." .- / "; ?></span>
                                            <span
                                            style="text-align:left;font-size:14 px;color:IndianRed;"><?php echo $val2['field_unitcode1']; ?></span>
                                    </div>
                                    <div height="30px" style="padding-left:25px;text-align:left;">
                                        <span
                                            style="text-align:left;font-size:16 px;color:IndianRed;"><?php echo $new_price2." .- / "; ?></span>
                                            <span
                                            style="text-align:left;font-size:14 px;color:IndianRed;"><?php echo $val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?></span>
                                    </div>
                                    <div height="30px" style="padding-left:25px;text-align:left;">
                                        <span
                                            style="text-align:left;font-size:16 px;color:IndianRed;"><?php echo $new_price2." .- / "; ?></span>
                                            <span
                                            style="text-align:left;font-size:14 px;color:IndianRed;"><?php echo $val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?></span>
                                    </div>
                                <?php } ?> 
                            </div>
                            <div height="40px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:20px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="175px" style="padding:10px">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.7"
                                                height="1.5" /><br>
                                            <p style="font-size:13;"><?php echo $val2['field_barcode']; ?></p>

                                        </td>
                                        <td width="175px" style="padding:10px">
                                            <p style="font-size:16px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:13px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="150px" style="padding:10px">
                                            <img height="25px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                                        <?php
                    }
                        
                }

                //8ส่วนA4 ไม่มีราคา
                elseif ($val2['field_signsize'] == '17' && $val2['field_type_sign_price'] == '8') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:40 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:35 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:30 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:22 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:20 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                                                <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                    <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                                </div> -->
                        <div class="col-md-6">
                            <div class="bg-img-size8" height="50px"
                                style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                                <div height="110px" style="padding-top:10px;line-height: 1.2;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                    <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                                </div>
                                <div height="70px" style="padding-left:25px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:40 px;color:IndianRed;"></span>
                                        <span
                                        style="text-align:left;font-size:25 px;color:IndianRed;"></span>
                                </div>
                            </div>
                            <div height="40px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:5px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="175px" style="padding:5px">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                                height="1.7" /><br>
                                            <p style="font-size:13;"><?php echo $val2['field_barcode']; ?></p>

                                        </td>
                                        <td width="175px" style="padding:5px">
                                            <p style="font-size:16px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:13px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="150px" style="padding:5px">
                                            <img height="25px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                                        <?php
                    }
                        
                }


                //สี่ส่วน A4 ราคาเดียว
                elseif ($val2['field_signsize'] == '3' && $val2['field_type_sign_price'] == '1') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                        if ($count_str <= 20) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:37 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="170px" style="padding-top:10px;line-height: 1.2;">
                                    <span style="<?php echo $font_size; ?> text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
                                <div height="80px" style="padding-left:50px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:60 px;color:IndianRed;"><?php echo $price1." .- / "; ?></span>
                                    <span
                                        style="text-align:left;font-size:40 px;color:IndianRed;"><?php echo $val2['field_unitcode1']; ?></span>
                                    </div>
                            </div>
                            <div height="60px"
                             style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //สี่ส่วน A42ด้าน ราคาเดียว
                elseif ($val2['field_signsize'] == '20' && $val2['field_type_sign_price'] == '1') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) {
                        # code...
                        if ($count_str <= 20) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:37 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="170px" style="padding-top:10px;line-height: 1.2;">
                                    <span style="<?php echo $font_size; ?> text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
                                <div height="80px" style="padding-left:50px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:60 px;color:IndianRed;"><?php echo $price1." .- / "; ?></span>
                                    <span
                                        style="text-align:left;font-size:40 px;color:IndianRed;"><?php echo $val2['field_unitcode1']; ?></span>
                                    </div>
                            </div>
                            <div height="60px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                                <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //ครึ่งA4 ราคาเดียว
                elseif ($val2['field_signsize'] == '2' && $val2['field_type_sign_price'] == '1') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:100 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:90 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:75 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:65 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:55 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:50 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                                                <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                    <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                                </div> -->
                        <div class="bg-img-size2" height="200px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="220px" style="padding-top:20px;line-height: 1.2;">
                                <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                            </div>
                            <div height="100px" style="padding-left:100px;text-align:left;">
                                <span
                                    style="text-align:left;font-size:80 px;color:IndianRed;"><?php echo $price1." .- / "; ?></span>
                                    <span
                                    style="text-align:left;font-size:50 px;color:IndianRed;"><?php echo $val2['field_unitcode1']; ?></span>
                            </div>
                        </div>
                        <div height="80px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:50px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.1" /><br>
                                        <p style="font-size:20;"><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="300px" style="padding:20px">
                                        <img height="50px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                                        <?php
                    }
                        
                }

                //A4 สเต็ปราคา
                elseif ($val2['field_signsize'] == '1' && $val2['field_type_sign_price'] == '2') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์
                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>
                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="360px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <?php if ($val2['field_price3'] != 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:90 px;color:IndianRed;">
                                        <?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                </div>
                            <?php } ?> 
                            <?php if ($val2['field_price3'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span style="text-align:left;font-size:100 px;color:IndianRed;">
                                        <?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span style="text-align:left;font-size:80 px;color:IndianRed;"> 
                                        <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                </div>

                            <?php } ?> 
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }
                //ครึ่งA4 สเต็ปราคา
                elseif ($val2['field_signsize'] == '2' && $val2['field_type_sign_price'] == '2') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:100 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:90 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:50 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                         ?>
                        <div class="bg-img-size2" height="200px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="220px" style="padding-top:20px;line-height: 1;">
                                <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                            </div>
                            <?php if ($val2['field_price3'] != 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:55 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:30 px;color:IndianRed;">
                                        <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:30 px;color:IndianRed;">
                                        <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                    </span>
                                </div>
                            <?php } ?> 
                        
                            <?php if ($val2['field_price3'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:75 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:50 px;color:IndianRed;">
                                        <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                    </span>
                                </div>

                            <?php } ?> 
                        </div>
                        <div height="80px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:50px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.1" /><br>
                                        <p style="font-size:20;"><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="300px" style="padding:20px">
                                        <img height="50px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                                        <?php
                    }
                     
                }
                //สี่ส่วน A4 สเต็ปราคา
                elseif ($val2['field_signsize'] == '3' && $val2['field_type_sign_price'] == '2') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:35 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:30 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>

                                <?php if (  $val2['field_price5'] != 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:23 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price4." .- / ".number_format($val2['field_fromQty4'])." ".$val2['field_unitcode4']."ขึ้นไป".$val2['field_unitcode4']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price5." .- / ".number_format($val2['field_fromQty5'])." ".$val2['field_unitcode5']."ขึ้นไป".$val2['field_unitcode5']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if (  $val2['field_price4'] != 0 && $val2['field_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:35 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ($val2['field_price3'] != 0 && $val2['field_price4'] == 0 && $val2['field_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:35 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ($val2['field_price3'] == 0 && $val2['field_price4'] == 0 && $val2['field_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:50 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:40 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])."</span><span style='text-align:left;font-size:25 px;color:IndianRed;'>".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>

                                <?php } ?> 
                            </div>
                        <div height="60px"
                             style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //สี่ส่วน A4 ปรับราคา สเต็ปราคา
                elseif ($val2['field_signsize'] == '3' && $val2['field_type_sign_price'] == '6') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:35 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:30 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>

                                <?php if (  $val2['field_price5'] != 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:23 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price4." .- / ".number_format($val2['field_fromQty4'])." ".$val2['field_unitcode4']."ขึ้นไป".$val2['field_unitcode4']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price5." .- / ".number_format($val2['field_fromQty5'])." ".$val2['field_unitcode5']."ขึ้นไป".$val2['field_unitcode5']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if (  $val2['field_price4'] != 0 && $val2['field_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:35 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ($val2['field_price3'] != 0 && $val2['field_price4'] == 0 && $val2['field_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:35 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ($val2['field_price3'] == 0 && $val2['field_price4'] == 0 && $val2['field_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:50 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:40 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])."</span><span style='text-align:left;font-size:25 px;color:IndianRed;'>".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>

                                <?php } ?> 
                            </div>
                        <div height="60px"
                             style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //สี่ส่วน A42ด้าน สเต็ปราคา
                elseif ($val2['field_signsize'] == '20' && $val2['field_type_sign_price'] == '6') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:35 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:30 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>

                                <?php if (  $val2['field_price5'] != 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:23 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price4." .- / ".number_format($val2['field_fromQty4'])." ".$val2['field_unitcode4']."ขึ้นไป".$val2['field_unitcode4']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $price5." .- / ".number_format($val2['field_fromQty5'])." ".$val2['field_unitcode5']."ขึ้นไป".$val2['field_unitcode5']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if (  $val2['field_price4'] != 0 && $val2['field_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:35 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ($val2['field_price3'] != 0 && $val2['field_price4'] == 0 && $val2['field_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:35 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ($val2['field_price3'] == 0 && $val2['field_price4'] == 0 && $val2['field_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:50 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:40 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])."</span><span style='text-align:left;font-size:25 px;color:IndianRed;'>".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>

                                <?php } ?> 
                            </div>
                        <div height="60px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                                <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }
                //ป้ายหน้าชั้น สเต็ปราคา
                elseif ($val2['field_signsize'] == '4' && $val2['field_type_sign_price'] == '2') {
                    // # code...$val2['field_signamount']
                    if ($count_str <= 20) {
                        $font_size = "font-size:30 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:28 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:20 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:18 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:15 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <div class="col-md-6">
                        <div class="col-md-11" style="padding:5px;">
                        <?php if ($val2['field_price3'] == 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="2" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:25px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:18px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span style="font-size:20px"><?php echo $price2;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode1']."ขึ้นไป"; ?></span>

                                            </td>
                                        </tr>
                                    </table>
                        <?php   } ?>
                        <?php if ($val2['field_price3'] != 0 && $val2['field_price4'] == 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="3" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:13px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:13px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span><?php echo $price2;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป"; ?></span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:13px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span><?php echo $price3;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป"; ?></span>
                                            </td>
                                        </tr>
                                    </table>
                        <?php   } ?>
                        <?php if ($val2['field_price4'] != 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="4" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:15px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:15px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span><?php echo $price2;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode1']." ขึ้นไป"; ?></span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:15px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span><?php echo $price3;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode1']." ขึ้นไป"; ?></span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:15px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span><?php echo $price4;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty4'])." ".$val2['field_unitcode4']." ขึ้นไป"; ?></span>
                                            </td>
                                        </tr>
                                    </table>
                        <?php   } ?>
                        </div>
                        </div>
                          
                        <!-- </div> -->

                        <?php
                    }
                }
                 //A4 หลายหน่วยนับ
                elseif ($val2['field_signsize'] == '1' && $val2['field_type_sign_price'] == '3') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์
                        if ($count_str <= 20) {
                            $font_size = "font-size:110 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:110 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:70 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:60 px;";
                        }
                        ?>
                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="360px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <?php if ($val2['field_price3'] != 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:90 px;color:IndianRed;">
                                        <?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $price3." .- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>
                            <?php } ?> 
                            <?php if ($val2['field_price3'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span style="text-align:left;font-size:100 px;color:IndianRed;">
                                        <?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span style="text-align:left;font-size:80 px;color:IndianRed;"> 
                                            <?php echo $price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>

                            <?php } ?> 
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
                //ครึ่งA4 หลายหน่วยนับ
                elseif ($val2['field_signsize'] == '2' && $val2['field_type_sign_price'] == '3') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:100 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:90 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:50 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                         ?>
                        <div class="bg-img-size2" height="200px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="220px" style="padding-top:20px;line-height: 1;">
                                <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                            </div>
                            <?php if ($val2['field_price3'] != 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:60 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:45 px;color:IndianRed;">
                                        <?php echo $price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:45 px;color:IndianRed;">
                                        <?php echo $price3." .- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?>
                                    </span>
                                </div>
                            <?php } ?> 
                        
                            <?php if ($val2['field_price3'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:75 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:60 px;color:IndianRed;">
                                        <?php echo $price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                    </span>
                                </div>

                            <?php } ?> 
                        </div>
                        <div height="80px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:50px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.1" /><br>
                                        <p style="font-size:20;"><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="300px" style="padding:20px">
                                        <img height="50px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                                        <?php
                    }
                     
                }
                //สี่ส่วน A4 หลายหน่วยนับ
                elseif ($val2['field_signsize'] == '3' && $val2['field_type_sign_price'] == '3') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:65 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:55 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1.2;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
                                
                                <?php if ($val2['field_price3'] != 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:40 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:30 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:30 px;color:IndianRed;">
                                            <?php echo $price3." .- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ($val2['field_price3'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:45 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:35 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>

                                <?php } ?> 
                            </div>
                        <div height="60px"
                             style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //สี่ส่วน A42ด้าน หลายหน่วยนับ
                elseif ($val2['field_signsize'] == '20' && $val2['field_type_sign_price'] == '3') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:65 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:55 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
                                
                                <?php if ($val2['field_price3'] != 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:40 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:30 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:30 px;color:IndianRed;">
                                            <?php echo $price3." .- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ($val2['field_price3'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:45 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:35 px;color:IndianRed;">
                                            <?php echo $price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>

                                <?php } ?> 
                            </div>
                        <div height="60px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                                <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }
                 //ป้ายหน้าชั้น หลายหน่วยนับ
                elseif ($val2['field_signsize'] == '4' && $val2['field_type_sign_price'] == '3') {
                    // # code...$val2['field_signamount']
                    if ($count_str <= 20) {
                        $font_size = "font-size:30 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:28 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:20 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:18 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:15 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <div class="col-md-6">
                        <div class="col-md-11" style="padding:5px;">
                            <?php if ($val2['field_price3'] == 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="2" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:22px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:18px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span style="font-size:20px"><?php echo $price2;?></span><span><?php echo ".- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?></span>

                                            </td>
                                        </tr>
                                    </table>



                         <?php   } ?>
                         <?php if ($val2['field_price3'] != 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="3" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:22px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:11px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span style="font-size:15px"><?php echo $price2;?></span><span><?php echo ".- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?></span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:11px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span style="font-size:15px"><?php echo $price3;?></span><span><?php echo ".- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?></span>
                                            </td>
                                        </tr>
                                    </table>
                         <?php   } ?>
                        </div>  
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                        <?php
                        
                    }
                }
                //A4 ลดราคา
                elseif ($val2['field_signsize'] == '1' && $val2['field_type_sign_price'] == '4') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์
                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>
                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="370px" style="padding-top:20px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <div style="padding-left:230px;text-align:left;line-height: 1;">
                                <span style="text-align:left;font-size:50 px;color:DodgerBlue;">
                                    สินค้าลดราคาพิเศษ
                                </span>
                            </div>
                            <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:60 px;color:SlateBlue;">ปกติราคา </span>
                                    <span style="text-align:left;font-size:70 px;color:IndianRed;text-decoration: line-through"> 
                                    <?php echo number_format($val2['field_old_price1']); ?> 
                                    </span>
                                    <span style="text-align:left;font-size:70 px;color:IndianRed;"> .- / </span>
                                    <span style="text-align:left;font-size:60 px;color:SlateBlue;">
                                        <?php echo $val2['field_unitcode1']; ?>
                                    </span>
                            </div>
                            <div style="padding-left:20px;text-align:left;line-height: 1;">

                                    <span style="text-align:left;font-size:70 px;color:IndianRed;">พิเศษลดเหลือ </span>
                                    <span style="text-align:left;font-size:80 px;color:MediumVioletRed;"> 
                                     <?php echo $new_price1." .- / " ?> 
                                    </span>
                                    <span style="text-align:left;font-size:70 px;color:IndianRed;">
                                        <?php echo $val2['field_unitcode1']; ?>
                                    </span>

                            </div>
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }
                //ครึ่งA4 ลดราคา
                elseif ($val2['field_signsize'] == '2' && $val2['field_type_sign_price'] == '4') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:90 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:50 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                        <div class="bg-img-size2" height="200px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="220px" style="padding-top:20px;line-height: 1.2;">
                                <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                            </div>
                            <div style="padding-left:20px;text-align:left;line-height: 1;">
                                <span style="text-align:left;font-size:40 px;color:DodgerBlue;">
                                    ลดราคาพิเศษ
                                </span>
                            </div>
                            <div style="padding-left:20px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:40 px;color:SlateBlue;">ปกติราคา </span>
                                    <span style="text-align:left;font-size:50 px;color:IndianRed;text-decoration: line-through;"> 
                                    <?php echo number_format($val2['field_old_price1']); ?> 
                                    </span>
                                    <span style="text-align:left;font-size:50 px;color:IndianRed;"> .- / </span>
                                    <span style="text-align:left;font-size:40 px;color:SlateBlue;">
                                        <?php echo $val2['field_unitcode1']; ?>
                                    </span>
                            </div>
                            <div style="padding-left:20px;text-align:left;line-height: 1;">

                                    <span style="text-align:left;font-size:50 px;color:IndianRed;">พิเศษลดเหลือ </span>
                                    <span style="text-align:left;font-size:60 px;color:MediumVioletRed;"> 
                                    <?php echo $new_price1." .- / " ?> 
                                    </span>
                                    <span style="text-align:left;font-size:50 px;color:IndianRed;">
                                        <?php echo $val2['field_unitcode1']; ?>
                                    </span>

                            </div>
                        
                    
                        </div>
                        <div height="80px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:50px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.1" /><br>
                                        <p style="font-size:20;"><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="300px" style="padding:20px">
                                        <img height="50px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                                        <?php
                    }
                        
                }
                //สี่ส่วน A4 ลดราคา
                elseif ($val2['field_signsize'] == '3' && $val2['field_type_sign_price'] == '4') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:70 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
                                          
                                <div style="padding-left:20px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:30 px;color:SlateBlue;">ปกติราคา </span>
                                        <span style="text-align:left;font-size:45 px;color:IndianRed;text-decoration: line-through;"> 
                                        <?php echo number_format($val2['field_old_price1']); ?> 
                                        </span>
                                        <span style="text-align:left;font-size:40 px;color:IndianRed;"> .- / </span>
                                        <span style="text-align:left;font-size:30 px;color:SlateBlue;">
                                            <?php echo $val2['field_unitcode1']; ?>
                                        </span>
                                </div>
                                <div style="padding-left:20px;text-align:left;line-height: 1;">

                                        <span style="text-align:left;font-size:35 px;color:IndianRed;">ลดเหลือ </span>
                                        <span style="text-align:left;font-size:55 px;color:MediumVioletRed;"> 
                                        <?php echo $new_price1." .- / " ?> 
                                        </span>
                                        <span style="text-align:left;font-size:30 px;color:IndianRed;">
                                            <?php echo $val2['field_unitcode1']; ?>
                                        </span>

                                </div>
                      
                            </div>
                        <div height="60px"
                             style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //สี่ส่วน A42ด้าน ลดราคา
                elseif ($val2['field_signsize'] == '20' && $val2['field_type_sign_price'] == '4') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:70 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
                                            
                                <div style="padding-left:20px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:30 px;color:SlateBlue;">ปกติราคา </span>
                                        <span style="text-align:left;font-size:45 px;color:IndianRed;text-decoration: line-through;"> 
                                        <?php echo number_format($val2['field_old_price1']); ?> 
                                        </span>
                                        <span style="text-align:left;font-size:40 px;color:IndianRed;"> .- / </span>
                                        <span style="text-align:left;font-size:30 px;color:SlateBlue;">
                                            <?php echo $val2['field_unitcode1']; ?>
                                        </span>
                                </div>
                                <div style="padding-left:20px;text-align:left;line-height: 1;">

                                        <span style="text-align:left;font-size:35 px;color:IndianRed;">ลดเหลือ </span>
                                        <span style="text-align:left;font-size:55 px;color:MediumVioletRed;"> 
                                        <?php echo $new_price1." .- / " ?> 
                                        </span>
                                        <span style="text-align:left;font-size:30 px;color:IndianRed;">
                                            <?php echo $val2['field_unitcode1']; ?>
                                        </span>

                                </div>
                        
                            </div>
                        <div height="60px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                                <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //สี่ส่วน A4 ลดราคาหลายหนวยนับ
                elseif ($val2['field_signsize'] == '3' && $val2['field_type_sign_price'] == '10') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:70 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>

                                <div class="col-md-6">
                                    <div style="padding-left:10px;text-align:left;line-height: 1;">
                                            <span style="text-align:left;font-size:20 px;color:SlateBlue;">ปกติราคา </span>
                                            <span style="text-align:left;font-size:35 px;color:IndianRed;text-decoration: line-through;"> 
                                            <?php echo number_format($val2['field_old_price1']); ?> 
                                            </span>
                                            <span style="text-align:left;font-size:20 px;color:IndianRed;"> .- / </span>
                                            <span style="text-align:left;font-size:25 px;color:SlateBlue;">
                                                <?php echo $val2['field_unitcode1']; ?>
                                            </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="padding-left:20px;text-align:left;line-height: 1;">
                                            <span style="text-align:left;font-size:20 px;color:IndianRed;">ลดเหลือ </span>
                                            <span style="text-align:left;font-size:35 px;color:MediumVioletRed;"> 
                                            <?php echo $new_price1." .- / " ?> 
                                            </span>
                                            <span style="text-align:left;font-size:20 px;color:IndianRed;">
                                                <?php echo $val2['field_unitcode1']; ?>
                                            </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="padding-left:10px;text-align:left;line-height: 1;">
                                            <span style="text-align:left;font-size:18 px;color:SlateBlue;">ปกติราคา </span>
                                            <span style="text-align:left;font-size:32 px;color:IndianRed;text-decoration: line-through;"> 
                                            <?php echo number_format($val2['field_old_price2']); ?> 
                                            </span>
                                            <span style="text-align:left;font-size:18 px;color:IndianRed;"> .- / </span>
                                            <span style="text-align:left;font-size:23 px;color:SlateBlue;">
                                                <?php echo $val2['field_unitcode2']; ?>
                                            </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="padding-left:20px;text-align:left;line-height: 1;">
                                            <span style="text-align:left;font-size:18 px;color:IndianRed;">ลดเหลือ </span>
                                            <span style="text-align:left;font-size:32 px;color:MediumVioletRed;"> 
                                            <?php echo $new_price2." .- / " ?> 
                                            </span>
                                            <span style="text-align:left;font-size:23 px;color:IndianRed;">
                                                <?php echo $val2['field_unitcode2']; ?>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        <div height="60px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //สี่ส่วน A42ด้าน ลดราคาหลายหนวยนับ
                elseif ($val2['field_signsize'] == '20' && $val2['field_type_sign_price'] == '10') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:70 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>

                                <div class="col-md-6">
                                    <div style="padding-left:10px;text-align:left;line-height: 1;">
                                            <span style="text-align:left;font-size:20 px;color:SlateBlue;">ปกติราคา </span>
                                            <span style="text-align:left;font-size:35 px;color:IndianRed;text-decoration: line-through;"> 
                                            <?php echo number_format($val2['field_old_price1']); ?> 
                                            </span>
                                            <span style="text-align:left;font-size:20 px;color:IndianRed;"> .- / </span>
                                            <span style="text-align:left;font-size:25 px;color:SlateBlue;">
                                                <?php echo $val2['field_unitcode1']; ?>
                                            </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="padding-left:20px;text-align:left;line-height: 1;">
                                            <span style="text-align:left;font-size:20 px;color:IndianRed;">ลดเหลือ </span>
                                            <span style="text-align:left;font-size:35 px;color:MediumVioletRed;"> 
                                            <?php echo $new_price1." .- / " ?> 
                                            </span>
                                            <span style="text-align:left;font-size:20 px;color:IndianRed;">
                                                <?php echo $val2['field_unitcode1']; ?>
                                            </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="padding-left:10px;text-align:left;line-height: 1;">
                                            <span style="text-align:left;font-size:18 px;color:SlateBlue;">ปกติราคา </span>
                                            <span style="text-align:left;font-size:32 px;color:IndianRed;text-decoration: line-through;"> 
                                            <?php echo number_format($val2['field_old_price2']); ?> 
                                            </span>
                                            <span style="text-align:left;font-size:18 px;color:IndianRed;"> .- / </span>
                                            <span style="text-align:left;font-size:23 px;color:SlateBlue;">
                                                <?php echo $val2['field_unitcode2']; ?>
                                            </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="padding-left:20px;text-align:left;line-height: 1;">
                                            <span style="text-align:left;font-size:18 px;color:IndianRed;">ลดเหลือ </span>
                                            <span style="text-align:left;font-size:32 px;color:MediumVioletRed;"> 
                                            <?php echo $new_price2." .- / " ?> 
                                            </span>
                                            <span style="text-align:left;font-size:23 px;color:IndianRed;">
                                                <?php echo $val2['field_unitcode2']; ?>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        <div height="60px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                                <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //ป้ายหน้าชั้น ปรับราคา
                elseif ($val2['field_signsize'] == '4' && $val2['field_type_sign_price'] == '5') {
                    if ($count_str <= 20) {
                        $font_size = "font-size:21 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:20 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:19 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:18 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:17 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:16 px;";
                    }
                    // # code...$val2['field_signamount']
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <!-- <div class="row"> -->
                        <div class="col-md-6">
                        <div class="col-md-11" style="padding:5px;">
                            <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                <tr>
                                    <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                            height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                    <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                        rowspan="2" colspan="2" class="itemname">
                                        <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                    </td>
                                </tr>
                                <tr>

                                    <td rowspan="2" width="4cm"
                                        style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                        <br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                        <p><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="padding-bottom:5px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="5cm" colspan="2"
                                        style="text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <h1> <?php echo $new_price1.".-/".$val2['field_unitcode1']; ?> </h1>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </div>
                        <!-- </div> -->

                        <?php
                    }
                }
                //A4 ปรับราคา ราคาเดียว
                // elseif ($val2['field_type_sign_price'] == '1') {
                elseif ($val2['field_signsize'] == '1' && $val2['field_type_sign_price'] == '5') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์

                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>

                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="360px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <div height="100px" style="padding-left:100px;text-align:left;">
                                <span
                                    style="text-align:left;font-size:120 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?></span>
                            </div>
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }
                //ครึ่งA4 ปรับราคา ราคาเดียว
                elseif ($val2['field_signsize'] == '2' && $val2['field_type_sign_price'] == '5') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:85 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:75 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:50 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                                                <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                    <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                                </div> -->
                        <div class="bg-img-size2" height="200px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="240px" style="padding-top:20px;line-height: 1.2;">
                                <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                            </div>
                            <div height="100px" style="padding-left:100px;text-align:left;">
                                <span
                                    style="text-align:left;font-size:70 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?></span>
                            </div>
                        </div>
                        <div height="80px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:50px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.1" /><br>
                                        <p style="font-size:20;"><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="300px" style="padding:20px">
                                        <img height="50px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                                        <?php
                    }
                        
                }
                //สี่ส่วน A4 ปรับราคา ราคาเดียว
                elseif ($val2['field_signsize'] == '3' && $val2['field_type_sign_price'] == '5') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                        if ($count_str <= 20) {
                            $font_size = "font-size:70 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="170px" style="padding-top:10px;line-height: 1.2;">
                                    <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
                                <div height="80px" style="padding-left:50px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:50 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?></span>
                                </div>
                            </div>
                        <div height="60px"
                             style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //สี่ส่วน A42ด้าน ปรับราคา ราคาเดียว
                elseif ($val2['field_signsize'] == '20' && $val2['field_type_sign_price'] == '5') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) {
                        # code...
                        if ($count_str <= 20) {
                            $font_size = "font-size:70 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="170px" style="padding-top:10px;line-height: 1.2;">
                                    <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
                                <div height="80px" style="padding-left:50px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:50 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?></span>
                                </div>
                            </div>
                        <div height="60px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                                <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }
                //A4 2ด้าน ราคาเดียว
                // elseif ($val2['field_type_sign_price'] == '1') {
                elseif ($val2['field_signsize'] == '9' && $val2['field_type_sign_price'] == '1') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์

                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>

                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="360px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <div height="100px" style="padding-left:100px;text-align:left;">
                                <span
                                    style="text-align:left;font-size:120 px;color:IndianRed;"><?php echo $price1." .- / "; ?></span>
                                    <span
                                    style="text-align:left;font-size:80 px;color:IndianRed;"><?php echo $val2['field_unitcode1']; ?></span>
                            </div>
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }
                //A4 2ด้าน สเต็ปราคา
                elseif ($val2['field_signsize'] == '9' && $val2['field_type_sign_price'] == '2') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์
                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>
                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="360px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>

                            <?php if ($val2['field_price3'] != 0 && $val2['field_price5'] == 0 ) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:90 px;color:IndianRed;">
                                        <?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                </div>
                            <?php } ?> 
                            <?php if ($val2['field_price3'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span style="text-align:left;font-size:100 px;color:IndianRed;">
                                        <?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span style="text-align:left;font-size:80 px;color:IndianRed;"> 
                                        <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                </div>

                            <?php } ?> 
                            <?php if ($val2['field_price5'] != 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:50 px;color:IndianRed;">
                                        <?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:45 px;color:IndianRed;"> 
                                        <?php echo $price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:45 px;color:IndianRed;"> 
                                        <?php echo $price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:45 px;color:IndianRed;"> 
                                        <?php echo $price4." .- / ".number_format($val2['field_fromQty4'])." ".$val2['field_unitcode4']."ขึ้นไป".$val2['field_unitcode4']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:45 px;color:IndianRed;"> 
                                        <?php echo $price5." .- / ".number_format($val2['field_fromQty5'])." ".$val2['field_unitcode5']."ขึ้นไป".$val2['field_unitcode5']."ละ"; ?>
                                        </span>
                                </div>
                            <?php } ?> 
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }
                //A4 2ด้าน หลายหน่วยนับ
                elseif ($val2['field_signsize'] == '9' && $val2['field_type_sign_price'] == '3') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์
                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>
                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="360px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <?php if ($val2['field_price3'] != 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:90 px;color:IndianRed;">
                                        <?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $price3." .- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>
                            <?php } ?> 
                            <?php if ($val2['field_price3'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span style="text-align:left;font-size:100 px;color:IndianRed;">
                                        <?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span style="text-align:left;font-size:80 px;color:IndianRed;"> 
                                            <?php echo $price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>

                            <?php } ?> 
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
                //A4 2ด้าน ลดราคา ราคาเดียว
                elseif ($val2['field_signsize'] == '9' && $val2['field_type_sign_price'] == '4') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์
                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>
                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="370px" style="padding-top:20px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <div style="padding-left:230px;text-align:left;line-height: 1;">
                                <span style="text-align:left;font-size:50 px;color:DodgerBlue;">
                                    สินค้าลดราคาพิเศษ
                                </span>
                            </div>
                            <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:60 px;color:SlateBlue;">ปกติราคา </span>
                                    <span style="text-align:left;font-size:70 px;color:IndianRed;text-decoration: line-through"> 
                                        <?php echo number_format($val2['field_old_price1']); ?> 
                                    </span>
                                    <span style="text-align:left;font-size:70 px;color:IndianRed;"> .- / </span>
                                    <span style="text-align:left;font-size:60 px;color:SlateBlue;">
                                        <?php echo $val2['field_unitcode1']; ?>
                                    </span>
                            </div>
                            <div style="padding-left:20px;text-align:left;line-height: 1;">

                                    <span style="text-align:left;font-size:70 px;color:IndianRed;">พิเศษลดเหลือ </span>
                                    <span style="text-align:left;font-size:80 px;color:MediumVioletRed;"> 
                                        <?php echo $new_price1." .- / " ?> 
                                    </span>
                                    <span style="text-align:left;font-size:70 px;color:IndianRed;">
                                        <?php echo $val2['field_unitcode1']; ?>
                                    </span>

                            </div>
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }
                //A4 2ด้าน  ปรับราคา ราคาเดียว
                elseif ($val2['field_signsize'] == '9' && $val2['field_type_sign_price'] == '5') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์

                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>

                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="360px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <div height="100px" style="padding-left:100px;text-align:left;">
                                <span
                                    style="text-align:left;font-size:110 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?></span>
                            </div>
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }
                //A4 ปรับราคา สเต็ปราคา
                elseif ($val2['field_signsize'] == '1' && $val2['field_type_sign_price'] == '6') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์
                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>
                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="360px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <?php if ($val2['field_new_price3'] != 0 && $val2['field_new_price4'] == 0 && $val2['field_new_price5'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:90 px;color:IndianRed;">
                                        <?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $new_price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                </div>
                            <?php } ?> 
                            <?php if ($val2['field_new_price3'] == 0 && $val2['field_new_price4'] == 0 && $val2['field_new_price5'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span style="text-align:left;font-size:100 px;color:IndianRed;">
                                        <?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span style="text-align:left;font-size:80 px;color:IndianRed;"> 
                                        <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                </div>

                            <?php } ?> 
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }
                //ครึ่งA4 ปรับราคา สเต็ปราคา
                elseif ($val2['field_signsize'] == '2' && $val2['field_type_sign_price'] == '6') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:100 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:90 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:50 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                        <div class="bg-img-size2" height="200px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="220px" style="padding-top:20px;line-height: 1;">
                                <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                            </div>
                            <?php if ($val2['field_new_price3'] != 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:55 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:40 px;color:IndianRed;">
                                        <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:40 px;color:IndianRed;">
                                        <?php echo $new_price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                    </span>
                                </div>
                            <?php } ?> 
                        
                            <?php if ($val2['field_new_price3'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:75 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:60 px;color:IndianRed;">
                                        <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                    </span>
                                </div>

                            <?php } ?> 
                        </div>
                        <div height="80px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:50px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.1" /><br>
                                        <p style="font-size:20;"><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="300px" style="padding:20px">
                                        <img height="50px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                                        <?php
                    }
                        
                }
                //สี่ส่วน A42ด้าน ปรับราคา สเต็ปราคา
                elseif ($val2['field_signsize'] == '20' && $val2['field_type_sign_price'] == '6') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:35 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:30 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>

                                <?php if (  $val2['field_new_price5'] != 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:23 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $new_price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $new_price4." .- / ".number_format($val2['field_fromQty4'])." ".$val2['field_unitcode4']."ขึ้นไป".$val2['field_unitcode4']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span
                                            style="text-align:left;font-size:22 px;color:IndianRed;">
                                            <?php echo $new_price5." .- / ".number_format($val2['field_fromQty5'])." ".$val2['field_unitcode5']."ขึ้นไป".$val2['field_unitcode5']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if (  $val2['field_new_price4'] != 0 && $val2['field_new_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:35 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $new_price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ($val2['field_new_price3'] != 0 && $val2['field_new_price4'] == 0 && $val2['field_new_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:35 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $new_price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ($val2['field_new_price3'] == 0 && $val2['field_new_price4'] == 0 && $val2['field_new_price5'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:50 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:40 px;color:IndianRed;">
                                            <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])."</span><span style='text-align:left;font-size:25 px;color:IndianRed;'>".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                    </div>

                                <?php } ?> 
                            </div>
                        <div height="60px"
                             style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }
                //ป้ายหน้าชั้น ปรับราคา สเต็ปราคา
                elseif ($val2['field_signsize'] == '4' && $val2['field_type_sign_price'] == '6') {
                    // # code...$val2['field_signamount']
                    if ($count_str <= 20) {
                        $font_size = "font-size:28 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:23 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:20 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:18 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:15 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <div class="col-md-6">
                        <div class="col-md-11" style="padding:5px;">
                        <?php if ($val2['field_new_price3'] == 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="2" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:25px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $new_price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:18px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span style="font-size:20px"><?php echo $new_price2;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode1']."ขึ้นไป"; ?></span>

                                            </td>
                                        </tr>
                                    </table>
                        <?php   } ?>
                        <?php if ($val2['field_new_price3'] != 0 && $val2['field_new_price4'] == 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="3" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:15px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $new_price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:13px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span><?php echo $new_price2;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป"; ?></span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:13px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span><?php echo $new_price3;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป"; ?></span>
                                            </td>
                                        </tr>
                                    </table>
                        <?php   } ?>
                        <?php if ($val2['field_new_price4'] != 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="4" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:15px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $new_price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:15px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span><?php echo $new_price2;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode1']." ขึ้นไป"; ?></span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:15px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span><?php echo $new_price3;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode1']." ขึ้นไป"; ?></span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:15px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span><?php echo $new_price4;?></span><span><?php echo ".- / ".number_format($val2['field_fromQty4'])." ".$val2['field_unitcode4']." ขึ้นไป"; ?></span>
                                            </td>
                                        </tr>
                                    </table>
                        <?php   } ?>
                        </div>
                        </div>
                          
                        <!-- </div> -->

                        <?php
                    }
                }
                //A4 2ด้าน ปรับราคา สเต็ปราคา
                elseif ($val2['field_signsize'] == '9' && $val2['field_type_sign_price'] == '6') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์
                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>
                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="280px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <?php if (  $val2['field_new_price5'] != 0 ) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:65 px;color:IndianRed;">
                                        <?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:51 px;color:IndianRed;"> 
                                        <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:49 px;color:IndianRed;"> 
                                        <?php echo $new_price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:47 px;color:IndianRed;"> 
                                        <?php echo $new_price4." .- / ".number_format($val2['field_fromQty4'])." ".$val2['field_unitcode4']."ขึ้นไป".$val2['field_unitcode4']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:45 px;color:IndianRed;"> 
                                        <?php echo $new_price5." .- / ".number_format($val2['field_fromQty5'])." ".$val2['field_unitcode5']."ขึ้นไป".$val2['field_unitcode5']."ละ"; ?>
                                        </span>
                                </div>
                            <?php } ?> 
                            <?php if (  $val2['field_new_price4'] != 0 && $val2['field_new_price5'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:75 px;color:IndianRed;">
                                        <?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:55 px;color:IndianRed;"> 
                                        <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:55 px;color:IndianRed;"> 
                                        <?php echo $new_price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:55 px;color:IndianRed;"> 
                                        <?php echo $new_price4." .- / ".number_format($val2['field_fromQty4'])." ".$val2['field_unitcode4']."ขึ้นไป".$val2['field_unitcode4']."ละ"; ?>
                                        </span>
                                </div>
                            <?php } ?> 
                            <?php if ($val2['field_new_price3'] != 0 && $val2['field_new_price4'] == 0 && $val2['field_new_price5'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:90 px;color:IndianRed;">
                                        <?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $new_price3." .- / ".number_format($val2['field_fromQty3'])." ".$val2['field_unitcode3']."ขึ้นไป".$val2['field_unitcode3']."ละ"; ?>
                                        </span>
                                </div>
                            <?php } ?> 
                            <?php if ($val2['field_new_price3'] == 0 && $val2['field_new_price4'] == 0 && $val2['field_new_price5'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span style="text-align:left;font-size:100 px;color:IndianRed;">
                                        <?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span style="text-align:left;font-size:80 px;color:IndianRed;"> 
                                        <?php echo $new_price2." .- / ".number_format($val2['field_fromQty2'])." ".$val2['field_unitcode2']."ขึ้นไป".$val2['field_unitcode2']."ละ"; ?>
                                        </span>
                                </div>

                            <?php } ?> 
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }
                //A4 ปรับราคาหลายหน่วยนับ
                elseif ($val2['field_signsize'] == '1' && $val2['field_type_sign_price'] == '7') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์
                        if ($count_str <= 20) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:70 px;";
                        }
                        ?>
                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="360px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <?php if ($val2['field_price3'] != 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:90 px;color:IndianRed;">
                                        <?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $new_price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $new_price3." .- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>
                            <?php } ?> 
                            <?php if ($val2['field_price3'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span style="text-align:left;font-size:100 px;color:IndianRed;">
                                        <?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span style="text-align:left;font-size:80 px;color:IndianRed;"> 
                                            <?php echo $new_price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>

                            <?php } ?> 
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
                //ครึ่งA4 ปรับราคาหลายหน่วยนับ
                elseif ($val2['field_signsize'] == '2' && $val2['field_type_sign_price'] == '7') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:75 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:65 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:50 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                        <div class="bg-img-size2" height="200px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="220px" style="padding-top:20px;line-height: 1;">
                                <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                            </div>
                            <?php if ($val2['field_new_price3'] != 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:60 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:45 px;color:IndianRed;">
                                        <?php echo $new_price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:45 px;color:IndianRed;">
                                        <?php echo $new_price3." .- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?>
                                    </span>
                                </div>
                            <?php } ?> 
                        
                            <?php if ($val2['field_new_price3'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:75 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span
                                        style="text-align:left;font-size:60 px;color:IndianRed;">
                                        <?php echo $new_price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                    </span>
                                </div>

                            <?php } ?> 
                        </div>
                        <div height="80px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:50px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.1" /><br>
                                        <p style="font-size:20;"><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="300px" style="padding:20px">
                                        <img height="50px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                                        <?php
                    }
                        
                }

                //สี่ส่วน A4 ปรับราคาหลายหน่วยนับ
                elseif ($val2['field_signsize'] == '3' && $val2['field_type_sign_price'] == '7') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:55 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
                                
                                <?php if ( $val2['field_new_price3'] != 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:30 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $new_price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $new_price3." .- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ( $val2['field_new_price3'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:40 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:30 px;color:IndianRed;">
                                            <?php echo $new_price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>

                                <?php } ?> 
                            </div>
                        <div height="60px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <?php
                            if ($orderby == '2') { ?>
                                <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                        <?php
                    }
                }

                //สี่ส่วน A42ด้าน ปรับราคาหลายหน่วยนับ
                elseif ($val2['field_signsize'] == '20' && $val2['field_type_sign_price'] == '7') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) {
                        if ($count_str <= 20) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:55 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:45 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:40 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:35 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="150px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
                                
                                <?php if ( $val2['field_new_price3'] != 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:30 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $new_price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:25 px;color:IndianRed;">
                                            <?php echo $new_price3." .- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>
                                <?php } ?> 
                                <?php if ( $val2['field_new_price3'] == 0) { ?>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:40 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                        </span>
                                    </div>
                                    <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span
                                            style="text-align:left;font-size:30 px;color:IndianRed;">
                                            <?php echo $new_price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                    </div>

                                <?php } ?> 
                            </div>
                        <div height="60px"
                             style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                        <?php
                    }
                }
                //ป้ายหน้าชั้น ปรับราคาหลายหน่วยนับ
                elseif ($val2['field_signsize'] == '4' && $val2['field_type_sign_price'] == '7') {
                    // # code...$val2['field_signamount']
                    if ($count_str <= 20) {
                        $font_size = "font-size:30 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:28 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:20 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:18 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:15 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <div class="col-md-6">
                        <div class="col-md-11" style="padding:5px;">
                            <?php if ($val2['field_new_price3'] == 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="2" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:21px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $new_price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:18px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span style="font-size:20px"><?php echo $new_price2;?></span><span><?php echo ".- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?></span>

                                            </td>
                                        </tr>
                                    </table>



                            <?php   } ?>
                            <?php if ($val2['field_new_price3'] != 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="3" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:22px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $new_price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:11px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span style="font-size:15px"><?php echo $new_price2;?></span><span><?php echo ".- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?></span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:11px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span style="font-size:15px"><?php echo $new_price3;?></span><span><?php echo ".- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?></span>
                                            </td>
                                        </tr>
                                    </table>
                            <?php   } ?>
                        </div>  
                        </div>

                        <?php
                    }
                }

                //ป้ายหน้าชั้นพิเศษ หลายหน่วยนับ
                elseif ($val2['field_signsize'] == '18' && $val2['field_type_sign_price'] == '3') {
                    // # code...$val2['field_signamount']
                    if ($count_str <= 20) {
                        $font_size = "font-size:23 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:22 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:19 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:16 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:14 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:12 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <div class="col-md-6">
                        <div class="col-md-9" style="padding:5px;">
                            <?php if ($val2['field_price3'] == 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="2" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:22px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:18px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span style="font-size:20px"><?php echo $price2;?></span><span><?php echo ".- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?></span>

                                            </td>
                                        </tr>
                                    </table>



                            <?php   } ?>
                            <?php if ($val2['field_price3'] != 0) {
                                ?>
                                    <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <tr>
                                            <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                    height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                            <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                                rowspan="2" colspan="3" class="itemname">
                                                <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="4cm"
                                                style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                                <br>
                                                <p><?php echo $val2['field_barcode']; ?></p>
                                                <p><?php echo $val2['field_itemcode']; ?></p>
                                                <p style="padding-bottom:5px;">
                                                    <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="1cm" 
                                                style="font-size:22px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span> <?php echo $price1.".-/".$val2['field_unitcode1']; ?> </span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:11px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span style="font-size:15px"><?php echo $price2;?></span><span><?php echo ".- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?></span>
                                            </td>
                                            <td width="1cm" 
                                                style="font-size:11px;text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                                <span style="font-size:15px"><?php echo $price3;?></span><span><?php echo ".- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?></span>
                                            </td>
                                        </tr>
                                    </table>
                            <?php   } ?>
                        </div>  
                        </div>

                        <?php
                    }
                }
                //A4 2ด้าน ปรับราคาหลายหน่วยนับ
                elseif ($val2['field_signsize'] == '9' && $val2['field_type_sign_price'] == '7') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์
                        if ($count_str <= 20) {
                            $font_size = "font-size:110 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:70 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:60 px;";
                        }
                        ?>
                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="360px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <?php if ($val2['field_new_price3'] != 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                    <span style="text-align:left;font-size:90 px;color:IndianRed;">
                                        <?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $new_price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1;">
                                        <span style="text-align:left;font-size:60 px;color:IndianRed;"> 
                                        <?php echo $new_price3." .- / ".$val2['field_unitcode3']." ".number_format($val2['field_rate3'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>
                            <?php } ?> 
                            <?php if ($val2['field_new_price3'] == 0) { ?>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                    <span style="text-align:left;font-size:100 px;color:IndianRed;">
                                        <?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?>
                                    </span>
                                </div>
                                <div style="padding-left:50px;text-align:left;line-height: 1.2;">
                                        <span style="text-align:left;font-size:80 px;color:IndianRed;"> 
                                            <?php echo $new_price2." .- / ".$val2['field_unitcode2']." ".number_format($val2['field_rate2'])." ".$val2['field_unitcode1'].""; ?>
                                        </span>
                                </div>

                            <?php } ?> 
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
                //ป้ายสต็อก
                elseif ($val2['field_signsize'] == '5') {
                    if ($count_str <= 20) {
                        $font_size = "font-size:65 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:55 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:50 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:45 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:40 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                         ?>
                         <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                 <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                             </div> -->
                            <div height="200px" style="text-align:center;margin-right:0px;margin-bottom:20px;">
                                <table>
                                    <tr>
                                        <td height="50px" width="200px" style="border: 3px solid RoyalBlue;overflow:wrap;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                        <td width="550px" rowspan="2"
                                            style="<?php echo $font_size; ?>border-left: 5px solid RoyalBlue;border-top: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;vertical-align: text-top;text-align:center;">
                                            <?php echo $val2['field_itemname']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-stock5" rowspan="3" height="170px"
                                            style="border: 3px solid RoyalBlue;overflow:wrap;font-size:40px;text-align:center;">
                                            <h2 style="letter-spacing: 3px;">STOCK</h2>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="40px"
                                            style="border-left: 5px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;vertical-align: text-top;text-align:center;color:red;">
                                            <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="30px"
                                            style="border-left: 5px solid RoyalBlue;border-right: 3px solid RoyalBlue;border-bottom: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;vertical-align: text-top;text-align:right;font-size:20px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <?php
                    }
                     
                }
                //บาร์แท็ก
                elseif ($val2['field_signsize'] == '6'){
                    for ($i=0; $i < ($val2['field_signamount'] * 18); $i++) {
                        ?>
                            <div height="160px" class="col-md-4" style="border: 1px solid black;margin-left:10px;margin-bottom:10px;">
                                <div class="col-md-5" style="font-size:12px;padding-left:5px;">
                                    <div class="form-group">
                                        <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?>
                                    </div>
                                </div>
                                <div class="col-md-5" style="border: 1px solid red;float:right;text-align:center;">
                                    <div class="form-group">
                                         <img height="20px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </div>
                                </div>
                                <div class="col-md-1" style="font-size:12px;float:right;">
                                    <div height="30px" class="form-group">
                                        <img  src="<?= base_url('assets/images/sk_model.png'); ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-md-10" style="border: 1px solid black;margin-top:0px;margin-right:20px;margin-left:20px;">
                                        <div  height="40px" style="font-size:12px;text-align:center;">
                                            <?php echo $val2['field_itemname']; ?>
                                        </div>
                                        <div style="text-align:center;" >
                                            <barcode style="padding-bottom:1px;" code="<?php echo $code ?>" type="EAN13" size="1"
                                                height="0.5" />
                                        </div>
                                </div>
                                <div class="col-md-10" style="margin-right:20px;margin-left:20px;font-size:14;text-align:center;">
                                                <span>จำนวน.................<?php echo $val2['field_unitcode1'] ?></span><br><span> ชื่อ...........................วันที่........................</span>
                                </div>
                            </div>
                        <?php 
                    }
                }
                //ป้ายสต็อก 3ส่วน A4
                elseif ($val2['field_signsize'] == '7') {
                    if ($count_str <= 20) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:65 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:55 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:50 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:40 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                         ?>
                         <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                 <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                             </div> -->
                            <div height="300px" style="text-align:center;margin-right:0px;margin-bottom:20px;">
                                <table>
                                    <tr>
                                        <td height="60px" width="200px" style="border: 3px solid RoyalBlue;overflow:wrap;text-align:center;">
                                            <img height="50px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                        <td width="550px" rowspan="2" colspan="2"
                                            style="<?php echo $font_size; ?>border-left: 5px solid RoyalBlue;border-top: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;vertical-align: text-top;text-align:center;">
                                            <?php echo $val2['field_itemname']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-stock5" rowspan="3" height="170px"
                                            style="border: 3px solid RoyalBlue;overflow:wrap;font-size:62px;text-align:center;">
                                            <h2 style="letter-spacing: 3px;">STOCK</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="40px"
                                            style="text-align:center;line-height: 0.5;border-left: 5px solid RoyalBlue;overflow:wrap;margin-right:0px;vertical-align:text-top;">
                                            <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.7"
                                                height="2.4" /><br>
                                            <p ><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        
                                        <td height="40px"
                                            style="border-right: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;">
                                            <p style="font-size:60px;"><?php echo $val2['field_itemcode']; ?></p>

                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td height="30px" colspan="2"
                                            style="border-left: 5px solid RoyalBlue;border-right: 3px solid RoyalBlue;border-bottom: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;text-align:right;font-size:20px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <?php
                    }
                     
                }
                //ป้ายสต็อกโกดัง
                elseif ($val2['field_signsize'] == '8') {
                    if ($count_str <= 20) {
                        $font_size = "font-size:65 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:55 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:50 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:45 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:40 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                         ?>
                         <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                 <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                             </div> -->
                            <div height="200px" style="text-align:center;margin-right:0px;margin-bottom:20px;">
                                <table>
                                    <tr>
                                        <td height="50px" width="200px" style="border: 3px solid RoyalBlue;overflow:wrap;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                        <td width="550px" rowspan="2" colspan="2"
                                            style="border-left: 5px solid RoyalBlue;border-top: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;vertical-align: text-top;text-align:center;<?php echo $font_size; ?>">
                                            <?php echo $val2['field_itemname']; ?>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="bg-stock" rowspan="3" height="170px"
                                            style="border: 3px solid RoyalBlue;overflow:wrap;text-align:center;">

                                            <img height="170px" src="<?php echo base_url('assets/images');?>/<?php echo $arrow; ?>.png" >
                                            
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="40px" colspan="2"
                                            style="border-left: 5px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;vertical-align: text-top;text-align:center;">
                                            <p style="font-size:50px;color:red;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?></p>
                                            <p style="font-size:20px;"><?php echo $val2['field_bc_name2']; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-left: 5px solid RoyalBlue;border-bottom: 3px solid RoyalBlue;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                        </td>
                                        <td height="30px"
                                            style="border-right: 3px solid RoyalBlue;border-bottom: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;vertical-align: text-top;text-align:right;font-size:20px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <?php
                    }
                     
                }
                //ป้ายสต็อก ครึ่งA4
                elseif ($val2['field_signsize'] == '10') {
                    if ($count_str <= 20) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:75 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:65 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:55 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                         ?>
                         <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                 <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                             </div> -->
                        <div class="col-md-12">
                            <div height="500px" style="text-align:center;margin-right:0px;margin-bottom:20px;">
                                <table>
                                    <tr>
                                        <td height="70px" width="240px" style="border: 3px solid RoyalBlue;overflow:wrap;text-align:center;">
                                            <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                        <td  rowspan="2" colspan="2"  width="700px;" 
                                            style="<?php echo $font_size; ?>border-top: 3px solid RoyalBlue;border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;text-align:center;">
                                            <?php echo $val2['field_itemname']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-stock5" rowspan="4" 
                                            style="padding-left:50px;border: 3px solid RoyalBlue;overflow:wrap;font-size:110px;">
                                            <h2 >STOCK</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="100px" colspan="2"
                                            style="text-align:center;line-height: 1.5;border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;vertical-align:text-top;">
                                            <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.7"
                                                height="2.4" /><br>
                                            <p style="font-size:20;"><?php echo $val2['field_barcode']; ?></p>
                                            <span style="color:red;font-size:30;"><?php echo $val2['field_bc_name2']; ?></span>
                                        </td> 
                                    </tr>
                                    <tr>
                                        
                                        
                                        <td height="60px" colspan="2"
                                            style="border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;text-align:center;">
                                            <p style="font-size:60px;"><?php echo $val2['field_itemcode']; ?></p>

                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td height="30px" colspan="2"
                                            style="border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;border-bottom: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;text-align:right;font-size:30px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                            <?php
                    }
                     
                }

                //ป้ายสต็อก A4
                elseif ($val2['field_signsize'] == '11') {
                    if ($count_str <= 20) {
                        $font_size = "font-size:1000 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:95 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:90 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:85 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:75 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                         ?>
                         <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                 <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                             </div> -->
                            <div height="500px" style="text-align:center;margin-right:0px;margin-bottom:20px;">
                                <table>
                                    <tr>
                                        <td height="90px" width="280px" style="border: 3px solid RoyalBlue;overflow:wrap;text-align:center;">
                                            <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                        <td  rowspan="2" colspan="2"
                                            style="<?php echo $font_size; ?>border-top: 3px solid RoyalBlue;border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;text-align:center;">
                                            <?php echo $val2['field_itemname']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-stock5" rowspan="4" 
                                            style="padding-left:40px;border: 3px solid RoyalBlue;overflow:wrap;font-size:160px;">
                                            <h2 >STOCK</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="100px" colspan="2"
                                            style="text-align:center;line-height: 1.5;border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;vertical-align:text-top;">
                                            <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.7"
                                                height="2.4" /><br>
                                            <p ><?php echo $val2['field_barcode']; ?></p>
                                            <span style="color:red;font-size:40;"><?php echo htmlentities($val2['field_bc_name2']); ?></span>
                                        </td> 
                                    </tr>
                                    <tr>

                                        <td height="60px" colspan="2"
                                            style="border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;text-align:center;">
                                            <p style="font-size:60px;color:red;"><?php echo $val2['field_itemcode']; ?></p>

                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td height="30px" colspan="2"
                                            style="border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;border-bottom: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;text-align:right;font-size:30px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <?php
                    }
                     
                }

                //โกดังA4 ราคาเดียว
                // elseif ($val2['field_type_sign_price'] == '1') {
                elseif ($val2['field_signsize'] == '12' && $val2['field_type_sign_price'] == '1') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์

                        if ($count_str <= 20) {
                            $font_size = "font-size:110 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:105 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:95 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:80 px;";
                        }
                        ?>

                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="280px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <div height="130px" style="padding-left:20px;padding-right:20px;">
                            <span style="font-size:40;color:IndianRed;text-align:center;"><?php echo $val2['field_bc_name2']; ?></span>
                            </div>
                            <div height="80px" style="padding-left:100px;text-align:left;">
                                <span
                                    style="text-align:left;font-size:100 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?></span>
                            </div>
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }
                //โกดังครึ่งA4 ราคาเดียว
                elseif ($val2['field_signsize'] == '13' && $val2['field_type_sign_price'] == '1') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:75 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:65 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:55 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:50 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                         ?>
                                              <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                 <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                             </div> -->
                        <div class="bg-img-size2" height="170px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="190px" style="padding-top:20px;line-height: 1;">
                                <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                            </div>
                            <div height="95px" style="padding-left:20px;padding-right:20px;">
                                <span style="font-size:30;color:IndianRed;text-align:center;"><?php echo $val2['field_bc_name2']; ?></span>
                            </div>
                            <div height="80px" style="padding-left:100px;text-align:left;">
                                <span
                                    style="text-align:left;font-size:70 px;color:IndianRed;"><?php echo $price1." .- / ".$val2['field_unitcode1']; ?></span>
                            </div>
                        </div>
                        <div height="80px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:50px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.1" /><br>
                                        <p style="font-size:20;"><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="300px" style="padding:20px">
                                        <img height="50px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                                        <?php
                    }
                     
                }

                //โกดังครึ่งA4 ปรับราคา
                elseif ($val2['field_signsize'] == '13' && $val2['field_type_sign_price'] == '5') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:75 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:65 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:55 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:50 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                         ?>
                                              <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                 <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                             </div> -->
                        <div class="bg-img-size2" height="170px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="190px" style="padding-top:20px;line-height: 1.2;">
                                <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                            </div>
                            <div height="95px" style="padding-left:20px;padding-right:20px;">
                                <span style="font-size:30;color:IndianRed;text-align:center;"><?php echo $val2['field_bc_name2']; ?></span>
                            </div>
                            <div height="80px" style="padding-left:100px;text-align:left;">
                                <span
                                    style="text-align:left;font-size:70 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?></span>
                            </div>
                        </div>
                        <div height="80px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:50px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.1" /><br>
                                        <p style="font-size:20;"><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="300px" style="padding:20px">
                                        <img height="50px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                                        <?php
                    }
                     
                }

                //โกดังA4 ปรับราคา
                // elseif ($val2['field_type_sign_price'] == '1') {
                elseif ($val2['field_signsize'] == '12' && $val2['field_type_sign_price'] == '5') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์

                        if ($count_str <= 20) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:80 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:70 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:65 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:55 px;";
                        }
                        ?>

                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="280px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                            <div height="130px" style="padding-left:20px;padding-right:20px;">
                            <span style="font-size:40;color:IndianRed;text-align:center;"><?php echo $val2['field_bc_name2']; ?></span>
                            </div>
                            <div height="80px" style="padding-left:100px;text-align:left;">
                                <span
                                    style="text-align:left;font-size:100 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?></span>
                            </div>
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }

                //ป้ายหน้าชั้น ไม่มีราคา
                if ($val2['field_signsize'] == '4' && $val2['field_type_sign_price'] == '8') {
                    if ($count_str <= 20) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:23 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:22 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:21 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:20 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:18 px;";
                    }
                    // # code...$val2['field_signamount']
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <!-- <div class="row"> -->
                        <div class="col-md-6">
                        <div class="col-md-11" style="padding:5px;">
                            <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                <tr>
                                    <td width="4cm" style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                            height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                    <td width="5cm" style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                        rowspan="3" colspan="2" class="itemname">
                                        <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                    </td>
                                </tr>
                                <tr>

                                    <td rowspan="2" width="4cm"
                                        style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                        <br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                        <p><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="padding-bottom:5px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                </tr>
                                
                            </table>
                        </div>
                        </div>
                        <!-- </div> -->

                        <?php
                    }
                }
                //A4 ไม่มีราคา
                // elseif ($val2['field_type_sign_price'] == '1') {
                elseif ($val2['field_signsize'] == '1' && $val2['field_type_sign_price'] == '8') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์

                        if ($count_str <= 20) {
                            $font_size = "font-size:150 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:110 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:90 px;";
                        }
                        ?>

                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="550px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }

                //A42ด้าน ไม่มีราคา
                // elseif ($val2['field_type_sign_price'] == '1') {
                elseif ($val2['field_signsize'] == '9' && $val2['field_type_sign_price'] == '8') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) { 
                        ?>
                        <?php
                        //นับตัวแปรว่ามีกี่พยางค์

                        if ($count_str <= 20) {
                            $font_size = "font-size:150 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:130 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:120 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:110 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:100 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:90 px;";
                        }
                        ?>

                        <div class="bg-img-size1" height="400px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="550px" style="padding-top:25px;line-height: 1.3;">
                                <span style="<?php echo $font_size; ?>text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                            </div>
                        </div>
                        <div height="120px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.3" /><br>
                                        <p><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    
                }

                //ครึ่งA4 ไม่มีราคา
                elseif ($val2['field_signsize'] == '2' && $val2['field_type_sign_price'] == '8') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:100 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:85 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:75 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:65 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                        <div class="bg-img-size2" height="200px"
                            style="border: 5px solid IndianRed;overflow:wrap;text-align:center;margin-right:0px;">
                            <div height="370px" style="padding-top:20px;line-height: 1.5;">
                                <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                            </div>
                        </div>
                        <div height="80px"
                            style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin:0px;margin-bottom:50px;">
                            <table style="text-align:center;">
                                <tr>
                                    <td width="350px" style="padding:20px">
                                    <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.9"
                                            height="1.1" /><br>
                                        <p style="font-size:20;"><?php echo $val2['field_barcode']; ?></p>
                                    </td>
                                    <td width="350px" style="padding:20px">
                                        <p style="font-size:30px;"><?php echo $val2['field_itemcode']; ?></p>
                                        <p style="font-size:25px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                    </td>
                                    <td width="300px" style="padding:20px">
                                        <img height="50px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                    </td>
                                </tr>
                            </table>
                        </div>
                                        <?php
                    }
                        
                }
                //สี่ส่วน A4 ไม่มีราคา
                elseif ($val2['field_signsize'] == '3' && $val2['field_type_sign_price'] == '8') {
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                        if ($count_str <= 20) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:40 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="250px" style="padding-top:15px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
 
                            </div>
                        <div height="60px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //สี่ส่วน A42ด้าน ไม่มีราคา
                elseif ($val2['field_signsize'] == '20' && $val2['field_type_sign_price'] == '8') {
                    for ($i=0; $i < $val2['field_signamount']*2; $i++) {
                        # code...
                        if ($count_str <= 20) {
                            $font_size = "font-size:90 px;";
                        }
                        elseif ($count_str <= 30) {
                            $font_size = "font-size:60 px;";
                        }
                        elseif ($count_str <= 40) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 50) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str <= 60) {
                            $font_size = "font-size:50 px;";
                        }
                        elseif ($count_str > 60) {
                            $font_size = "font-size:40 px;";
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="bg-img-size3" height="200px"
                                style="margin-right:10px;margin-left:10px;margin-top:10px;border: 5px solid IndianRed;overflow:wrap;text-align:center;">
                                <div height="250px" style="padding-top:15px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> text-align:center;"><?php echo $val2['field_itemname']; ?></span>
                                </div>
    
                            </div>
                        <div height="60px"
                                style="border-left: 5px solid IndianRed;border-right: 5px solid IndianRed;border-bottom: 5px solid IndianRed;overflow: wrap;margin-right:10px;margin-left:10px;">
                                <table style="text-align:center;">
                                    <tr>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                        <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="1.2"
                                            height="1.4" /><br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                        </td>
                                        <td width="200px" style="padding:5px;text-align:center;">
                                            <p style="font-size:20px;"><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="font-size:15px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                        <td width="80px" style="padding:5px;text-align:center;">
                                            <img height="40px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                                <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                                            <?php
                    }
                }

                //ป้ายของSCT,CTI
                elseif ($val2['field_signsize'] == '14'){
                    if ($count_str <= 20) {
                        $font_size = "font-size:18 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:17 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:16 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:14 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:12 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:11 px;";
                    }


                    $barcode = '<barcode style="padding-bottom:1px;" code="<?php echo $code ?>" type="C128A" size="0.3"
                    height="2" />';
                    if ($count_barcode == 7) {
                        $barcode = '<barcode style="padding-bottom:1px;" code="<?php echo $code ?>" type="C128A" size="0.3"
                        height="2" />';
                    }
                    elseif($count_barcode == 13){
                        $barcode = '<barcode style="padding-bottom:1px;" code="<?php echo $code ?>" type="C128A" size="0.3"
                        height="2" />';
                    }

                    elseif($count_barcode == 0){
                        $barcode = '';
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        ?>
                            <div height="100px" class="col-md-2" style="border: 5px solid black;margin-left:10px;margin-bottom:10px;">                          
                                <div class="col-md-10" style="margin-top:5px;margin-right:20px;margin-left:12px;">
                                        <div  height="50px" style="<?php echo $font_size; ?>text-align:center;">
                                            <?php echo $val2['field_itemname']; ?>
                                        </div>
                                        <div  height="30px" style="font-size:13px;text-align:center;">
                                            <?php echo $val2['field_itemcode']; ?>
                                            <?php echo $barcode; ?>
                                            <?php echo $val2['field_barcode']; ?>
                                        </div>
                                </div>
                                <div class="col-md-8" style="font-size:12px;padding-left:5px;text-align:left;">
                                    <div class="form-group">
                                        <span><?php echo $val2['field_comment']; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3" style="font-size:10px;padding-right:5px;text-align:right;">
                                    <div class="form-group">
                                        <?php echo date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?>
                                    </div>
                                </div>
                            </div>
                        <?php 
                    }
                }

                //ครึ่งA4 ป้ายหน้ากล่องสินค้า
                elseif ($val2['field_signsize'] == '2' && $val2['field_type_sign_price'] == '9') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:100 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:75 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:55 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:50 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:45 px;";
                    }
                    
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                                    <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                    <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                                </div> -->
                        <div height="50px"
                            style="border: 2px solid;overflow: wrap;margin:0px;text-align:right;font-size:30px;padding-top:5px;">
                            <div class="col-md-8">
                                <span>ป้ายหน้ากล่องสินค้า</span>
                            </div>
                            <div class="col-md-4">
                                <span style="font-size:13px;"><?php echo "พิมพ์ ".date("d")."/", date("m"), "/",substr($date_year, 2 ,4); ?></span>
                                <span style="font-size:13px;"><?php echo $employee['firstname']."(".$employee['nickname'].")"; ?></span>
                            </div>

                        </div>
                        <div height="450px"
                            style="border-bottom: 2px solid;border-right: 2px solid;border-left: 2px solid;overflow:wrap;text-align:center;margin-bottom:10px;">
                            <div height="450px" class="col-md-4" style="border-right:2px solid;">
                                <div height="100px" class="col-md-12"><span style="font-size:20px"><?php echo $val2['field_itemname']; ?></span></div>
                                <div height="150px" class="col-md-12"><span style="font-size:20px"><?php echo $val2['field_itemcode']; ?></span></div>
                                <div height="110px" class="col-md-11" style="border: 2px solid;margin:8px;">
                                    <div height="60px">
                                        <span style="font-size:55px;"><?php echo $val2['field_comment']; ?></span>
                                    </div>
                                    
                                    <div height="30px" style="text-align:right;padding-right:10px;">
                                        <span style="font-size:25px;"><?php echo $val2['field_unitcode1']; ?></span>
                                    </div>
                                    
                                </div>
                                <div  class="col-md-12" style="text-align:left;padding-left:5px;" >
                               
                                    <span style="font-size:16px;">ผู้ตรวจนับ..................</span>
                                    <span style="font-size:16px;">วันที่.....................</span>
                                    <span style="font-size:14px;color:red">*ชื่อจริง(ชื่อเล่น)เท่านั้น!</span>
                                </div>
                            </div>
                            <div class="col-md-8" style="line-height: 2.8;text-align:left;padding-left:5px;">
                                <span style="font-size:16px;">แก้ไขครั้งที่ 1 คงเหลือ______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_______________(&emsp;&emsp;&emsp;) วันที่________</span><br>
                                <span style="font-size:16px;">แก้ไขครั้งที่ 2 คงเหลือ______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_______________(&emsp;&emsp;&emsp;) วันที่________</span><br>
                                <span style="font-size:16px;">แก้ไขครั้งที่ 3 คงเหลือ______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_______________(&emsp;&emsp;&emsp;) วันที่________</span><br>
                                <span style="font-size:16px;">แก้ไขครั้งที่ 4 คงเหลือ______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_______________(&emsp;&emsp;&emsp;) วันที่________</span><br>
                                <span style="font-size:16px;">แก้ไขครั้งที่ 5 คงเหลือ______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_______________(&emsp;&emsp;&emsp;) วันที่________</span><br>
                                <span style="font-size:16px;">แก้ไขครั้งที่ 6 คงเหลือ______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_______________(&emsp;&emsp;&emsp;) วันที่________</span><br>
                                <span style="font-size:16px;">แก้ไขครั้งที่ 7 คงเหลือ______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_______________(&emsp;&emsp;&emsp;) วันที่________</span><br>
                                <span style="font-size:16px;">แก้ไขครั้งที่ 8 คงเหลือ______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_______________(&emsp;&emsp;&emsp;) วันที่________</span><br>
                                <span style="font-size:16px;">แก้ไขครั้งที่ 9 คงเหลือ______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_______________(&emsp;&emsp;&emsp;) วันที่________</span><br>
                                <span style="font-size:16px;">แก้ไขครั้งที่ 10 คงเหลือ______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_______________(&emsp;&emsp;&emsp;) วันที่________</span>
                            </div>
                            <!-- <div height="220px" style="padding-top:20px;line-height: 1;">
                                <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span> -->
                                <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                            <!-- </div>
                            <div height="100px" style="padding-left:100px;text-align:left;">
                                <span
                                    style="text-align:left;font-size:80 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?></span>
                            </div> -->
                        </div>
                        
                        <?php
                    }
                        
                }

                //สี่ส่วน A42 ป้ายหน้ากล่องสินค้า
                elseif ($val2['field_signsize'] == '3' && $val2['field_type_sign_price'] == '9') {

                    if ($count_str <= 20) {
                        $font_size = "font-size:100 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:90 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:50 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                                    <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                    <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                                </div> -->
                        <div class="col-ml-6" style="padding:5px;">
                            <div height="30px"
                                style="border: 2px solid;overflow: wrap;margin:0px;text-align:right;font-size:20px;padding-top:5px;">
                                <div class="col-md-8">
                                    <span>ป้ายหน้ากล่องสินค้า</span>
                                </div>
                                <div class="col-md-4">
                                    <span style="font-size:11px;"><?php echo "พิมพ์ ".date("d")."/", date("m"), "/",substr($date_year, 2 ,4); ?></span>
                                    <span style="font-size:11px;"><?php echo $employee['firstname']."(".$employee['nickname'].")"; ?>&emsp;</span>
                                </div>
                            </div>
                            <div height="300px"
                                style="border-bottom: 2px solid;border-right: 2px solid;border-left: 2px solid;overflow:wrap;text-align:center;margin-bottom:10px;">
                                <div height="200px" class="col-md-4" style="border-right:2px solid;">
                                    <div height="100px" class="col-md-12"><span style="font-size:16px"><?php echo $val2['field_itemname']; ?></span></div>
                                    <div height="60px" class="col-md-12"><span style="font-size:16px"><?php echo $val2['field_itemcode']; ?></span></div>
                                    <div height="80px" class="col-md-11" style="border: 2px solid;margin:5px;">
                                        <div height="40px">
                                            <span style="font-size:40px;"><?php echo $val2['field_comment']; ?></span>
                                        </div>
                                        
                                        <div height="30px" style="text-align:right;padding-right:10px;">
                                            <span style="font-size:20px;"><?php echo $val2['field_unitcode1']; ?></span>
                                        </div>
                                        <!-- <span style="font-size:20px;"><?php echo $val2['field_comment']." ".$val2['field_unitcode1']; ?></span> -->
                                    </div>
                                    <div  class="col-md-12" style="text-align:left;padding-left:5px;" >
                                        <span style="font-size:14px;">ผู้ตรวจนับ..........</span>
                                        <span style="font-size:14px;">วันที่..............</span>
                                        <span style="font-size:12px;color:red">*ชื่อจริง(ชื่อเล่น)เท่านั้น!</span>
                                    </div>
                                </div>
                                <div class="col-md-8" style="line-height: 2.2;text-align:left;padding-left:4px;">
                                    <span style="font-size:13px;">แก้ไขครั้งที่ 1 คงเหลือ_______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_________________(&emsp;&emsp;&emsp;) วันที่_______________</span><br>
                                    <span style="font-size:13px;">แก้ไขครั้งที่ 2 คงเหลือ_______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_________________(&emsp;&emsp;&emsp;) วันที่_______________</span><br>
                                    <span style="font-size:13px;">แก้ไขครั้งที่ 3 คงเหลือ_______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_________________(&emsp;&emsp;&emsp;) วันที่_______________</span><br>
                                    <span style="font-size:13px;">แก้ไขครั้งที่ 4 คงเหลือ_______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_________________(&emsp;&emsp;&emsp;) วันที่_______________</span><br>
                                    <span style="font-size:13px;">แก้ไขครั้งที่ 5 คงเหลือ_______<?php echo $val2['field_unitcode1']; ?> ชื่อ-สกุล_________________(&emsp;&emsp;&emsp;) วันที่_______________</span>
                                </div>
                                <!-- <div height="220px" style="padding-top:20px;line-height: 1;">
                                    <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']; ?></span> -->
                                    <!-- <span style="<?php echo $font_size; ?> px;text-align:center;"><?php echo $val2['field_itemname']." ".$count_str; ?></span> -->
                                <!-- </div>
                                <div height="100px" style="padding-left:100px;text-align:left;">
                                    <span
                                        style="text-align:left;font-size:80 px;color:IndianRed;"><?php echo $new_price1." .- / ".$val2['field_unitcode1']; ?></span>
                                </div> -->
                            </div>
                        </div>
                        <?php
                            if ($orderby == '2') { ?>
                              <div class="col-md-6" height="200px" ></div><div height="10px"></div>
                        <?php } ?>
                        <?php
                    }
                        
                }

                //ป้ายหน้าชั้น(ยาว) ราคาเดียว
                elseif ($val2['field_signsize'] == '15' && $val2['field_type_sign_price'] == '1') {
                    if ($count_str <= 20) {
                        $font_size = "font-size:35 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:32 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:28 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:25 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:22 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:18 px;";
                    }
                    // # code...$val2['field_signamount']
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>
                        <!-- <div class="row"> -->
        
                            <div style="padding:5px;">
                                <table style="border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                    <tr>
                                        <td  style="text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"> <img
                                                height="30" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></td>
                                        <td style="<?php echo $font_size; ?>text-align:center;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;"
                                            rowspan="2" colspan="2" class="itemname">
                                            <p><?php echo $val2['field_itemname'].'<br>'; ?></p>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td rowspan="2" 
                                            style="padding-top:5px;text-align:center; font-size: 16px;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                            <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="2.2" />
                                            <br>
                                            <p><?php echo $val2['field_barcode']; ?></p>
                                            <p><?php echo $val2['field_itemcode']; ?></p>
                                            <p style="padding-bottom:5px;">
                                                <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"
                                            style="text-align:center;padding:5px;color:red;border: 2px solid RoyalBlue;height: 22px;overflow: wrap;">
                                            <h1> <?php echo $price1.".-/".$val2['field_unitcode1']; ?> </h1>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- </div> -->

                        <?php
                    }
                }

                //สต็อกราคาA4(ลูกศร)
                elseif ($val2['field_signsize'] == '16') {
                    if ($count_str <= 20) {
                        $font_size = "font-size:1000 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:95 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:90 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:85 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:80 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:75 px;";
                    }
                    for ($i=0; $i < $val2['field_signamount']; $i++) {
                        # code...
                            ?>
                            <!-- <div height="180px" style="padding-top:20px;line-height: 1;border: 5px solid IndianRed;overflow: wrap;text-align:center;margin:0px;">
                                    <span style="font-size:80 px;"><?php echo $val2['field_itemname']; ?></span>
                                </div> -->
                            <div height="500px" style="text-align:center;margin-right:0px;margin-bottom:20px;">
                                <table>
                                    <tr>
                                        <td height="90px" width="280px" style="border: 3px solid RoyalBlue;overflow:wrap;text-align:center;">
                                            <img height="60px" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg">
                                        </td>
                                        <td  rowspan="2" colspan="2"
                                            style="<?php echo $font_size; ?>border-top: 3px solid RoyalBlue;border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;text-align:center;">
                                            <?php echo $val2['field_itemname']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-stock" rowspan="4" 
                                            style="border: 3px solid RoyalBlue;text-align:center;">
                                            <img height="300px" src="<?php echo base_url('assets/images');?>/<?php echo $arrow; ?>.png" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="100px" colspan="2"
                                            style="text-align:center;line-height: 1.5;border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;vertical-align:text-top;">
                                            <barcode style="padding-bottom:4px;" code="<?php echo $code; ?>" type="C128A" size="0.7"
                                                height="2.4" /><br>
                                            <p ><?php echo $val2['field_barcode']; ?></p>
                                            <span style="color:red;font-size:90;">
                                                <?php echo $price1." .- / ".$val2['field_unitcode1']; ?>
                                            </span>
                                        </td> 
                                    </tr>
                                    <tr>

                                        <td height="60px" colspan="2"
                                            style="border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;text-align:center;">
                                            <p style="font-size:60px;color:red;"><?php echo $val2['field_itemcode']; ?></p>
                                        </td>
                        
                                    </tr>
                                    <tr>
                                        <td height="30px" colspan="2"
                                            style="border-left: 3px solid RoyalBlue;border-right: 3px solid RoyalBlue;border-bottom: 3px solid RoyalBlue;overflow:wrap;margin-right:0px;text-align:right;font-size:30px;">
                                            <?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <?php
                    }
                        
                }

                //ป้ายไฮดรอลิค
                elseif ($val2['field_signsize'] == '19') {
                    if ($count_str <= 10) {
                        $font_size = "font-size:70 px;";
                    }
                    elseif ($count_str <= 20) {
                        $font_size = "font-size:60 px;";
                    }
                    elseif ($count_str <= 30) {
                        $font_size = "font-size:50 px;";
                    }
                    elseif ($count_str <= 40) {
                        $font_size = "font-size:45 px;";
                    }
                    elseif ($count_str <= 50) {
                        $font_size = "font-size:35 px;";
                    }
                    elseif ($count_str <= 60) {
                        $font_size = "font-size:75 px;";
                    }
                    elseif ($count_str > 60) {
                        $font_size = "font-size:70 px;";
                    }
                    // # code...$val2['field_signamount']
                    for ($i=0; $i < $val2['field_signamount']; $i++) { 
                        ?>

                        <div class="col-md-12" style="border: 2px solid RoyalBlue;padding-top:5px;">
                            <!-- <div style="border: 2px solid RoyalBlue;height: 22px;">
                            </div> -->

                            <div class="col-md-4 text-left" style="padding-top:4px;padding-left:5pxl"><?php echo $val2['field_itemcode']; ?></div>
                            <div class="col-md-4 text-center"><img height="25" src="<?= base_url('assets/images/logo_company');?>/logo_company_1.jpg"></div>
                            <div class="col-md-4 " style="text-align:right;padding-top:4px;"><?php echo "printed ".date("d").".", date("m"), ".",substr($date_year, 2 ,4); ?></div>
                            <div height="95" class="col-md-12 text-center vertical-center" style="<?php echo $font_size ?> padding-top:10px; line-height:1.5;">
                                    <?php echo $val2['field_itemname']; ?>
                            </div>
                        </div>

                        <?php
                    }
                }
            }
        }

        ?>
        <br>
        <!-- <b>วันที่พิมพ์ : </b><?php echo $thaiweek[date("w")] ,"ที่",date(" j "), $thaimonth[date(" m ")-1] , " พ.ศ. ",date(" Y ")+543, date(" H:i:s"); ?> -->
</body>

<?php 
    function utf8_strlen($s) 
    {
        $c = strlen($s); $l = 0;
        for ($i = 0; $i < $c; ++$i)
        if ((ord($s[$i]) & 0xC0) != 0x80) ++$l;
        return $l;
    }

    function escapeHtml($unsafe)
    {
        
        str_replace('&','&amp;',$unsafe);
        str_replace('<','&lt;',$unsafe);
        str_replace('>','&gt;',$unsafe);
        str_replace('"','&quot;',$unsafe);
        str_replace("'",'&#039;',$unsafe);
        return $unsafe;
    }

?>
<!-- // echo $val2['field_id'].'<br>';
                // echo $val2['field_itemcode'].'<br>';
                // echo $val2['field_itemname'].'<br>';
                // echo $val2['field_signsize'].'<br>';
                // echo $val2['field_signamount'].'<br>';
                // echo $val2['field_unitcode1'].'<br>';
                // echo $val2['field_unitcode2'].'<br>';
                // echo $val2['field_unitcode3'].'<br>';
                // echo $val2['field_unitcode4'].'<br>';
                // echo $val2['field_fromQty1'].'<br>';
                // echo $val2['field_fromQty2'].'<br>';
                // echo $val2['field_fromQty3'].'<br>';
                // echo $val2['field_fromQty4'].'<br>';
                // echo $val2['field_price1'].'<br>';
                // echo $val2['field_price2'].'<br>';
                // echo $val2['field_price3'].'<br>';
                // echo $val2['field_price4'].'<br>';
                // echo $val2['field_rate1'].'<br>';
                // echo $val2['field_rate2'].'<br>';
                // echo $val2['field_rate3'].'<br>';
                // echo $val2['field_rate4'].'<br>';
                // echo $val2['field_barcode'].'<br>';
                // echo $val2['field_old_price'].'<br>'; -->