<?php

namespace App\Services\ApiAdapters\Contracts;

use App\Services\ApiAdapters\Base\ApiResponse;

/**
 * ApiAdapterInterface
 * 
 * Defines the contract that all external API adapters must follow.
 */
interface ApiAdapterInterface
{
    /**
     * Fetch data from the external source
     *
     * @param array $params Optional query parameters
     * @return ApiResponse
     */
    public function fetch(array $params = []): ApiResponse;
}
