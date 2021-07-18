<?php

namespace App\Controllers;
use App\Models\Auth as AuthModel;
use App\Models\Users as UsersModel;
use App\Models\Device as DeviceModel;

class Auth extends BaseController
{

    
    public function index()
    {
        echo 'Hello World!';
    }

    public function login(){
   
        $session = session();
        $request = \Config\Services::request();
        
        $password = $request->getVar('password');
        $login_input = $request->getVar('login_input');
       
        $this->UsersModel = new UsersModel();
        $user_data =$this->UsersModel->get_user_by_email_or_national_id_login($login_input);
        if(!empty($user_data)){
            
            if(password_verify($password,$user_data->user_account_password))
            {   
           
            $session_data = [
                'user_account_id'       => $user_data->user_account_id,
                'user_account_name'     => $user_data->user_account_name,
                'user_account_email'    => $user_data->user_account_email,
                'user_group_id_fk' => $user_data->user_group_id_fk,
                'user_account_first_name' => $user_data->user_account_first_name,
                'user_account_second_name' => $user_data->user_account_second_name,
                'last_login' => $user_data->last_login,  
                'logged_in'     => TRUE
            ];
            $update_logged_in =$this->UsersModel->update_user_logged_in_info($user_data->user_account_id);
            if($update_logged_in===true){
            $session->set($session_data);
            return redirect()->to('/dashboard'); 
            }else{
                $session->setFlashdata('msg', 'an internal error has occurres');
                return redirect()->to('/home');
            } 
        }else{
            $session->setFlashdata('msg', 'Wrong Email/NationalID or Password');
            return redirect()->to('/home');

        }   
            
		}else{
            $session->setFlashdata('msg', 'Wrong Email/NationalID or Password');
            return redirect()->to('/home');

		}

		
    
    }
    public function log_out(){
        $session = session();
        $session->destroy();
        return redirect()->to('/home');
    }

    public function load_update_password_view(){
        $request = \Config\Services::request();
        $data['user_account_id']=$request->getVar('user_account_id');
        $data['new_user']=$request->getVar('new_user');
		echo view('Users\update_user_password', $data);


	}
	public function update_user_password(){
        $session = session();
        $request = \Config\Services::request();
        $user_account_id=$request->getVar('user_account_id');
        $new_password =password_hash($request->getVar('new_password'),PASSWORD_DEFAULT);
        $this->UsersModel = new UsersModel();
        $update_user_password =$this->UsersModel->update_user_password($user_account_id,$new_password);
        if($update_user_password=true){
            $get_logged_in_details=$this->UsersModel->get_user_by_id($user_account_id);
            $session->set('last_login', $get_logged_in_details->last_login);
            $res = array(
                'success' => 'Saved Sucessfully
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