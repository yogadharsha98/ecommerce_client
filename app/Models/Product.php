<?php

namespace App\Models;

use App\Models\Group;
use App\Models\SubGroup;
use App\Models\Department;
use App\Models\ProductImage;
use App\Models\ProductThumbnail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_id',
        'group_id',
        'sub_group_id',
        'sub_group_id_1',
        'sub_group_id_2',
        'sub_group_id_3',
        'si_upc',
        'barcode_sku',
        'b_m',
        'product_name',
        'product_description',
        'kg_ml',
        'units',
        'ps',
        'case',
        'dimensions',
        'cp_vat',
        'is',
        'lo',
        'ar',
        'vat',
        'wscp_vat',
        'samson_percent',
        'unit_rrp',
        'rupm',
        'bcqty_1',
        'bcp_1',
        'b_percent_1',
        'bcqty_2',
        'bcp_2',
        'b_percent_2',
        'bcqty_3',
        'bcp_3',
        'b_percent_3',
        'linked_item_1',
        'linked_item_2',
        'linked_item_3',
        'status',
        'trending', // Added trending column
        'featured', // Added featured column
    ];

    protected $casts = [
        'trending' => 'boolean', // Cast trending to boolean
        'featured' => 'boolean', // Cast featured to boolean
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function subGroup()
    {
        return $this->belongsTo(SubGroup::class, 'sub_group_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    /**
     * Get the product thumbnails associated with the product.
     */
    public function productThumbnails()
    {
        return $this->hasMany(ProductThumbnail::class, 'product_id', 'id');
    }

    // public function getImageUrlsAttribute()
    // {
    //     return $this->productImages->pluck('url')->implode(',');
    // }

    // /**
    //  * Accessor for getting thumbnail URLs associated with the product.
    //  *
    //  * @return string
    //  */
    // public function getThumbnailUrlsAttribute()
    // {
    //     return $this->productThumbnails->pluck('url')->implode(',');
    // }
}
