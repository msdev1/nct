<?php

use Illuminate\Database\Seeder;

class master_user_seeder_template extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $user=new \BModel\User();
      $array=[
        'FirstName'=>'Mitul',
        'LastName'=>'Patel',
        'UserName'=>'msuser',
        'UserCode'=>$user->newUserCode(),
        'PassWord'=>$user->secret('msuser!123'),
        'AccessCode'=>$user->secret('10'),
        'ContactNo'=>'9537966250',
        'eMail'=>'sales@millionsolutions.co.in',
        'LastLogin_ip'=>'0.0.0.0',
        'CurrentLogin_ip'=>'0.0.0.0',
        'JetKey'=>$user->newJetKey(),
        'EmailCode'=>$user->newEmailCode(),
        'ExtraField'=>json_encode([],true),
        'EmailVeryfied'=>1,
        'CurrentLogin_status'=>0,
        'Status'=>1,
      ];
      $userArray[]=$array;
      $array=[
        'FirstName'=>'Mitul 2',
        'LastName'=>'Patel 2',
        'UserName'=>'msadmin',
        'UserCode'=>$user->newUserCode(),
        'PassWord'=>$user->secret('msadmin!123'),
        'AccessCode'=>$user->secret('10'),
        'ContactNo'=>'9537966250',
        'eMail'=>'mitul@millionsolutions.co.in',
        'LastLogin_ip'=>'0.0.0.0',
        'CurrentLogin_ip'=>'0.0.0.0',
        'JetKey'=>$user->newJetKey(),
        'EmailCode'=>$user->newEmailCode(),
        'ExtraField'=>json_encode([],true),
        'EmailVeryfied'=>1,
        'CurrentLogin_status'=>0,
        'Status'=>1,
      ];
      $userArray[]=$array;
      foreach ($userArray as $key => $value) {
        $user=new \BModel\User();
        $user->feed($value);
        $user->checkSave();
      }

    }
}
