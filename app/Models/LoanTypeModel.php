<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanTypeModel extends Model
{
    protected $table            = 'loan_type';
    protected $primaryKey       = 'ltype_id';
    protected $allowedFields    = ['ltype_name', 'ltype_desc'];
    protected $useTimestamps    = false;
}
