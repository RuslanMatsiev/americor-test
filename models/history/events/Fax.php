<?php

namespace app\models\history\events;

use Yii;

/**
 * This is the model class for table "fax"
 *
 * @property integer $id
 * @property string $ins_ts
 * @property integer $user_id
 * @property integer $document_id
 * @property string $from
 * @property string $to
 * @property integer $status
 * @property integer $direction
 * @property integer $type
 * @property string $typeText
 *
 * @property User $user
 */
class Fax extends \app\models\Fax implements EventsInterface
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
            ' - ' .
            (isset($this->document) ? \yii\helpers\Html::a(
                Yii::t('app', 'view document'),
                $this->document->getViewUrl(),
                [
                    'target' => '_blank',
                    'data-pjax' => 0
                ]
            ) : ''),
            'footer' => Yii::t('app', '{type} was sent to {group}', [
                'type' => $this->getTypeText() ?? 'Fax',
                'group' => isset($this->creditorGroup) ? \yii\helpers\Html::a($this->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
            ]),
            'footerDatetime' => $model->ins_ts,
            'iconClass' => 'fa-fax bg-green'
        ];
    }

    public function getBody($model) : string
    {
        return $model->eventText;
    }
}