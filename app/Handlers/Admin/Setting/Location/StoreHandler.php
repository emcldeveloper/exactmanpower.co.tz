<?php
/**
 * @category Application
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

class StoreHandler
{
    /**
     * Store a newly created Locations in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $rules is set of validation rules
        $rules = [
        	'name' => 'required',
        	'parent_location_id' => 'required|exists:locations,parent_location_id',
        	'type' => 'required',
        	'latitude' => 'required',
        	'longitude' => 'required',
        ];

        // validate request data before continue
        $validator = Validator::make($request->all(), $rules);

        // if request data is valid it continue 
        // if is invalid return back with errors
        if ($validator->fails()) { 
            if($request->ajax() || $api) {
                return response()->json(['errors' => $validator->errors()]);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        } 
        
        // $body is the array of data to be save to locations table 
        $body = [
            'name' => $request->name,
            'parent_location_id' => $request->parent_location_id,
        	'type' => ($request->type)? $request->type: 1,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ];

        // saving the $body data to locations table
        $model = Location::create($body);
        if($model) {
            if(is_array($request->locations_list)) {
                foreach($request->locations_list as $index => $item) {
                    Location::create([
                        'name' => $item['name'],
                        'parent_location_id' => $item['parent_location_id'],
                        'type' => $item['type'],
                        'latitude' => $item['latitude'],
                        'longitude' => $item['longitude'],
                    ]);
                }
            }
        }

        if($request->ajax() || $api) {
            $locations_default = [ 
                ['key'=>'', 'value'=>'Select locations'], 
                ['key'=>'<new>', 'value'=>'Create new locations'], 
            ];
            $locations_new = Location::orderBy('name', 'ASC')->get(['location_id as key','name as value'])->toArray();
            $options_list = (array) array_merge($locations_default, $locations_new);
                
            return response()->json([
                "status"=>"success",
                "options_list"=> $options_list,
                "selected_id"=>$model->location_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Locations data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('admin/setting/locations/edit/'.$model->location_id)->with(['alert-success'=>'Locations data saved']);
    }
}