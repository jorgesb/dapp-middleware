<?php
/**
 * BlockchainConnector.php
 *
 * @author    Cocomore <info@cocomore.com>
 * @copyright 1997-2018 Cocomore AG
 */

namespace App\Service;

use App\Entity\OptAction;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use GuzzleHttp\Exception\RequestException;

/**
 * Class BlockchainConnector
 */
class BlockchainConnector
{
    const ADD_ENDPOINT_URL = 'add';
    const GET_ENDPOINT_URL = 'opt-action';
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * BlockchainConnector constructor.
     *
     * @param \GuzzleHttp\Client     $client
     * @param string                 $baseUrl
     */
    public function __construct(\GuzzleHttp\Client $client, $baseUrl)
    {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array  $data
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($url, $method = 'GET', array $data = [])
    {
        try {
            if ('GET' === $method) {

                $res = $this->client->request(
                    'GET',
                    $url,
                    [
                        'headers' => ['Accept' => 'text/html,text/json'],
                    ]
                );
            } elseif ('PUT' === $method) {
                $res = $this->client->request(
                    'PUT',
                    $url,
                    [
                        'headers'     => ['Accept' => 'text/html,text/json'],
                        'form_params' => $data,
                    ]
                );
            } else {

                $res = $this->client->request(
                    'POST',
                    $url,
                    [
                        'headers'     => ['Accept' => 'text/html,text/json'],
                        'form_params' => $data,
                    ]
                );
            }

        } catch (RequestException $e) {
            return $e->getResponse()->getBody()->__toString();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $res->getBody()->__toString();
    }

    /**
     * @param array $requestData
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add(array $requestData)
    {

        return $this->send(
            $this->baseUrl.self::ADD_ENDPOINT_URL,
            'POST',
            [
                'id'      => $requestData['id'],
                'urn'     => $requestData['urn'],
                'optId'   => $requestData['optId'],
                'action'  => $requestData['action'],
                'optText' => $requestData['optText'],
            ]
        );
    }

    /**
     * @param int $id
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($id)
    {
        return $this->send(
            $this->baseUrl.self::GET_ENDPOINT_URL.'/'.$id,
            'GET',
            [
                'id' => $id,
            ]
        );
    }



}