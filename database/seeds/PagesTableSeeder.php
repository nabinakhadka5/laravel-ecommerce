<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
          array(
              'title' => 'About Us',
              'slug' => \Str::slug('About Us'),
              'summary' => 'About Us',
              'layout' => 'default'
          ),
          array(
              'title' => 'Privacy Policy',
              'slug' => \Str::slug('Privacy Policy'),
              'summary' => 'Privacy Policy',
              'layout' => 'default'
          ),
          array(
              'title' => 'Terms and Condition',
              'slug' => \Str::slug('Terms and Condition'),
              'summary' => 'Terms and Condition',
              'layout' => 'default'
          ),
          array(
              'title' => 'FAQ and Help',
              'slug' => \Str::slug('FAQ and Help'),
              'summary' => 'FAQ and Help',
              'layout' => 'default'
          ),

        );
        foreach ($array as $page_item){

            $page = new \App\Models\Page();
            if($page->where('slug',$page_item['slug'])->count() <= 0) {
                $page->fill($page_item);
                $page->save();
            }
        }
    }
}
