<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Location;

use App\Models\Location;
use App\Models\Post;
use Illuminate\Http\Request;

class EditHandler
{
    /**
     * Show the form for editing the specified Locations.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $location_id = null, $api = false)
    {

        // initialize data to send to the view or client
        $data = [];

        $data['locations'] = new Location();

        // Get and assign all data from $Location to $data
        $data['model_info'] = Location::where('location_id', $location_id)->first();

        // render and send view to user
        return view('admin.setting.locations.edit', $data);
    }
}