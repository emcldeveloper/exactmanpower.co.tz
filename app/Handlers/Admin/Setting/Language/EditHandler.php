<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Language;

use App\Models\TranslatorLanguage;
use App\Models\PostTag;
use Illuminate\Http\Request;

class EditHandler
{
    /**
     * Show the form for editing the specified Languages.
     *
     * @param  int  $id
     * @param  \App\Models\TranslatorLanguage $languages
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, TranslatorLanguage $languages, $id = null)
    {

        // initialize data to send to the view or client
        $data = [];

        $data['languages'] = new TranslatorLanguage();

        // Get and assign all data from $languages to $data
        $data['model'] = $languages->where('id', $id)->first();

        // render and send view to user
        return view('admin.setting.languages.edit', $data);
    }
}