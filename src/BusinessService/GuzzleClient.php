<?php
namespace App\BusinessService;
use GuzzleHttp;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GuzzleClient
 * @description Class wrapper for making request to the API backend
 * @package BackendBundle\BusinessService\GuzzleClient
 * @author Sergio Gayarre Garasa
 */

class GuzzleClient {

    protected static $instance = null;

    public function __construct()
    {
        self::$instance = new GuzzleHttp\Client();
    }

    public function getClient()
    {
        return self::$instance;
    }

    /**
     * It makes a get request to the url provided
     * @return string json if action is carried out proprely
     * @param url,  string that contains the url of the server to be consumed
     * @return string
     * @throws Exception
     */

    public function get($url, $headers = [])
    {
        try {
            $response =  $this->getClient()->get($url, $headers);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            throw new \Exception("Guzzle has failed on request GET");
        }
    }

    /**
     * It makes a curl post request to post against the url provided
     * @todo Test
     * @return string json if action is carried out proprely
     * @param url,  string that contains the url of the server to be consumed
     * @param params, array associative containing the data to be posted
     * @throws Exception
     *
     */
    public function post($url, $params, $headers = ['Content-Type'=>'application/json'], $auth = null)
    {
        try {

            $options = ['headers' => $headers, 'json'=> $params];

            if (isset($options['headers']['Content-Type']) && $options['headers']['Content-Type'] !== 'application/json') {
                $options['form_params'] = $params;
                unset($options['json']);
            }

            if ($auth) {
                $options['auth'] = $auth;
            }

            $response = $this->getClient()->post($url, $options);
            return $response->getBody()->getContents();

        } catch (\Exception $e) {
            throw new \Exception("Guzzle has failed on request POST. Error: ".$e->getMessage()." -- ".$e->getCode());
        }
    }

    /**
     * It makes a delete request against the url provided
     * @return string json if action is carried out properly
     * @param $url, string that contains the url of the server to be consumed
     * @throws Exception
     *
     * @param type $url
     */

    public function delete($url, $params, $headers = ['Content-Type'=>'application/json'])
    {
        try {
            $response = $this->getClient()->delete($url, ['headers' => $headers, 'json'=> $params]);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            throw new \Exception("Guzzle has failed on request DELETE");
        }
    }

    /**
     * It makes a delete request against the url provided
     *
     * @return string json if action is carried out properly
     * @param $url, string that contains the url of the server to be consumed
     * @param $params, array associative to be imported
     * @throws Exception
     *
     * @param type $url
     */

    public function put($url, $params, $headers = ['Content-Type'=>'application/json'])
    {
        try {
            $response = $this->getClient()->delete($url, ['headers' => $headers, 'json'=> $params]);
            return $response->getBody()->getContents();

        } catch (\Exception $e) {
            throw new \Exception("Guzzle has failed on request PUT");
        }
    }
}