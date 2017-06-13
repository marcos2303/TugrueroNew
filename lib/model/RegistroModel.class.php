<?php
 
 function validarCorreoElectronico($correo)
 {
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->users
			->select("*")
			->where("mail=?",$correo);
			return $q;
 }	
 function validarRifRazonSocial($rif)
 {
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->company_validation_ve
			->select("*")
			->where("rif=?",$rif);
			return $q;
 }
  function validarCedula($cedula)
 {
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->users_data
			->select("*")
			->where("document=?",$cedula);
			return $q;
 }
   function validarRifCompany($rif)
 {
	   $ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect('tugruero')->company
		->select("*")
		->where("rif=?",$rif);
		
		return $q;
 }
 function insertCompanyValidation($rif,$correo,$razonSocial)
 {
	 $values = array('rif' => $rif,'razon_social' => $razonSocial);
	 $ConnectionORM = new ConnectionORM();
	 $q = $ConnectionORM->getConnect('tugruero')->company_validation_ve()->insert($values);
	 return $q;
 }
 function addToken($datos)
 {
	$values["date_created"] = date("Y-m-d H:i:s");
	$values["date_updated"] = date("Y-m-d H:i:s");
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->users_token()->insert($datos);
	return $q;
 }
 function validarToken($token)
 {
	 $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->users_token
			->select("*")
			->where("token=?",$token)
			->and("validate=?",0)
			->and("time_expire >=?",date("Y-m-d H:i:s"));
			return $q;
 }
 function utilizarToken($token)
 {
	$token = $token;
	$values = array("validate" => 1);
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->users_token('token', $token)->update($values);
	return $q;
 }
function GetCompanyValidation($idCompanyValidation)
 {
	
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')
			->company_validation_ve
			->select("*")
			->where("id=?",$idCompanyValidation);
	return $q;
 } 
 function addCompany($values)
 {
	$values["date_created"] = date("Y-m-d H:i:s");
	$values["date_updated"] = date("Y-m-d H:i:s");
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->company()->insert($values);
	return $q;
 }
 function addUsersCompany($values)
 {
	$values["date_created"] = date("Y-m-d H:i:s");
	$values["date_updated"] = date("Y-m-d H:i:s");
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->users_company()->insert($values);
	return $q;
 }
  function addUser($values)
 {
	$values["date_created"] = date("Y-m-d H:i:s");
	$values["date_updated"] = date("Y-m-d H:i:s");
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->users()->insert($values);
	return $q;
 }
 function updateUser($values)
 {
	$id = $values["id_user"];
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->users('id_user', $id)->update($values);
	return $q;
 }
  function addCompanyFiles($values)
 {
	$values["date_created"] = date("Y-m-d H:i:s");
	$values["date_updated"] = date("Y-m-d H:i:s");
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->company_files()->insert($values);
	return $q;
 }
  function addUserData($values)
 {
	$values["date_created"] = date("Y-m-d H:i:s");
	$values["date_updated"] = date("Y-m-d H:i:s");
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->users_data()->insert($values);
	return $q;
 }
  function addUserPerms($values)
 {
	$values["date_created"] = date("Y-m-d H:i:s");
	$values["date_updated"] = date("Y-m-d H:i:s");
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->users_perms()->insert($values);
	return $q;
 }
 
 function updateCompanyValidation($values)
 {
	$id = $values["id"];
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')->company_validation_ve('id', $id)->update($values);
	return $q;
	
 }
 function getBankList()
 {
	$ConnectionORM = new ConnectionORM();
	$q = $ConnectionORM->getConnect('tugruero')
			->bank
			->select("*")->order('name');
	return $q;
 }
function connect($login,$password)
{

		$login = strtoupper($login);
		$password = hash('sha256', $password);
		$valid = true;
		$ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect('tugruero')->users
		->select("count(*) as cuenta")
		->where("login =?", $login)
		->and('password=?',$password)
		->and('status=?',1)
		->fetch();

		if($q['cuenta']==0){
			$valid = false;
		}

		return $valid;

}
function validateForgottenPassword($document,$nationality,$InitialFirstName,$InitialFirstLastName,$mail)
{
		$where = "users.mail = '".$mail."' "
				. "AND UPPER(LEFT(users_data.first_name,1))='".$InitialFirstName."' "
				. "AND UPPER(LEFT(users_data.first_last_name,1))= '".$InitialFirstLastName."' "
				. "AND users_data.document= '".$document."' "
				. "AND users_data.nationality= '".$nationality."' "
				. "AND users.status= 1";
		$InitialFirstName = strtoupper($InitialFirstName);
		$InitialFirstLastName = strtoupper($InitialFirstLastName);
		$ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect('tugruero')->users
		->select("users.id_user,users.mail")
		->join("users_data","inner join users_data on users_data.id_users = users.id_user")
		->join("users_perms","inner join users_perms on users_perms.id_user = users.id_user")
		->where($where)
		->and("users_perms.id_perms =?",3);

		
		
		return $q;

}


