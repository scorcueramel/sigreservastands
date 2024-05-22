<?php

namespace Database\Seeders;

use App\Models\Stand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $stands = [
            'STAND N°1',
            'STAND N°2',
            'STAND N°3',
            'STAND N°4',
            'STAND N°5',
            'STAND N°6',
            'STAND N°7',
            'STAND N°8',
            'STAND N°9',
            'STAND N°10',
            'STAND N°11',
            'STAND N°12',
            'STAND N°13',
            'STAND N°14',
            'STAND N°15',
            'STAND N°16',
            'STAND N°17',
            'STAND N°18',
            'STAND N°19',
            'STAND N°20',
            'STAND N°21',
            'STAND N°22',
            'STAND N°23',
            'STAND N°24',
            'STAND N°25',
            'STAND N°26',
            'STAND N°27',
            'STAND N°28',
            'STAND N°29',
            'STAND N°30',
            'STAND N°31',
            'STAND N°32',
            'STAND N°33',
            'STAND N°34',
            'STAND N°35',
            'STAND N°36',
            'STAND N°37',
            'STAND N°38',
            'STAND N°39',
            'STAND N°40',
            'STAND N°41',
            'STAND N°42',
            'STAND N°43',
            'STAND N°44',
            'STAND N°45',
            'STAND N°46',
            'STAND N°47',
            'STAND N°48',
            'STAND N°49',
            'STAND N°50',
            'STAND N°51',
            'STAND N°52',
            'STAND N°53',
            'STAND N°54',
            'STAND N°55',
            'STAND N°56',
            'STAND N°57',
            'STAND N°58',
            'STAND N°59',
            'STAND N°60',
            'STAND N°61',
            'STAND N°62',
            'STAND N°63',
            'STAND N°64',
            'STAND N°65',
            'STAND N°66',
            'STAND N°67',
            'STAND N°68',
            'STAND N°69',
            'STAND N°70',
        ];
        foreach ($stands as $stand) {
            Stand::create([
                'stand_nro'=> $stand,
                'estado'=>'A'
            ]);
        }

    }
}
