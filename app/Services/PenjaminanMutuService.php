<?php

namespace App\Services;

use App\Models\PenjaminanMutu;
use Illuminate\Pagination\LengthAwarePaginator;

interface PenjaminanMutuService
{
    function add($nama, $keterangan): PenjaminanMutu;
    function list(string $key, int $size): LengthAwarePaginator;
    function update($nama, $ketarangan, $id): PenjaminanMutu;
    function delete(int $id): void;
}
