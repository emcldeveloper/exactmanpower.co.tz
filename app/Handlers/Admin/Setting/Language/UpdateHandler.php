<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Language;

use Validator;
use App\Models\TranslatorLanguage;
use App\Models\PostTag;
use Illuminate\Http\Request;

class UpdateHandler
{
    /**
     * Update the specified Languages in storage.
     *
     * @param  int  $id
     * @param  \App\Models\TranslatorLanguage  $languages
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, TranslatorLanguage $languages, $id = null, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = $languages->where('id', $id);

        // initialize $body: data that need to be updated
        $body = [];
        
        // check if field 'id' exist from the request and then add it to $body
        if(isset($inputs->id)) $body['id'] = $inputs->id;
        
        // check if field 'name' exist from the request and then add it to $body
        if(isset($inputs->name)) $body['name'] = $inputs->name;
        
        // check if field 'name' exist from the request and then add it to $body
        if(isset($inputs->locale)) $body['locale'] = $inputs->locale;
        
        // if there is data to update then update
        if(count($body)){
            // update languages table
            $model->update($body);
        }
        if(is_array($request->post_tags_list)) {
            PostTag::where('id', $id)->delete();
            for ($i = 0; $i < count($request->post_tags_list); $i++) {
                PostTag::create([
                    'post_id' => "",
                    'id' => $model->id,
                ]);
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
            return redirect($redirect)->with(['alert-success'=>'Languages data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Languages data updated']);
    }
}