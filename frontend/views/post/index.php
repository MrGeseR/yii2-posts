<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\select2\Select2;



/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="posts">
        <?php foreach ($posts as $post): ?>
            <div class="posts-item">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <a href="/post/<?=$post->id?>">
                                <?= $post->title ?>
                            </a>
                    </div>
                    <div class="panel-body">
                        <?= $post->description ?>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-2">
                                Author:
                                <?= $post->author->username ?>
                            </div>
                            <div class="col-sm-3">
                                <?php foreach ($post->tags as $tag) :?>
                                    <?= $tag->name ?>
                                <?php endforeach;?>
                                <a class="addTag"> + </a>
                            </div>
                            <div class="col-sm-2">
                                Created:
                                <?= date('h:i j-m-y',strtotime($post->created_at)) ?>
                            </div>
                            <div class="col-sm-3">
                                Last update:
                                <?= date('h:i j-m-y',strtotime($post->updated_at)) ?>
                            </div>
                            <div class="col-sm-2">
                                <a href="/post/<?=$post->id?>">Comments <span class="badge"><?= count($post->comments) ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="addingTag">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Add a tag for this post
                            </h3>
                        </div>

                        <form action="">
                            <div class="panel-body">
                                <?php echo '123q'?>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-warning" type="submit">Add</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        <?php endforeach;
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);?>
    </div>

</div>
