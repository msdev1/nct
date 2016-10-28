<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

     protected $signature = 'make:template {type? : Type of template} {name? : Name of class}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new class from templates';


    public $type;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->type=[
          'model'=>['backend'=>app_path().DS."Http".DS."Model".DS."Backend".DS,
                    'frontend'=>app_path().DS."Http".DS."Model".DS."Forntend".DS,
                    'template'=>app_path().DS."Http".DS."Model".DS."Templates".DS,
                    ],
          'controller'=>['backend'=>app_path().DS."Http".DS."Controllers".DS."Backend".DS,
                         'frontend'=>app_path().DS."Http".DS."Controllers".DS."Frontend".DS,
                         'template'=>app_path().DS."Http".DS."Controllers".DS."Templates".DS,
                        ],
          'middleware'=>['backend'=>app_path().DS."Http".DS."Middleware".DS."Backend".DS,
                         'frontend'=>app_path().DS."Http".DS."Middleware".DS."Frontend".DS,
                         'template'=>app_path().DS."Http".DS."Middleware".DS."Templates".DS,
                        ],
          


        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

      $type = $this->ask('Select Template type');
      while (!(array_key_exists($type,$this->type))) {
        $this->info('Available Types');
        $this->info('model , controller , middleware');
        $type = $this->ask('Please enter Valid Template type');
      }
      $forntend = $this->confirm('Class for [Frontend|Backend]');
      $classname = $this->ask('Please enter Class Name');

      if($forntend){
        $subtype='frontend';
      }else{
        $subtype='backend';
      }
      $pathtoStore=$this->type[$type][$subtype];
      $pathoftemp=$this->type[$type]['template'];

      switch ($type) {
        case 'controller':
          $classname=ucfirst($classname)."Controller";
          break;
        case 'middleware':
            $classname=ucfirst($classname)."Middleware";
            break;

        default:
          $classname=ucfirst($classname);
          break;
      }

      $template = file_get_contents($pathoftemp.ucfirst ($subtype).ucfirst ($type).'Template.php');
      $placeholders = ["{classname}"];
      $data=[
        'classname'=>$classname,
      ];
      $new_template=str_replace($placeholders, $data, $template);
      $newfile=$pathtoStore.$classname.".php";

      if (file_exists($newfile)) {
         $fh = fopen($newfile, 'a');
         fwrite($fh, $new_template);
       } else {
         $fh = fopen($newfile, 'wb');
         fwrite($fh, $new_template);
       }
      fclose($fh);
      $this->info('Class Successfully Genrated From Template');
      $this->info('File Path : '.$newfile);

    }
}
