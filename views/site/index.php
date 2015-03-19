<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

<a href="<?php echo Yii::$app->urlManager->createUrl(['my/desc', 'fun'=>'CData_TrainingClass']); ?>">ddd</a>

    <div class="body-content">

    </div>
    
    
    <script type="text/javascript">
    $(function() {

    	/*
    	SafeAjax({
    		type: "POST",
			url: "<?php echo Yii::$app->urlManager->createUrl('my/data'); ?>",
			data: {data: 'CData_ClassNameAndCourseAndTime', paras:{type:'json'}},
			success: function (result) {
				$('.body-content').html(result);
			}
        });
    	*/
    	/*
    	SafeAjax({
    		type: "POST",
			url: "<?php echo Yii::$app->urlManager->createUrl('my/data'); ?>",
			data: {data: 'CData_TrainingClass', paras:{lng:123.417095, lat:41.836929, catalog:'高中', curriculum:'数学'}},
			success: function (result) {
				$('.body-content').html(result);
			}
        });
         */
        /*
    	SafeAjax({
    		type: "POST",
			url: "<?php echo Yii::$app->urlManager->createUrl('my/data'); ?>",
			data: {data: 'CData_ClassSchedule', paras:{company_id:12, type:'xml'}},
			success: function (result) {
				$('.body-content').html(result);
			}
        });
    	 */
	});
    </script>
    
</div>
