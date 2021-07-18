<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
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



    public function get_user_by_email_or_national_id($email,$national_id){
		return $this->db->query("select * from user_account where
		(user_account_email like'".$email."' or user_account_national_id like'".$national_id."')
		AND user_account.deleted=0")->getRow(); 
    
	  }
	  public function get_user_by_email_or_national_id_login($login_input){
		return $this->db->query("select * from user_account where
		(user_account_email like'".$login_input."' or user_account_national_id like'".$login_input."')
		AND user_account.deleted=0")->getRow(); 
    
	  }
	  
	  public function get_user_by_id($user_account_id){
		return $this->db->query("SELECT * from user_account
		LEFT JOIN user_group ON user_account.user_group_id_fk =user_group.user_group_id
		LEFT JOIN registration_office ON user_account.user_account_county_registration_office_id=registration_office.registration_office_id
		LEFT JOIN subcounty ON registration_office.sub_county_id_fk=subcounty.subcounty_id
		LEFT JOIN county ON subcounty.county_id_fk=county.county_id
		WHERE user_account_id='".$user_account_id."'")->getRow(); 
	  }
	  public function select_all_users(){
		return $this->db->query("SELECT * from user_account
		INNER JOIN user_group ON user_account.user_group_id_fk=user_group.user_group_id
		INNER JOIN registration_office ON user_account.user_account_county_registration_office_id=registration_office.registration_office_id
		WHERE user_account.deleted =0
		")->getResult(); 
	
	  }
	  public function insert_update_user_data($user_account_id, $user_account_email, $user_account_national_id,$user_account_county_registration_office_id,$user_account_first_name,$user_account_second_name, $user_group_id_fk,$date_created,$added_by,$user_account_password,$phone_number){
      
					$data= array(
			'user_account_email'=>$user_account_email,
			'user_account_national_id'=>$user_account_national_id,
			'user_account_county_registration_office_id'=>$user_account_county_registration_office_id,
			'user_account_first_name'=>$user_account_first_name,
			'user_account_second_name'=>$user_account_second_name,
			'user_group_id_fk'=>$user_group_id_fk,
			'phone_number'=>$phone_number

					);

			if($user_account_id >0){
			$where=array('user_account_id'=>$user_account_id);
			$this->db->table('user_account')->where($where)->update($data); 
			// return $region_id;
			}else{

			$this->db->query("insert into user_account
			(user_account_email, user_account_county_registration_office_id, user_account_national_id, user_account_first_name,user_account_second_name,user_group_id_fk,user_account_password,created_date,created_by,phone_number)
			values
			('".$user_account_email."', '".$user_account_county_registration_office_id."', '".$user_account_national_id."', '".$user_account_first_name."', '".$user_account_second_name."', '".$user_group_id_fk."', '".$user_account_password."','".$date_created."','".$added_by."','".$phone_number."')
			");
			$user_account_id = $this->db->insertID(); 
			
			}
			return $user_account_id;

}
public function get_all_user_groups(){
	return $this->db->query("select * from user_group")->getResult(); 
}

public function get_user_by_national_id_or_email($user_account_national_id, $user_account_email){
	return $this->db->query("select * from user_account where
	(user_account_national_id like'".$user_account_national_id."' OR user_account_email like '".$user_account_email."')
	AND user_account.deleted=0")->getRow(); 
  }
  public function get_user_by_id_table($user_account_id){
	return $this->db->query("select * from user_account where
	user_account_id='".$user_account_id."'
	AND user_account.deleted=0")->getResult(); 
  }
  public function get_returned_device_user_data_by_id($user_returning_device_id){
	return $this->db->query("select * from user_returning_device 
	where user_returning_device_id= '".$user_returning_device_id."'
	AND user_returning_device.deleted=0
	")->getResult(); 

  }
  public function get_returned_device_user_data_by_id_view($user_returning_device_id){
	return $this->db->query("SELECT * from user_returning_device 
	LEFT JOIN registration_office ON user_returning_device.registration_office_id=registration_office.registration_office_id
	LEFT JOIN subcounty ON registration_office.sub_county_id_fk=subcounty.subcounty_id
	LEFT JOIN county ON subcounty.county_id_fk=county.county_id
	WHERE user_returning_device_id= '".$user_returning_device_id."'
	AND user_returning_device.deleted=0
	")->getRow(); 

  }
  public function get_retunred_user_by_national_id_or_email($national_id, $email){
	return $this->db->query("select * from user_returning_device where
    (national_id like'".$national_id."' OR email like '".$email."')
	AND user_returning_device.deleted=0")->getRow(); 
  }

  public function insert_update_returned_device_user_data($user_returning_device_id, $email, $national_id,$registration_office_id,$first_name,$second_name,$phone_number){
						
						$data= array(
					'email'=>$email,
					'national_id'=>$national_id,
					'registration_office_id'=>$registration_office_id,
					'first_name'=>$first_name,
					'second_name'=>$second_name,
					'phone_number'=>$phone_number
						);

					if($user_returning_device_id >0){

					$where=array('user_returning_device_id'=>$user_returning_device_id);
					$this->db->table('user_returning_device')->where($where)->update($data); 
					
					}else{

					$this->db->query("insert into user_returning_device
					(email, national_id, registration_office_id, first_name,second_name,phone_number)
					values
					('".$email."','".$national_id."','".$registration_office_id."','".$first_name."','".$second_name."','".$phone_number."')
					");
					
					$user_returning_device_id = $this->db->insertID(); 

					}
					return $user_returning_device_id;

}
public function update_user_password($user_account_id,$new_password){
	$data=array('user_account_password'=>$new_password,
     );
	$where=array('user_account_id'=>$user_account_id);
	if($this->db->table('user_account')->where($where)->update($data)){
		return true;
	}else{
		return false;
	}
				

}
public function update_user_logged_in_info($user_account_id){
	$last_login=date('Y-m-d H:i:s');
	$data=array('last_login'=>$last_login);
	$where=array('user_account_id'=>$user_account_id);
	if($this->db->table('user_account')->where($where)->update($data)){
		return true;
	}else{
		return false;
	}
		
}
public function search_user($user_input){
	return $this->db->query("SELECT * from user_account
	INNER JOIN user_group ON user_account.user_group_id_fk=user_group.user_group_id
	INNER JOIN registration_office ON user_account.user_account_county_registration_office_id=registration_office.registration_office_id
	WHERE (
	REPLACE(user_account_email, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(user_account_national_id, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(user_account_first_name, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(user_account_second_name, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	OR REPLACE(created_date, ' ', '') LIKE REPLACE('".$user_input."', ' ', '')
	)
	AND user_account.deleted=0
	ORDER BY created_date DESC")->getResult(); 
  }

  public function delete_user($user_account_id, $deleted){
	
		if($user_account_id >0){
			$data= array('deleted'=>$deleted,);
			$where=array('user_account_id'=>$user_account_id);

			if($this->db->table('user_account')->where($where)->update($data)){
				return true;
			}else{
				return false;
			} 
		}else{

			return false;
		}

  }
  public function delete_device_user($user_returning_device_id,$deleted){
	if($user_account_id >0){
		$data= array('deleted'=>$deleted,);
		$where=array('user_returning_device_id'=>$user_returning_device_id);

		if($this->db->table('user_returning_device')->where($where)->update($data)){
			return true;
		}else{
			return false;
		} 
	}else{

		return false;
	}
	

  }
  public function select_all_returned_devices_users_count(){
	return $this->db->query("select COUNT(*) as total from user_returning_device 
	where user_returning_device.deleted=0
	")->getRow(); 
  }	
  public function select_all_logged_in_users_count(){
	return $this->db->query("select COUNT(*) as total from user_account 
	where last_login= DATE_SUB(NOW())
	AND Logged_out=NULL
	AND deleted =0
	")->getRow(); 
  }	  
	
}
