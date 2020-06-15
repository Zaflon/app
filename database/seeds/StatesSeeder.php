<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatesSeeder extends Seeder
{
    /** @var array */
    private $STATES = [
        [
            'Acre', 'AC', 'Rio Branco', 12
        ],
        [
            'Alagoas', 'AL', 'Maceió', 27
        ],
        [
            'Amapá', 'AP', 'Macapá', 16
        ],
        [
            'Amazonas', 'AM', 'Manaus', 13
        ],
        [
            'Bahia', 'BA', 'Salvador', 29
        ],
        [
            'Ceará', 'CE', 'Fortaleza', 23
        ],
        [
            'Distrito Federal', 'DF', 'Brasília', 53
        ],
        [
            'Espirito Santo', 'ES', 'Vitória', 32
        ],
        [
            'Goiás', 'GO', 'Goiânia', 52
        ],
        [
            'Maranhão', 'MA', 'São Luís', 21
        ],
        [
            'Mato Grosso', 'MT', 'Cuiabá', 51
        ],
        [
            'Mato Grosso do Sul', 'MS', 'Campo Grande', 50
        ],
        [
            'Minas Gerais', 'MG', 'Belo  Horizonte', 31
        ],
        [
            'Pará', 'PA', 'Belém', 15
        ],
        [
            'Paraíba', 'PB', 'João Pessoa', 25
        ],
        [
            'Paraná', 'PR', 'Curitiba', 41
        ],
        [
            'Piauí', 'PI', 'Teresina', 22
        ],
        [
            'Rio de Janeiro', 'RJ', 'Rio de Janeiro', 33
        ],
        [
            'Rio Grande do Norte', 'RN', 'Natal', 24
        ],
        [
            'Rio Grande do Sul', 'RS', 'Porto Alegre', 43
        ],
        [
            'Rondônia', 'RO', 'Porto Velho', 11
        ],
        [
            'Roraima', 'RR', 'Boa Vista', 14
        ],
        [
            'Santa Catarina', 'SC', 'Florianópolis', 42
        ],
        [
            'São Paulo', 'SP', 'São Paulo', 35
        ],
        [
            'Sergipe', 'SE', 'Aracaju', 28
        ],
        [
            'Tocantins', 'TO', 'Palmas', 17
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->STATES as $state) {
            DB::table('states')->insert([
                'name' => $state[0],
                'abbreviation' => $state[1],
                'cUF' => $state[3],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
