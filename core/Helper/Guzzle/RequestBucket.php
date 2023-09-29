<?php

namespace Core\Helper\Guzzle;

class RequestBucket
{
    /**  METHOD */
    public const POST = 'POST';
    public const GET = 'GET';

    /** PARAM */
    protected string $method = self::GET;

    protected array $jsonData = [];

    protected ?string $body = null;
    protected array $query = [];
    protected array $headers = [];
    protected array $mutipart = [];
    protected string $url = '';

    /**
     * @var resource
     */
    protected $sink;

    protected array $formData = [];


    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return RequestBucket
     */
    public function setMethod(string $method): RequestBucket
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return RequestBucket
     */
    public function setUrl(string $url): RequestBucket
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return array
     */
    public function getJsonData(): array
    {
        return $this->jsonData;
    }

    /**
     * @param array $jsonData
     * @return RequestBucket
     */
    public function setJsonData(array $jsonData): RequestBucket
    {
        $this->jsonData = $jsonData;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string|null $body
     * @return RequestBucket
     */
    public function setBody(?string $body): RequestBucket
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return RequestBucket
     */
    public function setHeaders(array $headers): RequestBucket
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return array
     */
    public function getMutipart(): array
    {
        return $this->mutipart;
    }

    /**
     * @param array $mutipart
     * @return RequestBucket
     */
    public function setMutipart(array $mutipart): RequestBucket
    {
        $this->mutipart = $mutipart;
        return $this;
    }

    /**
     * @return resource
     */
    public function getSink()
    {
        return $this->sink;
    }

    /**
     * @param $sink
     * @return RequestBucket
     */
    public function setSink($sink): RequestBucket
    {
        $this->sink = $sink;
        return $this;
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
        return $this->formData;
    }

    /**
     * @param array $formData
     * @return RequestBucket
     */
    public function setFormData(array $formData): RequestBucket
    {
        $this->formData = $formData;
        return $this;
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * @param array $query
     * @return RequestBucket
     */
    public function setQuery(array $query): RequestBucket
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return RequestBucket
     */
    public function addHeader(string $name, string $value): RequestBucket
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * @param $data
     * @return RequestBucket
     * @throws JsonException
     */
    public function setJsonBody($data): RequestBucket
    {
        $this->addHeader('Content-Type', 'application/json');
        $this->setBody(json_encode($data, JSON_THROW_ON_ERROR));
        return $this;
    }


}
