<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cost;
use App\Models\Meal;
use App\Models\User;
use App\Models\Bazar;
use App\Models\Deposite;
use Illuminate\Support\Str;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Notifications\SendUserNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalDeposite =  Deposite::where('status', true)->sum('amount');
        $totalCost =  Cost::where('status', true)->sum('amount');
        $totalBazar =  Bazar::where('status', true)->sum('amount');
        $totalMeal =  Meal::where('status', true)->sum('amount');
        $users =  User::where('status', true)->get();
        $totalUser = $users->count();

        if ($totalBazar > 0) {
            $mealrate = number_format(($totalBazar / $totalMeal), 2);
        } else {
            $mealrate = 0;
        }

        $mealbalance = number_format(($totalDeposite - ($totalCost + $totalBazar)), 2);


        // Chart
        $labels = [];
        $data = [];
        $users = User::where('status', true)->get();

        foreach ($users as $user) {
            $labels[] = $user->name;
            $data[] = $user->deposite->sum('amount');
        }
        $labels = json_encode($labels);
        $data = json_encode($data);

        return view('admin.dashboard', compact('data', 'labels', 'mealrate', 'mealbalance', 'totalDeposite', 'totalCost', 'totalBazar', 'totalMeal', 'totalUser', 'users'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->withSuccess('Logout Success!');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function Updateprofile(Request $request)
    {
        $user = [];
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|numeric',
            'photo' => 'nullable|image|mimes:png,jpeg,jpg,webp'
        ]);

        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->file('photo')) {
            $filename = Str::slug($request->name) . "_" . time() . "." . $request->file('photo')->getClientOriginalExtension();

            $path = public_path('upload/user');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // Delete Old Photo
            $oldPhoto = Auth::user()->photo;

            if ($oldPhoto) {
                $oldPhotoPath = public_path(parse_url($oldPhoto, PHP_URL_PATH));
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }


            $image = new ImageManager(new Driver());
            $image = $image->read($request->file('photo'));
            $image->cover(300, 300)->save($path . '/' . $filename);

            $user['photo'] = asset('upload/user/' . $filename);
        }

        User::find(Auth::id())->update($user);

        return redirect()->route('admin.profile')->with('success', 'Profile Update Successfully!');
    }


    // Depostite
    public function deposite()
    {
        $deposites = Deposite::latest()->where('status', true)->paginate(20);
        return view('admin.deposite.deposite', compact('deposites'));
    }
    public function Createdeposite()
    {
        $users = User::where('status', true)->get();
        return view('admin.deposite.add-deposite', compact('users'));
    }

    public function Storedeposite(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ], ['user_id.required' => 'Must Select a Member']);

        Deposite::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'status' => true,
        ]);

        $user = User::find($request->user_id);
        $notification = [
            'stitle' => 'Deposite Added',
            'title' =>  'Deposite Added. ' . $request->amount . ' TK',
            'messege' => $request->amount . " tk deposite added successfully.Check your deposite history to view deposite",
            'userurl' => route('user.mydeposite'),
            'adminurl' => route('admin.deposite'),
        ];
        $user->notify(new SendUserNotification($notification));

        return redirect()->route('admin.deposite')->withSuccess('Deposite Added Successfully!');
    }

    public function deleteDeposite(Request $request)
    {
        $deposite = Deposite::find($request->id);
        $notification = [
            'stitle' => 'Deposite Deleted!',
            'title' =>  $deposite->amount . ' Tk Deposite Deleted!',
            'messege' => $deposite->amount . " tk deposite Deleted by Admin",
            'userurl' => route('user.mydeposite'),
            'adminurl' => route('admin.deposite'),
        ];
        User::find($deposite->user_id)->notify(new SendUserNotification($notification));

        if ($deposite) {
            $deposite->delete();
            $response = [
                'success' => true,
                'msg' => 'Deposite Deleted Successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Something Went wrong to deposite'
            ];
        }

        return response()->json($response);
    }

    public function pendingdeposite()
    {
        $deposites = Deposite::where('status', false)->get();
        return view('admin.deposite.pending-deposite', compact('deposites'));
    }

    public function acceptDeposite(Request $request)
    {
        $deposite = Deposite::find($request->id);
        $user = User::find($deposite->user_id);
        $notification = [
            'stitle' => 'Deposite Accepted!',
            'title' =>  $deposite->amount . ' Tk Deposite Accepted!',
            'messege' => $deposite->amount . " tk deposite Accepted by Admin.",
            'userurl' => route('user.mydeposite'),
            'adminurl' => route('admin.deposite'),
        ];
        $user->notify(new SendUserNotification($notification));
        if ($deposite) {
            $deposite->update([
                'status' => true
            ]);
            $response = [
                'success' => true,
                'msg' => 'Deposite Accepted!'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Something Went wrong '
            ];
        }

        return response()->json($response);
    }

    public function exportDeposite()
    {
        $deposits = Deposite::where('status', true)->get();
        $pdf = app()->make('dompdf.wrapper');
        $pdf = $pdf->loadView('admin.export.deposite', compact('deposits'));
        return $pdf->download("Total_deposits_" . time() . ".pdf");
    }


    // Users

    public function users()
    {
        $users = User::where('status', true)->latest()->get();
        return view('admin.users.users', compact('users'));
    }

    public function deleteuser(Request $request)
    {
        $user = User::find($request->id);
        $notification = [
            'stitle' => "$user->name is removed",
            'title' =>  $user->name . ' has been removed by admin',
            'messege' => "She/He is not a member yet. He can't access anything of a user",
            'userurl' => route('user.dashboard'),
            'adminurl' => route('admin.users'),
        ];
        $users = User::where('status', true)->get();
        Notification::send($users,new SendUserNotification($notification));

        if ($user) {
            $imageurl = $user->photo;
            $relativePath = str_replace(url('/'), '', $imageurl);
            $file = public_path($relativePath);

            if (file_exists($file)) {
                unlink($file);
            }
            $user->delete();
            $response = [
                'success' => true,
                'msg' => 'Successfully User Deleted!'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Failed To Delete!'
            ];
        }

        return response()->json($response);
    }

    public function adduser()
    {
        return view('admin.users.add-user');
    }

    public function storeuser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|numeric',
            'photo' => 'required|image|mimes:png,jpg,jpeg,webp',
            'role' => 'required',
        ]);

        if ($request->status) {
            $status = 1;
        } else {
            $status = 0;
        }

        $userdata = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'status' => $status,
        ];


        if ($request->file('photo')) {
            $filename = Str::slug($request->name) . "_" . time() . "." . $request->file('photo')->getClientOriginalExtension();

            $path = public_path('upload/user');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $image = new ImageManager(new Driver());
            $image = $image->read($request->file('photo'));
            $image->cover(300, 300)->save($path . '/' . $filename);

            $userdata['photo'] = asset('upload/user/' . $filename);
        }

        $yser = User::create($userdata);

        $userdata['id'] = $yser->id;

        $notification = [
            'stitle' => 'New User Added!',
            'title' =>  "$request->name added your meal",
            'messege' => $request->name . " added today in your meal system. Stay Connected!",
            'userurl' => route('user.dashboard'),
            'adminurl' => route('admin.users'),
            'newuser' => $userdata,
        ];

        $users = User::where('status', true)->get();
        Notification::send($users, new SendUserNotification($notification));


        return redirect()->route('admin.users')->withSuccess('User added Successfully!');
    }


    public function pendinguser()
    {
        $users = User::where('status', false)->get();
        return view('admin.users.pending-user', compact('users'));
    }

    public function acceptuser(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->update([
                'status' => true
            ]);
            $response = [
                'success' => true,
                'msg' => 'Now user is activated!'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Something Went wrong '
            ];
        }

        $notification = [
            'stitle' => 'Request Accepted!',
            'title' =>  "User Request Approved!",
            'messege' => "Now you are a member of meal manager. you can access all feature of role a user",
            'userurl' => route('user.profile'),
            'adminurl' => route('admin.users'),
        ];

        $users = User::where('status', true)->get();
        $notification2 = [
            'stitle' => 'Request Accepted!',
            'title' =>  "$request->name Approved by Admin",
            'messege' => $request->name . " added today in your meal system. Stay Connected!",
            'userurl' => route('user.dashboard'),
            'adminurl' => route('admin.users'),
            'newuser' => $user,
        ];

        Notification::send($user, new SendUserNotification($notification));
        Notification::send($users, new SendUserNotification($notification2));

        return response()->json($response);
    }

    public function exportusers()
    {
        $users = User::latest('status')->get();
        $pdf = app()->make('dompdf.wrapper');
        $pdf =  $pdf->setPaper('A4', 'landscape');
        $pdf = $pdf->loadView('admin.export.users', compact('users'));
        return $pdf->download("Total_users_" . time() . ".pdf");
    }

    public function edituser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit-user', compact('user'));
    }

    public function updateuser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'phone' => 'nullable|numeric',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'role' => 'required',
        ]);

        if ($request->status) {
            $status = 1;
        } else {
            $status = 0;
        }

        $userdata = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'status' => $status,
        ];


        if ($request->file('photo')) {
            $filename = Str::slug($request->name) . "_" . time() . "." . $request->file('photo')->getClientOriginalExtension();

            $path = public_path('upload/user');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // Delete Old Photo
            $oldPhoto = User::findOrFail($request->id)->photo;
            if ($oldPhoto) {
                $oldPhotoPath = public_path(parse_url($oldPhoto, PHP_URL_PATH));
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }


            $image = new ImageManager(new Driver());
            $image = $image->read($request->file('photo'));
            $image->cover(300, 300)->save($path . '/' . $filename);

            $userdata['photo'] = asset('upload/user/' . $filename);
        }

        $user = User::findOrFail($request->id);
        $user->update($userdata);

        $notification = [
            'stitle' => 'Update your info!',
            'title' =>  Auth::user()->name . " update your information",
            'messege' => Auth::user()->name . " update your information. Click Here to view what changes make by admin",
            'userurl' => route('user.profile'),
            'adminurl' => route('admin.users'),
        ];

        Notification::send($user, new SendUserNotification($notification));

        return redirect()->route('admin.users')->withSuccess('User info Updated Successfully!');
    }


    // Change Manager
    public function changemanager()
    {
        $users = User::where('role', 'user')->where('status', true)->get();
        return view('change-manager', compact('users'));
    }

    public function updatemanager(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric'
        ], [
            'user_id.required' => 'No Member Selected!'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->update([
            'role' => 'admin'
        ]);

        $usernotification = [
            'stitle' => "Congratulations!",
            'title' =>  "Now are admin now!",
            'messege' => "You can perform all action that can do a admin",
            'userurl' => route('user.profile'),
            'adminurl' => route('admin.users'),
        ];

        Notification::send($user, new SendUserNotification($usernotification));

        $users = User::where('status', true)->where('id', '!=', $request->user_id)->get();

        $notification = [
            'stitle' => "New admin assigned!",
            'title' =>  "$user->name is assign as Admin",
            'messege' => "New Admin Found.Now he can access all about thing of a admin",
            'userurl' => route('user.profile'),
            'adminurl' => route('admin.users'),
        ];

        Notification::send($users, new SendUserNotification($notification));

        return redirect()->route('admin.users')->withSuccess('Manager Changed Successfully!');
    }

    // Meals
    public function meals()
    {
        $meals = Meal::where('status', true)->latest()->paginate(20);
        return view('admin.meals.meals', compact('meals'));
    }

    public function deletemeal(Request $request)
    {
        $meal = Meal::findOrFail($request->id);


        $user = User::where('status', true)->where('id', $meal->user_id)->get();

        $notification = [
            'stitle' => "Admin delete your Meal",
            'title' =>  "Admin delete your Meal",
            'messege' => "An Admin Delete your meal. Check your meal history",
            'userurl' => route('user.mymeal'),
            'adminurl' => route('admin.meals'),
        ];

        Notification::send($user, new SendUserNotification($notification));

        if ($meal) {
            $meal->delete();
            $response = [
                'success' => true,
                'msg' => 'Meal Deletd Successfully!'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Failed To delete!'
            ];
        }
        return response()->json($response);
    }

    public function addmeal()
    {
        $users = User::where('status', true)->get();
        return view('admin.meals.add-meals', compact('users'));
    }

    public function pendingmeal()
    {
        $meals = Meal::where('status', false)->latest()->paginate(20);
        return view('admin.meals.pending-meals', compact('meals'));
    }

    public function acceptmeal(Request $request)
    {
        $meal = Meal::findOrFail($request->id);

        $user = User::where('status', true)->where('id', $meal->user_id)->get();

        $notification = [
            'stitle' => "Admin accept your Meal",
            'title' =>  "Admin accept your Meal",
            'messege' => "An Admin accept your meal. Check your meal history",
            'userurl' => route('user.mymeal'),
            'adminurl' => route('admin.meals'),
        ];

        Notification::send($user, new SendUserNotification($notification));

        if ($meal) {
            $meal->update(['status' => true]);
            $response = [
                'success' => true,
                'msg' => 'Meal Accepted Successfully!'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Failed To Accept!'
            ];
        }
        return response()->json($response);
    }

    public function storemeal(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required',
            'users' => 'required',
        ]);

        foreach ($request->users as $user) {
            Meal::create([
                'date' => $request->date,
                'amount' => $request->amount,
                'user_id' => $user,
                'status' => true
            ]);

            $singleuser = User::findOrFail($user);

            $notification = [
                'stitle' => "Meal Added!",
                'title' =>  "$request->amount meal added  in your Meal",
                'messege' => "An Admin add $request->amount your meal. Check your meal history",
                'userurl' => route('user.mymeal'),
                'adminurl' => route('admin.meals'),
            ];
            Notification::send($singleuser, new SendUserNotification($notification));
        }

        return redirect()->route('admin.meals')->withSuccess('Meal Added Successfully!');
    }

    public function editmeal($id)
    {
        $meal = Meal::findOrFail($id);
        $users = User::where('status', true)->get();
        return view('admin.meals.edit-meal', compact('meal', 'users'));
    }

    public function updatemeal(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required',
            'user' => 'required',
        ]);

        Meal::findOrFail($request->id)->update([
            'date' => $request->date,
            'amount' => $request->amount,
            'user_id' => $request->user,
            'status' => true,
        ]);

        $singleuser = User::findOrFail($request->user);

        $notification = [
            'stitle' => "Meal Updated!",
            'title' =>  "$request->amount meal updated to your Meal",
            'messege' => "An Admin update $request->amount your meal. Check your meal history",
            'userurl' => route('user.mymeal'),
            'adminurl' => route('admin.meals'),
        ];
        Notification::send($singleuser, new SendUserNotification($notification));

        return redirect()->route('admin.meals')->withSuccess('Meal Updated Successfully!');
    }



    // Costs
    public function individualcost()
    {
        $costs = Cost::where('status', true)->where('type', 'other')->latest()->paginate(20);
        return view('admin.costs.individual-cost', compact('costs'));
    }

    public function addindividualcost()
    {
        $users = User::where('status', true)->get();
        return view('admin.costs.add-individual-cost', compact('users'));
    }
    public function storeindividualcost(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'details' => 'required|string',
            'shopper' => 'required',
        ]);

        $users = User::where('status', true)->get();
        $notification = [
            'stitle' => "Cost Added!",
            'title' =>  (floor($request->amount / count($users) * 100) / 100)." cost added to your balance",
            'messege' => "An Admin added ".(floor($request->amount / count($users) * 100) / 100)." your cost. Cost: $request->details. Check your cost history",
            'userurl' => route('user.mycost'),
            'adminurl' => route('admin.individualcost'),
        ];
        Notification::send($users, new SendUserNotification($notification));

        foreach ($users as $user) {
            Cost::create([
                'date' => $request->date,
                'amount' => $request->amount / count($users),
                'details' => nl2br(e($request->details)),
                'type' =>  'other',
                'user_id' => $user->id,
                'status' => true,
                'shopper' => json_encode($request->shopper),
            ]);
        }

        return redirect()->route('admin.individualcost')->with('success', 'A New Cost Added Successfully!');
    }

    public function deletecost(Request $request)
    {
        $cost = Cost::findOrFail($request->id);
        if ($cost) {
            $cost->delete();
            $response = [
                'success' => true,
                'msg' => 'Cost Deletd Successfully!'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Failed To delete!'
            ];
        }
        return response()->json($response);
    }

    public function editcost($id)
    {
        $cost = Cost::findOrFail($id);
        $users = User::where('status', true)->get();
        return view('admin.costs.edit-individial-cost', compact('cost', 'users'));
    }


    public function updatecost(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'details' => 'required|string',
            'user' => 'required',
            'shopper' => 'required',
        ]);

        Cost::findOrFail($request->id)->update([
            'date' => $request->date,
            'amount' => $request->amount,
            'details' => nl2br(e($request->details)),
            'type' =>  'other',
            'user_id' => $request->user,
            'status' => true,
            'shopper' => json_encode($request->shopper),
        ]);

        return redirect()->route('admin.individualcost')->withSuccess('Cost Details Updated');
    }


    // Bazar
    public function bazar()
    {
        $bazars = Bazar::where('status', true)->latest()->paginate(20);
        return view('admin.bazar.bazar', compact('bazars'));
    }

    public function addbazar()
    {
        $users = User::where('status', true)->get();
        return view('admin.bazar.add-bazar', compact('users'));
    }
    public function storebazar(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'details' => 'required|string',
            'shopper' => 'required',
        ]);
        $users = User::where('status', true)->get();
        $notification = [
            'stitle' => "Bazar Added!",
            'title' =>  $request->amount ." bazar added to meal",
            'messege' => "An Admin added ".$request->amount." bazar cost. Bazar: $request->details. Check your bazar history",
            'userurl' => route('user.mybazar'),
            'adminurl' => route('admin.bazar'),
        ];
        Notification::send($users, new SendUserNotification($notification));
        Bazar::create([
            'date' => $request->date,
            'amount' => $request->amount,
            'details' => nl2br(e($request->details)),
            'status' => true,
            'shopper' => json_encode($request->shopper),
        ]);



        return redirect()->route('admin.bazar')->with('success', 'A New Bazar Add Successfully!');
    }

    public function deletebazar(Request $request)
    {
        $cost = Bazar::findOrFail($request->id);
        $users = User::where('status', true)->get();
        $notification = [
            'stitle' => "Bazar Deleted!",
            'title' =>  "An Admin delete bazar from meal",
            'messege' => "An Admin delete bazar. Check your bazar history",
            'userurl' => route('user.mybazar'),
            'adminurl' => route('admin.bazar'),
        ];
        Notification::send($users, new SendUserNotification($notification));
        if ($cost) {
            $cost->delete();
            $response = [
                'success' => true,
                'msg' => 'Bazar Deletd Successfully!'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Failed To delete!'
            ];
        }
        return response()->json($response);
    }

    public function editbazar($id)
    {
        $bazar = Bazar::findOrFail($id);
        $users = User::where('status', true)->get();
        return view('admin.bazar.edit-bazar', compact('bazar', 'users'));
    }

    public function updatebazar(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'details' => 'required|string',
            'shopper' => 'required',
        ]);

        $users = User::where('status', true)->get();
        $notification = [
            'stitle' => "Bazar updated!",
            'title' =>  "An Admin update bazar from meal",
            'messege' => "An Admin update bazar. Check your bazar history",
            'userurl' => route('user.mybazar'),
            'adminurl' => route('admin.bazar'),
        ];
        Notification::send($users, new SendUserNotification($notification));

        Bazar::findOrFail($request->id)->update([
            'date' => $request->date,
            'amount' => $request->amount,
            'details' => nl2br(e($request->details)),
            'status' => true,
            'shopper' => json_encode($request->shopper),
        ]);

        return redirect()->route('admin.bazar')->withSuccess('Bazar Details Updated');
    }

    // Pending Bazar

    public function pendingbazar()
    {
        $bazars = Bazar::where('status', false)->latest()->paginate(20);
        return view('admin.bazar.pending-bazar', compact('bazars'));
    }
    public function acceptbazar(Request $request)
    {
        $bazar = Bazar::findOrFail($request->id);

        $users = User::where('status', true)->get();
        $notification = [
            'stitle' => "Bazar Added!",
            'title' =>  $bazar->amount ." bazar added to meal",
            'messege' => "An Admin added ".$bazar->amount." bazar cost. Check your bazar history",
            'userurl' => route('user.mybazar'),
            'adminurl' => route('admin.bazar'),
        ];
        Notification::send($users, new SendUserNotification($notification));


        if ($bazar) {
            $bazar->update(['status' => true]);
            $response = [
                'success' => true,
                'msg' => 'Bazar Accepted Successfully!'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Failed To Accept!'
            ];
        }
        return response()->json($response);
    }

    // Settings
    public function settings()
    {
        return view('admin.settings');
    }

    public function everything(Request $request)
    {
        if ($request->status == true) {
            DB::table('bazars')->truncate();
            DB::table('costs')->truncate();
            DB::table('deposites')->truncate();
            DB::table('jobs')->truncate();
            DB::table('job_batches')->truncate();
            DB::table('meals')->truncate();
            DB::table('notifications')->truncate();

            $response = [
                'success' => true,
            ];

            return response()->json($response);
        }
    }


    // Dashboard
    public function showreport(Request $request)
    {
        $labels = [];
        $data = [];
        $users = User::where('status', true)->get();
        $bazars = Bazar::where('status', true)->get();

        if ($request->report == 'Deposite') {
            foreach ($users as $user) {
                $labels[] = $user->name;
                $data[] = $user->deposite->sum('amount');
            }
        } elseif ($request->report == 'Meal') {
            foreach ($users as $user) {
                $labels[] = $user->name;
                $data[] = $user->meal->sum('amount');
            }
        } elseif ($request->report == 'Balance') {
            foreach ($users as $user) {
                $labels[] = $user->name;
                $data[] = $user->deposite->sum('amount') - ($user->cost->sum('amount') + ($user->meal->sum('amount') * $request->mealrate));
            }
        } elseif ($request->report == 'Bazar') {
            foreach ($bazars as $bazar) {
                $labels[] = Carbon::parse($bazar->date)->format('d-M');
                $data[] = $bazar->amount;
            }
        } elseif ($request->report == 'MealCost') {
            foreach ($users as $user) {
                $labels[] = $user->name;
                $data[] = $user->meal->sum('amount') * $request->mealrate;
            }
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }


    // Notification
    public function notifications()
    {
        $notifications = Auth::user()->notifications()->paginate(20);
        return view('admin.notifications', compact('notifications'));
    }
    public function readandredirect($id, $url)
    {
        Auth::user()->notifications()->findOrFail($id)->markAsRead();
        return redirect(base64_decode($url));
    }
    public function deletenotification(Request $request)
    {
        $noti = Auth::user()->notifications()->findOrFail($request->id)->delete();
        if ($noti) {
            $response = [
                'success' => true,
                'msg' => 'Notification is deleted!',
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Something went wrong!',
            ];
        }

        return response()->json($response);
    }
    public function readnotification($id)
    {
        $noti = Auth::user()->notifications()->findOrFail($id)->markAsRead();
        return redirect()->back();
    }
    public function unreadnotification($id)
    {
        $noti = Auth::user()->notifications()->findOrFail($id)->markAsUnread();

        return redirect()->back();
    }
    public function deleteallnotification()
    {
        Auth::user()->notifications()->delete();
        return response()->json(['success' => true]);
    }
    public function readallnotification()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }
}
