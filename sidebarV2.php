  <?php
    $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction();
    $navbar = array(
        
        array("name" => "หน้าแรก", 'url' => base_url(), 'icon' => 'fas fa-tachometer-alt', "group" => "Main" , "active" => ""),

        array("name" => 'สำนักงาน', 'url' => "javascript:void(0)", 'icon' => 'fas fa-money-bill', "group" => "Main" , "active" => "",
        'dropdown' => array(
          array("name" => "บันทึกรายการยอดโอน(โอนเข้า)", 'url' => site_url('/Check_tranfer/check_tranfer_add'), 'icon' => 'fas fa-circle', "group" => "Check_tranfer/check_tranfer_add"),
          array("name" => "ตรวจสอบรายการยอดโอน(โอนเข้า)", 'url' => site_url('/Check_tranfer'), 'icon' => 'fas fa-circle', "group" => "Check_tranfer"),
          array("name" => "บันทึกรายการยอดโอน(โอนออก)", 'url' => site_url('/Check_tranfer_ap/check_tranfer_add'), 'icon' => 'fas fa-circle', "group" => "Check_tranfer_ap/check_tranfer_add"),
          array("name" => "ตรวจสอบรายการยอดโอน(โอนออก)", 'url' => site_url('/Check_tranfer_ap'), 'icon' => 'fas fa-circle', "group" => "Check_tranfer"),
          array("name" => "ติดตามใบรับเงินมัดจำ", 'url' => site_url('/AS_comment'), 'icon' => 'fas fa-circle', "group" => "AS_comment"),
          array("name" => "ติดตามใบจ่ายเงินล่วงหน้า", 'url' => site_url('/DS_comment'), 'icon' => 'fas fa-circle', "group" => "DS_comment"),
          array("name" => "ติดตามเจ้าหนี้คงค้างชำระ", 'url' => site_url('/Ap_comment'), 'icon' => 'fas fa-circle', "group" => "Ap_comment"),
          array("name" => "ติดตามลูกหนี้คงค้างชำระ", 'url' => site_url('/Ar_comment'), 'icon' => 'fas fa-circle', "group" => "Ar_comment"),
          array("name" => "ส่วนต่างค้างรับ", 'url' => site_url('/Diff_Comment'), 'icon' => 'fas fa-circle', "group" => "SignV2"),
          array("name" => "บันทึกการรับบิล", 'url' => site_url('/Record_bill'), 'icon' => 'fas fa-circle', "group" => "SignV2"),
          array("name" => "บันทึกการรับบิล(ไปรษณีย์)", 'url' => site_url('/Record_bill_post'), 'icon' => 'fas fa-circle', "group" => "SignV2"),
          array("name" => "ใบกำกับภาษี", 'url' => site_url('/Tax_Comment/TaxManage'), 'icon' => 'fas fa-circle', "group" => "SignV2"),
          array("name" => "บันทึกใบลดหนี้", 'url' => site_url('/Refund'), 'icon' => 'fas fa-circle', "group" => "Refund"),
          array("name" => "บันทึกลงบิลตั้งหนี้", 'url' => site_url('/Record_Debt'), 'icon' => 'fa fa-circle', "group" => "Record_Debt"),
          array("name" => "ใบสำคัญจ่าย ไม่มีภาษี", 'url' => site_url('/Payment_Novat'), 'icon' => 'fas fa-circle', "group" => "SignV2"),
          array("name" => "ค่าใช้จ่ายในร้าน ไม่มีภาษี", 'url' => site_url('/Payment_InStore'), 'icon' => 'fas fa-circle', "group" => "SignV2"),
            )
        ), 
        
        array("name" => 'สถาปนิก', 'url' => "javascript:void(0)", 'icon' => 'fa fa-building', "group" => "Main", "active" => "",
        'dropdown' => array(
            array("name" => "ใบส่งมอบงานแผนกสถาปนิก", 'url' => site_url('/Arc_completion'), 'icon' => 'fas fa-circle', "group" => "Arc_completion"),
            array("name" => "รายการตรวจงานผลิต", 'url' => site_url('/Check_stkissue'), 'icon' => 'fas fa-circle', "group" => "Check_stkissue")
            )
        ),

           
        array("name" => 'เช่า - ยืม', 'url' => "javascript:void(0)", 'icon' => 'fas fa-exchange-alt', "group" => "Main", "active" => "",
        'dropdown' => array(
            array("name" => "สินค้าเช่า - ยืม", 'url' => site_url('/Rent/rent_product'), 'icon' => 'fas fa-circle', "group" => "Rent/rent_product"),
            array("name" => "ใบสัญญาเช่า - ยืม", 'url' => site_url('/Rent'), 'icon' => 'fas fa-circle', "group" => "Rent")
            )
        ),

        array("name" => 'จัดซื้อ', 'url' => "javascript:void(0)", 'icon' => 'fa fa-chevron-circle-down', "group" => "Main", "active" => "",
        'dropdown' => array(
            array("name" => "รายการส่งเสริมการขาย", 'url' => site_url('/Sales_target'), 'icon' => 'fas fa-circle', "group" => "Sales_target"),
            array("name" => "ติดตามใบเสนอซื้อคงค้าง(งดใช้งาน 31/12/2564)", 'url' => site_url('/PR_Comment'), 'icon' => 'fas fa-circle', "group" => "PR_Comment"),
              // array("name" => "ติดตามสินค้าค้างรับ", 'url' => site_url('/PO_comment'), 'icon' => 'fas fa-circle', "group" => "PO_comment"),
            array("name" => "ติดตามสินค้าค้างรับV2", 'url' => site_url('/PO_CommentV2'), 'icon' => 'fas fa-circle', "group" => "PO_CommentV2"),
            array("name" => "ติดตามสินค้าบริการค้างรับ", 'url' => site_url('/PO_Service'), 'icon' => 'fas fa-circle', "group" => "PO_Service"),
            array("name" => "ติดตามสินค้าถึงจุดสั่งซื้อ", 'url' => site_url('/PURC_Comment'), 'icon' => 'fas fa-circle', "group" => "PURC_Comment")

            )
        ),

        array("name" => 'ขาย', 'url' => "javascript:void(0)", 'icon' => 'fa fa-tags', "group" => "Main", "active" => "",
        'dropdown' => array(
          array("name" => "สินค้าฝากขาย", 'url' => site_url('/Consignment'), 'icon' => 'fas fa-circle', "group" => "Consignment"),
            )
        ),

        array("name" => 'สินค้าคงคลัง', 'url' => "javascript:void(0)", 'icon' => 'fa fa-cubes', "group" => "Main", "active" => "",
        'dropdown' => array(
            array("name" => "จัดของให้ลูกค้า", 'url' => site_url('/Deliver_products'), 'icon' => 'fas fa-circle', "group" => "Deliver_products"),
            array("name" => "รายการสินค้าแบ่งขาย", 'url' => site_url('/Metal_meter'), 'icon' => 'fas fa-circle', "group" => "Metal_meter"),
            array("name" => "นับสต๊อกสินค้าตามใบสั่งซื้อ V2", 'url' => site_url('/Check_StkPOV2'), 'icon' => 'fas fa-circle', "group" => "Check_StkPOV2"),
            
          
            array("name" => "ติดตามสินค้าค้างส่ง", 'url' => site_url('/SO_comment'), 'icon' => 'fas fa-circle', "group" => "SO_comment"),
          
            array("name" => "ติดตามสินค้าเคลม", 'url' => site_url('/WL_Comment'), 'icon' => 'fas fa-circle', "group" => "WL_Comment"),
            array("name" => "สินค้าหมดอายุ(FIFO)", 'url' => site_url('/Fifo_Comment'), 'icon' => 'fas fa-circle', "group" => "Fifo_Comment"),
            array("name" => "รายการขายของเก่า", 'url' => site_url('/Sale_scrap'), 'icon' => 'fas fa-circle', "group" => "Sale_scrap"),
            array("name" => "สินค้าเคลม", 'url' => site_url('/Claim_Product'), 'icon' => 'fas fa-circle', "group" => "Claim_Product")

            )
        ),

        array("name" => 'ป้ายสินค้า', 'url' => "javascript:void(0)", 'icon' => 'fa fa-barcode', "group" => "Main", "active" => "",
        'dropdown' => array(
            array("name" => 'รายการป้ายสินค้า', 'url' => site_url('/Sign'), 'icon' => 'fas fa-circle', "group" => "Sign"),
            array("name" => 'จัดซื้อ', 'url' => site_url('/Sign/purchase_add'), 'icon' => 'fas fa-circle',"group" => "Sign/purchase_add"),
            array("name" => 'ขอทำป้าย', 'url' => site_url('/Sign/depart_confirm'), 'icon' => 'fas fa-circle', "group" => "Sign/depart_confirm"),
            array("name" => 'บรรจุภัณฑ์', 'url' => site_url('/Sign/packing_loaddata'), 'icon' => 'fas fa-circle', "group" => "Sign/packing_loaddata")
            )
        ),

        array("name" => 'ป้ายสินค้าV2', 'url' => "javascript:void(0)", 'icon' => 'fa fa-barcode', "group" => "Main", "active" => "",
        'dropdown' => array(
            array("name" => 'รายการป้ายสินค้าV2', 'url' => site_url('/SignV2'), 'icon' => 'fas fa-circle', "group" => "SignV2"),
            array("name" => 'จัดซื้อV2', 'url' => site_url('/SignV2/purchase_add'), 'icon' => 'fas fa-circle',"group" => "SignV2/purchase_add"),
            array("name" => 'ขอทำป้ายV2', 'url' => site_url('/SignV2/depart_confirm'), 'icon' => 'fas fa-circle', "group" => "SignV2/depart_confirm"),
            array("name" => 'บรรจุภัณฑ์V2', 'url' => site_url('/SignV2/packing_loaddata'), 'icon' => 'fas fa-circle', "group" => "SignV2/packing_loaddata"),
            array("name" => 'อนุมัติการขอแก้ไขV2', 'url' => site_url('/SignV2/sign_request_confirm'), 'icon' => 'fas fa-circle', "group" => "SignV2/sign_request_confirm")
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

        array("name" => 'Admin', 'url' => "javascript:void(0)", 'icon' => 'fas fa fa-users-cog', "group" => "Main", "active" => "",
        'dropdown' => array(
            array("name" => 'สิทธิ์ผู้ใช้', 'url' => site_url('/Privilege/group'), 'icon' => 'fas fa-circle', "group" => "Privilege/group"),
            array("name" => 'Log', 'url' => site_url('/Admin/home_log_admin/'), 'icon' => 'fas fa-circle', "group" => "Admin/home_log_admin"),
            array("name" => 'User', 'url' => site_url('/Admin/home_user_admin/'), 'icon' => 'fas fa-circle', "group" => "Admin/home_user_admin"),
            array("name" => 'Application', 'url' => site_url('/Admin/home_application_admin/'), 'icon' => 'fas fa-circle', "group" => "Admin/home_application_admin"),
            array("name" => 'Class', 'url' => site_url('/Admin/home_class_admin/'), 'icon' => 'fas fa-circle', "group" => "Admin/home_class_admin"),
            array("name" => 'Function', 'url' => site_url('/Admin/home_functions_admin/'), 'icon' => 'fas fa-circle', "group" => "Admin/home_functions_admin"),
            )   
        ),
          
    );

  ?>
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-2 sidebar-light-danger">
    <!-- Brand Logo -->
    <a href="/sk_main/?" class="brand-link">
      <img src="<?= base_url('assets/images/logo_company/logo_company_0.png') ?>" alt="" class="brand-image img-circle elevation-0" style="opacity: .8">
      <span class="brand-text font-weight-light Kanit-Regular">SK-GROUP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/images/default_user.png') ?>" class="img-circle elevation-0" alt="">
        </div>
        <div class="info">
          
          <?php
            $userDepart = $this->Function_model->userDepart();
            $departR = $userDepart->first_row();
          ?>
          <span class="d-block">สวัสดีคุณ <?= $_SESSION['saeree_name'] ?></span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <?php foreach ($navbar as $item){ ?>
            <?php if (isset($CheckPrivilegeFunction[$item['group']])){ ?>
              <li class="nav-item has-treeview">
                <a href="<?= $item['url'] ?>" class="nav-link <?= $item['active'] ?>">
                  <i class="nav-icon fas <?= $item['icon'] ?>"></i>
                  <p>
                    <?= $item['name'] ?>
                    <?php if (isset($item['dropdown'])) { ?>
                    <i class="fas fa-angle-left right"></i>
                    <?php } ?>
                  </p>
                </a>
                <?php if (isset($item['dropdown'])) { ?>
                <ul class="nav nav-treeview">
                  <?php foreach ($item['dropdown'] as $dropdown) { ?>
                    <?php if (isset($CheckPrivilegeFunction[$dropdown['group']])){ ?>
                      <li class="nav-item">
                      <a href="<?= $dropdown['url'] ?>" class="nav-link">
                        <i class="nav-icon far <?= $dropdown['icon'] ?> "></i>
                        <p><?= $dropdown['name'] ?></p>
                      </a>
                      
                      </li>
                    <?php } ?>
                  <?php } ?>
                </ul>
                <?php } ?>
              </li>
            <?php } ?>
          <?php }; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>