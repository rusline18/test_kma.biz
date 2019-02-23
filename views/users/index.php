<?php

use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            [
                'attribute' => 'date_registration',
                'format' => 'datetime',
                'value' => function($date) {
                    return $date->created_at;
                },
                'filter' => Html::input('date', 'UsersSearch[date_registration]'),
            ],
            [
                'attribute' => 'auth_date',
                'format' => 'datetime',
                'filter' => Html::input('date', 'UsersSearch[auth_date]'),
            ],
            [
                'label' => 'Статус',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->status === User::STATUS_ACTIVE || $data->username === 'admin' ? '' : Html::a('Принять', ['users/active', 'id' => $data->id], ['class' => 'button-success']);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}'
            ],
        ],
    ]); ?>
</div>
