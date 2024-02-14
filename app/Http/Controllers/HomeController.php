<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoCategory\Models\Type;
use TomatoPHP\TomatoCrm\Models\Contact;
use TomatoPHP\TomatoSaas\Models\CentralUser;
use TomatoPHP\TomatoSaas\Models\Tenant;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function demo()
    {
        return view('demo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'username' => [
                'required',
                'regex:/^[a-zA-Z]*$/',
                'min:3',
                Rule::unique('syncs', 'username')
            ],
            'password' => 'required|min:6|confirmed|string|max:255',
            'store' => 'required|string|max:255',
        ]);

        $account = new \App\Models\Account();
        $account->name = $request->get('first_name') .' ' . $request->get('last_name');
        $account->email = $request->get('email');
        $account->phone = $request->get('phone');
        $account->username = $request->get('email');
        $account->loginBy = "email";
        $account->type = "saas";
        $account->password = bcrypt($request->get('password'));
        $account->save();

        $sync = new CentralUser();
        $sync->global_id = $request->get('username');
        $sync->first_name = $request->get('first_name');
        $sync->last_name = $request->get('last_name');
        $sync->password = bcrypt($request->get('password'));
        $sync->email = $request->get('email');
        $sync->phone = $request->get('phone');
        $sync->type = $request->get('type');
        $sync->plan = $request->get('plan');
        $sync->user_id = $account->id;
        $sync->username = Str::lower($request->get('username'));
        $sync->store = $request->get('store');
        $sync->apps = [];
        $sync->save();

        $saas = Tenant::create([
            'id' => $request->get('username')
        ]);

        $saas->domains()->create([
            'domain' => $request->get('username') .'.'. config('tenancy.central_domains.0')
        ]);

        $sync->tenants()->attach($saas);
        $token = tenancy()->impersonate($saas, 1, '/admin', 'web');

        try {
            $user = User::first();
            $user->notifyDiscord(
                title: "=========== New DEMO User =========== \n".' NAME: '.$account->name . " \n EMAIL: " . $account->email . " \n PHONE: " . $account->phone . " \n USERNAME: " . $sync->username . " \n STORE: " . $sync->store . " \n DOMAIN: https://" . $saas->domains[0]->domain,
                webhook: config('services.discord.notification-webhook')
            );
        }catch (\Exception $exception){
            // do nothing
        }

        Toast::title(__('Your Domain Has Been Created'))->success()->autoDismiss(5);
        return redirect()->to('https://'.$saas->domains[0]->domain . '/admin/login/url?token='.$token->token .'&email='. $sync->email);
    }

    public function report(Request $request)
    {
        $request->validate([
           "error" => "required"
        ]);

        $getErrorType = Type::where('key', 'error')->where('for', 'contact')->where('type', 'type')->first();
        if(!$getErrorType){
            $getErrorType = new Type();
            $getErrorType->name = "Error";
            $getErrorType->key = "error";
            $getErrorType->for = "contact";
            $getErrorType->type = "type";
            $getErrorType->save();
        }

        $getPendingStatus = Type::where('key', 'pending')->where('for', 'contact')->where('type', 'status')->first();
        if(!$getPendingStatus){
            $getPendingStatus = new Type();
            $getPendingStatus->name = "Pending";
            $getPendingStatus->key = "pending";
            $getPendingStatus->for = "contact";
            $getPendingStatus->type = "status";
            $getPendingStatus->save();
        }

        Contact::create([
            "type_id" => $getErrorType->id,
            "status_id" => $getPendingStatus->id,
            "name" => "from server",
            "email" => "admin@admin.com",
            "phone" => "admin@admin.com",
            "subject" => "ERROR",
            "message" => $request->get('error'),
        ]);

        return redirect()->away('https://tomatophp.com');
    }
}
