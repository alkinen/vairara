<?php
session_start();
class Mserver
{
	const USER_AUTH_LOGIN = "mbank"; //для доступа к кошельку используя client_id и client_secret для тестовой среды
    const USER_AUTH_PASS = "secret"; //(mbank / secret) и учетную запись кошелька
    const client_id = "mbank_storefront"; // доступа для API витрины используя учетные данные тестовой среды
    const client_secret = "oklol"; // client_id/client_secret =  mbank_storefront / oklol.
    private $url = "https://www.synq.ru/mserver2-dev/oauth/token";//url OAuth
    private $url_card = "https://www.synq.ru/mserver2-dev/v1/cards";//url создания карт
    private $url_wallet = "https://www.synq.ru/mserver2-dev/v1/wallet";//url кошелька
    private $url_wallet_activate = "https://www.synq.ru/mserver2-dev/v1/wallet/activate";//url для активации кошелька
    private $url_person_info = "https://www.synq.ru/mserver2-dev/v1/wallet/person";
    private $url_payments = "https://www.synq.ru/mserver2-dev/v1/payments";//url оплаты
    private $url_card_payments = "https://www.synq.ru/mserver2-dev/application/payments";
    private $access_token = ''; // инициализируем возвращаемое значение
    private $basic_auth_login;
    private $basic_auth_pass;
    private $phone = '+79261234567'; // инициализируем возвращаемое значение $phone номер клиента +79261234567
    private $pass = 'password'; // инициализируем возвращаемое значение $pass пароль клиента password
    private $erros_bad = array
    (
        '400' => 'Плохо сформированный запрос, например, не валидный JSON.',
        '401' => 'Неверные учетные данные.',
        '404' => 'Запрошенный ресурс не существует для запрашивающего.',
        '405' => 'Неверный HTTP метод, например, GET вместо POST.',
        '415' => 'Неверный Content-type, мы поддерживаем только application/json.',
        '422' => 'Запрос сформирован верно, но не прошел валидацию, например, поле не в нужном формате.',
        'created' => 'Карта только что создана.',
        'pending' => 'Карта сохраняется (ожидается уведомление от IPSP о успехе/неуспехе карточной транзакции.',
        'active' => 'Карта сохранена, может быть использована для повторных платежей.',
        'failed' => 'Карта не сохранена (и уже не будет).',
        'used' => 'Карта использована для однократного пополнения.',
        'missing_phone' => 'Не передан номер телефона.',
        'invalid_phone' => 'Номер телефона не соответствует международному формату.',
        'missing_password' => 'Не передан пароль.',
        'invalid_password' => 'Пароль короче 6 символов',
        'phone_already_exists' => ' Кошелек с таким номером телефона уже существует (и активирован)',
        'wallet_not_active' => 'Кошелек с таким номером телефона уже существует и его нужно активировать кодом из СМС',
        'phone' => 'Номер телефона в международном формате, уникальный идентификатор Кошелька (в пределах Проекта), также является логином.',
        'amount' => 'Остаток на счете кошелька, в рублях.',
        'name' => 'Имя конечного пользователя, возвращается в случае, если были заданы имя и/или фамилия.',
        'verified' => 'Статус идентификации пользователя. (true | false )',
        'level' => 'Статус идентификации пользователя. (anonymous | identified | personified)',
        'person_status' => 'Статус персональных данных пользователя. (no_data | data_entered | data_verified)',
    ); //Статусы ошибок
    public function __construct()//Конструктор
    {
        $this->basic_auth_login = self::USER_AUTH_LOGIN;
        $this->basic_auth_pass = self::USER_AUTH_PASS;
        $this->get_access_token();
		$this->phone;
		$this->pass;
    }

    public function get_access_token() // TODO Метод получения токена для доступа к API п. 2.2.3
    {
        $fields = array
        (
            'grant_type' => 'client_credentials'
        );
        $response = $this->requestPost($this->url, $fields); //Конектимся и передаем данные. Ответ возвращается в $response
        $this->access_token = $response['data']['access_token']; //Сохраняем полученный access_token
    }

    public function create_wallet($phone, $pass) //TODO Метод создания кошелька API п. 4.2.1
    {
        $fields = array
        (
            'phone' => $phone,
            'passsword' => $pass
        );//учетные данные клиента
        $headers = array();
        $headers[] = "Content-type:application/json";//Передаем тип контента JSON в хедер
        $headers[] = "Authorization: Bearer {$this->access_token}";//Передаем токен в хедере
        $response = $this->requestPost($this->url_wallet, $fields, $headers);
        $code = $response['dev']['activation_code'];
        //TODO заменить сессии на параметры $_SESSION['dev']['activation_code'] = $code;
        return $response; // Надо проверить "activation_code" или "security_code" в ответе
    }

    /* @param $phone - телефон (логин клиента)
     * @param $code - ответ сервера (код который прийдет на телефон клиента для активации)
     * @return mixed */
    public function activate_wallet($phone, $code) //TODO Метод активации кошелька API п. 4.2.2
    {
        $fields = array
        (
            'phone' => $phone,
            'activation_code' => $code
        );//полученный activation_code, может нужно будет отправить JSON-ом
        $headers = array();
        $headers[] = "Content-type:application/json";//Передаем тип контента JSON в хедер
        $headers[] = "Authorization: Bearer {$this->access_token}";//Передаем токен в хедере
        $response = $this->requestPost($this->url_wallet_activate, $fields, $headers);
        return $response;
    }

    public function get_wallet($phone, $pass) //TODO Метод получение данных о кошельке API п.4.2.5
    {
        $this->basic_auth_login = $phone; //Переназначили логин
        $this->basic_auth_pass = $pass; //Переназначили пароль
        $headers = array();
        $headers[] = "Authorization: Bearer {$this->access_token}";//Передаем токен(При каждом обращении к API п.3.2)
        $response = $this->requestGet($this->url_wallet, array(), $headers);
        return $response;
		/* приблизительное содержание респонса
		 * {"meta" : {"code" : 200,"urgent_data" : {"amount" : 10010}},
		 * "data" : "phone" : "+79261111111", "amount" : 0, "name" : "Алексей Арсеньев", "verified" : false, "level" : "anonymous",
		 * "person_status" : "data */
    }

    public function create_card($phone, $pass) //Метод создания карты
    {
        $json_encode = json_encode(array(
            'card_success_url' => 'http://credeo.alterego-russia.ru/testing/mserver.php?payment=success',
            'card_failure_url' => 'http://credeo.alterego-russia.ru/testing/mserver.php?payment=failure'
        ));//Кодируем данные в JSON
        $this->basic_auth_login = $phone; //Переназначили логин
        $this->basic_auth_pass = $pass; //Переназначили пароль
        $headers = array();
        $headers[] = "Content-type:application/json";//Передаем тип данных в хедер(JSON)
        $headers[] = "Authorization: Bearer {$this->access_token}";//Передаем токен(При каждом обращении к API п.3.2)
        $response = $this->requestPost($this->url_card, $json_encode, $headers);
        $redirect_url = $response['data']['payment_page_url'];//Ссылка на переадрессацию клиента на страницу оплаты
        $client_card_id = $response['data']['id'];//ID Карты клинта
        //TODO сменить сессию на параметр $_SESSION["client_card_id"]= $client_card_id;//Сохраняем ID клиента в сессии
        /*
         * https://www.synq.ru/mserver2-dev/v1/payments/55401/pay
         * Сюда нужно отправить результат оплаты (?payment=success|failure) и страницы переадрессации
         */
        return $response;
   }

    public function card_check()//Загрузка карты карту
    {
        $headers = array();
        $headers[] = "Authorization: Bearer {$this->access_token}";
        $response = $this->requestGet($this->url_card . "/" . $_SESSION["client_card_id"], array(), $headers);
        return $response; //$id, $title, $state
    }

    public function new_payment($phone) //Метод создания платежа
    {
        $json = json_encode(array(
            'type' => 'inout',//тип передачи (оплата)
            'amount' => 100,//количество (цена)
            'service' => 834,//тестовый сервис 834 (ID)
            'parameters' => array(
                'phoneNumber' => $phone// (Номер клиента он же кошелек и логин)
            )
        ));//Данные которые нужно передать. Кодируем данные в JSON
        $this->basic_auth_login = self::client_id; //Переназначили логин (API витрины требует другой логин)
        $this->basic_auth_pass = self::client_secret; //Переназначили пароль(API витрины требует другой пароль)
        $headers = array();
        $headers[] = "Content-type:application/json";//Передаем тип данных в хедер(JSON)
        $headers[] = "Authorization: Bearer {$this->access_token}";//Передаем токен(При каждом обращении к API п.3.2)
        $response = $this->requestPost($this->url_card_payments, $json, $headers);
        $payment_page_url = $response['data']['card']['payment_page_url'];
        //Закомментировал строки высше и потух $response(спасибо подсветке синтаксиса).
        // Сразу вспомнил про ретурн, нам же нужно получить данные:)
        $payment_id = $response['data']['id']; //это ID платежа, на который мы направим клиента
        $service_id = $response['data']['service']['id']; //это ID сервиса(за что платит клиент?)
		//Надо заменить сессии на переменные. Не знаю как.
        //$_SESSION["payment_id"]= $payment_id;//Сохраняем ID клиента в сессии (кажеться, что все правильно)
        //$_SESSION["payment_page_url"]= $payment_page_url;//Сохраняем url для оплаты в сессии
        //$_SESSION["service_id"]= $service_id;//Сохраняем ID сервиса за который клиент платит
        return $response;
    }

    //TODO создание платежа B2

    public function check_payment($phone, $pass) //Подтвердим согласие клиента платить и указываем страницы редиректов
	{// для успеха/неуспеха карточного платежа.
        $json_encode = json_encode(array(
            'card_success_url' => 'http://credeo.alterego-russia.ru/testing/mserver.php?payment=success',
            'card_failure_url' => 'http://credeo.alterego-russia.ru/testing/mserver.php?payment=failure'
        ));//Кодируем данные в JSON
        $this->basic_auth_login = $phone; //Переназначили логин
        $this->basic_auth_pass = $pass; //Переназначили пароль
        $headers = array();
        $headers[] = "Content-type:application/json";//Передаем тип данных в хедер(JSON)
        $headers[] = "Authorization: Bearer {$this->access_token}";//Передаем токен(При каждом обращении к API п.3.2)
        $response = $this->requestPost($this->url_card_payments .  $_SESSION["service_id"] . "/pay", $json_encode, $headers);
        //проверить соединение ссылки и заменить сессии на переменные.
        //($_SESSION["service_id"]  на $service_id = $response['data']['service']['id'])
        return $response;
    }

    //TODO Оплата и статус платежа.

    public function payment_status() //Статус платежа
    {
        $headers = array();
        $headers[] = "Authorization: Bearer {$this->access_token}";//Передаем токен в хедере
        $response = $this->requestGet($this->url_card_payments . "/" .  $_SESSION["service_id"], array(), $headers);
        //проверить соединение ссылки и заменить сессии на переменные.
        //($_SESSION["service_id"]  на $service_id = $response['data']['service']['id'])
		//чуть не забыл что мы запрашиваем данные. Исправил  $this->requestPost на requestGet
        return $response;
    }

    function __call($method = '', $arg = array())
    {
        switch ($method) {
            case 'requestGet':
                return $this->request('GET', $arg[0], $arg[1], $arg[2]);
                break;
            case 'requestPost':
                return $this->request('POST', $arg[0], $arg[1], $arg[2]);
                break;
            default:
                throw new Exception('Нет такого метода');
        }
    }

    public function request($method='POST',$url='', $fields = array(), $headers = array())//Метод коннекта и передачи данных curl
    {
        $headers[] = 'Accept: application/json';
        if(!empty($this->access_token))
            $headers[] = "Authorization: Bearer {$this->access_token}";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($method == 'POST')
            curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $this->basic_auth_login . ":" . $this->basic_auth_pass);//две авторизации
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $data = curl_exec($ch);
        $response = json_decode($data, true);
        curl_close($ch);
        $this->check_errors($response);
        return $response;
/*
A6. Подтвердим согласие клиента платить и указываем страницы редиректов для успеха/неуспеха карточного платежа.
curl -H "Authorization: Bearer e28e65b1-fc26-45eb-b454-df35a6d5082e" -H 'Content-type:application/json'
-d '{"card_success_url": "http://ya.ru", "card_failure_url": "http://google.com"}' https://www.synq.ru/mserver2-dev/v1/payments/55401/pay

A10. Запрашиваем статус платежа.
curl -H "Authorization: Bearer e28e65b1-fc26-45eb-b454-df35a6d5082e" https://www.synq.ru/mserver2-dev/v1/payments/55402

A4. Запросим состояние кошелька.
curl -H "Authorization: Bearer e28e65b1-fc26-45eb-b454-df35a6d5082e" https://www.synq.ru/mserver2-dev/v1/wallet

B3. Подтвердим согласие клиента платить и указываем страницы редиректов для успеха/неуспеха карточного платежа.
curl -H "Authorization: Bearer 6c2ca6b0-f51d-4156-af66-c6cbe74b24a5" -H 'Content-type:application/json'
-d '{"card_success_url": "http://ya.ru", "card_failure_url": "http://google.com"}' https://www.synq.ru/mserver2-dev/application/payments/55403/pay

B4. Запрашиваем статус платежа.
curl -H "Authorization: Bearer 6c2ca6b0-f51d-4156-af66-c6cbe74b24a5" https://www.synq.ru/mserver2-dev/application/payments/55403
*/
    }

    /* @param $response - ответ сервера
     * @throws Exception - проверка кода ошибки
     */
    private function check_errors($response)
    {
        print_r($response);
        if (isset($response['meta']['print_r($response);code']) && 200 != $response['meta']['code']) {//Проверяем соответсвует ли ошибка нашему списку errors_bad и ответу 200 (все ок)
            $code = $response['meta']['code'];
            if (isset($this->erros_bad[$code]))
                throw new Exception($this->erros_bad[$code]);//Полученный код ошибки
            else throw new Exception('Проблема с mserver, повторите запрос позже.');//Ошибка 5ХХ проблема с Mserver
        }
    }
} //Конец класса
    try
    {
        $mserver = new Mserver();//Вызов конструктора

        //$mserver -> create_wallet();
        //$mserver -> activate_wallet();
        //$mserver -> get_wallet();
        //$mserver -> create_card();
        //$mserver -> card_check();
        $mserver -> new_payment("+79261234567"); // $phone
        $mserver -> check_payment("+79261234567", "password"); // $phone, $pass
        $mserver -> payment_status();
        if(isset($_GET['payment'])){
            //idk
            if ($_GET['payment']=='success'){

                $mserver -> card_check();
            }
            else {
                echo 'Ошибка транзакции';
            }
        } else {
            $mserver -> create_card('+79261234567', 'password'); // $phone, $pass
        }
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
