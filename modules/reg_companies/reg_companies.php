<?PHP

class reg_companies extends Basic {
	
	var $new_schema = true;
	var $module_dir = 'reg_companies';
	var $object_name = 'reg_companies';
	var $table_name = 'reg_companies';
	var $importable = false;
	var $disable_row_level_security = true ; // to ensure that modules created and deployed under CE will continue to function under team security if the instance is upgraded to PRO
	var $id;
	var $name;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	var $modified_by_name;
	var $created_by;
	var $created_by_name;
	var $description;
	var $deleted;
	var $created_by_link;
	var $modified_user_link;
	var $assigned_user_id;
	var $assigned_user_name;
	var $assigned_user_link;
	var $type;
	var $name2;
	var $name3;
	var $nif;
	var $residence;
	var $address_city;
	var $address_state;
	var $address_postalcode;
	var $address_country;
	var $address;
	var $conditions;
	var $is_default;
	
	function reg_companies(){	
		parent::Basic();
	}
	
	function bean_implements($interface){
		switch($interface){
			case 'ACL': return true;
		}
		return false;
	}
	
	function save( $check_notify = FALSE ){
		
		// You cannot remove default check directly
		if( !$this->is_default
			  && !empty($this->fetched_row['is_default'])
			  && $this->fetched_row['is_default']
		){
			$this->is_default = true;
		}
		
		// Only one default company
		if( $this->is_default && !$this->fetched_row['is_default'] ){
			$this->db->query( 'UPDATE reg_companies SET is_default = 0' );
		}
		
		parent::save( $check_notify );
	}
	
}
