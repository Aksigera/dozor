<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property integer $id
 * @property string $time
 * @property string $text
 * @property string $answer
 * @property integer $challenge_id
 *
 * @property Challenge $challenge
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['answer', 'unique'],
            [['time', 'text', 'challenge_id'], 'required'],
            [['time'], 'safe'],
            [['challenge_id'], 'integer'],
            [['text', 'answer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Время',
            'text' => 'События',
            'answer' => 'Данные',
            'challenge_id' => 'Challenge ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChallenge()
    {
        return $this->hasOne(Challenge::className(), ['id' => 'challenge_id']);
    }

    /**
     * @inheritdoc
     * @return LogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogQuery(get_called_class());
    }
}
