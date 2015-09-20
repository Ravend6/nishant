<?php

namespace frontend\models;

use Yii;
use frontend\models\Country;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "basic_profile".
 *
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $gender
 * @property integer $country_id
 * @property integer $city_id
 * @property string $address
 * @property integer $timezone_id
 * @property string $date_of_birth
 *
 * @property City $city
 * @property Country $country
 */
class BasicProfile extends \yii\db\ActiveRecord
{
    const GENDER_FEMALE = 0;
    const GENDER_MALE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'basic_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'address', 'timezone_id', 
                'date_of_birth', 'country_id', 'city_id', 'gender'], 'required'],
            [['gender', 'country_id', 'city_id', 'timezone_id'], 'integer'],
            ['gender', 'in', 'range' => [self::GENDER_FEMALE, self::GENDER_MALE]],
            [['country_id'], 'in', 'range'=>array_keys($this->getCountryList())],
            [['city_id'], 'in', 'range'=>array_keys($this->getCityList())],
            [['date_of_birth'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 128],
            [['address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'country_id' => 'Country',
            'city_id' => 'City',
            'address' => 'Address',
            'timezone_id' => 'Timezone',
            'date_of_birth' => 'Date Of Birth',
        ];
    }

    public static function getCountryList()
    {
        $droptions = Country::find()->asArray()->all();
        return Arrayhelper::map($droptions, 'id' , 'name');
    }

    public static function getCityList() 
    {
        $droptions = City::find()->asArray()->all();
        return Arrayhelper::map($droptions, 'id' , 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

}
