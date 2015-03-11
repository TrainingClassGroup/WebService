<?php

namespace app\models;

class CDataTest_table implements IData {
    public static function get( $paras = null ){
        return json_encode( [
                'colclass' => [
                        'colTextLeft','colTextRight','colTextCenter','colTextLeft','colTextLeft','colTextLeft','colTextLeft','colTextLeft','colTextLeft','colTextLeft' 
                ],                // 列宽
                'header' => [
                        $paras['a'],'BBB','啥地方','rrr','rrr','rrr','rrr','rrr','rrr' 
                ],                // 表头
                'header_en' => [
                        $paras['a'],'BBB','啥地方','rrr','rrr','rrr','rrr','rrr','rrr' 
                ], // 表头
                'rows' => [ // 数据
                        [
                                'aaa',9,'ccc','大是大非','34%','bbb','ccc','ddd','ddd','ddd','ddd' 
                        ],[
                                1,2,3,4,'2%','发风格','45.6%','ddd','ddd','ddd','ddd' 
                        ],[
                                'aaa',8,'ccc','广告歌','-0.2%','bbb','ccc','ddd','ddd','ddd','ddd' 
                        ],[
                                'aaa',10,'ccc','哈哈哈','1.2%','bbb','ccc','ddd','ddd','ddd','ddd' 
                        ],[
                                'aaa',1,'ccc','热热热','2.02%','bbb','ccc','ddd','ddd','ddd','ddd' 
                        ],[
                                'aaa',4,'ccc','哐哐哐','1.0%','bbb','ccc','ddd','ddd','ddd','ddd' 
                        ],[
                                'aaa',6,'ccc','哈嗯嗯','9%','bbb','ccc','ddd','ddd','ddd','ddd' 
                        ],[
                                'aaa',9,'ccc','难难难','3.45%','bbb','ccc','ddd','ddd','ddd','ddd' 
                        ],[
                                'aaa',12,'ccc','ddd','0%','bbb','ccc','ddd','ddd','ddd','ddd' 
                        ],[
                                234,3,'rrr','4545','','bbb','ccc','ddd','ddd','ddd','ddd' 
                        ] 
                ],'statistics' => [
                        [
                                'name' => '合计','key' => 'summary','columnidx' => [
                                        1,3,4 
                                ] 
                        ],[
                                'name' => '平均','key' => 'average','columnidx' => [
                                        1,3 
                                ] 
                        ] 
                ] 
        ] );
    }
}

?>