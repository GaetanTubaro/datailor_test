<?php

namespace App\DTO;

use App\Repository\DeliveryOrderRepository;
use DateTime;

class DeliveryEnquiry
{
    private ?int $orderId;

    private ?int $numberOrder;

    private ?DateTime $orderDate;

    private ?DateTime $deliveryEnquiry;

    private ?int $userId;

    private ?bool $deliveryValidate;

    /**
     * Get the value of orderId
     *
     * @return ?int
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * Set the value of orderId
     *
     * @param ?int $orderId
     *
     * @return self
     */
    public function setOrderId(?int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get the value of numberOrder
     *
     * @return ?int
     */
    public function getNumberOrder(): ?int
    {
        return $this->numberOrder;
    }

    /**
     * Set the value of numberOrder
     *
     * @param ?int $numberOrder
     *
     * @return self
     */
    public function setNumberOrder(?int $numberOrder): self
    {
        $this->numberOrder = $numberOrder;

        return $this;
    }

    /**
     * Get the value of orderDate
     *
     * @return ?DateTime
     */
    public function getOrderDate(): ?DateTime
    {
        return $this->orderDate;
    }

    /**
     * Set the value of orderDate
     *
     * @param ?DateTime $orderDate
     *
     * @return self
     */
    public function setOrderDate(?DateTime $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get the value of userId
     *
     * @return ?int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @param ?int $userId
     *
     * @return self
     */
    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of deliveryEnquiry
     *
     * @return ?DateTime
     */
    public function getDeliveryEnquiry(): ?DateTime
    {
        return $this->deliveryEnquiry;
    }

    /**
     * Set the value of deliveryEnquiry
     *
     * @param ?DateTime $deliveryEnquiry
     *
     * @return self
     */
    public function setDeliveryEnquiry(?DateTime $deliveryEnquiry): self
    {
        $this->deliveryEnquiry = $deliveryEnquiry;

        return $this;
    }

    public function timeDiff(DateTime $time1, DateTime $time2)
    {
        if ($time1 > $time2) {

            return false;
        } else {
            if ($time1->diff($time2)->d <= 2) {

                return false;
            } else {

                return true;
            }
        }
    }

    /**
     * Get the value of deliveryValidate
     *
     * @return ?bool
     */
    public function getDeliveryValidate(): ?bool
    {
        return $this->deliveryValidate;
    }

    /**
     * Set the value of deliveryValidate
     *
     * @param ?bool $deliveryValidate
     *
     * @return self
     */
    public function setDeliveryValidate(?bool $deliveryValidate): self
    {
        $this->deliveryValidate = $deliveryValidate;

        return $this;
    }
}
