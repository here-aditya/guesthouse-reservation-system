<?php
$sel_menu_name = $this->uri->segment(2); // selected menu in URL
?>        
<!-- Page Middle Container -->
<div class="container-fluid">
    <!-- Middle Row -->
    <div class="row-fluid">
        <!-- Main Menu Container -->
        <div class="span2">
            <!--side navbar -->
            <div class="sidebar-nav">
                <div class="accordion" id="accordion1">
                    <?php
					if(is_array($admin_menu))
					{
						$arr_main_menu = getMenu($admin_menu); // main menu
						$colps_id = 1; // collapse id for accordion
						foreach($arr_main_menu as $main_menu) 
						{
                    ?>	
                    <div class="accordion-group">
                        <div class="accordion-heading gradient_extrawhite">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?=$colps_id?>">
                               <?=$main_menu->menu_name?>
                            </a>
                        </div>
                        <?php
                        $arr_menu_name = array();
						$arr_menu = getMenu($admin_menu, $main_menu->id); // inner menu
						foreach($arr_menu as $menu)
						{
							$arr_menu_name[] = strtolower(str_replace(' ', '', $menu->menu_name));
						}	// inner foreach
						?>
                        <div id="collapse<?=$colps_id?>" class="accordion-body collapse <?php in_array($sel_menu_name, $arr_menu_name) ? print 'in' : ''?>">
                            <?php
                            foreach($arr_menu as $menu) 
							{
								$menu_link = strtolower(str_replace(' ', '', $menu->menu_name)); // actual menu name link
                            ?>
                            <div class="accordion-inner gradient_grey">
                                <?=anchor("admin/menu/{$menu_link}", $menu->menu_name, array('class' => 'accordion-inner-toggle'));?>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                        $colps_id++;
                    	}	// outer foreach
					}	// outer if
					else
					{
						echo 'No Menu Defined';
					}
                    ?>
                </div><!--/.Accordian -->
            </div><!--/side navbar -->
        </div><!--/Main Menu Container -->