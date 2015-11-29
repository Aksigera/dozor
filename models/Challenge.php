<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%challenge}}".
 *
 * @property integer $id
 * @property string $time
 * @property string $text
 * @property string $hint1
 * @property integer $is_hint1_active
 * @property string $hint2
 * @property integer $is_hint2_active
 * @property string $answer
 * @property integer $code_count
 * @property integer $code_available
 * @property integer $is_answer_activate
 * @property integer $is_solved
 * @property string $map_url
 *
 * @property Log[] $logs
 */
class Challenge extends \yii\db\ActiveRecord
{
    const ChallengeStartTime = 123;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%challenge}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time'], 'safe'],
            [['text', 'hint1', 'hint2', 'answer', 'code_count', 'code_available'], 'required'],
            [['is_hint1_active', 'is_hint2_active', 'code_count', 'code_available', 'is_answer_activate', 'is_solved'], 'integer'],
            [['text', 'hint1', 'hint2', 'answer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'text' => 'Text',
            'hint1' => 'Hint1',
            'is_hint1_active' => 'Is Hint1 Active',
            'hint2' => 'Hint2',
            'is_hint2_active' => 'Is Hint2 Active',
            'answer' => 'Answer',
            'code_count' => 'Code Count',
            'code_available' => 'Code Available',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['challenge_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ChallengeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChallengeQuery(get_called_class());
    }

    /**
     * @inheritdoc
     * @return ChallengeQuery the active query used by this AR class.
     */
    public static function findActual()
    {
        $levelTime = 0;
        $model = self::find()->where(['is_solved' => 0])->orderBy('id')->one();
        if (!empty($model)) {
            $timestamp = $model->time;
            $currentTime = strtotime('now');
            $levelTime = $currentTime - $timestamp;
//            if ($levelTime > 90 * 60 || $model->code_available == $model->code_count || $levelTime < 0) {
//                $model->is_solved = 1;
//                $model->save(false);
//                $model = self::findActual();
//            }

            if ($levelTime > 30 * 60 && $levelTime < 60 * 60) {
                $model->is_hint1_active = 1;
            } elseif ($levelTime > 60 * 60) {
                $model->is_hint2_active = 1;
                $model->is_answer_activate = 1;
            }
            $model->save(false);
        }
        return $model;
    }

    public static function checkAnswer($post,$model)
    {
        $answerType = 'Ошибка';
        $answer = $post['Challenge']['answer'];
        if (!empty($answer)) {
            if ($model->is_answer_activate == 0) {
                if ($answer == $model->answer) {
                    $model->is_answer_activate = 1;
                    $answerType = 'Ответ введен верно';
                    $model->save(false);
                } else {
                    $answerType = 'Ответ введен не верно';
                }
            }else{
                $checkSum = (string)(ord($answer[6]) + $answer[7]);
                $answerId = $checkSum[2];
                if(strlen($answer) == 8 && $answer[0] == 'z' && $answer[1] == 'p' && $answerId == $model-> id){
                    $answerType = 'Код введен верно';
                    $model-> code_count = $model-> code_count + 1;
                    $model->save(false);
                } else {
                    $answerType = 'Код введен не верно';
                }
            }
            $log = new Log();
            $log->time = time();
            $log->text = $answerType;
            $log->challenge_id = $model->id;
            $log->answer = $answer;
            $log->save();
        }
    }

}
