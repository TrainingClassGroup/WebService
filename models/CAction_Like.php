<?php
namespace app\models;

class CAction_Like implements IAction {

	public static function description(){
		return [
				'description' => '收藏',
				'paras' => [
						[
								'para' => 'user_id',
								'desc' => '用户ID',
								'isnull' => false,
								'type' => 'numeric',
								'example' => '3' ],
				        [
                                'para' => 'company_id',
                                'desc' => '培训班ID',
                                'isnull' => false,
                                'type' => 'numeric',
                                'example' => '222' ] ]
				];
	}
	/* (non-PHPdoc)
	 * @see \app\models\IAction::run()
	 */
	public static function run($paras = null) {
		$sql = "INSERT INTO tab_training_class_like(user_id, company_id) VALUES (:user_id, :company_id)";

		$command = CDB::getConnection()->createCommand( $sql );
		$command->bindParam( ':user_id', $paras['user_id'], \PDO::PARAM_INT );
		$command->bindParam( ':company_id', $paras['company_id'], \PDO::PARAM_INT );

		$command->execute();
	}

}
