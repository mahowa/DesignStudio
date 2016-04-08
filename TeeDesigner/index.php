<?php

session_start();

$server_name  = 'localhost';
$db_user_name = 'root'; //howa
$db_password  = 'root';
//$db_password  = '013645325';
$db_name      = 'dh_svg';
try {

    $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

$svg = array();
try {

    $DBH = $db;
    $stmt = $DBH->prepare("select svg from svg where sessionid='". session_id()."'");
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach($result as $r) {
        array_push($svg, $r["svg"]);
    }

} catch (PDOException $e) {}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE]><script type="text/javascript" src="js/excanvas.js"></script><![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/fabric.js"></script>
    <script type="text/javascript" src="js/tshirtEditor.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script src="pick-a-color/build/dependencies/tinycolor-0.9.15.min.js"></script>
    <script src="pick-a-color/build/1.2.3/js/pick-a-color-1.2.3.min.js"></script>
    <!-- Styles -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="pick-a-color/build/1.2.3/css/pick-a-color-1.2.3.min.css">
</head>


<body>
<div  class="container">
    <div class="page-header">
        <h1>Product Mock Up</h1>
    </div>

    <!-- Headings & Paragraph Copy -->
    <div class="row">
        <div class="col-sm-3">
            <h2>Design</h2>
            <ul class="nav nav-pills">
                <li class="active"><a data-toggle="pill" href="#home">Options</a></li>
                <li><a data-toggle="pill" href="#menu1">Style</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active" style="margin-top: 25px">
                    <div class="form-group">
                        <label for="sel1">Select list:</label>
                        <select class="form-control" id="sel1">
                            <option value="1" selected="selected">Short Sleeve Shirts</option>
                            <option value="2">Long Sleeve Shirts</option>
                            <option value="3">Hoodies</option>
                            <option value="4">Tank tops</option>
                        </select>

                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <div >
                        <div class="input-group input-group-lg" style="margin-top: 25px">
                            <input type="text" id="text-string" class="form-control" placeholder="add text here..." aria-describedby="add-text" >
                            <span id="add-text" class="btn input-group-addon" title="Add text" >+</span>
                            <hr/>

                        </div>
                        <button style="margin-top: 25px;margin-bottom: 25px" id="logo_designer" class="btn btn-primary" href="method-draw/index.html" title="Click here to access our advance logo designer">Design Your Logo Now</button>
                        <div id="avatarlist">
                            <?php
                                foreach($svg as $design){
                                    echo "<div class='img-thumbnail img-polaroid' style='height: 100px; width: 100px;'>$design</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-9 col-md-6">
            <div align="center" style="min-height: 32px;">
                <div class="clearfix">
                    <div class="form-inline pull-left" id="texteditor" style="display:none">
                        <div class="input-group inline " >
                            <button id="font-family" class="btn dropdown-toggle " data-toggle="dropdown" title="Font Style">
                                <span class="glyphicon glyphicon-font" style="width:19px;height:19px;"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="font-family-X">
                                <li><a tabindex="-1" href="#" onclick="setFont('Arial');" class="Arial">Arial</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Helvetica');" class="Helvetica">Helvetica</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Myriad Pro');" class="MyriadPro">Myriad Pro</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Delicious');" class="Delicious">Delicious</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Verdana');" class="Verdana">Verdana</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Georgia');" class="Georgia">Georgia</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Courier');" class="Courier">Courier</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Comic Sans MS');" class="ComicSansMS">Comic Sans MS</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Impact');" class="Impact">Impact</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Monaco');" class="Monaco">Monaco</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Optima');" class="Optima">Optima</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Hoefler Text');" class="Hoefler Text">Hoefler Text</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Plaster');" class="Plaster">Plaster</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Engagement');" class="Engagement">Engagement</a></li>
                            </ul>
                            <button id="text-bold" class="btn" data-original-title="Bold">
                                <span class="glyphicon glyphicon-bold" style="width:19px;height:19px;"></span>
                            </button>
                            <button id="text-italic" class="btn" data-original-title="Italic">
                                <span class="glyphicon glyphicon-italic" style="width:19px;height:19px;"></span>
                            </button>
                            <button id="text-underline" class="btn" title="Underline" style="">
                                <span class="glyphicon glyphicon-text-color" style="width:19px;height:19px;"></span>
                            </button>

                            <input id="text-fontcolor" type="text" value="000" name="border-color" class="pick-a-color form-control" rel="tooltip" data-placement="top" data-original-title="Font Color"/>
                            <input id="text-strokecolor" type="text" value="000" name="border-color" class="pick-a-color form-control"  rel="tooltip" data-placement="top" data-original-title="Font Border Color"/>

                        </div>
                    </div>
                    <div class="pull-right" align="" id="imageeditor" style="display:none">
                        <div class="btn-group">
                            <button class="btn" id="bring-to-front" title="Bring to Front"><span class="glyphicon glyphicon-triangle-top" style="height:19px;"></span></button>
                            <button class="btn" id="send-to-back" title="Send to Back"><span class="glyphicon glyphicon-triangle-bottom" style="height:19px;"></span></button>
                            <button id="flip" type="button" class="btn" title="Show Back View"><span class="glyphicon glyphicon-retweet" style="height:19px;"></span></button>
                            <button id="remove-selected" class="btn" title="Delete selected item"><span class="glyphicon glyphicon-trash" style="height:19px;"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <!--	EDITOR      -->
            <div id="shirtDiv" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);">
                <img id="tshirtFacing" src="img/crew_front.png"/>
                <div id="drawingArea" style="position: absolute;top: 0px;left: 0px;z-index: 10;width: 530px;height: 630px;">
                    <canvas id="tcanvas" width="530" height="630" class="hover" style="-webkit-user-select: none;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="well">
                <h3>Total Prices</h3>
                <br/>
                <table class="table">
                    <tr>
                        <td>Short Sleeve</td>
                        <td align="right">$12.49</td>
                    </tr>
                    <tr>
                        <td>Front Design</td>
                        <td align="right">$4.99</td>
                    </tr>
                    <tr>
                        <td>Back Design</td>
                        <td align="right">$4.99</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td align="right"><strong>$22.47</strong></td>
                    </tr>
                </table>

                <button type="button" class="btn btn-large btn-block btn-success" name="addToTheBag" id="addToTheBag">Add to bag <i class="icon-briefcase icon-white"></i></button>
            </div>
        </div>
    </div>
</div>

</body>
<script>
    var TShirtHtml;
    var body;
    $(".pick-a-color").pickAColor({
        showHexInput: false
    });

    $(document).ready(function(){
        $("#logo_designer").click(function(){
            window.location = "method-draw/index.php";
        });
    });

    $(document).ready(function(){
        var  svgArr = $("svg").get();

        svgArr.forEach(function(svg){
            var w = svg.width.baseVal.value;
            var h = svg.height.baseVal.value;
            svg.setAttribute('viewBox', '0 0 '+w+' '+h);
            svg.setAttribute('width', '100%');
            svg.setAttribute('height', '100%');
        });


    });

    function backToDesigner(){
        body.html(TShirtHtml);
    }
</script>
</html>