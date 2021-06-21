<?php

namespace App\Imports;

use App\Warkah;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class WarkahImport implements ToModel, WithStartRow, SkipsOnError, SkipsOnFailure
{
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function model(array $row)
    {
        return new Warkah([
            'kantor_id' => $this->request['kantor_id'],
            'jenis' => $this->request['jenis'],
            'no_warkah' => $row[1],
            'tahun' => $row[2],
            'album' => $row[3],
            'desa'  => "{$row[4]}, {$row[5]}" ,
            'ruang' => $this->request['ruang'],
            'rak'   => $row[6],
            'baris' => $row[7],
            'file_name' => $this->request['fileName'],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function onError(Throwable $error)
    {
        dd($error);
    }

    public function onFailure(Failure ...$failures) //
    {
        dd($failures);
    }
}
