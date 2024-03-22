<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ArticleLike> $articleLikes
 */
?>
<div class="articleLikes index content">
    <?= $this->Html->link(__('New Article Like'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Article Likes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('article_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('liked_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articleLikes as $articleLike): ?>
                <tr>
                    <td><?= $this->Number->format($articleLike->id) ?></td>
                    <td><?= $articleLike->has('article') ? $this->Html->link($articleLike->article->title, ['controller' => 'Articles', 'action' => 'view', $articleLike->article->id]) : '' ?></td>
                    <td><?= $articleLike->has('user') ? $this->Html->link($articleLike->user->email, ['controller' => 'Users', 'action' => 'view', $articleLike->user->id]) : '' ?></td>
                    <td><?= h($articleLike->liked_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $articleLike->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $articleLike->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $articleLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articleLike->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
