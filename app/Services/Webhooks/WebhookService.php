<?php

namespace App\Services\Webhooks;

use App\Models\FusedData;
use App\Models\AiInsight;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * WebhookService
 * 
 * Handles dispatching webhooks for data fusion and insights events
 */
class WebhookService
{
    /**
     * Dispatch fusion completed webhook
     */
    public function dispatchFusionCompleted(FusedData $fusedData)
    {
        $webhookUrl = config('services.webhooks.fusion_completed');
        
        if (!$webhookUrl) {
            return;
        }

        $payload = [
            'event' => 'fusion.completed',
            'timestamp' => now()->toIso8601String(),
            'fusion_id' => $fusedData->id,
            'user_id' => $fusedData->user_id,
            'sources_count' => $fusedData->source_count,
            'record_count' => $fusedData->record_count,
            'size_bytes' => $fusedData->size_bytes,
        ];

        try {
            Http::timeout(10)->post($webhookUrl, $payload);
        } catch (\Exception $e) {
            Log::error('Webhook dispatch failed', [
                'webhook_url' => $webhookUrl,
                'event' => 'fusion.completed',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Dispatch insight generated webhook
     */
    public function dispatchInsightGenerated(AiInsight $insight)
    {
        $webhookUrl = config('services.webhooks.insight_generated');
        
        if (!$webhookUrl) {
            return;
        }

        $payload = [
            'event' => 'insight.generated',
            'timestamp' => now()->toIso8601String(),
            'insight_id' => $insight->id,
            'user_id' => $insight->user_id,
            'sentiment' => $insight->sentiment,
            'title' => $insight->title,
            'summary' => $insight->summary,
        ];

        try {
            Http::timeout(10)->post($webhookUrl, $payload);
        } catch (\Exception $e) {
            Log::error('Webhook dispatch failed', [
                'webhook_url' => $webhookUrl,
                'event' => 'insight.generated',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Dispatch error webhook
     */
    public function dispatchError($errorMessage, $context = [])
    {
        $webhookUrl = config('services.webhooks.error_occurred');
        
        if (!$webhookUrl) {
            return;
        }

        $payload = [
            'event' => 'error.occurred',
            'timestamp' => now()->toIso8601String(),
            'message' => $errorMessage,
            'context' => $context,
        ];

        try {
            Http::timeout(10)->post($webhookUrl, $payload);
        } catch (\Exception $e) {
            Log::error('Error webhook dispatch failed', [
                'webhook_url' => $webhookUrl,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
