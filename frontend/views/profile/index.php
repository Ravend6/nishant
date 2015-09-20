<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\BasicProfile;
use frontend\models\Country;
use frontend\models\City;
use frontend\models\Timezone;
// use dosamigos\datepicker\DatePicker;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = 'Basic Profile';
?>

<div class="row">
    <div class="col-sm-12">

        <h2>Basic Profile</h2>

        <hr>
        
        <section>
            <?php if (!BasicProfile::find()->count()): ?>
                <?= Html::button('Create Profile', [
                    'value' => Url::to('/create'), 
                    'class' => 'btn btn-success', 
                    'id' => 'modal-button-create'
                ]) ?>
            <?php else: ?>
                <?php Pjax::begin(['id' => 'profile-content']); ?>   
                <div>
                    <p><b><?= $profile->getAttributeLabel('firts_name') ?>:</b> <?= $profile->first_name ?></p>
                    <p><b><?= $profile->getAttributeLabel('last_name') ?>:</b> <?= $profile->last_name ?></p>
                    <p><b><?= $profile->getAttributeLabel('gender') ?>:</b> <?= $profile->gender ? 'Male' : 'Female' ?></p>
                    <p><b><?= $profile->getAttributeLabel('country_id') ?>:</b> <?= Country::findOne($profile->country_id)->name ?></p>
                    <p><b><?= $profile->getAttributeLabel('city_id') ?>:</b> <?= City::findOne($profile->city_id)->name ?></p>
                    <p><b><?= $profile->getAttributeLabel('address') ?>:</b> <?= $profile->address ?></p>
                    <p><b><?= $profile->getAttributeLabel('timezone_id') ?>:</b> <?= Timezone::findOne($profile->timezone_id)->name?></p>
                    <p><b><?= $profile->getAttributeLabel('date_of_birth') ?>:</b> <?= $profile->date_of_birth ?></p>
                </div>
                <?php Pjax::end(); ?>
                <div><button id="modal-button-update" class="btn btn-primary" 
                    value="/update?id=<?= $profile->user_id ?>">Update</button></div>
            <?php endif; ?>
        </section>
    </div>
</div>


<?php Modal::begin([
    'size' => 'modal-lg',
    'header' => '<h2>Create Profile</h2>',
    'id' => 'modal',
    // 'clientOptions' => false,
    // 'toggleButton' => [
    //     'label' => 'Create Ajax', 
    //     'class' => 'btn btn-md btn-success'
    // ],
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
]); ?>

<div id="modal-content"></div>

<?php Modal::end(); ?>

