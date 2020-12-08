<?php 
session_start();
require_once("vendor/autoload.php");
require_once("functions.php");

use \Slim\Slim;
use \Unacurriculos\Page;
use \Unacurriculos\PageAdmin;
use \Unacurriculos\Model\User;
use \Unacurriculos\Model\TypeUser;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new Page();
	$page->setTpl("index");
});


$app->get('/admin', function() {
    User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl("index");
});

$app->get ("/admin/login", function()
{
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");
});

$app->post("/admin/login", function()
{
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");

	User::login($_POST["desemail"], $_POST["despassword"]);

	header("Location: /admin");
	exit;
});

$app->get("/admin/logout", function()
{
	User::logout();

	header("Location: /admin/login");
	exit();
});

$app->get("/admin/users", function()
{
	User::verifyLogin();

	$users= User::listAll();
	
	$page= new PageAdmin();

	$page->setTpl("users", [
		"users"=>$users
	]);
});

$app->get("/admin/users/create", function()
{
	User::verifyLogin();

	$page= new PageAdmin();

	$page->setTpl("users-create",[
		"typeuser"=>TypeUser::listAll(),
		
	]);
});

$app->get("/admin/users/:iduser/delete", function($iduser)
{
	User::verifyLogin();
	
	$user =new User();

	$user->get((int)$iduser);

	$user->delete();

	header ("Location: /admin/users");
	exit;
});

$app->get("/admin/users/:iduser", function($iduser)
{	
	User::verifyLogin();
	$user = new User();

	$user->get((int)$iduser);

	$page = new PageAdmin();
	$page->setTpl("users-update",array(
		"user"=>$user->getValues(),
		"typeuser"=>TypeUser::listAll()
	));

});


$app->post("/admin/users/create", function()
{

	User::verifyLogin();

	/* if(!isset($_POST['desperson']) || $_POST['desperson'] === '')
	{
		User::setErrorRegister("Confirme corretamente as senhas.");
		header("Location: /admin/users/create");
		exit;
	} else if(!isset($_POST['desemail']) || $_POST['desemail'] === '')
	{
		User::setError("Digite um email");
		header("Location: /admin/users/create");
		exit;
	}else if(!isset($_POST['despassword']) || $_POST['despassword'] === '')
	{
		User::setErrorRegister("Confirme corretamente as senhas.");
		header("Location: /admin/users/create");
		exit;
	}else if(!isset($_POST['despassword-confirm']) || $_POST['despassword-confirm'] === '')
	{
		User::setErrorRegister("Confirme corretamente as senhas.");
		header("Location: /admin/users/create");
		exit;
	}else if(($_POST["despassword"]) !== $_POST["despassword-confirm"] )
	{
		User::setErrorRegister("Confirme corretamente as senhas.");
		header("Location: /admin/users/create");
		exit;
	}else{
		User::setModalUser("#modalSuccess");
	}*/

	$user = new User();
	//$_POST['desperson'] = utf8_encode($_POST['desperson']);
	$user->setData($_POST);
	
	$user->save();

	header("Location: /admin/users/create");
	exit;
});


$app->post("/admin/users/:iduser", function($iduser)
{	
	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header("Location: /admin/users");
	exit;
});


$app->run();

 ?>