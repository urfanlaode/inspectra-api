<?php
return [
    'reference' => [
        'service_types' => \Domain\Reference\Imports\ServiceTypeImport::class,
        'scope_of_works' => \Domain\Reference\Imports\ScopeOfWorkImport::class,
        'uoms' => \Domain\Reference\Imports\UomImport::class,
        'locations' => \Domain\Reference\Imports\LocationImport::class,
        'allocations' => \Domain\Reference\Imports\AllocationImport::class,
        'owners' => \Domain\Reference\Imports\OwnerImport::class,
        'customers' => \Domain\Reference\Imports\CustomerImport::class,
        'conditions' => \Domain\Reference\Imports\ConditionImport::class,
        'item_categories' =>
            \Domain\Reference\Imports\ItemCategoryImport::class,
        'items' => \Domain\Reference\Imports\ItemImport::class,
        'lots' => \Domain\Reference\Imports\LotImport::class,
    ],
    'chunk_size' => env('IMPORT_CHUNK_SIZE', 500),
];
