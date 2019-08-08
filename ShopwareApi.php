<?php


namespace App\Service\LmaDev\ShopwareApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class ShopwareApi
 * @package App\Service\LmaDev\ShopwareApi
 * @author LmaDev
 * @version 1.0.0
 */
class ShopwareApi  implements ShopwareApiInterface
{
    /**
     * @var ConnectionApi
     */
    private $api;

    /**
     * @var ParameterBagInterface
     */
    private $params;


    /**
     * ShopwareApi constructor.
     * @param ConnectionApi $api
     * @param ParameterBagInterface $params
     */
    public function __construct(ConnectionApi $api, ParameterBagInterface $params)
    {
        $this->api = $api;
        $this->params = $params;
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
