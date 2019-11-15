<h2>Department List</h2>
<hr/>
<?php
$msg = $this->session->flashdata('msg');
if(isset($msg)){
    echo $msg;
}
?>
<table class="table">
    <thead>
    <tr>
        <th>No.</th>
        <th>Name</th>
        <th style="width: 3.5em;">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    foreach ($depdata as $ddata){
        $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $ddata->depname; ?></td>
           <td>
                <a href="<?php echo base_url();?>department/editdepartment/<?php echo $ddata->depid; ?>"><i class="fa fa-pencil"></i></a>
                <a onclick="return confirm('Are you sure to remove?')" href="<?php echo base_url();?>department/deldepartment/<?php echo $ddata->depid; ?>" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

