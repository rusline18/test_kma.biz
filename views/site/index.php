<?php

/* @var $this yii\web\View */
/* @var $pages \app\models\News*/

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';

$perPage = [10, 25, 50];
$current = Yii::$app->request->get('per-page');
?>
<div class="site-index">

    <div>
        <?php foreach ($model as $posts): ?>
            <div><?= Html::img('/'.$posts->image_path) ?></div>
            <h3><?= $posts->title ?></h3>
            <div><?= $posts->description ?></div>
            <div><?= Html::a('Подробнее', Url::to(['site/post', 'id' => $posts->id])) ?></div>
            <hr/>
        <?php endforeach; ?>
    </div>
    <select name="per-page" onchange="location = this.value">
        <?php foreach ($perPage as $value): ?>
            <option value="<?php Html::encode(Url::current(['per-page' => $value, 'page' => null])) ?>"
                    <?php if ($current == $value): ?>selected="selected"<?php endif; ?>
            >
                <?= $value ?>
            </option>
        <?php endforeach; ?>
    </select>
    <?= LinkPager::widget([
            'pagination' => $pages,
    ]) ?>
</div>
