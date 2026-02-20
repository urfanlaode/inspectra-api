<?php

namespace Domain\Inspection\Repositories;

use Domain\Inspection\Data\GetInspectionsData;
use Domain\Inspection\Enums\InspectionStatus;
use Domain\Inspection\Models\Inspection;
use Domain\Inspection\Data\InspectionData;
use Domain\Reference\Models\Lot;
use Illuminate\Support\Facades\DB;

class InspectionRepository implements InspectionRepositoryInterface
{
    public function __construct() {}

    public function generateInspectionNo()
    {
        return 'REQ-' . now()->format('Ymd') . '-' . rand(1000, 9999);
    }

    public function storeFromData(InspectionData $data): Inspection
    {
        $data->inspection_no = $this->generateInspectionNo();

        return DB::transaction(function () use ($data) {
            $status =
                $data->status == InspectionStatus::DRAFT
                    ? InspectionStatus::DRAFT
                    : InspectionStatus::NEW;

            $inspection = Inspection::create([
                'inspection_no' => $data->inspection_no,
                'service_type_id' => $data->service_type_id,
                'scope_of_work_id' => $data->scope_of_work_id,
                'location_id' => $data->location_id,
                'customer_id' => $data->customer_id,
                'is_customer_charged' => $data->is_customer_charged,
                'dc_code' => $data->dc_code,
                'estimated_completion_date' => $data->estimated_completion_date,
                'status' => $status,
                'note' => $data->note,
            ]);

            foreach ($data->items as $itemData) {
                $item = $inspection->items()->create([
                    'item_id' => $itemData->item_id,
                    'qty_requested' => $itemData->qty_requested,
                ]);

                foreach ($itemData->lots as $lotData) {
                    $lot = Lot::findOrFail($lotData->lot_id);

                    $item->lots()->create([
                        'lot_id' => $lotData->lot_id,
                        'qty_required' => $lotData->qty_required,
                        'available_qty_snapshot' => $lot->qty,
                    ]);
                }
            }

            return $inspection->load('items.lots');
        });
    }

    public function updateFromData(
        Inspection $inspection,
        InspectionData $data,
    ): Inspection {
        return DB::transaction(function () use ($inspection, $data) {
            $status =
                $data->status == InspectionStatus::DRAFT
                    ? InspectionStatus::DRAFT
                    : InspectionStatus::READY_FOR_REVIEW;

            $inspection->update([
                'scope_of_work_id' => $data->scope_of_work_id,
                'location_id' => $data->location_id,
                'customer_id' => $data->customer_id,
                'is_customer_charged' => $data->is_customer_charged,
                'dc_code' => $data->dc_code,
                'estimated_completion_date' => $data->estimated_completion_date,
                'status' => $status,
                'note' => $data->note,
            ]);

            $inspection->items()->delete();

            foreach ($data->items as $itemData) {
                $item = $inspection->items()->create([
                    'item_id' => $itemData->item_id,
                    'qty_requested' => $itemData->qty_requested,
                ]);

                $item->lots()->delete();

                foreach ($itemData->lots as $lotData) {
                    $lot = Lot::findOrFail($lotData->lot_id);

                    $item->lots()->create([
                        'lot_id' => $lotData->lot_id,
                        'qty_required' => $lotData->qty_required,
                        'available_qty_snapshot' => $lot->qty,
                    ]);
                }
            }

            return $inspection->load('items.lots');
        });
    }

    public function allWithLots(?GetInspectionsData $data = null)
    {
        $query = Inspection::with([
            'service_type:id,name',
            'scope_of_work:id,name',
            'location:id,name',
            'customer:id,name',
            'lots' => function ($q) {
                $q->with([
                    'lot' => function ($q) {
                        $q->with(['item', 'owner']);
                    },
                ]);
            },
        ]);

        $statuses = $data?->statuses();

        if (!empty($statuses)) {
            $query->whereIn('status', $statuses);
        }

        return $query->get();
    }

    public function findByIdWithLots(int $id)
    {
        return Inspection::with([
            'service_type:id,name',
            'scope_of_work:id,name,description',
            'location:id,name',
            'customer:id,name',
            'items' => function ($q) {
                $q->with(['item', 'lots']);
            },
            'lots' => function ($q) {
                $q->with([
                    'lot' => function ($q) {
                        $q->with(['item', 'owner', 'condition', 'allocation']);
                    },
                ]);
            },
        ])->find($id);
    }

    public function findById(int $id)
    {
        return Inspection::find($id);
    }
}
