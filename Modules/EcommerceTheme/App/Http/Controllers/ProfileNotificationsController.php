<?php

namespace Modules\EcommerceTheme\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use TomatoPHP\TomatoNotifications\Models\NotificationsTemplate;
use TomatoPHP\TomatoNotifications\Models\UserNotification;
use TomatoPHP\TomatoNotifications\Models\UserToken;
use TomatoPHP\TomatoOrders\Models\Order;
use TomatoPHP\TomatoOrders\Facades\TomatoOrdering;
use TomatoPHP\TomatoOrders\Tables\OrderTable;
use ProtoneMedia\Splade\Facades\Toast;

class ProfileNotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notification = UserNotification::where('model_type',config('tomato-crm.model'))
            ->where('model_id', auth('accounts')->user()->id)
            ->orWhere('model_id', null)
            ->orderBy('id', 'desc')
            ->paginate(5);

        foreach ($notification as $item) {
            $item->date = $item->created_at->diffForHumans();
            if ($item->template_id) {
                $template = NotificationsTemplate::find($item->template_id);
                $item->image = count($template->getMedia('image')) ? $template->getMedia('image')->first()->getUrl() : url('images/default.png');
            }
        }
        return view('ecommerce-theme::profile.notifications.index', [
            "notifications" => $notification
        ]);
    }

    public function show(UserNotification $model)
    {
        if(auth('accounts')->user()->id === $model->model_id){
            $model->read();
            $model->date = $model->created_at->diffForHumans();
            if ($model->template_id) {
                $template = NotificationsTemplate::find($model->template_id);
                $model->image = count($template->getMedia('image')) ? $template->getMedia('image')->first()->getUrl() : url('images/default.png');
            }
            return view('ecommerce-theme::profile.notifications.show', [
                "model" => $model
            ]);
        }
        else {
            return redirect()->back();
        }
    }

    public function clearUser(): \Illuminate\Http\RedirectResponse
    {
        UserNotification::where('model_type',config('tomato-crm.model'))
            ->where('model_id', auth('accounts')->user()->id)
            ->orderBy('id', 'desc')
            ->take(10)->delete();

        Toast::title(trans('tomato-notifications::global.notifications.success'))->success()->autoDismiss(2);
        return redirect()->back();
    }

    public function read()
    {
        $notifications = UserNotification::where('model_type',config('tomato-crm.model'))
            ->where('model_id', auth('accounts')->user()->id)
            ->orderBy('id', 'desc')
            ->take(10)->get();

        foreach ($notifications as $notification){
            $notification->read();
        }

        Toast::title(__('Notifications is marked as read'))->success()->autoDismiss(2);
        return redirect()->back();
    }

    public function readSelected(UserNotification $model)
    {
        if(auth('accounts')->user()->id === $model->model_id){
            $model->read();

            Toast::title(__('Notifications is marked as read'))->success()->autoDismiss(2);
            return redirect()->back();
        }
        else {
            return redirect()->back();
        }
    }

    public function destroy(UserNotification $model)
    {
        if(auth('accounts')->user()->id === $model->model_id){
            $model->delete();

            Toast::title(__('Notifications is deleted'))->success()->autoDismiss(2);
            return redirect()->back();
        }
        else {
            return redirect()->back();
        }
    }

    public function token(Request $request)
    {
        $request->validate([
            "token" => "required|string",
        ]);

        $checkEx = UserToken::where('model_type', config('tomato-crm.model'))
            ->where('model_id', auth('accounts')->user()->id)
            ->where('provider', 'fcm-web')
            ->first();

        if (!$checkEx) {
            $token = new UserToken();
            $token->model_type = config('tomato-crm.model');
            $token->model_id = auth('accounts')->user()->id;
            $token->provider = 'fcm-web';
            $token->provider_token = $request->get('token');
            $token->save();

            return back();
        } else {
            $checkEx->provider_token = $request->get('token');
            $checkEx->save();

            return back();
        }
    }
}
