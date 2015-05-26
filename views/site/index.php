<?php
/* @var $this yii\web\View */
$this->title = 'TC';
?>
<div class="site-index">

<?php
function tree($directory){
    $mydir = dir($directory);
    while($file = $mydir->read()){
        if((is_dir("$directory/$file")) AND ($file!=".") AND ($file!="..")){
            tree("$directory/$file");
        }
        else{
            if(preg_match("/CData_(.*)\.php/i", $file, $matches)){
                require_once $directory . 'CData_'.$matches[1].'.php';
                $name="";
                try {
                    $name = call_user_func ( 'app\\models\\' . 'CData_'.$matches[1] . '::description', null )['description'];
                } catch ( \Exception $e ) {
                }
?>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl(['my/desc', 'fun'=>'CData_'.$matches[1]]); ?>"><?= 'CData_'.$matches[1]?>&nbsp;&nbsp;&nbsp;&nbsp;//<?= $name?></a></li><br>
<?php
            }
            else if(preg_match("/CAction_(.*)\.php/i", $file, $matches)){
				require_once $directory . 'CAction_'.$matches[1].'.php';
				$name="";
				try {
					$name = call_user_func ( 'app\\models\\' . 'CAction_'.$matches[1] . '::description', null )['description'];
				} catch ( \Exception $e ) {
				}
?>
                <li><a href="<?php echo Yii::$app->urlManager->createUrl(['my/desc', 'fun'=>'CAction_'.$matches[1], 'noexample'=>true]); ?>"><?= 'CAction_'.$matches[1]?>&nbsp;&nbsp;&nbsp;&nbsp;//<?= $name?></a></li><br>
<?php
			}
        }
    }
   	$mydir->close();
}
echo "<ul>\n";
tree(dirname ( __FILE__ ) . '/../../models/');
echo "</ul>\n";
?>



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
