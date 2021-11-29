<?php
namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model 
{
    protected $table = 'cliente_tb';
   // protected $primaryKey = 'CpfCli';
    protected $allowedFields = ['CpfCli', 'codusu_FK', 'nomeCli', 'foneCli'];
    protected $returnType = 'object';
    //protected $autoIncrement = false;
}