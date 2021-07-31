<?php

namespace App\Domains\Budgets\Repositories;

use App\Domains\Budgets\Budget;
use App\Domains\Budgets\Contracts\BudgetRepositoryContract;
use App\Domains\Budgets\UseCases\Data\BudgetInputData;
use Illuminate\Support\Str;

class BudgetRepositoryMemory implements BudgetRepositoryContract
{
    protected $budgets = [];

    public function saveBudget(BudgetInputData $inputData): Budget
    {
        $budget = $inputData->budget;
        $budget->id = Str::uuid()->toString();

        $this->budgets[] = $budget;

        return $budget;
    }

    public function findById($id): null|Budget
    {
        return collect($this->budgets)->first(fn($budget) => $budget->id === $id);
    }
}
