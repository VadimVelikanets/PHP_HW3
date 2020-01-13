<?php 

	function task1(){
		echo "<h3>Задание 1</h3>";

		$xml = simplexml_load_file('data.xml');

		echo "Purchase order number - $xml[PurchaseOrderNumber] <br>";
		echo "Order date - $xml[OrderDate] <br> <hr>";
		foreach ($xml->Address as $address)  {

			echo "Adress <br>";
			echo "Type - $address[Type] <br>";
			echo "Name - $address->Name <br>";
			echo "Street - $address->Street <br>";
			echo "City - $address->City <br>";
			echo "State - $address->State <br>";
			echo "Zip - $address->Zip <br>";
			echo "Coutry - $address->Country <br>";
			echo '<hr>';
		};

		echo "$xml->DeliveryNotes <br>";

		foreach ($xml->Items->Item as $item) {
			echo "Part number -  $item[PartNumber] <br>";
			echo "Product name - $item->ProductName <br>";
			echo "Quantity - $item->Quantity <br>";
			echo "USPrice - $item->USPrice <br>";
			if($item->Comment){
				echo "Comment - $item->Comment <br>";
			}	
			if($item->ShipDate){
				echo "Shipdate - $item->ShipDate <br>";
			}
			echo '<hr>';
		}
	}

	function task2(){
		echo "<h3>Задание 2</h3>";

		$arr = [
			'name' => 'Smith',
			'age' => 29, 
			'city' => 'London', 
			'language' => 
				[
					'ENG', 'RU', 'FR'
				]
		];

		$jsonFile = json_encode($arr, JSON_FORCE_OBJECT);

		$fp = fopen('output.json', 'w');
		fwrite($fp, $jsonFile);
		fclose($fp);
		
		//Рандомно генерируем изменения в файле
		$rand = rand(1, 10);
		if($rand%2){
			$my_new_array = json_decode($jsonFile, true);
			$my_new_array['car'] = 'bentley';
			$newJson = json_encode($my_new_array, JSON_FORCE_OBJECT);
			$fp = fopen('output2.json', 'w');

			fwrite($fp, $newJson);
			fclose($fp);

			$diff = array_filter($my_new_array, function ($element) use ($arr) {
			    return !in_array($element, $arr);
			});
				foreach($diff  as  $key => $value)
				{
					echo "Объекты отличаются свойством - $key - $value <br>";
				}
		}

	};

	function task3(){
		echo "<h3>Задание 3</h3>";

		$numbers = [];
		for ($i = 0; $i < 50; $i++){
			array_push($numbers, rand(1, 100));
		}

		$fp = fopen('task3.csv', 'w');
			fputcsv($fp, $numbers);

		fclose($fp);

		$csv = array_map('str_getcsv', file('task3.csv'));
		$evenSumma = [];
		foreach ($csv[0] as $value) {
			if($value%2 == 0){
				array_push($evenSumma, $value);			
			}
		}
		echo "Сумма четные чисел -  " . array_sum($evenSumma) . '<br>';
	}

	function task4(){
		echo "<h3>Задание 4</h3>";

		 $url    = 'https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json';
    	$data   = file_get_contents($url);

	    if ( !empty($data)) {
	        $contents = json_decode($data, TRUE);

	        
	        echo " Title - " . $contents['query']['pages']['15580374']['title'] . "<br> Page Id -  " . $contents['query']['pages']['15580374']['pageid'] ;
	    }

	}
?>