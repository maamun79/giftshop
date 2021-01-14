<?php mi_set_meta('site_base', 0);?>
<?=mi_header();?>
<?=mi_nav();?>

<?php
    $contact_info = mi_db_read_by_id('settings_meta', array('meta_name'=> 'contact_info', 'type'=> 'contact'))[0];
?>

<div class="pb-35 pt-50" style="padding-bottom: 100px">
    <div class="container">
        <h4 class="text-center">Contact Us</h4>
        <hr style="margin: 35px 0">

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Contact Information</h5>
                    </div>
                    <div class="card-body">
                        <p><?=$contact_info['meta_value'];?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Submit Your Queries</h5>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <label for="">Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="">Email<span style="color: red;">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter subject">
                            </div>
                            <div class="form-group">
                                <label for="">Message<span style="color: red;">*</span></label>
                                <textarea name="message" id="message" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-lg pull-right contact_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?=mi_footer();?>
