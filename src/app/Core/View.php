<?php
declare(strict_types=1);

namespace App\Core;

class View
{
    public static function render(string $view, array $data = [], string $layout = 'app'): void
    {
        extract($data, EXTR_SKIP);

        $viewPath = SRC_PATH . '/app/Views/' . str_replace('.', '/', $view) . '.php';
        if (!is_file($viewPath)) {
            http_response_code(500);
            exit("View not found: $view");
        }

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        if ($layout === '') {
            echo $content;
            return;
        }

        $layoutPath = SRC_PATH . '/app/Views/layouts/' . $layout . '.php';
        if (!is_file($layoutPath)) {
            echo $content;
            return;
        }
        require $layoutPath;
    }

    public static function partial(string $__partial, array $data = []): void
    {
        $__path = SRC_PATH . '/app/Views/partials/' . $__partial . '.php';
        if (!is_file($__path)) return;
        extract($data, EXTR_OVERWRITE);
        require $__path;
    }
}
