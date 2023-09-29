<?php

namespace App;

use Core\Controller;
use Core\Helper\Guzzle\Client;
use Core\Helper\Guzzle\RequestBucket;
use Core\HTTP\ResponseContent;
use Core\HTTP\ResponseJson;


class TestController extends Controller
{
    protected $arr = [
        '1_Тиморское',
        '2_Арафурское',
        '3_Коралловое',
        '4_Тасманово',
        '5_Карпентария_залив',
        '6_Спенсера_залив',
        '7_Большой_австралийский',
        '8_Географа',
        '9_Жозеф-Бонапарт_залив',
        '10_Тасман',
        '11_Торресов',
        '12_Бассов',
        '13_Кука',
        '14_Большой_Барьерный_Риф',
        '15_Новая_Зеландия',
        '16_Чатем',
        '17_Тасмания',
        '18_Кенгуру',
        '19_Тимор',
        '20_Новая_Гвинея',
        '21_Арх_Бисмарка',
        '22_Новая_Британия',
        '23_Новая_Ирландия',
        '24_Соломоновы_острова',
        '25_острова_Новые_Гебриды',
        '26_острова_Новая_Каледония',
        '27_Тувалу_острова',
        '28_Фиджи_острова',
        '29_Тонга_острова',
        '30_Арнемленд_Полуостров',
        '31_Йорк_Полуостров',
        '32_Эйр_Полуостров',
        '33_Кейп-Йорк_Полуостров',
        '34_Австралийские Альпы',
        '35_Большой_водораздельный_хребет',
        '36_Макдоннелл_горы',
        '37_Масгрейв_горы',
        '38_Хамерсли_горы',
        '39_Флиндерс_горы',
        '40_Западно-Австралийское плоскогорье',
        '41_Кимберли_плато',
        '42_Карпентария_низменность ',
        '43_Налларбор_низменность',
        '44_Равнины Муррея-Дарлинга',
        '45_Центральная низменность',
        '46_Муррей река',
        '47_Дарлинг река',
        '48_Купер-крик',
        '49_Даймантина река',
        '50_Джорджина река',
        '51_Фицрой река',
        '52_Флиндерс река',
        '53_Ропер река',
        '54_Гаскойн река',
        '55_Финке река',
        '56_Амадиус озеро',
        '57_Барли озеро',
        '58_Торренс озеро',
        '59_Эйр озеро',
        '60_From озеро',
        '61_Большая пустыня Виктория',
        '62_Большая песчаная пустыня',
        '63_Gibson пустыня',
        '64_Simpson пустыня'
    ];
    public function index()
    {

        if (empty($_SESSION['arr'])) {
            $_SESSION['arr'] = $this->arr;
        }

        $y = array_rand($_SESSION['arr']);
        $b = array_rand($_SESSION['arr']);


        echo '<h1>' .  str_repeat('_', 100) . '</h1>';
        echo '<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_SESSION['arr'][$y] . '&nbsp;&nbsp;&nbsp;&nbsp;' . $_SESSION['arr'][$b] . '</h1>';
        echo '<h1>' .  str_repeat('_', 100) . '</h1>';

        dump(...$_SESSION['arr']);

        unset($_SESSION['arr'][$y], $_SESSION['arr'][$b]);
        exit();
        //return new ResponseJson();
//        $bucket = (new RequestBucket())
//            ->setUrl('ut.su/mashle/episode-3.htmle')
//            ->setMethod(RequestBucket::GET);
//        $request = (new Client())->requestBucket($bucket);

//        return (new ResponseContent())
//            ->setContent($request->getBody());

    }





}
