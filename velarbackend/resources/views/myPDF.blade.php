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
		  border-collapse: collapse;
      }

      td, th {
          text-align: left;
          padding: 10px;
      }
	  tr td, tr th{
		  border-bottom: 1px solid rgb(186, 187, 189); 
	  }
      tr:nth-child(even) {
		border-bottom: 1px solid #0e2433;
		/* background-color: rgb(186, 187, 189); */
      }
      th{
		color: #222;
		font-weight: bold;
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
          Date of issue <br>
          06/03/2010
        </td>
        
        <td>
          Invoice no <br>
          {{ $id }}
        </td>
        <td>
			Due Date <br>
			09/12/2020
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
        <th>Price(&#8358;)</th>
      </tr>
      <tr>
        <th >{{ $kva }} KVA complete solar solution</th>
        <td>Inverter + battery accesories + solar panel + solar charge controller</td>
        <td>{{ $panelcount}}</td>
        <td>{{ $totalpricewithsolar }}</td>
      </tr>
      <tr>
        <th>{{ $kva }} KVA backup power solution</th>
        <td> Inverter + battery + accesories only</td>
        <td>{{ $batterycount }}</td>
        <td>{{ $totalpricewithoutsolar }}</td>
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
        <td></td>
      </tr>
      <tr>
        <th>Solar Charge controller</th>
        <td>{{ $solaramp }}amp maximum powerpoint tracking controller</td>
        <td></td>
        <td></td>
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
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th>Total Price</th>
        <td> </td>
        <td></td>
        <td style="font-weight:bold">{{ $totalpricewithsolar }} <br> or <br> {{$totalpricewithoutsolar}}
        </td></td>
      </tr>
    </table>
  </div>
</body>
</html>