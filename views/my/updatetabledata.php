<?php
use app\models\CUUID;
$id='tabId-'.CUUID::guid(false);
?>

<table id="<?= $id?>" class="resizeTable zgDisableSelected">
	<tbody>
	</tbody>
</table>

<script type="text/javascript">

	$('#<?= $id?>').updateTableData({data:'<?= $data?>', callback:function(data, tableObj){
		<?php if(!is_null($callback)){?>
			(<?= $callback?>)(data, tableObj);
		<?php }?>
	}}).bind('exportData',function(event,exname){
		myFun_DataExport("<?php echo Yii::$app->urlManager->createUrl('my/exportdata'); ?>", '<?= $paras?>', '<?= $filename?>', exname);
	});

</script>
