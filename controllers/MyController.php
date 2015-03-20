<?php

namespace app\controllers;

use Yii;

use app\models\CMyController;
use app\models\CExportData;

class MyController extends CMyController {

	private function _dynamicGetDataConsole($data, $pars) {
		try {
			return call_user_func ( 'app\\models\\' . $data . '::get', $pars );
		} catch ( \Exception $e ) {
			return $e;//print_r($e);
		}
	}
	
	private function _dynamicGetDescription(){
	    if (isset ( $_GET ['fun'] )) {
    	    try {
    			return call_user_func ( 'app\\models\\' . $_GET ['fun'] . '::description', null );
    		} catch ( \Exception $e ) {
    			return $e;//print_r($e);
    		}
	    }
	    return [];
	}

	private function _dynamicGetData() {
		if (isset ( $_POST ['data'] )) {
			return $this->_dynamicGetDataConsole($_POST ['data'], isset($_POST ['paras'])?$_POST ['paras']:null);
		}
		return [];
	}

	private function _dynamicRunAction() {
		if (isset ( $_POST ['data'] )) {
			try {
				return call_user_func ( 'app\\models\\' . $_POST ['data'] . '::run', isset($_POST ['paras'])?$_POST ['paras']:null );
			} catch ( \Exception $e ) {
				return $e;//print_r($e);
			}
		}
		return [];
	}
	
	/* ------------------------------------------------------ */

	public function actionUpdatetabledata() {
		$data = $this->_dynamicGetData ();
		return $this->render ( 'updatetabledata', array (
				'data' => $data,
				'paras'=> json_encode(['data'=>$_POST ['data'], 'paras'=>isset($_POST ['paras'])?$_POST ['paras']:[]]),
				'filename'=> isset($_POST ['filename'])?$_POST ['filename']:'',
				'callback' => (isset($_POST ['callback'])?$_POST ['callback']:null)
		) );
	}

	public function actionDesc(){
	    $desc = $this->_dynamicGetDescription ();
	    return $this->render ( 'desc', ['fun'=>$_GET ['fun'], 'desc' => $desc] );
	}
	
	public function actionData() {
		$data = $this->_dynamicGetData ();
		return $data;
	}

	public function actionRunaction() {
		$data = $this->_dynamicRunAction ();
		return $data;
	}

	public function actionExportdata(){
		$paras = json_decode($_POST ['paras'], true);
		$exname = $_POST ['exname'];
		$filename = (isset($_POST ['filename']) && !is_null($_POST ['filename']) && count($_POST ['filename'])>0)?$_POST ['filename']:$paras ['data'];

		$filename = CExportData::getFilename($filename, $exname, $paras['paras']);

		if($exname=="csv"){
			$resultData = $this->_dynamicGetDataConsole($paras ['data'], $paras ['paras']);
			$context = CExportData::getData_CSV($resultData);

//			header('Content-type: application/octet-stream');
			header("Content-type:text/csv");
			header('Accept-Ranges: bytes');
			header('Accept-Length:'.count($context));
			header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
			header('Expires:0');
			header('Pragma:public');
			header("Content-Disposition: attachment; filename=".$filename);

			echo $context;
		}
	}
	
	public function actionAbout()
	{
	    return $this->render('about');
	}
}



