<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $post app\models\Post */

$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$now = new DateTime()

?>
<div class="post-view">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?= $post->title ?></h4>
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
                <div class="col-sm-2 col-sm-offset-3">
                    Created:
                    <?= date('h:i j-m-y',strtotime($post->created_at)) ?>
                </div>
                <div class="col-sm-3">
                    Last update:
                    <?= date('h:i j-m-y',strtotime($post->updated_at)) ?>
                </div>
                <div class="col-sm-2">
                    Comments <span class="badge"><?= count($post->comments) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<p>
    <?php if (Yii::$app->user->id === $post->author_id
        && ((new \DateTime())->diff(new \DateTime($post->created_at))->i < 5)
        && !count($post->comments)) : ?>
        <?= Html::a('Update', ['update', 'id' => $post->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $post->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif;?>
</p>
<a id="addComment" class="btn btn-success">Add a comment</a>
<div class="panel panel-success commentAdd hidden">
    <div class="panel-heading commentAdd_header">
        <i>Add a comment</i>
    </div>
    <form action="/comment/create" method="post">
        <div class="panel-body">
                <textarea name="text" id="text" cols="30" rows="5" class="commentAdd_textarea"></textarea>
        </div>
        <div class="panel-footer">
            <button class="btn btn-success commentAdd_button" type="submit">Add</button>
        </div>
    </form>
</div>
<div class="row">
    <?php foreach ($post->comments as $comment) :?>
        <div class="col-md-9 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-body">
                    <?= $comment->text ?>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-3">
                            Author:
                            <?= $comment->user->username ?>
                        </div>
                        <div class="col-md-3 col-md-offset-6">
                            Created at:
                            <?= date('h:i j-m-y',strtotime($comment->updated_at)) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
