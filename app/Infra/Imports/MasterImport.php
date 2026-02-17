<?php

namespace App\Infra\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MasterImport implements WithMultipleSheets
{
    protected array $sheetMap;

    /**
     * @param array $sheetMap
     */
    public function __construct(array $sheetMap)
    {
        $this->sheetMap = $sheetMap;
    }

    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->sheetMap as $sheetName => $importClass) {
            $sheets[$sheetName] = app($importClass);
        }
        return $sheets;
    }
}
