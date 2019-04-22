<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class ApplyJbp extends Model
{
    protected $table = 'dx_apply_jbp';

    protected $fillable =  [
        'name',
        'sex',
        'birthday',
        'address',
        'venture_years',
        'identity',
        'mobile',
        'weixin',
        'email',
        'graduate_scholl',
        'education_background',
        'company',
        'position',
        'establish',
        'staff_number',
        'company_address',
        'financing_phases',
        'income',
        'market_value',
        'investor',
        'operation_state',
        'expectation',
        'interest_jbp',
        'interest_in',
        'pay_attention',
        'referrer',
        'referrer_mobile'];



}
