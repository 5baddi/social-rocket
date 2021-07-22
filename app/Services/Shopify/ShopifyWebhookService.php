<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Services\Shopify;

class ShopifyWebhookService extends ShopifyService
{
    public const BILLING_SUCCESS_WEBHOOK = "subscription_billing_attempts/success";
    public const BILLING_FAILURE_WEBHOOK = "subscription_billing_attempts/failure";
    public const CUSTOMER_UPDATED_WEBHOOK = "customers/update";
    public const CUSTOMER_DISABLED_WEBHOOK = "customers/disable";
    public const CUSTOMER_ENABLED_WEBHOOK = "customers/enable";
    public const DOMAIN_UPDATED_WEBHOOK = "domains/update";
    public const DOMAIN_DESTROYED_WEBHOOK = "domains/destroy";
    public const ORDER_CANCELLED_WEBHOOK = "orders/cancelled";
    public const ORDER_PAID_WEBHOOK = "orders/paid";
    public const ORDER_UPDATED_WEBHOOK = "orders/updated";
    public const SHOP_UPDATED_WEBHOOK = "shop/update";
    public const PRODUCT_UPDATED_WEBHOOK = "products/update";
}