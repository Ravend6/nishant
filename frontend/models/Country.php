<?php

namespace frontend\models;

use Yii;
use frontend\models\City;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $name
 *
 * @property BasicProfile[] $basicProfiles
 * @property CountryCity[] $countryCities
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBasicProfiles()
    {
        return $this->hasMany(BasicProfile::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryCities()
    {
        return $this->hasMany(CountryCity::className(), ['country_id' => 'id']);
    }

    public function getCities()
    {
        return $this->hasMany(City::className(), ['id' => 'city_id'])
            ->viaTable('country_city', ['country_id' => 'id']);
    }

}
