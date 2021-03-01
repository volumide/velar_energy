<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
      div{
        width: 100%;
      }
      table {
          font-family: arial, sans-serif;
          width: 100%;
          margin-top: 50px;
      }

      td, th {
          text-align: left;
          padding: 10px;
          
      }

      tr:nth-child(even) {
        background-color: #rgb(67, 159, 251);;
      }
      th{
        color: dodgerblue;
        border: 1px solid rgb(67, 159, 251);
      }
    </style>
</head>
<body>
  <div>
    <table>
      <tr>
        <td role="row" style="text-align:left;"> 
          <img src="/img/velar-mdeium.png" width="70px" height="50px" alt="" srcset="">
        </td>
        <td style="text-align:right;">
            Acme Street, <br>
            no 23,<br>
            Oke Aro
        </td>
      </tr>
    </table>
  </div>

  <div> 
    <table>
      <tr>
        <td>
          Billed to <br>
          Ajayi leyor <br>
          09039492939, <br>
          no 5 alero street
        </td>
        
        <td>
          Date of issue
          06/03/2010
          <br>
        Due Date 
          09/12/2020
        </td>
        
        <td>
          Invoice no <br>
          12234
        </td>
        <td>
          <p  class="heading">Amount due</p> 
          5500 or 3000
        </td>
      </tr>
    </table>
  </div>

  <div>
    <table>
      <tr>
        <th>Item</th>
        <th>Description</th>
        <th>Qty</th>
        <th>Price</th>
      </tr>
      <tr>
        <th >{{ $kva }} KVA complete solar solution</th>
        <td>Inverter + battery accesories + solar panel + solar charge controller</td>
        <td>Germany</td>
        <td>Germany</td>
      </tr>
      <tr>
        <th>{{ $kva }} KVA backup power solution</th>
        <td> Inverter + battery + accesories only</td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th>Inverter</th>
        <td>{{ $kva }}kva pure sign wave inverter</td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th>Bttery</th> 
        <td>{{ $batteryamp }} Ah maintanace free deep cycle gel batttery</td>
        <td>{{ $batterycount }}</td>
        <td></td>
      </tr>
      <tr>
        <th>Solar Pannels</th>
        <td>{{ $solaramp }}watts, monocrystalline solar panels</td>
        <td>{{ $panelcount }}</td>
        <td>Canada</td>
      </tr>
      <tr>
        <th>Solar Charge controller</th>
        <td>{{ $solaramp }}amp maximum powerpoint tracking controller</td>
        <td>Italy</td>
        <td>Italy</td>
      </tr>
      <tr>
        <th>Accessories and fitting</th>
        <td>Batttery pack, change over  box , bales adaptor circuit breakers, earthing instrument</td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th>Installation Service</th>
        <td>Power audit design, procuremnt and installation</td>
        <td>Italy</td>
        <td>Italy</td>
      </tr>
      <tr>
        <th>Total Price</th>
        <td> </td>
        <td></td>
        <td>{{ $totalpricewithsolar }} <br> {{ $totalpricewithsolar }}</td>
      </tr>
    </table>
  </div>
</body>
</html>