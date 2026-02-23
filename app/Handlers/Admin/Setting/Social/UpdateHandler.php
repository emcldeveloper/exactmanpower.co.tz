<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Social;

use Helper;
use Validator;
use App\Models\Social;
use App\Models\PostSocial;
use Illuminate\Http\Request;

class UpdateHandler
{
    /**
     * Update the specified Socials in storage.
     *
     * @param  int  $id
     * @param  \App\Models\Social  $socials
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, Social $socials, $id = null, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = $socials->where('id', $id);

        // initialize $body: data that need to be updated
        $body = [];
        
        // check if field 'social_id' exist from the request and then add it to $body
        if(isset($inputs->social_id)) $body['social_id'] = $inputs->social_id;
        
        // check if field 'name' exist from the request and then add it to $body
        if(isset($inputs->name)) $body['name'] = $inputs->name;

        $filename = Helper::save_uploaded_file($request, 'icon');
        if(isset($filename)) $body['icon'] = $filename;
        
        // if there is data to update then update
        if(count($body)){
            // update socials table
            $model->update($body);
        }
        if(is_array($request->post_socials_list)) {
            PostSocial::where('id', $id)->delete();
            for ($i = 0; $i < count($request->post_socials_list); $i++) {
                PostSocial::create([
                    'post_id' => "",
                    'social_id' => $model->social_id,
                ]);
            }
        }

        if($request->ajax()) {
            $socials_default = [ 
                ['id'=>'', 'name'=>'Select socials'], 
                ['id'=>'<new>', 'name'=>'Create new socials'], 
            ];
            $socials_new = Social::orderBy('name', 'ASC')
                ->get(['social_id as id', 'name as name'])
                ->toArray();

            $socials_list = (array) array_merge($socials_default, $socials_new);
                
            return [
                "status" => "success",
                "socials_list" => $socials_list,
                "selected_id" => $model->social_id
            ];
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Socials data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Socials data updated']);
    }
}