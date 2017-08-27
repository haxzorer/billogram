Billogram v2 API Client
=======================

[![Latest Version](https://img.shields.io/github/release/FriendsOfApi/billogram.svg?style=flat-square)](https://github.com/FriendsOfApi/billogram/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/FriendsOfApi/billogram.svg?style=flat-square)](https://travis-ci.org/FriendsOfApi/billogram)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/friendsofapi/billogram.svg?style=flat-square)](https://scrutinizer-ci.com/g/friendsofapi/billogram)
[![Quality Score](https://img.shields.io/scrutinizer/g/friendsofapi/billogram.svg?style=flat-square)](https://scrutinizer-ci.com/g/friendsofapi/billogram)
[![Total Downloads](https://img.shields.io/packagist/dt/friendsofapi/billogram.svg?style=flat-square)](https://packagist.org/packages/friendsofapi/billogram)
#Getting Started

The Billogram API is built according to RESTful principles, which means it uses HTTP as an application protocol.
This library available for PHP. It have code examples which are easy to use but we recommend also to visit the documentation.
The following Client Library are central to the use of the Billogram service:

* Customers
* Items
* Invoices
* Settingd
* LogoType
* Report

 
## Installation:
    Via Composer
    
    composer require billogram/billogram_api
    

## Usage 

First you need to register an account. it's recommend that you sign up on Billogram sandbox environment
[Sandbox Billogram](https://billogram.com) or on [Billogram](https://billogram.com) ,then generate an API user
    
##### 1- How to Authentify to api :

After you have generated an API user you need to create a BillogramClient and pass your user and the password to the static create function
```php
$billogramClient = BillogramClient::create(userName,password);
```

##### 2- Example :
* How to create a customer :

```php
$contact = CustomerContact::createFromArray(['name' => 'ib92g', 'email' => 'ib922@gmail.com', 'phone' => '0712223344']);
$addressCustomer = CustomerBillingAddress::createFromArray(['careof' => 'ibrahim', 'use_careof_as_attention' => false, 'street_address' => 'Flygarvägen 189B', 'zipcode' => '175 69', 'city' => 'Järfälla', 'country' => 'SE']);
$addressDelivery = CustomerDeliveryAddress::createFromArray(['name' => 'ibrahim', 'street_address' => 'Flygarvägen 189B', 'careof' => 'ibrahim', 'zipcode' => '175 69', 'city' => 'Järfälla', 'country' => 'SE']);
$customer = new Model();
$customer = $customer->withCustomerNo(1);
$customer = $customer->withName('Ibrahim AA');
$customer = $customer->withNotes('aa');
$customer = $customer->withOrgNo('556801-7155');
$customer = $customer->withVatNo('SE556677889901');
$customer = $customer->withContact($contact);
$customer = $customer->withAddress($addressCustomer);
$customer = $customer->withDeliveryAddress($addressDelivery);
$customer = $customer->withCompanyType('individual');
$billogramClient = BillogramClient::create(userName,password);
$customerFinal = $billogramClient->customers()->create($customer);
```
* How to get a customer

```php
$billogramClient = BillogramClient::create(userName,password);
$customerFetched = $apiClient->customers()->fetch($customerNo, ['customer_no']);
return $customerFetched;
    
```

* how to create an item
```php
$bookkeeping = Bookkeeping::createFromArray(['income_account' => '302', 'vat_account' => '303']);
$item = new Item();
$item = $item->withTitle('cc');
$item = $item->withDescription('cc');
$item = $item->withPrice(12);
$item = $item->withVat(12);
$item = $item->withUnit('hour');
$item = $item->withBookkeeping($bookkeeping);
$billogramClient = BillogramClient::create(userName,password);
$itemCreated = $billogramClient->items()->create($item);
```

* How to fetch the items:
```php
$billogramClient = BillogramClient::create(userName,password);
$items = $apiClient->items()->search(['page' => 1]);
```

* How to delete an item
```php
$billogramClient = BillogramClient::create(userName,password);
$billogramClient->items()->delete($itemNo);
```

* How to create an invoice
We consider that you have created a customer and an item (Seed the docs above) and you will you them to create a new invoice:

```php
$billogramClient = BillogramClient::create(userName,password);
$customerFetched = $billogramClient->customers()->fetch($customerNo);

$billogramClient = BillogramClient::create(userName,password);
$itemFetched = $billogramClient->items()->fetch($itemNo);

$itemOfinvoice = new src/Model/Invoice/Item();
$itemOfinvoice = $itemOfinvoice->withItemNo($itemFetched->getItemNo());
$itemOfinvoice = $itemOfinvoice->withCount(2)
$itemOfinvoice = $itemOfinvoice->withDiscount(1)
$invoice = new src/Model/Invoice/Invoice();
$invoice = $invoice->withCustomer($customerFetched);
$invoice = $invoice->withItems([$itemOfinvoice]);
$invoice = $invoice->withInvoiceDate('2013-11-14');

$billogramClient = BillogramClient::create(userName,password);
$invoiceCreated = $billogramClient->invoices()->create($invoice);
```

* How to update the default setting of business account
```php
$setting = new Setting();
$contact = Contact::createFromArray(['name' => 'Ib92', 'phone' => '0712345678', 'email' => 'tarafder.saptad@pig.pp.ua', 'www' => 'https://www.youtube.com/']);
$address = BusinessAddress::createFromArray(['street_address' => 'Finlandsgatan 36', 'careof' => 'Microsoft', 'zipcode' => '164 74', 'city' => 'Kista', 'country' => 'Sweden']);
$invoiceAddress = InvoiceAddress::createFromArray(['street_address' => 'Finlandsgatan 36', 'careof' => 'Microsoft', 'zipcode' => '164 74', 'city' => 'Kista', 'country' => 'Sweden', 'email' => 'tarafder.saptad@pig.pp.ua']);
$visitingAddress = VisitingAddress::createFromArray(['street_address' => 'Finlandsgatan 36', 'careof' => 'Microsoft', 'zipcode' => '164 74', 'city' => 'Kista', 'country' => 'Sweden']);
$payment = PaymentSetting::createFromArray(['bankgiro' => '', 'plusgiro' => '', 'domestic_bank_account' => ['account_no' => '', 'clearing_no' => ''], 'international_bank_account' => ['bank' => '', 'iban' => '', 'bic' => '', 'swift' => '']]);
$tax = TaxSetting::createFromArray(['is_vat_registered' => '', 'has_fskatt' => '', 'vat_no' => '']);
$bookkeeping = BookkeepingSetting::createFromArray(['income_account_for_vat_25' => '', 'income_account_for_vat_12' => '', 'income_account_for_vat_6' => '', 'income_account_for_vat_0' => '', 'reversed_vat_account' => '', 'vat_account_for_vat_25' => '',
                                'vat_account_for_vat_12' => '', 'vat_account_for_vat_6' => '', 'account_receivable_account' => '', 'client_funds_account' => '', 'banking_account' => '', 'interest_fee_account' => '', 'reminder_fee_account' => '',
                                'rounding_account' => '', 'factoring_receivable_account' => '', 'non_allocated_account' => '', 'income_payout_account' => '', 'written_down_receivables_account' => '', 'expected_loss_account' => '',
                                'regional_sweden' => ['rotavdrag_account' => ''], ]);
$invoices = InvoiceDefaults::createFromArray(['default_message' => 'hey hey', 'default_messagedefault_message' => 8.5, 'default_reminder_fee' => 10, 'default_invoice_fee' => 30,
                                'automatic_reminders' => ['delay_days' => 5, 'message' => 'HEY'],
                                'automatic_writeoff' => ['settings' => 'all_fees', 'amount' => 100],
                                'automatic_collection' => ['delay_days' => 5, 'amount' => 100], ]);
$setting = $setting->withName('debg');
$setting = $setting->withOrgNo('556667-0591');
$setting = $setting->withContact($contact);
$setting = $setting->withBusinessAddress($address);
$setting = $setting->withVisitingAddress($visitingAddress);
$setting = $setting->withInvoiceAddress($invoiceAddress);
$setting = $setting->withPayment($payment);
$setting = $setting->withTax($tax);
$setting = $setting->withBookkeeping($bookkeeping);
$setting = $setting->withInvoices($invoices);

$billogramClient = BillogramClient::create(userName,password);
 $settingFinal = $billogramClient->settings()->update($setting);
```
## Endpoints
This repository contains an example API client for Billogram. The API for Billogram has the following endpoints

| Method | URI | Parameters |
| ------ | --- | ---------- |
| GET | api/v2/customer | (array) param |
| GET | api/v2/customer/{id} | (array) param |
| POST | api/v2/customer | (Customer) customer |
| PUT | api/v2/customer/{id} | (Customer) customer |
| GET | api/v2/item | (array) param |
| GET | api/v2/item/{id} | (array) param |
| POST | api/v2/item | (Item) item |
| PUT | api/v2/item/{id} | (Item) item |
| Delete | api/v2/item/{id} | |
| GET | api/v2/item | (array) param |
| GET | api/v2/item/{id} | (array) param |
| POST | api/v2/item | (Item) item |
| PUT | api/v2/item/{id} | (Item) item |
| Delete | api/v2/item/{id} | |
| GET | api/v2/settings |  |
| PUT | api/v2/settings | (Item) item |
| GET | api/v2/logotype |  |
| POST | api/v2/logotype | (Item) item |
| GET | api/v2/report | (array) param |
| GET | api/v2/report/{filename} |  |


## Documentation
Read the [Billogram documentation](https://billogram.com/api/documentation) 

## Contribute

Do you want to make a change? Pull requests are welcome.