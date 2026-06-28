<?php

declare(strict_types=1);

namespace Molitor\Tinyurl\DataTables;

use Molitor\Admin\DataTables\DataTable;
use Molitor\Tinyurl\Http\Resources\TinyurlResource;
use Molitor\Tinyurl\Models\Tinyurl;

class TinyurlDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return Tinyurl::class;
    }

    protected function getResourceClass(): string
    {
        return TinyurlResource::class;
    }

    protected function initColumns(): void
    {
        $this->addColumn('slug')->setLabel('Slug')->setSearchable()->setOrderable();
        $this->addColumn('url')->setLabel('URL')->setSearchable()->setOrderable();
    }
}
