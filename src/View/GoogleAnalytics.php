<?php

namespace Nip\Helpers\View;

use ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce\Transaction;
use Nip\Config\ConfigAwareTrait;
use Nip\FlashData\FlashData;

/**
 * Class GoogleAnalytics
 * @package Nip\Helpers\View
 */
class GoogleAnalytics extends AbstractHelper
{
    use ConfigAwareTrait;

    protected $ga = null;

    public $transactions = null;

    protected $trackingId = null;

    protected $domain = null;

    protected $page;

    protected $operations = [];

    protected $flashMemory = null;

    /**
     * GoogleAnalytics constructor.
     */
    public function __construct()
    {
        $this->ga = new \ByTIC\GoogleAnalytics\Tracking\GoogleAnalytics();
    }

    /**
     * @return \ByTIC\GoogleAnalytics\Tracking\GoogleAnalytics|null
     */
    public function getGa()
    {
        return $this->ga;
    }

    /**
     * @param $id
     * @param null $trackerKey
     */
    public function setTrackingId($id, $trackerKey = null)
    {
        $this->ga->setTrackingId($id, $trackerKey);
    }

    /**
     * @param array $data
     * @see http://code.google.com/apis/analytics/docs/gaJS/gaJSApiEcommerce.html
     */
    public function addTransaction($data = [])
    {
        $this->transactions[$data['id']] = $data;

        $this->saveTransactionsInFlashMemory();
    }

    /**
     * @param array $data
     *
     * @see http://code.google.com/apis/analytics/docs/gaJS/gaJSApiEcommerce.html
     */
    public function addTransactionItem($data = [])
    {
        $this->transactions[$data['transactionId']]['items'][] = $data;

        $this->saveTransactionsInFlashMemory();
    }

    /**
     * @return FlashData
     */
    public function getFlashMemory()
    {
        if ($this->flashMemory == null) {
            $this->initFlashMemory();
        }

        return $this->flashMemory;
    }

    /**
     * @param FlashData $flashMemory
     */
    public function setFlashMemory($flashMemory)
    {
        $this->flashMemory = $flashMemory;
    }

    public function initFlashMemory()
    {
        $this->flashMemory = app('flash.data');
    }

    protected function saveTransactionsInFlashMemory()
    {
        $this->getFlashMemory()->add("analytics.transactions", json_encode($this->transactions));
    }

    /**
     * @return mixed
     */
    protected function getTransactionsInFlashMemory()
    {
        return json_decode($this->getFlashMemory()->get('analytics.transactions'), true);
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->setTrackingId($this->getTrackingId());
        $this->parseTransactions();

        return $this->ga->generateCode();
    }

    /**
     * @param string $trackerKey
     */
    public function parseTransactions($trackerKey = null)
    {
        $transactions = $this->getTransactions();

        if (count($transactions)) {
            foreach ($transactions as $transactionData) {
                $transaction = Transaction::createFromArray($transactionData);
                $this->ga->addTransaction($transaction, $trackerKey);
            }
        }
    }

    /**
     * @return null
     */
    public function getTransactions()
    {
        if ($this->transactions === null) {
            $this->transactions = $this->getTransactionsInFlashMemory();
        }

        return $this->transactions;
    }

    /**
     * @param string $method
     * @param array $params
     * @param string $position
     * @return $this
     */
    public function addOperation($method, $params = [], $position = 'below')
    {
        if ($position == 'prepend') {
            array_unshift($this->operations, [$method, $params]);
        } else {
            $this->operations[] = [$method, $params];
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->page ? "'$this->page'" : '';
    }

    /**
     * @param $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        if ($this->domain == null) {
            $this->initDomain();
        }

        return $this->domain;
    }

    /**
     * @param $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    protected function initDomain()
    {
        $domain = '';
        $config = $this->getConfig();
        if ($config->has('ANALYTICS.domain')) {
            $domain = $config->get('ANALYTICS.domain');
        }
        $this->setDomain($domain);
    }

    /**
     * @return null|string
     */
    public function getTrackingId()
    {
        if ($this->trackingId == null) {
            $this->initUA();
        }

        return $this->trackingId;
    }

    protected function initUA()
    {
        $ua = '';
        $config = $this->getConfig();
        if ($config->has('analytics.tracking_id')) {
            $ua = $config->get('analytics.tracking_id');
        }
        $this->setTrackingId($ua);
    }
}
