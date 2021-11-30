<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отделы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->isGuest ? null : Html::a('Создать отдел', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (Yii::$app->session->hasFlash('delete')): ?>
        <div class="alert alert-success"><?= Yii::$app->session->getFlash('delete') ?></div>
    <?php endif ?>
    <?php if (Yii::$app->session->hasFlash('not_delete')): ?>
        <div class="alert alert-danger"><?= Yii::$app->session->getFlash('not_delete') ?></div>
    <?php endif ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' =>[
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действие',
                'headerOptions' => ['width' => '85'],
                'contentOptions' => ['class' => 'text-center', 'style' => ['vertical-align' => 'middle']],
                'template' => '{view} {update} {delete}',
                'visible' => Yii::$app->user->isGuest ? false : true,
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
