<?php

use app\models\Department;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудник';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->isGuest ? null : Html::a('Добавить сотрудника', ['create'], ['class' => 'btn btn-success']) ?>
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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'first_name',
            'patronymic',
            [
                'attribute' => 'last_name',
                'label' => 'Фамилия',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Staff::find()->all(), 'last_name', 'last_name'),
                'value' => function($data){
                    return $data->last_name;
                }
            ],
            'phone_number',
            'email:email',
            'address',
            [
                'attribute'=>'department',
                'label'=>'Отдел',
                'format'=>'text', // Возможные варианты: raw, html
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Department::find()->all(), 'id', 'name'),
                'value' => function($data){
                    return $data->last_name;
                },
                'content'=> function($data){
                    $department= [];
                    foreach ($data->department as $name_department) {
                        $department[] = $name_department->name;
                    }
                    $department = implode(", \n", $department);
                    return $department;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действие',
                'headerOptions' => ['width' => '85'],
                'contentOptions' => ['class' => 'text-center', 'style' => ['vertical-align' => 'middle']],
                'template' => '{view} {update} {delete}',
                'visible' => Yii::$app->user->isGuest ? false : true,
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
