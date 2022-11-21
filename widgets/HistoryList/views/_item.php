<?php
use app\models\Call;
use app\models\Customer;
use app\models\history\History;
use app\models\history\Search as HistorySearch;
use app\models\Sms;
use yii\helpers\Html;

/** @var $model HistorySearch */

$event = \app\models\history\events\EventsFactory::factory($model);
echo $this->render($model->eventFactory->renderFileName(), $model->eventFactory->renderParams($model));
