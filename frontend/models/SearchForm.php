<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SearchForm extends Model
{
    public $name;
    public $phone;
    public $date_from;
    public $course_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string', 'max' => 255],

            ['course_id', 'required'],
            ['course_id', 'integer'],

            ['date_from', 'date'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ім\'я',
            'phone' => 'Телефон',
            'branch_id' => 'Автошкола',
            'course_id' => 'Курс',
        ];
    }
}
