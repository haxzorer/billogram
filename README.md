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

For the authentication :


$httpClientConfigurator = new HttpClientConfigurator(new HttplugClient());
$httpClientConfigurator->setAuth('your Api username', 'your Api  password');
$apiClient = BillogramClient::create($httpClientConfigurator);



For example if you need to add a new invoice with a new costumer and a new item : 
    
1- to create the models :
*create a new Costumer object (src/Model/Costumer)
*create a new Item object (src/Model/Item) 

2- to send Http request :
```php
$customercreated = $apiClient->customers()->create($customer);
$itemCreated = $apiClient->items()->create($item);
$itemOfinvoice = new src/Model/Invoice/Item();
$itemOfinvoice = $itemOfinvoice->withItemNo($itemCreated->getItemNo());
$itemOfinvoice = $itemOfinvoice->withCount(2)
$itemOfinvoice = $itemOfinvoice->withDiscount(1)
$invoice = new src/Model/Invoice/Invoice();
$invoice = $invoice->withCustomer($customer);
$invoice = $invoice->withItems([$itemOfinvoice]);
$invoice = $invoice->withInvoiceDate('2013-11-14');
$cacheClient = $this->getHttpClient();
$invoiceCreated = $apiClient->invoices()->create($invoice);
```
## Examples
This repository contains an example API client for FakeTwitter. The API for FakeTwitter has the following endpoints.

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