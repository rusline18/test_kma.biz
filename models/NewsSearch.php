<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\News;

/**
 * NewsSearch represents the model behind the search form of `app\models\News`.
 */
class NewsSearch extends News
{
    public $to_created;
    public $from_created;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['image_path', 'title', 'description', 'text'], 'safe'],
            [['to_created', 'from_created'], 'date', 'format' => 'php:Y-m-d']
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = News::find()->with('user');
        $user = Yii::$app->user;

        if (!$user->can('admin')) {
            $query = $query->where(['user_id' => $user->id]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'image_path', $this->image_path])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['between', 'created_at', $this->to_created ? $this->to_created . ' 00:00:00' : null, $this->from_created ? $this->from_created . ' 23:59:59' : null ])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
