<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Social;

use App\Models\Social;
use App\Models\PostSocial;
use Illuminate\Http\Request;

class IndexTableHandler
{
    /**
     * Display a listing of the Socials.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');
        
        // initialize Social model
        $model = (new Social)->newQuery();
        
        // check if user request for search
        if($search){
            // this do the margic for search in $model
            $model->where(function($query) use($search){
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('social_id', 'LIKE', "%".$search."%") // match Social column
                    ->orWhere('name', 'LIKE', "%".$search."%"); // match Name column
            });
        }

        // assign model values to $data
        $data['socials_list'] = (object) $model->paginate($limit);

        // if $api is true return the json data
        if($api){
            // send data to ui
            return $data;
        }

        // if $api is false return the view
        return view('admin.settings.socials.index-table', $data);
    }
}