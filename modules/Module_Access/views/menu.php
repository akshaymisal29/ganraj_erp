
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
<!-- Sidebar user panel -->
<div class="user-panel">
<div class="pull-left image">
<img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
</div>
<div class="pull-left info">
<p><?php echo $this->session->userdata('name')?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        
         <li><a href="<?php echo base_url(); ?>Home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
        <?php 
        
        for($i = 0; $i < $menu_count; ++$i)
        {
        	$row =$menu_view[$i];
        	
        	if($row['sub_name']==NULL)
        	{
        		echo '<li><a href="'.base_url().$row['link'].'"><i class="'.$row['class'].'"></i> <span>'.$row['main_name'].'</span></a></li>';
        	}
        	else 
        	{
        			
        		$header=$row['main_name'];
        	?>
        	<li class="treeview">
        		<a href="#">
        			<i class="<?php echo $row['class'];?>"></i> <span><?php echo $row['main_name'];?></span>
	        		<span class="pull-right-container">
	        			<i class="fa fa-angle-left pull-right"></i>
	        		</span>
        		</a>
        		<ul class="treeview-menu">
		        	<?php while($i < $menu_count  &&  $header==$row['main_name'] )
		        	      {
	        					
		        	?>	
		        	<li><a href="<?php echo base_url().$row['link']; ?>"><i class="fa fa-circle-o"></i><?php echo $row['sub_name'];?></a></li>
		        		      		
		           <?php 
		           			$i++;
		           			if($i < $menu_count) {
		       		     		$row =$menu_view[$i];
		           			}
		        	  }
		        	?>
		        	</ul>
		        		</li>
        		<?php 
        		if($i < $menu_count) {
        			$i--;
        		}
        	}
        	
        }
        ?>
		<li><a href="http://softtantra.com/support" target="_blank"><i class="fa fa-support"></i> <span>Support</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>