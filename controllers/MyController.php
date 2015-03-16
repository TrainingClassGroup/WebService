<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\RateLimiter;
use app\models\CMyController;
use app\models\CExportData;

class MyController extends CMyController {
	public function behaviors() {
		return ArrayHelper::merge ( parent::behaviors (), [
				'rateLimiter' => [
						'class' => RateLimiter::className (),
						'enableRateLimitHeaders' => false
				]
		] );
	}

	/* ------------------------------------------------------ */

	private function _dynamicGetDataConsole($data, $pars) {
		try {
			return call_user_func ( 'app\\models\\' . $data . '::get', $pars );
		} catch ( \Exception $e ) {
			return $e;
		}
	}

	private function _dynamicGetData() {
		if (isset ( $_POST ['data'] )) {
			return $this->_dynamicGetDataConsole($_POST ['data'], $_POST ['paras']);
		}
		return null;
	}

	private function _dynamicRunAction() {
		if (isset ( $_POST ['data'] )) {
			try {
				return call_user_func ( 'app\\models\\' . $_POST ['data'] . '::run', $_POST ['paras'] );
			} catch ( \Exception $e ) {
				return $e;
			}
		}
		return null;
	}
	
	/* ------------------------------------------------------ */

	public function actionUpdatetabledata() {
		$data = $this->_dynamicGetData ();
		return $this->render ( 'updatetabledata', array (
				'data' => $data,
				'paras'=> json_encode(['data'=>$_POST ['data'], 'paras'=>$_POST ['paras']]),
				'filename'=> isset($_POST ['filename'])?$_POST ['filename']:'',
				'callback' => (isset($_POST ['callback'])?$_POST ['callback']:null)
		) );
	}

	public function actionJsondata() {
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
}



