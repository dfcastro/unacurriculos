<?php

use Unacurriculos\Model\Cnpj;
use \Unacurriculos\PageAdmin;
use \Unacurriculos\Model\User;
use \Unacurriculos\Model\TypeUser;


$app->get("/admin/users-admin", function()
{
	User::verifyLogin();

	$cnpjs= Cnpj::listAll();
	
	$page= new PageAdmin();

	$page->setTpl("users-cnpj", [
		"users"=>$cnpjs
	]);
});


?>