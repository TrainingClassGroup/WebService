<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">


    <div class="body-content">

        <?php

                use app\models\CData_CatalogOfClassNameAndCourseAndTime;

                echo CData_CatalogOfClassNameAndCourseAndTime::get();

                ?>

    </div>
</div>
