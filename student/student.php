<?php

require 'core/init.php';
$user = new UserLogin(); //Current

if(!$user->isLoggedIn()) {
    Redirect::to('login.php');
}else{
	if($user->isStudent()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'Sbooklist':	
				require('student/Sbooklist.php');
			break;
			
			case 'Sborrowed':	
				require('student/Sborrowed.php');
			break;

		  default:
			require('student/Sdashboard.php');
		}
	// }elseif($user->isTeacher()) {
	// 	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
	// 	include "qrLib/qrlib.php";    
		
	// 	switch ( $action ) {
	// 		case 'settings':	
	// 			require('admin/settings.php');
	// 		break;
			
	// 	  default:
	// 		require('admin/tdashboard.php');
	// 	}
	}
		else{
		Redirect::to('index.php');
	}
	
}
?>