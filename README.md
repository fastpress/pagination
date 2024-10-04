# Paginator

A PHP Pagination Library

The Paginator class provides a simple and efficient way to implement pagination in your PHP applications. It handles the calculation of page numbers, total records, and other related information, making it easy to create paginated interfaces.

## Installation

To use the Paginator library, you can install it using Composer:

```bash
composer require fastpress/pagination
```
## Usage
Create a new Paginator instance:
```php
use Fastpress\Pagination\Paginator;

$paginator = new Paginator(100, 3, 10);
// 100: Total number of records.
// 3: Current page number.
// 10: Records per page limit.
```

Get pagination data:
```
php
$paginationData = $paginator->getPaginationData();
```

The $paginationData array will contain the following information:
 - current_page_number: The current page number.
- total_records: The total number of records.
- total_records_remaining: The number of remaining records.
- total_pages: The total number of pages.
- limit: The records per page limit.
- has_next_page: Whether there is a next page.
- has_prev_page: Whether there is a previous page.
- next_page: The next page number (if available).
- previous_page: The previous page number (if available).
- display_pages: An array of page numbers to display in the pagination controls.

## Example
```php
<?php

use Fastpress\Pagination\Paginator;

// Assuming you have a query that fetches data from a database
$totalRecords = 500;
$currentPage = 3;
$limit = 10;

$paginator = new Paginator($totalRecords, $currentPage, $limit);
$paginationData = $paginator->getPaginationData();

// Use the pagination data to render your pagination controls and display the data
```

