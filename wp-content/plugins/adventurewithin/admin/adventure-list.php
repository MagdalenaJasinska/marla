<?php ob_start();
	require('adventure-class.php');
	$adventureList = new AdventureList();
	if(!isset($_REQUEST['action']) || $_REQUEST['action']=='delete'){
		session_start();
	    //Create an instance of our package class...

	    //Fetch, prepare, sort, and filter our data...
	    $adventureList->prepare_items(); 
?>
		<div class="wrap">
			<!-- <h2>Brokers <a href="admin.php?page=add_broker" class="add-new-h2">Add New</a></h2> -->
			<?php if(!empty($adventureList->notify)) { ?>
				<div id="message" class="<?php echo $adventureList->messclass;?> notice notice-success is-dismissible">
					<p><?php echo $adventureList->notify; ?></p>
					<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
				</div>
			<?php }?>
			<form  method="post" action="">
				<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
			    <?php $adventureList->display(); ?>
			</form>
		</div>
<?php ob_flush(); 
	}

?>