<?php

namespace app\models\notifications;

use app\models\UserNotification;
use Yii;

/**
 * This is the model class for table "notification_types".
 *
 * @property integer $id
 * @property string $title
 * @property string $class
 *
 * @property UserNotification[] $notifications
 */
class NotificationType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%notification_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'class'], 'required'],
            [['title', 'class'], 'string', 'max' => 255],
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
            'class' => Yii::t('app', 'Name of class with namespace'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(UserNotification::className(), ['notification_type' => 'id']);
    }
}
