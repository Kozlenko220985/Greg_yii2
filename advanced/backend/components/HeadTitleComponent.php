<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 06.10.2017
 * Time: 20:27
 */

namespace backend\components;

use yii\base\Widget;
use yii\helpers\Html;

class HeadTitleComponent extends Widget
{

    /**
     * @var string $label
     */
    public $label;

    /**
     * @var array $buttons
     */
    public $buttons;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $content = Html::tag('div',
            Html::tag('div', self::renderTitle($this->label), ['class' => 'col-sm-6']) .
            Html::tag('div', self::renderButtons($this->buttons), ['class' => 'col-sm-6 text-right']),
            ['class' => 'row']
        );
        return $content;
    }

    private static function renderTitle($title)
    {
        return Html::tag('h3', Html::tag('b', $title));
    }

    private static function renderButtons($config){
        $response = '';
        foreach ($config as $item) {
            $response .= ' ' . self::renderButton($item);
        }
        return $response;
    }

    private static function renderButton($config){
        $config = array_values($config);
        return Html::a(...$config);
    }

}