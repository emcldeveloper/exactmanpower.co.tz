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
use Illuminate\Support\Facades\File;

class DeleteHandler
{
    /**
     * Remove the specified Users from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $user_id = null, $api = false)
    {
        // Find profile_url file
        self::delete_profile_url($users, $user_id);
        // Find Users from users table and delete
        User::where('user_id', $user_id)->delete();

        if($api) {
            return response()->json(['status'=>'success', 'message'=>'Users data deleted']);
        }

        if(request('redirect')){
            return redirect(request('redirect'))->with(['alert-success'=>'Users data deleted']);
        }

        // redirect to list page with success massage
        return redirect()->back()->with(['alert-success'=>'Users data deleted']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $users
     * @return \Illuminate\Http\Response
     */
    public function delete_profile_url(User $users, $user_id = null)
    {
        $model = $users->where('user_id', $user_id)->first();
        if($model){
            $filename = public_path('uploaded/'.$model->profile_url);
            if(File::exists($filename)){
                File::delete($filename);
            }
        }
    }
}