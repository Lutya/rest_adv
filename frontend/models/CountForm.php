<?php
namespace frontend\models;

class CountForm extends \yii\base\Model
{
    public $count;

    public function rules()
    {
        return [
            ['count', 'integer', 'min' => 0],
        ];
    }
}