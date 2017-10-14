<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string  $title
 * @property string  $image
 * @property string  $slug
 * @property string  $description
 * @property boolean $draft
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property TagsToPost $tags
 */
class Post extends \yii\db\ActiveRecord
{

    public $relatedTags;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ],
            'slug' => [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'immutable' => true,
                'ensureUnique' => true,
            ],
            'blamble' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description', 'relatedTags'], 'string'],
            [['draft', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug', 'image'], 'string', 'max' => 255],
            [['draft'], 'default', 'value' => 1],
            [['slug'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => false, 'targetClass' => User::className(), 'targetAttribute' => [
                'user_id' => 'id'
            ]],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagsToPosts()
    {
        return $this->hasMany(TagsToPost::className(), ['post_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Description',
            'draft' => 'Draft',
            'user_id' => 'User ID',
            'image' => 'Image',
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
     * @inheritdoc
     * @return \common\models\query\Post the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\Post(get_called_class());
    }
}
