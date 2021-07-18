<?php

namespace App\Controllers;
use App\Models\Region as RegionModel;

class Region extends BaseController
{

    
    public function index()
    {
        echo 'Hello World!';
    }
    public function load_add_edit_registration_office_views(){
  
        $request = \Config\Services::request();
        $registration_office_id = $request->getVar('registration_office_id');
        $this->RegionModel = new RegionModel();      
        $data['counties']=$this->RegionModel->get_all_counties();
        $registration_office_id =(int) $registration_office_id; 
        $data['registration_office_data']=$this->RegionModel->get_office_by_id($registration_office_id);
        $data['all_offices']=$this->RegionModel->get_all_registered_offices();    
        $data['registration_office_id']=$registration_office_id;
        
        echo view('Regions\add_registration_office', $data);
        
    }
    public function add_edit_registration_office(){
        $request = \Config\Services::request();
        $registration_office_id = $request->getVar('registration_office_id');
        $registration_office_name = $request->getVar('registration_office_name');
        $sub_county_id_fk = $request->getVar('sub_county_id_fk');
        $registration_office_id =(int) $registration_office_id; 
        $sub_county_id_fk =(int) $sub_county_id_fk; 
        $this->RegionModel = new RegionModel();      
        $added_updated_reg_office_id=$this->RegionModel->insert_update_registration_office($registration_office_id,$registration_office_name,$sub_county_id_fk);
        if($added_updated_reg_office_id >0){
            $res = array(
                'success' =>'The office has been successully saved');
                echo json_encode($res);

        }else{
            $res = array(
                'error' =>'An internal error has occurred');
                echo json_encode($res);

        }
         
    }
    
     // dependent dropdowns
  public function fetch_subcounties_dropdown(){
    $request = \Config\Services::request();
    $county_id = $request->getVar('county_id');
    $this->RegionModel = new RegionModel();
    $subcounty_dropdown_data =$this->RegionModel->get_subcounty_dependent_dropdown_values($county_id);
    echo json_encode($subcounty_dropdown_data);   
    
}
public function fetch_registration_offices_dropdown(){
    $request = \Config\Services::request();
    $sub_county_id_fk = $request->getVar('sub_county_id_fk');
    $this->RegionModel = new RegionModel();
    $registraton_office_dropdown_data =$this->RegionModel->get_registration_office_dependent_dropdown_values($sub_county_id_fk);  
    echo json_encode($registraton_office_dropdown_data);
    
}
public function delete_registration_office(){

    $request = \Config\Services::request();
    $this->RegionModel = new RegionModel(); 
    $deleted=$request->getVar('deleted');
    $registration_office_id=$request->getVar('registration_office_id');
    $delete_office_details=$this->RegionModel->delete_office($registration_office_id,$deleted);
    if($delete_office_details){
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