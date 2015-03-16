<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">


    <div class="body-content">
    </div>
    
    
    <script type="text/javascript">
    $(function() {
    	SafeAjax({
    		type: "POST",
			url: "<?php echo Yii::$app->urlManager->createUrl('my/jsondata'); ?>",
			data: {data: 'CData_TrainingClass', paras:{lng:123.417095, lat:41.836929}},
			success: function (result) {
				$('.body-content').html(result);
			}
        });
	});
    </script>
    
</div>
