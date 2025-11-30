<?php

namespace App\Models;
use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'loan_id';

    protected $allowedFields = [
        'user_id',
        'ltype_id',
        'lplan_id',
        'amount',
        'status',
        'created_at'
    ];

    public function getAllLoansWithDetails()
    {
        return $this->select('loans.*, user.firstname, user.lastname, loan_type.ltype_name, loan_plan.lplan_month')
                    ->join('user', 'user.user_id = loans.user_id', 'left')
                    ->join('loan_type', 'loan_type.ltype_id = loans.ltype_id', 'left')
                    ->join('loan_plan', 'loan_plan.lplan_id = loans.lplan_id', 'left')
                    ->findAll();
    }

    public function getLoanById($id)
    {
        return $this->select('loans.*, user.firstname, user.lastname, loan_type.ltype_name, loan_plan.lplan_month, loan_plan.lplan_interest')
                    ->join('user', 'user.user_id = loans.user_id', 'left')
                    ->join('loan_type', 'loan_type.ltype_id = loans.ltype_id', 'left')
                    ->join('loan_plan', 'loan_plan.lplan_id = loans.lplan_id', 'left')
                    ->where('loans.loan_id', $id)
                    ->first();
    }
}
