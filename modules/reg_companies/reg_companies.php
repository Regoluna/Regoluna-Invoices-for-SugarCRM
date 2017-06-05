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
	var $billing_address_city;
	var $billing_address_street;
	var $billing_address_state;
	var $billing_address_postalcode;
	var $billing_address_country;
	var $billing_address;
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

	/**
	 * Get list of available companies for Issuer dropdown
	 */
	public static function getAvailableCompaniesList(){
		$db = DBManagerFactory::getInstance();
		$sql = 'SELECT id, name, is_default FROM reg_companies WHERE deleted=0 ORDER BY is_default DESC';
		$result = $db->query( $sql );
		$response = array();
		while( $row = $db->fetchByAssoc($result) ){
			$response[ $row['id'] ] = $row['name'];
		}
		return $response;
	}

	public function retrieveDefault(){
		$sql = 'SELECT id FROM reg_companies WHERE deleted=0 AND is_default=1';
		$result = $this->db->query( $sql );
		$row = $this->db->fetchByAssoc($result);
		if( !empty($row['id']) ){
			$this->retrieve( $row['id'] );
		}
	}


	function deleteAttachment($isduplicate="false"){

		if($this->ACLAccess('edit')){
			if($isduplicate=="true"){
				return true;
			}
			$removeFile = "upload://{$this->id}";
		}

		if(!empty($this->doc_type) && !empty($this->doc_id)){
      $document = ExternalAPIFactory::loadAPI($this->doc_type);
	    $response = $document->deleteDoc($this);
      $this->doc_type = '';
      $this->doc_id = '';
      $this->doc_url = '';
      $this->filename = '';
      $this->file_mime_type = '';
		}

		if(file_exists($removeFile)) {
			if(!unlink($removeFile)) {
				$GLOBALS['log']->error("*** Could not unlink() file: [ {$removeFile} ]");
			}else{
				$this->filename = '';
				$this->file_mime_type = '';
				$this->file = '';
				$this->save();
				return true;
			}
		} else {
			$this->filename = '';
			$this->file_mime_type = '';
			$this->file = '';
			$this->doc_id = '';
			$this->save();
			return true;
		}
		return false;
	}


}
