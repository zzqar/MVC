<?php

namespace Core\HTTP;


class ResponseContent extends ResponseInterface
{

    protected $content;

    public function getContent()
    {
        return $this->content ?? '';
    }

    /**
     *
     * @param $content
     * @return ResponseContent
     */
    public function setContent($content): ResponseContent
    {
        $this->content = $content;
        return $this;
    }

}
