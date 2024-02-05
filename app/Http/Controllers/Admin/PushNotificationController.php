<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\cr;
use App\Models\PushNotification;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $push_notifications = PushNotification::orderBy('created_at', 'desc')->paginate(25);
        return view('admin.notification.index', compact('push_notifications'));
    }
    public function bulksend(Request $req){
        try{
        $comment = new PushNotification();
        $comment->title = $req->input('title');
        $comment->body = $req->input('body');
        $comment->save();
        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $req->id,'status'=>"done");
        $notification = array('title' =>$req->title, 'body' => $req->body, 'sound' => 'default', 'badge' => '1',);
        $arrayToSend = array('to' => "/topics/all", 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
        $fields = json_encode ($arrayToSend);
        $headers = array (
            'Authorization: key=' . "AAAA355yacU:APA91bHFP_gfyb0UshvP9teHwID9bTV-SkTENKKzDLdiiH8DwaC4arAI--LHBHUzZRJUngJPttbC1KapP6MbyL2WwJCEA-a8b73Ii-lPZWjn8CUrn2E7W_8Q7KrkB8ijgTkB7TMztH1f",
            'Content-Type: application/json'
        );
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        $result = curl_exec ( $ch );
        //var_dump($result);
        curl_close ( $ch );
        return redirect()->back()->with('success', 'Notification Send successfully');
}        catch(\Exception $e){

		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notification.create');
    }
    public function deletenotifications($id)
    {
        $notifications = PushNotification::find($id);
        $notifications->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->route('all-notifications');
    }
    public function search(Request $request)
    {
        $output = "";
        $output .='<tr>

                                    <th >'.trans('admin.title').'</th>
                                    <th >'.trans('admin.body').'</th>






                                    <th >'.trans('admin.delete').'</th>
                                </tr>';
        $users = PushNotification::where('title', 'Like', '%' . $request->search . '%')->orwhere('body', 'Like', '%' . $request->search . '%')->get();
        foreach ($users as $user) {
            $output .= '<tr id="sid '.$user->id.'}}">
<td>' . $user->title . '</td>
<td>' . $user->body . '</td>

   <td>' . ' <a href="/deletenotifications/' . $user->id . '"  class="btn btn-danger btn-sm">'.trans('admin.delete').'</a>' . '</td>
</tr>';
        }
        return response($output);
    }

}
