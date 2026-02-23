<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Location;

use Helper;
use Validator;
use App\Models\Location;
use App\Models\Post;
use Illuminate\Http\Request;

class UpdateHandler
{
    /**
     * Update the specified Locations in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $location_id = null, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = Location::where('location_id', $location_id)->first();

        // initialize $body: data that need to be updated
        $body = [];
        if(isset($inputs->location_id)) $body['location_id'] = $inputs->location_id; // check if field 'location_id' exist from the request and then add it to $body
        if(isset($inputs->name)) $body['name'] = $inputs->name; // check if field 'name' exist from the request and then add it to $body
        if(isset($inputs->parent_location_id)) $body['parent_location_id'] = $inputs->parent_location_id; // check if field 'parent_location_id' exist from the request and then add it to $body
        if(isset($inputs->type)) $body['type'] = ($inputs->type)? $inputs->type: 0; // check if field 'type' exist from the request and then add it to $body
        if(isset($inputs->latitude)) $body['latitude'] = $inputs->latitude; // check if field 'latitude' exist from the request and then add it to $body
        if(isset($inputs->longitude)) $body['longitude'] = $inputs->longitude; // check if field 'longitude' exist from the request and then add it to $body
        
        // if there is data to update then update
        if(count($body)){
            // update locations table
            $model->update($body);
        }
        if(is_array($request->locations_list)) {
            $updated_ids = [];
            $old_ids = Location::where('parent_location_id', $model->location_id)->pluck('location_id')->toArray();
            foreach($request->locations_list as $index => $item) {
                $sub_body = [
                    'name' => $item['name'],
                    'parent_location_id' => $item['parent_location_id'],
                    'type' => $item['type'],
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude'],
                ];

                if(isset($item['location_id']) && in_array($item['location_id'], $old_ids)) {
                    $updated_ids[] = $item['location_id'];
                    Location::where('location_id', $item['location_id'])->update($sub_body);
                } else {
                    Location::create($sub_body);
                }
            }

            foreach ($old_ids as $value) {
                if(!in_array($value, $updated_ids)){
                    Location::where('location_id', $value)->delete();
                }
            }
        }

        if($request->ajax() || $api) {
            $locations_default = [ 
                ['id'=>'', 'name'=>'Select locations'], 
                ['id'=>'<new>', 'name'=>'Create new locations'], 
            ];
            $locations_new = Location::orderBy('name', 'ASC')->get(['location_id as id','name as name'])->toArray();
            $locations_list = (array) array_merge($locations_default, $locations_new);
                
            return response()->json([
                "status"=>"success",
                "locations_list"=> $locations_list,
                "selected_id"=>$model->location_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Locations data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Locations data updated']);
    }
}