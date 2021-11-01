<?php


class ApiTest extends PHPUnit\Framework\TestCase
{

  public function getLocalIP()
  {
    $localIPa = getHostByName(getHostName());
    $localIP = isset($localIPa) ? getHostByName(getHostName()) : '127.0.0.1';
    $localIP = "172.25.208.1";
    return $localIP;
  }

  /**
   * @throws \GuzzleHttp\Exception\GuzzleException
   *
   */
  public function test_indexAction()
  {
    $client = new \GuzzleHttp\Client();

    $response = $client->get('http://'.$this->getLocalIP().':8001/api/v1/notes');

    $this->assertEquals(200, $response->getStatusCode());
  }

  /**
   * @param null $note_id
   * @throws \GuzzleHttp\Exception\GuzzleException
   *
   */
  public function test_findByIdAction($note_id = null)
  {
    $id = $note_id == null ? 3 : $note_id;
    $client = new \GuzzleHttp\Client();

    $response = $client->get('http://'.$this->getLocalIP().':8001/api/v1/notes/' . $id);
    $this->assertEquals(200, $response->getStatusCode());
  }

  /**
   * @throws \GuzzleHttp\Exception\GuzzleException
   *
   */
  public function test_createAction()
  {
    $client = new \GuzzleHttp\Client();
    $formData = [
        'title' => 'This is test ttile for unit testing',
        'created_time' => '2014-01-01 12:12:34',
        'text' => 'test text'
    ];

    $response = $client->request('POST', 'http://'.$this->getLocalIP().':8001/api/v1/notes/add', [
        'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        'body' => json_encode($formData),
        'debug' => true
    ]);

    $this->assertEquals(200, $response->getStatusCode());
  }

  /**
   * @throws \GuzzleHttp\Exception\GuzzleException
   *
   */
  public function test_updateByIdAction()
  {
    $client = new \GuzzleHttp\Client();
    $formData = [
        'title' => 'This is test update for id= 2',
        'created_time' => '2014-01-01 12:12:34',
        'text' => 'test text'
    ];

    $response = $client->request('PUT', 'http://'.$this->getLocalIP().':8001/api/v1/notes/2', [
        'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        'body' => json_encode($formData),
        'debug' => true

    ]);

    $this->assertEquals(200, $response->getStatusCode());
  }

  /**
   * @throws \GuzzleHttp\Exception\GuzzleException
   *
   */
  public function test_deleteByIdAction()
  {
    $client = new \GuzzleHttp\Client();

    $response = $client->delete('http://'.$this->getLocalIP().':8001/api/v1/notes/1');

    $this->assertEquals(200, $response->getStatusCode());
  }

}
