<?php

namespace Soap\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\DriverInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select as Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

class NavistarPlugin extends AbstractPlugin{
   
    protected $adapter;
   
    public function __construct(Adapter $adapter){
        $this->adapter = $adapter;
    }

    public function saveEmployee($employee){

    	$core_table = 'jos_users';
    	$sql = new Sql($this->adapter);

    	//is email set?
    	if(isset($employee->email)){

    		//checking if it exists in database
	    	$exists = $this->searchEmployee($employee->email);
	        if($exists > 0){

	        	//it exists, so let's update its info
    			$n_employee = array();
	        	
	        	//cleaning the information to update
	        	if(isset($employee->username)){
	        		$n_employee['username'] = $employee->username;
	        	}

	        	if(isset($employee->firstname)){
	        		$n_employee['name'] = $employee->firstname;
	        	}

	        	if(isset($employee->password)){
	        		$n_employee['password'] = $employee->password;
	        	}

	        	//update action
    			$update = $sql->update();
    			$update->table($core_table)
    				   ->set($n_employee)
    				   ->where(array('email' => $employee->email));

    			$statement = $sql->prepareStatementForSqlObject($update);

    			//executing statement
			    try {
			        $result = $statement->execute();
				    //return 31 - user already exists. Information updated.
				    return 31;
			    } catch (\Exception $e) {
			        die('Error: ' . $e->getMessage());
			    }

	        }else{
	        	/* Insert into jos_users */
	        	$insert_users = $sql->insert($core_table);
	        	$n_employee = array(
	        		'name' 	       => $employee->firstname,
	        		'username'     => $employee->username,
	        		'email'        => $employee->email,
	        		'password'     => $employee->password,
	        		'sendEmail'    => 1,
	        		'registerDate' => date('Y-m-d H:i:s')
	        	);
	        	$insert_users->values($n_employee);
	        	$statement = $sql->prepareStatementForSqlObject($insert_users);
		        $result = $statement->execute();
		        $last_user = $this->adapter->getDriver()->getLastGeneratedValue();

			    /* Insert into jos_virtuemart_userinfos */
			    $n_virtuemart_userinfos = array(
			    	'virtuemart_user_id' => $last_user,
			    	'address_type' => $employee->address_type,
			    	'address_type_name' => '-',
			    	'name' => $employee->firstname,
			    	'company' => $employee->company,
			    	'title' => '-',
			    	'last_name' => $employee->lastname,
			    	'first_name' => $employee->firstname,
			    	'middle_name' => '-',
			    	'phone_1' => $employee->phone1,
			    	'phone_2' => $employee->phone2,
			    	'fax' => $employee->fax,
			    	'address_1' => $employee->address1,
			    	'address_2' => $employee->address2,
			    	'city' => $employee->city,
			    	'virtuemart_state_id' => $employee->state,
			    	'virtuemart_country_id' => $employee->country,
			    	'zip' => $employee->zipcode,
			    	'agreed' => '0',
			    	'created_on' => date('Y-m-d H:i:s'),
			    	'created_by' => $last_user,
			    	'modified_on' => date('Y-m-d H:i:s'),
			    	'modified_by' => $last_user,
			    	'locked_on' => '0000-00-00 00:00:00',
			    	'locked_by' => '0',
			    );
				$insert_vm_infos = $sql->insert('jos_virtuemart_userinfos');
				$insert_vm_infos->values($n_virtuemart_userinfos);
	        	$statement = $sql->prepareStatementForSqlObject($insert_vm_infos);
	        	$result = $statement->execute();

	        	/* Insert into jos_virtuemart_vmuser_shoppergroups */
	        	$n_virtuemart_vmuser_shoppergroups = array(
	        		'virtuemart_user_id' => $last_user,
	        		'virtuemart_shoppergroup_id' => 2
	        	);
	        	$insert_vm_shoppergroup = $sql->insert('jos_virtuemart_vmuser_shoppergroups');
	        	$insert_vm_shoppergroup->values($n_virtuemart_vmuser_shoppergroups);
	        	$statement = $sql->prepareStatementForSqlObject($insert_vm_shoppergroup);
	        	$result = $statement->execute();

	        	/* Insert into jos_virtuemart_vmusers */
	        	$n_virtuemart_vmuser = array(
	        		'virtuemart_user_id' => $last_user,
	        		'virtuemart_vendor_id' => 0,
	        		'user_is_vendor' => 0,
	        		'customer_number' => md5($employee->username),
	        		'perms' => 'shopper',
	        		'agreed' => 1,
	        		'created_on' => date('Y-m-d h:i:s'),
	        		'created_by' => 0,
	        		'modified_on' => date('Y-m-d h:i:s'),
	        		'modified_by' => 0,
	        		'locked_on' => '0000-00-00 00:00:00',
	        		'locked_by' => 0
	        	);
	        	$insert_vm_vmuser = $sql->insert('jos_virtuemart_vmusers');
	        	$insert_vm_vmuser->values($n_virtuemart_vmuser);
	        	$statement = $sql->prepareStatementForSqlObject($insert_vm_vmuser);
	        	$result = $statement->execute();

		        //return 33 - user successfully saved.
			    return 33;
	        }

	    }

	    //return 30 - username is missing in json
        return 30;

    }
    
    public function searchEmployee($employee){

    	$sql = new Sql($this->adapter);

    	$select = $sql->select();
        $select->from('jos_users')
               ->where(array('email' => $employee));
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();

        return $resultSet->count();

    }
}