<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Department */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Отделы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="department-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы увeерены, что хотите удалить этот отдел?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute'=>'id_staff',
                'label'=>'Сотрудники',
                'format'=>'text', // Возможные варианты: raw, html
                'value'=> function($data){
                    $staff= [];
                    foreach ($data->staff as $name_staff) {
                        $staff[] = $name_staff->first_name . ' ' . $name_staff->last_name . ' id:' . $name_staff->id;
                    }
                    $staff = implode(", \n", $staff);
                    return $staff;
                },

            ],
        ],
    ]) ?>

</div>
