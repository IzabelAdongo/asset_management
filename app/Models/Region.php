<?php

namespace App\Models;

use CodeIgniter\Model;

class Region extends Model
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



	public function insert_update_region_data($region_id, $sub_county_id_fk,$registration_offce_id_fk, $region_telephone){
        
                    $data= array(
            'sub_county_id_fk'=>$sub_county_id_fk,
            'registration_offce_id_fk'=>$registration_offce_id_fk,
            'region_telephone'=>$region_telephone,
    
                    );
       
       if($region_id >0){
           $where=array('region_id'=>$region_id);
        $this->db->table('region')->where($where)->update($data); 
        // return $region_id;
       }else{

        $this->db->query("insert into region (sub_county_id_fk, registration_offce_id_fk, region_telephone)
        values
        ('".$sub_county_id_fk."', '".$registration_offce_id_fk."', '".$region_telephone."')
        ");
        $region_id = $this->db->insertID(); 
       }
		return $region_id;
		
    }
    public function select_all_regions(){
        return $this->db->query("select * from region
                             inner join subcounty on region.registration_offce_id_fk=subcounty.subcounty_id
                             inner join county on subcounty.county_id_fk= county.county_id
                             inner join registration_office on subcounty.subcounty_id=registration_office.sub_county_id_fk ")->getResult(); 

       
        
          
  }
  public function get_office_by_id($id){
    return $this->db->query("select * from registration_office where registration_office_id='".$id."'")->getRow();
    
  }
  public function get_all_counties(){
    return $this->db->query("select * from county")->getResult(); 

  }
  public function get_all_sub_counties(){
    return $this->db->query("select * from subcounty")->getResult(); 

  }
  public function get_all_registration_offices_sub_cnty(){
    return $this->db->query("select * from registration_office")->getResult(); 

  }
  public function get_region_by_id($region_id){
    return $this->db->query("select * from region where region_id='".$region_id."'")->getRow(); 

  }
  public function get_subcounty_dependent_dropdown_values($county_id){
    return $this->db->query("select subcounty_id as dropdown_value,subcounty_name as dropdown_text from subcounty where county_id_fk='".$county_id."' ORDER BY subcounty_name ASC")->getResult(); 
  }
  public function get_registration_office_dependent_dropdown_values($sub_county_id){
    return $this->db->query("select registration_office_id as dropdown_value, registration_office_name as dropdown_text from registration_office where sub_county_id_fk='".$sub_county_id."' ORDER BY registration_office_name ASC")->getResult(); 
 
  }
  public function insert_update_registration_office($registration_office_id,$registration_office_name, $sub_county_id_fk){
        
    $data= array(
    'registration_office_id'=>$registration_office_id,
    'registration_office_name'=>$registration_office_name,
    'sub_county_id_fk'=>$sub_county_id_fk,

    );
        if($registration_office_id >0){
        $where=array('device_id'=>$device_id);
        $this->db->table('device')->where($where)->update($data); 
        return $registration_office_id;
        }else{

        $this->db->query("insert into registration_office (registration_office_id, registration_office_name, sub_county_id_fk)
        values
        ('".$registration_office_id."', '".$registration_office_name."', '".$sub_county_id_fk."')
        ");
        $registration_office_id = $this->db->insertID(); 
        }
        return $registration_office_id;

    }
    public function get_all_registered_offices(){
      return $this->db->query("SELECT * from registration_office
      INNER JOIN subcounty ON registration_office.sub_county_id_fk=subcounty.subcounty_id
      INNER JOIN county ON subcounty.county_id_fk=county.county_id
      WHERE deleted=0
      ")->getResult();

    }
    public function delete_office($registration_office_id,$deleted){
      if($registration_office_id >0){
        $data= array('deleted'=>$deleted,);
        $where=array('registration_office_id'=>$registration_office_id);
        if($this->db->table('registration_office')->where($where)->update($data)){
          return true;
        }else{
          return false;
        } 
      }else{
    
        return false;
      }
      
    
    }

 
	
}
