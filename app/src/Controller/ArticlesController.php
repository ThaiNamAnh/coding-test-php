<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\View\JsonView;

class ArticlesController extends AppController
{
    /**
     * @param \Cake\Event\EventInterface $event
     * @return void
     */
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index', 'view']);
        $this->Authorization->skipAuthorization();
    }

    /**
     * @return string[]
     */
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    /**
     * @return void
     */
    public function index()
    {
        $this->request->allowMethod(['get']);
        $articles = $this->Articles->find('all')->all();
        $this->set('articles', $articles);
        $this->viewBuilder()->setOption('serialize', ['articles']);
    }

    /**
     * @param $id
     * @return void
     */
    public function view($id)
    {
        $this->request->allowMethod(['get']);
        $article = $this->Articles->get($id);
        $this->set('article', $article);
        $this->viewBuilder()->setOption('serialize', ['article']);
    }

    /**
     * @return void
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $article = $this->Articles->newEntity($this->request->getData());
        $result = $this->Authentication->getResult();
        $user = $result->getData();
        $article->user_id = $user->id;
        if ($this->Articles->save($article)) {
            $message = true;
        } else {
            $message = false;
        }
        $this->set(['is_success' => $message]);
        $this->viewBuilder()->setOption('serialize', ['is_success']);
    }

    /**
     * @param $id
     * @return void
     */
    public function edit($id)
    {
        $this->request->allowMethod(['put']);
        $article = $this->Articles->get($id);
        $this->Authorization->authorize($article, 'edit');
        $article = $this->Articles->patchEntity($article, $this->request->getData());
        if ($this->Articles->save($article)) {
            $message = true;
        } else {
            $message = false;
        }
        $this->set(['is_success' => $message]);
        $this->viewBuilder()->setOption('serialize', ['is_success']);
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $article = $this->Articles->get($id);
        $this->Authorization->authorize($article, 'delete');
        $message = true;
        if (!$this->Articles->delete($article)) {
            $message = false;
        }
        $this->set('is_success', $message);
        $this->viewBuilder()->setOption('serialize', ['is_success']);
    }
}
