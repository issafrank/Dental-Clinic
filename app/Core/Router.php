<?php
declare(strict_types=1);

namespace App\Core;

class Router
{
    /** @var array<string, array<int, array{pattern:string, action:mixed, middleware:array}>> */
    private array $routes = [
        'GET' => [], 'POST' => [], 'PUT' => [], 'PATCH' => [], 'DELETE' => [],
    ];

    public function get(string $path, $action, array $middleware = []): void    { $this->add('GET', $path, $action, $middleware); }
    public function post(string $path, $action, array $middleware = []): void   { $this->add('POST', $path, $action, $middleware); }
    public function put(string $path, $action, array $middleware = []): void    { $this->add('PUT', $path, $action, $middleware); }
    public function patch(string $path, $action, array $middleware = []): void  { $this->add('PATCH', $path, $action, $middleware); }
    public function delete(string $path, $action, array $middleware = []): void { $this->add('DELETE', $path, $action, $middleware); }

    private function add(string $method, string $path, $action, array $middleware): void
    {
        $pattern = preg_replace('#\{([a-zA-Z_]+)\}#', '(?P<$1>[^/]+)', $path);
        $this->routes[$method][] = [
            'pattern' => '#^' . rtrim($pattern, '/') . '/?$#',
            'action' => $action,
            'middleware' => $middleware,
        ];
    }

    public function dispatch(string $method, string $uri): void
    {
        // Strip the script subfolder (e.g. /capstone2/public) when not using vhost.
        $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
        if ($base !== '' && str_starts_with($uri, $base)) {
            $uri = substr($uri, strlen($base));
        }
        $uri = '/' . trim($uri, '/');

        // Method override via _method form field.
        if ($method === 'POST' && !empty($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        foreach ($this->routes[$method] ?? [] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                foreach ($route['middleware'] as $mw) {
                    (new $mw())->handle();
                }

                $action = $route['action'];
                if (is_array($action)) {
                    [$class, $methodName] = $action;
                    (new $class())->$methodName(...array_values($params));
                    return;
                }
                if (is_callable($action)) {
                    $action(...array_values($params));
                    return;
                }
            }
        }

        http_response_code(404);
        View::render('errors/404', [], 'guest');
    }
}
