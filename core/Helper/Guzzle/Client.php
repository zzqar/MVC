<?php

namespace Core\Helper\Guzzle;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class Client extends \GuzzleHttp\Client
{
    /**
     * @param RequestBucket $bucket
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function requestBucket(RequestBucket $bucket): ResponseInterface
    {
        $options = [];
        $test = $bucket->getBody();

        if (!empty($bucket->getBody())) {
            $options[RequestOptions::BODY] = $bucket->getBody();
        }

        if (!empty($bucket->getFormData())) {
            $options[RequestOptions::FORM_PARAMS] = $bucket->getFormData();
        }

        if (!empty($bucket->getHeaders())) {
            $options[RequestOptions::HEADERS] = $bucket->getHeaders();
        }

        if (!empty($bucket->getQuery())) {
            $options[RequestOptions::QUERY] = $bucket->getQuery();
        }

        if (!empty($bucket->getMutipart())) {
            $options[RequestOptions::MULTIPART] = $bucket->getMutipart();
        }

        if (!empty($bucket->getJsonData())) {
            $options[RequestOptions::JSON] = $bucket->getJsonData();
        }

        if (!empty($bucket->getSink())) {
            $options[RequestOptions::SINK] = $bucket->getSink();
        }

         return $this->request(
             $bucket->getMethod(),
             $bucket->getUrl(),
             $options
         );
    }

    /**
     * @param RequestBucket $bucket
     * @param bool $associative
     * @param int $depth
     * @param int $flags
     * @return mixed
     * @throws GuzzleException
     */
    public function getJsonResponse(
        RequestBucket $bucket,
        bool $associative = true,
        int $depth = 512,
        int $flags = JSON_THROW_ON_ERROR
    ): mixed
    {
        $result = $this->requestBucket($bucket);
        $body = $result->getBody()->getContents();

            return json_decode($body, $associative, $depth, $flags);


    }


}
