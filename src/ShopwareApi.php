<?php


namespace LmaDev\ShopwareApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class ShopwareApi
 * @package LmaDev\ShopwareApi
 * @author LmaDev
 * @version 2.1.1
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
     * @param array|null $limit
     * @return mixed
     * @throws GuzzleException
     * @example [['property'=>'active','value'=>1],['property'=>'name','value'=>'%klakier%']]
     */
    public function get(String $action, array $filter = null , array $sort = null, array $limit = null)
    {
        /**
         * @var string
         */
        $params = null;
        if (null !== $filter && is_array($filter)) {
            $params .= http_build_query(['filter' => $filter]);
        }

        if (null !== $sort && is_array($sort)) {
            $params .= http_build_query(['sort' => $sort]);
        }

        if (null !== $limit && is_array($limit)) {
            $params .= http_build_query($limit);
        }

        /**
         * @var Client
         */
        $response = $this->api->call()->request('GET', $action . '/?' . $params);

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
        $response = $this->api->call()->post($action, ['json' => $data]);

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
        $response = $this->api->call()->put($action . '/' . $productID, ['json' => $data]);

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
        $response = $this->api->call()->delete($action . '/' . $productID);
        return \GuzzleHttp\json_decode($response->getBody());
    }
}
