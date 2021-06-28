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
        $data = [
            'kantor_id' => $this->request['kantor_id'],
            'jenis' => $this->request['jenis'],
            'no_warkah' => isset($row[1]) ? $row[1] : null,
            'tahun' => isset($row[2]) ? $row[2] : null,
            'album' => isset($row[3]) ? $row[3] : null,
            'desa'  => isset($row[4]) ? "{$row[4]}, {$row[5]}" : null,
            'ruang' => $this->request['ruang'],
            'rak'   => isset($row[6]) ? $row[6] : null,
            'baris' => isset($row[7]) ? $row[7] : null,
            'file_name' => $this->request['fileName'],
        ];
        return new Warkah($data);
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
