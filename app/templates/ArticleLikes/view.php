<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ArticleLike $articleLike
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Article Like'), ['action' => 'edit', $articleLike->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Article Like'), ['action' => 'delete', $articleLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articleLike->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Article Likes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Article Like'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="articleLikes view content">
            <h3><?= h($articleLike->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Article') ?></th>
                    <td><?= $articleLike->has('article') ? $this->Html->link($articleLike->article->title, ['controller' => 'Articles', 'action' => 'view', $articleLike->article->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $articleLike->has('user') ? $this->Html->link($articleLike->user->email, ['controller' => 'Users', 'action' => 'view', $articleLike->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($articleLike->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Liked At') ?></th>
                    <td><?= h($articleLike->liked_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
