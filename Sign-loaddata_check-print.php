<head>
    <!-- 
    <script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js')?>"></script>

    <link href="<?= base_url('assets/css/style.css');?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css')?>" > 
    <!-- <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet"> -->
    <title>บาร์โค้ด SG</title>
    <?php 
        $thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
        $thaiweek=array("วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัสบดี","วันศุกร์","วันเสาร์");
    ?>
    <style>
        table, td {
        overflow: wrap;
        border: 1px solid black;
        height: 22px;
        font-size: 11px;
        }

        table {
        overflow: wrap;
        border-collapse: collapse;
        width: 100%;
        font-size: 11px;
        }

        th {
            /* overflow: wrap; */
            border: 1px solid black;
            height: 25px;
            font-size: 10px;
        }

        hr { 
        margin-left: auto;
        margin-right: auto;
        color: black;
        } 
    </style>
</head>

<body>
    <table >
        <thead>
            <tr>
                <th colspan="8" ><?=$title_list?></th>
            </tr>
            <tr>
                <th>เลขที่เอกสาร</th>
                <th>กลุ่มสินค้า</th>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>สาเหตุ</th>
                <th>ผู้บันทึก</th>
                <th>สถานะ</th>
                <th>บาร์โค้ด</th>
            </tr>
        </thead>
        <?php 
            $status_name = '';
            $save_creator = '';
            $before_status = '';
        ?>
        <tbody >
            <?php 
                foreach ($sign as $key => $val) { $code = $val['field_docno']; 
                    if($search_status_sign == 1){
                        $status_name = 'รอสั่งทำ';
                        $before_status = ' แชร์โดย ';
                        $save_creator = '[จัดซื้อแชร์] '.$val['creator_nickname'].'('.$val['creator_firstname'].')';
                    }elseif($search_status_sign == 2){
                        $status_name = 'รอรับป้าย';
                        $before_status = ' ยืนยันทำโดย ';
                        $save_creator = '[ยืนยันทำ] '.$val['confirm_nickname'].'('.$val['confirm_firstname'].')';
                    }elseif($search_status_sign == 3){
                        $status_name = 'รอติดตั้งป้าย';
                        $before_status = ' รับโดย ';
                        $save_creator = '[รับป้าย] '.$val['recieve_nickname'].'('.$val['recieve_firstname'].')';
                    }elseif($search_status_sign == 4){
                        $status_name = 'รอทำลาย';
                        $before_status = ' ยืนยันทำโดย ';
                        $save_creator = '[ยืนยันทำ] '.$val['confirm_nickname'].'('.$val['confirm_firstname'].')';
                    }elseif($search_status_sign == 5){
                        $status_name = 'รอตรวจสอบ';
                        $before_status = ' ติดตั้งโดย ';
                        $save_creator = '[ติดตั้ง] '.$val['setup_nickname'].'('.$val['setup_firstname'].')';
                    }
                ?>
                <tr>
                    <td style="text-align:center;"><?=$val['field_docno']?></td>
                    <td style="text-align:center;"><?=$val['field_groupcode']?></td>
                    <td style="text-align:center;"><?=$val['field_itemcode']?></td>
                    <td style="text-align:center;"><?=$val['field_itemname']?></td>
                    <td style="text-align:center;"><?=$val['type_name']?></td>
                    <td style="text-align:center;"><?=$save_creator?></td>
                    <td style="text-align:center;"><?=$status_name?></td>
                    <td style="text-align:center;"><barcode style="padding:4px;" code="<?php echo $code; ?>" type="C128A" size="0.6" height="1.5"/></td>
                </tr>
            <?php 
                }
            ?>
        </tbody>
    </table>
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