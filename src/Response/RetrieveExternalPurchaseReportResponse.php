<?php
namespace Readdle\AppStoreServerAPI\Response;

use Readdle\AppStoreServerAPI\Request\AbstractRequest;

/**
 * @method static HistoryResponse createFromString(string $string, AbstractRequest $originalRequest)
 */
class RetrieveExternalPurchaseReportResponse extends AbstractResponse
{
    protected array $report;

    /**
     * @return array
     */
    public function getReport(): array
    {
        return $this->report;
    }

    public function __construct(array $data)
    {
        $this->report = $data; // Or populate specific properties
    }
}