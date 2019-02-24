<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @var $image
 * @property int $id
 * @property string $image_path
 * @property string $title
 * @property string $description
 * @property string $text
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $user_id
 *
 * @property User $user
 */
class News extends \yii\db\ActiveRecord
{
    const NEWS_ACTIVE = 1;
    const NEWS_NOT_ACTIUVE = 2;
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['status', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['image_path', 'description'], 'string', 'max' => 256],
            [['title'], 'string', 'max' => 128],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_path' => 'Image Path',
            'title' => 'Title',
            'description' => 'Description',
            'text' => 'Text',
            'status' => 'Status',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * Загрузка изображение
     * @return string
     */
    public function upload($path)
    {
        $posts = 'images/posts';
        if (!file_exists('images')) {
            mkdir('images');
            if (!file_exists('images/posts')) {
                mkdir('images/posts/');
            }
        }
        $this->image->saveAs($path);
        return true;
    }
}
