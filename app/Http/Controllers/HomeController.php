<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Department;
use App\Models\Group;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubGroup;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Department::all();
        $slider = Slider::all();
        return view('home.home', compact('data', 'slider'));
    }

    public function view_products()
    {
        $departments = Department::all();
        $products = Product::all();
        return view('home.department', compact('departments', 'products'));
    }

    public function view_department($id)
    {
        $departments = Department::all();
        $department = Department::find($id);
        $products = Product::all();
        // Check if department exists
        if (!$department) {
            abort(404); // Or handle the error in a different way
        }

        // Retrieve groups associated with the department
        $groups = $department->groups;

        // Pass data to the view
        return view('home.group', compact('departments', 'department', 'groups', 'products'));
    }

    public function view_group($id)
    {
        $departments = Department::all();
        $products = Product::all();
        $group = Group::find($id);
        $subgroups = $group->subGroups;
        return view('home.subgroup', compact('departments', 'products', 'group', 'subgroups'));
    }

    public function view_subgroup_products($id)
    {
        $departments = Department::all();
        $subgroup = SubGroup::find($id);
        $subgroupproducts = Product::where('sub_group_id', $subgroup->id)->get();
        $products = Product::all();

        return view('home.viewsubgroup_products', compact('departments', 'subgroup', 'subgroupproducts', 'products'));
    }


    public function showCart(Request $request)
    {
        // Get the product IDs from the URL query parameters
        $productIds = $request->query('productId');

        // Check if $productIds is an array
        if (!is_array($productIds)) {
            // If it's not an array, convert it to an array
            $productIds = [$productIds];
        }

        // Retrieve the products based on the IDs
        $products = Product::whereIn('id', $productIds)->get();

        // Return the view with the products
        return view('home.cart', ['products' => $products]);
    }

    public function product_details($id)
    {
        $products = Product::all();
        $departments = Department::all();
        $product_details = Product::find($id);
        $banner = Banner::all();

        return view('home.product_details', compact('departments', 'products', 'product_details', 'banner'));
    }
}
