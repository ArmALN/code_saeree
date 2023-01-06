<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_production_model extends CI_Model{

    // ADD PROCESS
    public function __construct() {
        parent::__construct();

        // $this->load->library("mpdf60/mpdf");
        $this->load->model('All_electronic_signature_model');
        $this->load->model('All_activity_log_model');
        $this->load->model('All_tools_certificate_signature_model');
        $this->load->model('All_tools_docno_model');
        
    }

    function get_os() 
	{ 
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$os_platform =   "Bilinmeyen İşletim Sistemi";
		$os_array =   array(
			'/windows nt 10/i'      =>  'Windows 10',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/android/i'            =>  'Android',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile'
		);
		foreach ( $os_array as $regex => $value ) { 
			if ( preg_match($regex, $user_agent ) ) {
				$os_platform = $value;
			}
		} 

		return $os_platform;
	}
	
	function get_browser($user_agent)
	{
		if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
		elseif (strpos($user_agent, 'Edge')) return 'Edge';
		elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
		elseif (strpos($user_agent, 'Safari')) return 'Safari';
		elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
		elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';

		return 'Other';
	}

    function get_data_request_production($value1,$value2)
    {

        $this->db = $this->load->database('default', TRUE);
       
        $this->db->select("
            tb_request_production.*,

            ec.id AS ecid,
            ec.pepleid AS ecpepleid,
            ec.firstname AS ecfirstname,
            ec.lastname AS eclastname,
            ec.nickname AS ecnickname,
            dc.id AS  dcid,
            dc.name AS dcname,

            ect.id AS ectid,
            ect.pepleid AS ectpepleid,
            ect.firstname AS ectfirstname,
            ect.lastname AS ectlastname,
            ect.nickname AS ectnickname,
            dct.id AS  dctid,
            dct.name AS dctname,
           
            tb_request_production_topic.field_id AS topic_id,
            tb_request_production_topic.field_topic AS topic_name,

            drp.name AS drpname,

            CASE
                WHEN tb_request_production.field_doc_type = 1  THEN 'งานสั่งผลิต'
                WHEN tb_request_production.field_doc_type = 2  THEN 'งานสั่งซ่อม'
                ELSE 'ไม่ได้ระบุ'
            END AS doc_type_status ,

            CONCAT( ec.firstname, ' ' , ec.lastname, ' (', ec.nickname , ') ' ) AS ecfullname ,
            CONCAT( ect.firstname, ' ' , ect.lastname, ' (', ect.nickname , ') ' ) AS ectfullname ,

        ");
        
        $this->db->from('tb_request_production');

        $this->db->join('employee ec','ec.id = tb_request_production.field_rp_creator');
        $this->db->join('depart dc','dc.id = ec.depart_id');

        $this->db->join('employee ect','ect.id = tb_request_production.field_rp_controller'  , 'left');
        $this->db->join('depart dct','dct.id = ect.depart_id'  , 'left');

        $this->db->join('employee employeect','employeect.id = tb_request_production.field_rp_controller' , 'left');
        $this->db->join('depart departct','departct.id = employeect.depart_id', 'left');

        $this->db->join('tb_request_production_topic','tb_request_production_topic.field_id = tb_request_production.field_rp_topic');
        $this->db->join('depart drp','drp.id = tb_request_production.field_rp_depart');

        $this->db->where('tb_request_production.field_id',$value1);
        $data = $this->db->get()->result_array()[0];

        return $data;
    }

    function get_data_request_production_worker($value1,$value2)
    {

        $this->db = $this->load->database('default', TRUE);

        $this->db->select("
        
            tb_request_production_worker.*,
            ew.pepleid AS ewpepleid,
            ew.firstname AS ewfirstname,
            ew.lastname AS ewlastname,
            ew.nickname AS ewnickname,
            ew.lastposition AS ewlastposition,
            dw.name AS dwname ,

            CONCAT( ew.firstname, ' ' , ew.lastname, ' (', ew.nickname , ') ' ) AS ewfullname ,

            CASE
                WHEN tb_request_production_worker.field_status IS NULL  THEN '<span class=\"text-warning\">รอระบุสถานะ</span>'
                WHEN tb_request_production_worker.field_status = 0  THEN '<span class=\"text-success\">ทำงาน</span>'
                WHEN tb_request_production_worker.field_status = 1  THEN '<span class=\"text-danger\">ไม่ได้ทำงาน</span>'
                ELSE ''
            END AS accept_status

        ");
        $this->db->from('tb_request_production_worker');
        $this->db->join('employee ew',' ew.id = tb_request_production_worker.field_employee_id ');
        $this->db->join('depart dw',' dw.id = ew.depart_id');
        $this->db->where('tb_request_production_worker.field_rp_id',$value1);

        if($value2 == '0'){
            $this->db->where('tb_request_production_worker.field_status',0);
        }
        
        $data = $this->db->get()->result_array();

        return $data;
    }

    function get_data_request_production_fixitem($value1,$value2)
    {

        $this->db = $this->load->database('default', TRUE);

        $this->db->select("
            tb_request_production_fixitem.*,
        ");
        $this->db->from('tb_request_production_fixitem');
        $this->db->where('tb_request_production_fixitem.field_id',$value1);
        $data = $this->db->get()->result_array()[0];

        return $data;
    }

    // function get_data_request_production_fixitem_sub($value1,$value2)
    // {

    //     $this->db = $this->load->database('default', TRUE);

    //     $this->db->select("
    //         tb_request_production_fixitem_sub.*,
    //     ");
    //     $this->db->from('tb_request_production_fixitem_sub');
    //     $this->db->where('tb_request_production_fixitem_sub.field_id',$value1);
    //     $data = $this->db->get()->result_array()[0];

    //     return $data;
    // }

    function get_data_request_production_item($value1,$value2)
    {

        $this->db = $this->load->database('default', TRUE);

        if($value2 == 'doclist'){
            $this->db->select("
                tb_request_porduction_item.field_bc_docno
            ");	 
        }else if($value2 == 'laborlist'){
            $this->db->select("
                tb_request_porduction_item.*
            ");	 
        }else if($value2 == 'itemlist'){
            $this->db->select("
                tb_request_porduction_item.*
            ");	 
        }else if($value2 == 'all'){
            $this->db->select("
                tb_request_porduction_item.*
            ");	 
        }
      
        $this->db->from('tb_request_porduction_item');
        $this->db->where('tb_request_porduction_item.field_rp_id',$value1);
        
        if($value2 == 'doclist'){
            $this->db->where('tb_request_porduction_item.field_bc_docno is NOT NULL', NULL, FALSE);	
            $this->db->group_by('tb_request_porduction_item.field_bc_docno'); 
            $this->db->order_by('tb_request_porduction_item.field_id','ASC');	 
            $data = $this->db->get()->result_array();
        }else if($value2 == 'laborlist'){
            $this->db->where('tb_request_porduction_item.field_bc_docno is NULL', NULL, FALSE);	
            $this->db->order_by('tb_request_porduction_item.field_id','ASC');	
            $data = $this->db->get()->result_array();
        }else if($value2 == 'itemlist'){
            $this->db->where('tb_request_porduction_item.field_bc_docno is NOT NULL', NULL, FALSE);	
            $this->db->order_by('tb_request_porduction_item.field_id','ASC');	
            $data_itemlist = $this->db->get()->result_array();

                $data = array();
                foreach ($data_itemlist as $key => $value){

                    if(isset($value['field_database'])){
                        $get_stkissue_docno = $this->get_stkissue(
                            $value['field_database'],
                            $value['field_bc_docno'],
                            $value['field_bc_item_code'],
                            $value['field_item_qty']
                        );
                        // $data['get_stkissue_docno'] = $get_stkissue_docno;
                    }else{
                        $get_stkissue_docno = 'nodata';
                    }
                    if($get_stkissue_docno != 'nodata'){
                        $stkissue_docno = ["stkissue_docno" => $get_stkissue_docno[0]['Docno']];
                        $stkissue_qty = ["stkissue_qty" => $get_stkissue_docno[0]['Qty']];

                        $get_stkissueRet_docno = $this->get_stkissueRet(
                            $value['field_database'],
                            $stkissue_docno['stkissue_docno'],
                            $value['field_bc_item_code']
                        );
                        if($get_stkissueRet_docno != 'nodata'){

                            // $data['get_stkissueRet_docno_checksss'] = $get_stkissueRet_docno;


                            if(count($get_stkissueRet_docno) == 2){

                                $BCStkIssueRetSub_MyDescription1 = ["BCStkIssueRetSub_MyDescription" => $get_stkissueRet_docno[0]['BCStkIssueRetSub_MyDescription']];
                                $stkissueRet_docno1 = ["stkissueRet_docno" => $get_stkissueRet_docno[0]['BCStkIssueRetSub_docno']];
                                $stkissueRet_qty1 = ["stkissueRet_qty" => $get_stkissueRet_docno[0]['BCStkIssueRetSub_qty']];

                                $BCStkIssueRetSub_MyDescription2 = ["BCStkIssueRetSub_MyDescription2" => $get_stkissueRet_docno[1]['BCStkIssueRetSub_MyDescription']];
                                $stkissueRet_docno2 = ["stkissueRet_docno2" => $get_stkissueRet_docno[1]['BCStkIssueRetSub_docno']];
                                $stkissueRet_qty2 = ["stkissueRet_qty2" => $get_stkissueRet_docno[1]['BCStkIssueRetSub_qty']];

                                $maxqty_item_invoice = $value + $stkissue_docno + $stkissue_qty + $BCStkIssueRetSub_MyDescription1 + $stkissueRet_docno1 + $stkissueRet_qty1 +  $BCStkIssueRetSub_MyDescription2 + $stkissueRet_docno2 + $stkissueRet_qty2;
                                array_push($data,$maxqty_item_invoice);
                            }elseif(count($get_stkissueRet_docno) == 1){

                                $BCStkIssueRetSub_MyDescription = ["BCStkIssueRetSub_MyDescription" => $get_stkissueRet_docno[0]['BCStkIssueRetSub_MyDescription']];
                                $stkissueRet_docno = ["stkissueRet_docno" => $get_stkissueRet_docno[0]['BCStkIssueRetSub_docno']];
                                $stkissueRet_qty = ["stkissueRet_qty" => $get_stkissueRet_docno[0]['BCStkIssueRetSub_qty']];

                                $maxqty_item_invoice = $value + $stkissue_docno + $stkissue_qty + $BCStkIssueRetSub_MyDescription + $stkissueRet_docno + $stkissueRet_qty;
                                array_push($data,$maxqty_item_invoice);
                            }
                        }else{
                            $BCStkIssueRetSub_MyDescription = ["BCStkIssueRetSub_MyDescription" => ''];
                            $stkissueRet_docno = ["stkissueRet_docno" => ''];
                            $stkissueRet_qty = ["stkissueRet_qty" => 0];
                            $maxqty_item_invoice = $value + $stkissue_docno + $stkissue_qty + $BCStkIssueRetSub_MyDescription + $stkissueRet_docno + $stkissueRet_qty;
                            array_push($data,$maxqty_item_invoice);
                        }
                    }else{
                        $stkissue_docno = ["stkissue_docno" => '' ];
                        $stkissue_qty = ["stkissue_qty" => 0 ];
                        $BCStkIssueRetSub_MyDescription = ["BCStkIssueRetSub_MyDescription" => ''];
                        $stkissueRet_docno = ["stkissueRet_docno" => ''];
                        $stkissueRet_qty = ["stkissueRet_qty" => 0];

                        $maxqty_item_invoice = $value + $stkissue_docno + $stkissue_qty + $BCStkIssueRetSub_MyDescription + $stkissueRet_docno + $stkissueRet_qty;
                        array_push($data,$maxqty_item_invoice);
                    }
                }

        }else if($value2 == 'all'){
            $this->db->order_by('tb_request_porduction_item.field_id','ASC');	
            $data = $this->db->get()->result_array();
        }


        return $data;
    }

    function get_data_request_production_manager($value1)
    {

        $this->db = $this->load->database('default', TRUE);

        $this->db->select("
            tb_request_production_manager.*,
            employee.id,
            employee.pepleid,
            employee.beforname,
            employee.firstname,
            employee.lastname,
            employee.nickname,
            employee.lastposition ,
            CONCAT( employee.firstname, ' ' , employee.lastname, ' (', employee.nickname , ') ' ) AS fullname ,
            CASE
                WHEN tb_request_production_manager.field_approve = 0  THEN '<span class=\"text-warning\">รออนุมัติ</span>'
                WHEN tb_request_production_manager.field_approve = 1  THEN '<span class=\"text-success\">อนุมัติ</span>'
                WHEN tb_request_production_manager.field_approve = 2  THEN '<span class=\"text-danger\">ไม่อนุมัติ</span>'
                ELSE ''
            END AS approve_status

		");
		$this->db->from('tb_request_production_manager');
		$this->db->join('employee',' employee.id = tb_request_production_manager.field_employee_id ');
		$this->db->where('tb_request_production_manager.field_rp_id',$value1);
		$data = $this->db->get()->result_array();

        return $data;
    }

    function get_data_request_production_ceo($value1)
    {

        $this->db = $this->load->database('default', TRUE);

        $this->db->select('*');      
		$this->db->from('tb_request_production_ceo');
		$this->db->where('tb_request_production_ceo.field_rp_id',$value1);
        $this->db->order_by('tb_request_production_ceo.field_date', 'DESC');
		$data = $this->db->get()->result_array();

        return $data;
    }

    function get_stkissue(
        $field_database,
        $field_bc_docno,
        $field_bc_item_code,
        $field_item_qty
        )
    {

        $this->db = $this->load->database( $field_database, TRUE);

        $this->db->select('
            ic_trans_detail.doc_no as Docno,
            ic_trans_detail.item_code as ItemCode,
            ic_trans_detail.qty as Qty,
            ic_trans_detail.ref_doc_no as Refno');
        $this->db->from('ic_trans_detail');
        $this->db->where('ic_trans_detail.ref_doc_no',$field_bc_docno);
        $this->db->where('ic_trans_detail.item_code',$field_bc_item_code);
        $data_stkissue = $this->db->get()->result_array();

        if(count($data_stkissue) > 0){
            $data = $data_stkissue;
        }else{
            $data = 'nodata';
        }

        return $data;
    
    }

    function get_stkissueRet(
        $field_database,
        $stkissue_docno,
        $stkissue_itemcode
        )
    {
        $this->db = $this->load->database($field_database, TRUE);

        $this->db->select('
            ic_trans.remark AS BCStkIssueRetSub_MyDescription,
            ic_trans_detail.doc_no AS BCStkIssueRetSub_docno,
            ic_trans_detail.qty AS BCStkIssueRetSub_qty');
        $this->db->from('ic_trans_detail');
        $this->db->join('ic_trans','ic_trans.doc_no = ic_trans_detail.doc_no');
        $this->db->where('ic_trans_detail.ref_doc_no',$stkissue_docno);
        $this->db->where('ic_trans_detail.item_code',$stkissue_itemcode);
        $data_stkissueRet = $this->db->get()->result_array();
        if(count($data_stkissueRet) > 0){
            $data = $data_stkissueRet;
        }else{
            $data = 'nodata';
        }
        return $data;
    }

    public function get_manage_confirm_model()
    {

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

		$this->db->select("
            tb_request_production.*,
            CASE
                WHEN tb_request_production.field_rp_status = 0  THEN '<span class=\"text-black\">(รอผู้บริหารอนุมัติ)</span>'
                WHEN tb_request_production.field_rp_status = 1  THEN '<span class=\"text-black\">(ผู้บริหารอนุมัติ)</span>'
                WHEN tb_request_production.field_rp_status = 5  THEN '<span class=\"text-black\">(ผู้บริหารไม่อนุมัติ)</span>'
                WHEN tb_request_production.field_rp_status = 8  THEN '<span class=\"text-black\">(ผู้บริหารสั่งแก้)</span>'
                WHEN tb_request_production.field_rp_status = 9  THEN '<span class=\"text-black\">(ผู้บริหารสั่งแก้)</span>'
                ELSE ''
            END AS approve_status
        ");
		$this->db->from('tb_request_production');
		$this->db->where('tb_request_production.field_id',$_data['id']);
		$data['data_rp'] = $this->db->get()->result_array()[0];

		$data['data_preconfirm'] = $this->get_data_request_production_manager($_data['id']);

        

        return $data;

    }
        
    public function get_depart_model()
    {

        $this->db = $this->load->database('default', TRUE);

        $this->db->select('*');
        $this->db->from('depart');
        $this->db->where('depart.depart_status', 0);
		$this->db->order_by('depart.order_no','ASC');
        $data['depart'] = $this->db->get()->result_array();

        return $data;
    }

    public function get_topic_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $this->db->select('*');
        $this->db->from('tb_request_production_topic');
        $this->db->where('field_trash',0);
        $this->db->order_by('field_id','ASC');
        $data['topic'] = $this->db->get()->result_array();

        return $data;
    }

    public function autocomplete_request_production_model()
    { 

        $_data = $_REQUEST;

        $this->db = $this->load->database('default', TRUE);

        // $search = $_data['search'];

        $search_text = explode(" ",$_data['search']);
		$count_search_text = count($search_text);

        $this->db->select('
            tb_request_production.field_id,
            tb_request_production.field_docno,
            tb_request_production.field_rp_name
        ');
        $this->db->from('tb_request_production');
        // $this->db->group_start();
        //     $this->db->or_like('tb_request_production.field_docno',$search_text, 'both');
        //     $this->db->or_like('tb_request_production.field_rp_name',$search_text, 'both');
        // $this->db->group_end();
        if($search_text != ''){
			$this->db->group_start();
				for($i=0;$i<$count_search_text;$i++){
					$this->db->like('tb_request_production.field_docno',$search_text[$i], 'both');
				}
			
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('tb_request_production.field_rp_name',$search_text[$i], 'both');
				}
		
			$this->db->group_end();
		}
        $this->db->where('tb_request_production.field_rp_trash',0);
        $this->db->where('tb_request_production.field_fixitem_sub_id is NULL', NULL, FALSE);
        $this->db->limit(10);
        $data = $this->db->get()->result_array();

        foreach($data as $row){
            $result['field_id'] = $row['field_id'];
            $result['field_docno'] = $row['field_docno'];
            $result['field_rp_name'] = $row['field_rp_name'];
            $result['label'] = $row['field_docno'].' -> ' . $row['field_rp_name'];
            $data['request_production'][] = $result;
        }
        return $data;
        
    }

    public function check_request_product_model()
    {

        $this->db = $this->load->database('default', TRUE);
        $_data = $_REQUEST;
        $this->db->select('
            tb_request_production.field_id,
            tb_request_production.field_docno,
            tb_request_production.field_rp_name
        ');
        $this->db->from('tb_request_production');
        // $this->db->where('tb_request_production.field_rp_trash',0);
        $this->db->where('tb_request_production.field_docno',$_data['docno']);
        $data['request_production'] = $this->db->get()->result_array()[0];

        return $data;
    }

    public function autocomplete_project_department_model()
    { 

        $_data = $_REQUEST;

        $this->db = $this->load->database($_data['database'], TRUE);

        $search = $_data['search'];

        $sql = " ";
        $sql .= "SELECT TOP 10 * FROM ( ";
        $sql .= "SELECT ";
        $sql .= "Code , Name ";
        $sql .= "FROM ";
        $sql .= "BCProject ";
        $sql .= "UNION ";
        $sql .= "SELECT ";
        $sql .= "Code , Name ";
        $sql .= "FROM ";
        $sql .= "BCDepartment ";
        $sql .= ") AS project_department ";
        $sql .= "WHERE project_department.Code LIKE '%" . $search . "%' " ;
        $sql .= "OR project_department.Name LIKE '%" . $search . "%' " ;
       
        $data = $this->db->query($sql)->result_array();

        foreach($data as $row){

            $result['Code'] = $row['Code'];
            $result['Name'] = $row['Name'];
            $result['label'] = $row['Code'].' -> ' . $row['Name'];
            $data['project_department'][] = $result;
        }

        return $data;
        
    }

    public function autocomplete_stkissue_model()
    { 

        $_data = $_REQUEST;

        $this->db = $this->load->database($_data['database'], TRUE);

        $search = $_data['search_stkissue'];
        $field_docno = $_data['field_docno'];

        $this->db->select('
            ic_trans.remark as MyDescription,
            ic_trans.doc_no as Docno
        ');
        $this->db->from('ic_trans');
        $this->db->where('ic_trans.is_lock_record','0');
        $this->db->like('ic_trans.doc_no','DR','after');
        $this->db->like('ic_trans.remark',$field_docno);
        $this->db->group_start();
            $this->db->like('ic_trans.doc_no',$search);
        $this->db->group_end();
        $this->db->limit(10);
        $data = $this->db->get()->result_array();

        foreach($data as $row){
            $result['Docno'] = $row['Docno'];
            $result['MyDescription'] = $row['MyDescription'];
            $result['label'] = $row['Docno'].' -> ' . $row['MyDescription'];
            $result['ssss'] = $field_docno;
            $data['stkissue'][] = $result;
        }

        return $data;
    }
  
    public function get_rp_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;
        
        $CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction();
        $data_permission = $this->permission_model();

        $usersPerPage = $_data['usersPerPage'];
        $pageNumber = $_data['pageNumber'] * $usersPerPage;		

        $search_text = '';
        $search_depart = '';
        $search_status = '';
        $search_doc_type = '';

        if(isset($_data['search_text'])){
            // $search_text = $_data['search_text'];
            $search_text = explode(" ",$_data['search_text']);
            $count_search_text = count($search_text);
        }

        if(isset($_data['search_depart'])){
            $search_depart = $_data['search_depart'];
        }

        if(isset($_data['search_status'])){
            $search_status = $_data['search_status'];
        }

        if(isset($_data['search_doc_type'])){
            $search_doc_type = $_data['search_doc_type'];
        }
   
        $this->db->select("
            tb_request_production.field_id,
            tb_request_production.field_rp_status,
            tb_request_production.field_docno,
            tb_request_production.field_rp_name,
            tb_request_production.field_rp_status,
            tb_request_production.field_request_backward_status,
            rp_topic.field_id AS topic_id,
            rp_topic.field_topic AS topic_name,
            rp_topic.field_depart_id AS topic_depart,

            CONCAT( ec.firstname, ' ' , ec.lastname, ' (', ec.nickname , ') ' ) AS ecfullname ,

            CASE
                WHEN tb_request_production.field_doc_type = 0 OR tb_request_production.field_doc_type IS NULL THEN '<span class=\"text-gray\">ไม่ได้ระบุประเภท</span>'
                WHEN tb_request_production.field_doc_type = 1  THEN '<span class=\"badge bg-light\"><i class=\"fa fa-certificate\"></i> สั่งผลิต</span>'
                WHEN tb_request_production.field_doc_type = 2  THEN '<span class=\"badge bg-light\"><i class=\"fa fa-wrench\"></i> สั่งซ่อม</span>'
                ELSE ''
            END AS doc_type_status,

            CONCAT('<b>ประมาณการ</b> ', FORMAT(tb_request_production.field_rp_cost_estimate,2)) AS rp_cost_estimate_status ,

            CASE
                WHEN tb_request_production.field_rp_cost_final IS NULL THEN ''
                WHEN 
                    tb_request_production.field_rp_cost_final IS NOT NULL AND (tb_request_production.field_rp_cost_final > tb_request_production.field_rp_cost_estimate)
                THEN  CONCAT('<span class=\"text-danger\">ใช้จริง ', ' ' , FORMAT(tb_request_production.field_rp_cost_final,2) , '</span>') 
                WHEN 
                tb_request_production.field_rp_cost_final IS NOT NULL AND (tb_request_production.field_rp_cost_final < tb_request_production.field_rp_cost_estimate)
                THEN CONCAT('<span class=\"text-success\">ใช้จริง ', ' ' , FORMAT(tb_request_production.field_rp_cost_final,2) , '</span>') 
                WHEN 
                tb_request_production.field_rp_cost_final IS NOT NULL AND (tb_request_production.field_rp_cost_final = tb_request_production.field_rp_cost_estimate)
                THEN CONCAT('<span class=\"text-success\">ใช้จริง ', ' ' , FORMAT(tb_request_production.field_rp_cost_final,2) , '</span>') 
                ELSE ''
            END AS rp_cost_final_status ,


            CASE
                WHEN tb_request_production.field_rp_status = 1 AND tb_request_production.field_count_print = 0
                THEN '&emsp;<span class=\"text-gray\"><i class=\"fa fa-print\"></i> พิมพ์ใบสั่งผลิต-สั่งซ่อม </span><br>&emsp;<span class=\"text-warning\"><i class=\"fas fa-clock\"></i> รอระบุผู้รับทำงาน </span>'
                WHEN tb_request_production.field_rp_status = 1 AND tb_request_production.field_count_print > 0
                THEN CONCAT('&emsp;<span class=\"text-success\"><i class=\"fa  fa-print\"></i> พิมพ์ใบสั่งผลิต-สั่งซ่อม (', tb_request_production.field_count_print ,') </span><br>&emsp;<span class=\"text-warning\"><i class=\"fas fa-clock\"></i> รอระบุผู้รับทำงาน </span>')
                
                WHEN (tb_request_production.field_rp_status = 2 OR tb_request_production.field_rp_status = 3 OR tb_request_production.field_rp_status = 4) AND tb_request_production.field_count_print = 0
                THEN '&emsp;<span class=\"text-gray\"><i class=\"fa fa-print\"></i> พิมพ์ใบสั่งผลิต-สั่งซ่อม </span><br>&emsp;<span class=\"text-success\"><i class=\"fa fa-check-circle\"></i> ระบุผู้รับทำงานแล้ว </span>'
                WHEN (tb_request_production.field_rp_status = 2 OR tb_request_production.field_rp_status = 3 OR tb_request_production.field_rp_status = 4) AND tb_request_production.field_count_print > 0
                THEN CONCAT('&emsp;<span class=\"text-success\"><i class=\"fa  fa-print\"></i> พิมพ์ใบสั่งผลิต-สั่งซ่อม (', tb_request_production.field_count_print ,') </span><br>&emsp;<span class=\"text-success\"><i class=\"fa fa-check-circle\"></i> ระบุผู้รับทำงานแล้ว </span>')
                
                WHEN tb_request_production.field_rp_status = 6
                THEN '&emsp;<span class=\"text-danger\"><i class=\"fa fa-times-circle\"></i> ยกเลิกงาน </span> '

                WHEN tb_request_production.field_rp_status = 7
                THEN '&emsp;<span class=\"text-danger\"><i class=\"fa fa-times-circle\"></i> งานไม่ผ่าน </span> '
                ELSE ''
            END AS work_status ,

            CASE
                WHEN tb_request_production.field_rp_status = 2 OR tb_request_production.field_rp_status = 3
                THEN '&emsp;<span class=\"text-warning\"><i class=\"fas fa-clock\"></i> รอตรวจรับงาน </span>'
                
                WHEN tb_request_production.field_rp_status = 4
                THEN '&emsp;<span class=\"text-success\"><i class=\"fa fa-check-circle\"></i> รับงานเรียบร้อย </span> '
                
                ELSE ''
            END AS success_status ,
            
            CASE
                WHEN tb_request_production.field_rp_status = 0 
                THEN '&emsp;<span class=\"text-warning\"><i class=\"fas fa-clock\"></i> รอผู้บริหารอนุมัติ </span> '
                
                WHEN tb_request_production.field_rp_status = 1 OR tb_request_production.field_rp_status = 2  OR tb_request_production.field_rp_status = 3 OR tb_request_production.field_rp_status = 4 OR tb_request_production.field_rp_status = 6 OR tb_request_production.field_rp_status = 7
                THEN '&emsp;<span class=\"text-success\"><i class=\"fa fa-check-circle\"></i> ผู้บริหารอนุมัติ </span> '

                WHEN tb_request_production.field_rp_status = 5
                THEN '&emsp;<span class=\"text-danger\"><i class=\"fa fa-times-circle\"></i> ผู้บริหารไม่อนุมัติ </span> '
                
                WHEN tb_request_production.field_rp_status = 8
                THEN '&emsp;<span class=\"text-danger\"><i class=\"fa fa-edit\"></i> <b>ผู้บริหารสั่งแก้</b> </span> '

                WHEN tb_request_production.field_rp_status = 9
                THEN '&emsp;<span class=\"text-blue\"><i class=\"fa fa-edit\"></i> <b>แก้ไขตามผู้บริหารสั่งแล้ว</b> </span> '
                ELSE ''
            END AS ceo_status ,

            CASE
                WHEN tb_request_production.field_request_backward_status = 1 
                THEN '&emsp;<span class=\"text-warning\"><i class=\"fas fa-clock\"></i> ขอผู้บริหารถอยอนุมัติ </span> '
                
                ELSE ''
            END AS request_backward_status ,

            IFNULL(GROUP_CONCAT(
                CASE
                    WHEN tb_request_production_manager.field_approve = 0 
                    THEN  CONCAT('&emsp;<span class=\"text-warning\"><i class=\"fas fa-clock\"></i> รอ',ecm.lastposition , ' ' , ecm.firstname, '(' , ecm.nickname , ') อนุมัติ' , '</span><br>' )

                    WHEN tb_request_production_manager.field_approve = 1 
                    THEN  CONCAT('&emsp;<span class=\"text-success\"><i class=\"fa fa-check-circle\"></i> ',ecm.lastposition , ' ' , ecm.firstname, '(' , ecm.nickname , ') อนุมัติแล้ว' , '</span><br>' )

                    WHEN tb_request_production_manager.field_approve = 2 
                    THEN  CONCAT('&emsp;<span class=\"text-danger\"><i class=\"fa fa-times-circle\"></i> ',ecm.lastposition , ' ' , ecm.firstname, '(' , ecm.nickname , ') ไม่อนุมัติ' , '</span><br>' )
                    ELSE ''
                END 

                ORDER BY
                    employee_position.`level` ASC
            ), '') AS manager_status

            ");
        $this->db->from('tb_request_production');
        $this->db->join('employee ec','ec.id = tb_request_production.field_rp_creator');
        $this->db->join('depart dc','dc.id = ec.depart_id');
        $this->db->join('tb_request_production_topic rp_topic','rp_topic.field_id = tb_request_production.field_rp_topic');
        $this->db->join('tb_request_production_manager ','tb_request_production_manager.field_rp_id = tb_request_production.field_id');
        $this->db->join('employee ecm','ecm.id = tb_request_production_manager.field_employee_id');
        $this->db->join('employee_position','employee_position.name_th = ecm.lastposition');

            // if (isset($CheckPrivilegeFunction['Request_production']["Request_production/View_request_production_depart"])) {
            //     $this->db->where('part_id',$data_permission[0]['part_id']);
            // }

            if($search_text != ''){
                // $this->db->group_start();
                // $this->db->or_like('tb_request_production.field_docno',$search_text, 'both');
                // $this->db->or_like('tb_request_production.field_rp_name',$search_text, 'both');
                // $this->db->group_end();
                $this->db->group_start();
				for($i=0;$i<$count_search_text;$i++){
					$this->db->like('tb_request_production.field_docno',$search_text[$i], 'both');
				}
			
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('tb_request_production.field_rp_name',$search_text[$i], 'both');
				}
		
			    $this->db->group_end();
            }

            if($search_depart != ''){
                $this->db->where('tb_request_production.field_rp_depart',$search_depart);
            }   
            
            if($search_status != ''){
                if ($search_status == 10) {
                    $this->db->where('tb_request_production.field_request_backward_status','1');
                }else{
                    $this->db->where('tb_request_production.field_rp_status',$search_status);
                }
            } 
            
            if($search_doc_type != ''){
                $this->db->where('tb_request_production.field_doc_type',$search_doc_type);
            } 

        $this->db->where('tb_request_production.field_rp_trash',0);
        $this->db->limit($usersPerPage,$pageNumber);
        $this->db->group_by('
            tb_request_production.field_id,
            tb_request_production.field_rp_status,
            tb_request_production.field_docno,
            tb_request_production.field_rp_name,
            tb_request_production.field_rp_status,
            rp_topic.field_id ,
            rp_topic.field_topic ,
            rp_topic.field_depart_id 
        ');    

        $array_of_ordered_ids = array(0,8,1,2,3,4,5,6,7);
        $order = sprintf('FIELD(tb_request_production.field_rp_status, %s)', implode(', ', $array_of_ordered_ids));
        $this->db->order_by($order); 
        $this->db->order_by('tb_request_production.field_id ','DESC');
        $data_rp_data = $this->db->get()->result_array();
        
        $data['rp_data'] = [];
        $manager_confirm = [];
        $request_production_ceo = '';
        foreach ($data_rp_data as $key => $value) {

            $this->db->select('field_rp_id,firstname,nickname,field_employee_id,lastposition,field_approve,field_approve_date');
            $this->db->from('tb_request_production_manager');
            $this->db->join('employee','employee.id = tb_request_production_manager.field_employee_id');
            $this->db->where('field_rp_id',$value['field_id']);
            $data['manager_confirm'][$key]= $this->db->get()->result_array();

            $this->db->select("
                CASE
                    WHEN DATE_ADD(tb_request_production_ceo.field_date, INTERVAL 3 DAY) < CURDATE() AND tb_request_production.field_rp_status IN (1,2)  THEN  'duedate'
                    ELSE ''
                END AS data_duedate_3_day ,
            ");
            $this->db->from('tb_request_production_ceo');
            $this->db->join('tb_request_production ','tb_request_production_ceo.field_rp_id = tb_request_production.field_id AND tb_request_production_ceo.field_status = 1');
            $this->db->where('tb_request_production_ceo.field_rp_id',$value['field_id']);
            $ceo_duedate = $this->db->get()->result_array();

            if(count($ceo_duedate) > 0){
                $value_ceo_duedate = ['data_duedate_3_day' => $ceo_duedate[0]['data_duedate_3_day']];
            }else{
                $value_ceo_duedate = ['data_duedate_3_day' => '' ];
            }

            $request_production_ceo = $value + $value_ceo_duedate;

            array_push($data['rp_data'],$request_production_ceo);

        }


        
        // COUNT
        $this->db->select('count(tb_request_production.field_id) as count');
        $this->db->from('tb_request_production');
        $this->db->join('tb_request_production_topic rp_topic','rp_topic.field_id = tb_request_production.field_rp_topic'); 

        // if (isset($CheckPrivilegeFunction['Request_production']["Request_production/View_request_production_depart"])) {
        //     // $this->db->where('ee.depart_id',$data_permission[0]['depart_id']);
        //     $this->db->where('part_id',$data_permission[0]['part_id']);
        // }

        if($search_text != ''){
            // $this->db->group_start();
            // $this->db->or_like('tb_request_production.field_docno',$search_text, 'both');
            // $this->db->or_like('tb_request_production.field_rp_name',$search_text, 'both');
            // $this->db->group_end();
            $this->db->group_start();
            for($i=0;$i<$count_search_text;$i++){
                $this->db->like('tb_request_production.field_docno',$search_text[$i], 'both');
            }
        
            for($i=0;$i<$count_search_text;$i++){
                $this->db->or_like('tb_request_production.field_rp_name',$search_text[$i], 'both');
            }
    
            $this->db->group_end();
        }

        if($search_depart != ''){
            $this->db->where('tb_request_production.field_rp_depart',$search_depart);
        }      
        
        if($search_status != ''){
            $this->db->where('tb_request_production.field_rp_status',$search_status);
        }       

        if($search_doc_type != ''){
            $this->db->where('tb_request_production.field_doc_type',$search_doc_type);
        } 
            
        $this->db->where('tb_request_production.field_rp_trash',0);
        $data['totalrp'] = $this->db->get()->result_array()[0]['count'];

        return $data;
    }

    public function permission_model()
    {

        $this->db = $this->load->database('default', TRUE);
            
        $this->db->select('
        *,
        group.name as groupname,
        employee.id AS employeeid');
        $this->db->from('employee');
        $this->db->join('depart','employee.depart_id = depart.id');
        $this->db->join('user','user.employee_id = employee.id');	
        $this->db->join('privilege','user.user_id = privilege.pv_userid');
        $this->db->join('group','privilege.pv_groupid = group.id');	
        $this->db->where('employee_id',$_SESSION['saeree_employee']);
        $data = $this->db->get()->result_array();	
    
        return  $data ;	
    
    }

    public function get_view_rp_model()
    {

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $id = $_data['id'];

        $data['request_production'] = $this->get_data_request_production($id,'');
        
        $data['request_production_worker'] = $this->get_data_request_production_worker($id,'');

        if($data['request_production']['field_fixitem_sub_id'] != 0 and $data['request_production']['field_fixitem_sub_id'] != null  ){

            $this->db->select('
            sk_asset.tb_asset.*,
            type_sub.field_id as sub_field_id,
            type_sub.field_name_th as sub_field_name_th,
            type_sub.field_name_en as sub_field_name_en,
            type_sub.field_detail as sub_field_detail,
            type_main.field_id as main_field_id,
            type_main.field_name_th as main_field_name_th,
            type_main.field_name_en as main_field_name_en,
            type_main.field_detail as main_field_detail
            ');
            $this->db->from('sk_asset.tb_asset');
            $this->db->join('sk_asset.tb_asset_type_sub as type_sub','type_sub.field_id = sk_asset.tb_asset.field_type_sub_no','left');
            $this->db->join('sk_asset.tb_asset_type as type_main','type_main.field_id = type_sub.field_type_no','left');
            $this->db->where('sk_asset.tb_asset.field_id',$data['request_production']['field_fixitem_sub_id']);
            $data['data_field_fixitem_id'] = $this->db->get()->result_array()[0];

        }

        $data['doclist'] = $this->get_data_request_production_item($id,'doclist');

        $data['laborlist'] = $this->get_data_request_production_item($id,'laborlist');

        $data['itemlist'] = $this->get_data_request_production_item($id,'itemlist');
        
        return $data;
        
    }

    public function get_image_model()
    {
        $this->db = $this->load->database('default', TRUE);
        
        $_data = $_REQUEST;

        if(file_exists("assets/images/Request_production/".$_data['id'])){
            $data['scandir'] = scandir("assets/images/Request_production/".$_data['id']);
            
            return $data;
        }
    }

    public function get_employee_controller_model() 
    {
        $this->db = $this->load->database('default', TRUE);
        
        $this->db->select('
            employee.*,
            depart.name as dename'
        );
        $this->db->from('employee');
        $this->db->join('depart','depart.id = employee.depart_id');
        $this->db->where('employee.status',"ทำงาน");
        $this->db->or_where('employee.id',136);
        $data['employee'] = $this->db->get()->result_array();
        
        return $data;
    }

    public function get_employee_depart_model()
    {    
        $_data = $_REQUEST;

        $this->db->select('
        employee.*,
        depart.name as dename');
        $this->db->from('employee');
        $this->db->join('depart','depart.id = employee.depart_id');
        
        if($_data['topic_depart'] == 'CTI'){
            $this->db->where('employee.id',1);
            $this->db->or_where('employee.id',261);
       
        }else if($_data['topic_depart'] == 'SCT'){
            $this->db->where('employee.id',136);
       
        }else{
            $this->db->where('employee.depart_id',$_data['topic_depart']);
            $this->db->where('status',"ทำงาน");
        }
        $data['employee'] = $this->db->get()->result_array();
        
        return $data;
    }

    public function get_rp_history_model()
    {

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $this->db->select("
            tb_request_production_history.*,
            ee.id AS  eeid,
            ee.pepleid AS  eepepleid,
            ee.firstname AS  eefirstname,
            ee.nickname AS  eenickname,
            tb_request_production_ceo.field_ceo_id AS ceo_id ,

            CASE
                WHEN tb_request_production_history.field_editor = 'ceo'  THEN 'ผู้บริหารสั่งแก้ไข'
                ELSE 'แก้ไข'
            END AS history_status ,
            
            CASE
                WHEN tb_request_production_history.field_editor = 'ceo'  THEN CONCAT(  tb_request_production_ceo.field_ceo_id ,  ' (ผู้บริหาร)' )
                ELSE CONCAT( ee.firstname, ' ' , ee.lastname, ' (', ee.nickname , ') ' )
            END AS editor_status ,

        ");

        $this->db->from('tb_request_production_history');
        $this->db->join('employee ee','ee.id = tb_request_production_history.field_editor','left');
        $this->db->join('tb_request_production_ceo','tb_request_production_ceo.field_rp_id = tb_request_production_history.field_rp_id');
        $this->db->where('tb_request_production_history.field_rp_id',$_data['id']);
        $this->db->order_by('tb_request_production_history.field_id', "ASC");
        $this->db->group_by('tb_request_production_history.field_id');  
        $data['request_production_history'] = $this->db->get()->result_array();

        return $data;
	}

    public function get_rp_progress_model()
    {

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;
	
        $this->db->select("
            tb_request_production_update.*,
            eu.id AS  euid,
            eu.pepleid AS  eupepleid,
            eu.firstname AS  eufirstname,
            eu.nickname AS  eunickname,
            CONCAT( eu.firstname, ' ' , eu.lastname, ' (', eu.nickname , ') ' ) AS eufullname
        ");
        $this->db->from('tb_request_production_update');
        $this->db->join('employee eu','eu.id = tb_request_production_update.field_employee_id','left');
        $this->db->where('tb_request_production_update.field_rp_id',$_data['id']);
        $this->db->order_by('tb_request_production_update.field_id', "ASC");
        $this->db->group_by('tb_request_production_update.field_id');  
        $data['request_production_progress'] = $this->db->get()->result_array();
        
        return $data;
    }

    public function edit_request_production_model()
    {

        date_default_timezone_set('Asia/Bangkok');

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        //  request_production
        
            if($_data['field_rp_status'] == 8){

                $this->edit_request_production_history($_data['field_id']);

                $this->db->set('field_rp_status',9);

            }
            $this->db->set('field_doc_type',$_data['field_doc_type']);
            if ($_data['field_fixitem_sub_id'] != 0) {
                $this->db->set('field_fixitem_sub_id',$_data['field_fixitem_sub_id']);
            }
            $this->db->set('field_rp_controller',$_data['field_rp_controller']);
            $this->db->set('field_rp_topic',$_data['field_rp_topic']);
            $this->db->set('field_rp_name',$_data['field_rp_name']);
            $this->db->set('field_rp_worker',$_data['field_rp_worker']);
            $this->db->set('field_rp_require_date',$_data['field_rp_require_date']);
            $this->db->set('field_rp_cause',$_data['field_rp_cause']);
            $this->db->set('field_rp_description',$_data['field_rp_description']);
            $this->db->set('field_rp_cost_estimate',$_data['field_rp_cost_estimate']);
            $this->db->where('field_id',$_data['field_id']);
            $this->db->update('tb_request_production');

            //  END request_production

        // request_porduction_item

            $this->db->where('tb_request_porduction_item.field_rp_id',$_data['field_id']);
            $this->db->delete('tb_request_porduction_item');

            if(isset($_data['data_labor_list'])){

                $this->request_porduction_item_labor_add($_data['field_id'] ,$_data['data_labor_list'] );

            }

        // END request_porduction_item

        // request_porduction_item

            if(isset($_data['data_item_request'])){

                $this->request_porduction_item_request_add($_data['field_id'] ,$_data['data_item_request'] );

            }

        // END request_porduction_item

            // request_porduction_fixitem_history
    
            // if(isset($_data['data_fixhistory'])){

            //     $this->request_porduction_fixitem_history_request_add($_data['field_id'] ,$_data['data_fixhistory'],$_data['field_fixitem_sub_id']);

            // }

        // END request_porduction_fixitem_history

            // request_production_manager

            //แต่ผจก.ต้องมาอนุมัติใหม่ทุกครั้งที่มีการแก้
            $this->db->set('field_approve',0);
            $this->db->where('field_rp_id',$_data['field_id']);
            $this->db->update('tb_request_production_manager');
            
        // END request_production_manager

        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'แก้ไข' ,
                "field_table_name" => 'tb_request_production',
                "field_table_id" => $_data['field_id'],
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------


        return 'success';

    }

    function edit_request_production_history($id)
    {
        $this->db = $this->load->database('default', TRUE);
        
        $field_ip = $_SERVER['REMOTE_ADDR'];
        $field_comname = gethostbyaddr($_SERVER['REMOTE_ADDR']); 
        $field_os = $this->get_os();
        $field_browser = $this->get_browser($_SERVER['HTTP_USER_AGENT']);

        //เก็บประวัติใน table history
        $this->db->select('
            field_id,
            field_rp_topic,
            field_rp_name,
            field_rp_description,
            field_rp_require_date,
            field_rp_worker,
            field_ceo_comment
        ');
        $this->db->from('tb_request_production');
        $this->db->where('field_id',$id);
        $data_request_production = $this->db->get()->result_array()[0];

        $this->db->set('field_rp_id',$data_request_production['field_id']);
        $this->db->set('field_rp_history_name',$data_request_production['field_rp_name']);
        $this->db->set('field_rp_history_description',$data_request_production['field_rp_description']);
        $this->db->set('field_rp_history_worker',$data_request_production['field_rp_worker']);
        $this->db->set('field_rp_history_require_date',$data_request_production['field_rp_require_date']);
        $this->db->set('field_rp_history_topic',$data_request_production['field_rp_topic']);
        $this->db->set('field_rp_history_ceo',$data_request_production['field_ceo_comment']);
        $this->db->set('field_history_status',0);
        $this->db->set('field_editor',$_SESSION['saeree_employee']);
        $this->db->set('field_edit_date',date('Y-m-d H:i:s'));
        $this->db->set('field_ip',$field_ip);
        $this->db->set('field_comname',$field_comname);
        $this->db->set('field_os',$field_os);
        $this->db->set('field_browser',$field_browser);
        $this->db->set('field_action',0);
        $this->db->insert('tb_request_production_history');

    }

    public function editupload_image_model()
    {

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $field_id = $_data['id'];
        
        if(file_exists("./assets/images/Request_production/$field_id")){
        
            $directory = "./assets/images/Request_production/$field_id/";
            $filecount = 0;
            $files = glob($directory . "*");

            if($files){
                $filecount = count($files);
            }
            
            if($filecount < 2){

                // Old Folder   
                foreach($_FILES['file_edit']['name'] as $key=>$val){

                    $filecount++;

                    if($filecount <= 2){
                    
                        $numrand = (mt_rand());
            
                        $file_name = $_FILES['file_edit']['name'][$key];
                        $file_tmp_name = $_FILES['file_edit']['tmp_name'][$key];
                        $file_target = './assets/images/Request_production/'.$field_id.'/';
                        $file_size = $_FILES['file_edit']['size'][$key];
            
                        $images = $file_tmp_name;
                        $temp = explode(".", $_FILES["file_edit"]["name"][$key]);
                        $newfilename = $numrand . '.' . end($temp);
                        
                        $width=1000;
                        $size=GetimageSize($images);
                        $height=round($width*$size[1]/$size[0]);
                        $images_orig = ImageCreateFromJPEG($images);
                        $photoX = ImagesX($images_orig);
                        $photoY = ImagesY($images_orig);
                        $images_fin = ImageCreateTrueColor($width, $height);
                        ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                        ImageJPEG($images_fin, $file_target . $newfilename);
                        ImageDestroy($images_orig);
                        ImageDestroy($images_fin);

                        $data['check_pic'] = 'success';

                    }else{
                        $data['check_pic'] = 'maxvalue_more';
                    }
        
                }
                
            }else{
                $data['check_pic'] = 'maxvalue';
            }
        
        }else{

            // New Folder
            mkdir('./assets/images/Request_production/'.$field_id, 0777, true);
            $filecount = 0;
            
            foreach($_FILES['file_edit']['name'] as $key=>$val){
                $filecount++;
        
                if($filecount <= 2){
        
                    $numrand = (mt_rand());
                    $temp = explode(".", $_FILES["file_edit"]["name"][$key]);
                    $newfilename = $numrand . '.' . end($temp);
        
                    $file_name = $_FILES['file_edit']['name'][$key];
                    $file_tmp_name = $_FILES['file_edit']['tmp_name'][$key];
                    $file_target = './assets/images/Request_production/'.$field_id.'/';
                    $file_size = $_FILES['file_edit']['size'][$key];
        
                    $images = $file_tmp_name;
                    $temp = explode('.', $file_name);
                    $newfilename = $newfilename . '.' . end($temp);
                    $width=1000;
                    $size=GetimageSize($images);
                    $height=round($width*$size[1]/$size[0]);
                    $images_orig = ImageCreateFromJPEG($images);
                    $photoX = ImagesX($images_orig);
                    $photoY = ImagesY($images_orig);
                    $images_fin = ImageCreateTrueColor($width, $height);
                    ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                    ImageJPEG($images_fin, $file_target . $newfilename);
                    ImageDestroy($images_orig);
                    ImageDestroy($images_fin);
        
                    $data['check_pic'] = 'success';
        
                }else{
                    $data['check_pic'] = 'maxvalue_more';
                }
        
            }
        
        }

        //-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"field_activity" => 'อัพโหลดไฟล์' ,
                "field_table_name" => 'tb_request_production',
				"field_table_id" => $field_id,
				"field_creator_id" => $_SESSION['saeree_employee'],
				"field_creator_date" => date('Y-m-d H:i:s')
			);
			$this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------
        
        return $data;
        
    }

    public function get_editimg_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $field_id = $_data['field_id'];
        
        if(file_exists("assets/images/Request_production/".$field_id)){
            $data['scandir'] = scandir("assets/images/Request_production/".$field_id);

            return $data;
        }
    }

    public function delete_file_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;
        $field_id = $_data['field_id'];
        $field_name = $_data['field_name'];

        if(file_exists("assets/images/Request_production/". $field_id ."/". $field_name)){

            $dir = "./assets/images/Request_production/". $field_id ."/". $field_name ;
            unlink($dir);
            
        }else{
        }

        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'ลบไฟล์' ,
                "field_table_name" => 'tb_request_production',
                "field_table_id" =>   $field_id,
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------
      
        return $data;
        
    }
    
    public function upload_image_model()
    {

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $field_id = $_data['id'];

        if(file_exists("./assets/images/Request_production/$field_id")){

            $directory = "./assets/images/Request_production/$field_id/";
            $filecount = 0;
            $files = glob($directory . "*");

            if($files){
                $filecount = count($files);
            }

            // if($filecount < 2 ){
                if($filecount >= 2 && $filecount < 5){

                //Old Folder
                foreach($_FILES['file']['name'] as $key=>$val){

                    $filecount++;

                    // if($filecount <= 2){
                    if($filecount > 2 && $filecount < 5){
                    
                    
                        $numrand = (mt_rand());

                        $file_name = $_FILES['file']['name'][$key];
                        $file_tmp_name = $_FILES['file']['tmp_name'][$key];
                        $file_target = './assets/images/Request_production/'.$field_id.'/';
                        $file_size = $_FILES['file']['size'][$key];

                        $images = $file_tmp_name;
                        $temp = explode(".", $_FILES["file"]["name"][$key]);
                        $newfilename = $numrand . '.' . end($temp);
                        
                        $width=1000;
                        $size=GetimageSize($images);
                        $height=round($width*$size[1]/$size[0]);
                        $images_orig = ImageCreateFromJPEG($images);
                        $photoX = ImagesX($images_orig);
                        $photoY = ImagesY($images_orig);
                        $images_fin = ImageCreateTrueColor($width, $height);
                        ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                        ImageJPEG($images_fin, $file_target . $newfilename);
                        ImageDestroy($images_orig);
                        ImageDestroy($images_fin);

                        $data['check_pic'] = 'success';
                        $field_docno = '';  
                        $this->db->select('field_docno');
                        $this->db->from('tb_request_production');
                        $this->db->where('tb_request_production.field_id',$field_id);
                        $field_docno = $this->db->get()->result_array();
                        $this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('sctPeeps','เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม','".$_SESSION['saeree_name']." เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม เลขที่ ".$field_docno[0]['field_docno']." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
                        
                    }else{

                        $data['check_pic'] = 'maxvalue_more';
                        

                    }

                }
            
            }else{
                $data['check_pic'] = 'maxvalue';
            }

        }else{

            // New Folder
            mkdir('./assets/images/Request_production/'.$field_id, 0777, true);
            $filecount = 0;

            foreach($_FILES['file']['name'] as $key=>$val){
                
                $filecount++;

                if($filecount <= 2){

                    $numrand = (mt_rand());
                    $temp = explode(".", $_FILES["file"]["name"][$key]);
                    $newfilename = $numrand . '.' . end($temp);

                    $file_name = $_FILES['file']['name'][$key];
                    $file_tmp_name = $_FILES['file']['tmp_name'][$key];
                    $file_target = './assets/images/Request_production/'.$field_id.'/';
                    $file_size = $_FILES['file']['size'][$key];

                    $images = $file_tmp_name;
                    $temp = explode('.', $file_name);
                    $newfilename = $newfilename . '.' . end($temp);
                    $width=1000;
                    $size=GetimageSize($images);
                    $height=round($width*$size[1]/$size[0]);
                    $images_orig = ImageCreateFromJPEG($images);
                    $photoX = ImagesX($images_orig);
                    $photoY = ImagesY($images_orig);
                    $images_fin = ImageCreateTrueColor($width, $height);
                    ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                    ImageJPEG($images_fin, $file_target . $newfilename);
                    ImageDestroy($images_orig);
                    ImageDestroy($images_fin);
            
                    $data['check_pic'] = 'success';
                    $field_docno = '';  
                    $this->db->select('field_docno');
                    $this->db->from('tb_request_production');
                    $this->db->where('tb_request_production.field_id',$field_id);
                    $field_docno = $this->db->get()->result_array();
                    $this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('sctPeeps','เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม','".$_SESSION['saeree_name']." เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม เลขที่ ".$field_docno[0]['field_docno']." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
                    

                }else{
                    $data['check_pic'] = 'maxvalue_more';
                }
            }

        }

        //-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"field_activity" => 'อัพโหลดไฟล์' ,
                "field_table_name" => 'tb_request_production',
				"field_table_id" => $field_id,
				"field_creator_id" => $_SESSION['saeree_employee'],
				"field_creator_date" => date('Y-m-d H:i:s')
			);
			$this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

    
        return $data;

    }

    public function pre_confirm_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        // type 0 = เจ้าของ 
        // type 1 = ตัวแทน 

        if($_data['type'] == 1){
            $this->db->set('field_employee_id',$_SESSION['saeree_employee']);
        }
        $this->db->set('field_approve_date',date('Y-m-d H:i:s'));
		$this->db->set('field_approve',$_data['pre_confirm']);
		$this->db->where('field_id',$_data['manager_id']);
		$this->db->update('tb_request_production_manager');

        
        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'อนุมัติ สถานะ' . $_data['pre_confirm'] ,
                "field_table_name" => 'tb_request_production_manager',
                "field_table_id" => $_data['manager_id'],
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------

		
        return 'success';
    }

    public function rp_confirm_model()
    {
        date_default_timezone_set('Asia/Bangkok');

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $field_ip = $_SERVER['REMOTE_ADDR'];
		$field_comname = gethostbyaddr($_SERVER['REMOTE_ADDR']); 
		$field_os = $this->get_os();
		$field_browser = $this->get_browser($_SERVER['HTTP_USER_AGENT']);

        $this->db->set('field_request_backward_status','0');
        $this->db->set('field_ceo_comment',$_data['comment']);
		$this->db->set('field_rp_status',$_data['ceo_confirm']);
		$this->db->where('field_id',$_data['id']);
        $this->db->update('tb_request_production');

        $this->db->set('field_rp_id',$_data['id']);
        $this->db->set('field_date',date('Y-m-d H:i:s'));
        $this->db->set('field_ip',$field_ip);
        $this->db->set('field_comname',$field_comname);
        $this->db->set('field_os',$field_os);
        $this->db->set('field_browser',$field_browser);
        $this->db->set('field_ceo_id',$_SESSION['saeree_name'] );
        $this->db->set('field_status',$_data['ceo_confirm']);
        $this->db->insert('tb_request_production_ceo');

        if($_data['ceo_confirm'] == 8 ){

            $this->db->select('
                field_id,
                field_rp_topic,
                field_rp_name,
                field_rp_description,
                field_rp_require_date,
                field_rp_worker,
                field_ceo_comment
            ');
            $this->db->from('tb_request_production');
            $this->db->where('field_id',$_data['id']);
            $rp_old = $this->db->get()->result_array()[0];
    
            //RP DATA
            $this->db->set('field_rp_id',$rp_old['field_id']);
            $this->db->set('field_rp_history_name',$rp_old['field_rp_name']);
            $this->db->set('field_rp_history_description',$rp_old['field_rp_description']);
            $this->db->set('field_rp_history_require_date',$rp_old['field_rp_require_date']);
            $this->db->set('field_rp_history_worker',$rp_old['field_rp_worker']);
            $this->db->set('field_rp_history_topic',$rp_old['field_rp_topic']);
            $this->db->set('field_rp_history_ceo',$rp_old['field_ceo_comment']);
            $this->db->set('field_history_status',0);
    
            //EDITOR DATA
            $this->db->set('field_editor',"ceo");
            $this->db->set('field_edit_date',date('Y-m-d H:i:s'));
            $this->db->set('field_ip',$field_ip);
            $this->db->set('field_comname',$field_comname);
            $this->db->set('field_os',$field_os);
            $this->db->set('field_browser',$field_browser);
            $this->db->set('field_action',8);
            $this->db->insert('tb_request_production_history');
        }

         //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'อนุมัติ สถานะ' . $_data['ceo_confirm'] ,
                "field_table_name" => 'tb_request_production',
                "field_table_id" => $_data['id'],
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------
       
        return 'success';

	}

    public function receive_rp_model()
    {

        date_default_timezone_set('Asia/Bangkok'); 
        
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $this->db->set('field_rp_recipient',$_SESSION['saeree_employee']);
        $this->db->set('field_rp_recive_date',date('Y-m-d H:i:s'));
        $this->db->set('field_rp_status',2);
        $this->db->where('field_id',$_data['id']);
        $this->db->update('tb_request_production');

        if(isset($_data['list_employee'])){

            $this->db->where('tb_request_production_worker.field_rp_id',$_data['id']);
            $this->db->delete('tb_request_production_worker');

            foreach($_data['list_employee'] as $value){

                if($value['employee_id'] == '' ){

                }else{
                    $id = $_data['id'];
                    $this->db->set('field_rp_id',$id);
                    $this->db->set('field_employee_id',$value['employee_id']);
                    $this->db->insert('tb_request_production_worker');
                }
            }
        }

        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'ระบุพนักงานรับทำงาน สถานะ 2' ,
                "field_table_name" => 'tb_request_production',
                "field_table_id" => $_data['id'],
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------
       
        return 'success';
    }
    
    public function accept_rp_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

		$this->db->select('*');
		$this->db->from('tb_request_production');
		$this->db->where('tb_request_production.field_id',$_data['id']);
		$data['data_accept'] = $this->db->get()->result_array()[0];

        $data['data_accept_status'] = $this->get_data_request_production_worker($_data['id'],'');

        return $data;

    }
    
    public function accept_employee_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

		$this->db->set('field_status',$_data['accept_type']);
		$this->db->where('field_id',$_data['accept_id']);
        $this->db->update('tb_request_production_worker');

        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'สรุปผลการทำงานพนักงาน สถานะ ' . $_data['accept_type'] ,
                "field_table_name" => 'tb_request_production_worker',
                "field_table_id" => $_data['accept_id'],
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------
        
        return 'success';
    }

    public function update_cost_final_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $this->db->set('field_rp_cost_final',$_data['rp_cost_final']);
        $this->db->set('field_rp_cost_final_comment',$_data['rp_cost_final_comment']);
        $this->db->set('field_rp_status',4);
        $this->db->set('field_rp_success',$_SESSION['saeree_employee']);
        $this->db->set('field_rp_success_date',date('Y-m-d H:i:s'));
        $this->db->where('field_id',$_data['rp_id']);
        $this->db->update('tb_request_production');

        $this->db->select('field_doc_type,field_fixitem_sub_id');
        $this->db->from('tb_request_production');
        $this->db->where('field_id',$_data['rp_id']);
        $check_doctype = $this->db->get()->result_array()[0];

        if ($check_doctype['field_doc_type'] == 2) {
            
            $this->db->set('sk_asset.tb_asset.field_qty_fix',0);
            $this->db->where('sk_asset.tb_asset.field_id',$check_doctype['field_fixitem_sub_id']);
            $this->db->update('sk_asset.tb_asset');
        }


        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'ตรวจรับงาน สถานะ 4 ค่าใช้จ่ายจริง ' . $_data['rp_cost_final'] ,
                "field_table_name" => 'tb_request_production',
                "field_table_id" => $_data['rp_id'],
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------
     
           
		return 'success';
    }

    
    public function update_requestbackward_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $this->db->set('field_request_backward_status',1);
        $this->db->set('field_request_backward_comment',$_data['comment']);
        $this->db->set('field_request_backward_person',$_SESSION['saeree_employee']);
        $this->db->set('field_request_backward_date',date('Y-m-d H:i:s'));
        $this->db->where('field_id',$_data['field_id']);
        $this->db->update('tb_request_production');

        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'ขอถอยใบสั่งผลิต-สั่งซ่อม ' . $_data['comment'] ,
                "field_table_name" => 'tb_request_production',
                "field_table_id" => $_data['field_id'],
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------
     
           
		return 'success';
    }

// topic       
    public function check_topic_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $this->db->select('*');
        $this->db->from('tb_request_production_topic');
        $this->db->where('field_topic',$_data['topic_name']  );
        $this->db->where('field_trash',0 );
        $check_topic = $this->db->get()->result_array();

        if(count($check_topic) >= 1){
            $data['check_topic'] = 'have';
        }else{
            $data['check_topic'] = 'no_have';
        }
        
        return $data;
    }

    public function add_topic_model()
    {

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;
        
        $this->db->set('field_topic',$_data['field_topic']);
        $this->db->set('field_topic_description',$_data['field_topic_description']);
        $this->db->set('field_trash',0);
        $this->db->insert('tb_request_production_topic');

        $request_production_topic_no = $this->db->insert_id();

         //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'เพิ่ม' ,
                "field_table_name" => 'tb_request_production_topic',
                "field_table_id" => $request_production_topic_no,
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------
        
        return 'success';
    }
    
    public function get_main_topic_model()
    {

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $usersPerPage = $_data['usersPerPage'];
        $pageNumber = $_data['pageNumber'] * $usersPerPage;		
        
        $search_text = '';
        $search_text = $_data['search_text'];

        $this->db->select('*');
        $this->db->from('tb_request_production_topic');
            if($search_text != ''){
                $this->db->group_start();
                $this->db->or_like('field_topic',$search_text, 'both');
                $this->db->or_like('field_topic_description',$search_text, 'both');
                $this->db->group_end();
            }
        $this->db->where('field_trash',0);
        $this->db->limit($usersPerPage,$pageNumber);
        $data['topic_data'] = $this->db->get()->result_array();
        
        $this->db->select('count(*) as count');
        $this->db->from('tb_request_production_topic');

            if($search_text != ''){
                $this->db->group_start();
                $this->db->or_like('field_topic',$search_text, 'both');
                $this->db->or_like('field_topic_description',$search_text, 'both');
                $this->db->group_end();
            }

        $this->db->set('field_trash',0);
        $data['totaltopic'] = $this->db->get()->result_array()[0]['count'];
        
        return $data;
    }

    public function get_topic_byid_model ()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $id = $_data['id'];

        $this->db->select('*');
        $this->db->from('tb_request_production_topic');
        $this->db->where('tb_request_production_topic.field_id',$id);
        $data = $this->db->get()->result_array()[0];

        return $data;
    }	
    
    public function edit_topic_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $this->db->set('field_topic',$_data['field_topic']);
        $this->db->set('field_topic_description',$_data['field_topic_description']);
        $this->db->where('field_id',$_data['field_id']);
        $this->db->update('tb_request_production_topic');

        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'แก้ไข' ,
                "field_table_name" => 'tb_request_production_topic',
                "field_table_id" => $_data['field_id'],
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------

        return 'success';
    }
    
    public function delete_topic_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;
        
        $this->db->set('field_trash',1);
        $this->db->where('field_id', $_data['id']);
        $this->db->update('tb_request_production_topic');

        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'ลบ' ,
                "field_table_name" => 'tb_request_production_topic',
                "field_table_id" => $_data['id'],
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------

        return 'success';
    }
// END topic  

// fixitem

    // public function check_fixitem_model()
    // {
    //     $this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;

    //     $this->db->select('*');

    //     if($_data['type'] == 'fixitem'){
    //         $this->db->from('tb_request_production_fixitem');
    //         $this->db->where('field_code',$_data['field_code']);
    //     }else if($_data['type'] == 'fixitem_sub'){
    //         $this->db->from('tb_request_production_fixitem_sub');
    //         $this->db->where('field_fixitem_no',$_data['id']);
    //         $this->db->group_start();
    //             // $this->db->where('field_code',$_data['field_code']);
    //             $this->db->or_where('field_name',$_data['field_name']);
    //         $this->db->group_end();
    //     }
    //     $this->db->where('field_trash',0 );
    //     $check_fixitem = $this->db->get()->result_array();

    //     if(count($check_fixitem) >= 1){
    //         $data['check_fixitem'] = 'have';
    //     }else{
    //         $data['check_fixitem'] = 'no_have';
    //     }
        
    //     return $data;
    // }

    // public function get_main_fixitem_model()
    // {
       
    //     $this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;

    //     $usersPerPage = $_data['usersPerPage'];
    //     $pageNumber = $_data['pageNumber'] * $usersPerPage;		
        
    //     $search_text = '';
    //     $search_text = $_data['search_text'];

    //     $this->db->select('
    //         tb_request_production_fixitem.field_id,
    //         tb_request_production_fixitem.field_code,
    //         tb_request_production_fixitem.field_name,
    //         tb_request_production_fixitem.field_detail,
    //         COUNT(tb_request_production_fixitem_sub.field_id) AS count_fixitem_sub
    //     ');
    //     $this->db->from('tb_request_production_fixitem');
    //     $this->db->join('tb_request_production_fixitem_sub','tb_request_production_fixitem_sub.field_fixitem_no = tb_request_production_fixitem.field_id','left');
    //         if($search_text != ''){
    //             $this->db->group_start();
    //             $this->db->like('tb_request_production_fixitem.field_code',$search_text, 'both');
    //             $this->db->or_like('tb_request_production_fixitem.field_name',$search_text, 'both');
    //             $this->db->or_like('tb_request_production_fixitem.field_detail',$search_text, 'both');
    //             $this->db->group_end();
    //         }
    //     $this->db->where('tb_request_production_fixitem.field_trash',0);
    //     $this->db->limit($usersPerPage,$pageNumber);
    //     $this->db->group_by('
    //         tb_request_production_fixitem.field_id,
    //         tb_request_production_fixitem.field_code,
    //         tb_request_production_fixitem.field_name,
    //         tb_request_production_fixitem.field_detail
    //     '); 
    //     $data['data_fixitem'] = $this->db->get()->result_array();
        
    //     $this->db->select('count(*) as count');
    //     $this->db->from('tb_request_production_fixitem');

    //         if($search_text != ''){
    //             $this->db->group_start();
    //             $this->db->like('tb_request_production_fixitem.field_code',$search_text, 'both');
    //             $this->db->or_like('tb_request_production_fixitem.field_name',$search_text, 'both');
    //             $this->db->or_like('tb_request_production_fixitem.field_detail',$search_text, 'both');
    //             $this->db->group_end();
    //         }

    //     $this->db->set('tb_request_production_fixitem.field_trash',0);
    //     $data['totalfixitem'] = $this->db->get()->result_array()[0]['count'];

    //     return $data;

    // }	

    // public function get_fixitem_byid_model()
    // {
    //     $this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;

    //     $id = $_data['id'];

    //     $this->db->select('*');
    //     $this->db->from('tb_request_production_fixitem');
    //     $this->db->where('tb_request_production_fixitem.field_id',$id);
    //     $data = $this->db->get()->result_array()[0];

    //     return $data;
    // }	

    public function get_fixitem_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $this->db->select('*');
        $this->db->from('sk_asset.tb_asset_type');
        $this->db->where('field_trash',1);
        $data['fixitem'] = $this->db->get()->result_array();

        return $data;

    }	

    public function get_fixhistory_model()
    {
        $this->db = $this->load->database('default', TRUE);
        $this->db->select('*');
        $this->db->from('tb_request_production');
        $this->db->where('field_doc_type',2);
        $this->db->where('field_rp_trash',0);
        $this->db->where('field_fixitem_sub_id',$_POST['field_fixitem_sub_id']);
        $this->db->where('field_rp_status',4);
        $data['fix_history'] = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('tb_request_production_fixitem_history');
        $this->db->where('field_fixitem_sub_id',$_POST['field_fixitem_sub_id']);
        $data['fix_history_return'] = $this->db->get()->result_array();

        return $data;
    }

    // public function get_fixhistory_model()
    // {
    //     $this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;

    //     $this->db->select("
    //         tb_request_production.field_id,
    //         tb_request_production.field_docno,
    //         tb_request_production.field_rp_status,
    //         tb_request_production.field_rp_name ,
    //         tb_request_production.field_use_status ,
    //         tb_request_production.field_use_deatil ,
    //         tb_request_production.field_use_reuse_no ,
    //         CASE
    //             WHEN tb_request_production.field_use_status = 0  THEN '<span class=\"text-danger\">สินค้าเลิกใช้งาน</span>'
    //             WHEN tb_request_production.field_use_status = 1  THEN '<span class=\"text-success\">สินค้าใช้งาน</span>'
    //             ELSE ''
    //         END AS use_status ,

    //         CASE
    //             WHEN tb_request_production.field_use_deatil IS NOT NULL 
    //             THEN  CONCAT('<br>', '<span class=\"text-danger\">' , 'รายละเอียด : ' , tb_request_production.field_use_deatil , '</span>' )
    //         ELSE ''
    //         END AS use_deatil ,

    //         CASE
    //             WHEN tb_request_production.field_use_reuse_no IS NOT NULL 
    //             THEN  CONCAT( '<br>', '<span class=\"text-danger\">'  , 'อ้างอิง : '  , tb_request_production.field_use_reuse_no , '</span>' )
    //         ELSE ''
    //         END AS use_reuse_no ,

    //     ");
    //     $this->db->from('tb_request_production');
    //     $this->db->where('tb_request_production.field_fixitem_sub_id',$_data['field_fixitem_sub_id']);
    //     $this->db->where('tb_request_production.field_doc_type',2);
    //     $this->db->order_by('tb_request_production.field_docno','ASC');	 
    //     $data['fix_history'] = $this->db->get()->result_array();

    //     return $data;
    // }	

    // public function add_fixitem_model()
    // {
    //     $this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;

    //     $this->db->set('field_code',$_data['field_code']);
    //     $this->db->set('field_name',$_data['field_name']);
    //     $this->db->set('field_detail',$_data['field_detail']);
    //     $this->db->set('field_trash',0);
    //     $this->db->insert('tb_request_production_fixitem');

    //     $request_production_fixitem_no = $this->db->insert_id();

    //     //-------------------------------------Activity_log-------------------------------------------------
    //         $data_activity_log = array();
    //         $data_activity_log = array(
    //             "field_activity" => 'เพิ่ม' ,
    //             "field_table_name" => 'tb_request_production_fixitem',
    //             "field_table_id" =>  $request_production_fixitem_no,
    //             "field_creator_id" => $_SESSION['saeree_employee'],
    //             "field_creator_date" => date('Y-m-d H:i:s')
    //         );
    //         $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
    //     //-------------------------------------END-Activity_log--------------------------------------------

    //     return 'success';
    // }

    // public function edit_fixitem_model()
    // {
    //     $this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;

    //     $this->db->set('field_code',$_data['field_code']);
    //     $this->db->set('field_name',$_data['field_name']);
    //     $this->db->set('field_detail',$_data['field_detail']);
    //     $this->db->where('field_id',$_data['field_id']);
    //     $this->db->update('tb_request_production_fixitem');

    //     //-------------------------------------Activity_log-------------------------------------------------
    //         $data_activity_log = array();
    //         $data_activity_log = array(
    //             "field_activity" => 'แก้ไข' ,
    //             "field_table_name" => 'tb_request_production_fixitem',
    //             "field_table_id" => $_data['field_id'],
    //             "field_creator_id" => $_SESSION['saeree_employee'],
    //             "field_creator_date" => date('Y-m-d H:i:s')
    //         );
    //         $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
    //     //-------------------------------------END-Activity_log--------------------------------------------

    //     return 'success';
    // }

    // public function delete_fixitem_model()
    // {
    //     $this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;
        
    //     $this->db->set('field_trash',1);
    //     $this->db->where('field_id', $_data['id']);
    //     $this->db->update('tb_request_production_fixitem');

    //     //-------------------------------------Activity_log-------------------------------------------------
    //         $data_activity_log = array();
    //         $data_activity_log = array(
    //             "field_activity" => 'ลบ' ,
    //             "field_table_name" => 'tb_request_production_fixitem',
    //             "field_table_id" => $_data['id'],
    //             "field_creator_id" => $_SESSION['saeree_employee'],
    //             "field_creator_date" => date('Y-m-d H:i:s')
    //         );
    //         $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
    //     //-------------------------------------END-Activity_log--------------------------------------------

    //     return 'success';
    // }

    public function get_fixitem_sub_byid_model()
	{   
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        // $this->db->select('
        //     tb_request_production_fixitem_sub.field_id,
        //     tb_request_production_fixitem_sub.field_code,
        //     tb_request_production_fixitem_sub.field_name,
        //     tb_request_production_fixitem_sub.field_detail,
        //     tb_request_production_fixitem_sub.field_fixitem_no,
        //     COUNT(tb_request_production.field_id) AS count_request_production
        // ');
        // $this->db->from('tb_request_production_fixitem_sub');
        // $this->db->join('tb_request_production','tb_request_production.field_fixitem_sub_id = tb_request_production_fixitem_sub.field_id','left');
        // $this->db->where('tb_request_production_fixitem_sub.field_fixitem_no',$_data['field_fixitem_no']);
        // $this->db->where('tb_request_production_fixitem_sub.field_trash',0);
        // $this->db->group_by('
        //     tb_request_production_fixitem_sub.field_id,
        //     tb_request_production_fixitem_sub.field_code,
        //     tb_request_production_fixitem_sub.field_name,
        //     tb_request_production_fixitem_sub.field_fixitem_no,
        //     tb_request_production_fixitem_sub.field_detail
        // '); 


        $this->db->select('*');
        $this->db->from('sk_asset.tb_asset_type_sub');
        $this->db->where('field_type_no',$_data['field_fixitem_no']);
        $data['data_fixitem_sub'] = $this->db->get()->result_array();

        return $data;

	}

    public function get_fixitem_item_byid_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $this->db->select('*');
        $this->db->from('sk_asset.tb_asset');
        $this->db->where('field_type_sub_no',$_data['field_fixitem_sub_no']);
        $data['data_fixitem_sub'] = $this->db->get()->result_array();

        return $data;
    }

    public function check_fixitem_item_byid_model()
    {
        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $this->db->select('*');
        $this->db->from('sk_asset.tb_asset');
        $this->db->where('field_id',$_data['field_fixitem_item_no']);
        $data['data_fixitem_sub'] = $this->db->get()->result_array()[0];

        return $data;
    }


    // public function get_fixitem_sub_byid2_model()
	// {   
		
    //     $this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;

    //     $this->db->select('
    //         tb_request_production_fixitem_sub.*
    //     ');
    //     $this->db->from('tb_request_production_fixitem_sub');
    //     $this->db->where('tb_request_production_fixitem_sub.field_id',$_data['field_id']);
    //     $data = $this->db->get()->result_array()[0];

    //     return $data;

	// }

    // public function add_fixitem_sub_model()
    // {
    //     $this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;

    //     $this->db->set('field_code',$_data['field_code']);
    //     $this->db->set('field_name',$_data['field_name']);
    //     $this->db->set('field_detail',$_data['field_detail']);
    //     $this->db->set('field_fixitem_no',$_data['field_fixitem_no']);
    //     $this->db->set('field_trash',0);
    //     $this->db->insert('tb_request_production_fixitem_sub');

    //     $request_production_fixitem_sub_no = $this->db->insert_id();

    //     //-------------------------------------Activity_log-------------------------------------------------
    //         $data_activity_log = array();
    //         $data_activity_log = array(
    //             "field_activity" => 'เพิ่ม' ,
    //             "field_table_name" => 'tb_request_production_fixitem_sub',
    //             "field_table_id" =>  $request_production_fixitem_sub_no,
    //             "field_creator_id" => $_SESSION['saeree_employee'],
    //             "field_creator_date" => date('Y-m-d H:i:s')
    //         );
    //         $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
    //     //-------------------------------------END-Activity_log--------------------------------------------

    //     return 'success';
    // }

    // public function edit_fixitem_sub_model()
	// {   
	// 	$this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;

    //     $this->db->set('field_code',$_data['field_code']);
    //     $this->db->set('field_name',$_data['field_name']);
    //     $this->db->set('field_detail',$_data['field_detail']);
    //     $this->db->where('field_id',$_data['field_id']);
    //     $this->db->update('tb_request_production_fixitem_sub');

    //     //-------------------------------------Activity_log-------------------------------------------------
    //         $data_activity_log = array();
    //         $data_activity_log = array(
    //             "field_activity" => 'แก้ไข' ,
    //             "field_table_name" => 'tb_request_production_fixitem_sub',
    //             "field_table_id" => $_data['field_id'],
    //             "field_creator_id" => $_SESSION['saeree_employee'],
    //             "field_creator_date" => date('Y-m-d H:i:s')
    //         );
    //         $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
    //     //-------------------------------------END-Activity_log--------------------------------------------

    //     return 'success';
	// }

    // public function delete_fixitem_sub_model()
    // {
    //     $this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;
        
    //     $this->db->set('field_trash',1);
    //     $this->db->where('field_id', $_data['id']);
    //     $this->db->update('tb_request_production_fixitem_sub');

    //     //-------------------------------------Activity_log-------------------------------------------------
    //         $data_activity_log = array();
    //         $data_activity_log = array(
    //             "field_activity" => 'ลบ' ,
    //             "field_table_name" => 'tb_request_production_fixitem_sub',
    //             "field_table_id" => $_data['id'],
    //             "field_creator_id" => $_SESSION['saeree_employee'],
    //             "field_creator_date" => date('Y-m-d H:i:s')
    //         );
    //         $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
    //     //-------------------------------------END-Activity_log--------------------------------------------

    //     return 'success';
    // }

    // public function add_history_fixitem_model()
	// {   
	// 	$this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;
        
    //     $this->db->set('field_fixitem_sub_id',$_data['field_fixitem_sub_id']);
    //     $this->db->set('field_doc_type',2);
    //     $this->db->where('field_id', $_data['field_id']);
    //     $this->db->update('tb_request_production');

    //     //-------------------------------------Activity_log-------------------------------------------------
    //         $data_activity_log = array();
    //         $data_activity_log = array(
    //             "field_activity" => 'เพิ่มใบสั่งซ่อมในหัวข้อการซ่อมย่อย' ,
    //             "field_table_name" => 'tb_request_production',
    //             "field_table_id" => $_data['field_id'],
    //             "field_creator_id" => $_SESSION['saeree_employee'],
    //             "field_creator_date" => date('Y-m-d H:i:s')
    //         );
    //         $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
    //     //-------------------------------------END-Activity_log--------------------------------------------

    //     return 'success';
	// }

// END fixitem

    public function get_stkissue_bydocno_model()
    {
        
        $_data = $_REQUEST;

        $this->db = $this->load->database($_data['database'], TRUE);

        $this->db->select('
            ic_trans_detail.doc_no as Docno,
            ic_trans_detail.item_code as ItemCode,
            ic_trans_detail.item_name as ItemName,
            ic_trans_detail.qty as Qty,
            ic_trans_detail.unit_code as UnitCode,
            (
                SELECT
                    average_cost
                FROM
                    ic_inventory
                WHERE
                    ic_inventory.code = ic_trans_detail.item_code
            ) AS Price,
            ic_trans_detail.remark AS StkIssueSub2MyDescription,
            ic_trans.remark AS StkIssueMyDescription
        ');
        $this->db->from('ic_trans_detail');
        $this->db->join('ic_trans','ic_trans.doc_no = ic_trans_detail.doc_no');
        $this->db->where('ic_trans_detail.doc_no',$_data['docno']);
        $this->db->order_by('ic_trans_detail.roworder','ASC');
        $data['ISSUE_ITEM'] = $this->db->get()->result_array();

        $this->db->select('ic_trans.doc_no as Docno');
        $this->db->from('ic_trans');
        $this->db->where('ic_trans.doc_no',$_data['docno']);
        $data['ISSUE_DOC'] = $this->db->get()->result_array()[0];

        return $data;
    }

    public function check_bill_model()
    {

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;
        
        $this->db->select('field_bc_docno');
        $this->db->from('tb_request_porduction_item');
        $this->db->where('field_bc_docno',$_data['docno']);
        $data_check_bill = $this->db->get()->result_array();

        if(count($data_check_bill) > 0){
            $data['check_bill'] = 'have';
        }else{
            $data['check_bill'] = 'no_have';
        }
        
        return $data;
    
    }

    public function add_request_production_model()
    {

        date_default_timezone_set('Asia/Bangkok');

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        //-------------------------------------certificate_signature-------------------------------------------------
            // $type => part depart employee
            // $group_id = > 1 2 3 4 5
            // $array = > array or value one data or value more data (Separated by ,)
            // get_find_position_bygroup_model => $type , $group_id , $array
            // get_find_position_bygroup_set_model  =>  $group_id
            // get_find_list_position_bygroup_model  =>  $type , $group_id , $array
            // if not found data response => nodata
            // $group_id = $value;
            $data_certificate_signature_group_2 = $this->All_tools_certificate_signature_model->get_find_list_position_bygroup_model(
                'part',
                2,
                $_SESSION['saeree_partid']
            );

        //-------------------------------------END-certificate_signature--------------------------------------------

        //-------------------------------------tools_docno-------------------------------------------------

            // $name_table => table name
            // $name_field_id => field name (id)
            // $name_field_date => field name (date)
            // $name_field_docno => field name (docno)
            // $name_field_type => field name (type)
            // $name_title => title name 
            // $data_field_type => data (1 or 2 or 3)

            $name_table = 'tb_request_production';
            $name_field_id = 'field_id';
            $name_field_date = 'field_rp_create_date';
            $name_field_docno = 'field_docno';
            $name_title  = 'RP';
            $data_docno = $this->All_tools_docno_model->get_create_docno_1_model(
                $name_table,
                $name_field_id,
                $name_field_date,
                $name_field_docno,
                $name_title
            );

        
        //-------------------------------------END-tools_docno--------------------------------------------

        $this->db->set('field_docno',$data_docno);
        $this->db->set('field_rp_creator',$_SESSION['saeree_employee']);
        $this->db->set('field_rp_depart',$_SESSION['saeree_departid']);
        $this->db->set('field_rp_create_date',date('Y-m-d H:i:s'));
        $this->db->set('field_doc_type',$_data['field_doc_type']);
        $this->db->set('field_fixitem_sub_id',$_data['field_fixitem_sub_id']);
        $this->db->set('field_rp_topic',$_data['field_rp_topic']);
        $this->db->set('field_rp_controller',$_data['field_rp_controller']);
        $this->db->set('field_rp_name',$_data['field_rp_name']);
        $this->db->set('field_rp_description',$_data['field_rp_description']);
        $this->db->set('field_rp_require_date',$_data['field_rp_require_date']);
        $this->db->set('field_rp_worker',$_data['field_rp_worker']);
        $this->db->set('field_rp_cost_estimate',$_data['field_rp_cost_estimate']);
        $this->db->set('field_rp_cause',$_data['field_rp_cause']);
        // $this->db->set('field_rp_fix',$_data['field_rp_fix']);
        $this->db->set('field_rp_status',0);
        $this->db->set('field_rp_trash',0);
        $this->db->set('field_count_print',0);
        $this->db->insert('tb_request_production');

        $id = $this->db->insert_id();

        $afftectedRows = $this->db->affected_rows();

        // request_production_manager

            if($afftectedRows > 0){

                foreach ($data_certificate_signature_group_2 as $key => $value) {
                    $this->db->set('field_rp_id',$id);
                    $this->db->set('field_employee_id',$value['id']);
                    $this->db->set('field_approve','0');
                    $this->db->insert('tb_request_production_manager');
                }

            }

        // END request_production_manager

        // request_porduction_item

            if(isset($_data['data_labor_list'])){

                $this->request_porduction_item_labor_add($id ,$_data['data_labor_list'] );
              
            }

        // END request_porduction_item

        // request_porduction_item
        
            if(isset($_data['data_item_request'])){

                $this->request_porduction_item_request_add($id ,$_data['data_item_request'] );

            }

        // END request_porduction_item

        // request_porduction_fixitem_history
        

        // END request_porduction_fixitem_history

        if ($_data['field_doc_type'] == 2) {
            
            $this->db->set('sk_asset.tb_asset.field_qty_fix',1);
            $this->db->where('sk_asset.tb_asset.field_id',$_data['field_fixitem_sub_id']);
            $this->db->update('sk_asset.tb_asset');
        }

        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'เพิ่ม' ,
                "field_table_name" => 'tb_request_production',
                "field_table_id" =>  $id,
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------
        
        return $data_certificate_signature_group_2;
    }

    public function add_request_production_history_model()
    {

        $this->db = $this->load->database('default', TRUE);
        $_data = $_REQUEST;

        if(isset($_data['data_fixhistory'])){

            $this->request_porduction_fixitem_history_request_add($_data['data_fixhistory'],$_data['field_fixitem_sub_id']);

        }

        return 'success';
    }

    function request_porduction_item_labor_add(
        $id , $data
    )
    {

        foreach($data as $value){
        
            if($value['field_labor_name'] == '' ){

            }else{
                $this->db->set('field_item_name',$value['field_labor_name']);
                $this->db->set('field_item_qty',$value['field_labor_qty']);
                $this->db->set('field_item_unit',$value['field_labor_unit']);
                $this->db->set('field_item_priceunit',$value['field_labor_unitprice']);
                $this->db->set('field_item_price',$value['field_labor_sumprice']);
                $this->db->set('field_rp_id',$id);
                $this->db->insert('tb_request_porduction_item');
            }	
        }

    }

    function request_porduction_item_request_add(
        $id , $data
    )
    {

        foreach($data as $value){

            if($value['Docno'] == '' ){

            }else{
                $this->db->set('field_database',$value['Database']);
                $this->db->set('field_bc_item_code',$value['ItemCode']);
                $this->db->set('field_item_name',$value['ItemName']);
                $this->db->set('field_item_qty',$value['Qty']);
                $this->db->set('field_item_unit',$value['UnitCode']);
                $this->db->set('field_item_priceunit',$value['Price']);
                $this->db->set('field_item_price',$value['Amount']);
                $this->db->set('field_bc_docno',$value['Docno']);
                $this->db->set('field_rp_id',$id);
                $this->db->set('field_bc_docno_detail',$value['StkIssueMyDescription']);
                $this->db->set('field_bc_item_code_detail',$value['StkIssueSub2MyDescription']);
                $this->db->insert('tb_request_porduction_item');
            }	
        }

    }

    public function request_porduction_fixitem_history_request_add(
        $data,$field_fixitem_sub_id
    )
    {
        foreach($data as $value){

            if($value['field_docno'] == '' ){

            }else{
                $this->db->set('field_fixitem_sub_id',$field_fixitem_sub_id);
                $this->db->set('field_rp_id',$value['field_id']);
                $this->db->set('field_rp_name',$value['field_rp_name']);
                $this->db->set('field_rp_docno',$value['field_docno']);
                $this->db->insert('tb_request_production_fixitem_history');
            }	
        }

    }

    public function print_rp_model($id)
    {

        $this->db = $this->load->database('default', TRUE);

        $_data = $_REQUEST;

        $data['data_rp'] = $this->get_data_request_production($id,'');

        $data['data_rp_item'] = $this->get_data_request_production_item($id,'all');

        $data['cer_manager'] = $this->get_data_request_production_manager($id);

        $data['cer_ceo'] = $this->get_data_request_production_ceo($id);

        $this->db->set('tb_request_production.field_count_print','field_count_print+1', FALSE);
		$this->db->set('tb_request_production.field_print_date',date('Y-m-d H:i:s'));
		$this->db->where('tb_request_production.field_id',$id);
        $this->db->update('tb_request_production');

        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'พิมพ์ใบสั่งผลิต-ใบสั่งซ่อม' ,
                "field_table_name" => 'tb_request_production',
                "field_table_id" =>  $id,
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------
      
        $this->load->view("Request_production/Request-production-print",$data);
    }	

    // public function print_rp_first_model($id)
    // {

    //     $this->db = $this->load->database('default', TRUE);

    //     $_data = $_REQUEST;

    //     $data['data_rp'] = $this->get_data_request_production($id,'');

    //     $data['data_rp_item'] = $this->get_data_request_production_item($id,'all');

    //     $data['cer_manager'] = $this->get_data_request_production_manager($id);

    //     // $data['cer_ceo'] = $this->get_data_request_production_ceo($id);

    //     // $this->db->set('tb_request_production.field_count_print','field_count_print+1', FALSE);
	// 	// $this->db->set('tb_request_production.field_print_date',date('Y-m-d H:i:s'));
	// 	// $this->db->where('tb_request_production.field_id',$id);
    //     // $this->db->update('tb_request_production');

    //     //-------------------------------------Activity_log-------------------------------------------------
    //         // $data_activity_log = array();
    //         // $data_activity_log = array(
    //         //     "field_activity" => 'พิมพ์ใบสั่งผลิต-ใบสั่งซ่อม' ,
    //         //     "field_table_name" => 'tb_request_production',
    //         //     "field_table_id" =>  $id,
    //         //     "field_creator_id" => $_SESSION['saeree_employee'],
    //         //     "field_creator_date" => date('Y-m-d H:i:s')
    //         // );
    //         // $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
    //     //-------------------------------------END-Activity_log--------------------------------------------
      
    //     $this->load->view("Request_production/Request-production-print_first",$data);
    // }	

    public function print_rp_first_model()
    {

        $this->db = $this->load->database('default', TRUE);

        // $data = $_GET;

        $data['data_rp'] = $this->get_data_request_production($_GET['id'],'');

        $data['data_rp_item'] = $this->get_data_request_production_item($_GET['id'],'all');

        $data['data_itemlist'] = $this->get_data_request_production_item($_GET['id'],'itemlist');

        $data['data_laborlist'] = $this->get_data_request_production_item($_GET['id'],'laborlist');

        $data['cer_manager'] = $this->get_data_request_production_manager($_GET['id']);

        $data['type'] = $_GET['type'];

        if ($_GET['type'] == 1) {
            $this->db->set('tb_request_production.field_labor_print','1');
        }elseif ($_GET['type'] == 2) {
            $this->db->set('tb_request_production.field_item_print','1');
        }elseif ($_GET['type'] == 3) {
            // $this->db->set('tb_request_production.field_labor_print','1');
            // $this->db->set('tb_request_production.field_item_print','1');
            $this->db->set('tb_request_production.field_laboritem_print','1');
        }
        $this->db->set('tb_request_production.field_count_print','field_count_print+1', FALSE);
        $this->db->where('tb_request_production.field_id',$_GET['id']);
        $this->db->update('tb_request_production');

        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'พิมพ์ใบสั่งผลิต-ใบสั่งซ่อมก่อนอนุมัติ' ,
                "field_table_name" => 'tb_request_production',
                "field_table_id" =>  $_GET['id'],
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------
      

        // $data['cer_ceo'] = $this->get_data_request_production_ceo($id);

        $this->load->view("Request_production/Request-production-print_first",$data);
    }	

    public function fixit_again_model()
    {
        $this->db = $this->load->database('default', TRUE);
        //-------------------------------------Activity_log-------------------------------------------------
        $data_activity_log = array();
        $data_activity_log = array(
            "field_activity" => 'ซ่อมสินทรัพย์เพิ่มทับกับสินทรัพย์ที่ทำอยู่ '.$_POST['comment'] ,
            "field_table_name" => 'tb_asset',
            "field_table_id" =>  $_POST['id'],
            "field_creator_id" => $_SESSION['saeree_employee'],
            "field_creator_date" => date('Y-m-d H:i:s')
        );
        $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
    //-------------------------------------END-Activity_log--------------------------------------------
    }

    public function print_sum_model($id)
    {

        $this->db = $this->load->database('default', TRUE);

        $data['data_rp'] = $this->get_data_request_production($id,'');

        $data_rp_employee = $this->get_data_request_production_worker($id,'');
		$data['employee'] = '';
		foreach ($data_rp_employee as $key => $value){
			$data['employee'] = $data['employee'] .$value['ewpepleid']   .$value['ewfirstname']  .'(' .$value['ewnickname']. ')'. ' , ';
        }

        $data_accept_employee = $this->get_data_request_production_worker($id,0);
		$data['employee_accept'] = '';
		foreach ($data_accept_employee as $key => $value) {
			$data['employee_accept'] = $data['employee_accept'] .$value['ewpepleid']   .$value['ewfirstname']  .'(' .$value['ewnickname']. ')'. ' , ';
        }

        $recive_date = $data['data_rp']['field_rp_recive_date'];
        $success_date = $data['data_rp']['field_rp_success_date'];

        $ts1 = strtotime($recive_date);
		$ts2 = strtotime($success_date);

        $diff = ($ts2 - $ts1)/86400+1;
        $data['diff'] = $diff;

        $dataitemlist = $this-> get_data_request_production_item($id,'itemlist');
        $data['itemlist'] = [];
        foreach ($dataitemlist as $key => $value){

            $this->db = $this->load->database($value['field_database'], TRUE);

            if($value['field_bc_docno'] != null){

                $get_stkissue_docno = $this->get_stkissue(
                    $value['field_database'],
                    $value['field_bc_docno'],
                    $value['field_bc_item_code'],
                    $value['field_item_qty']
                );


                if($get_stkissue_docno != 'nodata'){
                    $stkissue_docno = ["stkissue_docno" => $get_stkissue_docno[0]['Docno']];
                    $stkissue_qty = ["stkissue_qty" => $get_stkissue_docno[0]['Qty']];
                   
                    $get_stkissueRet_docno = $this->get_stkissueRet(
                        $value['field_database'],
                        $stkissue_docno['stkissue_docno'],
                        $value['field_bc_item_code']
                    );
                
                    if($get_stkissueRet_docno != 'nodata'){
                        $stkissueRet_docno = ["stkissueRet_docno" => $get_stkissueRet_docno[0]['BCStkIssueRetSub_docno']];
                        $stkissueRet_qty = ["stkissueRet_qty" => $get_stkissueRet_docno[0]['BCStkIssueRetSub_qty']];
                    }else{
                        $stkissueRet_docno = ["stkissueRet_docno" => ''];
                        $stkissueRet_qty = ["stkissueRet_qty" => 0];
                    }

                }else{
                    $stkissue_docno = ["stkissue_docno" => ''];
                    $stkissue_qty = ["stkissue_qty" => 0 ];
                }
                $maxqty_item_invoice = $value + $stkissue_docno + $stkissue_qty + $stkissueRet_docno + $stkissueRet_qty;

            }else{
                $maxqty_item_invoice = $value;
            } 
            array_push($data['itemlist'],$maxqty_item_invoice);

        }

        //-------------------------------------Activity_log-------------------------------------------------
            $data_activity_log = array();
            $data_activity_log = array(
                "field_activity" => 'พิมพ์สรุปใบสั่งผลิต-ใบสั่งซ่อม' ,
                "field_table_name" => 'tb_request_production',
                "field_table_id" =>  $id,
                "field_creator_id" => $_SESSION['saeree_employee'],
                "field_creator_date" => date('Y-m-d H:i:s')
            );
            $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
        //-------------------------------------END-Activity_log--------------------------------------------
      
        $this->load->view("Request_production/Request-production-sum",$data);
    }



}