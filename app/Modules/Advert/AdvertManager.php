<?php
namespace App\Modules\Advert;


use App\Modules\Advert\Model\Advert;
use App\Modules\Advert\Model\AdvertCategory;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;

class AdvertManager {

    /**
     * @var array
     */
    private $used = [];

    /**
     * @var object;
     */
    private static $instance;

    /**
     * @return AdvertManager
     */
    public static function getInstance()
    {
        return static::$instance ?: (static::$instance = new self());
    }


    /**
     * Search advert by AdvertCategory type
     * If duplicate set to true then it's possible that advert will be the same with
     * previous showed advert
     *
     * @param $name
     * @param bool $duplicate
     * @return HtmlString|string
     */
    public function getHTML($name, $duplicate = false){
        $advert_category = AdvertCategory::where('name', $name)->first();

        if(!$advert_category){
            return '';
        }

        $advert = $advert_category
            ->adverts()
            ->where('status', Advert::STATUS_APPROVED)
            ->where(function($query) use ($duplicate){
                if(!$duplicate){
                    $query->whereNotIn('id', $this->used);
                }
            })
            ->active()
            ->orderBy('viewed_at', 'ASC')
            ->first();

        if($advert){
            $advert->plusViews();
            $advert->updateLastViewed();
            $this->used[$name][] = $advert->id;
            $html = View::make('partials.advert', compact('advert'))->render();
            return new HtmlString($html);
        } else {
            return '';
        }
    }

}