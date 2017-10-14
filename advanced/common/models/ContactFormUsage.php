<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contact_form_usage".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property integer $read
 * @property integer $created_at
 * @property integer $updated_at
 */
class ContactFormUsage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_form_usage';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'subject', 'body'], 'required'],
            [['body'], 'string'],
            [['read', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'email', 'subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'subject' => 'Subject',
            'body' => 'Body',
            'read' => 'Read',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ContactFormUsageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ContactFormUsageQuery(get_called_class());
    }
}
