		<div class="col-lg-4 col-md-6">
			
			<div class="panel panel-default">
				
				<div class="panel-heading">
					
					<h3 class="panel-title"><i class="fa fa-tasks"></i> Installed Memory</h3>
					
				</div>
				
				<div class="panel-body text-center">
					
					<?php
						$machine = new Machine_model();
						$in_green = 0;
						$in_yellow = 0;
						$in_red = 0;
						$filter = get_machine_group_filter();
						$sql = "SELECT physical_memory, count(1) as count
							FROM machine
							LEFT JOIN reportdata USING (serial_number)
							$filter
							GROUP BY physical_memory
							ORDER BY physical_memory DESC";
							
						foreach ($machine->query($sql) as $obj) {
							
							// with intval for the memory column should be robust enough for clients not converted yet to int
							
							if (intval($obj->physical_memory) >= 8 ){
								
								$in_green += $obj->count ;
								
							} elseif (intval($obj->physical_memory) < 4 ) {
								
								$in_red += $obj->count ;
								
							} else {
								
								$in_yellow += $obj->count ;
								
							}
						} // end foreach
					?>

					<a href="<?php echo url('show/listing/hardware'); ?>" class="btn btn-danger">
						<span class="bigger-150"> <?php echo $in_red; ?> </span><br>
						< 4GB
					</a>
					<a href="<?php echo url('show/listing/hardware'); ?>" class="btn btn-warning">
						<span class="bigger-150"> <?php echo $in_yellow; ?> </span><br>
						4GB +
					</a>
					<a href="<?php echo url('show/listing/hardware'); ?>" class="btn btn-success">
						<span class="bigger-150"> <?php echo $in_green; ?> </span><br>
						8GB +
					</a>
					
				</div>
				
			</div><!-- /panel -->
			
		</div><!-- /col -->
