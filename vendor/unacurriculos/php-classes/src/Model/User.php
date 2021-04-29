<?php 

namespace Unacurriculos\Model;

use \Unacurriculos\Model;
use \Unacurriculos\DB\Sql;

class User extends Model {

	const SESSION = "User";
	const ERROR = "UserError";
	const SUCCESS = "UserSucesss";
	const USERDESPERSONFORM = "UserDespersonForm";
	const USERNRPHONEFORM = "UserNrPhoneForm";
	const USERDESEMAILFORM = "UserDesemailForm";

	protected $fields = [
		"iduser", "idperson", "idtypeuser", "desemail", "despassword", "dtregister"
	];

	public static function login($desemail, $password):User
	{

		$db = new Sql();

		$results = $db->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) WHERE desemail = :desemail", array(
			":desemail"=>$desemail
		));
	
		if (count($results) === 0) {
			throw new \Exception("Não foi possível fazer login.");
		}

		$data = $results[0];

		if (password_verify($password, $data["despassword"])) {

			$user = new User();
			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;

		} else {

			throw new \Exception("Não foi possível fazer login.");

		}

	}

	public static function logout()
	{

		$_SESSION[User::SESSION] = NULL;

	}

	public static function verifyLogin($idtypeuser = 1)
	{

		if (
			!isset($_SESSION[User::SESSION])
			|| 
			!$_SESSION[User::SESSION]
			||
			!(int)$_SESSION[User::SESSION]["iduser"] > 0
			||
			(int)$_SESSION[User::SESSION]["idtypeuser"] !== 1
		) {
			
			header("Location: /admin/login");
			exit;

		}

	}

	public static function listAll()
	{
		$sql = new Sql();

		$results= $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson)
		INNER JOIN tb_typeusers c using(idtypeuser)
		WHERE idtypeuser= 1
		 ORDER BY b.desperson ;");

		return $results;
	}

	public function get($iduser)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) WHERE a.iduser = :iduser", array(
			":iduser"=>$iduser
		));

		$data = $results[0];

		$data['desperson'] = utf8_decode($data['desperson']);


		$this->setData($data);

	}

	public function save()
	{
		$sql = new Sql();
		$results = $sql->select("CALL sp_users_save(:desperson, :idtypeuser, :despassword, :desemail, :nrphone)", [
			":desperson" => utf8_encode($this->getdesperson()),
			":idtypeuser" =>$this->getidtypeuser(),
			":despassword"=>User::getPasswordHash($this->getdespassword()),
			":desemail" =>$this->getdesemail(),
			":nrphone" =>$this->getnrphone()
		]);

		$this->setData($results[0]);
	}

	public function update()
	{

		$sql = new Sql();

	$results = $sql->select("CALL sp_usersupdate_save(:iduser, :desperson, :idtypeuser, :despassword, :desemail, :nrphone)", [
			":iduser"=>$this->getiduser(),
			":desperson" => utf8_encode($this->getdesperson()),
			":idtypeuser" =>$this->getidtypeuser(),
			":despassword"=>User::getPasswordHash($this->getdespassword()),
			":desemail" =>$this->getdesemail(),
			":nrphone" =>$this->getnrphone()
		]);

		$this->setData($results[0]);		

	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("CALL sp_users_delete(:iduser)", array(
			":iduser"=>$this->getiduser()
		));

	}

	public static function getPasswordHash($password)
	{

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);
	}

	public static function setSuccess($msg)
	{

		$_SESSION[User::SUCCESS] = $msg;

	}

	public static function getSuccess()
	{

		$msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : '';

		User::clearSuccess();

		return $msg;

	}

	public static function clearSuccess()
	{

		$_SESSION[User::SUCCESS] = NULL;

	}

	public static function setError($msg)
	{

		$_SESSION[User::ERROR] = $msg;

	}

	public static function getError()
	{

		$msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : '';

		User::clearError();

		return $msg;

	}

	public static function clearError()
	{

		$_SESSION[User::ERROR] = NULL;

	}

	public static function checkLoginExist($desemail)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_persons WHERE desemail = :desemail", [
			':desemail'=>$desemail
		]);
		//var_dump($results);
		//exit;
		if(count($results) === 0){
			return false;
		}else{
			return true;
		}

	}



	public static function setUserDespersonForm($UserDespersonForm)
	{

		$_SESSION[User::USERDESPERSONFORM] = $UserDespersonForm;

	}

	public static function getUserDespersonForm()
	{

		$userDespersonForm = (isset($_SESSION[User::USERDESPERSONFORM]) && $_SESSION[User::USERDESPERSONFORM]) ? $_SESSION[User::USERDESPERSONFORM] : '';

		User::clearUserDespersonForm();

		return $userDespersonForm;

	}

	public static function clearUserDespersonForm()
	{

		$_SESSION[User::USERDESPERSONFORM] = NULL;

	}

	public static function setUserNrphoneForm($UserNrphoneForm)
	{

		$_SESSION[User::USERNRPHONEFORM] = $UserNrphoneForm;

	}

	public static function getUserNrphoneForm()
	{

		$UserNrphoneForm = (isset($_SESSION[User::USERNRPHONEFORM]) && $_SESSION[User::USERNRPHONEFORM]) ? $_SESSION[User::USERNRPHONEFORM] : '';

		User::clearUserNrphoneForm();

		return $UserNrphoneForm;

	}

	public static function clearUserNrphoneForm()
	{

		$_SESSION[User::USERNRPHONEFORM] = NULL;

	}

	public static function setUserDesemailForm($UserDesemailForm)
	{

		$_SESSION[User::USERDESEMAILFORM] = $UserDesemailForm;

	}

	public static function getUserDesemailForm()
	{

		$UserDesemailForm = (isset($_SESSION[User::USERDESEMAILFORM]) && $_SESSION[User::USERDESEMAILFORM]) ? $_SESSION[User::USERDESEMAILFORM] : '';

		User::clearUserDesemailForm();

		return $UserDesemailForm;

	}

	public static function clearUserDesemailForm()
	{

		$_SESSION[User::USERDESEMAILFORM] = NULL;

	}
}

 ?>