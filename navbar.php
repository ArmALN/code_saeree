<body class="hold-transition skin-red sidebar-mini sidebar-collapse" data-baseurl="<?= base_url() ?>" data-siteurl="<?= site_url() ?>">
    <?php
        $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction();
        $navbar = array(
            array("name" => "หน้าแรก", 'url' => base_url(), 'icon' => 'fa fa-dashboard', "group" => "Main"),

            array("name" => 'สำนักงาน', 'url' => "javascript:void(0)", 'icon' => 'fa fa-money', "group" => "Main",
            'dropdown' => array(
                array("name" => "บันทึกรายการยอดโอน(โอนเข้า)", 'url' => site_url('/Check_tranfer/check_tranfer_add'), 'icon' => 'fa fa-money', "group" => "Check_tranfer/check_tranfer_add"),
                array("name" => "ตรวจสอบรายการยอดโอน(โอนเข้า)", 'url' => site_url('/Check_tranfer'), 'icon' => 'fa fa-money', "group" => "Check_tranfer"),
                array("name" => "บันทึกรายการยอดโอน(โอนออก)", 'url' => site_url('/Check_tranfer_ap/check_tranfer_add'), 'icon' => 'fa fa-money', "group" => "Check_tranfer_ap/check_tranfer_add"),
                array("name" => "ตรวจสอบรายการยอดโอน(โอนออก)", 'url' => site_url('/Check_tranfer_ap'), 'icon' => 'fa fa-money', "group" => "Check_tranfer"),
                array("name" => "ติดตามใบรับเงินมัดจำ", 'url' => site_url('/AS_comment'), 'icon' => 'fa fa-money', "group" => "AS_comment"),
                array("name" => "ติดตามใบจ่ายเงินล่วงหน้า", 'url' => site_url('/DS_comment'), 'icon' => 'fa fa-money', "group" => "DS_comment"),
                array("name" => "ติดตามเจ้าหนี้คงค้างชำระ", 'url' => site_url('/Ap_comment'), 'icon' => 'fa fa-money', "group" => "Ap_comment"),
                array("name" => "ติดตามลูกหนี้คงค้างชำระ", 'url' => site_url('/Ar_comment'), 'icon' => 'fa fa-money', "group" => "Ar_comment"),
                array("name" => "ส่วนต่างค้างรับ", 'url' => site_url('/Diff_Comment'), 'icon' => 'fa fa-money', "group" => "Diff_Comment"),
                array("name" => "บันทึกการรับบิล", 'url' => site_url('/Record_bill'), 'icon' => 'fa fa-money', "group" => "Record_bill"),
                array("name" => "บันทึกการรับบิล(ไปรษณีย์)", 'url' => site_url('/Record_bill_post'), 'icon' => 'fa fa-money', "group" => "Record_bill_post"),
                array("name" => "ใบกำกับภาษี", 'url' => site_url('/Tax_Comment/TaxManage'), 'icon' => 'fa fa-money', "group" => "Tax_Comment/TaxManage"),
                array("name" => "บันทึกใบลดหนี้", 'url' => site_url('/Refund'), 'icon' => 'fa fa-money', "group" => "Refund"),
                )
            ),
        
            array("name" => 'สถาปนิก', 'url' => "javascript:void(0)", 'icon' => 'fa fa-building', "group" => "Main",
            'dropdown' => array(
                array("name" => "ใบส่งมอบงานแผนกสถาปนิก", 'url' => site_url('/Arc_completion'), 'icon' => 'fa fa-money', "group" => "Arc_completion"),
                array("name" => "รายการตรวจงานผลิต", 'url' => site_url('/Check_stkissue'), 'icon' => 'fa fa-money', "group" => "Check_stkissue")
                )
            ),

            array("name" => 'เช่า - ยืม', 'url' => "javascript:void(0)", 'icon' => 'fa fa-exchange', "group" => "Main",
            'dropdown' => array(
                array("name" => "สินค้าเช่า - ยืม", 'url' => site_url('/Rent/rent_product'), 'icon' => 'fa fa-money', "group" => "Rent/rent_product"),
                array("name" => "ใบสัญญาเช่า - ยืม", 'url' => site_url('/Rent'), 'icon' => 'fa fa-money', "group" => "Rent")
                )
            ),

            array("name" => 'จัดซื้อ', 'url' => "javascript:void(0)", 'icon' => 'fa fa-chevron-circle-down', "group" => "Main",
            'dropdown' => array(
                array("name" => "รายการส่งเสริมการขาย", 'url' => site_url('/Sales_target'), 'icon' => 'fa fa-money', "group" => "Sales_target"),
                array("name" => "ติดตามใบเสนอซื้อคงค้าง(งดใช้งาน 31/12/2564)", 'url' => site_url('/PR_Comment'), 'icon' => 'fa fa-money', "group" => "PR_Comment"),
                 // array("name" => "ติดตามสินค้าค้างรับ", 'url' => site_url('/PO_comment'), 'icon' => 'fa fa-money', "group" => "PO_comment"),
                array("name" => "ติดตามสินค้าค้างรับV2", 'url' => site_url('/PO_CommentV2'), 'icon' => 'fa fa-money', "group" => "PO_CommentV2"),
                array("name" => "ติดตามสินค้าบริการค้างรับ", 'url' => site_url('/PO_Service'), 'icon' => 'fa fa-money', "group" => "PO_Service"),
                array("name" => "ติดตามสินค้าถึงจุดสั่งซื้อ", 'url' => site_url('/PURC_Comment'), 'icon' => 'fa fa-money', "group" => "PURC_Comment")

                )
            ),

            array("name" => 'สินค้าคงคลัง', 'url' => "javascript:void(0)", 'icon' => 'fa fa-cubes', "group" => "Main",
            'dropdown' => array(
                array("name" => "จัดของให้ลูกค้า", 'url' => site_url('/Deliver_products'), 'icon' => 'fa fa-money', "group" => "Deliver_products"),
                array("name" => "รายการสินค้าแบ่งขาย", 'url' => site_url('/Metal_meter'), 'icon' => 'fa fa-money', "group" => "Metal_meter"),
                array("name" => "นับสต๊อกสินค้าตามใบสั่งซื้อ", 'url' => site_url('/Check_StkPO'), 'icon' => 'fa fa-money', "group" => "Check_StkPO"),
               
              
                array("name" => "ติดตามสินค้าค้างส่ง", 'url' => site_url('/SO_comment'), 'icon' => 'fa fa-money', "group" => "SO_comment"),
              
                array("name" => "ติดตามสินค้าเคลม", 'url' => site_url('/WL_Comment'), 'icon' => 'fa fa-money', "group" => "WL_Comment"),
                array("name" => "สินค้าหมดอายุ(FIFO)", 'url' => site_url('/Fifo_Comment'), 'icon' => 'fa fa-money', "group" => "Fifo_Comment"),
                array("name" => "รายการขายของเก่า", 'url' => site_url('/Sale_scrap'), 'icon' => 'fa fa-money', "group" => "Sale_scrap"),
                array("name" => "สินค้าเคลม", 'url' => site_url('/Claim_Product'), 'icon' => 'fas fa-circle', "group" => "Claim_Product")
                )
            ),

            array("name" => 'ป้ายสินค้า', 'url' => "javascript:void(0)", 'icon' => 'fa fa-barcode', "group" => "Main",
            'dropdown' => array(
                array("name" => 'รายการป้ายสินค้า', 'url' => site_url('/Sign'), "group" => "Sign"),
                array("name" => 'จัดซื้อ', 'url' => site_url('/Sign/purchase_add'), "group" => "Sign/purchase_add"),
                array("name" => 'ขอทำป้าย', 'url' => site_url('/Sign/depart_confirm'), "group" => "Sign/depart_confirm"),
                array("name" => 'บรรจุภัณฑ์', 'url' => site_url('/Sign/packing_loaddata'), "group" => "Sign/packing_loaddata")
                )   
            ),

            array("name" => 'ป้ายสินค้าV2', 'url' => "javascript:void(0)", 'icon' => 'fa fa-barcode', "group" => "Main",
            'dropdown' => array(
                array("name" => 'รายการป้ายสินค้าV2', 'url' => site_url('/SignV2'), "group" => "SignV2"),
                array("name" => 'จัดซื้อV2', 'url' => site_url('/SignV2/purchase_add'), "group" => "SignV2/purchase_add"),
                array("name" => 'ขอทำป้ายV2', 'url' => site_url('/SignV2/depart_confirm'), "group" => "SignV2/depart_confirm"),
                array("name" => 'บรรจุภัณฑ์V2', 'url' => site_url('/SignV2/packing_loaddata'), "group" => "SignV2/packing_loaddata"),
                array("name" => 'อนุมัติการขอแก้ไขV2', 'url' => site_url('/SignV2/sign_request_confirm'), "group" => "SignV2/sign_request_confirm")
                )   
            ),
            array("name" => 'ตัดชำรุด', 'url' => "javascript:void(0)", 'icon' => 'fa fa-barcode', "group" => "Main",
            'dropdown' => array(                
                array("name" => 'บันทึกใบขอเบิกใช้สินค้า,วัตถุดิบ DM', 'url' => site_url('/Recieve_success/DM'), "group" => "Sign"),
                array("name" => 'บันทึกใบเบิกใช้สินค้า,วัตถุดิบ IZ/IP', 'url' => site_url('/Recieve_success/IZIP'), "group" => "Sign"),
                array("name" => 'รับเข้าสินค้าเกรด B หรือลดล้างสต๊อก IW', 'url' => site_url('/Recieve_success/IW'), "group" => "Sign"),
                )   
            ),

            array("name" => 'รับเข้าสำเร็จรูป', 'url' => "javascript:void(0)", 'icon' => 'fa fa-barcode', "group" => "Main",
            'dropdown' => array(
                array("name" => 'กำหนดต้นทุนขั้นต่ำ', 'url' => site_url('/Recieve_success/cost_minimum_view'), "group" => "Sign"),
                array("name" => 'รับเข้าแบบ II', 'url' => site_url('/Recieve_success'), "group" => "Sign"),
                array("name" => 'รับเข้าแบบ IT', 'url' => site_url('/Recieve_success/IT'), "group" => "Sign"),
                // array("name" => 'รับเข้าแบบ IW', 'url' => site_url('/Recieve_success/IW'), "group" => "Sign"),

                )   
            ),

            // array("name" => 'บริการหลังการขาย', 'url' => "javascript:void(0)", 'icon' => 'fa fa-book', "group" => "Main",
            // 'dropdown' => array(
            //     array("name" => 'รายการบริการ(ซับเมอร์ส)', 'url' => site_url('/CallCheck'), "group" => "CallCheck"),
            //     array("name" => 'รายการบริการ(ฝ่ายขาย)', 'url' => site_url('/CallCheck_Sale'), "group" => "CallCheck_Sale")
            //     )   
            // ),

            // array("name" => 'สั่งผลิต-ใบสั่งซ่อม', 'url' => "javascript:void(0)", 'icon' => 'fa fa-cube', "group" => "Main",
            // 'dropdown' => array(
            //     array("name" => 'ใบสั่งผลิต-ใบสั่งซ่อม', 'url' => site_url('/Request_production'), "group" => "Request_production"),
            //     )   
            // ),
    
            array("name" => 'Admin', 'url' => "javascript:void(0)", 'icon' => 'fa fa-gears', "group" => "Main",
            'dropdown' => array(
                array("name" => 'สิทธิ์ผู้ใช้', 'url' => site_url('/Privilege/group'), "group" => "Privilege/group"),
                array("name" => 'Log', 'url' => site_url('/Admin/home_log_admin/'), "group" => "Admin/home_log_admin"),
                array("name" => 'User', 'url' => site_url('/Admin/home_user_admin/'), "group" => "Admin/home_user_admin"),
                array("name" => 'Application', 'url' => site_url('/Admin/home_application_admin/'), "group" => "Admin/home_application_admin"),
                array("name" => 'Class', 'url' => site_url('/Admin/home_class_admin/'), "group" => "Admin/home_class_admin"),
                array("name" => 'Function', 'url' => site_url('/Admin/home_functions_admin/'), "group" => "Admin/home_functions_admin"),
                )   
            ),
        
        );
    ?>

    <div class="wrapper Sarabun-Regular">
        <header class="main-header">
            <a href="/?" class="logo">
                <span class="logo-mini" style="font-size:12pt;"><b><span class="Sarabun-Regular">SK</span> </b></span>
                <span class="logo-lg" style="font-size:12pt"><span class="Sarabun-Regular"><b>S</b>K <b>S</b>oftware <b>H</b>ub</span></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="offcanvas" role="button" title="เมนู">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url('assets/images/default_user.png') ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?= $_SESSION['saeree_name'] ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?= base_url('assets/images/default_user.png') ?>" class="img-circle" alt="User Image">

                                    <p>
                                        <?php
                                        $userDepart = $this->Function_model->userDepart();
                                        $departR = $userDepart->first_row();
                                        ?>
                                        <?= $_SESSION['saeree_name'] ?> - แผนก<?= $departR->name; ?>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">ข้อมูลส่วนตัว</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= site_url('/Site/logout') ?>" class="btn btn-default btn-flat" id="btnLogout">ออกจากระบบ</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="hidden">
                            <a href="#" data-toggle="control-sidebar" title="ติดต่อผู้ดูแล"><i class="fa fa-comments-o"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= base_url('assets/images/default_user.png') ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?= $_SESSION['saeree_name'] ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> ออนไลน์</a>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="header"></li>
                    <?php foreach ($navbar as $item): ?>
                        <?php if (isset($CheckPrivilegeFunction[$item['group']])): ?>
                            <li class="treeview">
                                <a href="<?= $item['url'] ?>" <?php
                                if (isset($item['target'])) {
                                    echo "target='" . $item['target'] . "'";
                                }
                                ?>>
                                    <i class="<?= $item['icon'] ?>"></i> <span><?= $item['name'] ?></span> <?php if (isset($item['dropdown'])) { ?><i class="fa fa-angle-left pull-right"></i><?php } ?>
                                </a>
                                <?php if (isset($item['dropdown'])) { ?>
                                    <ul class="treeview-menu">
                                        <?php foreach ($item['dropdown'] as $dropdown) : ?>
                                            <?php if (isset($CheckPrivilegeFunction[$dropdown['group']])): ?>
                                                <li><a href="<?= $dropdown['url'] ?>" <?php
                                                    if (isset($dropdown['target'])) {
                                                        echo "target='" . $dropdown['target'] . "'";
                                                    }
                                                    ?>><i class="fa fa-circle-o"></i><?= $dropdown['name'] ?></a></li>
                                                   <?php endif; ?>
                                               <?php endforeach; ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </section>
        </aside>
    <div class="content-wrapper">
