<?php

namespace Core\HTTP;

class ResponseJson extends ResponseInterface
{
 public function __construct($template = null, int $code = null)
 {
     parent::__construct($template, $code);
     $this->responseData = [
         'status' => true,
     ];
 }

}
