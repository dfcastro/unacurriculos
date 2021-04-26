<?php 
require_once("vendor/autoload.php");
require_once("functions.php");

use \Unacurriculos\PageAdmin;
use \Unacurriculos\Model\User;
use \Slim\Slim;
use \Unacurriculos\Page;

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

	$page->setTpl("login",[	
		"errorMsg"=>User::getError()
	]);
});

$app->post("/admin/login", function()
{
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login",[
	"errorMsg"=>User::getError()	
]);

	try
	{
		User::login($_POST['desemail'], $_POST['despassword']);
	}
	catch(Exception $e)
	{
		User::setError($e->getMessage());
	}

	header("Location: /admin");
	exit;
});

$app->get("/admin/logout", function()
{
	User::logout();

	header("Location: /admin/login");
	exit();
});


?>