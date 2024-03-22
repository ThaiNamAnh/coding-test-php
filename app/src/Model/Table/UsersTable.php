<?php

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use DateTime;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('users');
    }
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->id) {
            $entity->created_at = new DateTime();
            $entity->updated_at = new DateTime();
        }
    }
}
