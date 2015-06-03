<?php
namespace app\models;

class CData_Like extends CData {

	public static function description(){
		return [
				'description' => '收藏',
				'paras' => [
						[
								'para' => 'user_id',
								'desc' => '用户ID',
								'isnull' => false,
								'type' => 'numeric',
								'example' => '13' ] ]
				];
	}
	/* (non-PHPdoc)
	 * @see \app\models\IAction::run()
	 */
	public static function getex($paras = null) {
		$key = __METHOD__ . ":" . serialize( $paras );
		$data = CSystemCache::get( $key );
		if( !is_null( $data ) ) return $data;

		$sql = "SELECT company_id FROM tab_training_class_like WHERE user_id=:user_id";

		$command = CDB::getConnection()->createCommand( $sql );
		$command->bindParam( ':user_id', $paras['user_id'], \PDO::PARAM_INT );

		$data = $command->queryAll();

        CSystemCache::set( $key, $data, 10 * 60 );

        return $data;
	}

}
