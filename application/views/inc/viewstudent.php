<h2>Student Details</h2>
<hr/>

<div class="panel-body" style="width:600px;">

        <div class="form-group">
            <label>Student Name</label>
            <input type="text" value="<?php echo $studentdata->name; ?>" readonly class="form-control span12">
        </div>
        <div class="form-group">
            <label>Department</label>
            <?php
                 $sdepid= $studentdata->dep;
                 $getdep = $this->dep_model->getDepartment($sdepid);
                if(isset($getdep)){?>
                    <input type="text" value="<?php echo $getdep->depname; ?>" readonly class="form-control span12">

                <?php } ?>


        </div>
        <div class="form-group">
            <label>Roll No.</label>
            <input type="text" value="<?php echo $studentdata->roll; ?>" readonly class="form-control span12">

        </div>
        <div class="form-group">
            <label>Reg. No.</label>
            <input type="text" value="<?php echo $studentdata->reg; ?>" readonly class="form-control span12">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" value="<?php echo $studentdata->phone; ?>" readonly class="form-control span12">
        </div>

</div>

