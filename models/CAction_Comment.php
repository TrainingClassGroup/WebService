<?php
namespace app\models;

class CAction_Comment implements IAction {

	public static function description(){
		return [
				'description' => '增加评论。',
				'paras' => [
						[
								'para' => 'company_id',
								'desc' => '培训班ID',
								'isnull' => false,
								'type' => 'numeric',
								'example' => '222' ],
						[
								'para' => 'comment',
								'desc' => '评论内容',
								'isnull' => false,
								'type' => 'string',
								'example' => '这里的老师真好' ],
						[
								'para' => 'user_id',
								'desc' => '用户ID',
								'isnull' => false,
								'type' => 'numeric',
								'example' => '3' ] ]
				];
	}
	/* (non-PHPdoc)
	 * @see \app\models\IAction::run()
	 */
	public static function run($paras = null) {
		$sql = "INSERT INTO tab_training_class_comment(company_id, comment, user_id) VALUES (:company_id, :comment, :user_id)";

		$command = CDB::getConnection()->createCommand( $sql );
		$command->bindParam( ':company_id', $paras['company_id'], \PDO::PARAM_INT); // 培训班ID
		$command->bindParam( ':comment', $paras['comment'], \PDO::PARAM_STR ); // 评论
		$command->bindParam( ':user_id', $paras['user_id'], \PDO::PARAM_INT ); // 用户ID

		$command->execute();
	}

}
