<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Carts;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Group;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index()
    {
        $data = Department::all();
        $products = Product::all();
        $slider = Slider::all();
        return view('home.home', compact('data', 'products', 'slider'));
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


    public function show_cart()
    {
        $id = Auth::guard('customer')->user()->id;

        $cart = Carts::where('user_id', '=', $id)->get();

        // Retrieve product images for each product in the cart
        $cart->each(function ($item) {
            $product = Product::with('productImages')->find($item->product_id);
            $item->product_images = $product->productImages;
        });

        return view('home.cart', compact('cart'));
    }

    public function product_details(Request $request, $id)
    {
        $products = Product::all();
        $departments = Department::all();
        $product_details = Product::find($id);
        $banner = Banner::all();

        return view('home.product_details', compact('departments', 'products', 'product_details', 'banner'));
    }

    public function add_cart(Request $request, $id)
    {
        if (Auth::guard('customer')->check()) {
            // User is authenticated, retrieve user data
            $customer = Auth::guard('customer')->user();
            $product = Product::find($id);

            $cart = new Carts();

            $cart->name = $customer->name;
            $cart->email = $customer->email;
            $cart->phone = $customer->phone;
            $cart->address = $customer->address;
            $cart->user_id = $customer->id;

            $cart->product_id = $product->id;
            $cart->product_title = $product->product_name;
            $cart->department_title = $product->department_title;
            $cart->group_title = $product->group_title;
            $cart->sub_group_title = $product->sub_group_title;

            if ($product->discount_price != null) {
                $cart->unit_price = $product->discount_price * $request->quantity;
            } else {
                $cart->unit_price = $product->unit_price *  $request->quantity;
                $cart->case_price = $product->case_price *  $request->case_quantity;
            }

            $cart->unit_price = $product->unit_price;
            $cart->case = $request->case_quantity;
            $cart->case_price = $product->case_price;
            $cart->quantity = $request->quantity;

            $cart->unit_price = $product->unit_price *  $request->quantity;
            $cart->case_price = $product->case_price *  $request->case_quantity;
            $cart->save();

            return redirect()->back();
        } else {
            // User is not authenticated, redirect to login page
            return redirect('/login');
        }
    }

    //show register page
    public function register()
    {
        return view('home.register');
    }

    //create new customer
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:customers,email'],
            'phone' => ['required', 'numeric'],
            'address' => ['required'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new customer record
        $customer = Customer::create($validatedData);

        // Authenticate the customer
        auth()->guard('customer')->login($customer);

        // Retrieve the authenticated customer
        $authenticatedCustomer = auth()->guard('customer')->user();

        // Store the authenticated customer data in the session
        session(['customer' => $authenticatedCustomer]);

        // Optionally, you can log in the newly registered customer here

        return redirect('/')->with('message', 'User created successfully');
    }

    //logout
    public function logout(Request $request)
    {
        auth()->guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been Logged out!');
    }

    //show login form
    public function login()
    {
        return view('home.login');
    }

    //authenticate user
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            // Authentication passed...
            $request->session()->regenerate();
            $customer = Auth::guard('customer')->user();
            session(['customer' => $customer]);
            return redirect('/')->with('message', 'You are now logged in');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
    }
}
