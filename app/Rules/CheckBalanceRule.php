<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class CheckBalanceRule implements ValidationRule
{
    /**
     * The current balance.
     *
     * @var float
     */
    private $balance;
    private $type;

    public function __construct(float $balance,string $type)
    {
        $this->balance = $balance;
        $this->type = $type;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->type==="transaction"){
            if($value>$this->balance){
                $fail('you don\'t have enaught balance');
            }
        }
        //if(!($value >= 1980 && $value <= date('Y'))){
        //    $fail('The :attribute must be between 1980 to '.date('Y').'.');
        //}
    }
}