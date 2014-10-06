<?php
Class Wizard{

    private $StepContents;
    private $CurrentStep;
    private $Identifier;
    private $SetNext= null;
    private $onCompleted;
    

    public function __construct() {
        $arg = func_get_args();
        $this->StepContents = $arg[0];
        $this->CurrentStep = func_num_args()<2 || $arg[1] == null ? current(array_keys($arg[0])) : $arg[1];
        $this->onCompleted = func_num_args()<3 || $arg[2] == null ? null : $arg[2];
    }
    
    public function __destruct() {
        
    }
    
    public function getCurrectStep() {
        return $this->CurrentStep; 
    }
    
    public function setCurrectStep($Step2set) {
        $this->CurrentStep = $Step2set; 
    }
    
    public function setStepContents($newStepContent) {
        $this->StepContents = $newStepContent; 
    }
    
    public function setIdentifier($ID) {
        $this->Identifier = $ID; 
    }
    
    public function setNext($nextin)
    {
        $this->SetNext = $nextin;   
        
    }
    public function GetIdentifier() {
        return $this->Identifier;
    }
    
    public function checkCompleted ($bredirect)
    {
        return ($this->CurrentStep == 'complete' && $this->onCompleted != null) ? ($bredirect ? true : header('Location: '.$this->onCompleted)) :  false;  
    }
            
        
    private function findNext ($array,$currentIndex)
    {
        $keys = array_keys($array);
        return array_key_exists(array_search($currentIndex,$keys)+1, $keys) ? $keys[array_search($currentIndex,$keys)+1] : ($this->SetNext == null? "complete" : $this->SetNext);
        
    }
    
    public function AddClass($input)
    {
        return array_key_exists('class',$input)? 'class=\"'.$input['class'].'\"' : "";
        
    }
    
    public function AddProp($input)
    {
        $property = "";
        if(array_key_exists('property',$input))
        {
            foreach ($input['property'] as $key => $value)
            {
                $property.=$key.'=\"'.$value.'\" ';
            }
        }
        return $property;
        
    }
    
    public function Render() {
        $arg = func_get_args();
        $DivID = $arg[0];
     
       
        // build form
        $header = '<H1>'.$this->CurrentStep.'</H1>';
        $polyele.= '<table>';
        foreach ($this->StepContents[$this->CurrentStep]['FormElement'] as $key => $value)
        {
            
             $polyele.= '<tr><td><lable>'.($value['fieldname']==""?"":$value['fieldname'].':').' </lable></td>';
             switch($value['type'])
             {
                 case 'textbox':
                   // $polyele.='<td><input type=\"textbox\" '.$this->AddClass($value).' '.$this->AddProp($value).'/></td>';
                    $polyele.='<td><input type=\"textbox\" |X|/></td>';
                 break;
                 case 'datetime':
                    //$polyele.='<td><input type=\"textbox\" '.$this->AddClass($value).' '.$this->AddProp($value).'/></td>';
                    $polyele.='<td><input type=\"textbox\" |X|/></td>';
                 break;
                 case 'dropdown':
                   // $polyele.='<td><select '.$this->AddClass($value).'>';
                    $polyele.='<td><select |X|>';
                    foreach($value['options'] as $selval => $selable)
                    {
                        $polyele.='<option value=\"'.$selval.'\">'.$selable.'</option>';
                    }
                    $polyele.='</select></td>';
                 break;
                 case 'div':
                    $polyele.='<td><div |X|></div></td>';
                 break;
                 case 'button':
                    $polyele.='<td><input type=\"button\" |X|/></td>';
                 break;
             }
             $polyele= str_replace('|X|', $this->AddClass($value).' '.$this->AddProp($value), $polyele);
             $polyele.='</tr>';
            
        }
         $polyele.'</table>';
        foreach($this->StepContents[$this->CurrentStep]['PageConfig'] as $key2 => $value2)
        {
             switch($key2)
             {
                 case 'ProcessMethod':
                    $polyele.='<input type=\"hidden\" name=\"process\"  value=\"'.$value2.'\"/>';
                    
                 break;
             }
        }
        $polyele.='<input type=\"hidden\" name=\"ConferenceID\"  value=\"'.$this->Identifier.'\"/>';
        //set next
        echo '<script>
        $("#'.$DivID.'").parents("table tbody").find("#Title td").html("'.$header.'");
        $("#'.$DivID.'").prepend("'.$polyele.'");
        $("form button[name=next]").val("'.$this->findNext($this->StepContents, $this->CurrentStep).'");
        
        
        </script>';
    }
    
    public function ClearVars () {
        $this->StepContents = null;
        $this->CurrentStep = null;
    }
    
    
}
?>