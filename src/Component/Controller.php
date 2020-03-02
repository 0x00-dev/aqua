<?php


namespace Aqua\Component;

use Aqua\Interfaces\ApplicationInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Контроллер.
 *
 * @package Aqua\Component
 */
abstract class Controller
{
    /**
     * Шаблоны.
     *
     * @var string
     */
    private string $templates = "/views";

    private string $cache = "/cache";

    /**
     * Шаблонизатор.
     *
     * @var Environment
     */
    private Environment $twig;

    /**
     * Controller constructor.
     *
     * @param ApplicationInterface $app Приложение
     */
    public function __construct(ApplicationInterface $app)
    {
        $loader = new \Twig\Loader\FilesystemLoader("app/" . $app->getName() . $this->templates);
        $this->twig = new \Twig\Environment($loader, [
            'cache' => 'app/' . $app->getName() . $this->cache,
        ]);
    }

    /**
     * Скомпилировать.
     *
     * @param string $template Шаблон
     * @param iterable $params Параметры
     * @param int $status HTTP статус
     */
    public function render(string $template, iterable $params, int $status = 200)
    {
        try {
            $data = $this->twig->render($template, $params);
            $response = new Response($data, $status);
            $response->send();
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
}