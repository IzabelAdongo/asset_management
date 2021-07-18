<?php

namespace App\Controllers;
use App\Models\Auth as AuthModel;
use App\Models\Device as DeviceModel;
use App\Models\Users as UsersModel;

class Dashboard extends BaseController
{

    
    public function index()
    {
        echo 'Hello World!';
    }
    public function admin_dashboard(){
        $session = session();
        $this->DeviceModel = new DeviceModel();
        $this->UsersModel = new UsersModel();  
        $data['returned_device_list']=$this->DeviceModel->select_all_returned_devices($is_returned=1);
        $data['number_of_returned_device']=$this->DeviceModel->select_all_returned_devices_count($is_returned=1);
        $data['number_of_faulty_device']=$this->DeviceModel->select_all_faulty_devices_count($reason_for_return_id=1);
        $data['number_of_device_users']=$this->UsersModel->select_all_returned_devices_users_count();
        $data['number_of_reusable_device_users']=$this->DeviceModel->select_all_reusable_returned_devices_count($is_returned=1, $reusable=1);
        if($session->get('user_account_id')==NULL||$session->get('user_account_id')==""||$session->get('user_account_id')==0){
            return view('Auth\login');
        }else{
        echo view('Dashboards\admin_dashboard', $data);
        
        }
    }


}