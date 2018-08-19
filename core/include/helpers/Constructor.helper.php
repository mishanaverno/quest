<?php 
class Constructor
{
	function __construct($headers = null, $data = null, $title = '')
	{
		$this->headers = $headers;
		$this->data = $data;
		$this->title = $title;
		$this->dom = new DOMDocument('1.0', 'utf-8');
	}
	public function addField($name = null, $value = null, $options = [])
	{
		if($name){
		$this->headers[$name] = $options;
		$this->data[$name] = $value;
		}
		
	}
	public function constructForm()
	{
		if($this->headers && $this->data){
			$form = $this->createTag('form');
			$title = $this->createTag('h2', $this->title);
			$form->appendChild($title);
			foreach ($this->headers as $k => $v) {
				if ($v['visibility']){
					$id = PHP::stringGen(7);
					$wraper = $this->createTag('div', null, ['class'=>'form-group']);
					if(isset($v['label'])){
						$label = $this->createTag('label', $v['label'], ['for'=>$id]);
						$wraper->appendChild($label);
					}
					$input_attrebutes = [
						'class' => 'form-control',
						'value' => $this->data[$k],
						'id' => $id,
						'name' => $k
					];
					if(isset($v['placeholder'])) 
						$input_attrebutes['placeholder'] = $v['placeholder'];
					switch ($v['type']){
						case 'text':
						$input_attrebutes['type'] = 'text';
						break;
						case 'hidden':
						$input_attrebutes['type'] = 'hidden';
						break;
					}
					$input = $this->createTag('input', null, $input_attrebutes);
					$wraper->appendChild($input);
					if(isset($v['help'])){
						$input ->setAttribute('aria-describedby', $k.'help');
						$help = $this->createTag('small',$v['help'],['id' => $k.'help']);
						$wraper->appendChild($help);
					}
					$form->appendChild($wraper);
				}
			}
			$submit = $this->createTag('button','ОK',[
				'type' => 'submit',
				'class' => 'btn btn-primary'
			]);
			$form->appendChild($submit);
			$this->dom->appendChild($form);
			echo $this->dom->saveXML();
		}
	}
	private function createTag($name, $value = null, $attrebutes = [])
	{
		$tag = $this->dom->createElement($name, $value);
		foreach ($attrebutes as $k => $v) {
			$tag->setAttribute($k, $v);
		}
		return $tag;
	}
}