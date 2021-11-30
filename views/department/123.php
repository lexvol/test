<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Department */

$this->title = 'Изменить отдел: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Отдел', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="department-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php $form = ActiveForm::begin(); ?>

    <?php foreach ($model->staff as $staff): ?>
        <?php $param = ['options' =>[ $staff->id => ['Selected' => true]]];?>
        <?php $staff_list = ArrayHelper::map($model->staff, 'id', 'first_name')?>
        <?= $form->field($staff, 'first_name')->dropDownList($staff_list, $param) ?>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<=================================================================================>

<?=$form->field($model, 'first_name')
    ->checkbox([
        'label' => 'Неактивный чекбокс',
        'labelOptions' => [
            'style' => 'padding-left:20px;'
        ],
        'disabled' => false
    ]);?>

<==============================================================================================>
<?php
    {
        $model = new Staff();
        $model_dependency = new Dependency();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()
                && $model_dependency->load($this->request->post())) {
                $model_dependency->id_staff = $model->id;
                if ($model_dependency->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                else {
                    $model->loadDefaultValues();
                    $model_dependency->loadDefaultValues();
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'model_dependency' => $model_dependency,
        ] );
    }
?>