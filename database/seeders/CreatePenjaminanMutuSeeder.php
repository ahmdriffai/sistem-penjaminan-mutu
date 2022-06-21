<?php

namespace Database\Seeders;

use App\Models\PenjaminanMutu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatePenjaminanMutuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = ['Manual Mutu', 'Standar Operasional Prosedur', 'Intruksi Kerja'];

        foreach ($list as $value) {
            $penjaminanMutu = new PenjaminanMutu([
                'nama' => $value,
                'keterangan' => '-',
            ]);
            $penjaminanMutu->save();
        }
    }
}
