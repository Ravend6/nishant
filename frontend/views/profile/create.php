<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\BasicProfile;
use frontend\models\Country;
use frontend\models\Timezone;
use dosamigos\datepicker\DatePicker;
// use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

?>

<?php $form = ActiveForm::begin([
    'action' => '/create',
    'id' => 'profile-create-form',  
]); ?>

<?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'last_name')->textarea(['maxlength' => true]) ?>

<?= $form->field($model, 'gender')->dropdownList(
    [$model::GENDER_FEMALE => 'Female', $model::GENDER_MALE => 'Male'],
    ['prompt' => 'Select gender']
); ?>

<?= $form->field($model, 'country_id')->dropdownList(
    // ArrayHelper::map(Country::find()->all(), 'id', 'name'),
    BasicProfile::getCountryList(),
    [
        'prompt' => 'Select Country',
        'onchange' => 
            '$.post("/city-list?id=' . '"+$(this).val(), function (data) {
                $("#basicprofile-city_id").prop("disabled", false); 
                $("select#basicprofile-city_id").html(data);
            });'
    ]
) ?>

<?= $form->field($model, 'city_id')->dropdownList(
    BasicProfile::getCityList(),
    [
        'disabled' => true,
        'prompt' => 'Select City',

    ]
) ?>

<?= $form->field($model, 'address')->textArea(['maxlength' => true]) ?>

<?= $form->field($model, 'timezone_id')->dropdownList(
    ArrayHelper::map(Timezone::find()->all(), 'id', 'name'),
    [
        'prompt' => 'Select Timezone',

    ]
) ?>

<?= $form->field($model, 'date_of_birth')->widget(
    DatePicker::className(), [
        'inline' => true, 
        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>

<div class="form-group">
    <?= Html::submitButton('Create', [
        'class' => 'btn btn-success', 
    ]) ?>
</div>
<?php ActiveForm::end(); ?>

