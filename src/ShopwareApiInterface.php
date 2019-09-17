<?php


namespace LmaDev\ShopwareApi;

/**
 * Interface ShopwareApiInterface
 * @package LmaDev\ShopwareApi
 * @author LmaDev
 * @version 2.1.1
 */
interface ShopwareApiInterface
{
    /**
     * @param String $action
     * @param array $params
     * @param array $sort
     * @param array $limit
     * @return mixed
     */
    public function get(String $action, array $params = null , array $sort = null, array $limit = null);

    /**
     * @param String $action
     * @param array $data
     * @return mixed
     */
    public function post(String $action, array $data);

    /**
     * @param String $action
     * @param int $productID
     * @param array $data
     * @return mixed
     */
    public function put(String $action, int $productID, array $data);

    /**
     * @param String $action
     * @param int $productID
     * @return mixed
     */
    public function delete(String $action, int $productID);
}