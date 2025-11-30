<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $DBGroup = 'default';

    // Count active loans (status = 2)
    public function countActiveLoans()
    {
        return $this->db->table('loan')->where('status', 2)->countAllResults();
    }

    // Get total payments made today
    public function getPaymentsToday()
    {
        $builder = $this->db->table('payment');
        $builder->selectSum('pay_amount', 'total');
        $builder->where('DATE(date_created)', date('Y-m-d'));
        $query = $builder->get()->getRow();
        return $query ? $query->total : 0;
    }

    // Count all borrowers
    public function countBorrowers()
    {
        return $this->db->table('borrower')->countAllResults();
    }
}
