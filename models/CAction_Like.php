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
                                'example' => '222' ],
				        [
                                'para' => 'flag',
                                'desc' => '是否设定为like，0=否，1=是',
                                'isnull' => false,
                                'type' => 'numeric',
                                'example' => '1' ] ]
				];
	}
	/* (non-PHPdoc)
	 * @see \app\models\IAction::run()
	 */
	public static function run($paras = null) {

		if($paras['flag']=='1'){
			$sql = "INSERT INTO tab_training_class_like(user_id, company_id) VALUES (:user_id, :company_id)";

			$command = CDB::getConnection()->createCommand( $sql );
			$command->bindParam( ':user_id', $paras['user_id'], \PDO::PARAM_INT );
			$command->bindParam( ':company_id', $paras['company_id'], \PDO::PARAM_INT );

			$command->execute();
		}
		else{
			$sql = "DELETE FROM tab_training_class_like WHERE user_id=:user_id AND company_id=:company_id";

			$command = CDB::getConnection()->createCommand( $sql );
			$command->bindParam( ':user_id', $paras['user_id'], \PDO::PARAM_INT );
			$command->bindParam( ':company_id', $paras['company_id'], \PDO::PARAM_INT );

			$command->execute();
		}
	}

}
