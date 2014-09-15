<?php


function Event_Create (){
 $eventData = $_POST;
    //var_dump ($eventData);
    //return array("status"=>"Success", "EventID"=>$eventData["EventGroupID"]);

    //$check_exist1 = mysql_query("SELECT * FROM FloorLevel WHERE iEventID = ".$eventData["EventGroupID"]);
    $check_exist2 = mysql_query("SELECT * FROM confs WHERE iEventGroupID = ".$eventData["EventGroupID"]);
    if(mysql_num_rows($check_exist2) == 0)
    {
        mysql_query("Insert into confs (confID, name, location, date, dCreated, dLastUpdate, ieventGroupID) values ('".$eventData["confID"]."','".$eventData["EventName"]."','".$eventData["EventLocation"]."','".$eventData["EventDate"]."', NOW(), NOW(),".$eventData["EventGroupID"].");");

    }
    else
    {
        return array("status"=>"Fail", "message"=>"This event has already been entered!");   
    }
    return array("status"=>"Success", "EventID"=>$eventData["EventGroupID"]);
}

function Content_Upload (){
     $eventData = $_POST; 
    
   
      //return array("status"=>"Success", "EventID"=>$eventData["ConferenceID"]); 
    
	 $eventQuery = mysql_query("SELECT * FROM confs WHERE iEventGroupID = ".$eventData["ConferenceID"]);
   
	if (mysql_num_rows($eventQuery) != 1)
    {
       // return array("status"=>"Fail", "message"=>"Could not find event!"); 
    }
    else
    {
        $event = mysql_fetch_object($eventQuery);
    }
   
    $check_exist1 = mysql_query("SELECT * FROM FloorLevel WHERE iEventID = ".$eventData["ConferenceID"]);

    if(mysql_num_rows($check_exist1) == 0)
    {
        //echo mysql_num_rows($check_exist1); 
		for($i = 0;$i<sizeof($eventData['Floorplans']);$i++ )
		{
			 $mapQuery = "Insert into FloorLevel (iEventID, iMapID, vLevelName, dLastUpdated) Select * from (Select ".$eventData["ConferenceID"].",".$eventData["Floorplans"][$i].",'".$event->name." Map ".($i+1)."', NOW()) AS TMP WHERE NOT EXISTS (SELECT * FROM FloorLevel  WHERE (iEventID= ".$eventData["ConferenceID"]." and iMapID = ".$eventData["Floorplans"][$i].") or vLevelName = '".$event->name." Map ".($i+1)."') LIMIT 1; ";
           // echo $mapQuery;
            
			mysql_query($mapQuery);
		}
          $floorPlanArray['new'] = array();
            $floorPlanArray['processed'] = array();
            $floorplanQuery=mysql_query("Select ID, iMapID, vLevelName from FloorLevel where iEventID =".$eventData['ConferenceID']." order by ID");
       
            while ($fp = mysql_fetch_object($floorplanQuery))
               array_push($floorPlanArray['new'],array("FloorID"=>$fp->ID, "MapID"=>$fp->iMapID, "LevelName"=>$fp->vLevelName));
         return getTopMap($floorPlanArray['new'],$floorPlanArray['processed'], array("status"=>"Success", "EventID"=>$eventData["ConferenceID"], "FloorLevel"=>$floorPlanArray));
    }
    else
    { 
        if(!array_key_exists('FloorLevel', $eventData))
        {
          return array("status"=>"Fail", "message"=>"This event already has floor plan, please use edit to make changes!");
        }
        else 
        {
            $floorPlanArray=json_decode(stripslashes($eventData['FloorLevel']),true);
             return getTopMap($floorPlanArray['new'],$floorPlanArray['processed'], array("status"=>"Success", "EventID"=>$eventData["ConferenceID"], "FloorLevel"=>$floorPlanArray));
        }
       // var_dump($floorPlanArray);
      
    }
	
}

function getTopMap (&$arrayIn_from, &$arrayIn_to, $addIn)
{
    $getMapID = array_shift($arrayIn_from);
    array_push($arrayIn_to,$getMapID);
    $MapObject  = mysql_fetch_array(mysql_query("Select * from images where ID =".$getMapID['MapID']));
    return array_merge($addIn, array("currentFloorID"=>$getMapID['FloorID'], "currentFloorMap"=>$MapObject ));
}



function Create_Rooms ()
{
    
    $eventData = $_POST;
    //var_dump ($_POST);
    $floorInfoArray = json_decode(stripslashes($_POST['FloorLevel']),true);
    $getMapID=mysql_fetch_array(mysql_query("Select iMapID from FloorLevel where ID =".$eventData['currentFloorID']));
    $MapObject  = mysql_fetch_array(mysql_query("Select * from images where ID =".$getMapID['iMapID']));
    return array("status"=>"Success", "EventID"=>$eventData["ConferenceID"], "FloorLevel"=>$floorInfoArray, "currentFloorID"=>$eventData['currentFloorID'], "currentFloorMap"=>$MapObject);
    /*
    $getMapID = array_shift($_POST['FloorLevel']);
    $MapObject  = mysql_fetch_object(mysql_query("Select * from images where ID =".$getMapID));
    return array("status"=>"Success", "confID"=>$eventData["ConferenceID"], "FloorLevel"=>$floorPlanArray, "currentFloorOBJECT"=>$MapObject ); */

}


function Final_Review()
{
  //redirect
  return Content_Upload();
    
}



//fill up options for event 
$EventGroup = array();
$FloorPlans = array();
$query = mysql_query("SELECT DISTINCT iEventGroupID, vGroupName FROM Sessions WHERE dSessionBegin >= DATE_FORMAT( CURDATE( ) ,  '%Y-1-1' )");
while ($row = mysql_fetch_object($query))
   $EventGroup[$row->iEventGroupID]=$row->vGroupName;

$query = mysql_query("SELECT ID, ImageName, fileName FROM images");
while ($row = mysql_fetch_object($query))
   $FloorPlans[$row->ID]=$row->ImageName;


$steps_create = array(
"Event Infomation"=>array(
    "FormElement"=>array(
        array("fieldname"=>"Conference ID","type"=>"textbox", "property"=>array("name"=>"confID", "required"=>"")),
        array("fieldname"=>"Event Name", "type"=>"textbox", "property"=>array("name"=>"EventName", "required"=>"")),
        array("fieldname"=>"Location", "type"=>"textbox", "property"=>array("name"=>"EventLocation", "required"=>"")),
        array("fieldname"=>"Date", "type"=>"datetime", "class"=>"datetime", "property"=>array("name"=>"EventDate", "required"=>"")),
        array("fieldname"=>"EventGroup", "type"=>"dropdown", "options"=>$EventGroup, "property"=>array("name"=>"EventGroupID"))),
    "PageConfig"=>array("ProcessMethod"=>"Event_Create")),
"Upload Content"=>array(
    "FormElement"=>array(
        array("fieldname"=>"Select Floor Plan","type"=>"dropdown", 
              "options"=>$FloorPlans, "class"=>"Expandable Previewable","property"=>array("name"=>"Floorplans[]")),
        array("fieldname"=>"","type"=>"button", "property"=>array("ID"=>"btnUpload", "value"=>"Upload", "required"=>""))),
    "PageConfig"=>array("ProcessMethod"=>"Content_Upload")),
"Create and Add"=>array(
    "FormElement"=>array(
        array("fieldname"=>"", "type"=>"div","property"=>array("ID"=>"svgsketch", "name"=>"RoomInterface"))),
    "PageConfig"=>array("ProcessMethod"=>"Create_Rooms")),
"Review"=>array(
    "FormElement"=>array(
        array("fieldname"=>"", "type"=>"div","property"=>array("ID"=>"svgView", "name"=>"SessionReview"))
    
    ),
    "PageConfig"=>array("ProcessMethod"=>"Final_Review"))
);

$steps_edit_main = array(
"Event Infomation"=>array(
    "FormElement"=>array(
        array("fieldname"=>"Conference ID","type"=>"textbox", "property"=>array("name"=>"confID", "required"=>"")),
        array("fieldname"=>"Event Name", "type"=>"textbox", "property"=>array("name"=>"EventName", "required"=>"")),
        array("fieldname"=>"Location", "type"=>"textbox", "property"=>array("name"=>"EventLocation", "required"=>"")),
        array("fieldname"=>"Date", "type"=>"datetime", "class"=>"datetime", "property"=>array("name"=>"EventDate", "required"=>"")),
        array("fieldname"=>"Event Group", "type"=>"dropdown", "options"=>$EventGroup, "property"=>array("name"=>"EventGroupID")),
        array("fieldname"=>"", "type"=>"div", "class"=>"", "property"=>array("name"=>"FloorPlanQueue", "width"=>300, "height"=>200
    ),
    "PageConfig"=>array("ProcessMethod"=>"Event_Save"))
)));

$steps_edit_floors = array(
"Event Infomation"=>array(
    "FormElement"=>array(
        array("fieldname"=>"Conference ID","type"=>"textbox", "property"=>array("name"=>"confID", "required"=>"")),
        array("fieldname"=>"Event Name", "type"=>"textbox", "property"=>array("name"=>"EventName", "required"=>"")),
        array("fieldname"=>"Location", "type"=>"textbox", "property"=>array("name"=>"EventLocation", "required"=>"")),
        array("fieldname"=>"Date", "type"=>"datetime", "class"=>"datetime", "property"=>array("name"=>"EventDate", "required"=>"")),
        array("fieldname"=>"EventGroup", "type"=>"dropdown", "options"=>$EventGroup, "property"=>array("name"=>"EventGroupID"))),
    "PageConfig"=>array("ProcessMethod"=>"Event_Create")),
"Upload Content"=>array(
    "FormElement"=>array(
        array("fieldname"=>"Select Floor Plan","type"=>"dropdown", 
              "options"=>$FloorPlans, "class"=>"Expandable Previewable","property"=>array("name"=>"Floorplans[]")),
        array("fieldname"=>"","type"=>"button", "property"=>array("ID"=>"btnUpload", "value"=>"Upload", "required"=>""))),
    "PageConfig"=>array("ProcessMethod"=>"Content_Upload")),
"Create and Add"=>array(
    "FormElement"=>array(
        array("fieldname"=>"", "type"=>"div","property"=>array("ID"=>"svgsketch", "name"=>"RoomInterface"))),
    "PageConfig"=>array("ProcessMethod"=>"Create_Rooms")),
"Review"=>array(
    "FormElement"=>array(
        array("fieldname"=>"", "type"=>"div","property"=>array("ID"=>"svgView", "name"=>"SessionReview"))
    
    ),
    "PageConfig"=>array("ProcessMethod"=>"Final_Review"))
);

?>