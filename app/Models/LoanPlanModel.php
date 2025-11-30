<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanPlanModel extends Model
{
    protected $table            = 'loan_plan';
    protected $primaryKey       = 'lplan_id';
    protected $allowedFields    = ['lplan_month', 'lplan_interest', 'lplan_penalty'];
}
