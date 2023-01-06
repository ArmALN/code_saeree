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
            "Action" => 'ดูข้อมูล'
        );
        $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>

    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
		<div class="row">
			<div class="col-md-3">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title" id="title_docno"></h3>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title" id="title_itemcode"></h3>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title" id="title_itemname"></h3>
					</div>
				</div>
			</div>
		</div>
		<div class="card card-success  hidden" id="div_purchase">
			<div class="card-header">
				<h3 class="card-title">ข้อมูลจัดซื้อแชร์ป้าย</h3>
			</div>
			<div class="card-body" id="div_purchase_body">
			</div>
		</div>

		<div class="card card-success  hidden" id="div_depart">
			<div class="card-header">
				<h3 class="card-title">ข้อมูลแผนกแชร์ป้าย</h3>
			</div>
			<div class="card-body" id="div_depart_body">
			</div>
		</div>

		<div class="card card-primary  hidden" id="div_depart_detail">
			<div class="card-header">
				<h3 class="card-title">ข้อมูลการจัดทำป้าย</h3>
			</div>
			<div class="card-body" id="div_depart_detail_body">
			</div>
		</div>

		<div class="card card-purple  hidden" id="div_packing">
			<div class="card-header">
				<h3 class="card-title">ข้อมูลผู้ทำป้าย</h3>
			</div>
			<div class="card-body" id="div_packing_body">
			</div>
		</div>

		<div class="card card-danger  hidden" id="div_destroy">
			<div class="card-header">
				<h3 class="card-title">ข้อมูลการทำลายป้าย</h3>
			</div>
			<div class="card-body" id="div_destroy_body">
			</div>
		</div>

		<div class="card card-info  hidden" id="div_recieve">
			<div class="card-header">
				<h3 class="card-title">ข้อมูลการรับป้าย</h3>
			</div>
			<div class="card-body" id="div_recieve_body">
			</div>
		</div>

		<div class="card card-secondary  hidden" id="div_setup">
			<div class="card-header">
				<h3 class="card-title">ข้อมูลการติดตั้งป้าย</h3>
			</div>
			<div class="card-body" id="div_setup_body">
			</div>
		</div>

		<div class="card card-warning  hidden" id="div_recheck">
			<div class="card-header">
				<h3 class="card-title">ข้อมูลการตรวจสอบป้าย</h3>
			</div>
			<div class="card-body" id="div_recheck_body">
			</div>
		</div>

		<div class="row">
			<div class="col-md-6" >
				<div class="card card-secondary" id="div_links_file_recheck">
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
				<div class="card card-secondary" id="div_links_file_recheck_destroy">
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

    </section>
</div>