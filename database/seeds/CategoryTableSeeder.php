<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    private $category = [
        'School' => 'ข่าวสารจากโรงเรียน',
        'Student Committee' => 'ข่าวสารจากคณะกรรมการนักเรียน',
        'Student Space' => 'ข่าวสารจากนักเรียนหรือชุมนุมต่าง',
        'Developer' => 'ข่าวสารจากผู้พัฒนาระบบ'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->category as $name => $desc) {
            DB::table('categories')->insert([
                'name' => $name,
                'description' => $desc,
                'parent_id' => null
            ]);
        }
    }
}
