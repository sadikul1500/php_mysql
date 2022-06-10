<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Power Bi Charts</title>
</head>
<body>
    <div style="position:relative;">
    <div style="background-color:#E0E0E0; position:fixed;top:0; width:100%; z-index:100;"><h2 style="text-align: center; padding-top: 5px; padding-bottom: 5px;">Result Analytics</h2></div>
        
    <!-- overall result by student -->
        <div style="position:relative; top:70px;"><h2 style="margin-left: 60px;">Overall Result by Student Id</h2></div> 
    <div style="position:relative;top:100px;"><br></div>
    <div style="overflow: hidden; margin: 15px auto; max-width: 800px;top:100px;"> 
    
     <iframe scrolling="no" src="https://app.powerbi.com/reportEmbed?reportId=f6153308-0833-482e-ac37-9ec75c5ef236&autoAuth=true&ctid=0869d2b7-957f-41e6-b98e-69d3ddc9fe06&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly93YWJpLWVhc3QtYXNpYS1iLXByaW1hcnktcmVkaXJlY3QuYW5hbHlzaXMud2luZG93cy5uZXQvIn0%3D&pageName=ReportSection23c7c55eb2a1a35ec384" style="border: 0px none; margin-left: -30px; height: 859px; margin-bottom: -420px; margin-top: 0px; margin-right: -120px; width: 890px;">
        </iframe>
    </div>

    <!-- semester wise result by sid -->
    <div ><h2 style="margin-left: 60px;">Semester wise Result</h2></div>
    <div style="position:relative; overflow: hidden; margin: 15px auto; max-width: 800px;"> 
        
     <iframe scrolling="no" src="https://app.powerbi.com/reportEmbed?reportId=f6153308-0833-482e-ac37-9ec75c5ef236&autoAuth=true&ctid=0869d2b7-957f-41e6-b98e-69d3ddc9fe06&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly93YWJpLWVhc3QtYXNpYS1iLXByaW1hcnktcmVkaXJlY3QuYW5hbHlzaXMud2luZG93cy5uZXQvIn0%3D&pageName=ReportSection6f573dea300a4328b369" style="border: 0px none; marign-top: 75px; margin-left: -30px; height: 859px; margin-bottom: -420px; margin-right: -120px; width: 890px;"> <!-- &$filter=student/SID eq '1002' -->
        </iframe>
    </div>

    <!-- course wise result -->
    <div><h2 style="margin-left: 60px;">Course wise Result</h2></div>
    <div style=" overflow: hidden; margin: 0px auto; max-width: 800px;"> 
        
     <iframe scrolling="no" src="https://app.powerbi.com/reportEmbed?reportId=f6153308-0833-482e-ac37-9ec75c5ef236&autoAuth=true&ctid=0869d2b7-957f-41e6-b98e-69d3ddc9fe06&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly93YWJpLWVhc3QtYXNpYS1iLXByaW1hcnktcmVkaXJlY3QuYW5hbHlzaXMud2luZG93cy5uZXQvIn0%3D&pageName=ReportSection6c6c64a602de9b106b44" style="border: 0px none; marign-top: -10px; margin-left: -30px; height: 859px; margin-bottom: -420px; margin-right: -120px; width: 890px;"> <!-- $filter=student_result+course/SID eq '1002' -->
        </iframe>
    </div>
    </div>
    
</body>
</html>
