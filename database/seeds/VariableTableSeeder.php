<?php

use Illuminate\Database\Seeder;

class VariableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $variables = [
         [
             'variable' => 'Books',
                 'children' => [
                     [
                         'variable' => 'Comic Book',
                         'children' => [
                                 ['variable' => 'Marvel Comic Book'],
                                 ['variable' => 'DC Comic Book'],
                                 ['variable' => 'Action comics'],
                         ],
                     ],
                     [
                         'variable' => 'Textbooks',
                             'children' => [
                                 ['variable' => 'Business'],
                                 ['variable' => 'Finance'],
                                 ['variable' => 'Computer Science'],
                         ],
                     ],
                 ],
             ],
             [
                 'variable' => 'Electronics',
                     'children' => [
                     [
                         'variable' => 'TV',
                         'children' => [
                             ['variable' => 'LED'],
                             ['variable' => 'Blu-ray'],
                         ],
                     ],
                     [
                         'variable' => 'Mobile',
                         'children' => [
                             ['variable' => 'Samsung'],
                             ['variable' => 'iPhone'],
                             ['variable' => 'Xiomi'],
                         ],
                     ],
                 ],
             ],
     ];
     foreach($variables as $var)
     {
         \App\Variable::create($var);
     }
    }
}
