<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\View\JsonView;

/**
 * Users Controller
 */
class UsersController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }
    /**
     * Index method
     * @return void
     */
    public function index()
    {
        $users = $this->Users->find('all')->all();
        $this->set('users', $users);
        $this->viewBuilder()->setOption('serialize', ['users']);
    }

    /**
     * @param $id
     * @return void
     */
    public function view($id)
    {
        $this->request->allowMethod(['get']);
        $user = $this->Users->get($id);
        $this->set('user', $user);
        $this->viewBuilder()->setOption('serialize', ['user']);
    }

    /**
     * @return void
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $user = $this->Users->newEntity($this->request->getData());
        if ($this->Users->save($user)) {
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
        $user = $this->Users->get($id);
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($this->Users->save($user)) {
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
        $user = $this->Users->get($id);
        $message = true;
        if (!$this->Users->delete($user)) {
            $message = false;
        }
        $this->set('is_success', $message);
        $this->viewBuilder()->setOption('serialize', ['is_success']);
    }
}
