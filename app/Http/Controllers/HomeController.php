<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Stripe;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Carts;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Group;
use App\Models\Orders;
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
        $departments = Department::all();
        $products = Product::all();
        $slider = Slider::all();

        $featuredProducts = Product::where('featured', true)->get();

        return view('home.home', compact('data', 'departments', 'products', 'slider', 'featuredProducts'));
    }

    public function show_all_products()
    {
        $departments = Department::all();
        $products = Product::all();
        // Retrieve featured products
        $featuredProducts = Product::where('featured', 1)->get();

        // Retrieve trending products
        $trendingProducts = Product::where('trending', 1)->get();
        return view('home.products', compact('departments', 'products', 'featuredProducts', 'trendingProducts'));
    }

    public function show_contact()
    {
        $departments = Department::all();

        return view('home.contact', compact('departments'));
    }

    public function show_myaccount()
    {
        $departments = Department::all();
        $customer = Auth::guard('customer')->user();


        return view('home.my_account', compact('departments', 'customer'));
    }

    public function view_products()
    {
        $departments = Department::all();
        $products = Product::all();
        // Retrieve featured products
        $featuredProducts = Product::where('featured', 1)->get();

        // Retrieve trending products
        $trendingProducts = Product::where('trending', 1)->get();
        return view('home.department', compact('departments', 'products', 'featuredProducts', 'trendingProducts'));
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
        // Retrieve featured products
        $featuredProducts = Product::where('featured', 1)->get();

        // Retrieve trending products
        $trendingProducts = Product::where('trending', 1)->get();



        // Pass data to the view
        return view('home.group', compact('departments', 'department', 'groups', 'products', 'featuredProducts', 'trendingProducts'));
    }

    public function view_group($id)
    {
        $departments = Department::all();
        $products = Product::all();
        $group = Group::find($id);
        $subgroups = $group->subGroups;
        $featuredProducts = Product::where('featured', 1)->get();

        // Retrieve trending products
        $trendingProducts = Product::where('trending', 1)->get();

        return view('home.subgroup', compact('departments', 'products', 'group', 'subgroups', 'featuredProducts', 'trendingProducts'));
    }

    public function view_subgroup_products($id)
    {
        $departments = Department::all();
        $subgroup = SubGroup::find($id);
        $subgroupproducts = Product::where('sub_group_id', $subgroup->id)->get();
        $products = Product::all();
        $featuredProducts = Product::where('featured', 1)->get();

        // Retrieve trending products
        $trendingProducts = Product::where('trending', 1)->get();

        return view('home.viewsubgroup_products', compact('departments', 'subgroup', 'subgroupproducts', 'products', 'featuredProducts', 'trendingProducts'));
    }

    public function product_details(Request $request, $id)
    {
        $products = Product::all();
        $departments = Department::all();
        $product_details = Product::find($id);
        $banner = Banner::all();
        $featuredProducts = Product::where('featured', 1)->get();

        // Retrieve trending products
        $trendingProducts = Product::where('trending', 1)->get();

        return view('home.product_details', compact('departments', 'products', 'product_details', 'banner', 'featuredProducts', 'trendingProducts'));
    }


    public function show_cart()
    {
        if (Auth::guard('customer')->check()) {
            $id = Auth::guard('customer')->user()->id;

            $cart = Carts::where('user_id', '=', $id)->get();
            $departments = Department::all();

            // Retrieve product images for each product in the cart
            $cart->each(function ($item) {
                $product = Product::with('productImages')->find($item->product_id);
                $item->product_images = $product->productImages;
            });

            return view('home.cart', compact('cart', 'departments'));
        } else {
            return redirect('/login');
        }
    }

    public function add_cart(Request $request, $id)
    {
        if (Auth::guard('customer')->check()) {
            // User is authenticated, retrieve user data
            $customer = Auth::guard('customer')->user();
            $product = Product::find($id);

            // Check if the product already exists in the cart
            $existingCartItem = Carts::where('user_id', $customer->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCartItem) {
                // Update the existing cart item with new quantities
                $existingCartItem->quantity = $request->quantity;
                $existingCartItem->case = $request->case_quantity;
                // Recalculate prices based on new quantities
                $existingCartItem->unit_price = $product->discount_price != null ? $product->discount_price * $request->quantity : $product->unit_price * $request->quantity;
                $existingCartItem->case_price = $product->case_price * $request->case_quantity;
                if ($request->bulk1) {
                    $existingCartItem->bcqty1 = $product->bcqty_1;
                    $existingCartItem->total_bulk1_price = $product->bcp_1 * $product->bcqty_1;
                }
                if ($request->bulk2) {
                    $existingCartItem->bcqty2 = $product->bcqty_2;
                    $existingCartItem->total_bulk2_price = $product->bcp_2 * $product->bcqty_2;
                }
                if ($request->bulk3) {
                    $existingCartItem->bcqty3 = $product->bcqty_3;
                    $existingCartItem->total_bulk3_price = $product->bcp_3 * $product->bcqty_3;
                }
                // Save the updated cart item
                $existingCartItem->save();
            } else {
                // Create a new cart item
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
                $cart->vat = $product->vat;
                $cart->por = $product->por;
                $cart->rsp = $product->rsp;
                $cart->sub_group_title = $product->sub_group_title;
                $cart->quantity = $request->quantity;
                $cart->case = $request->case_quantity;
                $cart->unit_price = $product->discount_price != null ? $product->discount_price * $request->quantity : $product->unit_price * $request->quantity;
                $cart->case_price = $product->case_price * $request->case_quantity;
                if ($request->bulk1) {
                    $cart->bcqty1 = $product->bcqty_1;
                    $cart->total_bulk1_price = $product->bcp_1 * $product->bcqty_1;
                }
                if ($request->bulk2) {
                    $cart->bcqty2 = $product->bcqty_2;
                    $cart->total_bulk2_price = $product->bcp_2 * $product->bcqty_2;
                }
                if ($request->bulk3) {
                    $cart->bcqty3 = $product->bcqty_3;
                    $cart->total_bulk3_price = $product->bcp_3 * $product->bcqty_3;
                }
                $cart->save();
            }

            return redirect()->back()->with('message', 'Product added to the cart');
        } else {
            // User is not authenticated, redirect to login page
            return redirect('/login');
        }
    }

    public function remove_cart($id)
    {
        $cart = Carts::find($id);
        $cart->delete();

        return redirect()->back()->with('message', 'Product removed');
    }



    public function show_order()
    {
        $departments = Department::all();

        if (Auth::guard('customer')->check()) {
            // User is authenticated, retrieve user data
            $customer = Auth::guard('customer')->user();
            $customer_id = $customer->id;

            $order = Orders::where('user_id', $customer_id)->with('product')->get();

            return view('home.order', compact('departments', 'order'));
        } else {
            return redirect('/login');
        }
    }

    public function cancel_order($id)
    {
        $order = Orders::find($id);

        $order->delivery_status = 'Order canceled';
        $order->save();
        return redirect()->back()->with('message', 'Order canceled');
    }

    public function stripe($total_amount)
    {
        $departments = Department::all();
        return view('home.stripe', compact('total_amount', 'departments'));
    }

    public function stripePost(Request $request, $total_amount)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $total_amount * 100,
            "currency" => "GBP",
            "source" => $request->stripeToken,
            "description" => "Thanks for the payment. "
        ]);

        $customer = Auth::guard('customer')->user();
        $customer_id = $customer->id;

        $data = Carts::where('user_id', '=', $customer_id)->get();

        foreach ($data as $data) {
            // Calculate total amount for each order
            $total_amount = $data->unit_price + $data->case_price + $data->total_bulk1_price + $data->total_bulk2_price + $data->total_bulk3_price;

            $order = new Orders;

            //first field from the order table and second field from the cart table
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;

            $order->product_id = $data->product_id;
            $order->product_title = $data->product_title;
            $order->department_title = $data->department_title;
            $order->group_title = $data->group_title;
            $order->sub_group_title = $data->sub_group_title;

            $order->quantity = $data->quantity;
            $order->total_unit_price = $data->unit_price;
            $order->case = $data->case;
            $order->total_case_price = $data->case_price;

            $order->bcqty1 = $data->bcqty1;
            $order->total_bulk1_price = $data->total_bulk1_price;
            $order->bcqty2 = $data->bcqty2;
            $order->total_bulk2_price = $data->total_bulk2_price;
            $order->bcqty3 = $data->bcqty3;
            $order->total_bulk3_price = $data->total_bulk3_price;
            $order->bcqty1 = $data->bcqty1;
            $order->vat = $data->vat;
            $order->total_amount = $total_amount;

            $order->payment_status = 'Paid';

            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;
            $cart = Carts::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function product_search(Request $request)
    {
        $departments = Department::all();
        $products = Product::all();
        // Retrieve featured products
        $featuredProducts = Product::where('featured', 1)->get();

        $search_text = $request->search;
        $product = Product::where('product_name', 'LIKE', "%$search_text%")->orWhere('department_title', 'LIKE', "%$search_text%")->paginate(10);

        return view('home.products', compact('featuredProducts', 'products', 'product', 'departments'));
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
