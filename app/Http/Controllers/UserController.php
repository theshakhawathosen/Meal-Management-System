<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cost;
use App\Models\Meal;
use App\Models\User;
use App\Models\Bazar;
use App\Models\Deposite;
use App\Notifications\SendAdminNotification;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
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
        $labels = json_encode( $labels);
        $data = json_encode($data);

        return view('user.dashboard', compact('data','labels','mealrate', 'mealbalance', 'totalDeposite', 'totalCost', 'totalBazar', 'totalMeal', 'totalUser', 'users'));
    }
    public function logout()
    {
        Auth::logout();
        session()->regenerate();
        return redirect('/')->withSuccess('Logout Success!');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function Updateprofile(Request $request)
    {
        $user = [];
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
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

        return redirect()->route('user.profile')->with('success','Profile Update Successfully!');

    }

    public function showreport(Request $request)
    {
        $labels = [];
        $data = [];
        $users = User::where('status', true)->get();
        $bazars = Bazar::where('status',true)->get();

        if ($request->report == 'Deposite') {
            foreach ($users as $user) {
                $labels[] = $user->name;
                $data[] = $user->deposite->sum('amount');
            }
        }
        elseif($request->report == 'Meal')
        {
            foreach ($users as $user) {
                $labels[] = $user->name;
                $data[] = $user->meal->sum('amount');
            }
        }
        elseif($request->report == 'Balance')
        {
            foreach ($users as $user) {
                $labels[] = $user->name;
                $data[] = $user->deposite->sum('amount') - ($user->cost->sum('amount') + ($user->meal->sum('amount') * $request->mealrate));
            }
        }
        elseif($request->report == 'Bazar')
        {
            foreach ($bazars as $bazar) {
                $labels[] = Carbon::parse($bazar->date)->format('d-M');
                $data[] = $bazar->amount;
            }
        }
        elseif($request->report == 'MealCost')
        {
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



    // Deposite
    public function mydeposite()
    {
        $deposites = Deposite::where('status', true)->where('user_id',Auth::id())->latest()->get();
        return view('user.deposite.deposite-history', compact('deposites'));
    }

    public function deleteDeposite(Request $request)
    {
        $deposite = Deposite::find($request->id);
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
        $deposites = Deposite::where('status', false)->where('user_id',Auth::id())->latest()->get();
        return view('user.deposite.pending-history', compact('deposites'));
    }

    public function requestdeposite()
    {
        return view('user.deposite.deposite-request');
    }

    public function storedeposite(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'amount' => 'required',
        ]);

        Deposite::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'date' => $request->date,
            'status' => 0,
        ]);

        $users = User::where('status', true)->where('role','admin')->get();
        $notification = [
            'stitle' => "Deposite Request Found!",
            'title' =>  Auth::user()->name ." - send Deposite Request",
            'messege' => "An Admin update bazar. Check pending deposite history",
            'userurl' => route('user.requestdeposite'),
            'adminurl' => route('admin.pendingDeposite'),
            'newuser' => Auth::user(),
        ];
        Notification::send($users, new SendAdminNotification($notification));

        return redirect()->route('user.pendingdeposite')->withSuccess('Deposite Request send,wait for confirmation.');

    }



    // Meal
    public function mymeal()
    {
        $meals = Meal::where('status', true)->where('user_id',Auth::id())->latest()->get();
        return view('user.meal.meal-history', compact('meals'));
    }

    public function deletemeal(Request $request)
    {
        $meal = Meal::find($request->id);
        if ($meal) {
            $meal->delete();
            $response = [
                'success' => true,
                'msg' => 'Meal Deleted Successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Something Went wrong to meal'
            ];
        }

        return response()->json($response);
    }

    public function pendingmeal()
    {
        $meals = Meal::where('status', false)->where('user_id',Auth::id())->latest()->get();
        return view('user.meal.pending-history', compact('meals'));
    }

    public function requestmeal()
    {
        return view('user.meal.meal-request');
    }

    public function storemeal(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'amount' => 'required',
        ]);

        Meal::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'date' => $request->date,
            'status' => 0,
        ]);

        $users = User::where('status', true)->where('role','admin')->get();
        $notification = [
            'stitle' => "Meal Request Found!",
            'title' =>  Auth::user()->name ." - send meal Request",
            'messege' => "An Admin update bazar. Check pending meal history",
            'userurl' => route('user.requestmeal'),
            'adminurl' => route('admin.pendingmeal'),
            'newuser' => Auth::user(),
        ];
        Notification::send($users, new SendAdminNotification($notification));

        return redirect()->route('user.pendingmeal')->withSuccess('Meal Request send,wait for confirmation.');

    }

    // My Cost
    public function mycost()
    {
        $costs = Cost::where('status',true)->where('user_id',Auth::id())->latest()->get();
        return view('user.cost.cost-history',compact('costs'));
    }


    // Bazar
    public function mybazar()
    {
        $bazars = Bazar::where('status', true)->latest()->paginate(20);
        return view('user.bazar.bazar-history', compact('bazars'));
    }

    public function deletebazar(Request $request)
    {
        $bazar = Bazar::find($request->id);
        if ($bazar) {
            $bazar->delete();
            $response = [
                'success' => true,
                'msg' => 'Bazar Deleted Successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Something Went wrong to bazar'
            ];
        }

        return response()->json($response);
    }

    public function pendingbazar()
    {
        $bazars = Bazar::where('status', false)->latest()->paginate(20);
        return view('user.bazar.pending-history', compact('bazars'));
    }

    public function requestbazar()
    {
        $users = User::where('status',true)->get();
        return view('user.bazar.bazar-request',compact('users'));
    }

    public function storebazar(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'details' => 'required|string',
            'shopper' => 'required',
        ]);

        Bazar::create([
            'date' => $request->date,
            'amount' => $request->amount,
            'details' => nl2br(e($request->details)),
            'status' => false,
            'shopper' => json_encode($request->shopper),
        ]);


        $users = User::where('status', true)->where('role','admin')->get();
        $notification = [
            'stitle' => "Bazar Request Found!",
            'title' =>  Auth::user()->name ." - send bazar Request",
            'messege' => "An Admin update bazar. Check pending bazar history",
            'userurl' => route('user.requestbazar'),
            'adminurl' => route('admin.pendingbazar'),
            'newuser' => Auth::user(),
        ];
        Notification::send($users, new SendAdminNotification($notification));

        return redirect()->route('user.pendingbazar')->with('success', 'Bazar requested,wait for confirmation');
    }



    // Notification
public function notifications()
    {
        $notifications = Auth::user()->notifications()->paginate(20);
        return view('user.notifications',compact('notifications'));
    }
    public function readandredirect($id,$url)
    {
        Auth::user()->notifications()->findOrFail($id)->markAsRead();
        return redirect(base64_decode($url));
    }
    public function deletenotification(Request $request)
    {
        $noti = Auth::user()->notifications()->findOrFail($request->id)->delete();
        if($noti)
        {
            $response = [
                'success' => true,
                'msg' => 'Notification is deleted!',
            ];
        }else
        {
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
