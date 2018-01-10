<?php
namespace App\Responder;

use Psr\Http\Message\ResponseInterface;

interface HttpResponderInterface
{
    public function respond(): ResponseInterface;
}
