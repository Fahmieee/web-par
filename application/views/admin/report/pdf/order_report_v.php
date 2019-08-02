 <table  style="border-collapse: collapse;" border="1" width="100%">   
  <tr>
    <th>No</th> 
    <th>No Police</th>
    <th>Nama Unit</th>
    <th>Model </th>  
    <th>Varian </th>  
    <th>Tahun</th>    
  </tr>
  <?php foreach($datas as $key=>$row){?>
    <tr>
      <td><?php echo $key+1;?></td> 
      <td><?php echo $row->no_police;?></td>
      <td><?php echo $row->unit_merk;?></td>
      <td><?php echo $row->model;?> </td>  
      <td><?php echo $row->varian;?> </td>  
      <td><?php echo $row->years;?></td>    
    </tr>
  <?php }?>
   
</table> 