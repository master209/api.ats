<?php

namespace app\models;

use app\models\query\PostQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\Linkable;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $title
 * @property string $content
 *
 * @property User $user
 */
class Post extends ActiveRecord implements Linkable
{
    public static function tableName()
    {
        return '{{%post}}';
    }

    public function rules()
    {
        return [
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'title' => 'Title',
            'content' => 'Content',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return PostQuery
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

// Поля extraFields() от просто fields() отличаются тем, что они просто по умолчанию не выводятся (5:10:00)
// /posts/1?expand=author
    public function extraFields()
    {
        return [
            'author' => 'user', //поле будет называтья 'author', а браться будет из $this->user
        ];
    }

    public function getLinks()
    {
        return [
            'self' => Url::to(['post/view', 'id' => $this->id], true),
        ];
    }
}
