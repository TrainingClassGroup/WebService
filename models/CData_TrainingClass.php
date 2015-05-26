<?php

namespace app\models;

class CData_TrainingClass extends CData {
    public static function description(){
        return [
                    'description' => '根据“年纪”和“课程”查询培训班，并按照举例排序。',
                    'paras' => [
                                    [
                                        'para' => 'lng',
                                        'desc' => '经度',
                                        'isnull' => false,
                                        'type' => 'numeric',
                                        'example' => '123.417095' ],
                                    [
                                        'para' => 'lat',
                                        'desc' => '纬度',
                                        'isnull' => false,
                                        'type' => 'numeric',
                                        'example' => '41.836929' ],
                                    [
                                        'para' => 'catalog',
                                        'desc' => '年级',
                                        'isnull' => false,
                                        'type' => 'string',
                                        'example' => '"高中"' ],
                                    [
                                        'para' => 'curriculum',
                                        'desc' => '课程',
                                        'isnull' => false,
                                        'type' => 'string',
                                        'example' => '"数学"' ],
		                    		[
			                    		'para' => 'schedule',
			                    		'desc' => '授时',
			                    		'isnull' => false,
	                    				'type' => 'string',
	                    				'example' => '"上午"' ],
                                    [
                                        'para' => 'rownum',
                                        'desc' => '行数',
                                        'isnull' => true,
                                        'type' => 'numeric',
                                        'example' => '10' ],
                                    [
                                        'para' => 'page',
                                        'desc' => '页数',
                                        'isnull' => true,
                                        'type' => 'numeric',
                                        'example' => '0' ],
		                    		[
			                    		'para' => 'order',
			                    		'desc' => '排序',
			                    		'isnull' => true,
	                    				'type' => 'string',
	                    				'example' => '""' ],
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
		SELECT  cdb.id, /*cdb.company, cdb.url_home, cdb.contact,*/
        		replace(substr(cdb.text, 1, 160),'\"','')||'...' as \"text\",
        		/*cdb.catalog, cdb.taught, cdb.curriculum,
        	    cdb.tel, cdb.address, cdb.coordinate,*/
        		(CASE WHEN tcc.cnt ISNULL THEN 0 ELSE tcc.cnt END) comment_cnt,
                (CASE WHEN tv.cnt ISNULL THEN 0 ELSE tv.cnt END) reservation_cnt,
        		fun_distance (:lat, :lng, cdb.coordinate[1], cdb.coordinate[0]) distance,
        	    cdb.logo_image /* , img.imagedata */
		FROM tab_training_class_db cdb
        	/* LEFT JOIN tab_training_class_image img ON cdb.logo_image = img.id */
        	 LEFT JOIN (SELECT company_id, COUNT(*) cnt FROM tab_training_class_comment GROUP BY company_id) tcc ON tcc.company_id = cdb.id
             LEFT JOIN (SELECT tct.company_id, COUNT(*) cnt FROM tab_training_class_reservation tcv, tab_training_class_teacher tct WHERE tcv.teacher_id=tct.id GROUP BY tct.company_id) tv ON tv.company_id = cdb.id
		WHERE cdb.catalog ~ ('.*' || :catalog || '.*')
		  AND cdb.curriculum ~ ('.*' || :curriculum || '.*')
          AND EXISTS (SELECT 1 FROM tab_training_class_teacher ct, tab_training_class_schedule cs, tab_training_class_course cc
                      WHERE ct.schedule_id = cs.id AND ct.company_id = cdb.id
                        AND cs.course_id = cc.id AND cc.course ~ (:curriculum)
                        AND (cs.week0 ~ (:schedule) OR cs.week1 ~ (:schedule) OR
						     cs.week2 ~ (:schedule) OR cs.week3 ~ (:schedule) OR
						     cs.week4 ~ (:schedule) OR cs.week5 ~ (:schedule) OR
						     cs.week6 ~ (:schedule)
                            )
                      )
	) cc
ORDER BY cc.distance ASC ".((isset($paras['order']) && !empty($paras['order'])) ? $paras['order'] : '')." LIMIT :rownum OFFSET :page";

        if( !isset( $paras['rownum'] ) || is_null( $paras['rownum'] ) ) $paras['rownum'] = 10;
        if( !isset( $paras['page'] ) || is_null( $paras['page'] ) ) $paras['page'] = 0;
        if($paras['catalog'] == "年级" || empty($paras['catalog'])) $paras['catalog']='';
        if($paras['curriculum'] == "课程" || empty($paras['curriculum'])) $paras['curriculum']='';
        if( !isset( $paras['schedule'] ) || is_null( $paras['schedule']) || $paras['schedule'] == "授时" ){
        	$paras['schedule'] = '^.*/.*/.*$';
        }
        else if($paras['schedule']=="全天"){
        	$paras['schedule'] = '^.+/.+/.+$';
        }
        else if($paras['schedule']=="上午"){
        	$paras['schedule'] = '^.+/.*/.*$';
        }
        else if($paras['schedule']=="下午"){
        	$paras['schedule'] = '^.*/.+/.*$';
        }
        else if($paras['schedule']=="晚生"){
        	$paras['schedule'] = '^.*/.*/.+$';
        }

        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam( ':lng', $paras['lng'], \PDO::PARAM_STR ); // 经度
        $command->bindParam( ':lat', $paras['lat'], \PDO::PARAM_STR ); // 纬度
        $command->bindParam( ':catalog', $paras['catalog'], \PDO::PARAM_STR ); // 年级
        $command->bindParam( ':curriculum', $paras['curriculum'], \PDO::PARAM_STR ); // 课程
        $command->bindParam( ':schedule', $paras['schedule'], \PDO::PARAM_STR ); // 授时
        $command->bindParam( ':rownum', $paras['rownum'], \PDO::PARAM_INT ); // 行数
        $command->bindParam( ':page', $paras['page'], \PDO::PARAM_INT ); // 页数

        $data = $command->queryAll();

        $len=count($data);
        for($i=0;$i<$len;$i++){
        	$data[$i]['index'] = $paras['page'] * $paras['rownum'] + $i;
        }

        //CSystemCache::set( $key, $data, 10 * 60 );

        return $data;
    }
}
