<?php


namespace LmaDev\ShopwareApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

/**
 * Class ShopwareApi
 * @package LmaDev\ShopwareApi
 * @author LmaDev
 * @version 2.1.7
 */
class ShopwareApi  implements ShopwareApiInterface
{
    /**
     * @var ConnectionApi
     */
    private $api;

    /**
     * ShopwareApi constructor.
     * @param ConnectionApi $api
     */
    public function __construct(ConnectionApi $api)
    {
        $this->api = $api;
    }

    /**
     * @param String $action
     * @param array|null $filter
     * @param array|null $sort
     * @param int|null $limit
     * @return mixed
     * @throws GuzzleException
     * @example [['property'=>'active','value'=>1],['property'=>'name','value'=>'%klakier%']]
     */
    public function get(String $action, array $filter = null , array $sort = null, int $limit = null)
    {
        /**
         * @var string
         */
        $params = null;
        if (null !== $filter && is_array($filter)) {
            $params .= http_build_query(['filter' => $filter]);
        }

        if (null !== $sort && is_array($sort)) {
            if($params == "") {
                $params .= http_build_query(['sort' => $sort]);
            }else{
                $params .= "&".http_build_query(['sort' => $sort]);
            }

        }

        if (null !== $limit) {
            if($params == "") {
                $params .= http_build_query(['limit' => $limit]);
            }else{
                $params .= "&".http_build_query(['limit' => $limit]);
            }
        }

        /**
         * @var Client
         */
        try{
            $response = $this->api->call()->request('GET', $action . '/?' . $params);
        }catch (RequestException $e){
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }
        return \GuzzleHttp\json_decode($response->getBody());
    }

    /**
     * @param String $action
     * @param array $data
     * @return mixed
     */
    public function post(String $action, array $data)
    {

        /**
         * @var Client
         */
        try{
            $response = $this->api->call()->post($action, ['json' => $data]);
        }catch (RequestException $e){
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }

        return \GuzzleHttp\json_decode($response->getBody());
    }

    /**
     * @param String $action
     * @param int $productID
     * @param array $data
     * @return mixed
     */
    public function put(String $action, int $productID, array $data)
    {
        /**
         * @var Client
         */
        try{
            $response = $this->api->call()->put($action . '/' . $productID, ['json' => $data]);
        }catch (RequestException $e){
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }

        return \GuzzleHttp\json_decode($response->getBody());
    }

    /**
     * @param String $action
     * @param int $productID
     * @return mixed
     */
    public function delete(String $action, int $productID)
    {
        /**
         * @var Client
         */
        try {
            $response = $this->api->call()->delete($action . '/' . $productID);
        }catch (RequestException $e){
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }
        return \GuzzleHttp\json_decode($response->getBody());
    }

    /**
     * @return array
     */
    public function testConnection()
    {
        /**
         * @var Client
         */
        try{
            $response = $this->api->call()->request('GET', 'version');
        }catch (RequestException $e){
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }
        return [
            'success' => true,
            'message' => $response->getBody(),
            'code' => $response->getStatusCode()
        ];
    }
}
