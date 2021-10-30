<?php


namespace App\Controller;


use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiController extends AbstractFOSRestController
{
  protected function respond($data, int $statusCode = Response::HTTP_OK):Response
  {
    return $this->handleView($this->view($data, $statusCode));
  }
}