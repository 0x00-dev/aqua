<?php


namespace App\http\Controller;

use Aqua\Component\Controller;

/**
 * По умолчанию.
 *
 * @package App\http\Controller
 */
class DefaultController extends Controller
{
    public function index(iterable $params = [])
    {
        var_dump($params);
        $this->render("index.html.twig", array_merge($params, ['title' => 'Test Title']));
    }
}