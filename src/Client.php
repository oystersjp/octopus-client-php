<?php
namespace Octopus;

require_once('../vendor/autoload.php');

/**
 * Class Client
 * @package Octopus
 */
class Client
{
    /** @var string */
    const API_BASE_URL = 'https://strong-octopus.com';

    /** @var string */
    const PATH = '/articles/search';

    protected $client;

    protected $presharedKey;

    /**
     * Client constructor.
     * @param string $presharedKey
     * @param null $client
     */
    public function __construct(string $presharedKey, $client = null)
    {
        if (is_null($client)) {
            $client = new \GuzzleHttp\Client([
                'base_uri' => self::API_BASE_URL,
            ]);
        }
        $this->client = $client;
        $this->presharedKey = $presharedKey;
    }

    /**
     * @param string $keyword
     * @param int $page
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function SearchByKeyword(string $keyword, int $page): array
    {
        $options = [
            'query' => ['keyword' => $keyword, 'page' => $page],
            'headers' => [
                'Authorization' => $this->presharedKey
            ]
        ];
        $response = $this->client->request('GET', self::PATH, $options);

        return json_decode($response->getBody()->getContents(), true);
    }
}