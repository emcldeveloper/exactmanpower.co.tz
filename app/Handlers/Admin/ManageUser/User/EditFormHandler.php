<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\User;

use App\Models\User;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Location;
use App\Models\UserLog;
use App\Models\Log;
use Illuminate\Http\Request;

class EditFormHandler
{
    /**
     * Show the form for editing the specified Users.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $user_id = null, $api = false, $redirect = null, $hidden = [])
    {

        // initialize data to send to the view or client
        $data = [];

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $users to $data
        $data['model_info'] = User::where('user_id', $user_id)->first();

        // Get and assign all data from Post model to $data
        $data['model_posts_list'] = Post::where('post_author', $user_id)
                ->pluck('post_id')
                ->toArray();
        // Get and assign all data from UserLog model to $data
        $data['user_logs_list'] = UserLog::orderBy('id', 'ASC')->get();

        // Get and assign all data from UserLog model to $data
        $data['model_user_logs_list'] = UserLog::where('user_id', $user_id)
                ->pluck('user_log_id')
                ->toArray();
        // Get and assign child child all data from Log model to $data
        $data['logs_list'] = Log::orderBy('name', 'ASC')->get();
        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.manage-users.users.edit-form', $data);
    }
}