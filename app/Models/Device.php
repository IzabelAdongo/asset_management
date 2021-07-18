<?php

namespace App\Models;

use CodeIgniter\Model;

class Device extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'auths';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];



	public function insert_update_device_data($device_id,$device_name, $device_serial_no, $device_imei_no, $logged_in_user,$returned_by_user,$reason_for_return_id,$date_of_return, $is_returned=0,$reason_for_returning_description,$asset_tag_number,$current_date){
        
                    $data= array(
            'device_name'=>$device_name,
            'device_serial_no'=>$device_serial_no,
			'device_imei_no'=>$device_imei_no,
			'reason_for_returning_description'=>$reason_for_returning_description,
			'reason_for_return_id'=>$reason_for_return_id,
			'asset_tag_number'=>$asset_tag_number,
			'updated_date'=>$current_date,
			'updated_by'=>$logged_in_user,

                    );
       
       if($device_id >0){
           $where=array('device_id'=>$device_id);
        $this->db->table('device')->where($where)->update($data); 
        return $device_id;
       }else{

        $this->db->query("insert into device (device_name, device_serial_no, device_imei_no, created_by,returned_by_user,reason_for_return_id,date_of_return,is_returned,reason_for_returning_description,asset_tag_number,date_created)
        values
        ('".$device_name."', '".$device_serial_no."', '".$device_imei_no."','".$logged_in_user."','".$returned_by_user."','".$reason_for_return_id."','".$date_of_return."','".$is_returned."','".$reason_for_returning_description."','".$asset_tag_number."','".$current_date."')
        ");
        $device_id = $this->db->insertID(); 
       }
		return $device_id;
		
    }
    public function select_all_devices(){
        
       
		return $this->db->query("select * from device
		inner join user_account on device.created_by =user_account.user_account_id
		WHERE device.deleted =0
		")->getResult();           
  }
  public function get_device_data_by_id($device_id){
        
       
	return $this->db->query("select * from device 
	inner join user_account on device.created_by =user_account.user_account_id
	inner join user_returning_device on device.returned_by_user =user_returning_device.user_returning_device_id
	inner join reason_for_returning_device on device.reason_for_return_id=reason_for_returning_device.reason_for_returning_device_id
	 where device_id= '".$device_id."'
	 AND device.deleted = 0")->getRow(); 
      
}
public function get_user_that_added_device($device_id){
        
       
	return $this->db->query("select * from device 
	inner join user_account on device.created_by =user_account.user_account_id
	 where device_id= '".$device_id."'")->getRow(); 
      
}
public function select_all_unassigned_assigned_devices($status_id){
    return $this->db->query("select * from device inner join user_account on device.created_by =user_account.user_account_id where device_status='".$status_id."'")->getResult(); 

}
public function assign_device_to_region($sub_county_id_fk, $device_id,$device_status){
        
    

	$this->db->query("insert into assigned_device_region (sub_county_id_fk, device_id_fk)
	values 
	('".$sub_county_id_fk."', '".$device_id."')
	");
	$assigned_device_region_id = $this->db->insertID(); 

	$this->db->query("UPDATE device
	SET device_status = '".$device_status."'
	WHERE device_id='".$device_id."'
    "); 


	return $assigned_device_region_id;

}
public function return_device($formerly_assigned_region, $device_condition,$device_status, $reason_for_returning, $device_id){
        
    

	$this->db->query("insert into returned_assets (formerly_assigned_region, device_condition,reason_for_returning )
	values 
	('".$formerly_assigned_region."', '".$device_condition."','".$reason_for_returning."' )
	");
	$returned_device = $this->db->insertID(); 

	$this->db->query("UPDATE device
	SET device_status = '".$device_status."'
	WHERE device_id='".$device_id."'
    "); 


	return $returned_device;

}
public function get_returned_device_data_by_id($device_id){
	return $this->db->query("select * from device inner join user_account on device.created_by =user_account.user_account_id AND device.returned_by_user=user_account.user_account_id where device_id= '".$device_id."' AND device.deleted=0")->getRow(); 
}
public function get_all_reasons_for_return_of_device(){

	return $this->db->query("select * from reason_for_returning_device")->getResult(); 

}
public function select_all_returned_devices($is_returned){
	return $this->db->query("select * from device
	inner join user_returning_device on device.returned_by_user =user_returning_device.user_returning_device_id
	inner join reason_for_returning_device on device.reason_for_return_id=reason_for_returning_device.reason_for_returning_device_id
	where is_returned='".$is_returned."'
	AND device.deleted=0
	")->getResult(); 

}
public function select_all_reusable_returned_devices_count($is_returned,$reusable){
	return $this->db->query("select COUNT(*) as total from device 
	inner join user_returning_device on device.returned_by_user =user_returning_device.user_returning_device_id
	inner join reason_for_returning_device on device.reason_for_return_id=reason_for_returning_device.reason_for_returning_device_id
	where is_returned='".$is_returned."'
	AND reusable='".$reusable."'
	AND device.deleted=0
	")->getRow(); 

}
public function select_all_returned_devices_count($is_returned){
	return $this->db->query("select COUNT(*) as total from device 
	inner join user_returning_device on device.returned_by_user =user_returning_device.user_returning_device_id
	inner join reason_for_returning_device on device.reason_for_return_id=reason_for_returning_device.reason_for_returning_device_id
	where is_returned='".$is_returned."'
	AND device.deleted=0
	")->getRow(); 

}


public function get_user_by_asset_tag_or_imei_or_serial_no($asset_tag_number, $device_serial_no,$device_imei_no){
	return $this->db->query("select * from device
	inner join user_returning_device on device.returned_by_user =user_returning_device.user_returning_device_id
	inner join user_account on device.created_by =user_account.user_account_id
	inner join reason_for_returning_device on device.reason_for_return_id=reason_for_returning_device.reason_for_returning_device_id
	 where (
		REPLACE(asset_tag_number, ' ', '') LIKE REPLACE('".$asset_tag_number."', ' ', '')
		OR REPLACE(device_serial_no, ' ', '') LIKE REPLACE('".$device_serial_no."', ' ', '')
		OR REPLACE(device_imei_no, ' ', '') LIKE REPLACE('".$device_imei_no."', ' ', '')
		) 
		AND is_returned=1
		AND device.deleted =0")->getRow(); 
}
public function select_all_faulty_devices_count($reason_for_return_id){
	return $this->db->query("select COUNT(*) as total from device 
	inner join user_returning_device on device.returned_by_user =user_returning_device.user_returning_device_id
	inner join reason_for_returning_device on device.reason_for_return_id=reason_for_returning_device.reason_for_returning_device_id
	where reason_for_return_id='".$reason_for_return_id."'
	AND device.deleted = 0
	")->getRow(); 

}

public function search_device($user_input){
	return $this->db->query("select * from device 
	inner join user_returning_device on device.returned_by_user =user_returning_device.user_returning_device_id
	inner join reason_for_returning_device on device.reason_for_return_id=reason_for_returning_device.reason_for_returning_device_id
	where (
	REPLACE(device_name, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(device_serial_no, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(device_imei_no, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(date_created, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(asset_tag_number, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(reason_for_returning_description, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	)
	AND device.deleted = 0
	ORDER BY device_name DESC")->getResult(); 
}
public function search_all_device($user_input){
	return $this->db->query("select * from device
	inner join user_account on device.created_by =user_account.user_account_id
	where(
	REPLACE(device_name, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(device_serial_no, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(device_imei_no, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(date_created, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(asset_tag_number, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(reason_for_returning_description, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	)
	AND device.deleted =0
	ORDER BY device_name DESC")->getResult(); 
}
public function get_device_data_by_id_device_internal_useer($device_id){
        
       
	return $this->db->query("select * from device 
	inner join user_account on device.created_by =user_account.user_account_id
	left join user_returning_device on device.returned_by_user =user_returning_device.user_returning_device_id
	left join reason_for_returning_device on device.reason_for_return_id=reason_for_returning_device.reason_for_returning_device_id
	 where device_id= '".$device_id."'
	 AND device.deleted =0")->getRow();
      
}
public function delete_device($device_id,$deleted){
	if($device_id >0){
		$data= array('deleted'=>$deleted,);
		$where=array('device_id'=>$device_id);

		if($this->db->table('device')->where($where)->update($data)){
			return true;
		}else{
			return false;
		} 
	}else{

		return false;
	}
	

}



 	
}
