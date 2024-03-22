<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class ArticleLikes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('article_likes');
        $table->addColumn('article_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('liked_at', 'datetime')
            ->addPrimaryKey(['id'])
            ->addIndex(['article_id', 'user_id'], ['unique' => true])
            ->addIndex(['user_id'])
            ->addForeignKey('article_id', 'articles', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}
