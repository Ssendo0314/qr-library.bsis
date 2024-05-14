<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";  
if (Input::exists()) {
	//set it to writable location, a place for temp generated PNG files
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'magazineQRCodes'.DIRECTORY_SEPARATOR;
			
			$magazines = DB:: getInstance()->get('magazines', array('id','=',Input::get('newID')));							
			foreach($magazines->results() as $magazines){
				unlink($PNG_TEMP_DIR.$magazines->qrcode);
			}
			
			//ofcourse we need rights to create temp dir
			if (!file_exists($PNG_TEMP_DIR))
				mkdir($PNG_TEMP_DIR);
			
			$filename = '';
			
			//processing form input
			//remember to sanitize user input in real-life solution !!!
			$errorCorrectionLevel = 'H';
			$matrixPointSize = 10;

			if (isset($_REQUEST['newIsbn'])) { 
				// user data
				$newfilename = round(microtime(true)).'.png';
				$filename = $PNG_TEMP_DIR.$newfilename;
				QRcode::png($_REQUEST['newIsbn'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
				
			} 
			$book = new Magazines();
			
            try {
                $book->update(array(
					'isbn' => Input::get('newIsbn'),
					'qrcode' => $newfilename,
                ), Input::get('newID'));
			
			Session::flash('magazineUpdated', 'Magazine Title has been updated');
			Redirect::to('admin.php?action=editMagazine&id='.Input::get('newID'));
            } catch(Exception $e) {
                $error;
            }
}
ob_end_flush();