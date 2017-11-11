
<?php if ($this->session->userdata('logged_in')) {
    ?>
    <div class="row">
        <div class="col-md-3 text-center home_profile thumbnail">
            <?php
            $Memimg = $this->session->userdata('member_image');
            $str = call_user_func_array("pack", array_merge(array("C*"), $Memimg));
            $img = base64_encode($str);
            if ($img != NULL && count($img) > 0) {
                ?>
                <img alt="User Pic" src="data:image/jpg;base64, <?php echo $img; ?>" class="img-circle member_profile_img  img-thumbnail"> 
                <?php
            } else {
                echo '
                                <img src="' . base_url() . 'image/default_image.png" class="img-circle img-thumbnail">';
            }
            ?>
            <?php echo '<p><span class="welcome_msg">Welcome, ' . $this->session->userdata('username') . '</span></p>'; ?>
        </div>
        <div class="col-md-9">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#booksBorrowed" aria-controls="booksBorrowed" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-book"></span> Books Borrowed 
                    </a>
                </li>
                <li role="presentation">
                    <a href="#bookBankborrow" aria-controls="bookBankborrow" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span> Book Bank Borrowed </a>
                </li>
                <li role="presentation">
                    <a href="#manualBorrow" aria-controls="manualBorrow" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-floppy-disk"></span> Manuals Borrowed</a>
                </li>
                <li role="presentation">
                    <a href="#mediaBorrow" aria-controls="mediaBorrow" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-film"></span> Medias Borrowed</a>
                </li>
                <li role="presentation">
                    <a href="#reportBorrow" aria-controls="reportBorrow" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-hdd"></span> Reports Borrowed</a>
                </li>
            </ul>
            <!--            <ul class="nav nav-tabs">
                            <li class="active tab_li tab_bookBorrow">
                                <a href="#booksBorrowed" ><span class="glyphicon glyphicon-th-list"></span> Books Borrowed </a>
                            </li>
                            <li class=" tab_li tab_bookBankborrow">
                                <a href="#bookBankborrow" ><span class="glyphicon glyphicon-list"></span> Book Bank Borrowed </a>
                            </li>
                            <li class="tab_li tab_manualBorrow">
                                <a href="#manualBorrow"><span class="glyphicon glyphicon-floppy-disk"></span> Manuals Borrowed </a>
                            </li>
                            <li class="tab_li tab_mediaBorrow">
                                <a href="#mediaBorrow"><span class="glyphicon glyphicon-film"></span> Medias Borrowed </a>
                            </li>
                            <li class="tab_li tab_reportBorrow">
                                <a href="#reportBorrow"><span class="glyphicon glyphicon-folder-closet"> Reports Borrowed </a>
                            </li>
                        </ul>-->
            <div class="tab-content">
                <div role="tabpanel"  id="booksBorrowed"  class="tab-pane active" >

                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <!--                    <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Book Borrow Records:
                                                        </a>
                                                    </h4>
                                                </div>-->
                            <div class="panel-body">

                                <?php
                                if (isset($data_borrow_info) AND $data_borrow_info != NULL) {
                                    ?>	

                                    <table class="table table-striped">
                                        <th>Book Code</th>
                                        <th>Issue Date</th>
                                        <th>Title</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                        <?php
                                        foreach ($data_borrow_info as $rows) {

                                            $todays_date = date("Y-m-d");
                                            $return_date = date("Y-m-d", strtotime($rows['ReturnDate']));
                                            if (strtotime($todays_date) == strtotime($return_date)) {
                                                $status = '<label class="label label-warning">Warning</label>';
                                                ?>
                                                <tr class="warning">
                                                    <?php
                                                } else if (strtotime($todays_date) > strtotime($return_date)) {
                                                    $status = '<label class="label label-danger">Alert</label>';
                                                    ?>
                                                <tr class="danger">
                                                    <?php
                                                } else {
                                                    $status = '<label class="label label-success">ok</label>';
                                                    ?>
                                                <tr>
                                                    <?php
                                                }
                                                ?>

                                                <td><?php echo $rows['BookCode']; ?> </td>
                                                <td><?php echo $rows['IssueDate']; ?> </td>
                                                <td><?php echo $rows['Title']; ?> </td>
                                                <td><?php echo $rows['ReturnDate']; ?> </td>
                                                <td><?php echo $status; ?></td>
                                            </tr>	
                                            <?php
                                        }
                                    } else {
                                        Echo "No Book Borrow record";
                                    }
                                    ?>	
                                </table>
                            </div>
                        </div>
                    </div><!-- end class="panel-group" id="accordion" -->
                </div>

                <div role="tabpanel" id="bookBankborrow" class="tab-pane " >

                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <?php
                                    if (isset($bookBank_borrow_info) AND $bookBank_borrow_info != NULL) {
                                        ?>	

                                        <table class="table table-striped">
                                            <th>Book Id</th>
                                            <th>Acc No</th>
                                            <th>Title</th>
                                            <th>Issue Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                            <?php
                                            foreach ($bookBank_borrow_info as $rows) {

                                                $todays_date = date("Y-m-d");
                                                $return_date = date("Y-m-d", strtotime($rows['ReturnDate']));
                                                if (strtotime($todays_date) == strtotime($return_date)) {
                                                    $status = '<label class="label label-warning">Warning</label>';
                                                    ?>
                                                    <tr class="warning">
                                                        <?php
                                                    } else if (strtotime($todays_date) > strtotime($return_date)) {
                                                        $status = '<label class="label label-danger">Alert</label>';
                                                        ?>
                                                    <tr class="danger">
                                                        <?php
                                                    } else {
                                                        $status = '<label class="label label-success">ok</label>';
                                                        ?>
                                                    <tr>
                                                        <?php
                                                    }
                                                    ?>

                                                    <td><?php echo $rows['BookId']; ?> </td>
                                                    <td><?php echo $rows['AccNo']; ?> </td>
                                                    <td><?php echo $rows['Title']; ?> </td>
                                                    <td><?php echo $rows['IssueDate']; ?> </td>
                                                    <td><?php echo $rows['ReturnDate']; ?> </td>
                                                    <td><?php echo $status; ?></td>
                                                </tr>	
                                                <?php
                                            }
                                        } else {
                                            Echo "No Book Borrow record";
                                        }
                                        ?>	
                                    </table>
                                </div>
                            </div>
                        </div><!-- end class="panel-group" id="accordion" -->
                    </div>
                <div role="tabpanel" class="tab-pane" id="manualBorrow">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <?php
                                    if (isset($manual_borrow_info) AND $manual_borrow_info != NULL) {
                                        ?>	

                                        <table class="table table-striped">
                                            <th>Manual Code</th>
                                            <th>Acc No</th>
                                            <th>Title</th>
                                            <th>Issue Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                            <?php
                                            foreach ($manual_borrow_info as $rows) {

                                                $todays_date = date("Y-m-d");
                                                $return_date = date("Y-m-d", strtotime($rows['ReturnDate']));
                                                if (strtotime($todays_date) == strtotime($return_date)) {
                                                    $status = '<label class="label label-warning">Warning</label>';
                                                    ?>
                                                    <tr class="warning">
                                                        <?php
                                                    } else if (strtotime($todays_date) > strtotime($return_date)) {
                                                        $status = '<label class="label label-danger">Alert</label>';
                                                        ?>
                                                    <tr class="danger">
                                                        <?php
                                                    } else {
                                                        $status = '<label class="label label-success">ok</label>';
                                                        ?>
                                                    <tr>
                                                        <?php
                                                    }
                                                    ?>

                                                    <td><?php echo $rows['ManualCode']; ?> </td>
                                                    <td><?php echo $rows['ManualAccNo']; ?> </td>
                                                    <td><?php echo $rows['Title']; ?> </td>
                                                    <td><?php echo $rows['IssueDate']; ?> </td>
                                                    <td><?php echo $rows['ReturnDate']; ?> </td>
                                                    <td><?php echo $status; ?></td>
                                                </tr>	
                                                <?php
                                            }
                                        } else {
                                            Echo "No Manual Borrow record";
                                        }
                                        ?>	
                                    </table>
                                </div>
                            </div>
                        </div><!-- end class="panel-group" id="accordion" -->
                </div>
                <div role="tabpanel" class="tab-pane" id="mediaBorrow">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <?php
                                    if (isset($media_borrow_info) AND $media_borrow_info != NULL) {
                                        ?>	

                                        <table class="table table-striped">
                                            <th>Media Code</th>
                                            <th>Acc No</th>
                                            <th>Title</th>
                                            <th>Issue Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                            <?php
                                            foreach ($media_borrow_info as $rows) {

                                                $todays_date = date("Y-m-d");
                                                $return_date = date("Y-m-d", strtotime($rows['ReturnDate']));
                                                if (strtotime($todays_date) == strtotime($return_date)) {
                                                    $status = '<label class="label label-warning">Warning</label>';
                                                    ?>
                                                    <tr class="warning">
                                                        <?php
                                                    } else if (strtotime($todays_date) > strtotime($return_date)) {
                                                        $status = '<label class="label label-danger">Alert</label>';
                                                        ?>
                                                    <tr class="danger">
                                                        <?php
                                                    } else {
                                                        $status = '<label class="label label-success">ok</label>';
                                                        ?>
                                                    <tr>
                                                        <?php
                                                    }
                                                    ?>

                                                    <td><?php echo $rows['MediaCode']; ?> </td>
                                                    <td><?php echo $rows['AccNo']; ?> </td>
                                                    <td><?php echo $rows['Title']; ?> </td>
                                                    <td><?php echo $rows['IssueDate']; ?> </td>
                                                    <td><?php echo $rows['ReturnDate']; ?> </td>
                                                    <td><?php echo $status; ?></td>
                                                </tr>	
                                                <?php
                                            }
                                        } else {
                                            Echo "No Media Borrow record";
                                        }
                                        ?>	
                                    </table>
                                </div>
                            </div>
                        </div><!-- end class="panel-group" id="accordion" -->
                </div>
                <div role="tabpanel" class="tab-pane" id="reportBorrow">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <?php
                                    if (isset($report_borrow_info) AND $report_borrow_info != NULL) {
                                        ?>	

                                        <table class="table table-striped">
                                            <th>Report Code</th>
                                            <th>Acc No</th>
                                            <th>Title</th>
                                            <th>Issue Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                            <?php
                                            foreach ($report_borrow_info as $rows) {

                                                $todays_date = date("Y-m-d");
                                                $return_date = date("Y-m-d", strtotime($rows['ReturnDate']));
                                                if (strtotime($todays_date) == strtotime($return_date)) {
                                                    $status = '<label class="label label-warning">Warning</label>';
                                                    ?>
                                                    <tr class="warning">
                                                        <?php
                                                    } else if (strtotime($todays_date) > strtotime($return_date)) {
                                                        $status = '<label class="label label-danger">Alert</label>';
                                                        ?>
                                                    <tr class="danger">
                                                        <?php
                                                    } else {
                                                        $status = '<label class="label label-success">ok</label>';
                                                        ?>
                                                    <tr>
                                                        <?php
                                                    }
                                                    ?>

                                                    <td><?php echo $rows['ReportCode']; ?> </td>
                                                    <td><?php echo $rows['AccNo']; ?> </td>
                                                    <td><?php echo $rows['Title']; ?> </td>
                                                    <td><?php echo $rows['IssueDate']; ?> </td>
                                                    <td><?php echo $rows['ReturnDate']; ?> </td>
                                                    <td><?php echo $status; ?></td>
                                                </tr>	
                                                <?php
                                            }
                                        } else {
                                            Echo "No Report Borrow record";
                                        }
                                        ?>	
                                    </table>
                                </div>
                            </div>
                        </div><!-- end class="panel-group" id="accordion" -->
                </div>
            </div><!-- end tab-content -->
        </div><!-- end row -->
    <?php }
    ?>


</div>
</div>
</body>
</html>