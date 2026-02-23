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
use App\Models\UserLog;
use Illuminate\Http\Request;

class ShowHandler
{
    /**
     * Display the specified Users.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $user_id = null, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from $users to $data
        $data['model_info'] = User::where('user_id', $user_id)->first();
        
        // Get and assign all data from User model to $data
        $data['model_list'] = User::get();

        if($api) {
            return new ShowFormHandler($request, $user_id, $api);
        }

        // render and send view to user
        return view('admin.manage-users.users.show', $data);
    }
}