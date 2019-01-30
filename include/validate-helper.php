<?php
	//Added By Ejaz On 19 May 2017
	function validate($data)
	{
		
		$res[] = [
			'validity' => false,
			'type'     => 'all',
			'message'  => ''
		];
		//required check
		if(isset($data['required'])){
			$dataForCheck = $data['required'];
			foreach ($dataForCheck as $key => $value) {
				if($value != null && $value != '' && !empty($value) && !is_null($value))
				{
					$res[] = [
						'validity' => true,
						'type'     => 'required',
						'message'  => 'Success'
					];
				}
				else
				{
					$res[] = [
						'validity' => false,
						'type'     => 'required',
						'message'  => 'Some required fields are missing'
					];
				}
			}
		}

		return $res;
	} 
	//End of Added By Ejaz On 19 May 2017
?>