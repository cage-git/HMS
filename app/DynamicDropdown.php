<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class DynamicDropdown extends Model
{
	protected $guarded = ['id'];
	protected $table = 'dynamic_dropdowns';
}
