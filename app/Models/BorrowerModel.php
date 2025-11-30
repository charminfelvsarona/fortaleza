<?php

namespace App\Models;

use CodeIgniter\Model;

class BorrowerModel extends Model
{
    protected $table            = 'borrower';
    protected $primaryKey       = 'borrower_id';
    protected $allowedFields    = [
        'firstname', 'middlename', 'lastname', 
        'contact_no', 'address', 'email', 'tax_id'
    ];
    protected $useTimestamps = false;
}
