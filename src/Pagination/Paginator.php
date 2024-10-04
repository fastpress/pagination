<?php

namespace Fastpress\Pagination;

/**
 * Class Paginator
 *
 * Provides pagination functionality.
 */
class Paginator
{
    /**
     * Total number of records.
     *
     * @var int
     */
    private int $totalRecords;

    /**
     * Current page number.
     *
     * @var int
     */
    private int $currentPage;

    /**
     * Records per page limit.
     *
     * @var int
     */
    private int $limit;

    /**
     * Total number of pages.
     *
     * @var int
     */
    private int $totalPages;

    /**
     * Constructor.
     *
     * @param int $totalRecords Total number of records.
     * @param int $currentPage Current page number.
     * @param int $limit Records per page limit.
     */
    public function __construct(int $totalRecords, int $currentPage, int $limit)
    {
        $this->totalRecords = $totalRecords;
        $this->currentPage = $currentPage;
        $this->limit = $limit;
        $this->totalPages = (int)ceil($totalRecords / $limit);
    }

    /**
     * Gets pagination data.
     *
     * @return array Pagination data.
     */
    public function getPaginationData(): array
    {
        return [
            'current_page_number' => $this->currentPage,
            'total_records' => $this->totalRecords,
            'total_records_remaining' => $this->getTotalRecordsRemaining(),
            'total_pages' => $this->totalPages,
            'limit' => $this->limit,
            'has_next_page' => $this->hasNextPage(),
            'has_prev_page' => $this->hasPrevPage(),
            'next_page' => $this->getNextPage(),
            'previous_page' => $this->getPreviousPage(),
            'display_pages' => $this->getDisplayPages()
        ];
    }

    /**
     * Gets the total number of remaining records.
     *
     * @return int Total number of remaining records.
     */
    private function getTotalRecordsRemaining(): int
    {
        return max($this->totalRecords - ($this->currentPage * $this->limit), 0);
    }

    /**
     * Checks if there is a next page.
     *
     * @return bool True if there is a next page, false otherwise.
     */
    private function hasNextPage(): bool
    {
        return $this->currentPage < $this->totalPages;
    }

    /**
     * Checks if there is a previous page.
     *
     * @return bool True if there is a previous page, false otherwise.
     */
    private function hasPrevPage(): bool
    {
        return $this->currentPage > 1;
    }

    /**
     * Gets the next page number.
     *
     * @return int|null Next page number, or null if there is no next page.
     */
    private function getNextPage(): ?int
    {
        return $this->hasNextPage() ? $this->currentPage + 1 : null;
    }

    /**
     * Gets the previous page number.
     *
     * @return int|null Previous page number, or null if there is no previous page.
     */
    private function getPreviousPage(): ?int
    {
        return $this->hasPrevPage() ? $this->currentPage - 1 : null;
    }

    /**
     * Gets the pages to display.
     *
     * @return array Pages to display.
     */
    private function getDisplayPages(): array
    {
        $start = max($this->currentPage - 2, 1);
        $end = min($start + 4, $this->totalPages);
        $start = max($end - 4, 1);

        return range($start, $end);
    }
}