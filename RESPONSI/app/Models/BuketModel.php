<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class BuketModel extends Model
{
    protected $table = 'buket';
    protected $primaryKey = 'buket_id';
    protected $createdField = 'buket_created';
    protected $updatedField = 'buket_updated';
    protected $useTimestamps = true;
    protected $allowedFields = ['buket_nama', 'buket_gambar', 'buket_harga', 'buket_desc', 'buket_pemilik', 'buket_status', 'buket_kontak', 'buket_wa'];
   
}