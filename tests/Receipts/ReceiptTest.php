<?php

namespace Imdhemy\AppStore\Tests\Receipts;

use GuzzleHttp\Exception\GuzzleException;
use Imdhemy\AppStore\ClientFactory;
use Imdhemy\AppStore\Receipts\Receipt;
use Imdhemy\AppStore\Receipts\ReceiptResponse;
use Imdhemy\AppStore\Tests\TestCase;

class ReceiptTest extends TestCase
{
    /**
     * @test
     * @throws GuzzleException
     */
    public function test_verify()
    {
        // Given
        $iosReceipt = json_decode(file_get_contents(__DIR__ . '/../../iOS-receipt.json'), true);
        $client = ClientFactory::create();
        $password = getenv('PASSWORD');
        
        $receiptData = $iosReceipt['transactionReceipt'];
        $receipt = new Receipt($client, $receiptData, $password);

        // when
        $response = $receipt->verify(true);

        // then
        $this->assertInstanceOf(ReceiptResponse::class, $response);
    }
}
