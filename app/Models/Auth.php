<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth extends Model
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



	public function validateUser($email, $password, $national_id){

		// return $this->db->query('select * from user_account')->getRow();
		return $user_rows =$this->db->query("select * from user_account where 
		(user_account_email = '".$email."' AND user_account_password='".$password."')
		 OR (user_account_national_id='".$national_id."' AND user_account_password='".$password."')")->getNumRows();
	
	}
	
}
