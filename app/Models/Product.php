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
        'department_title', // Add department_title to fillable fields
        'group_title', // Add group_title to fillable fields
        'sub_group_title', // Add sub_group_title to fillable fields
        'si_upc',
        'barcode_sku',
        'product_name',
        'product_description',
        'packsize',
        'unit_price',
        'case_price',
        'rsp',
        'vat',
        'por',
        'bcqty_1',
        'bcp_1',
        'por_1',
        'bcqty_2',
        'bcp_2',
        'por_2',
        'bcqty_3',
        'bcp_3',
        'por_3',
        'status',
        'trending',
        'featured',
        'monthly_offer', // Add monthly_offer to fillable fields
        'weekly_offer', // Add weekly_offer to fillable fields
        'seasonal_offer', // Add seasonal_offer to fillable fields
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
