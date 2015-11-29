<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Challenge;

/**
 * ChallengeSearch represents the model behind the search form about `app\models\Challenge`.
 */
class ChallengeSearch extends Challenge
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_hint1_active', 'is_hint2_active', 'is_answer_activate'], 'integer'],
            [['time', 'text', 'hint1', 'hint2', 'answer'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Challenge::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'time' => $this->time,
            'is_hint1_active' => $this->is_hint1_active,
            'is_hint2_active' => $this->is_hint2_active,
            'is_answer_activate' => $this->is_answer_activate,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'hint1', $this->hint1])
            ->andFilterWhere(['like', 'hint2', $this->hint2])
            ->andFilterWhere(['like', 'answer', $this->answer]);

        return $dataProvider;
    }
}
