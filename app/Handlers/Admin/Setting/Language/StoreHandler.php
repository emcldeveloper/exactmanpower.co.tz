<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Language;

use Validator;
use App\Models\TranslatorLanguage;
use App\Models\PostTag;
use Illuminate\Http\Request;

class StoreHandler
{
    /**
     * Store a newly created Languages in storage.
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
            'locale'=>'required'
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
        
        // $body is the array of data to be save to languages table 
        $body = [
            'name' => $request->name,
            'locale' => $request->locale,
        ];

        // saving the $body data to languages table
        $model = TranslatorLanguage::create($body);
        if($model) {
            if(is_array($request->post_tags_list)) {
                for ($i = 0; $i < count($request->post_tags_list); $i++) {
                    PostTag::create([
                        'post_id' => "",
                        'id' => $model->id,
                    ]);
                }
            }
        }

        if($request->ajax()) {
            $tags_default = [ 
                ['id'=>'', 'name'=>'Select languages'], 
                ['id'=>'<new>', 'name'=>'Create new languages'], 
            ];
            $tags_new = TranslatorLanguage::orderBy('name', 'ASC')->get(['id as id','name as name'])->toArray();
            $languages_list = (array) array_merge($tags_default, $tags_new);
                
            return [
                "status"=>"success",
                "languages_list"=> $languages_list,
                "selected_id"=>$model->id
            ];
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Languages data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('admin.setting.languages/edit/'.$model->id)->with(['alert-success'=>'Languages data saved']);
    }
}