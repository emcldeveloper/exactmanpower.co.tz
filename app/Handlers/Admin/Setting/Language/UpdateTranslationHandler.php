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
use App\Models\TranslatorTranslation;
use App\Models\PostTag;
use Illuminate\Http\Request;

class UpdateTranslationHandler
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
    public static function handler(Request $request)
    {
        $data = explode('-', $request->data);
        $locale = $data[0];
        $group = $data[1];
        $item = $data[2];
        $text = $request->text;

        $translation = TranslatorTranslation::where('locale', $locale)
                    ->where('group', $group)
                    ->where('item', $item)
                    ->first();
        
        if($translation) {
            $translation->update(['text'=>$text]);
        } else {
            TranslatorTranslation::create([
                'locale' => $locale,
                'namespace' => '*',
                'group' => $group,
                'item' => $item,
                'text' => $text,
                'descriptions' => $text,
                'unstable' => 0,
                'locked	' => 0,
            ]);
        }

        return ['status'=>'success'];
    }
}