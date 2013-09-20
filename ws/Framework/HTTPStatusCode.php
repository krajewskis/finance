<?php

namespace Framework;

class HttpStatusCode
{
	private static $codes = array(
		'200'=>'OK', //Zawartość żądanego dokumentu (najczęściej zwracany nagłówek odpowiedzi w komunikacji WWW Internetu)
		'400'=>'Bad Request', //Nieprawidłowe zapytanie – żądanie nie może być obsłużone przez serwer z powodu błędnej składni zapytania
		'401'=>'Unauthorized', //Nieautoryzowany dostęp – żądanie zasobu, który wymaga uwierzytelnienia
		'402'=>'Payment Required', //Wymagana opłata – odpowiedź zarezerwowana na przyszłość
		'403'=>'Forbidden', //Zabroniony – serwer zrozumiał zapytanie lecz konfiguracja bezpieczeństwa zabrania mu zwrócić żądany zasób
		'404'=>'Not Found', //Nie znaleziono – serwer nie odnalazł zasobu według podanego URL ani niczego co by wskazywało na istnienie takiego zasobu w przeszłości',
		'405'=>'Method Not Allowed', //Niedozwolona metoda – metoda zawarta w żądaniu nie jest dozwolona dla wskazanego zasobu, odpowiedź zawiera też listę dozwolonych metod',
		'406'=>'Not Acceptable', //Niedozwolone – zażądany zasób nie jest w stanie zwrócić odpowiedzi mogącej być obsłużonej przez klienta według informacji podanych w zapytaniu',
		'407'=>'Proxy Authentication Required', //Wymagane uwierzytelnienie do serwera pośredniczącego (ang. proxy) – analogicznie do kodu 401, dotyczy dostępu do serwera proxy',
		'408'=>'Request Timeout', //Koniec czasu oczekiwania na żądanie – klient nie przesłał zapytania do serwera w określonym czasie',
		'409'=>'Conflict', //Konflikt – żądanie nie może być zrealizowane, ponieważ występuje konflikt z obecnym statusem zasobu, ten kod odpowiedzi jest zwracany tylko w przypadku podejrzewania przez serwer, że klient może nie znaleźć przyczyny błędu i przesłać prawidłowego zapytania',
		'410'=>'Gone', //Zniknął (usunięto) – zażądany zasób nie jest dłużej dostępny i nie znany jest jego ewentualny nowy adres URI; klient powinien już więcej nie odwoływać się do tego zasobu',
		'411'=>'Length required', //Wymagana długość – serwer odmawia zrealizowania zapytania ze względu na brak nagłówka Content-Length w zapytaniu; klient może powtórzyć zapytanie dodając doń poprawny nagłówek długości',
		'412'=>'Precondition Failed', //Warunek wstępny nie może być spełniony – serwer nie może spełnić przynajmniej jednego z warunków zawartych w zapytaniu',
		'413'=>'Request Entity Too Large', //Encja zapytania zbyt długa – całkowita długość zapytania jest zbyt długa dla serwera',
		'414'=>'Request-URI Too Long', //Adres URI zapytania zbyt długi – długość zażądanego URI jest większa niż maksymalna oczekiwana przez serwer',
		'415'=>'Unsupported Media Type', //Nieznany sposób żądania – serwer odmawia przyjęcia zapytania, ponieważ jego składnia jest niezrozumiała dla serwera',
		'416'=>'Requested Range Not Satisfiable', //Zakres bajtowy podany w zapytaniu nie do obsłużenia – klient podał w zapytaniu zakres, który nie może być zastosowany do wskazanego zasobu',
		'417'=>'Expectation Failed' //Oczekiwana wartość nie do zwrócenia – oczekiwanie podane w nagłówku Expect żądania nie może być spełnione przez serwer lub – jeśli zapytanie realizuje serwer proxy – serwer ma dowód, że oczekiwanie nie będzie spełnione przez następny w łańcuchu serwer realizujący zapytanie
	) ;
	
	public static function getHeader($httpStatusCode)
	{
		header('HTTP/1.1 '.$httpStatusCode.' '.self::$codes[$httpStatusCode]);
	}
}