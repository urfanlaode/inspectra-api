<?php

namespace Domain\Reference\Imports;

use Domain\Reference\Data\ScopeOfWorkData;
use Domain\Reference\Repositories\ScopeOfWorkRepository;
use Domain\Reference\Repositories\ServiceTypeRepository;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class ScopeOfWorkImport implements
    ToCollection,
    WithHeadingRow,
    WithChunkReading
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ScopeOfWorkRepository $repo,
        protected ServiceTypeRepository $serviceTypeRepo,
    ) {}

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            try {
                $serviceTypeName = $row['service_type_name'] ?? null;
                $serviceType = $this->serviceTypeRepo->findByName(
                    $serviceTypeName,
                );
                $row['service_type_id'] = $serviceType?->id;

                $dto = ScopeOfWorkData::from($row);
                $this->repo->upsertFromData($dto);
            } catch (\Exception $e) {
                error_log('ScopeOfWork import failed ' . $e->getMessage());
            }
        }
    }

    public function chunkSize(): int
    {
        return config('imports.chunk_size', 500);
    }
}
