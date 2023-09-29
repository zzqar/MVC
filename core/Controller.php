<?php

namespace Core;

use Core\Helper\TwigHelper;
use Core\HTTP\Content;
use Core\HTTP\ResponseContent;
use Core\HTTP\ResponseJson;
use ReflectionClass;
use Core\HTTP\ResponsePage;
use Core\HTTP\ResponseInterface;
use Core\Exceptions\CoreException;

abstract class Controller
{

    protected Content $dispatcher;
    protected string $twigExt = 'twig';
    /** @var TwigHelper  */
    protected TwigHelper $twigHelper;


    /**
     * @throws CoreException
     */
    public function __construct(string $action, ?array $params = [])
    {
        $this->configure();
        $this->before();

        $result = $this->{$action}(...$params);

        $this->render($result);
    }

    protected function before(): void
    {

    }

    protected function configure(): void
    {
        $this->twigHelper = new TwigHelper();
        $this->dispatcher = Content::getInstance();
    }

    /**
     * @throws CoreException
     */
    protected function render(ResponseInterface $response): void
    {
        $header = [];

        match (true) {
            $response instanceof ResponsePage => $this->dispatcher->dispatch(
                $this->twigHelper->renderFullPage($response, $this->getTemplateFile($response)),
                'text/html',
                $response->getCode(),
                $header
            ),
            $response instanceof ResponseJson => $this->dispatcher->dispatch(
                json_encode($response->getResponseData(), JSON_THROW_ON_ERROR),
                'application/json',
                $response->getCode(),
                $header
            ),
            $response instanceof ResponseContent => $this->dispatcher->dispatch(
                $response->getContent(),
                'text/html',
                $response->getCode(),
                $header
            ),
            default => throw new CoreException('Не опознанный тип ответа')
        };



    }

    protected function getTemplateFile(ResponseInterface $result): string
    {
        $template = $result->getTemplate() ?? $this->getTemplateName();
        return "$template.$this->twigExt";
    }

    protected function getTemplateName(): string
    {
        return str_replace('controller', '', strtolower($this->getClassName()));
    }

    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return (new ReflectionClass(static::class))->getShortName();
    }
}
