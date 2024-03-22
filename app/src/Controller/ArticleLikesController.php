<?php
declare(strict_types=1);

namespace App\Controller;

use DateTime;
use mysql_xdevapi\Exception;

/**
 * ArticleLikes Controller
 *
 * @property \App\Model\Table\ArticleLikesTable $ArticleLikes
 * @method \App\Model\Entity\ArticleLike[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticleLikesController extends AppController
{
    /**
     * @param \Cake\Event\EventInterface $event
     * @return void
     */
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->Authorization->skipAuthorization();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->request->allowMethod(['get']);
        $result = $this->Authentication->getResult();
        $user = $result->getData();
        $articleLikes = $this->ArticleLikes->find('all')->where(['user_id' => $user->id]);
        $this->set('articleLikes', $articleLikes);
        $this->viewBuilder()->setOption('serialize', ['articleLikes']);
    }

    /**
     * View method
     *
     * @param string|null $id Article Like id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id)
    {
        $this->request->allowMethod(['get']);
        $articleLike = $this->ArticleLikes->find('all')->where(['article_id' => $id]);
        $this->set('articleLike', $articleLike);
        $this->viewBuilder()->setOption('serialize', ['articleLike']);
        $this->set(compact('articleLike'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($id)
    {
        $this->request->allowMethod(['put']);
        $result = $this->Authentication->getResult();
        $user = $result->getData();
        try {
            $articleLike = $this->ArticleLikes->newEmptyEntity();
            $articleLike->article_id = $id;
            $articleLike->user_id = $user->id;
            $articleLike->liked_at = new DateTime();
            $this->ArticleLikes->save($articleLike);
            $this->set(['is_success' => true]);
            $this->viewBuilder()->setOption('serialize', ['is_success']);
        } catch (\Exception $e) {
            $this->set(['is_success' => false]);
            $this->viewBuilder()->setOption('serialize', ['is_success']);
        }
    }
}
