<?php

use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'Task #4';
?>
<div class="site-index">

    <div class="body-content">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'MEDREC_ID',
                'PATIENT_NAME'
            ]
        ]); ?>

    </div>
</div>
