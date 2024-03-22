<?php

namespace App\Model\Table;
use Cake\ORM\Table;
use DateTime;

class ArticlesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('articles');
    }

    public function beforeSave($event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->id) {
            $entity->created_at = new DateTime();
            $entity->updated_at = new DateTime();
        }
    }
}
