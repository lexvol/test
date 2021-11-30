<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $model_dependency app\models\Dependency */
/* @var $selection \app\controllers\StaffController */
$staff_name = $model->first_name . ' ' . $model->last_name;
$this->title = 'Редактирование: ' . $staff_name;
$this->params['breadcrumbs'][] = ['label' => 'Сотрудник', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $staff_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="staff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_dependency' => $model_dependency,
        'selection' => $selection
    ]) ?>

</div>
