<?php

namespace app\models\history\events;

use Yii;

/**
 * The model class for table %sms
 *
 * @property User $user
 * @property Customer $customer
 */
class Sms extends \app\models\Sms implements EventsInterface
{

    public function renderFileName() : string
    {
        return '_item_common';
    }

    public function renderParams($model) : array
    {
        return [
            'user' => $model->user,
            'body' => $this->getBody($model),
            'footer' => $this->direction == self::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $this->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $this->phone_to ?? ''
                ]),
            'iconIncome' => $this->direction == Sms::DIRECTION_INCOMING,
            'footerDatetime' => $model->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ];
    }

    public function getBody($model) : string
    {
        return $this->message ?? '';
    }
}