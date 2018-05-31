<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>

<div class="product-item">

    <h2>Здравствуйте <?= Html::a($model->email, Url::to(['/users/view/', 'id' => $model->id])) ?></h2>

    <h4>Вы вошли с правами - <?= HtmlPurifier::process($model->adminGroup) ?></h4>

</div>
