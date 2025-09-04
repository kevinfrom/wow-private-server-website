<?php

declare(strict_types=1);

namespace App;

use App\Database\CharactersDatabase;
use App\Database\RealmdDatabase;
use App\Http\Controller\Api\AccountController;
use App\Http\Controller\Api\CharacterController;
use App\Http\Controller\HomeController;
use App\Services\AccountService;
use App\Services\CharacterService;
use App\Services\FeatureService;
use App\View\Templater;
use ArrayObject;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use League\Container\Container;
use function FastRoute\simpleDispatcher;

final readonly class Application
{
    public function __construct(protected Container $container)
    {
        $this->container();
        $this->routes();
    }

    protected function container(): void
    {
        // Databases
        $this->container->add(CharactersDatabase::class);
        $this->container->add(RealmdDatabase::class);

        // Services
        $this->container->add(AccountService::class)->addArguments([
            RealmdDatabase::class,
        ]);
        $this->container->add(CharacterService::class)->addArguments([
            CharactersDatabase::class,
        ]);
        $this->container->add(FeatureService::class);

        // Templater
        $this->container->add(Templater::class)->addArguments([
            TEMPLATES_DIR,
            new ArrayObject([
                'appVersion' => APP_VERSION,
            ]),
        ]);

        // Controllers
        $this->container->add(HomeController::class)->addArguments([
            Templater::class,
            FeatureService::class,
            CharacterService::class,
        ]);
        $this->container->add(AccountController::class)->addArguments([
            AccountService::class,
            FeatureService::class,
        ]);
        $this->container->add(CharacterController::class)->addArguments([
            CharacterService::class,
            FeatureService::class,
        ]);
    }

    protected function routes(): void
    {
        $this->container->add('router', function (): Dispatcher {
            return simpleDispatcher(function (RouteCollector $routes) {
                $routes->get('/', fn() => $this->container->get(HomeController::class)->index());

                $routes->addGroup('/api', function (RouteCollector $routes): void {
                    $routes->post('/accounts', fn() => $this->container->get(AccountController::class)->create());
                    $routes->post('/accounts/{username}/change-password', fn(string $username) => $this->container->get(AccountController::class)->changePassword($username));
                    $routes->get('/characters', fn() => $this->container->get(CharacterController::class)->index());
                });
            });
        });
    }

    public function run(): never
    {
        $method = mb_strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $path   = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

        /** @var Dispatcher $router */
        $router = $this->container->get('router');

        $route = $router->dispatch($method, $path);

        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                die('Not Found');
            case Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                die('Method Not Allowed');
            case Dispatcher::FOUND:
                call_user_func_array($route[1], $route[2]);
            break;
        }

        exit;
    }
}
