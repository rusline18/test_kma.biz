<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(\mihaildev\ckeditor\CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false
            ]
    ]) ?>

    <?= Html::checkbox('status', false, ['label' => 'Активный', 'class' => 'news-checkbox']) ?>

    <?= Html::fileInput('image') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
