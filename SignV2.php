<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
		
	class SignV2 extends CI_Controller {
		
		function __construct(){
			parent::__construct();
		}

		public function index(){
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-home');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-home-js');
		}

		public function purchase_add(){
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-purchase_add');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-purchase_add-js');
		}

		public function purchase_confirm(){

			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-purchase_confirm');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-purchase_confirm-js');

		}

		public function depart_add(){
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-depart_add');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-depart_add-js');
		}

		public function depart_confirm(){
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-depart_confirm');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-depart_confirm-js');
		}

		public function packing_loaddata(){
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-packing-loaddata');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-packing-loaddata-js');
		}

		public function depart_load_data(){ 
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-dosign-loaddata');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-dosign-loaddata-js');
		}


		public function depart_packing(){
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-depart-packing');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-depart-packing-js');
		}

		public function packing(){
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-packing');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-packing-js');
		}

		public function loaddata_excel(){

			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-loaddata_excel');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-loaddata_excel-js');
		}

		public function packing_excel($id){
			// $data['id'] = $id;
			// $this->load->view('template/header');
			// $this->load->view('template/navbar');
			// $this->load->view('SignV2/Sign-packing_excel', $data);
			// $this->load->view('template/footer'); 
			$data['id'] = $id;
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-packing_excel',$data);
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-packing_excel-js');
		}

		public function checkprice_onBC(){
			// $data['id'] = $id;
			// $this->load->view('template/header');
			// $this->load->view('template/navbar');
			// $this->load->view('SignV2/Sign-packing_excel', $data);
			// $this->load->view('template/footer'); 
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-checkprice_onBC');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-checkprice_onBC-js');
		}

		public function view_sign($field_id){
			$data['id'] = $field_id;
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-view',$data);
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-view-js');
		}

		public function sign_destroy_manage(){
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-manage_destroy');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-manage_destroy-js');
		}

		public function sign_place_manage(){
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-manage_place');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-manage_place-js');
		}

		public function sign_request_confirm(){
			$this->load->view('template/headerV2');
			$this->load->view('template/navbarV2');
			$this->load->view('template/sidebarV2');
			$this->load->view('SignV2/Sign-request_confirm');
			$this->load->view('template/footerV2');
			$this->load->view('SignV2/js/Sign-request_confirm-js');
		}

		// public function confirm_sign($field_id){
		// 	$data['id'] = $field_id;
		// 	$this->load->view('template/header');
		// 	$this->load->view('template/navbar');
		// 	$this->load->view('template/css');
		// 	$this->load->view('SignV2/Sign-confirm_sign', $data);
		// 	$this->load->view('bcuserlogbook/js/bcuserlogbook-home-js');
		// 	$this->load->view('template/footer'); 
		// }

		public function view_depart_edit($field_id){
			$data['id'] = $field_id;
			$this->load->view('template/header');
			$this->load->view('template/navbar');
			$this->load->view('SignV2/Sign-depart-packing');
			$this->load->view('SignV2/Sign-depart_edit', $data);
			$this->load->view('bcuserlogbook/js/bcuserlogbook-home-js');
			$this->load->view('template/footer'); 
		}

		public function sign_test_print(){
			$this->load->view('template/header');
			$this->load->view('template/navbar');
			$this->load->view('SignV2/Sign-ex');
			$this->load->view('template/footer'); 
		}

		public function test(){

			$this->load->view('SignV2/testtest');

		}

		public function packing_nodo_loaddata(){
			$this->load->view('template/header');
			$this->load->view('template/navbar');
			$this->load->view('SignV2/Sign-loaddata_nodo');
			$this->load->view('template/footer'); 
		}

		public function loaddata_employee(){
			$this->load->view('template/header');
			$this->load->view('template/navbar');
			$this->load->view('SignV2/Sign-loaddata_employee');
			$this->load->view('template/footer'); 
		}

		public function repeat(){
			$this->load->view('template/header');
			$this->load->view('template/navbar');
			$this->load->view('SignV2/Sign-repeat');
			$this->load->view('template/footer'); 
		}

		public function get_loaddata_tocheck(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_loaddata_tocheck();
		}

		public function get_select_destroy(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_select_destroy();
		}

		public function search_itemlist(){ 
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->search_itemlist();
		}

		public function get_destroy_info(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_destroy_info();
		}

		public function update_change_status_destroy(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_change_status_destroy();
		}

		public function get_employee_diff(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_employee_diff();
		}

		public function update_it_unconfirm(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_it_unconfirm();
		}


		public function get_repeat(){ 
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->get_repeat_model();
		}

		public function get_employee(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_employee_model();
		}

		public function update_itemname(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_itemname();
		}

		public function update_print_person(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_print_person();
		}

		public function autocomplete_bcitem(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->autocomplete_bcitem_model();
		}

		public function autocomplete_Signitem(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->autocomplete_Signitem_model();
		}

		public function check_itemcode(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->check_itemcode_model();
		}

		public function update_edit_destroy_comment(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_edit_destroy_comment();
		}

		public function get_bcitem(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_bcitem_model();
		}

		public function delete_file_1(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->delete_file_1_model();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		public function delete_file_2(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->delete_file_2_model();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		public function get_bcstkpacking(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_bcstkpacking_model();
		}

		public function get_signandsignsub(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_signandsignsub();
		}

		public function get_bcitem_unitcode(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_bcitem_unitcode();
		}

		public function save_step_model(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->save_step_model();
		}

		public function get_packingrate(){ 
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_packingrate_model();
		}

		public function save(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->save_model();
		}

		public function get_groupcode(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_groupcode_model();
		}

		public function sign_list(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->sign_list();
		}

		public function select_item(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->select_item();
		}

		public function all_sign(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->all_sign();
		}

		public function edit_sign(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->edit_sign();
		}

		public function get_sign_packing_do_model(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_sign_packing_do_model();
		}

		public function update_load_data_packing(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_load_data_packing();
		}

		public function update_load_data_nopacking(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_load_data_nopacking();
		}

		public function get_sign(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_sign_model();
		}

		public function get_view(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_view_model();
		}

		public function confirm_undo(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->confirm_undo_model();
		}

		public function confirmsign(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->confirmsign_model();
		}

		public function get_confirm_edit(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_confirm_edit_model();
		}

		public function update_confirm_undo(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_confirm_undo_model();
		}

		public function sign_type(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->sign_type();
		}

		public function comment_type(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->comment_type();
		}

		public function comment_type_sub(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->comment_type_sub();
		}


		public function confirm_sign_size(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->confirm_sign_size();
		}

		public function confirmsign_type_price(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->confirmsign_type_price();
		}


		public function get_packing_recive(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_packing_recive();
		}

		public function depart_confirm_sign(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->depart_confirm_sign();
		}
		
		public function select_confirm_detail(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->select_confirm_detail();
		}

		public function update_confirm(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_confirm();
		}

		public function update_confirmsign(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_confirmsign_model();
		}

		public function show_data_item(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->show_data_item();
		}

		public function update_packing_excel(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_packing_excel();
		}

		public function update_packing(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_packing();
		}

		public function get_sign_packing(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_sign_packing_model();
		}

		public function get_packing_excel(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_packing_excel_model();
		}

		public function get_employee_setup(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_employee_setup();
		}

		public function get_packinglist(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_packinglist_model();
		}

		public function packing_confirm(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->packing_confirm_model();
		}

		public function destroy_confirm(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->destroy_confirm_model();
		}

		public function get_employee_tosetup(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_employee_tosetup_model();
		}

		public function recieve_confirm(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->recieve_confirm_model();
		}

		public function get_file_1(){
			$this->load->model(array('SignV2_model'));		
			$data = $this->SignV2_model->get_file_1_model();
		}

		public function get_file_2(){
			$this->load->model(array('SignV2_model'));		
			$data = $this->SignV2_model->get_file_2_model();
		}

		public function setup_confirm(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->setup_confirm_model();
		}

		public function unsetup_confirm(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->unsetup_confirm_model();
		}
		
		public function recheck_print($field_id){  
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->recheck_print_model($field_id);
		}

		public function update_cancel_destroy(){  
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->update_cancel_destroy();
		}

		public function Sign_dosign_print(){  
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->Sign_dosign_print();
		}

		public function Sign_dosign_print_preview(){  
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->Sign_dosign_print_preview();
		}

		public function Sign_loaddata_check(){  
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->Sign_loaddata_check();
		}

		public function recheck_confirm(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->recheck_confirm_model();
		}

		public function update_recive(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_recive();
		}


		public function upload_image(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->upload_image_model();
		}

		public function upload_image_destroy(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->upload_image_destroy();
		}

		public function get_viewfinal(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_viewfinal_model();
		}

		public function get_image(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_image_model();
		}

		public function depart_addsign(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->depart_addsign_model();
		}

		public function select_sign_size(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->select_sign_size();
		}

		public function get_signnodo_excel(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_signnodo_excel();
		}

		public function get_signactive_excel(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_signactive_excel();
		}

		public function get_sign_place_old_list(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_sign_place_old_list();
		}

		public function get_select_place(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_select_place();
		}

		public function change_place(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->change_place();
		}

		public function get_signold_inplace(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->get_signold_inplace();
		}

		public function loaddata_place(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->loaddata_place();
		}

		public function insert_place(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->insert_place();
		}

		public function update_place_name(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_place_name();
		}

		public function update_purcease_confirm(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_purcease_confirm();
		}

		public function update_purcease_unconfirm(){
			$this->load->model(array('SignV2_model'));			
			$data = $this->SignV2_model->update_purcease_unconfirm();
		}

		public function del_place(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->del_place();
		}

		public function get_item_info(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->get_item_info();
		}

		public function get_destroy_list(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->get_destroy_list();
		}

		public function update_edit_data(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->update_edit_data();
		}

		public function update_destroy_sub(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->update_destroy_sub();
		}

		public function update_main_destroy_sub(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->update_main_destroy_sub();
		}

		public function cause_Modal(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->cause_Modal();
		}

		public function active_sign(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->active_sign();
		}

		public function get_recieve_detail(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->get_recieve_detail();
		}

		public function request_sign(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->request_sign();
		}

		public function sign_request_list(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->sign_request_list();
		}

		public function confirm_reprint(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->confirm_reprint();
		}

		public function cancel_reprint(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->cancel_reprint();
		}

		public function confirm_reloaddata(){
			$this->load->model(array('SignV2_model'));	
			$data = $this->SignV2_model->confirm_reloaddata();
		}

		public function list_request_sub(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->list_request_sub();
		}

		public function confirm_backtoedit(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->confirm_backtoedit();
		}

		public function cancel_backtoedit(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->cancel_backtoedit();
		}


		public function waitsetup_confirm(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->waitsetup_confirm();
		}

		public function update_main_destroy_sg(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->update_main_destroy_sg();
		}

		public function sign_timeline(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->sign_timeline();
		}

		public function get_signdata_bydocno(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->get_signdata_bydocno();
		}

		public function update_change_place(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->update_change_place();
		}

		public function cancel_reloaddata(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->cancel_reloaddata();
		}

		public function change_active_status(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->change_active_status();
		}

		public function update_recheck_destroy(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->update_recheck_destroy();
		}

		public function update_signsub_name2(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->update_signsub_name2();
		}

		public function get_file_view_destroy(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->get_file_view_destroy();
		}

		public function check_price_onBC(){
			$this->load->model(array('SignV2_model'));
			$data = $this->SignV2_model->check_price_onBC();
		}
	}
	
?>