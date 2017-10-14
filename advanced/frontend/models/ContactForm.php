<?php

namespace frontend\models;

use common\models\ContactFormUsage;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        $flag = Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => sprintf('%s %s', $this->first_name, $this->last_name)])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();

        (new ContactFormUsage([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'subject' => $this->subject,
            'body' => $this->body
        ]))->save();

        return $flag;
    }
}
