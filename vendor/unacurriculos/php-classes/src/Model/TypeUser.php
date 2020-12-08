<?php 

namespace UnaCurriculos\Model;

use \Unacurriculos\DB\Sql;
use \Unacurriculos\Model;


class TypeUser extends Model
{

	const ADMIN = 1;
	const CPF = 2;
	const CNPJ = 3;



	public static function listAll()
	{
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_typeusers ORDER BY destypeuser");

	}
}

 ?>