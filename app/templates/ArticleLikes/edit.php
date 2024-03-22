<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ArticleLike $articleLike
 * @var string[]|\Cake\Collection\CollectionInterface $articles
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $articleLike->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $articleLike->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Article Likes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="articleLikes form content">
            <?= $this->Form->create($articleLike) ?>
            <fieldset>
                <legend><?= __('Edit Article Like') ?></legend>
                <?php
                    echo $this->Form->control('article_id', ['options' => $articles]);
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('liked_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
