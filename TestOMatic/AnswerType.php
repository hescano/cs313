<?php
   include_once("dataaccess.php");

   class AnswerType
   {
      var $AnswerTypeID;
      var $AnswerTypeName;
      var $Status;

      public function AnswerType($pAnswerTypeID = 0, $pAnswerTypeName = "", $pStatus = false)
      {
         $this->AnswerTypeID = $pAnswerTypeID;
         $this->AnswerTypeName = $pAnswerTypeName;
         $this->Status = $pStatus;
      }

      public static function getAllAnswerTypes()
      {
         $result = queryTable("SELECT * FROM AnswerTypes WHERE Status = 1");

         if ($result->num_rows > 0)
         {
            $answerTypes = array();

            while ($row = $result->fetch_assoc())
            {
               array_push($answerTypes, new AnswerType($row["AnswerTypeID"], $row["AnswerTypeName"], $row["Status"]));
            }
            return $answerTypes;
         }
      }
   }