<?php
namespace App\Controllers;

use Http\Request;
use App\Helpers\ApiResponse;
use App\Services\TransactionService;

class TransactionController
{

    private $request;

    private $transactionService;

    /**
     * TransactionController Constructor
     */
    public function __construct(TransactionService $transactionService, Request $request)
    {
        $this->transactionService = $transactionService;
        $this->request = $request;
    }

    /**
     * Put transaction in queue
     */
    public function queueTransaction()
    {
        // TODO validate request params
        $params['sku'] = $this->request->getParameter('sku');

        $response = $this->transactionService->queueTransaction($params)->handleApiResponse();

        return ApiResponse::json($response['status'], $response['message'], $response['data']);
    }
    
    public function insertTransaction()
    {
        $params['id'] = $this->request->getParameter('id');
        $params['sku'] = $this->request->getParameter('sku');
        $params['variant_id'] = $this->request->getParameter('variant_id');
        $params['title'] = $this->request->getParameter('title');
        
        $this->transactionService->insertTransaction($params);
    }
}
