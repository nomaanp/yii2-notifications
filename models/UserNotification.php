<?php

namespace app\models;

use app\models\notifications\NotificationType;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property string $title
 * @property string $event_id
 * @property integer $user_id
 * @property integer $recipient_id
 * @property string $subject
 * @property string $body
 * @property integer $notification_type
 * @property array $available
 *
 * @property User $recipient
 * @property User $user
 */
class UserNotification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%notification}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'event_id', 'user_id'], 'required'],
            [['user_id', 'recipient_id'], 'integer'],
            [['subject', 'body'], 'string'],
            [['title', 'event_id'], 'string', 'max' => 255],
            [['recipient_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recipient_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty'=> true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['notification_type', 'each', 'rule' => ['in', 'range' => array_keys(UserNotification::getAvailable())]]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'event_id' => Yii::t('app', 'Event ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'recipient_id' => Yii::t('app', 'Recipient ID'),
            'subject' => Yii::t('app', 'Subject'),
            'body' => Yii::t('app', 'Body'),
            'notification_type' => Yii::t('app', 'Notification Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipient()
    {
        return $this->hasOne(User::className(), ['id' => 'recipient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationType()
    {
        return $this->hasOne(NotificationType::className(), ['id' => 'notification_type']);
    }

    /**
     * List all available types of notifications
     * @return array
     */
    public static function getAvailable()
    {
        return ArrayHelper::map(NotificationType::find()->asArray()->all(), 'id', 'title');
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->notification_type = unserialize($this->notification_type);
    }

    public function afterValidate()
    {
        parent::afterValidate();
        $this->notification_type = serialize($this->notification_type);
    }


}
