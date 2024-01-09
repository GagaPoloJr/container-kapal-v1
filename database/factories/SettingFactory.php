<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{

     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_perusahaan' => 'Test User',
            'nama_perusahaan' => 'Alken',
            'lini_bisnis' =>  'apaja',
            'email' =>  'apaja@gmail.com',
            'phone' =>  '08129919129',
            'fax' =>  'apaja',
            'alamat' =>  'apaja',
            'npwp' =>  'apaja',
            'ttd_resi'=> 'ttd',
            'ttd_kwitansi'=> 'ttd',
            'ttd_nama_resi'=> 'ttd resi',
            'ttd_nama_kwitansi'=> 'ttd kwitansi',
            'no_rek_1'=> 'ttd',
            'no_rek_2'=> 'ttd',
        ];
    }
}
