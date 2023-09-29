<?php

namespace Core\HTTP;

use Core\Traits\Instance;

class Content
{
    use Instance;

    /**
     * @param string $content
     * @param string|null $encoding
     * @param int|null $code
     * @param array $headers
     * @return void

     */
    public function dispatch(
        string $content,
        string $encoding = null,
        int $code =  null,
        array $headers = []
    ): void
    {
        if (ob_get_length()) {
            ob_clean();
        }

        $encoding = $encoding ?? 'text/html';
        header("Content-Type: {$encoding}; charset=utf-8");
        header('Vary: Accept-Encoding');

        if ($code !== null) {
            if (!isset(HttpStatusCode::STATUSES[$code])) {
                $code = HttpStatusCode::OK;
            }

            $stringStatus = HttpStatusCode::STATUSES[$code];
            header("{$_SERVER['SERVER_PROTOCOL']} $code $stringStatus", true, $code);
        }

        header('Content-Length: ' . \strlen($content));
        foreach ($headers as $header => $value) {
            header("$header: $value", true);
        }

        flush();
        echo $content;
        exit(2);
    }

}
