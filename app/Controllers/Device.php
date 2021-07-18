<?php

namespace App\Controllers;
use App\Models\Device as DeviceModel;
use App\Models\Region as RegionModel;
use App\Models\Users as UsersModel;

class Device extends BaseController
{

    
    public function index()
    {
        echo 'Hello World!';
    }
    public function load_add_edit_device_view(){
  
        $request = \Config\Services::request();
        $device_id = $request->getVar('device_id');
        // Codeigniter has chosen to return all values as string so this is a measure to recovert deviceId to int
        $device_id =(int) $device_id;
        $this->DeviceModel = new DeviceModel();
        $data['device_data']=$this->DeviceModel->get_device_data_by_id_device_internal_useer($device_id); 
        $data['reasons_for_return_of_device']=$this->DeviceModel->get_all_reasons_for_return_of_device(); 
        $data['device_id'] = $device_id;
        $data['user_function']=$request->getVar('user_function');
        echo view('Device\add_device', $data);
    }
    public function add_edit_device(){
        helper(['form', 'url']);
        $session = session();
        $request = \Config\Services::request();
        $validation =  \Config\Services::validation();
    if($session->get('user_account_id')==NULL||$session->get('user_account_id')==""||$session->get('user_account_id')==0){
        return view('Auth\login');
    }else{
       
            $device_id = $request->getVar('device_id');
            $device_state_id = $request->getVar('device_state_id');
            $device_name = $request->getVar('device_name');
            $device_serial_no = $request->getVar('device_serial_no');
            $device_imei_no = $request->getVar('device_imei_no');
            $added_by=$request->getVar('added_by');
            $added_by=$logged_in_user=$session->get('user_account_id');
            $asset_tag_number=$request->getVar('asset_tag_number');
            $date_of_return="";
            $returned_by_user=0;
            $reason_for_return_id=$request->getVar('reason_for_return_id');
            $is_returned=$request->getVar('is_returned');
            $is_returned =(int) $is_returned; 
            
            $reason_for_returning_description=$request->getVar('reason_for_returning_description');
            $current_date=$date_of_return=date('Y-m-d H:i:s');
            

         

        $this->DeviceModel = new DeviceModel();
        $added_updated_device_id =$this->DeviceModel->insert_update_device_data($device_id,$device_name, $device_serial_no, $device_imei_no, $logged_in_user,$returned_by_user,$reason_for_return_id,$date_of_return,$is_returned,$reason_for_returning_description,$asset_tag_number,$current_date);
    
        if($added_updated_device_id >0){
            $res = array(
                'success' =>'The device has been successully saved');
                echo json_encode($res);

        }else{
            $res = array(
                'error' =>'An internal error has occurred');
                echo json_encode($res);

        }
    }

    }
    public function load_devices_list(){
        $this->DeviceModel = new DeviceModel();
        
        $data['device_list']=$this->DeviceModel->select_all_devices();
        $data['search_function']=0;
        echo view('Device\all_devices', $data);
        
    }
    public function load_page_assign_device(){
        $request = \Config\Services::request();
        $device_id = $request->getVar('device_id');
        $this->RegionModel = new RegionModel();
        $this->DeviceModel = new DeviceModel(); 
        $device_id =(int) $device_id;       
        $data['region_data']=$this->RegionModel->get_all_regions();
        $data['counties']=$this->RegionModel->get_all_counties();
        $data['subcounties']=$this->RegionModel->get_all_sub_counties();
        $data['device_data']=$this->DeviceModel->get_device_data_by_id($device_id);
        $data['registration_offices']=$this->RegionModel->get_all_registration_offices_sub_cnty();
        echo view('Device\assign_device', $data);
        
    }
    public function load_page_return_device(){
        $request = \Config\Services::request();
        $device_id = $request->getVar('device_id'); 
        $device_id =(int) $device_id;
        $this->DeviceModel = new DeviceModel();        
        $data['device_data']=$this->DeviceModel->get_device_data_by_id($device_id);
        $data['device_id']=$device_id;
        echo view('Device\returned_device', $data);
        
        
    }

    public function load_unassigned_devices_list(){
        $this->DeviceModel = new DeviceModel(); 
        $data['device_list']=$this->DeviceModel->select_all_unassigned_assigned_devices(0);
        echo view('Device\all_unassigned_devices', $data);
    }
    
    public function load_assigned_devices_list(){
        $this->DeviceModel = new DeviceModel(); 
        $data['device_list']=$this->DeviceModel->select_all_unassigned_assigned_devices(1);
        echo view('Device\all_assigned_devices', $data);
    }
    public function assign_device_to_region(){

        $request = \Config\Services::request();

        $sub_county_id_fk = $request->getVar('sub_county_id_fk');
        $device_id = $request->getVar('device_id');
        $device_status = $request->getVar('device_status');
       
        

    $this->DeviceModel = new DeviceModel();
    $device_id =(int) $device_id; 
    $device_status =(int) $device_status; 
    
    $assigned_device =$this->DeviceModel->assign_device_to_region($sub_county_id_fk, $device_id,$device_status);
    

    if($assigned_device >0){
        echo json_encode('The device has been successfully added');

    }else{
        echo json_encode('An internal error has occurred');

    }

    }
    public function return_a_device(){

        $request = \Config\Services::request();

        $formerly_assigned_region = $request->getVar('formerly_assigned_region');
        $device_condition = $request->getVar('device_condition');
        $device_status = $request->getVar('device_status');
        $reason_for_returning = $request->getVar('reason_for_returning');
        $device_id = $request->getVar('device_id');
       
         
        

    $this->DeviceModel = new DeviceModel();
    $device_id =(int) $device_id; 
    $device_status =(int) $device_status; 
    
    $returned_device =$this->DeviceModel->return_device($formerly_assigned_region, $device_condition,$device_status, $reason_for_returning, $device_id);
    
    if($returned_device >0){
        echo json_encode('The device has been marked as returned');

    }else{
        echo json_encode('An internal error has occurred');

    }

    }
    
    public function load_add_returned_edit_device_view(){
  
        $request = \Config\Services::request();
        $this->DeviceModel = new DeviceModel();
        $this->UsersModel = new UsersModel(); 
        $this->RegionModel = new RegionModel();
     
        $device_id = $request->getVar('device_id');
        $user_returning_device_id=$request->getVar('user_returning_device_id');
        // Codeigniter has chosen to return all values as string so this is a measure to recovert deviceId to int
        $device_id =(int) $device_id;
        $user_returning_device_id =(int) $user_returning_device_id;    
        $data['device_data']=$this->DeviceModel->get_returned_device_data_by_id($device_id); 
        $data['user_data']=$this->UsersModel->get_returned_device_user_data_by_id($user_returning_device_id); 
        $data['device_id'] = $device_id;
        $data['user_returning_device_id'] = $user_returning_device_id;
        $data['counties']=$this->RegionModel->get_all_counties();
        $data['reasons_for_return_of_device']=$this->DeviceModel->get_all_reasons_for_return_of_device(); 
        echo view('Device\add_returned_device', $data);
    }
    public function add_edit_returned_device(){ 
        $session = session();
        $request = \Config\Services::request();
        $validation =  \Config\Services::validation();
        if($session->get('user_account_id')==NULL||$session->get('user_account_id')==""||$session->get('user_account_id')==0){
            return view('Auth\login');
        }else{
        
        $device_id = $request->getVar('device_id');
        $device_name = $request->getVar('device_name');
        $device_serial_no = $request->getVar('device_serial_no');
        $device_imei_no = $request->getVar('device_imei_no');
        $user_returning_device_id = $request->getVar('user_returning_device_id');
        $user_returning_device_id =(int) $user_returning_device_id;
        $first_name = $request->getVar('first_name');
        $second_name = $request->getVar('second_name');
        $email = $request->getVar('email');
        $national_id = $request->getVar('national_id');
        $registration_office_id = $request->getVar('registration_office_id');
        $reason_for_return_id = $request->getVar('reason_for_return_id');
        $reason_for_returning_description= $request->getVar('reason_for_returning_description');
        $asset_tag_number = $request->getVar('asset_tag_number');
        $phone_number = $request->getVar('phone_number');
    
        
        $added_by=$logged_in_user=$session->get('user_account_id');
        $date_created=$date_of_return=date('Y-m-d H:i:s');
           
        $this->DeviceModel = new DeviceModel();
        if($user_returning_device_id==0){

            $this->UsersModel = new UsersModel();  
            $added_updated_returned_device_user_id =$this->UsersModel->insert_update_returned_device_user_data($user_returning_device_id, $email, $national_id,$registration_office_id,$first_name,$second_name,$phone_number);
            
             if($added_updated_returned_device_user_id >0){
                 $returned_by_user=$added_updated_returned_device_user_id;
                
                        
                        $added_updated_device_id =$this->DeviceModel->insert_update_device_data($device_id,$device_name, $device_serial_no, $device_imei_no, $logged_in_user,$returned_by_user,$reason_for_return_id,$date_of_return,$is_returned=1,$reason_for_returning_description,$asset_tag_number,$date_created);
                    
                        if($added_updated_device_id >0){
                            
                            $res = array(
                                'success' =>'The device has been successully saved');
                                echo json_encode($res);

                        }else{
                            $res = array(
                                'error' => 'An internal error has occured');
                                echo json_encode($res);

                        }
            }else{
                $res = array(
                    'error' => 'An internal error has occured');
                    echo json_encode($res);

            }
        }else{
            $returned_by_user=$user_returning_device_id;
            $added_updated_device_id =$this->DeviceModel->insert_update_device_data($device_id,$device_name, $device_serial_no, $device_imei_no, $logged_in_user,$returned_by_user,$reason_for_return_id,$date_of_return,$is_returned=1,$reason_for_returning_description,$asset_tag_number,$date_created);
                    
            if($added_updated_device_id >0){
                
                $res = array(
                    'success' =>'The device has been successully saved');
                    echo json_encode($res);

            }else{
                $res = array(
                    'error' => 'An internal error has occured');
                    echo json_encode($res);

            }

        }

        }
    

    }
    public function check_if_device_has_been_returned(){
		$request = \Config\Services::request();
		$asset_tag_number = $request->getVar('asset_tag_number');
        $device_serial_no = $request->getVar('device_serial_no');
        $device_imei_no = $request->getVar('device_imei_no');
        
		$this->DeviceModel = new DeviceModel();
        $check_if_device_exists =$this->DeviceModel->get_user_by_asset_tag_or_imei_or_serial_no($asset_tag_number, $device_serial_no,$device_imei_no);
       
		if($check_if_device_exists != null){
            $data['check_if_device_exists']=$check_if_device_exists;
            $html = view('Device\filtered_device', $data);
			$res = array(
                'success' => $html);

            echo json_encode($res);
		}else{

			$res = array(
                'error' => 0);

            echo json_encode($res);

		}

    }
    
    public function load_returned_devices_list(){
        $this->DeviceModel = new DeviceModel(); 
        $data['device_list']=$this->DeviceModel->select_all_returned_devices($is_returned=1);
        $data['search_function']=0;
        echo view('Device\added_returned_devices_list', $data);
        
    }
    public function load_view_device_view(){
        $request = \Config\Services::request();
        $device_id = $request->getVar('device_id');
        // Codeigniter has chosen to return all values as string so this is a measure to recovert deviceId to int
        $device_id =(int) $device_id;
        $this->DeviceModel = new DeviceModel();
        $data['device_data']=$this->DeviceModel->get_device_data_by_id($device_id); 
        $data['device_id'] = $device_id;
        echo view('Device\view_device_details', $data);
    

    }
    public function search_device(){

        $request = \Config\Services::request();
        $this->DeviceModel = new DeviceModel();
        $user_input=$request->getVar('user_input');
        $data['device_list']=$this->DeviceModel->search_device($user_input);
		$data['search_function']=1;
        echo view('Device\added_returned_devices_list', $data);

    }
    public function search_all_device(){
        $request = \Config\Services::request();
        $this->DeviceModel = new DeviceModel();
        $user_input=$request->getVar('user_input');
        $data['device_list']=$this->DeviceModel->search_all_device($user_input);
        $data['search_function']=1;
        echo view('Device\all_devices', $data);
     

    }
    public function delete_device(){
		$request = \Config\Services::request();
		$this->DeviceModel = new DeviceModel();  
		$deleted=$request->getVar('deleted');
		$device_id=$request->getVar('device_id');
		$delete_device_details=$this->DeviceModel->delete_device($device_id,$deleted);
		if($delete_device_details){
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