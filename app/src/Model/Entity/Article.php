<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entity
{
    /**
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
