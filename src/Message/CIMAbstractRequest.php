<?php

namespace Omnipay\AuthorizeNet\Message;

/**
 * Authorize.Net CIM Abstract Request
 */
abstract class CIMAbstractRequest extends AIMAbstractRequest
{
    protected $xmlRootElement = null;

    // Need the below setters and getters for accessing this data within createCardRequest.send
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    public function getName()
    {
        return $this->getParameter('name');
    }

    public function setCustomerProfileId($value)
    {
        return $this->setParameter('customerProfileId', $value);
    }

    public function getCustomerProfileId()
    {
        return $this->getParameter('customerProfileId');
    }

    public function setCustomerPaymentProfileId($value)
    {
        return $this->setParameter('customerPaymentProfileId', $value);
    }

    public function getCustomerPaymentProfileId()
    {
        return $this->getParameter('customerPaymentProfileId');
    }

    public function getInvoiceNumber()
    {
        return $this->getParameter('invoiceNumber');
    }

    public function setInvoiceNumber($value)
    {
        return $this->setParameter('invoiceNumber', $value);
    }

    /**
     * Flag to force update consumer payment profile if duplicate is found
     *
     * @param $value
     *
     * @return $this
     */
    public function setForceCardUpdate($value)
    {
        return $this->setParameter('forceCardUpdate', $value);
    }

    public function getForceCardUpdate()
    {
        return $this->getParameter('forceCardUpdate');
    }

    /**
     * Create and return the base XML data required to create a new request
     *
     * @return mixed|\SimpleXMLElement
     */
    public function getBaseData()
    {
        $data = new \SimpleXMLElement("<" . $this->xmlRootElement . "/>");
        $data->addAttribute('xmlns', 'AnetApi/xml/v1/schema/AnetApiSchema.xsd');

        // Credentials
        $data->merchantAuthentication->name = $this->getApiLoginId();
        $data->merchantAuthentication->transactionKey = $this->getTransactionKey();

        return $data;
    }
}
