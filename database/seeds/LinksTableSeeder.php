<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{

    /**
     * 运行数据库填充。
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
            'link_name' => '致Great',
            'link_title' => '博客网站',
            'link_url' => 'yanqiangmiffy.github.com',
            'link_order' => 1,
            ],
            [
                'link_name' => '后盾论坛',
                'link_title' => '后盾网，人人做后盾',
                'link_url' => 'http://bbs.houdunwang.com',
                'link_order' => 2,
            ]
        ];
        DB::table('links')->insert($data);
    }
}
