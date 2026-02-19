<?php

namespace Domain\Reference\Services;

use Domain\Reference\Repositories\AllocationRepository;
use Domain\Reference\Repositories\ConditionRepository;
use Domain\Reference\Repositories\CustomerRepository;
use Domain\Reference\Repositories\ItemCategoryRepository;
use Domain\Reference\Repositories\ItemRepository;
use Domain\Reference\Repositories\LocationRepository;
use Domain\Reference\Repositories\LotRepository;
use Domain\Reference\Repositories\OwnerRepository;
use Domain\Reference\Repositories\ScopeOfWorkRepository;
use Domain\Reference\Repositories\ServiceTypeRepository;
use Domain\Reference\Repositories\UomRepository;

class ReferenceService
{
    public function __construct(
        protected ServiceTypeRepository $serviceTypeRepo,
        protected ScopeOfWorkRepository $scopeRepo,
        protected ItemCategoryRepository $categoryRepo,
        protected ItemRepository $itemRepo,
        protected LotRepository $lotRepo,
        protected AllocationRepository $allocationRepo,
        protected OwnerRepository $ownerRepo,
        protected ConditionRepository $conditionRepo,
        protected UomRepository $uomRepo,
        protected LocationRepository $locationRepo,
        protected CustomerRepository $customerRepo,
    ) {}

    public function dropdowns()
    {
        return [
            'service_types' => $this->serviceTypeRepo->allSelect(),
            'scope_of_works' => $this->scopeRepo->allSelect(),
            'item_categories' => $this->categoryRepo->allSelect(),
            'items' => $this->itemRepo->allSelect(),
            'allocations' => $this->allocationRepo->allSelect(),
            'owners' => $this->ownerRepo->allSelect(),
            'conditions' => $this->conditionRepo->allSelect(),
            'uoms' => $this->uomRepo->allSelect(),
            'locations' => $this->locationRepo->allSelect(),
            'customers' => $this->customerRepo->allSelect(),
        ];
    }

    public function lots()
    {
        return $this->lotRepo->allSelect();
    }

    public function items()
    {
        return $this->itemRepo->allSelect();
    }
}
