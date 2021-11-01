<?php


class ApiTest extends PHPUnit\Framework\TestCase
{

  public function getLocalIP()
  {
    $localIPa = getHostByName(getHostName());
    $localIP = isset($localIPa) ? getHostByName(getHostName()) : '127.0.0.1';

    return $localIP;
  }

  public function test_indexAction()
  {

    $client = new \GuzzleHttp\Client();

    $response = $client->get('http://172.25.208.1:8001/api/v1/notes');
//    var_dump($response);
    $this->assertEquals(200, $response->getStatusCode());
  }


}
