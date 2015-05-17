<?php

namespace app\models;

class CData_TrainingClassInfo extends CData {
    public static function description(){
        return [
                    'description' => '根据ID查询培训班详细信息。',
                    'paras' => [
                                    [
                                        'para' => 'company_id',
                                        'desc' => '培训班ID',
                                        'isnull' => true,
                                        'type' => 'numeric',
                                        'example' => '222' ],

                     ]
               ];
    }
    /*
     * (non-PHPdoc) @see \app\models\CData::getx()
     */
    protected static function getex( $paras = null ){
        $key = __METHOD__ . ":" . serialize( $paras );
        //$data = CSystemCache::get( $key );
        //if( !is_null( $data ) ) return $data;


        $sql = "SELECT * FROM
	(
		SELECT  cdb.id, cdb.company,
        		replace(substr(cdb.text, 1, 320),'\"','')||'...' as \"text\",
        	    cdb.tel, cdb.address, cdb.coordinate[0] lng, cdb.coordinate[1] lat,
        	    cdb.logo_image
		FROM tab_training_class_db cdb
		WHERE cdb.id = :id
	) cc";


        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam( ':id', $paras['company_id'], \PDO::PARAM_INT ); // 培训班ID

        $data_tc = $command->queryAll();

        //
		$sql="SELECT tct.id, tct.teacher, tcc.course, tcs.week0, tcs.week1, tcs.week2, tcs.week3, tcs.week4, tcs.week5, tcs.week6
	FROM tab_training_class_teacher tct, tab_training_class_schedule tcs, tab_training_class_course tcc
	 WHERE tct.schedule_id = tcs.id
	   AND tcs.course_id = tcc.id
	   AND tct.company_id = :id
	ORDER BY tcc.index, tct.id";

		$command = CDB::getConnection()->createCommand( $sql );
		$command->bindParam( ':id', $paras['company_id'], \PDO::PARAM_INT ); // 培训班ID

		$data_tcs = $command->queryAll();


		$data = ['tc'=>$data_tc[0], 'schedule'=>$data_tcs];
        //CSystemCache::set( $key, $data, 10 * 60 );

        return $data;
    }
}
