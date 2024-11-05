<?php
namespace Readdle\AppStoreServerAPI\Request;

class RetrieveExternalPurchaseReportRequest extends AbstractRequest
{
    public function getHTTPMethod(): string
    {
        return self::HTTP_METHOD_GET;
    }

    protected function getURLPattern(): string
    {
        return '{baseUrl}/v1/reports/{requestIdentifier}';
    }
}