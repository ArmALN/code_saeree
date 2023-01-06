<head>
    <script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js')?>"></script>

    <link href="<?= base_url('assets/css/style.css');?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css')?>" >

    <title>ใบสั่งผลิต-ใบสั่งซ่อม</title>
    <?php 
        date_default_timezone_set("Asia/Bangkok");
        $thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
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
        <div align="right">วันที่พิมพ์ :<?php echo date(" j "), $thaimonth[date(" m ")-1] , " พ.ศ. ",date(" Y ")+543;?> เวลา <?php echo date("H:i")?> น.</div>

        <div align="center">
            <img src="<?= base_url('assets/images/logo_saeree.jpg');?>" >
        </div>
       
        <div align="center" >
            <h3><b>ใบสั่งผลิต-ใบสั่งซ่อม เลขที่  <?= $data_rp['field_docno'] ?></b></h3>
        </div>

        <br>
        <div align="left"><b>ส่วนที่ 1 ข้อมูลการสั่งผลิต-สั่งซ่อม</b></div>
        <table style="width:100%;" class="table table-bordered fonts_SarabunPSK">
            <tr>
                <td style="width:50%;"><b>ผู้ทำใบสั่งผลิต-ใบสั่งซ่อม :</b> <?= $data_rp['ecfullname']?>  </td>
                <td style="width:50%;"><b>แผนก :</b> <?= $data_rp['dcname'] ?></td>
            </tr>
           
            <tr>
                <td style="width:50%;"><b>ผู้ควบคุมการผลิต / การซ่อม :</b> <?= $data_rp['ectfullname']?> </td>
                <td style="width:50%;"><b>แผนก :</b> <?= $data_rp['dctname'] ?></td>
            </tr>

            <tr>
                <td colspan="2"><b>แผนกที่รับผลิต / รับซ่อม :</b> <?= $data_rp['topic_name'] ?> </td> 
            </tr>


        </table> 
            
        <div align="left"><b>ส่วนที่ 2 รายละเอียดงาน</b></div>
        <table style="width:100%;" class="table table-bordered fonts_SarabunPSK">
            
            <tr>
                <td><b>ชื่องาน :</b> <?= $data_rp['field_rp_name']?></td>
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

            <!-- <tr>
			    <td><b>มูลค่าต้นทุนผลิต / ซ่อม : </b> <?= $data_rp['field_rp_cost_estimate']?> บาท </td>	
		    </tr> -->

            <tr>
			    <td><b>จำนวนพนักงานที่ใช้ : </b> <?= $data_rp['field_rp_worker']?> คน </td>	
		    </tr>
           

        </table>  

        <?php
            if ($type == 3) { ?>
                <table style="width:100%;" class="table table-bordered fonts_SarabunPSK">
                    <tr>
                        <td class="text-center" colspan="8"><b> รายการวัสดุ และค่าบริการที่ใช้ </b></td>
                    </tr>

                    <tr>
                        <td class="text-center" style="width: 100px;"><b>ลำดับ</b></td>
                        <td class="text-center" style="width: 100px;"><b>รายการวัสดุ และค่าบริการที่ใช้</b></td>
                        <td class="text-center" style="width: 100px;"><b>จำนวน</b></td>
                        <td class="text-center" style="width: 100px;"><b>คืน</b></td>
                        <td class="text-center" style="width: 100px;"><b>หน่วยนับ</b></td>
                        <td class="text-center" style="width: 100px;"><b>ราคาต่อหน่วย</b></td>
                        <td class="text-center" style="width: 100px;"><b>ราคารวม</b></td>
                        <td class="text-center" style="width: 100px;"><b>ใบขอเบิก</b></td>
                    </tr>

                    <?php 
                        $row_no = 0;
                        $total_net = 0;
                        foreach($data_laborlist as $item) {  $row_no++;?>
                          <?php  $total_net = $total_net + $item['field_item_price']; ?>
                        <tr>
                            <td style="width:10%;text-align:center;padding: 0px;"> <?= $row_no ?></td>
                            <td style="width:30%;text-align:left;padding: 0px;"> <?= $item['field_item_name'] ?></td>
                            <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_qty'] ?></td>
                            <td style="width:10%;text-align:center;padding: 0px;">0</td>
                            <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_unit'] ?></td>
                            <td style="width:10%;text-align:right; padding: 0px;"> <?= $item['field_item_priceunit'] ?></td>
                            <td style="width:10%;text-align:right; padding: 0px;"> <?= $item['field_item_price'] ?></td>
                            <td style="width:15%;text-align:center;padding: 0px;">
                                <?php 
                                if($item['field_bc_docno'] == null){
                                    echo "-";
                                    }else{
                                    echo $item['field_bc_docno'];
                                    }
                                ?>
                            </td>
                        </tr>

                        <?php }  

                        foreach($data_itemlist as $item) {  $row_no++;?>

                          <?php  
                            $item_retqty = 0;

                            $item_retqty = $item['stkissueRet_qty']; 

                            if (isset($item['stkissueRet_qty2'])) {
                                $item_retqty = $item_retqty + $item['stkissueRet_qty2']; 
                            }
                            
                            $total_qty = $item['field_item_qty'] - $item_retqty; 



                            $total_price = $item['field_item_priceunit'] * $total_qty;

                            $total_net = $total_net + $total_price;
                          ?>

                        <tr>
                            <td style="width:10%;text-align:center;padding: 0px;"> <?= $row_no ?></td>
                            <td style="width:30%;text-align:left;padding: 0px;"> <?= $item['field_item_name'] ?></td>
                            <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_qty'] ?></td>
                            <td style="width:10%;text-align:center;padding: 0px;"> <?= number_format($item_retqty,2) ?></td>
                            <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_unit'] ?></td>
                            <td style="width:10%;text-align:right; padding: 0px;"> <?= $item['field_item_priceunit'] ?></td>
                            <td style="width:10%;text-align:right; padding: 0px;"> <?= $total_price ?></td>
                            <td style="width:15%;text-align:center;padding: 0px;">
                                <?php 
                                if($item['field_bc_docno'] == null){
                                    echo "-";
                                    }else{
                                    echo $item['field_bc_docno'];
                                    }
                                ?>
                            </td>
                        </tr>
                    
                    <?php }  ?>
                    <?php 
                        // $row_no = 0;
                        foreach($data_rp_item as $item) {  $row_no++;?>
                        <!-- <tr>
                            <td style="width:10%;text-align:center;padding: 0px;"> <?= $row_no ?></td>
                            <td style="width:30%;text-align:left;padding: 0px;"> <?= $item['field_item_name'] ?></td>
                            <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_qty'] ?></td>
                            <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_unit'] ?></td>
                            <td style="width:10%;text-align:right; padding: 0px;"> <?= $item['field_item_priceunit'] ?></td>
                            <td style="width:10%;text-align:right; padding: 0px;"> <?= $item['field_item_price'] ?></td>
                            <td style="width:15%;text-align:center;padding: 0px;">
                                <?php 
                                if($item['field_bc_docno'] == null){
                                    echo "-";
                                    }else{
                                    echo $item['field_bc_docno'];
                                    }
                                ?>
                            </td>
                        </tr> -->
                    <?php }  ?>
                    <?php
                        $diff = 0;
                        
                        $diff = $data_rp['field_rp_cost_estimate'] - $total_net ;
                    ?>
                    <tr>
                        <td class="text-center" colspan="4"><b> รวมค่าใช้จ่ายประมาณการ <?= number_format($data_rp['field_rp_cost_estimate'],2)?> บาท</b></td>
                        <td class="text-center" colspan="4"><b> รวมค่าใช้จ่ายจริง <?= number_format($total_net,2)?> บาท</b></td>
                    </tr>
                    <?php
                        if ($diff == 0) { ?>
                            <tr>
                                <td class="text-center" colspan="8"><b> สรุป ค่าใช้จ่ายจริงท่ากับค่าใช้จ่ายประมาณการ</b></td>
                            </tr>
                       <?php }
                        elseif ($diff > 0) {?>
                            <tr>
                                <td class="text-center" colspan="8"><b> สรุป ค่าใช้จ่ายจริงน้อยกว่าค่าใช้จ่ายประมาณการ <?=number_format($diff,2)?> บาท</b></td>
                            </tr>
                        <?php }
                        elseif ($diff < 0) {?>
                            <?php $diff = $diff + (($total_net - $data_rp['field_rp_cost_estimate'])*2) ?>
                            <tr>
                                <td class="text-center" colspan="8"><b> สรุป ค่าใช้จ่ายจริงมากกว่าค่าใช้จ่ายประมาณการ <?=number_format($diff,2)?> บาท</b></td>
                            </tr>
                        <?php }
                    ?>
                    
                </table>
        <?php } elseif ($type == 2) { ?>
                <table style="width:100%;" class="table table-bordered fonts_SarabunPSK">
                    <tr>
                        <td class="text-center" colspan="7"><b> รายการวัสดุที่ใช้ </b></td>
                    </tr>

                    <tr>
                        <td class="text-center" style="width: 100px;"><b>ลำดับ</b></td>
                        <td class="text-center" style="width: 100px;"><b>รายการวัสดุ และค่าบริการที่ใช้</b></td>
                        <td class="text-center" style="width: 100px;"><b>จำนวน</b></td>
                        <td class="text-center" style="width: 100px;"><b>คืน</b></td>
                        <td class="text-center" style="width: 100px;"><b>หน่วยนับ</b></td>
                        <td class="text-center" style="width: 100px;"><b>ราคาต่อหน่วย</b></td>
                        <td class="text-center" style="width: 100px;"><b>ราคารวม</b></td>
                        <td class="text-center" style="width: 100px;"><b>ใบขอเบิก</b></td>
                    </tr>
                    
                    <?php 
                        $row_no = 0;
                        $price_total = 0;
                        $total_net = 0;
                        foreach($data_itemlist as $item) {  $row_no++;
                        if ($item['field_bc_docno'] != null) { ?>
                                <?php  

                                $item_retqty = 0;

                                $item_retqty = $item['stkissueRet_qty']; 

                                if (isset($item['stkissueRet_qty2'])) {
                                    $item_retqty = $item_retqty + $item['stkissueRet_qty2']; 
                                }

                                $price_total = $price_total + $item['field_item_price'];
                                // $total_net = $total_net + $item['field_item_price']; 
                                $total_qty = $item['field_item_qty'] - $item_retqty; 
                                $total_price = $item['field_item_priceunit'] * $total_qty;
    
                                $total_net = $total_net + $total_price;
                                ?>
                                <tr>
                                    <td style="width:10%;text-align:center;padding: 0px;"> <?= $row_no ?></td>
                                    <td style="width:30%;text-align:left;padding: 0px;"> <?= $item['field_item_name'] ?></td>
                                    <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_qty'] ?></td>
                                    <td style="width:10%;text-align:center;padding: 0px;"> <?= number_format($item_retqty,2) ?></td>
                                    <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_unit'] ?></td>
                                    <td style="width:10%;text-align:right; padding: 0px;"> <?= $item['field_item_priceunit'] ?></td>
                                    <td style="width:10%;text-align:right; padding: 0px;"> <?= number_format($total_price,2) ?></td>
                                    <td style="width:15%;text-align:center;padding: 0px;">
                                        <?php 
                                        if($item['field_bc_docno'] == null){
                                            echo "-";
                                            }else{
                                            echo $item['field_bc_docno'];
                                            }
                                        ?>
                                    </td>
                                </tr>
        
                    <?php  } }  ?>
                    <?php  $diff = $price_total - $total_net ; ?>
                    <tr>
                        <td class="text-center" colspan="4"><b> รวมค่าใช้จ่ายประมาณการ <?= number_format($price_total,2)?> บาท</b></td>
                        <td class="text-center" colspan="4"><b> รวมค่าใช้จ่ายจริง <?= number_format($total_net,2)?> บาท</b></td>
                    </tr>
                    <?php
                        if ($diff == 0) { ?>
                            <tr>
                                <td class="text-center" colspan="8"><b> สรุป ค่าใช้จ่ายจริงท่ากับค่าใช้จ่ายประมาณการ</b></td>
                            </tr>
                       <?php }
                        elseif ($diff > 0) {?>
                            <tr>
                                <td class="text-center" colspan="8"><b> สรุป ค่าใช้จ่ายจริงน้อยกว่าค่าใช้จ่ายประมาณการ <?=number_format($diff,2)?> บาท</b></td>
                            </tr>
                        <?php }
                        elseif ($diff < 0) {?>
                            <?php $diff = $diff + (($total_net - $price_total)*2) ?>
                            <tr>
                                <td class="text-center" colspan="8"><b> สรุป ค่าใช้จ่ายจริงมากกว่าค่าใช้จ่ายประมาณการ <?=number_format($diff,2)?> บาท</b></td>
                            </tr>
                        <?php }
                    ?>
                    
                </table>
      <?php  }elseif ($type == 1) { ?>
                <table style="width:100%;" class="table table-bordered fonts_SarabunPSK">
                    <tr>
                        <td class="text-center" colspan="7"><b> รายการค่าบริการ </b></td>
                    </tr>

                    <tr>
                        <td class="text-center" style="width: 100px;"><b>ลำดับ</b></td>
                        <td class="text-center" style="width: 100px;"><b>รายการบริการ</b></td>
                        <td class="text-center" style="width: 100px;"><b>จำนวน</b></td>
                        <td class="text-center" style="width: 100px;"><b>หน่วยนับ</b></td>
                        <td class="text-center" style="width: 100px;"><b>ราคาต่อหน่วย</b></td>
                        <td class="text-center" style="width: 100px;"><b>ราคารวม</b></td>
                        <td class="text-center" style="width: 100px;"><b>ใบขอเบิก</b></td>
                    </tr>
                    
                    <?php 
                        $row_no = 0;
                        $price_total = 0;
                        foreach($data_rp_item as $item) {  $row_no++;
                        if ($item['field_bc_docno'] == null) {
                                # code...
                            $price_total =  $price_total +  $item['field_item_price'];
                            ?>
                            <tr>
                                <td style="width:10%;text-align:center;padding: 0px;"> <?= $row_no ?></td>
                                <td style="width:30%;text-align:left;padding: 0px;"> <?= $item['field_item_name'] ?></td>
                                <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_qty'] ?></td>
                                <td style="width:10%;text-align:center;padding: 0px;"> <?= $item['field_item_unit'] ?></td>
                                <td style="width:10%;text-align:right; padding: 0px;"> <?= $item['field_item_priceunit'] ?></td>
                                <td style="width:10%;text-align:right; padding: 0px;"> <?= $item['field_item_price'] ?></td>
                                <td style="width:15%;text-align:center;padding: 0px;">
                                    <?php 
                                    if($item['field_bc_docno'] == null){
                                        echo "-";
                                        }else{
                                        echo $item['field_bc_docno'];
                                        }
                                    ?>
                                </td>
                            </tr>
                    <?php  } }  ?>

                    <tr>
                        <td class="text-center" colspan="7"><b> รวมบริการ <?= $price_total?> บาท</b></td>
                    </tr>
                    
                </table>
      <?php  }
        ?>
        <table style="float:center; width:100%; class="tablea tablea-bora fonts_SarabunPSK">
            <?php
                foreach ($cer_manager as $key => $value){
                    ?>
                    
				    <td style="float:left; width:49%; height:145px; margin: 3px;">
                    <b>แผนกสั่งผลิต / สั่งซ่อม</b>
                        <p style="text-align:center;margin: 0px;padding: 0px;">ลงชื​่อ.......................................................<?=$value['lastposition']?></p>
                        <p style="text-align:center;margin: 0px;padding: 0px;"> (<?= ($value['beforname'].  $value['firstname'].' '.$value['lastname'] )?>)</p>
                        <p style="text-align:center;margin: 0px;padding: 0px;">ลงชื​่อ.......................................................อนุมัติแทน</p>
                        <p style="text-align:center;margin: 0px;padding: 0px;"> (&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)</p>
                        <p style="text-align:center;padding-right:13px;margin: 0px;padding: 0px;">วันที่............................................</p>
                    </td>
                    <?php
                }
            ?> 
                <td style="float:left; width:49%; height:95px; margin: 3px;">
                <b>แผนกรับงาน</b>
                    <p style="text-align:center;margin: 0px;padding: 0px;">ลงชื​่อ.......................................................ผู้จัดการ</p>
                    <p style="text-align:center;margin: 0px;padding: 0px;"> (&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)  </p>
                    <p style="text-align:center;padding-right:13px;margin: 0px;padding: 0px;">วันที่............................................</p>
                </td>
        </table>

        <table style="float:center; width:100%; class="tablea tablea-bora fonts_SarabunPSK">
            <td style="float:left; width:49%; height:95px; margin: 3px;">
            <b>ผู้ควบคุมการผลิต / การซ่อม</b>
                <p style="text-align:center;margin: 0px;padding: 0px;">ลงชื​่อ.......................................................ผู้ควบคุมการผลิต / การซ่อม</p>
                <p style="text-align:center;margin: 0px;padding: 0px;"> (<?= $data_rp['ectfirstname']?> <?= $data_rp['ectlastname']?> )  </p>
                <p style="text-align:center;padding-right:13px;margin: 0px;padding: 0px;">วันที่............................................</p>
            </td>
        </table>

        <!-- <br>        
        <div style="float:left;border:1.5 px solid #000000 ;width:50%;height: 75px;">
            <p style="text-align:center;margin: 0px;padding: 0px;"><b>ลงชื​่อ.......................................................ผู้บริหาร</b></p>
            <p style="text-align:center;padding-right:13px;margin: 0px;padding: 0px;"><b>( นายพิสุทธิ์ ภู่พิสิฐ )</b></p>
            <p style="text-align:center;padding-right:13px;margin: 0px;padding: 0px;"><b>วันที่............................................</p></b>
        </div> -->
       
    </div>    
</body>