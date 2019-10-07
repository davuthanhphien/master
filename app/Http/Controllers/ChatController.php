<?php

namespace App\Http\Controllers;

use App\Events\Notifi;
use App\Events\Typing;
use App\Message;
use App\Notification;
use App\Notifications\InvoicePaid;
use App\User;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessagePosted;
use Illuminate\Support\Facades\URL;




class ChatController extends Controller
{
    public function index()
    {
        return view('admin.chat.index');
    }

    public function getUserLogin()
    {
        return Auth::user();
    }

    public function friend()
    {
        $user = User::findOrFail(\auth()->id());
        $friend = $user->friend;
        return $friend;
    }

    public function message(Request $request)
    {
        $microtime =  microtime(true);
        $input = $request->all();
        dd($input->file('image'));
        $user = Auth::user();
        if ($request->image !== null) {
            $image = $request->image;
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];;
            Image::make($request->get('image'))->save(public_path('/images/') . $name);
            $input['image'] = URL::to('/') . '/images/' . $name;
        }
        $items = explode(' ', $request->message);
        foreach ($items as $item) {
            if (filter_var($item, FILTER_VALIDATE_URL)) {
                $mess = str_replace($item, '<a href=' . '"' . $item . '"' . '>' . $item . '</a>', $request->message);
                $input['link'] = $item;
                $input['message'] = $mess;
            }
        }

        $input['room'] = auth()->id() . '|' . $request->id;

        $message = $user->messages()->create($input);

        broadcast(new MessagePosted($message, $user,$microtime))->toOthers();

        $users = User::find($request->id);
        $users->notify(new InvoicePaid());

        if (isset($mess)) {
            return $mess;
        } else {
            return $message;
        }
    }

    public function friendMessage($id)
    {
        $item = auth()->id() . '|' . $id;
        $item2 = $id . '|' . auth()->id();
        $item3 = $id;
        $user_message = Message::where('room', $item)->orWhere('room', $item2)->orWhere('room', $item3)->orderBy('created_at', 'asc')->get();
        return ['message' => $user_message, 'id' => $id];
    }

    public function notification($id)
    {
        $notification = Notification::where('user_id', \auth()->id())->where('friend_id', $id)->first();
        return $notification;
    }

    public function postNotification(Request $request)
    {
        $notification = Notification::where('user_id', \auth()->id())->where('friend_id', $request->id)->first();
        if (isset($notification)) {
            $amount = $request->amount + $notification->amount;
            $notification->update([
                'amount' => $amount,
                'name' => 'Bạn có ' . $amount . 'tin nhắn',
                'user_id' => \auth()->id(),
                'friend_id' => $request->id,
            ]);
        }else{
            $notification = Notification::create([
                'amount' => 1,
                'name' => 'Bạn có 1 tin nhắn',
                'user_id' => \auth()->id(),
                'friend_id' => $request->id,
            ]);
        }
        return $notification;
    }

    public function postTyping(Request $request)
    {
        $user = Auth::user();
        $id = $request->id;
        $type = $request->type;
        broadcast(new Typing($user, $id, $type))->toOthers();
    }

    public function deleteNotification($id)
    {
        $notification = Notification::where('user_id', \auth()->id())->where('friend_id', $id)->first();
        if ($notification == null || !$notification) {
            return response()->json('không có notification');
        } else {
            $notification->delete();
        }
    }

    public function updateMessage(Request $request)
    {
        $message = Message::findOrFail($request->id);

        $message->update(['status' => $request->status]);

        return $message;
    }

    public function online(Request $request){
        $user = User::findOrFail($request->data);
        $user->update(['online'=>1]);
    }
    public function offline(Request $request){
        $user = User::findOrFail($request->data);
        $user->update(['online'=>0]);
    }
    public function getOnline(){
        $user = User::where('online',1)->pluck('id');
        return $user;
    }

}
