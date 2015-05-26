<div>
    <pre class='myCode'>
    <?php
        $info = "<span class='myDescription'>".$desc['description']."</span>";
        echo $info;
    ?>
    </pre>
    <!--
    <div class='myCodeShow'>
        <pre class='myCode' onclick='copyCode($(this))'>
        <?php
            $lineno = 1;
            $info = "<span class='myDescription-sub'>".'&lt'.'PHP'.'&gt'."</span>\n";
            $info = $info."<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes myFunction'>".$fun."</span> ([\n";
            $num = count($desc['paras']);
            for($i=0;$i<$num;$i++){
                $info = $info . "<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes'><span class='myPara'>\t '".$desc['paras'][$i]['para']."' => ?, </span><span class='myComment'>/* <strong class='myImportant'>".($desc['paras'][$i]['isnull']?'（可选）':'（必填）')."</strong>; 描述: <strong class='myImportant'>".$desc['paras'][$i]['desc']."</strong>; 类型：<strong class='myImportant'>".$desc['paras'][$i]['type']."</strong>; 举例：".$desc['paras'][$i]['example']." */</span></span>\n";
            }
            $info = $info."<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes'>]);</span>";

            echo "\n";
            echo $info;
        ?>
        </pre>
        <textarea class="myCodeText" rows="<?= $lineno?>"></textarea>
    </div>
         -->
    <div class='myCodeShow'>
        <pre class='myCode' onclick='copyCode($(this))'>
        <?php
            $example_paras="";

            $lineno = 1;
            $info = "<span class='myDescription-sub'>".'&lt'.'Javasctipt'.'&gt'."</span>\n";
            $info = $info."<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes'>$.ajax ({</span>\n";
            $info = $info."<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes'>\t type: 'POST',</span>\n";
            $info = $info."<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes'>\t url: '".Yii::$app->urlManager->createUrl('my/data')."',</span>\n";
            $info = $info."<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes'>\t data: {'data' : '".$fun."', 'paras' : {</span>\n";
            $num = count($desc['paras']);
            for($i=0;$i<$num;$i++){
                if(strlen($desc['paras'][$i]['example'])>0){
	                $example_paras = $example_paras."'".$desc['paras'][$i]['para']."' : ".$desc['paras'][$i]['example'].",";
                }
                $info = $info . "<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes'><span class='myPara'>\t\t '".$desc['paras'][$i]['para']."' : ?, </span><span class='myComment'>/* <strong class='myImportant'>".($desc['paras'][$i]['isnull']?'（可选）':'（必填）')."</strong>; 描述: <strong class='myImportant'>".$desc['paras'][$i]['desc']."</strong>; 类型：<strong class='myImportant'>".$desc['paras'][$i]['type']."</strong>; 举例：".$desc['paras'][$i]['example']." */</span></span>\n";
            }
            $info = $info."<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes'>\t\t 'type' : 'json' </span><span class='myCodes myComment'>/* json / xml */</span>}}</span>,\n";
            $info = $info."<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes'>\t success: function (result) {</span>\n";
            $info = $info."<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes'>\t }</span>\n";
            $info = $info."<span class='myLineno'>".($lineno++)."</span>"."<span class='myCodes'>});</span>";

            echo "\n";
            echo $info;
        ?>
        </pre>
        <textarea class="myCodeText" rows="<?= $lineno?>"></textarea>
    </div>
</div>

<pre class='myCode' id="example">
</pre>

<?php if(!isset($noexample) || $noexample==false){?>
<script type="text/javascript">
$(function() {

    SafeAjax({
    	type: "POST",
    	url: "<?php echo Yii::$app->urlManager->createUrl('my/data'); ?>",
    	data: {data: '<?= $fun?>', paras:{<?= $example_paras?> type:'json'}},
    	success: function (result) {
    		//$('#example').text(result);
    		$('#example').html(JsonUti.convertToString(eval('('+result+')')));
    	}
    });
});
</script>
<?php }?>


