<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,'https://api.rajaongkir.com/starter/province?key=43d275bff97a267a81705eae89820ab4');
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl);
curl_close($curl);

$result = json_decode($result,true);
$data= $result['rajaongkir']['results'];

echo($result['rajaongkir']['results'][0]['province']);
?>


<html>
<title>Data Provinsi</title>
<body>
    <table border='1'>

    <tr>
    <th>id</th>
    <td>Nama Provinsi</td>
    </tr>

   
    <?php  foreach ($data as $provinsi):?>
    <tr>
    <td><?= $provinsi['province_id'];?></td>
    <td><?= $provinsi['province'];?></td>
    </tr>
    <?php endforeach  ?>

    </table>
</body>
</html>