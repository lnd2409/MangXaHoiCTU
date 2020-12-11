<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class students extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $dem=1600000;
        // for($i=1;$i<=10;$i++){
            // lớp từ 10 đến 20 sv
            $amount_class=rand(10,20);

            // for($j=1;$j<=$amount_class;$j++){
            //     $dem++;
            //     DB::table('students')->insert([
            //         [
            //             'username'=>'B'.$dem,
            //             'password'=>\Hash::make('ctu'),
            //             'stu_name'=>$faker->name,
            //             'stu_avatar'=>'/img/avatar.jpg',
            //             'stu_birth'=>$faker->date,
            //             'stu_code'=>'B'.$dem,
            //             'stu_address'=>$faker->address,
            //             'stu_gmail'=>$faker->unique()->safeEmail,
            //             'yb_id'=>1
            //         ],
            //     ]);
            // }
        // }
        $sinhVien = [
            #Lớp 1
            [
                'username'=>'B160'.'0001',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Trần Thanh Phụng',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0001',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>1
            ],
            [
                'username'=>'B160'.'0002',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Lê Ngọc Đức',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0002',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>1
            ],
            [
                'username'=>'B160'.'0003',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Đỗ Thị Ngọc Nguyên',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0003',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>1
            ],
            [
                'username'=>'B160'.'0004',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Lê Minh Nghĩa',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0004',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>1
            ],
            [
                'username'=>'B160'.'0005',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Dương Ngọc Tâm',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0005',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>1
            ],

            #Lớp
            [
                'username'=>'B160'.'0006',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Đức Huy',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0006',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>6
            ],
            [
                'username'=>'B160'.'0007',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Maly',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0007',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>6
            ],
            [
                'username'=>'B160'.'0008',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Kim Thành',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0008',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>6
            ],
            [
                'username'=>'B160'.'0009',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Lương Quốc Bình',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0009',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>6
            ],
            [
                'username'=>'B160'.'0010',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Đặng Thị Tường Vy',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0010',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>6
            ],

            #Lớp 127
            [
                'username'=>'B160'.'0011',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Phạm Thị Phụng',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0011',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>127
            ],
            [
                'username'=>'B160'.'0012',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Trương Công Hậu',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0012',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>127
            ],
            [
                'username'=>'B160'.'0013',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Hân Hân',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0013',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>127
            ],
            [
                'username'=>'B160'.'0014',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Huyền',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B160'.'0014',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>127
            ],
            [
                'username'=>'B'.'1600015',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Trần Quốc Cường',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600015',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>10
            ],
            [
                'username'=>'B'.'1600016',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Trần Trung Khánh',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600016',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>10
            ],
            [
                'username'=>'B'.'1600017',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Lâm Thị Ngọc Mỹ',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600017',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>10
            ],
            [
                'username'=>'B'.'1600018',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Nguyễn Minh Phú',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600018',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>10
            ],
            [
                'username'=>'B'.'1600019',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Nguyễn Minh Trí',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600019',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>10
            ],
            [
                'username'=>'B'.'1600020',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Nguyễn Việt Khoa',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600020',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>10
            ],
            [
                'username'=>'B'.'1600021',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Trần Quốc Việt',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600021',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>17
            ],
            [
                'username'=>'B'.'1600022',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Nguyễn Ngọc Đỉnh',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600022',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>17
            ],
            [
                'username'=>'B'.'1600023',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Trần Thị Ngọc Lan',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600023',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>17
            ],
            [
                'username'=>'B'.'1600024',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Nguyễn Đông Nghi',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600024',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>17
            ],
            [
                'username'=>'B'.'1600025',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Trần Quốc Việt',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600025',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>17
            ],
            [
                'username'=>'B'.'16000226',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Trần Đăng Khoa',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'1600026',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>17
            ],
            [
                'username'=>'B'.'1600027',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Nguyễn Thị Thủy Tiên',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'16000217',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>25
            ],
            [
                'username'=>'B'.'1600028',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Nguyễn Thị Ngô',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'16000218',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>25
            ],
            [
                'username'=>'B'.'1600029',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Lê Cẩm Hương',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'16000219',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>25
            ],
            [
                'username'=>'B'.'1600030',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Trần Đức Bo',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'16000230',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>25
            ],
            [
                'username'=>'B'.'1600031',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Võ Minh Hiếu',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'16000232',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>25
            ],
            [
                'username'=>'B'.'160032',
                'password'=>\Hash::make('ctu'),
                'stu_name'=> 'Lê Công Vinh',
                'stu_avatar'=>'/img/avatar.jpg',
                'stu_birth'=>$faker->date,
                'stu_code'=>'B'.'16000232',
                'stu_address'=>$faker->address,
                'stu_gmail'=>$faker->unique()->safeEmail,
                'yb_id'=>25
            ],
        ];
        DB::table('students')->insert($sinhVien);
    }
}
