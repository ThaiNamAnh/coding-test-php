<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArticleLike Entity
 *
 * @property int $id
 * @property int $article_id
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $liked_at
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\User $user
 */
class ArticleLike extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'article_id' => true,
        'user_id' => true,
        'liked_at' => true,
        'article' => true,
        'user' => true,
    ];
}
