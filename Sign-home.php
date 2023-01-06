<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction(); ?>
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
		"Action" => ''
	);
	$this->load->view('Tools/Breadcrumb-1',$data); 
	?>
	<?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-danger">
					<div class="card-header">
					<h3 class="card-title">*ระยะเวลาการทำป้ายให้เสร็จสิ้นและตรวจสอบเรียบร้อย อิงตามกลุ่มสินค้า จำนวน 1-10 ป้ายภายใน 3 วัน 11-20 ป้ายภายใน 5 วัน 21 ป้ายขึ้นไปภายใน 7 วัน</h3>
					</div>
				</div>
			</div>
		</div>
		<div  class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label> ค้นหาตามกลุ่มสินค้า </label>
					<select class="form-control search_groupcode" id="search_groupcode">
						<option value=""> ทั้งหมด </option>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label> ค้นหาตามสาเหตุ </label>
					<select class="form-control search_type" id="search_type">
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label> ค้นหาตามสถานะสั่งทำ </label>
					<select class="form-control search_status" id="search_status">
						<option value=""> ทั้งหมด </option>
						<option value="0"> รอสั่งทำป้าย </option>
						<option value="1"> ต้องการทำป้าย </option>
						<option value="2"> ไม่ต้องการทำป้าย </option>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label> ค้นหาตามสถานะทำป้าย </label>
					<select class="form-control search_status_packing" id="search_status_packing">
						<option value=""> ทั้งหมด </option>
						<option value="0"> รอรับเรื่อง </option>
						<option value="1"> กำลังทำป้าย </option>
						<option value="2"> ทำป้ายเรียบร้อย </option>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label> ค้นหาตามสถานะรับป้ายและติดตั้ง </label>
					<select class="form-control search_status_setup" id="search_status_setup">
						<option value=""> ทั้งหมด </option>
						<option value="0"> รอรับป้าย </option>
						<option value="1"> รับป้ายเรียบร้อย/รอติดตั้ง </option>
						<option value="2"> ติดตั้งแล้ว </option>
						<option value="3"> ไม่ติดตั้ง </option>
						<option value="4"> ไม่พร้อมติดตั้ง </option>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label> ค้นหาตามสถานะการตรวจ </label>
					<select class="form-control search_status" id="search_status_check">
						<option value=""> ทั้งหมด </option>
						<option value="1"> รอตรวจสอบ </option>
						<option value="2"> ผ่านการตรวจสอบ </option>
						<option value="3"> ไม่ผ่านการตรวจสอบ </option>
						<option value="4"> ไม่ผ่านการตรวจสอบรอทำลาย </option>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label> ค้นหาตามสถานะทำลาย </label>
					<select class="form-control search_status_destroy" id="search_status_destroy">
						<option value=""> ทั้งหมด </option>                
						<option value="1"> ต้องการทำลาย </option>
						<option value="2"> ทำลายแล้ว </option>
						<option value="0"> ไม่ต้องการทำลาย </option>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label> ค้นหาตามสถานะใช้งาน </label>
					<select id="search_status_active" class="form-control search_status_active">
						<option value="">ทั้งหมด</option>
						<option value="1">เอกสารที่ใช้งานอยู่</option>
						<option value="0">เอกสารที่เลิกใช้งาน</option>
					</select>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label> ค้นหาตามเลขที่เอกสาร รหัสสินค้า หรือชื่อสินค้า</label>
					<input type="text" class="form-control" id="search_text" >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<a href="<?php echo site_url('SignV2/sign_place_manage');?>"><button type="button" class="btn btn-warning btn-block"><i class="fa fa-list-alt"></i> จัดการสถานที่ติดตั้งป้าย</button></a>
			</div>
			<div class="col-md-6">
				<a href="<?php echo site_url('SignV2/sign_destroy_manage');?>"><button type="button" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> ทำลายป้ายสำหรับป้ายที่เลิกใช้งาน</button></a>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-3">
				<a href="<?php echo site_url('Sign/packing_nodo_loaddata');?>"><button type="button" class="btn btn-primary btn-block"> ค้นหาสินค้าที่เลิกใช้งานที่ค้างในระบบ</button></a>
			</div>
			<div class="col-md-3">
				<a href="<?php echo site_url('SignV2/checkprice_onBC');?>"><button type="button" class="btn btn-info btn-block"><i class="fa fa-filter"></i> เปรียบเทียบราคาป้ายกับราคาในBC</button></a>
			</div>
			<div class="col-md-6">
				<a href="<?php echo site_url('Sign/lose_loaddata');?>"><button type="button" class="btn btn-primary btn-block"><i class="fa fa-image "></i> ค้นหาสินค้าที่ป้ายหายไม่มีรูปในระบบ</button></a>
			</div>
		</div>		
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">รายการป้ายสินค้า</h3>
						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<select class="form-control float-right" id="usersPerPage">
									<option value="15">15 แถว</option>
									<option value="20">20 แถว</option>
									<option value="30">30 แถว</option>
									<option value="50">50 แถว</option>
									<option value="100">100 แถว</option>
								</select>
								<div class="input-group-append">
									<button type="button" class="btn btn-default">
										<i class="fas fa-list"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="card-tools">
							<div class="input-group input-group-sm float-right" style="width: 60px;">
								<button type="button" title="รีเฟรช" id="btn_refresh" class="btn btn-info btn_refresh btn-sm">
									<i class="fas fa-sync-alt"></i>
								</button>
							</div>
						</div>
					</div>
					<div class="card-body table-responsive p-0">
						<input type="hidden" id="pageNumber" value="0">
						<table class="table table-hover ">
							<thead>
								<tr>
									<th>เลขที่เอกสาร</th>
									<th>รหัสสินค้า</th>
									<th>ชื่อสินค้า</th>
									<th>หมายเหตุ</th>
									<th class="text-center">ป้ายที่ใช้งาน</th>
									<th>สถานะสั่งทำ</th>
									<th>สถานะการทำป้าย</th>
									<th>สถานะติดตั้ง</th>
									<th>จัดการ</th>
								</tr>
							</thead>
							<tbody id="tbody_sign"></tbody> 
						</table>
					</div>
					<div class="card-footer clearfix">
						<div class="row text-center" >
							<nav aria-label="Page navigation">
								<ul class="pagination"></ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="modal fade" id="recieveModal" role="dialog">
		<div class="modal-dialog modal-xl" style="width:80%" role="document">
			<div class="modal-content">
				<div class="modal-header bg-gray">
					<h4 class="modal-title Sarabun-Regular"> รับป้ายเพื่อดำเนินการติดตั้ง </h4>
				</div>
				<div class="modal-body">
					<div class="card card-primary">
						<div class="card-header">
							<div class="card-title">
								ราายละเอียดป้าย
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label >เลขที่เอกสาร</label>
										<input type="text" class="form-control" id="recieve_docno" readonly>
										<input type="hidden" class="form-control" id="recieve_id" readonly>
									</div>
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<label >สินค้า</label>
										<input type="text" class="form-control" id="recieve_itemcodename" readonly>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label >ผู้ขอทำป้าย</label>
										<input type="text" class="form-control" id="recieve_confirmperson" readonly>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label >วันที่ต้องการ</label>
										<input type="text" class="form-control" id="recieve_needdate" readonly>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label >ผู้ทำ</label>
										<input type="text" class="form-control" id="recieve_packingperson" readonly>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label >วันที่ทำป้าย</label>
										<input type="text" class="form-control" id="recieve_packingdate" readonly>
									</div>
								</div>
							</div>
							<div class = "row">
								<div class="col-md-12">
									<div class="d-flex" >
										<table id="tb_active_sign" class="table table-hover ">
											<thead>
												<tr>
													<th>ลำดับ</th>
													<th>บริเวณที่จะนำไปติด</th>
													<th>ประเภทราคา</th>
													<th>ขนาด</th>
													<th class="text-right">จำนวน</th>
												</tr>
											</thead>
											<tbody id="tb_recievelist">
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card card-info">
						<div class="card-header">
							<div class="card-title">
								การรับป้าย
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label >ผู้รับป้าย</label>
										<input type="text" class="form-control" id="recieve_person" readonly>
										<input type="hidden" class="form-control" id="recieve_person_id" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label >มอบให้ฝ่าย </label>
										<select  class="form-control recieve_toperson" id="recieve_toperson" > 
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label style="color:red;">หมายเหตุ</label>
									<input type="text" class="form-control" id="recieve_comment">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="submit_recieve"> อัปเดทสถานะรับป้าย </button>
					<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="setupModal" role="dialog">
		<div class="modal-dialog modal-xl" style="width:80%" role="document">
			<div class="modal-content">
				<div class="modal-header bg-gray">
					<h4 class="modal-title Sarabun-Regular"> อัปเดทสถานะติดตั้งป้าย </h4>
				</div>
				<div class="modal-body">
					<div class="card card-primary">
						<div class="card-header">
							<div class="card-title">
								ราายละเอียดป้ายและการติดตั้ง
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label >เลขที่เอกสาร</label>
										<input type="text" class="form-control" id="setup_docno" readonly>
										<input type="hidden" class="form-control" id="setup_id" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label >สินค้า</label>
										<input type="text" class="form-control" id="setup_itemcodename" readonly>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label >ผู้ขอทำป้าย</label>
										<input type="text" class="form-control" id="setup_confirmperson" readonly>
									</div>
								</div>
							</div>
							<div class = "row">
								<div class="col-md-12">
									<div class="d-flex" >
										<table id="tb_active_sign" class="table table-hover table-responsive">
											<thead>
												<tr>
													<th>ลำดับ</th>
													<th>บริเวณที่จะนำไปติด</th>
													<th>ประเภทราคา</th>
													<th>ขนาด</th>
													<th>จำนวน</th>
													<th>พนักงานติดตั้ง</th>
												</tr>
											</thead>
											<tbody id="tb_setuplist">
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label style="color:red;">ผู้บันทึกข้อมูล</label>
										<input type="text" class="form-control" id="setup_person" readonly>
										<input type="hidden" class="form-control" id="setup_personid" readonly>
									</div>
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<label>หมายเหตุ</label>
										<input type="text" class="form-control" id="setup_comment">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="submit_setup"> ติดตั้งป้าย </button>
					<button type="button" class="btn btn-danger" id="submit_unsetup"> ไม่ติดตั้งป้าย </button>
					<button type="button" class="btn btn-warning" id="submit_waitsetup"> ยังไม่พร้อมติดตั้ง </button>
					<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="recheckModal" role="dialog">
		<div class="modal-dialog modal-xl" style="width:80%" role="document">
			<div class="modal-content">
				<div class="modal-header bg-gray">
					<h4 class="modal-title Sarabun-Regular"> อัปเดทสถานะการตรวจสอบ </h4>
				</div>
				<div class="modal-body">
					<div class="card card-primary">
						<div class="card-header">
							<div class="card-title">
								ราายละเอียดป้าย
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label >เลขที่เอกสาร</label>
										<input type="text" class="form-control" id="recheck_docno" readonly>
										<input type="hidden" class="form-control" id="recheck_id" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label >สินค้า</label>
										<input type="text" class="form-control" id="recheck_itemcodename" readonly>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label >ผู้ขอทำป้าย</label>
										<input type="text" class="form-control" id="recheck_confirmperson" readonly>
									</div>
								</div>
							</div>
							<div class = "row">
								<div class="col-md-12">
									<div class="d-flex" >
										<table  class="table table-hover ">
											<thead>
												<tr>
													<th>ลำดับ</th>
													<th>บริเวณที่จะนำไปติด</th>
													<th>ประเภทราคา</th>
													<th>ขนาด</th>
													<th>จำนวน</th>
													<th>พนักงานติดตั้ง</th>
												</tr>
											</thead>
											<tbody id="tb_rechecklist">
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card card-info">
						<div class="card-header">
							<div class="card-title">
								รายละเอียดราคา
							</div>
						</div>
						<div class="card-body">
							<div class="row"  id="recheck_price_row">

							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-6">
							<div class="card card-secondary">
								<div class="card-header">
									<div class="card-title">
										รูป
									</div>
								</div>
								<div class="card-body">
									<div class="row" id="links_file_recheck">

									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card card-secondary">
								<div class="card-header">
									<div class="card-title">
										รูปทำลาย
									</div>
								</div>
								<div class="card-body">
									<div class="row" id="links_file_recheck_destroy">

									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card card-warning">
						<div class="card-header">
							<div class="card-title">
								การตรวจสอบ
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label style="color:red;">ผู้บันทึกข้อมูล</label>
										<input type="text" class="form-control" id="recheck_person" readonly>
										<input type="hidden" class="form-control" id="recheck_personid" readonly>
									</div>
								</div>
								<div class="col-md-6 hidden" id="div_recheck_destroy">
									<div class="form-group">
										<label >เอกสารที่ทำลาย</label>
										<input type="text" class="form-control" id="recheck_destroy" readonly>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label style="color:red;">การตรวจสอบ</label>
										<select class="form-control" id="recheck_status" >
											<option value="">เลือกการตรวจสอบ</option>
											<option value="2">ผ่านการตรวจสอบ</option>
											<option value="4">ตรวจสอบแล้วไม่ผ่าน</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label style="color:red;">หมายเหตุเพิ่มเติม</label>
										<input type="text" class="form-control" id="recheck_comment">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="submit_recheck"> อัปเดทสถานะตรวจสอบ </button>
					<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="destroy_recheck_Modal" role="dialog">
		<div class="modal-dialog modal-xl" style="width:80%" role="document">
			<div class="modal-content" >
				<div class="modal-header bg-danger">
					<h4 class="modal-title Sarabun-Regular"> อัปเดทสถานะทำลายป้ายก่อนถอยเอกสาร </h4>
				</div>
				<div class="modal-body">
					<div class="card card-default">
						<div class="card-header">
							<div class="card-title">
								ราายละเอียดป้ายและป้ายที่ต้องทำลาย
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label >เลขที่เอกสาร</label>
										<input type="text" class="form-control" id="destroy_recheck_docno" readonly>
										<input type="hidden" class="form-control" id="destroy_recheck_id" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label >รหัสสินค้า</label>
										<input type="text" class="form-control" id="destroy_recheck_itemcodename" readonly>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label >ผู้ขอทำป้าย</label>
										<input type="text" class="form-control" id="destroy_recheck_confirmperson" readonly>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<table id="sign_destroy_recheck_list" class=" table order-list">
											<thead>
												<tr>
													<th>ลำดับ</th>
													<th>อ้างอิงSG</th>
													<th>บริเวณที่ติดตั้ง</th>
													<th>ขนาด</th>
													<th>ประเภท</th>
													<th class="text-right">จำนวน</th>
												</tr>
											</thead>
											<tbody id="tb_destroy_recheck_list">
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label >หมายเหตุเพิ่มเติม</label>
										<input type="text" class="form-control" id="destroy_recheck_comment">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="checkbox-inline" style="color:red;">
											<input type="checkbox" value="1" id="no_image_recheck"> *-->ไม่มีรูปทำลายป้าย(เนื่องจากป้ายหาย)<--
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit"  class="btn btn-danger" id="submit_destroy_recheck">ทำลายป้าย</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="destroy_Modal" role="dialog">
		<form id="form_confirm_success_destroy">
			<div class="modal-dialog modal-xl" style="width:80%" role="document">
				<div class="modal-content" >
					<div class="modal-header bg-danger">
						<h4 class="modal-title Sarabun-Regular"> อัปเดทสถานะทำลายป้ายเดิมเสร็จสิ้น </h4>
					</div>
					<div class="modal-body">
						<div class="card card-default">
							<div class="card-header">
								<div class="card-title">
									ราายละเอียดป้ายและป้ายที่ต้องทำลาย
								</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label >เลขที่เอกสาร</label>
											<input type="text" class="form-control" id="destroy_docno" readonly>
											<input type="hidden" class="form-control" id="destroy_id" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label >รหัสสินค้า</label>
											<input type="text" class="form-control" id="destroy_itemcodename" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label >ผู้ขอทำป้าย</label>
											<input type="text" class="form-control" id="destroy_confirmperson" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<table id="sign_destroy_list" class=" table order-list">
												<thead>
													<tr>
														<th>ลำดับ</th>
														<th>อ้างอิงSG</th>
														<th>บริเวณที่ติดตั้ง</th>
														<th>ขนาด</th>
														<th>ประเภท</th>
														<th class="text-right">จำนวน</th>
													</tr>
												</thead>
												<tbody id="tb_destroy_list">
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label >หมายเหตุการทำลาย</label>
											<select  class="form-control" id="destroy_comment" >
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="checkbox-inline" style="color:red;">
												<input type="checkbox" value="1" id="no_image"> *-->ไม่มีรูปทำลายป้าย(เนื่องจากป้ายหาย)<--
											</label>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>หมายเหตุเพิ่มเติม </label><span class="text-danger"> ** หากพบเจอป้ายที่แจ้งว่าหาย จะมีบทลงโทษภายหลัง</span>
											<input type="text" class="form-control" id="destroy_comment_more" placeholder="เช่น เนื่องจากป้ายติดไปกับสินค้าที่ขายให้ลูกค้า">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="submit"  class="btn btn-danger" id="submit_destroy">ทำลายป้าย</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="modal fade" id="backtoedit_Modal" role="dialog">
		<div class="modal-dialog modal-xl" style="width:40%" role="document">
			<div class="modal-content" >
				<div class="modal-header bg-warning">
					<h4 class="modal-title Sarabun-Regular" id="backtoedit_title"> ถอยเอกสาร </h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>หมายเหตุการขอถอยเอกสาร</label>
								<input type="hidden" id="field_id_backtoedit">
								<input type="text" class="form-control" id="backtoedit_comment">
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button"  class="btn btn-warning" id="submit_backtoedit">ถอย</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="timeline_Modal" role="dialog">
	<div class="modal-dialog modal-xl" style="width:80%" role="document">
		<div class="modal-content" >
			<div class="modal-header bg-default">
				<h4 class="modal-title Sarabun-Regular" id="timeline_title"></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="timeline" id="comment_timeline">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
			</div>
		</div>
	</div>
</div>

<form id="uploadimage" method="post" enctype="multipart/form-data" accept-charset="utf-8" method="get">
    <div class="modal fade" id="uploadModal" role="dialog" data-keyboard="false">  
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" >
                <div class="modal-header bg-secondary">
                    <h4 class="modal-title Sarabun-Regular" id="upmodal_name"> เพิ่มรูปภาพ </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <!-- <input class="form-control" type="file" name="file[]" id="file" accept="image/*" multiple="multiple" required /> -->

								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" name="file[]" id="file" accept="image/*" multiple="multiple" required >
										<label class="custom-file-label" for="file">เลือกไฟล์</label>
									</div>
								</div>
                            </div>
                            <p class="text-danger"><b>* รับเฉพาะไฟล์ .jpg สามารถเพิ่มรูปได้ 2 รูปเท่านั้น</b></p>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
								<input type="hidden" id="recheck_status_img">
                                <input class="form-control" type="hidden" name="id" id="upload_id" />                   
                            </div>
                        </div>
                    </div>
					<div class="row" id="links_file">

					</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">เพิ่มรูปภาพ</button>
                    <button type="button" class="btn btn-default cancel_uploadModal" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div> 
    </div>
</form>