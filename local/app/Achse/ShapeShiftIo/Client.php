<?php

declare(strict_types=1);

namespace Achse\ShapeShiftIo;

use Achse\ShapeShiftIo\ApiError\ApiErrorException;
use Achse\ShapeShiftIo\ApiError\NotValidResponseFromApiException;
use Achse\ShapeShiftIo\ApiError\TransactionNotCancelledException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
//use Nette\SmartObject;
use stdClass;
use Achse\ShapeShiftIo\Resources;

class Client
{

//    use SmartObject;

    const DEFAULT_BASE_URL = 'https://shapeshift.io';

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var GuzzleClient
     */
    private $guzzleClient;

    /**
     * @param  $baseUrl
     */
    public function __construct($baseUrl = self::DEFAULT_BASE_URL)
    {
        $this->baseUrl = $baseUrl;
        $this->guzzleClient = new GuzzleClient(['base_uri' => $baseUrl]);
    }

    /**
     * @see https://info.shapeshift.io/api#api-2
     *
     * @param  $coin1
     * @param  $coin2
     * @return string
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function getRate( $coin1,  $coin2)
    {
        return $this->get(sprintf('%s/%s', Resources::RATE, Tools::buildPair($coin1, $coin2)))->rate;
    }

    /**
     * @see https://info.shapeshift.io/api#api-3
     *
     * @param  $coin1
     * @param  $coin2
     * @return string
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function getLimit( $coin1,  $coin2)
    {
        return $this->get(sprintf('%s/%s', Resources::LIMIT, Tools::buildPair($coin1, $coin2)))->limit;
    }

    /**
     * @see https://info.shapeshift.io/api#api-103
     *
     * @return stdClass[]
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function getWholeMarketInfo()
    {
        return $this->get(Resources::MARKET_INFO);
    }

    /**
     * @see https://info.shapeshift.io/api#api-103
     *
     * @param  $coin1
     * @param  $coin2
     * @return stdClass
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function getMarketInfo( $coin1,  $coin2)
    {
        return $this->get(sprintf('%s/%s', Resources::MARKET_INFO, Tools::buildPair($coin1, $coin2)));
    }

    /**
     * @see https://info.shapeshift.io/api#api-4
     *
     * @param int $max
     * @return stdClass[]
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function getRecentTransactionList($max)
    {
        return $this->get(sprintf('%s/%s', Resources::RECENT_TRANSACTIONS, $max));
    }

    /**
     * @see https://info.shapeshift.io/api#api-5
     *
     * @param  $address
     * @return stdClass
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function getStatusOfDepositToAddress( $address)
    {
        return $this->get(sprintf('%s/%s', Resources::RECENT_DEPOSIT_TRANSACTION_STATUS, $address));
    }

    /**
     * @see https://info.shapeshift.io/api#api-6
     *
     * @param  $address
     * @return int
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function getTimeRemaining( $address)
    {
        return (int)$this->get(sprintf('%s/%s', Resources::TIME_REMAINING, $address))->seconds_remaining;
    }

    /**
     * @see https://info.shapeshift.io/api#api-104
     *
     * @return stdClass
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function getSupportedCoins()
    {
        return $this->get(Resources::LIST_OF_SUPPORTED_COINS);
    }

    /**
     * @see https://info.shapeshift.io/api#api-105
     *
     * @param  $apiKey
     * @return stdClass[]
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function getListAOfTransactionsByApiKey( $apiKey)
    {
        return $this->get(sprintf('%s/%s', Resources::LIST_OF_TRANSACTIONS_WITH_API_KEY, $apiKey));
    }

    /**
     * @see https://info.shapeshift.io/#api-106
     *
     * @param  $address
     * @param  $apiKey
     * @return stdClass[]
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function getTransactionsByOutputAddress( $address,  $apiKey)
    {
        return $this->get(
            sprintf('%s/%s/%s', Resources::LIST_OF_TRANSACTIONS_WITH_API_KEY_BY_ADDRESS, $address, $apiKey)
        );
    }

    /**
     * @see https://info.shapeshift.io/#api-7
     *
     * @param  $withdrawalAddress
     * @param  $coin1
     * @param  $coin2
     * @param string|null $returnAddress
     * @param string|null $destinationTag
     * @param string|null $rsAddress
     * @param string|null $apiKey
     * @return array|stdClass
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function createTransaction(
         $withdrawalAddress,
         $coin1,
         $coin2,
         $returnAddress = null,
         $rsAddress = null,
         $destinationTag = null,
         $apiKey = null
    ) {
        $input = [
            'withdrawal' => $withdrawalAddress,
            'pair' => Tools::buildPair($coin1, $coin2, Tools::LOWERCASE),
            'returnAddress' => $returnAddress,
            'destTag' => $destinationTag,
            'rsAddress' => $rsAddress,
            'apiKey' => $apiKey,
        ];

        return $this->post(Resources::CREATE_TRANSACTION, $input);
    }

    /**
     * @see https://info.shapeshift.io/#api-8
     *
     * @param  $email
     * @param  $transactionId
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function requestEmailReceipt( $email,  $transactionId)
    {
        $this->post(Resources::REQUEST_RECEIPT, ['email' => $email, 'txid' => $transactionId]);
    }

    /**
     * @see https://info.shapeshift.io/#api-9
     *
     * @param  $amount
     * @param  $withdrawalAddress
     * @param  $coin1
     * @param  $coin2
     * @param string|null $returnAddress
     * @param string|null $rsAddress
     * @param string|null $destinationTag
     * @param string|null $apiKey
     * @return array|stdClass
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function createFixedAmountTransaction(
         $amount,
         $withdrawalAddress,
         $coin1,
         $coin2,
         $returnAddress = null,
         $rsAddress = null,
         $destinationTag = null,
         $apiKey = null
    ) {
        $input = [
            'withdrawal' => $withdrawalAddress,
            'pair' => Tools::buildPair($coin1, $coin2, Tools::LOWERCASE),
            'returnAddress' => $returnAddress,
            'destTag' => $destinationTag,
            'rsAddress' => $rsAddress,
            'apiKey' => $apiKey,
            'amount' => $amount,
        ];
        $result = $this->post(Resources::SEND_AMOUNT, $input);

        if (!isset($result->success)) {
            throw new NotValidResponseFromApiException('API responded with invalid structure.');
        }

        return $result->success;
    }

    /**
     * @see https://info.shapeshift.io/#api-108
     *
     * @param  $address
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function cancelTransaction( $address)
    {
        try {
            $result = $this->post(Resources::CANCEL_PENDING_TRANSACTION, ['address' => $address]);
        } catch (ApiErrorException $e) {
            throw new TransactionNotCancelledException($e->getMessage(), $e->getCode(), $e);
        }

        if (!isset($result->success) || $result->success !== ' Pending Transaction cancelled ') {
            throw new ApiErrorException('Canceling transaction failed.');
        }
    }

    /**
     * @see https://info.shapeshift.io/#api-107
     *
     * @param  $address
     * @param  $coin
     * @return stdClass
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    public function validateAddress( $address,  $coin)
    {
        $result = $this->get(sprintf('%s/%s/%s', Resources::VALIDATE_ADDRESS, $address, $coin));

        if (!isset($result->isValid) && isset($result->isvalid)) {
            $result->isValid = $result->isvalid;
            unset ($result->isvalid);
        }

        return $result;
    }

    /**
     * @param  $url
     * @return stdClass|array
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    private function get( $url)
    {
        return $this->request('GET', $url);
    }

    /**
     * @param  $url
     * @param array $formParams
     * @return array|stdClass
     * @throws RequestFailedException
     */
    private function post( $url, array $formParams)
    {
        return $this->request('POST', $url, ['form_params' => $formParams]);
    }

    /**
     * @param  $method
     * @param  $url
     * @param array $options
     * @return array|stdClass
     *
     * @throws RequestFailedException
     * @throws ApiErrorException
     */
    private function request( $method,  $url, array $options = [])
    {
        try {
            $response = $this->guzzleClient->request($method, $url, $options);
        } catch (RequestException $exception) {
            ResultProcessor::handleGuzzleRequestException($exception);
        }

        return ResultProcessor::processResult($url, $response);
    }

}
