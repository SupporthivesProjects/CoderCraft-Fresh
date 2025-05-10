<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatewayHistory extends Model
{
    protected $table = 'gateway_history';
    public $timestamps = false;

    protected $fillable = [
        'TransactionID',
        'MerchantRef',
        'TransTypeID',
        'Currency',
        'Amount',
        'BusinessCase',
        'Descriptor',
        'Bank',
        'ResponseCode',
        'ResponseDescription',
        'BankCode',
        'BankDescription',
        'Signature'
    ];

    public function isSuccessful()
    {
        return $this->ResponseCode === 0;
    }

    public function getFormattedAmount()
    {
        return number_format($this->Amount / 100, 2);
    }

    public static function storeTransaction($request, $currencyCode)
    {
        return self::create([
            'TransactionID' => $request->TransactionID,
            'MerchantRef' => $request->MerchantRef,
            'TransTypeID' => $request->TransTypeID,
            'Currency' => $currencyCode,
            'Amount' => $request->Amount,
            'BusinessCase' => $request->BusinessCase ?? 'DummyWS',
            'Descriptor' => $request->Descriptor ?? 'DummyDescriptor',
            'Bank' => $request->Bank ?? 'DummyBank',
            'ResponseCode' => $request->ResponseCode,
            'ResponseDescription' => $request->ResponseDescription,
            'BankCode' => $request->BankCode ?? 'DummyBankCode',
            'BankDescription' => $request->BankDescription ?? 'DummyBankDescription',
            'Signature' => $request->Signature
        ]);
    }
}
