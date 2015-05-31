<?php
namespace app\models;

class CAction_Regist implements IAction {

	public static function description(){
		return [
				'description' => '根据“用户UUID”创建用户。',
				'paras' => [
						[
                                'para' => 'uuid',
                                'desc' => '用户UUID',
                                'isnull' => false,
                                'type' => 'string',
                                'example' => 'w32453yhgbst4' ]]
				];
	}
	/* (non-PHPdoc)
	 * @see \app\models\IAction::run()
	 */
	public static function run($paras = null) {
		$sql = "INSERT INTO tab_training_class_user(uuid) VALUES (:uuid)";

		$command = CDB::getConnection()->createCommand( $sql );
		$command->bindParam( ':uuid', $paras['uuid'], \PDO::PARAM_STR ); // 用户UUID

		$command->execute();

		return CData_UserInfo::get($paras);
	}

}
