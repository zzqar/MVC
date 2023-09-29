<?php

namespace Core\HTTP;

abstract class ResponseInterface
{
    protected string $title;
    protected string|null $template;
    protected int $code;
    protected array $responseData = [];


    /**
     * @param null $template
     * @param int|null $code
     */
    public function __construct($template = null, int $code = null)
    {
        $this->template = $template;
        $this->code = $code ?? HttpStatusCode::OK;
    }

    /**
     * @param int $code
     * @return static
     */
    public function setCode(int $code): static
    {
        $this->code = $code;
        return $this;
    }

    public function getCode(): int
    {
        return $this->code;
    }


    /**
     * @param array $responseData
     * @return static
     */
    public function setData(array $responseData): static
    {
        $this->responseData = $responseData;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return static
     */
    public function assign($key, $value): static
    {
        $this->responseData[$key] = $value;
        return $this;
    }

    /**
     * @param array $data
     * @return static
     */
    public function assignArray(array $data): static
    {
        $this->responseData = array_merge($this->responseData, $data);
        return $this;
    }

    /**
     * @return array
     */
    public function getResponseData(): array
    {
        return $this->responseData;
    }

    /**
     * @return string|null
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return static
     */
    public function setTemplate(string $template): static
    {
        $this->template = $template;
        return $this;
    }



}
