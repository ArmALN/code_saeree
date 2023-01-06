<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction(); ?>

<head>
	<script src="<?= base_url('assets/jquery-form/dist/jquery.form.min.js')?>" ></script>
	<script src="<?= base_url('assets/jquery-validation/dist/jquery.validate.js')?>" ></script>
	<script src="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js')?>" ></script>
	<script src="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.js')?>" ></script>
	<script src="<?= base_url('/assets/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('/assets/js/dataTables.bootstrap.min.js') ?>"></script>

	<link rel="stylesheet" href="<?= base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css')?>" >
	<link rel="stylesheet" href="<?= base_url('assets/sweetalert2-master/dist/sweetalert2.min.css')?>"> 
</head>

<style>
	.ui-front {
		z-index: 1500 !important;
	}

	.ui-widget-content {
		border: none;
	}

	.label-radio {
		width: 100%;
		background-color: #eee;
		border: 1px solid #ccc;
		border-radius: 4px;
		text-align: left;
		padding: 5px;
		margin-bottom: 10px;
	}

	.span-radio {
		padding-left: 20px;
	}

	.select2-container .select2-selection--single{height: 34px;}
	.select2-selection__choice__remove{float: left;} */
	.pointer {cursor: pointer;}

	.icheck:hover{
		cursor: pointer;
		color: #550000;
	}

	.list{
		min-height: 50px;
		max-height: 200px;
		overflow-y: scroll;
	}

	.iradio .iradio-val{
		display: none;
	}

	.iradio:hover{
		cursor: pointer;
	}

	.icollapse{
		display: none;
	}

	.form-noborder{
		border:none;
	}

    .swal2-title{
        font-family : Sarabun-Regular;
        font-size: 16px;
    }

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

</style>    

<body>
	<div class="container" style="width:90%;" >
        <?php $this->Function_model->BREADCRUMB(array('หน้าแรก' => base_url(),'ป้ายสินค้า' => base_url('index.php/Sign'), 'ตัวอย่างป้าย' => '')); ?>

        <div class="box box-default box-solid">
            <div class="modal-header bg-gray">
                <h4 class="modal-title Sarabun-Regular" style="font-size: 26px;"> ตัวอย่างป้ายแต่ละแบบ </h4>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>ตัวอย่างตามขนาด</h3>
                        <h4><b>1. A4 / A4 2ด้าน</b></h4>
                        <p><b>ราคาเดียว</b></p>
                        <img height="400px" src="<?= base_url('assets/images/ex_sign');?>/1_1.jpg" alt="Photo">
                        <p><b>สเต็ปราคา</b></p>
                        <img height="400px" src="<?= base_url('assets/images/ex_sign');?>/1_2.jpg" alt="Photo">
                        <p><b>หลายหน่วยนับ</b></p>
                        <img height="400px" src="<?= base_url('assets/images/ex_sign');?>/1_3.jpg" alt="Photo">
                        <p><b>ลดราคา</b></p>
                        <img height="400px" src="<?= base_url('assets/images/ex_sign');?>/1_4.jpg" alt="Photo">
                        <br><br>
                        <h4><b>2. ครึ่งA4</b></h4>
                        <img height="500px" src="<?= base_url('assets/images/ex_sign');?>/2_1.jpg" alt="Photo">
                        <br><br>
                        <h4><b>3. สี่ส่วนA4</b></h4>
                        <img height="500px" src="<?= base_url('assets/images/ex_sign');?>/3_1.jpg" alt="Photo">
                        <br><br>
                        <h4><b>4. ป้ายหน้าชั้น(สั้น)</b></h4>
                        <img height="500px" src="<?= base_url('assets/images/ex_sign');?>/4_1.jpg" alt="Photo">
                        <br><br>
                        <h4><b>5. ป้ายสต็อก 4 ส่วน A4(ไม่ต้องใส่ประเภทราคา)</b></h4>
                        <img height="200px" src="<?= base_url('assets/images/ex_sign');?>/1_5.jpg" alt="Photo">
                        <br><br>
                        <h4><b>6. บาร์แท็ก(ไม่ต้องใส่ประเภทราคา)</b></h4>
                        <img height="500px" src="<?= base_url('assets/images/ex_sign');?>/1_6.jpg" alt="Photo">
                        <br><br>
                        <h4><b>7. ป้ายสต็อก 3 ส่วน A4(ไม่ต้องใส่ประเภทราคา)</b></h4>
                        <img height="400px" src="<?= base_url('assets/images/ex_sign');?>/1_7.jpg" alt="Photo">
                        <br><br>
                        <h4><b>8. ป้ายหน้าชั้นโกดัง(ไม่ต้องใส่ประเภทราคา)</b></h4>
                        <img height="400px" src="<?= base_url('assets/images/ex_sign');?>/8.jpg" alt="Photo">
                        <br><br>
                        <h4><b>9. สต็อกครึ่งA4(ไม่ต้องใส่ประเภทราคา)</b></h4>
                        <img height="400px" src="<?= base_url('assets/images/ex_sign');?>/10.jpg" alt="Photo">
                        <br><br>
                        <h4><b>9. สต็อกA4(ไม่ต้องใส่ประเภทราคา)</b></h4>
                        <img height="500px" src="<?= base_url('assets/images/ex_sign');?>/11.jpg" alt="Photo">
                        <br><br>
                        <h4><b>10. โกดังA4(เฉพาะประเภทราคาเดียวและปรับราคา)</b></h4>
                        <img height="500px" src="<?= base_url('assets/images/ex_sign');?>/12_1.jpg" alt="Photo">
                        <br><br>
                        <h4><b>11. โกดังครึ่งA4(เฉพาะประเภทราคาเดียวและปรับราคา)</b></h4>
                        <img height="500px" src="<?= base_url('assets/images/ex_sign');?>/13_1.jpg" alt="Photo">
                        <br><br>
                        <h4><b>12. ป้ายหน้าชั้น(ยาว)</b></h4>
                        <img height="500px" src="<?= base_url('assets/images/ex_sign');?>/15_1.jpg" alt="Photo">
                        <br><br>
                        <h4><b>13. สต็อกราคาA4(ลูกศร)(ไม่ต้องใส่ประเภทราคา)</b></h4>
                        <img height="500px" src="<?= base_url('assets/images/ex_sign');?>/16.jpg" alt="Photo">
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
	</div>
</body>