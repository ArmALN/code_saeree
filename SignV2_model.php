<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignV2_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->load->library("mpdf60/mpdf");
    }

	public function permission_user_model()
	{
	
		$this->db->select('
			*,
			employee.id AS employeeid,
			group.name as groupname
		');
		$this->db->from('employee');
		$this->db->join('depart','employee.depart_id = depart.id');
		$this->db->join('user','user.employee_id = employee.id');	
		$this->db->join('privilege','user.user_id = privilege.pv_userid');
		$this->db->join('group','privilege.pv_groupid = group.id');	
		$this->db->where('employee_id',$_SESSION['saeree_employee']);
		$data = $this->db->get()->result_array();
			
		return  $data ;
	
	}

	public function get_employee_model(){
		$this->db = $this->load->database('default', TRUE);
        $this->db->select('*,
        depart.name AS departname,
        employee.id AS employeeid');
        $this->db->from('employee');
        $this->db->join('depart','employee.depart_id = depart.id');
        $this->db->join('user','user.employee_id = employee.id');	
        $this->db->where('employee_id',$_SESSION['saeree_employee']);
        $data = $this->db->get()->result_array();	
        echo json_encode($data);
    }

	public function check_price_onBC(){
		$this->db = $this->load->database('default', TRUE);

		$array_size = ['5','7','10','11'];
		$array_type_price = ['8','9'];
		
		if ($_POST['search_signver'] == 1) {
			$this->db->select('
			tb_sign_sub.*,
			tb_sign.field_comfirm_needdate,
			tb_sign.field_docno,
			tb_sign_type_price.type_name_price,
			tb_sign_size.size_name
			');
			$this->db->from('tb_sign');
			$this->db->join('tb_sign_sub','tb_sign.field_id = tb_sign_sub.field_sign_id');
			$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_sign_sub.field_type_sign_price');
			$this->db->join('tb_sign_size','tb_sign_size.id = tb_sign_sub.field_signsize');
			$this->db->where_not_in('field_signsize',$array_size);
			$this->db->where_not_in('field_type_sign_price',$array_type_price);
			$this->db->where('tb_sign.field_itemcode >=',$_POST['search_str']);
			$this->db->where('tb_sign.field_itemcode <=',$_POST['search_end']);
			$this->db->where('tb_sign.field_confirm_status !=',2);
			$this->db->group_by('tb_sign_sub.field_itemcode');
			$this->db->order_by('tb_sign.field_itemcode','ASC');
			$this->db->order_by('tb_sign.field_id','DESC');
			$data['Sign'] = $this->db->get()->result_array();
		}elseif($_POST['search_signver'] == 2){

			$this->db->select('field_itemcode');
			$this->db->from('tb_signv2');
			$this->db->where('tb_signv2.field_itemcode >=',$_POST['search_str']);
			$this->db->where('tb_signv2.field_itemcode <=',$_POST['search_end']);
			$this->db->group_by('tb_signv2.field_itemcode');
			$field_id_sign = $this->db->get()->result_array();

			foreach ($field_id_sign as $key => $value) {
				$this->db->select('field_id');
				$this->db->from('tb_signv2');
				$this->db->where('tb_signv2.field_itemcode',$value['field_itemcode']);
				$this->db->order_by('tb_signv2.field_id','DESC');
				$this->db->limit(1);
				$all_field_id[] = $this->db->get()->result_array()[0]['field_id'];
			}

			$this->db->select('
			tb_signv2_sub.*,
			tb_signv2.field_docno,
			tb_signv2.field_comfirm_needdate,
			tb_sign_type_price.type_name_price,
			tb_sign_size.size_name
			');
			$this->db->from('tb_signv2');
			$this->db->join('tb_signv2_sub','tb_signv2.field_id = tb_signv2_sub.field_sign_id');
			$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price');
			$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize');
			$this->db->where_not_in('field_signsize',$array_size);
			$this->db->where_not_in('field_type_sign_price',$array_type_price);
			$this->db->where_in('tb_signv2.field_id',$all_field_id);
			// $this->db->where('tb_signv2.field_itemcode >=',$_POST['search_str']);
			// $this->db->where('tb_signv2.field_itemcode <=',$_POST['search_end']);
			$this->db->where('tb_signv2.field_active_status',1);
			$this->db->where('tb_signv2.field_confirm_status',1);
			// $this->db->where('tb_signv2.field_confirm_status !=',2);
			$this->db->group_by('tb_signv2_sub.field_itemcode');
			$this->db->order_by('tb_signv2.field_itemcode','ASC');
			// $this->db->order_by('tb_signv2_sub.field_id','DESC');
			$this->db->order_by('tb_signv2.field_id','DESC');
			$data['Sign'] = $this->db->get()->result_array();
		}

		foreach ($data['Sign'] as $key => $value) {
			$this->db = $this->load->database('shsps_2022', TRUE);
			$this->db->select('
				BCITEM.Code,
				BCITEM.Name1,
				BCITEM.Name2,
				BCITEM.GroupCode,
				BCPriceList.UnitCode as DefSaleUnitCode,
				BCPriceList.FromQty,
				BCPriceList.ToQty,
				BCPriceList.SalePrice1,
				BCStkPacking.Rate'
			);
			$this->db->from('BCITEM');
			$this->db->join('BCPriceList','BCPriceList.ItemCode = BCITEM.Code','left');
			$this->db->join('BCStkPacking','BCStkPacking.ItemCode = BCPriceList.ItemCode And BCStkPacking.UnitCode = BCPriceList.UnitCode','left');
			$this->db->where_in('BCITEM.Code',$value['field_itemcode']);
			$this->db->where('BCITEM.ActiveStatus !=',3);
			$this->db->order_by('BCStkPacking.Rate','ASC');
			$this->db->order_by('BCPriceList.FromQty','ASC');
			$data['BCITEM'][] = $this->db->get()->result_array();
		}

        echo json_encode($data);
	}

	public function get_loaddata_tocheck(){
		$this->db = $this->load->database('default', TRUE);
		
		$count_creator = 0;
		if ($_POST['search_creator'] != null) {
			$count_creator = count($_POST['search_creator']);
		}

		$count_groupcode = 0;
		if ($_POST['search_groupcode'] != null) {
			$count_groupcode = count($_POST['search_groupcode']);
		
		}

        $this->db->select('
			tb_signv2.field_groupcode,
			tb_signv2.field_active_status,
			tb_signv2.field_upload_status,
			tb_signv2.field_docno,
			tb_signv2.field_itemcode,
			tb_signv2.field_itemname,
			tb_signv2.field_confirm_status,
			tb_signv2.field_packing_status,
			tb_signv2.field_recieve_status,
			tb_signv2.field_setup_status,
			tb_signv2.field_recheck_status,
			tb_signv2.field_packingdate,
			tb_signv2.field_recievedate,
			tb_signv2.field_recieve_success,
			tb_signv2.field_destroy_status as status_destroy,
			tb_signv2.field_id as sign_id,
			tb_signv2.field_do_yourself as field_do_yourself,
			tb_signv2.field_request_status,
			tb_signv2.field_setupdate,
			tb_signv2.field_upload_date,
			tb_sign_cause.type_name,
			employee.firstname as creator_firstname,
			employee.lastname as creator_lastname,
			employee.nickname as creator_nickname,
			cf.firstname as confirm_firstname,
			cf.nickname as confirm_nickname,
			pk.firstname as packing_firstname,
			pk.nickname as packing_nickname,
			rc.firstname as recieve_firstname,
			rc.nickname as recieve_nickname,
			rcp.firstname as recievetoperson_firstname,
			rcp.nickname as recievetoperson_nickname,
			st.firstname as setup_firstname,
			st.nickname as setup_nickname,
			recheck.firstname as recheck_firstname,
			recheck.nickname as recheck_nickname
		');
        $this->db->from('tb_signv2');
		$this->db->join('employee','employee.id = tb_signv2.field_creator','left');
		$this->db->join('employee cf','cf.id = tb_signv2.field_confirm_person','left');
		$this->db->join('employee pk','pk.id = tb_signv2.field_packing_person','left');
		$this->db->join('employee rc','rc.id = tb_signv2.field_recieve_person','left');
		$this->db->join('employee rcp','rcp.id = tb_signv2.field_recieve_toperson','left');
		$this->db->join('employee st','st.id = tb_signv2.field_setup_person','left');
		$this->db->join('employee recheck','recheck.id = tb_signv2.field_recheck_person','left');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_signv2.field_type','left');
		if ($_POST['search_status_sign'] != '') {
			if ($_POST['search_status_sign'] == 1) {
				if ($count_creator != 0) {
					$this->db->where_in('field_creator',$_POST['search_creator']);
				}
				$this->db->where('field_confirm_status',0);

			}elseif ($_POST['search_status_sign'] == 2) {
				if ($count_creator != 0) {
					$this->db->where_in('field_confirm_person',$_POST['search_creator']);
				}
				$this->db->where('field_recieve_status',1);
			}elseif ($_POST['search_status_sign'] == 3) {
				if ($count_creator != 0) {
					$this->db->where_in('field_recieve_person',$_POST['search_creator']);
				}
				$this->db->where('field_setup_status',1);
			}elseif ($_POST['search_status_sign'] == 4) {
				if ($count_creator != 0) {
					$this->db->where_in('field_confirm_person',$_POST['search_creator']);
				}
				$this->db->where('field_destroy_status',1);
			}elseif ($_POST['search_status_sign'] == 5) {
				if ($count_creator != 0) {
					$this->db->where_in('field_setup_person',$_POST['search_creator']);
				}
				$this->db->where('field_recheck_status',1);
			}
			if ($count_groupcode != 0) {
				$this->db->where_in('field_groupcode',$_POST['search_groupcode']);
			}
		}
		$this->db->order_by('field_groupcode','ASC');
        $data['sign'] = $this->db->get()->result_array();

		$this->db->select('
		employee.firstname as firstname,
		employee.lastname as lastname,
		employee.nickname as nickname,
        depart.name AS departname,
        employee.id AS employeeid');
        $this->db->from('employee');
        $this->db->join('depart','employee.depart_id = depart.id');
        $this->db->join('user','user.employee_id = employee.id');	
        $this->db->where_in('employee.id',$_POST['search_creator']);
        $data['employee'] = $this->db->get()->result_array();	

        echo json_encode($data);
    }

	public function get_select_place(){
		$this->db = $this->load->database('default', TRUE);
        $this->db->select('*');
        $this->db->from('tb_sign_place');
		$this->db->where('field_item_code',$_POST['item_code']);
        $data = $this->db->get()->result_array();	
        echo json_encode($data);
    }

	public function get_select_destroy(){
		$this->db = $this->load->database('default', TRUE);
        $this->db->select('*');
        $this->db->from('tb_sign_old_new');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_sign_old_new.field_type_sign_price','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_sign_old_new.sign_size','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_sign_old_new.field_place_id','left');
		$this->db->where('tb_sign_old_new.field_item_code',$_POST['item_code']);
        $data['destroy'] = $this->db->get()->result_array();	

		$this->db = $this->load->database('shsps_2022', TRUE);
		$this->db->select('
			*
		');
		$this->db->from('ic_inventory_detail');
		$this->db->where('ic_code',$_POST['item_code']);
        $data['ic_inventory_detail'] = $this->db->get()->result_array()[0];	

        echo json_encode($data);
    }

	public function get_destroy_info(){
		$this->db = $this->load->database('default', TRUE);
        $this->db->select('*');
        $this->db->from('tb_sign_destroy_sub');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_sign_destroy_sub.field_type_sign_price','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_sign_destroy_sub.sign_size','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_sign_destroy_sub.field_place_id','left');
		$this->db->where('tb_sign_destroy_sub.field_destroy_id',$_POST['id']);
        $data = $this->db->get()->result_array();	
        echo json_encode($data);
    }

	public function change_place(){
		$this->db = $this->load->database('default', TRUE);
		$date_today = date('Y-m-d H:i:s');
        $this->db->select('*');
        $this->db->from('tb_sign_old');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_name = tb_sign_old.place');	
		$this->db->where('status_sign','1');
		$this->db->where('id >=', 23000);
		$this->db->where('id <=', 24000);
		$this->db->group_by('item_code,place');    
        $data['place'] = $this->db->get()->result_array();	

        // $this->db->select('
		// field_place_id,
		// field_item_code
		// ');
        // $this->db->from('tb_sign_place');  
		// // $this->db->limit(1000);
		// $this->db->where('field_place_id >=', 19500);
		// $this->db->where('field_place_id <=', 20000);
		// $this->db->order_by('field_item_code','ASC');
        // $data['place'] = $this->db->get()->result_array();	

		foreach ($data['place'] as $val) {
			$this->db->set('field_signplace',$val['field_place_id']);
			$this->db->where('field_itemcode',$val['field_item_code']);
			$this->db->where('field_signsize',$val['sign_size']);
			$this->db->update('tb_signv2_sub');
		}

        echo json_encode($data);
    }

	public function update_change_place(){
		$this->db = $this->load->database('default', TRUE);
		$date_today = date('Y-m-d H:i:s');
		

		$this->db->set('field_signplace',$_POST['place_id']);
		$this->db->where('field_id',$_POST['field_id']);
		$this->db->update('tb_signv2_sub');

		// timeline
		$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself,tb_signv2_sub.field_itemname');
		$this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
		$this->db->where('tb_signv2_sub.field_id',$_POST['field_id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0];


		$field_detail = 'แก้ไขสถานที่ติดตั้ง เลขที่เอกสาร '.$data_docno['field_docno'];


		$this->db->set('field_sign_id',$data_docno['field_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',6);
		$this->db->set('field_createdate',$date_today);
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		// 
	
        echo json_encode($data);
    }

	public function update_edit_data()
	{
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;

		if ($data['type_submit'] == 1) {
			$this->db->set('field_signplace',$data['data_update']);
		}
		elseif ($data['type_submit'] == 2) {
			$this->db->set('field_type_sign_price',$data['data_update']);
			$this->db->set('field_pack_status',null);
		}
		elseif ($data['type_submit'] == 3) {
			$this->db->set('field_signsize',$data['data_update']);
			$this->db->set('field_pack_status',null);
		}
		elseif ($data['type_submit'] == 4) {
			$this->db->set('field_signamount',$data['data_update']);
			$this->db->set('field_pack_status',null);
		}
		elseif ($data['type_submit'] == 5) {
			$this->db->set('field_comment',$data['data_update']);
			$this->db->set('field_pack_status',null);
		}

		// $this->db->set('field_signplace',$val['field_place_id']);
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signv2_sub');
		
		if ($data['type_submit'] != 1) {
			$this->db->set('tb_sign.field_packing_status','0');
			$this->db->set('tb_sign.field_recheck_status','1');
			$this->db->set('tb_sign.field_edit_comment',$data['edit_comment']);
			$this->db->where('tb_sign.field_id',$data['field_sign_id']);
			$this->db->update('tb_sign');
		}else{
			$this->db->set('tb_sign.field_recheck_status','1');
			$this->db->where('tb_sign.field_id',$data['field_sign_id']);
			$this->db->update('tb_sign');
		}
		echo json_encode($data);
	}

	public function loaddata_place(){
		$this->db = $this->load->database('default', TRUE);
		$date_today = date('Y-m-d H:i:s');
        $this->db->select('*');
        $this->db->from('tb_sign_old');
		$this->db->where('status_sign','1');
		$this->db->where('id >=', 23000);
		$this->db->where('id <=', 24000);
		$this->db->group_by('item_code,place');    
        $data['place'] = $this->db->get()->result_array();	


		foreach ($data['place'] as $key => $value) {
			$this->db->set('field_create_date',$date_today);
			$this->db->set('field_place_name',$value['place']);
			$this->db->set('field_item_code',$value['item_code']);
			$this->db->set('field_create_person',$_SESSION['saeree_employee']);
			$this->db->insert('tb_sign_place');

			$this->db->select('field_place_id,field_item_code');
			$this->db->from('tb_sign_place');
			$this->db->order_by('field_place_id','DESC');
			$this->db->limit(1);
			$selectplace[$key] = $this->db->get()->result_array()[0];

			$this->db->select('*');
			$this->db->from('tb_sign_old');
			$this->db->where('item_code',$selectplace[$key]['field_item_code']);
			$this->db->where('status_sign','1');
			$data['signold'][$key] = $this->db->get()->result_array();

			foreach ($data['signold'][$key] as $val) {
				$this->db->set('sign_size',$val['sign_size']);
				$this->db->set('field_place_id',$selectplace[$key]['field_place_id']);
				$this->db->set('field_item_code',$val['item_code']);
				$this->db->insert('tb_sign_old_new');
			}
		}


			// $this->db->select('field_item_code,field_place_id');
			// $this->db->from('tb_sign_place');
			// $this->db->order_by('field_place_id','DESC');
			// $selectplace = $this->db->get()->result_array();

			// $this->db->select('*');
			// $this->db->from('tb_sign_old');
			// $this->db->where_in('item_code',$selectplace['field_item_code']);
			// $this->db->where('status_sign','1');
			// $datasignold = $this->db->get()->result_array();

			// foreach ($selectplace as $val) {
			// 	// $this->db->set('field_place_id',$selectplace[$key]['field_place_id']);
			// 	$this->db->set('field_place_id',$val['field_place_id']);
			// 	$this->db->where('field_item_code',$val['field_item_code']);
			// 	$this->db->update('tb_sign_old_new');
			// }

        echo json_encode($data);
    }
	
	public function get_signold_inplace(){
		$this->db = $this->load->database('default', TRUE);
		// tb_sign_size.size_name,
		// tb_sign_place.field_place_name
        $this->db->select('
			tb_sign_old_new.field_place_id,
			tb_sign_old_new.field_old_id,
			SUM(tb_sign_old_new.sign_amount) as sign_amount,
			tb_sign_size.size_name,
			tb_sign_place.field_place_name
		');
        $this->db->from('tb_sign_old_new');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_sign_old_new.sign_size','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_sign_old_new.field_place_id','left');
		$this->db->where('tb_sign_old_new.field_place_id',$_POST['place_id']);
		$this->db->group_by('tb_sign_old_new.sign_size');
        $data = $this->db->get()->result_array();	
        echo json_encode($data);
    }
	
	public function comment_type(){
		$this->db = $this->load->database('default', TRUE);
        $this->db->select('*');
        $this->db->from('tb_sign_destroy_comment');
        $data = $this->db->get()->result_array();	
        echo json_encode($data);
    }

	public function comment_type_sub(){
		$this->db = $this->load->database('default', TRUE);
        $this->db->select('*');
        $this->db->from('tb_signv2_destroy_comment');
        $data = $this->db->get()->result_array();	
        echo json_encode($data);
    }

	public function sign_type(){
		$this->db = $this->load->database('default', TRUE);
        $this->db->select('*');
        $this->db->from('tb_sign_cause');
        $data = $this->db->get()->result_array();	
        echo json_encode($data);
    }

	public function confirm_sign_size(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;

		if ($data['type_price'] == 1) {
			$size = array('1','2','3','4','9','20','12','13','15','17');
		}
		if ($data['type_price'] == 2) {
			$size = array('1','2','3','4','9','20','17');
		}
		if ($data['type_price'] == 3) {
			$size = array('1','2','3','4','9','20','17');
		}
		if ($data['type_price'] == 4) {
			$size = array('1','2','3','9','20','17');
		}
		if ($data['type_price'] == 5) {
			$size = array('1','2','3','4','9','20','12','13','17');
		}
		if ($data['type_price'] == 6) {
			$size = array('1','2','3','4','9','20','17');
		}
		if ($data['type_price'] == 7) {
			$size = array('1','2','3','4','9','20','17');
		}
		if ($data['type_price'] == 8) {
			$size = array('1','2','3','4','9','17');
		}
		if ($data['type_price'] == 9) {
			$size = array('2','3');
		}
		if ($data['type_price'] == '') {
			$size = array('5','6','7','8','10','11','16','19');
		}

        $this->db->select('*');
        $this->db->from('tb_sign_size');
		$this->db->where_in('id',$size);
		
        $data = $this->db->get()->result_array();	
        echo json_encode($data);
    }

	public function select_sign_size(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;

        $this->db->select('*');
        $this->db->from('tb_sign_size');
		
        $data = $this->db->get()->result_array();	
        echo json_encode($data);
    }

	public function confirmsign_type_price(){
		$this->db = $this->load->database('default', TRUE);
        $this->db->select('*');
        $this->db->from('tb_sign_type_price');
		if ($_POST['price'] != '') {
			if ($_POST['price'] == '8') {
				$type = array('9','8');
				$this->db->where_in('id',$type);
			}else if($_POST['price'] == '1'){
				$type = array('5','6','7','8');
				$this->db->where_in('id',$type);
			}else{
				$type = array('1','2','3','4','8','9','10');
				$this->db->where_in('id',$type);
			}
		}
		else{
			// $type = array('1','2','3','4','8','9','10');
			// $this->db->where_in('id',$type);
		}
        $data = $this->db->get()->result_array();
        echo json_encode($data);
    }
    
    public function autocomplete_bcitem_model(){

		$this->db = $this->load->database('shsps_2022', TRUE);

        $data = $_POST;
		$search = $_POST['search_itemcode'];
		$search = explode(" ",$search);
		$count_search = count($search);

		$this->db->select('
		code,
		name_1,
		name_2,
		unit_type,
		unit_standard,
		unit_cost,
		group_main,
		group_sub,
		item_category,
		item_status,
		status,
		average_cost,
		balance_qty
		');
		$this->db->from('ic_inventory');
		// $this->db->where('ActiveStatus !=',3);
		// $this->db->like('code',$data['search_itemcode'],'after');
		// $this->db->or_like('name1',$data['search_itemcode'],'both');

		$this->db->group_start();
		for($i=0;$i<$count_search;$i++){
			$this->db->like('code',$search[$i]);
		}
		$this->db->group_end();

		$this->db->or_group_start();
		for($i=0;$i<$count_search;$i++){
			$this->db->like('name_1',$search[$i]);
		}
		$this->db->group_end();

		$this->db->or_group_start();
		for($i=0;$i<$count_search;$i++){
			$this->db->like('name_2',$search[$i]);
		}
		$this->db->group_end();

		$this->db->limit(10);
		$this->db->order_by('code','ASC');
		$ICinventory = $this->db->get()->result_array();
		foreach ($ICinventory as $key => $value) {

			$o = [];
			$o['code'] = $value['code'];
			$o['value'] = $value['code'];
			$o['name_1'] = $value['name_1'];
			$o['name_2'] = $value['name_2'];
			$o['unit_standard'] = $value['unit_standard'];
			$o['balance_qty'] = $value['balance_qty'];
			$o['SalePrice1'] = $value['SalePrice1'];
			$o['label'] = $value['code'].' '.$value['name_1'];

			$data['ICinventory'][] = $o;
		}

		echo json_encode($ICinventory);
	}

	public function search_itemlist(){

		$this->db = $this->load->database('shsps_2022', TRUE);

        $data = $_POST;
		$search = $_POST['search_itemcode'];
		$search = explode(" ",$search);
		$count_search = count($search);

		$this->db->select('
		code,
		name_1,
		name_2,
		unit_type,
		unit_standard,
		unit_cost,
		group_main,
		group_sub,
		item_category,
		item_status,
		status,
		average_cost,
		balance_qty,
		unit_standard_name
		');
		$this->db->from('ic_inventory');
		// $this->db->where('ActiveStatus',1);
		// $this->db->like('code',$data['search_itemcode'],'after');
		// $this->db->or_like('name1',$data['search_itemcode'],'both');

		$this->db->group_start();
		for($i=0;$i<$count_search;$i++){
			$this->db->like('code',$search[$i]);
		}
		$this->db->group_end();

		$this->db->or_group_start();
		for($i=0;$i<$count_search;$i++){
			$this->db->like('name_1',$search[$i]);
		}
		$this->db->group_end();

		$this->db->or_group_start();
		for($i=0;$i<$count_search;$i++){
			$this->db->like('name_2',$search[$i]);
		}
		$this->db->group_end();
		$this->db->limit(10);
		$this->db->order_by('code','ASC');
		$data['ic_inventory'] = $this->db->get()->result_array();
		echo json_encode($data);
	} 


	public function autocomplete_Signitem_model(){

		$this->db = $this->load->database('default', TRUE);

        $data = $_POST;
		$search = $_POST['search_itemcode'];
		$search = explode(" ",$search);
		$count_search = count($search);

		$this->db->select('
		tb_signv2.field_itemcode,
		tb_signv2.field_itemname
		');
		$this->db->from('tb_signv2');
		// $this->db->where('ActiveStatus',1);
		// $this->db->like('code',$data['search_itemcode'],'after');
		// $this->db->or_like('name1',$data['search_itemcode'],'both');

		$this->db->group_start();
		for($i=0;$i<$count_search;$i++){
			$this->db->like('field_itemcode',$search[$i]);
		}
		$this->db->group_end();

		$this->db->or_group_start();
		for($i=0;$i<$count_search;$i++){
			$this->db->like('field_itemname',$search[$i]);
		}
		$this->db->group_end();
		$this->db->group_by('field_itemcode');
		// $this->db->or_group_start();
		// for($i=0;$i<$count_search;$i++){
		// 	$this->db->like('name2',$search[$i]);
		// }
		// $this->db->group_end();

		$this->db->limit(10);
		$BCITEM = $this->db->get()->result_array();
		foreach ($BCITEM as $key => $value) {

			$o = [];
			$o['value'] = $value['field_itemcode'];
			$o['name1'] = $value['field_itemname'];
			$o['label'] = $value['field_itemcode'].' '.$value['field_itemname'];

			$data['BCITEM'][] = $o;
		}
		$this->db = $this->load->database('default',TRUE);
		echo json_encode($data);
	}

    public function check_itemcode_model(){
		$itemcode = explode(',',$_POST['itemcode']);

		$this->db->select('*');
        $this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_signv2_sub.field_signplace','left');
        $this->db->where_in('tb_signv2.field_itemcode',$itemcode);
        $check_itemcode = $this->db->get()->result_array();
		
        $data['check_itemcode'] = 'no_have';

		$i = 0;
		foreach ($check_itemcode as  $value) {

			if ($value['field_confirm_status'] != 2 && $value['field_recheck_status'] != 2) {
				$i++;
			}
		}

		if ($i > 0) {
			$data['check_itemcode'] = 'have';
		}
		$data['i'] = $i;
		$data['data'] = $check_itemcode;

        echo json_encode($data);
    }

	public function get_bcitem_unitcode(){
		$itemcode = explode(',',$_POST['itemcode']);

		$this->db = $this->load->database('shsps_2022', TRUE);
		$this->db->select('
			BCITEM.Code,
			BCITEM.Name1,
			BCITEM.GroupCode,
			BCPriceList.UnitCode as DefSaleUnitCode,
			BCPriceList.FromQty,
			BCPriceList.ToQty,
			BCStkPacking.Rate,
			BCPriceList.SalePrice1');
		$this->db->from('BCITEM');
		$this->db->join('BCPriceList','BCPriceList.ItemCode = BCITEM.Code','left');
		$this->db->join('BCStkPacking','BCStkPacking.ItemCode = BCPriceList.ItemCode And BCStkPacking.UnitCode = BCPriceList.UnitCode','left');
		$this->db->where_in('BCITEM.Code',$itemcode);
		$this->db->order_by('BCStkPacking.Rate','DESC');
		$this->db->order_by('BCPriceList.FromQty','ASC');
		$data['BCITEM'] = $this->db->get()->result_array();


		// $this->db = $this->load->database('shsps_2022', TRUE);
		// $this->db->select('
		// BCITEM.Code,
		// BCITEM.GroupCode,
		// BCITEM.Name1,
		// BCITEM.DefSaleUnitCode,
		// BCITEM.SalePrice1,
		// BCITEM.UnitType,
		// BCITEM.AverageCost,
		// BCITEM.FormatCode,
		// BCITEM.GroupCode,
		// BCITEM.MyDescription,
		// BCITEM.ItemBarCode,
		// BCITEM.StockType,
		// BCITEM.DefSaleWHCode,
		// BCITEM.DefSaleShelf
		// ');
		// $this->db->from('BCITEM');
		// $this->db->where('BCITEM.Code',$_POST['itemcode']);
		// $this->db->where('BCITEM.ActiveStatus != ',0);
		// $this->db->where('BCITEM.ActiveStatus != ',3);
		// $data['BCITEM'] = $this->db->get()->result_array();

		// if(count($data['BCITEM']) > 0){
		// 	$this->db->select('
		// 		BCBarCodeMaster.Barcode
		// 	');
		// 	$this->db->from('BCBarCodeMaster');
		// 	$this->db->where('BCBarCodeMaster.ItemCode',$data['BCITEM'][0]['Code']);
		// 	$this->db->where('BCBarCodeMaster.UnitCode',$data['BCITEM'][0]['DefSaleUnitCode']);
		// 	$this->db->where('BCBarCodeMaster.ActiveStatus',1);
		// 	$data_BarCode = $this->db->get()->result_array();

			
		// 	if(count($data_BarCode) > 0){
		// 		$data['Barcode'] = $data_BarCode[0]['Barcode'];
		// 	}else{
		// 		$data['Barcode'] = '';
		// 	}

		// }else{
		// 	$data['Barcode'] = '';
		// }

		echo json_encode($data);

	}

    public function get_bcitem_model(){

		$itemcode = explode(',',$_POST['itemcode']);

		$this->db = $this->load->database('shsps_2022', TRUE);

		$this->db->select('
			ic_unit_use.ic_code,
			ic_unit_use.stand_value,
			ic_unit_use.code as unit_code,
			ic_inventory_price.sale_price2,
			ic_inventory_price.from_qty,
			ic_inventory_price.to_qty,
			ic_inventory.name_1,
			ic_inventory.group_main
		');
		$this->db->from('ic_unit_use');
		$this->db->join('ic_inventory','ic_inventory.code = ic_unit_use.ic_code');
		$this->db->join('ic_inventory_price','ic_inventory_price.ic_code = ic_unit_use.ic_code','left');
		$this->db->where_in('ic_unit_use.ic_code',$itemcode);
		$this->db->order_by('ic_unit_use.stand_value','DESC');
		$this->db->order_by('ic_inventory_price.line_number','DESC');
		$data['ic_unit_use'] = $this->db->get()->result_array();

		$this->db->select('
		ic_inventory_price_formula.ic_code,
		ic_inventory_price_formula.price_0,
		ic_inventory_price_formula.unit_code
		');
		$this->db->from('ic_inventory_price_formula');
		$this->db->where_in('ic_inventory_price_formula.ic_code',$itemcode);
		$this->db->order_by('ic_inventory_price_formula.price_0','DESC');
		$data['ic_inventory_price'] = $this->db->get()->result_array();

		$this->db->select('
			code,
			name_1,
			name_2,
			group_main,
			unit_standard
		');
		$this->db->from('ic_inventory');
		$this->db->where_in('ic_inventory.code',$itemcode);
		$data['ic_inventory'] = $this->db->get()->result_array();

		// $this->db->select('
		// 	code,
		// 	name_1,
		// 	name_2,
		// 	unit_standard
		// ');
		// $this->db->from('ic_inventory_price');
		// $this->db->where_in('ic_code',$itemcode);
		// $data['ic_inventory'] = $this->db->get()->result_array();

		echo json_encode($data);
	}

	public function get_item_info(){
		$this->db = $this->load->database('shsps_2022', TRUE);
		
		$this->db->select('
		code,
		name_1,
		name_2,
		unit_type,
		unit_standard,
		unit_cost,
		group_main,
		group_sub,
		item_category,
		item_status,
		status,
		average_cost,
		balance_qty
		');
		$this->db->from('ic_inventory');
		$this->db->where('code',$_POST['field_itemcode']);
		$data['ic_inventory'] = $this->db->get()->result_array();

		$this->db->select('
		ic_inventory_price_formula.ic_code,
		ic_inventory_price_formula.price_0,
		ic_inventory_price_formula.unit_code
		');
		$this->db->from('ic_inventory_price_formula');
		$this->db->where_in('ic_inventory_price_formula.ic_code',$data['ic_inventory'][0]['code']);
		$this->db->order_by('ic_inventory_price_formula.price_0','DESC');
		$data['ic_inventory_price'] = $this->db->get()->result_array();

		echo json_encode($data);
	}

	public function get_bcstkpacking_model(){
		$this->db = $this->load->database('shsps_2022', TRUE);
		$this->db->distinct();
		$this->db->select('UnitCode');
		$this->db->from('BCPriceList');
		$this->db->where('ItemCode',$_POST['Code']);
		$data['BCPriceList'] = $this->db->get()->result_array();
		
		$this->db->select('DefSaleUnitCode');
		$this->db->from('BCITEM');
		$this->db->where('Code',$_POST['Code']);
		$data['BCITEM'] = $this->db->get()->result_array();
		
		echo json_encode($data);
	}

	public function get_packingrate_model(){
		$this->db = $this->load->database('shsps_2022', TRUE);
		$this->db->select('Rate,SalePrice1');
		$this->db->from('BCStkPacking');
		$this->db->join('BCPriceList','BCStkPacking.ItemCode = BCPriceList.ItemCode');
		$this->db->where('BCStkPacking.ItemCode',$_POST['Code']);
		$this->db->where('BCStkPacking.UnitCode',$_POST['UnitCode']);
		$this->db->where('BCPriceList.ItemCode',$_POST['Code']);
		$this->db->where('BCPriceList.UnitCode',$_POST['UnitCode']);
		$data['Rate'] = $this->db->get()->result_array(); 
		echo json_encode($data);
	}

	public function confirm_reprint(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;
		$date_today = date('Y-m-d H:i:s');

		$this->db->select('
		tb_signv2_request_sub.field_sgsub_id,
		tb_signv2_sub.field_sign_id,
		tb_signv2_request_sub.field_id as field_request_id
		');
		$this->db->from('tb_signv2_request_sub');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_id = tb_signv2_request_sub.field_sgsub_id','left');
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_sub.field_sign_id','left');
		$this->db->where('field_request_id',$data['field_id']);
		$data['request_sub'] = $this->db->get()->result_array();

		foreach ($data['request_sub'] as $key => $value) {
			$this->db->set('field_packing_status','0');
			$this->db->set('field_packing_person',null);
			$this->db->set('field_packingdate',null);
			$this->db->where('field_id',$value['field_sign_id']);
			$this->db->update('tb_signv2');

			$this->db->set('field_pack_status',null);
			$this->db->set('field_pack_person',null);
			$this->db->set('field_pack_datetime',null);
			$this->db->set('field_request_status',null);
			$this->db->where('field_id',$value['field_sgsub_id']);
			$this->db->update('tb_signv2_sub');

			// timeline
			$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself');
			$this->db->from('tb_signv2');
			$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
			$this->db->where('tb_signv2_sub.field_id',$value['field_sgsub_id']);
			$this->db->limit(1);
			$data_docno = $this->db->get()->result_array()[0];

			$field_detail = 'อนุมัติถอยปริ้น หมายเหตุ '.$data['comment'].' เลขที่เอกสาร '.$data_docno['field_docno'];

			$this->db->set('field_sign_id',$data_docno['field_id']);
			$this->db->set('field_detail',$field_detail);
			$this->db->set('field_status',1);
			$this->db->set('field_createdate',$date_today);
			$this->db->set('field_creator',$_SESSION['saeree_employee']);
			$this->db->insert('tb_signv2_timeline');
			// 
		}

		$this->db->set('field_confirm_comment',$data['comment']);
		$this->db->set('field_confirm_status',1);
		$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
		$this->db->set('field_confirm_date',$date_today);
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signv2_request');
		
		echo json_encode($data);
	}

	public function cancel_reprint(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;
		$date_today = date('Y-m-d H:i:s');

		$this->db->select('
		tb_signv2_request_sub.field_sgsub_id,
		tb_signv2_sub.field_sign_id,
		tb_signv2_request_sub.field_id as field_request_id
		');
		$this->db->from('tb_signv2_request_sub');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_id = tb_signv2_request_sub.field_sgsub_id','left');
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_sub.field_sign_id','left');
		$this->db->where('field_request_id',$data['field_id']);
		$data['request_sub'] = $this->db->get()->result_array();

		foreach ($data['request_sub'] as $key => $value) {

			$this->db->set('field_request_status',null);
			$this->db->where('field_id',$value['field_sgsub_id']);
			$this->db->update('tb_signv2_sub');

			// timeline
			$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself');
			$this->db->from('tb_signv2');
			$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
			$this->db->where('tb_signv2_sub.field_id',$value['field_sgsub_id']);
			$this->db->limit(1);
			$data_docno = $this->db->get()->result_array()[0];

			$field_detail = 'ไม่อนุมัติถอยปริ้น หมายเหตุ '.$data['comment'].' เลขที่เอกสาร '.$data_docno['field_docno'];

			$this->db->set('field_sign_id',$data_docno['field_id']);
			$this->db->set('field_detail',$field_detail);
			$this->db->set('field_status',5);
			$this->db->set('field_createdate',$date_today);
			$this->db->set('field_creator',$_SESSION['saeree_employee']);
			$this->db->insert('tb_signv2_timeline');
			// 
		}

		$this->db->set('field_confirm_comment',$data['comment']);
		$this->db->set('field_confirm_status',2);
		$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
		$this->db->set('field_confirm_date',$date_today);
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signv2_request');
		
		echo json_encode($data);
	}

	public function confirm_backtoedit(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;
		$date_today = date('Y-m-d H:i:s');

		$this->db->select('
		tb_signv2_request_sub.field_sg_id,
		tb_signv2_sub.field_sign_id,
		tb_signv2_request_sub.field_id as field_request_id
		');
		$this->db->from('tb_signv2_request_sub');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_id = tb_signv2_request_sub.field_sgsub_id','left');
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_sub.field_sign_id','left');
		$this->db->where('field_request_id',$data['field_id']);
		$data['request_sub'] = $this->db->get()->result_array();

		foreach ($data['request_sub'] as $key => $value) {
			$this->db->set('field_confirm_status',0);
			$this->db->set('field_request_status',null);
			$this->db->set('field_comfirm_needdate',null);
			$this->db->set('field_comfirm_comment',null);
			$this->db->set('field_confirm_person',null);
			$this->db->set('field_confirmdate',null);
			$this->db->set('field_packing_status',0);
			$this->db->set('field_packing_person',null);
			$this->db->set('field_packingdate',null);
			$this->db->set('field_recieve_status',0);
			$this->db->set('field_recieve_toperson',null);
			$this->db->set('field_recievedate',null);
			$this->db->set('field_recieve_comment',null);
			$this->db->set('field_setup_status',0);
			$this->db->set('field_setup_person',null);
			$this->db->set('field_setupdate',null);
			$this->db->set('field_setup_comment',null);
			$this->db->set('field_recheck_status',0);
			$this->db->set('field_recheck_comment',null);
			$this->db->set('field_recheck_person',null);
			$this->db->set('field_recheckdate',null);
			$this->db->set('field_destroy_comment',null);
			$this->db->set('field_destroy_date',null);
			$this->db->set('field_destroy_status',0);
			$this->db->set('field_destroy_person_save',null);
			$this->db->set('field_do_yourself',0);
			$this->db->set('print_person',null);
			$this->db->set('print_datetime',null);
			$this->db->set('field_recieve_success',null);
			$this->db->set('field_recieve_success_person',null);
			$this->db->set('field_recieve_success_date',null);
			$this->db->set('field_upload_status',0);

			$this->db->where('field_id',$value['field_sg_id']);
			$this->db->update('tb_signv2');

			$this->db->select('*');
			$this->db->from('tb_signv2_preparedestroy');
			$this->db->where('field_sign_id',$value['field_sg_id']);
			$data['preparedestroy'] = $this->db->get()->result_array();

			foreach ($data['preparedestroy'] as $key => $value2) {
				$this->db->set('field_status_destroy',null);
				$this->db->where('field_old_id',$value2['field_destroy_id']);
				$this->db->update('tb_sign_old_new');
			}

			$this->db->where('field_sign_id',$value2['field_sg_id']);
			$this->db->delete('tb_signv2_preparedestroy');

			// timeline
			$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself');
			$this->db->from('tb_signv2');
			$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
			$this->db->where('tb_signv2.field_id',$value['field_sg_id']);
			$this->db->limit(1);
			$data_docno = $this->db->get()->result_array()[0];

			$field_detail = 'อนุมัติถอยเอกสาร หมายเหตุ '.$data['comment'].' เลขที่เอกสาร '.$data_docno['field_docno'];

			$this->db->set('field_sign_id',$data_docno['field_id']);
			$this->db->set('field_detail',$field_detail);
			$this->db->set('field_status',1);
			$this->db->set('field_createdate',$date_today);
			$this->db->set('field_creator',$_SESSION['saeree_employee']);
			$this->db->insert('tb_signv2_timeline');
			// 
		}

		$this->db->set('field_confirm_comment',$data['comment']);
		$this->db->set('field_confirm_status',1);
		$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
		$this->db->set('field_confirm_date',$date_today);
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signv2_request');
		
		echo json_encode($data);
	}

	public function update_change_status_destroy(){
		$this->db = $this->load->database('default', TRUE);
		$this->db->set('field_status','1');
		$this->db->where('field_id',$_POST['field_id']);
		$this->db->update('tb_sign_destroy_list');
		
		echo json_encode($data);
	}

	public function update_cancel_destroy(){
		$this->db = $this->load->database('default', TRUE);

		$this->db->select('*');
		$this->db->from('tb_sign_destroy_list');
		$this->db->like('field_docno','DT');
		$this->db->where('field_itemcode',$data['field_itemcode']);
		$this->db->limit(1);
		$this->db->order_by('field_id','DESC');
		$data['sg_destroy_main'] = $this->db->get()->result_array()[0];

		$this->db->select('*');
		$this->db->from('tb_sign_destroy_sub');
		$this->db->where('field_destroy_id',$data['sg_destroy_main']['field_id']);
		$data['sg_destroy_sub'] = $this->db->get()->result_array();

		foreach ($data['sg_destroy_sub'] as $val) {

			$this->db->set('field_place_id',$val['field_place_id']);
			$this->db->set('field_type_sign_price',$val['field_type_sign_price']);
			$this->db->set('sign_size',$val['sign_size']);
			$this->db->set('field_item_code',$data['sg_main']['field_itemcode']);
			$this->db->set('field_sg_docno',$data['sg_main']['field_docno']);
			$this->db->insert('tb_sign_old_new');
		}
		
		echo json_encode($data);
	}

	public function cancel_backtoedit(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;
		$date_today = date('Y-m-d H:i:s');

		$this->db->select('
		tb_signv2_request_sub.field_sg_id,
		tb_signv2_sub.field_sign_id,
		tb_signv2_request_sub.field_id as field_request_id
		');
		$this->db->from('tb_signv2_request_sub');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_id = tb_signv2_request_sub.field_sgsub_id','left');
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_sub.field_sign_id','left');
		$this->db->where('field_request_id',$data['field_id']);
		$data['request_sub'] = $this->db->get()->result_array();

		foreach ($data['request_sub'] as $key => $value) {
			$this->db->set('field_request_status',null);
			$this->db->where('field_id',$value['field_sg_id']);
			$this->db->update('tb_signv2');

			// timeline
			$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself');
			$this->db->from('tb_signv2');
			$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
			$this->db->where('tb_signv2.field_id',$value['field_sg_id']);
			$this->db->limit(1);
			$data_docno = $this->db->get()->result_array()[0];

			$field_detail = 'ไม่อนุมัติถอยเอกสาร หมายเหตุ '.$data['comment'].' เลขที่เอกสาร '.$data_docno['field_docno'];

			$this->db->set('field_sign_id',$data_docno['field_id']);
			$this->db->set('field_detail',$field_detail);
			$this->db->set('field_status',5);
			$this->db->set('field_createdate',$date_today);
			$this->db->set('field_creator',$_SESSION['saeree_employee']);
			$this->db->insert('tb_signv2_timeline');
			// 
		}

		$this->db->set('field_confirm_comment',$data['comment']);
		$this->db->set('field_confirm_status',2);
		$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
		$this->db->set('field_confirm_date',$date_today);
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signv2_request');
		
		echo json_encode($data);
	}


	public function confirm_reloaddata(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;
		$date_today = date('Y-m-d H:i:s');

		$this->db->select('
		tb_signv2_request_sub.field_sgsub_id,
		tb_signv2_sub.field_sign_id,
		tb_signv2_request_sub.field_id as field_request_id
		');
		$this->db->from('tb_signv2_request_sub');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_id = tb_signv2_request_sub.field_sgsub_id','left');
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_sub.field_sign_id','left');
		$this->db->where('field_request_id',$data['field_id']);
		$data['request_sub'] = $this->db->get()->result_array();

		foreach ($data['request_sub'] as $key => $value) {
			$this->db->set('field_load_data','0');
			$this->db->set('field_request_status',null);
			$this->db->where('field_id',$value['field_sgsub_id']);
			$this->db->update('tb_signv2_sub');

			// timeline
			$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself');
			$this->db->from('tb_signv2');
			$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
			$this->db->where('tb_signv2_sub.field_id',$value['field_sgsub_id']);
			$this->db->limit(1);
			$data_docno = $this->db->get()->result_array()[0];

			$field_detail = 'อนุมัติถอยดึงข้อมูล หมายเหตุ '.$data['comment'].' เลขที่เอกสาร '.$data_docno['field_docno'];

			$this->db->set('field_sign_id',$data_docno['field_id']);
			$this->db->set('field_detail',$field_detail);
			$this->db->set('field_status',1);
			$this->db->set('field_createdate',$date_today);
			$this->db->set('field_creator',$_SESSION['saeree_employee']);
			$this->db->insert('tb_signv2_timeline');
			// 
		}

		$this->db->set('field_confirm_comment',$data['comment']);
		$this->db->set('field_confirm_status',1);
		$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
		$this->db->set('field_confirm_date',$date_today);
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signv2_request');
		
		echo json_encode($data);
	}

	public function cancel_reloaddata(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;
		$date_today = date('Y-m-d H:i:s');

		$this->db->select('
		tb_signv2_request_sub.field_sgsub_id,
		tb_signv2_sub.field_sign_id,
		tb_signv2_request_sub.field_id as field_request_id
		');
		$this->db->from('tb_signv2_request_sub');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_id = tb_signv2_request_sub.field_sgsub_id','left');
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_sub.field_sign_id','left');
		$this->db->where('field_request_id',$data['field_id']);
		$data['request_sub'] = $this->db->get()->result_array();

		foreach ($data['request_sub'] as $key => $value) {
			$this->db->set('field_request_status',null);
			$this->db->where('field_id',$value['field_sgsub_id']);
			$this->db->update('tb_signv2_sub');

			// timeline
			$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself');
			$this->db->from('tb_signv2');
			$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
			$this->db->where('tb_signv2_sub.field_id',$value['field_sgsub_id']);
			$this->db->limit(1);
			$data_docno = $this->db->get()->result_array()[0];

			$field_detail = 'ไม่อนุมัติถอยดึงข้อมูล หมายเหตุ '.$data['comment'].' เลขที่เอกสาร '.$data_docno['field_docno'];

			$this->db->set('field_sign_id',$data_docno['field_id']);
			$this->db->set('field_detail',$field_detail);
			$this->db->set('field_status',5);
			$this->db->set('field_createdate',$date_today);
			$this->db->set('field_creator',$_SESSION['saeree_employee']);
			$this->db->insert('tb_signv2_timeline');
			// 
		}

		$this->db->set('field_confirm_comment',$data['comment']);
		$this->db->set('field_confirm_status',2);
		$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
		$this->db->set('field_confirm_date',$date_today);
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signv2_request');
		
		echo json_encode($data);
	}

	public function get_create_docno_1_model(
		$name_table,
		$name_field_id,
		$name_field_date,
		$name_field_docno,
		$name_title
	)
	{

		$this->db = $this->load->database('default', TRUE);

		$this->db->select($name_field_docno);
		$this->db->from($name_table);
		$this->db->where('DATE('.$name_field_date.')',date('Y-m-d'));
		$this->db->where($name_field_docno . ' is NOT NULL', NULL, FALSE);
		$this->db->order_by($name_field_id,'DESC');
		$this->db->limit(1);
		$check_docno = $this->db->get()->result_array();

		if(count($check_docno) >= 1 ){

			$check_docno[0][$name_field_docno];
			$substr_docno = substr($check_docno[0][$name_field_docno],10,5) + 1;
			$data = $name_title . date('Ymd'). sprintf("%04s",$substr_docno);

		}else if(count($check_docno) == 0) {
			$data = $name_title . date('Ymd'). '0001';
		}
		
		return $data;

	}

	public function get_create_docno_2_model(
		$name_table,
		$name_field_id,
		$name_field_date,
		$name_field_docno,
		$name_title
	)
	{

		$this->db = $this->load->database('default', TRUE);

		$this->db->select($name_field_docno);
		$this->db->from($name_table);
		$this->db->where('DATE('.$name_field_date.')',date('Y-m-d'));
		$this->db->where($name_field_docno . ' is NOT NULL', NULL, FALSE);
		$this->db->like($name_field_docno,'DT');
		$this->db->order_by($name_field_id,'DESC');
		$this->db->limit(1);
		$check_docno = $this->db->get()->result_array();

		if(count($check_docno) >= 1 ){

			$check_docno[0][$name_field_docno];
			$substr_docno = substr($check_docno[0][$name_field_docno],10,5) + 1;
			$data = $name_title . date('Ymd'). sprintf("%04s",$substr_docno);

		}else if(count($check_docno) == 0) {
			$data = $name_title . date('Ymd'). '0001';
		}
		
		return $data;

	}

	public function get_create_docno_destroy_model(
		$name_table,
		$name_field_id,
		$name_field_date,
		$name_field_docno,
		$name_title
	)
	{

		$this->db = $this->load->database('default', TRUE);

		$this->db->select($name_field_docno);
		$this->db->from($name_table);
		$this->db->where('DATE('.$name_field_date.')',date('Y-m-d'));
		$this->db->like($name_field_docno,$name_title);
		$this->db->where($name_field_docno . ' is NOT NULL', NULL, FALSE);
		$this->db->order_by($name_field_id,'DESC');
		$this->db->limit(1);
		$check_docno = $this->db->get()->result_array();

		if(count($check_docno) >= 1 ){

			$check_docno[0][$name_field_docno];
			$substr_docno = substr($check_docno[0][$name_field_docno],10,5) + 1;
			$data = $name_title . date('Ymd'). sprintf("%04s",$substr_docno);

		}else if(count($check_docno) == 0) {
			$data = $name_title . date('Ymd'). '0001';
		}
		
		return $data;

	}

	public function save_model(){
		$this->db = $this->load->database('default', TRUE);
		date_default_timezone_set('Asia/Bangkok');
		$data = $_REQUEST;

		$date_today = date('Y-m-d H:i:s');

		foreach($data['tb_addsign'] as $row1){
			if($row1['Code'] == '' ){
			}else{
				$name_table = 'tb_signv2';
				$name_field_id = 'field_id';
				$name_field_date = 'field_createdate';
				$name_field_docno = 'field_docno';
				$name_title  = 'SG';
				$data_docno = $this->get_create_docno_1_model(
					$name_table,
					$name_field_id,
					$name_field_date,
					$name_field_docno,
					$name_title
				);

				$this->db->set('field_docno',$data_docno);
				$this->db->set('field_purchase_comment',$row1['purchase_comment']);
				$this->db->set('field_itemcode',$row1['Code']);
				$this->db->set('field_groupcode',$row1['GroupCode']);
				$this->db->set('field_type',$row1['sign_type']);
				$this->db->set('field_itemname',$row1['Name1']);
				$this->db->set('field_change_date',$row1['date_change']);
				$this->db->set('field_createdate',$date_today);
				$this->db->set('field_creator',$row1['sign_creator']);

				if ($row1['sign_type'] == 6 || $row1['sign_type'] == 7 || $row1['sign_type'] == 8) {
				 	$this->db->set('field_confirm_status','3');
				}
				// $this->db->set('field_confirm_status','0');
				// $this->db->set('field_confirm_return','0');
				$this->db->insert('tb_signv2');
				$rent_no = $this->db->insert_id();
				

				$field_detail = 'จัดซื้อ เพิ่ม เลขที่เอกสาร '.$data_docno.' หมายเหตุ '.$row1['purchase_comment'];

				$this->db->set('field_sign_id',$rent_no);
				$this->db->set('field_detail',$field_detail);
				$this->db->set('field_status',1);
				$this->db->set('field_createdate',$date_today);
				$this->db->set('field_creator',$_SESSION['saeree_employee']);
				$this->db->insert('tb_signv2_timeline');
			}
		}

		foreach ($data['tb_addsign_sub'] as $row2){
			$this->db->select('field_id');
			$this->db->from('tb_signv2');
			$this->db->where('field_itemcode',$row2['Code']);
			$this->db->order_by('field_id','DESC');
			$this->db->limit(1);
			$sign_id = $this->db->get()->result_array();

			$this->db->set('field_itemcode',$row2['Code']);
			$this->db->set('field_itemname',$row2['Name1']);
			$this->db->set('field_groupcode',$row2['GroupCode']);
			$this->db->set('field_price1',$row2['SalePrice1']);
			$this->db->set('field_new_price1',$row2['Oldprice']);
			$this->db->set('field_old_price1',$row2['SalePrice1']);
			$this->db->set('field_sign_id',$sign_id[0]['field_id']);
			$this->db->insert('tb_signv2_sub');
		}

		// $this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('saereePeeps','เพิ่ม : ใบสั่งผลิต / สั่งซ่อม','".$_SESSION['saeree_name']." เพิ่ม : ใบสั่งผลิต / สั่งซ่อม เลขที่ ".$Docno." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
		echo json_encode($data);

	}

	public function save_step_model(){
		$this->db = $this->load->database('skpeople', TRUE);
		date_default_timezone_set('Asia/Bangkok');
		$data = $_REQUEST;

		$date_today = date('Y-m-d H:i:s');

		foreach($data['tb_addsign'] as $row1){
			if($row1['Code'] == '' ){
			}else{
				$name_table = 'tb_signv2';
				$name_field_id = 'field_id';
				$name_field_date = 'field_createdate';
				$name_field_docno = 'field_docno';
				$name_title  = 'SG';
				$data_docno = $this->get_create_docno_1_model(
					$name_table,
					$name_field_id,
					$name_field_date,
					$name_field_docno,
					$name_title
				);

				$this->db->set('field_docno',$data_docno);
				$this->db->set('field_purchase_comment',$row1['purchase_comment']); 
				$this->db->set('field_itemcode',$row1['Code']);
				$this->db->set('field_groupcode',$row1['GroupCode']);
				$this->db->set('field_type',$row1['sign_type']);
				$this->db->set('field_itemname',$row1['Name1']);
				$this->db->set('field_change_date',$row1['date_change']);
				$this->db->set('field_createdate',$date_today);
				$this->db->set('field_creator',$row1['sign_creator']);
				if ($row1['sign_type'] == 6 || $row1['sign_type'] == 7 || $row1['sign_type'] == 8) {
					$this->db->set('field_confirm_status','3');
				}
				// $this->db->set('field_confirm_status','0');
				// $this->db->set('field_confirm_return','0');
				$this->db->insert('tb_signv2');
				$rent_no = $this->db->insert_id();

				$field_detail = 'จัดซื้อ เพิ่ม เลขที่เอกสาร '.$data_docno.' หมายเหตุ '.$row1['purchase_comment'];

				$this->db->set('field_sign_id',$rent_no);
				$this->db->set('field_detail',$field_detail);
				$this->db->set('field_status',1);
				$this->db->set('field_createdate',$date_today);
				$this->db->set('field_creator',$_SESSION['saeree_employee']);
				$this->db->insert('tb_signv2_timeline');

				$data['row1'][] = $data_docno;
			}
		}

		foreach ($data['tb_addsign_sub'] as $row2){
			$this->db->select('field_id');
			$this->db->from('tb_signv2');
			$this->db->where('field_itemcode',$row2['Code']);
			$this->db->order_by('field_id','DESC');
			$this->db->limit(1);
			$sign_id = $this->db->get()->result_array();

			$this->db->set('field_itemcode',$row2['Code']);
			$this->db->set('field_itemname',$row2['Name1']);
			$this->db->set('field_groupcode',$row2['GroupCode']);
			$i = 1;
			foreach ($data['tb_addsign_sub'] as $val) {
				$this->db->set('field_price'.$i,$val['SalePrice1']);
				$this->db->set('field_new_price'.$i,$val['Oldprice']);
				$this->db->set('field_old_price'.$i,$val['SalePrice1']);
				$i++;
			}
			
			$this->db->set('field_sign_id',$sign_id[0]['field_id']);
			$this->db->insert('tb_signv2_sub');
		}

		// $this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('saereePeeps','เพิ่ม : ใบสั่งผลิต / สั่งซ่อม','".$_SESSION['saeree_name']." เพิ่ม : ใบสั่งผลิต / สั่งซ่อม เลขที่ ".$Docno." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
		echo json_encode($data);

	}


	public function insert_place(){
		$this->db = $this->load->database('default', TRUE);
		$date_today = date('Y-m-d H:i:s');

		$this->db->set('field_create_date',$date_today);
		$this->db->set('field_place_name',$_POST['place_name']);
		$this->db->set('field_item_code',$_POST['itemcode']);
		$this->db->set('field_create_person',$_SESSION['saeree_employee']);
		$this->db->insert('tb_sign_place');
		echo json_encode('success');
	}
	

	public function get_groupcode_model(){
		$this->db = $this->load->database('shsps_2022', TRUE);
		$this->db->select('code,name_1');
		$this->db->from('ic_group');
		$this->db->order_by('code');
		$data['groupcode'] = $this->db->get()->result_array();
		echo json_encode($data);
	}

	public function get_sign_model(){
		$this->db = $this->load->database('default', TRUE);
		$usersPerPage = $_POST['usersPerPage'];
		$pageNumber = $_POST['pageNumber'] * $usersPerPage;		
		$search_text = $_POST['search_text'];
		$search_groupcode = $_POST['search_groupcode'];
		$search_status = $_POST['search_status'];

		$this->db->select('
		tb_sign.*,
		tb_signsub.field_itemname,
		employee.firstname as creator_firstname,
		employee.nickname as creator_lastname,
		cf.firstname as confirm_firstname,
		cf.nickname as confirm_nickname,
		pk.firstname as packing_firstname,
		pk.nickname as packing_nickname');
		$this->db->from('tb_sign');
		$this->db->join('tb_signsub','tb_signsub.field_sign_id = tb_sign.field_id','right');
		// $this->db->join('employee','employee.id = tb_sign.field_creator','left');
		// $this->db->join('employee cf','cf.id = tb_sign.field_confirm_person','left');
		// $this->db->join('employee pk','pk.id = tb_sign.field_packing_person','left');
		
		// if($search_text != ''){
		// 	$this->db->group_start();
		// 	$this->db->like('tb_sign.field_docno',$search_text, 'both');
		// 	$this->db->or_like('tb_sign.field_itemcode',$search_text, 'both');
		// 	$this->db->or_like('tb_sign.field_itemname',$search_text, 'both');
		// 	$this->db->group_end();
		// }

		// if($search_groupcode != ''){
		// 	$this->db->where('tb_sign.field_groupcode',$search_groupcode);
		// }

		// if($search_type != ''){
		// 	$this->db->where('tb_sign.field_type',$search_type);
		// }

		// if($search_status != ''){
		// 	$this->db->where('tb_sign.field_confirm_status',$search_status);
		// }
		
		$this->db->group_by('tb_sign.field_id');    
		$this->db->limit($usersPerPage,$pageNumber);
		$this->db->order_by('tb_sign.field_confirm_status','ASC');
		$data['Sign'] = $this->db->get()->result_array();	

		$this->db->select('count(*) as count');
		$this->db->from('tb_sign');
		$this->db->join('tb_signsub','tb_signsub.field_sign_id = tb_sign.field_id','right');
		$this->db->join('employee','employee.id = tb_sign.field_creator','left');
		$this->db->join('employee cf','cf.id = tb_sign.field_confirm_person','left');
		$this->db->join('employee pk','pk.id = tb_sign.field_packing_person','left');
		
		if($search_text != ''){
			$this->db->group_start();
			$this->db->like('tb_sign.field_docno',$search_text, 'both');
			$this->db->or_like('tb_sign.field_itemcode',$search_text, 'both');
			$this->db->or_like('tb_sign.field_itemname',$search_text, 'both');
			$this->db->group_end();
		}

		if($search_groupcode != ''){
			$this->db->where('tb_sign.field_groupcode',$search_groupcode);
		}

		if($search_type != ''){
			$this->db->where('tb_sign.field_type',$search_type);
		}

		if($search_status != ''){
			$this->db->where('tb_sign.field_confirm_status',$search_status);
		}

		$this->db->order_by('tb_sign.field_confirm_status','ASC');
		$data['Total_Sign'] = $this->db->get()->result_array()[0]['count'];
		echo json_encode($data);

    }

	public function get_signdata_bydocno(){
		$this->db = $this->load->database('default', TRUE);

		$_data = $_REQUEST;

		$this->db->select('
			tb_signv2_sub.*,
			tb_sign_type_price.type_name_price,
			tb_sign_size.size_name,
			tb_sign_place.field_place_name
		');
		$this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_signv2_sub.field_signplace','left');
		$this->db->where('tb_signv2.field_docno',$_data['field_docno']);
		$this->db->where('tb_signv2.field_recheck_status !=',2);
		$this->db->where('tb_signv2.field_active_status',1);
		$data['Sign_sub'] = $this->db->get()->result_array();

		echo json_encode($data);
	}

	public function get_signandsignsub(){
		$this->db = $this->load->database('default', TRUE);

		$_data = $_REQUEST;

		$this->db->select('
			tb_signv2.*,
			tb_sign_cause.type_name as type_name,
			employee.firstname as creator_firstname,
			employee.nickname as creator_lastname,
			cf.firstname as confirm_firstname,
			cf.nickname as confirm_nickname,
			pk.firstname as packing_firstname,
			pk.nickname as packing_nickname,
			set.firstname as setup_firstname,
			set.nickname as setup_nickname,
			rck.firstname as recheck_firstname,
			rck.nickname as recheck_nickname,
			rc.firstname as recieve_firstname,
			rc.nickname as recieve_nickname,
			rcc.firstname as recievesuccess_firstname,
			rcc.nickname as recievesuccess_nickname,
			ed.firstname as edit_firstname,
			ed.nickname as edit_nickname,
			pt.firstname as print_firstname,
			pt.nickname as print_nickname,
			dt.firstname as destroy_firstname,
			dt.nickname as destroy_nickname
		');
		$this->db->from('tb_signv2');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_signv2.field_type');	
		$this->db->join('employee','employee.id = tb_signv2.field_creator','left');
		$this->db->join('employee cf','cf.id = tb_signv2.field_confirm_person','left');
		$this->db->join('employee pk','pk.id = tb_signv2.field_packing_person','left');
		$this->db->join('employee set','set.id = tb_signv2.field_setup_person','left');
		$this->db->join('employee rck','rck.id = tb_signv2.field_recheck_person','left');
		$this->db->join('employee rc','rc.id = tb_signv2.field_recieve_person','left');
		$this->db->join('employee rcc','rcc.id = tb_signv2.field_recieve_success_person','left');
		$this->db->join('employee ed','ed.id = tb_signv2.field_edit_person','left');
		$this->db->join('employee pt','pt.id = tb_signv2.print_person','left');
		$this->db->join('employee dt','dt.id = tb_signv2.field_destroy_person_save','left');
		$this->db->where('tb_signv2.field_id',$_data['field_id']);
		$data['Sign'] = $this->db->get()->result_array()[0];

		$this->db->select('
			tb_signv2_sub.*,
			set.firstname as setup_firstname,
			set.nickname as setup_nickname,
			pk.firstname as packing_firstname,
			pk.nickname as packing_nickname,
			tb_sign_type_price.type_name_price,
			tb_sign_size.size_name,
			tb_sign_place.field_place_name
		');
		$this->db->from('tb_signv2_sub');
		$this->db->join('employee set','set.id = tb_signv2_sub.field_setup_person','left');
		$this->db->join('employee pk','pk.id = tb_signv2_sub.field_pack_person','left');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_signv2_sub.field_signplace','left');
		$this->db->where('tb_signv2_sub.field_sign_id',$data['Sign']['field_id']);
		$data['Sign_sub'] = $this->db->get()->result_array();

		$this->db->select('*');
        $this->db->from('tb_sign_old_new');
		$this->db->join('tb_signv2_prepareDestroy','tb_signv2_prepareDestroy.field_destroy_id = tb_sign_old_new.field_old_id','left');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_sign_old_new.field_type_sign_price','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_sign_old_new.sign_size','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_sign_old_new.field_place_id','left');
		$this->db->where_in('tb_signv2_prepareDestroy.field_sign_id',$_data['field_id']);
        $data['signold_new'] = $this->db->get()->result_array();

		$this->db->select('*');
        $this->db->from('tb_signv2_prepareDestroy');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_prepareDestroy.field_type_sign_price','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_prepareDestroy.sign_size','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_signv2_prepareDestroy.field_place_id','left');
		$this->db->where_in('tb_signv2_prepareDestroy.field_sign_id',$_data['field_id']);
        $data['sign_prepare'] = $this->db->get()->result_array();

		$this->db->select('*');
        $this->db->from('part');
		$this->db->where_in('id',$data['Sign']['field_recieve_toperson']);
        $data['sign_part'] = $this->db->get()->result_array()[0];

		$this->db->select('*');
        $this->db->from('tb_sign_destroy_list');
		$this->db->where_in('field_sg_id',$data['Sign']['field_id']);
        $data['sign_destroy_list'] = $this->db->get()->result_array()[0];

		$this->db->select('*');
        $this->db->from('tb_sign_old_new');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_sign_old_new.field_type_sign_price','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_sign_old_new.sign_size','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_sign_old_new.field_place_id','left');
		$this->db->where('field_sg_docno',$data['Sign']['field_docno']);
        $data['sign_destroy_this_sg'] = $this->db->get()->result_array();

		echo json_encode($data);
	}

	public function get_signnodo_excel(){
		$this->db = $this->load->database('default', TRUE);

		$data = $_REQUEST;
		$this->db->select('
			tb_sign.field_itemcode,
		');
		$this->db->from('tb_sign');
		$this->db->where('field_groupcode','RC-BBB');
		$this->db->order_by('tb_sign.field_id','DESC');
		$this->db->group_by('field_itemcode');
		$data['Sign'] = $this->db->get()->result_array();	

		$this->db = $this->load->database('shsps_2022', TRUE);
		$this->db->select('
		BCITEM.Code,
		BCITEM.name1,
		BCITEM.GroupCode
		');
		$this->db->from('BCITEM');
		$this->db->where('ActiveStatus',1);
		$this->db->where('StockQty >',0);
		$this->db->where('GroupCode','RC-BBB');
		$data['BCITEM'] = $this->db->get()->result_array();

		foreach ($data['BCITEM'] as $key => $value) {
			foreach ($data['Sign'] as  $val) {
				if ($value['Code'] == $val['field_itemcode']) {
					$ItemCode[] = $value['Code'];
				}
			}
		}

		$this->db = $this->load->database('shsps_2022', TRUE);


		$uid_list = array_chunk($ItemCode,20); // ใช้คำสั่ง array_chunk แบ่ง array เป็น 2 มิติ และมิติละ 2 แถว
		$query_string = '';
		$last_loop = count($uid_list); // หา loop รอบสุดท้าย
		$start_loop = 0;
		foreach($uid_list as $uids)
		{
			$start_loop++;
			$uids = implode("','",$uids);
			if($start_loop == $last_loop){ // loop รอบสุดท้ายไม่ต้องมี OR
				$query_string .= " Code IN('".$uids."')";
			}else{
				$query_string .= " Code IN('".$uids."') OR";
			}
		}
		$query = $this->db->query("SELECT Code,name1,GroupCode FROM BCITEM WHERE ActiveStatus = '1' AND StockQty > 0 AND GroupCode = 'RC-BBB' AND NOT (".$query_string.")");
		$data['process'] = $query->result_array();
		
		echo json_encode($data);
    }

	public function all_sign(){
		$this->db = $this->load->database('default', TRUE);

		$data = $_REQUEST;

		$usersPerPage = $data['usersPerPage'];
		$pageNumber = $data['pageNumber'] * $usersPerPage;		
		$search_text = $data['search_text'];
		$search_groupcode = $data['search_groupcode'];
		$search_type = $data['search_type'];
		$search_status = $data['search_status'];
		$search_status_packing = $data['search_status_packing'];
		$search_status_setup = $data['search_status_setup'];
		$search_status_destroy = $data['search_status_destroy'];
		$search_status_check = $data['search_status_check'];
		$search_status_loaddata = $data['search_status_loaddata'];
		$search_status_active = $data['search_status_active'];

		$this->db->select('
			tb_signv2.field_active_status,
			tb_signv2.field_upload_status,
			tb_signv2.field_docno,
			tb_signv2.field_itemcode,
			tb_signv2.field_itemname,
			tb_signv2.field_confirm_status,
			tb_signv2.field_packing_status,
			tb_signv2.field_recieve_status,
			tb_signv2.field_setup_status,
			tb_signv2.field_recheck_status,
			tb_signv2.field_packingdate,
			tb_signv2.field_recievedate,
			tb_signv2.field_recieve_success,
			tb_signv2.field_destroy_status as status_destroy,
			tb_signv2.field_id as sign_id,
			tb_signv2.field_do_yourself as field_do_yourself,
			tb_signv2.field_request_status,
			tb_signv2.field_setupdate,
			tb_signv2.field_upload_date,
			employee.firstname,
			employee.lastname,
			employee.nickname,
			tb_sign_cause.type_name
		');
		$this->db->from('tb_signv2');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_signv2.field_type','left');
		$this->db->join('employee','employee.id = tb_signv2.field_setup_person','left');

		if ($search_text != '') {
			$this->db->group_start();
			$this->db->like('tb_signv2.field_docno',$search_text,'both');
			$this->db->or_like('tb_signv2.field_itemname',$search_text, 'both');
			$this->db->or_like('tb_signv2.field_itemcode',$search_text, 'both');
			
			$this->db->group_end();
		}
		if($search_groupcode != ''){
			$this->db->where('tb_signv2.field_groupcode',$search_groupcode);
		}
		if($search_status != ''){
			$this->db->where('tb_signv2.field_confirm_status',$search_status);
		}
		if($search_status_packing != ''){
			$this->db->where('tb_signv2.field_packing_status',$search_status_packing);
			$this->db->where('tb_signv2.field_confirm_status !=','2');
		}
		if($search_status_setup != ''){
			$this->db->where('tb_signv2.field_confirm_status','1');
			$this->db->where('tb_signv2.field_setup_status',$search_status_setup);
			$this->db->where('tb_signv2.field_packing_status','2');
		}
		if($search_type != ''){
			$this->db->where('tb_signv2.field_type',$search_type);
		}
		if($search_status_destroy != ''){
			$this->db->where('tb_signv2.field_destroy_status',$search_status_destroy);
			$this->db->where('tb_signv2.field_confirm_status !=','2');
		}
		if($search_status_check != ''){
			$this->db->where('tb_signv2.field_recheck_status',$search_status_check);
			$this->db->where('tb_signv2.field_confirm_status !=','2');
			$this->db->where('tb_signv2.field_packing_status','2');
			$this->db->where('tb_signv2.field_setup_status','2');
		}
		if($search_status_loaddata != ''){
			$this->db->where('tb_signv2.field_packing_status','0');
			$this->db->where('tb_signv2.field_confirm_status','1');
		}
		if($search_status_active != ''){
			$this->db->where('tb_signv2.field_active_status',$search_status_active);
		}

		$this->db->group_by('tb_signv2.field_id');
		$this->db->order_by('tb_signv2.field_id','DESC');
		$this->db->limit($usersPerPage,$pageNumber);
	
		$data['Sign'] = $this->db->get()->result_array();	

		// $data['sql'] = $this->db->last_query();

		$this->db->select("
			tb_signv2.field_docno,
			tb_signv2.field_itemcode,
			tb_signv2.field_confirm_status,
			tb_signv2.field_packing_status,
			tb_signv2.field_recieve_status,
			tb_signv2.field_setup_status,
			tb_signv2.field_recheck_status,
			tb_signv2.field_packingdate,
			tb_signv2.field_recievedate,
			tb_signv2.field_destroy_status as status_destroy,
			tb_signv2.field_id as sign_id,
			tb_sign_cause.type_name
		");
		$this->db->from('tb_signv2');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_signv2.field_type','left');
		
		if ($search_text != '') {
			$this->db->group_start();
			$this->db->like('tb_signv2.field_docno',$search_text,'both');
			$this->db->or_like('tb_signv2.field_itemname',$search_text, 'both');
			$this->db->or_like('tb_signv2.field_itemcode',$search_text, 'both');
			
			$this->db->group_end();
		}
		if($search_groupcode != ''){
			$this->db->where('tb_signv2.field_groupcode',$search_groupcode);
		}
		if($search_status != ''){
			$this->db->where('tb_signv2.field_confirm_status',$search_status);
		}
		if($search_status_packing != ''){
			$this->db->where('tb_signv2.field_packing_status',$search_status_packing);
			$this->db->where('tb_signv2.field_confirm_status !=','2');
		}
		if($search_status_setup != ''){
			$this->db->where('tb_signv2.field_confirm_status','1');
			$this->db->where('tb_signv2.field_setup_status',$search_status_setup);
			$this->db->where('tb_signv2.field_packing_status','2');
		}
		if($search_type != ''){
			$this->db->where('tb_signv2.field_type',$search_type);
		}
		if($search_status_destroy != ''){
			$this->db->where('tb_signv2.field_destroy_status',$search_status_destroy);
			$this->db->where('tb_signv2.field_confirm_status !=','2');
		}
		if($search_status_check != ''){
			$this->db->where('tb_signv2.field_recheck_status',$search_status_check);
			$this->db->where('tb_signv2.field_confirm_status !=','2');
			$this->db->where('tb_signv2.field_packing_status','2');
			$this->db->where('tb_signv2.field_setup_status','2');
		}
		if($search_status_loaddata != ''){
			$this->db->where('tb_signv2.field_packing_status','0');
			$this->db->where('tb_signv2.field_confirm_status','1');
		}
		if($search_status_active != ''){
			$this->db->where('tb_signv2.field_active_status',$search_status_active);
		}

		$this->db->group_by('tb_signv2.field_id');
		$this->db->order_by('tb_signv2.field_id','DESC');
	
		$data_Total_Sign = $this->db->get()->result_array();	
		$data['Total_Sign'] = count($data_Total_Sign);	

		foreach ($data['Sign'] as $val) {
			$this->db->select('count(*) count');
			$this->db->from('tb_sign_old_new');
			$this->db->where('tb_sign_old_new.field_item_code',$val['field_itemcode']);
			$data['sign_old_count'][] = $this->db->get()->result_array();	
		}

		echo json_encode($data);

    }

	public function get_sign_place_old_list()
	{
		$this->db = $this->load->database('default', TRUE);
		$_data = $_REQUEST;

		$this->db->select('
			tb_sign_old.id,
			tb_sign_old.place,
			tb_sign_old.item_code,
			tb_sign_size.size_name,
			tb_sign.field_itemname
		');
		$this->db->from('tb_sign_old');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_sign_old.sign_size','left');
		$this->db->join('tb_sign','tb_sign.field_itemcode = tb_sign_old.item_code','left');
		$this->db->where('tb_sign_old.item_code',$_data['field_itemcode']);
		$this->db->where('tb_sign_old.status_sign','1');
		$this->db->group_by('			
			tb_sign_old.id,
			tb_sign_old.place,
			tb_sign_old.item_code
		');
		$data['sign_old'] = $this->db->get()->result_array();

		echo json_encode($data);
	}

	public function sign_list(){
		$this->db = $this->load->database('default', TRUE);

		$data = $_REQUEST;

		$usersPerPage = $data['usersPerPage'];
		$pageNumber = $data['pageNumber'] * $usersPerPage;		
		$search_text = $data['search_text'];
		$search_groupcode = $data['search_groupcode'];

		$this->db->select('
		tb_signv2.*,
		employee.nickname as creator_nickname,
		employee.firstname as creator_firstname,
		tb_sign_cause.type_name

		');
		$this->db->from('tb_signv2');
		$this->db->join('employee','employee.id = tb_signv2.field_creator','left');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_signv2.field_type','left');
		if ($search_text != '') {
			$this->db->group_start();
			$this->db->like('tb_signv2.field_docno',$search_text, 'both');
			$this->db->or_like('tb_signv2.field_itemname',$search_text, 'both');
			$this->db->or_like('tb_signv2.field_itemcode',$search_text, 'both');
			$this->db->or_like('employee.firstname',$search_text, 'both');
			$this->db->group_end();
		}
		if($search_groupcode != ''){
			$this->db->where('tb_signv2.field_groupcode',$search_groupcode);
		}

		$this->db->where('tb_signv2.field_confirm_status',$data['field_confirm_status']);

		$this->db->group_by('tb_signv2.field_id');
		$this->db->limit($usersPerPage,$pageNumber);
		// $this->db->join('tb_signsub','tb_signsub.field_sign_id = tb_sign.field_id','right');
		
		// $this->db->join('employee cf','cf.id = tb_sign.field_confirm_person','left');
		// $this->db->join('employee pk','pk.id = tb_sign.field_packing_person','left');
		$data['Sign'] = $this->db->get()->result_array();	

		$this->db->select('count(*) count');
		$this->db->from('tb_signv2');
		$this->db->join('employee','employee.id = tb_signv2.field_creator','left');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_signv2.field_type','left');
		if ($search_text != '') {
			$this->db->group_start();
			$this->db->like('tb_signv2.field_docno',$search_text, 'both');
			$this->db->or_like('tb_signv2.field_itemname',$search_text, 'both');
			$this->db->or_like('employee.firstname',$search_text, 'both');
			$this->db->group_end();
		}
		if($search_groupcode != ''){
			$this->db->where('tb_signv2.field_groupcode',$search_groupcode);
		}

		$this->db->where('tb_signv2.field_confirm_status',$data['field_confirm_status']);

		$data['Total_Sign'] = $this->db->get()->result_array()[0]['count'];

		echo json_encode($data);
    }

	public function get_destroy_list(){
		$this->db = $this->load->database('default', TRUE);

		$data = $_REQUEST;

		$field_id = $data['field_id'];

		$usersPerPage = $data['usersPerPage'];
		$pageNumber = $data['pageNumber'] * $usersPerPage;
		$search_text = $data['search_text'];
		$search_status = $data['search_status'];
		$search_recheck = $data['search_recheck'];
		
		$this->db->select('
		tb_sign_destroy_list.*,
		employee.nickname as creator_nickname,
		employee.firstname as creator_firstname,
		up.nickname as upload_nickname,
		up.firstname as upload_firstname,
		chk.nickname as check_nickname,
		chk.firstname as check_firstname
		');
		$this->db->from('tb_sign_destroy_list');
		$this->db->join('employee','employee.id = tb_sign_destroy_list.field_destroy_person','left');
		$this->db->join('employee up','up.id = tb_sign_destroy_list.field_upload_person','left');
		$this->db->join('employee chk','chk.id = tb_sign_destroy_list.field_recheck_person','left');
		if ($search_text != '') {
			$this->db->group_start();
			$this->db->like('tb_sign_destroy_list.field_docno',$search_text,'both');
			$this->db->or_like('tb_sign_destroy_list.field_itemname',$search_text, 'both');
			$this->db->or_like('tb_sign_destroy_list.field_itemcode',$search_text, 'both');
			$this->db->group_end();
		}
		if ($search_status != '') {
			$this->db->where('field_status',$search_status);
		}
		if ($search_recheck != '') {
			$this->db->where('field_recheck_status',$search_recheck);
		}
		$this->db->where('field_trash',0);
		$this->db->order_by('tb_sign_destroy_list.field_id','DESC');
		$this->db->limit($usersPerPage,$pageNumber);
		$data['destroy_list'] = $this->db->get()->result_array();

		$this->db->select('count(*) as count');
		$this->db->from('tb_sign_destroy_list');
		$this->db->join('employee','employee.id = tb_sign_destroy_list.field_destroy_person','left');
		if ($search_text != '') {
			$this->db->group_start();
			$this->db->like('tb_sign_destroy_list.field_docno',$search_text,'both');
			$this->db->or_like('tb_sign_destroy_list.field_itemname',$search_text, 'both');
			$this->db->or_like('tb_sign_destroy_list.field_itemcode',$search_text, 'both');
			$this->db->group_end();
		}
		if ($search_status != '') {
			$this->db->where('field_status',$search_status);
		}
		if ($search_recheck != '') {
			$this->db->where('field_recheck_status',$search_recheck);
		}
		$this->db->where('field_trash',0);
		$data['destroy_total'] = $this->db->get()->result_array()[0]['count'];

		echo json_encode($data);

    }

	public function select_confirm_detail(){
		$this->db = $this->load->database('default', TRUE);

		$data = $_REQUEST;

		$field_id = $data['field_id'];

		$this->db->select('
		tb_signv2_sub.*,
		tb_sign_cause.type_name,
		tb_sign_cause.id
		');
		$this->db->from('tb_signv2_sub');
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_sub.field_sign_id');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_signv2.field_type');
		$this->db->where('field_sign_id',$field_id);
		// $this->db->join('tb_signsub','tb_signsub.field_sign_id = tb_sign.field_id','right');
		$data['tb_signv2_sub'] = $this->db->get()->result_array()[0];

		$this->db->select('
		tb_sign_place.field_place_name,
		tb_sign_size.size_name,
		tb_sign_type_price.type_name_price,
		tb_sign_old_new.sign_amount,
		tb_sign_old_new.field_old_id,
		tb_sign_old_new.field_type_sign_price,
		tb_sign_old_new.sign_size
		');
		$this->db->from('tb_sign_old_new');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_sign_old_new.field_type_sign_price','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_sign_old_new.sign_size','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_sign_old_new.field_place_id','left');
		$this->db->where('tb_sign_old_new.field_item_code',$data['tb_signv2_sub']['field_itemcode']);
		$this->db->where('tb_sign_old_new.field_status',0);
		$this->db->where('tb_sign_old_new.field_status_destroy',null);
		// $this->db->join('tb_signsub','tb_signsub.field_sign_id = tb_sign.field_id','right');
		$data['sign_old'] = $this->db->get()->result_array();

		if (count($data['tb_signv2_sub']) <= 0) {
			# code...
		}else{
			$this->db = $this->load->database('shsps_2022', TRUE);

			$this->db->select('
				ic_unit_use.ic_code,
				ic_unit_use.stand_value,
				ic_unit_use.code as unit_code,
				ic_inventory_price.sale_price2,
				ic_inventory.name_1
			');
			$this->db->from('ic_unit_use');
			$this->db->join('ic_inventory','ic_inventory.code = ic_unit_use.ic_code');
			$this->db->join('ic_inventory_price','ic_inventory_price.ic_code = ic_unit_use.ic_code','left');
			$this->db->where_in('ic_unit_use.ic_code',$data['tb_signv2_sub']['field_itemcode']);
			$this->db->order_by('ic_unit_use.stand_value','ASC');
			$this->db->order_by('ic_inventory_price.line_number','ASC');
			$data['ic_unit_use'] = $this->db->get()->result_array();
	
			$this->db->select('
			ic_inventory_price_formula.ic_code,
			ic_inventory_price_formula.price_0,
			ic_inventory_price_formula.unit_code
			');
			$this->db->from('ic_inventory_price_formula');
			$this->db->where_in('ic_inventory_price_formula.ic_code',$data['tb_signv2_sub']['field_itemcode']);
			$this->db->order_by('ic_inventory_price_formula.price_0','DESC');
			$data['ic_inventory_price'] = $this->db->get()->result_array();
		}

		echo json_encode($data);

    }

	public function active_sign()
	{
		$this->db = $this->load->database('default', TRUE);

		$this->db->select('
			tb_sign_place.field_place_name,
			tb_sign_size.size_name,
			tb_sign_type_price.type_name_price,
			tb_sign_old_new.sign_amount,
			tb_sign_old_new.field_old_id
		');
		$this->db->from('tb_sign_old_new');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_sign_old_new.field_type_sign_price','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_sign_old_new.sign_size','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_sign_old_new.field_place_id','left');
		$this->db->where('tb_sign_old_new.field_item_code',$_POST['item_code']);
		$this->db->where('tb_sign_old_new.field_status',0);
		$this->db->where('tb_sign_old_new.field_status_destroy',null);
		// $this->db->join('tb_signsub','tb_signsub.field_sign_id = tb_sign.field_id','right');
		$data['sign_old'] = $this->db->get()->result_array();
		
		echo json_encode($data);
	}

	public function get_view_model()
	{
		$this->db = $this->load->database('default', TRUE);
	}



	public function cause_Modal()
	{
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);


		$this->db->set('tb_sign.field_type',$data['cause']);
		$this->db->set('tb_sign.field_packing_status','0');
		$this->db->set('tb_sign.field_recheck_status','1');
		$this->db->where('tb_sign.field_id',$data['field_id']);
		$this->db->update('tb_sign');

		$this->db->set('field_pack_status',null);
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signv2_sub');
		
		echo json_encode($data);
	}

	public function request_sign()
	{
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);

		$id = explode("-",$data['id']);
		$date_today = date('Y-m-d H:i:s');

		$name_table = 'tb_signv2_request';
		$name_field_id = 'field_id';
		$name_field_date = 'field_request_date';
		$name_field_docno = 'field_docno';
		$name_title  = 'RQ';
		$data_docno = $this->get_create_docno_1_model(
			$name_table,
			$name_field_id,
			$name_field_date,
			$name_field_docno,
			$name_title
		);

		if ($data['comment_request'] != '') {
			# code...
			$this->db->set('field_docno',$data_docno);
			$this->db->set('field_request_type',$data['type_request']);
			$this->db->set('field_request_comment',$data['comment_request']);
			$this->db->set('field_request_person',$_SESSION['saeree_employee']);
			$this->db->set('field_request_date',$date_today);
			$this->db->insert('tb_signv2_request');
			$rent_no = $this->db->insert_id();


			if ($data['type_request'] == 1 || $data['type_request'] == 2) {
				foreach ($id as $id_sub) {
					if ($id_sub != 0 && $id_sub != '') {
						$this->db->set('field_request_status','1');
						$this->db->set('field_request_person',$_SESSION['saeree_employee']);
						$this->db->set('field_request_date',$date_today);
						$this->db->where('field_id',$id_sub);
						$this->db->update('tb_signv2_sub');
			
						$this->db->set('field_request_id',$rent_no);
						$this->db->set('field_sgsub_id',$id_sub);
						$this->db->insert('tb_signv2_request_sub');

						// timeline
						$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself');
						$this->db->from('tb_signv2');
						$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
						$this->db->where('tb_signv2_sub.field_id',$id_sub);
						$this->db->limit(1);
						$data_docno = $this->db->get()->result_array()[0];

						if ($data_docno['field_do_yourself'] == '0') {
							$field_detail = 'บรรจุภัณฑ์ '.$data['type_name'].' หมายเหตุ '.$data['comment_request'].' เลขที่เอกสาร '.$data_docno['field_docno'];
						}elseif ($data_docno['field_do_yourself'] == '1') {
							$field_detail = 'แผนก '.$data['type_name'].' หมายเหตุ '.$data['comment_request'].' เลขที่เอกสาร '.$data_docno['field_docno'];
						}

						$this->db->set('field_sign_id',$data_docno['field_id']);
						$this->db->set('field_detail',$field_detail);
						$this->db->set('field_status',6);
						$this->db->set('field_createdate',$date_today);
						$this->db->set('field_creator',$_SESSION['saeree_employee']);
						$this->db->insert('tb_signv2_timeline');
						// 
					}
				}
			}elseif ($data['type_request'] == 3) {
				$this->db->set('field_request_status','1');
				$this->db->set('field_request_person',$_SESSION['saeree_employee']);
				$this->db->set('field_request_date',$date_today);
				$this->db->where('field_id',$data['field_id']);
				$this->db->update('tb_signv2');

				$this->db->set('field_request_id',$rent_no);
				$this->db->set('field_sg_id',$data['field_id']);
				$this->db->insert('tb_signv2_request_sub');

				// timeline main
				$this->db->select('field_docno');
				$this->db->from('tb_signv2');
				$this->db->where('field_id',$data['field_id']);
				$this->db->limit(1);
				$data_docno = $this->db->get()->result_array()[0]['field_docno'];

				$field_detail = 'ขอถอยเอกสาร หมายเหตุ '.$data['comment_request'].' เลขที่เอกสาร '.$data_docno;
				$this->db->set('field_sign_id',$data['field_id']);
				$this->db->set('field_detail',$field_detail);
				$this->db->set('field_status',6);
				$this->db->set('field_createdate',$date_today);
				$this->db->set('field_creator',$_SESSION['saeree_employee']);
				$this->db->insert('tb_signv2_timeline');
				// 
			}
		}
		echo json_encode($data);
	}

	public function sign_request_list()
	{
		$this->db = $this->load->database('default', TRUE);
		$_data = $_POST;

		$data_permission = $this->permission_user_model();
		$CheckPrivilegeFunction = $this->Function_model->CheckPrivilegeFunction();
		

		$search_text = $_data['search_text'];
		$search_type = $_data['search_type'];
		$usersPerPage = $_data['usersPerPage'];
		$pageNumber = $_data['pageNumber'] * $usersPerPage;

		$this->db->select("
			tb_signv2_request.*,
			IFNULL(GROUP_CONCAT(
				CONCAT( tb_signv2_sub.field_itemcode )
				ORDER BY
				tb_signv2_sub.field_itemcode ASC
			), '') AS itemcode_sub ,
			IFNULL(GROUP_CONCAT(

				CONCAT( tb_signv2.field_docno )

				ORDER BY
				tb_signv2.field_docno ASC
			), '') AS sg_sub ,
			req.firstname as request_firstname,
			req.nickname as request_nickname,
			cf.firstname as confirm_firstname,
			cf.nickname as confirm_nickname
		");
  		$this->db->from('tb_signv2_request');
		$this->db->join('tb_signv2_request_sub','tb_signv2_request_sub.field_request_id = tb_signv2_request.field_id','left');	
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_id = tb_signv2_request_sub.field_sgsub_id','left');	
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_request_sub.field_sg_id','left');	
		$this->db->join('employee req','req.id = tb_signv2_request.field_request_person','left');	
		$this->db->join('employee cf','cf.id = tb_signv2_request.field_confirm_person','left');	
		$this->db->join('depart','depart.id = req.depart_id','left');	
		if($search_text != ''){
			$this->db->group_start();
			$this->db->like('tb_signv2_request.field_docno',$search_text, 'both');
			$this->db->or_like('req.firstname',$search_text, 'both');
			$this->db->or_like('req.nickname',$search_text, 'both');
			$this->db->or_like('tb_signv2_sub.field_itemcode',$search_text, 'both');
			$this->db->or_like('tb_signv2.field_docno',$search_text, 'both');
			$this->db->group_end();
		}
		if($search_type != ''){
			$this->db->where('tb_signv2_request.field_request_type',$search_type);
		}
		
		if (isset($CheckPrivilegeFunction['SignV2/sign_request_confirm']["SignV2/sign_request_confirm/Viewfordepart"])) {
			$this->db->where('depart.part_id',$data_permission[0]['part_id'], 'both');
		}
		$this->db->group_by("tb_signv2_request.field_id"); 
		$this->db->limit($usersPerPage,$pageNumber);
		$this->db->order_by('tb_signv2_request.field_confirm_status','ASC');
		$this->db->order_by('tb_signv2_request.field_id','DESC');
		$data['SignRequest'] = $this->db->get()->result_array();

		// 
		$this->db->select('count(*) count');
		$this->db->from('tb_signv2_request');
		$this->db->join('tb_signv2_request_sub','tb_signv2_request_sub.field_request_id = tb_signv2_request.field_id','left');	
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_id = tb_signv2_request_sub.field_sgsub_id','left');	
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_request_sub.field_sg_id','left');	
		$this->db->join('employee req','req.id = tb_signv2_request.field_request_person','left');	
		$this->db->join('employee cf','cf.id = tb_signv2_request.field_confirm_person','left');	
		$this->db->join('depart','depart.id = req.depart_id','left');	
		if($search_text != ''){
			$this->db->group_start();
			$this->db->like('tb_signv2_request.field_docno',$search_text, 'both');
			$this->db->or_like('req.firstname',$search_text, 'both');
			$this->db->or_like('req.nickname',$search_text, 'both');
			$this->db->or_like('tb_signv2_sub.field_itemcode',$search_text, 'both');
			$this->db->or_like('tb_signv2.field_docno',$search_text, 'both');
			$this->db->group_end();
		}
		if($search_type != ''){
			$this->db->where('tb_signv2_request.field_request_type',$search_type);
		}
		if (isset($CheckPrivilegeFunction['SignV2/sign_request_confirm']["SignV2/sign_request_confirm/Viewfordepart"])) {
			$this->db->where('depart.part_id',$data_permission[0]['part_id'], 'both');
		}
		$data['total_request'] = $this->db->get()->result_array()[0]['count'];
		echo json_encode($data);
	}

	public function list_request_sub()
	{
		$this->db = $this->load->database('default', TRUE);
		$_data = $_POST;

		$search_text = $_data['search_text'];
		$usersPerPage = $_data['usersPerPage'];
		$pageNumber = $_data['pageNumber'] * $usersPerPage;

		$this->db->select('
		tb_signv2_request_sub.*,
		tb_signv2_sub.field_itemcode,
		tb_signv2_sub.field_itemname,
		tb_signv2_sub.field_print_count,
		tb_sign_size.size_name,
		tb_sign_type_price.type_name_price,
		tb_signv2_sub.field_signamount
		');
  		$this->db->from('tb_signv2_request_sub');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_id = tb_signv2_request_sub.field_sgsub_id','left');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize');	
		$this->db->where('tb_signv2_request_sub.field_request_id',$_data['field_id']);
		$data['SignRequest_sub'] = $this->db->get()->result_array();

		$this->db->select('
		tb_signv2_request_sub.*,
		tb_signv2.field_itemcode,
		tb_signv2.field_itemname,
		tb_signv2.field_docno,
		');
  		$this->db->from('tb_signv2_request_sub');
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_request_sub.field_sg_id','left');
		$this->db->where('tb_signv2_request_sub.field_request_id',$_data['field_id']);
		$data['SignRequest_signmain'] = $this->db->get()->result_array();

		$this->db->select('*');
  		$this->db->from('tb_signv2_request');
		$this->db->where('tb_signv2_request.field_id',$_data['field_id']);
		$data['SignRequest'] = $this->db->get()->result_array();
		echo json_encode($data);
	}

	public function confirmsign_model(){
		
		date_default_timezone_set('Asia/Bangkok');
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);

		$needdate = explode("/",$data['confirmsign_date']);
		$needdate = $needdate[2].'-'.$needdate[1].'-'.$needdate[0];   

		$this->db->set('tb_sign.field_confirm_status',$data['confirm_status']);
		$this->db->set('tb_sign.field_comfirm_needdate',$needdate);
		$this->db->set('tb_sign.field_comfirm_comment',$data['confirmsign_comment']);
		$this->db->set('tb_sign.field_confirm_person',$_SESSION['saeree_employee']);
		$this->db->set('tb_sign.field_confirmdate',date('Y-m-d H:i:s'));
		$this->db->where('tb_sign.field_id',$data['signid']);
		$this->db->update('tb_sign');

		$this->db->where('field_sign_id',$data['signid']);
		$this->db->delete('tb_signplace');

		if(isset($data['tb_dosign'])){

            foreach($data['tb_dosign'] as $value){

                if($value['confirmsign_place'] == '' ){

                }else{
					$this->db->set('field_itemcode',$data['itemcode']);
					$this->db->set('field_signplace',$value['confirmsign_place']);
					$this->db->set('field_signsize',$value['confirmsign_size']);
					$this->db->set('field_signamount',$value['confirmsign_amount']);
					$this->db->set('field_signstatus',0);
					$this->db->set('field_signpacking_status',0);
					$this->db->set('field_signrecieve_status',0);
					$this->db->set('field_signsetup_status',0);
					$this->db->set('field_signcheck_status',0);
					$this->db->set('field_sign_id',$data['signid']);
					$this->db->insert('tb_signplace');
                }	
            }
        }
		
		$field_id = '';  
		$this->db->select('field_docno');
		$this->db->from('tb_sign');
		$this->db->where('tb_sign.field_id',$data['signid']);
		$field_id = $this->db->get()->result_array();
		$this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('SKWorks','ป้ายสินค้า : เจ้าของแผนกจัดการป้าย(ต้องการทำ)','".$_SESSION['saeree_name']." ป้ายสินค้า : เจ้าของแผนกจัดการป้าย(ต้องการทำ) เลขที่".$field_id[0]['field_docno']." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
		echo json_encode($data);

	}

	public function update_packing_excel(){
		
		date_default_timezone_set('Asia/Bangkok');
		$ids = explode('-',$_POST['id_sub']);
		$_data = $_POST;
		$this->db = $this->load->database('default', TRUE);
		$date_today = date('Y-m-d H:i:s');
		$data['ids'] = $ids;
		$this->db->select('tb_signv2.field_id');
		$this->db->from('tb_signv2_sub');
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_sub.field_sign_id');	
		$this->db->where_in('tb_signv2_sub.field_id',$ids);
		$this->db->group_by('tb_signv2_sub.field_id');
		$data['id'] = $this->db->get()->result_array();

		foreach ($ids as $id_sub) {
			$print_count = 0;

			$this->db->select('field_print_count');
			$this->db->from('tb_signv2_sub');
			$this->db->where('field_id',$id_sub);
			$data['print_count'] = $this->db->get()->result_array()[0]['field_print_count'];

			$print_count = $data['print_count'] + 1;

			$this->db->set('field_pack_person',$_SESSION['saeree_employee']);
			$this->db->set('field_pack_datetime',date('Y-m-d H:i:s'));
			$this->db->set('field_pack_status',$_data['field_pack_status']);
			$this->db->set('field_print_count',$print_count);
			$this->db->where('field_id',$id_sub);
			$this->db->update('tb_signv2_sub');
			if ($id_sub != 0 && $id_sub != '') {
				// timeline
				$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself');
				$this->db->from('tb_signv2');
				$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
				$this->db->where('tb_signv2_sub.field_id',$id_sub);
				$this->db->limit(1);
				$data_docno = $this->db->get()->result_array()[0];

				if ($data_docno['field_do_yourself'] == '0') {
					$field_detail = 'บรรจุภัณฑ์ ปริ้นป้ายไอดี '.$id_sub.' เลขที่เอกสาร '.$data_docno['field_docno'];
				}elseif ($data_docno['field_do_yourself'] == '1') {
					$field_detail = 'แผนก ปริ้นป้ายไอดี '.$id_sub.' เลขที่เอกสาร '.$data_docno['field_docno'];
				}

				$this->db->set('field_sign_id',$data_docno['field_id']);
				$this->db->set('field_detail',$field_detail);
				$this->db->set('field_status',4);
				$this->db->set('field_createdate',$date_today);
				$this->db->set('field_creator',$_SESSION['saeree_employee']);
				$this->db->insert('tb_signv2_timeline');
				// 
			}
		}

		foreach ($data['id'] as $key => $value) {
			$this->db->select('count(*) count');
			$this->db->from('tb_signv2_sub');
			$this->db->where('field_sign_id',$value['field_id']);
			$data['sign_count'][] = $this->db->get()->result_array()[0]['count'];

			$this->db->select('count(*) count');
			$this->db->from('tb_signv2_sub');
			$this->db->where('field_sign_id',$value['field_id']);
			$this->db->where('field_pack_status',$_data['field_pack_status']);
			$data['sign_not_pack_count'][] = $this->db->get()->result_array()[0]['count'];

			if ($data['sign_count'][$key] == $data['sign_not_pack_count'][$key]) {
				$this->db->set('field_packing_person',$_SESSION['saeree_employee']);
				$this->db->set('field_packingdate',date('Y-m-d H:i:s'));
				$this->db->set('field_recieve_status',$_data['field_recieve_status']);
				$this->db->set('field_packing_status',$_data['field_packing_status']);
				$this->db->where('field_id',$value['field_id']);
				$this->db->update('tb_signv2');
			}

		}
		echo json_encode($data);

	}

	public function update_print_person(){
		
		date_default_timezone_set('Asia/Bangkok');
		// $ids = explode('-',$_POST['id']);
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);

		// $this->db->select('field_sign_id');
		// $this->db->from('tb_signv2_sub');
		// $this->db->where_in('field_sign_id',$ids);
		// $data['id'] = $this->db->get()->result_array();

		$i = 0;
		foreach ($data['id'] as $id) {
			$this->db->set('print_person',$_SESSION['saeree_employee']);
			$this->db->set('print_datetime',date('Y-m-d H:i:s'));

			$this->db->where('field_id',$id['id']);
			$this->db->update('tb_sign');
			
			$i++;
		}
		echo json_encode($data);

	}

	public function update_recive(){
		
		date_default_timezone_set('Asia/Bangkok');
		$ids = explode('-',$_POST['id']);
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);


		$this->db->select('field_sign_id');
		$this->db->from('tb_signv2_sub');
		$this->db->where_in('field_id',$ids);
		$data['id'] = $this->db->get()->result_array();

		$i = 0;
		foreach ($data['id'] as $id) {
			$this->db->set('field_recieve_status',$data['field_recieve_status']);
			$this->db->set('field_recieve_success_person',$_SESSION['saeree_employee']);
			$this->db->set('field_recieve_success_date',date('Y-m-d H:i:s'));
			$this->db->set('field_recieve_success','1');
			$this->db->where('field_id',$id['field_sign_id']);
			$this->db->update('tb_signv2');
			
			// $data['data'] = $id['field_sign_id'];
			$i++;

			// timeline
			$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself,tb_signv2_sub.field_itemname');
			$this->db->from('tb_signv2');
			$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
			$this->db->where('tb_signv2.field_id',$id['field_sign_id']);
			$this->db->limit(1);
			$data_docno = $this->db->get()->result_array()[0];

			if ($data_docno['field_do_yourself'] == '0') {
				$field_detail = 'บรรจุภัณฑ์ ยืนยันรับป้าย เลขที่เอกสาร '.$data_docno['field_docno'];
			}elseif ($data_docno['field_do_yourself'] == '1') {
				$field_detail = 'แผนก ยืนยันรับป้าย เลขที่เอกสาร '.$data_docno['field_docno'];
			}

			$this->db->set('field_sign_id',$data_docno['field_id']);
			$this->db->set('field_detail',$field_detail);
			$this->db->set('field_status',2);
			$this->db->set('field_createdate',date('Y-m-d H:i:s'));
			$this->db->set('field_creator',$_SESSION['saeree_employee']);
			$this->db->insert('tb_signv2_timeline');
			// 

		}
		echo json_encode($data);

	}


	public function update_packing(){
		
		date_default_timezone_set('Asia/Bangkok');
		$ids = explode('-',$_POST['id']);
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);

		$date_today = date('Y-m-d H:i:s');

		$this->db->select('field_sign_id');
		$this->db->from('tb_signv2_sub');
		$this->db->where_in('field_id',$ids);
		$data['id'] = $this->db->get()->result_array();

		$i = 0;
		foreach ($data['id'] as $id) {
			$this->db->set('field_packing_person',$_SESSION['saeree_employee']);
			$this->db->set('field_packingdate',date('Y-m-d H:i:s'));
			$this->db->set('field_recieve_status',$data['field_recieve_status']);
			$this->db->set('field_packing_status',$data['field_packing_status']);
			$this->db->where('field_id',$id['field_sign_id']);
			$this->db->update('tb_signv2');
			// $data['data'] = $id['field_sign_id'];
			$i++;

			// timeline
			$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself,tb_signv2_sub.field_id as field_id_sub');
			$this->db->from('tb_signv2');
			$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
			$this->db->where('tb_signv2.field_id',$id['field_sign_id']);
			$this->db->limit(1);
			$data_docno = $this->db->get()->result_array()[0];

			if ($data_docno['field_do_yourself'] == '0') {
				$field_detail = 'บรรจุภัณฑ์ ยืนยันทำป้าย ไอดี '.$data_docno['field_id_sub'].' เรียบร้อย เลขที่เอกสาร '.$data_docno['field_docno'];
			}elseif ($data_docno['field_do_yourself'] == '1') {
				$field_detail = 'แผนก ยืนยันทำป้าย ไอดี '.$data_docno['field_id_sub'].' เรียบร้อย เลขที่เอกสาร '.$data_docno['field_docno'];
			}

			$this->db->set('field_sign_id',$data_docno['field_id']);
			$this->db->set('field_detail',$field_detail);
			$this->db->set('field_status',4);
			$this->db->set('field_createdate',$date_today);
			$this->db->set('field_creator',$_SESSION['saeree_employee']);
			$this->db->insert('tb_signv2_timeline');
			// 
		}
		echo json_encode($data);

	}

	public function select_item(){
		
		date_default_timezone_set('Asia/Bangkok');
		$ids = explode('-',$_POST['id']);
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);

		foreach ($ids as $id) {
			$this->db->select('
			tb_signsub.*,
			tb_sign.field_confirm_status,
			tb_sign.field_comfirm_comment,
			tb_sign.field_comfirm_needdate');
			$this->db->from('tb_signsub');
			$this->db->join('tb_sign','tb_sign.field_id = tb_signsub.field_sign_id','left');
			$this->db->where('field_sign_id',$id);
			$data['ViewSign'] = $this->db->get()->result_array();
		}
		echo json_encode($data);

	}

	public function sign_timeline(){
		
		date_default_timezone_set('Asia/Bangkok');
		$this->db = $this->load->database('default', TRUE);

		$this->db->select('
		tb_signv2_timeline.*,
		ed.firstname as creator_firstname,
		ed.lastname as creator_lastname,
		ed.nickname as creator_nickname,
		depart.name as depart_name
		');
		$this->db->from('tb_signv2_timeline');
		$this->db->join('employee ed','ed.id = tb_signv2_timeline.field_creator','left');
		$this->db->join('depart','depart.id = ed.depart_id','left');
		$this->db->where('field_sign_id',$_POST['field_id']);
		$this->db->order_by('field_id','DESC');
		$data['timeline'] = $this->db->get()->result_array();
		
		echo json_encode($data);

	}

	public function update_it_unconfirm(){
		
		date_default_timezone_set('Asia/Bangkok');
		$data = $_REQUEST;
		$this->db = $this->load->database('default', TRUE);
		$date_today = date('Y-m-d H:i:s');

		$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
		$this->db->set('field_confirmdate',date('Y-m-d H:i:s'));
		$this->db->set('field_destroy_status','0');
		$this->db->set('field_packing_status','0');
		$this->db->set('field_recieve_status','0');
		$this->db->set('field_setup_status','0');
		$this->db->set('field_recheck_status','0');
		$this->db->set('field_confirm_status',$data['field_confirm_status']);
		$this->db->set('field_not_confirm_comment',$data['field_not_confirm_comment']);
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signV2');

		$this->db->select('field_docno');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$data['field_id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0]['field_docno'];

		$this->db->select('field_docno,field_id');
		$this->db->from('tb_sign_destroy_list');
		$this->db->where('field_docno',$data_docno);
		$this->db->limit(1);
		$data['sign_destroy'] = $this->db->get()->result_array()[0];

		if (count($data['sign_destroy']) > 0) {
			$this->db->set('field_trash',1);
			$this->db->where('field_docno',$data['field_docno']);
			$this->db->update('tb_sign_destroy_list');
		}

		$field_detail = 'ไอที ยกเลิกป้าย ตามใบขอยกเลิก หมายเหตุ '.$data['field_not_confirm_comment'].' เลขที่เอกสาร '.$data_docno;
		$this->db->set('field_sign_id',$data['field_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',2);
		$this->db->set('field_createdate',$date_today);
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		echo json_encode($data);

	}

	public function update_confirm(){
		
		date_default_timezone_set('Asia/Bangkok');
		$data = $_REQUEST;
		$this->db = $this->load->database('default', TRUE);
		$date_today = date('Y-m-d H:i:s');
		if ($data['field_confirm_status'] == 1) {
			$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
			$this->db->set('field_confirmdate',date('Y-m-d H:i:s'));
			$this->db->set('field_confirm_status',$data['field_confirm_status']);
			$this->db->set('field_not_confirm_comment',$data['field_not_confirm_comment']);
			$this->db->where('field_id',$data['field_id']);
			$this->db->update('tb_signV2');

			$this->db->select('field_docno');
			$this->db->from('tb_signv2');
			$this->db->where('field_id',$data['field_id']);
			$this->db->limit(1);
			$data_docno = $this->db->get()->result_array()[0]['field_docno'];

			$field_detail = 'ยืนยันทำป้าย เลขที่เอกสาร '.$data_docno;
			$this->db->set('field_sign_id',$data['field_id']);
			$this->db->set('field_detail',$field_detail);
			$this->db->set('field_status',2);
			$this->db->set('field_createdate',$date_today);
			$this->db->set('field_creator',$_SESSION['saeree_employee']);
			$this->db->insert('tb_signv2_timeline');
		}
		elseif ($data['field_confirm_status'] == 2) {
			$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
			$this->db->set('field_confirmdate',date('Y-m-d H:i:s'));
			$this->db->set('field_destroy_status','0');
			$this->db->set('field_confirm_status',$data['field_confirm_status']);
			$this->db->set('field_not_confirm_comment',$data['field_not_confirm_comment']);
			$this->db->where('field_id',$data['field_id']);
			$this->db->update('tb_signV2');

			$this->db->select('field_docno');
			$this->db->from('tb_signv2');
			$this->db->where('field_id',$data['field_id']);
			$this->db->limit(1);
			$data_docno = $this->db->get()->result_array()[0]['field_docno'];

			$field_detail = 'ยืนยันไม่ทำป้าย หมายเหตุ '.$data['field_not_confirm_comment'].' เลขที่เอกสาร '.$data_docno;
			$this->db->set('field_sign_id',$data['field_id']);
			$this->db->set('field_detail',$field_detail);
			$this->db->set('field_status',2);
			$this->db->set('field_createdate',$date_today);
			$this->db->set('field_creator',$_SESSION['saeree_employee']);
			$this->db->insert('tb_signv2_timeline');
		}
		echo json_encode($data);

	}

	public function show_data_item(){
		
		date_default_timezone_set('Asia/Bangkok');
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);
		// $this->dbs = $this->load->database('shsps_2022', TRUE);

		$this->db->select('
		tb_signv2_sub.*,
		tb_sign_type_price.type_name_price as type_name
		
		');
		$this->db->from('tb_signv2_sub');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price','left');
		$this->db->where('tb_signv2_sub.field_id',$data['item_id']);
		
		$data['sign_sub_data'] = $this->db->get()->result_array();

		
		$this->db = $this->load->database('shsps_2022', TRUE);

		$this->db->select('
			ic_unit_use.ic_code,
			ic_unit_use.stand_value,
			ic_unit_use.code as unit_code,
			ic_inventory_price.sale_price2,
			ic_inventory_price.from_qty,
			ic_inventory_price.to_qty,
			ic_inventory.group_main,
			ic_inventory.name_1
		');
		$this->db->from('ic_unit_use');
		$this->db->join('ic_inventory','ic_inventory.code = ic_unit_use.ic_code');
		$this->db->join('ic_inventory_price','ic_inventory_price.ic_code = ic_unit_use.ic_code','left');
		$this->db->where_in('ic_unit_use.ic_code',$data['sign_sub_data'][0]['field_itemcode']);
		$this->db->order_by('ic_unit_use.stand_value','ASC');
		$data['ic_unit_use'] = $this->db->get()->result_array();

		$this->db->select('
		ic_inventory_price_formula.ic_code,
		ic_inventory_price_formula.price_0,
		ic_inventory_price_formula.unit_code
		');
		$this->db->from('ic_inventory_price_formula');
		$this->db->where_in('ic_inventory_price_formula.ic_code',$data['sign_sub_data'][0]['field_itemcode']);
		$this->db->order_by('ic_inventory_price_formula.price_0','DESC');
		$data['ic_inventory_price'] = $this->db->get()->result_array();

		$this->db->select('
		ic_inventory_barcode.barcode,
		ic_inventory_barcode.unit_code as barcodeUnitcode
		');
		$this->db->from('ic_inventory_barcode');
		$this->db->where('ic_inventory_barcode.ic_code',$data['item_code']);
		$this->db->order_by('ic_inventory_barcode.line_number','ASC');
		$data['sign_barcode'] = $this->db->get()->result_array();
	
		echo json_encode($data);

	}

	public function confirm_undo_model(){
		
		date_default_timezone_set('Asia/Bangkok');
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);

		$this->db->set('tb_sign.field_confirm_status',$data['confirm_status']);
		$this->db->set('tb_sign.field_comfirm_comment',$data['undo_comment']);
		$this->db->set('tb_sign.field_confirm_person',$_SESSION['saeree_employee']);
		$this->db->set('tb_sign.field_confirmdate',date('Y-m-d H:i:s'));
		$this->db->where('tb_sign.field_id',$data['signid']);
		$this->db->update('tb_sign');

		$this->db->where('field_sign_id',$data['signid']);
		$this->db->delete('tb_signplace');

		$field_id = '';  
		$this->db->select('field_docno');
		$this->db->from('tb_sign');
		$this->db->where('tb_sign.field_id',$data['signid']);
		$field_id = $this->db->get()->result_array();
		$this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('SKWorks','ป้ายสินค้า : เจ้าของแผนกจัดการป้าย(ไม่ต้องการทำ)','".$_SESSION['saeree_name']." ป้ายสินค้า : เจ้าของแผนกจัดการป้าย(ไม่ต้องการทำ) เลขที่".$field_id[0]['field_docno']." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
		echo json_encode($data);

	}

	public function update_load_data_nopacking(){
		
		date_default_timezone_set('Asia/Bangkok');
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);

		$y = 1 ;
		$date_today = date('Y-m-d H:i:s');
		
		foreach ($data['ar_price_list'] as $price_list) {
			$this->db->set('field_fromQty'.$y,$price_list['FromQty']);
			$this->db->set('field_price'.$y,$price_list['SalePrice1']);
			$this->db->set('field_unitcode'.$y,$price_list['priceUnitcode']);
			// $data_list['FromQty'][$y] = $price_list['FromQty'];
			// $data_list['SalePrice1'][$y] = $price_list['SalePrice1'];
			// $data_list['price_all'][$y] = $price_list['price_all'];
			$y++;
		}

		$this->db->set('field_barcode',$data['barcode_select']);
		$this->db->set('field_load_data','1');
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signv2_sub');

		// timeline
		$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself');
		$this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
		$this->db->where('tb_signv2_sub.field_id',$data['field_id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0];

		if ($data_docno['field_do_yourself'] == '0') {
			$field_detail = 'บรรจุภัณฑ์ ดึงข้อมูลก่อนทำป้าย เลขที่เอกสาร '.$data_docno['field_docno'];
		}elseif ($data_docno['field_do_yourself'] == '1') {
			$field_detail = 'แผนก ดึงข้อมูลก่อนทำป้าย เลขที่เอกสาร '.$data_docno['field_docno'];
		}

		$this->db->set('field_sign_id',$data_docno['field_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',2);
		$this->db->set('field_createdate',$date_today);
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		// 
		
		echo json_encode($data);

	}

	public function update_load_data_packing(){
		
		date_default_timezone_set('Asia/Bangkok');
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);

		$i = 1 ;
		$y = 1 ;
		$date_today = date('Y-m-d H:i:s');

		foreach ($data['ar_price_list'] as $price_list) {
			$this->db->set('field_fromQty'.$y,$price_list['FromQty']);
			$this->db->set('field_price'.$y,$price_list['SalePrice1']);
			$this->db->set('field_unitcode'.$y,$price_list['priceUnitcode']);
			// $data_list['FromQty'][$y] = $price_list['FromQty'];
			// $data_list['SalePrice1'][$y] = $price_list['SalePrice1'];
			// $data_list['price_all'][$y] = $price_list['price_all'];
			$y++;
		}

		foreach ($data['ar_packing'] as $packing) {
			// $this->db->set('field_rate1'.$i,$packing['Rate']);
			$this->db->set('field_rate'.$i,$packing['Rate']);
			// $data_list['field_rate'][$i] = $packing['Rate'];
			$i++;
		}

		$this->db->set('field_barcode',$data['barcode_select']);
		$this->db->set('field_load_data','1');
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signv2_sub');
		
		// timeline
		$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself');
		$this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
		$this->db->where('tb_signv2_sub.field_id',$data['field_id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0];

		if ($data_docno['field_do_yourself'] == '0') {
			$field_detail = 'บรรจุภัณฑ์ ดึงข้อมูลก่อนทำป้าย เลขที่เอกสาร '.$data_docno['field_docno'];
		}elseif ($data_docno['field_do_yourself'] == '1') {
			$field_detail = 'แผนก ดึงข้อมูลก่อนทำป้าย เลขที่เอกสาร '.$data_docno['field_docno'];
		}

		$this->db->set('field_sign_id',$data_docno['field_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',2);
		$this->db->set('field_createdate',$date_today);
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		// 

		echo json_encode($data);

	}

	//Packing Process
	public function get_sign_packing_model(){
		$this->db = $this->load->database('default', TRUE);
	
		$search_text = $_POST['search_text'];
		$search_groupcode = $_POST['search_groupcode'];
		$search_size = $_POST['search_size'];
		$search_type = $_POST['search_type'];
		$usersPerPage = $_POST['usersPerPage'];
		$pageNumber = $_POST['pageNumber'] * $usersPerPage;

		$this->db->select('
			tb_signv2_sub.*,
			ed.firstname as depart_firstname,
			ed.lastname as depart_lastname,
			ed.nickname as depart_nickname,
			tb_signv2_sub.field_signsize,
			tb_signv2_sub.field_signamount,
			tb_sign_type_price.type_name_price,
			tb_sign_size.size_name,
			tb_sign_cause.type_name,
			tb_signv2.field_comfirm_comment
		');
  		$this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2.field_id = tb_signv2_sub.field_sign_id');	
		$this->db->join('employee ed','ed.id = tb_signv2.field_confirm_person','left');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_signv2.field_type');
		$this->db->where('tb_signv2.field_confirm_status',1);
		$this->db->order_by('tb_signv2_sub.field_id','ASC');
	
		if($search_text != ''){
			$this->db->group_start();
			$this->db->or_like('tb_signv2_sub.field_itemcode',$search_text, 'both');
			$this->db->or_like('tb_signv2_sub.field_itemname',$search_text, 'both');
			$this->db->group_end();
		}

		if($search_groupcode != ''){
			$this->db->where('tb_signv2_sub.field_groupcode',$search_groupcode);
		}

		if($search_size != ''){
			$this->db->where('tb_signv2_sub.field_signsize',$search_size);
		}

		if($search_type != ''){
			$this->db->where('tb_signv2_sub.field_type_sign_price',$search_type);
		}

		$this->db->where('tb_signv2.field_request_status',null);
		// $this->db->where('tb_signv2.field_packing_status','0');
		$status = array('0', '3');
		$this->db->where_in('tb_signv2.field_packing_status',$status);
		$this->db->where('tb_signv2.field_do_yourself',$_POST['doit']);
		$this->db->where('tb_signv2_sub.field_load_data',$_POST['field_load_data']);
		$this->db->where('tb_signv2_sub.field_pack_status',null);
		$this->db->where('tb_signv2_sub.field_request_status',null);
		$this->db->limit($usersPerPage,$pageNumber);
		$data['SignPacking'] = $this->db->get()->result_array();	


		$this->db->select('count(*) count');
		$this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2.field_id = tb_signv2_sub.field_sign_id');	
		$this->db->where('tb_signv2.field_confirm_status',1);

        $this->db->order_by('tb_signv2_sub.field_id','ASC');
	
		if($search_text != ''){
			$this->db->group_start();
			$this->db->or_like('tb_signv2_sub.field_itemcode',$search_text, 'both');
			$this->db->or_like('tb_signv2_sub.field_itemname',$search_text, 'both');
			$this->db->group_end();
		}

		if($search_groupcode != ''){
			$this->db->where('tb_signv2_sub.field_groupcode',$search_groupcode);
		}

		if($search_size != ''){
			$this->db->where('tb_signv2_sub.field_signsize',$search_size);
		}

		if($search_type != ''){
			$this->db->where('tb_signv2_sub.field_type_sign_price',$search_type);
		}
		$this->db->where('tb_signv2.field_request_status',null);
		// $this->db->where('tb_signv2.field_packing_status','0');
		$status = array('0', '3');
		$this->db->where_in('tb_signv2.field_packing_status',$status);
		$this->db->where('tb_signv2_sub.field_load_data',$_POST['field_load_data']);
		$this->db->where('tb_signv2.field_do_yourself',$_POST['doit']);
		$this->db->where('tb_signv2_sub.field_pack_status',null);
		$this->db->where('tb_signv2_sub.field_request_status',null);
		$data['total_packing'] = $this->db->get()->result_array()[0]['count'];

	
		echo json_encode($data);

    }

	public function get_sign_packing_do_model(){
		$this->db = $this->load->database('default', TRUE);

		$data = $_POST;
		$search_text = $data['search_text'];
		$search_groupcode = $data['search_groupcode'];
		$search_size = $data['search_size'];
		$usersPerPage = $data['usersPerPage'];
		$search_type = $data['search_type'];
		$pageNumber = $data['pageNumber'] * $usersPerPage;
		$search_status_do = $data['search_status_do'];

		$this->db->select('
		tb_signv2_sub.*,
		tb_signv2_sub.field_signsize,
		tb_signv2_sub.field_signamount,
		tb_signv2.field_packing_person,
		tb_signv2.field_comfirm_needdate,
		tb_signv2.field_packing_status,
		tb_signv2.field_recieve_status,
		tb_signv2.field_recieve_success,
		tb_sign_size.size_name,
		tb_sign_type_price.type_name_price,
		employee.firstname,
		tb_sign_cause.type_name,
		employee.nickname,
		tb_signv2.field_comfirm_comment');
  		$this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2.field_id = tb_signv2_sub.field_sign_id');
		$this->db->join('employee','employee.id = tb_signv2.field_packing_person');	
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_signv2.field_type');	
        
		if($search_text != ''){
			$this->db->group_start();
			$this->db->or_like('tb_signv2_sub.field_itemcode',$search_text, 'both');
			$this->db->or_like('tb_signv2_sub.field_itemname',$search_text, 'both');
			$this->db->group_end();
		}

		if($search_groupcode != ''){
			$this->db->where('tb_signv2_sub.field_groupcode',$search_groupcode);
		}

		if($search_size != ''){
			$this->db->where('tb_signv2_sub.field_signsize',$search_size);
		}

		if($search_type != ''){
			$this->db->where('tb_signv2_sub.field_type_sign_price',$search_type);
		}
		$status = array('1','2');
		if ($search_status_do != '') {
			$status = array($search_status_do);
		}

		if ($search_status_do == 3) {
			$this->db->where('tb_signv2.field_recieve_success',null);
			$this->db->where('tb_signv2.field_recieve_status',2);
			$status = array('2');
		}

		if ($search_status_do == 4) {
			$this->db->where('tb_signv2.field_recieve_success',null);
			$this->db->where('tb_signv2.field_recieve_status',1);
			$status = array('2');
		}
		$this->db->where('tb_signv2.field_request_status',null);
		$this->db->where_in('tb_signv2.field_packing_status',$status);
		$this->db->where('tb_signv2.field_do_yourself',$_POST['doit']);
		$this->db->where('tb_signv2_sub.field_pack_status','1');
		$this->db->where('tb_signv2_sub.field_request_status',null);
		$this->db->order_by('tb_signv2_sub.field_sign_id','DESC');
		$this->db->limit($usersPerPage,$pageNumber);
        // $this->db->order_by('tb_signv2_sub.field_sign_id','DESC');	
		$data['SignPacking'] = $this->db->get()->result_array();	

		$this->db->select('count(*) count');
		$this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2.field_id = tb_signv2_sub.field_sign_id');
		$this->db->join('employee','employee.id = tb_signv2.field_packing_person');	
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_signv2.field_type');	
        $this->db->order_by('tb_signv2_sub.field_id','DESC');
	
		if($search_text != ''){
			$this->db->group_start();
			$this->db->or_like('tb_signv2_sub.field_itemcode',$search_text, 'both');
			$this->db->or_like('tb_signv2_sub.field_itemname',$search_text, 'both');
			$this->db->group_end();
		}

		if($search_groupcode != ''){
			$this->db->where('tb_signv2_sub.field_groupcode',$search_groupcode);
		}

		if($search_size != ''){
			$this->db->where('tb_signv2_sub.field_signsize',$search_size);
		}

		if($search_type != ''){
			$this->db->where('tb_signv2_sub.field_type_sign_price',$search_type);
		}
		$status = array('1','2');
		if ($search_status_do != '') {
			$status = array($search_status_do);
		}

		if ($search_status_do == 3) {
			$this->db->where('tb_signv2.field_recieve_success',null);
			$this->db->where('tb_signv2.field_recieve_status',2);
			$status = array('2');
		}

		if ($search_status_do == 4) {
			$this->db->where('tb_signv2.field_recieve_success',null);
			$this->db->where('tb_signv2.field_recieve_status',1);
			$status = array('2');
		}
		$this->db->where('tb_signv2.field_request_status',null);
		$this->db->where_in('tb_signv2.field_packing_status',$status);
		$this->db->where('tb_signv2.field_do_yourself',$_POST['doit']);
		$this->db->where('tb_signv2_sub.field_pack_status','1');
		$this->db->where('tb_signv2_sub.field_request_status',null);
		$this->db->order_by('tb_signv2_sub.field_sign_id','DESC');
		$data['total_packing'] = $this->db->get()->result_array()[0]['count'];
	
		echo json_encode($data);

    }

	public function get_packing_recive(){
		$this->db = $this->load->database('default', TRUE);

		$ids = explode('-',$_POST['id']);

		$data['EXCEL'] = [];
		foreach ($ids as $id){

			if($id != ''){

				$this->db->select('
				tb_signsub.*,
				tb_sign.field_type,
				tb_sign.field_comfirm_needdate,
				tb_sign.field_packingdate
				');
				$this->db->from('tb_signsub');
				$this->db->join('tb_sign','tb_sign.field_id = tb_signsub.field_sign_id','left');
				$this->db->where('tb_sign.field_packing_status','2');
				$this->db->where('tb_signsub.field_sign_id',$id);
				$this->db->group_by('tb_signsub.field_sign_id');
				$data['list'][] = $this->db->get()->result_array();
				// $maindata = $this->db->get()->result_array();
			}	

		}

		echo json_encode($data);

    }


	public function get_packing_excel_model(){
		$this->db = $this->load->database('default', TRUE);
		$this->dbs = $this->load->database('shsps_2022', TRUE);
		$ids = explode('-',$_POST['id']);

		$this->db->select('
		tb_signv2_sub.*,
		tb_signv2.field_comfirm_needdate,
		tb_signv2.field_docno,
		tb_sign_type_price.type_name_price,
		tb_sign_size.size_name
		');
		$this->db->from('tb_signv2_sub');
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_sub.field_sign_id');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize');
		$this->db->where_in('tb_signv2_sub.field_id',$ids);
		$data['list'] = $this->db->get()->result_array();

		foreach ($data['list'] as $key => $value) {
			$this->db = $this->load->database('shsps_2022', TRUE);

			$this->db->select('
				ic_unit_use.ic_code,
				ic_unit_use.stand_value,
				ic_unit_use.code as unit_code,
				ic_inventory_price.sale_price2,
				ic_inventory_price.from_qty,
				ic_inventory.name_1,
				ic_inventory.name_2
			');
			$this->db->from('ic_unit_use');
			$this->db->join('ic_inventory','ic_inventory.code = ic_unit_use.ic_code');
			$this->db->join('ic_inventory_price','ic_inventory_price.ic_code = ic_unit_use.ic_code','left');
			$this->db->where_in('ic_unit_use.ic_code',$value['field_itemcode']);
			$this->db->order_by('ic_unit_use.stand_value','ASC');
			$this->db->order_by('ic_inventory_price.line_number','ASC');
			$data['ic_unit_use'][] = $this->db->get()->result_array();

			$this->db->select('
			ic_inventory_price_formula.ic_code,
			ic_inventory_price_formula.price_0,
			ic_inventory_price_formula.unit_code
			');
			$this->db->from('ic_inventory_price_formula');
			$this->db->where_in('ic_inventory_price_formula.ic_code',$value['field_itemcode']);
			$this->db->order_by('ic_inventory_price_formula.price_0','DESC');
			$data['ic_inventory_price'][] = $this->db->get()->result_array();
		}

		echo json_encode($data);

    }

	function get_system_barcode($itemcode,$unitcode){

		$this->db = $this->load->database('shsps_2022', TRUE);
		$this->db->select('BCBarCodeMaster.Barcode as Barcode');
		$this->db->from('BCBarCodeMaster');
		$this->db->where('BCBarCodeMaster.ActiveStatus',1);
		$this->db->where('BCBarCodeMaster.Itemcode',$itemcode);
		$this->db->WHERE('BCBarCodeMaster.UnitCode',$unitcode);
		$this->db->order_by('BCBarCodeMaster.Roworder','DESC');
		$this->db->limit(1);
		$data_BCBarCode = $this->db->get()->result_array();

		if(count($data_BCBarCode) > 0){
			$data = $data_BCBarCode;
		}else{
			$data = 'nodata';
		}

		return $data;
	
	}

	public function get_packinglist_model(){
		$this->db = $this->load->database('default', TRUE);

		$data = $_POST;

		$this->db->select('
			tb_signv2.*,
			tb_signv2_sub.*,
			employee.firstname as creator_firstname,
			employee.lastname as creator_lastname,
			employee.nickname as creator_nickname,
			cf.firstname as confirm_firstname,
			cf.nickname as confirm_nickname,
			pk.firstname as packing_firstname,
			pk.nickname as packing_nickname,
			rc.firstname as recieve_firstname,
			rc.nickname as recieve_nickname,
			st.firstname as setup_firstname,
			st.nickname as setup_nickname,
			tb_sign_place.field_place_name,
			dt.name as partname

		');
		$this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id');
		$this->db->join('employee','employee.id = tb_signv2.field_creator','left');
		$this->db->join('part dt','dt.id = tb_signv2.field_recieve_toperson','left');
		$this->db->join('employee cf','cf.id = tb_signv2.field_confirm_person','left');
		$this->db->join('employee pk','pk.id = tb_signv2.field_packing_person','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_signv2_sub.field_signplace','left');
		$this->db->join('employee rc','rc.id = tb_signv2.field_recieve_person','left');
		$this->db->join('employee st','st.id = tb_signv2_sub.field_setup_person','left');
		$this->db->join('employee recheck','recheck.id = tb_signv2.field_recheck_person','left');
		$this->db->where('tb_signv2.field_id',$data['field_id']);
		$data['Sign'] = $this->db->get()->result_array()[0];

		$this->db->select('
			tb_signv2_sub.*,
			tb_signv2_sub.field_signsize,
			tb_signv2_sub.field_signamount,
			tb_sign_type_price.type_name_price,
			tb_sign_size.size_name,
			tb_sign_cause.type_name,
			tb_sign.field_comfirm_comment,
			st.firstname as setup_firstname,
			tb_sign_place.field_place_name,
			st.nickname as setup_nickname
		');
		$this->db->from('tb_sign');
		$this->db->join('tb_signv2_sub','tb_sign.field_id = tb_signv2_sub.field_sign_id');	
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_signv2_sub.field_signplace','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize');
		$this->db->join('employee st','st.id = tb_signv2_sub.field_setup_person','left');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_sign.field_type');
		$this->db->where('tb_sign.field_id',$data['field_id']);
		$this->db->order_by('tb_signv2_sub.field_id','ASC');
	    $data['SignSub'] = $this->db->get()->result_array();	


		$this->db->select('
			tb_signv2_sub.*,
			tb_signv2_sub.field_signsize,
			tb_signv2_sub.field_signamount,
			tb_sign_type_price.type_name_price,
			tb_sign_place.field_place_name,
			tb_sign_size.size_name,
			tb_sign_cause.type_name,
			tb_sign.field_comfirm_comment
		');
		$this->db->from('tb_sign');
		$this->db->join('tb_signv2_sub','tb_sign.field_id = tb_signv2_sub.field_sign_id');	
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_signv2_sub.field_signplace','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_sign.field_type');
		$this->db->where('tb_sign.field_id',$data['field_id']);
		$this->db->where('tb_signv2_sub.field_destroy_status','1');
		$this->db->order_by('tb_signv2_sub.field_id','ASC');
	    $data['SignDes'] = $this->db->get()->result_array();	

		$this->db->select('
			tb_signv2_sub.*,
			tb_signv2_sub.field_signsize,
			tb_signv2_sub.field_signamount,
			tb_sign_type_price.type_name_price,
			tb_sign_place.field_place_name,
			tb_sign_size.size_name,
			tb_sign_cause.type_name,
			tb_sign.field_comfirm_comment
		');
		$this->db->from('tb_sign');
		$this->db->join('tb_signv2_sub','tb_sign.field_id = tb_signv2_sub.field_sign_id');	
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_signv2_sub.field_signplace','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_sign.field_type');
		$this->db->where('tb_sign.field_id',$data['field_id']);
		$this->db->where('tb_signv2_sub.field_destroy_status','1');
		$this->db->order_by('tb_signv2_sub.field_id','ASC');
		$data['SignDesSuc'] = $this->db->get()->result_array();	


		$this->db->select('
			tb_sign_old_new.field_place_id,
			tb_sign_old_new.field_old_id,
			SUM(tb_sign_old_new.sign_amount) as count_sign,
			tb_sign_size.size_name
		');
		$this->db->from('tb_sign_old_new');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_sign_old_new.sign_size','left');
		// $this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_sign_old_new.field_place_id','left');
		$this->db->where('tb_sign_old_new.field_item_code',$data['SignDesSuc'][0]['field_itemcode']);
		$this->db->where('tb_sign_old_new.sign_size',$data['SignDesSuc'][0]['field_signsize']);
		$this->db->group_by('tb_sign_old_new.sign_size');
		$data['signold'] = $this->db->get()->result_array();
		
		$this->db->select('*');
        $this->db->from('tb_sign_old_new');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_sign_old_new.field_type_sign_price','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_sign_old_new.sign_size','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_sign_old_new.field_place_id','left');
		$this->db->where('tb_sign_old_new.field_item_code',$data['Sign']['field_itemcode']);
        $data['signold_new'] = $this->db->get()->result_array();	

		echo json_encode($data);

    }

	public function update_signsub_name2(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;

		// $this->db->set('field_edit_person',$_SESSION['saeree_employee']);
		// $this->db->set('field_edit_time',date('Y-m-d H:i:s'));
		$count = $_POST['field_count_update'] + 1;

		$this->db->set('field_count_update',$count);
		$this->db->set('field_bc_name2',$_POST['field_bc_name2']);
		$this->db->where('field_id',$_POST['field_id']);
		$this->db->update('tb_signv2_sub');

		// timeline
		$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself,tb_signv2_sub.field_itemname');
		$this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
		$this->db->where('tb_signv2_sub.field_id',$_POST['field_id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0];


		$field_detail = 'แผนก เพิ่มรายละเอียดป้ายเพิ่มเติม '.$_POST['field_bc_name2'].' เลขที่เอกสาร '.$data_docno['field_docno'];
		$this->db->set('field_sign_id',$data_docno['field_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',6);
		$this->db->set('field_createdate',date('Y-m-d H:i:s'));
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		// 

		echo json_encode($data);
	}

	public function update_itemname(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;
		$date_today = date('Y-m-d H:i:s');

		// timeline
		$this->db->select('tb_signv2.field_docno,tb_signv2.field_id,tb_signv2.field_do_yourself,tb_signv2_sub.field_itemname');
		$this->db->from('tb_signv2');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_signv2.field_id','left');
		$this->db->where('tb_signv2_sub.field_id',$_POST['field_id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0];

		if ($data_docno['field_do_yourself'] == '0') {
			$field_detail = 'บรรจุภัณฑ์ แก้ไขชื่อ เดิม '.$data_docno['field_itemname'].' เป็น '.$_POST['field_itemname'].' เลขที่เอกสาร '.$data_docno['field_docno'];
		}elseif ($data_docno['field_do_yourself'] == '1') {
			$field_detail = 'แผนก แก้ไขชื่อ เดิม '.$data_docno['field_itemname'].' เป็น '.$_POST['field_itemname'].' '.$data_docno['field_docno'];
		}

		$this->db->set('field_sign_id',$data_docno['field_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',6);
		$this->db->set('field_createdate',$date_today);
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		// 
				
		$this->db->set('field_edit_person',$_SESSION['saeree_employee']);
		$this->db->set('field_edit_time',date('Y-m-d H:i:s'));
		$this->db->set('field_itemname',$_POST['field_itemname']);
		$this->db->where('field_id',$_POST['field_id']);
		$this->db->update('tb_signv2_sub');

		echo json_encode($data);
	}

	public function packing_confirm_model(){
		$data = $_POST;
		$this->db->set('field_packing_status',0);
		$this->db->set('field_packing_person',$_SESSION['saeree_employee']);
		$this->db->set('field_packingdate',date('Y-m-d H:i:s'));
		$this->db->where('field_id',$data['id']);
		$this->db->update('tb_sign');
		echo json_encode($data);
	}

	public function update_main_destroy_sub(){
		
		date_default_timezone_set('Asia/Bangkok');
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);

		$date_today = date('Y-m-d H:i:s');

		$name_table = 'tb_sign_destroy_list';
		$name_field_id = 'field_id';
		$name_field_date = 'field_docdate';
		$name_field_docno = 'field_docno';
		$name_title  = 'DT';
		$data_docno = $this->get_create_docno_destroy_model(
			$name_table,
			$name_field_id,
			$name_field_date,
			$name_field_docno,
			$name_title
		);

		$this->db->select('*');
		$this->db->from('tb_signv2_preparedestroy');
		$this->db->join('tb_sign_old_new','tb_sign_old_new.field_old_id = tb_signv2_preparedestroy.field_destroy_id');	
		$this->db->where_in('field_sign_id',$data['sign_id']);
		$this->db->where('field_destroy_id !=','0');
		$data['sign_destroy'] = $this->db->get()->result_array();
		
		$this->db->select('detail');
		$this->db->from('tb_sign_destroy_comment');
		$this->db->where('id',$data['destroy_comment']);
		$data['destroy_comment'] = $this->db->get()->result_array()[0]['detail'];

		$this->db->select('*');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$data['sign_id']);
		$data['tb_signv2'] = $this->db->get()->result_array()[0];

		$this->db->select('field_docno');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$data['sign_id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0]['field_docno'];

		$field_detail = 'ทำลายป้าย หมายเหตุ '.$data['destroy_comment'].' เลขที่เอกสาร '.$data_docno;
		$this->db->set('field_sign_id',$data['sign_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',5);
		$this->db->set('field_createdate',$date_today);
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');

		if ($data['sign_destroy'] != '') {

			$this->db->set('field_docno',$data_docno);
			$this->db->set('field_sg_id',$data['tb_signv2']['field_id']);
			$this->db->set('field_itemcode',$data['tb_signv2']['field_itemcode']);
			$this->db->set('field_itemname',$data['tb_signv2']['field_itemname']);
			$this->db->set('field_destroy_comment',$data['destroy_comment'].' '.$data['destroy_comment_more']);
			$this->db->set('field_status',$data['img']);
			$this->db->set('field_docdate',date('Y-m-d H:i:s'));
			$this->db->set('field_destroy_person',$_SESSION['saeree_employee']);
			$this->db->insert('tb_sign_destroy_list');
			$rent_no = $this->db->insert_id();

			foreach ($data['sign_destroy'] as $val) {
				$this->db->set('field_destroy_id',$rent_no);
				$this->db->set('sign_size',$val['sign_size']);
				$this->db->set('field_type_sign_price',$val['field_type_sign_price']);
				$this->db->set('field_place_id',$val['field_place_id']);
				$this->db->set('sign_amount',$val['sign_amount']);
				$this->db->insert('tb_sign_destroy_sub');
	
				$this->db->where('field_old_id',$val['field_destroy_id']);
				$this->db->delete('tb_sign_old_new');
			}	
		}

		$this->db->set('field_destroy_comment',$data['destroy_comment'].' '.$data['destroy_comment_more']);
		$this->db->set('field_destroy_person_save',$_SESSION['saeree_employee']);
		$this->db->set('field_destroy_date',date('Y-m-d H:i:s'));
		$this->db->set('field_destroy_status',2);
		$this->db->where('field_id',$data['tb_signv2']['field_id']);
		$this->db->update('tb_signv2');

		if ($data['sign_destroy'] != '') {
			foreach ($data['sign_destroy'] as $key => $value) {
				$this->db->select('COUNT(*) count');
				$this->db->from('tb_sign_old_new');
				$this->db->where('field_sg_docno', $value['field_sg_docno']);
				$this->db->where('field_sg_docno !=', null);
				$data['count_sg_old'] = $this->db->get()->result_array()[0]['count'];
		
				if ($data['count_sg_old'] == 0) {
					$this->db->set('field_active_status',0);
					$this->db->where('field_docno', $value['field_sg_docno']);
					$this->db->update('tb_signv2');
	
					// 
					$this->db->select('field_id');
					$this->db->from('tb_signv2');
					$this->db->where('field_docno',$value['field_sg_docno']);
					$this->db->limit(1);
					$data_field_id = $this->db->get()->result_array()[0]['field_id'];
	
					$field_detail = 'เลิกใช้งาน เลขที่เอกสาร '.$value['field_sg_docno'];
					$this->db->set('field_sign_id',$data_field_id);
					$this->db->set('field_detail',$field_detail);
					$this->db->set('field_status',0);
					$this->db->set('field_createdate',date('Y-m-d H:i:s'));
					$this->db->set('field_creator',$_SESSION['saeree_employee']);
					$this->db->insert('tb_signv2_timeline');
					// 
				}
	
			}
		}

		


		echo json_encode($data);
	}

	public function update_main_destroy_sg(){
		
		date_default_timezone_set('Asia/Bangkok');
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);
		$date_today = date('Y-m-d H:i:s');

		$name_table = 'tb_sign_destroy_list';
		$name_field_id = 'field_id';
		$name_field_date = 'field_docdate';
		$name_field_docno = 'field_docno';
		$name_title  = 'DT';
		$data_docno = $this->get_create_docno_1_model(
			$name_table,
			$name_field_id,
			$name_field_date,
			$name_field_docno,
			$name_title
		);

		$this->db->select('*');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$data['sign_id']);
		$data['tb_signv2'] = $this->db->get()->result_array()[0];

		// 
		$this->db->select('field_docno');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$data['sign_id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0]['field_docno'];

		$field_detail = 'ทำลายป้ายก่อนถอย หมายเหตุ '.$data['destroy_comment'].' เลขที่เอกสาร '.$data_docno;
		$this->db->set('field_sign_id',$data['field_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',6);
		$this->db->set('field_createdate',$date_today);
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		// 

		$this->db->select('*');
		$this->db->from('tb_sign_old_new');
		$this->db->where('field_sg_docno',$data['tb_signv2']['field_docno']);
		$data['sign_destroy'] = $this->db->get()->result_array();



		if ($data['sign_destroy'] != '') {
			$this->db->set('field_docno',$data_docno);
			$this->db->set('field_sg_id',$data['tb_signv2']['field_id']);
			$this->db->set('field_itemcode',$data['tb_signv2']['field_itemcode']);
			$this->db->set('field_itemname',$data['tb_signv2']['field_itemname']);
			$this->db->set('field_destroy_comment',$data['destroy_comment']);
			$this->db->set('field_status',$data['img']);
			$this->db->set('field_docdate',date('Y-m-d H:i:s'));
			$this->db->set('field_destroy_person',$_SESSION['saeree_employee']);
			$this->db->insert('tb_sign_destroy_list');
			$rent_no = $this->db->insert_id();

			foreach ($data['sign_destroy'] as $val) {
				$this->db->set('field_destroy_id',$rent_no);
				$this->db->set('sign_size',$val['sign_size']);
				$this->db->set('field_type_sign_price',$val['field_type_sign_price']);
				$this->db->set('field_place_id',$val['field_place_id']);
				$this->db->set('sign_amount',$val['sign_amount']);
				$this->db->insert('tb_sign_destroy_sub');
	
				$this->db->where('field_old_id',$val['field_old_id']);
				$this->db->delete('tb_sign_old_new');
			}
	
		}

		$this->db->set('field_recheck_status',3);
		$this->db->where('field_id',$data['tb_signv2']['field_id']);
		$this->db->update('tb_signv2');

		echo json_encode($data);
	}

	public function update_destroy_sub(){
		
		date_default_timezone_set('Asia/Bangkok');
		$ids = explode('-',$_POST['id']);
		$data = $_POST;
		$this->db = $this->load->database('default', TRUE);


		$this->db->select('*');
		$this->db->from('tb_sign_old_new');
		$this->db->where_in('field_old_id',$ids);
		$data['id'] = $this->db->get()->result_array();

		$name_table = 'tb_sign_destroy_list';
		$name_field_id = 'field_id';
		$name_field_date = 'field_docdate';
		$name_field_docno = 'field_docno';
		$name_title  = 'DT';
		$data_docno = $this->get_create_docno_destroy_model(
		$name_table,
		$name_field_id,
		$name_field_date,
		$name_field_docno,
		$name_title
		);

		if ($data['id'] != '') {
			# code...
			$this->db->set('field_docno',$data_docno);
			$this->db->set('field_itemcode',$data['id'][0]['field_item_code']);
			$this->db->set('field_itemname',$data['itemname']);
			$this->db->set('field_destroy_comment',$data['destroy_comment'].' '.$data['destroy_comment_more']);
			$this->db->set('field_status',$data['img']);
			$this->db->set('field_docdate',date('Y-m-d H:i:s'));
			$this->db->set('field_destroy_person',$_SESSION['saeree_employee']);
			$this->db->insert('tb_sign_destroy_list');

			$this->db->select('field_id');
			$this->db->from('tb_sign_destroy_list');
			$this->db->order_by('field_id','DESC');
			$this->db->limit(1);
			$destroy_id = $this->db->get()->result_array()[0];

			foreach ($data['id'] as $id) {
				$this->db->set('field_destroy_id',$destroy_id['field_id']);
				$this->db->set('sign_size',$id['sign_size']);
				$this->db->set('field_type_sign_price',$id['field_type_sign_price']);
				$this->db->set('field_place_id',$id['field_place_id']);
				$this->db->set('sign_amount',$id['sign_amount']);
				$this->db->insert('tb_sign_destroy_sub');

				$this->db->where('field_old_id',$id['field_old_id']);
				$this->db->delete('tb_sign_old_new');
			}

			foreach ($data['id'] as $key => $value) {
				$this->db->select('COUNT(*) count');
				$this->db->from('tb_sign_old_new');
				$this->db->where('field_sg_docno', $value['field_sg_docno']);
				$this->db->where('field_sg_docno !=', null);
				$data['count_sg_old'] = $this->db->get()->result_array()[0]['count'];
		
				if ($data['count_sg_old'] == 0) {
					$this->db->set('field_active_status',0);
					$this->db->where('field_docno', $value['field_sg_docno']);
					$this->db->update('tb_signv2');

					// 
					$this->db->select('field_id');
					$this->db->from('tb_signv2');
					$this->db->where('field_docno',$value['field_sg_docno']);
					$this->db->limit(1);
					$data_field_id = $this->db->get()->result_array()[0]['field_id'];

					$field_detail = 'เลิกใช้งาน เลขที่เอกสาร '.$value['field_sg_docno'];
					$this->db->set('field_sign_id',$data_field_id);
					$this->db->set('field_detail',$field_detail);
					$this->db->set('field_status',0);
					$this->db->set('field_createdate',date('Y-m-d H:i:s'));
					$this->db->set('field_creator',$_SESSION['saeree_employee']);
					$this->db->insert('tb_signv2_timeline');
					// 

				}
			}
		}
		echo json_encode($data);

	}

	public function update_edit_destroy_comment(){
		date_default_timezone_set('Asia/Bangkok');
	
		$data = $_POST;
		$date_today = date('Y-m-d H:i:s');

		$this->db->set('field_destroy_comment',$data['destroy_comment']);
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_sign_destroy_list');

		echo json_encode($data);
	}

	public function destroy_confirm_model(){
		date_default_timezone_set('Asia/Bangkok');
	
		$data = $_POST;
		$ids = explode('-',$data['itemcode']);
		$date_today = date('Y-m-d H:i:s');
		$this->db->select('*');
		$this->db->from('tb_sign_old_new');
		$this->db->where_in('field_old_id',$ids);
		$data['id'] = $this->db->get()->result_array();

		foreach ($data['id'] as $id) {
			$this->db->where('field_old_id',$id['field_old_id']);
			$this->db->delete('tb_sign_old_new');
		}

		// $data['id_destroy'];

		$this->db->set('field_destroy_status',$data['main']);
		$this->db->set('field_destroy_comment',$data['destroy_comment']);
		$this->db->set('field_destroy_person_save',$data['destroy_person_id']);
		$this->db->set('field_destroy_date',date('Y-m-d H:i:s'));
		$this->db->where('field_id',$data['destroy_id']);
		$this->db->update('tb_sign');

		// timeline main
		$this->db->select('field_docno');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$data['destroy_id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0]['field_docno'];

		$field_detail = 'ทำลายป้ายในเลขที่เอกสาร '.$data_docno.' หมายเหตุ '.$data['destroy_comment'];
		$this->db->set('field_sign_id',$data['destroy_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',2);
		$this->db->set('field_createdate',$date_today);
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		// 

		$i = 0;
		foreach ($data['id_destroy'] as $destroy) {
			// $data['dessss'] = $destroy['field_id'];

			$this->db->set('field_destroy_status',$data['sub']);
			$this->db->where('field_id',$destroy['field_id']);
			$this->db->update('tb_signv2_sub');
			$i++;
		}

		// foreach ($data['id_destroy'] as  $val) {
			
		// 	for ($i=0; $i < $val['field_signamount']; $i++) { 
		// 		$this->db->where('field_item_code',$val['field_itemcode']);
		// 		$this->db->where('sign_size',$val['field_signsize']);
		// 		$this->db->delete('tb_sign_old_new');
		// 	}
		// }


		echo json_encode($data);
	}

	public function get_employee_tosetup_model(){
		$this->db = $this->load->database('default', TRUE);
        $this->db->select('*');
        $this->db->from('part');

		$data['PART'] = $this->db->get()->result_array();	
        echo json_encode($data);
    }

	public function get_employee_diff(){
		$this->db = $this->load->database('default', TRUE);
        $this->db->select('
		employee.id,
		employee.pepleid,
		employee.firstname,
		employee.lastname,
		employee.nickname,
        depart.name AS departname,
        employee.id AS employeeid');
        $this->db->from('employee');
        $this->db->join('depart','employee.depart_id = depart.id');
        $this->db->join('user','user.employee_id = employee.id');	
		$this->db->where('employee.status','ทำงาน');
		$this->db->where_in('employee.status','ทำงาน');
		$data['employee'] = $this->db->get()->result_array();	
        echo json_encode($data);

    }

	public function get_employee_setup(){
		$this->db = $this->load->database('default', TRUE);
        $this->db->select('
		employee.id,
		employee.pepleid,
		employee.firstname,
		employee.lastname,
		employee.nickname,
        depart.name AS departname,
        employee.id AS employeeid');
        $this->db->from('employee');
        $this->db->join('depart','employee.depart_id = depart.id');
        $this->db->join('user','user.employee_id = employee.id');
		$this->db->where('employee.status','ทำงาน');
		$data['employee'] = $this->db->get()->result_array();	
        echo json_encode($data);

    }

	public function recieve_confirm_model(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;
		$this->db->set('field_recieve_status','2');
		$this->db->set('field_setup_status','1');
		$this->db->set('field_recieve_person',$data['recieve_person_id']);
		$this->db->set('field_recieve_toperson',$data['recieve_toperson']);
		$this->db->set('field_recieve_comment',$data['recieve_comment']);
		$this->db->set('field_recievedate',date('Y-m-d H:i:s'));
		$this->db->where('field_id',$data['recieve_id']);
		$this->db->update('tb_signv2');

		// timeline
		$this->db->select('field_docno');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$data['recieve_id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0]['field_docno'];

		$field_detail = 'แผนก รับป้าย หมายเหตุ '.$data['recieve_comment'].' เลขที่เอกสาร '.$data_docno;
		$this->db->set('field_sign_id',$data['recieve_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',3);
		$this->db->set('field_createdate',date('Y-m-d H:i:s'));
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		// 

		echo json_encode($data);
	}

	public function setup_confirm_model(){
		$data = $_POST;
		$this->db->select('field_id');
        $this->db->from('tb_signv2');
		$this->db->where('field_id',$data['id']);
		$this->db->where('field_setup_status','2');
		$this->db->where('field_recheck_status','1');
		$check_update = $this->db->get()->result_array();	

		if (count($check_update) != 0) {
			# code...
		}else{

			$this->db->set('field_setup_status','2');
			$this->db->set('field_recheck_status','1');
			$this->db->set('field_setup_person',$_SESSION['saeree_employee']);
			$this->db->set('field_setupdate',date('Y-m-d H:i:s'));
			$this->db->where('field_id',$data['id']);
			$this->db->update('tb_signv2');

			// timeline
			$this->db->select('field_docno');
			$this->db->from('tb_signv2');
			$this->db->where('field_id',$data['id']);
			$this->db->limit(1);
			$data_docno = $this->db->get()->result_array()[0]['field_docno'];

			$field_detail = 'แผนก ติดตั้งป้าย เลขที่เอกสาร '.$data_docno;
			$this->db->set('field_sign_id',$data['id']);
			$this->db->set('field_detail',$field_detail);
			$this->db->set('field_status',6);
			$this->db->set('field_createdate',date('Y-m-d H:i:s'));
			$this->db->set('field_creator',$_SESSION['saeree_employee']);
			$this->db->insert('tb_signv2_timeline');
			// 

			$this->db->select('
			tb_signv2.field_docno,
			tb_signv2_sub.field_itemcode,
			tb_signv2_sub.field_itemname,
			tb_signv2_sub.field_groupcode,
			tb_signv2_sub.field_signplace,
			tb_signv2_sub.field_signsize,
			tb_signv2_sub.field_type_sign_price,
			tb_signv2_sub.field_id,
			tb_signv2_sub.field_signamount
			');
			$this->db->from('tb_signv2_sub');
			$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_sub.field_sign_id','left');
			$this->db->where('field_sign_id',$data['id']);
			$data['sign_sub'] = $this->db->get()->result_array();	
		
			$y = 0;
			foreach ($data['sign_sub'] as  $val) {

				$this->db->set('field_setup_person',$data['setup_per'][$y]);
				$this->db->where('field_id',$val['field_id']);
				$this->db->update('tb_signv2_sub');
			

				// $data['person_setup'][] = $data['setup_per'][$y];
				$y++;
				for ($i=0; $i < $val['field_signamount']; $i++) { 
					$this->db->set('field_sg_docno',$val['field_docno']);
					$this->db->set('field_item_code',$val['field_itemcode']);
					$this->db->set('field_item_name',$val['field_itemname']);
					$this->db->set('field_groupcode',$val['field_groupcode']);
					$this->db->set('field_place_id',$val['field_signplace']);
					$this->db->set('sign_size',$val['field_signsize']);
					$this->db->set('field_type_sign_price',$val['field_type_sign_price']);
					$this->db->insert('tb_sign_old_new');
				}
			}
		}
		echo json_encode($data);
	}

	public function unsetup_confirm_model(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;
		$this->db->set('field_setup_comment',$data['comment']);
		$this->db->set('field_setup_status','3');
		$this->db->set('field_recheck_status','1');
		$this->db->set('field_setup_person',$_SESSION['saeree_employee']);
		$this->db->set('field_setupdate',date('Y-m-d H:i:s'));
		$this->db->where('field_id',$data['id']);
		$this->db->update('tb_signv2');

		$this->db->select('
		tb_signv2.field_docno,
		tb_signv2_sub.field_itemcode,
		tb_signv2_sub.field_signplace,
		tb_signv2_sub.field_signsize,
		tb_signv2_sub.field_type_sign_price,
		tb_signv2_sub.field_id,
		tb_signv2_sub.field_signamount
		');
        $this->db->from('tb_signv2_sub');
		$this->db->join('tb_signv2','tb_signv2.field_id = tb_signv2_sub.field_sign_id','left');
		$this->db->where('field_sign_id',$data['id']);
		$data['sign_sub'] = $this->db->get()->result_array();	
	
		$y = 0;
		foreach ($data['sign_sub'] as  $val) {
			// $data['person_setup'][] = $data['setup_per'][$y];
			$y++;
			for ($i=0; $i < $val['field_signamount']; $i++) { 
				$this->db->set('field_sg_docno',$val['field_docno']);
				$this->db->set('field_item_code',$val['field_itemcode']);
				$this->db->set('field_place_id',$val['field_signplace']);
				$this->db->set('sign_size',$val['field_signsize']);
				$this->db->set('field_type_sign_price',$val['field_type_sign_price']);
				$this->db->insert('tb_sign_old_new');
			}
		}

		// timeline
		$this->db->select('field_docno');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$data['id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0]['field_docno'];

		$field_detail = 'แผนก ไม่ติดตั้ง หมายเหตุ '.$data['comment'].' เลขที่เอกสาร '.$data_docno;
		$this->db->set('field_sign_id',$data['id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',6);
		$this->db->set('field_createdate',date('Y-m-d H:i:s'));
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		// 

		echo json_encode($data);
	}

	public function waitsetup_confirm(){
		$this->db = $this->load->database('default', TRUE);
		$data = $_POST;
		$this->db->set('field_setup_comment',$data['comment']);
		$this->db->set('field_setup_status','4');
		$this->db->set('field_setup_person',$_SESSION['saeree_employee']);
		$this->db->set('field_setupdate',date('Y-m-d H:i:s'));
		$this->db->where('field_id',$data['id']);
		$this->db->update('tb_signv2');

		// timeline
		$this->db->select('field_docno');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$data['id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0]['field_docno'];

		$field_detail = 'แผนก ยังไม่พร้อมติดตั้ง หมายเหตุ '.$data['comment'].' เลขที่เอกสาร '.$data_docno;
		$this->db->set('field_sign_id',$data['id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',0);
		$this->db->set('field_createdate',date('Y-m-d H:i:s'));
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		// 

		echo json_encode($data);
	}

	public function recheck_print_model($field_id){
		
		$this->db = $this->load->database('default', TRUE);
		$this->db->select('
			tb_sign.*,
			tb_signv2_sub.field_itemname,
			tb_sign_place.field_place_name,
			tb_sign_size.size_name,
			tb_sign_type_price.type_name_price,
			employee.firstname as creator_firstname,
			employee.lastname as creator_lastname,
			employee.nickname as creator_nickname,
			cf.firstname as confirm_firstname,
			cf.nickname as confirm_nickname,
			pk.firstname as packing_firstname,
			pk.nickname as packing_nickname,
			rc.firstname as recieve_firstname,
			rc.nickname as recieve_nickname,
			rcp.firstname as recievetoperson_firstname,
			rcp.nickname as recievetoperson_nickname,
			st.firstname as setup_firstname,
			st.nickname as setup_nickname,
			recheck.firstname as recheck_firstname,
			recheck.nickname as recheck_nickname');
		$this->db->from('tb_sign');
		$this->db->join('tb_signv2_sub','tb_signv2_sub.field_sign_id = tb_sign.field_id','left');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize','left');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_signv2_sub.field_signplace','left');
		$this->db->join('employee','employee.id = tb_sign.field_creator','left');
		$this->db->join('employee cf','cf.id = tb_sign.field_confirm_person','left');
		$this->db->join('employee pk','pk.id = tb_sign.field_packing_person','left');
		$this->db->join('employee rc','rc.id = tb_sign.field_recieve_person','left');
		$this->db->join('employee rcp','rcp.id = tb_sign.field_recieve_toperson','left');
		$this->db->join('employee st','st.id = tb_sign.field_setup_person','left');
		$this->db->join('employee recheck','recheck.id = tb_sign.field_recheck_person','left');
		$this->db->where('tb_sign.field_id',$field_id);
		$data['Sign'] = $this->db->get()->result_array()[0];	

		$this->db->select('
			tb_signv2_sub.*,
			tb_signv2_sub.field_itemname,
			tb_sign_place.field_place_name,
			tb_sign_size.size_name,
			tb_sign_type_price.type_name_price
		');
		$this->db->from('tb_signv2_sub');
		$this->db->join('tb_sign_size','tb_sign_size.id = tb_signv2_sub.field_signsize','left');
		$this->db->join('tb_sign_type_price','tb_sign_type_price.id = tb_signv2_sub.field_type_sign_price','left');
		$this->db->join('tb_sign_place','tb_sign_place.field_place_id = tb_signv2_sub.field_signplace','left');
		$this->db->where('tb_signv2_sub.field_sign_id',$field_id);
		$data['SignSub'] = $this->db->get()->result_array();	

		$field_docno = '';  
		$this->db->select('field_docno');
		$this->db->from('tb_sign');
		$this->db->where('tb_sign.field_id',$field_id);
		$field_docno = $this->db->get()->result_array();
		$this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('SKWorks','พิมพ์ : ใบตรวจสอบการติดตั้งป้ายสินค้า','".$_SESSION['saeree_name']." พิมพ์ : ใบตรวจสอบการติดตั้งป้ายสินค้า เลขที่เอกสาร ".$field_docno[0]['field_docno']." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
		$html = $this->load->view('SignV2/Sign-recheck_print',$data);
        
	}

	public function Sign_loaddata_check(){
		
		$this->db = $this->load->database('default', TRUE);
		$ids = explode(',',$_GET['docno']);

		$this->db->select('
		tb_signv2.field_groupcode,
		tb_signv2.field_active_status,
		tb_signv2.field_upload_status,
		tb_signv2.field_docno,
		tb_signv2.field_itemcode,
		tb_signv2.field_itemname,
		tb_signv2.field_confirm_status,
		tb_signv2.field_packing_status,
		tb_signv2.field_recieve_status,
		tb_signv2.field_setup_status,
		tb_signv2.field_recheck_status,
		tb_signv2.field_recieve_success,
		tb_signv2.field_destroy_status as status_destroy,
		tb_signv2.field_id as sign_id,
		tb_signv2.field_request_status,
		tb_sign_cause.type_name,
		employee.firstname as creator_firstname,
		employee.lastname as creator_lastname,
		employee.nickname as creator_nickname,
		cf.firstname as confirm_firstname,
		cf.nickname as confirm_nickname,
		pk.firstname as packing_firstname,
		pk.nickname as packing_nickname,
		rc.firstname as recieve_firstname,
		rc.nickname as recieve_nickname,
		rcp.firstname as recievetoperson_firstname,
		rcp.nickname as recievetoperson_nickname,
		st.firstname as setup_firstname,
		st.nickname as setup_nickname,
		recheck.firstname as recheck_firstname,
		recheck.nickname as recheck_nickname
		');
		$this->db->from('tb_signv2');
		$this->db->join('employee','employee.id = tb_signv2.field_creator','left');
		$this->db->join('employee cf','cf.id = tb_signv2.field_confirm_person','left');
		$this->db->join('employee pk','pk.id = tb_signv2.field_packing_person','left');
		$this->db->join('employee rc','rc.id = tb_signv2.field_recieve_person','left');
		$this->db->join('employee rcp','rcp.id = tb_signv2.field_recieve_toperson','left');
		$this->db->join('employee st','st.id = tb_signv2.field_setup_person','left');
		$this->db->join('employee recheck','recheck.id = tb_signv2.field_recheck_person','left');
		$this->db->join('tb_sign_cause','tb_sign_cause.id = tb_signv2.field_type','left');
		$this->db->where_in('field_docno',$ids);
		$this->db->order_by('field_groupcode','ASC');
		$data['sign'] = $this->db->get()->result_array();

		$this->db->select('
		employee.id,
		employee.pepleid,
		employee.firstname,
		employee.lastname,
		employee.nickname,
        depart.name AS departname,
        employee.id AS employeeid');
        $this->db->from('employee');
        $this->db->join('depart','employee.depart_id = depart.id');
        $this->db->join('user','user.employee_id = employee.id');	
		$this->db->where('employee.id',$_SESSION['saeree_employee']);
		$data['employee'] = $this->db->get()->result_array()[0];	

		$paper = 'A4';

		$data['title_list'] = $_GET['title_list'];

		$data['search_status_sign'] = $_GET['search_status_sign'];

		$html = $this->load->view('SignV2/Sign-loaddata_check-print',$data,true);
		$mypdf = new mPdf('utf8_encode', $paper, '0', 'rsu');
		$mypdf->AddPage();
		$mypdf->useAdobeCJK = true;
		// $mypdf->SetWatermarkText('ดูเท่านั้น');
		// $mypdf->SetWatermarkText('สำหรับ ดูเท่านั้น', 0.5);
		// $mypdf->showWatermarkText = true;
		// $mypdf->WriteHTML($bootstrap);
		$mypdf->WriteHTML($html);
		$mypdf->Output("บาร์โค้ด" . ".pdf", 'I');

	}

	public function Sign_dosign_print(){
		
		$this->db = $this->load->database('default', TRUE);
		$ids = explode('-',$_GET['id']);
		// print_r($ids);
		$i = 0;
		foreach ($ids as $field_id){
			$i++;
			// $data['Ad'][$i] = $field_id;
			// if($id != ''){
				$this->db->select('*');
				$this->db->from('tb_signv2_sub');
				$this->db->where('field_id',$field_id);
				$data['sign'][] = $this->db->get()->result_array();
				// $maindata = $this->db->get()->result_array();
				// $data['Ar'] = $id;
			// }	
		}

		$this->db->select('
		employee.id,
		employee.pepleid,
		employee.firstname,
		employee.lastname,
		employee.nickname,
        depart.name AS departname,
        employee.id AS employeeid');
        $this->db->from('employee');
        $this->db->join('depart','employee.depart_id = depart.id');
        $this->db->join('user','user.employee_id = employee.id');	
		$this->db->where('employee.id',$_SESSION['saeree_employee']);
		$data['employee'] = $this->db->get()->result_array()[0];	

		// print_r($_GET);
		$paper = $_GET['paper'];
		$data['orderby'] = $_GET['orderby'];
		// $data['Ar'] = $ids;
		// $data['Helloworld'] = 'Helloworld';
		// $html = $this->load->view('Sign/Sign-dosign-print',$data);
		// $bootstrap = base_url('assets/css/bootstrap.min.css');
		// $data['boot'] = $bootstrap;
		$data['orderby'] = $_GET['orderby'];
		$data['arrow'] = $_GET['arrow'];
		$data['detail'] = $_GET['detail'];
		$html = $this->load->view('SignV2/Sign-dosign-print',$data,true);
		$mypdf = new mPdf('utf8_encode', $paper, '0', 'rsu');
		$mypdf->AddPage();
		$mypdf->useAdobeCJK = true;
		// $mypdf->SetWatermarkText('ดูเท่านั้น');
		// $mypdf->SetWatermarkText('สำหรับ ดูเท่านั้น', 0.5);
		// $mypdf->showWatermarkText = true;
		// $mypdf->WriteHTML($bootstrap);
		$mypdf->WriteHTML($html);
		$mypdf->Output("บาร์โค้ด" . ".pdf", 'I');

	}

	public function Sign_dosign_print_preview(){
		
		$this->db = $this->load->database('default', TRUE);
		$ids = explode('-',$_GET['id']);
		// print_r($ids);
		$i = 0;
		foreach ($ids as $field_id){
			$i++;
			// $data['Ad'][$i] = $field_id;
			// if($id != ''){
				$this->db->select('*');
				$this->db->from('tb_signv2_sub');
				$this->db->where('field_id',$field_id);
				$data['sign'][] = $this->db->get()->result_array();
				// $maindata = $this->db->get()->result_array();
				// $data['Ar'] = $id;
			// }	
		}

		$this->db->select('
		employee.id,
		employee.pepleid,
		employee.firstname,
		employee.lastname,
		employee.nickname,
        depart.name AS departname,
        employee.id AS employeeid');
        $this->db->from('employee');
        $this->db->join('depart','employee.depart_id = depart.id');
        $this->db->join('user','user.employee_id = employee.id');	
		$this->db->where('employee.id',$_SESSION['saeree_employee']);
		$data['employee'] = $this->db->get()->result_array()[0];	

		// print_r($_GET);
		$paper = $_GET['paper'];
		$data['orderby'] = $_GET['orderby'];
		// $data['Ar'] = $ids;
		// $data['Helloworld'] = 'Helloworld';
		// $html = $this->load->view('Sign/Sign-dosign-print',$data);
		// $bootstrap = base_url('assets/css/bootstrap.min.css');
		// $data['boot'] = $bootstrap;
		$data['orderby'] = $_GET['orderby'];
		$data['arrow'] = $_GET['arrow'];
		$data['detail'] = $_GET['detail'];
		$html = $this->load->view('SignV2/Sign-dosign-print',$data,true);
		$mypdf = new mPdf('utf8_encode', $paper, '0', 'rsu');
		$mypdf->AddPage();
		$mypdf->useAdobeCJK = true;
		// $mypdf->SetWatermarkText('ดูเท่านั้น');
		$mypdf->SetWatermarkText('สำหรับ ดูเท่านั้น', 0.5);
		$mypdf->showWatermarkText = true;
		// $mypdf->WriteHTML($bootstrap);
		$mypdf->WriteHTML($html);
		$mypdf->Output("บาร์โค้ด" . ".pdf", 'I');

	}

	public function update_recheck_destroy(){
		$this->db = $this->load->database('default', TRUE);

		if ($_POST['status_recheck'] == 3) {
			# code...
			$this->db->set('field_status',0);
			$_POST['status_recheck'] = 0;
		}
		$this->db->set('field_recheck_status',$_POST['status_recheck']);
		$this->db->set('field_recheck_person',$_SESSION['saeree_employee']);
		$this->db->set('field_recheck_date',date('Y-m-d H:i:s'));
		$this->db->where('field_id',$_POST['field_id']);
		$this->db->update('tb_sign_destroy_list');

		echo json_encode($data);
	}

	public function change_active_status(){
		$this->db = $this->load->database('default', TRUE);

		$this->db->select('field_id,field_itemcode,field_docno');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$_POST['field_id']);
		$this->db->limit(1);
		$data['sg_main'] = $this->db->get()->result_array()[0];

		$this->db->select('*');
		$this->db->from('tb_sign_destroy_list');
		$this->db->like('field_docno','DT');
		$this->db->where('field_itemcode',$data['sg_main']['field_itemcode']);
		$this->db->limit(1);
		$this->db->order_by('field_id','DESC');
		$data['sg_destroy_main'] = $this->db->get()->result_array()[0];

		$this->db->select('*');
		$this->db->from('tb_sign_destroy_sub');
		$this->db->where('field_destroy_id',$data['sg_destroy_main']['field_id']);
		$data['sg_destroy_sub'] = $this->db->get()->result_array();

		foreach ($data['sg_destroy_sub'] as $val) {

			$this->db->set('field_place_id',$val['field_place_id']);
			$this->db->set('field_type_sign_price',$val['field_type_sign_price']);
			$this->db->set('sign_size',$val['sign_size']);
			$this->db->set('field_item_code',$data['sg_main']['field_itemcode']);
			$this->db->set('field_sg_docno',$data['sg_main']['field_docno']);
			$this->db->insert('tb_sign_old_new');
		}

		$this->db->set('field_active_status',1);
		$this->db->where('field_id',$_POST['field_id']);
		$this->db->update('tb_signv2');

		$field_detail = 'เปลี่ยนสถานะจากเลิกใช้งานเป็นใช้งาน';
		
		$this->db->set('field_status',1);
		$this->db->set('field_sign_id',$_POST['field_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_createdate',date('Y-m-d H:i:s'));
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');

		echo json_encode($data);
	}

	public function recheck_confirm_model(){
		$data = $_POST;

		$this->db->select('field_docno,field_setup_status,field_active_status,field_upload_status');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$data['recheck_id']);
		$this->db->limit(1);
		$status_setup = $this->db->get()->result_array()[0];

		if ($status_setup['field_active_status'] == 1 && $status_setup['field_upload_status'] == 1) {

			$this->db->select('field_status');
			$this->db->from('tb_sign_destroy_list');
			$this->db->where('field_docno',$status_setup['field_docno']);
			// $this->db->limit(1);
			$this->db->order_by('field_id','DESC');
			$upload_status = $this->db->get()->result_array()[0];
			$upload_count = count($upload_status);

			// $data['upload_status'] = $upload_status;

			if ($upload_count == 0 ) {
				if ($status_setup['field_setup_status'] == 3) {
					$data['recheck_status'] = 4 ;
				}
				$this->db->set('field_recheck_status',$data['recheck_status']);
				$this->db->set('field_recheck_comment',$data['recheck_comment']);
				$this->db->set('field_recheck_person',$data['recheck_personid']);
				$this->db->set('field_recheckdate',date('Y-m-d H:i:s'));
				$this->db->where('field_id',$data['recheck_id']);
				$this->db->update('tb_signv2');

				if ($data['recheck_status'] == 2) {
					$this->db->set('field_recheck_status',$data['recheck_status']);
					$this->db->set('field_recheck_person',$data['recheck_personid']);
					$this->db->set('field_recheck_date',date('Y-m-d H:i:s'));
					$this->db->where('field_sg_id',$data['recheck_id']);
					$this->db->update('tb_sign_destroy_list');
				}

				// timeline
				$this->db->select('field_docno');
				$this->db->from('tb_signv2');
				$this->db->where('field_id',$data['recheck_id']);
				$this->db->limit(1);
				$data_docno = $this->db->get()->result_array()[0]['field_docno'];

				if ($data['recheck_status'] == 2) {
					$field_detail = 'ตรวจสอบ ผ่านการตรวจสอบ หมายเหตุ '.$data['recheck_comment'].' เลขที่เอกสาร '.$data_docno;
					$this->db->set('field_status',1);
				}elseif ($data['recheck_status'] == 4) {
					$field_detail = 'ตรวจสอบ ไม่ผ่านการตรวจสอบ หมายเหตุ '.$data['recheck_comment'].' เลขที่เอกสาร '.$data_docno;
					$this->db->set('field_status',5);
				}elseif ($data['recheck_status'] == 3) {
					$field_detail = 'ตรวจสอบ ไม่ผ่านการตรวจสอบ หมายเหตุ '.$data['recheck_comment'].' เลขที่เอกสาร '.$data_docno;
					$this->db->set('field_status',5);
				}
				
				$this->db->set('field_sign_id',$data['recheck_id']);
				$this->db->set('field_detail',$field_detail);

				$this->db->set('field_createdate',date('Y-m-d H:i:s'));
				$this->db->set('field_creator',$_SESSION['saeree_employee']);
				$this->db->insert('tb_signv2_timeline');
				// 

				$data['check'] = 'success';
				echo json_encode($data);
			}else{
				if ($upload_status['field_status'] == '0') {
					$data['check'] = 'nope';
					echo json_encode($data);
				}else{
					if ($status_setup['field_setup_status'] == 3) {
						$data['recheck_status'] = 3 ;
					}
					$this->db->set('field_recheck_status',$data['recheck_status']);
					$this->db->set('field_recheck_comment',$data['recheck_comment']);
					$this->db->set('field_recheck_person',$data['recheck_personid']);
					$this->db->set('field_recheckdate',date('Y-m-d H:i:s'));
					$this->db->where('field_id',$data['recheck_id']);
					$this->db->update('tb_signv2');

					if ($data['recheck_status'] == 2) {
						$this->db->set('field_recheck_status',$data['recheck_status']);
						$this->db->set('field_recheck_person',$data['recheck_personid']);
						$this->db->set('field_recheck_date',date('Y-m-d H:i:s'));
						$this->db->where('field_sg_id',$data['recheck_id']);
						$this->db->update('tb_sign_destroy_list');
					}

					// timeline
					$this->db->select('field_docno');
					$this->db->from('tb_signv2');
					$this->db->where('field_id',$data['recheck_id']);
					$this->db->limit(1);
					$data_docno = $this->db->get()->result_array()[0]['field_docno'];

					if ($data['recheck_status'] == 2) {
						$field_detail = 'ตรวจสอบ ผ่านการตรวจสอบ หมายเหตุ '.$data['recheck_comment'].' เลขที่เอกสาร '.$data_docno;
						$this->db->set('field_status',1);
					}elseif ($data['recheck_status'] == 4) {
						$field_detail = 'ตรวจสอบ ไม่ผ่านการตรวจสอบ หมายเหตุ '.$data['recheck_comment'].' เลขที่เอกสาร '.$data_docno;
						$this->db->set('field_status',5);
					}elseif ($data['recheck_status'] == 3) {
						$field_detail = 'ตรวจสอบ ไม่ผ่านการตรวจสอบ หมายเหตุ '.$data['recheck_comment'].' เลขที่เอกสาร '.$data_docno;
						$this->db->set('field_status',5);
					}
					
					$this->db->set('field_sign_id',$data['recheck_id']);
					$this->db->set('field_detail',$field_detail);

					$this->db->set('field_createdate',date('Y-m-d H:i:s'));
					$this->db->set('field_creator',$_SESSION['saeree_employee']);
					$this->db->insert('tb_signv2_timeline');
					// 

					$data['check'] = 'success';
					echo json_encode($data);
				}
			}
		}else{
			$data['check'] = 'error';
			echo json_encode($data);
		}

	}

	public function update_place_name(){
		$data = $_POST;
		$this->db->set('field_place_name',$data['place_new_name']);
		$this->db->set('field_edit_person',$_SESSION['saeree_employee']);
		$this->db->set('field_edit_date',date('Y-m-d H:i:s'));
		$this->db->where('field_place_id',$data['place_id']);
		$this->db->update('tb_sign_place');
		
		echo json_encode('success');
	}

	public function edit_sign(){
		$data = $_POST;
		$this->db->set('field_confirm_status','0');
		$this->db->set('field_edit_person',$_SESSION['saeree_employee']);
		$this->db->set('field_edit_date',date('Y-m-d H:i:s'));
		$this->db->where('field_id',$data['id']);
		$this->db->update('tb_signv2');
		echo json_encode($data);
	}

	// public function backtoedit_confirm(){
	// 	$data = $_POST;
	// 	$this->db->set('field_confirm_status','0');
	// 	$this->db->set('field_edit_comment',$data['comment']);
	// 	$this->db->set('field_edit_person',$_SESSION['saeree_employee']);
	// 	$this->db->set('field_edit_date',date('Y-m-d H:i:s'));
	// 	$this->db->where('field_id',$data['field_id']);
	// 	$this->db->update('tb_signv2');
	// 	echo json_encode($data);
	// }

	public function upload_file_3_model()
 {

  $_data = $_REQUEST;

  $link_1 = $_data['upload_link_1'];
  $field_id = $_data['upload_field_id'];

  if(file_exists("./assets/images/$link_1/$field_id")){

   $directory = "./assets/images/$link_1/$field_id/";
   $filecount = 0;
   $files = glob($directory . "*");
   if ($files){
    $filecount = count($files);
   }

   foreach($_FILES['file']['name'] as $key=>$val){
    
    $filecount++;

    $file_type = $_FILES['file']['type'][0];

    if($file_type == 'image/jpeg'){

     $file_name = $_FILES['file']['name'][$key];
     $file_tmp_name = $_FILES['file']['tmp_name'][$key];
     $file_target = './assets/images/'.$link_1.'/'.$field_id.'/';
     $file_size = $_FILES['file']['size'][$key];

     $images = $file_tmp_name;
     $temp = explode('.', $file_name);
     $newfilename = $filecount . '.' . end($temp);
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

     $data['check_file'] = 'success';

    }else if(
     $file_type == 'application/pdf'
     || $file_type == 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
    ){
     
     $temp = explode(".", $_FILES["file"]["name"][$key]);
     $newfilename = $filecount . '.' . end($temp);
     move_uploaded_file($_FILES["file"]["tmp_name"][$key], './assets/images/'.$link_1.'/'.$field_id.'/'.$newfilename);

     $data['check_file'] = 'success';
    
    }else{
     $data['check_file'] = 'error_data_file';
    }

   }

  }else{

   // New Folder
   mkdir('./assets/images/'. $link_1 .'/'.$field_id, 0777, true);
   $filecount = 0;
   foreach($_FILES['file']['name'] as $key=>$val){
   
    $filecount++;

    $file_type = $_FILES['file']['type'][0];

    if($file_type == 'image/jpeg'){
    
     $file_name = $_FILES['file']['name'][$key];
     $file_tmp_name = $_FILES['file']['tmp_name'][$key];
     $file_target = './assets/images/'. $link_1 .'/'.$field_id.'/';
     $file_size = $_FILES['file']['size'][$key];

     $images = $file_tmp_name;
     $temp = explode('.', $file_name);
     $newfilename = $filecount . '.' . end($temp);
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

     $data['check_file'] = 'success';

    }else if(
     $file_type == 'application/pdf'
     || $file_type == 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
    ){
     
     $temp = explode(".", $_FILES["file"]["name"][$key]);
     $newfilename = $filecount . '.' . end($temp);
     move_uploaded_file($_FILES["file"]["tmp_name"][$key], './assets/images/'.$link_1.'/'.$field_id.'/'.$newfilename);

     $data['check_file'] = 'success';

    }else{
     $data['check_file'] = 'error_data_file';
    }

   }

   
  }

  //-------------------------------------Activity_log-------------------------------------------------
   $data_activity_log = array();
   $data_activity_log = array(
    "field_activity" => 'อัพโหลดไฟล์' ,
    "field_table_name" =>  'tb_'. strtolower($link_1),
    "field_table_id" => $field_id,
    "field_creator_id" => $_SESSION['saeree_employee'],
    "field_creator_date" => date('Y-m-d H:i:s')
   );
   $this->All_activity_log_model->add_activity_log_1_model($data_activity_log);
  //-------------------------------------END-Activity_log--------------------------------------------

  
  return $data;

 }

 public function upload_image_destroy(){

	$field_id = $_POST['id'];

	if(file_exists("./assets/images/SignV2Destroy/$field_id")){

		$directory = "./assets/images/SignV2Destroy/$field_id/";
		$filecount = 0;
		$files = glob($directory . "*");

		if($files){
			$filecount = count($files);
		}

		if($filecount < 2){
			//Old Folder
			foreach($_FILES['file']['name'] as $key=>$val){

				$filecount++;
				$file_type = $_FILES['file']['type'][0];
				if($file_type == 'image/jpeg'){
					if($filecount <= 2){
						$numrand = (mt_rand());
						$file_name = $_FILES['file']['name'][$key];
						$file_tmp_name = $_FILES['file']['tmp_name'][$key];
						$file_target = './assets/images/SignV2Destroy/'.$field_id.'/';
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


						$this->db->set('field_status','2');
						$this->db->set('field_upload_date',date('Y-m-d H:i:s'));
						$this->db->set('field_upload_person',$_SESSION['saeree_employee']);
						$this->db->where('field_id',$field_id);
						$this->db->update('tb_sign_destroy_list');

						// timeline main
						// $this->db->select('field_docno');
						// $this->db->from('tb_signv2');
						// $this->db->where('field_id',$field_id);
						// $this->db->limit(1);
						// $data_docno = $this->db->get()->result_array()[0]['field_docno'];

						// $field_detail = 'เพิ่มรูป เลขที่เอกสาร '.$data_docno;
						// $this->db->set('field_sign_id',$field_id);
						// $this->db->set('field_detail',$field_detail);
						// $this->db->set('field_status',2);
						// $this->db->set('field_createdate',date('Y-m-d H:i:s'));
						// $this->db->set('field_creator',$_SESSION['saeree_employee']);
						// $this->db->insert('tb_signv2_timeline');
						// 

						$data['check_pic'] = 'success';
						$field_docno = '';  
						$this->db->select('field_docno');
						$this->db->from('tb_sign');
						$this->db->where('tb_sign.field_id',$field_id);
						$field_docno = $this->db->get()->result_array();
					
					// $this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('sctPeeps','เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม','".$_SESSION['saeree_name']." เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม เลขที่ ".$field_docno[0]['field_docno']." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
					}else{

						$data['check_pic'] = 'maxvalue_more';
						

					}
				}else{
					$data['check_pic'] = 'error_data_file';
				}
			}
		}else{
			$data['check_pic'] = 'maxvalue';
		}
	}else{

		// New Folder
		mkdir('./assets/images/SignV2Destroy/'.$field_id, 0777, true);
		$filecount = 0;

		foreach($_FILES['file']['name'] as $key=>$val){
		   
			$filecount++;
			$file_type = $_FILES['file']['type'][0];
			if($file_type == 'image/jpeg'){
				if($filecount <= 2){

					$numrand = (mt_rand());
					$temp = explode(".", $_FILES["file"]["name"][$key]);
					$newfilename = $numrand . '.' . end($temp);

					$file_name = $_FILES['file']['name'][$key];
					$file_tmp_name = $_FILES['file']['tmp_name'][$key];
					$file_target = './assets/images/SignV2Destroy/'.$field_id.'/';
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


					$this->db = $this->load->database('default', TRUE);
					date_default_timezone_set('Asia/Bangkok');
			
					$this->db->set('field_status','2');
					$this->db->set('field_upload_date',date('Y-m-d H:i:s'));
					$this->db->set('field_upload_person',$_SESSION['saeree_employee']);
					$this->db->where('field_id',$field_id);
					$this->db->update('tb_sign_destroy_list');

					// timeline main
					// $this->db->select('field_docno');
					// $this->db->from('tb_signv2');
					// $this->db->where('field_id',$field_id);
					// $this->db->limit(1);
					// $data_docno = $this->db->get()->result_array()[0]['field_docno'];

					// $field_detail = 'เพิ่มรูป เลขที่เอกสาร '.$data_docno;
					// $this->db->set('field_sign_id',$field_id);
					// $this->db->set('field_detail',$field_detail);
					// $this->db->set('field_status',2);
					// $this->db->set('field_createdate',date('Y-m-d H:i:s'));
					// $this->db->set('field_creator',$_SESSION['saeree_employee']);
					// $this->db->insert('tb_signv2_timeline');
					// 
		
					$data['check_pic'] = 'success';
					// $field_docno = '';  
					// $this->db->select('field_docno');
					// $this->db->from('tb_sign');
					// $this->db->where('tb_sign.field_id',$field_id);
					// $field_docno = $this->db->get()->result_array();
					// $this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('sctPeeps','เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม','".$_SESSION['saeree_name']." เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม เลขที่ ".$field_docno[0]['field_docno']." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
					

				}else{
					$data['check_pic'] = 'maxvalue_more';
				}
			}else{
				$data['check_pic'] = 'error_data_file';
			}
		}

	}


   echo json_encode($data);

}

	public function upload_image_model(){

		$field_id = $_POST['id'];

		if(file_exists("./assets/images/SignV2/$field_id")){

			$directory = "./assets/images/SignV2/$field_id/";
			$filecount = 0;
			$files = glob($directory . "*");

			if($files){
				$filecount = count($files);
			}

			if($filecount < 2){
				//Old Folder
				foreach($_FILES['file']['name'] as $key=>$val){

					$filecount++;
					$file_type = $_FILES['file']['type'][0];
					if($file_type == 'image/jpeg'){
						if($filecount <= 2){
							$numrand = (mt_rand());
							$file_name = $_FILES['file']['name'][$key];
							$file_tmp_name = $_FILES['file']['tmp_name'][$key];
							$file_target = './assets/images/SignV2/'.$field_id.'/';
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
							$this->db->from('tb_sign');
							$this->db->where('tb_sign.field_id',$field_id);
							$field_docno = $this->db->get()->result_array();
						
						// $this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('sctPeeps','เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม','".$_SESSION['saeree_name']." เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม เลขที่ ".$field_docno[0]['field_docno']." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
						}else{

							$data['check_pic'] = 'maxvalue_more';
							
						}
						$this->db->set('field_upload_status',1);
						$this->db->set('field_upload_date',date('Y-m-d H:i:s'));
						$this->db->where('field_id',$field_id);
						$this->db->update('tb_signv2');

						// timeline main
						$this->db->select('field_docno');
						$this->db->from('tb_signv2');
						$this->db->where('field_id',$field_id);
						$this->db->limit(1);
						$data_docno = $this->db->get()->result_array()[0]['field_docno'];

						$field_detail = 'เพิ่มรูป เลขที่เอกสาร '.$data_docno;
						$this->db->set('field_sign_id',$field_id);
						$this->db->set('field_detail',$field_detail);
						$this->db->set('field_status',2);
						$this->db->set('field_createdate',date('Y-m-d H:i:s'));
						$this->db->set('field_creator',$_SESSION['saeree_employee']);
						$this->db->insert('tb_signv2_timeline');
						// 
							
					}else{
						$data['check_pic'] = 'error_data_file';
					}
				}
			}else{
				$data['check_pic'] = 'maxvalue';
			}
		}else{

			// New Folder
			mkdir('./assets/images/SignV2/'.$field_id, 0777, true);
			$filecount = 0;

			foreach($_FILES['file']['name'] as $key=>$val){
			   
				$filecount++;
				$file_type = $_FILES['file']['type'][0];
				if($file_type == 'image/jpeg'){
					if($filecount <= 2){

						$numrand = (mt_rand());
						$temp = explode(".", $_FILES["file"]["name"][$key]);
						$newfilename = $numrand . '.' . end($temp);

						$file_name = $_FILES['file']['name'][$key];
						$file_tmp_name = $_FILES['file']['tmp_name'][$key];
						$file_target = './assets/images/SignV2/'.$field_id.'/';
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
						$this->db->from('tb_sign');
						$this->db->where('tb_sign.field_id',$field_id);
						$field_docno = $this->db->get()->result_array();
						// $this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('sctPeeps','เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม','".$_SESSION['saeree_name']." เพิ่มรูปภาพ : ใบสั่งผลิต / สั่งซ่อม เลขที่ ".$field_docno[0]['field_docno']." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
						

					}else{
						$data['check_pic'] = 'maxvalue_more';
					}

					$this->db->set('field_upload_status',1);
					$this->db->set('field_upload_date',date('Y-m-d H:i:s'));
					$this->db->where('field_id',$field_id);
					$this->db->update('tb_signv2');

					// timeline main
					$this->db->select('field_docno');
					$this->db->from('tb_signv2');
					$this->db->where('field_id',$field_id);
					$this->db->limit(1);
					$data_docno = $this->db->get()->result_array()[0]['field_docno'];

					$field_detail = 'เพิ่มรูป เลขที่เอกสาร '.$data_docno;
					$this->db->set('field_sign_id',$field_id);
					$this->db->set('field_detail',$field_detail);
					$this->db->set('field_status',2);
					$this->db->set('field_createdate',date('Y-m-d H:i:s'));
					$this->db->set('field_creator',$_SESSION['saeree_employee']);
					$this->db->insert('tb_signv2_timeline');
					// 
				}else{
					$data['check_pic'] = 'error_data_file';
				}
			}

		}

	
	   echo json_encode($data);

	}

	public function get_viewfinal_model(){

		$this->db = $this->load->database('default', TRUE);
		$field_id = $_POST['id'];

		$this->db->select('
		tb_signv2_sub.*,
		tb_sign.field_docno,
		tb_sign.field_type,
		tb_sign.field_datechange,
		tb_sign.field_createdate,
		employee.firstname as creator_firstname,
		employee.lastname as creator_lastname,
		employee.nickname as creator_nickname');
        $this->db->from('tb_signv2_sub');
		$this->db->join('tb_sign','tb_sign.field_id = tb_signv2_sub.field_sign_id');
		$this->db->join('employee','employee.id = tb_sign.field_creator','left');
        $this->db->where('field_sign_id',$field_id);	
        $this->db->order_by('field_id','ASC');	
        $data['ViewPurchase'] = $this->db->get()->result_array();

		$this->db->select('tb_sign.*,
		employee.firstname as confirm_firstname,
		employee.lastname as confirm_lastname,
		employee.nickname as confirm_nickname');
        $this->db->from('tb_sign');
		$this->db->join('employee','employee.id = tb_sign.field_confirm_person','left');
        $this->db->where('field_id',$field_id);	
        $this->db->order_by('field_id','ASC');	
        $data['ViewDepart'] = $this->db->get()->result_array();


		// $this->db->select('
		// tb_sign.*,
		// employee.firstname as creator_firstname,
		// employee.lastname as creator_lastname,
		// employee.nickname as creator_nickname,
		
		// cf.firstname as confirm_firstname,
		// cf.lastname as confirm_lastname,
		// cf.nickname as confirm_nickname,
		
		// pk.firstname as packing_firstname,
		// pk.lastname as packing_lastname,
		// pk.nickname as packing_nickname,
		
		// rt.firstname as return_firstname,
		// rt.lastname as return_lastname,
		// rt.nickname as return_nickname,

		// rc.firstname as recieve_firstname,
		// rc.lastname as recieve_lastname,
		// rc.nickname as recieve_nickname,

		// rcp.firstname as recievetoperson_firstname,
		// rcp.lastname as recievetoperson_lastname,
		// rcp.nickname as recievetoperson_nickname,

		// st.firstname as setup_firstname,
		// st.lastname as setup_lastname,
		// st.nickname as setup_nickname,
		
		// recheck.firstname as recheck_firstname,
		// recheck.lastname as recheck_lastname,
		// recheck.nickname as recheck_nickname');

		// $this->db->from('tb_sign');
		// $this->db->join('employee','employee.id = tb_sign.field_creator','left');
		// $this->db->join('employee cf','cf.id = tb_sign.field_confirm_person','left');
		// $this->db->join('employee pk','pk.id = tb_sign.field_packing_person','left');
		// $this->db->join('employee rt','rt.id = tb_sign.field_return_person','left');
		// $this->db->join('employee rc','rc.id = tb_sign.field_recieve_person','left');
		// $this->db->join('employee rcp','rcp.id = tb_sign.field_recieve_toperson','left');
		// $this->db->join('employee st','st.id = tb_sign.field_setup_person','left');
		// $this->db->join('employee recheck','recheck.id = tb_sign.field_recheck_person','left');
		// $this->db->where('tb_sign.field_id',$field_id);
		// $data['ViewSign'] = $this->db->get()->result_array()[0];
		
        // $this->db->select('*');
        // $this->db->from('tb_signv2_sub');
        // $this->db->where('field_sign_id',$field_id);	
        // $this->db->order_by('field_id','ASC');	
        // $data['ViewSignSub'] = $this->db->get()->result_array();

		echo json_encode($data);
	
	}

	public function get_image_model(){
		if(file_exists("assets/images/SignV2/".$_POST['id'])){
			$data['scandir'] = scandir("assets/images/SignV2/".$_POST['id']);
			echo json_encode($data);
		}
	}

	public function depart_addsign_model(){
		$this->db = $this->load->database('default', TRUE);
		date_default_timezone_set('Asia/Bangkok');
		$data = $_REQUEST;
		$destroy_id = explode(',',$data['destroy_id']);
		$date_today = date('Y-m-d H:i:s');
		if(isset($data['tb_addsign'])){
			foreach($data['tb_addsign'] as $row1){
				if($row1['Code'] == '' ){
				}else{
					$name_table = 'tb_signv2';
					$name_field_id = 'field_id';
					$name_field_date = 'field_createdate';
					$name_field_docno = 'field_docno';
					$name_title  = 'SG';
					$data_docno = $this->get_create_docno_1_model(
					$name_table,
					$name_field_id,
					$name_field_date,
					$name_field_docno,
					$name_title
				);
					if ($data['addcon_person'] == 'add_again') {
						$this->db->set('field_docno',$data_docno);
						$this->db->set('field_itemcode',$row1['Code']);
						$this->db->set('field_groupcode',$row1['GroupCode']);
						$this->db->set('field_type',$data['sign_type']);
						$this->db->set('field_creator',$_SESSION['saeree_employee']);	
						$this->db->set('field_comfirm_needdate',$data['confirmsign_needdate']);
						$this->db->set('field_comfirm_comment',$data['confirmsign_comment']);
						$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
						$this->db->set('field_destroy_status',$data['destroy_status']);	
						$this->db->set('field_confirmdate',date('Y-m-d H:i:s'));	
						$this->db->set('field_confirm_status',$data['field_confirm_status']);
						$this->db->set('field_do_yourself',$data['doit']);
						$this->db->set('field_itemname',$row1['Name1']);
						$this->db->insert('tb_signv2');
						$rent_no = $this->db->insert_id();
					}
					else {
						$this->db->set('field_docno',$data_docno);
						$this->db->set('field_itemcode',$row1['Code']);
						$this->db->set('field_groupcode',$row1['GroupCode']);
						$this->db->set('field_type',$data['sign_type']);
						$this->db->set('field_creator',$_SESSION['saeree_employee']);	
						$this->db->set('field_comfirm_needdate',$data['confirmsign_needdate']);
						$this->db->set('field_comfirm_comment',$data['confirmsign_comment']);
						$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
						$this->db->set('field_destroy_status',$data['destroy_status']);	
						$this->db->set('field_confirmdate',date('Y-m-d H:i:s'));	
						$this->db->set('field_confirm_status',$data['field_confirm_status']);
						$this->db->set('field_do_yourself',$data['doit']);
						$this->db->set('field_itemname',$row1['Name1']);
						$this->db->insert('tb_signv2');
						$rent_no = $this->db->insert_id();
					}

					$this->db->select('field_docno');
					$this->db->from('tb_signv2');
					$this->db->where('field_id',$rent_no);
					$this->db->limit(1);
					$data_docno = $this->db->get()->result_array()[0]['field_docno'];
	
					$field_detail = 'แผนก ขอทำป้าย เลขที่เอกสาร '.$data_docno;
					$this->db->set('field_sign_id',$rent_no);
					$this->db->set('field_detail',$field_detail);
					$this->db->set('field_status',1);
					$this->db->set('field_createdate',$date_today);
					$this->db->set('field_creator',$_SESSION['saeree_employee']);
					$this->db->insert('tb_signv2_timeline');
				}	
			}
			if(isset($data['tb_dosign'])){
				foreach($data['tb_dosign'] as $value){
					$this->db->select('field_id');
					$this->db->from('tb_signv2');
					$this->db->where('field_itemcode',$value['Code']);
					$this->db->order_by('field_id','DESC');
					$this->db->limit(1);
					$sign_id = $this->db->get()->result_array();
					if($value['confirmsign_place'] == '' ){
					}else{
						if ($value['confirmsign_type_price'] == '') {
							$type_price = '1';
						}
						else if ($value['confirmsign_type_price'] != '') {
							$type_price = $value['confirmsign_type_price'];
						}
						$this->db->set('field_itemcode',$value['Code']);
						$this->db->set('field_itemname',$value['Name1']);
						$this->db->set('field_groupcode',$value['GroupCode']);
						$this->db->set('field_comment',$value['confirmsign_comment']);
						$this->db->set('field_signplace',$value['confirmsign_place']);
						$this->db->set('field_signsize',$value['confirmsign_size']);
						$this->db->set('field_signamount',$value['confirmsign_amount']);
						$this->db->set('field_type_sign_price',$type_price);
						$this->db->set('field_sign_id',$sign_id['0']['field_id']);
						$this->db->insert('tb_signv2_sub');
					}
				}
			}
		}

		$this->db->set('field_status_destroy',1);
		$this->db->where_in('field_old_id',$destroy_id);
		$this->db->update('tb_sign_old_new');

		$this->db->select('*');
		$this->db->from('tb_sign_old_new');
		$this->db->where_in('field_old_id',$destroy_id);
		$data['sign_old'] = $this->db->get()->result_array();

		foreach ($data['sign_old'] as $key => $value) {
			$this->db->set('field_destroy_id',$value['field_old_id']);
			$this->db->set('field_place_id',$value['field_place_id']);
			$this->db->set('field_type_sign_price',$value['field_type_sign_price']);
			$this->db->set('sign_size',$value['sign_size']);
			$this->db->set('sign_amount',$value['sign_amount']);
			$this->db->set('field_sign_id',$rent_no);
			$this->db->insert('tb_signv2_prepareDestroy');
		}
		// $this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('saereePeeps','เพิ่ม : ใบสั่งผลิต / สั่งซ่อม','".$_SESSION['saeree_name']." เพิ่ม : ใบสั่งผลิต / สั่งซ่อม เลขที่ ".$Docno." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
		echo json_encode($data);
	}

	public function save_addcon()
	{
		$this->db = $this->load->database('default', TRUE);
		date_default_timezone_set('Asia/Bangkok');

		$this->db->set('field_do_yourself',$data['doit']);
		$this->db->set('field_confirmdate',date('Y-m-d H:i:s'));
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_sign');
	}

	public function del_place()
	{
		$this->db = $this->load->database('default', TRUE);
		$data = $_REQUEST;

		$this->db->select('field_place_id');
		$this->db->from('tb_sign_old_new');
		$this->db->where('field_place_id',$data['place_id']);
		$this->db->order_by('field_place_id','DESC');
		$this->db->limit(1);
		$place_id = $this->db->get()->result_array();
		$countplace = count($place_id);
		if ($countplace == 1) {
			echo json_encode('fail');
		}
		elseif($countplace == 0) {
			$this->db->where('field_place_id', $data['place_id']);
			$this->db->delete('tb_sign_place');
			echo json_encode('success');
		}
		// $this->db->where('field_place_id', $data['place_id']);
		// $this->db->delete('tb_sign_place');
		// echo json_encode($countplace);
	}

	public function update_purcease_confirm()
	{
		$this->db = $this->load->database('default', TRUE);
		$data = $_REQUEST;
		$date_today = date('Y-m-d H:i:s');
		$field_id = explode('-',$data['field_id']);

		foreach ($field_id as $key => $value) {
			if ($value != '' and $value != null) {
				$this->db->set('field_confirm_status',0);
				$this->db->where('field_id',$value);
				$this->db->update('tb_signv2');

				$this->db->select('field_docno');
				$this->db->from('tb_signv2');
				$this->db->where('field_id',$value);
				$this->db->limit(1);
				$data_docno = $this->db->get()->result_array()[0]['field_docno'];

				$field_detail = 'จัดซื้อ ยืนยันปรับราคา เลขที่เอกสาร '.$data_docno;
				$this->db->set('field_sign_id',$value);
				$this->db->set('field_detail',$field_detail);
				$this->db->set('field_status',2);
				$this->db->set('field_createdate',$date_today);
				$this->db->set('field_creator',$_SESSION['saeree_employee']);
				$this->db->insert('tb_signv2_timeline');
			}
		}

		echo json_encode($data);
	}

	public function update_purcease_unconfirm()
	{
		$this->db = $this->load->database('default', TRUE);
		$data = $_REQUEST;
		$date_today = date('Y-m-d H:i:s');
		$field_id = explode('-',$data['field_id']);

		foreach ($field_id as $key => $value) {
			if ($value != '' and $value != null) {

				$this->db->where('field_id',$value);
				$this->db->delete('tb_signv2');
			}
		}

		echo json_encode($data);
	}

	public function depart_confirm_sign(){
		$this->db = $this->load->database('default', TRUE);
		date_default_timezone_set('Asia/Bangkok');
		$data = $_REQUEST;
		$destroy_id = explode(',',$data['destroy_id']);
		$date_today = date('Y-m-d H:i:s');

		$this->db->where('field_sign_id', $data['field_id']);
		$this->db->delete('tb_signv2_sub');

		$this->db->set('field_confirm_status',$data['field_confirm_status']);
		$this->db->set('field_confirm_person',$_SESSION['saeree_employee']);
		$this->db->set('field_comfirm_comment',$data['confirmsign_comment']);
		$this->db->set('field_comfirm_needdate',$data['confirmsign_needdate']);
		$this->db->set('field_destroy_status',$data['destroy_status']);
		$this->db->set('field_do_yourself',$data['doit']);
		$this->db->set('field_confirmdate',date('Y-m-d H:i:s'));
		$this->db->where('field_id',$data['field_id']);
		$this->db->update('tb_signv2');

		if(isset($data['tb_dosign'])){
			foreach($data['tb_dosign'] as $value){
				if ($value['confirmsign_type_price'] == '') {
					$type_price = '1';
				}
				else if ($value['confirmsign_type_price'] != '') {
					$type_price = $value['confirmsign_type_price'];
				}
				$this->db->set('field_itemcode',$data['item_code']);
				$this->db->set('field_itemname',$data['item_name']);
				$this->db->set('field_groupcode',$data['groupcode']);
				$this->db->set('field_new_price1',$data['new_price1']);
				$this->db->set('field_new_price2',$data['new_price2']);
				$this->db->set('field_new_price3',$data['new_price3']);
				$this->db->set('field_new_price4',$data['new_price4']);
				$this->db->set('field_new_price5',$data['new_price5']);
				$this->db->set('field_old_price1',$data['sale_price1']);
				$this->db->set('field_old_price2',$data['sale_price2']);
				$this->db->set('field_old_price3',$data['sale_price3']);
				$this->db->set('field_old_price4',$data['sale_price4']);
				$this->db->set('field_old_price5',$data['sale_price5']);
				$this->db->set('field_price1',$data['sale_price1']);
				$this->db->set('field_price2',$data['sale_price2']);
				$this->db->set('field_price3',$data['sale_price3']);
				$this->db->set('field_price4',$data['sale_price4']);
				$this->db->set('field_price5',$data['sale_price5']);
				$this->db->set('field_comment',$value['comment']);
				$this->db->set('field_signplace',$value['confirmsign_place']);
				$this->db->set('field_signsize',$value['confirmsign_size']);
				$this->db->set('field_signamount',$value['confirmsign_amount']);
				$this->db->set('field_type_sign_price',$type_price);
				$this->db->set('field_sign_id',$data['field_id']);
				$this->db->insert('tb_signv2_sub');
			}
		}
		// timeline
		$this->db->select('field_docno');
		$this->db->from('tb_signv2');
		$this->db->where('field_id',$data['field_id']);
		$this->db->limit(1);
		$data_docno = $this->db->get()->result_array()[0]['field_docno'];

		if ($data['doit'] == '0') {
			$field_detail = 'แผนก ยืนยันให้บรรจุภัณฑ์ทำป้าย เลขที่เอกสาร '.$data_docno;
		}elseif ($data['doit'] == '1') {
			$field_detail = 'แผนก ยืนยันทำป้ายเอง เลขที่เอกสาร '.$data_docno;
		}


		$this->db->set('field_sign_id',$data['field_id']);
		$this->db->set('field_detail',$field_detail);
		$this->db->set('field_status',3);
		$this->db->set('field_createdate',$date_today);
		$this->db->set('field_creator',$_SESSION['saeree_employee']);
		$this->db->insert('tb_signv2_timeline');
		// 


		$this->db->set('field_status_destroy',1);
		$this->db->where_in('field_old_id',$destroy_id);
		$this->db->update('tb_sign_old_new');

		$this->db->select('*');
		$this->db->from('tb_sign_old_new');
		$this->db->where_in('field_old_id',$destroy_id);
		$data['sign_old'] = $this->db->get()->result_array();

		$this->db->where('field_sign_id',$data['field_id']);
		$this->db->delete('tb_signv2_preparedestroy');

		foreach ($data['sign_old'] as $key => $value) {
			$this->db->set('field_destroy_id',$value['field_old_id']);
			$this->db->set('field_place_id',$value['field_place_id']);
			$this->db->set('field_type_sign_price',$value['field_type_sign_price']);
			$this->db->set('sign_size',$value['sign_size']);
			$this->db->set('sign_amount',$value['sign_amount']);
			$this->db->set('field_sign_id',$data['field_id']);
			$this->db->insert('tb_signv2_prepareDestroy');
		}
		// $this->db->query("INSERT INTO `log`(`docno`, `table`, `action`, `user`, `actionTime`, `user_id`) VALUES('saereePeeps','เพิ่ม : ใบสั่งผลิต / สั่งซ่อม','".$_SESSION['saeree_name']." เพิ่ม : ใบสั่งผลิต / สั่งซ่อม เลขที่ ".$Docno." ผ่าน IP :".$_SERVER['REMOTE_ADDR']."','".$_SESSION['saeree_name']."','".date("Y-m-d H:i:s")."','".$_SESSION['saeree_id']."')");
		echo json_encode($data);
	}
	
	public function get_file_2_model()
	{
		$_data = $_REQUEST;

		// if(file_exists("assets/images/".$_data['link_1'])){

		// 	$data['scandir'] = scandir("assets/images/". $_data['link_1'] ."/". $_data['field_id']);

		// 	echo json_encode($data);

		// }else{
		// 	echo json_encode('eeror');
		// }
		if(file_exists("assets/images/".$_data['link_1'])){
			$data['scandir'] = scandir("assets/images/". $_data['link_1'] ."/". $_data['field_id']);
			echo json_encode($data);
		}
		else{
			echo json_encode('eeror');
		}

	}

	public function delete_file_2_model()
	{
		$_data = $_REQUEST;

		if(file_exists("assets/images/". $_data['link_1'] ."/". $_data['file_id'] ."/". $_data['file_name'])){

			$dir = "./assets/images/" . $_data['link_1'] ."/". $_data['file_id']  ."/". $_data['file_name'] ;
			unlink($dir);


			return 'success';

		}else{
			
			return 'error';

		}
		
	}


	public function get_file_1_model()
	{
		$_data = $_REQUEST;

		// if(file_exists("assets/images/".$_data['link_1'])){

		// 	$data['scandir'] = scandir("assets/images/". $_data['link_1'] ."/". $_data['field_id']);

		// 	echo json_encode($data);

		// }else{
		// 	echo json_encode('eeror');
		// }
		if(file_exists("assets/images/".$_data['link_1'])){
			$data['scandir'] = scandir("assets/images/". $_data['link_1'] ."/". $_data['field_id']);
			echo json_encode($data);
		}
		else{
			echo json_encode('eeror');
		}

	}

	public function get_file_view_destroy()
	{
		$_data = $_REQUEST;

		$this->db->select('*');
		$this->db->from('tb_signv2');
		$this->db->where('tb_signv2.field_id',$_data['field_id']);
		$data['Sign'] = $this->db->get()->result_array()[0];

		$this->db->select('*');
        $this->db->from('tb_sign_destroy_list');
		$this->db->where_in('field_sg_id',$data['Sign']['field_id']);
		$this->db->order_by('field_id','DESC');
        $data['sign_destroy_list'] = $this->db->get()->result_array();

		foreach ($data['sign_destroy_list'] as $key => $value) {
			if(file_exists("assets/images/".$_data['link_1'])){
				if (file_exists("assets/images/".$_data['link_1']."/".$value['field_id'])) {
					$data['scandir'][$key] = scandir("assets/images/". $_data['link_1'] ."/". $value['field_id']);
				}

				// echo json_encode($data);
			}
			else{
				// echo json_encode('eeror');
			}
		}

		// if(file_exists("assets/images/".$_data['link_1'])){
		// 	$data['scandir'] = scandir("assets/images/". $_data['link_1'] ."/". $_data['field_id']);
		// 	echo json_encode($data);
		// }
		// else{
		// 	echo json_encode('eeror');
		// }
		echo json_encode($data);
	}


	public function delete_file_1_model()
	{
		$_data = $_REQUEST;

		if(file_exists("assets/images/". $_data['link_1'] ."/". $_data['file_id'] ."/". $_data['file_name'])){

			$dir = "./assets/images/" . $_data['link_1'] ."/". $_data['file_id']  ."/". $_data['file_name'] ;
			unlink($dir);


			if(file_exists("assets/images/Sign")){
				$scandir = scandir("assets/images/". $_data['link_1'] ."/". $_data['file_id'] );
				if(count($scandir) == 2){

					$this->db->set('field_upload_status',0);
					$this->db->where('field_id',$_data['file_id']);
					$this->db->update('tb_signv2');
				}
			}

			return $data;

		}else{
			
			return 'error';

		}
		
	}

}		
