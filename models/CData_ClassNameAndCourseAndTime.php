<?php

namespace app\models;

class CData_ClassNameAndCourseAndTime extends CData {

    public static function description(){
        return [
                'description' => '获取筛选条件。',
                'paras' => [ ] ];
    }
    /*
     * (non-PHPdoc) @see \app\models\CData::getx()
     */
    protected static function getex( $paras = null ){
        $key=__METHOD__.":".serialize($paras);
        //$data = CSystemCache::get($key);
        //if(!is_null($data)) return $data;

        $sql = 'SELECT cn."id" class_name_id, cc."id" course_id, cn.class_name,	cc.course, cn.index cn_index, cc.index cc_index
FROM tab_training_class_classname cn
LEFT JOIN (
	tab_training_class_relation_between_class_name_and_course nrc
	LEFT JOIN tab_training_class_course cc ON cc."id" = nrc.course_id
) ON cn."id" = nrc.class_name_id ORDER BY cn.index, cc.index';

        $command = CDB::getConnection()->createCommand( $sql );
        $result = $command->queryAll();

        $rownum = count( $result );
        for($r = 0; $r < $rownum; $r++){
            CTree::menuTree($data, '', ['id'=>$result[$r]['class_name_id'], 'menu'=>$result[$r]['class_name'], 'paras'=>'', 'index'=>$result[$r]['cn_index'] ],
                                       ['id'=>$result[$r]['course_id'], 'menu'=>$result[$r]['course'], 'paras'=>'', 'index'=>$result[$r]['cc_index'] ]);
        }

        $data = ['menus'=>$data, 'time'=>(Object)[
        		['id'=>1, 'menu'=>"全天", 'paras'=>'', 'index'=>1, 'sub'=>[] ],
        		['id'=>2, 'menu'=>"上午", 'paras'=>'', 'index'=>2, 'sub'=>[] ],
        		['id'=>3, 'menu'=>"下午", 'paras'=>'', 'index'=>3, 'sub'=>[] ],
        		['id'=>4, 'menu'=>"晚上", 'paras'=>'', 'index'=>4, 'sub'=>[] ]
        ]];

        //CSystemCache::set($key, $data, 60*60);

        return $data;
    }


}
