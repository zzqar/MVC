<?php

namespace Core\Helper;
use Core\Exceptions\CoreException;
use Core\HTTP\ResponsePage;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class TwigHelper
{
    protected FilesystemLoader $loader;
    protected Environment $twig;
    protected string $baseTemplate = 'base/base.html.twig';

    public function __construct()
    {

        $this->loader = new FilesystemLoader(__mvRoot__ . '/templates');
        $this->twig = new Environment($this->loader, [
            'cache' => __mvRoot__ . '/cache',
            'auto_reload' => true
        ]);


    }

    /**
     * Проверяет на наличие шаблона в проекте
     *
     * @param string $template
     * @return bool
     */
    public function isExistsTemplate(string $template): bool
    {
        return  $this->loader->exists($template);
    }

    /**
     * @param ResponsePage $response
     * @param string $template
     * @return string
     * @throws CoreException
     */
    public function renderFullPage(ResponsePage $response, string $template): string
    {
        if (!$this->isExistsTemplate($template)) {
            throw new CoreException("Шаблон не найден: {$template}");
        }

        try {
            $content = $this->twig->render($template, $response->getResponseData());
            $page = $this->twig->render($this->baseTemplate, ['content' => $content]);
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            throw new CoreException("Не удалось отрисовать шаблон: {$e->getMessage()}");
        }
        return $page;


    }


}
