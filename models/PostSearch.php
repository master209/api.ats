<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\models\Post;

class PostSearch extends Post
{
    public function rules()
    {
        return [
            [['title'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find()->with('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

    public function formName()
    {
        return 's';
    }
}
