<?php

use app\models\News;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'image_path',
            'title',
            'description',
            'text:ntext',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => Html::dropDownList('NewsSearch[status]', null, [0 => 'Неактивный', 1 => 'Активный'], ['prompt' => 'Статус']),
                'value' => function($data) {
                    return Html::checkbox('status', $data->status === News::NEWS_ACTIVE, [
                            'data-url' => Url::to(['news/active', 'id' => $data->id]),
                            'class' => 'status-checkbox'
                    ]);
                }
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Автор',
                'value' => 'userName'
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Дата создание',
                'format' => 'datetime',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'to_created',
                    'attribute2' => 'from_created',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => ['format' => 'yyyy-mm-dd']
                ]),
                'value' => function($data) {
                    return $data->created_at;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}'
            ],
        ],
    ]); ?>
</div>
<?php
    $script = <<< JS
        $('.status-checkbox').click(function() {
            let url = $(this).data('url');
            $.get(url).then(res => {
                if (res === '0') {
                    $(this).attr('checked', false);
                }
            });
        })        
JS;

    $this->registerJs($script);

?>

