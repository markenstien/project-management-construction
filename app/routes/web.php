<?php
	
	$routes = [];

	$controller = '/QuotationController';

	$routes['quote'] = [
		'projectClassification' => $controller.'/projectClassification',
		'projectSize' => $controller.'/projectSize',
		'projectAddress' => $controller.'/projectAddress',
		'projectSector' => $controller.'/projectSector',
		'projectOwner' => $controller.'/projectOwner',
		'create'  => $controller.'/create',
		'index'   => $controller.'/index',
		'show'    => $controller.'/show',
		'projectAttachment' => $controller.'/projectAttachment',
		'sendToEmail'  => $controller.'/sendToEmail'
	];


	$controller = '/CustomerController';

	$routes['customer'] = [
		'create' => $controller.'/create'
	];


	$controller = '/ProjectController';

	$routes['project'] = [
		'create' => $controller.'/create',
		'edit'   => $controller.'/edit',
		'index' => $controller.'/index',
		'addCustomer' => $controller.'/addCustomer',
		'addCustomerCreate' => $controller.'/addCustomerCreate',
		'show'  => $controller.'/show',
		'createByQuote' => $controller.'/createByQuote',
		'addSectors'    => $controller.'/addSectors',
		'updateStatus'  => $controller.'/updateStatus'
	];

	$controller = '/FilesController';

	$routes['file'] = [
		'upload' => $controller.'/upload',
		'uploadWithFolderCreate' => $controller.'/uploadWithFolderCreate',
		'delete' => $controller.'/delete'
	];

	$controller = '/FolderController';

	$routes['folder'] = [
		'show' => $controller.'/show',
		'create' => $controller.'/create',
		'index' => $controller.'/index',
		'delete' => $controller.'/delete'
	];

	$controller = '/ProjectSectorController';

	$routes['projectSector'] = [
		'create' => $controller.'/create',
		'index'  => $controller.'/index',
		'edit'   => $controller.'/edit'
	];

	$controller = '/DashboardController';

	$controller = '/SecurityController';

	$routes['sec'] = [
		'login' => $controller.'/login',
		'register' => $controller.'/register',
		'logout'  => $controller.'/logout'
	];

	$controller = '/DownloadController';

	$routes['download'] = [
		'index' => $controller.'/index'
	];

	$controller = '/ProjectProjectSector';

	$routes['projectProjectSector'] = [
		'add' => $controller.'/add',
		'delete' => $controller.'/delete',
		'edit'  => $controller.'/edit'
	];

	$controller ='/ExpensesController';

	$routes['expenses'] = [
		'add' => $controller.'/add',
		'delete' => $controller.'/delete',
		'edit' => $controller.'/edit'
	];


	$controller = '/ProjectWorkerController';

	$routes['worker'] = [
		'add' => $controller.'/add',
		'edit' => $controller.'/edit',
		'delete' => $controller.'/delete'
	];

	$controller = '/LandingController';

	$routes['landing'] = [
		'quotationSent' => $controller.'/quotationSent',
		'about' => $controller.'/about',
		'index' => $controller.'/index',
		'services' => $controller.'/services',
		'portfolio' => $controller.'/portfolio',
		'contact' => $controller.'/contact',
		'bot' => $controller.'/bot',
	];

	$controller = '/userController';

	$routes['user'] = [
		'index' => $controller.'/index',
		'editSingle' => $controller.'/editSingle',
		'overview'   => $controller.'/overview',
		'create'     => $controller.'/create',
		'createByAdmin' => $controller.'/createByAdmin',
		'sendAuthToEmail' => $controller.'/sendAuthToEmail'
	];

	$controller = '/MailingController';

	$routes['mailing'] = [
		'publicBasic' => $controller.'/publicBasic'
	];

	$controller = '/ProfileController';

	$routes['profile'] = [
		'index' => $controller.'/index'
	];

	$controller = '/ProgressController';

	$routes['progress'] = [
		'create' => $controller.'/create'
	];
	

	$controller = '/ForgetPasswordController';

	$routes['forget'] = [
		'send' => $controller.'/sendRequest'
	];

	$controller = '/IntentController';

	$routes['intent'] = [
		'doAction' => $controller.'/doAction'
	];

	return $routes;
?>