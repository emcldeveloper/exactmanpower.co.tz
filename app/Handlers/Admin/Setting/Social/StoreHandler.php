<?php
/**
 * @category Application
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

class StoreHandler
{
    /**
     * Store a newly created Socials in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $rules is set of validation rules
        $rules = [
        	'name' => 'required',
        ];

        // validate request data before continue
        $validator = Validator::make($request->all(), $rules);

        // if request data is valid it continue 
        // if is invalid return back with errors
        if ($validator->fails()) { 
            if($request->ajax()) {
                return ['errors' => $validator->errors()];
            }

            return redirect()->back()->withErrors($validator)->withInput();
        } 

        $filename = Helper::save_uploaded_file($request, 'icon');
        
        // $body is the array of data to be save to socials table 
        $body = [
            'name' => $request->name,
            'icon' => $filename,
        ];

        // saving the $body data to socials table
        $model = Social::create($body);
        if($model) {
            if(is_array($request->post_socials_list)) {
                for ($i = 0; $i < count($request->post_socials_list); $i++) {
                    PostSocial::create([
                        'post_id' => "",
                        'social_id' => $model->social_id,
                    ]);
                }
            }
        }

        if($request->ajax()) {
            $socials_default = [ 
                ['id'=>'', 'name'=>'Select socials'], 
                ['id'=>'<new>', 'name'=>'Create new socials'], 
            ];
            $socials_new = Social::orderBy('name', 'ASC')->get(['social_id as id','name as name'])->toArray();
            $socials_list = (array) array_merge($socials_default, $socials_new);
                
            return [
                "status"=>"success",
                "socials_list"=> $socials_list,
                "selected_id"=>$model->social_id
            ];
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Socials data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('admin/settings/socials/edit/'.$model->id)->with(['alert-success'=>'Socials data saved']);
    }
}