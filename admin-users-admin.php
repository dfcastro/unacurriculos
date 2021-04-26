<?php
use \Unacurriculos\PageAdmin;
use \Unacurriculos\Model\User;
use \Unacurriculos\Model\TypeUser;


$app->get("/admin/users-admin", function()
{
	User::verifyLogin();

	$users= User::listAll();
	
	$page= new PageAdmin();

	$page->setTpl("users-admin", [
		"users"=>$users
	]);
});

$app->get("/admin/users-admin/create", function()
{
	User::verifyLogin();

	$page= new PageAdmin();

	$page->setTpl("users-admin-create",[
		"typeuser"=>TypeUser::listAll(),
		"errorMsg"=>User::getError(),
		"userDespersonForm"=>User::getUserDespersonForm(),
		"userDesemailForm"=>User::getUserDesemailForm(),
		"userNrphoneForm"=>User::getUserNrphoneForm()
		
	]);
});

$app->get("/admin/users-admin/:iduser/delete", function($iduser)
{
	User::verifyLogin();
	
	$user =new User();

	$user->get((int)$iduser);

	$user->delete();

	header ("Location: /admin/users-admin");
	exit;
});

$app->get("/admin/users-admin/:iduser", function($iduser)
{	
	User::verifyLogin();
	$user = new User();

	$user->get((int)$iduser);

	$page = new PageAdmin();
	$page->setTpl("users-admin-update",array(
		"user"=>$user->getValues(),
		"typeuser"=>TypeUser::listAll()
	
	));

});


$app->post("/admin/users-admin/create", function()
{

	User::verifyLogin();
	
	User::setUserDespersonForm($_POST['desperson']);

	User::setUserDesemailForm($_POST['desemail']);	

	User::setUserNrphoneForm($_POST['nrphone']);

	 if(!isset($_POST['desperson']) || $_POST['desperson'] === '')
	{
		User::setError("Preencha o campo nome de usuário.");
		header("Location: /admin/users-admin/create");
		exit;
	} else 	if(!isset($_POST['desemail']) || $_POST['desemail'] === '')
	{
		User::setError("Digite um email");
		header("Location: /admin/users-admin/create");
		exit;
	}else	if(!isset($_POST['despassword']) || $_POST['despassword'] === '')
	{
		User::setError("Preencha o campo senha.");
		header("Location: /admin/users-admin/create");
		exit;
	}else 	if(!isset($_POST['despassword-confirm']) || $_POST['despassword-confirm'] === '')
			{
		User::setError("Preencha o campo confirme a senha.");
		header("Location: /admin/users-admin/create");
		exit;
	}else if(($_POST["despassword"]) !== $_POST["despassword-confirm"] )
	{
		User::setError("Preencha o campo senha e confirme senha igualmente.");
		header("Location: /admin/users-admin/create");
		exit;
	}

	$user = new User();
	//$_POST['desperson'] = utf8_encode($_POST['desperson']);


		if($user->checkLoginExist($_POST['desemail'])){
			User::setError("Email de usuário já cadastrado.");
			header("Location: /admin/users-admin/create");
			exit;
		}

		$user->setData($_POST);

		$user->save();

		header("Location: /admin/users-admin/create");

		User::clearUserDesemailForm();

		User::clearUserDespersonForm();

		User::clearUserNrphoneForm();

		exit;
		
});


$app->post("/admin/users-admin/:iduser", function($iduser)
{	
	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header("Location: /admin/users-admin");
	exit;
});
?>