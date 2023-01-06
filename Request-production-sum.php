<head>
    <script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js')?>"></script>

    <link href="<?= base_url('assets/css/style.css');?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css')?>" >

    <title>ใบสั่งผลิต / ใบสั่งซ่อม</title>
    <?php $thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
    $thaiweek=array("วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัส","วันศุกร์","วันเสาร์");
    ?>
</head>        

<style>
    div{
    font-size: 18px;
    }

    .width-table{
    width: 100px;
    text-align: center;
    }

    .table-bordered>tbody>tr>td{
    padding:1.5px 5px 1.5px 5px;
    font-size: 18px;
    }

    .table-bordered>tbody>tr>th{
    padding:1.5px 5px 1.5px 5px;
    font-size: 18px;
    }

    .tablea {
	border-collapse: collapse;
	}

	.tablea-bora, td, th {
    padding:1.5px 5px 1.5px 5px;
	border: 0.2px solid grey;
    font-size: 18px;
	}
</style>

<script>

    // window.onload = function () {
    
    //     window.print();
    //     setTimeout(function(){window.close();}, 1);
    // } 

    function imgError(image){
      image.style.display = 'none';
    }
</script>

<body class="fonts_SarabunPSK">
    <div style="width:210mm; height:128mm; background:white; margin:auto;">
       
        <div align="right">วันที่พิมพ์ :<?php echo date(" j "), $thaimonth[date(" m ")-1] , " พ.ศ. ",date(" Y ")+543; ?></div>

        <div align="center">
            <img src="<?= base_url('assets/images/logo_saeree.jpg');?>" >
        </div>

        <div align="center" >
            <h3><b>สรุปงาน ใบสั่งผลิต / ใบสั่งซ่อม เลขที่  <?= $data_rp['field_docno'] ?></b></h3>
        </div>

      
        <div align="left"><b> รายละเอียดงาน </b></div>
        <table style="width:100%;" class="table table-bordered fonts_SarabunPSK">

            <tr>
                <td><b>ชื่องาน :</b> <?= $data_rp['field_rp_name']?></td>
            </tr>

            <tr>
                <td><b> ผู้ทําใบสั่งผลิต / ใบสั่งซ่อม :</b>  <?= $data_rp['ecfullname']?> <b>แผนก : </b><?= $data_rp['dcname'] ?></td>
            </tr>

            <tr>
                <td><b> ผู้ควบคุมการผลิต / การซ่อม :</b>  <?= $data_rp['ectfullname']?> <b>แผนก : </b><?= $data_rp['dctname'] ?></td>
            </tr>

            <tr>
                <td><b> แผนกที่รับผลิต / การซ่อม :</b>  <?= $data_rp['topic_name'] ?></td>
            </tr>

            <tr>
                <td><b>เหตุผลการสั่งผลิต/สั่งซ่อม :</b><br> <?= $data_rp['field_rp_cause'] ?></td>
            </tr>

            <tr>
                <td><b>ประวัติการซ่อม :</b><br> <?= $data_rp['field_rp_fix'] ?></td>
            </tr>

            <tr>
                <td><b>รายละเอียดงาน :</b><br> <?= $data_rp['field_rp_description'] ?></td>
            </tr>

            <tr>
			    <td><b>วันที่ต้องการงาน : </b> <?= date_format(date_create($data_rp['field_rp_require_date']),'d'),"/", date_format(date_create($data_rp['field_rp_require_date']),'m'),"/",date_format(date_create($data_rp['field_rp_require_date']),'Y')+543; ?></td>	
		    </tr>

        </table>  

        <div align="left"><b> พนักงานที่ใช้ในการผลิต / การซ่อม </b> จำนวนพนักงานที่ระบุไว้ในใบสั่งผลิต / ใบสั่งซ่อม <?= $data_rp['field_rp_worker'] ?> คน</div>
        <table style="width:100%;" class="table table-bordered fonts_SarabunPSK">

            <tr>
                <td><b>พนักงานที่ลงชื่อรับงาน :</b> <?= $employee?>	 </td>
            </tr>
            
            <tr>
                <td><b>พนักงานที่ปฏิบัติงานจริง :</b> <?= $employee_accept?> </td>
            </tr>

        </table>  
        
       
       
        <div align="left"><b> มูลค่าการผลิต / การซ่อม</b></div>              
      

        <table style="width:100%;" class="table table-bordered fonts_SarabunPSK">
            <tr>
                <td class="text-center" colspan="7"><b> รายการวัสดุ และค่าบริการที่ใช้ </b></td>
            </tr>

            <tr>
                <td class="text-center" style="width: 100px;"><b>ลำดับ</b></td>
                <td class="text-center" style="width: 100px;"><b>รายการวัสดุ และค่าบริการที่ใช้</b></td>
                <td class="text-center" style="width: 100px;"><b>จำนวน</b></td>
                <td class="text-center" style="width: 100px;"><b>หน่วยนับ</b></td>
                <td class="text-center" style="width: 100px;"><b>ราคาต่อหน่วย</b></td>
                <td class="text-center" style="width: 100px;"><b>ราคารวม</b></td>
                <td class="text-center" style="width: 100px;"><b>อ้างอิงเอกสาร</b></td>
            </tr>
            
            <?php 
                $row_no = 0;
                foreach($itemlist as $item) {  $row_no++;?>
                <tr>
                    <td style="width:10%;text-align:center;padding: 0px;"> <?= $row_no ?></td>
                    <td style="width:30%;text-align:left;padding: 0px;"> <?= $item['field_item_name'] ?></td>
                    <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_qty'] ?></td>
                    <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_unit'] ?></td>
                    <td style="width:10%;text-align:right; padding: 0px;"> <?= $item['field_item_priceunit'] ?></td>
                    <td style="width:10%;text-align:right; padding: 0px;"> <?= $item['field_item_price'] ?></td>
                    <td>

                        <?php

                            if($item['field_bc_docno'] != ''){

                                $item_qty = floatval( $item['field_item_qty']);
                                if($item['stkissue_docno'] !== ''){
                                    $stkissue_qty = floatval($item['stkissue_qty']);
                                }
                                $unit_price = floatval($item['field_item_priceunit']);
                                if($item['stkissueRet_docno'] !== ''){
                                    $stkissueRet_qty = floatval($item['stkissueRet_qty']);
                                    $sum_qty = $stkissue_qty - $stkissueRet_qty;
                                    $sum_diffrow = $stkissueRet_qty * $unit_price;
                                }
                                if($item['stkissue_docno'] !== ''){
                                    if($item['stkissueRet_docno'] !== ''){
                                        echo "เบิกสินค้าจริง<br>". $item['stkissue_docno']."(".$sum_qty.")<br>";
                                        echo "รับคืนสินค้า<br>". $item['stkissueRet_docno']."(".$stkissueRet_qty.")";
                                    }else{
                                        echo "เบิกสินค้าเต็มจำนวน<br>". $item['stkissue_docno']."(".$stkissue_qty.")";
                                    }
                                }else{
                                    echo "ไม่ได้ทำเบิกสินค้า";
                                }
                            
                            }else{

                            }   

                        ?>

                    </td>
                </tr>
            <?php }  ?>

            <tr>
                <td class="text-left" colspan="6"><b> รวมค่าวัสดุ และค่าบริการประมาณการ</td>
                <td class="text-left"><b><?= $data_rp['field_rp_cost_estimate']?> บาท</b></td>
            </tr>

            <tr>
                <td class="text-left" colspan="6"><b> รวมค่าวัสดุ และค่าบริการที่ใช้จริง</td>
                <td class="text-left"><b><?= $data_rp['field_rp_cost_final']?> บาท</b></td>
            </tr>

            <tr>
                <td class="text-left" colspan="7"><b>หมายเหตุเพิ่มเติม : <?= $data_rp['field_rp_cost_final_comment']?></b></td>
            </tr>
           
        </table>
                      
    </div>    
</body>