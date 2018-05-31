 <?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ListView;

?>

<?php
	 echo ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => 'list_hello',
    'summary'=>'',
	]);

?>
