<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Gas Chart</title>
    <script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
  input[type=month] {
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}
    @media only screen and (max-width: 600px) {
    body{
      justify-content:center;
      width: 100%;
    }
    table{
      width:100%;
      table-layout: fixed;
    }
    div{
      width:100%;
      height:auto;
    }
  }
    body{
        background-color:#ecedff;
        font-family:sans-serif;
    }
    table{
      table-layout: fixed;
    }
    .low{
      color:green;
    }
    .high{
      color:red;
    }

    .cardNo{
      width:150px;
      height:150px;
      background-color:#f9f7f7;
      margin:10px;
      display:inline-block;
      border-radius:25px;
    }
    div{
      justify-content: center; 
      align-items: center;
    }

</style>
<body>
    <div style=" margin-left:5%; margin-right:5%; margin-top:5%;">
        <div class="row" >
        <div class="col-md-7" style="text-align:center; margin-bottom:1%; display:inline-block; background-color:#f9f7f7; border-radius:25px; padding:30px; width:100%; font-size: 30px; ">DX Gas Price Dashboard</div>
        <div class="col-md-4"  style="text-align:center; margin-bottom:1%; margin-left:1%; display:inline-block; background-color:#f9f7f7; border-radius:25px; padding:30px; width:100%; font-size: 30px; ">ราคาน้ำมันประจำวันที่ <div style="display:inline-block;" id="Today"></div></div>
        </div>
            <div class="row">
                <div  class="cchart col-md-7" style="display:inline-block; background-color:#f9f7f7; height:550px; width:100%; border-radius:25px; padding:30px;">
                    <canvas id="myChart"></canvas>
                </div>
                <div  class="col-md-4" style="margin-left:1%; display:inline-block; background-color:#f9f7f7; height:550px; width:100%; border-radius:25px; padding:30px;">
                    <table style = "color:black; text-align:center; width:100%; font-weight:bold;">
                        <tr>
                            <th>ประเภทน้ำมัน</th>
                            <th>ราคาวันนี้ (บาท/ลิตร)</th>
                            <th><div>ราคาในเดือนนี้</div><span style="color:#82CD47; font-size:15px;">ต่ำสุด</span>
                              /<span style="color:#E14D2A; font-size:15px;">แพงสุด</span>
                              /<span  style="color:#f89261; font-size:15px;">เฉลี่ย</span></th>
                        </tr> 
                        <tr>
                            <td><img src="../../img/P_Die_B7.jpg" style="height:60%; width:62%;"></td>
                            <td style="font-style:italic;font-size:20px;">
                              <span id="T_P_Die_B7"></span>
                              <span style="font-size:15px;" id="Per_P_Die_B7_price"></span>
                            </td>
                            <td>
                            <div class="row" style="justify-content:center;">
                              <div class="col-md-4" style="color:#82CD47; font-style:italic;font-size:15px;" id="min_P_Die_B7"></div>
                              <div class="col-md-4" style="color:#E14D2A; font-style:italic;font-size:15px;" id="max_P_Die_B7"></div>
                              <div class="col-md-4" style="color:#f89261; font-style:italic;font-size:15px;" id="avg_P_Die_B7"></div>
                            </div>
                            </td>

                        </tr>
                        <tr>
                            <td><img src="../../img/Die.jpg" style="height:60%; width:62%;"></td>
                            <td style="font-style:italic;font-size:20px;" >
                              <span id="T_Die"></span>
                              <span style="font-size:15px;" id="Per_Die_price"></span></td>
                              <td>
                            <div class="row" style="justify-content:center;">
                              <div class="col-md-4" style="color:#82CD47; font-style:italic;font-size:15px;" id="min_Die"></div>
                              <div class="col-md-4" style="color:#E14D2A; font-style:italic;font-size:15px;" id="max_Die"></div>
                              <div class="col-md-4" style="color:#f89261; font-style:italic;font-size:15px;" id="avg_Die"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="../../img/Die_B20.jpg" style="height:60%; width:62%;"></td>
                            <td style="font-style:italic;font-size:20px;">
                              <span id="T_Die_B20"></span>
                              <span style="font-size:15px;" id="Per_Die_B20_price"></span>
                          </td>
                          <td>
                            <div class="row" style="justify-content:center;">
                              <div class="col-md-4" style="color:#82CD47; font-style:italic;font-size:15px;" id="min_Die_B20"></div>
                              <div class="col-md-4" style="color:#E14D2A; font-style:italic;font-size:15px;" id="max_Die_B20"></div>
                              <div class="col-md-4" style="color:#f89261; font-style:italic;font-size:15px;" id="avg_Die_B20"></div>
                            </div>
                            </td>
                        </tr>

                        <tr>
                            <td><img src="../../img/Gasolin_95.jpg" style="height:60%; width:62%;"></td>
                            <td style="font-style:italic;font-size:20px;">
                              <span id="T_Gasolin_95"></span>
                              <span style="font-size:15px;" id="Per_Gasolin_95_price"></span></td>
                              </td>
                            <td >
                            <div class="row" style="justify-content:center;">
                              <div class="col-md-4" style="color:#82CD47; font-style:italic;font-size:15px;" id="min_Gasolin_95"></div>
                              <div class="col-md-4" style=" color:#E14D2A; font-style:italic;font-size:15px;" id="max_Gasolin_95"></div>
                              <div class="col-md-4" style="color:#f89261; font-style:italic;font-size:15px;" id="avg_Gasolin_95"></div>
                            </div>

                            </td>
                        </tr>
                        <tr>
                            <td><img src="../../img/GSH_95.jpg" style="height:60%; width:62%;"></td>
                            <td style="font-style:italic;font-size:20px;" >
                              <span id="T_Gasohol_95"></span>
                              <span style="font-size:15px;" id="Per_Gasohol_95_price"></span></td>
                              <td>
                            <div class="row" style="justify-content:center;">
                              <div class="col-md-4" style="color:#82CD47; font-style:italic;font-size:15px;" id="min_Gasohol_95"></div>
                              <div class="col-md-4" style="color:#E14D2A; font-style:italic;font-size:15px;" id="max_Gasohol_95"></div>
                              <div class="col-md-4" style="color:#f89261; font-style:italic;font-size:15px;" id="avg_Gasohol_95"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="../../img/GSH_91.jpg" style="height:60%; width:62%;"></td>
                            <td style="font-style:italic;font-size:20px;" >
                              <span id="T_Gasohol_91"></span>
                              <span style="font-size:15px;" id="Per_Gasohol_91_price"></span>
                            </td>
                            <td>
                            <div class="row" style="justify-content:center;">
                              <div class="col-md-4" style="color:#82CD47; font-style:italic;font-size:15px;" id="min_Gasohol_91"></div>
                              <div class="col-md-4" style="color:#E14D2A; font-style:italic;font-size:15px;" id="max_Gasohol_91"></div>
                              <div class="col-md-4" style="color:#f89261; font-style:italic;font-size:15px;" id="avg_Gasohol_91"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="../../img/GSH_E20.jpg" style="height:60%; width:62%;"></td>
                            <td style="font-style:italic;font-size:20px;">
                              <span id="T_Gasohol_E20"></span>
                              <span style="font-size:15px;" id="Per_Gasohol_E20_price"></span>
                            </td>
                            <td>
                            <div class="row" style="justify-content:center;">
                              <div class="col-md-4" style="color:#82CD47; font-style:italic;font-size:15px;" id="min_Gasohol_E20"></div>
                              <div class="col-md-4" style="color:#E14D2A; font-style:italic;font-size:15px;" id="max_Gasohol_E20"></div>
                              <div class="col-md-4" style="color:#f89261; font-style:italic;font-size:15px;" id="avg_Gasohol_E20"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="../../img/GSH_E85.jpg" style="height:60%; width:62%;"></td>
                            <td style="font-style:italic;font-size:20px;" >
                              <span id="T_Gasohol_E85"></span>
                              <span style="font-size:15px;" id="Per_Gasohol_E85_price"></span>
                            </td>
                            <td>
                            <div class="row" style="justify-content:center;">
                              <div class="col-md-4" style="color:#82CD47; font-style:italic;font-size:15px;" id="min_Gasohol_E85"></div>
                              <div class="col-md-4" style="color:#E14D2A; font-style:italic;font-size:15px;" id="max_Gasohol_E85"></div>
                              <div class="col-md-4" style="color:#f89261; font-style:italic;font-size:15px;" id="avg_Gasohol_E85"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="../../img/Die_B7.jpg" style="height:60%; width:62%;"></td>
                            <td style="font-style:italic;font-size:20px;">
                              <span id="T_Die_B7"></span>
                              <span style="font-size:15px;" id="Per_Die_B7_price"></span>
                            </td>
                              
                            <td>
                            <div class="row" style="justify-content:center;">
                              <div class="col-md-4" style="color:#82CD47; font-style:italic;font-size:15px;" id="min_Die_B7"></div>
                              <div class="col-md-4" style="color:#E14D2A; font-style:italic;font-size:15px;" id="max_Die_B7"></div>
                              <div class="col-md-4" style="color:#f89261; font-style:italic;font-size:15px;" id="avg_Die_B7"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="../../img/P_GSH_95.jpg" style="height:60%; width:62%;"></td>
                            <td style="font-style:italic;font-size:20px;">
                            <span id="T_P_Gasohol_95"></span>
                              <span style="font-size:15px;" id="Per_P_Gasohol_95_price"></span>
                            </td>
                            <td>
                            <div class="row" style="justify-content:center;">
                              <div class="col-md-4" style="color:#82CD47; font-style:italic;font-size:15px;" id="min_P_Gasohol_95"></div>
                              <div class="col-md-4" style="color:#E14D2A; font-style:italic;font-size:15px;" id="max_P_Gasohol_95"></div>
                              <div class="col-md-4" style="color:#f89261; font-style:italic;font-size:15px;" id="avg_P_Gasohol_95"></div>
                            </div>
                            </td>
                        </tr>
                    </table>
                  </div>
            </div>
        

           
<!--             <div style=" padding:30px;" class="btn-group btn-group-toggle" role="group"  >
              <button id="btn_week" style="" class="btn btn-outline-primary">Week</button>
              <button id="btn_month"  style="" class="btn btn-outline-primary">Month</button>
              <button id="btn_year"  style="" class="btn btn-outline-primary">Year</button>
            </div> -->


            <div style=" padding:30px;" class="btn-group"  >
            <form action="" action="GET">
                <div style="" class=""> 
                    <input type="month" name="submit">
                    <button type="submit" class="btn btn-outline-primary">ค้นหา</button>
                </div>
                </form> 
            </div>

<!--             <div style=" padding:30px;" class="btn-group btn-group-toggle" role="group"  >
              <button  id="btn_min" style="" class="btn btn-outline-primary">Min</button>
              <button  id="btn_avg" style="" class="btn btn-outline-primary">Avg</button>
              <button  id="btn_max" style="" class="btn btn-outline-primary">Max</button>
            </div> -->

        </div>
        
   <!--  <div style="justify-content:center; padding-left:5%; padding-right:5%; text-align:center;" class="row">
      <div class="cardNo">

      </div>
      <div class="cardNo">

      </div>
      <div class="cardNo ">

      </div>
      <div class="cardNo ">

      </div>
    </div> -->


    <script>

var chart;
var type = 0;

//Week
const P_Die_B7_price = [];
const Die_price = [];
const Die_B20_price = [];
const Gasolin_95_price = [];
const Gasohol_95_price = [];
const Gasohol_91_price = [];
const Gasohol_E20_price = [];
const Gasohol_E85_price = [];
const Die_B7_price = [];
const P_Gasohol_95_price = [];
//Month
const Month_P_Die_B7_price = [];
const Month_Die_price = [];
const Month_Die_B20_price = [];
const Month_Gasolin_95_price = [];
const Month_Gasohol_95_price = [];
const Month_Gasohol_91_price = [];
const Month_Gasohol_E20_price = [];
const Month_Gasohol_E85_price = [];
const Month_Die_B7_price = [];
const Month_P_Gasohol_95_price = [];
//Year
const Year_P_Die_B7_price = [];
const Year_Die_price = [];
const Year_Die_B20_price = [];
const Year_Gasolin_95_price = [];
const Year_Gasohol_95_price = [];
const Year_Gasohol_91_price = [];
const Year_Gasohol_E20_price = [];
const Year_Gasohol_E85_price = [];
const Year_Die_B7_price = [];
const Year_P_Gasohol_95_price = [];

// most week
const M_P_Die_B7_price = [];
const M_Die_price = [];
const M_Die_B20_price = [];
const M_Gasolin_95_price = [];
const M_Gasohol_95_price = [];
const M_Gasohol_91_price = [];
const M_Gasohol_E20_price = [];
const M_Gasohol_E85_price = [];
const M_Die_B7_price = [];
const M_P_Gasohol_95_price = [];
//most month
const MM_P_Die_B7_price = [];
const MM_Die_price = [];
const MM_Die_B20_price = [];
const MM_Gasolin_95_price = [];
const MM_Gasohol_95_price = [];
const MM_Gasohol_91_price = [];
const MM_Gasohol_E20_price = [];
const MM_Gasohol_E85_price = [];
const MM_Die_B7_price = [];
const MM_P_Gasohol_95_price = [];
//most year
const MY_P_Die_B7_price = [];
const MY_Die_price = [];
const MY_Die_B20_price = [];
const MY_Gasolin_95_price = [];
const MY_Gasohol_95_price = [];
const MY_Gasohol_91_price = [];
const MY_Gasohol_E20_price = [];
const MY_Gasohol_E85_price = [];
const MY_Die_B7_price = [];
const MY_P_Gasohol_95_price = [];

const week_min_p_die_b7_price =[];
const week_min_die_price =[];
const week_min_die_B20_price =[];
const week_min_gasolin_95_price =[];
const week_min_gasohol_95_price =[];
const week_min_gasohol_91_price =[];
const week_min_gasohol_e20_price =[];
const week_min_gasohol_e85_price =[];
const week_min_die_b7_price =[];
const week_min_p_gasohol_95_price =[];

const month_min_p_die_b7_price =[];
const month_min_die_price =[];
const month_min_die_b20_price =[];
const month_min_gasolin_95_price =[];
const month_min_gasohol_95_price =[];
const month_min_gasohol_91_price =[];
const month_min_gasohol_e20_price =[];
const month_min_gasohol_e85_price =[];
const month_min_die_b7_price =[];
const month_min_p_gasohol_95_price =[];

const year_min_p_die_b7_price =[];
const year_min_die_price =[];
const year_min_die_b20_price =[];
const year_min_gasolin_95_price =[];
const year_min_gasohol_95_price =[];
const year_min_gasohol_91_price =[];
const year_min_gasohol_e20_price =[];
const year_min_gasohol_e85_price =[];
const year_min_die_b7_price =[];
const year_min_p_gasohol_95_price =[];


const week_avg_p_die_b7_price =[];
const week_avg_die_price =[];
const week_avg_die_B20_price =[];
const week_avg_gasolin_95_price =[];
const week_avg_gasohol_95_price =[];
const week_avg_gasohol_91_price =[];
const week_avg_gasohol_e20_price =[];
const week_avg_gasohol_e85_price =[];
const week_avg_die_b7_price =[];
const week_avg_p_gasohol_95_price =[];

const month_avg_p_die_b7_price =[];
const month_avg_die_price =[];
const month_avg_die_b20_price =[];
const month_avg_gasolin_95_price =[];
const month_avg_gasohol_95_price =[];
const month_avg_gasohol_91_price =[];
const month_avg_gasohol_e20_price =[];
const month_avg_gasohol_e85_price =[];
const month_avg_die_b7_price =[];
const month_avg_p_gasohol_95_price =[];


const year_avg_p_die_b7_price =[];
const year_avg_die_price =[];
const year_avg_die_b20_price =[];
const year_avg_gasolin_95_price =[];
const year_avg_gasohol_95_price =[];
const year_avg_gasohol_91_price =[];
const year_avg_gasohol_e20_price =[];
const year_avg_gasohol_e85_price =[];
const year_avg_die_b7_price =[];
const year_avg_p_gasohol_95_price =[];


//most
const week_most = (<?php echo json_encode($week_most); ?>);
M_P_Die_B7_price.push([week_most[0].price]);
M_Die_price.push([week_most[1].price]);
M_Die_B20_price.push([week_most[2].price]);
M_Gasolin_95_price.push([week_most[3].price]);
M_Gasohol_95_price.push([week_most[4].price]);
M_Gasohol_91_price.push([week_most[5].price]);
M_Gasohol_E20_price.push([week_most[6].price]);
M_Gasohol_E85_price.push([week_most[7].price]);
M_Die_B7_price.push([week_most[8].price]);
M_P_Gasohol_95_price.push([week_most[9].price]);
//most month 
const month_most = (<?php echo json_encode($month_most); ?>);
MM_P_Die_B7_price.push([month_most[0].price]);
MM_Die_price.push([month_most[1].price]);
MM_Die_B20_price.push([month_most[2].price]);
MM_Gasolin_95_price.push([month_most[3].price]);
MM_Gasohol_95_price.push([month_most[4].price]);
MM_Gasohol_91_price.push([month_most[5].price]);
MM_Gasohol_E20_price.push([month_most[6].price]);
MM_Gasohol_E85_price.push([month_most[7].price]);
MM_Die_B7_price.push([month_most[8].price]);
MM_P_Gasohol_95_price.push([month_most[9].price]);

//most year
const year_most = (<?php echo json_encode($year_most); ?>);
MY_P_Die_B7_price.push([year_most[0].price]);
MY_Die_price.push([year_most[1].price]);
MY_Die_B20_price.push([year_most[2].price]);
MY_Gasolin_95_price.push([year_most[3].price]);
MY_Gasohol_95_price.push([year_most[4].price]);
MY_Gasohol_91_price.push([year_most[5].price]);
MY_Gasohol_E20_price.push([year_most[6].price]);
MY_Gasohol_E85_price.push([year_most[7].price]);
MY_Die_B7_price.push([year_most[8].price]);
MY_P_Gasohol_95_price.push([year_most[9].price]);

//min
const week_min = (<?php echo json_encode($week_min); ?>);
week_min_p_die_b7_price.push([week_min[0].price]);
week_min_die_price.push([week_min[1].price]);
week_min_die_B20_price.push([week_min[2].price]);
week_min_gasolin_95_price.push([week_min[3].price]);
week_min_gasohol_95_price.push([week_min[4].price]);
week_min_gasohol_91_price.push([week_min[5].price]);
week_min_gasohol_e20_price.push([week_min[6].price]);
week_min_gasohol_e85_price.push([week_min[7].price]);
week_min_die_b7_price.push([week_min[8].price]);
week_min_p_gasohol_95_price.push([week_min[9].price]);
//min month 
const month_min = (<?php echo json_encode($month_min); ?>);
month_min_p_die_b7_price.push([month_min[0].price]);
month_min_die_price.push([month_min[1].price]);
month_min_die_b20_price.push([month_min[2].price]);
month_min_gasolin_95_price.push([month_min[3].price]);
month_min_gasohol_95_price.push([month_min[4].price]);
month_min_gasohol_91_price.push([month_min[5].price]);
month_min_gasohol_e20_price.push([month_min[6].price]);
month_min_gasohol_e85_price.push([month_min[7].price]);
month_min_die_b7_price.push([month_min[8].price]);
month_min_p_gasohol_95_price.push([month_min[9].price]);
//min year
const year_min = (<?php echo json_encode($year_min); ?>);
year_min_p_die_b7_price.push([year_min[0].price]);
year_min_die_price.push([year_min[1].price]);
year_min_die_b20_price.push([year_min[2].price]);
year_min_gasolin_95_price.push([year_min[3].price]);
year_min_gasohol_95_price.push([year_min[4].price]);
year_min_gasohol_91_price.push([year_min[5].price]);
year_min_gasohol_e20_price.push([year_min[6].price]);
year_min_gasohol_e85_price.push([year_min[7].price]);
year_min_die_b7_price.push([year_min[8].price]);
year_min_p_gasohol_95_price.push([year_min[9].price]);

//avg
const week_avg = (<?php echo json_encode($week_avg); ?>);
week_avg_p_die_b7_price.push([week_avg[0].price]);
week_avg_die_price.push([week_avg[1].price]);
week_avg_die_B20_price.push([week_avg[2].price]);
week_avg_gasolin_95_price.push([week_avg[3].price]);
week_avg_gasohol_95_price.push([week_avg[4].price]);
week_avg_gasohol_91_price.push([week_avg[5].price]);
week_avg_gasohol_e20_price.push([week_avg[6].price]);
week_avg_gasohol_e85_price.push([week_avg[7].price]);
week_avg_die_b7_price.push([week_avg[8].price]);
week_avg_p_gasohol_95_price.push([week_avg[9].price]);
//avg month 
const month_avg = (<?php echo json_encode($month_avg); ?>);
month_avg_p_die_b7_price.push([month_avg[0].price]);
month_avg_die_price.push([month_avg[1].price]);
month_avg_die_b20_price.push([month_avg[2].price]);
month_avg_gasolin_95_price.push([month_avg[3].price]);
month_avg_gasohol_95_price.push([month_avg[4].price]);
month_avg_gasohol_91_price.push([month_avg[5].price]);
month_avg_gasohol_e20_price.push([month_avg[6].price]);
month_avg_gasohol_e85_price.push([month_avg[7].price]);
month_avg_die_b7_price.push([month_avg[8].price]);
month_avg_p_gasohol_95_price.push([month_avg[9].price]);

//avg year
const year_avg = (<?php echo json_encode($year_avg); ?>);
year_avg_p_die_b7_price.push([year_avg[0].price]);
year_avg_die_price.push([year_avg[1].price]);
year_avg_die_b20_price.push([year_avg[2].price]);
year_avg_gasolin_95_price.push([year_avg[3].price]);
year_avg_gasohol_95_price.push([year_avg[4].price]);
year_avg_gasohol_91_price.push([year_avg[5].price]);
year_avg_gasohol_e20_price.push([year_avg[6].price]);
year_avg_gasohol_e85_price.push([year_avg[7].price]);
year_avg_die_b7_price.push([year_avg[8].price]);
year_avg_p_gasohol_95_price.push([year_avg[9].price]);



const date = [];

const week_gas = (<?php echo json_encode($week_gas); ?>);
const week_p_die_b7 = week_gas[0]
const week_die = week_gas[1]
const week_die_b20 = week_gas[2]
const week_gasolin_95 = week_gas[3]
const week_gasohol_95 = week_gas[4]
const week_gasohol_91 = week_gas[5]
const week_gasohol_e20 = week_gas[6]
const week_gasohol_e85 = week_gas[7]
const week_die_b7 = week_gas[8]
const week_p_gasohol_95 = week_gas[9]

week_p_die_b7.forEach(element => {
    date.push(element.date);
    P_Die_B7_price.push({x: element.date, y: element.price})
});

week_die.forEach(element => {
    date.push(element.date);
    Die_price.push({x: element.date, y: element.price})
});

week_die_b20.forEach(element => {
    date.push(element.date);
    Die_B20_price.push({x: element.date, y: element.price})
});
week_gasolin_95.forEach(element => {
    date.push(element.date);
    Gasolin_95_price.push({x: element.date, y: element.price})
});
week_gasohol_95.forEach(element => {
    date.push(element.date);
    Gasohol_95_price.push({x: element.date, y: element.price})
});
week_gasohol_91.forEach(element => {
    date.push(element.date);
    Gasohol_91_price.push({x: element.date, y: element.price})
});
week_gasohol_e20.forEach(element => {
    date.push(element.date);
    Gasohol_E20_price.push({x: element.date, y: element.price})
});
week_gasohol_e85.forEach(element => {
    date.push(element.date);
    Gasohol_E85_price.push({x: element.date, y: element.price})
});
week_die_b7.forEach(element => {
    date.push(element.date);
    Die_B7_price.push({x: element.date, y: element.price})
});
week_p_gasohol_95.forEach(element => {
    date.push(element.date);
    P_Gasohol_95_price.push({x: element.date, y: element.price})
});

//month
const month_gas = (<?php echo json_encode($month_gas); ?>);
const month_p_die_b7 = month_gas[0]
const month_die = month_gas[1]
const month_die_b20 = month_gas[2]
const month_gasolin_95 = month_gas[3]
const month_gasohol_95 = month_gas[4]
const month_gasohol_91 = month_gas[5]
const month_gasohol_e20 = month_gas[6]
const month_gasohol_e85 = month_gas[7]
const month_die_b7 = month_gas[8]
const month_p_gasohol_95 = month_gas[9]

month_p_die_b7.forEach(element => {
    date.push(element.date);
    Month_P_Die_B7_price.push({x: element.date, y: element.price})
});

month_die.forEach(element => {
    date.push(element.date);
    Month_Die_price.push({x: element.date, y: element.price})
});
month_die_b20.forEach(element => {
    date.push(element.date);
    Month_Die_B20_price.push({x: element.date, y: element.price})
});
month_gasolin_95.forEach(element => {
    date.push(element.date);
    Month_Gasolin_95_price.push({x: element.date, y: element.price})
});
month_gasohol_95.forEach(element => {
    date.push(element.date);
    Month_Gasohol_95_price.push({x: element.date, y: element.price})
});
month_gasohol_91.forEach(element => {
    date.push(element.date);
    Month_Gasohol_91_price.push({x: element.date, y: element.price})
});
month_gasohol_e20.forEach(element => {
    date.push(element.date);
    Month_Gasohol_E20_price.push({x: element.date, y: element.price})
});
month_gasohol_e85.forEach(element => {
    date.push(element.date);
    Month_Gasohol_E85_price.push({x: element.date, y: element.price})
});
month_die_b7.forEach(element => {
    date.push(element.date);
    Month_Die_B7_price.push({x: element.date, y: element.price})
});
month_p_gasohol_95.forEach(element => {
    date.push(element.date);
    Month_P_Gasohol_95_price.push({x: element.date, y: element.price})
}); 

//Year
const year_gas = (<?php echo json_encode($year_gas); ?>);
const year_p_die_b7 = year_gas[0]
const year_die = year_gas[1]
const year_die_b20 = year_gas[2]
const year_gasolin_95 = year_gas[3]
const year_gasohol_95 = year_gas[4]
const year_gasohol_91 = year_gas[5]
const year_gasohol_e20 = year_gas[6]
const year_gasohol_e85 = year_gas[7]
const year_die_b7 = year_gas[8]
const year_p_gasohol_95 = year_gas[9]
year_p_die_b7.forEach(element => {
    date.push(element.date);
    Year_P_Die_B7_price.push({x: element.date, y: element.price})
});
year_die.forEach(element => {
    date.push(element.date);
    Year_Die_price.push({x: element.date, y: element.price})
});
year_die_b20.forEach(element => {
    date.push(element.date);
    Year_Die_B20_price.push({x: element.date, y: element.price})
});
year_gasolin_95.forEach(element => {
    date.push(element.date);
    Year_Gasolin_95_price.push({x: element.date, y: element.price})
});
year_gasohol_95.forEach(element => {
    date.push(element.date);
    Year_Gasohol_95_price.push({x: element.date, y: element.price})
});
year_gasohol_91.forEach(element => {
    date.push(element.date);
    Year_Gasohol_91_price.push({x: element.date, y: element.price})
});
year_gasohol_e20.forEach(element => {
    date.push(element.date);
    Year_Gasohol_E20_price.push({x: element.date, y: element.price})
});
year_gasohol_e85.forEach(element => {
    date.push(element.date);
    Year_Gasohol_E85_price.push({x: element.date, y: element.price})
});
year_die_b7.forEach(element => {
    date.push(element.date);
    Year_Die_B7_price.push({x: element.date, y: element.price})
});
year_p_gasohol_95.forEach(element => {
    date.push(element.date);
    Year_P_Gasohol_95_price.push({x: element.date, y: element.price})
}); 


const T_P_Die_B7_price = week_gas[0];
const T_Die_price = week_gas[1];
const T_Die_B20_price = week_gas[2];
const T_Gasolin_95_price = week_gas[3];
const T_Gasohol_95_price = week_gas[4];
const T_Gasohol_91_price = week_gas[5];
const T_Gasohol_E20_price = week_gas[6];
const T_Gasohol_E85_price = week_gas[7];
const T_Die_B7_price = week_gas[8];
const T_P_Gasohol_95_price = week_gas[9];
$("#T_P_Die_B7").text(T_P_Die_B7_price[T_P_Die_B7_price.length -1].price);
$("#T_Die").text(T_Die_price[T_Die_price.length -1].price);
$("#T_Die_B20").text(T_Die_B20_price[T_Die_B20_price.length -1].price);
$("#T_Gasolin_95").text(T_Gasolin_95_price[T_Gasolin_95_price.length -1].price);
$("#T_Gasohol_95").text(T_Gasohol_95_price[T_Gasohol_95_price.length -1].price);
$("#T_Gasohol_91").text(T_Gasohol_91_price[T_Gasohol_91_price.length -1].price);
$("#T_Gasohol_E20").text(T_Gasohol_E20_price[T_Gasohol_E20_price.length -1].price);
$("#T_Gasohol_E85").text(T_Gasohol_E85_price[T_Gasohol_E85_price.length -1].price);
$("#T_Die_B7").text(T_Die_B7_price[T_Die_B7_price.length -1].price);
$("#T_P_Gasohol_95").text(T_P_Gasohol_95_price[T_P_Gasohol_95_price.length -1].price);

const Today = T_P_Die_B7_price[T_P_Die_B7_price.length -1].date;
const strDate = new Date(Today).toLocaleDateString('en-GB');
$("#Today").text(strDate);

$( document ).ready(function() {
                $("#datetype").text("30 วัน");
                $("#datatype").text("ราคาสูงสุดใน");
                MonthGas()

/*              $("#btn_min").removeClass("active");
                $("#btn_avg").removeClass("active");
                $("#btn_max").addClass("active"); */
                month_max_data()
                month_min_data()
                month_avg_data()
    });
    

$("#btn_week").click(function () {
            type = 0;
            $("#btn_week").addClass("active");
            $("#btn_month").removeClass("active");
            $("#btn_year").removeClass("active");
            $("#datetype").text("7 วัน");
            if(chart)
            chart.destroy()
            WeekGas()
            week_max_data()
            $("#btn_min").removeClass("active");
            $("#btn_avg").removeClass("active");
            $("#btn_max").addClass("active");
            $("#datatype").text("ราคาสูงสุดใน");
});
$("#btn_month").click(function () {
            type = 1;
            $("#btn_week").removeClass("active");
            $("#btn_month").addClass("active");
            $("#btn_year").removeClass("active");
            $("#datetype").text("30 วัน");
            if(chart)
            chart.destroy()
            MonthGas()
            month_max_data()
            $("#btn_min").removeClass("active");
            $("#btn_avg").removeClass("active");
            $("#btn_max").addClass("active");
            $("#datatype").text("ราคาสูงสุดใน");
});
$("#btn_year").click(function () {
            type = 2;
            $("#btn_week").removeClass("active");
            $("#btn_month").removeClass("active");
            $("#btn_year").addClass("active");
            $("#datetype").text("365 วัน");
            if(chart)
            chart.destroy()
            YearGas()
            year_max_data()
            $("#btn_min").removeClass("active");
            $("#btn_avg").removeClass("active");
            $("#btn_max").addClass("active");
            $("#datatype").text("ราคาสูงสุดใน");
});

$("#btn_min").click(function() {
            $("#btn_min").addClass("active");
            $("#btn_avg").removeClass("active");
            $("#btn_max").removeClass("active");
            $("#datatype").text("ราคาต่ำสุดใน");
            if (type == 0) {
              week_min_data()
            } else if (type == 1) {
              month_min_data()
            } else {
              year_min_data()
            }
})
$("#btn_avg").click(function() {
            $("#btn_min").removeClass("active");
            $("#btn_avg").addClass("active");
            $("#btn_max").removeClass("active");
            $("#datatype").text("ราคาเฉลี่ยใน");
            if (type == 0) {
              week_avg_data()
            } else if (type == 1) {
              month_avg_data()
            } else {
              year_avg_data()
            }

})
$("#btn_max").click(function() {
            $("#btn_min").removeClass("active");
            $("#btn_avg").removeClass("active");
            $("#btn_max").addClass("active");
            $("#datatype").text("ราคาสูงสุดใน");
            if (type == 0) {
              week_max_data()
            } else if (type == 1) {
              month_max_data()
            } else {
              year_max_data()
            }
            
})

//  function week_min_data() {
//     $("#P_Die_B7").text(week_min_p_die_b7_price);
//     $("#Die").text(week_min_die_price);
//     $("#Die_B20").text(week_min_die_B20_price);
//     $("#Gasolin_95").text(week_min_gasolin_95_price);
//     $("#Gasohol_95").text(week_min_gasohol_95_price);
//     $("#Gasohol_91").text(week_min_gasohol_91_price);
//     $("#Gasohol_E20").text(week_min_gasohol_e20_price);
//     $("#Gasohol_E85").text(week_min_gasohol_e85_price);
//     $("#Die_B7").text(week_min_die_b7_price);
//     $("#P_Gasohol_95").text(week_min_p_gasohol_95_price);
//  }
//  function week_avg_data() {
//     $("#P_Die_B7").text(week_avg_p_die_b7_price);
//     $("#Die").text(week_avg_die_price);
//     $("#Die_B20").text(week_avg_die_B20_price);
//     $("#Gasolin_95").text(week_avg_gasolin_95_price);
//     $("#Gasohol_95").text(week_avg_gasohol_95_price);
//     $("#Gasohol_91").text(week_avg_gasohol_91_price);
//     $("#Gasohol_E20").text(week_avg_gasohol_e20_price);
//     $("#Gasohol_E85").text(week_avg_gasohol_e85_price);
//     $("#Die_B7").text(week_avg_die_b7_price);
//     $("#P_Gasohol_95").text(week_avg_p_gasohol_95_price);
//  }
//  function week_max_data() {
//     $("#P_Die_B7").text(M_P_Die_B7_price);
//     $("#Die").text(M_Die_price);
//     $("#Die_B20").text(M_Die_B20_price);
//     $("#Gasolin_95").text(M_Gasolin_95_price);
//     $("#Gasohol_95").text(M_Gasohol_95_price);
//     $("#Gasohol_91").text(M_Gasohol_91_price);
//     $("#Gasohol_E20").text(M_Gasohol_E20_price);
//     $("#Gasohol_E85").text(M_Gasohol_E85_price);
//     $("#Die_B7").text(M_Die_B7_price);
//     $("#P_Gasohol_95").text(M_P_Gasohol_95_price);
//  }

 function month_min_data() {
        $("#min_P_Die_B7").text(month_min_p_die_b7_price);
        $("#min_Die").text(month_min_die_price);
        $("#min_Die_B20").text(month_min_die_b20_price);
        $("#min_Gasolin_95").text(month_min_gasolin_95_price);
        $("#min_Gasohol_95").text(month_min_gasohol_95_price);
        $("#min_Gasohol_91").text(month_min_gasohol_91_price);
        $("#min_Gasohol_E20").text(month_min_gasohol_e20_price);
        $("#min_Gasohol_E85").text(month_min_gasohol_e85_price);
        $("#min_Die_B7").text(month_min_die_b7_price);
        $("#min_P_Gasohol_95").text(month_min_p_gasohol_95_price);
     }
     
     function month_avg_data() {
        $("#avg_P_Die_B7").text(month_avg_p_die_b7_price);
        $("#avg_Die").text(month_avg_die_price);
        $("#avg_Die_B20").text(month_avg_die_b20_price);
        $("#avg_Gasolin_95").text(month_avg_gasolin_95_price);
        $("#avg_Gasohol_95").text(month_avg_gasohol_95_price);
        $("#avg_Gasohol_91").text(month_avg_gasohol_91_price);
        $("#avg_Gasohol_E20").text(month_avg_gasohol_e20_price);
        $("#avg_Gasohol_E85").text(month_avg_gasohol_e85_price);
        $("#avg_Die_B7").text(month_avg_die_b7_price);
        $("#avg_P_Gasohol_95").text(month_avg_p_gasohol_95_price);
     }
     function month_max_data() {
        $("#max_P_Die_B7").text(MM_P_Die_B7_price);
        $("#max_Die").text(MM_Die_price);
        $("#max_Die_B20").text(MM_Die_B20_price);
        $("#max_Gasolin_95").text(MM_Gasolin_95_price);
        $("#max_Gasohol_95").text(MM_Gasohol_95_price);
        $("#max_Gasohol_91").text(MM_Gasohol_91_price);
        $("#max_Gasohol_E20").text(MM_Gasohol_E20_price);
        $("#max_Gasohol_E85").text(MM_Gasohol_E85_price);
        $("#max_Die_B7").text(MM_Die_B7_price);
        $("#max_P_Gasohol_95").text(MM_P_Gasohol_95_price);
     }


//  function year_min_data() {
//     $("#P_Die_B7").text(year_min_p_die_b7_price);
//     $("#Die").text(year_min_die_price);
//     $("#Die_B20").text(year_min_die_b20_price);
//     $("#Gasolin_95").text(year_min_gasolin_95_price);
//     $("#Gasohol_95").text(year_min_gasohol_95_price);
//     $("#Gasohol_91").text(year_min_gasohol_91_price);
//     $("#Gasohol_E20").text(year_min_gasohol_e20_price);
//     $("#Gasohol_E85").text(year_min_gasohol_e85_price);
//     $("#Die_B7").text(year_min_die_b7_price);
//     $("#P_Gasohol_95").text(year_min_p_gasohol_95_price);
//  }
//  function year_avg_data() {
//     $("#P_Die_B7").text(year_avg_p_die_b7_price);
//     $("#Die").text(year_avg_die_price);
//     $("#Die_B20").text(year_avg_die_b20_price);
//     $("#Gasolin_95").text(year_avg_gasolin_95_price);
//     $("#Gasohol_95").text(year_avg_gasohol_95_price);
//     $("#Gasohol_91").text(year_avg_gasohol_91_price);
//     $("#Gasohol_E20").text(year_avg_gasohol_e20_price);
//     $("#Gasohol_E85").text(year_avg_gasohol_e85_price);
//     $("#Die_B7").text(year_avg_die_b7_price);
//     $("#P_Gasohol_95").text(year_avg_p_gasohol_95_price);
//  }
//  function year_max_data() {        
//     $("#P_Die_B7").text(MY_P_Die_B7_price);
//     $("#Die").text(MY_Die_price);
//     $("#Die_B20").text(MY_Die_B20_price);
//     $("#Gasolin_95").text(MY_Gasolin_95_price);
//     $("#Gasohol_95").text(MY_Gasohol_95_price);
//     $("#Gasohol_91").text(MY_Gasohol_91_price);
//     $("#Gasohol_E20").text(MY_Gasohol_E20_price);
//     $("#Gasohol_E85").text(MY_Gasohol_E85_price);
//     $("#Die_B7").text(MY_Die_B7_price);
//     $("#P_Gasohol_95").text(MY_P_Gasohol_95_price);}

  function WeekGas() {
    const week = {
    datasets: [
    {
      label: 'Premium Diesel B7',
      data: P_Die_B7_price,
    //   data: [date,P_Die_B7_price],
      backgroundColor: '#c0bec1',
      borderColor: '#c0bec1',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Diesel',
      data: Die_price,
      backgroundColor: '#1f3684',
      borderColor: '#1f3684',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Diesel B20',
      data: Die_B20_price,
      backgroundColor: '#c4171d',
      borderColor: '#c4171d',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Bensin',
      data: Gasolin_95_price,
      backgroundColor: '#ffd601',
      borderColor: '#ffd601',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol 95',
      data: Gasohol_95_price,
      backgroundColor: '#eb6609',
      borderColor: '#eb6609',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol 91',
      data: Gasohol_91_price,
      backgroundColor: '#10a64f',
      borderColor: '#10a64f',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol E20',
      data: Gasohol_E20_price,
      backgroundColor: '#aec90c',
      borderColor: '#aec90c',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol E85',
      data: Gasohol_E85_price,
      backgroundColor: '#b01280',
      borderColor: '#b01280',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Diesel B7',
      data: Die_B7_price,
      backgroundColor: '#0168b3',
      borderColor: '#0168b3',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Premium Gasohol 95',
      data: P_Gasohol_95_price,
      backgroundColor: '#d4a86a',
      borderColor: '#d4a86a',
      fill: false,
      tension: 0.1
    },
    ]
    };

    const day = {
    type: 'line',
    data: week,
    options: {
    },
    };

    chart = new Chart(
    document.getElementById('myChart'),
    day
    );
}

  function MonthGas() {

    const month = {
    datasets: [
    {
      label: 'Premium Diesel B7',
      data: Month_P_Die_B7_price,
    //   data: [date,P_Die_B7_price],
      backgroundColor: '#c0bec1',
      borderColor: '#c0bec1',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Diesel',
      data: Month_Die_price,
      backgroundColor: '#1f3684',
      borderColor: '#1f3684',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Diesel B20',
      data: Month_Die_B20_price,
      backgroundColor: '#c4171d',
      borderColor: '#c4171d',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Bensin',
      data: Month_Gasolin_95_price,
      backgroundColor: '#ffd601',
      borderColor: '#ffd601',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol 95',
      data: Month_Gasohol_95_price,
      backgroundColor: '#eb6609',
      borderColor: '#eb6609',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol 91',
      data: Month_Gasohol_91_price,
      backgroundColor: '#10a64f',
      borderColor: '#10a64f',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol E20',
      data: Month_Gasohol_E20_price,
      backgroundColor: '#aec90c',
      borderColor: '#aec90c',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol E85',
      data: Month_Gasohol_E85_price,
      backgroundColor: '#b01280',
      borderColor: '#b01280',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Diesel B7',
      data: Month_Die_B7_price,
      backgroundColor: '#0168b3',
      borderColor: '#0168b3',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Premium Gasohol 95',
      data: Month_P_Gasohol_95_price,
      backgroundColor: '#d4a86a',
      borderColor: '#d4a86a',
      fill: false,
      tension: 0.1
    },
    ]
    };


    // console.log(month);

    const day = {
    type: 'line',
    data: month,
    options: {
    },
    };
    
    chart = new Chart(
    document.getElementById('myChart'),
    day
    );
}
function YearGas() {
    const year = {
    datasets: [
    {
      label: 'Premium Diesel B7',
      data: Year_P_Die_B7_price,
    //   data: [date,P_Die_B7_price],
      backgroundColor: '#c0bec1',
      borderColor: '#c0bec1',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Diesel',
      data: Year_Die_price,
      backgroundColor: '#1f3684',
      borderColor: '#1f3684',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Diesel B20',
      data: Year_Die_B20_price,
      backgroundColor: '#c4171d',
      borderColor: '#c4171d',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Bensin',
      data: Year_Gasolin_95_price,
      backgroundColor: '#ffd601',
      borderColor: '#ffd601',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol 95',
      data: Year_Gasohol_95_price,
      backgroundColor: '#eb6609',
      borderColor: '#eb6609',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol 91',
      data: Year_Gasohol_91_price,
      backgroundColor: '#10a64f',
      borderColor: '#10a64f',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol E20',
      data: Year_Gasohol_E20_price,
      backgroundColor: '#aec90c',
      borderColor: '#aec90c',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Gasohol E85',
      data: Year_Gasohol_E85_price,
      backgroundColor: '#b01280',
      borderColor: '#b01280',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Diesel B7',
      data: Year_Die_B7_price,
      backgroundColor: '#0168b3',
      borderColor: '#0168b3',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Premium Gasohol 95',
      data: Year_P_Gasohol_95_price,
      backgroundColor: '#d4a86a',
      borderColor: '#d4a86a',
      fill: false,
      tension: 0.1
    },
    ]
    };

    const day = {
    type: 'line',
    data: year,
    options: {
    },
    };

    chart = new Chart(
    document.getElementById('myChart'),
    day
    );
}

</script>




    <!-- <script>
    var chart;
    var type = 0;

    //Week
    const P_Die_B7_price = [];
    const Die_price = [];
    const Die_B20_price = [];
    const Gasolin_95_price = [];
    const Gasohol_95_price = [];
    const Gasohol_91_price = [];
    const Gasohol_E20_price = [];
    const Gasohol_E85_price = [];
    const Die_B7_price = [];
    const P_Gasohol_95_price = [];
    //Month
    const Month_P_Die_B7_price = [];
    const Month_Die_price = [];
    const Month_Die_B20_price = [];
    const Month_Gasolin_95_price = [];
    const Month_Gasohol_95_price = [];
    const Month_Gasohol_91_price = [];
    const Month_Gasohol_E20_price = [];
    const Month_Gasohol_E85_price = [];
    const Month_Die_B7_price = [];
    const Month_P_Gasohol_95_price = [];
    //Year
    // const Year_P_Die_B7_price = [];
    // const Year_Die_price = [];
    // const Year_Die_B20_price = [];
    // const Year_Gasolin_95_price = [];
    // const Year_Gasohol_95_price = [];
    // const Year_Gasohol_91_price = [];
    // const Year_Gasohol_E20_price = [];
    // const Year_Gasohol_E85_price = [];
    // const Year_Die_B7_price = [];
    // const Year_P_Gasohol_95_price = [];

    // most week
/*     const M_P_Die_B7_price = [];
    const M_Die_price = [];
    const M_Die_B20_price = [];
    const M_Gasolin_95_price = [];
    const M_Gasohol_95_price = [];
    const M_Gasohol_91_price = [];
    const M_Gasohol_E20_price = [];
    const M_Gasohol_E85_price = [];
    const M_Die_B7_price = [];
    const M_P_Gasohol_95_price = []; */

    //most month
    const MM_P_Die_B7_price = [];
    const MM_Die_price = [];
    const MM_Die_B20_price = [];
    const MM_Gasolin_95_price = [];
    const MM_Gasohol_95_price = [];
    const MM_Gasohol_91_price = [];
    const MM_Gasohol_E20_price = [];
    const MM_Gasohol_E85_price = [];
    const MM_Die_B7_price = [];
    const MM_P_Gasohol_95_price = [];

/*     const week_min_p_die_b7_price =[];
    const week_min_die_price =[];
    const week_min_die_B20_price =[];
    const week_min_gasolin_95_price =[];
    const week_min_gasohol_95_price =[];
    const week_min_gasohol_91_price =[];
    const week_min_gasohol_e20_price =[];
    const week_min_gasohol_e85_price =[];
    const week_min_die_b7_price =[];
    const week_min_p_gasohol_95_price =[]; */

    const month_min_p_die_b7_price =[];
    const month_min_die_price =[];
    const month_min_die_b20_price =[];
    const month_min_gasolin_95_price =[];
    const month_min_gasohol_95_price =[];
    const month_min_gasohol_91_price =[];
    const month_min_gasohol_e20_price =[];
    const month_min_gasohol_e85_price =[];
    const month_min_die_b7_price =[];
    const month_min_p_gasohol_95_price =[];



    const month_avg_p_die_b7_price =[];
    const month_avg_die_price =[];
    const month_avg_die_b20_price =[];
    const month_avg_gasolin_95_price =[];
    const month_avg_gasohol_95_price =[];
    const month_avg_gasohol_91_price =[];
    const month_avg_gasohol_e20_price =[];
    const month_avg_gasohol_e85_price =[];
    const month_avg_die_b7_price =[];
    const month_avg_p_gasohol_95_price =[];



    
    //most
/*     const week_most = (<?php echo json_encode($week_most); ?>);
    M_P_Die_B7_price.push([week_most[0].price]);
    M_Die_price.push([week_most[1].price]);
    M_Die_B20_price.push([week_most[2].price]);
    M_Gasolin_95_price.push([week_most[3].price]);
    M_Gasohol_95_price.push([week_most[4].price]);
    M_Gasohol_91_price.push([week_most[5].price]);
    M_Gasohol_E20_price.push([week_most[6].price]);
    M_Gasohol_E85_price.push([week_most[7].price]);
    M_Die_B7_price.push([week_most[8].price]);
    M_P_Gasohol_95_price.push([week_most[9].price]); */


    
    //most month 
    const month_most = (<?php echo json_encode($month_most); ?>);
    MM_P_Die_B7_price.push([month_most[0].price]);
    MM_Die_price.push([month_most[1].price]);
    MM_Die_B20_price.push([month_most[2].price]);
    MM_Gasolin_95_price.push([month_most[3].price]);
    MM_Gasohol_95_price.push([month_most[4].price]);
    MM_Gasohol_91_price.push([month_most[5].price]);
    MM_Gasohol_E20_price.push([month_most[6].price]);
    MM_Gasohol_E85_price.push([month_most[7].price]);
    MM_Die_B7_price.push([month_most[8].price]);
    MM_P_Gasohol_95_price.push([month_most[9].price]);

    //most year
/*     const year_most = (<?php echo json_encode($year_most); ?>);
    MY_P_Die_B7_price.push([year_most[0].price]);
    MY_Die_price.push([year_most[1].price]);
    MY_Die_B20_price.push([year_most[2].price]);
    MY_Gasolin_95_price.push([year_most[3].price]);
    MY_Gasohol_95_price.push([year_most[4].price]);
    MY_Gasohol_91_price.push([year_most[5].price]);
    MY_Gasohol_E20_price.push([year_most[6].price]);
    MY_Gasohol_E85_price.push([year_most[7].price]);
    MY_Die_B7_price.push([year_most[8].price]);
    MY_P_Gasohol_95_price.push([year_most[9].price]); */

    //min
/*     const week_min = (<?php echo json_encode($week_min); ?>);
    week_min_p_die_b7_price.push([week_min[0].price]);
    week_min_die_price.push([week_min[1].price]);
    week_min_die_B20_price.push([week_min[2].price]);
    week_min_gasolin_95_price.push([week_min[3].price]);
    week_min_gasohol_95_price.push([week_min[4].price]);
    week_min_gasohol_91_price.push([week_min[5].price]);
    week_min_gasohol_e20_price.push([week_min[6].price]);
    week_min_gasohol_e85_price.push([week_min[7].price]);
    week_min_die_b7_price.push([week_min[8].price]);
    week_min_p_gasohol_95_price.push([week_min[9].price]); */
    //min month 
    const month_min = (<?php echo json_encode($month_min); ?>);
    month_min_p_die_b7_price.push([month_min[0].price]);
    month_min_die_price.push([month_min[1].price]);
    month_min_die_b20_price.push([month_min[2].price]);
    month_min_gasolin_95_price.push([month_min[3].price]);
    month_min_gasohol_95_price.push([month_min[4].price]);
    month_min_gasohol_91_price.push([month_min[5].price]);
    month_min_gasohol_e20_price.push([month_min[6].price]);
    month_min_gasohol_e85_price.push([month_min[7].price]);
    month_min_die_b7_price.push([month_min[8].price]);
    month_min_p_gasohol_95_price.push([month_min[9].price]);
    //min year
/*     const year_min = (<?php echo json_encode($year_min); ?>);
    year_min_p_die_b7_price.push([year_min[0].price]);
    year_min_die_price.push([year_min[1].price]);
    year_min_die_b20_price.push([year_min[2].price]);
    year_min_gasolin_95_price.push([year_min[3].price]);
    year_min_gasohol_95_price.push([year_min[4].price]);
    year_min_gasohol_91_price.push([year_min[5].price]);
    year_min_gasohol_e20_price.push([year_min[6].price]);
    year_min_gasohol_e85_price.push([year_min[7].price]);
    year_min_die_b7_price.push([year_min[8].price]);
    year_min_p_gasohol_95_price.push([year_min[9].price]); */

    //avg
/*     const week_avg = (<?php echo json_encode($week_avg); ?>);
    week_avg_p_die_b7_price.push([week_avg[0].price]);
    week_avg_die_price.push([week_avg[1].price]);
    week_avg_die_B20_price.push([week_avg[2].price]);
    week_avg_gasolin_95_price.push([week_avg[3].price]);
    week_avg_gasohol_95_price.push([week_avg[4].price]);
    week_avg_gasohol_91_price.push([week_avg[5].price]);
    week_avg_gasohol_e20_price.push([week_avg[6].price]);
    week_avg_gasohol_e85_price.push([week_avg[7].price]);
    week_avg_die_b7_price.push([week_avg[8].price]);
    week_avg_p_gasohol_95_price.push([week_avg[9].price]); */
    //avg month 
    const month_avg = (<?php echo json_encode($month_avg); ?>);
    month_avg_p_die_b7_price.push([month_avg[0].price]);
    month_avg_die_price.push([month_avg[1].price]);
    month_avg_die_b20_price.push([month_avg[2].price]);
    month_avg_gasolin_95_price.push([month_avg[3].price]);
    month_avg_gasohol_95_price.push([month_avg[4].price]);
    month_avg_gasohol_91_price.push([month_avg[5].price]);
    month_avg_gasohol_e20_price.push([month_avg[6].price]);
    month_avg_gasohol_e85_price.push([month_avg[7].price]);
    month_avg_die_b7_price.push([month_avg[8].price]);
    month_avg_p_gasohol_95_price.push([month_avg[9].price]);

    //avg year
/*     const year_avg = (<?php echo json_encode($year_avg); ?>);
    year_avg_p_die_b7_price.push([year_avg[0].price]);
    year_avg_die_price.push([year_avg[1].price]);
    year_avg_die_b20_price.push([year_avg[2].price]);
    year_avg_gasolin_95_price.push([year_avg[3].price]);
    year_avg_gasohol_95_price.push([year_avg[4].price]);
    year_avg_gasohol_91_price.push([year_avg[5].price]);
    year_avg_gasohol_e20_price.push([year_avg[6].price]);
    year_avg_gasohol_e85_price.push([year_avg[7].price]);
    year_avg_die_b7_price.push([year_avg[8].price]);
    year_avg_p_gasohol_95_price.push([year_avg[9].price]); */



    const date = [];
    const month = [];
    const year = [];

    const week_gas = (<?php echo json_encode($week_gas); ?>);
    const week_p_die_b7 = week_gas[0]
    const week_die = week_gas[1]
    const week_die_b20 = week_gas[2]
    const week_gasolin_95 = week_gas[3]
    const week_gasohol_95 = week_gas[4]
    const week_gasohol_91 = week_gas[5]
    const week_gasohol_e20 = week_gas[6]
    const week_gasohol_e85 = week_gas[7]
    const week_die_b7 = week_gas[8]
    const week_p_gasohol_95 = week_gas[9]


    /* console.log(Yesterday_P_Die_B7_price); */


     week_p_die_b7.forEach(element => {
        date.push(element.date);
        P_Die_B7_price.push({x: element.date, y: element.price})
    });
    
    week_die.forEach(element => {
        date.push(element.date);
        Die_price.push({x: element.date, y: element.price})
    });

    week_die_b20.forEach(element => {
        date.push(element.date);
        Die_B20_price.push({x: element.date, y: element.price})
    });
    week_gasolin_95.forEach(element => {
        date.push(element.date);
        Gasolin_95_price.push({x: element.date, y: element.price})
    });
    week_gasohol_95.forEach(element => {
        date.push(element.date);
        Gasohol_95_price.push({x: element.date, y: element.price})
    });
    week_gasohol_91.forEach(element => {
        date.push(element.date);
        Gasohol_91_price.push({x: element.date, y: element.price})
    });
    week_gasohol_e20.forEach(element => {
        date.push(element.date);
        Gasohol_E20_price.push({x: element.date, y: element.price})
    });
    week_gasohol_e85.forEach(element => {
        date.push(element.date);
        Gasohol_E85_price.push({x: element.date, y: element.price})
    });
    week_die_b7.forEach(element => {
        date.push(element.date);
        Die_B7_price.push({x: element.date, y: element.price})
    });
    week_p_gasohol_95.forEach(element => {
        date.push(element.date);
        P_Gasohol_95_price.push({x: element.date, y: element.price})
    });
    
    //month
    const month_gas = (<?php echo json_encode($month_gas); ?>);
    const month_p_die_b7 = month_gas[0]
    const month_die = month_gas[1]
    const month_die_b20 = month_gas[2]
    const month_gasolin_95 = month_gas[3]
    const month_gasohol_95 = month_gas[4]
    const month_gasohol_91 = month_gas[5]
    const month_gasohol_e20 = month_gas[6]
    const month_gasohol_e85 = month_gas[7]
    const month_die_b7 = month_gas[8]
    const month_p_gasohol_95 = month_gas[9]
    


    month_p_die_b7.forEach(element => {
        date.push(element.date);
        Month_P_Die_B7_price.push({x: element.date, y: element.price})
    });

    month_die.forEach(element => {
        date.push(element.date);
        Month_Die_price.push({x: element.date, y: element.price})
    });
    month_die_b20.forEach(element => {
        date.push(element.date);
        Month_Die_B20_price.push({x: element.date, y: element.price})
    });
    month_gasolin_95.forEach(element => {
        date.push(element.date);
        Month_Gasolin_95_price.push({x: element.date, y: element.price})
    });
    month_gasohol_95.forEach(element => {
        date.push(element.date);
        Month_Gasohol_95_price.push({x: element.date, y: element.price})
    });
    month_gasohol_91.forEach(element => {
        date.push(element.date);
        Month_Gasohol_91_price.push({x: element.date, y: element.price})
    });
    month_gasohol_e20.forEach(element => {
        date.push(element.date);
        Month_Gasohol_E20_price.push({x: element.date, y: element.price})
    });
    month_gasohol_e85.forEach(element => {
        date.push(element.date);
        Month_Gasohol_E85_price.push({x: element.date, y: element.price})
    });
    month_die_b7.forEach(element => {
        date.push(element.date);
        Month_Die_B7_price.push({x: element.date, y: element.price})
    });
    month_p_gasohol_95.forEach(element => {
        date.push(element.date);
        Month_P_Gasohol_95_price.push({x: element.date, y: element.price})
    }); 

    
    //Year
    // const year_gas = (<?php echo json_encode($year_gas); ?>);
    // const year_p_die_b7 = year_gas[0]
    // const year_die = year_gas[1]
    // const year_die_b20 = year_gas[2]
    // const year_gasolin_95 = year_gas[3]
    // const year_gasohol_95 = year_gas[4]
    // const year_gasohol_91 = year_gas[5]
    // const year_gasohol_e20 = year_gas[6]
    // const year_gasohol_e85 = year_gas[7]
    // const year_die_b7 = year_gas[8]
    // const year_p_gasohol_95 = year_gas[9]
    // year_p_die_b7.forEach(element => {
    //     date.push(element.date);
    //     Year_P_Die_B7_price.push({x: element.date, y:element.price })
    // });
    // year_die.forEach(element => {
    //     date.push(element.date);
    //     Year_Die_price.push({x: element.date, y: element.price})
    // });
    // year_die_b20.forEach(element => {
    //     date.push(element.date);
    //     Year_Die_B20_price.push({x: element.date, y: element.price})
    // });
    // year_gasolin_95.forEach(element => {
    //     date.push(element.date);
    //     Year_Gasolin_95_price.push({x: element.date, y: element.price})
    // });
    // year_gasohol_95.forEach(element => {
    //     date.push(element.date);
    //     Year_Gasohol_95_price.push({x: element.date, y: element.price})
    // });
    // year_gasohol_91.forEach(element => {
    //     date.push(element.date);
    //     Year_Gasohol_91_price.push({x: element.date, y: element.price})
    // });
    // year_gasohol_e20.forEach(element => {
    //     date.push(element.date);
    //     Year_Gasohol_E20_price.push({x: element.date, y: element.price})
    // });
    // year_gasohol_e85.forEach(element => {
    //     date.push(element.date);
    //     Year_Gasohol_E85_price.push({x: element.date, y: element.price})
    // });
    // year_die_b7.forEach(element => {
    //     date.push(element.date);
    //     Year_Die_B7_price.push({x: element.date, y: element.price})
    // });
    // year_p_gasohol_95.forEach(element => {
    //     date.push(element.date);
    //     Year_P_Gasohol_95_price.push({x: element.date, y: element.price})
    // }); 

    const month_filter = (<?php echo json_encode($month_filter); ?>);
    const MF_P_Die_B7_price = month_filter[0];
    const MF_Die_price = month_filter[1];
    const MF_Die_B20_price = month_filter[2];
    const MF_Gasolin_95_price = month_filter[3];
    const MF_Gasohol_95_price = month_filter[4];
    const MF_Gasohol_91_price = month_filter[5];
    const MF_Gasohol_E20_price = month_filter[6];
    const MF_Gasohol_E85_price = month_filter[7];
    const MF_Die_B7_price = month_filter[8];
    const MF_P_Gasohol_95_price = month_filter[9];

    const Filter_P_Die_B7_price = [];
    const Filter_Die_price = [];
    const Filter_Die_B20_price = [];
    const Filter_Gasolin_95_price = [];
    const Filter_Gasohol_95_price = [];
    const Filter_Gasohol_91_price = [];
    const Filter_Gasohol_E20_price = [];
    const Filter_Gasohol_E85_price = [];
    const Filter_Die_B7_price = [];
    const Filter_P_Gasohol_95_price = [];

    MF_P_Die_B7_price.forEach(element => {
      month.push(element.month);
      Filter_P_Die_B7_price.push({x: element.month, y: element.avg})
    });
    MF_Die_price.forEach(element => {
      month.push(element.month);
      Filter_Die_price.push({x: element.month, y: element.avg})
    });
    MF_Die_B20_price.forEach(element => {
      month.push(element.month);
      Filter_Die_B20_price.push({x: element.month, y: element.avg})
    });
    MF_Gasolin_95_price.forEach(element => {
      month.push(element.month);
      Filter_Gasolin_95_price.push({x: element.month, y: element.avg})
    });
    MF_Gasohol_95_price.forEach(element => {
      month.push(element.month);
      Filter_Gasohol_95_price.push({x: element.month, y: element.avg})
    });
    MF_Gasohol_91_price.forEach(element => {
      month.push(element.month);
      Filter_Gasohol_91_price.push({x: element.month, y: element.avg})
    });
    MF_Gasohol_E20_price.forEach(element => {
      month.push(element.month);
      Filter_Gasohol_E20_price.push({x: element.month, y: element.avg})
    });
    MF_Gasohol_E85_price.forEach(element => {
      month.push(element.month);
      Filter_Gasohol_E85_price.push({x: element.month, y: element.avg})
    });
    MF_Die_B7_price.forEach(element => {
      month.push(element.month);
      Filter_Die_B7_price.push({x: element.month, y: element.avg})
    });
    MF_P_Gasohol_95_price.forEach(element => {
      month.push(element.month);
      Filter_P_Gasohol_95_price.push({x: element.month, y: element.avg})
    }); 



    const T_P_Die_B7_price = week_gas[0];
    const T_Die_price = week_gas[1];
    const T_Die_B20_price = week_gas[2];
    const T_Gasolin_95_price = week_gas[3];
    const T_Gasohol_95_price = week_gas[4];
    const T_Gasohol_91_price = week_gas[5];
    const T_Gasohol_E20_price = week_gas[6];
    const T_Gasohol_E85_price = week_gas[7];
    const T_Die_B7_price = week_gas[8];
    const T_P_Gasohol_95_price = week_gas[9];

                //yesterday;
    const Performance_P_Die_B7_price = [];
    const Performance_Die_price = [];
    const Performance_Die_B20_price = [];
    const Performance_Gasolin_95_price = [];
    const Performance_Gasohol_95_price = [];
    const Performance_Gasohol_91_price = [];
    const Performance_Gasohol_E20_price = [];
    const Performance_Gasohol_E85_price = [];
    const Performance_Die_B7_price = [];
    const Performance_P_Gasohol_95_price = [];


        Performance_P_Die_B7_price.push([week_p_die_b7[week_p_die_b7.length -1].price]-[week_p_die_b7[week_p_die_b7.length -2].price]);
        Performance_Die_price.push([week_die[week_die.length -1].price]-[week_die[week_die.length -2].price]);
        Performance_Die_B20_price.push([week_die_b20[week_die_b20.length -1].price]-[week_die_b20[week_die_b20.length -2].price]);
        Performance_Gasolin_95_price.push([week_gasolin_95[week_gasolin_95.length -1].price]-[week_gasolin_95[week_gasolin_95.length -2].price]);
        Performance_Gasohol_95_price.push([week_gasohol_95[week_gasohol_95.length -1].price]-[week_gasohol_95[week_gasohol_95.length -2].price]);
        Performance_Gasohol_91_price.push([week_gasohol_91[week_gasohol_91.length -1].price]-[week_gasohol_91[week_gasohol_91.length -2].price]);
        Performance_Gasohol_E20_price.push([week_gasohol_e20[week_gasohol_e20.length -1].price]-[week_gasohol_e20[week_gasohol_e20.length -2].price]);
        Performance_Gasohol_E85_price.push([week_gasohol_e85[week_gasohol_e85.length -1].price]-[week_gasohol_e85[week_gasohol_e85.length -2].price]);
        Performance_Die_B7_price.push([week_die_b7[week_die_b7.length -1].price]-[week_die_b7[week_die_b7.length -2].price]);
        Performance_P_Gasohol_95_price.push([week_p_gasohol_95[week_p_gasohol_95.length -1].price]-[week_p_gasohol_95[week_p_gasohol_95.length -2].price]);

        const Per_P_Die_B7_price = parseFloat(Performance_P_Die_B7_price).toFixed(2);
        const Per_Die_price = parseFloat(Performance_Die_price).toFixed(2);
        const Per_Die_B20_price = parseFloat(Performance_Die_B20_price).toFixed(2);
        const Per_Gasolin_95_price = parseFloat(Performance_Gasolin_95_price).toFixed(2);
        const Per_Gasohol_95_price = parseFloat(Performance_Gasohol_95_price).toFixed(2);
        const Per_Gasohol_91_price = parseFloat(Performance_Gasohol_91_price).toFixed(2);
        const Per_Gasohol_E20_price = parseFloat(Performance_Gasohol_E20_price).toFixed(2);
        const Per_Gasohol_E85_price = parseFloat(Performance_Gasohol_E85_price).toFixed(2);
        const Per_Die_B7_price = parseFloat(Performance_Die_B7_price).toFixed(2);
        const Per_P_Gasohol_95_price = parseFloat(Performance_P_Gasohol_95_price).toFixed(2);

        
        $( document ).ready(function() {
          if (Per_P_Die_B7_price < 0) {
          $("#Per_P_Die_B7_price").addClass("low");
          $("#Per_P_Die_B7_price").text("ลด" + Per_P_Die_B7_price);
        } else if (Per_P_Die_B7_price > 0) {
          $("#Per_P_Die_B7_price").addClass("high");
          $("#Per_P_Die_B7_price").text("เพิ่ม" + Per_P_Die_B7_price);
        }else {
          $("#Per_P_Die_B7_price").text("-");
        }

        if (Per_Die_price < 0) {
          $("#Per_Die_pricev").addClass("low");
          $("#Per_Die_price").text("ลด" + Per_Die_price);
        } else if (Per_Die_price > 0) {
          $("#Per_Die_price").addClass("high");
          $("#Per_Die_price").text("เพิ่ม" + Per_Die_price);
        }else {
          $("#Per_Die_price").text("-");
        }

        if (Per_Die_B20_price < 0) {
          $("#Per_Die_B20_price").addClass("low");
          $("#Per_Die_B20_price").text("ลด" + Per_Die_B20_price);
        } else if (Per_Die_B20_price > 0) {
          $("#Per_Die_B20_price").addClass("high");
          $("#Per_Die_B20_price").text("เพิ่ม" + Per_Die_B20_price);
        }else {
          $("#Per_Die_B20_price").text("-");
        }

        if (Per_Gasolin_95_price < 0) {
          $("#Per_Gasolin_95_price").addClass("low");
          $("#Per_Gasolin_95_price").text("ลด" + Per_Gasolin_95_price);
        } else if (Per_Gasolin_95_price > 0) {
          $("#Per_Gasolin_95_price").addClass("high");
          $("#Per_Gasolin_95_price").text("เพิ่ม" + Per_Gasolin_95_price);
        }else {
          $("#Per_Gasolin_95_price").text("-");
        }

        if (Per_Gasohol_95_price < 0) {
          $("#Per_Gasohol_95_price").addClass("low");
          $("#Per_Gasohol_95_price").text("ลด" + Per_Gasohol_95_price);
        } else if (Per_Gasohol_95_price > 0) {
          $("#Per_Gasohol_95_price").addClass("high");
          $("#Per_Gasohol_95_price").text("เพิ่ม" + Per_Gasohol_95_price);
        }else {
          $("#Per_Gasohol_95_price").text("-");
        }

        if (Per_Gasohol_91_price < 0) {
          $("#Per_Gasohol_91_price").addClass("low");
          $("#Per_Gasohol_91_price").text("ลด" + Per_Gasohol_91_price);
        } else if (Per_Gasohol_91_price > 0) {
          $("#Per_Gasohol_91_price").addClass("high");
          $("#Per_Gasohol_91_price").text("เพิ่ม" + Per_Gasohol_91_price);
        }else {
          $("#Per_Gasohol_91_price").text("-");
        }

        if (Per_Gasohol_E20_price < 0) {
          $("#Per_Gasohol_E20_price").addClass("low");
          $("#Per_Gasohol_E20_price").text("ลด" + Per_Gasohol_E20_price);
        } else if (Per_Gasohol_E20_price > 0) {
          $("#Per_Gasohol_E20_price").addClass("high");
          $("#Per_Gasohol_E20_price").text("เพิ่ม" + Per_Gasohol_E20_price);
        }else {
          $("#Per_Gasohol_E20_price").text("-");
        }

        if (Per_Gasohol_E85_price < 0) {
          $("#Per_Gasohol_E85_price").addClass("low");
          $("#Per_Gasohol_E85_price").text("ลด" + Per_Gasohol_E85_price);
        } else if (Per_Gasohol_E85_price > 0) {
          $("#Per_Gasohol_E85_price").addClass("high");
          $("#Per_Gasohol_E85_price").text("เพิ่ม" + Per_Gasohol_E85_price);
        }else {
          $("#Per_Gasohol_E85_price").text("-");
        }

        if (Per_Die_B7_price < 0) {
          $("#Per_Die_B7_price").addClass("low");
          $("#Per_Die_B7_price").text("ลด" + Per_Die_B7_price);
        } else if (Per_Die_B7_price > 0) {
          $("#Per_Die_B7_price").addClass("high");
          $("#Per_Die_B7_price").text("เพิ่ม" + Per_Die_B7_price);
        }else {
          $("#Per_Die_B7_price").text("-");
        }

        if (Per_P_Gasohol_95_price < 0) {
          $("#Per_P_Gasohol_95_price").addClass("low");
          $("#Per_P_Gasohol_95_price").text("ลด" + Per_P_Gasohol_95_price);
        } else if (Per_P_Gasohol_95_price > 0) {
          $("#Per_P_Gasohol_95_price").addClass("high");
          $("#Per_P_Gasohol_95_price").text("เพิ่ม" + Per_P_Gasohol_95_price);
        } else {
          $("#Per_P_Gasohol_95_price").text("-");
        }
    });

        

 /*        console.log(Per_P_Die_B7_price); */


        //performance
    // const Per_P_Die_B7_price = T_P_Die_B7_price - Yesterday_P_Die_B7_price;
    // const Per_Die_price = T_Die_price - Yesterday_Die_price;
    // const Per_Die_B20_price = T_Die_B20_price - Yesterday_Die_B20_price;
    // const Per_Gasolin_95_price = T_Gasolin_95_price - Yesterday_Gasolin_95_price;
    // const Per_Gasohol_95_price = T_Gasohol_95_price - Yesterday_Gasohol_95_price;
    // const Per_Gasohol_91_price = T_Gasohol_91_price - Yesterday_Gasohol_91_price;
    // const Per_Gasohol_E20_price = T_Gasohol_E20_price - Yesterday_Gasohol_E20_price;
    // const Per_Gasohol_E85_price = T_Gasohol_E85_price - Yesterday_Gasohol_E85_price;
    // const Per_Die_B7_price = T_Die_B7_price - Yesterday_Die_B7_price;
    // const Per_P_Gasohol_95_price = T_P_Gasohol_95_price - Yesterday_P_Gasohol_95_price; 
    

    $("#T_P_Die_B7").text(T_P_Die_B7_price[T_P_Die_B7_price.length -1].price);
    $("#T_Die").text(T_Die_price[T_Die_price.length -1].price);
    $("#T_Die_B20").text(T_Die_B20_price[T_Die_B20_price.length -1].price);
    $("#T_Gasolin_95").text(T_Gasolin_95_price[T_Gasolin_95_price.length -1].price);
    $("#T_Gasohol_95").text(T_Gasohol_95_price[T_Gasohol_95_price.length -1].price);
    $("#T_Gasohol_91").text(T_Gasohol_91_price[T_Gasohol_91_price.length -1].price);
    $("#T_Gasohol_E20").text(T_Gasohol_E20_price[T_Gasohol_E20_price.length -1].price);
    $("#T_Gasohol_E85").text(T_Gasohol_E85_price[T_Gasohol_E85_price.length -1].price);
    $("#T_Die_B7").text(T_Die_B7_price[T_Die_B7_price.length -1].price);
    $("#T_P_Gasohol_95").text(T_P_Gasohol_95_price[T_P_Gasohol_95_price.length -1].price);

    const Today = T_P_Die_B7_price[T_P_Die_B7_price.length -1].date;
    const strDate = new Date(Today).toLocaleDateString('en-GB');
    $("#Today").text(strDate);

    $( document ).ready(function() {
                $("#datetype").text("30 วัน");
                $("#datatype").text("ราคาสูงสุดใน");
                MonthGas()

/*              $("#btn_min").removeClass("active");
                $("#btn_avg").removeClass("active");
                $("#btn_max").addClass("active"); */
                month_max_data()
                month_min_data()
                month_avg_data()
    });
    

    $("#btn_min").click(function() {
                $("#btn_min").addClass("active");
                $("#btn_avg").removeClass("active");
                $("#btn_max").removeClass("active");
                $("#datatype").text("ราคาต่ำสุดใน");
                  month_min_data()
    })
    $("#btn_avg").click(function() {
                $("#btn_min").removeClass("active");
                $("#btn_avg").addClass("active");
                $("#btn_max").removeClass("active");
                $("#datatype").text("ราคาเฉลี่ยใน");
                  month_avg_data()
    })
    $("#btn_max").click(function() {
                $("#btn_min").removeClass("active");
                $("#btn_avg").removeClass("active");
                $("#btn_max").addClass("active");
                $("#datatype").text("ราคาสูงสุดใน");
                  month_max_data()
    })

   /*   function week_min_data() {
        $("#P_Die_B7").text(week_min_p_die_b7_price);
        $("#Die").text(week_min_die_price);
        $("#Die_B20").text(week_min_die_B20_price);
        $("#Gasolin_95").text(week_min_gasolin_95_price);
        $("#Gasohol_95").text(week_min_gasohol_95_price);
        $("#Gasohol_91").text(week_min_gasohol_91_price);
        $("#Gasohol_E20").text(week_min_gasohol_e20_price);
        $("#Gasohol_E85").text(week_min_gasohol_e85_price);
        $("#Die_B7").text(week_min_die_b7_price);
        $("#P_Gasohol_95").text(week_min_p_gasohol_95_price);
     }
     function week_avg_data() {
        $("#P_Die_B7").text(week_avg_p_die_b7_price);
        $("#Die").text(week_avg_die_price);
        $("#Die_B20").text(week_avg_die_B20_price);
        $("#Gasolin_95").text(week_avg_gasolin_95_price);
        $("#Gasohol_95").text(week_avg_gasohol_95_price);
        $("#Gasohol_91").text(week_avg_gasohol_91_price);
        $("#Gasohol_E20").text(week_avg_gasohol_e20_price);
        $("#Gasohol_E85").text(week_avg_gasohol_e85_price);
        $("#Die_B7").text(week_avg_die_b7_price);
        $("#P_Gasohol_95").text(week_avg_p_gasohol_95_price);
     }
     function week_max_data() {
        $("#P_Die_B7").text(M_P_Die_B7_price);
        $("#Die").text(M_Die_price);
        $("#Die_B20").text(M_Die_B20_price);
        $("#Gasolin_95").text(M_Gasolin_95_price);
        $("#Gasohol_95").text(M_Gasohol_95_price);
        $("#Gasohol_91").text(M_Gasohol_91_price);
        $("#Gasohol_E20").text(M_Gasohol_E20_price);
        $("#Gasohol_E85").text(M_Gasohol_E85_price);
        $("#Die_B7").text(M_Die_B7_price);
        $("#P_Gasohol_95").text(M_P_Gasohol_95_price);
     } */

     function month_min_data() {
        $("#min_P_Die_B7").text(month_min_p_die_b7_price);
        $("#min_Die").text(month_min_die_price);
        $("#min_Die_B20").text(month_min_die_b20_price);
        $("#min_Gasolin_95").text(month_min_gasolin_95_price);
        $("#min_Gasohol_95").text(month_min_gasohol_95_price);
        $("#min_Gasohol_91").text(month_min_gasohol_91_price);
        $("#min_Gasohol_E20").text(month_min_gasohol_e20_price);
        $("#min_Gasohol_E85").text(month_min_gasohol_e85_price);
        $("#min_Die_B7").text(month_min_die_b7_price);
        $("#min_P_Gasohol_95").text(month_min_p_gasohol_95_price);
     }
     
     function month_avg_data() {
        $("#avg_P_Die_B7").text(month_avg_p_die_b7_price);
        $("#avg_Die").text(month_avg_die_price);
        $("#avg_Die_B20").text(month_avg_die_b20_price);
        $("#avg_Gasolin_95").text(month_avg_gasolin_95_price);
        $("#avg_Gasohol_95").text(month_avg_gasohol_95_price);
        $("#avg_Gasohol_91").text(month_avg_gasohol_91_price);
        $("#avg_Gasohol_E20").text(month_avg_gasohol_e20_price);
        $("#avg_Gasohol_E85").text(month_avg_gasohol_e85_price);
        $("#avg_Die_B7").text(month_avg_die_b7_price);
        $("#avg_P_Gasohol_95").text(month_avg_p_gasohol_95_price);
     }
     function month_max_data() {
        $("#max_P_Die_B7").text(MM_P_Die_B7_price);
        $("#max_Die").text(MM_Die_price);
        $("#max_Die_B20").text(MM_Die_B20_price);
        $("#max_Gasolin_95").text(MM_Gasolin_95_price);
        $("#max_Gasohol_95").text(MM_Gasohol_95_price);
        $("#max_Gasohol_91").text(MM_Gasohol_91_price);
        $("#max_Gasohol_E20").text(MM_Gasohol_E20_price);
        $("#max_Gasohol_E85").text(MM_Gasohol_E85_price);
        $("#max_Die_B7").text(MM_Die_B7_price);
        $("#max_P_Gasohol_95").text(MM_P_Gasohol_95_price);
     }

  /*    function year_min_data() {
        $("#P_Die_B7").text(year_min_p_die_b7_price);
        $("#Die").text(year_min_die_price);
        $("#Die_B20").text(year_min_die_b20_price);
        $("#Gasolin_95").text(year_min_gasolin_95_price);
        $("#Gasohol_95").text(year_min_gasohol_95_price);
        $("#Gasohol_91").text(year_min_gasohol_91_price);
        $("#Gasohol_E20").text(year_min_gasohol_e20_price);
        $("#Gasohol_E85").text(year_min_gasohol_e85_price);
        $("#Die_B7").text(year_min_die_b7_price);
        $("#P_Gasohol_95").text(year_min_p_gasohol_95_price);
     }
     function year_avg_data() {
        $("#P_Die_B7").text(year_avg_p_die_b7_price);
        $("#Die").text(year_avg_die_price);
        $("#Die_B20").text(year_avg_die_b20_price);
        $("#Gasolin_95").text(year_avg_gasolin_95_price);
        $("#Gasohol_95").text(year_avg_gasohol_95_price);
        $("#Gasohol_91").text(year_avg_gasohol_91_price);
        $("#Gasohol_E20").text(year_avg_gasohol_e20_price);
        $("#Gasohol_E85").text(year_avg_gasohol_e85_price);
        $("#Die_B7").text(year_avg_die_b7_price);
        $("#P_Gasohol_95").text(year_avg_p_gasohol_95_price);
     }
     function year_max_data() {        
        $("#P_Die_B7").text(MY_P_Die_B7_price);
        $("#Die").text(MY_Die_price);
        $("#Die_B20").text(MY_Die_B20_price);
        $("#Gasolin_95").text(MY_Gasolin_95_price);
        $("#Gasohol_95").text(MY_Gasohol_95_price);
        $("#Gasohol_91").text(MY_Gasohol_91_price);
        $("#Gasohol_E20").text(MY_Gasohol_E20_price);
        $("#Gasohol_E85").text(MY_Gasohol_E85_price);
        $("#Die_B7").text(MY_Die_B7_price);
        $("#P_Gasohol_95").text(MY_P_Gasohol_95_price);
      } */

/*       function WeekGas() {
        const week = {
        datasets: [
        {
          label: 'Premium Diesel B7',
          data: P_Die_B7_price,
        //   data: [date,P_Die_B7_price],
          backgroundColor: '#c0bec1',
          borderColor: '#c0bec1',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Diesel',
          data: Die_price,
          backgroundColor: '#1f3684',
          borderColor: '#1f3684',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Diesel B20',
          data: Die_B20_price,
          backgroundColor: '#c4171d',
          borderColor: '#c4171d',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Bensin',
          data: Gasolin_95_price,
          backgroundColor: '#ffd601',
          borderColor: '#ffd601',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol 95',
          data: Gasohol_95_price,
          backgroundColor: '#eb6609',
          borderColor: '#eb6609',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol 91',
          data: Gasohol_91_price,
          backgroundColor: '#10a64f',
          borderColor: '#10a64f',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol E20',
          data: Gasohol_E20_price,
          backgroundColor: '#aec90c',
          borderColor: '#aec90c',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol E85',
          data: Gasohol_E85_price,
          backgroundColor: '#b01280',
          borderColor: '#b01280',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Diesel B7',
          data: Die_B7_price,
          backgroundColor: '#0168b3',
          borderColor: '#0168b3',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Premium Gasohol 95',
          data: P_Gasohol_95_price,
          backgroundColor: '#d4a86a',
          borderColor: '#d4a86a',
          fill: false,
          tension: 0.1
        },
        ]
        };

        const day = {
        type: 'line',
        data: week,
        options: {
        },
        };

        chart = new Chart(
        document.getElementById('myChart'),
        day
        );
    } */

      function MonthGas() {

        const month = {
        datasets: [
        {
          label: 'Premium Diesel B7',
          data: Month_P_Die_B7_price,
        //   data: [date,P_Die_B7_price],
          backgroundColor: '#c0bec1',
          borderColor: '#c0bec1',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Diesel',
          data: Month_Die_price,
          backgroundColor: '#1f3684',
          borderColor: '#1f3684',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Diesel B20',
          data: Month_Die_B20_price,
          backgroundColor: '#c4171d',
          borderColor: '#c4171d',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Bensin',
          data: Month_Gasolin_95_price,
          backgroundColor: '#ffd601',
          borderColor: '#ffd601',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol 95',
          data: Month_Gasohol_95_price,
          backgroundColor: '#eb6609',
          borderColor: '#eb6609',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol 91',
          data: Month_Gasohol_91_price,
          backgroundColor: '#10a64f',
          borderColor: '#10a64f',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol E20',
          data: Month_Gasohol_E20_price,
          backgroundColor: '#aec90c',
          borderColor: '#aec90c',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol E85',
          data: Month_Gasohol_E85_price,
          backgroundColor: '#b01280',
          borderColor: '#b01280',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Diesel B7',
          data: Month_Die_B7_price,
          backgroundColor: '#0168b3',
          borderColor: '#0168b3',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Premium Gasohol 95',
          data: Month_P_Gasohol_95_price,
          backgroundColor: '#d4a86a',
          borderColor: '#d4a86a',
          fill: false,
          tension: 0.1
        },
        ]
        };


        // console.log(month);

        const day = {
        type: 'line',
        data: month,
        options: {
        },
        };
        
        chart = new Chart(
        document.getElementById('myChart'),
        day
        );
    }
/*     function YearGas() {
        const year = {
        datasets: [
        {
          label: 'Premium Diesel B7',
          data: Year_P_Die_B7_price,
        //   data: [date,P_Die_B7_price],
          backgroundColor: '#c0bec1',
          borderColor: '#c0bec1',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Diesel',
          data: Year_Die_price,
          backgroundColor: '#1f3684',
          borderColor: '#1f3684',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Diesel B20',
          data: Year_Die_B20_price,
          backgroundColor: '#c4171d',
          borderColor: '#c4171d',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Bensin',
          data: Year_Gasolin_95_price,
          backgroundColor: '#ffd601',
          borderColor: '#ffd601',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol 95',
          data: Year_Gasohol_95_price,
          backgroundColor: '#eb6609',
          borderColor: '#eb6609',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol 91',
          data: Year_Gasohol_91_price,
          backgroundColor: '#10a64f',
          borderColor: '#10a64f',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol E20',
          data: Year_Gasohol_E20_price,
          backgroundColor: '#aec90c',
          borderColor: '#aec90c',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Gasohol E85',
          data: Year_Gasohol_E85_price,
          backgroundColor: '#b01280',
          borderColor: '#b01280',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Diesel B7',
          data: Year_Die_B7_price,
          backgroundColor: '#0168b3',
          borderColor: '#0168b3',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Premium Gasohol 95',
          data: Year_P_Gasohol_95_price,
          backgroundColor: '#d4a86a',
          borderColor: '#d4a86a',
          fill: false,
          tension: 0.1
        },
        ]
        };

        const day = {
        type: 'line',
        data: year,
        options: {
        },
        };

        chart = new Chart(
        document.getElementById('myChart'),
        day
        );
    } */

</script> -->
</body>



</html>