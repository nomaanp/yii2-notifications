<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\User;
use app\models\UserNotification;

/* @var $this yii\web\View */
/* @var $model app\models\UserNotification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => User::getList(),
        'hideSearch' => true,
        'pluginOptions' => [
            'allowClear' => false
        ],
    ]) ?>

    <?= $form->field($model, 'recipient_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::merge([''=> 'Send to all users'], User::getList()),
        'hideSearch' => true,
        'pluginOptions' => [
            'allowClear' => false,
        ],
    ]) ?>

    <?= $form->field($model, 'subject')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notification_type')->widget(Select2::classname(), [
        'data' => UserNotification::getAvailable(),
        'hideSearch' => true,
        'pluginOptions' => [
            'allowClear' => false,
            'multiple' => true,
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
