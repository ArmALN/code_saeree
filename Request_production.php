<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Request_production extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		// $this->load->view('template/header');
		// $this->load->view('template/navbar');
		$this->load->view('template/headerV2');
        $this->load->view('template/navbarV2');
        $this->load->view('template/sidebarV2');
		$this->load->view('Request_production/Request-production-home');
		$this->load->view('template/footerV2');
		$this->load->view('Request_production/js/Request-production-home-js');
		// $this->load->view('template/footer');
    }	
    
	public function gotoadd_request_production()
	{
		$data['id'] = '0';
		$data['type'] = 'add';
		// $this->load->view('template/header');
		// $this->load->view('template/navbar');
		$this->load->view('template/headerV2');
        $this->load->view('template/navbarV2');
        $this->load->view('template/sidebarV2');

		$this->load->view('Request_production/Request-production-add', $data);
		$this->load->view('template/footerV2');
		$this->load->view('Request_production/js/Request-production-share-all-js', $data);
		$this->load->view('Request_production/js/Request-production-add-js', $data);
		$this->load->view('Request_production/js/Request-production-share-add-edit-js', $data);
		
	}

	public function view_Request_production($id)
	{
		$data['id'] = $id;
		$data['type'] = 'view';
		// $this->load->view('template/header');
		// $this->load->view('template/navbar');
		$this->load->view('template/headerV2');
        $this->load->view('template/navbarV2');
        $this->load->view('template/sidebarV2');
		$this->load->view('Request_production/Request-production-summary', $data);
		$this->load->view('template/footerV2');
		$this->load->view('Request_production/js/Request-production-share-all-js', $data);
		$this->load->view('Request_production/js/Request-production-summary-js', $data);
		$this->load->view('Request_production/js/Request-production-share-summary-js', $data);
		// $this->load->view('template/footer');
	}

	public function gotoedit_Request_production($id)
	{
		$data['id'] = $id;
		// $this->load->view('template/header');
		// $this->load->view('template/navbar');
		$this->load->view('template/headerV2');
        $this->load->view('template/navbarV2');
        $this->load->view('template/sidebarV2');
		$this->load->view('Request_production/Request-production-edit', $data);
		$this->load->view('template/footerV2');
		$this->load->view('Request_production/js/Request-production-share-all-js', $data);
		$this->load->view('Request_production/js/Request-production-edit-js', $data);
		$this->load->view('Request_production/js/Request-production-share-add-edit-js', $data);
		$this->load->view('Request_production/js/Request-production-share-summary-js', $data);
		
		// $this->load->view('template/footer');
	}

	public function summary_Request_production($id)
	{
		$data['id'] = $id;
		$data['type'] = 'accept';
		$this->load->view('template/headerV2');
        $this->load->view('template/navbarV2');
        $this->load->view('template/sidebarV2');
		$this->load->view('Request_production/Request-production-summary', $data);
		$this->load->view('template/footerV2');
		$this->load->view('Request_production/js/Request-production-share-all-js', $data);
		$this->load->view('Request_production/js/Request-production-summary-js', $data);
		$this->load->view('Request_production/js/Request-production-share-summary-js', $data);
		
		// $this->load->view('template/footer');
	}

	public function view_summary_Request_production($id)
	{
		$data['id'] = $id;
		$data['type'] = 'summary';
		// $this->load->view('template/header');
		// $this->load->view('template/navbar');
		$this->load->view('template/headerV2');
        $this->load->view('template/navbarV2');
        $this->load->view('template/sidebarV2');
		$this->load->view('Request_production/Request-production-summary', $data);
		$this->load->view('template/footerV2');
		$this->load->view('Request_production/js/Request-production-share-all-js', $data);
		$this->load->view('Request_production/js/Request-production-summary-js', $data);
		$this->load->view('Request_production/js/Request-production-share-summary-js', $data);
		
		// $this->load->view('template/footer');
	}

	// public function fixitem_Request_production()
	// {
	// 	$this->load->view('template/header');
	// 	$this->load->view('template/navbar');
	// 	$this->load->view('Request_production/Request-production-fixitem');
	// 	$this->load->view('Request_production/js/Request-production-fixitem-js');
	// 	$this->load->view('template/footer');
	// }

	public function topic_Request_production()
	{
		// $this->load->view('template/header');
		// $this->load->view('template/navbar');

		$this->load->view('template/headerV2');
        $this->load->view('template/navbarV2');
        $this->load->view('template/sidebarV2');
		$this->load->view('Request_production/Request-production-topic');
		$this->load->view('template/footerV2');
		$this->load->view('Request_production/js/Request-production-topic-js');
		// $this->load->view('template/footer');
	}

	public function add_request_production_history()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->add_request_production_history_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}	

	public function get_topic()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_topic_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}	

	public function add_request_production()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->add_request_production_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}	

	public function get_rp()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_rp_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function autocomplete_request_production()
    { 

		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->autocomplete_request_production_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }

	public function check_request_product()
    { 
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->check_request_product_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }

	public function autocomplete_project_department()
    {
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->autocomplete_project_department_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }

	public function get_depart()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_depart_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}	

	public function get_view_rp()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_view_rp_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}	

	public function upload_image()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->upload_image_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function editupload_image()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->editupload_image_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	
	public function get_editimg()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_editimg_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete_file()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->delete_file_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_image()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_image_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}	

	public function edit_request_production()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->edit_request_production_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}	

	public function get_manage_confirm()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_manage_confirm_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function pre_confirm()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->pre_confirm_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function rp_confirm()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->rp_confirm_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function print_rp($id)
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->print_rp_model($id);
	}	

	// public function print_rp_first($id)
	// {   
	// 	$this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->print_rp_first_model($id);
	// }	

	public function print_rp_first()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->print_rp_first_model();
	}	

	public function get_employee_controller()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_employee_controller_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_employee_depart()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_employee_depart_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function receive_rp()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->receive_rp_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


	public function get_rp_history()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_rp_history_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_rp_progress()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_rp_progress_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


	public function get_main_topic()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_main_topic_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function check_topic()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->check_topic_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function add_topic()
	{
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->add_topic_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_topic_byid()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_topic_byid_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function edit_topic()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->edit_topic_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete_topic()
	{  
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->delete_topic_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function print_sum($id)
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->print_sum_model($id);
	}

	public function accept_rp()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->accept_rp_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function accept_employee()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->accept_employee_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function update_cost_final()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->update_cost_final_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	// public function check_fixitem()
    // {
    //     $this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->check_fixitem_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
    // }

	// public function get_main_fixitem()
	// {  
	// 	$this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->get_main_fixitem_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	// public function get_fixitem_byid()
	// {  
	// 	$this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->get_fixitem_byid_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	public function get_fixitem()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_fixitem_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_fixitem_item_byid()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_fixitem_item_byid_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


	public function get_fixhistory()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_fixhistory_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function fixit_again()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->fixit_again_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	// public function add_fixitem()
	// {   
	// 	$this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->add_fixitem_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	// public function edit_fixitem()
	// {   
	// 	$this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->edit_fixitem_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	// public function delete_fixitem()
	// {   
	// 	$this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->delete_fixitem_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	public function get_fixitem_sub_byid()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_fixitem_sub_byid_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	// public function get_fixitem_sub_byid2()
	// {   
	// 	$this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->get_fixitem_sub_byid2_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	// public function add_fixitem_sub()
	// {   
	// 	$this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->add_fixitem_sub_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	// public function edit_fixitem_sub()
	// {   
	// 	$this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->edit_fixitem_sub_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	// public function delete_fixitem_sub()
	// {   
	// 	$this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->delete_fixitem_sub_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }
	

	// public function add_history_fixitem()
	// {   
	// 	$this->load->model(array('Request_production_model'));
	// 	$data = $this->Request_production_model->add_history_fixitem_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	public function autocomplete_stkissue()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->autocomplete_stkissue_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_stkissue_bydocno()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->get_stkissue_bydocno_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function check_bill()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->check_bill_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function check_fixitem_item_byid()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->check_fixitem_item_byid_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function update_requestbackward()
	{   
		$this->load->model(array('Request_production_model'));
		$data = $this->Request_production_model->update_requestbackward_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
