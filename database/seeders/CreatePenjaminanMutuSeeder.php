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
        $list = ['Intruksi Kerja','Standar Operasional Prosedur', 'Manual Mutu'];
        $icon = ['IK.png','sop.png', 'MM.png'];

        for ($i=0; $i < count($list) ; $i++) { 
            $penjaminanMutu = new PenjaminanMutu([
                'nama' => $list[$i],
                'keterangan' => '-',
                'icon' => $icon[$i],
            ]);
            $penjaminanMutu->save();
        }
    }
}
