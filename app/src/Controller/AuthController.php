<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\View\JsonView;
use Firebase\JWT\JWT;

/**
 * Auth Controller
 *
 * @method \App\Model\Entity\Auth[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AuthController extends AppController
{
    /**
     * @return string[]
     */
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    /**
     * @param \Cake\Event\EventInterface $event
     * @return void
     */
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
        $this->Authorization->skipAuthorization();
    }

    /**
     * Login action
     * @return void
     */
    public function login(): void
    {
        $this->request->allowMethod(['post']);
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $user = $result->getData();
            $json = [
                'token' => $this->createJwtToken($user->id),
            ];
        } else {
            $this->response = $this->response->withStatus(401);
            $json = [];
        }
        $this->set(compact('json'));
        $this->viewBuilder()->setOption('serialize', 'json');
    }

    /**
     * Create jwt token.
     *
     * @param int $id user id.
     * @return string
     */
    private function createJwtToken(int $id): string
    {
        $key = file_get_contents(CONFIG . '/jwt.key');
        $payload = [
            'iss' => 'test_app',
            'sub' => $id,
            'exp' => time() + 3600
        ];

        return JWT::encode($payload, $key, 'RS256');
    }
}
