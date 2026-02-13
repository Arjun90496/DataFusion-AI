<?php

namespace App\Services\ApiAdapters\Base;

use Illuminate\Support\Collection;

/**
 * ApiResponse
 * 
 * Standardized response object for all API adapters.
 */
class ApiResponse
{
    public bool $success;
    public $data;
    public ?string $message;
    public int $statusCode;
    protected bool $fromCache;

    public function __construct(
        bool $success,
        $data = null,
        ?string $message = null,
        int $statusCode = 200,
        bool $fromCache = false
    ) {
        $this->success = $success;
        $this->data = $data;
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->fromCache = $fromCache;
    }

    /**
     * Map data to a collection
     */
    public function toCollection(): Collection
    {
        return collect($this->data);
    }

    /**
     * Convert data to array
     */
    public function toArray(): array
    {
        if (is_array($this->data)) {
            return $this->data;
        }
        
        if ($this->data instanceof Collection) {
            return $this->data->toArray();
        }

        return (array) $this->data;
    }

    /**
     * Check if data was served from cache
     */
    public function isCached(): bool
    {
        return $this->fromCache;
    }
}
