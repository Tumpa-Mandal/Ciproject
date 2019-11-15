<h2>Update Book</h2>
<hr/>
<?php
$msg = $this->session->flashdata('msg');
if(isset($msg)){
    echo $msg;
}
?>

<div class="panel-body" style="width:600px;">
    <form action="<?php echo base_url();?>book/updateBookForm" method="post">
        <input type="hidden" name="bookid" value="<?php echo $bookById->bookid; ?>">
        <div class="form-group">
            <label>Book Name</label>
            <input type="text" name="bookname" value="<?php echo $bookById->bookname; ?>" class="form-control span12">
        </div>
        <div class="form-group">
            <label>Department</label>
            <select name="dep" class="form-control">
                <option value="">Select One</option>
                <?php
                foreach ($departmentdata as $ddata){
                    if($bookById->dep==$ddata->depid){?>
                        <option value="<?php echo $ddata->depid; ?>" selected="selected"><?php echo $ddata->depname; ?></option>

                    <?php }
                    ?>
                    <option value="<?php echo $ddata->depid; ?>"><?php echo $ddata->depname; ?></option>
                <?php }?>
            </select>
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author"value="<?php echo $bookById->author; ?>" class="form-control span12">
        </div>
        <div class="form-group">
            <label>Total Book</label>
            <input type="text" name="total"value="<?php echo $bookById->total; ?>" class="form-control span12">
        </div>
        <div class="form-group">
            <input type="submit"class="btn btn-primary" value="Submit">
        </div>

    </form>
</div>
