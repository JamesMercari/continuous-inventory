<?php

namespace Mercari\ContinuousInventory\Api;

interface CheckInventoryManagementInterface
{

    /**
     * GET for testaction api
     * @param string $params
     * @return string
     */
    public function checkinventory($params);
}