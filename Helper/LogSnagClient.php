<?php

namespace Sysentive\LogSnag\Helper;

use Sysentive\LogSnag\Model\Config\ConfigProvider;

class LogSnagClient
{
  const HTTP_REQUEST_TIMEOUT = 3;
  protected $config;

  public function __construct(ConfigProvider $configProvider)
  {
    $this->config = $configProvider;
  }

  public function sendEvent($channel, $event, $description, $icon, $notify = false, $parser = 'text', $tags = [])
  {
    $url = 'https://api.logsnag.com/v1/log';
    $httpRequest = 'POST';

    $templateValues = [];
    foreach ($tags as $key => $value) {
      $templateValues['{{' . $key . '}}'] = $value;
    }

    $data = [
      'channel' => $channel,
      'event' => $event,
      'description' => strtr($description, $templateValues),
      'icon' => $icon,
      'notify' => $notify,
      'parser' => $parser,
      'tags' => $tags
    ];

    $this->send($url, $httpRequest, $data);
  }

  private function send($url, $httpRequest, $data)
  {
    $apiToken = $this->config->getApiToken();
    $apiProject = $this->config->getApiProject();

    $data['project'] = $apiProject;

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiToken
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
  }
}
