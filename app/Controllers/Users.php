<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Region as RegionModel;
use App\Models\Users as UsersModel;

class Users extends BaseController
{
	public function index()
	{
		//
	}
	public function load_add_edit_users_views(){
  
		$request = \Config\Services::request();
		$user_account_id=$request->getVar('user_account_id');
		$this->RegionModel = new RegionModel();    
		$this->UsersModel = new UsersModel();   
        $data['counties']=$this->RegionModel->get_all_counties();
        $data['subcounties']=$this->RegionModel->get_all_sub_counties();
		$data['registration_offices']=$this->RegionModel->get_all_registration_offices_sub_cnty();
		$data['user_group_data']=$this->UsersModel->get_all_user_groups();
        $user_account_id =(int) $user_account_id; 
        $data['user_data']=$this->UsersModel->get_user_by_id($user_account_id);    
        $data['user_account_id']=$user_account_id;
        
        echo view('Users\add_user', $data);
        
	}
	public function load_users_list(){

		$this->UsersModel = new UsersModel();  
        
		$data['users_list']=$this->UsersModel->select_all_users();
		$data['search_function']=0;
        echo view('Users\all_users', $data);
	}
	public function add_edit_users_data(){
		$session = session();
		$request = \Config\Services::request();
		if($session->get('user_account_id')==NULL||$session->get('user_account_id')==""||$session->get('user_account_id')==0){
            return view('Auth\login');
        }else{

		$user_account_id = $request->getVar('user_account_id');
		$user_account_email = $request->getVar('user_account_email');
		// $user_account_password = $request->getVar('user_account_password');
		$user_account_national_id = $request->getVar('user_account_national_id');
		$user_account_county_registration_office_id=$request->getVar('user_account_county_registration_office_id');
		$user_account_second_name=$request->getVar('user_account_second_name');
		$user_group_id_fk=$request->getVar('user_group_id_fk');
		$user_account_first_name=$request->getVar('user_account_first_name');
		$default_password='password';
		$user_account_password =password_hash($default_password, PASSWORD_BCRYPT);
		$phone_number=$request->getVar('user_account_phone');

		$added_by=$logged_in_user=$session->get('user_account_id');
		$date_created=$date_of_return=date("Y/m/d");
	$this->UsersModel = new UsersModel();  
	$added_updated_user_id =$this->UsersModel->insert_update_user_data($user_account_id, $user_account_email, $user_account_national_id,$user_account_county_registration_office_id,$user_account_first_name,$user_account_second_name, $user_group_id_fk,$date_created,$added_by,$user_account_password,$phone_number);

	if($added_updated_user_id >0){
		$res = array(
			'success' => 'Saved Sucessfully
			');

		echo json_encode($res);

	}else{
		$res = array(
			'error' => 'An internal error has occurred');

		echo json_encode($res);
	}
  }
	}
	public function check_if_user_exists(){
		$request = \Config\Services::request();
		$national_id = $request->getVar('national_id');
		$email = $request->getVar('email');
		$this->UsersModel = new UsersModel();  
		$check_if_user_exists =$this->UsersModel->get_retunred_user_by_national_id_or_email($national_id, $email);
		if($check_if_user_exists !=null){
			$res = array(
                'success' => $check_if_user_exists->user_returning_device_id);

            echo json_encode($res);
		}else{

			$res = array(
                'error' => 0);

            echo json_encode($res);

		}

	}
	public function display_specific_returned_device_user(){
		$request = \Config\Services::request();
		$user_returning_device_id=$request->getVar('user_returning_device_id');
		$user_returning_device_id =(int) $user_returning_device_id; 
		$this->UsersModel = new UsersModel();
        $data['users_list']=$this->UsersModel->get_returned_device_user_data_by_id($user_returning_device_id);       
       echo view('Users\user_filtered', $data);
	 	
	}

	
  
	public function add_edit_user_that_returned_device(){
		$session = session();
		$request = \Config\Services::request();
		if($session->get('user_account_id')==NULL||$session->get('user_account_id')==""||$session->get('user_account_id')==0){
            return view('Auth\login');
        }else{

		$user_returning_device_id=$request->getVar('user_returning_device_id');
		$first_name=$request->getVar('first_name');
		$second_name=$request->getVar('second_name');
		$email=$request->getVar('email');
		$national_id=$request->getVar('national_id');
		$phone_number=$request->getVar('phone_number');
		$registration_office_id=$request->getVar('registration_office_id');
		$this->UsersModel = new UsersModel();  
		$added_updated_returned_device_user_id =$this->UsersModel->insert_update_returned_device_user_data($user_returning_device_id, $email, $national_id,$registration_office_id,$first_name,$second_name,$phone_number);
	  
	if($added_updated_returned_device_user_id >0){
		$res = array(
			'success' => 'Saved Sucessfully
			');

		echo json_encode($res);

	}else{
		$res = array(
			'error' => 'An internal error has occurred');

		echo json_encode($res);
	}
}
	

	}

	public function load_add_edit_user_returned_device_views(){
		$request = \Config\Services::request();
		$this->RegionModel = new RegionModel();    
		$this->UsersModel = new UsersModel();   
		$user_returning_device_id=$request->getVar('user_returning_device_id');
		$user_returning_device_id =(int) $user_returning_device_id; 
		$page_type=(int)$request->getVar('page_type');
		$device_id=(int)$request->getVar('device_id');
		$data['user_data']=$this->UsersModel->get_returned_device_user_data_by_id_view($user_returning_device_id); 
		$data['counties']=$this->RegionModel->get_all_counties();
		$data['user_returning_device_id']=$user_returning_device_id;
		$data['page_type']=$page_type;
        $data['device_id']=$device_id;
      
		echo view('Users\add_edit_device_user', $data);

	}
	public function search_user(){
		$request = \Config\Services::request();
		$this->UsersModel = new UsersModel();   
		$user_input=$request->getVar('user_input');
		$data['users_list']=$this->UsersModel->search_user($user_input);
		$data['search_function']=1;
		echo view('Users\all_users', $data);   

	}
	public function delete_user(){
		$request = \Config\Services::request();
		$this->UsersModel = new UsersModel();  
		$deleted=$request->getVar('deleted');
		$user_account_id=$request->getVar('user_account_id');
		$delete_user_details=$this->UsersModel->delete_user($user_account_id,$deleted);
		if($delete_user_details){
			$res = array(
				'success' => 'The record has been deleted successfully
				');
	
			echo json_encode($res);
		}else{
			$res = array(
				'error' => 'An internal error has occurred
				');
	
			echo json_encode($res);
		}
	
		
	}
	public function delete_device_user(){
		$request = \Config\Services::request();
		$this->UsersModel = new UsersModel();  
		$deleted=$request->getVar('deleted');
		$user_returning_device_id=$request->getVar('user_returning_device_id');
		$delete_device_user_details=$this->UsersModel->delete_user($user_returning_device_id,$deleted);
		if($delete_device_user_details){
			$res = array(
				'success' => 'The record has been deleted successfully
				');
			echo json_encode($res);
		}else{
			$res = array(
				'error' => 'An internal error has occurred
				');
	
			echo json_encode($res);
		}
	
		
	}
	
	
	
}
